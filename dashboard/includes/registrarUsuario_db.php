<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

// Validación de contraseña en el lado del servidor
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

// Validar si las contraseñas coinciden
if ($password !== $confirmPassword) {
	$response['message'] = 'Las contraseñas no coinciden.';
	echo json_encode($response);
	exit; // Detener la ejecución del script
}



// Recibir datos
$data = [
	'id_type_user' => isset($_POST['id_type_user']) ? $_POST['id_type_user'] : '',
	'first_name_user' => isset($_POST['first_name_user']) ? $_POST['first_name_user'] : '',
	'last_name_user' => isset($_POST['last_name_user']) ? $_POST['last_name_user'] : '',
	'nick_user' => isset($_POST['nick_user']) ? $_POST['nick_user'] : NULL,
	'mail_user' => isset($_POST['mail_user']) ? $_POST['mail_user'] : '',
	'password_user' => isset($_POST['password']) ? $_POST['password'] : '',
	'space' => isset($_POST['space']) ? $_POST['space'] : NULL,
	'type_agent' => isset($_POST['type_agent']) ? $_POST['type_agent'] : '0'
];

// Seción para Validar y sanear datos  
// echo "Nick: " . $_POST['nick_user'];

// Validar nombre y apellidos
$first_name = $_POST['first_name_user'] ?? '';
$last_name = $_POST['last_name_user'] ?? '';

if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $first_name)) {
	$response['message'] = 'El nombre contiene caracteres inválidos.';
	echo json_encode($response);
	exit;
}

if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $last_name)) {
	$response['message'] = 'Los apellidos contienen caracteres inválidos.';
	echo json_encode($response);
	exit;
}

// Recibir y validar el correo electrónico
$mail_user = isset($_POST['mail_user']) ? $_POST['mail_user'] : '';

if (!filter_var($mail_user, FILTER_VALIDATE_EMAIL)) {
	$response['message'] = 'La dirección de correo electrónico no es válida.';
	echo json_encode($response);
	exit;
}

// Validar si el email ya está registrado
if (Consultas::verificarEmailExistente($data['mail_user'])) {
	$response['message'] = 'El email ya está registrado. Por favor, utiliza otro email.';
	echo json_encode($response);
	exit; // Detener la ejecución del script
}

// Validar si el nick user ya está registrado
if (Consultas::verificarNickUserExistente($data['nick_user'])) {
	$response['message'] = 'El nombre de banda o artista ya está registrado. Por favor, utiliza otro nombre.';
	echo json_encode($response);
	exit; // Detener la ejecución del script
}

// Validar si el space ya está registrado
if (Consultas::verificarSpaceExistente($data['space'])) {
	$response['message'] = 'El nombre de lugar o espacio ya está registrado. Por favor, utiliza otro nombre.';
	echo json_encode($response);
	exit; // Detener la ejecución del script
}

// Guardar datos
if (Consultas::registrarUsuario($data)) {
	$response['success'] = true;
	$response['message'] = 'Usuario registrado con éxito.';
} else {
	$response['message'] = 'Error al registrar el usuario.';
}

// Enviar respuesta
echo json_encode($response);
