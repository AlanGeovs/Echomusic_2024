<?php

session_start();

require_once "../model/model.php";

$id = $_POST["id"];
$title_multi1 = $_POST["title_multi1"];
$title_multi2 = $_POST["title_multi2"];
$title_multi3 = $_POST["title_multi3"];
$title_multi4 = $_POST["title_multi4"];
$title_multi5 = $_POST["title_multi5"];
$embed_multi1 = Consultas::extraerIdVideoYouTube($_POST["embed_multi1"]);
$embed_multi2 = Consultas::extraerIdVideoYouTube($_POST["embed_multi2"]);
$embed_multi3 = Consultas::extraerIdVideoYouTube($_POST["embed_multi3"]);
$embed_multi4 = Consultas::extraerIdVideoYouTube($_POST["embed_multi4"]);
$embed_multi5 = Consultas::extraerIdVideoYouTube($_POST["embed_multi5"]);

$service_multi = 'youtube';
$accion = $_POST["accion"];

// echo $id;
// echo "<br>------------" . $nick_user;

echo "<br>ID: " . $id;
echo "<br>v1: " . $title_multi1;
echo "<br>Emb: " . $embed_multi1;
echo "<br>Acc: " . $accion;

// $datosModel = array($id, $title_multi1, $service_multi, $embed_multi1);
// $tabla = "multimedia"; 
// $respuesta = Consultas::agregarOEditarPerfilVideo($datosModel, $tabla, $accion);

// Array para almacenar los datos
$titles = array(
    $_POST["title_multi1"],
    $_POST["title_multi2"],
    $_POST["title_multi3"],
    $_POST["title_multi4"],
    $_POST["title_multi5"]
);

$embeds = array(
    $_POST["embed_multi1"],
    $_POST["embed_multi2"],
    $_POST["embed_multi3"],
    $_POST["embed_multi4"],
    $_POST["embed_multi5"]
);

// $service_multi = 'youtube';
// $accion = $_POST["accion"];
$tabla = "multimedia";

// Contador para los embed_multi con datos
$contador = 0;

// Iterar sobre los arrays y ejecutar la función si embed_multi tiene datos
for ($i = 0; $i < count($embeds); $i++) {
    if (!empty($embeds[$i])) {
        $contador++;
        $embed_multi = Consultas::extraerIdVideoYouTube($embeds[$i]);
        $datosModel = array($id, $titles[$i], $service_multi, $embed_multi);
        $respuesta = Consultas::agregarOEditarPerfilVideo($datosModel, $tabla, $accion);
    }
}


echo "<br><br>Respuesta: " . $respuesta;

if ($respuesta == "ok") {
    header("Location: https://echomusic.net/dashboard/perfil-editar.php?alerta=video");
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
