<?php
session_start();
require_once "../model/model.php";

$id = $_POST['id'];

try {
    $resultado = Consultas::obtenerIntegrantePorId($id);
    echo json_encode($resultado);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
