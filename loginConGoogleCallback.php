<?php
require_once 'vendor/autoload.php';
require_once 'dashboard/model/model.php';

session_start();

$client = new Google_Client();
$client->setClientId('958916104006-2sr5okp27ss5c67vbfjdnvsp8gdott72.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://www.echomusic.net/loginConGoogleCallback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;

    // Aquí, verifica si el usuario ya existe en tu base de datos
    $userExists = Consultas::checkUserExists($email);

    if ($userExists) {
        // Iniciar sesión 
        $_SESSION['user_email'] = $email;
        $_SESSION["nick_user"] =  $email;
        $_SESSION["id_type_user"] = 2;
        $_SESSION["id_user"] = 5971;
        // Redirige al usuario a la página principal o a su perfil
        header('Location: index.php');
    } else {
        // Si el usuario no existe, puedes optar por registrarlo o mostrar un mensaje de error
        // Ejemplo: Redirigir al formulario de registro o mostrar mensaje
        header('Location: registro.php?error=usuario_no_existente');
    }
} else {
    // Manejar el caso de error o acceso denegado
    header('Location: ingresar.php?error=acceso_denegado');
}
