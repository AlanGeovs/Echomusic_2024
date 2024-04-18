<?php
session_start();
require_once "../model/model.php";

$id = $_GET['id'] ?? ''; // Asegúrate de validar y sanear este input

// Suponiendo que tienes una función que obtiene los datos por ID
$datosUsuario = Consultas::obtenerRecompensasProyecto($id);

echo json_encode($datosUsuario);
