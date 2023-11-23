<?php

session_start();

require_once "../model/model.php";

$playlist_id = $_POST['playlist_id'];
$id_user = $_POST['id_user'];
$service_multi = $_POST['service_multi'];
$embed_multi = $_POST['embed_multi'];

$resultado = Consultas::editarPlaylist($playlist_id, $id_user, $service_multi, $embed_multi);

echo $resultado ? 'Éxito ' . $playlist_id : 'Error';  // Devuelve un mensaje o información de éxito/error al cliente
