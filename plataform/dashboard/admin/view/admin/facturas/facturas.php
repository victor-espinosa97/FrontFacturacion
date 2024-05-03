  <div class="tabcontent" id="pagina_facturas">

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="card-body pb-0">
                  <div class="card-title">
                    <h3>Listado de facturas</h3>
                    <button  
                      id=""
                      class="btn btn-outline-success btn-sm crear_factura m-4" 
                      type="button"
                    >
                      Nuevo factura
                    </button>
                  </div>
                  <div class="table table-responsive w-100 d-block d-md-table" width="100%"> 
                      <table class="table table-striped table-sm" id="tbl_facturas">
                          <thead>
                            <tr>       
                              <th>Nro. Factura</th>
                              <th>Fecha</th>
                              <th>Cliente</th>
                              <th>Descripcion</th>        
                              <th>Subtotal</th>        
                            </tr>
                          </thead>
                      </table>
                  </div>
                  <form action="report/export_excel_ventas.php" method="post">
                    
                    <button type="submit" name="btn_export_rep_ventas" class="btn btn-outline-success form-control">
                      <i class="ri-file-excel-2-line"></i> Exportar general
                    </button>
                  </form>
                  <br>
                </div>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>
</div>
