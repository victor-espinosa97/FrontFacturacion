$(document).ready(function() {
    var productosAgregados = [];

    function cargar_facturas(){
        $('#tbl_facturas').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": { 
                url: "?c=facturas&a=listar_facturas",
                type: "POST",
            },
            "autoWidth": false,
            "bDestroy": true
    
        });
    }

    cargar_facturas();

    $(document).on('click', '.crear_factura', function() { 
        $("#modal_form_facturar").modal('show'); 
        $('#form_factura').trigger("reset"); 
        $("#clienteEncontrado").html('');
        $("#productoEncontrado").html('');
        productosAgregados = [];
        $("#tbl_body_detalles").html('');

        $("#btn_cliente").val("Registrar");
        // cliente_id
    });

    $('#clienteSearch').on('change', function(){
        var dato = $(this).val();
        if(dato==='')return;
        $.ajax({
            url: "?c=clientes&a=buscar_por_dato",
            method: "POST",
            data:{ dato },
            dataType: 'json',
            error: function(request, error) {
                console.log(arguments);
                alert('Ocurrio un error');
            },
            success: function(data) {   
                if(!!data){
                    $("#cliente_id").val(data.id);
                    $("#clienteEncontrado").html(data.identificacion +' - '+data.nombreCompleto);
                    $("#clienteEncontrado").removeClass("text-danger");
                    $("#clienteEncontrado").addClass("text-success");

                }else{
                    $("#cliente_id").val('');
                    $("#clienteEncontrado").html('No se encontraron resultados..');
                    $("#clienteEncontrado").removeClass("text-success");
                    $("#clienteEncontrado").addClass("text-danger");

                }
            }
        });
    });
 
    $('#productoSearch').on('change', function(){
        var dato = $(this).val();
        if(dato==='')return;
        $.ajax({
            url: "?c=producto&a=buscar_por_dato",
            method: "POST",
            data:{ dato },
            dataType: 'json',
            error: function(request, error) {
                console.log(arguments);
                alert('Ocurrio un error');
            },
            success: function(data) {   
                if(!!data){
                    $("#productoEncontrado").html(`<div class="d-flex justify-content-around">
                                                    <h3>`+data.descripcion +` - `+data.precio+` - unidades: `+data.existencia+`</h3>
                                                    <button 
                                                        type="button"
                                                        class="btn btn-success agregar_producto" 
                                                        data-id="`+data.id +`"
                                                        data-descripcion="`+data.descripcion +`"
                                                        data-disponible="`+data.disponible +`"
                                                        data-existencia="`+data.existencia +`"
                                                        data-precio="`+data.precio +`"
                                                    > + agregar
                                                    </button>
                                                </div>`);

                }else{
                    $("#productoEncontrado").html('<h3>No se encontraron resultados..</h3>');
                }
            }
        });
    });
    
    $(document).on('click', '.agregar_producto', function() {    
        var id = $(this).attr("data-id");
        var descripcion = $(this).attr("data-descripcion");
        var disponible = $(this).attr("data-disponible"); 
        var existencia = parseInt($(this).attr("data-existencia")); 
        var precio = parseFloat($(this).attr("data-precio")); 
        
        if(disponible!=='true'){
            alert("Este producto esta marcado como no disponible");
            return;
        }
        
        var producto = {
            id: id,
            descripcion: descripcion,
            existencia: existencia,
            precio: precio,
            cantidad: 1
        };
        productosAgregados.push(producto);
        
        var fila = `
        <tr data-id="${id}">
            <td>${descripcion}</td>
            <td>${precio}</td>
            <td><input type="number" min="1" max="${existencia}" value="1" class="cantidad_producto"></td>
            <td class="subtotal"></td>
            <td><button class="btn btn-danger retirar_producto">Eliminar</button></td>
        </tr>`;
        $("#tbl_body_detalles").append(fila);
    });
    
    $(document).on('change', '.cantidad_producto', function() {
        var id = $(this).closest("tr").data("id");
        var cantidad = parseInt($(this).val());
        var existencia = parseInt($(this).closest("tr").find("td:eq(2)").text());

        if(existencia<1)return alert("Este producto no tiene existencias disponibles");
        
        var precio = parseFloat($(this).closest("tr").find("td:eq(1)").text());
        var subtotal = cantidad * precio;
        $(this).closest("tr").find(".subtotal").text(subtotal.toFixed(2));
        
        //Modificar el producto del array
        for (var i = 0; i < productosAgregados.length; i++) {
            if (productosAgregados[i].id === `${id}`) {
                productosAgregados[i].cantidad = cantidad;
                break;
            }
        }
    });
    
    $(document).on('click', '.retirar_producto', function() {
        var id = $(this).closest("tr").data("id");
        $(this).closest("tr").remove();
        // Eliminar el producto del array
        productosAgregados = productosAgregados.filter(function(producto) {
            return producto.id !== `${id}`;
        });
    });

    $(".registrar_factura").on('click', function() { 
        
        var clienteId = $("#cliente_id").val();
        var descripcion = $("#descripcionF").val();
        var observacion = $("#observacionF").val();
        
        if (clienteId === '' || descripcion === '' || observacion === '' || productosAgregados.length<1) {
            alert("Completar todos los campos, y selecionar por lo menos un producto");
            return;
        }
        const data = { productos: productosAgregados, clienteId, descripcion, observacion };
        console.log(data);
        $("#btn_cliente").val("Registrar");
        
        $.ajax({
            url: '?c=facturas&a=registrar_factura',
            type: 'post',
            data,
            error: function(request, error) {
                $("#btn_factura").prop("disabled", false);
            },
            success: function(data) {
                $("#modal_form_facturar").modal('hide');
                $('#form_factura').trigger("reset");
                $("#btn_factura").prop("disabled", false);
                $("#clienteEncontrado").html('');
                $("#productoEncontrado").html('');
                productosAgregados = [];
                $("#tbl_body_detalles").html('');
                alert(data);
                cargar_facturas();
            }
        });

    }); 

    $(document).on('click', '.obtener_facturas_cliente', function() { 
        let clienteId = $(this).attr("id");
        $.ajax({
            url: "?c=clientes&a=obtener_cliente",
            method: "POST",
            data:{ clienteId },
            dataType: 'json',
            error: function(request, error) {
                alert('Ocurrio un error');
            },
            success: function(data) {   
                $("#modal_form_facturas_cliente").modal('show'); 
                
                $("#fechaIngreso_info").html(data.fechaIngreso);   
                $("#capacidadCredito_info").html(data.capacidadCredito);   
                $("#correoElectronico_info").html(data.correoElectronico);   
                $("#direccion_info").html(data.direccion);   
                $("#identificacion_info").html(data.identificacion);
                $("#nombreCompleto_info").html(data.nombreCompleto);
                $("#telefono_info").html(data.telefono);
                $("#tipoIdentificacion_info").html(data.tipoIdentificacion);
                cargar_facturas_cliente(data.id);
            }
        });
        
    });

    function cargar_facturas_cliente(cliente){
        $('#tbl_facturas_cliente').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": { 
                url: "?c=facturas&a=listar_facturas_cliente&cliente="+cliente,
                type: "POST",
            },
            "autoWidth": false,
            "bDestroy": true
    
        });
    }

    
});