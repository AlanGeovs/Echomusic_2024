<?php
include 'connect.php';
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
if(isset($_POST['id']) && !empty($_POST['id'])) {
  if(isset($_SESSION['user'])){
    $userid = $_SESSION['user'];

    if($id = FILTER_INPUT(INPUT_POST, 'id', FILTER_VALIDATE_INT, 1)){
      $id = mysqli_real_escape_string($conn, $id);
    }else{
      header('HTTP/1.1 403 Forbidden');
      die();
    }

    if(empty($_POST['type'])){
      $typeEvent = '1';
    }else if($typeEvent = FILTER_INPUT(INPUT_POST, 'type', FILTER_VALIDATE_INT, 1)){
      $typeEvent = mysqli_real_escape_string($conn, $typeEvent);
    }else{
      header('HTTP/1.1 403 Forbidden');
      die();
    }

  // Switch type event

  switch($typeEvent){
    case '1':
    // Get Private Events
      $queryEvents = mysqli_query($conn,"SELECT * FROM events_private LEFT JOIN users ON events_private.id_user_sell = users.id_user
                                                               LEFT JOIN cities ON events_private.id_city = cities.id_city
                                                               LEFT JOIN plans ON events_private.id_plan = plans.id_plan
                                                               LEFT JOIN name_plan ON events_private.id_name_plan = name_plan.id_name_plan WHERE id_event='$id' AND id_user_buy='$userid'");
      $data = array();

      $events = mysqli_fetch_array($queryEvents);
      $artistId = $events['id_user_sell'];
      $queryArtistData = mysqli_query($conn, "SELECT * FROM users LEFT JOIN genre_user ON users.id_user = genre_user.id_user
                                                                  LEFT JOIN genres ON genre_user.id_genre = genres.id_genre
                                                                  LEFT JOIN regions ON regions.id_region = users.id_region WHERE users.id_user='$artistId'");

      $artistData = mysqli_fetch_array($queryArtistData);

      $queryRatings = mysqli_query($conn, "SELECT * FROM user_ratings LEFT JOIN users ON user_ratings.id_user = users.id_user WHERE id_artist='$artistId' AND status_rating='closed' ORDER BY date_rating DESC");
      $rateArray = array();
      while($ratingArray = mysqli_fetch_array($queryRatings)){
        $rateArray[] = $ratingArray;
      }
    break;
    case '2':
      // Get Public Events
      $queryEvents = mysqli_query($conn, "SELECT * FROM events_public LEFT JOIN cities ON events_public.id_city = cities.id_city
                                                                      LEFT JOIN regions ON events_public.id_region = regions.id_region WHERE id_event='$id' AND id_user='$userid'");
      $events = mysqli_fetch_array($queryEvents);
    break;
    case '3':
      // Get Linked Events
      $queryEvents = mysqli_query($conn,"SELECT * FROM events_private LEFT JOIN users AS user_sell ON events_private.id_user_sell = user_sell.id_user
                                                                      LEFT JOIN users AS user_buy ON events_private.id_user_buy = user_buy.id_user
                                                                      LEFT JOIN cities ON events_private.id_city = cities.id_city
                                                                      LEFT JOIN plans ON events_private.id_plan = plans.id_plan
                                                                      LEFT JOIN name_plan ON events_private.id_name_plan = name_plan.id_name_plan
                                                                      LEFT JOIN events_linked ON events_linked.id_event_private = events_private.id_event WHERE events_linked.id_event='$id' AND events_private.id_user_buy='$userid'");
      $events = mysqli_fetch_array($queryEvents);

      $artistId = $events['id_user_sell'];

      $queryArtistData = mysqli_query($conn, "SELECT * FROM users LEFT JOIN genre_user ON users.id_user = genre_user.id_user
                                                                  LEFT JOIN genres ON genre_user.id_genre = genres.id_genre
                                                                  LEFT JOIN regions ON regions.id_region = users.id_region WHERE users.id_user='$artistId'");

      $artistData = mysqli_fetch_array($queryArtistData);

      $queryRatings = mysqli_query($conn, "SELECT * FROM user_ratings LEFT JOIN users ON user_ratings.id_user = users.id_user WHERE id_artist='$artistId' AND status_rating='closed' ORDER BY date_rating DESC");
      $rateArray = array();
      while($ratingArray = mysqli_fetch_array($queryRatings)){
        $rateArray[] = $ratingArray;
      }
    break;
    case '4':
      // Get Streaming Events
      $queryEvents = mysqli_query($conn, "SELECT * FROM events_streaming LEFT JOIN streaming_platform ON events_streaming.id_streaming_platform = streaming_platform.id_streaming_platform WHERE events_streaming.id_event='$id' AND id_user='$userid'");
      $events = mysqli_fetch_array($queryEvents);
    break;
  }



// Function rating display
  function displayTotalRating($rateArray){
    $y = 0;
    foreach($rateArray as $values){
      $count += count($values['number_rating']);
      $z = $values['number_rating'];
      $y = $y + $z;
    }
    $totalRating = $y / $count;
    $totalRating = round($totalRating, 1);
    if(is_nan($totalRating)){
      $totalRating = "Sin valoraciones";
    }
    return $totalRating;
  }

// Switch status
  switch($events['status_event']){
    case "reserved":
      $statusEvent = 'Reservado';
    break;
    case "pending":
      $statusEvent = 'Pendiente por pagar';
    break;
    case "confirmed":
    if($events['public_event'] == 'yes'){
      $statusEvent = 'Publicado';
    }else{
      $statusEvent = 'Confirmado';
    }
    break;
    case "canceled":
      $statusEvent = 'Cancelado';
    break;
  }

  // Date and Time
  $date = date_create($events['date_event']);
  $timeNow = date('Y-m-d H:i:s');
  $time = DATE_FORMAT($date, 'H:i');

include 'functionDateTranslate.php';

// Display events Test
switch($typeEvent){
  // Private events
  case'1': ?>
    <div id="return-eventostream1" class="col-md-9 return-tablaeventos">
      <a ><i class="fas fa-caret-left"></i> <?=$events['name_event']?></a>
    </div>
    <div class="col-md-9 table-responsive">
      <table id="tableresponsive-event" class="table">
        <tbody>
          <tr class="tr-responsive">
            <th scope="row">Artista</th>
            <td><?=$artistData['nick_user']?></td>
          </tr>
          <tr class="tr-responsive">
            <th scope="row">Dirección</th>
            <td><?=ucfirst($events['location'])?>, <?=ucfirst($events['name_city'])?></td>
          </tr>
          <tr class="tr-responsive">
            <th scope="row">Fecha</th>
            <td><?=getDayday($date)?> de <?=getMonthYear($date)?> <b class="mx-4">Hora</b><?=$time?> hrs</td>
          </tr>
          <tr class="tr-responsive">
            <th scope="row">Valores</th>
            <td>Plan: $<?=number_format($events['value_plan_event'] , 0, ',', '.')?> / Servicio: $<?=number_format($events['commission_plan_event'] , 0, ',', '.')?> / Total: $<?=number_format($events['value_plan_event']+$events['commission_plan_event'] , 0, ',', '.')?></td>
          </tr>
          <tr class="tr-responsive">
            <th scope="row">Estado</th>
            <td class=""><i class="fas fa-circle status-dot-<?=$events['status_event']?>"></i> <?=$statusEvent?></td>
          </tr>
          <tr class="tr-responsive">
            <th scope="row">Descripción</th>
            <td><p><?=$events['desc_event']?></p></td>
          </tr>
          <tr class="tr-responsive">
            <th scope="row"></th>
            <td class="px-1 text-center detalleeventos-btn">
              <? switch($events['status_event']):?><?case "reserved": ?>
                  <form action="" method="post">
                      <input type="hidden" value="<?=$events['id_event']?>" name="id_event" />
                      <? if($events['date_event']>$timeNow): ?>
                        <button onClick="writeCancelValue(<?=$events['id_event']?>)" class="btn btn-outline-secondary m-2">Cancelar Evento</button>
                        <a class="btn btn-outline-secondary m-2" href="https://echomusic.cl/edit_event.php?eventid=<?=$events['id_event']?>">Editar</a>
                      <? elseif($events['date_event']<$timeNow): ?>
                        <a class="btn btn-outline-secondary m-2 isDisabled">Cancelar Evento</a>
                        <a class="btn btn-outline-secondary m-2 isDisabled">Editar</a>
                      <? endif; ?>
                      <a class="btn btn-outline-secondary m-2 text-orange" onClick="showList()">Volver</a>
                  </form>
                <? break; ?>
                <? case "pending": ?>
                  <form action="" method="post">
                      <input type="hidden" value="<?=$events['id_event']?>" name="id_event" />
                      <? if($events['date_event']>$timeNow): ?>
                        <a href="ticket_buy.php?private=<?=$events['id_event']?>" class="btn btn-primary m-2" value="Proceder al pago" name="pay_event">Proceder al pago</a>
                        <a class="btn btn-outline-secondary m-2" href="https://echomusic.cl/edit_event.php?eventid=<?=$events['id_event']?>">Editar</a>
                        <button onClick="writeCancelValue(<?=$events['id_event']?>)" class="btn btn-outline-secondary m-2">Cancelar Evento</button>
                      <? elseif($events['date_event']<$timeNow): ?>
                        <a class="btn btn-primary m-2 isDisabled">Proceder al pago</a>
                        <a class="btn btn-outline-secondary m-2 isDisabled">Editar</a>
                        <a class="btn btn-outline-secondary m-2 isDisabled">Cancelar Evento</a>
                      <? endif; ?>
                      <a onClick="showList()"class="btn btn-outline-secondary m-2 text-orange">Volver</a>
                  </form>
                <? break; ?>
                <? case "confirmed": ?>
                  <form action="" method="post">
                      <input type="hidden" value="<?=$events['id_event']?>" name="id_event" />
                      <? if($events['date_event']>$timeNow): ?>
                        <input name="publish_event" class="btn btn-primary m-2 isDisabled" value="Publicar en Cartelera"/>
                        <button onClick="writeCancelValue(<?=$events['id_event']?>)" class="btn btn-outline-secondary m-2">Cancelar Evento</button>
                      <? elseif($events['date_event']<$timeNow): ?>
                        <a class="btn btn-primary m-2 isDisabled">Publicar en Cartelera</a>
                        <a class="btn btn-outline-secondary m-2 isDisabled">Cancelar Evento</a>
                      <? endif; ?>
                      <a onClick="showList()" class="btn btn-outline-secondary m-2 text-orange">Volver</a>
                  </form>
                <? break; ?>
                <? case "canceled": ?>
                    <a onClick="showList()" class="btn btn-outline-secondary m-2 text-orange">Volver</a>
                <? break; ?>
              <? endswitch; ?>
              <!-- <button type="submit" class="btn btn-outline-secondary m-2">Editar </button>
              <button type="submit" class="btn btn-outline-secondary m-2" data-toggle="modal" data-target="#configEventroStreamModalLabel">Configurar</button>
              <button id="" type="submit" class="btn btn-primary m-1"  data-toggle="modal" data-target="#estadisticaStreamModalLabel">Estadisticas</button>
              <button id="return-v-eventostream1" type="submit" class="btn btn-primary  m-2">Volver</button> -->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  <? break; ?>
  <!-- // Public events -->
  <? case'2':?>

    <div id="return-eventostream1" class="col-md-9 return-tablaeventos">
      <a onClick="showListPublic()"><i class="fas fa-caret-left"></i> <?=$events['name_event']?></a>
    </div>
    <div class="col-md-9 table-responsive">

      <table id="tableresponsive-event" class="table">

        <tbody>
          <tr class="tr-responsive">

            <th scope="row"><?=$events['name_location']?></th>
            <td><?=$events['location']?> | <?=$events['name_city']?>, Región: <?=$events['name_region']?></td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row">Fecha</th>
            <td><?=getDayday($date)?> de <?=getMonthYear($date)?> <b class="mx-4">Hora</b><?=$time?> hrs</td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row">Plan de visibilidad</th>
            <td>BASICO <b class="mx-4">Estado</b><i class="fas fa-circle"></i> <?=($events['active_event']=='1') ? "Publicado" : "No publicado"?></td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row">Tipo de evento</th>
            <td class="status-dot-confirmed"><i class="fas fa-users"></i> Presencial</td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row">Código de acceso APP</th>
            <td class=""> <?=$events['verifier_event']?></td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row">Descripción</th>
            <td><?=$events['desc_event']?></td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row"></th>
            <td class="px-1 text-center detalleeventos-btn">
              <input type="hidden" value="<?=$events['id_event']?>" id="statsPublicId">
              <? if($events['date_event']>$timeNow): ?>
                <a href="https://echomusic.cl/edit_event.php?publicid=<?=$events['id_event']?>" class="btn btn-outline-secondary m-2">Editar </a>
              <? elseif($events['date_event']<$timeNow): ?>
                <a class="btn btn-outline-secondary m-2 isDisabled">Editar </a>
              <? endif; ?>
              <a href="https://echomusic.cl/event.php?public=<?=$events['id_event']?>" class="btn btn-outline-secondary m-2" >Ver publicación</a>
              <? if($events['active_event']=='1'): ?>
                <a href="#" class="btn btn-outline-secondary m-2" data-toggle="modal" data-target="#InvitacionesModalLabel">Invitaciones</a>
              <? else: ?>
                <a class="btn btn-outline-secondary m-2 isDisabled">Invitaciones</a>
              <? endif; ?>
              <button id="" type="submit" class="btn btn-primary m-1"  data-toggle="modal" data-target="#estadisticaStreamModalLabel" onClick="showPublicStats()">Estadísticas</button>
              <button id="return-v-eventostream1" onClick="showListPublic()" class="btn btn-primary  m-2">Volver</button>
            </td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row">Compartir</th>
              <td>
              <div id="compartirEventroStream" class="container">
              <? switch($events['active_event']):case '1': ?>
                <div class="row my-1 text-center text-white">
                  <ul class="list-inline mb-0">
                    <li class="list-inline-item list-fb"><a href="https://www.facebook.com/sharer.php?u=https://echomusic.cl/event.php?public=<?=$events['id_event']?>" target="_blank"><i class="fab fa-facebook-f share-fb"></i> </a></li>
                    <li class="list-inline-item list-tw"><a href="https://twitter.com/share?url=https://echomusic.cl/event.php?public=<?=$events['id_event']?>&amp;text=EchoMusic&amp;hashtags=echomusic" target="_blank"><i class="fab fa-twitter share-tw"></i> </a></li>
                    <li class="list-inline-item list-wpp"><a href="https://api.whatsapp.com/send?text=https://echomusic.cl/event.php?public=<?=$events['id_event']?>" data-action="share/whatsapp/share" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp share-wpp"></i> </a></li>
                  </ul>
                </div>
            <? break; ?>
            <? case '0': ?>
              <div class="row my-1 text-center">
                <p>El evento debe estar publicado para poder ser compartido</p>
              </div>
              <? break; ?>
              <? case '2': ?>
                <div class="row my-1 text-center">
                  <p>El evento ha sido cancelado y no puede ser compartido</p>
                </div>
              <? break; ?>
            <? endswitch;?>
            </div>
          </td>

          </tr>

        </tbody>

      </table>

    </div>

  <? break;?>
  <!-- // Linked events -->
  <? case'3': ?>
    <!-- echo
    '<h3 class="major" id="event_name">'.$events['name_event'].'</h3>
    <div style="width: 48%; float:left;">
    <ul class="alt">
      <li id="event_artist"><strong>Artista: </strong>'.$artistData['nick_user'].'</li>
      <li id="event_location"><strong>Dirección: </strong>'.ucfirst($events['location']).', '.$events['name_city'].'</li>
      <li id="event_date"><strong>Fecha: </strong>';echo getDayday($date).' de '; echo getMonthYear($date); echo '</li>
      <li><strong>Hora: </strong>'.$time.'</li>
      <li><strong>Valor: </strong>$'.number_format($events['value_plan_event'] , 0, ',', '.').'</li>
      <li><strong>Costo por Servicio: </strong>$'.number_format($events['commission_plan_event'] , 0, ',', '.').'</li>
      <li><strong>Total: </strong>$'.number_format($events['value_plan_event']+$events['commission_plan_event'] , 0, ',', '.').'</li>
      <li id="event_status"><strong>Estado: </strong>'.$statusEvent.'</li>
      <li id="event_desc desc_pre-wrap"><strong>Descripción: </strong>'.$events['desc_event'].'</li>
    </ul>
    </div>
    <article class="artist-card-event col-6 col-12-xsmall">
      <a class="image left" href="#">
        <img src="images/avatars/'.$artistId.'.jpg"/>
      </a>
      <div class="">
        <ul class="alt">
        <li class="desc_pre-wrap"><strong>Artista: </strong>'.$artistData['nick_user'].'</li>
        <li class="desc_pre-wrap"><strong>Género: </strong>'.$artistData['name_genre'].'</li>
        <li class="desc_pre-wrap"><strong>Ubicación: </strong>'.$artistData['name_region'].'</li>
        <li class="desc_pre-wrap"><strong>Valoración: </strong>'.displayTotalRating($rateArray).'</li>
        </ul>
      </div>
    </article>
    <form method="POST" action="" style="clear:left;">
      <ul class="actions">
        <input type="hidden" value="'.$events['id_event'].'" name="id_event" />
        <li><a class="button primary" href="https://echomusic.cl/event.php?eventid='.$events['id_event'].'">Ir a la publicación</a></li>
        <li><a onClick="writeCancelValue('.$events['id_event'].')" href="#cancel_event" class="button" name="cancel_event">Cancelar Evento</a> </li>
        <li><a onClick="showList()" class="button">volver</a></li>
      </ul>
    </form>'; -->
  <? break; ?>

  <!-- // Streaming Events -->
  <? case '4': ?>
    <div id="return-eventostream1" class="col-md-9 return-tablaeventos">
      <a onClick="showListPublic()"><i class="fas fa-caret-left"></i> <?=$events['name_event']?></a>
    </div>
    <div class="col-md-9 table-responsive">

      <table id="tableresponsive-event" class="table">

        <tbody>

          <tr class="tr-responsive">

            <th scope="row">Fecha</th>
            <td><?=getDayday($date)?> de <?=getMonthYear($date)?> <b class="mx-4">Hora</b><?=$time?> hrs</td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row">Plan de visibilidad</th>
            <td>BÁSICO  <b class="mx-4">Estado</b><i class="fas fa-circle"></i> <?=($events['active_event']=='1') ? "Publicado" : "No publicado"?></td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row">Tipo de evento</th>
            <td class="status-dot-confirmed"><i class="fas fa-wifi"></i> Streaming</td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row">Descripción</th>
            <td><?=$events['desc_event']?></td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row"></th>
            <td class="px-1 text-center detalleeventos-btn">
              <input type="hidden" value="<?=$events['id_event']?>" id="statsStreamingId">
              <? if($events['date_event']>$timeNow): ?>
                <? if($events['active_event']=='0'): ?>
                  <a href="https://echomusic.cl/edit_event.php?streamingid=<?=$events['id_event']?>" class="btn btn-outline-secondary m-2">Editar </a>
                <? else: ?>
                  <a class="btn btn-outline-secondary m-2 isDisabled">Editar </a>
                <? endif; ?>
                <button type="submit" class="btn btn-outline-secondary m-2" data-toggle="modal" data-target="#configEventroStreamModalLabel">Configurar</button>
              <? elseif($events['date_event']<$timeNow): ?>
                <a class="btn btn-outline-secondary m-2 isDisabled">Editar </a>
                <button type="submit" class="btn btn-outline-secondary m-2" data-toggle="modal" data-target="#configEventroStreamModalLabel">Configurar</button>
              <? endif; ?>
              <button id="" type="submit" class="btn btn-primary m-1"  data-toggle="modal" data-target="#estadisticaStreamModalLabel" onClick="showStreamStats()">Estadísticas</button>
              <button id="return-v-eventostream1" onClick="showListPublic()" class="btn btn-primary  m-2">Volver</button>
            </td>

          </tr>
          <tr class="tr-responsive">

            <th scope="row">Compartir</th>
              <td>
                <div id="compartirEventroStream" class="container">
                  <? switch($events['active_event']):case '1': ?>
                  <div class="row my-1 text-center text-white">
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item list-fb"><a href="https://www.facebook.com/sharer.php?u=https://echomusic.cl/event.php?streaming=<?=$events['id_event']?>" target="_blank"><i class="fab fa-facebook-f share-fb"></i> </a></li>
                      <li class="list-inline-item list-tw"><a href="https://twitter.com/share?url=https://echomusic.cl/event.php?streaming=<?=$events['id_event']?>&amp;text=Echomusic&amp;hashtags=echomusic" target="_blank"><i class="fab fa-twitter share-tw"></i> </a></li>
                      <li class="list-inline-item list-wpp"><a href="https://api.whatsapp.com/send?text=https://echomusic.cl/event.php?streaming=<?=$events['id_event']?>" data-action="share/whatsapp/share" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp share-wpp"></i> </a></li>
                    </ul>
                  </div>
                <? break; ?>
                <? case '0': ?>
                  <div class="row my-1 text-center">
                    <p>El evento debe estar publicado para poder ser compartido</p>
                  </div>
                <? break; ?>
                <? case '2': ?>
                  <div class="row my-1 text-center">
                    <p>El evento ha sido cancelado y no puede ser compartido</p>
                  </div>
                <? break; ?>
                <? endswitch;?>
                </div>
              </td>

          </tr>

        </tbody>

      </table>

    </div>
  <? break; ?>
<?
}

  }
}
?>
