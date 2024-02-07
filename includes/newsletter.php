<?php
session_start();
require_once "../model/models.php"; // Asegúrate de que la ruta al archivo de modelos sea correcta

header('Content-Type: application/json');

$response = ['success' => 0, 'message' => ''];

// Validar que el campo de email no esté vacío y sea un correo válido
if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email = $_POST['email'];

    // Instanciar la clase de modelos y verificar si el email ya existe
    if (Consultas::emailYaExiste($email)) {
        $response['message'] = 'Este correo ya está suscrito a nuestro newsletter.';
    } else {
        // Si el correo no existe, intentar registrar la suscripción
        $resultado = Consultas::registrarNewsletter($email);
        if ($resultado) {
            $response['success'] = 1;
            $response['message'] = 'Gracias por suscribirte a nuestro newsletter.';
        } else {
            $response['message'] = 'No se pudo completar tu suscripción. Por favor, intenta de nuevo más tarde.';
        }
    }
} else {
    $response['message'] = 'Por favor, ingresa un correo electrónico válido.';
}

echo json_encode($response);
