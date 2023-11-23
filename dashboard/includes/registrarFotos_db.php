<?php

session_start();

require_once "../model/model.php";

$denominacion = $_POST["denom"];
$titular = $_POST["titular"];
$pais = $_POST["paisOrigen"];
$numRegistro = $_POST["numRegistro"];
$numSol = $_POST["numSol"];
$vigencia = $_POST["vigencia"];
$vigencia = preg_replace('/([0-9]{2})\-([0-9]{2})\-([0-9]{4})/', "\\3-\\2-\\1", $vigencia);
$contacto = $_POST["contacto"];
$correo = $_POST["correo"];
$tel = $_POST["tel"];
$fax = $_POST["fax"];
$link = $_POST["link"];
$fuente = $_POST["fuente"];
$ultimaCertificacion = $_POST["ult_certi_notarial"];
$ultimaCertificacion = preg_replace('/([0-9]{2})\-([0-9]{2})\-([0-9]{4})/', "\\3-\\2-\\1", $ultimaCertificacion);
$servicio = $_POST["prodServ"];
$observaciones = $_POST["observaciones"];
$categoria = $_POST["clases"];
$img = $_POST["datosImagen"];
$img = substr($img, 0, -1);
$idUsuario = $_SESSION["idUser"];

if (preg_match("/\s/", $img)) {
	$img = preg_replace("/\s/", "", $img);
}

/*=============================================
=            codigo para cuando se usa checkboxesk            =
=============================================*/

/*if(!empty($_POST['clases'])) {
	$clases=$_POST['clases'];
	$c="";
    for ($i=0; $i < count($clases); $i++) { 
    	$c.=$clases[$i].", ";
    }
    $c=substr($c, 0, -2);
    //echo $c;
}

$datosModel=array($denominacion,$titular,$c,$pais,$numRegistro,$numSol,$vigencia,$contacto,$correo,$tel,$fax,$link,$fuente,$servicio,$observaciones);*/

/*=====  codigo para cuando se usa checkboxes  ======*/


$datosModel = array($denominacion, $titular, $categoria, $pais, $numRegistro, $numSol, $vigencia, $contacto, $correo, $tel, $fax, $link, $fuente, $servicio, $observaciones, $img, $ultimaCertificacion, $idUsuario);
$tabla = "marcas";

//var_dump($datosModel);
//Consultas::registrarMarcas($denominacion,$titular,$c,$pais,$numRegistro,$numSol,$vigencia,$contacto,$correo,$tel,$fax,$link,$fuente,$servicio,$observaciones);

//header("Location: ../site.php");

$respuesta = Consultas::registrarMarcas($datosModel, $tabla);
if ($respuesta == "error") {
	header("Location: http://trademarkbank.mx/admin/registrar_marca.php?e=error");
} elseif ($respuesta == "ok") {
	$res = Consultas::registrarBitacora($_SESSION["usuario"], "bitacora", "Registró una Marca");
	if ($res == "ok") {
		header("Location: http://trademarkbank.mx/admin/listar_marcas.php");
	} elseif ($res == "error") {
		header("Location: http://trademarkbank.mx/admin/registrar_marca.php?e=error");
	}
}

//move_uploaded_file($_FILES['foto']['tmp_name'],"../images/obras/".$nom.".jpg");