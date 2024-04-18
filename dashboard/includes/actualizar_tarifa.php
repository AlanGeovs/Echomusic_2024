<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => 'Operación fallida'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recuperar datos del formulario
    $idPlanKey = $_POST['id_plan_key'];
    $idNamePlan = $_POST['id_name_plan'];
    $valuePlan = $_POST['value_plan'];
    $commissionValuePlan = $_POST['value_plan'] * .1;
    $durationHours = $_POST['duration_hours'];
    $durationMinutes = $_POST['duration_minutes'];
    $backline = $_POST['backline'];
    $soundReinforcement = $_POST['sound_reinforcement'];
    $soundEngineer = $_POST['sound_engineer'];
    $artistsAmount = $_POST['artists_amount'];
    $descPlan = $_POST['desc_plan'];

    // Llamada a la función de actualización
    $result = Consultas::actualizarTarifa([
        'id_plan_key' => $idPlanKey,
        'id_name_plan' => $idNamePlan,
        'value_plan' => $valuePlan,
        'commission_plan' => $commissionValuePlan,
        'duration_hours' => $durationHours,
        'duration_minutes' => $durationMinutes,
        'backline' => $backline,
        'sound_reinforcement' => $soundReinforcement,
        'sound_engineer' => $soundEngineer,
        'artists_amount' => $artistsAmount,
        'desc_plan' => $descPlan,
    ]);

    if ($result) {
        $response['success'] = true;
        $response['message'] = 'Tarifa actualizada correctamente';
    } else {
        $response['message'] = 'Error al actualizar la tarifa';
    }
} else {
    $response['message'] = 'Método de solicitud no soportado';
}

echo json_encode($response);
