<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $idProyecto = $data['id_project'] ?? null;
    $activeEvent = $data['status_project'] ?? null;

    if (is_null($idProyecto) || is_null($activeEvent)) {
        $response['message'] = 'Datos incompletos.';
    } else {
        $resultado = Consultas::cambiarEstadoProyecto($idProyecto, $activeEvent);
        if ($resultado) {
            $response['success'] = true;
            $response['message'] = 'Estado actualizado con éxito.';
        } else {
            $response['message'] = 'Error al actualizar el estado.';
        }
    }
} else {
    $response['message'] = 'Método de solicitud no válido.';
}

header('Content-Type: application/json');
echo json_encode($response);
