<?php
include 'connect.php';
include 'functionValidateDate.php';
// Turn Off and On
// header("location: cuidemonos/index.php");
// die();

// Random str function
 function random_str(
     int $length = 36,
     string $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'
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

if(isset($_SESSION['user']) && $_SESSION['user']!=''){

  $userid=$_SESSION['user'];

  // Query regions
  $queryRegionsInfo = mysqli_query($conn, "SELECT * FROM regions");
  $arrayRegions = array();
  while($regions = mysqli_fetch_array($queryRegionsInfo)){
    $arrayRegions[] = $regions;
  }

  // Get comunas
  $queryCitiesInfo = mysqli_query($conn, "SELECT * FROM regions_cities LEFT JOIN cities ON regions_cities.id_city = cities.id_city WHERE id_region='$idRegion'");
  $arrayCities = array();
  while($cities = mysqli_fetch_array($queryCitiesInfo)){
    $arrayCities[] = $cities;
  }

  // Publish Event
  if ( isset($_POST['submitPublicEvent']) ) {
      $error = false;
      // Turn Off and On
      // header("location: alpha_test.php");
      // die();

      $publicNameEvent = trim($_POST['publicNameEvent']);
      $publicNameEvent = strip_tags($publicNameEvent);
      $publicNameEvent = htmlspecialchars($publicNameEvent);
      $publicNameEvent = mysqli_real_escape_string($conn, $publicNameEvent);

      $publicNameLocationEvent = trim($_POST['publicNameLocationEvent']);
      $publicNameLocationEvent = strip_tags($publicNameLocationEvent);
      $publicNameLocationEvent = htmlspecialchars($publicNameLocationEvent);
      $publicNameLocationEvent = mysqli_real_escape_string($conn, $publicNameLocationEvent);

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

      $publicTimeEvent = trim($_POST['publicTimeEvent']);
      $publicTimeEvent = strip_tags($publicTimeEvent);
      $publicTimeEvent = htmlspecialchars($publicTimeEvent);
      $publicTimeEvent = mysqli_real_escape_string($conn, $publicTimeEvent);

      $publicRegionEvent = trim($_POST['publicRegionEvent']);
      $publicRegionEvent = strip_tags($publicRegionEvent);
      $publicRegionEvent = htmlspecialchars($publicRegionEvent);
      $publicRegionEvent = mysqli_real_escape_string($conn, $publicRegionEvent);

      $publicCityEvent = trim($_POST['publicCityEvent']);
      $publicCityEvent = strip_tags($publicCityEvent);
      $publicCityEvent = htmlspecialchars($publicCityEvent);
      $publicCityEvent = mysqli_real_escape_string($conn, $publicCityEvent);

      $paymentEvent = trim($_POST['paymentEvent']);
      $paymentEvent = FILTER_VAR($paymentEvent, FILTER_SANITIZE_NUMBER_INT);
      $paymentEvent = strip_tags($paymentEvent);
      $paymentEvent = htmlspecialchars($paymentEvent);
      $paymentEvent = mysqli_real_escape_string($conn, $paymentEvent);

      $eventDesc = trim($_POST['eventDesc']);
      $eventDesc = strip_tags($eventDesc);
      $eventDesc = htmlspecialchars($eventDesc);
      // $eventDesc = FILTER_VAR($eventDesc, FILTER_SANITIZE_STRING);
      $eventDesc = mysqli_real_escape_string($conn, $eventDesc);

    // get video if uploaded
      if($_POST['eventVideo'] != ''){
        $audioURL = trim($_POST['eventVideo']);
        $audioURL = strip_tags($audioURL, '<iframe>');
        $audioURL = htmlspecialchars($audioURL);
        $audioURL = mysqli_real_escape_string($conn, $audioURL);

        // data validation
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $audioURL, $match)) {
            $audioURLraw = $audioURL;
            $audioURL = urlencode($match[1]);
            $service = 'youtube';
        }else if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $audioURL, $match)) {
            $audioURLraw = $audioURL;
            $audioURL = urlencode($match[3]);
            $service = 'vimeo';
        }else{
          $error = true;
          $videoError = 'Este enlace no es válido, por favor inténtalo con otro.';
        }
      }


      // AUDIENCIA EVENTO GRATUITO
            $minpaymentEvent = 1;
            $maxpaymentEvent = 2;

            if(!FILTER_VAR($paymentEvent, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$minpaymentEvent, "max_range"=>$maxpaymentEvent))) ){
               $error = true;
               $paymentEventError = "Elige un tipo de evento válido";
            }


// TICKETS EVENTO pago


if($paymentEvent=='2'){
      foreach( $_POST['ticketName'] as $key=>$val ) {
        $val = trim($val);
        $val = mysqli_real_escape_string($conn, $val);

        if (empty($val)) {
         $error = true;
         $ticketNameError = "Por favor ingresa el nombre de la entrada.";
       } else if (strlen($val) < 3) {
         $error = true;
         $ticketNameError = "El nombre de la entrada debe tener más de 3 caracteres";
       } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$val)) {
         $error = true;
         $ticketNameError = "El nombre de la entrada solo puede contener letras y números";
        }

        $arrayPublicTicket['ticketName'][] =  $val;
      }

      foreach( $_POST['ticketAudience'] as $key=>$val ) {
        $val = trim($val);
        $val = mysqli_real_escape_string($conn, $val);

        if (empty($val)) {
         $error = true;
         $ticketAudienceError = "Por favor ingresa el aforo de la entrada";
        } else if(!is_numeric($val) && (!intval($val) == $val)){
          $error = true;
          $ticketAudienceError = "La audiencia solo puede contener números.";
        }

        $arrayPublicTicket['ticketAudience'][] =  $val;
      }

        foreach( $_POST['ticketValue'] as $key=>$val ) {
          $val = trim($val);
          $val = mysqli_real_escape_string($conn, $val);

          if($val==''){
            $error = true;
            $ticketValueError = "Por favor, indica un valor de entrada.";
          }else if(!is_numeric($val) && (!intval($val) == $val)){
            $error = true;
            $ticketValueError = "El valor solo puede contener números.";
          }

          $arrayPublicTicket['ticketValue'][] =  $val;
        }


      foreach( $_POST['ticketStart'] as $key=>$val ) {
        $val = trim($val);
        $val = mysqli_real_escape_string($conn, $val);

        if (empty($val)) {
         $error = true;
         $ticketStartError = "Por favor ingresa la fecha de inicio de venta.";
      } else if (strlen($val) < 3) {
         $error = true;
         $ticketStartError = "Por favor ingresa una fecha válida.";
       }else if(validateDate2($val)==false){
         $error = true;
         $ticketStartError = "Fecha inválida";
       }

        $arrayPublicTicket['ticketStart'][] =  $val;
      }

      foreach( $_POST['ticketEnd'] as $key=>$val ) {
        $val = trim($val);
        $val = mysqli_real_escape_string($conn, $val);

        if (empty($val)) {
         $error = true;
         $ticketEndError = "Por favor ingresa la fecha de término de venta.";
      } else if (strlen($val) < 3) {
         $error = true;
         $ticketEndError = "Por favor ingresa una fecha válida.";
       }else if(validateDate2($val)==false){
         $error = true;
         $ticketEndError = "Fecha inválida";
       }

        $arrayPublicTicket['ticketEnd'][] =  $val;
      }

  }elseif($paymentEvent=='1'){

    $audienceEvent = trim($_POST['audienceEvent']);
    $audienceEvent = FILTER_VAR($audienceEvent, FILTER_SANITIZE_NUMBER_INT);
    $audienceEvent = strip_tags($audienceEvent);
    $audienceEvent = htmlspecialchars($audienceEvent);
    $audienceEvent = mysqli_real_escape_string($conn, $audienceEvent);

    $minAudience = 1;
    $maxAudience = 5000;
    if(!FILTER_VAR($audienceEvent, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$minAudience, "max_range"=>$maxAudience))) ){
       $error = true;
       $audienceEventError = "Elige una audiencia entre 1 a 5000 personas";
    }

    $arrayPublicTicket['ticketName'][] =  'Gratuito';
    $arrayPublicTicket['ticketAudience'][] =  $audienceEvent;
    $arrayPublicTicket['ticketValue'][] =  0;
    $arrayPublicTicket['ticketStart'][] =  date('Y-m-d H:i:s', time());
    $arrayPublicTicket['ticketEnd'][] =  $publicDateEvent;

  }


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

      if (empty($publicNameLocationEvent)) {
       $error = true;
       $publicNameLocationEventError = "Por favor ingresa el nombre del lugar.";
     } else if (strlen($publicNameLocationEvent) < 3) {
       $error = true;
       $publicNameLocationEventError = "El nombre del lugar debe tener más de 3 caracteres";
     } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$publicNameLocationEvent)) {
       $error = true;
       $publicNameLocationEventError = "El nombre del lugar solo puede contener letras y números";
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


      if(validateDate($publicDateEvent)==false){
        $error = true;
        $publicDateEventError = "Fecha inválida";
      }

      if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $publicTimeEvent)){
        $error = true;
        $publicTimeEventError = "Hora inválida";
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
    } else if (strlen($eventDesc) < 50) {
       $error = true;
       $eventDescError = "La descripción debe tener más de 50 caracteres.";
    } else if (strlen($eventDesc) > 3000) {
       $error = true;
       $eventDescError = "La descripción debe tener menos de 3000 caracteres.";
     }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$eventDesc)) {
       $error = true;
       $eventDescError = "La descripción del evento contiene caracteres no permitidos.";
      }



      // Create image from format

      $sourceImage = $_FILES["file-input"]["tmp_name"];
      $infoImage = getimagesize($sourceImage);

      if ($infoImage['mime'] == 'image/jpeg'){
    		$sourceImage = imagecreatefromjpeg($sourceImage);
      }
    	elseif ($infoImage['mime'] == 'image/gif'){
    		$sourceImage = imagecreatefromgif($sourceImage);
      }
    	elseif ($infoImage['mime'] == 'image/png'){
    		$sourceImage = imagecreatefrompng($sourceImage);
      }

     $imgRename = str_replace(".", "_", uniqid(mt_rand(), true));

     // Generate datetime
     $today = date('Y-m-d', time());

     $publicDateEventValue = $publicDateEvent;
     $publicDateEvent = date_create($publicDateEvent);
     $publicDateEvent = DATE_FORMAT($publicDateEvent, 'Y-m-d');

     if($publicDateEvent<=$today){
       $error = true;
       $publicDateEventError = "Fecha inválida";
     }

     $publicDateEvent = $publicDateEvent.' '.$publicTimeEvent;




// If there's no error...
     if( !$error ) {

       $typeEvent = 2;
       $verifier_event = random_str(6);
       $queryEventInsert = "INSERT INTO events_public(id_user, date_event, id_region, id_city, name_event, name_location, location, organizer, desc_event, payment_event, img, verifier_event, active_event) VALUES ('$userid', '$publicDateEvent', '$publicRegionEvent', '$publicCityEvent', '$publicNameEvent', '$publicNameLocationEvent', '$publicLocationEvent', '$publicOrganizerEvent', '$eventDesc','$paymentEvent', '$imgRename','$verifier_event', '0')";

        if (mysqli_query($conn, $queryEventInsert)) {
          $target = "images/events/" . $imgRename . '.jpg';
          if (imagejpeg($sourceImage, $target, 60)) {

          // Get id event
            $queryLastEvent = mysqli_query($conn, "SELECT MAX(id_event) FROM events_public WHERE id_user='$userid'");
            $arrayLastEvent = mysqli_fetch_assoc($queryLastEvent);
            $id_event = $arrayLastEvent['MAX(id_event)'];

        // query tickets
           $keys = array_keys($arrayPublicTicket['ticketName']);

           for($i = 0; $i < count($keys); $i++) {
             // variables para query
               $publicTicketName = $arrayPublicTicket['ticketName'][$i];
               $publicTicketValue = $arrayPublicTicket['ticketValue'][$i];
               $publicTicketAudience = $arrayPublicTicket['ticketAudience'][$i];
             // reconfig date start
               $publicTicketStart = $arrayPublicTicket['ticketStart'][$i];
               $publicTicketStart = date_create($publicTicketStart);
               $publicTicketStart = DATE_FORMAT($publicTicketStart, 'Y-m-d H:i:s');
             // reconfig date end
               $publicTicketEnd = $arrayPublicTicket['ticketEnd'][$i];
               $publicTicketEnd = date_create($publicTicketEnd);
               $publicTicketEnd = DATE_FORMAT($publicTicketEnd, 'Y-m-d H:i:s');

             // cálculo comisión
               $fee = 10;
               $publicTicketCommission = 0;
               $a = $publicTicketValue / 100;
               $a = $a * $fee;
               $publicTicketCommission = round($a, 0);

               // query ticket insert
               $queryTickets .= "INSERT INTO tickets_public (id_event, ticket_name, ticket_value, ticket_commission, ticket_audience, ticket_dateStart, ticket_dateEnd) VALUES ('$id_event', '$publicTicketName', '$publicTicketValue', '$publicTicketCommission', '$publicTicketAudience', '$publicTicketStart', '$publicTicketEnd');";

           }

           // Query video
           if(isset($audioURL)){
             $queryTickets .= "INSERT INTO multimedia_feature_events(id_event, service_multi, embed_multi) VALUES('$id_event', '$service', '$audioURL');";
           }

            mysqli_multi_query($conn, $queryTickets);
            while (mysqli_next_result($conn)) // flush multi_queries
              {
                if (!mysqli_more_results($conn)) break;
              }

              $errTyp = "success";
              $errMSG = "Evento creado con éxito.";
              unset($imgRename);
              $_SESSION['success'] = $errMSG;
              header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
              exit();
          } else {
            $errTyp = "danger";
            $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";

          }
       } else {
        $errTyp = "danger";
        $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
       }

    }else {
      if(!$publicCityEventError){
        $_SESSION['selectedCity'] = $publicCityEvent;
      }
     $errTyp = "danger";
     $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

     // errors check
     // if(isset($audienceEventError)){
     //   $errMSG= "la audienciaa";
     // }
     // if(isset($ticketNameError)){
     //   $errMSG= "el nombre";
     // }
     // if(isset($ticketValueError)){
     //   $errMSG= "el valor";
     // }
     // if(isset($ticketAudienceError)){
     //   $errMSG= "la audienciaa ticket";
     // }
     // if(isset($ticketStartError)){
     //   $errMSG= $ticketStartError;
     // }
     // if(isset($ticketEndError)){
     //   $errMSG= $ticketEndError;
     // }

    }
  }
}else{
  $plsLogin = true;
}


 ?>
