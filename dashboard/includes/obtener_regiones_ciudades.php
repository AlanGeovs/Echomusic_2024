<?php
require_once "../model/model.php";

$id_region = $_POST['id_region'];

// Asegúrate de validar y sanear $id_region
$ciudades = Consultas::obtenerCiudadesPorRegionDos($id_region);
echo json_encode($ciudades);
