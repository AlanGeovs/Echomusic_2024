<?php
session_start();
require_once "../model/model.php";


// Obtener el ID del usuario
$id_user = $_SESSION["id_user"];

// Obtener las fotos del usuario
$fotos = Consultas::obtenerFotosUsuario($id_user);

// var_dump($fotos);
// Devolver las fotos en formato JSON
echo json_encode($fotos);
