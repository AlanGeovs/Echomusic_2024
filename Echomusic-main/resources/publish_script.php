<?php

include 'connect.php';

// Display info Queries
if(isset($_SESSION['user'])){

  $userid = $_SESSION['user'];
  if(isset($_POST['id_event'])){
    $idEvent = $_POST['id_event'];
    $_SESSION['id_event'] = $idEvent;
  }else if(isset($_SESSION['id_event'])){
    $idEvent = $_SESSION['id_event'];
  }else if(isset($errTyp) && $errTyp == "success"){

  }else{
    header('HTTP/1.1 403 Forbidden');
    die();
  }

  $queryInfo = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$userid'");
  $userInfo_array = mysqli_fetch_array($queryInfo);

  $queryGenre = mysqli_query($conn, "SELECT * FROM genre_user LEFT JOIN genres ON genre_user.id_genre = genres.id_genre WHERE genre_user.id_user='$userid'");
  $userGenre_array = mysqli_fetch_array($queryGenre);

// Get Events
  $queryEvents = mysqli_query($conn, "SELECT * FROM events_private WHERE id_user_buy='$userid' AND id_event='$idEvent'");
  $arrayEvents = array();
  while($events = mysqli_fetch_array($queryEvents)){
    $arrayEvents[] = $events;
  }
  $artistId = $arrayEvents[0]['id_user_sell'];

  $queryArtist = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$artistId'");
  $artistArray = array();
  while($userArtist = mysqli_fetch_array($queryArtist)){
    $artistArray[] = $userArtist;
  }

  $queryEvents_Artists = mysqli_query($conn, "SELECT DISTINCT users.id_user, users.nick_user FROM events_private LEFT JOIN users ON events_private.id_user_sell = users.id_user WHERE events_private.id_user_buy = '$userid' AND events_private.status_event='confirmed'");
  $eventsArtistsArray = array();
  while($eventsArtists = mysqli_fetch_array($queryEvents_Artists)){
    $eventsArtistsArray[] = $eventsArtists;
  }

// get Date Time
  $time = date_create($arrayEvents[0]['date_event']);

  date_default_timezone_set('America/Santiago');
  $today = date('m/d/Y h:i:s a', time());
  $monthYear = date('M Y', time());
  $hour = DATE_FORMAT($time, 'H:i');


// Publish Event
  if ( isset($_POST['submitPublicEvent']) ) {

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

    $publicTimeEvent = trim($_POST['publicTimeEvent']);
    $publicTimeEvent = strip_tags($publicTimeEvent);
    $publicTimeEvent = htmlspecialchars($publicTimeEvent);
    $publicTimeEvent = mysqli_real_escape_string($conn, $publicTimeEvent);

    $publicValueEvent = trim($_POST['publicValueEvent']);
    $publicValueEvent = strip_tags($publicValueEvent);
    $publicValueEvent = htmlspecialchars($publicValueEvent);
    $publicValueEvent = mysqli_real_escape_string($conn, $publicValueEvent);

    $artist_1 = trim($_POST['publicArtist1Event']);
    $artist_1 = strip_tags($artist_1);
    $artist_1 = htmlspecialchars($artist_1);
    $artist_1 = mysqli_real_escape_string($conn, $artist_1);

    $artist_2 = trim($_POST['publicArtist2Event']);
    $artist_2 = strip_tags($artist_2);
    $artist_2 = htmlspecialchars($artist_2);
    $artist_2 = mysqli_real_escape_string($conn, $artist_2);

    $artist_3 = trim($_POST['publicArtist3Event']);
    $artist_3 = strip_tags($artist_3);
    $artist_3 = htmlspecialchars($artist_3);
    $artist_3 = mysqli_real_escape_string($conn, $artist_3);

    $artist_4 = trim($_POST['publicArtist4Event']);
    $artist_4 = strip_tags($artist_4);
    $artist_4 = htmlspecialchars($artist_4);
    $artist_4 = mysqli_real_escape_string($conn, $artist_4);

    $planPublicEvent = $_POST['planPublicEvent'];
    $planPublicEvent = strip_tags($planPublicEvent);
    $planPublicEvent = htmlspecialchars($planPublicEvent);
    $planPublicEvent = mysqli_real_escape_string($conn, $planPublicEvent);

    $eventDesc = trim($_POST['eventDesc']);
    $eventDesc = strip_tags($eventDesc);
    $eventDesc = htmlspecialchars($eventDesc);
    $eventDesc = mysqli_real_escape_string($conn, $eventDesc);

  // Get Image Dimension
  $error = false;
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
      $publicImageEventError = "Las dimensiones de la imagen son superior a 1920x1080";
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

    if (empty($publicTimeEvent)) {
     $error = true;
     $publicTimeEventError = "Por favor ingresa la hora del evento.";
   } else if (!preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9]+$/", $publicTimeEvent)) {
     $error = true;
     $publicTimeEventError = "Por favor ingresa una hora válida.";
    } else if (strlen($publicTimeEvent) < 3) {
     $error = true;
     $publicTimeEventError = "Por favor ingresa una hora válida Más de 3 caracteres.";
    }

    if (empty($planPublicEvent)) {
     $error = true;
     $planPublicEventError = "Por favor elige el tipo de plan.";
   }else if(!preg_match("/^[1-9][0-9]*$/", $planPublicEvent)){
     $error = true;
     $planPublicEventError = "El tipo de plan no es válido.";
   }

    if (empty($artist_1)) {
     $error = true;
     $artist_1Error = "Por favor elige al menos un artist.";
   }else if(!preg_match("/^[1-9][0-9]*$/", $artist_1)){
     $error = true;
     $artist_1Error = "El tipo de artist no es válido.";
   }

   if (empty($eventDesc)) {
    $error = true;
    $eventDescError = "Por favor ingresa la descripción del evento.";
  } else if (strlen($eventDesc) < 1) {
     $error = true;
     $eventDescError = "La descripción debe tener más de 1 caracter.";
   } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$eventDesc)) {
     $error = true;
     $eventDescError = "El descripción contiene caracteres no permitidos";
    }

    $imgRename = str_replace(".", "_", uniqid(mt_rand(), true));

    // Insert Data
   if( !$error ) {
     $queryArtistsPerEvent = "INSERT INTO events_user (id_event, id_user) VALUES('$idEvent', '$artist_1')";
     if(!empty($artist_2)){
       $queryArtistsPerEvent .= ", ('$idEvent', '$artist_2')";
     }
     if(!empty($artist_3)){
       $queryArtistsPerEvent .= ", ('$idEvent', '$artist_3')";
     }
     if(!empty($artist_4)){
       $queryArtistsPerEvent .= ", ('$idEvent', '$artist_4')";
     }
     if($planPublicEvent == 1){
       $queryEventUpdate = "INSERT INTO events_linked (id_event_private, id_public_plan, public_name_event, public_name_location, public_organizer, public_time_event, public_value, public_desc_event, img, active_event) VALUES ('$idEvent','$planPublicEvent', '$publicNameEvent', '$publicLocationEvent', '$publicOrganizerEvent', '$publicTimeEvent', '$publicValueEvent', '$eventDesc', '$imgRename', '1')";
       if (mysqli_query($conn, $queryEventUpdate)) {
         $target = "images/events/" . $imgRename . '.jpg';
         if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {
           if(mysqli_query($conn, $queryArtistsPerEvent)){
             $errTyp = "success";
             $errMSG = "Información agregada con éxito";
             header("Refresh:1; url=event.php?linked=".$idEvent);
             unset($idEvent);
             unset($_SESSION['id_event']);
           }else{
             $errTyp = "danger";
             $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
           }
         }else{
           $errTyp = "danger";
           $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
         }
      } else {
       $errTyp = "danger";
       $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
      }
     }else if($planPublicEvent == 2){
       $typeEvent = 3;
       $queryEventUpdate = "INSERT INTO events_linked (id_event_private, id_public_plan, public_name_event, public_name_location, public_organizer, public_time_event, public_value, public_desc_event, img, active_event) VALUES ('$idEvent','$planPublicEvent', '$publicNameEvent', '$publicLocationEvent', '$publicOrganizerEvent', '$publicTimeEvent', '$publicValueEvent', '$eventDesc', '$imgRename', '0')";
       if (mysqli_query($conn, $queryEventUpdate)) {
         $target = "images/events/" . $imgRename . '.jpg';
         if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {
           if(mysqli_query($conn, $queryArtistsPerEvent)){
             // Check transaction on DB
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
             unset($idEvent);
             unset($_SESSION['id_event']);
           }else{
             $errTyp = "danger";
             $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
           }
         }else{
           $errTyp = "danger";
           $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
         }
      } else {
       $errTyp = "danger";
       $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
      }
     }

   }else {
    $errTyp = "danger";
    $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
   }
  }
} else{
  header('HTTP/1.1 403 Forbidden');
  die();
}
?>
