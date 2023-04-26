<?php

session_start();

require_once "../model/model.php";

$id=$_POST["idd"];
$tabla="inventario";

$respuesta=Consultas::eliminarInventario($id,$tabla);

if ($respuesta=="ok") {
	$res=Consultas::registrarBitacora($_SESSION["usuario"],"bitacora","Eliminó un Auto");
	if ($res=="ok") {
		echo "succes";
	}elseif ($res=="error") {
		echo $res;
	}
}