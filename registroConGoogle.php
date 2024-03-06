<?php

session_start();
require_once 'vendor/autoload.php';

$type_user = $_GET['u'];

$client = new Google_Client();
$client->setClientId('958916104006-2sr5okp27ss5c67vbfjdnvsp8gdott72.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://www.echomusic.net/registroConGoogleCallback.php?u=' . $type_user);
$client->addScope("email");
$client->addScope("profile");

// Redirige al usuario a la página de autenticación de Google
$auth_url = $client->createAuthUrl();
header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
