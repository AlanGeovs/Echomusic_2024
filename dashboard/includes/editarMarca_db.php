<?php

session_start();

require_once "../model/model.php";

$denominacion=$_POST["denom"];
$titular=$_POST["titular"];
$pais=$_POST["paisOrigen"];
$clase=$_POST["categoria"];
$numRegistro=$_POST["numRegistro"];
$numSol=$_POST["numSol"];
$vigencia=$_POST["vigencia"];
$vigencia=preg_replace('/([0-9]{2})\-([0-9]{2})\-([0-9]{4})/', "\\3-\\2-\\1", $vigencia);
$contacto=$_POST["contacto"];
$correo=$_POST["correo"];
$tel=$_POST["tel"];
$fax=$_POST["fax"];
$link=$_POST["link"];
$fuente=$_POST["fuente"];
$ultimaCertificacion=$_POST["ult_certi_notarial"];
$ultimaCertificacion=preg_replace('/([0-9]{2})\-([0-9]{2})\-([0-9]{4})/', "\\3-\\2-\\1", $ultimaCertificacion);
$servicio=$_POST["prodServ"];
$observaciones=$_POST["observaciones"];
$img=$_POST["datosImagen"];
$img=substr($img, 0, -1);
$id=$_POST["id"];

if (preg_match("/[\s]/", $img)) {
	$img=preg_replace("/[\s]/", "", $img);
}

$datosModel=array($denominacion,$titular,$clase,$pais,$numRegistro,$numSol,$vigencia,$contacto,$correo,$tel,$fax,$link,$fuente,$servicio,$observaciones,$img,$ultimaCertificacion,$id);
$tabla="marcas";

$respuesta=Consultas::modificarMarca($datosModel,$tabla);
if ($respuesta=="error") {
	header("Location: http://inventario.automayore.com/editar_marca.php?e=error");
}elseif ($respuesta=="ok") {
	$res=Consultas::registrarBitacora($_SESSION["usuario"],"bitacora","Modificó una Marca");
	if ($res=="ok") {
		header("Location: http://inventario.automayore.com/listar_marcas.php");
	}elseif ($res=="error") {
		header("Location: http://inventario.automayore.com/editar_marca.php?e=error");
	}
}
