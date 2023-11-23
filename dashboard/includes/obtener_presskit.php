<?php
session_start();
require_once "../model/model.php";

$id_user = $_POST['id_user']; // O usa $_SESSION['id_user'] directamente

try {
    $presskitData = Consultas::obtenerPresskitPorUsuario($id_user);
    echo json_encode(['success' => true, 'data' => $presskitData]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
