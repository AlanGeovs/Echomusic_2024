<?php
include 'connect.php';
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
if(isset($_POST['id']) && !empty($_POST['id'])) {

  if(!empty($_SESSION['user'])){
    $userid = $_SESSION['user'];
  }else{
    $error = true;
  }

  // Get data
    $orderTransaction = $_POST['id'];
    $orderTransaction = mysqli_real_escape_string($conn, $orderTransaction);

  // Data Validation
    if (empty($orderTransaction)) {
     $orderTransaction = '';
    } else if (strlen($orderTransaction) < 12) {
     $error = true;
    } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$orderTransaction)) {
     $error = true;
    }

   if( !$error ) {
    // Get susbcribes
      $querySubscribesPublic = mysqli_query($conn, "SELECT subscribes_public.id_subscribe_public, events_public.name_event, subscribes_public.ticket_file
                                          FROM subscribes_public
                                          LEFT JOIN transactions_public ON transactions_public.order_transaction=subscribes_public.order_transaction
                                          LEFT JOIN events_public ON events_public.id_event=transactions_public.id_event
                                          WHERE subscribes_public.id_user='$userid' AND transactions_public.payment_status='paid' AND subscribes_public.order_transaction='$orderTransaction' AND subscribes_public.subscribe_status='1'
                                          ORDER BY transactions_public.date_transaction ASC");
      $arraySubscribesPublic = array();
      echo $userid;
      echo $orderTransaction;
      while($subscribesPublic = mysqli_fetch_array($querySubscribesPublic)){
        $arraySubscribesPublic[] = $subscribesPublic;
      }

      ?>
      <thead>

        <tr>

          <th scope="col">Evento</th>

          <th scope="col">Entrada</th>

          <th scope="col">Enlace</th>

        </tr>

      </thead>
        <? foreach($arraySubscribesPublic as $subscribesPublic): ?>

            <tr>

            <td><p id="" class=""><i class="fas fa-users"></i> <?=$subscribesPublic['name_event']?></p></td>
            <td><?=$subscribesPublic['id_subscribe_public']?></td>

              <td class="text-center btn-estadoevento">
                  <a href="images/tickets/<?=$subscribesPublic['ticket_file']?>.pdf" target="_blank" class="btn btn-primary m-1 col-sm-12 col-md-12">Descargar entrada</a>
              </td>

            </tr>
        <? endforeach; ?>

<?
   }else{
     echo 'La información de la transacción o sesión no es válida';
   }

}
 ?>
