<?php

session_start();
require_once "../model/model.php"; // Asegúrate de que esta ruta es correcta

try {
    // Asumiendo que el ID del usuario está almacenado en la sesión
    $id_user = $_POST['id_user'];

    if (!$id_user) {
        throw new Exception("ID de usuario no proporcionado o sesión no iniciada.");
    }

    $resultado = Consultas::borrarPresskitPorIdUser($id_user);

    if ($resultado) {
        echo json_encode(['success' => true, 'message' => 'Presskit eliminado con éxito.']);
    } else {
        throw new Exception("Error al eliminar el presskit.");
    }
} catch (Exception $e) {
    // Enviar respuesta de error
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
