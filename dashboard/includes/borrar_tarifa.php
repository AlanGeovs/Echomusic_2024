<?php
// Asegúrate de ajustar la ruta según tu estructura de archivos
require_once "../model/model.php";
session_start();

$response = ['success' => false, 'message' => ''];

// Decodificar JSON del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $idTarifa = $data['id'];

    if (Consultas::borrarTarifa($idTarifa)) {
        $response['success'] = true;
        $response['message'] = 'Tarifa borrada con éxito.';
    } else {
        $response['message'] = 'Error al borrar la tarifa.';
    }
} else {
    $response['message'] = 'ID de la tarifa no proporcionado.';
}

echo json_encode($response);
