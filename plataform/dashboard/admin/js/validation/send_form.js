    (function() {

        'use strict'
        
        // comprobamos los formularios que tengas la clase de validación

        var forms = document.querySelectorAll('.needs-validation')

        // Detenemos el envio y validamos los campos requeridos

        Array.prototype.slice.call(forms)

        .forEach(function(form) {

            form.addEventListener('submit', function(event) {

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();

                    let formulario = $(this).attr("id");
                    
                    
                    switch (formulario) {
                        case 'form_factura':       
                            
                            event.preventDefault();
                            document.getElementById("registrar_factura").click();
                            
                            break;
                        case 'form_producto':       
                            let btn_producto = document.getElementById('btn_producto').value; 
                            
                            event.preventDefault();
                            switch(btn_producto){
                                case 'Registrar':
                                    document.getElementById("registrar_producto").click();
                                    break;
                                case 'Actualizar':
                                    document.getElementById("editar_producto").click(); 
                                    break;
                                default:
                                    alert('Error al enviar..');
                                
                            }
                            
                            break;
                        case 'form_cliente':        
                            let btn_cliente = document.getElementById('btn_cliente').value;    
                            
                            event.preventDefault();
                            switch(btn_cliente){
                                case 'Registrar':
                                    document.getElementById("registrar_cliente").click();
                                    break;
                                case 'Actualizar':
                                    document.getElementById("editar_cliente").click(); 
                                    break;
                                default:
                                    alert('Error al enviar..');
                                
                            }
                            
                            break;
                        default:
                            break;
                    }
                }
                form.classList.add('was-validated')

            }, false)

        })

    })()