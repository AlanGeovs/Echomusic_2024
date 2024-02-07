<?php

$errorMSG = "";

// NOMBRE
if (empty($_POST["name"])) {
    $errorMSG = "El nombre es requerido ";
} else {
    $name = $_POST["name"];
}

// CORREO
if (empty($_POST["email"])) {
    $errorMSG .= "El correo es requerido ";
} else {
    $email = $_POST["email"];
}

// ASUNTO DEL MENSAJE
if (empty($_POST["msg_subject"])) {
    $errorMSG .= "El asunto es requerido ";
} else {
    $msg_subject = $_POST["msg_subject"];
}

// NÚMERO DE TELÉFONO
if (empty($_POST["phone_number"])) {
    $errorMSG .= "El número de teléfono es requerido ";
} else {
    $phone_number = $_POST["phone_number"];
}

// MENSAJE
if (empty($_POST["message"])) {
    $errorMSG .= "El mensaje es requerido ";
} else {
    $message = $_POST["message"];
}

$EmailTo = "alan@genesysapp.com";
$Subject = "Nuevo mensaje de contacto [EchoMusic.net]";

// preparar el texto del correo
$Body = "";
$Body .= "Nombre: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Correo: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Asunto: ";
$Body .= $msg_subject;
$Body .= "\n";
$Body .= "Número de teléfono: ";
$Body .= $phone_number;
$Body .= "\n";
$Body .= "Mensaje: ";
$Body .= $message;
$Body .= "\n";

// enviar correo
$success = mail($EmailTo, $Subject, $Body);

// redirigir a la página de éxito
if ($success && $errorMSG == "") {
    echo "Éxito";
} else {
    if ($errorMSG == "") {
        echo "Algo salió mal :(";
    } else {
        echo $errorMSG;
    }
}
