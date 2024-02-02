<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreArtista = $_POST['nombreArtista'];
    $asunto = $_POST['asunto'];
    $descripcion = $_POST['descripcion'];

    $para = "alangeovs@gmail.com";
    $titulo = "Solicitud de Contratación: " . $asunto;
    $mensaje = "Nombre del Artista: " . $nombreArtista . "\nDescripción: " . $descripcion;
    $headers = "From: contacto@echomusic.net" . "\r\n" .
        "Reply-To: contacto@echomusic.net" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    if (mail($para, $titulo, $mensaje, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
