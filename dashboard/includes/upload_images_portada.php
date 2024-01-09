<?php
session_start();
require_once "../model/model.php"; // Asegúrate de que este path sea correcto

$id_user = $_POST['id_user'];

foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
    if ($_FILES['images']['error'][$key] == 0) {
        $temporal = $_FILES['images']['tmp_name'][$key];
        $aleatorio = mt_rand(10000000, 99999999);
        $nombreImagen = "images/fotos/" . $id_user . "-" . $aleatorio . ".jpg";

        if (move_uploaded_file($temporal, "../" . $nombreImagen)) {
            Consultas::agregarFotoPortada($id_user, $nombreImagen);
        }
    }
}

echo "Imágenes subidas correctamente";
