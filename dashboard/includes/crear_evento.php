<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

// echo  'id_type_event ' . $_POST['id_type_event'];
// echo  '<br>id_user ' . $_POST['id_user'];
// echo  '<br>id_region ' . $_POST['id_region'];
// echo  '<br>id_city ' . $_POST['id_city'];
// echo  '<br>date_event ' . $_POST['date_event'];
// echo  '<br>name_event ' . $_POST['name_event'];
// echo  '<br>name_location ' . $_POST['name_location'];
// echo  '<br>location ' . $_POST['location'];
// echo  '<br>organizer ' . $_POST['organizer'];
// echo  '<br>desc_event ' . $_POST['desc_event'];
// echo  '<br>audience_event ' . $_POST['audience_event'];

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Aquí debes validar y sanear los datos de entrada
// Convertir la fecha del evento al formato de MySQL (YYYY-MM-DD HH:MM:SS)
$date_event = DateTime::createFromFormat('d-m-Y H:i', $_POST['date_event']);
$formatted_date_event = $date_event->format('Y-m-d H:i:s');

$nombreArchivo = $_POST['id_user'] . "_" . rand(999, 9999);

$data = [
    'id_type_event' => $_POST['id_type_event'],
    'id_user' => $_POST['id_user'],
    'id_region' => $_POST['id_region'],
    'id_city' => $_POST['id_city'],
    'date_event' => $formatted_date_event, // Usar la fecha formateada
    'name_event' => $_POST['name_event'],
    'name_location' => $_POST['name_location'],
    'location' => $_POST['location'],
    'organizer' => $_POST['organizer'],
    'desc_event' => $_POST['desc_event'],
    'audience_event' => $_POST['audience_event'],
    'img' => $nombreArchivo,
    // Asegúrate de manejar también la carga de la foto y el video si es necesario
];

$ticket = [
    // 'ticket_name' => $_POST['ticket_name'],
    'ticket_name' => "Gratuito",
    'ticket_value' => $_POST['ticket_value'],
    // 'ticket_audience' => $_POST['ticket_audience'],
    'ticket_audience' => $_POST['audience_event'],
    'ticket_dateStart' => $_POST['ticket_dateStart'],
    'ticket_dateEnd' => $_POST['ticket_dateEnd']
];

// Procesar la carga de la foto
if (isset($_FILES['eventPhoto']) && $_FILES['eventPhoto']['error'] == 0) {
    $foto = $_FILES['eventPhoto'];
    $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $nombreArchivoGuardar = $nombreArchivo . '.jpg'; //   usando id_user para el nombre
    $rutaDestino = '../images/eventos/' . $nombreArchivoGuardar;

    if (move_uploaded_file($foto['tmp_name'], $rutaDestino)) {
        //$data['img'] = $nombreArchivoGuardar;
    } else {
        $response['message'] = 'Error al subir el archivo.';
        echo json_encode($response);
        exit;
    }
}

// Lógica actual para crear Evento
$resultado = Consultas::crearEventos($data);

/////////////////////
// Crear función para obtener el id_event des pues de crearEventos
// Enviar id_event el crearTickets

//Lógica para guardar Tickets
$crearTickets = Consultas::crearTickets($ticket);

if ($resultado['success']) {
    $response['success'] = true;
    $response['message'] = 'Evento creado con éxito.';
} else {
    $response['message'] = 'Error al crear el evento.' . (isset($resultado['error']) ? ' Detalles: ' . $resultado['error'] : '');
}

header('Content-Type: application/json');
echo json_encode($response);
