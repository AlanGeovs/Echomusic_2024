<?php

require_once "../model/model.php";

$id=$_POST["id"];
$tipo=$_POST["tipo"];
$titulo=$_POST["titulo"];
$desc=$_POST["desc"];

$datosModel=array($tipo,$titulo,$desc,$id);
$tabla="categorias";

$respuesta=Consultas::modificarCategoria($datosModel,$tabla);

$res=Consultas::registrarBitacora($_SESSION["usuario"],"bitacora","Modificó una Categoría");

if ($res=="ok") {
	echo $respuesta;
}elseif ($res=="error") {
	echo $respuesta;
}


