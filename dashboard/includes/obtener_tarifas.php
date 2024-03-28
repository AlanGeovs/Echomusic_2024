<?php
session_start();
require_once "../model/model.php"; // Ajusta esta ruta según tu estructura de archivos

$response = ['success' => false, 'data' => [], 'message' => ''];

// Asegúrate de tener una forma de obtener el ID del usuario actual
// Esto podría ser a través de $_SESSION si el usuario está logueado y guardas su ID allí
if (isset($_SESSION['id_user'])) {
    $idUsuario = $_SESSION['id_user'];

    try {
        $tarifas = Consultas::obtenerTarifasPorUsuario($idUsuario);
        if (!empty($tarifas)) {
            $response['success'] = true;
            $response['data'] = $tarifas;
            $response['message'] = 'Tarifas obtenidas con éxito.';
        } else {
            $response['message'] = 'No se encontraron tarifas para el usuario.';
        }
    } catch (Exception $e) {
        $response['message'] = 'Ocurrió un error al obtener las tarifas: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Usuario no identificado.';
}

header('Content-Type: application/json');
echo json_encode($response);
