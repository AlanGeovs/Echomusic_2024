<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asume que tienes campos similares al formulario de creación
    $project_id = $_POST['edit_id_project'] ?? null;
    $id_user = $_POST['edit_id_user'] ?? null;
    $project_title = $_POST['edit_project_title'] ?? null;
    $project_region = $_POST['edit_project_region'] ?? null;
    $project_desc = $_POST['edit_project_desc'] ?? null;
    $id_category = $_POST['edit_id_category'] ?? null;

    // Valida que se hayan proporcionado todos los datos necesarios
    if ($project_id && $id_user && $project_title && $project_desc && $id_category) {
        // Actualiza el proyecto utilizando las funciones adecuadas en Consultas
        $actualizado = Consultas::actualizarProyecto($project_id, $id_user, $project_title, $project_region, $project_desc, $id_category);
        if ($actualizado) {
            $response['success'] = true;
            $response['message'] = 'Proyecto actualizado con éxito.';
        } else {
            $response['message'] = 'Error al actualizar el proyecto.';
        }
    } else {
        $response['message'] = 'Datos incompletos.';
    }
} else {
    $response['message'] = 'Método de solicitud no válido.';
}

echo json_encode($response);
