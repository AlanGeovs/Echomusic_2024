<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../images/usuarios/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            echo 'La imagen ha sido subida exitosamente.';
        } else {
            echo 'Error al subir la imagen.';
        }
    } else {
        echo 'No se recibió ninguna imagen o hubo un error al subirla.';
    }
}
