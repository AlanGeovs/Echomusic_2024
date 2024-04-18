<?php
session_start();
require_once "../model/model.php"; // Ajusta la ruta si es necesario

if (!isset($_SESSION["id_user"])) {
    echo json_encode(['error' => 'Usuario no identificado']);
    exit;
}

$id_usuario = $_SESSION["id_user"];
$numPorPagina = 10; // Ajustar según se necesite
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$typeUser = $_GET['type_user'];
$offset = ($paginaActual - 1) * $numPorPagina;

// Defino si es usaurio vendedor o comprador con base en el tipo de usuario "type_user"
if ($typeUser == 4 || $typeUser == 1) { // usuario Admin o usuario Artista
    $id_type_user = 'id_user_sell';
} elseif ($typeUser == 2) { // Usuario 
    $id_type_user = 'id_user_buy';
}

$reservas = Consultas::obtenerReservasPorUsuario($id_usuario, $offset, $numPorPagina, $id_type_user);
$totalReservas = Consultas::totalReservas($id_usuario);
$totalPaginas = ceil($totalReservas / $numPorPagina);

echo json_encode([
    'reservas' => $reservas,
    'paginaActual' => $paginaActual,
    'totalPaginas' => $totalPaginas,
    'totalReservas' => $totalReservas //  
]);
