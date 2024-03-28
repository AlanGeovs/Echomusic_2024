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
$offset = ($paginaActual - 1) * $numPorPagina;

$reservas = Consultas::obtenerReservasPorUsuario($id_usuario, $offset, $numPorPagina);
$totalReservas = Consultas::totalReservas($id_usuario);
$totalPaginas = ceil($totalReservas / $numPorPagina);

echo json_encode([
    'reservas' => $reservas,
    'paginaActual' => $paginaActual,
    'totalPaginas' => $totalPaginas,
    'totalReservas' => $totalReservas //  
]);
