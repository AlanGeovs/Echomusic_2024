<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';

if(isset($_POST['id'])){

  $userid = $_SESSION['user'];

  $error = false;

  $eventId = trim($_POST['id']);
  $eventId = FILTER_VAR($eventId, FILTER_SANITIZE_NUMBER_INT);
  $eventId = htmlspecialchars($eventId);
  $eventId = mysqli_real_escape_string($conn, $eventId);

  if(!FILTER_VAR($eventId, FILTER_VALIDATE_INT, 1)){
    $error = true;
    $videoError = 'Evento inválido.';
  }

  if(!$error){
    $query_1 = mysqli_query( $conn, "SELECT * FROM events_streaming WHERE id_user='$userid' AND id_event='$eventId'");
    $query_2 = mysqli_query($conn, "SELECT * FROM subscribes_streaming WHERE id_event_streaming='$eventId'");
    $query_3 = mysqli_query($conn, "SELECT DISTINCT id_user FROM transactions_streaming WHERE id_event='$eventId' AND payment_status='paid'");
    $query_4 = mysqli_query($conn, "SELECT SUM(amount_transaction_streaming) AS value_sum FROM transactions_streaming WHERE id_event='$eventId' AND payment_status='paid'");
    $query_5 = mysqli_query($conn, "SELECT SUM(amount_transaction_commission) AS value_sum FROM transactions_streaming WHERE id_event='$eventId' AND payment_status='paid'");
    $query_6 = mysqli_query($conn, "SELECT SUM(amount_transaction_tip) AS value_sum FROM transactions_streaming WHERE id_event='$eventId' AND payment_status='paid'");
    $query_7 = mysqli_query($conn, "SELECT SUM(amount_transaction_tip_commission) AS value_sum FROM transactions_streaming WHERE id_event='$eventId' AND payment_status='paid'");
    if(mysqli_num_rows($query_1)>0){
      $streamingEvent_array = mysqli_fetch_array($query_1);
      $totalRecords = mysqli_num_rows($query_2);
      $totalTickets = mysqli_num_rows($query_3);
      $row_4 = mysqli_fetch_assoc($query_4);
      $row_5 = mysqli_fetch_assoc($query_5);
      $row_6 = mysqli_fetch_assoc($query_6);
      $row_7 = mysqli_fetch_assoc($query_7);
      $totalValueTransactionStreaming = $row_4['value_sum'];
      if($totalValueTransactionStreaming==''){$totalValueTransactionStreaming=0;}
      $totalValueTransactionCommission = $row_5['value_sum'];
      if($totalValueTransactionCommission==''){$totalValueTransactionCommission=0;}
      $totalValueTransactionTip = $row_6['value_sum'];
      if($totalValueTransactionTip==''){$totalValueTransactionTip=0;}
      $totalValueTransactionTipCommission = $row_7['value_sum'];
      if($totalValueTransactionTipCommission==''){$totalValueTransactionTipCommission=0;}
      echo '<div class="row my-3">
        <div class="col-md-12 iconos-requerimientos">
          <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Usuarios Registrados
            <span id="stats_subscribedUsers" class="badge badge-primary badge-pill">'.$totalRecords.'</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Ticket Vendidos
            <span id="stats_ticketsSold" class="badge badge-primary badge-pill">'.$totalTickets.'</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Monto Recaudado
            <span id="stats_totalValue" class="badge badge-primary badge-pill">$'.number_format($totalValueTransactionStreaming , 0, ',', '.').'</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Donaciones
            <span id="stats_serviceValue" class="badge badge-primary badge-pill">$'.number_format($totalValueTransactionTip , 0, ',', '.').'</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Costo servicio recaudación
            <span id="stats_serviceValue" class="badge badge-primary badge-pill">$'.number_format($totalValueTransactionTipCommission , 0, ',', '.').'</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Total recaudado
            <span id="stats_serviceValue" class="badge badge-primary badge-pill">$'.number_format($totalValueTransactionStreaming+$totalValueTransactionTip , 0, ',', '.').'</span>
          </li>
        </ul>
        </div>

      </div>';
      die();
    }else{
      $errTyp = 'danger';
      echo $errTyp;
      die();
    }
  }else{
    $errTyp = 'danger';
    die();
  }

}

 ?>
