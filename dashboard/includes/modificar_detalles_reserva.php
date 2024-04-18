<?php
session_start();
require_once "../model/model.php"; // Asegúrate de ajustar la ruta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Asume que los campos del formulario se llaman como las columnas en tu base de datos
    $idReserva = $_POST['id_event']; // Asume que este es el ID único de la reserva
    $nameEvent = $_POST['name_event'];
    $location = $_POST['location'];
    $idRegion = $_POST['id_region'];
    $idCity = $_POST['id_city'];
    $dateEvent = $_POST['date_event'];
    $phoneEvent = $_POST['phone_event'];
    $descEvent = $_POST['desc_event'];

    // Aquí deberías validar y sanear las entradas

    try {
        $resultado = Consultas::actualizarDetalleReserva($idReserva, $nameEvent, $location, $idRegion, $idCity, $dateEvent, $phoneEvent, $descEvent);
        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'No se pudo actualizar la reserva.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error al actualizar la reserva: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Método de solicitud no válido.']);
}
