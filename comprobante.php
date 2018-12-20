<?php 
    date_default_timezone_set("America/Lima");
    session_start();
    $nivel = $_SESSION['nivel'];
?>
<div class="page-title">
  <div class="title_left">
    <h3>COMPROBANTES</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Busqueda Filtrada</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="row">
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <label class="control-label" for="fechainicio-id">Desde: </label>
            <input type="text"  id="fechainicio-id" name="fechainicio-name" value="<?php echo date("d/m/Y"); ?>" onclick="this.select()" onkeyup="convertir_fecha(event,this,10);" class="form-control" autofocus>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <label class="control-label" for="fechafin-id">Hasta: </label>
            <input type="text" id="fechafin-id" name="fechafin-name" value="<?php echo date("d/m/Y"); ?>" onclick="this.select()" onkeyup="convertir_fecha(event,this,10);" class="form-control">
          </div>
          <div class="col-md-2 col-sm-12 col-xs-12 xs-mb-10">
            <div class="xs-mt-25">
                  <button type="button" class="btn btn-success btn-app" onclick="filtrar_comprobantes()" ><span class="fa fa-filter"></span>Filtrar</button>
            </div>
          </div>
          <div class="col-md-2 col-sm-12 col-xs-12 xs-mb-10">
            <div class="xs-mt-25">
              <button type="button" class="btn btn-success btn-app" data-toggle="modal" data-target=".bs-descarga-excel-modal-lg"><span class="fa fa-cloud-download"></span>Descargar Excel</button>
            </div>
          </div>
        </div>
         <div class="row">
          <hr>
          <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label class="control-label" for="txtDocumento" style="height: 40px">Tipo de documento: </label>
            <input type="text" id="txtDocumento" name="txtDocumento" value="" class="form-control" placeholder="01" maxlength="2" onkeypress="return numero(event);">
          </div>
        <?php
          if ($nivel==1) {
        ?>
          <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label class="control-label" for="txtRsocial" style="height: 40px">Razón Social:</label>
            <input type="text" id="txtRsocial" name="txtRsocial" value="" class="form-control" placeholder="41542154124" maxlength="11" onkeypress="return numero(event);">
          </div>
        <?php
          } else {
        ?>
          <input type="hidden" id="txtRsocial" name="txtRsocial" value="">
        <?php
          }
        ?>
          <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label class="control-label" for="txtSerie" style="height: 40px">Serie:</label>
            <input type="text" id="txtSerie" name="txtSerie" value="" class="form-control mayus" placeholder="F001" onkeyup="mayus(this);" maxlength="4">
          </div>
          <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label class="control-label" for="txtNumero" style="height: 40px">Numero de Comprobante: </label>
            <input type="text" id="txtNumero" name="txtNumero" value="" class="form-control" placeholder="0000001" maxlength="7" onkeypress="return numero(event);">
          </div>
          <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label class="control-label" for="txtMoneda" style="height: 40px">Tipo de Monedas: </label>
            <input type="text" id="txtMoneda" name="txtMoneda" value="" class="form-control" placeholder="52" maxlength="2" onkeypress="return numero(event);">
          </div>
          <div class="col-md-2 col-sm-12 col-xs-12 xs-mb-10">
            <div class="xs-mt-25">
                  <button type="button" class="btn btn-success btn-app" onclick="filtrar_otros('lista_comprobantes.php')" ><span class="fa fa-filter"></span>Filtrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Resultados de Busqueda</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content "> 
      <div class="row" id = "campos_tabla">
          
        
      </div>       
        
          
          
      </div>
    </div>
  </div>
</div>


                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body" id="panel_movil_comprobante">

                          <button type="button" class="btn btn-default" onclick="imprimirdocumento()">Imprimir</button>

                    <button type="button" class="btn btn-primary">Ver en navegador</button>

                    
                            <iframe id="pdf-iframe" src="" FRAMEBORDER="no" BORDER="0" height="700" width="100%"></iframe>
                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="modal fade bs-descarga-excel-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Descargar Excel</h4>
                        </div>
                        <div class="modal-body">
                          <p>Descargar en un excel todos los documentos filtrados.</p>
                          <div>
                            <button type="button" class="btn btn-primary btn-block" ><span class="fa fa-cloud-download"></span> Descargar en Excel los Documentos</button>

                    <button type="button" class="btn btn-primary btn-block"><span class="fa fa-cloud-download"></span> Descargar en Excel El Detalle o Items</button>
                          </div>
                        </div>
                        

                      </div>
                    </div>
                  </div>
<script type="text/javascript">
  $("#datatable").DataTable({language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 en 0 de 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar: ",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }});

</script>