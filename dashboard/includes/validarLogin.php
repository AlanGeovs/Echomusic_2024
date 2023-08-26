<?php

include "../model/model.php";

$correo=$_POST["correo"];
$password=md5($_POST["password"]);
 
$respuesta=Consulta::validarLogin($correo,$password);
//var_dump($respuesta);

if ($respuesta=="") {
	header("Location: ../index.php?error=1");
}else{
	session_start();
	$_SESSION["idUser"]=$respuesta["id"];
	$_SESSION["usuario"]=$respuesta["usuario"];
	$_SESSION["tipoUsuario"]=$respuesta["tipo"];
//	$res=Consultas::registrarBitacora($respuesta["usuario"],"bitacora","Inició Sesión"); 
	if ($res=="ok") {
		header("Location: ../site.php");
	}elseif ($res=="error") {
		header("Location: ../index.php?error=1"); 
	}
}
