<?php

include "../model/model.php";
include "../model/Usuarios.php";

$correo = $_POST["correo"];
// $usuario = $_POST["usuario"];
$password = md5($_POST["password"]);
echo $correo;

echo "<br>Prueba: ";

// $prueba = Usuarios::consultaPrueba();
// print_r($prueba); 

// $respuesta=Consultas::validarLogin($correo,$password);
// $respuesta = Consultas::validarLoginUsuario($usuario, $password);
$respuesta = Usuarios::validaLogin($correo, $password);
// var_dump($respuesta);

if ($respuesta == "") {
	header("Location: ../index.php?error=100");
} else {
	session_start();
	$_SESSION["idUser"] = $respuesta["id"];
	$_SESSION["usuario"] = $respuesta["usuario"];
	$_SESSION["tipoUsuario"] = $respuesta["tipo"];

	$res = Usuarios::registrarBitacora($respuesta["usuario"], "bitacora", "Inició Sesión");
	// $res = Consultas::registrarBitacora($respuesta["usuario"], "bitacora", "Inició Sesión");
	if ($res == "ok") {
		header("Location: ../site.php");
	} elseif ($res == "error") {
		header("Location: ../index.php?error=1");
	}
}
