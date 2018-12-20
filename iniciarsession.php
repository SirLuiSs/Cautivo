<?php 
	session_start();
	include_once("clases/conexion.php");
	$con = new conexion();
	$usuario_name = $_POST['usuario_name'];
	$password_name = $_POST['password_name'];
	

	$query = "select * from usuarios where usuario = '$usuario_name' and password = '$password_name';";
	$data_user = $con->exe_data($query);
	if(count($data_user['DATA']) > 0){
		$_SESSION['datos_usuario'] = $data_user['DATA'][0];
		$_SESSION['autorizado']=1;
		$_SESSION['nivel']=$data_user['DATA'][0]['nivel'];

  		header("location: principal.php");
	}else{
		header('location: index.php');
	}
 ?>