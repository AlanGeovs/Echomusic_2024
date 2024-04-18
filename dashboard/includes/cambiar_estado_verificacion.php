<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $idUsuario = $data['id_user'] ?? null;
    $verified = $data['verified'] ?? null;

    if (is_null($idUsuario) || is_null($verified)) {
        $response['message'] = 'Datos incompletos.';
    } else {
        $resultado = Consultas::cambiarEstadoVerificacionUsuario($idUsuario, $verified);
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
