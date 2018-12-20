 

 <?php

	if (isset($_GET['descargar-pdf'])) { 
  $file = $_GET['ruta_pdf'];
	$conwww = array();
	$conwww=explode("/",$file);
	$filename = $conwww[2];
  if (is_file($file)) { // el nombre con el que se descargará, puede ser diferente al original
    /*header("Content-Type: application/octet-stream");*/
    header('Content-type: application/force-download');
	header('Content-Disposition: inline; filename="' . $filename . '"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($file));
	header('Accept-Ranges: bytes');
	@readfile($file);
  } else {
    header("Location: index.php");
  }
}else if (isset($_GET['descargar-xml'])) { 
  $file = $_GET['ruta_xml'];
	$conwww = array();
	$conwww=explode("/",$file);
	$filename = $conwww[2];
  if (is_file($file)) {
    // el nombre con el que se descargará, puede ser diferente al original
    /*header("Content-Type: application/octet-stream");*/
   	header('Content-type: application/force-download');
	header('Content-Disposition: inline; filename="' . $filename . '"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($file));
	header('Accept-Ranges: bytes');
	@readfile($file);
  } else {
    header("Location: index.php");
  }
}else if (isset($_GET['location'])) {
	header("Location: index.php");
}








?>