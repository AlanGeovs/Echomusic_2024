<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProject = $_POST['id_project'] ?? null;

    if (!$idProject) {
        $response['message'] = 'ID de proyecto no especificado.';
        echo json_encode($response);
        exit;
    }

    // Obtener los datos de rec_time y exec_time
    $times = Consultas::obtenerTiemposProyecto($idProject);
    if (!$times) {
        $response['message'] = 'Error al obtener los tiempos del proyecto.';
        echo json_encode($response);
        exit;
    }

    // Calcular las fechas
    $fechaActual = new DateTime(); // Fecha de inicio
    $projectDateStart = $fechaActual->format('Y-m-d H:i:s');

    $fechaFin = clone $fechaActual;
    $fechaFin->add(new DateInterval('P' . $times['rec_time'] . 'D')); // Sumar días de rec_time
    $projectDateEnd = $fechaFin->format('Y-m-d 23:59:59');

    $fechaEjecucion = clone $fechaFin;
    $fechaEjecucion->add(new DateInterval('P' . $times['exec_time'] . 'M')); // Sumar meses de exec_time
    $projectDateExecution = $fechaEjecucion->format('Y-m-d');

    // Actualizar el proyecto con las nuevas fechas
    if (Consultas::publicarProyecto($idProject, $projectDateStart, $projectDateEnd, $projectDateExecution)) {
        $response = ['success' => true, 'message' => 'Proyecto publicado exitosamente con las fechas actualizadas.'];
    } else {
        $response['message'] = 'Error al publicar el proyecto con las fechas actualizadas.';
    }
} else {
    $response['message'] = 'Método de solicitud no válido.';
}

header('Content-Type: application/json');
echo json_encode($response);
