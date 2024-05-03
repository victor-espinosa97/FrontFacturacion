<div class="modal fade" id="modal_form_producto" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content " >
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Gestionar producto</h5> 
                <a data-bs-dismiss="modal">
                  <font size="+3">x</font>
                </a>
            </div>
            <div class="modal-body">
              <a id='registrar_producto' class="registrar_producto"></a> 
              <a id='editar_producto' class="editar_producto"></a> 
              <form method="post" class="needs-validation row" id="form_producto" novalidate> 
                <input type="hidden" id="product_seleccionado" name="product_seleccionado"/> 
                <div class="col-12 p-3">  
                    <b>Nombre:</b> 
                    <input type="text" class="form-control" name="descripcion" id="descripcionP" placeholder="Nombre.."/>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un nombre valido..</div> 
                </div>
                <div class="col-12 p-3">
                    <b>Existencia:</b> 
                    <input type="number" class="form-control" name="existencia" id="existencia" placeholder="10.."/>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un valor valido..</div> 
                </div>
                <div class="col-12 p-3">
                    <div class="d-flex justify-content-between">
                        <b>¿Hay diponibilidad:</b> 
                        <div>
                            <input type="radio" id="disponibleSi" name="disponible" value="1">
                            <label for="1">Si</label><br>
                        </div>
                        <div>
                            <input type="radio" id="disponibleNo" name="disponible" value="0">
                            <label for="0">No</label><br>
                        </div>
                    </div>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Selecciona un valor valido..</div> 
                </div>
                <div class="col-12 p-3">
                    <b>Precio:</b> 
                    <input type="number" class="form-control" name="precio" id="precio" placeholder="10.000.."/>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un valor valido..</div> 
                </div>
                <div class="col-12 p-3">  
                    <b>Categoría:</b> 
                    <select class="form-select" id="categoriaId" name="categoriaId"></select>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Selecciona una categoria valida..</div> 
                </div>
                <div class="col-12 p-3"> 
                    <br>
                    <input type="submit" id="btn_producto" name="btn_accion" class="btn btn-success text-light form-control" />
                    <hr>
                    <center>
                        <a class="deshabilitar_producto"> Eliminar producto</a>
                    </center>
                </div>   
              </form>
            </div>
        </div>
    </div>
</div>