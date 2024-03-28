<?php
// duplicar_evento.php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

// Asumiendo que recibes el ID del evento como JSON
$data = json_decode(file_get_contents('php://input'), true);
$idEventoOriginal = $data['id_event'];

// Duplicar evento
$resultadoEvento = Consultas::duplicarEvento($idEventoOriginal);

// Si se crea el evento correctamente, duplicar tickets
if ($resultadoEvento['success']) {
    $idNuevoEvento = $resultadoEvento['id_event'];
    $resultadoTickets = Consultas::duplicarTicketsDelEvento($idEventoOriginal, $idNuevoEvento);

    if ($resultadoTickets['success']) {
        $response['success'] = true;
        $response['message'] = 'Evento y tickets duplicados con éxito.';
    } else {
        $response['message'] = 'Evento duplicado, pero ocurrió un error al duplicar los tickets. ID pasado' . $idEventoOriginal . ' / Id nuevo evento: ' . $idNuevoEvento;
    }
} else {
    $response['message'] = 'Error al duplicar el evento.';
}

echo json_encode($response);
