<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => 'No se pudo borrar el evento.'];

if (isset($_GET['id'])) {
    $idEvent = $_GET['id'];

    // Llama a la función que borrará el evento y los tickets asociados. 
    $resultado = Consultas::borrarEventoYTickets($idEvent);

    if ($resultado) {
        $response = ['success' => true, 'message' => 'Evento borrado con éxito.'];
    }
}

echo json_encode($response);
