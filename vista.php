<?php 
session_start();
if (isset($_SESSION['ruta_pdf'])) {
	$file = $_SESSION['ruta_pdf'];
	$conwww = array();
	$conwww=split("/",$file);
	$filename = $conwww[2];
	header('Content-type: application/pdf');
	header('Content-Disposition: inline; filename="' . $filename . '"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($file));
	header('Accept-Ranges: bytes');
	@readfile($file);
	session_destroy();
	$parametros_cookies = session_get_cookie_params();
	setcookie(session_name(),0,1,$parametros_cookies["path"]);
}

 ?>