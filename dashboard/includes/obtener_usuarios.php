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
$numPorPagina = 25; // Ajustar según se necesite
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $numPorPagina;

// $usuarios = Consultas::obtenerUsuarios($offset, $numPorPagina);
// $totalUsers = Consultas::totalUsuarios();

// Obtén los usuarios con filtro
$usuarios = Consultas::obtenerUsuarios($offset, $numPorPagina, $filtro);
// Obtén el total de usuarios con el mismo filtro para mantener la coherencia en la paginación
$totalUsers = Consultas::totalUsuarios($filtro);

//echo "Total de usuarios: ", $totalUsers;


$totalPaginas = ceil($totalUsers / $numPorPagina);


foreach ($usuarios as $key => $usuario) {
    $id_ciudad = $usuario['id_city'];
    $usuarios[$key]['nombre_ciudadyregion'] = Consultas::obtenerNombresCiudadYRegion($id_ciudad);
}


echo json_encode([
    'usuarios' => $usuarios,
    'paginaActual' => $paginaActual,
    'totalPaginas' => $totalPaginas,
    //'totalEventos' => $totalUsers, // Opcional, si deseas mostrar el total de eventos en la UI
    'totalUsers' => $totalUsers
]);
