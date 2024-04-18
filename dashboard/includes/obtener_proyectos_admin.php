<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once "../model/model.php"; // Ajusta la ruta si es necesario

if (!isset($_SESSION["id_user"])) {
    echo json_encode(['error' => 'Usuario no identificado']);
    exit;
}

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';


$id_usuario = $_SESSION["id_user"];
$numPorPagina = 10; // Ajustar según se necesite
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $numPorPagina;

// Obtén los proyectos con filtro
$proyectos = Consultas::obtenerProyectos($offset, $numPorPagina, $filtro);
// Obtén el total de proyectos con el mismo filtro para mantener la coherencia en la paginación
$totalProyectos = Consultas::totalProyectosAdmin($filtro);


$totalPaginas = ceil($totalProyectos / $numPorPagina);


foreach ($proyectos as $key => $proyecto) {
    // Obtener el nombre de la ciudad y región
    $project_region = $proyecto['project_region'];
    $proyectos[$key]['name_region'] = Consultas::obtenerNombresRegion($project_region);

    $idUser = $proyecto['id_user'];
    $datosArtista = Consultas::obtenerNombresUsuario($idUser);
    // Agrega los datos del artista a un nuevo índice, por ejemplo, 'datos_artista'
    $proyectos[$key]['datos_artista'] = $datosArtista;

    // Total recaudado por Proyecto
    $idProject = $proyecto['id_project'];
    $proyectos[$key]['current_funding'] = Consultas::recaudadoCrowdfunding($idProject);

    // Enlisto las recompensas creadas por el artista
    //Ya no son necesarios por que las jalo directo cuando mando a llamar el modal de Recompensas, esto para evitar saturar las peticiones
    // $datosRecompensas = Consultas::obtenerRecompensasProyecto($idProject);
    // $proyectos[$key]['recompensas'] = $datosRecompensas;

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
    //'totalProyectos' => $totalUsers, // Opcional, si deseas mostrar el total de proyectos en la UI
    'totalProjects' => $totalProyectos
]);
