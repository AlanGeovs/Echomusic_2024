<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=echomusicnet_db', 'echomusicnet_db', 'W4dR9+L/Mi8');
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
