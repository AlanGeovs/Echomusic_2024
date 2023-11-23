<?php
session_start();

require_once "../model/model.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $note = $_POST['note'];
    $file = $_FILES['file'];

    echo "ID USER: " . $id_user;

    // Aquí debes manejar la carga del archivo y asegurarte de que sea un PDF válido.

    // Procesar los datos con la clase Consultas
    $resultado = Consultas::subirPresskit($id_user, $file, $note);

    // Devolver una respuesta
    echo json_encode($resultado);
}
