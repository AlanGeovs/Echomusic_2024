<?php
session_start();
require_once "../model/model.php";

$id = $_POST['id'];
$id_user = $_SESSION["id_user"];

try {
    $resultado = Consultas::borrarIntegrante($id, $id_user);
    echo json_encode(['success' => $resultado]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
