<?php
define('ROOT_PATH', dirname(__DIR__) . '/');
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

// Conectar base de datos
  include ('connect.php');

  $userid = $_SESSION['user'];

  $eventId = trim($_GET['id']);
  $eventId = FILTER_VAR($eventId, FILTER_SANITIZE_NUMBER_INT);
  $eventId = htmlspecialchars($eventId);
  $eventId = mysqli_real_escape_string($conn, $eventId);

  if(!FILTER_VAR($eventId, FILTER_VALIDATE_INT, 1)){
    $error = true;
    $eventError = 'Evento inválido.';
  }

if(!$error){

  // Filter the excel data
    function filterData(&$str){
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

  // Excel file name for download
  $fileName = "datos_suscriptores_" . date('d-m-Y') . ".xls";

  // Column names
  $fields = array('NOMBRE EVENTO', 'LUGAR EVENTO', 'ORGANIZADOR', 'FECHA EVENTO', 'NOMBRE', 'APELLIDO', 'RUT', 'CORREO', 'ID SUSCRIPCIÓN', 'VALOR ENTRADA', 'FECHA COMPRA', 'ASISTENCIA');

  // Display column names as first row
  $excelData = implode("\t", array_values($fields)) . "\n";

  // Fetch records from database
  $query = mysqli_query($conn, "SELECT events_public.name_event, events_public.name_location, events_public.organizer, events_public.date_event, subscribes_public.subscribe_fname, subscribes_public.subscribe_lname, subscribes_public.subscribe_rut, subscribes_public.subscribe_email, subscribes_public.id_subscribe_public, ROUND(transactions_public.amount_transaction_public/transactions_public.n_tickets, 0) AS total, transactions_public.date_transaction, subscribes_public.event_assist
                                FROM subscribes_public
                                LEFT JOIN transactions_public ON subscribes_public.order_transaction=transactions_public.order_transaction
                                LEFT JOIN events_public ON events_public.id_event=subscribes_public.id_event_public
                                LEFT JOIN type_events ON type_events.id_type_event=events_public.id_type_event
                                LEFT JOIN users ON users.id_user=subscribes_public.id_user
                                WHERE subscribes_public.subscribe_status='1' AND events_public.id_event='$eventId' AND events_public.id_user='$userid'");
  if(mysqli_num_rows($query) > 0){
      // Output each row of the data
      while($row = mysqli_fetch_assoc($query)){
          $total_amount = number_format($row['total'], 0, ',', '.');
          $lineData = array($row['name_event'], $row['name_location'], $row['organizer'], $row['date_event'], $row['subscribe_fname'], $row['subscribe_lname'], $row['subscribe_rut'], $row['subscribe_email'], $row['id_subscribe_public'], $total_amount, $row['date_transaction'], $row['event_assist']);
          array_walk($lineData, 'filterData');
          $excelData .= implode("\t", array_values($lineData)) . "\n";
      }
  }else{
      $excelData .= 'No se encontraron datos...'. "\n";
  }

  // Headers for download
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=\"$fileName\"");

  // Render excel data
  echo $excelData;
}
exit;
?>
