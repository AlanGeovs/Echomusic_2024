<?php

// ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

require_once '../vendor/autoload.php';

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
$client->addScope("email");
$client->addScope("profile");

// Redirige al usuario a la página de autenticación de Google
$auth_url = $client->createAuthUrl();
header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
