<?php
session_start();
require_once "../model/models.php";

// header('Content-Type: application/json');


$response = ['success' => false, 'message' => 'Error al enviar la pregunta'];

if (isset($_POST['question_desc']) && !empty($_POST['question_desc'])) {
    $id_project = $_POST['id_project'] ?? '';
    $id_user = $_POST['id_user'] ?? '';
    $question_desc = trim($_POST['question_desc']);

    // Asumiendo que tienes una clase Consultas con un método para insertar preguntas
    if (Consultas::insertarPreguntaCrowdfunding($id_project, $id_user, $question_desc)) {
        $response = ['success' => true, 'message' => 'Pregunta enviada con éxito'];
    } else {
        $response['message'] = 'No se pudo enviar la pregunta. Intenta nuevamente más tarde.';
    }
} else {
    $response['message'] = 'Por favor, completa todos los campos requeridos.';
}

echo json_encode($response);
