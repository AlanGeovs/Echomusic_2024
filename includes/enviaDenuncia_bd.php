<?php
session_start();
require_once "../model/models.php"; // Ajusta la ruta según tu estructura de archivos

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Error al enviar el reporte'];

// Validaciones básicas
if (empty($_POST['report_desc']) || empty($_POST['report_category'])) {
    $response['message'] = 'Por favor, completa todos los campos requeridos.';
    echo json_encode($response);
    exit;
}

$id_project = $_POST['id_project'] ?? '';
$id_user = $_POST['id_user'] ?? '';
$question_desc = trim($_POST['report_desc']);
$report_category = $_POST['report_category'] ?? '';

// Llamar a la clase para insertar el reporte
if (Consultas::insertarDenuncia($id_project, $id_user, $question_desc, $report_category)) {
    $response = ['success' => true, 'message' => 'Reporte enviado con éxito'];
} else {
    $response['message'] = 'No se pudo enviar el reporte. Intenta nuevamente más tarde.';
}

echo json_encode($response);
