<?php
session_start();

require_once "../model/model.php";

 

$videoId = $_POST['videoId'];

// Borrar el video de la base de datos
$resultado = Consultas::borrarVideo($videoId);

echo $resultado;  // Devuelve un mensaje o información de éxito/error al cliente
