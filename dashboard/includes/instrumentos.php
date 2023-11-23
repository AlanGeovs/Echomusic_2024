<?php
session_start();

require_once "../model/model.php";

$resultado = Consultas::obtenerInstrumentos(); // Método que debes crear para obtener los datos

echo json_encode($resultado);
