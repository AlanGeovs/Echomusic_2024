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

// Obtén los eventos con filtro
$eventos = Consultas::obtenerEventos($offset, $numPorPagina, $filtro);
// Obtén el total de eventos con el mismo filtro para mantener la coherencia en la paginación
$totalEventos = Consultas::totalEventosAdmin($filtro);


$totalPaginas = ceil($totalEventos / $numPorPagina);


foreach ($eventos as $key => $evento) {
    // Obtener el nombre de la ciudad y región
    $id_ciudad = $evento['id_city'];
    $eventos[$key]['nombre_ciudadyregion'] = Consultas::obtenerNombresCiudadYRegion($id_ciudad);

    $idUser = $evento['id_user'];
    $datosArtista = Consultas::obtenerNombresUsuario($idUser);
    // Agrega los datos del artista a un nuevo índice, por ejemplo, 'datos_artista'
    $eventos[$key]['datos_artista'] = $datosArtista;
}



echo json_encode([
    'eventos' => $eventos,
    'paginaActual' => $paginaActual,
    'totalPaginas' => $totalPaginas,
    //'totalEventos' => $totalUsers, // Opcional, si deseas mostrar el total de eventos en la UI
    'totalEvents' => $totalEventos
]);
