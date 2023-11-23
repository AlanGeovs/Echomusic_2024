<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

require_once "../model/model.php";

try {
    $id_region = $_POST['id_region'];
    if (empty($id_region)) {
        throw new Exception("ID de la región no proporcionado.");
    }

    $ciudades = Consultas::obtenerCiudadesPorRegion($id_region);

    if (empty($ciudades)) {
        throw new Exception("No se encontraron ciudades para la región proporcionada.");
    }

    echo json_encode($ciudades);
} catch (Exception $e) {
    // Esto enviará un mensaje de error detallado al cliente,
    // lo cual puede ayudar con el debugging.
    echo json_encode(['error' => $e->getMessage()]);
}
