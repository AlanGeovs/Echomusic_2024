<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

if (!isset($_POST['id_evento'])) {
    $response['message'] = 'ID del evento no proporcionado.';
    echo json_encode($response);
    exit;
}

$idEvento = $_POST['id_evento'];

// Convertir la fecha del evento al formato de MySQL (YYYY-MM-DD HH:MM:SS)
$date_event = DateTime::createFromFormat('d-m-Y H:i', $_POST['date_event']);
$formatted_date_event = $date_event->format('Y-m-d H:i:s');

$dataEvento = [
    'id_type_event' => $_POST['id_type_event'],
    'id_user' => $_POST['id_user'],
    'id_region' => $_POST['id_region'],
    'id_city' => $_POST['id_city'],
    'date_event' => $formatted_date_event,
    'name_event' => $_POST['name_event'],
    'name_location' => $_POST['name_location'],
    'location' => $_POST['location'],
    'organizer' => $_POST['organizer'],
    'desc_event' => $_POST['desc_event'],
    'audience_event' => $_POST['audience_event'],
    // Supone  que 'img' es opcional y solo se actualiza si se proporciona una nueva imagen
    'img' => isset($_FILES['eventPhoto']) ? $_FILES['eventPhoto'] : null
];

// Procesar la carga de la foto, si existe
if ($dataEvento['img']) {
    // Aquí procesas la carga de la foto y actualizas $dataEvento['img'] con el nombre del archivo
}


// Actualizamos los Tickets
// Antes de actualizar el evento, verifica si es de pago y maneja los tickets
// Suponiendo que 'id_type_event' indica si hay que manejar tickets
if ($_POST['id_type_event'] == '2') { // Evento de pago
    // Asumiendo que sabes la cantidad de tickets por algún medio, como un campo oculto en el formulario
    $cantidadTickets = count($_POST['ticket_name']); // Cuenta cuántos nombres de tickets se enviaron

    for ($i = 0; $i < $cantidadTickets; $i++) {
        $ticketData = [
            'ticket_name' => $_POST['ticket_name'][$i],
            'ticket_value' => $_POST['ticket_value'][$i],
            'ticket_audience' => $_POST['ticket_audience'][$i],
            'ticket_dateStart' => DateTime::createFromFormat('Y-m-d\TH:i', $_POST['ticket_dateStart'][$i])->format('Y-m-d H:i:s'),
            'ticket_dateEnd' => DateTime::createFromFormat('Y-m-d\TH:i', $_POST['ticket_dateEnd'][$i])->format('Y-m-d H:i:s'),
        ];

        if (!empty($_POST['id_ticket'][$i])) {
            // Actualizar el ticket si se proporcionó un ID
            $ticketData['id_ticket'] = $_POST['id_ticket'][$i];
            Consultas::actualizarEntradaEvento($ticketData);
        } else {
            // Crear un nuevo ticket si no se proporcionó un ID
            Consultas::crearTickets($ticketData, $idEvento); // Asegúrate de tener una función para insertar un nuevo ticket
        }
    }
} else {
    // Lógica para eventos gratuitos
    // Asumiendo que solo hay un ticket gratuito que posiblemente actualizar o insertar
    $ticketGratis = [
        'ticket_name' => "Gratuito",
        'ticket_value' => 0,
        'ticket_audience' => $_POST['audience_event'],
        'ticket_dateStart' => $formatted_date_event,
        'ticket_dateEnd' => $formatted_date_event,
    ];

    // Actualizar o crear el ticket gratuito, según tu lógica específica
    Consultas::actualizarEntradaEvento($ticketGratis);
}



// -----------------


// Luego de manejar los tickets, procede a actualizar el evento
$resultado = Consultas::actualizarEvento($idEvento, $dataEvento);

if ($resultado) {
    $response['success'] = true;
    $response['message'] = 'Evento actualizado correctamente.';
} else {
    $response['message'] = 'Error al actualizar el evento.';
}

echo json_encode($response);
