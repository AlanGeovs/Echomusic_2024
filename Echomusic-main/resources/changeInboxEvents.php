<?php
include 'connect.php';
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
if(isset($_POST['month']) && !empty($_POST['month'])) {
  $month = $_POST['month'];
  $month = mysqli_real_escape_string($conn, $month);
  $year = $_POST['year'];
  $year = mysqli_real_escape_string($conn, $year);

  $date = $year.'-'.$month.'-01';
  $date = date_create($date);
  $date = DATE_FORMAT($date, 'Y-m-d');

  $userid = $_SESSION['user'];

  $typeUserQuery = mysqli_query($conn, "SELECT id_type_user as id_type_user FROM users WHERE id_user='$userid'");
  $typeUser = mysqli_fetch_array($typeUserQuery);
  $typeUser = $typeUser['id_type_user'];

  if($typeUser == 1){
    // Query events and Stuff
   $queryEvents = mysqli_query($conn, "SELECT * FROM events_private WHERE (id_user_sell='$userid' OR id_user_buy='$userid') AND date_event >=  '$date' AND date_event <= DATE_ADD('$date', INTERVAL 1 MONTH)  ORDER BY date_event ASC");
   $arrayEvents = array();
   while($events = mysqli_fetch_array($queryEvents)){
     $arrayEvents[] = $events;
   }

   // $arrayEventsMerged = array_merge($arrayEvents, $arrayEventsPublic, $arrayEventsStreaming);

  }else if($typeUser == 2){
    // Query events and Stuff
   $queryEvents = mysqli_query($conn, "SELECT * FROM events_private WHERE id_user_buy='$userid' AND date_event >=  '$date' AND date_event <= DATE_ADD('$date', INTERVAL 1 MONTH)  ORDER BY date_event ASC");
   $arrayEvents = array();
   while($events = mysqli_fetch_array($queryEvents)){
     $arrayEvents[] = $events;
   }
  }

include 'functionDateTranslate.php';

if($typeUser == 1){?>

  <? foreach($arrayEvents as $events): ?>
   <? $time = date_create($events['date_event']); ?>
      <tr>
      <th scope="row"> <?getDayday($time);?> </th>
      <td><?=DATE_FORMAT($time, 'H:i')?></td>
      <td><a  role="button" class="a-evento" onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()" ><?=$events['name_event']?></a></td>
      <? switch($events['status_event']): ?>
<? case "reserved": ?>
        <td class="text-center status-dot-reserved"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
        <? break; ?>
        <? case "pending": ?>
        <td class="text-center status-dot-pending"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
        <? break; ?>
        <? case "confirmed": ?>
        <td class="text-center status-dot-confirmed"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
        <? break; ?>
        <? case "canceled": ?>
        <td class="text-center status-dot-canceled"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
        <? break; ?>
      <? endswitch; ?>
      </tr>
  <? endforeach; ?>

<?}else if($typeUser == 2){?>
  
  <? foreach($arrayEvents as $events): ?>
   <? $time = date_create($events['date_event']); ?>
      <tr>
      <th scope="row"> <?getDayday($time);?> </th>
      <td><?=DATE_FORMAT($time, 'H:i')?></td>
      <td><a  role="button" class="a-evento" onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()" ><?=$events['name_event']?></a></td>
      <? switch($events['status_event']): ?>
<? case "reserved": ?>
        <td class="text-center status-dot-reserved"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
        <? break; ?>
        <? case "pending": ?>
        <td class="text-center status-dot-pending"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
        <? break; ?>
        <? case "confirmed": ?>
        <td class="text-center status-dot-confirmed"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
        <? break; ?>
        <? case "canceled": ?>
        <td class="text-center status-dot-canceled"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
        <? break; ?>
      <? endswitch; ?>
      </tr>
  <? endforeach; ?>
<?
}

}
?>
