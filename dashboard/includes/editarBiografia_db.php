<?php

session_start();

require_once "../model/model.php";

$id = $_POST["id"];
$accion = $_POST["accion"];
$bio = $_POST["bio"];

// echo $id;
// echo "<br>------------" . $nick_user;

$datosModel = array($id, $bio);
$tabla = "bio_user";

// print_r($datosModel);


$respuesta = Consultas::agregarOEditarPerfilBio($datosModel, $tabla, $accion);

echo "<br><br>Respuesta: " . $respuesta;

if ($respuesta == "ok") {
    header("Location: https://echomusic.net/dashboard/perfil-editar.php");
    exit;
} else {
    header("Location: https://echomusic.net/dashboard/perfil-editar.php?e=error");
}
