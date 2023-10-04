<?php
session_start();

if (isset($_POST['imagebase64'])) {
    $data = $_POST['imagebase64'];

    // Eliminar el prefijo de la data URL para obtener solamente la base64
    list($type, $data) = explode(';', $data);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    // Asegúrate de que la carpeta "/images/usuarios" exista o crea la lógica para crearla si no existe
    $path = "images/usuarios/" . $_SESSION["id_user"] . "-profile.png";

    // Guardar la imagen
    file_put_contents($path, $data);

    echo "Imagen subida correctamente. " . $_SESSION["id_user"];
} else {
    echo "Error al subir la imagen.";
}
