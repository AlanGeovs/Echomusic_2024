<?php

session_start();

require_once "../model/model.php";

$id_genero = $_POST['id_genero'];
$subgeneros = Consultas::obtenerSubGenerosPorGenero($id_genero);
echo json_encode($subgeneros);
