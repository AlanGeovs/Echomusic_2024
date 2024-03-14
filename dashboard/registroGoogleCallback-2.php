<?php
// ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

require_once '../vendor/autoload.php';
require_once 'model/model.php'; // Ajusta la ruta según tu estructura

$type_user = $_GET['u'];
// Verifici si se envia tipo de usaurio
if (empty($type_user)) {
    $url = 'https://www.echomusic.net/dashboard/registroGoogleCallback-2.php';
} else {
    $url = 'https://www.echomusic.net/dashboard/registroGoogleCallback-2.php?u=' . $type_user;
}

$client = new Google_Client();
$client->setClientId('958916104006-2sr5okp27ss5c67vbfjdnvsp8gdott72.apps.googleusercontent.com');
$client->setClientSecret('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');
// $client->setRedirectUri('https://www.echomusic.net/dashboard/registroGoogleCallback-2.php?u=' . $type_user);
$client->setRedirectUri($url);

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

    // Aquí  verifica si el usuario ya existe en tu base de datos
    $userExists = Consultas::checkUserExists($email);

    if ($userExists) {
        // Iniciar sesión
        $_SESSION['user_email'] = $email;

        // Obtener datos de BD del usuarios pasando el mail de login desde GMAIL
        $result = Consultas::loginUsuarioGoogle($email);
        $_SESSION["user_email"] = $email;
        $_SESSION["nick_user"] =  $result['nick_user'];
        $_SESSION["id_type_user"] = $result['id_type_user'];
        $_SESSION["id_user"] = $result['id_user'];
        // Redirige al usuario a su perfil o a la página principal
        header('Location: perfil-editar.php');
    } else {
        // Registrar nuevo usuario
        $result = Consultas::registrarUsuarioGoogle($email, $name, $type_user);
        if ($result) {
            $resultRegistrado = Consultas::loginUsuarioGoogle($email);
            $_SESSION["user_email"] = $email;
            $_SESSION["nick_user"] =  $resultRegistrado['nick_user'];
            $_SESSION["id_type_user"] = $resultRegistrado['id_type_user'];
            $_SESSION["id_user"] = $resultRegistrado['id_user'];
            header('Location: perfil-editar.php');
        } else {
            echo "Error al registrar el usuario";
            // Manejar error
        }
    }
}
