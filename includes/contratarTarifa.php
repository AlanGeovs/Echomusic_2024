<?php
session_start();
require_once "../model/models.php";

//header('Content-Type: application/json'); // Asegura que la respuesta es en formato JSON

$response = ['success' => false, 'message' => ''];

// $name = $_POST['name_event'];
// $loca = $_POST['location'];
// echo "Nombre " . $name . ",  Location: " . $loca . "<br>";

$data = [
    'id_plan' =>      isset($_POST['id_plan']) ? $_POST['id_plan'] : '',
    'value_plan_event' =>   isset($_POST['value_plan_event']) ? $_POST['value_plan_event'] : '',
    'id_name_plan' => isset($_POST['id_name_plan']) ? $_POST['id_name_plan'] : '',
    'name_event' =>   isset($_POST['name_event']) ? $_POST['name_event'] : '',
    'location' =>     isset($_POST['location']) ? $_POST['location'] : '',
    'id_region' =>    isset($_POST['id_region']) ? $_POST['id_region'] : '',
    'id_city' =>      isset($_POST['id_city']) ? $_POST['id_city'] : '',
    'date_event' =>   isset($_POST['date_event']) ? $_POST['date_event'] : '',
    'phone_event' =>  isset($_POST['phone_event']) ? $_POST['phone_event'] : '',
    'desc_event' =>   isset($_POST['desc_event']) ? $_POST['desc_event'] : ''
];

// Validación de Datos
$event_name = $_POST['name_event'] ?? '';
$location_name = $_POST['name_event'] ?? '';
$phone_num = $_POST['phone_event'] ?? '';

if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $location_name)) {
    $response['message'] = 'El nombre del evento contiene caracteres inválidos.';
    echo json_encode($response);
    exit;
}
if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $location_name)) {
    $response['message'] = 'La dirección contiene caracteres inválidos.';
    echo json_encode($response);
    exit;
}
// Validar si $phone_num tiene 9 caracteres numéricos
if (!preg_match("/^\d{9}$/", $phone_num)) {
    $response['success'] = false;
    $response['message'] = 'El número de teléfono debe contener exactamente 9 dígitos numéricos.';
    echo json_encode($response);
    exit; // Salir del script para evitar ejecutar operaciones adicionales
}


// Aquí, procesa tu formulario. Por ejemplo:
if (!empty($_POST['name_event']) && !empty($_POST['location'])) {
    // Suponiendo que tienes una clase Consultas con un método para registrar la solicitud
    $resultado = Consultas::registrarSolicitudContratacion($data);

    if ($resultado) {
        $response['success'] = true;
        $response['message'] = 'Tu solicitud ha sido enviada correctamente.';
    } else {
        $response['message'] = 'No se pudo enviar tu solicitud. Inténtalo de nuevo.';
    }
} else {
    $response['message'] = 'Por favor, completa todos los campos requeridos.';
}

echo json_encode($response);
