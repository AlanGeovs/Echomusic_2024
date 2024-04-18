<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

session_start();
require_once "../model/model.php";

$response = ['success' => false, 'messages' => []]; // Inicializa una respuesta estándar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProyectoActual = $_POST['edit_id_project'] ?? null; // Asegúrate que este sea el ID del proyecto

    // Verifica que se haya recibido correctamente el ID del proyecto
    if (!$idProyectoActual) {
        $response['messages'][] = 'ID del proyecto no especificado.';
        echo json_encode($response);
        exit;
    }

    $allSuccess = true; // Bandera para verificar el éxito de todas las operaciones

    for ($i = 1; $i <= 5; $i++) {
        $tierTitle = $_POST["edit_r{$i}_tier_title"] ?? '';
        $tierAmount = $_POST["edit_r{$i}_tier_amount"] ?? '';
        $tierDesc = $_POST["edit_r{$i}_project_desc"] ?? '';
        $rewards = isset($_POST["edit_r{$i}_t_reward"]) ? explode(",", $_POST["edit_r{$i}_t_reward"]) : [];

        // Convertir el monto a un valor numérico limpio
        $tierAmount = str_replace(['.', ','], '', $tierAmount);

        $statusTier = (!empty($tierTitle) && !empty($tierAmount) && !empty($tierDesc)) ? 1 : 0;

        if ($statusTier === 1) { // Solo intenta crear/actualizar si los campos requeridos están presentes
            $result = Consultas::crearActualizarRecompensa($idProyectoActual, $i, $tierTitle, $tierAmount, $tierDesc, $rewards, $statusTier);

            if (!$result) {
                $allSuccess = false; // Si algún resultado falla, ajusta la bandera
                $response['messages'][] = "Error al actualizar la recompensa $i.";
            }
        }
    }

    // Ajusta la respuesta basada en el éxito de todas las operaciones
    if ($allSuccess) {
        $response['success'] = true;
        $response['messages'][] = 'Todas las recompensas han sido actualizadas exitosamente.';
    } else {
        $response['success'] = false;
    }
} else {
    $response['messages'][] = 'Método de solicitud no válido.';
}

echo json_encode($response); // Envía la respuesta como JSON
