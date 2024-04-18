<?php
session_start();
require_once "../model/model.php"; // Ajusta la ruta si es necesario

if (!isset($_SESSION["id_user"])) {
    echo json_encode(['error' => 'Usuario no identificado']);
    exit;
}

$id_usuario = $_SESSION["id_user"];
$numPorPagina = 5; // Ajustar según se necesite
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $numPorPagina;

$proyectos = Consultas::obtenerProyectosPorUsuario($id_usuario, $offset, $numPorPagina);
$totalEventos = Consultas::totalEventos($id_usuario);
$totalPaginas = ceil($totalEventos / $numPorPagina);
$recaudado = Consultas::recaudadoCrowdfunding($proyectos[0]['id_project']);
//print_r($proyectos);

// incluya current_funding en la respuesta JSON de cada proyecto
foreach ($proyectos as $key => $proyecto) {
    $idProject = $proyecto['id_project'];
    $proyectos[$key]['current_funding'] = Consultas::recaudadoCrowdfunding($idProject);


    // Calcula los días restantes
    $fechaHoy = new DateTime(); // Fecha actual
    $fechaEjecucion = new DateTime($proyecto['project_date_execution']); // Fecha de ejecución del proyecto
    $diferencia = $fechaHoy->diff($fechaEjecucion); // Diferencia entre las fechas
    $diasRestantes = $diferencia->days;

    if ($fechaEjecucion < $fechaHoy) {
        // Si la fecha de ejecución ya pasó, asigna 0 días restantes
        $diasRestantes = 0;
    }

    // Agrega los días restantes al array del proyecto
    $proyectos[$key]['days_remaining'] = $diasRestantes;
}

echo json_encode([
    'proyectos' => $proyectos,
    'paginaActual' => $paginaActual,
    'totalPaginas' => $totalPaginas,
    'totalEventos' => $totalEventos // Opcional, si deseas mostrar el total de eventos en la UI
]);
