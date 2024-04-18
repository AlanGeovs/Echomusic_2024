<?php
session_start();
require_once "../model/model.php"; // Asegúrate de ajustar la ruta según tu estructura de carpetas

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProject = $_POST['edit_id_project'] ?? null;
    $projectAmountFormatted = $_POST['edit_project_amount'] ?? null;
    $projectAmount = str_replace('.', '', $projectAmountFormatted);
    $projectAmount = intval($projectAmount);

    $recTime = $_POST['edit_rec_time'] ?? null;
    $execTime = $_POST['edit_exec_time'] ?? null;

    // Llamadas a las funciones para actualizar los datos en la base de datos
    $plazosCorrectos = Consultas::editarPlazos($idProject, $recTime, $execTime);
    $montosCorrectos = Consultas::editarMontos($idProject, $projectAmount);

    if ($plazosCorrectos && $montosCorrectos) {
        echo json_encode(['success' => true]);
    } else {
        $errorMensaje = 'No se pudo actualizar la base de datos.';
        echo json_encode(['success' => false, 'error' => $errorMensaje]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
