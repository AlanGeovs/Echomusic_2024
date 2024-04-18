<?php
// require_once "../model/model.php";

// $id_region = $_POST['id_region'];

// // Asegúrate de validar y sanear $id_region
// $ciudades = Consultas::obtenerCiudadesPorRegionDos($id_region);
// echo json_encode($ciudades);

session_start();
require_once "../model/model.php";

$id_region = $_POST['id_region'] ?? null;
if ($id_region) {
    $ciudades = Consultas::obtenerCiudadPorRegion($id_region);
    echo json_encode($ciudades);
} else {
    // Enviar respuesta de error si no se recibe el id_region
    echo json_encode(['error' => 'No se recibió el ID de la región.']);
}
