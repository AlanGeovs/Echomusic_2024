<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_POST['image'])) {
    $data = $_POST['image'];

    // Elimina el prefijo de la imagen
    list($type, $data) = explode(';', $data);
    list(, $data) = explode(',', $data);

    $data = base64_decode($data);

    // Nombre de archivo
    $filename = $_SESSION['id_user'] . '-profile.png';

    // Guarda la imagen en el directorio deseado
    // file_put_contents('/images/usuarios/' . $filename, $data);
    file_put_contents(__DIR__ . '/images/usuarios/' . $filename, $data);
}
