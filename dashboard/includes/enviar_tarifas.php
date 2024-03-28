<?php
session_start();
require_once "../model/model.php"; // Asegúrate de incluir correctamente tu archivo del modelo

$response = ['success' => false, 'message' => 'Error al guardar el plan'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $valueAndCommission = $_POST['value_plan'] * 0.1;

  $data = [
    'id_user' => $_POST['id_user'],
    'id_name_plan' => $_POST['id_name_plan'],
    'value_plan' => $_POST['value_plan'],
    'commission_plan' => $valueAndCommission,
    'desc_plan' => $_POST['desc_plan'],
    'active' => 'active',
    'duration_hours' => $_POST['duration_hours'],
    'duration_minutes' => $_POST['duration_minutes'],
    'backline' => $_POST['backline'],
    'sound_reinforcement' => $_POST['sound_reinforcement'],
    'sound_engineer' => $_POST['sound_engineer'],
    'artists_amount' => $_POST['artists_amount']
  ];

  if (Consultas::guardarPlan($data)) {
    $response['success'] = true;
    $response['message'] = 'Plan guardado con éxito';
  } else {
    $response['message'] = 'Error al intentar guardar el plan';
  }
}

echo json_encode($response);
