<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
require_once "../model/model.php";

$response = ['success' => false];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asumiendo que tu clase de conexión se llama Conexion y el método para obtener la conexión es conectar()
    $id = $_POST['id'];
    $datos = [
        'id' => $id,
        'id_type_user' => $_POST['id_type_user'] ?? null, // Usa null o un valor predeterminado que sea adecuado
        'nick_user' => $_POST['nick_user'] ?? '',
        'mail_user' => $_POST['mail_user'] ?? '',
        'first_name_user' => $_POST['first_name_user'] ?? '',
        'last_name_user' => $_POST['last_name_user'] ?? '',
        'id_city' => $_POST['id_city'] ?? null,
        'id_region' => $_POST['id_region'] ?? null,
        'id_genero' => $_POST['id_genero'] ?? 0,
        'id_subgenero' => $_POST['id_subgenero'] ?? 0,
        'id_musician' => $_POST['id_musician'] ?? null
    ];

    $resultado = Consultas::actualizarDatosUsuario($datos);

    if ($resultado == 'ok') {
        $response['success'] = true;
    } else {
        $response['error'] = 'Error al actualizar el perfil.';
    }
}

echo json_encode($response);
