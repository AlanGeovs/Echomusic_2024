<?php
session_start();
require_once "../model/model.php"; // Asegúrate de ajustar la ruta según tu estructura de archivos

$response = ['success' => false, 'message' => ''];

if (!isset($_GET['id_plan_key'])) {
    $response['message'] = 'ID de la tarifa no proporcionado.';
    echo json_encode($response);
    exit;
}

$idPlanKey = $_GET['id_plan_key'];

// Utiliza la función para obtener los datos de la tarifa por su ID
// $datosTarifa = Consultas::obtenerTarifasPorIDPlanKey($idPlanKey);

// if ($datosTarifa) {
//     $response['success'] = true;
//     $response['data'] = $datosTarifa;
// } else {
//     $response['message'] = 'No se encontraron datos para la tarifa solicitada.';
// }
$datosTarifa = Consultas::obtenerTarifasPorIDPlanKey($idPlanKey);
if (!empty($datosTarifa)) {
    $response['success'] = true;
    $response['data'] = $datosTarifa[0]; // Asume que solo hay un resultado y toma el primero
} else {
    $response['message'] = 'No se encontraron datos para la tarifa solicitada.';
}


header('Content-Type: application/json');
echo json_encode($response);
