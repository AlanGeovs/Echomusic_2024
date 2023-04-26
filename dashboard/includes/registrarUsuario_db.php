<?php
session_start();
require_once "../model/model.php";

$nombre=$_POST["userName"];
$correo=$_POST["correo"];
$password=$_POST["password"];
$tipo=$_POST["tipo"];

$datosModel=array($nombre,$correo,$password,$tipo);
$tabla="usuarios";

$validar=Consultas::validarRegistroUsuario($datosModel,$tabla);

if ($validar=="") {
	$respuesta=Consultas::registrarUsuarios($datosModel,$tabla);
	if ($respuesta=="error") {
		header("Location: http://inventario.automayore.com/registrar_usuario.php?e=error");
	}elseif ($respuesta=="ok") {
		move_uploaded_file($_FILES['file']['tmp_name'],"../images/usuarios/".$_POST["userName"].".jpg");
		$res=Consultas::registrarBitacora($_SESSION["usuario"],"bitacora","Registró un Usuario");
		if ($res=="ok") {
			header("Location: http://inventario.automayore.com/site.php");
		}elseif ($res=="error") {
			header("Location: http://inventario.automayore.com/registrar_usuario.php?e=error");
		}
		
	}
}else{
	header("Location: http://inventario.automayore.com/registrar_usuario.php?e=existe");
}

