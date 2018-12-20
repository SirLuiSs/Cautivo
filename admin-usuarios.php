<div class="page-title">
  <div class="title_left">
    <h3>Usuarios</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Opciones</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">        
         <div class="col-md-2 col-sm-12 col-xs-12 ">
          <button type="button" onclick="ponerpanel('nuevo-usuarios.php');" class="btn btn-success btn-app btn-block" data-toggle="modal" ><span class="fa fa-user"></span> Nuevo Usuario</button>
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
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_content bs-example-popovers">
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>Se encontraron 5 resultados.</strong>
            </div>            
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
          <table  id="datatable1" class="table table-striped table-bordered">
            <thead>
              <tr>                
                <th class="text-center">Opciones</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Usuario</th>
                <th class="text-center">Cliente</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td >
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-descarga-excel-modal-lg"><span class="fa fa-pencil-square-o"></span>
                  </button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-descarga-excel-modal-lg"><span class="fa fa-eye"></span>
                  </button>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-descarga-excel-modal-lg"><span class="fa fa-times"></span>
                  </button>
                </td>
                <td >05-10-2018</td>
                <td >USUARIOS1</td>
                <td >BRUFAT SAC</td>
              </tr>
            

            </tbody>
          </table>
        </div>
        </div>
        
      </div>       
        
          
          
      </div>
    </div>
  </div>
  </div>
  <div class="modal fade modal-nuevo-usuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
        </div>
        <div class="modal-body">
          <form  class="form-horizontal form-label-left ajax">
            <div class="row">
            <div class="form-group">
              <label for="Total-name" class="control-label col-md-3 col-sm-3 col-xs-12" for="fechaemision-name">Cliente</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="fechaemision-id" name="fechaemision-name"  autocomplete="off" class="form-control ">
              </div>
            </div>
            <div class="form-group">
              <label for="Total-name" class="control-label col-md-3 col-sm-3 col-xs-12" for="fechaemision-name">Usuario</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="fechaemision-id" name="fechaemision-name"  autocomplete="off" class="form-control ">
              </div>
            </div>
            <div class="form-group">
              <label for="Total-name" class="control-label col-md-3 col-sm-3 col-xs-12" for="fechaemision-name">Contraseña</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" id="fechaemision-id" name="fechaemision-name"  autocomplete="off" class="form-control ">
              </div>
            </div>
            <div class="form-group">
              <label for="Total-name" class="control-label col-md-3 col-sm-3 col-xs-12" for="fechaemision-name">Contraseña</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" id="fechaemision-id" name="fechaemision-name"  autocomplete="off" class="form-control ">
              </div>
            </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Grabar</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  $("#datatable1").DataTable({language: {
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