<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once "../model/model.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'] ?? '';
    $video_url = $_POST['video_url'] ?? '';
    $video_service = '';
    $video_code = '';

    // Determinar si la URL es de YouTube
    if (preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i', $video_url, $matches)) {
        $video_service = 'youtube';
        $video_code = $matches[1];
    }
    // Determinar si la URL es de Vimeo
    else if (preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/[^\/]+\/videos\/|video\/|)(\d+)/i', $video_url, $matches)) {
        $video_service = 'vimeo';
        $video_code = $matches[1];
    }

    // Procesar video
    if ($video_service && $video_code) {
        $result_video = Consultas::guardarMultimediaProyecto($project_id, 1, $video_code, $video_service);
        if (!$result_video) {
            echo json_encode(['success' => false, 'message' => 'Error al guardar video']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'URL del video no válida o no soportada']);
        exit;
    }


    // Procesar imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../images/crowdfunding/';
        $fileNameSimple = $project_id . '_' . time();
        $fileName = $fileNameSimple . '.jpg'; // Genera un nombre único
        $uploadFile = $uploadDir . basename($fileName);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            // Guardar la ruta/nombre de la imagen en la base de datos
            $result_image = Consultas::guardarMultimediaProyecto($project_id, 2, $fileNameSimple, 'image');
            if (!$result_image) {
                echo json_encode(['success' => false, 'message' => 'Error al guardar imagen']);
                exit;
            }

            echo json_encode(['success' => true, 'message' => 'Multimedia guardada exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al subir la imagen']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No se recibió ninguna imagen o hubo un error al subirla']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
