<?php
session_start();
require_once "../model/model.php";

$id_usuario = $_SESSION["id_user"]; // Asegúrate de que esta es la forma correcta de obtener el ID del usuario

$eventos = Consultas::obtenerEventosPorUsuario($id_usuario);

echo json_encode($eventos);
