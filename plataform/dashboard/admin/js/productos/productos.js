$(document).ready(function() {
    
    function cargar_selector_categorias(){
        $.ajax({
            url: "?c=categoria&a=cargar_categorias",
            method: "POST",
            dataType: 'json',
            error: function(request, error) {
                console.log(arguments);
                alert('Ocurrio un error');
            },
            success: function(data) {   
                $("#categoriaId").html(data.categorias);
            }
        });
    }

    cargar_selector_categorias();

    function cargar_productos(){
        $('#tbl_productos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": { 
                url: "?c=producto&a=listar_productos",
                type: "POST",
            },
            "autoWidth": false,
            "bDestroy": true
    
        });
    }

    cargar_productos();

    $(document).on('click', '.registrar_producto', function() { 
        $("#modal_form_producto").modal('show'); 
        $('#form_producto').trigger("reset"); 
        $("#btn_producto").val("Registrar");
        $("#descripcionP").prop("required", true);
        $("#disponibleSi").attr('checked', false);
        $("#disponibleNo").attr('checked', true);
        $("#existencia").prop("required", true);
        $("#precio").prop("required", true);
        $("#categoriaId").prop("required", true);
        $(".deshabilitar_producto").hide();
    });

    $("#registrar_producto").on('click', function() { 
        var formData = new FormData($('#form_producto').get(0)); 
        $("#btn_producto").prop("disabled", true);
        
        $.ajax({
            url: '?c=producto&a=registrar_producto',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            error: function(request, error) {
                $("#btn_producto").prop("disabled", false);
            },
            success: function(data) {
                alert(data);
                $('#modal_form_producto').modal('hide'); 
                $('#form_producto').trigger("reset");
                $("#btn_producto").prop("disabled", false);
                cargar_productos();
            }
        });

    }); 
    
    $("#editar_producto").on('click', function() { 
        var formData = new FormData($('#form_producto').get(0)); 
        $("#btn_producto").prop("disabled", true);
        
        $.ajax({
            url: '?c=producto&a=editar_producto',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            error: function(request, error) {
                $("#btn_producto").prop("disabled", false);
            },
            success: function(data) {
                alert(data);
                $('#modal_form_producto').modal('hide'); 
                $('#form_producto').trigger("reset");
                $("#btn_producto").prop("disabled", false);
                cargar_productos();
            }
        });

    }); 

    $(document).on('click', '.obtener_producto', function() {  
        $('#form_producto').trigger("reset"); 
        $("#btn_producto").val("Actualizar");
        $("#descripcionP").prop("required", true);
        $("#disponibleSi").attr('checked', false);
        $("#disponibleNo").attr('checked', true); 
        $("#existencia").prop("required", true);
        $("#precio").prop("required", true);
        $("#categoriaId").prop("required", true);
        $(".deshabilitar_producto").show();
        let productId = $(this).attr("id");
        obtener_producto(productId);
    });

    function obtener_producto(productId){
        $.ajax({
            url: "?c=producto&a=obtener_producto",
            method: "POST",
            data:{ productId },
            dataType: 'json',
            error: function(request, error) {
                console.log(arguments);
                alert('Ocurrio un error');
            },
            success: function(data) {   
                
                $("#modal_form_producto").modal('show'); 
                
                $("#product_seleccionado").val(data.id);   
                $("#descripcionP").val(data.descripcion);   
                $("#categoriaId").val(data.categoria.id);   
                $("#existencia").val(data.existencia);
                $("#precio").val(data.precio);
                if(data.disponible){
                    $("#disponibleSi").attr('checked', true);
                    $("#disponibleNo").attr('checked', false);
                }else{
                    $("#disponibleSi").attr('checked', false);
                    $("#disponibleNo").attr('checked', true);
                }
                $('.deshabilitar_producto').attr("id", data.id);
            }
        });
    }

    $(".deshabilitar_producto").on('click', function() {  
        let productId = $(this).attr("id");
        $(".deshabilitar_producto").prop("disabled", true);

        if (window.confirm("¿Estás seguro de que deseas continuar?")) {
            $.ajax({
                url: '?c=producto&a=deshabilitar_producto',
                method: "POST",
                data:{ productId },
                success: function(data) {
                    alert(data);
                    $('#form_producto').trigger("reset"); 
                    $("#modal_form_producto").modal('hide');
                    cargar_productos(); 
                }
            });
        } 
        
        $(".deshabilitar_producto").prop("disabled", false);
        
    }); 
    
    $(document).on('click', '.eliminar_producto', function() {  
        let productId = $(this).attr("id");
        $(".eliminar_producto").prop("disabled", true);

        if (window.confirm("¿Estás seguro de que deseas continuar?")) {
            $.ajax({
                url: '?c=producto&a=deshabilitar_producto',
                method: "POST",
                data:{ productId },
                success: function(data) {
                    alert(data);
                    cargar_productos(); 
                }
            });
        } 
        
        $(".eliminar_producto").prop("disabled", false);
        
    }); 

});