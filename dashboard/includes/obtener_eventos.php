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

$eventos = Consultas::obtenerEventosPorUsuario($id_usuario, $offset, $numPorPagina);
$totalEventos = Consultas::totalEventos($id_usuario);
$totalPaginas = ceil($totalEventos / $numPorPagina);

echo json_encode([
    'eventos' => $eventos,
    'paginaActual' => $paginaActual,
    'totalPaginas' => $totalPaginas,
    'totalEventos' => $totalEventos // Opcional, si deseas mostrar el total de eventos en la UI
]);
