<?php
session_start();
require_once "../model/model.php";

// Usa la función para obtener las regiones
$regiones = Consultas::listarRegionesConNombre();

// Preparando el array de regiones para el frontend
$response = [];
foreach ($regiones as $region) {
    $response[] = [
        'id' => $region['id_region'],
        'nombre' => $region['name_region']
    ];
}

// Devuelve las regiones en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
