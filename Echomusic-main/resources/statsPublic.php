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
    $query_1 = mysqli_query( $conn, "SELECT * FROM events_public WHERE id_user='$userid' AND id_event='$eventId'");
    $query_2 = mysqli_query($conn, "SELECT * FROM subscribes_public LEFT JOIN tickets_public ON subscribes_public.id_ticket=tickets_public.id_ticket WHERE subscribes_public.id_event_public='$eventId' AND subscribes_public.subscribe_status='1'");
    $query_3 = mysqli_query($conn, "SELECT id_user FROM transactions_public WHERE id_event='$eventId' AND payment_status='paid'");
    $query_4 = mysqli_query($conn, "SELECT SUM(amount_transaction_public) AS value_sum FROM transactions_public WHERE id_event='$eventId' AND payment_status='paid'");
    $query_5 = mysqli_query($conn, "SELECT SUM(amount_transaction_commission) AS value_sum FROM transactions_public WHERE id_event='$eventId' AND payment_status='paid'");
    $query_6 =  mysqli_query($conn, "SELECT * FROM tickets_public WHERE id_event='$eventId'");
    if(mysqli_num_rows($query_1)>0){
      $streamingEvent_array = mysqli_fetch_array($query_1);
      $totalRecords = mysqli_num_rows($query_3);
      $totalTickets = mysqli_num_rows($query_2);
      $row_4 = mysqli_fetch_assoc($query_4);
      $row_5 = mysqli_fetch_assoc($query_5);
      // $row_6 = mysqli_fetch_assoc($query_6);
      $totalValueTransactionStreaming = $row_4['value_sum'];
      if($totalValueTransactionStreaming==''){$totalValueTransactionStreaming=0;}
      $totalValueTransactionCommission = $row_5['value_sum'];
      if($totalValueTransactionCommission==''){$totalValueTransactionCommission=0;}?>

      <div class="row my-3">
              <div id="tableEstadisticas" class="col-md-12 iconos-requerimientos mb-2 px-1">
                  <table id="tableEstadisticasModal">
                      <tr>
                        <th>Tipo Entrada</th>
                        <th>Cantidad</th>
                        <th>Valor Entrada</th>
                      </tr>

                      <? while($ticketsData = mysqli_fetch_assoc($query_6)): ?>
                      <? $id_ticket = $ticketsData['id_ticket']?>
                      <? $query_tickets = mysqli_query($conn, "SELECT * FROM subscribes_public LEFT JOIN tickets_public ON subscribes_public.id_ticket=tickets_public.id_ticket WHERE tickets_public.id_ticket='$id_ticket' AND subscribes_public.id_event_public='$eventId' AND subscribes_public.subscribe_status='1'");?>
                      <? $totalTickets = mysqli_num_rows($query_tickets); ?>
                      <tr>
                        <td><?=$ticketsData['ticket_name']?></td>
                        <td> <?=$totalTickets?> / <?=$ticketsData['ticket_audience']?></td>
                        <td>$ <?=number_format($ticketsData['ticket_value'] , 0, ',', '.')?></td>
                      </tr>
                      <? endwhile; ?>
                      <? $query_tickets = mysqli_query($conn, "SELECT * FROM subscribes_public LEFT JOIN tickets_public ON subscribes_public.id_ticket=tickets_public.id_ticket WHERE subscribes_public.id_ticket='0' AND subscribes_public.id_event_public='$eventId' AND subscribes_public.subscribe_status='1'");?>
                      <? $totalTickets = mysqli_num_rows($query_tickets); ?>
                      <tr>
                        <td>Invitaciones</td>
                        <td> <?=$totalTickets?></td>
                        <td>$ <?=number_format($ticketsData['ticket_value'] , 0, ',', '.')?></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="font-weight-bold">Total recaudado</td>
                        <td>$ <?=number_format($totalValueTransactionStreaming , 0, ',', '.')?></td>
                      </tr>
                  </table>
              </div>
              <a href="https://echomusic.cl/resources/statsPublicDownload.php?event=<?=$eventId?>" class="btn btn-primary m-auto">Descargar asistentes</a>
            </div>

<?php
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
