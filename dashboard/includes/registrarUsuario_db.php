<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

// Recibir datos
$data = [
	'id_type_user' => $_POST['id_type_user'],
	'first_name_user' => $_POST['first_name_user'],
	'last_name_user' => $_POST['last_name_user'],
	'nick_user' => $_POST['nick_user'],
	'mail_user' => $_POST['mail_user'],
	'password_user' => $_POST['password_user'],
	// Otros campos si son necesarios
];

// Validar y sanear datos aquí...
// echo "Nick: " . $_POST['nick_user'];

// Guardar datos
if (Consultas::registrarUsuario($data)) {
	$response['success'] = true;
	$response['message'] = 'Usuario registrado con éxito.';
} else {
	$response['message'] = 'Error al registrar el usuario.';
}

// Enviar respuesta
echo json_encode($response);
