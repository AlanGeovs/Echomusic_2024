<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => 'No se pudo borrar la entrada.'];

if (isset($_GET['id'])) {
    $idEvent = $_GET['id'];

    // Llama a la función que borrará la entrada del evento
    $resultado = Consultas::borrarEntradas($idEvent);

    if ($resultado) {
        $response = ['success' => true, 'message' => 'Entrada borrada con éxito.'];
    }
}

echo json_encode($response);
