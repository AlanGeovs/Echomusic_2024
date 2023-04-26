<?php

require_once "../model/model.php";

$usuario=$_POST["nombre"];
$password=$_POST["pass"];
$nuevoPass=$_POST["passNuevo"];
$confirmNuevoPass=$_POST["passNuevoConfirm"];
$id=$_POST["idUsuario"];

if ($nuevoPass=="" && $confirmNuevoPass=="") {
	$datosModel=array($id,$usuario);
	$respuesta=Consultas::actualizarUsuario($datosModel,"usuarios");
	if ($respuesta=="ok") {
		header("Location: ../perfil.php?u=".$id);
	}else{
		header("Location: ../perfil.php?error=1");
	}
}else{
	$datosModel=array($id,$usuario,$nuevoPass,md5($confirmNuevoPass));
	$respuesta=Consultas::actualizarUsuario($datosModel,"usuarios");
	if ($respuesta=="ok") {
		header("Location: ../perfil.php?u=".$id);
	}else{
		header("Location: ../perfil.php?error=1");
	}
}

if (isset($_FILES['nuevaFoto']['tmp_name'])) {
	$foto=$_FILES['nuevaFoto']['tmp_name'];
	$ruta = "../images/usuarios/".$usuario.".jpg";
	$origen = imagecreatefromjpeg($foto);
	imagejpeg($origen, $ruta);
	
}