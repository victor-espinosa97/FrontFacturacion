<div class="modal fade" id="modal_form_cliente" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content " >
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Gestionar cliente</h5> 
                <a data-bs-dismiss="modal">
                  <font size="+3">x</font>
                </a>
            </div>
            <div class="modal-body">
              <a id='registrar_cliente' class="registrar_cliente"></a> 
              <a id='editar_cliente' class="editar_cliente"></a> 
              <form method="post" class="needs-validation row" id="form_cliente" novalidate> 
                <input type="hidden" id="cliente_seleccionado" name="cliente_seleccionado"/> 
                <div class="col-12 p-3">  
                    <b>Nombre:</b> 
                    <input type="text" class="form-control" name="nombreCompleto" id="nombreCompleto" placeholder="Nombre.."/>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un nombre valido..</div> 
                </div>
                <div class="col-12 p-3">  
                    <b>Capacidad Credito:</b> 
                    <input type="number" class="form-control" name="capacidadCredito" id="capacidadCredito" placeholder="1000000.."/>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un valor valido..</div> 
                </div>
                <div class="col-12 p-3">  
                    <b>Correo eléctronico:</b> 
                    <input type="email" class="form-control" name="correoElectronico" id="correoElectronico" placeholder="correo@example.."/>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un valor valido..</div> 
                </div>
                <div class="col-12 p-3">  
                    <b>Tipo de Identificacion:</b> 
                    <select class="form-select" id="tipoIdentificacion" name="tipoIdentificacion">
                        <option selected disabled value="">Seleccionar...</option>
                        <option value="Cédula">Cédula</option>
                        <option value="Contraseña">Contraseña</option>
                        <option value="Nit">Nit</option>
                        <option value="RUT">RUT</option>
                        <option value="Tarjeta identidad">Tarjeta identidad</option>
                    </select>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un valor valido..</div> 
                </div>
                <div class="col-12 p-3">  
                    <b>Identificacion:</b> 
                    <input type="text" class="form-control" name="identificacion" id="identificacion" placeholder="103696.."/>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un valor valido..</div> 
                </div>
                <div class="col-12 p-3">  
                    <b>Dirección:</b> 
                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Calle 30.."/>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un valor valido..</div> 
                </div>
                <div class="col-12 p-3">  
                    <b>Teléfono:</b> 
                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="310320.."/>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un valor valido..</div> 
                </div>
                <div class="col-12 p-3"> 
                    <br>
                    <input type="submit" id="btn_cliente" name="btn_accion" class="btn btn-success text-light form-control" />
                    <hr>
                    <center>
                        <a class="deshabilitar_cliente"> Eliminar cliente</a>
                    </center>
                </div>   
              </form>
            </div>
        </div>
    </div>
</div>