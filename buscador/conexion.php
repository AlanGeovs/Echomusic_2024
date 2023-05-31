<?php
$servidor= "localhost";
$usuario= "genesysa_echomisuc";
$password = "Y8vJ2.0Iw_Le";
$nombreBD= "genesysa_echomisuc";
$db = new mysqli($servidor, $usuario, $password, $nombreBD);
if ($db->connect_error) {
    die("la conexión ha fallado: " . $db->connect_error);
}
if (!$db->set_charset("utf8")) {
    printf("Error al cargar el conjunto de caracteres utf8: %s\n", $db->error);
    exit();
} else {
    printf("Conjunto de caracteres actual: %s\n", $db->character_set_name());
}
?>