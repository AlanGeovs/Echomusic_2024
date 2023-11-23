<?php
session_start();

require_once "../model/model.php";



$videoId = $_POST['videoId'];
$videoTitle = $_POST['videoTitle'];
$videoUrl = $_POST['videoUrl'];

// Extraer el ID del video de YouTube
$youtubeId = Consultas::extraerIdVideoYouTube($videoUrl);

// Actualizar la base de datos
$resultado = Consultas::editarVideo($videoId, $videoTitle, $youtubeId);

echo $resultado;  // Devuelve un mensaje o información de éxito/error al cliente
