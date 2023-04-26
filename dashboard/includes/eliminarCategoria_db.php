<?php

session_start();

require_once "../model/model.php";

$id=$_POST["idd"];
$tabla="categorias";

$respuesta=Consultas::eliminarCategoria($id,$tabla);

if ($respuesta=="ok") {
	$res=Consultas::registrarBitacora($_SESSION["usuario"],"bitacora","Eliminó una Categoría");
	if ($res=="ok") {
		echo "succes";
	}elseif ($res=="error") {
		echo $res;
	}
}