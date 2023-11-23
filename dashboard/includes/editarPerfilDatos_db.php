<?php

session_start();

require_once "../model/model.php";

$id = $_POST["id"];
$nick_user = $_POST["nick_user"];
$mail_user = $_POST["mail_user"];
$first_name_user = $_POST["first_name_user"];
$last_name_user = $_POST["last_name_user"];
$descripcion = $_POST["descripcion"];
$id_region = $_POST["id_region"];
$id_city = $_POST["id_city"];
$id_genero = $_POST["id_genero"];
$id_subgenero = $_POST["id_subgenero"];
$id_musician = $_POST["id_musician"];

echo $id;
// echo "<br>------------" . $nick_user;

$datosModel = array($id, $nick_user, $mail_user, $first_name_user, $last_name_user, $descripcion, $id_region, $id_city, $id_genero, $id_subgenero, $id_musician);
$tabla = "users";

// print_r($datosModel);


$respuesta = Consultas::modificarPerfilDatos($datosModel, $tabla);

echo "<br><br>Respuesta: " . $respuesta;

if ($respuesta == "ok") {
    header("Location: https://echomusic.net/dashboard/perfil-editar.php");
    exit;
} else {
    header("Location: https://echomusic.net/dashboard/perfil-editar.php?e=error");
}

// if ($respuesta == "error") {
//     header("Location: https://echomusic.net/dashboard/perfil-editar.php?e=error");
// } elseif ($respuesta == "ok") {
//     // $res = Consultas::registrarBitacora($_SESSION["usuario"], "bitacora", "Modificó una Marca");
//     if ($res == "ok") {
//         header("Location: https://echomusic.net/dashboard/perfil-editar.php");
//     } elseif ($res == "error") {
//         header("Location: https://echomusic.net/dashboard/perfil-editar.php?e=error");
//     }
// }
