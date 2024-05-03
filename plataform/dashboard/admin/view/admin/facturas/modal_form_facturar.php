<div class="modal fade" id="modal_form_facturar" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content " >
            <div class="modal-header bg-success text-light">
                <h5 class="modal-title" id="ModalLabel">Gestionar factura</h5> 
                <a data-bs-dismiss="modal">
                  <font size="+3">x</font>
                </a>
            </div>
            <div class="modal-body">
              <a id='registrar_factura' class="registrar_factura"></a> 
              <form method="post" class="needs-validation row" id="form_factura" novalidate> 
                <input type="hidden" id="cliente_id" name="cliente_id"/> 
                <div class="col-5 p-3">
                    <b>Cliente</b> 
                    <input type="text" class="form-control" id="clienteSearch" placeholder="Documento.."/>
                </div>
                <div class="col-7 p-3">
                    <b>Resultado:</b> 
                    <h3 id="clienteEncontrado" class="text-center"></h3>
                </div>
                <div class="col-12 p-3">
                    <b>Descripción</b> 
                    <input type="text" class="form-control" name="descripcion" id="descripcionF"  require placeholder="Descripción.."/>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un valor valido..</div> 
                </div>
                <div class="col-12 p-3">
                    <b>Observación</b> 
                    <textarea class="form-control" name="observacion" id="observacionF" rows="3" require placeholder="Contenido de la observacion.."></textarea>
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">Ingresa un valor valido..</div> 
                </div>
                <div class="col-5 p-3">
                    <b>Buscar producto</b> 
                    <input type="text" class="form-control" name="productoSearch" id="productoSearch" require placeholder="Nombre del producto.."/>
                </div>
                <div class="col-7 p-3">
                    <b>Resultado:</b> 
                    <center id="productoEncontrado"></center>
                </div>
                <div class="col-12 p-3"> 
                    <div class="table table-responsive w-100 d-block d-md-table" width="100%"> 
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>       
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Cantidad</th>        
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody id="tbl_body_detalles">
                                
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <input type="submit" value="Registrar" id="btn_factura" name="btn_accion" class="btn btn-outline-success" />
                </div>   
              </form>
            </div>
        </div>
    </div>
</div>