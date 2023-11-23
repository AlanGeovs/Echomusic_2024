<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();

require_once "../model/model.php";

// Asegúrate de validar y sanear todas las entradas
// if (isset($_FILES['memberPhoto']) && isset($_POST['id_user'])) {
$id_user = $_POST['id_user'];
$first_name = $_POST['memberName'];
$last_name = $_POST['memberLastName'];
$instrument = $_POST['memberRole'];

echo "ID user: " . $id_user;
echo "<br>Nombre: " . $first_name;
echo "<br>App: " . $last_name;
echo "<br>Instrumento: " . $instrument;


$foto = $_FILES['memberPhoto'];
$nombreFoto = $id_user . '-' . rand(1000, 9999) . '.jpg';
$rutaFoto = '../images/integrantes/' . $nombreFoto;
// $rutaFoto =  $nombreFoto;

// Mover la foto a la carpeta correspondiente
move_uploaded_file($foto['tmp_name'], $rutaFoto);

// Luego guardar la información en la base de datos
$resultado = Consultas::guardarIntegrante($id_user, $first_name, $last_name, $instrument, $nombreFoto);

// Envía una respuesta
echo $resultado ? "Integrante guardado con éxito" : "Error al guardar el integrante BD";
// }
