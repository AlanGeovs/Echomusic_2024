<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProject = $_POST['id_project'] ?? null;

    if ($idProject && Consultas::publicarProyecto($idProject)) {
        $response = ['success' => true, 'message' => 'Proyecto publicado exitosamente.'];
    } else {
        $response = ['success' => false, 'message' => 'Error al publicar el proyecto.'];
    }
} else {
    $response = ['success' => false, 'message' => 'Método de solicitud no válido.'];
}

header('Content-Type: application/json');
echo json_encode($response);
