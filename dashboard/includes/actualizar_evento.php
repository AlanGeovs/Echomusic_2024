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
$nombreArchivo = $_POST['id_user'] . "_" . rand(999, 9999);

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
    // 'img' => isset($_FILES['eventPhoto']) ? $_FILES['eventPhoto'] : null
    'img' => $_POST['currentImage'],
];

// Procesar la carga de la foto, si existe
// Verifica si se subió una nueva imagen
// Procesar la carga de la foto
if (isset($_FILES['eventPhoto']) && $_FILES['eventPhoto']['error'] == 0) {
    $foto = $_FILES['eventPhoto'];
    $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $nombreArchivoGuardar = $nombreArchivo . '.jpg'; //   usando id_user para el nombre
    $rutaDestino = '../images/eventos/' . $nombreArchivoGuardar;

    if (move_uploaded_file($foto['tmp_name'], $rutaDestino)) {
        $dataEvento['img'] = $nombreArchivo;
    } else {
        $response['message'] = 'Error al subir el archivo.';
        echo json_encode($response);
        exit;
    }
}

// Formato de Fechas
// $date_eventStart = DateTime::createFromFormat('d-m-Y H:i', $_POST['ticket_dateStart']);
// $formatted_date_eventStart = $date_eventStart->format('Y-m-d H:i:s');
// $date_eventEnd = DateTime::createFromFormat('d-m-Y H:i', $_POST['ticket_dateEnd']);
// $formatted_date_eventEnd = $date_eventEnd->format('Y-m-d H:i:s');

// Actualizamos los Tickets
// Antes de actualizar el evento, verifica si es de pago y maneja los tickets
// Suponiendo que 'id_type_event' indica si hay que manejar tickets
if ($_POST['id_type_event'] == '2') { // Evento de pago
    // Asumiendo que sabes la cantidad de tickets por algún medio, como un campo oculto en el formulario
    //  
    // Esta funcion es la que debo de cambiar para que cuente cuandos tickets tiene el evento actula 
    $cantidadTickets = count($_POST['ticket_name']); // Cuenta cuántos nombres de tickets se enviaron
    //echo "<br>Cantidad de tickets: " . $cantidadTickets . "<br>";
    //$cantidadTickets = Consultas::contarTicketsPorEvento($idEvento); // Cuenta cuántos nombres de tickets guardados previamente en la BD
    //echo "Total tickets: - " . $cantidadTickets['total_tickets'] . " - " . $cantidadTickets . "<br>";
    //print_r($cantidadTickets);

    // for ($i = 0; $i <= $cantidadTickets; $i++) {
    //     echo ">> " . $i . "<br>";
    //     $ticketData = [
    //         'ticket_name' => $_POST['ticket_name'][$i],
    //         'ticket_value' => $_POST['ticket_value'][$i],
    //         'ticket_audience' => $_POST['ticket_audience'][$i],
    //         'ticket_dateStart' => DateTime::createFromFormat('Y-m-d\TH:i', $_POST['ticket_dateStart'][$i])->format('Y-m-d H:i:s'),
    //         'ticket_dateEnd' => DateTime::createFromFormat('Y-m-d\TH:i', $_POST['ticket_dateEnd'][$i])->format('Y-m-d H:i:s'),
    //     ];

    //     echo "Id ticket valuar: [" . $i . "]" . $_POST['id_ticket'][$i] . "<br>";
    //     // echo "Id ticket 3: " . $_POST['id_ticket'][3];
    //     if (!empty($_POST['id_ticket'][$i])) {
    //         // Actualizar el ticket si se proporcionó un ID
    //         $ticketData['id_ticket'] = $_POST['id_ticket'][$i];
    //         Consultas::actualizarEntradaEvento($ticketData);
    //     } else {
    //         // Crear un nuevo ticket si no se proporcionó un ID                    
    //         print_r($ticketData);
    //         echo "<br><br>Se ejecuta id evento: " . $idEvento;
    //         Consultas::crearTickets($ticketData, $idEvento); // Asegúrate de tener una función para insertar un nuevo ticket  
    //     }
    // }

    // for ($i = 0; $i < $cantidadTickets; $i++) { // Usa < en lugar de <= para iterar correctamente
    //     // Solo procede si el nombre del ticket en esta iteración está seteado
    //     if (isset($_POST['ticket_name'][$i])) {
    //         $ticketData = [
    //             'ticket_name' => $_POST['ticket_name'][$i],
    //             'ticket_value' => $_POST['ticket_value'][$i] ?? 0, // Usa el operador de fusión null para valores predeterminados
    //             'ticket_audience' => $_POST['ticket_audience'][$i] ?? 0,
    //             'ticket_dateStart' => '2024-05-04 02:00:00',
    //             'ticket_dateEnd' => '2024-05-04 02:00:00',
    //             // 'ticket_dateStart' => isset($_POST['ticket_dateStart'][$i]) ? DateTime::createFromFormat('Y-m-d\TH:i', $_POST['ticket_dateStart'][$i])->format('Y-m-d H:i:s') : null,
    //             // 'ticket_dateEnd' => isset($_POST['ticket_dateEnd'][$i]) ? DateTime::createFromFormat('Y-m-d\TH:i', $_POST['ticket_dateEnd'][$i])->format('Y-m-d H:i:s') : null,
    //         ];

    //         if (isset($_POST['id_ticket'][$i]) && !empty($_POST['id_ticket'][$i])) {
    //             // Actualizar el ticket
    //             $ticketData['id_ticket'] = $_POST['id_ticket'][$i];
    //             Consultas::actualizarEntradaEvento($ticketData);
    //         } else {
    //             // Crear un nuevo ticket
    //             // print_r($ticketData);
    //             Consultas::crearTickets($ticketData, $idEvento);
    //         }
    //     }
    // }
    for ($i = 0; $i < $cantidadTickets; $i++) {
        if (isset($_POST['ticket_name'][$i])) {
            // Determinar el formato de la fecha basado en la presencia del carácter 'T'
            if (strpos($_POST['ticket_dateStart'][$i], 'T') !== false) {
                // Formato de fecha para tickets existentes: 'Y-m-d\TH:i'
                $format = 'Y-m-d\TH:i';
            } else {
                // Formato de fecha para nuevos tickets: 'd-m-Y H:i'
                $format = 'd-m-Y H:i';
            }

            // Crear objetos DateTime desde los valores de formulario según el formato detectado
            $startDateTime = DateTime::createFromFormat($format, $_POST['ticket_dateStart'][$i]);
            $endDateTime = DateTime::createFromFormat($format, $_POST['ticket_dateEnd'][$i]);

            // Convertir las fechas al formato deseado para la base de datos
            $formattedStart = $startDateTime ? $startDateTime->format('Y-m-d H:i:s') : null;
            $formattedEnd = $endDateTime ? $endDateTime->format('Y-m-d H:i:s') : null;

            $ticketData = [
                'ticket_name' => $_POST['ticket_name'][$i],
                'ticket_value' => $_POST['ticket_value'][$i] ?? 0,
                'ticket_audience' => $_POST['ticket_audience'][$i] ?? 0,
                'ticket_dateStart' => $formattedStart,
                'ticket_dateEnd' => $formattedEnd,
            ];

            if (isset($_POST['id_ticket'][$i]) && !empty($_POST['id_ticket'][$i])) {
                // Actualizar el ticket existente
                $ticketData['id_ticket'] = $_POST['id_ticket'][$i];
                Consultas::actualizarEntradaEvento($ticketData);
            } else {
                // Crear un nuevo ticket
                Consultas::crearTickets($ticketData, $idEvento);
            }
        }
    }
} else {
    // Lógica para eventos gratuitos
    // Asumiendo que solo hay un ticket gratuito que posiblemente actualizar o insertar
    $ticketGratis = [
        'ticket_name' => ["Gratuitos"][0],
        'ticket_value' => [0][0],
        'ticket_audience' => [$_POST['ticket_audience']][0],
        'ticket_dateStart' => [$_POST['ticket_dateStart']][0],
        'ticket_dateEnd' => [$_POST['ticket_dateEnd']][0],
        // 'ticket_dateStart' => $formatted_date_event,
        // 'ticket_dateEnd' => $formatted_date_event,
    ];

    //print_r($ticketGratis);

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
