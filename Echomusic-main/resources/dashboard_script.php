<?php



include 'connect.php';
include 'eventoAceptadoMail.php';
include 'eventoRechazadoMail.php';
include 'eventoModificadoMail.php';
include 'eventoCanceladoMail.php';
include 'eventoConfirmadoMail.php';
include 'eventoPublicadoMail.php';

include 'suscripTicketMail.php';
include 'ticketPresencialMail.php';
include 'compraTicketMail.php';
include 'ticketMailPdf.php';
require './vendor/autoload.php';
include './phpqrcode/qrlib.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

  // Check RUT function
     function valida_rut($rut)
     {
         if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
             return false;
         }
         $rut = preg_replace('/[\.\-]/i', '', $rut);
         $dv = substr($rut, -1);
         $numero = substr($rut, 0, strlen($rut) - 1);
         $i = 2;
         $suma = 0;
         foreach (array_reverse(str_split($numero)) as $v) {
             if ($i == 8)
                 $i = 2;
             $suma += $v * $i;
             ++$i;
         }
         $dvr = 11 - ($suma % 11);
         if ($dvr == 11)
             $dvr = 0;
         if ($dvr == 10)
             $dvr = 'K';
         if ($dvr == strtoupper($dv))
             return true;
         else
             return false;
     }

  // Random str function
     function random_str(
         int $length = 64,
         string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
     ): string {
         if ($length < 1) {
             throw new \RangeException("Length must be a positive integer");
         }
         $pieces = [];
         $max = mb_strlen($keyspace, '8bit') - 1;
         for ($i = 0; $i < $length; ++$i) {
             $pieces []= $keyspace[random_int(0, $max)];
         }
         return implode('', $pieces);
     }

// Login Check

if(isset($_SESSION['user'])){

  $error = FALSE;

  $userid = $_SESSION['user'];



  // Queries and fetch data user

  $queryInfo = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$userid'");

  $userInfo_array = mysqli_fetch_array($queryInfo);

  if($userInfo_array['first_login'] == 'yes'){
    header('Location: first_login.php');
    die();
  }

  $queryProfile = mysqli_query($conn, "SELECT * FROM users LEFT JOIN desc_user ON users.id_user = desc_user.id_user

                                                           LEFT JOIN type_musician ON users.id_musician = type_musician.id_musician

                                                           LEFT JOIN instruments ON users.id_instrument = instruments.id_instrument

                                                           LEFT JOIN regions ON users.id_region = regions.id_region

                                                           LEFT JOIN cities ON users.id_city = cities.id_city

                                                           LEFT JOIN user_social_data ON users.id_user = user_social_data.id_user

                                                           LEFT JOIN social_genres ON user_social_data.genre_data = social_genres.id_soc_genre WHERE users.id_user='$userid'");

  $userProfile_array = mysqli_fetch_array($queryProfile);



  if($userProfile_array['genre_data']=='0' || empty($userProfile_array['genre_data'])){

    $userProfile_array['soc_genre_name'] = 'No especificado';

  }



  if($userProfile_array['age_data']=='0' || empty($userProfile_array['age_data'])){

    $userProfile_array['age_data'] = 'No especificada';

    $userProfileAgeValue = '';

  }else{

    $userProfileAgeValue = $userProfile_array['age_data'];

  }



// get genre

  $queryGenre = mysqli_query($conn, "SELECT * FROM genre_user LEFT JOIN genres ON genre_user.id_genre = genres.id_genre WHERE genre_user.id_user='$userid'");

  $userGenre_array = mysqli_fetch_array($queryGenre);

  $user_idGenre = $userGenre_array['id_genre'];



// get sub genres

  $querySubGenre = mysqli_query($conn, "SELECT * FROM subGenres_user LEFT JOIN sub_genres ON subGenres_user.id_subGenre = sub_genres.id_subGenre WHERE subGenres_user.id_user='$userid'");

  $userSubGenresArray = array();

  while($userSubGenre_array = mysqli_fetch_array($querySubGenre)){

    $userSubGenresArray[] = $userSubGenre_array;

  }



// get multimedia

  $queryMultimedia = mysqli_query($conn, "SELECT * FROM multimedia WHERE id_user='$userid'");

  $multiArray = array();

  while($multimediaArray = mysqli_fetch_array($queryMultimedia)){

    $multiArray[] = $multimediaArray;

  }

  // get data bank

  $queryUserData = mysqli_query($conn, "SELECT * FROM user_data LEFT JOIN banks ON user_data.id_bank = banks.id_bank

                                                                LEFT JOIN type_accounts ON user_data.id_type_account = type_accounts.id_type_account WHERE id_user='$userid'");

  $userData_array = mysqli_fetch_array($queryUserData);



// Get Prices

  $queryPlans = mysqli_query($conn, "SELECT * from plans LEFT JOIN type_reinforcements id1 on plans.backline = id1.id_type_reinforcement

                                                         LEFT JOIN type_reinforcements id2 on plans.sound_engineer = id2.id_type_reinforcement

                                                         LEFT JOIN type_reinforcements id3 on plans.sound_reinforcement = id3.id_type_reinforcement

                                                         LEFT JOIN name_plan ON plans.id_name_plan = name_plan.id_name_plan WHERE plans.id_user='$userid' ORDER BY slot_plan ASC");

  $planArray = array();

  while($pricingArray = mysqli_fetch_array($queryPlans)){

    $planArray[] = $pricingArray;

  }



// Get Plans

  $queryPlanName = mysqli_query($conn, "SELECT * FROM name_plan");

  $arrayPlanName = array();

  while($planName = mysqli_fetch_array($queryPlanName)){

    $arrayPlanName[] = $planName;

  }

// Query regions

$queryRegionsInfo = mysqli_query($conn, "SELECT * FROM regions");

$arrayRegions = array();

while($regions = mysqli_fetch_array($queryRegionsInfo)){

      $arrayRegions[] = $regions;

    }



// Query type_reinforcement

$queryTypeReinforcementInfo = mysqli_query($conn, "SELECT * FROM type_reinforcements");

$arrayTypeReinforcement = array();

while($typeReinforcement = mysqli_fetch_array($queryTypeReinforcementInfo)){

      $arrayTypeReinforcement[] = $typeReinforcement;

    }



// Query follow artists

$queryArtistsFollow = mysqli_query($conn, "SELECT * FROM follow_users LEFT JOIN users ON follow_users.id_artist = users.id_user WHERE follow_users.id_user='$userid'");

$arrayArtistsFollow = array();

while($artistsFollow = mysqli_fetch_array($queryArtistsFollow)){

      $arrayArtistsFollow[] = $artistsFollow;

    }



// Query follow genres

$queryGenresFollow = mysqli_query($conn, "SELECT * FROM follow_genres LEFT JOIN genres ON follow_genres.id_genre = genres.id_genre WHERE id_user='$userid' AND follow_genres.id_genre!='0'");

$arrayGenresFollow = array();

while($genresFollow = mysqli_fetch_array($queryGenresFollow)){

    $arrayGenresFollow[] = $genresFollow;

  }





// Get Events

if($userProfile_array['id_type_user'] == '1'){

// Query events Artists

  $queryEvents = mysqli_query($conn, "SELECT * FROM events_private WHERE (id_user_sell='$userid' OR id_user_buy='$userid') AND date_event >=  DATE_FORMAT(NOW() ,'%Y-%m-01') AND date_event <= DATE_ADD(DATE_FORMAT(NOW() ,'%Y-%m-01'), INTERVAL 1 MONTH)  ORDER BY date_event ASC");

  $arrayEvents = array();

  while($events = mysqli_fetch_array($queryEvents)){

    $arrayEvents[] = $events;

  }



  $queryEventsPublic = mysqli_query($conn, "SELECT * FROM events_public WHERE id_user='$userid' AND date_event >=  DATE_FORMAT(NOW() ,'%Y-%m-01') AND date_event <= DATE_ADD(DATE_FORMAT(NOW() ,'%Y-%m-01'), INTERVAL 1 MONTH)  ORDER BY date_event ASC");

  $arrayEventsPublic = array();

  while($eventsPublic = mysqli_fetch_array($queryEventsPublic)){

    $arrayEventsPublic[] = $eventsPublic;

  }



  $queryEventsStreaming = mysqli_query($conn, "SELECT * FROM events_streaming WHERE id_user='$userid' AND date_event >=  DATE_FORMAT(NOW() ,'%Y-%m-01') AND date_event <= DATE_ADD(DATE_FORMAT(NOW() ,'%Y-%m-01'), INTERVAL 1 MONTH)  ORDER BY date_event ASC");

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



  $queryEventsNextMonth = mysqli_query($conn, "SELECT * FROM events_private WHERE (id_user_sell='$userid' OR id_user_buy='$userid') AND date_event >=  DATE_ADD(DATE_FORMAT(NOW() ,'%Y-%m-01'), INTERVAL 1 MONTH) AND date_event <= DATE_ADD(DATE_FORMAT(NOW() ,'%Y-%m-01'), INTERVAL 2 MONTH)  ORDER BY date_event ASC");

  $arrayEventsNextMonth = array();

  while($eventsNextMonth = mysqli_fetch_array($queryEventsNextMonth)){

    $arrayEventsNextMonth[] = $eventsNextMonth;

  }

  // Get subscribes
    $querySubscribesPublic = mysqli_query($conn, "SELECT subscribes_public.order_transaction, transactions_public.date_transaction, events_public.name_event, transactions_public.order_transaction
                                        FROM subscribes_public
                                        LEFT JOIN transactions_public ON transactions_public.order_transaction=subscribes_public.order_transaction
                                        LEFT JOIN events_public ON events_public.id_event=transactions_public.id_event
                                        WHERE subscribes_public.id_user='$userid' AND transactions_public.payment_status='paid'
                                        GROUP BY transactions_public.order_transaction
                                        ORDER BY transactions_public.date_transaction DESC");
    $arraySubscribesPublic = array();

    while($subscribesPublic = mysqli_fetch_array($querySubscribesPublic)){
      $arraySubscribesPublic[] = $subscribesPublic;
    }

}else if($userProfile_array['id_type_user'] == '2'){

  // Query Events users

  $queryEvents = mysqli_query($conn, "SELECT * FROM events_private WHERE id_user_buy='$userid' AND date_event >=  DATE_FORMAT(NOW() ,'%Y-%m-01') AND date_event <= DATE_ADD(DATE_FORMAT(NOW() ,'%Y-%m-01'), INTERVAL 1 MONTH)  ORDER BY date_event ASC");

  $arrayEvents = array();

  while($events = mysqli_fetch_array($queryEvents)){

    $arrayEvents[] = $events;

  }

    $queryEventsPublic = mysqli_query($conn, "SELECT * FROM events_public WHERE id_user='$userid' AND date_event >=  DATE_FORMAT(NOW() ,'%Y-%m-01') AND date_event <= DATE_ADD(DATE_FORMAT(NOW() ,'%Y-%m-01'), INTERVAL 1 MONTH)  ORDER BY date_event ASC");

    $arrayEventsPublic = array();

    while($eventsPublic = mysqli_fetch_array($queryEventsPublic)){

      $arrayEventsPublic[] = $eventsPublic;

    }



    $queryEventsStreaming = mysqli_query($conn, "SELECT * FROM events_streaming WHERE id_user='$userid' AND date_event >=  DATE_FORMAT(NOW() ,'%Y-%m-01') AND date_event <= DATE_ADD(DATE_FORMAT(NOW() ,'%Y-%m-01'), INTERVAL 1 MONTH)  ORDER BY date_event ASC");

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



  $queryEventsNextMonth = mysqli_query($conn, "SELECT * FROM events_private WHERE id_user_buy='$userid'  AND date_event >=  DATE_ADD(DATE_FORMAT(NOW() ,'%Y-%m-01'), INTERVAL 1 MONTH) AND date_event <= DATE_ADD(DATE_FORMAT(NOW() ,'%Y-%m-01'), INTERVAL 2 MONTH)  ORDER BY date_event ASC");

  $arrayEventsNextMonth = array();

  while($eventsNextMonth = mysqli_fetch_array($queryEventsNextMonth)){

    $arrayEventsNextMonth[] = $eventsNextMonth;

  }

  // Get subscribes
    $querySubscribesPublic = mysqli_query($conn, "SELECT subscribes_public.order_transaction, transactions_public.date_transaction, events_public.name_event, transactions_public.order_transaction
                                        FROM subscribes_public
                                        LEFT JOIN transactions_public ON transactions_public.order_transaction=subscribes_public.order_transaction
                                        LEFT JOIN events_public ON events_public.id_event=transactions_public.id_event
                                        WHERE subscribes_public.id_user='$userid' AND transactions_public.payment_status='paid'
                                        GROUP BY transactions_public.order_transaction
                                        ORDER BY transactions_public.date_transaction DESC");
    $arraySubscribesPublic = array();

    while($subscribesPublic = mysqli_fetch_array($querySubscribesPublic)){
      $arraySubscribesPublic[] = $subscribesPublic;
    }



}



  function displayEventsArtist($arrayEvents){

    foreach($arrayEvents as $events){

      $time = date_create($events['date_event']);

      if($events['active_event'] == '1'){

          echo '<tr>';

          echo '<td><strong>'; getDayday($time); echo '</strong></td>';

          echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';

          echo '<td><a  onClick="getEvents('.$events['id_event'].','.$events['id_type_event'].'); showDetail()" >'.$events['name_event'].'</a></td>';

          echo '<td><a  onClick="getEvents('.$events['id_event'].','.$events['id_type_event'].'); showDetail()" class="icon solid fa-calendar-check"> Publicado</a></td>';

          echo '</tr>';

      }else if ($events['active_event']=='0'){

          echo '<tr>';

          echo '<td><strong>'; getDayday($time); echo '</strong></td>';

          echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';

          echo '<td><a  onClick="getEvents('.$events['id_event'].','.$events['id_type_event'].'); showDetail()" >'.$events['name_event'].'</a></td>';

          echo '<td><a  onClick="getEvents('.$events['id_event'].','.$events['id_type_event'].'); showDetail()" class="icon solid fa-calendar-check"> No Publicado</a></td>';

          echo '</tr>';

      }else{

        echo '<tr>';

        echo '<td><strong>'; getDayday($time); echo '</strong></td>';

        echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';

        echo '<td><a  onClick="getEvents('.$events['id_event'].','.$events['id_type_event'].'); showDetail()" >'.$events['name_event'].'</a></td>';

        switch($events['status_event']){

          case "reserved":

          echo '<td><a  onClick="getEvents('.$events['id_event'].','.$events['id_type_event'].'); showDetail()" class="icon solid fa-envelope"> Reservado</a></td>';

          break;

          case "pending":

          echo '<td><a  onClick="getEvents('.$events['id_event'].','.$events['id_type_event'].'); showDetail()" class="icon solid fa-ellipsis-h"> Pendiente</a></td>';

          break;

          case "confirmed":

          echo '<td><a  onClick="getEvents('.$events['id_event'].','.$events['id_type_event'].'); showDetail()" class="icon solid fa-check"> Confirmado</a></td>';

          break;

          case "canceled":

          echo '<td><a  onClick="getEvents('.$events['id_event'].','.$events['id_type_event'].'); showDetail()" class="icon solid fa-times"> Cancelado</a></td>';

          break;

        }

        echo '</tr>';

      }

    }

  }



  function displayEventsUser($arrayEvents){

    foreach($arrayEvents as $events){

      $time = date_create($events['date_event']);

      if($events['active_event'] == '1'){

          echo '<tr>';

          echo '<td><strong>'; getDayday($time); echo '</strong></td>';

          echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';

          echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" >'.$events['name_event'].'</a></td>';

          echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-calendar-check"> Publicado</a></td>';

          echo '</tr>';

      }else if ($events['active_event']=='0'){

          echo '<tr>';

          echo '<td><strong>'; getDayday($time); echo '</strong></td>';

          echo '<td>'.DATE_FORMAT($time, 'H:i').'</td>';

          echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" >'.$events['name_event'].'</a></td>';

          echo '<td><a  onClick="getEvents('.$events['id_event'].'); showDetail()" class="icon solid fa-calendar-check"> No Publicado</a></td>';

          echo '</tr>';

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

  }



  function displayFollowArtists($arrayArtistsFollow){

    if(!empty($arrayArtistsFollow)){

      // echo '<ul class="alt">';

      foreach($arrayArtistsFollow as $artistsFollow){

        // echo '<li><a href="profile.php?userid='.$artistsFollow['id_user'].'">'.$artistsFollow['nick_user'].'</a></li>';

        echo '<article class="artist-card-follow">

        <a href="profile.php?userid='.$artistsFollow['id_user'].'" onClick="clearProfileCookie()"></a>

          <div class="image left">

            <img src="images/avatars/'.$artistsFollow['id_user'].'.jpg"/>

          </div>

          <div class="">

            <p>'.$artistsFollow['nick_user'].'</p>

          </div>

        </article>';

      }

      // echo '</ul>';

    } else {

      echo '<p>Aún no sigues a ningún Artista.</p>';

    }

  }



  date_default_timezone_set('America/Santiago');

  $today = date('m/d/Y h:i:s a', time());

  $todayDate = date_create($today);

  $dateFirstDay = date("Y-m-01");

  $newdate = strtotime ( '+1 month' , strtotime ( $dateFirstDay ) ) ;

  $newdate = date('M Y', $newdate);

  $monthYear = date('M Y', time());

  $currentMonth = date('m', time());

  $currentYear = date('Y', time());



  $arrayMonths = array('01' => 'Enero',

                       '02' => 'Febrero',

                       '03' => 'Marzo',

                       '04' => 'Abril',

                       '05' => 'Mayo',

                       '06' => 'Junio',

                       '07' => 'Julio',

                       '08' => 'Agosto',

                       '09' => 'Septiembre',

                       '10' => 'Octubre',

                       '11' => 'Noviembre',

                       '12' => 'Diciembre');

  $arrayYears = array('2020', '2021', '2022', '2023', '2024');



include 'functionDateTranslate.php';



  // Accept Events

  if(isset($_POST['accept_event'])){

    if($idEvent = FILTER_INPUT(INPUT_POST, 'id_event', FILTER_VALIDATE_INT, 1)){

      $idEvent = mysqli_real_escape_string($conn, $idEvent);



      $queryAccept = "UPDATE events_private SET status_event='pending' WHERE id_event='$idEvent' AND id_user_sell='$userid'";

      $queryInfoBuyer = mysqli_query($conn, "SELECT mail_user FROM users LEFT JOIN events_private ON events_private.id_user_buy = users.id_user WHERE events_private.id_event='$idEvent'");

      $fetchInfoBuyer = mysqli_fetch_array($queryInfoBuyer);

      $emailBuyer = $fetchInfoBuyer['mail_user'];

    }else{

      header('HTTP/1.1 403 Forbidden');

      die();

    }



    if(mysqli_query($conn,$queryAccept)){

      /*$text = '<html><p>El Artista '.$userProfile_array['nick_user'].' ha aceptado tu reserva, por favor procede a realizar el pago desde tu <a href="http://echomusic.cl/dashboard.php?location=https://echomusic.cl/dashboard.php">Panel de Control</a> para completar el proceso. </p></html>';
      */
      $text = $eventomail.$userProfile_array['nick_user'].$eventomail1;

      $headers = "MIME-Version: 1.0" . "\r\n";

      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

      $headers .= "From: reservas@echomusic.cl" . "\r\n";

      if(mail($emailBuyer, "Felicitaciones, tu evento fue aceptado por el artista", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Evento aceptado. El usuario ha sido notificado.";

        unset($idEvent);

        $_SESSION['success'] = $errMSG;

        $_SESSION['tab'] = 'collapseMyEvents';

        header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

        exit();

      }

      $errTyp = "success";

      $errMSG = "Evento aceptado.";

      unset($idEvent);

      $_SESSION['success'] = $errMSG;

      $_SESSION['tab'] = 'collapseMyEvents';

      header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

      exit();

    }

    else{

      $errTyp = "danger";

      $_SESSION['tab'] = 'collapseMyEvents';

      $errMSG = "Ha sucedido un error.";

    }

  }



// Reject event

  if(isset($_POST['reject_event'])){

      if($idEvent = FILTER_INPUT(INPUT_POST, 'id_event', FILTER_VALIDATE_INT, 1)){

        $idEvent = mysqli_real_escape_string($conn, $idEvent);



        $queryReject = "UPDATE events_private SET status_event='canceled' WHERE id_event='$idEvent' AND id_user_sell='$userid'";

        $queryInfoBuyer = mysqli_query($conn, "SELECT mail_user FROM users LEFT JOIN events_private ON events_private.id_user_buy = users.id_user WHERE events_private.id_event='$idEvent'");

        $fetchInfoBuyer = mysqli_fetch_array($queryInfoBuyer);

        $emailBuyer = $fetchInfoBuyer['mail_user'];

      }else{

        header('HTTP/1.1 403 Forbidden');

        die();

      }



      if(mysqli_query($conn,$queryReject)){

       /* $text = '<html><p>El Artista '.$userProfile_array['nick_user'].' ha rechazado el evento. </br>Puedes encontrar más artistas con nuestro <a href="https://echomusic.cl/search.php">Buscador</a></p></html>';
*/
       $text = $eventoremail.$userProfile_array['nick_user'].$eventoremail1;

        $headers = "MIME-Version: 1.0" . "\r\n";

        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headers .= "From: reservas@echomusic.cl" . "\r\n";

        if(mail($emailBuyer, "Evento rechazado", $text, $headers)){

          $errTyp = "success";

          $errMSG = "Evento rechazado. El usuario ha sido notificado.";

          unset($idEvent);

          $_SESSION['success'] = $errMSG;

          $_SESSION['tab'] = 'collapseMyEvents';

          header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

          exit();

        }

      $errTyp = "success";

      $_SESSION['tab'] = 'collapseMyEvents';

      $errMSG = "Evento rechazado.";

      unset($idEvent);

      $_SESSION['success'] = $errMSG;

      $_SESSION['tab'] = 'collapseMyEvents';

      header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

      exit();

      }

      else{

        $errTyp = "danger";

        $_SESSION['tab'] = 'collapseMyEvents';

        $errMSG = "Ha sucedido un error.";

      }

  }



// Cancel event

  if(isset($_POST['cancel_event'])){

      if($idEvent = FILTER_INPUT(INPUT_POST, 'id_event', FILTER_VALIDATE_INT, 1)){

        $idEvent = mysqli_real_escape_string($conn, $idEvent);

      }else{

        header('HTTP/1.1 403 Forbidden');

        die();

      }



      $cancelText = trim($_POST['cancel_text']);

      $cancelText = strip_tags($cancelText);

      $cancelText = htmlspecialchars($cancelText);

      $cancelText = mysqli_real_escape_string($conn, $cancelText);



      if (empty($cancelText)) {

       $error = true;

       $cancelTextError = "Por favor ingresa un motivo para cancelar el evento.";

     } else if (strlen($cancelText) < 10) {

       $error = true;

       $cancelTextError = "El motivo debe tener más de 10 caracteres";

     } else if (strlen($cancelText) > 201) {

       $error = true;

       $cancelTextError = "El motivo no puede tener más de 200 caracteres";

     }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$cancelText)) {

       $error = true;

       $cancelTextError = "El texto solo puede contener letras y números";

      }



      if(!$error){

        $queryInfoUser = mysqli_query($conn, "SELECT * FROM events_private LEFT JOIN users AS user_sell ON events_private.id_user_sell = user_sell.id_user

                                                                           LEFT JOIN users AS user_buy ON events_private.id_user_buy = user_buy.id_user WHERE id_event='$idEvent' AND (id_user_sell='$userid' OR id_user_buy='$userid')");

        $arrayInfoUser = mysqli_fetch_array($queryInfoUser);



        if($arrayInfoUser['id_user_buy'] == $userid){

          $queryCancel_1 = "UPDATE events_private SET status_event='canceled' WHERE id_event='$idEvent' AND id_user_buy='$userid' AND status_event!='canceled'";

          $queryCancel_2 = "INSERT INTO canceled_events (id_event, cancel_text) VALUES ('$idEvent', '$cancelText')";

          $emailUser = $arrayInfoUser['26'];

          if(mysqli_query($conn,$queryCancel_1)){

            if(mysqli_query($conn,$queryCancel_2)){
/*
              $text = '<html><p>El Cliente '.ucfirst($arrayInfoUser['first_name_user']).' '.ucfirst($arrayInfoUser['last_name_user']).' ha cancelado el evento '.$arrayInfoUser['name_event'].'. </br>Motivos: '.$cancelText.'</p></html>';
*/
              $text= $eventocamail.$eventoCAAmail1.ucfirst($arrayInfoUser['first_name_user']).' '.ucfirst($arrayInfoUser['last_name_user']).$eventocamail2.$arrayInfoUser['name_event'].$eventocamail3.$cancelText.$eventocamail4;

              $headers = "MIME-Version: 1.0" . "\r\n";

              $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

              $headers .= "From: reservas@echomusic.cl" . "\r\n";

              if(mail($emailUser, "Evento Cancelado", $text, $headers)){

                $errTyp = "success";

                $errMSG = "Evento cancelado. El Artista ha sido notificado.";

                unset($idEvent);

                $_SESSION['success'] = $errMSG;

                $_SESSION['tab'] = 'collapseMyEvents';

                header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

                exit();

              }

            $errTyp = "success";

            $errMSG = "Evento cancelado.";

            unset($idEvent);

            $_SESSION['success'] = $errMSG;

            $_SESSION['tab'] = 'collapseMyEvents';

            header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

            exit();

            }else{

              $errTyp = "danger";

              $_SESSION['tab'] = 'collapseMyEvents';

              $errMSG = "Ha sucedido un error.";

            }

          }else{

            $errTyp = "danger";

            $_SESSION['tab'] = 'collapseMyEvents';

            $errMSG = "Ha sucedido un error.";

          }

        }else if($arrayInfoUser['id_user_sell'] == $userid){

          $queryCancel_1 = "UPDATE events_private SET status_event='canceled' WHERE id_event='$idEvent' AND id_user_sell='$userid' AND status_event!='canceled'";

          $queryCancel_2 = "INSERT INTO canceled_events (id_event, cancel_text) VALUES ('$idEvent', '$cancelText')";

          $emailUser = $arrayInfoUser['mail_user'];

          if(mysqli_query($conn,$queryCancel_1)){

            if(mysqli_query($conn,$queryCancel_2)){
/*
              $text = '<html><p>El Artista '.$arrayInfoUser['31'].' ha cancelado el evento '.$arrayInfoUser['name_event'].'.</br> Motivos: '.$cancelText.'</p></html>';
              */
              $text= $eventocamail.$eventoCACmail1.ucfirst($arrayInfoUser['first_name_user']).' '.ucfirst($arrayInfoUser['last_name_user']).$eventocamail2.$arrayInfoUser['name_event'].$eventocamail3.$cancelText.$eventocamail4;
              $headers = "MIME-Version: 1.0" . "\r\n";

              $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

              $headers .= "From: reservas@echomusic.cl" . "\r\n";

              if(mail($emailUser, "Evento Cancelado", $text, $headers)){

                $errTyp = "success";

                $errMSG = "Evento cancelado. El Cliente ha sido notificado.";

                unset($idEvent);

                $_SESSION['success'] = $errMSG;

                $_SESSION['tab'] = 'collapseMyEvents';

                header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

                exit();

              }

            $errTyp = "success";

            $errMSG = "Evento cancelado.";

            unset($idEvent);

            $_SESSION['success'] = $errMSG;

            $_SESSION['tab'] = 'collapseMyEvents';

            header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

            exit();

            }else{

              $errTyp = "danger";

              $_SESSION['tab'] = 'collapseMyEvents';

              $errMSG = "Ha sucedido un error.";

            }

          }else{

            $errTyp = "danger";

            $_SESSION['tab'] = 'collapseMyEvents';

            $errMSG = "Ha sucedido un error.";

          }

      }else{

        $errTyp = "danger";

        $_SESSION['tab'] = 'collapseMyEvents';

        $errMSG = "Ha sucedido un error.";

      }

  }else{

    $errTyp = "danger";

    $_SESSION['tab'] = 'collapseMyEvents';

    $errMSG = "Ha sucedido un error.";

  }

}



// Publish Event

  if ( isset($_POST['submitPublicEvent']) ) {



    // Turn Off and On
    // header("location: cuidemonos/index.php");
    // die();



    $publicNameEvent = trim($_POST['publicNameEvent']);

    $publicNameEvent = strip_tags($publicNameEvent);

    $publicNameEvent = htmlspecialchars($publicNameEvent);

    $publicNameEvent = mysqli_real_escape_string($conn, $publicNameEvent);



    $publicLocationEvent = trim($_POST['publicLocationEvent']);

    $publicLocationEvent = strip_tags($publicLocationEvent);

    $publicLocationEvent = htmlspecialchars($publicLocationEvent);

    $publicLocationEvent = mysqli_real_escape_string($conn, $publicLocationEvent);



    $publicOrganizerEvent = trim($_POST['publicOrganizerEvent']);

    $publicOrganizerEvent = strip_tags($publicOrganizerEvent);

    $publicOrganizerEvent = htmlspecialchars($publicOrganizerEvent);

    $publicOrganizerEvent = mysqli_real_escape_string($conn, $publicOrganizerEvent);



    $publicDateEvent = trim($_POST['publicDateEvent']);

    $publicDateEvent = strip_tags($publicDateEvent);

    $publicDateEvent = htmlspecialchars($publicDateEvent);

    $publicDateEvent = mysqli_real_escape_string($conn, $publicDateEvent);



    $publicRegionEvent = trim($_POST['publicRegionEvent']);

    $publicRegionEvent = strip_tags($publicRegionEvent);

    $publicRegionEvent = htmlspecialchars($publicRegionEvent);

    $publicRegionEvent = mysqli_real_escape_string($conn, $publicRegionEvent);



    $publicCityEvent = trim($_POST['publicCityEvent']);

    $publicCityEvent = strip_tags($publicCityEvent);

    $publicCityEvent = htmlspecialchars($publicCityEvent);

    $publicCityEvent = mysqli_real_escape_string($conn, $publicCityEvent);



    $publicValueEvent = trim($_POST['publicValueEvent']);

    $publicValueEvent = strip_tags($publicValueEvent);

    $publicValueEvent = htmlspecialchars($publicValueEvent);

    $publicValueEvent = mysqli_real_escape_string($conn, $publicValueEvent);



    $planPublicEvent = trim($_POST['planPublicEvent']);

    $planPublicEvent = strip_tags($planPublicEvent);

    $planPublicEvent = htmlspecialchars($planPublicEvent);

    $planPublicEvent = mysqli_real_escape_string($conn, $planPublicEvent);



    $eventDesc = trim($_POST['eventDesc']);

    $eventDesc = strip_tags($eventDesc);

    $eventDesc = htmlspecialchars($eventDesc);

    $eventDesc = mysqli_real_escape_string($conn, $eventDesc);



  // Get Image Dimension

    $fileinfo = @getimagesize($_FILES["file-input"]["tmp_name"]);

    $width = $fileinfo[0];

    $height = $fileinfo[1];



    $allowed_image_extension = array(

      "png",

      "jpg",

      "jpeg",

      "JPG",

      "JPEG",

      "PNG"

    );

    // Get image file extension

    $file_extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);



    if (! file_exists($_FILES["file-input"]["tmp_name"])) {

      $error = true;

      $publicImageEventError = "Por favor, elige una imagen para subir.";

    }    // Validate file input to check if is with valid extension

    else if (! in_array($file_extension, $allowed_image_extension)) {

      $error = true;

      $publicImageEventError = "Por favor, elige una imagen de formato JPG o PNG.";

    }    // Validate image file size

    else if (($_FILES["file-input"]["size"] > 5000000)) {

      $error = true;

      $publicImageEventError = "La imagen excede el peso de 5MB.";

    }    // Validate image file dimension

    else if ($width >= "1921" || $height >= "1081") {

      $error = true;

      $publicImageEventError = "Las dimensiones de la imagen son superior a 1920x1080 pixeles.";

    }



    //Data validation

    if (empty($publicNameEvent)) {

     $error = true;

     $publicNameEventError = "Por favor ingresa el nombre del evento.";

   } else if (strlen($publicNameEvent) < 3) {

     $error = true;

     $publicNameEventError = "El nombre del evento debe tener más de 3 caracteres";

   } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$publicNameEvent)) {

     $error = true;

     $publicNameEventError = "El nombre del evento solo puede contener letras y números";

    }



    if (empty($publicLocationEvent)) {

     $error = true;

     $publicLocationEventError = "Por favor ingresa la dirección del evento.";

   } else if (strlen($publicLocationEvent) < 3) {

     $error = true;

     $publicLocationEventError = "La dirección del evento debe tener más de 3 caracteres";

   } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$publicLocationEvent)) {

     $error = true;

     $publicLocationEventError = "La dirección del evento solo puede contener letras y números";

    }



    if (empty($publicOrganizerEvent)) {

     $error = true;

     $publicOrganizerEventError = "Por favor ingresa el nombre del organizador del evento.";

   } else if (strlen($publicOrganizerEvent) < 3) {

     $error = true;

     $publicOrganizerEventError = "El nombre del organizador del evento debe tener más de 3 caracteres";

   } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$publicOrganizerEvent)) {

     $error = true;

     $publicOrganizerEventError = "El nombre del organizador del evento solo puede contener letras y números";

    }



    if (empty($publicDateEvent)) {

     $error = true;

     $publicDateEventError = "Por favor ingresa la hora del evento.";

   } else if (strlen($publicDateEvent) < 3) {

     $error = true;

     $publicDateEventError = "Por favor ingresa una hora válida.";

    }



    if (empty($planPublicEvent)) {

     $error = true;

     $planPublicEventError = "Por favor elige el tipo de plan.";

   }else if(!preg_match("/^[1-9][0-9]*$/", $planPublicEvent)){

     $error = true;

     $planPublicEventError = "El tipo de plan no es válido.";

   }



    if (empty($publicRegionEvent)) {

     $error = true;

     $publicRegionEventError = "Por favor elige una región.";

   }else if(!preg_match("/^[1-9][0-9]*$/", $publicRegionEvent)){

     $error = true;

     $publicRegionEventError = "La región no es válida.";

   }



    if (empty($publicCityEvent)) {

     $error = true;

     $publicCityEventError = "Por favor elige una comuna.";

   }else if(!preg_match("/^[1-9][0-9]*$/", $publicCityEvent)){

     $error = true;

     $publicCityEventError = "La comuna no es válida.";

   }



   if (empty($eventDesc)) {

    $error = true;

    $eventDescError = "Por favor ingresa la descripción del evento.";

  } else if (strlen($eventDesc) < 1) {

     $error = true;

     $eventDescError = "La descripción debe tener más de 1 caracter.";

   }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$eventDesc)) {

     $error = true;

     $eventDescError = "La descripción del evento contiene caracteres no permitidos.";

    }



   $imgRename = str_replace(".", "_", uniqid(mt_rand(), true));



   $publicTimeEvent = date_create($publicDateEvent);

   $publicTimeEvent = DATE_FORMAT($publicTimeEvent, 'H:i:s');



   if( !$error ) {

     $typeEvent = 2;

     // Check if plan standard or basic if standard, then khipu

     if($planPublicEvent == 1){

     $queryEventInsert = "INSERT INTO events_public (id_user, date_event, id_region, id_city, name_event, location, organizer, value, id_plan, desc_event, img, active_event) VALUES ('$userid', '$publicDateEvent', '$publicRegionEvent', '$publicCityEvent', '$publicNameEvent', '$publicLocationEvent', '$publicOrganizerEvent', '$publicValueEvent', '$planPublicEvent', '$eventDesc', '$imgRename', '1')";



      if (mysqli_query($conn, $queryEventInsert)) {

        $target = "images/events/" . $imgRename . '.jpg';

        if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {

            $errTyp = "success";

            $errMSG = "Evento publicado con éxito.";

            unset($imgRename);

            $_SESSION['success'] = $errMSG;

            header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

            exit();

        } else {

          $errTyp = "danger";

          $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";



        }

     }

     else {

      $errTyp = "danger";

      $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";

     }

   }else if($planPublicEvent == 2){

     $queryEventInsert = "INSERT INTO events_public (id_user, date_event, id_region, id_city, name_event, location, organizer, value, id_plan, desc_event, img, active_event) VALUES ('$userid', '$publicDateEvent', '$publicRegionEvent', '$publicCityEvent', '$publicNameEvent', '$publicLocationEvent', '$publicOrganizerEvent', '$publicValueEvent', '$planPublicEvent', '$eventDesc', '$imgRename', '0')";



      if (mysqli_query($conn, $queryEventInsert)) {

        $target = "images/events/" . $imgRename . '.jpg';

        if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {

          // Check transaction on DB

          $checkIdEvent = mysqli_query($conn, "SELECT * FROM events_public WHERE id_user='$userid' AND active_event='0' ORDER BY id_event DESC LIMIT 1");

          $arrayIdEvent = mysqli_fetch_array($checkIdEvent);

          $idEvent = $arrayIdEvent['id_event'];

          $checkTransaction = mysqli_query($conn, "SELECT * FROM transactions_visibility WHERE id_event='$idEvent' AND id_type_event='$typeEvent' AND payment_status='pending'");

          if(mysqli_num_rows($checkTransaction) == 0){

            $amountVisibility = 50000;

            $dateTransaction = date('Y-m-d H:i:s', time());

            $queryTransaction = mysqli_query($conn, "INSERT INTO transactions_visibility(id_event, id_type_event, id_user, id_plan_visibility, amount_transaction_visibility, payment_status, date_transaction) VALUES ('$idEvent', '$typeEvent', '$userid', '$planPublicEvent', '$amountVisibility', 'pending', '$dateTransaction')");

            $checkTransaction = mysqli_query($conn, "SELECT * FROM transactions_visibility WHERE id_event='$idEvent' AND id_type_event='$typeEvent' AND payment_status='pending'");

            $arrayTransaction = mysqli_fetch_array($checkTransaction);

            $id_transaction = $arrayTransaction['id_transaction_visibility'];

          }else if(mysqli_num_rows($checkTransaction) == 1){

            $arrayTransaction = mysqli_fetch_array($checkTransaction);

            $id_transaction = $arrayTransaction['id_transaction_visibility'];

            $amountVisibility = 50000;

          }

            // Inicio de Khipu

                $receiverId = 400724;

                $secretKey = 'cb8a44364a896177330666f8949e57f70dcd2c1a';

                $totalTransaction = $amountVisibility;



                require './vendor/autoload.php';



                $configuration = new Khipu\Configuration();

                $configuration->setReceiverId($receiverId);

                $configuration->setSecret($secretKey);

                // $configuration->setDebug(true);



                $client = new Khipu\ApiClient($configuration);

                $payments = new Khipu\Client\PaymentsApi($client);



                try {

                    $opts = array(

                        "transaction_id" => "TE-".$id_transaction,

                        "return_url" => "https://echomusic.cl/dashboard.php",

                        "notify_url" => "https://echomusic.cl/resources/notification_script.php",

                        "notify_api_version" => "1.3",

                    );

                    $response = $payments->paymentsPost(

                        "Pago del plan de visibilidad Estándar ", //Motivo de la compra

                        "CLP", //Monedas disponibles CLP, USD, ARS, BOB

                        $totalTransaction, //Monto. Puede contener ","

                        $opts //campos opcionales

                );



                } catch (\Khipu\ApiException $e) {

                    echo print_r($e->getResponseBody(), TRUE);

                }





          // Header to Khipu payment

          if(isset($response)){

            $payment_id = $response['payment_id'];

            mysqli_query($conn, "UPDATE transactions_visibility SET order_transaction='$payment_id' WHERE id_transaction_visibility='$id_transaction'");

            header('Location: '.$response['payment_url']);

          }

        } else {

          $errTyp = "danger";

          $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";



        }

     }else {

      $errTyp = "danger";

      $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";



     }



   }

  }else {

    $errTyp = "danger";

    $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

  }

}



  //Get genres

  $queryGenres = mysqli_query($conn, "SELECT * FROM genres");

  $arrayGenres = array();

  while($genres = mysqli_fetch_array($queryGenres)){

    $arrayGenres[] = $genres;

  }



  //Get subGenres

  $querySubGenres = mysqli_query($conn, "SELECT * FROM sub_genres LEFT JOIN genres_subs ON sub_genres.id_subGenre = genres_subs.id_subGenre WHERE genres_subs.id_genre='$user_idGenre'");

  $arraySubGenres = array();

  while($subGenres = mysqli_fetch_array($querySubGenres)){

    $arraySubGenres[] = $subGenres;

  }



  // Get Banks

    $queryBanks = mysqli_query($conn, "SELECT * FROM banks");

    $arrayBanks = array();

    while($banks = mysqli_fetch_array($queryBanks)){

      $arrayBanks[] = $banks;

    }



  // Get Type accounts

    $queryAccounts = mysqli_query($conn, "SELECT * FROM type_accounts");

    $arrayAccounts = array();

    while($accounts = mysqli_fetch_array($queryAccounts)){

      $arrayAccounts[] = $accounts;

    }



  //Get requests

  $mailRequest = $userProfile_array['mail_user'];

  $queryRequests = mysqli_query($conn, "SELECT * FROM requests WHERE email_request='$mailRequest' AND status_request='open' AND user_request IN ('1','2')");

  $requestsArray = mysqli_fetch_array($queryRequests);

  if(empty($requestsArray)){

    $contactAdmin = false;



  }

  else{

    $contactAdmin = true;

    $assistNumber = $requestsArray['id_request'];

  }



  $queryMusicianInfo = mysqli_query($conn, "SELECT * FROM type_musician");

  $queryCityInfo = mysqli_query($conn, "SELECT * FROM cities");

  $idRegion = $userProfile_array['id_region'];

  // Get comunas

  $queryCitiesInfo = mysqli_query($conn, "SELECT * FROM regions_cities LEFT JOIN cities ON regions_cities.id_city = cities.id_city WHERE id_region='$idRegion'");

  $arrayCities = array();

  while($cities = mysqli_fetch_array($queryCitiesInfo)){

    $arrayCities[] = $cities;

  }



  // Get soc genres

  $querySocGenresInfo = mysqli_query($conn, "SELECT * FROM social_genres");

  $arraySocGenres = array();

  while($socGenres = mysqli_fetch_array($querySocGenresInfo)){

    $arraySocGenres[] = $socGenres;

  }



  $queryInstrumentInfo = mysqli_query($conn, "SELECT * FROM instruments");





// Submit Personal Data Artist

  if(isset($_POST['submitPersonalData_artist'])){



    // Email

    // $email = trim($_POST['email']);

    // $email = mysqli_real_escape_string($conn, $email);



    // Type Artist

    $typeMusician = trim($_POST['musician']);

    $typeMusician = mysqli_real_escape_string($conn, $typeMusician);



    // Instrument

    if(!empty($_POST['instrument'])){

      $instrument = trim($_POST['instrument']);

      $instrument = mysqli_real_escape_string($conn, $instrument);

    }



    // Genre

    $genre = trim($_POST['genre']);

    $genre = mysqli_real_escape_string($conn, $genre);



    // Sub Genre

    $subGenre1 = trim($_POST['subGenre1']);

    $subGenre1 = mysqli_real_escape_string($conn, $subGenre1);



    // Region

    $region = trim($_POST['region']);

    $region = mysqli_real_escape_string($conn, $region);



    // Comuna

    $comuna = trim($_POST['comuna']);

    $comuna = mysqli_real_escape_string($conn, $comuna);



    // Region Validation

    if(empty($region)){

      $error = true;

      $regionError = "Por favor ingresa una región";

    }else if (!FILTER_VAR($region, FILTER_VALIDATE_INT, 1)){

      $error = true;

      $regionError = "Por favor elige una región válida";

    }



    // Comuna Validation

    if(empty($comuna)){

      $error = true;

      $comunaError = "Por favor ingresa una comuna";

    }else if (!FILTER_VAR($comuna, FILTER_VALIDATE_INT, 1)){

      $error = true;

      $comunaError = "Por favor elige una comuna válida";

    }



    if (empty($comunaError) && empty($regionError)) {

      $locationQuery = "UPDATE users SET id_region='$region', id_city='$comuna' WHERE id_user='$userid'";

    }



    // SubGenre Validation

    if(!preg_match("/^[0-9]*$/", $subGenre1)){

      $error = true;

      $subGenreError = "Por favor elige un sub género válido";

    }else {

      $subGenre1Query = "UPDATE subGenres_user SET id_subGenre='$subGenre1' WHERE id_user='$userid' AND subGenre_slot=1";

    }



    // Genre Validation

    if(empty($genre)){

      $error = true;

      $genreError = "Por favor elige un género musical";

    }else if (!FILTER_VAR($genre, FILTER_VALIDATE_INT, 1)){

      $error = true;

      $genreError = "Por favor elige un género válido";

    }else {

      $genreQuery = "UPDATE genre_user SET id_genre='$genre' WHERE id_user='$userid'";

    }



    // Type Artist Validation

    if(empty($typeMusician)){

      $error = true;

      $musicianError = "Por favor ingresa tu tipo de artista";

    }else if (!FILTER_VAR($typeMusician, FILTER_VALIDATE_INT, 1)){

      $error = true;

      $musicianError = "Por favor elige un tipo de artista válido";

    }else {

      $musicianQuery = "UPDATE users SET id_musician='$typeMusician' WHERE id_user='$userid'";

    }



    // Instrument Validation

    if (!FILTER_VAR($instrument, FILTER_VALIDATE_INT, 1)){

      $error = true;

      $instrumentError = "Por favor elige un instrumento válido";

    }else{

      $instrumentQuery = "UPDATE users SET id_instrument='$instrument' WHERE id_user='$userid'";

    }



    // Email validation

   //  if(empty($email)){

   //    $error = true;

   //    $emailError = "Por favor ingresa una dirección de correo";

   //  }else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   //     $error = true;

   //     $emailError = "Por favor ingresa una dirección de correo válida";

   //  }else {

   //   // check email exist or not

   //   $mailquery = "SELECT mail_user FROM users WHERE mail_user='$email' AND id_user!='$userid'";

   //   $result = mysqli_query($conn, $mailquery);

   //   $count = mysqli_num_rows($result);

   //   if($count!=0){

   //    $error = true;

   //    $emailError = "La dirección de correo ingresada ya esta en uso.";

   //  }else{

   //    $emailQuery = "UPDATE users SET mail_user='$email' WHERE id_user='$userid'";

   //  }

   // }



    // Queries











    // $submitDataQuery = $emailQuery;

    // $submitDataQuery .= $musicianQuery;

    // $submitDataQuery .= $genreQuery;



    // $submitDataQuery .= $locationQuery;



    // $submitDataQuery = implode(";", array_filter([$emailQuery, $instrumentQuery, $musicianQuery, $genreQuery, $subGenre1Query, $locationQuery])) ;

    $submitDataQuery = implode(";", array_filter([$instrumentQuery, $musicianQuery, $genreQuery, $subGenre1Query, $locationQuery])) ;



    // If there's no error, procede to update



    if(!$error){

      if(mysqli_multi_query($conn, $submitDataQuery)){

        if($genre != $user_idGenre){

          while (mysqli_next_result($conn)) // flush multi_queries

            {

                if (!mysqli_more_results($conn)) break;

            }

          $differentsubGenreQuery = "UPDATE subGenres_user SET id_subGenre='0' WHERE id_user='$userid'";

          mysqli_query($conn, $differentsubGenreQuery);

        }

        $errTyp = "success";

        $errMSG = "Información agregada con éxito.";

        $_SESSION['success'] = $errMSG;

        $_SESSION['tab'] = 'collapseMyInfo';

        header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

        exit();

      }else{

        $errTyp = "danger";

        $_SESSION['tab'] = 'collapseMyInfo';

        $errMSG = "Ha sucedido un error.";

      }

    }else{

      $errTyp = "danger";

      $_SESSION['tab'] = 'collapseMyInfo';

      $errMSG = "Ha sucedido un error, por favor revisa la información y vuelve a intentarlo.";

    }



  }



// Submit Personal Data User

  if(isset($_POST['submitPersonalData_user'])){



    // Email

    // $email = trim($_POST['email']);

    // $email = mysqli_real_escape_string($conn, $email);



    // Region

    $region = trim($_POST['region']);

    $region = mysqli_real_escape_string($conn, $region);



    // Comuna

    $comuna = trim($_POST['comuna']);

    $comuna = mysqli_real_escape_string($conn, $comuna);



    // Edad

    $age = trim($_POST['age']);

    $age = mysqli_real_escape_string($conn, $age);



    // social genre

    $socGenre = trim($_POST['socGenre']);

    $socGenre = mysqli_real_escape_string($conn, $socGenre);



    // Region Validation

    if(empty($region)){

      $error = true;

      $regionError = "Por favor ingresa una región";

    }else if (!FILTER_VAR($region, FILTER_VALIDATE_INT, 1)){

      $error = true;

      $regionError = "Por favor elige una región válida";

    }



    // Comuna Validation

    if(empty($comuna)){

      $error = true;

      $comunaError = "Por favor ingresa una comuna";

    }else if (!FILTER_VAR($comuna, FILTER_VALIDATE_INT, 1)){

      $error = true;

      $comunaError = "Por favor elige una comuna válida";

    }

    // SubGenre Validation

    if(empty($age)){

      $age = NULL;

    }else if(!FILTER_VAR($age, FILTER_VALIDATE_INT, array("options" => array("min_range"=>'1', "max_range"=>'120')))){

      $error = true;

      $ageError = "Por favor elige una edad válida";

    }



    // Genre Validation

    if(empty($socGenre)){

      $socGenre = NULL;

    }else if (!FILTER_VAR($socGenre, FILTER_VALIDATE_INT, 1)){

      $error = true;

      $socGenreError = "Por favor elige un género";

    }





    if (empty($comunaError) && empty($regionError)) {

      $locationQuery = "UPDATE users SET id_region='$region', id_city='$comuna' WHERE id_user='$userid'";

    }

    if (empty($ageError) && empty($socGenreError)) {

      $socialDataQuery = "INSERT INTO user_social_data(id_user, age_data, genre_data) VALUES('$userid', '$age', '$socGenre') ON DUPLICATE KEY UPDATE age_data='$age', genre_data='$socGenre'";

    }





    // Email validation

   //  if(empty($email)){

   //    $error = true;

   //    $emailError = "Por favor ingresa una dirección de correo";

   //  }else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   //     $error = true;

   //     $emailError = "Por favor ingresa una dirección de correo válida";

   //  }else {

   //   // check email exist or not

   //   $mailquery = "SELECT mail_user FROM users WHERE mail_user='$email' AND id_user!='$userid'";

   //   $result = mysqli_query($conn, $mailquery);

   //   $count = mysqli_num_rows($result);

   //   if($count!=0){

   //    $error = true;

   //    $emailError = "La dirección de correo ingresada ya esta en uso.";

   //  }else{

   //    $emailQuery = "UPDATE users SET mail_user='$email' WHERE id_user='$userid'";

   //  }

   // }





    $submitDataQuery = implode(";", array_filter([$locationQuery, $socialDataQuery])) ;



    // If there's no error, procede to update



    if(!$error){

      if(mysqli_multi_query($conn, $submitDataQuery)){

        // if($genre != $user_idGenre){

        //   while (mysqli_next_result($conn)) // flush multi_queries

        //     {

        //         if (!mysqli_more_results($conn)) break;

        //     }

        //   $differentsubGenreQuery = "UPDATE subGenres_user SET id_subGenre='0' WHERE id_user='$userid'";

        //   mysqli_query($conn, $differentsubGenreQuery);

        // }

        $errTyp = "success";

        $errMSG = "Información agregada con éxito.";

        $_SESSION['success'] = $errMSG;

        $_SESSION['tab'] = 'collapseMyInfo';

        header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

        exit();

      }else{

        $errTyp = "danger";

        $_SESSION['tab'] = 'collapseMyInfo';

        $errMSG = "Ha sucedido un error.";

      }

    }else{

      $errTyp = "danger";

      $_SESSION['tab'] = 'collapseMyInfo';

      $errMSG = "Ha sucedido un error, por favor revisa la información y vuelve a intentarlo.";

    }



  }





// Edit  Mail info



//   if ( isset($_POST['submit_email']) ) {

//

//     $email = trim($_POST['email']);

//     $email = strip_tags($email);

//     $email = htmlspecialchars($email);

//

//     // data validation

//     if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

//      $error = true;

//      $emailError = "Por favor ingresa una dirección de correo válida";

//      ;

//     } else {

//      // check email exist or not

//      $mailquery = "SELECT mail_user FROM users WHERE mail_user='$email'";

//      $result = mysqli_query($conn, $mailquery);

//      $count = mysqli_num_rows($result);

//      if($count!=0){

//       $error = true;

//       $emailError = "La dirección de correo ingresada ya esta en uso.";

//       ;

//      }

//     }

//

//    if( !$error ) {

//

//      $query1 = "UPDATE users SET mail_user='$email' WHERE id_user='$userid'";

//

//       if (mysqli_query($conn, $query1)) {

//             $errTyp = "success";

//             $errMSG = "Información agregada con éxito.";

//             header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

//             exit();

//      }else {

//       $errTyp = "danger";

//       $errMSG = "Ha sucedido un error.";

//      }

//     }else {

//      $errTyp = "danger";

//      $errMSG = "Ha sucedido un error.";

//    }

//   }

//

// // Edit Musician info

//   if ( isset($_POST['submit_musician']) ) {

//

//     $typeMusician = trim($_POST['musician']);

//     $typeMusician = strip_tags($typeMusician);

//     $typeMusician = htmlspecialchars($typeMusician);

//     $typeMusician = mysqli_real_escape_string($conn, $typeMusician);

//

//     if(isset($_POST['instrument'])){

//       $instrument = trim($_POST['instrument']);

//       $instrument = strip_tags($instrument);

//       $instrument = htmlspecialchars($instrument);

//       $instrument = mysqli_real_escape_string($conn, $instrument);

//     }

//

//     $genre = trim($_POST['genre']);

//     $genre = strip_tags($genre);

//     $genre = htmlspecialchars($genre);

//     $genre = mysqli_real_escape_string($conn, $genre);

//

//

// // Data validation

//     if (empty($typeMusician)) {

//      $error = true;

//      $musicianError = "Por favor elige el tipo de artista";

//

//    }

//     if (empty($genre)) {

//      $error = true;

//      $genreError = "Por favor elige el género musical";

//    }

//    if (filter_var($genre, FILTER_VALIDATE_INT) === 0 || filter_var($genre, FILTER_VALIDATE_INT)) {

//

//    } else {

//      $error=true;

//      $genreError = "Por favor elige un género válido";

//    }

//

//    if( !$error ) {

//

//      $query1 = "UPDATE users SET id_musician='$typeMusician' WHERE id_user='$userid'";

//      $query2 = "UPDATE genre_user SET id_genre='$genre' WHERE id_user='$userid'";

//

//       if (mysqli_query($conn, $query1)) {

//

//         if (mysqli_query($conn, $query2)) {

//

//           if($genre != $user_idGenre){

//             $query3 = "UPDATE subGenres_user SET id_subGenre='0' WHERE id_user='$userid'";

//             mysqli_query($conn, $query3);

//           }

//

//           if(isset($instrument)){

//             $query4 = "UPDATE users SET id_instrument='$instrument' WHERE id_user='$userid'";

//

//             if(mysqli_query($conn, $query4)){

//

//               $errTyp = "success";

//               $errMSG = "Información agregada con éxito.";

//               unset($type_musician);

//               unset($genre);

//               unset($instrument);

//               header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

//               exit();

//             }

//           }

//           else{

//

//             $errTyp = "success";

//             $errMSG = "Información agregada con éxito.";

//             unset($type_musician);

//             unset($genre);

//             unset($instrument);

//             header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

//             exit();

//           }

//

//          }

//        }

//      }

//      else {

//       $errTyp = "danger";

//       $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

//      }

//   }

//

// // Edit SubGenre info

//   if ( isset($_POST['submit_subgenres']) ) {

//

//     $subGenre1 = trim($_POST['subGenre1']);

//     $subGenre1 = strip_tags($subGenre1);

//     $subGenre1 = htmlspecialchars($subGenre1);

//     $subGenre1 = mysqli_real_escape_string($conn, $subGenre1);

//

//     $subGenre2 = trim($_POST['subGenre2']);

//     $subGenre2 = strip_tags($subGenre2);

//     $subGenre2 = htmlspecialchars($subGenre2);

//     $subGenre2 = mysqli_real_escape_string($conn, $subGenre2);

//

//     $subGenre3 = trim($_POST['subGenre3']);

//     $subGenre3 = strip_tags($subGenre3);

//     $subGenre3 = htmlspecialchars($subGenre3);

//     $subGenre3 = mysqli_real_escape_string($conn, $subGenre3);

//

// // Data validation

//

//     if(empty($subGenre1) && $subGenre1>0 || empty($subGenre2) && $subGenre2>0 || empty($subGenre3) && $subGenre3>0){

//       $error=true;

//       $subGenreError = "Por favor elige un subgénero válido";

//     }

//

//     if (filter_var($subGenre1, FILTER_VALIDATE_INT) === 0 || filter_var($subGenre1, FILTER_VALIDATE_INT)) {

//

//     } else {

//       $error=true;

//       $subGenreError = "Por favor elige un subgénero válido";

//     }

//     if (filter_var($subGenre2, FILTER_VALIDATE_INT) === 0 || filter_var($subGenre2, FILTER_VALIDATE_INT)) {

//

//     } else {

//       $error=true;

//       $subGenreError = "Por favor elige un subgénero válido";

//     }

//     if (filter_var($subGenre3, FILTER_VALIDATE_INT) === 0 || filter_var($subGenre3, FILTER_VALIDATE_INT)) {

//

//     } else {

//       $error=true;

//       $subGenreError = "Por favor elige un subgénero válido";

//     }

//     if($subGenre1>132 || $subGenre3>132 || $subGenre3>132){

//       $error=true;

//       $subGenreError = "Por favor elige un subgénero válido";

//     }

//

//    if( !$error ) {

//

//      $query1 = "UPDATE subGenres_user SET id_subGenre='$subGenre1' WHERE id_user='$userid' AND subGenre_slot=1";

//      $query2 = "UPDATE subGenres_user SET id_subGenre='$subGenre2' WHERE id_user='$userid' AND subGenre_slot=2";

//      $query3 = "UPDATE subGenres_user SET id_subGenre='$subGenre3' WHERE id_user='$userid' AND subGenre_slot=3";

//

//       if (mysqli_query($conn, $query1)) {

//

//         if (mysqli_query($conn, $query2)) {

//

//           if(mysqli_query($conn, $query3)){

//

//               $errTyp = "success";

//               $errMSG = "Información agregada con éxito.";

//               unset($type_musician);

//               unset($genre);

//               unset($instrument);

//               header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

//               exit();

//           }

//         }

//       }

//      }

//      else {

//       $errTyp = "danger";

//       $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";;

//      }

//   }

//

//   //Edit Location Info

//   if (isset($_POST["submit_location"])) {

//

//       $region = trim($_POST['region']);

//       $region = strip_tags($region);

//       $region = htmlspecialchars($region);

//       $region = mysqli_real_escape_string($conn, $region);

//

//       $comuna = trim($_POST['comuna']);

//       $comuna = strip_tags($comuna);

//       $comuna = htmlspecialchars($comuna);

//       $comuna = mysqli_real_escape_string($conn, $comuna);

//

//       if( !$error ) {

//

//         $query1 = "UPDATE users SET id_region='$region', id_city='$comuna' WHERE id_user='$userid'";

//

//         if (mysqli_query($conn, $query1)) {

//               $errTyp = "success";

//               $errMSG = "Información agregada con éxito.";

//               unset($type_musician);

//               header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

//               exit();

//        }

//        else {

//         $errTyp = "danger";

//         $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";

//        }

//

//       }else {

//        $errTyp = "danger";

//        $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

//      }

//   }





//Insert Bank Data

  if(isset($_POST['accountSubmit'])){



// Turn On and Off

    // header("location: alpha_test.php");

    // die();





   //Clean Names

   $fname = trim($_POST['fname']);

   $fname = strip_tags($fname);

   $fname = htmlspecialchars($fname);

   $fname = mysqli_real_escape_string($conn, $fname);



   $lname = trim($_POST['lname']);

   $lname = strip_tags($lname);

   $lname = htmlspecialchars($lname);

   $lname= mysqli_real_escape_string($conn, $lname);

   // Get Bank data

   $nbanco = trim($_POST['bank']);

   $nbanco = strip_tags($nbanco);

   $nbanco = htmlspecialchars($nbanco);

   $nbanco= mysqli_real_escape_string($conn, $nbanco);



   $tcuenta = trim($_POST['tcuenta']);

   $tcuenta = strip_tags($tcuenta);

   $tcuenta = htmlspecialchars($tcuenta);

   $tcuenta= mysqli_real_escape_string($conn, $tcuenta);



   $ncuenta = trim($_POST['ncuenta']);

   $ncuenta = strip_tags($ncuenta);

   $ncuenta = htmlspecialchars($ncuenta);

   $ncuenta = mysqli_real_escape_string($conn, $ncuenta);



   //Get RUT

   $rut = trim($_POST['rut']);

   $rut = strip_tags($rut);

   $rut = htmlspecialchars($rut);

   $rut = mysqli_real_escape_string($conn, $rut);



   //Get email

   $email = trim($_POST['bank_email']);

   $email = strip_tags($email);

   $email = htmlspecialchars($email);

   $email = mysqli_real_escape_string($conn, $email);



   // Get phone

   $phone = trim($_POST['phone']);

   $phone = strip_tags($phone);

   $phone = htmlspecialchars($phone);

   $phone = mysqli_real_escape_string($conn, $phone);

   $phone = str_replace("(+56)","",$phone);

   $phone = str_replace(" ","",$phone);

    // Get location

    $direction = trim($_POST['direction']);

    $direction = strip_tags($direction);

    $direction = htmlspecialchars($direction);

    $direction = mysqli_real_escape_string($conn, $direction);



   //Data Validation

   if (empty($fname)) {

    $error = true;

    $fnameError = "Por favor ingresa tu nombre.";

  } else if (strlen($fname) < 3) {

    $error = true;

    $fnameError = "El nombre debe tener más de 3 caracteres";

  } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$fname)) {

    $error = true;

    $fnameError = "El nombre solo puede contener letras";

   }



   //basic last_name validation

   if (empty($lname)) {

    $error = true;

    $lnameError = "Por favor ingresa tu apellido.";

  } else if (strlen($lname) < 3) {

    $error = true;

    $lnameError = "El apellido debe tener más de 3 caracteres";

  } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$lname)) {

    $error = true;

    $lnameError = "El apellido solo puede contener letras";

   }



   //Check Bank Data Empty or not

   if (empty($nbanco)) {

    $error = true;

    $bankError = "Por favor selecciona tu banco.";

  }

  if(empty($tcuenta)){

    $error = true;

    $tcuentaError = "Por favor selecciona tu tipo de cuenta.";

  }

  if(empty($ncuenta)){

    $error = true;

    $ncuentaError = "Por favor ingresa el número de tu cuenta.";

  }else if (strlen($ncuenta) < 5){

    $error = true;

    $ncuentaError = "El número de tu cuenta debe tener más de 5 caracteres.";

  }else if(!preg_match("/^[0-9][0-9]*$/", $ncuenta)){

    $error = true;

    $ncuentaError = "El número de cuenta solo puede contener números.";

  }



  // Check RUT

  if(valida_rut($rut) == false){

    $error = true;

    $rutError = "Por favor ingresa un RUT válido.";

  }



  // Check Email

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $bankEmailError = "Por favor ingresa una dirección de correo válida";

  }



  // Check Phone

  if(empty($phone)){

    $error = true;

    $phoneError = "Por favor ingresa tu número de teléfono.";

  }else if (strlen($phone) < 9 || strlen($phone) > 9){

    $error = true;

    $phoneError = "El número de teléfono debe tener 9 dígitos.";

  }else if(!preg_match("/^[1-9][0-9]*$/", $phone)){

    $error = true;

    $phoneError = "El teléfono solo puede contener números.";

  }

  if (empty($direction)) {
   $error = true;
   $directionError = "Por favor ingresa domicilio tributario.";
 } else if (strlen($direction) < 3) {
   $error = true;
   $directionError = "El domicilio debe tener más de 3 caracteres";
 } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W.,]+$/",$direction)) {
   $error = true;
   $directionError = "El domicilio solo puede contener letras, números y puntuaciones";
  }





  if( !$error ){

    $queryBankData = "INSERT INTO user_data(rut, ncuenta, id_bank, id_type_account, fname, lname, phone, id_user, mail, direction) VALUES('$rut', '$ncuenta', '$nbanco', '$tcuenta', '$fname', '$lname', '$phone', '$userid', '$email', '$direction')";



    if (mysqli_query($conn, $queryBankData)) {

     mysqli_query($conn, "UPDATE users SET data_ready='yes' WHERE id_user='$userid'");

     $errTyp = "success";

     $errMSG = "Registro exitoso";

     $_SESSION['success'] = $errMSG;

     $_SESSION['tab'] = 'collapseMyData';

     header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

     exit();

    } else {

     $errTyp = "danger";

     $_SESSION['tab'] = 'collapseMyData';

     $errMSG = "Ha sucedido un error, por favor intentalo de nuevo.";

    }

  }else {

   $errTyp = "danger";

   $_SESSION['tab'] = 'collapseMyData';

   $errMSG = "Ha sucedido un error, por favor revisa la información e intentalo de nuevo.";

  }

}

  //FIN ingreso de BankData



//Update Bank Data

  if(isset($_POST['accountUpdate'])){

    // Turn Off and On

    // header("location: alpha_test.php");

    // die();



   //Clean Names

   $fname = trim($_POST['fname']);

   $fname = strip_tags($fname);

   $fname = htmlspecialchars($fname);

   $fname = mysqli_real_escape_string($conn, $fname);



   $lname = trim($_POST['lname']);

   $lname = strip_tags($lname);

   $lname = htmlspecialchars($lname);

   $lname= mysqli_real_escape_string($conn, $lname);

   // Get Bank data

   $nbanco = trim($_POST['bank']);

   $nbanco = strip_tags($nbanco);

   $nbanco = htmlspecialchars($nbanco);

   $nbanco= mysqli_real_escape_string($conn, $nbanco);



   $tcuenta = trim($_POST['tcuenta']);

   $tcuenta = strip_tags($tcuenta);

   $tcuenta = htmlspecialchars($tcuenta);

   $tcuenta= mysqli_real_escape_string($conn, $tcuenta);



   $ncuenta = trim($_POST['ncuenta']);

   $ncuenta = strip_tags($ncuenta);

   $ncuenta = htmlspecialchars($ncuenta);

   $ncuenta = mysqli_real_escape_string($conn, $ncuenta);



   //Get RUT

   $rut = trim($_POST['rut']);

   $rut = strip_tags($rut);

   $rut = htmlspecialchars($rut);

   $rut = mysqli_real_escape_string($conn, $rut);



   //Get email

   $email = trim($_POST['bank_email']);

   $email = strip_tags($email);

   $email = htmlspecialchars($email);

   $email = mysqli_real_escape_string($conn, $email);



   // Get phone

   $phone = trim($_POST['phone']);

   $phone = strip_tags($phone);

   $phone = htmlspecialchars($phone);

   $phone = mysqli_real_escape_string($conn, $phone);

   $phone = str_replace("(+56)","",$phone);

   $phone = str_replace(" ","",$phone);


   // Get location

   $direction = trim($_POST['direction']);

   $direction = strip_tags($direction);

   $direction = htmlspecialchars($direction);

   $direction = mysqli_real_escape_string($conn, $direction);



   //Data Validation

   if (empty($fname)) {

    $error = true;

    $first_nameError = "Por favor ingresa tu nombre.";

  } else if (strlen($fname) < 3) {

    $error = true;

    $first_nameError = "El nombre debe tener más de 3 caracteres";

  } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$fname)) {

    $error = true;

    $first_nameError = "El nombre solo puede contener letras";

   }



   //basic last_name validation

   if (empty($lname)) {

    $error = true;

    $last_nameError = "Por favor ingresa tu apellido.";

  } else if (strlen($lname) < 3) {

    $error = true;

    $last_nameError = "El apellido debe tener más de 3 caracteres";

  } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$lname)) {

    $error = true;

    $last_nameError = "El apellido solo puede contener letras";

   }



   //Check Bank Data Empty or not

   if (empty($nbanco)) {

    $error = true;

    $bankError = "Por favor selecciona tu banco.";

  }

  if(empty($tcuenta)){

    $error = true;

    $tcuentaError = "Por favor selecciona tu tipo de cuenta.";

  }

  if(empty($ncuenta)){

    $error = true;

    $ncuentaError = "Por favor ingresa el número de tu cuenta.";

  }else if (strlen($ncuenta) < 5){

    $error = true;

    $ncuentaError = "El número de tu cuenta debe tener más de 5 caracteres.";

  }else if(!preg_match("/^[0-9][0-9]*$/", $ncuenta)){

    $error = true;

    $ncuentaError = "El número de cuenta solo puede contener números.";

  }



  // Check RUT

  if(valida_rut($rut) == false){

    $error = true;

    $rutError = "Por favor ingresa un RUT válido.";

  }



  // Check Email

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $bankEmailError = "Por favor ingresa una dirección de correo válida";

  }



  // Check Phone

  if(empty($phone)){

    $error = true;

    $phoneError = "Por favor ingresa tu número de teléfono.";

  }else if (strlen($phone) < 9 || strlen($phone) > 9 ){

    $error = true;

    $phoneError = "El número de teléfono debe tener 9 dígitos.";

  }else if(!preg_match("/^[1-9][0-9]*$/", $phone)){

    $error = true;

    $phoneError = "El teléfono solo puede contener números.";

  }

  if (empty($direction)) {
   $error = true;
   $directionError = "Por favor ingresa domicilio tributario.";
 } else if (strlen($direction) < 3) {
   $error = true;
   $directionError = "El domicilio debe tener más de 3 caracteres";
 } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W.,]+$/",$direction)) {
   $error = true;
   $directionError = "El domicilio solo puede contener letras, números y puntuaciones";
  }



  // RECUERDA PASAR POR HASH LA INFO



  if( !$error ){

    $queryBankData = "UPDATE user_data SET rut='$rut', ncuenta='$ncuenta', id_bank='$nbanco', id_type_account='$tcuenta', fname='$fname', lname='$lname', phone='$phone', mail='$email', direction='$direction' WHERE id_user='$userid'";



    if (mysqli_query($conn, $queryBankData)) {

     $errTyp = "success";

     $errMSG = "Información cambiada con éxito.";

     $_SESSION['success'] = $errMSG;

     $_SESSION['tab'] = 'collapseMyData';

     header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

     exit();

    } else {

     $errTyp = "danger";

     $_SESSION['tab'] = 'collapseMyData';

     $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo";

    }

  }else {

   $errTyp = "danger";

   $_SESSION['tab'] = 'collapseMyData';

   $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo";

  }

}

  //FIN update de BankData



// Plan 1

  if ( isset($_POST['submit_plan_1']) ) {



    $typePlan = trim($_POST['plan_type1']);

    $typePlan = mysqli_real_escape_string($conn, $typePlan);



    $valuePlan = trim($_POST['value_plan1']);

    $valuePlan = strip_tags($valuePlan);

    $valuePlan = htmlspecialchars($valuePlan);

    $valuePlan = mysqli_real_escape_string($conn, $valuePlan);

    $valuePlan = str_replace(".", "", $valuePlan);



    $descPlan = trim($_POST['plan_desc1']);

    $descPlan = strip_tags($descPlan);

    $descPlan = htmlspecialchars($descPlan);

    $descPlan = mysqli_real_escape_string($conn, $descPlan);



    $backlinePlan = $_POST['backline_plan1'];

    $backlinePlan = mysqli_real_escape_string($conn, $backlinePlan);



    $sReinforcementPlan = $_POST['soundReinforcement_plan1'];

    $sReinforcementPlan = mysqli_real_escape_string($conn, $sReinforcementPlan);



    $sEngineerPlan = $_POST['soundEngineer_plan1'];

    $sEngineerPlan = mysqli_real_escape_string($conn, $sEngineerPlan);



    $hoursPlan = $_POST['hours_plan1'];

    $hoursPlan = mysqli_real_escape_string($conn, $hoursPlan);



    $minutesPlan = $_POST['minutes_plan1'];

    $minutesPlan = mysqli_real_escape_string($conn, $minutesPlan);



    $nArtistsPlan = $_POST['nArtists_plan1'];

    $nArtistsPlan = mysqli_real_escape_string($conn, $nArtistsPlan);



    // Generate Fee

    $fee = 12;

    $commissionPlan = 0;

    $a = $valuePlan / 100;

    $a = $a * $fee;

    $commissionPlan = intval($a);



    // data validation

  if (empty($valuePlan)) {

     $error = true;

     $valueError = "Elige el valor de este plan.";

   }else if(!preg_match("/^[1-9][0-9]*$/", $valuePlan)){

     $error = true;

     $valueError = "Solo puede contener números.";

   }



  if (strlen($descPlan) < 30) {

     $error = true;

     $descError = "La descripción debe tener más de 30 caracteres.";

   }else if (strlen($descPlan) > 300) {

    $error = true;

    $descError = "La descripción no puede tener más de 300 caracteres.";

  }



  if(empty($backlinePlan)){

    $error = true;

    $backlineError = "Elige una opción";

  }else if(strlen($backlinePlan)>1){

    $error = true;

    $backlineError = "Elige una opción";

  }



  if(empty($sReinforcementPlan)){

    $error = true;

    $sReinforcementError = "Elige una opción";

  }else if(strlen($sReinforcementPlan)>1){

    $error = true;

    $sReinforcementError = "Elige una opción";

  }



  if(empty($sEngineerPlan)){

    $error = true;

    $sEngineerError = "Elige una opción";

  }else if(strlen($sEngineerPlan)>1){

    $error = true;

    $sEngineerError = "Elige una opción";

  }



  if(empty($nArtistsPlan)){

    $error = true;

    $nArtistsError = "Elige una opción";

  }else if(strlen($nArtistsPlan)>2){

    $error = true;

    $nArtistsError = "Elige una opción";

  }



  if(strlen($hoursPlan)!=1){

    $error = true;

    $hoursError = "Elige una opción";

  }



  if(strlen($minutesPlan)>2){

    $error = true;

    $minutesError = "Elige una opción";

  }



  if($hoursPlan == '0' && $minutesPlan == '0'){

    $error = true;

    $hoursError = "Define la duración";

    $minutesError = "Define la duración";

  }



   if( !$error ) {



     $query = "UPDATE plans SET id_name_plan='$typePlan', value_plan='$valuePlan', commission_plan='$commissionPlan', desc_plan='$descPlan', active='active', duration_hours='$hoursPlan', duration_minutes='$minutesPlan', backline='$backlinePlan', sound_engineer='$sEngineerPlan', artists_amount='$nArtistsPlan', sound_reinforcement='$sReinforcementPlan' WHERE slot_plan='1' AND id_user='$userid'";



      if (mysqli_query($conn, $query)) {

            $errTyp = "success";

            $errMSG = "Información agregada con éxito";

            unset($typePlan);

            unset($valuePlan);

            unset($descPlan);

            $_SESSION['success'] = $errMSG;

            $_SESSION['tab'] = 'collapseMyPlans';

            header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

            exit();

          }else {

           $errTyp = "danger";

           $_SESSION['tab'] = 'collapseMyPlans';

           $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";

          }

     }else {

      $errTyp = "danger";

      $_SESSION['tab'] = 'collapseMyPlans';

      $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

     }



  }

  if(isset($_POST['delete_plan_1'])){

    $query = "UPDATE plans SET id_name_plan='0', value_plan='0', commission_plan='', desc_plan='', active='none', duration_hours='', duration_minutes='', backline='', sound_engineer='', artists_amount='', sound_reinforcement='' WHERE slot_plan='1' AND id_user='$userid'";

    if(mysqli_query($conn, $query)){

      $_SESSION['tab'] = 'collapseMyPlans';

      header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

      exit();

    }

    else {

     $errTyp = "danger";

     $_SESSION['tab'] = 'collapseMyPlans';

     $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";

    }

  }



// Plan 2

  if ( isset($_POST['submit_plan_2']) ) {



    $typePlan = $_POST['plan_type2'];

    $typePlan = mysqli_real_escape_string($conn, $typePlan);



    $valuePlan = trim($_POST['value_plan2']);

    $valuePlan = strip_tags($valuePlan);

    $valuePlan = htmlspecialchars($valuePlan);

    $valuePlan = mysqli_real_escape_string($conn, $valuePlan);

    $valuePlan = str_replace(".", "", $valuePlan);



    $descPlan = trim($_POST['plan_desc2']);

    $descPlan = strip_tags($descPlan);

    $descPlan = htmlspecialchars($descPlan);

    $descPlan = mysqli_real_escape_string($conn, $descPlan);



    $backlinePlan = $_POST['backline_plan2'];

    $backlinePlan = mysqli_real_escape_string($conn, $backlinePlan);



    $sReinforcementPlan = $_POST['soundReinforcement_plan2'];

    $sReinforcementPlan = mysqli_real_escape_string($conn, $sReinforcementPlan);



    $sEngineerPlan = $_POST['soundEngineer_plan2'];

    $sEngineerPlan = mysqli_real_escape_string($conn, $sEngineerPlan);



    $hoursPlan = $_POST['hours_plan2'];

    $hoursPlan = mysqli_real_escape_string($conn, $hoursPlan);



    $minutesPlan = $_POST['minutes_plan2'];

    $minutesPlan = mysqli_real_escape_string($conn, $minutesPlan);



    $nArtistsPlan = $_POST['nArtists_plan2'];

    $nArtistsPlan = mysqli_real_escape_string($conn, $nArtistsPlan);



    // Generate Fee

    $fee = 12;

    $commissionPlan = 0;

    $a = $valuePlan / 100;

    $a = $a * $fee;

    $commissionPlan = $a;



    // data validation

    if (empty($valuePlan)) {

       $error = true;

       $valueError = "Elige el valor de este plan.";

     }else if(!preg_match("/^[1-9][0-9]*$/", $valuePlan)){

       $error = true;

       $valueError = "Solo puede contener números.";

     }



    if (strlen($descPlan) < 30) {

       $error = true;

       $descError = "La descripción debe tener más de 30 caracteres.";

     }else if (strlen($descPlan) > 300) {

      $error = true;

      $descError = "La descripción no puede tener más de 300 caracteres.";

    }



    if(empty($backlinePlan)){

      $error = true;

      $backlineError = "Elige una opción";

    }else if(strlen($backlinePlan)>1){

      $error = true;

      $backlineError = "Elige una opción";

    }



    if(empty($sReinforcementPlan)){

      $error = true;

      $sReinforcementError = "Elige una opción";

    }else if(strlen($sReinforcementPlan)>1){

      $error = true;

      $sReinforcementError = "Elige una opción";

    }



    if(empty($sEngineerPlan)){

      $error = true;

      $sEngineerError = "Elige una opción";

    }else if(strlen($sEngineerPlan)>1){

      $error = true;

      $sEngineerError = "Elige una opción";

    }



    if(empty($nArtistsPlan)){

      $error = true;

      $nArtistsError = "Elige una opción";

    }else if(strlen($nArtistsPlan)>2){

      $error = true;

      $nArtistsError = "Elige una opción";

    }



    if(strlen($hoursPlan)!=1){

      $error = true;

      $hoursError = "Elige una opción";

    }



    if(strlen($minutesPlan)>2){

      $error = true;

      $minutesError = "Elige una opción";

    }



    if($hoursPlan == '0' && $minutesPlan == '0'){

      $error = true;

      $hoursError = "Define la duración";

      $minutesError = "Define la duración";

    }



   if( !$error ) {



     $query = "UPDATE plans SET id_name_plan='$typePlan', value_plan='$valuePlan', commission_plan='$commissionPlan', desc_plan='$descPlan', active='active', duration_hours='$hoursPlan', duration_minutes='$minutesPlan', backline='$backlinePlan', sound_engineer='$sEngineerPlan', artists_amount='$nArtistsPlan', sound_reinforcement='$sReinforcementPlan' WHERE slot_plan='2' AND id_user='$userid'";



      if (mysqli_query($conn, $query)) {

            $errTyp = "success";

            $errMSG = "Información agregada con éxito";

            unset($typePlan);

            unset($valuePlan);

            unset($descPlan);

            $_SESSION['success'] = $errMSG;

            $_SESSION['tab'] = 'collapseMyPlans';

            header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

            exit();

          }else {

           $errTyp = "danger";

           $_SESSION['tab'] = 'collapseMyPlans';

           $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";

          }

     }

     else {

      $errTyp = "danger";

      $_SESSION['tab'] = 'collapseMyPlans';

      $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

     }

  }

  if(isset($_POST['delete_plan_2'])){

    $query = "UPDATE plans SET id_name_plan='0', value_plan='0', commission_plan='', desc_plan='', active='none', duration_hours='', duration_minutes='', backline='', sound_engineer='', artists_amount='', sound_reinforcement='' WHERE slot_plan='2' AND id_user='$userid'";

    if(mysqli_query($conn, $query)){

      $_SESSION['tab'] = 'collapseMyPlans';

      header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

      exit();

    }

    else {

     $errTyp = "danger";

     $_SESSION['tab'] = 'collapseMyPlans';

     $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";

    }

  }



// Plan 3

  if ( isset($_POST['submit_plan_3']) ) {



    $typePlan = $_POST['plan_type3'];

    $typePlan = mysqli_real_escape_string($conn, $typePlan);



    $valuePlan = trim($_POST['value_plan3']);

    $valuePlan = strip_tags($valuePlan);

    $valuePlan = htmlspecialchars($valuePlan);

    $valuePlan = mysqli_real_escape_string($conn, $valuePlan);

    $valuePlan = str_replace(".", "", $valuePlan);



    $descPlan = trim($_POST['plan_desc3']);

    $descPlan = strip_tags($descPlan);

    $descPlan = htmlspecialchars($descPlan);

    $descPlan = mysqli_real_escape_string($conn, $descPlan);



    $backlinePlan = $_POST['backline_plan3'];

    $backlinePlan = mysqli_real_escape_string($conn, $backlinePlan);



    $sReinforcementPlan = $_POST['soundReinforcement_plan3'];

    $sReinforcementPlan = mysqli_real_escape_string($conn, $sReinforcementPlan);



    $sEngineerPlan = $_POST['soundEngineer_plan3'];

    $sEngineerPlan = mysqli_real_escape_string($conn, $sEngineerPlan);



    $hoursPlan = $_POST['hours_plan3'];

    $hoursPlan = mysqli_real_escape_string($conn, $hoursPlan);



    $minutesPlan = $_POST['minutes_plan3'];

    $minutesPlan = mysqli_real_escape_string($conn, $minutesPlan);



    $nArtistsPlan = $_POST['nArtists_plan3'];

    $nArtistsPlan = mysqli_real_escape_string($conn, $nArtistsPlan);



    // Generate Fee

    $fee = 12;

    $commissionPlan = 0;

    $a = $valuePlan / 100;

    $a = $a * $fee;

    $commissionPlan = $a;



    // data validation

    if (empty($valuePlan)) {

     $error = true;

     $valueError = "Por favor elige el valor de este plan.";

   }else if(!preg_match("/^[1-9][0-9]*$/", $valuePlan)){

     $error = true;

     $valueError = "El valor solo puede contener números.";

   }

   if (strlen($descPlan) < 30) {

    $error = true;

    $descError = "La descripción debe tener más de 30 caracteres.";

  }else if (strlen($descPlan) > 300) {

   $error = true;

   $descError = "La descripción no puede tener más de 300 caracteres.";

   }

   if(empty($backlinePlan)){

     $error = true;

     $backlineError = "Elige una opción";

   }else if(strlen($backlinePlan)>1){

     $error = true;

     $backlineError = "Elige una opción";

   }



   if(empty($sReinforcementPlan)){

     $error = true;

     $sReinforcementError = "Elige una opción";

   }else if(strlen($sReinforcementPlan)>1){

     $error = true;

     $sReinforcementError = "Elige una opción";

   }



   if(empty($sEngineerPlan)){

     $error = true;

     $sEngineerError = "Elige una opción";

   }else if(strlen($sEngineerPlan)>1){

     $error = true;

     $sEngineerError = "Elige una opción";

   }



   if(empty($nArtistsPlan)){

     $error = true;

     $nArtistsError = "Elige una opción";

   }else if(strlen($nArtistsPlan)>2){

     $error = true;

     $nArtistsError = "Elige una opción";

   }



   if(strlen($hoursPlan)!=1){

     $error = true;

     $hoursError = "Elige una opción";

   }



   if(strlen($minutesPlan)>2){

     $error = true;

     $minutesError = "Elige una opción";

   }



   if($hoursPlan == '0' && $minutesPlan == '0'){

     $error = true;

     $hoursError = "Define la duración";

     $minutesError = "Define la duración";

   }



   if( !$error ) {



     $query = "UPDATE plans SET id_name_plan='$typePlan', value_plan='$valuePlan', commission_plan='$commissionPlan', desc_plan='$descPlan', active='active', duration_hours='$hoursPlan', duration_minutes='$minutesPlan', backline='$backlinePlan', sound_engineer='$sEngineerPlan', artists_amount='$nArtistsPlan', sound_reinforcement='$sReinforcementPlan' WHERE slot_plan='3' AND id_user='$userid'";



      if (mysqli_query($conn, $query)) {

            $errTyp = "success";

            $errMSG = "Información agregada con éxito.";

            unset($typePlan);

            unset($valuePlan);

            unset($descPlan);

            $_SESSION['success'] = $errMSG;

            $_SESSION['tab'] = 'collapseMyPlans';

            header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

            exit();

          }else {

           $errTyp = "danger";

           $_SESSION['tab'] = 'collapseMyPlans';

           $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";

          }

     }

     else {

      $errTyp = "danger";

      $_SESSION['tab'] = 'collapseMyPlans';

      $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

     }

  }

  if(isset($_POST['delete_plan_3'])){

    $query = "UPDATE plans SET id_name_plan='0', value_plan='0', commission_plan='', desc_plan='', active='none', duration_hours='', duration_minutes='', backline='', sound_engineer='', artists_amount='', sound_reinforcement='' WHERE slot_plan='3' AND id_user='$userid'";

    if(mysqli_query($conn, $query)){

      $_SESSION['tab'] = 'collapseMyPlans';

      header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

      exit();

    }

    else {

     $errTyp = "danger";

     $_SESSION['tab'] = 'collapseMyPlans';

     $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";

    }

  }



 // Contact Request

  if(isset($_POST['submit_contact'])){





    $subject_request = trim($_POST['subject']);

    $subject_request = strip_tags($subject_request);

    $subject_request = htmlspecialchars($subject_request);

    $subject_request = mysqli_real_escape_string($conn, $subject_request);



    $desc_request = trim($_POST['description_text']);

    $desc_request = strip_tags($desc_request);

    $desc_request = htmlspecialchars($desc_request);

    $desc_request = mysqli_real_escape_string($conn,$desc_request);



    $lname_request = $userProfile_array['last_name_user'];



    $fname_request = $userProfile_array['first_name_user'];



    $user_request = $userProfile_array['id_type_user'];



    $email_request = $userProfile_array['mail_user'];

    // Get current datetime

    $date_request = date('Y-m-d H:i:s', time());



    if (strlen($subject_request) < 5) {

     $error = true;

     $subjectError = "La descripción debe tener más de 5 caracteres.";

   }else if(strlen($subject_request)>100){

      $error = true;

      $subjectError = "La descripción no puede tener más de 100 caracteres.";

   }



    if (strlen($desc_request) < 20) {

     $error = true;

     $descError = "La descripción debe tener más de 20 caracteres.";

   }else if(strlen($desc_request)>1200){

      $error = true;

      $descError = "La descripción no puede tener más de 1200 caracteres.";

   }



  if(!$error){



    $queryRequest = "INSERT INTO requests(fname_request, lname_request, subject_request, email_request, message_request, status_request, user_request, date_request) VALUES('$fname_request', '$lname_request', '$subject_request', '$email_request', '$desc_request', 'open', '$user_request', '$date_request')";

    if(mysqli_query($conn, $queryRequest)){

      $errTypPublish = "success";

      $errMSG = "Información enviada con éxito.";

      // Mail a soporte

      $text = '<html><p><strong>Asunto: '.$subject_request.'</strong></br>'.$desc_request.'</p></html>';

      $headers = "MIME-Version: 1.0" . "\r\n";

      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

      $headers .= 'From: '.$email_request.'' . "\r\n";

      if(mail('contacto@echomusic.cl', "Contacto, Soporte usuarios", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Mensaje Enviado, nos pondremos en contacto contigo a la brevedad";

      }

      unset($fname_request);

      unset($lname_request);

      unset($desc_request);

      unset($email_request);

      $_SESSION['success'] = $errMSG;

      $_SESSION['tab'] = 'collapseMySupport';

      header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

      exit();

    }else{

      $errTyp = "danger";

      $openContact == true;

      $hideEvents == true;

      $_SESSION['tab'] = 'collapseMySupport';

      $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";

    }

  }else {

   $errTyp = "danger";

   $openContact == true;

   $hideEvents == true;

   $_SESSION['tab'] = 'collapseMySupport';

   $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

  }

}

// invitations public event

if(isset($_POST['invitation_submit'])){

  // Get data
    $invitation_fname = trim($_POST['invitation_fname']);
    $invitation_fname = strip_tags($invitation_fname);
    $invitation_fname = htmlspecialchars($invitation_fname);
    $invitation_fname = mysqli_real_escape_string($conn, $invitation_fname);

    $invitation_lname = trim($_POST['invitation_lname']);
    $invitation_lname = strip_tags($invitation_lname);
    $invitation_lname = htmlspecialchars($invitation_lname);
    $invitation_lname= mysqli_real_escape_string($conn, $invitation_lname);

    $invitation_rut = trim($_POST['invitation_rut']);
    $invitation_rut = strip_tags($invitation_rut);
    $invitation_rut = htmlspecialchars($invitation_rut);
    $invitation_rut = mysqli_real_escape_string($conn, $invitation_rut);

    $invitation_email = trim($_POST['invitation_email']);
    $invitation_email = strip_tags($invitation_email);
    $invitation_email = htmlspecialchars($invitation_email);
    $invitation_email = mysqli_real_escape_string($conn, $invitation_email);

    $invitation_event = trim($_POST['invitation_id']);
    $invitation_event = strip_tags($invitation_event);
    $invitation_event = htmlspecialchars($invitation_event);
    $invitation_event = mysqli_real_escape_string($conn, $invitation_event);

  //Data Validation
     // fname
    if (empty($invitation_fname)) {
       $error = true;
       $invitation_fnameError = "Por favor ingresa tu nombre.";
     } else if (strlen($invitation_fname) < 3) {
       $error = true;
       $invitation_fnameError = "El nombre debe tener más de 3 caracteres";
     } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$invitation_fname)) {
       $error = true;
       $invitation_fnameError = "El nombre solo puede contener letras";
     }

     // lname
      if (empty($invitation_lname)) {
       $error = true;
       $invitation_lnameError = "Por favor ingresa tu apellido.";
     } else if (strlen($invitation_lname) < 3) {
       $error = true;
       $invitation_lnameError = "El apellido debe tener más de 3 caracteres";
     } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$invitation_lname)) {
       $error = true;
       $invitation_lnameError = "El apellido solo puede contener letras";
      }

   // Check RUT
     if(valida_rut($invitation_rut) == false){
       $error = true;
       $invitation_rutError = "Por favor ingresa un RUT válido.";
     }

   // Check Email
     if ( !filter_var($invitation_email,FILTER_VALIDATE_EMAIL) ) {
      $error = true;
      $invitation_emailError = "Por favor ingresa una dirección de correo válida";
     }

 // Check entries
     if(FILTER_INPUT(INPUT_POST, 'invitation_entries', FILTER_VALIDATE_INT, 1)){
       $invitation_entries = trim($_POST['invitation_entries']);
       $invitation_entries = mysqli_real_escape_string($conn, $invitation_entries);
     }else if(empty($_POST['invitation_entries'])){
       $error = true;
       $invitation_entriesError = "Por favor elige cuantas entradas quieres.";
     }else{
       $error = true;
       $invitation_entriesError = "Cantidad de entradas inválida.";
     }

     if($invitation_entries>10){
       $error = true;
       $invitation_entriesError = "Lo sentimos, no puedes comprar más de 10 entradas.";
     }

    if(!FILTER_VAR($invitation_event, FILTER_VALIDATE_INT)){
       $error = true;
       $invitation_eventError = "ID inválido";
    }

    // check event status and user
    $queryCheckInvitationData = mysqli_query($conn, "SELECT id_event FROM events_public WHERE id_event='$invitation_event' AND id_user='$userid' AND active_event='1'");
    if(mysqli_num_rows($queryCheckInvitationData)<=0){
      $error = true;
      $invitation_eventError = "Evento inválido";
    }



  // If there's no error...
       if( !$error ) {

           $queryTransaction = mysqli_query($conn, "INSERT INTO transactions_public(id_event, id_type_event, id_user, n_tickets, amount_transaction_public, amount_transaction_commission, payment_status) VALUES ('$invitation_event', '2', '0', '$invitation_entries', '0', '0', 'pending')");

           $checkTransaction = mysqli_query($conn, "SELECT id_transaction_public FROM transactions_public WHERE id_event='$invitation_event' AND id_type_event='2' AND payment_status='pending' AND id_user='0' AND id_transaction_public=(SELECT MAX(id_transaction_public) FROM transactions_public WHERE id_event='$invitation_event' AND id_user='0')");

           $arrayTransaction = mysqli_fetch_array($checkTransaction);

           $id_transaction = $arrayTransaction['id_transaction_public'];

           $session_id = random_str(12);

           $sqlSubscribe = "INSERT INTO subscribes_public (id_event_public, id_user, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email, order_transaction, subscribe_status) VALUES ('$invitation_event', '0', '$invitation_fname', '$invitation_lname', '$invitation_rut', '$invitation_email', '$session_id', '0');";
           for($y = 1; $y <$invitation_entries; $y++){
             $sqlSubscribe .= "INSERT INTO subscribes_public (id_event_public, id_user, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email, order_transaction, subscribe_status) VALUES ('$invitation_event', '0', '$invitation_fname', '$invitation_lname', '$invitation_rut', '$invitation_email', '$session_id', '0');";
           }
           mysqli_multi_query($conn, $sqlSubscribe);
           while (mysqli_next_result($conn)) // flush multi_queries
             {
               if (!mysqli_more_results($conn)) break;
             }
           mysqli_query($conn, "UPDATE transactions_public SET payment_status='paid', order_transaction='$session_id' WHERE id_event='$invitation_event' AND id_type_event='2' AND id_transaction_public='$id_transaction' ");

           $queryDataUser = mysqli_query($conn, "SELECT id_user, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email FROM subscribes_public WHERE order_transaction='$session_id' LIMIT 1");
           $arrayDataUser = mysqli_fetch_array($queryDataUser);

           $queryEventData = mysqli_query($conn, "SELECT * FROM events_public LEFT JOIN cities ON cities.id_city=events_public.id_city WHERE id_event='$invitation_event'");
           $arrayEventData = mysqli_fetch_array($queryEventData);

           $queryTransactionData = mysqli_query($conn, "SELECT * FROM transactions_public WHERE id_event='$invitation_event' AND payment_status='paid' AND id_transaction_public='$id_transaction'");
           $arrayTransactionData = mysqli_fetch_array($queryTransactionData);

           $idArtist = $arrayEventData['id_user'];

           $queryDataArtist = mysqli_query($conn, "SELECT users.nick_user, user_data.rut FROM users LEFT JOIN user_data ON users.id_user = user_data.id_user WHERE users.id_user='$idArtist'");
           $arrayDataArtist = mysqli_fetch_array($queryDataArtist);

           $dateTimeEvent = date_create($arrayEventData['date_event']);
           $timeEventMail = DATE_FORMAT($dateTimeEvent, 'H:i');
           $dateEventMail = DATE_FORMAT($dateTimeEvent, 'd/m/Y');

           $dateTimeTransaction = date_create($arrayTransactionData['date_transaction']);
           $timeTransaction = DATE_FORMAT($dateTimeTransaction, 'H:i');
           $dateTransaction = DATE_FORMAT($dateTimeTransaction, 'd/m/Y');

           $transactionCode = sprintf('%04d', $id_transaction);
           $eventCode = sprintf('%04d', $invitation_event);
           $typeCode = '02';
           $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

           $nameEvent = $arrayEventData['name_event'];
           $nameLocationEvent = $arrayEventData['name_location'];
           $locationEvent = $arrayEventData['location'].', '.$arrayEventData['name_city'];

           $rawEventValue = 0;
           $rawEventValueCommision = 0;
           $rawEventTotal = $rawEventValue + $rawEventValueCommision;

           $singleTicketValue = 0;
           $singleTicketCommission = 0;
           $singleTicketTotal = number_format($singleTicketValue+$singleTicketCommission , 0, ',', '.');

           $eventValue = 0;
           $eventValueCommision = 0;
           $eventValueTotal = 0;

           $ntickets = $arrayTransactionData['n_tickets'];

          // * NOMBRE BANDA QUE TOCA - CUADRO GRANDE GRIS
           $nick_artist = $arrayDataArtist['nick_user'];
          // * QUIEN ORGANIZA EL EVENTO
           $eventOrganizer = $arrayEventData['organizer'];
          // * RUT ORGANIZADOR
           $rut_artist = $arrayDataArtist['rut'];

           // Generate IVA
           // $fee = 16;
           // $commissionEvent = 0;
           // $a = $rawEventTotal / 100;
           // $a = $a * $fee;
           $iva= intval(0);

           // set mail user
           $emailUser = $arrayDataUser['subscribe_email'];

           // Start mail object
             $mail = new PHPMailer();
             $mail->Encoding = 'base64';
             $mail->CharSet = 'UTF-8';

           // Get ids subscribes
           $querySubscribes = mysqli_query($conn, "SELECT id_subscribe_public FROM subscribes_public WHERE order_transaction='$session_id'");

           while($ids_subscribes = mysqli_fetch_array($querySubscribes)){
             $id_subscribe = $ids_subscribes['id_subscribe_public'];
           // Generate QR code and unique string
            include 'qr-generator.php';

            $pdfName = random_str(12);

            // mysqli_query($conn, "UPDATE subscribes_public SET verify_string='$randStrURL', subscribe_status='1' WHERE order_transaction='$id_session'");
            mysqli_query($conn, "UPDATE subscribes_public SET verify_string='$randStrURL', subscribe_status='1', ticket_file='$pdfName' WHERE id_subscribe_public='$id_subscribe'");


          // Utilizar qr-temps/$randQRName.php para obtener imagen de código QR
            $varImgQr= '<img id="qr-imgTicket" style="vertical-align: top;width:55%;" src="'.$rutaQR.'" alt="Echomusic">';

           //GENERAMOS EL CUERPO DEL PDF TICKET

            $cuerpoTicketMail = $ticketMail.$varImgQr.$ticketMail1.$paymentCode.$ticketMail2.$nick_artist.$ticketMail3.$locationEvent.' - '.$dateEventMail.' - '.$timeEventMail.$ticketMail4.'Invitación'.$ticketMail4_5.$id_subscribe.$ticketMail5.$ticketMail6.'EVENTO: '.$nameEvent.$ticketMail7.'ORGANIZA: '.$eventOrganizer.$ticketMail8.'RUT: '.$rut_artist.$ticketMail9.'PRECIO: $'.$singleTicketTotal.$ticketMail10;

            $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/images/tmp3']);
            $mpdf->WriteHTML($cuerpoTicketMail);
            // $mpdf->Output(__DIR__ . '/images/tmp3/'.$pdfName.'.pdf', 'F');
            $mpdf->Output(ROOT_PATH . '/images/tickets/'.$pdfName.'.pdf', 'F');

            // $mail->addAttachment(__DIR__ . '/images/tmp3/'.$pdfName.'.pdf', $id_subscribe.'.pdf');
            $mail->addAttachment(ROOT_PATH. '/images/tickets/'.$pdfName.'.pdf', $id_subscribe.'.pdf');

           }


          //GENERAMOS CUERPO DEL CORREO ENTRADA
           $varClienteTicket = '<br><br><b>Estimado(a) '.ucfirst($arrayDataUser['subscribe_fname']).' '.ucfirst($arrayDataUser['subscribe_lname']);

           $varTicket= '<b>Orden de compra:</b></td><td>'.$paymentCode.'<br></td></tr>
           <tr><td><b>Nombre:</b></td><td>'.ucfirst($arrayDataUser['subscribe_fname']).' '.ucfirst($arrayDataUser['subscribe_lname']).'<br></td></tr>
           <tr><td><b>RUT:</b></td><td>'.$arrayDataUser['subscribe_rut'].'<br></td></tr>
           <tr><td><b>E-Mail:</b></td><td>'.$emailUser.'<br></td></tr>
           <tr><td><b>Fecha:</b></td><td>'.$dateTransaction.'<br></td></tr>
           <tr><td><b>Hora:</b></td><td>'.$timeTransaction.' hrs.<br></td></tr>

           <tr><td><b style="color:#ff6600;">Resumen del evento</b><br></td></tr>
           <tr><td><b>Evento:</b></td><td>'.$nameEvent.'<br></td></tr>
           <tr><td><b>Lugar:</b></td><td>'.$nameLocationEvent.' <br></td></tr>
           <tr><td><b>Direcci&oacuten:</b></td><td>'.$locationEvent.'. <br></td></tr>
           <tr><td><b>Fecha:</b></td><td>'.$dateEventMail.'<br></td></tr>
           <tr><td><b>Hora:</b></td><td>'.$timeEventMail.' hrs.<br></tr>

           <tr><td><b style="color:#ff6600;">Datos de entrada</b><br></td></tr>
           <tr><td><b>Items:</b></td><td> '.$ntickets.' <br></td></tr>
           <tr><td><b>Precio:</b></td><td> $'.$eventValue.'<br></td></tr>
           <tr><td><b>Cargo por servicio:</b></td><td> $'.$eventValueCommision.'<br></td></tr>
           <tr><td><b>IVA incluido:</b></td><td> $'.number_format($iva, 0, ',', '.').'<br></td></tr>
           <tr><td><b>Total: </b></td><td> $'.$eventValueTotal.'<br>';


           $textUser = $ticketPremail.$paymentCode.$varClienteTicket.$ticketPremail2.$varTicket.$ticketPremail3;


           $mail->isHTML(true);
           $mail->SetFrom('eventos@echomusic.cl', 'Eventos EchoMusic'); //Name is optional
           $mail->Subject   = 'Entrada(s) de Cortesía';
           $mail->Body     = $textUser;
           $mail->AltBody  = $textUser;
           $mail->AddAddress($emailUser);
           $mail->addBCC('copiaentradas@echomusic.cl');

          $mail->send();


           $errTyp = "success";
           $errMSG = "Entrada(s) ingresada(s) con éxito.";
           $_SESSION['success'] = $errMSG;
           header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
           exit();

      }else {
       $errTyp = "danger";
       $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
      }

    }



} else{

  header('Location: login.php');

  die();

}

?>
