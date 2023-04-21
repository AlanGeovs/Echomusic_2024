<?php
define('ROOT_PATH', dirname(__DIR__) . '/');
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

// Conectar base de datos
  include (ROOT_PATH.'resources/connect.php');

  $userid = $_SESSION['user'];

  $eventId = trim($_GET['event']);
  $eventId = FILTER_VAR($eventId, FILTER_SANITIZE_NUMBER_INT);
  $eventId = htmlspecialchars($eventId);
  $eventId = mysqli_real_escape_string($conn, $eventId);

  if(!FILTER_VAR($eventId, FILTER_VALIDATE_INT, 1)){
    $error = true;
    echo 'Evento inválido.';
  }

//Get event Id with user id
  $queryCheckUser = mysqli_query($conn, "SELECT id_event FROM events_public WHERE id_user='$userid' AND active_event='1' AND id_event='$eventId'");
  if(mysqli_num_rows($queryCheckUser)>0){
    $checkUserArray = mysqli_fetch_assoc($queryCheckUser);
    $id_event = $checkUserArray['id_event'];
  }else{
    echo "El inicio de sesión no coincide con los datos solicitados.";
    die();
  }

// Filter the excel data
  function filterData(&$str){
      $str = preg_replace("/\t/", "\\t", $str);
      $str = preg_replace("/\r?\n/", "\\n", $str);
      if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

// Excel file name for download
$fileName = "datos_asistentes_" . date('d-m-Y') . ".xls";

// Column names
$fields = array('NOMBRE', 'APELLIDO', 'RUT', 'E-MAIL', 'MONTO', 'FECHA', 'NOMBRE ENTRADA', 'N ENTRADA', 'ASISTENCIA');

// Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database
$query = mysqli_query($conn, "SELECT subscribes_public.subscribe_fname, subscribes_public.subscribe_lname, subscribes_public.subscribe_rut, subscribes_public.subscribe_email, subscribes_public.id_subscribe_public, subscribes_public.event_assist,  ROUND(transactions_public.amount_transaction_public/transactions_public.n_tickets, 0) AS total, transactions_public.date_transaction, tickets_public.ticket_name
                                      FROM subscribes_public
                                      LEFT JOIN transactions_public ON subscribes_public.order_transaction=transactions_public.order_transaction
                                      LEFT JOIN events_public ON events_public.id_event=subscribes_public.id_event_public
                                      LEFT JOIN type_events ON type_events.id_type_event=events_public.id_type_event
                                      LEFT JOIN users ON users.id_user=subscribes_public.id_user
                                      LEFT JOIN tickets_public ON subscribes_public.id_ticket=tickets_public.id_ticket
                                      WHERE subscribes_public.subscribe_status='1' AND subscribes_public.id_event_public='$id_event'");
if(mysqli_num_rows($query) > 0){
    // Output each row of the data
    while($row = mysqli_fetch_assoc($query)){
        $total_amount = number_format($row['total'] , 0, ',', '.');
        $lineData = array($row['subscribe_fname'], $row['subscribe_lname'], $row['subscribe_rut'], $row['subscribe_email'], $total_amount, $row['date_transaction'], $row['ticket_name'], $row['id_subscribe_public'], $row['event_assist']);
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

exit;
?>
