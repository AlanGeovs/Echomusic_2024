<?php

session_start();

require_once "../model/model.php";

$tipo=$_POST["tipo"];
$titulo=$_POST["titulo"];
$desc=$_POST["desc"];
$total=$_POST["total"];
$total+=1;

$datosModel=array($tipo,$titulo,$desc,"Clase ".$total);
$tabla="categorias";

$respuesta=Consultas::registrarCategoria($datosModel,$tabla);

if ($respuesta=="ok") {
	$r=Consultas::registrarBitacora($_SESSION["usuario"],"bitacora","Registró una Categoría");
	if ($r=="ok") {
		$res=Consultas::nuevaCategoria($tabla);
		$datos="";
		for ($i=0; $i < count($res); $i++) { 
			$datos.= $res[$i]."|";
		}
		echo substr($datos, 0, -1);
	}elseif ($r=="error") {
		echo $r;
	}
	
}elseif ($respuesta=="error") {
	echo $respuesta;
}

