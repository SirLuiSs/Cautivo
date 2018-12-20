<?php 
	session_start();
	include_once('clases/conexion.php');
	$fechaemision = mysql_real_escape_string($_POST['fechaemision-name']);
	$conwww = array();
	$conwww=split("-",$fechaemision);
	//var_dump($fechaemision);
	$fechaemision = $conwww[2].'-'.$conwww[1].'-'.$conwww[0];
	$tipocomprobante = mysql_real_escape_string($_POST['tipocomprobante-name']);
	$serie = mysql_real_escape_string($_POST['serie-name']);
	$numero = mysql_real_escape_string($_POST['numero-name']);
	$total1 = mysql_real_escape_string( $_POST['total-name']);
	//var_dump($total1);
	$total = str_replace(',','',$total1);
	//var_dump($total);
	$con = new conexion();
	$ruta ="";
	$ruta_pdf ="";
	$ruta_xml ="";
	$query="SELECT ruta_pdf,ruta_xml FROM `fe_comprobantes` where serie = '$serie' and numero = '$numero' and date(fec_emi)='$fechaemision' and fe_estado = 'E' and tip_docu='$tipocomprobante' and fe_monto = '$total'";
	//echo $query;exit;
		$data = $con->exe_data($query);
		if(count($data['DATA'])>0){
			foreach ($data['DATA'] as $registro) {
				$ruta_pdf = $registro['ruta_pdf'];
				$ruta_xml = $registro['ruta_xml'];
				 $_SESSION['ruta_pdf']= $registro['ruta_pdf'];
			}
		}else{
			unset($ruta_pdf);
			unset($ruta_xml);
		}                          
	
	if (isset($ruta_pdf,$ruta_xml)) {

		 ?>
		 <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <form id="comprobante-form" data-parsley-validate class="form-horizontal form-label-left ajax " method="post"  action="descarga.php">
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12 text-right">
								<input type="hidden" name="ruta_pdf" id="ruta_pdf" value="<?php echo $ruta_pdf; ?>">
								<input type="hidden" name="ruta_xml" id="ruta_xml" value="<?php echo $ruta_xml; ?>">
								<button type="submit"  name="location" class="btn btn-primary"><i class="fa fa-home"></i> Volver</button>
								<button type="submit" name="descargar-pdf" class="btn btn-primary">Descargar PDF</button>
								<button type="submit" name="descargar-xml" class="btn btn-primary">Descargar xml</button>
							</div>
						</div>
					</form>
                    <div class="ln_solid" ></div>
                    <div id="ifrmae-id">                     
                     <iframe SRC="vista.php" width="100%" height="1000px"   FRAMEBORDER="no" BORDER="0" SCROLLING="no"> </iframe>
                    </div>
                    

                   
                  </div>
                </div>
              </div>

		 <?php 
	}
 ?>