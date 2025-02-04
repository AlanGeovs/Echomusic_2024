<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $idEvento = $data['id_event'] ?? null;
    $activeEvent = $data['status_event'] ?? null;

    if (is_null($idEvento) || is_null($activeEvent)) {
        $response['message'] = 'Datos incompletos.';
    } else {
        $resultado = Consultas::cambiarEstadoReserva($idEvento, $activeEvent);
        if ($resultado) {
            $response['success'] = true;
            $response['message'] = 'Estado actualizado con éxito.';
            // Aquí se despliego el mensaje via email de confirmación para el usuario
        } else {
            $response['message'] = 'Error al actualizar el estado.';
        }
    }
} else {
    $response['message'] = 'Método de solicitud no válido.';
}

header('Content-Type: application/json');
echo json_encode($response);
