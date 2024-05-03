<div class="modal fade" id="modal_form_facturas_cliente" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content " >
            <div class="modal-header bg-success text-light">
                <h5 class="modal-title" id="ModalLabel">Gestionar factura</h5> 
                <a data-bs-dismiss="modal">
                  <font size="+3">x</font>
                </a>
            </div>
            <div class="modal-body p-5">
                <table class="table table-sm">
                    <tr><th>Tipo de documento: <b id="tipoIdentificacion_info"></b></th></tr>
                    <tr><th>Identificación: <b id="identificacion_info"></b></th></tr>
                    <tr><th>Teléfono: <b id="telefono_info"></b></th></tr>
                    <tr><th>Dirección: <b id="direccion_info"></b></th></tr>
                    <tr><th>Nombre completo: <b id="nombreCompleto_info"></b></th></tr>
                    <tr><th>FechaIngreso: <b id="fechaIngreso_info"></b></th></tr>
                    <tr><th>Correo electrónico: <b id="correoElectronico_info"></b></th></tr>
                    <tr><th>Capacidad credito: <b id="capacidadCredito_info"></b></th></tr>
                </table>
                <hr>
                <div class="table table-responsive w-100 d-block d-md-table" width="100%"> 
                    <table class="table table-striped table-sm" id="tbl_facturas_cliente">
                        <thead>
                            <tr>
                                <th>Nro. Factura</th>        
                                <th>Fecha</th>
                                <th>Descripción</th>        
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>