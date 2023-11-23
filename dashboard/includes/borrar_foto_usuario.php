<?php
session_start();
require_once "../model/model.php";

$nombreFoto = $_POST['nombreFoto'] ?? '';

if ($nombreFoto) {
    // Borrar foto del servidor (archivo)
    $rutaFoto = "../" . $nombreFoto;
    if (file_exists($rutaFoto)) {
        unlink($rutaFoto);
    }

    // Borrar entrada de la base de datos
    $resultado = Consultas::borrarFotoUsuario($nombreFoto);
    echo $resultado ? "Foto borrada" : "Error al borrar foto";
}
