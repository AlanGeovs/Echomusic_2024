<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
require_once "../model/model.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProject = $_POST['id_project'] ?? null;
    $projectAmountFormatted = $_POST['project_amount'] ?? null;
    $projectAmount = str_replace('.', '', $projectAmountFormatted);
    $projectAmount = intval($projectAmount);

    $duration = $_POST['duration'] ?? null;
    $projectExecutionMonths = $_POST['project_date_execution'] ?? null;


    // Llama a las funciones para actualizar los montos y fechas en la base de datos
    $plazosCorrectos = Consultas::crearPlazos($idProject, $duration, $projectExecutionMonths);
    $montosCorrectos = Consultas::crearMontos($idProject, $projectAmount);

    // Verificar que ambas operaciones fueron exitosas
    if ($plazosCorrectos && $montosCorrectos) {
        echo json_encode(['success' => true]);
    } else {
        // Identificar cuál de las operaciones falló para proporcionar un mensaje de error más específico
        $errorMensaje = 'Error al actualizar la base de datos.';
        if (!$plazosCorrectos) {
            $errorMensaje = 'Error al actualizar los plazos.';
        } elseif (!$montosCorrectos) {
            $errorMensaje = 'Error al actualizar los montos.';
        }
        echo json_encode(['success' => false, 'error' => $errorMensaje]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
