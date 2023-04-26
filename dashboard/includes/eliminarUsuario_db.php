<?php

session_start();

require_once "../model/model.php";

$id=$_POST["idd"];
$tabla="usuarios";

$respuesta=Consultas::eliminarUsuario($id,$tabla);

if ($respuesta=="ok") {
	$res=Consultas::registrarBitacora($_SESSION["usuario"],"bitacora","Eliminó un Usuario");
	if ($res=="ok") {
		echo "succes";
	}elseif($res=="error"){
		echo $res;
	}
	
}elseif ($respuesta=="error") {
	echo $respuesta;
}