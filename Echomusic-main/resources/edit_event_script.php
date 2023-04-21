<?php
include 'connect.php';
// Turn Off and On
// header("location: cuidemonos/index.php");
// die();

// Display info Queries
if(isset($_SESSION['user'])){

  // function to validate date
  include 'functionValidateDate.php';

  // function date Translate
  include 'functionDateTranslate.php';

  if(!empty($_GET['eventid']) && FILTER_INPUT(INPUT_GET, 'eventid', FILTER_VALIDATE_INT, 1)){
    $error = FALSE;

    $idEvent = trim($_GET['eventid']);
    $idEvent = intval($idEvent);
    $idEvent = strip_tags($idEvent);
    $idEvent = htmlspecialchars($idEvent);
    $idEvent = mysqli_real_escape_string($conn, $idEvent);

    $userid = $_SESSION['user'];

    $queryDataEvent = mysqli_query($conn, "SELECT * FROM events_private LEFT JOIN users ON events_private.id_user_sell = users.id_user
                                                                        LEFT JOIN regions ON events_private.id_region = regions.id_region
                                                                        LEFT JOIN cities ON events_private.id_city = cities.id_city WHERE id_event='$idEvent' AND id_user_buy='$userid'");
    $arrayDataEvent = mysqli_fetch_array($queryDataEvent);

    if($arrayDataEvent['status_event'] == 'confirmed' OR $arrayDataEvent['status_event'] == 'canceled'){
      http_response_code(403);
      die();
    }

    //format date
    $datePrivate = date_create($arrayDataEvent['date_event']);
    $datePrivateEvent = DATE_FORMAT($datePrivate, 'd-m-Y');
    $datePrivateCheck = DATE_FORMAT($datePrivate, 'Y-m-d');

    // Query regions
    $queryRegionsInfo = mysqli_query($conn, "SELECT * FROM regions");
    $arrayRegions = array();
    while($regions = mysqli_fetch_array($queryRegionsInfo)){
      $arrayRegions[] = $regions;
    }

    $idRegion = $arrayDataEvent['id_region'];


    $dataEventTime = date_create($arrayDataEvent['date_event']);
    $timeEvent = DATE_FORMAT($dataEventTime, 'H:i');

    // Query city
    $queryCitiesInfo = mysqli_query($conn, "SELECT * FROM regions_cities LEFT JOIN cities ON regions_cities.id_city = cities.id_city WHERE id_region='$idRegion'");
    $arrayCities = array();
    while($cities = mysqli_fetch_array($queryCitiesInfo)){
      $arrayCities[] = $cities;
    }

  // Guardar Cambios Evento
    if(isset($_POST['saveEvent'])){

      $error = false;
      $idArtist = $arrayDataEvent['id_user_sell'];
      $queryEmailArtist = mysqli_query($conn, "SELECT mail_user FROM users LEFT JOIN events_private ON events_private.id_user_sell = users.id_user WHERE events_private.id_user_sell='$idArtist'");
      $arrayEmailArtist = mysqli_fetch_array($queryEmailArtist);
      $emailSeller = $arrayEmailArtist['mail_user'];
      // Get Data
      $nameEvent = trim($_POST['nameEvent']);
      $nameEvent = strip_tags($nameEvent);
      $nameEvent = htmlspecialchars($nameEvent);
      $nameEvent = mysqli_real_escape_string($conn, $nameEvent);

      $locationEvent = trim($_POST['locationEvent']);
      $locationEvent = strip_tags($locationEvent);
      $locationEvent = htmlspecialchars($locationEvent);
      $locationEvent = mysqli_real_escape_string($conn, $locationEvent);

      $dateEvent = trim($_POST['dateEvent']);
      $dateEvent = strip_tags($dateEvent);
      $dateEvent = htmlspecialchars($dateEvent);
      $dateEvent = mysqli_real_escape_string($conn, $dateEvent);

      $timeEvent = trim($_POST['timeEvent']);
      $timeEvent = strip_tags($timeEvent);
      $timeEvent = htmlspecialchars($timeEvent);
      $timeEvent = mysqli_real_escape_string($conn, $timeEvent);

      $cityEvent = trim($_POST['cityEvent']);
      $cityEvent = strip_tags($cityEvent);
      $cityEvent = htmlspecialchars($cityEvent);
      $cityEvent = mysqli_real_escape_string($conn, $cityEvent);

      $eventDesc = trim($_POST['eventDesc']);
      $eventDesc = strip_tags($eventDesc);
      $eventDesc = htmlspecialchars($eventDesc);
      $eventDesc = mysqli_real_escape_string($conn, $eventDesc);

      //Data validation
      if (empty($nameEvent)) {
       $error = true;
       $nameEventError = "Por favor ingresa el nombre del evento.";
     } else if (strlen($nameEvent) < 3) {
       $error = true;
       $nameEventError = "El nombre del evento debe tener más de 3 caracteres";
     } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$nameEvent)) {
       $error = true;
       $nameEventError = "El nombre del evento solo puede contener letras y números";
      }

      if (empty($locationEvent)) {
       $error = true;
       $locationEventError = "Por favor ingresa la dirección del evento.";
     } else if (strlen($locationEvent) < 3) {
       $error = true;
       $locationEventError = "La dirección del evento debe tener más de 3 caracteres";
     } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$locationEvent)) {
       $error = true;
       $locationEventError = "La dirección del evento solo puede contener letras y números";
      }

      if (empty($dateEvent)) {
       $error = true;
       $dateEventError = "Por favor ingresa la fecha del evento.";
     } else if (strlen($dateEvent) < 3) {
       $error = true;
       $dateEventError = "Por favor ingresa una fecha válida.";
     }else if(validateDate($dateEvent)==false){
        $error = true;
        $dateEventError = "Fecha inválida";
      }

      if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $timeEvent)){
        $error = true;
        $timeEventError = "Hora inválida";
      }

      if (empty($cityEvent)) {
       $error = true;
       $cityEventError = "Por favor elige una comuna.";
     }else if(!preg_match("/^[1-9][0-9]*$/", $cityEvent)){
       $error = true;
       $cityEventError = "La comuna no es válida.";
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
      // Generate datetime
      $dateEvent = date_create($dateEvent);
      $dateEvent = DATE_FORMAT($dateEvent, 'Y-m-d');

      // Check dateEvent <= today
      $today = date('Y-m-d', time());
      if($dateEvent<$datePrivateCheck AND $dateEvent<=$today){

         $error = true;
         $dateEventError = "Fecha inválida";

      }

      $dateEvent = $dateEvent.' '.$timeEvent;



    // Update data
    if( !$error){
      $queryUpdate = "UPDATE events_private SET id_city='$cityEvent', name_event='$nameEvent', location='$locationEvent', date_event='$dateEvent', desc_event='$eventDesc' WHERE id_event='$idEvent' AND id_user_buy='$userid'";

      if (mysqli_query($conn, $queryUpdate)) {
        if(mysqli_affected_rows($conn)){
        $errTyp = "success";
        $errMSG = "Evento modificado con éxito.";
        $_SESSION['success'] = $errMSG;

        $text = '<html><p>Se ha realizado un cambio en el evento:'.$arrayDataEvent['name_event'].' </br> Para ver más detalles accede a tu <a href="https://qa.echomusic.cl/dashboard.php">Panel de Control.</a></p><p>Equipo EchoMusic</p></html>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From: reservas@echomusic.cl" . "\r\n";
        mail($emailSeller, "Modificación de Evento", $text, $headers);
        $_SESSION['success'] = $errMSG;
        header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
        exit();
      }else{
        $errTyp = "danger";
        $errMSG = "Ha sucedido un error, inténtalo de nuevo.";
      }
    }else{
        $errTyp = "danger";
        $errMSG = "Ha sucedido un error, inténtalo de nuevo.";
      }
    }else{
      $errTyp = "danger";
      $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
    }

  }

}else if(!empty($_GET['streamingid']) && FILTER_INPUT(INPUT_GET, 'streamingid', FILTER_VALIDATE_INT, 1)){

    $error = FALSE;

    $idEvent = trim($_GET['streamingid']);
    $idEvent = intval($idEvent);
    $idEvent = strip_tags($idEvent);
    $idEvent = htmlspecialchars($idEvent);
    $idEvent = mysqli_real_escape_string($conn, $idEvent);

    $userid = $_SESSION['user'];

    $queryDataEvent = mysqli_query($conn, "SELECT * FROM events_streaming LEFT JOIN users ON events_streaming.id_user = users.id_user
                                                                          WHERE id_event='$idEvent' AND events_streaming.id_user='$userid'");
    $arrayDataEvent = mysqli_fetch_array($queryDataEvent);

    if($arrayDataEvent['status_event'] == '2'){
      http_response_code(403);
      die();
    }

    //format value
    $formatedValue = number_format($arrayDataEvent['value'] , 0, ',', '.');

    //format date
    $dateStreaming = date_create($arrayDataEvent['date_event']);
    $dateStreamingEvent = DATE_FORMAT($dateStreaming, 'd-m-Y');
    $dateStreamingCheck = DATE_FORMAT($dateStreaming, 'Y-m-d');


    $dataEventTime = date_create($arrayDataEvent['date_event']);
    $timeEvent = DATE_FORMAT($dataEventTime, 'H:i');


    // Guardar Cambios Evento
      if(isset($_POST['saveStreamingEvent'])){

        $error = false;

        // Get Data
        $nameEvent = trim($_POST['nameEvent']);
        $nameEvent = strip_tags($nameEvent);
        $nameEvent = htmlspecialchars($nameEvent);
        $nameEvent = mysqli_real_escape_string($conn, $nameEvent);

        $dateEvent = trim($_POST['dateEvent']);
        $dateEvent = strip_tags($dateEvent);
        $dateEvent = htmlspecialchars($dateEvent);
        $dateEvent = mysqli_real_escape_string($conn, $dateEvent);

        $timeEvent = trim($_POST['timeEvent']);
        $timeEvent = strip_tags($timeEvent);
        $timeEvent = htmlspecialchars($timeEvent);
        $timeEvent = mysqli_real_escape_string($conn, $timeEvent);

        $durationEvent = trim($_POST['durationEvent']);
        $durationEvent = strip_tags($durationEvent);
        $durationEvent = htmlspecialchars($durationEvent);
        $durationEvent = mysqli_real_escape_string($conn, $durationEvent);

        $audienceEvent = trim($_POST['audienceEvent']);
        $audienceEvent = FILTER_VAR($audienceEvent, FILTER_SANITIZE_NUMBER_INT);
        $audienceEvent = strip_tags($audienceEvent);
        $audienceEvent = htmlspecialchars($audienceEvent);
        $audienceEvent = mysqli_real_escape_string($conn, $audienceEvent);

        if($arrayDataEvent['active_event'] == '1'){
          $valueEvent = $arrayDataEvent['value'];
        }else{
          $valueEvent = trim($_POST['publicValueTicket']);
          $valueEvent = FILTER_VAR($valueEvent, FILTER_SANITIZE_NUMBER_INT);
          $valueEvent = strip_tags($valueEvent);
          $valueEvent = htmlspecialchars($valueEvent);
          $valueEvent = mysqli_real_escape_string($conn, $valueEvent);
        }

        $eventDesc = trim($_POST['eventDesc']);
        $eventDesc = strip_tags($eventDesc);
        $eventDesc = htmlspecialchars($eventDesc);
        $eventDesc = mysqli_real_escape_string($conn, $eventDesc);

        //Data validation
        if (empty($nameEvent)) {
         $error = true;
         $nameEventError = "Por favor ingresa el nombre del evento.";
       } else if (strlen($nameEvent) < 3) {
         $error = true;
         $nameEventError = "El nombre del evento debe tener más de 3 caracteres";
       } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$nameEvent)) {
         $error = true;
         $nameEventError = "El nombre del evento solo puede contener letras y números";
        }

        if (empty($dateEvent)) {
         $error = true;
         $dateEventError = "Por favor ingresa la fecha del evento.";
       } else if (strlen($dateEvent) < 3) {
         $error = true;
         $dateEventError = "Por favor ingresa una fecha válida.";
       }else if(validateDate($dateEvent)==false){
          $error = true;
          $dateEventError = "Fecha inválida";
        }

        if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $timeEvent)){
          $error = true;
          $timeEventError = "Hora inválida";
        }

        if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $durationEvent)){
          $error = true;
          $durationEventError = "Hora inválida";
        }else if($durationEvent == '00:00'){
          $error = true;
          $durationEventError = "Por favor elige una duración.";
        }

       $minAudience = 1;
       $maxAudience = 5000;
       if(!FILTER_VAR($audienceEvent, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$minAudience, "max_range"=>$maxAudience))) ){
          $error = true;
          $audienceEventError = "Elige una audiencia entre 1 a 5000 personas";
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

        // if($valueEvent==''){
        //   $error = true;
        //   $valueEventError = "Por favor, indica un valor de entrada.";
        // }else
        if(!is_numeric($valueEvent) && (!intval($valueEvent) == $valueEvent)){
          $error = true;
          $valueEventError = "El valor solo puede contener números.";
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
         // Get previous image
         $imgRename = $arrayDataEvent['img'];
        }    // Validate file input to check if is with valid extension
        else if (! in_array($file_extension, $allowed_image_extension)) {
         $error = true;
         $imageEventError = "Por favor, elige una imagen de formato JPG o PNG.";
        }    // Validate image file size
        else if (($_FILES["file-input"]["size"] > 5000000)) {
         $error = true;
         $imageEventError = "La imagen excede el peso de 5MB.";
        }    // Validate image file dimension
        else if ($width >= "1921" || $height >= "1081") {
         $error = true;
         $imageEventError = "Las dimensiones de la imagen son superior a 1920x1080";
       }else if(!isset($imgRename)){
         $imgRename = str_replace(".", "_", uniqid(mt_rand(), true));
         $target = "images/events/" . $imgRename . '.jpg';
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
       }

       // Generate datetime
       $dateEvent = date_create($dateEvent);
       $dateEvent = DATE_FORMAT($dateEvent, 'Y-m-d');

       // Check dateEvent <= today
       $today = date('Y-m-d', time());
       if($dateEvent<$dateStreamingCheck AND $dateEvent<=$today){

          $error = true;
          $dateEventError = "Fecha inválida";

       }

       $dateEvent = $dateEvent.' '.$timeEvent;

      // Update data
      if( !$error){

        // Generate Fee
        if($valueEvent !=0){
          $fee = 10;
          $commissionEvent = 0;
          $a = $valueEvent / 100;
          $a = $a * $fee;
          $commissionEvent = round($a, 0);
        }else{
          $commissionEvent = 0;
        }


        $queryUpdate = "UPDATE events_streaming SET name_event='$nameEvent', date_event='$dateEvent', duration_event='$durationEvent', desc_event='$eventDesc', audience_event='$audienceEvent', value='$valueEvent', value_commission='$commissionEvent', img='$imgRename' WHERE id_event='$idEvent' AND id_user='$userid'";

        if (mysqli_query($conn, $queryUpdate)) {
          // Check if user uploads picture
          if(file_exists($_FILES["file-input"]["tmp_name"])){
                if (imagejpeg($sourceImage, $target, 60)) {
                    $errTyp = "success";
                    $errMSG = "Evento modificado con éxito.";
                    $_SESSION['success'] = $errMSG;
                    header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
                    exit();

                }else{
                    $errTyp = "danger";
                    $errMSG = "Ha sucedido un error al subir la imagen, inténtalo de nuevo.";
                }
          }else{
                $errTyp = "success";
                $errMSG = "Evento modificado con éxito.";
                $_SESSION['success'] = $errMSG;
                header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
                exit();
          }


        }else{
            $errTyp = "danger";
            $errMSG = "Ha sucedido un error, inténtalo de nuevo.";
        }
      }else{
        $errTyp = "danger";
        $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
      }

    }


}else if(!empty($_GET['publicid']) && FILTER_INPUT(INPUT_GET, 'publicid', FILTER_VALIDATE_INT, 1)){

      $error = FALSE;

      $idEvent = trim($_GET['publicid']);
      $idEvent = intval($idEvent);
      $idEvent = strip_tags($idEvent);
      $idEvent = htmlspecialchars($idEvent);
      $idEvent = mysqli_real_escape_string($conn, $idEvent);

      $userid = $_SESSION['user'];

      $queryDataEvent = mysqli_query($conn, "SELECT * FROM events_public LEFT JOIN users ON events_public.id_user = users.id_user
                                                                          LEFT JOIN regions ON events_public.id_region = regions.id_region
                                                                          LEFT JOIN cities ON events_public.id_city = cities.id_city WHERE id_event='$idEvent' AND events_public.id_user='$userid'");
      $arrayDataEvent = mysqli_fetch_array($queryDataEvent);

      if($arrayDataEvent['status_event'] == '2'){
        http_response_code(403);
        die();
      }

      // Query tickets
        $queryTicketsData = mysqli_query($conn, "SELECT * FROM tickets_public WHERE id_event='$idEvent'");
        $ticketDataArray = array();

        while($ticketsData = mysqli_fetch_array($queryTicketsData)){
        	$ticketsDataArray[] = $ticketsData;
        }

      //format date
      $datePublic = date_create($arrayDataEvent['date_event']);
      $datePublicEvent = DATE_FORMAT($datePublic, 'd-m-Y');
      $datePublicCheck = DATE_FORMAT($datePublic, 'Y-m-d');

      //format value
      $formatedValue = number_format($arrayDataEvent['value'] , 0, ',', '.');

      // Query regions
      $queryRegionsInfo = mysqli_query($conn, "SELECT * FROM regions");
      $arrayRegions = array();
      while($regions = mysqli_fetch_array($queryRegionsInfo)){
        $arrayRegions[] = $regions;
      }

      $idRegion = $arrayDataEvent['id_region'];

      $dataEventTime = date_create($arrayDataEvent['date_event']);
      $timeEvent = DATE_FORMAT($dataEventTime, 'H:i');

      // Query city
      $queryCitiesInfo = mysqli_query($conn, "SELECT * FROM regions_cities LEFT JOIN cities ON regions_cities.id_city = cities.id_city WHERE id_region='$idRegion'");
      $arrayCities = array();
      while($cities = mysqli_fetch_array($queryCitiesInfo)){
        $arrayCities[] = $cities;
      }

      // Query video
      $queryFeaturedMultimedia = mysqli_query($conn, "SELECT * FROM multimedia_feature_events WHERE id_event='$idEvent' ORDER BY id_multimedia_featured DESC LIMIT 1");
      if(mysqli_num_rows($queryFeaturedMultimedia)>0){
        $postDetail = mysqli_fetch_array($queryFeaturedMultimedia);
      }

      // Guardar Cambios Evento Público
      if(isset($_POST['savePublicEvent'])){

        $error = false;

        // Get Data
        $publicNameEvent = trim($_POST['publicNameEvent']);
        $publicNameEvent = strip_tags($publicNameEvent);
        $publicNameEvent = htmlspecialchars($publicNameEvent);
        $publicNameEvent = mysqli_real_escape_string($conn, $publicNameEvent);

        $publicLocationEvent = trim($_POST['publicLocationEvent']);
        $publicLocationEvent = strip_tags($publicLocationEvent);
        $publicLocationEvent = htmlspecialchars($publicLocationEvent);
        $publicLocationEvent = mysqli_real_escape_string($conn, $publicLocationEvent);

        $publicNameLocationEvent = trim($_POST['publicNameLocation']);
        $publicNameLocationEvent = strip_tags($publicNameLocationEvent);
        $publicNameLocationEvent = htmlspecialchars($publicNameLocationEvent);
        $publicNameLocationEvent = mysqli_real_escape_string($conn, $publicNameLocationEvent);

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

        // if($arrayDataEvent['active_event'] == '1'){
        //   $publicValueEvent = $arrayDataEvent['value'];
        // }else{
        //   $publicValueEvent = trim($_POST['publicValueEvent']);
        //   $publicValueEvent = strip_tags($publicValueEvent);
        //   $publicValueEvent = htmlspecialchars($publicValueEvent);
        //   $publicValueEvent = mysqli_real_escape_string($conn, $publicValueEvent);
        // }

      // Store and validate ticket data
        foreach( $_POST['publicNameTicket'] as $key=>$val ) {
          $val = trim($val);
          $val = mysqli_real_escape_string($conn, $val);

          if (empty($val)) {
           $error = true;
           $publicNameTicketError = "Por favor ingresa el nombre de la entrada.";
         } else if (strlen($val) < 3) {
           $error = true;
           $publicNameTicketError = "El nombre de la entrada debe tener más de 3 caracteres";
         } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$val)) {
           $error = true;
           $publicNameTicketError = "El nombre de la entrada solo puede contener letras y números";
          }
          if($arrayDataEvent['payment_event'] == '2'){
            $arrayPublicTicket['publicNameTicket'][] =  $val;
          }else{
            $arrayPublicTicket['publicNameTicket'][] =  'Gratuito';
          }
        }

        foreach( $_POST['publicAudienceTicket'] as $key=>$val ) {
          $val = trim($val);
          $val = mysqli_real_escape_string($conn, $val);

          if (empty($val)) {
           $error = true;
           $publicAudienceTicketError = "Por favor ingresa el aforo de la entrada";
          } else if(!is_numeric($val) && (!intval($val) == $val)){
            $error = true;
            $publicAudienceTicketError = "La audiencia solo puede contener números.";
          }

          $arrayPublicTicket['publicAudienceTicket'][] =  $val;
        }

          foreach( $_POST['publicValueTicket'] as $key=>$val ) {
            $val = trim($val);
            $val = mysqli_real_escape_string($conn, $val);

            if($val==''){
              $error = true;
              $publicValueTicketError = "Por favor, indica un valor de entrada.";
            }else if(!is_numeric($val) && (!intval($val) == $val)){
              $error = true;
              $publicValueTicketError = "El valor solo puede contener números.";
            }

            if($arrayDataEvent['payment_event'] == '2'){
              $arrayPublicTicket['publicValueTicket'][] =  $val;
            }else{
              $arrayPublicTicket['publicValueTicket'][] =  0;
            }

          }


        foreach( $_POST['publicTicketStart'] as $key=>$val ) {
          $val = trim($val);
          $val = mysqli_real_escape_string($conn, $val);

          if (empty($val)) {
           $error = true;
           $publicDateStartError = "Por favor ingresa la fecha de inicio de venta.";
        } else if (strlen($val) < 3) {
           $error = true;
           $publicDateStartError = "Por favor ingresa una fecha válida.";
         }else if(validateDate2($val)==false){
           $error = true;
           $publicDateStartError = "Fecha inválida";
           echo $val;
         }

          $arrayPublicTicket['publicTicketStart'][] =  $val;
        }

        foreach( $_POST['publicTicketEnd'] as $key=>$val ) {
          $val = trim($val);
          $val = mysqli_real_escape_string($conn, $val);

          if (empty($val)) {
           $error = true;
           $publicDateEndError = "Por favor ingresa la fecha de término de venta.";
        } else if (strlen($val) < 3) {
           $error = true;
           $publicDateEndError = "Por favor ingresa una fecha válida.";
         }else if(validateDate2($val)==false){
           $error = true;
           $publicDateEndError = "Fecha inválida";
         }

          $arrayPublicTicket['publicTicketEnd'][] =  $val;
        }

        foreach( $_POST['publicTicketId'] as $key=>$val ) {
          $val = trim($val);
          $val = mysqli_real_escape_string($conn, $val);

          if($val==''){

          }else if(preg_match('/(delete)/',$val)){

          }else if(!is_numeric($val) && (!intval($val) == $val)){
            $error = true;
            $publicTicketIdError = "El id solo puede contener números.";
          }

          $arrayPublicTicket['publicTicketId'][] =  $val;
        }


        // $keys = array_keys($arrayPublicTicket['publicNameTicket']);

        for($i = 0; $i < count($arrayPublicTicket['publicTicketId']); $i++) {
          // variables para query
            $publicTicketId = $arrayPublicTicket['publicTicketId'][$i];
            $publicTicketName = $arrayPublicTicket['publicNameTicket'][$i];
            $publicTicketValue = $arrayPublicTicket['publicValueTicket'][$i];
            $publicTicketAudience = $arrayPublicTicket['publicAudienceTicket'][$i];
          // reconfig date start
            $publicTicketStart = $arrayPublicTicket['publicTicketStart'][$i];
            $publicTicketStart = date_create($publicTicketStart);
            $publicTicketStart = DATE_FORMAT($publicTicketStart, 'Y-m-d H:i:s');
          // reconfig date end
            $publicTicketEnd = $arrayPublicTicket['publicTicketEnd'][$i];
            $publicTicketEnd = date_create($publicTicketEnd);
            $publicTicketEnd = DATE_FORMAT($publicTicketEnd, 'Y-m-d H:i:s');


          // cálculo comisión
            $fee = 10;
            $publicTicketCommission = 0;
            $a = $publicTicketValue / 100;
            $a = $a * $fee;
            $publicTicketCommission = round($a, 0);


            if($publicTicketId=='' && ($arrayDataEvent['payment_event'] != '1')){
              // query ticket insert
              $queryTicketsUpdate .= "INSERT INTO tickets_public (id_event, ticket_name, ticket_value, ticket_commission, ticket_audience, ticket_dateStart, ticket_dateEnd) VALUES ('$idEvent', '$publicTicketName', '$publicTicketValue', '$publicTicketCommission', '$publicTicketAudience', '$publicTicketStart', '$publicTicketEnd');";
            }else if(preg_match('/(delete)/',$publicTicketId)){

              $publicTicketId = str_replace("delete-", "",$publicTicketId);

              // Check audience
              $queryAudience = mysqli_query($conn, "SELECT COUNT(*) FROM subscribes_public WHERE id_ticket='$publicTicketId' AND subscribe_status='1'");
              $countAudience = mysqli_fetch_assoc($queryAudience)['COUNT(*)'];
              if($countAudience==0){
                $queryTicketsUpdate .= "DELETE FROM tickets_public WHERE id_event='$idEvent' AND id_ticket='$publicTicketId';";
              }

            }else{
              // query ticket update
              $queryTicketsUpdate .= "UPDATE tickets_public SET ticket_name='$publicTicketName', ticket_value='$publicTicketValue', ticket_commission='$publicTicketCommission', ticket_audience='$publicTicketAudience', ticket_dateStart='$publicTicketStart', ticket_dateEnd='$publicTicketEnd' WHERE id_event='$idEvent' AND id_ticket='$publicTicketId';";
            }
        }



        $eventDesc = trim($_POST['eventDesc']);
        $eventDesc = strip_tags($eventDesc);
        $eventDesc = htmlspecialchars($eventDesc);
        $eventDesc = mysqli_real_escape_string($conn, $eventDesc);

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

        if (empty($publicNameLocationEvent)) {
         $error = true;
         $publicNameLocationEventError = "Por favor ingresa el lugar del evento.";
       } else if (strlen($publicNameLocationEvent) < 3) {
         $error = true;
         $publicNameLocationEventError = "El lugar del evento debe tener más de 3 caracteres";
       } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$publicNameLocationEvent)) {
         $error = true;
         $publicNameLocationEventError = "El lugar del evento solo puede contener letras y números";
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

        // if($publicValueEvent==''){
        //   $error = true;
        //   $publicValueEventError = "Por favor, indica un valor de entrada.";
        // }else if(!is_numeric($publicValueEvent) && (!intval($publicValueEvent) == $publicValueEvent)){
        //   $error = true;
        //   $publicValueEventError = "El valor solo puede contener números.";
        // }

        if (empty($publicDateEvent)) {
         $error = true;
         $publicDateEventError = "Por favor ingresa la hora del evento.";
      } else if (strlen($publicDateEvent) < 3) {
         $error = true;
         $publicDateEventError = "Por favor ingresa una hora válida.";
       }else if(validateDate($publicDateEvent)==false){
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
      } else if (strlen($eventDesc) < 1) {
         $error = true;
         $eventDescError = "La descripción debe tener más de 1 caracter.";
       }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$eventDesc)) {
         $error = true;
         $eventDescError = "La descripción del evento contiene caracteres no permitidos.";
        }

       // Create dates
       $eventDate = date_create($publicDateEvent);
       // $timeEvent = DATE_FORMAT($eventDate, 'H:i:s');

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

       if (!file_exists($_FILES["file-input"]["tmp_name"])) {
        // Get previous image
        $imgRename = $arrayDataEvent['img'];
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
      }else if(!isset($imgRename)){
        $imgRename = str_replace(".", "_", uniqid(mt_rand(), true));
        $target = "images/events/" . $imgRename . '.jpg';

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
      }



      // Generate datetime
      $dateEvent = date_create($publicDateEvent);
      $dateEvent = DATE_FORMAT($dateEvent, 'Y-m-d');

      // Check dateEvent <= today
      $today = date('Y-m-d', time());
      if($dateEvent<$datePublicCheck AND $dateEvent<=$today){

         $error = true;
         $dateEventError = "Fecha inválida";

      }

      $dateEvent = $dateEvent.' '.$publicTimeEvent;

      // Query video
      if(isset($audioURL)){
        $queryTicketsUpdate .= "INSERT INTO multimedia_feature_events(id_event, service_multi, embed_multi) VALUES('$idEvent', '$service', '$audioURL');";
      }


      // Update data
      if( !$error){
        echo $publicValueEvent;
        // Generate Fee
        $fee = 10;
        $publicCommissionEvent = 0;
        $a = $publicValueEvent / 100;
        $a = $a * $fee;
        $publicCommissionEvent = round($a, 0);

        $queryUpdate = "UPDATE events_public SET id_region='$publicRegionEvent', id_city='$publicCityEvent', date_event='$dateEvent', name_event='$publicNameEvent', name_location='$publicNameLocationEvent', location='$publicLocationEvent', organizer='$publicOrganizerEvent', desc_event='$eventDesc', img='$imgRename' WHERE id_event='$idEvent' AND id_user='$userid';";
        $queryUpdate .= $queryTicketsUpdate;

        // multiquery
        if (mysqli_multi_query($conn, $queryUpdate)) {

          while (mysqli_next_result($conn)) // flush multi_queries
            {
                if (!mysqli_more_results($conn)) break;
            }

          // Check if user uploads picture
          if(file_exists($_FILES["file-input"]["tmp_name"])){

              if (imagejpeg($sourceImage, $target, 60)) {
                // if(mysqli_affected_rows($conn)){
                  $errTyp = "success";
                  $errMSG = "Evento modificado con éxito.";
                  $_SESSION['success'] = $errMSG;
                  header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                  die();
                // } else{
                //   $errTyp = "danger";
                //   $errMSG = "Ha sucedido un error, inténtalo de nuevo.";
                // }
              } else{
                $errTyp = "danger";
                $errMSG = "Ha sucedido un error, inténtalo de nuevo.";
              }
          }else{
            // if(mysqli_affected_rows($conn)){
              $errTyp = "success";
              $errMSG = "Evento modificado con éxito.";
              $_SESSION['success'] = $errMSG;
              header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
              die();
            // } else{
            //   $errTyp = "danger";
            //   $errMSG = "Ha sucedido un error, inténtalo de nuevo.";
            // }
          }


        }else{
          $errTyp = "danger";
          $errMSG = "Ha sucedido un error, inténtalo de nuevo.";
        }
      }else{
        $errTyp = "danger";
        $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

        // echo $publicNameTicketError;
        // echo $publicAudienceTicketError;
        // echo $publicValueTicketError;
        // echo $publicDateStartError;
        // echo $publicDateEndError;
        // echo $publicTicketIdError;
        // echo $publicNameEventError;
        // echo $publicLocationEventError;
        // echo $publicNameLocationEventError;
        // echo $publicOrganizerEventError;
        // echo $publicDateEventError;
        // echo $publicTimeEventError;
        // echo $publicCityEventError;
        // echo $publicRegionEventError;
        // echo $eventDescError;
        // echo $dateEventError;
      }

    }

}else{
    http_response_code(404);
    die();
  }
}else{
  http_response_code(403);
  die();
}
?>
