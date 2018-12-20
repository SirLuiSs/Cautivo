<?php 
session_start();
$datos_usuario = $_SESSION['datos_usuario'];
    include_once("clases/conexion.php");
    $con = new conexion();
    $otros = $_POST['otros'];
    if($otros=="1") {
        $txtDocumento = $_POST['txtDocumento'];
        $txtRsocial = $_POST['txtRsocial'];
        $txtSerie = "P";
        $txtNumero = $_POST['txtNumero'];
        $txtMoneda = $_POST['txtMoneda'];
        $id_empresa = $datos_usuario['id_emp'];
        $query = "SELECT * FROM fe_comprobantes where tip_sunat like '%" . $txtDocumento . "' and ruc_dni like '%" . $txtRsocial . "' and serie like '" . $txtSerie . "%' and numero like '%" . $txtNumero . "' and moneda like '%" . $txtMoneda . "' and id_empresa = '$id_empresa'";
        $query2 = "SELECT * FROM fe_comprobantes where tip_sunat like '%" . $txtDocumento . "' and ruc_dni like '%" . $txtRsocial . "' and serie like '" . $txtSerie . "%' and numero like '%" . $txtNumero . "' and moneda like '%" . $txtMoneda . "' ";
        if($datos_usuario['nivel'] == '1'){
            $data_comprobante = $con->exe_data($query2);
        }else{
            $data_comprobante = $con->exe_data($query);
        }
    } else {
        $fechainicio = $_POST['fechainicio'];
        $conwww=split("/",$fechainicio);
        //var_dump($fechaemision);
        $fechainicio = $conwww[2].'-'.$conwww[1].'-'.$conwww[0];
        $fechafin = $_POST['fechafin'];
        $conwww2=split("/",$fechafin);
        //var_dump($fechaemision);
        $fechafin = $conwww2[2].'-'.$conwww2[1].'-'.$conwww2[0];
        //echo json_encode($datos_usuario);exit;
        $id_empresa = $datos_usuario['id_emp'];
        $query = "select * from fe_comprobantes where fec_emi between '$fechainicio' and '$fechafin' and serie like 'P%' and id_empresa = '$id_empresa';";

        $query2 = "select * from fe_comprobantes where fec_emi between '$fechainicio' and '$fechafin' and serie like 'P%';";
        $data_comprobante = array();
        if($datos_usuario['nivel'] == '1'){
            $data_comprobante = $con->exe_data($query2);
        }else{
            $data_comprobante = $con->exe_data($query);
        }
    }

    
    $count = count($data_comprobante['DATA']);
 ?>
 <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_content bs-example-popovers">
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>Se encontraron <?php echo $count; ?> resultados.</strong>
            </div>            
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="table-responsive" >
            <table  id="datatable_comprobante" class="table table-striped table-bordered">
            <thead>
              <tr>                
                <th class="text-center">Fecha</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Serie</th>
                <th class="text-center">Número</th>
                <th class="text-center">Ruc,Dni,etc.</th>
                <th class="text-center">Denominacion</th>
                <th class="text-center">M</th>
                <th class="text-center">Total</th>
                <th class="text-center">Total Gratuita</th>
                <th class="text-center">Pagado</th>
                <th class="text-center">Enviado al Cliente</th>
                <th class="text-center">Leido por el Cliente</th>
                <th class="text-center">Imprimir</th>
                <th class="text-center">Pdf</th>
                <th class="text-center">Xml</th>
                <th class="text-center">CDR</th>
                <th class="text-center">Estado en la Sunat</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                $count = 0;
                $importeBoleta = 0;
                $importeFactura= 0;
                $importeNC= 0;
                $importeND= 0;
                foreach ($data_comprobante['DATA'] as $key) {
                    # code...
                 ?>
              <tr>
                <?php
                    $fecemi = $key['fec_emi'];
                    $f1=$fecemi{0};
                    $f2=$fecemi{1};
                    $f3=$fecemi{2};
                    $f4=$fecemi{3};
                    $f6=$fecemi{5};
                    $f7=$fecemi{6};
                    $f9=$fecemi{8};
                    $f10=$fecemi{9};
                    //$h1=$fecemi{11};
                    //$h2=$fecemi{12};
                    //$h3=$fecemi{14};
                    //$h4=$fecemi{15};
                    //$h6=$fecemi{17};
                    //$h7=$fecemi{18};
                    //var_dump($fechaemision);
                    $fechaemi = $f9 . $f10 . "/" . $f6 . $f7 . "/" . $f1 . $f2 . $f3 . $f4/* . " " . $h1 . $h2 . ":" . $h3 . $h4 . ":" . $h6 . $h7*/;
                ?>
                <td ><?php echo $fechaemi; ?></td>
                <td ><?php echo $key['tip_sunat']; ?></td>
                <td ><?php echo $key['serie']; ?></td>
                <td ><?php echo $key['numero']; ?></td>
                <td ><?php echo $key['ruc_dni']; ?></td>
                <td ><?php echo $key['nomb_suje']; ?></td>
                <td ><?php echo $key['moneda']; ?></td>
                <td ><?php echo $key['importe']; ?></td>                
                <td ><?php echo $key['base_gratuita']; ?></td>

                <td class="text-center"><span class="fa fa-times"></span></td>
                <td class="text-center"><span class="fa fa-check"></span></td>
                <td class="text-center"><span class="fa fa-check"></span></td>
                <td class="text-center"><button type="button" class="btn btn-default" onclick="imprimirdocumento('<?php echo $key['ruta_pdf'].'#zoom=55'; ?>')"><span class="fa fa-print"></span></button></td>
                <td class="text-center"><button type="button" class="btn btn-default" onclick="descargar_pdf('<?php echo $key['ruta_pdf']; ?>')" ><span class="fa fa-file-pdf-o"></span></button></td>
                <td class="text-center"><button type="button" class="btn btn-default" onclick="descargar_xml('<?php echo $key['ruta_xml']?>')" ><span class="fa fa-file-code-o"></span></button></td>
                <td class="text-center"><button type="button" class="btn btn-default" ><span class="fa fa-cloud-download"></span></button></td>
                <td class="text-center"><button type="button" class="btn btn-default" ><span class="fa fa-paper-plane"></span></button></td>
              </tr>
            <?php 
            if($key['tip_sunat']  == '01'){
                $importeBoleta = $importeBoleta + $key['importe'];
            }else if($key['tip_sunat']  == '03'){

                $importeFactura= $importeFactura + $key['importe'];
            }else if($key['tip_sunat']  == '08'){

                $importeNC= $importeNC + $key['importe'];
            }else if($key['tip_sunat']  == '07'){

                $importeND= $importeND + $key['importe'];
            }



            }  ?>

            </tbody>
            <tfoot>
              <tr>
                <td colspan="7" class="text-right">TOTAL DE FACTURAS ELECTRÓNICAS EN SOLES</td>
                <td><?php echo $importeBoleta; ?></td>
                <td colspan="9"></td>
              </tr>
              <tr>
                <td colspan="7" class="text-right">TOTAL DE BOLETAS DE VENTA ELECTRÓNICAS EN SOLES</td>
                <td><?php echo $importeFactura; ?></td>
                <td colspan="9"></td>
              </tr>
              <tr>
                <td colspan="7" class="text-right">TOTAL DE NOTAS DE CRÉDITO ELECTRÓNICAS EN SOLES</td>
                <td><?php echo $importeNC; ?></td>
                <td colspan="9"></td>
              </tr>
              <tr>
                <td colspan="7" class="text-right">TOTAL DE NOTAS DE DÉBITO DE VENTA ELECTRÓNICAS EN SOLES</td>
                <td><?php echo $importeND; ?></td>
                <td colspan="9"></td>
              </tr>
            </tfoot>
          </table>
        </div>
        </div>
 

          