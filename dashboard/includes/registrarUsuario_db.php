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

// echo 'Id user: ' . $_POST['id_type_user'];
// echo 'Nick user: ' . $_POST['nick_user'];

// Guardar datos
if (Consultas::registrarUsuario($data)) {
	$response['success'] = true;
	$response['message'] = 'Usuario registrado con éxito.';
} else {
	$response['message'] = 'Error al registrar el usuario.';
}

// Enviar respuesta
echo json_encode($response);


// $nombre=$_POST["userName"];
// $correo=$_POST["correo"];
// $password=$_POST["password"];
// $tipo=$_POST["tipo"];

// $datosModel=array($nombre,$correo,$password,$tipo);
// $tabla="users";

// $validar=Consultas::validarRegistroUsuario($datosModel,$tabla);

// if ($validar=="") {
// 	$respuesta=Consultas::registrarUsuarios($datosModel,$tabla); 
// 	if ($respuesta=="error") {
// 		header("Location: https://echomusic.net/dashboard/registrar_usuario.php?e=error");
// 	}elseif ($respuesta=="ok") {
// 		move_uploaded_file($_FILES['file']['tmp_name'],"../images/usuarios/".$_POST["userName"].".jpg");
// 		$res=Consultas::registrarBitacora($_SESSION["usuario"],"bitacora","Registró un Usuario");
// 		if ($res=="ok") {
// 			header("Location: https://echomusic.net/dashboard/site.php");
// 		}elseif ($res=="error") {
// 			header("Location: https://echomusic.net/dashboard/registrar_usuario.php?e=error");
// 		}
		
// 	}
// }else{
// 	header("Location: https://echomusic.net/dashboard/registrar_usuario.php?e=existe"); 
// }
