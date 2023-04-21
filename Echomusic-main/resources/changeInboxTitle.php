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

  $typeUser = mysqli_query($conn, "SELECT id_type_user as id_type_user FROM users WHERE id_user='$userid'");
  if($typeUser == 1){
    // Query events and Stuff
   $queryEvents = mysqli_query($conn, "SELECT * FROM events_private WHERE (id_user_sell='$userid' OR id_user_buy='$userid') AND date_event >=  '$date' AND date_event <= DATE_ADD('$date', INTERVAL 1 MONTH)  ORDER BY date_event ASC");
   $arrayEvents = array();
   while($events = mysqli_fetch_array($queryEvents)){
     $arrayEvents[] = $events;
   }
  }else if($typeUser == 2){
    // Query events and Stuff
   $queryEvents = mysqli_query($conn, "SELECT * FROM events_private WHERE id_user_buy='$userid' AND date_event >=  '$date' AND date_event <= DATE_ADD('$date', INTERVAL 1 MONTH)  ORDER BY date_event ASC");
   $arrayEvents = array();
   while($events = mysqli_fetch_array($queryEvents)){
     $arrayEvents[] = $events;
   }
  }

include 'functionDateTranslate.php';

if($typeUser == 1){
  // Print
  echo '<table>
    <thead>
      <tr>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Nombre</th>
          <th>Estado</th>
      </tr>
    </thead>';
  foreach($arrayEvents as $events){
    $time = date_create($events['date_event']);
    if($events['public_event'] == 'yes'){
      if($events['status_event'] == 'canceled'){
        echo '<tr>';
        echo '<td><strong>'; getDayday($time); echo '</strong></td>';
        echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" >'.$events['public_name_event'].'</a></td>';
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-times"> Cancelado</a></td>';
        echo '</tr>';
      }else{
        echo '<tr>';
        echo '<td><strong>'; getDayday($time); echo '</strong></td>';
        echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" >'.$events['public_name_event'].'</a></td>';
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-calendar-check"> Publicado</a></td>';
        echo '</tr>';
      }
    }else{
      echo '<tr>';
      echo '<td><strong>'; getDayday($time); echo '</strong></td>';
      echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';
      echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" >'.$events['name_event'].'</a></td>';
      switch($events['status_event']){
        case "reserved":
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-envelope"> Reservado</a></td>';
        break;
        case "pending":
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-ellipsis-h"> Pendiente</a></td>';
        break;
        case "confirmed":
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-check"> Confirmado</a></td>';
        break;
        case "canceled":
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-times"> Cancelado</a></td>';
        break;
      }
      echo '</tr>';

    }
  }
  echo '</table>';
}else if($typeUser == 2){
  // Print
  echo '<table>
    <thead>
      <tr>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Nombre</th>
          <th>Estado</th>
      </tr>
    </thead>';
  foreach($arrayEvents as $events){
    $time = date_create($events['date_event']);
    if($events['public_event'] == 'yes'){
      if($events['status_event'] == 'canceled'){
        echo '<tr>';
        echo '<td><strong>'; getDayday($time); echo '</strong></td>';
        echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" >'.$events['public_name_event'].'</a></td>';
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-times"> Cancelado</a></td>';
        echo '</tr>';
      }else{
        echo '<tr>';
        echo '<td><strong>'; getDayday($time); echo '</strong></td>';
        echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" >'.$events['public_name_event'].'</a></td>';
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-calendar-check"> Publicado</a></td>';
        echo '</tr>';
      }
    }else{
      echo '<tr>';
      echo '<td><strong>'; getDayday($time); echo '</strong></td>';
      echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';
      echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" >'.$events['name_event'].'</a></td>';
      switch($events['status_event']){
        case "reserved":
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-clock"> Reservado</a></td>';
        break;
        case "pending":
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-comments-dollar"> Pendiente</a></td>';
        break;
        case "confirmed":
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-check"> Confirmado</a></td>';
        break;
        case "canceled":
        echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-times"> Cancelado</a></td>';
        break;
      }
      echo '</tr>';
    }
  }
  echo '</table>';

}

}
?>
