 <?php
    session_start();
    require_once "../model/models.php";

    // header('Content-Type: application/json');

    $response = ['success' => false, 'message' => ''];

    // if (!filter_var($_POST['email_request'], FILTER_VALIDATE_EMAIL)) {
    //     $response['message'] = 'Por favor, introduce un correo electrónico válido.';
    //     echo json_encode($response);
    //     exit;
    // }

    // Aquí deberías agregar más validaciones si lo consideras necesario

    try {
        $data = [
            'fname_request' => $_POST['fname_request'] ?? '',
            'lname_request' => $_POST['lname_request'] ?? '',
            'subject_request' => $_POST['subject_request'] ?? '',
            'company_request' => $_POST['company_request'] ?? '',
            'email_request' => $_POST['email_request'] ?? '',
            'phone_request' => $_POST['phone_request'] ?? '',
            'message_request' => $_POST['message_request'] ?? '',
        ];

        // Asegúrate de que la clase Consultas y su método insertarSolicitud manejan correctamente la conexión y ejecución.
        // print_r($data);
        $result = Consultas::insertarSolicitud($data);

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Tu solicitud ha sido enviada correctamente.';
        } else {
            $response['message'] = '---No se pudo enviar tu solicitud. Por favor, intenta de nuevo.';
        }
    } catch (Exception $e) {
        $response['message'] = 'Ocurrió un error al procesar tu solicitud: ' . $e->getMessage();
    } finally {
        // Asegúrate de devolver un JSON válido siempre, incluso cuando se atrapa una excepción.
        echo json_encode($response);
    }
