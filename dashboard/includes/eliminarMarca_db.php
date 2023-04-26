<?php

session_start();

require_once "../model/model.php";

$id=$_POST["idd"];
$tabla="marcas";

$respuesta=Consultas::eliminarMarca($id,$tabla);

if ($respuesta=="ok") {
	$res=Consultas::registrarBitacora($_SESSION["usuario"],"bitacora","Eliminó una Marca");
	if ($res=="ok") {
		echo "succes";
	}elseif ($res=="error") {
		echo $res;
	}
}