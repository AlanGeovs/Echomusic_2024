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

   $queryEventsPublic = mysqli_query($conn, "SELECT * FROM events_public WHERE id_user='$userid' AND date_event >=  '$date' AND date_event <= DATE_ADD('$date', INTERVAL 1 MONTH)  ORDER BY date_event ASC");
   $arrayEventsPublic = array();
   while($eventsPublic = mysqli_fetch_array($queryEventsPublic)){
     $arrayEventsPublic[] = $eventsPublic;
   }

   $queryEventsStreaming = mysqli_query($conn, "SELECT * FROM events_streaming WHERE id_user='$userid' AND date_event >=  '$date' AND date_event <= DATE_ADD('$date', INTERVAL 1 MONTH)  ORDER BY date_event ASC");
   $arrayEventsStreaming = array();
   while($eventsStreaming = mysqli_fetch_array($queryEventsStreaming)){
     $arrayEventsStreaming[] = $eventsStreaming;
   }

   $arrayPublicEventsMerged = array_merge($arrayEventsPublic, $arrayEventsStreaming);

   // Sort events array by date
     usort($arrayPublicEventsMerged, function($a, $b) {
       $ad = new DateTime($a['date_event']);
       $bd = new DateTime($b['date_event']);

       if ($ad == $bd) {
         return 0;
       }

       return $ad < $bd ? -1 : 1;
     });

  }else if($typeUser == 2){
    // Query events and Stuff
   $queryEventsPublic = mysqli_query($conn, "SELECT * FROM events_public WHERE id_user='$userid' AND date_event >=  '$date' AND date_event <= DATE_ADD('$date', INTERVAL 1 MONTH)  ORDER BY date_event ASC");
   $arrayEventsPublic = array();
   while($eventsPublic = mysqli_fetch_array($queryEventsPublic)){
     $arrayEventsPublic[] = $eventsPublic;
   }

   $queryEventsStreaming = mysqli_query($conn, "SELECT * FROM events_streaming WHERE id_user='$userid' AND date_event >=  '$date' AND date_event <= DATE_ADD('$date', INTERVAL 1 MONTH)  ORDER BY date_event ASC");
   $arrayEventsStreaming = array();
   while($eventsStreaming = mysqli_fetch_array($queryEventsStreaming)){
     $arrayEventsStreaming[] = $eventsStreaming;
   }

   $arrayPublicEventsMerged = array_merge($arrayEventsPublic, $arrayEventsStreaming);

   // Sort events array by date
     usort($arrayPublicEventsMerged, function($a, $b) {
       $ad = new DateTime($a['date_event']);
       $bd = new DateTime($b['date_event']);

       if ($ad == $bd) {
         return 0;
       }

       return $ad < $bd ? -1 : 1;
     });

  }

include 'functionDateTranslate.php';

$timeNow = date('Y-m-d H:i:s', time());

if($typeUser == 1){?>

  <? foreach($arrayPublicEventsMerged as $publicEventsMerged): ?>
   <? $time = date_create($publicEventsMerged['date_event']); ?>
      <tr>
      <th scope="row"> <?getDayday($time);?> </th>
      <td><?=DATE_FORMAT($time, 'H:i')?></td>
      <td><a  role="button" id="" class="a-evento status-dot-confirmed" onClick="getPublicEvents(<?=$publicEventsMerged['id_event']?>,<?=$publicEventsMerged['id_type_event']?>); showDetailPublic()"><?=($publicEventsMerged['id_type_event']=='4') ? '<i class="fas fa-wifi"></i>' : '<i class="fas fa-users"></i>'?> <?=$publicEventsMerged['name_event']?></a></td>
      <td><button  role="button" id="" class="btn btn-outline-secondary m-1" onClick="getPublicEvents(<?=$publicEventsMerged['id_event']?>,<?=$publicEventsMerged['id_type_event']?>); showDetailPublic()">Ver</button></td>
      <? switch($publicEventsMerged['active_event']): ?>
<? case "0": ?>
        <td class="text-center btn-estadoevento row">
          <? if($publicEventsMerged['date_event']>$timeNow): ?>
            <button id="cancelEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" onClick="cancelEventId(<?=$publicEventsMerged['id_event']?>, <?=$publicEventsMerged['id_type_event']?>)" data-toggle="modal" data-target="#cancelEventModal" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5">Cancelar</button>
            <button id="publishEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" onClick="publishEventId(<?=$publicEventsMerged['id_event']?>, <?=$publicEventsMerged['id_type_event']?>)" data-toggle="modal" data-target="#publishEventModal" class="btn btn-primary m-1 col-sm-12 col-md-5">Publicar</button>
          <? elseif($publicEventsMerged['date_event']<$timeNow): ?>
            <a class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelar</a>
            <a class="btn btn-primary m-1 col-sm-12 col-md-5 isDisabled">Publicar</a>
          <? endif; ?>
        </td>
        <? break; ?>
        <? case "1": ?>
        <td class="text-center btn-estadoevento row">
          <? if($publicEventsMerged['date_event']>$timeNow): ?>
            <button id="cancelEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" onClick="cancelEventId(<?=$publicEventsMerged['id_event']?>, <?=$publicEventsMerged['id_type_event']?>)" data-toggle="modal" data-target="#cancelEventModal" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5">Cancelar</button>
          <? elseif($publicEventsMerged['date_event']<$timeNow): ?>
            <a class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelar</a>
          <? endif; ?>
          <button id="publishedEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Publicado</button>
        </td>
        <? break; ?>
        <? case "2": ?>
          <td class="text-center btn-estadoevento row">
            <button class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelado</button>
          </td>
        <? break; ?>
      <? endswitch; ?>
      </tr>
  <? endforeach; ?>

<?}else if($typeUser == 2){?>

  <? foreach($arrayPublicEventsMerged as $publicEventsMerged): ?>
   <? $time = date_create($publicEventsMerged['date_event']); ?>
      <tr>
      <th scope="row"> <?getDayday($time);?> </th>
      <td><?=DATE_FORMAT($time, 'H:i')?></td>
      <td><a  role="button" id="" class="a-evento status-dot-confirmed" onClick="getPublicEvents(<?=$publicEventsMerged['id_event']?>,<?=$publicEventsMerged['id_type_event']?>); showDetailPublic()"><?=($publicEventsMerged['id_type_event']=='4') ? '<i class="fas fa-wifi"></i>' : '<i class="fas fa-users"></i>'?> <?=$publicEventsMerged['name_event']?></a></td>
      <td><button  role="button" id="" class="btn btn-outline-secondary m-1" onClick="getPublicEvents(<?=$publicEventsMerged['id_event']?>,<?=$publicEventsMerged['id_type_event']?>); showDetailPublic()">Ver</button></td>
      <? switch($publicEventsMerged['active_event']): ?>
<? case "0": ?>
        <td class="text-center btn-estadoevento row">
          <? if($publicEventsMerged['date_event']>$timeNow): ?>
            <button id="cancelEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" onClick="cancelEventId(<?=$publicEventsMerged['id_event']?>, <?=$publicEventsMerged['id_type_event']?>)" data-toggle="modal" data-target="#cancelEventModal" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5">Cancelar</button>
            <button id="publishEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" onClick="publishEventId(<?=$publicEventsMerged['id_event']?>, <?=$publicEventsMerged['id_type_event']?>)" data-toggle="modal" data-target="#publishEventModal" class="btn btn-primary m-1 col-sm-12 col-md-5">Publicar</button>
          <? elseif($publicEventsMerged['date_event']<$timeNow): ?>
            <a class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelar</a>
            <a class="btn btn-primary m-1 col-sm-12 col-md-5 isDisabled">Publicar</a>
          <? endif; ?>
        </td>
        <? break; ?>
        <? case "1": ?>
        <td class="text-center btn-estadoevento row">
          <? if($publicEventsMerged['date_event']>$timeNow): ?>
            <button id="cancelEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" onClick="cancelEventId(<?=$publicEventsMerged['id_event']?>, <?=$publicEventsMerged['id_type_event']?>)" data-toggle="modal" data-target="#cancelEventModal" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5">Cancelar</button>
          <? elseif($publicEventsMerged['date_event']<$timeNow): ?>
            <a class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelar</a>
          <? endif; ?>
          <button id="publishedEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Publicado</button>
        </td>
        <? break; ?>
        <? case "2": ?>
          <td class="text-center btn-estadoevento row">
            <button class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelado</button>
          </td>
        <? break; ?>
      <? endswitch; ?>
      </tr>
  <? endforeach; ?>

<?
}

}
?>
