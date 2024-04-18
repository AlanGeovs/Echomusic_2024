<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
require_once "../model/model.php"; // Ajusta la ruta si es necesario
if (isset($_GET['id_reserva'])) {
    $idReserva = $_GET['id_reserva'];

    $reservas = Consultas::obtenerDetalleReserva($idReserva);
    // Aquí llamas a la función que obtiene los detalles de la reserva y la conviertes a JSON
    echo json_encode($reservas);
} else {
    // En caso de que no se haya proporcionado un id_reserva, puedes devolver un error
    echo json_encode(['error' => 'No se proporcionó el ID de la reserva']);
}
