<?php

require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('958916104006-2sr5okp27ss5c67vbfjdnvsp8gdott72.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://www.echomusic.net/loginConGoogleCallback.php');
$client->addScope("email");
$client->addScope("profile");

$login_url = $client->createAuthUrl();

header('Location: ' . $login_url);
exit;
