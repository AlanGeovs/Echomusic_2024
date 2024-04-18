<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once "../model/model.php"; // Ajusta la ruta si es necesario

// if (!isset($_SESSION["id_user"])) {
//     echo json_encode(['error' => 'Usuario no identificado']);
//     exit;
// }
$idProyecto = $_GET['proyecto'];
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';


$id_usuario = $_SESSION["id_user"];
$numPorPagina = 10; // Ajustar según se necesite
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $numPorPagina;

// Obtén los aportaciones con filtro
$aportaciones = Consultas::obtenerAportacionesPorProyecto($idProyecto, $offset, $numPorPagina, $filtro);
// Obtén el total de aportaciones con el mismo filtro para mantener la coherencia en la paginación
$totalEntradas = Consultas::totalAportacionesporProyectoAdmin($filtro, $idProyecto);


$totalPaginas = ceil($totalEntradas / $numPorPagina);


foreach ($aportaciones as $key => $aportacion) {
    // Obtener el nombre de la ciudad y región
    // $id_ciudad = $evento['id_city'];
    // $eventos[$key]['nombre_ciudadyregion'] = Consultas::obtenerNombresCiudadYRegion($id_ciudad);

    $idUser = $aportacion['id_user'];
    $datosArtista = Consultas::obtenerNombresUsuario($idUser);
    // Agrega los datos del artista a un nuevo índice, por ejemplo, 'datos_artista'
    $aportaciones[$key]['datos_artista'] = $datosArtista;
}



echo json_encode([
    'aportaciones' => $aportaciones,
    'paginaActual' => $paginaActual,
    'totalPaginas' => $totalPaginas,
    'totalEvents' => $totalEntradas
]);
