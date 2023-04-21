<?php
include 'connect.php';

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
   }
  }
}


 ?>
