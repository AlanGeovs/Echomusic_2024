<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => 'No se pudo borrar la reserva.'];

if (isset($_GET['id'])) {
    $idEvent = $_GET['id'];

    // Llama a la función que borrará el reserva y los tickets asociados. 
    $resultado = Consultas::borrarReserva($idEvent);

    if ($resultado) {
        $response = ['success' => true, 'message' => 'Reserva borrada con éxito.'];
    }
}

echo json_encode($response);
