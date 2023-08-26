<?php
$servername = "localhost";
$username = "echomusicnet_db";
$password = "W4dR9+L/Mi8";
$db = "echomusicnet_db";
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
