<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'] ?? null;
    $project_title = $_POST['project_title'] ?? null;
    $project_region = $_POST['project_region'] ?? null;
    $project_desc = $_POST['project_desc'] ?? null;
    $id_category = $_POST['id_category'] ?? null;

    if ($id_user && $project_title && $project_desc && $id_category) {
        //Guarda el proyecto y debuelve el valor del id_project para posteriormente usarlo en crearDescProyecto y crearCategoriaProyecto
        $id_project = Consultas::crearProyecto($id_user, $project_title, $project_region);

        if ($id_project) {
            $descCreada = Consultas::crearDescProyecto($id_project, $project_desc);
            $categoriaCreada = Consultas::crearCategoriaProyecto($id_project, $id_category);
            $creaRecompensas = Consultas::crearRegistrosTiers($id_project);
            $creaMultimedia = Consultas::crearRegistrosMultimedia($id_project);
            $creaTimes      = Consultas::crearRegistrosTimes($id_project);

            if ($descCreada && $categoriaCreada) {
                $response['success'] = true;
                $response['message'] = 'Proyecto creado con éxito.';
            } else {
                $response['message'] = 'Error al crear descripción o categoría del proyecto.';
            }
        } else {
            $response['message'] = 'Error al crear el proyecto.';
        }
    } else {
        $response['message'] = 'Datos incompletos.';
    }
} else {
    $response['message'] = 'Método de solicitud no válido.';
}

echo json_encode($response);
