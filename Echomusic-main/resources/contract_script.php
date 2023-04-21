<?php



include 'connect.php';
include 'contractMail.php';
require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



// Turn Off and On

// header("location: cuidemonos/index.php");
//
// die();



// Display info Queries

if(isset($_SESSION['user'])){



  $buyerId = $_SESSION['user'];



// Set plan info

  if(isset($_POST['planInfo'], $_POST['idArtist'])){

    $planId = $_POST['planInfo'];

    $sellerId = $_POST['idArtist'];

    $_SESSION['buyerId'] = $buyerId;

    $_SESSION['sellerId'] = $sellerId;

    $_SESSION['planId'] = $planId;

  }

  if(isset($_SESSION['buyerId'], $_SESSION['sellerId'])){

    $planId = $_SESSION['planId'];

    $buyerId = $_SESSION['buyerId'];

    $sellerId = $_SESSION['sellerId'];

  }



// plan data query

  $queryInfoPlan = mysqli_query($conn, "SELECT * FROM plans LEFT JOIN type_reinforcements id1 on plans.backline = id1.id_type_reinforcement

                                                            LEFT JOIN type_reinforcements id2 on plans.sound_engineer = id2.id_type_reinforcement

                                                            LEFT JOIN type_reinforcements id3 on plans.sound_reinforcement = id3.id_type_reinforcement

                                                            LEFT JOIN name_plan ON plans.id_name_plan = name_plan.id_name_plan

                                                            LEFT JOIN users ON plans.id_user = users.id_user WHERE plans.id_plan='$planId' AND plans.id_user='$sellerId'");



// user data query

  $queryInfoBuyer = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$buyerId'");



// artist data query

  $queryInfoSeller = mysqli_query($conn, "SELECT * FROM users LEFT JOIN desc_user ON users.id_user = desc_user.id_user

                                                           LEFT JOIN type_musician ON users.id_musician = type_musician.id_musician

                                                           LEFT JOIN instruments ON users.id_instrument = instruments.id_instrument

                                                           LEFT JOIN regions ON users.id_region = regions.id_region

                                                           LEFT JOIN cities ON users.id_city = cities.id_city WHERE users.id_user='$sellerId'");





  $queryGenre = mysqli_query($conn, "SELECT * FROM genre_user LEFT JOIN genres ON genre_user.id_genre = genres.id_genre WHERE genre_user.id_user='$sellerId'");



  $genreInfoSeller = mysqli_fetch_array($queryGenre);

  $arrayPlan = mysqli_fetch_array($queryInfoPlan);

  $arrayInfoBuyer = mysqli_fetch_array($queryInfoBuyer);

  $arrayInfoSeller = mysqli_fetch_array($queryInfoSeller);



  $sellerRegion = $arrayInfoSeller['id_region'];

  $planPrice = $arrayPlan['value_plan'];

  $commissionPrice = $arrayPlan['commission_plan'];

  $planName = $arrayPlan['id_name_plan'];

  $planDesc = $arrayPlan['desc_plan'];

  $planHours = $arrayPlan['duration_hours'];

  $planMinutes = $arrayPlan['duration_minutes'];

  $planBackline = $arrayPlan['backline'];

  $planEngi = $arrayPlan['sound_engineer'];

  $planArtistN = $arrayPlan['artists_amount'];

  $planReinforcement = $arrayPlan['sound_reinforcement'];

  $emailSeller = $arrayInfoSeller['mail_user'];

  $genreSeller = $genreInfoSeller['name_genre'];



  $queryRegionsCities = mysqli_query($conn, "SELECT * FROM regions_cities LEFT JOIN cities ON regions_cities.id_city = cities.id_city WHERE id_region='$sellerRegion'");

  $arrayCities = array();

  while($cities = mysqli_fetch_array($queryRegionsCities)){

    $arrayCities[] = $cities;

  }



  // Get Ratings

  $queryRatings = mysqli_query($conn, "SELECT * FROM user_ratings LEFT JOIN users ON user_ratings.id_user = users.id_user WHERE id_artist='$sellerId' AND status_rating='closed' ORDER BY date_rating DESC");

  $rateArray = array();

  while($ratingArray = mysqli_fetch_array($queryRatings)){

    $rateArray[] = $ratingArray;

  }



  function displayTotalRating($rateArray){

    $y = 0;

    $count=0;

    if(count($rateArray)>0){

      foreach($rateArray as $values){

        $count += 1;

        $z = $values['number_rating'];

        $y = $y + $z;

      }

      $totalRating = $y / $count;

      $totalRating = round($totalRating, 1);

      return $totalRating;

      if(is_nan($totalRating)){

        return $totalRating = "Sin valoraciones";

      }

    }else{

      return $totalRating = "Sin valoraciones";

    }

  }



// get artists Plans

  $queryPlans = mysqli_query($conn, "SELECT * from plans LEFT JOIN type_reinforcements id1 on plans.backline = id1.id_type_reinforcement

                                                         LEFT JOIN type_reinforcements id2 on plans.sound_engineer = id2.id_type_reinforcement

                                                         LEFT JOIN type_reinforcements id3 on plans.sound_reinforcement = id3.id_type_reinforcement

                                                         LEFT JOIN name_plan ON plans.id_name_plan = name_plan.id_name_plan WHERE plans.id_user='$sellerId'");

  $planArray = array();

  while($pricingArray = mysqli_fetch_array($queryPlans)){

    $planArray[] = $pricingArray;

  }



// Get Eventos solicitados por usuario

  $queryEventsCheck = mysqli_query($conn, "SELECT * FROM events_private WHERE id_user_sell='$sellerId' AND id_user_buy='$buyerId'");

  $arrayEventsCheck = array();

  while($eventsCheck = mysqli_fetch_array($queryEventsCheck)){

    $arrayEventsCheck[] = $eventsCheck;

  }



// Get Eventos solicitados por usuario

  $queryEvents = mysqli_query($conn, "SELECT date_event FROM events_private WHERE id_user_sell='$sellerId'");

  $arrayEvents = array();

  while($events = mysqli_fetch_array($queryEvents)){

    $events = date_create($events['date_event']);

    $events = DATE_FORMAT($events, 'Y/m/d');

    $events = "'".$events."'";

    $arrayEvents[] = $events;

  }

  // $stringEvents = implode(",",$arrayEvents);

  $stringEvents = "";



  date_default_timezone_set('America/Santiago');



  $monthYear = date('M Y', time());





  $queryMusicianInfo = mysqli_query($conn, "SELECT * FROM type_musician");

  $queryGenresInfo = mysqli_query($conn, "SELECT * FROM genres");

  $queryRegionsInfo = mysqli_query($conn, "SELECT * FROM regions");

  $queryCityInfo = mysqli_query($conn, "SELECT * FROM cities");

  $queryInstrumentInfo = mysqli_query($conn, "SELECT * FROM instruments");



if(isset($_POST['submit_button'])){



    $error = false;

    // Get Data

    $eventName = trim($_POST['eventName']);

    $eventName = strip_tags($eventName);

    $eventName = htmlspecialchars($eventName);

    $eventName = mysqli_real_escape_string($conn, $eventName);



    $eventLocation = trim($_POST['eventLocation']);

    $eventLocation = strip_tags($eventLocation);

    $eventLocation = htmlspecialchars($eventLocation);

    $eventLocation = mysqli_real_escape_string($conn, $eventLocation);



    $eventPhone = trim($_POST['eventPhone']);

    $eventPhone = strip_tags($eventPhone);

    $eventPhone = htmlspecialchars($eventPhone);

    $eventPhone = mysqli_real_escape_string($conn, $eventPhone);

    $eventPhone = str_replace("(+56)","",$eventPhone);

    $eventPhone = str_replace(" ","",$eventPhone);



    $eventRegion = trim($_POST['eventRegion']);

    $eventRegion = strip_tags($eventRegion);

    $eventRegion = htmlspecialchars($eventRegion);

    $eventRegion = mysqli_real_escape_string($conn, $eventRegion);



    $eventCity = trim($_POST['eventCity']);

    $eventCity = strip_tags($eventCity);

    $eventCity = htmlspecialchars($eventCity);

    $eventCity = mysqli_real_escape_string($conn, $eventCity);



    $eventDate = trim($_POST['eventDate']);

    $eventDate = strip_tags($eventDate);

    $eventDate = htmlspecialchars($eventDate);

    $eventDate = mysqli_real_escape_string($conn, $eventDate);



    $eventTime = trim($_POST['eventTime']);

    $eventTime = strip_tags($eventTime);

    $eventTime = htmlspecialchars($eventTime);

    $eventTime = mysqli_real_escape_string($conn, $eventTime);



    $eventDesc = trim($_POST['eventDesc']);

    $eventDesc = strip_tags($eventDesc);

    $eventDesc = htmlspecialchars($eventDesc);

    $eventDesc = mysqli_real_escape_string($conn, $eventDesc);



    //Validate Data

    if (empty($eventName)) {

     $error = true;

     $eventNameError = "Por favor ingresa el nombre del evento.";

   } else if (strlen($eventName) < 3) {

     $error = true;

     $eventNameError = "El nombre del evento debe tener más de 3 caracteres";

   } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$eventName)) {

     $error = true;

     $eventNameError = "El nombre solo puede contener letras y números";

    }



    if (empty($eventLocation)) {

     $error = true;

     $eventLocationError = "Por favor ingresa una dirección.";

   } else if (strlen($eventLocation) < 3) {

     $error = true;

     $eventLocationError = "La dirección debe tener más de 3 caracteres";

   } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$eventLocation)) {

     $error = true;

     $eventLocationError = "El dirección solo puede contener letras y números";

    }



   if(empty($eventPhone)){

     $error = true;

     $eventPhoneError = "Por favor ingresa tu número de teléfono.";

   }else if (strlen($eventPhone) != 9){

     $error = true;

     $eventPhoneError = "El número de teléfono debe tener 9 dígitos.";

   }else if(!preg_match("/^[1-9][0-9]*$/", $eventPhone)){

     $error = true;

     $eventPhoneError = "El teléfono solo puede contener números.";

   }



   if(empty($eventRegion)){

     $error = true;

     $eventRegionError = "Por favor ingresa una Región.";

   }else if (strlen($eventRegion) > 16){

     $error = true;

     $eventRegionError = "Región inválida.";

   }else if(!preg_match("/^[1-9][0-9]*$/", $eventRegion)){

     $error = true;

     $eventRegionError = "Región inválida.";

   }



   if(empty($eventCity)){

     $error = true;

     $eventCityError = "Por favor ingresa tu número de teléfono.";

   }else if (strlen($eventCity) > 346){

     $error = true;

     $eventCityError = "Comuna inválida.";

   }else if(!preg_match("/^[1-9][0-9]*$/", $eventCity)){

     $error = true;

     $eventCityError = "Comuna inválida.";

   }



   if (empty($eventDesc)) {

    $error = true;

    $eventDescError = "Por favor ingresa una dirección.";

  } else if (strlen($eventDesc) < 30) {

    $error = true;

    $eventDescError = "La descripción debe tener más de 30 caracteres";

  } else if (strlen($eventDesc) > 1200) {

    $error = true;

    $eventDescError = "La descripción debe tener menos de 1200 caracteres";

  } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$eventDesc)) {

    $error = true;

    $eventDescError = "Descripción con caracteres inválidos";

   }



   include 'functionValidateDate.php';



    if(validateDate($eventDate)==false){

      $error = true;

      $eventDateError = "Fecha inválida";

    }



    if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $eventTime)){

      $error = true;

      $eventTimeError = "Hora inválida";

    }



   // reCaptcha start

     $g_recaptcha = $_POST['g-recaptcha-response'];



     $data = [

         'secret' => '6Ld2EqUZAAAAAMdpggqnsIwwKaSWzbxmja8XYNZj',

         'response' => $g_recaptcha,

     ];



     $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');

     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);



     // execute!

     $response = curl_exec($ch);



     // close the connection, release resources used

     curl_close($ch);



     $g_recaptcha_response = json_decode($response, true);



     if($g_recaptcha_response['success'] == false){

       $error = true;

       $reCaptchaError = "Error, por favor vuelve a intentarlo";

     }



     // reCaptcha End



// Validate Date Available

   $eventDate = $eventDate.' '.$eventTime;

   $dateToCheck = date_create($eventDate);

   $dateCheck = DATE_FORMAT($dateToCheck, 'Y-m-d');

   $dateNotice = DATE_FORMAT($dateToCheck, 'd-m-Y');

   $timeNotice = DATE_FORMAT($dateToCheck, 'H:i');

   $eventDate = DATE_FORMAT($dateToCheck, 'Y-m-d H:i');



   $today = date('Y-m-d', time());

   if($dateCheck<=$today){

     $error = true;

     $eventDateError = "Fecha inválida";

   }



foreach($arrayEventsCheck as $eventsCheck){

  $dateEventCheck = date_create($eventsCheck['date_event']);

  $dateEventCheck = DATE_FORMAT($dateEventCheck, 'Y-m-d');

   if($dateEventCheck == $dateCheck){

     $error = true;

     $eventDateCheckError = "Ya has solicitado esta fecha para un evento con este artista.";

     $errTyp = 'danger';

     $errMSG = 'Ya has solicitado esta fecha con este artista.';

   }

}



 // Start of queries and stuff

 if(!$error){

   $queryEventInfo = "INSERT INTO events_private(id_user_buy, id_user_sell, id_plan, date_event, phone_event, id_region, id_city, location, desc_event, name_event, status_event, status_payment, value_plan_event, commission_plan_event, id_name_plan) VALUES('$buyerId', '$sellerId', '$planId', '$eventDate', '$eventPhone', '$eventRegion', '$eventCity', '$eventLocation', '$eventDesc', '$eventName', 'reserved', 'pending', '$planPrice', '$commissionPrice', '$planName')";

    if(mysqli_query($conn, $queryEventInfo)){

      mysqli_query($conn, "INSERT INTO events_plans(id_event, value_plan, commission_plan, desc_plan, duration_hours, duration_minutes, backline, sound_engineer, artists_amount, sound_reinforcement) VALUES(LAST_INSERT_ID(), '$planPrice', '$commissionPrice', '$planDesc', '$planHours', '$planMinutes', '$planBackline', '$planEngi', '$planArtistN', '$planReinforcement')");

      $text = $reservamail.$dateNotice.'</b> a las <b>'.$timeNotice.$reservamail1;

      $mail = new PHPMailer();
      $mail->Encoding = 'base64';
      $mail->CharSet = 'UTF-8';
      $mail->isHTML(true);
      $mail->SetFrom('booking@echomusic.cl', 'Reservas EchoMusic');
      $mail->Subject   = 'Felicitaciones, tienes una reserva EchoMusic';
      $mail->Body     = $text;
      $mail->AddAddress($emailSeller);
      $mail->addBCC('booking@echomusic.cl');
      $mail->send();

        $errTyp = "success";
        $errMSG = "Solicitud de reserva enviada con éxito";


    } else {

        $errTyp = "danger";

        $errMSG = "Ha sucedido un error, inténtalo de nuevo.";

    }

  }else {

      $errTyp = "danger";

      $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

  }

}



} else{

  header('Location: index.php');

  die();

}

?>
