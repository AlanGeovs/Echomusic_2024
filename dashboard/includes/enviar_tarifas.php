<?php
session_start();
require_once "../model/model.php";

// Asegúrate de que el formulario haya sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Recopilar datos del formulario
  $data = [
    'plan_type1' => $_POST['plan_type1'] ?? '',
    'value_plan1' => $_POST['value_plan1'] ?? '',
    'hours_plan1' => $_POST['hours_plan1'] ?? 0,
    'minutes_plan1' => $_POST['minutes_plan1'] ?? 0,
    'backline_plan1' => $_POST['backline_plan1'] ?? 0,
    'soundReinforcement_plan1' => $_POST['soundReinforcement_plan1'] ?? 0,
    'soundEngineer_plan1' => $_POST['soundEngineer_plan1'] ?? 0,
    'nArtists_plan1' => $_POST['nArtists_plan1'] ?? 0,
    'plan_desc1' => $_POST['plan_desc1'] ?? ''
  ];

  // Validaciones adicionales pueden ir aquí

  // Crear instancia de la clase Consultas y llamar al método para insertar el plan
  $consultas = new Consultas();
  $resultado = $consultas->insertPlan($data);

  // Enviar respuesta
  if ($resultado) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar el plan.']);
  }
} else {
  // Método de solicitud no permitido
  echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido.']);
}
