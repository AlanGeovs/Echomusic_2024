<?php
$servername = "localhost";
$username = "genesysa_echomisuc";
$password = "Y8vJ2.0Iw_Le";
$db = "genesysa_echomisuc";
// Set Timezone
date_default_timezone_set('America/Santiago');
setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
?>
