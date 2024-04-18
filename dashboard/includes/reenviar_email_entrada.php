<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $idEntrada = $data['id_entrada'] ?? null;

    // Aqui se crea la función para enviar correo
    if ($idEntrada && Consultas::reenviarCorreoEntrada($idEntrada)) {
        $response['success'] = true;
    } else {
        $response['message'] = 'No se pudo reenviar el correo.';
    }
} else {
    $response['message'] = 'Método de solicitud no válido.';
}

header('Content-Type: application/json');
echo json_encode($response);
