$(document).ready(function() {

    function cargar_clientes(){
        $('#tbl_clientes').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": { 
                url: "?c=clientes&a=listar_clientes",
                type: "POST",
            },
            "autoWidth": false,
            "bDestroy": true
    
        });
    }

    cargar_clientes();

    $(document).on('click', '.registrar_cliente', function() { 
        $("#modal_form_cliente").modal('show'); 
        $('#form_cliente').trigger("reset"); 
        $("#btn_cliente").val("Registrar");
        $("#capacidadCredito").prop("required", true);
        $("#correoElectronico").prop("required", true);
        $("#direccion").prop("required", true);
        $("#identificacion").prop("required", true);
        $("#nombreCompleto").prop("required", true);
        $("#telefono").prop("required", true);
        $("#tipoIdentificacion").prop("required", true);
        $(".deshabilitar_cliente").hide();
    });

    $("#registrar_cliente").on('click', function() { 
        var formData = new FormData($('#form_cliente').get(0)); 
        $("#btn_cliente").prop("disabled", true);
        
        $.ajax({
            url: '?c=clientes&a=registrar_cliente',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            error: function(request, error) {
                $("#btn_cliente").prop("disabled", false);
            },
            success: function(data) {
                alert(data);
                $('#modal_form_cliente').modal('hide'); 
                $('#form_cliente').trigger("reset");
                $("#btn_cliente").prop("disabled", false);
                cargar_clientes();
            }
        });

    }); 
    
    $("#editar_cliente").on('click', function() { 
        var formData = new FormData($('#form_cliente').get(0)); 
        $("#btn_cliente").prop("disabled", true);
        
        $.ajax({
            url: '?c=clientes&a=editar_cliente',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            error: function(request, error) {
                $("#btn_cliente").prop("disabled", false);
            },
            success: function(data) {
                alert(data);
                $('#modal_form_cliente').modal('hide'); 
                $('#form_cliente').trigger("reset");
                $("#btn_cliente").prop("disabled", false);
                cargar_clientes();
            }
        });

    }); 

    $(document).on('click', '.obtener_cliente', function() {  
        $('#form_cliente').trigger("reset"); 
        $("#btn_cliente").val("Actualizar");
        $("#capacidadCredito").prop("required", true);
        $("#correoElectronico").prop("required", true);
        $("#direccion").prop("required", true);
        $("#identificacion").prop("required", true);
        $("#nombreCompleto").prop("required", false);
        $("#telefono").prop("required", false);
        $("#tipoIdentificacion").prop("required", false);
        $(".deshabilitar_cliente").show();
        let clienteId = $(this).attr("id");
        $('.deshabilitar_cliente').removeAttr("id");
        obtener_cliente(clienteId);
    });

    function obtener_cliente(clienteId){
        $.ajax({
            url: "?c=clientes&a=obtener_cliente",
            method: "POST",
            data:{ clienteId },
            dataType: 'json',
            error: function(request, error) {
                alert('Ocurrio un error');
            },
            success: function(data) {   
                $("#modal_form_cliente").modal('show'); 
                
                $("#cliente_seleccionado").val(data.id);   
                $("#capacidadCredito").val(data.capacidadCredito);   
                $("#correoElectronico").val(data.correoElectronico);   
                $("#direccion").val(data.direccion);   
                $("#identificacion").val(data.identificacion);
                $("#nombreCompleto").val(data.nombreCompleto);
                $("#telefono").val(data.telefono);
                $("#tipoIdentificacion").val(data.tipoIdentificacion);
                $('.deshabilitar_cliente').attr("id", data.id);
            }
        });
    }
    
    $(".deshabilitar_cliente").on('click', function() {  
        let clienteId = $(this).attr("id");
        $(".deshabilitar_cliente").prop("disabled", true);

        if (window.confirm("¿Estás seguro de que deseas continuar?")) {
            $.ajax({
                url: '?c=clientes&a=deshabilitar_cliente',
                method: "POST",
                data:{ clienteId },
                success: function(data) {
                    alert(data);
                    $('#form_cliente').trigger("reset"); 
                    $("#modal_form_cliente").modal('hide');   
                    cargar_clientes(); 
                }
            });
        } 
        
        $(".deshabilitar_cliente").prop("disabled", false);
        
    }); 

});