<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

require_once "../model/model.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && isset($_POST['user_id'])) {
        $userId = $_POST['user_id'];
        $uploadDir = '../images/usuarios/';
        $uploadFile = $uploadDir . $userId . '.jpg';  // El nombre del archivo será el ID del usuario

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $picture = Consultas::actualizarPictureReady($userId);
            echo 'La imagen ha sido subida exitosamente.';
        } else {
            echo 'Error al subir la imagen.';
        }
    } else {
        echo 'No se recibió ninguna imagen o hubo un error al subirla.';
    }
}
