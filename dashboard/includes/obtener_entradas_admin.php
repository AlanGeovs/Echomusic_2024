<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once "../model/model.php"; // Ajusta la ruta si es necesario

// if (!isset($_SESSION["id_user"])) {
//     echo json_encode(['error' => 'Usuario no identificado']);
//     exit;
// }
$idEvento = $_GET['evento'];
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';


$id_usuario = $_SESSION["id_user"];
$numPorPagina = 10; // Ajustar según se necesite
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $numPorPagina;

// Obtén los entradas con filtro
$entradas = Consultas::obtenerTicketsPorEventos($idEvento, $offset, $numPorPagina, $filtro);
// Obtén el total de entradas con el mismo filtro para mantener la coherencia en la paginación
$totalEntradas = Consultas::totalTicketsporEventosAdmin($filtro, $idEvento);


$totalPaginas = ceil($totalEntradas / $numPorPagina);


// foreach ($eventos as $key => $evento) {
//     // Obtener el nombre de la ciudad y región
//     $id_ciudad = $evento['id_city'];
//     $eventos[$key]['nombre_ciudadyregion'] = Consultas::obtenerNombresCiudadYRegion($id_ciudad);

//     $idUser = $evento['id_user'];
//     $datosArtista = Consultas::obtenerNombresUsuario($idUser);
//     // Agrega los datos del artista a un nuevo índice, por ejemplo, 'datos_artista'
//     $eventos[$key]['datos_artista'] = $datosArtista;
// }



echo json_encode([
    'entradas' => $entradas,
    'paginaActual' => $paginaActual,
    'totalPaginas' => $totalPaginas,
    'totalEvents' => $totalEntradas
]);
