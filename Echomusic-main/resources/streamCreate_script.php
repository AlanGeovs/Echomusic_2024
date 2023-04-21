<?php
include 'connect.php';

if(isset($_SESSION['user']) && $_SESSION['user']!=''){

  $userid = $_SESSION['user'];

  if(isset($_POST['submitEvent'])){

    $error = false;

    // Get Data
    $nameEvent = trim($_POST['nameEvent']);
    $nameEvent = strip_tags($nameEvent);
    $nameEvent = htmlspecialchars($nameEvent);
    $nameEvent = mysqli_real_escape_string($conn, $nameEvent);

    $typeEvent = trim($_POST['typeEvent']);
    $typeEvent = FILTER_VAR($typeEvent, FILTER_SANITIZE_NUMBER_INT);
    $typeEvent = strip_tags($typeEvent);
    $typeEvent = htmlspecialchars($typeEvent);
    $typeEvent = mysqli_real_escape_string($conn, $typeEvent);

    $audienceEvent = trim($_POST['audienceEvent']);
    $audienceEvent = FILTER_VAR($audienceEvent, FILTER_SANITIZE_NUMBER_INT);
    $audienceEvent = strip_tags($audienceEvent);
    $audienceEvent = htmlspecialchars($audienceEvent);
    $audienceEvent = mysqli_real_escape_string($conn, $audienceEvent);

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

    $valueEvent = trim($_POST['valueEvent']);
    $valueEvent = FILTER_VAR($valueEvent, FILTER_SANITIZE_NUMBER_INT);
    $valueEvent = strip_tags($valueEvent);
    $valueEvent = htmlspecialchars($valueEvent);
    $valueEvent = mysqli_real_escape_string($conn, $valueEvent);

    $valueEvent = str_replace(".", "",$valueEvent);

    $descEvent = trim($_POST['descEvent']);
    // $descEvent = FILTER_VAR($descEvent, FILTER_SANITIZE_STRING);
    $descEvent = strip_tags($descEvent);
    $descEvent = htmlspecialchars($descEvent);
    $descEvent = mysqli_real_escape_string($conn, $descEvent);

    // Validate Data
    if (empty($nameEvent)) {
     $error = true;
     $nameEventError = "Por favor ingresa el nombre del evento.";
   } else if (strlen($nameEvent) < 3) {
     $error = true;
     $nameEventError = "El nombre del evento debe tener más de 3 caracteres";
   } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$nameEvent)) {
     $error = true;
     $nameEventError = "El nombre solo puede contener letras y números";
   }

   if(empty($typeEvent)){
     $error = true;
     $typeEventError = "Por favor ingresa un tipo de evento.";
   }else if (strlen($typeEvent) > 1){
     $error = true;
     $typeEventError = "Tipo de evento inválido.";
   }else if(!preg_match("/^[1-9][0-9]*$/", $typeEvent)){
     $error = true;
     $typeEventError = "Tipo de evento inválido.";
   }

   $minAudience = 1;
   $maxAudience = 5000;
   if(!FILTER_VAR($audienceEvent, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$minAudience, "max_range"=>$maxAudience))) ){
      $error = true;
      $audienceEventError = "Elige una audiencia entre 1 a 5000 personas";
   }

   include 'functionValidateDate.php';


   if(validateDate($dateEvent)==false){
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

   if($valueEvent==''){
     $error = true;
     $valueEventError = "Por favor, indica un valor de entrada.";
   }else if(!is_numeric($valueEvent) && (!intval($valueEvent) == $valueEvent)){
     $error = true;
     $valueEventError = "El valor solo puede contener números.";
   }

   if (empty($descEvent)) {
    $error = true;
    $descEventError = "Por favor ingresa una descripción.";
  } else if (strlen($descEvent) < 50) {
    $error = true;
    $descEventError = "La descripción debe tener más de 50 caracteres";
  } else if (strlen($descEvent) > 3000) {
    $error = true;
    $descEventError = "La descripción debe tener menos de 3000 caracteres";
  } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$descEvent)) {
    $error = true;
    $descEventError = "Descripción con caracteres inválidos";
   }

   // Get Image Dimension
   $fileinfo = @getimagesize($_FILES["imageEvent"]["tmp_name"]);
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
  $file_extension = pathinfo($_FILES["imageEvent"]["name"], PATHINFO_EXTENSION);

  if (! file_exists($_FILES["imageEvent"]["tmp_name"])) {
    $error = true;
    $imageEventError = "Por favor, elige una imagen para subir.";
  }    // Validate file input to check if is with valid extension
  else if (! in_array($file_extension, $allowed_image_extension)) {
    $error = true;
    $imageEventError = "Por favor, elige una imagen de formato JPG o PNG.";
  }    // Validate image file size
  else if (($_FILES["imageEvent"]["size"] > 5000000)) {
    $error = true;
    $imageEventError = "La imagen excede el peso de 5MB.";
  }    // Validate image file dimension
  else if ($width >= "1921" || $height >= "1081") {
    $error = true;
    $imageEventError = "Las dimensiones de la imagen son superior a 1920x1080";
  }

  // Create image from format

  $sourceImage = $_FILES["imageEvent"]["tmp_name"];
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

  // Generate datetime
  $today = date('Y-m-d', time());

  $dateEventValue = $dateEvent;
  $dateEvent = date_create($dateEvent);
  $dateEvent = DATE_FORMAT($dateEvent, 'Y-m-d');

  if($dateEvent<=$today){
    $error = true;
    $dateEventError = "Fecha inválida";
  }

  $dateEvent = $dateEvent.' '.$timeEvent;

  // If event free then change valueEvent var
  if($typeEvent=='1'){
    $valueEvent='0';
  }

  // If there's no error
   if(!$error){
     // Generate Fee
     $fee = 10;
     $commissionEvent = 0;
     $a = $valueEvent / 100;
     $a = $a * $fee;
     $commissionEvent = round($a, 0);
     $imgRename = str_replace(".", "_", uniqid(mt_rand(), true));
     $target = 'images/events/'.$imgRename.'.jpg';

     if (imagejpeg($sourceImage, $target, 60)) {
       $queryStreamingEvent = "INSERT INTO events_streaming (id_user, id_plan, date_event, duration_event, name_event, desc_event, audience_event, value, value_commission, img, active_event) VALUES ('$userid', '1', '$dateEvent', '$durationEvent', '$nameEvent', '$descEvent', '$audienceEvent', '$valueEvent', '$commissionEvent', '$imgRename', '0')";
       if(mysqli_query($conn, $queryStreamingEvent)){
         mysqli_query($conn, "INSERT INTO subscribes_streaming (id_event_streaming, id_user, subscribe_status) VALUES (LAST_INSERT_ID(), '$userid', '1')");
         $errTyp = 'success';
         $errMSG = 'Evento creado con éxito.';
       }else{
         $errTyp = 'danger';
         $errMSG = 'Ha sucedido un error, por favor vuelve a intentarlo.';
       }
     }else{
       $errTyp = 'danger';
       $errMSG = 'Ha sucedido un error, por favor vuelve a intentarlo.';
     }
   }else{
     $errTyp = 'danger';
     $errMSG = 'Ha sucedido un error, por favor revisa la información e inténtalo nuevamente.';
   }
 }
}else{
  $plsLogin = true;
}


 ?>
