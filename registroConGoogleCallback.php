<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'dashboard/model/model.php'; // Ajusta la ruta según tu estructura

$type_user = $_GET['u'];


$client = new Google_Client();
$client->setClientId('958916104006-2sr5okp27ss5c67vbfjdnvsp8gdott72.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://www.echomusic.net/registroConGoogleCallback.php?u=' . $type_user);

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // Obtener datos del perfil
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;


    // Prueba en tabla arterna google
    // $result = Consultas::registrarGoogle($email, $name);
    // if ($result) {
    //     $_SESSION['user_email'] = $email;
    //     // Redirige al usuario a su perfil o a la página principal
    //     header('Location: index.php');
    // } else {
    //     echo "Error al registrar el usuario";
    //     // Manejar error
    // }

    // Aquí deberías verificar si el usuario ya existe en tu base de datos
    $userExists = Consultas::checkUserExists($email);

    if ($userExists) {
        // Iniciar sesión
        $_SESSION['user_email'] = $email;
        // Redirige al usuario a su perfil o a la página principal
        header('Location: ingresar.php?m=1');
    } else {
        // Registrar nuevo usuario
        $result = Consultas::registrarUsuarioGoogle($email, $name, $type_user);
        if ($result) {
            $_SESSION['user_email'] = $email;
            $_SESSION["nick_user"] =  $name;
            $_SESSION["id_type_user"] = 2;
            $_SESSION["id_user"] = 5971;
            // $_SESSION["id_user"] = $respuesta["id_user"];
            // $_SESSION["nick_user"] = $respuesta["nick_user"];
            // $_SESSION["id_type_user"] = $respuesta["id_type_user"];
            // $_SESSION["tipo"] = $respuesta["tipo"];
            // Redirige al usuario a su perfil o a la página principal
            header('Location: index.php');
        } else {
            echo "Error al registrar el usuario";
            // Manejar error
        }
    }
}
