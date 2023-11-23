<?php
session_start();
require_once "../model/model.php";

$id_user = $_SESSION["id_user"];

// Aquí necesitas definir la lógica para obtener los integrantes de la base de datos
$integrantes = Consultas::obtenerIntegrantesPorUsuario($id_user);

echo json_encode($integrantes);
