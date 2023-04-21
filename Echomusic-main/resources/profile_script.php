<?php

include 'connect.php';


// Display info Queries

// SANITIZAR

if(FILTER_INPUT(INPUT_GET, 'userid', FILTER_VALIDATE_INT, 1)){
  $userid = $_GET["userid"];
}else{
  http_response_code(404);
  header("HTTP/1.0 404 Not Found");
  die();
}


$queryInfo = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$userid'");
$userInfo_array = mysqli_fetch_array($queryInfo);

$queryProfile = mysqli_query($conn, "SELECT * FROM users LEFT JOIN desc_user ON users.id_user = desc_user.id_user
                                                         LEFT JOIN type_musician ON users.id_musician = type_musician.id_musician
                                                         LEFT JOIN instruments ON users.id_instrument = instruments.id_instrument
                                                         LEFT JOIN regions ON users.id_region = regions.id_region
                                                         LEFT JOIN cities ON users.id_city = cities.id_city WHERE users.id_user='$userid'");

if(mysqli_num_rows($queryProfile)==0){
  http_response_code(404);
  header("HTTP/1.0 404 Not Found");
  die();
}
$userProfile_array = mysqli_fetch_array($queryProfile);

if($userProfile_array['id_type_user'] !== '1'){
  http_response_code(404);
  header("HTTP/1.0 404 Not Found");
  die();
}

// Get url breadcrumb
$breadCrumbUrl = $_SERVER['HTTP_REFERER'];

switch(true){
  case preg_match("/search/i", $breadCrumbUrl):
    $breadCrumbUrl = $breadCrumbUrl;
    $breadCrumbName = "Buscador";
  break;

  case preg_match("/index/i", $breadCrumbUrl):
    $breadCrumbUrl = "https://qa.echomusic.cl/index.php";
    $breadCrumbName = "Inicio";
  break;
  case true:
    $breadCrumbUrl = "https://qa.echomusic.cl/index.php";
    $breadCrumbName = "Inicio";
  break;
}

// Get Genre
$queryGenre = mysqli_query($conn, "SELECT * FROM genre_user LEFT JOIN genres ON genre_user.id_genre = genres.id_genre WHERE genre_user.id_user='$userid'");
$userGenre_array = mysqli_fetch_array($queryGenre);
$user_idGenre = $userGenre_array['id_genre'];

// Get SubGenres
$querySubGenre = mysqli_query($conn, "SELECT * FROM subGenres_user LEFT JOIN sub_genres ON subGenres_user.id_subGenre = sub_genres.id_subGenre WHERE subGenres_user.id_user='$userid'");
$userSubGenresArray = array();
while($userSubGenre_array = mysqli_fetch_array($querySubGenre)){
  $userSubGenresArray[] = $userSubGenre_array;
}

// Get tracks
// $queryTracks = mysqli_query($conn, "SELECT * FROM audio_user WHERE id_user='$userid'");
// $userTracksArray = array();
// while($userTracks = mysqli_fetch_array($queryTracks)){
//   $userTracksArray[] = $userTracks;
// }

// Get soundcloud playlist
$queryTracks = mysqli_query($conn, "SELECT * FROM multimedia_feature WHERE id_user='$userid'");
$userTracks = mysqli_fetch_array($queryTracks);


// Get Bio
$queryUserBio = mysqli_query($conn, "SELECT * FROM bio_user WHERE id_user='$userid'");
$userBio = mysqli_fetch_array($queryUserBio);

// Get band members
$queryBandMembers = mysqli_query($conn, "SELECT * FROM band_members LEFT JOIN instruments ON band_members.instrument_member = instruments.id_instrument WHERE id_user='$userid'");
if($userInfo_array['id_musician'] == 2){
  if(mysqli_num_rows($queryBandMembers)>0){
    $bandMembersDisplay = true;
  }
  $bandMembersArray = array();
  while($bandMembers = mysqli_fetch_array($queryBandMembers)){
    $bandMembersArray[] = $bandMembers;
  }
  $bandMembersActive = true;
}

// Get next events

$dateStart = date('Y-m-d', time()).' 00:00:00';
$dateEnd = date('Y-m-d', strtotime("+1 month")).' 23:59:59';

$queryNextEventsLinked = mysqli_query($conn, "SELECT events_linked.id_event, public_name_event AS name_event, public_date_event AS date_event, events_linked.id_type_event FROM events_linked LEFT JOIN events_private ON events_private.id_event = events_linked.id_event_private WHERE events_private.id_user_sell='$userid' AND (public_date_event BETWEEN '$dateStart' AND '$dateEnd') AND (active_event='1')");
$queryNextEventsPublic = mysqli_query($conn, "SELECT id_event, name_event, date_event, id_type_event FROM events_public WHERE id_user='$userid' AND (date_event BETWEEN '$dateStart' AND '$dateEnd') AND (active_event='1')");
$queryNextEventsStreaming = mysqli_query($conn, "SELECT id_event, name_event, date_event, id_type_event FROM events_streaming WHERE id_user='$userid' AND (date_event BETWEEN '$dateStart' AND '$dateEnd') AND (active_event='1')");

if(mysqli_num_rows($queryNextEventsLinked) > 0){
  $nextEventsLinkedArray = array();
  while($nextEventsLinked = mysqli_fetch_assoc($queryNextEventsLinked)){
    $nextEventsLinkedArray[] = $nextEventsLinked;
  }
  // Set next events to true
  $nextEventsActive = true;
}else{
  $nextEventsLinkedArray = array();
}

if(mysqli_num_rows($queryNextEventsPublic) > 0){
  $nextEventsPublicArray = array();
  while($nextEventsPublic = mysqli_fetch_assoc($queryNextEventsPublic)){
    $nextEventsPublicArray[] = $nextEventsPublic;
  }
  // Set next events to true
  $nextEventsActive = true;
}else{
  $nextEventsPublicArray = array();
}

if(mysqli_num_rows($queryNextEventsStreaming) > 0){
  $nextEventsStreamingArray = array();
  while($nextEventsStreaming = mysqli_fetch_assoc($queryNextEventsStreaming)){
    $nextEventsStreamingArray[] = $nextEventsStreaming;
  }
  // Set next events to true
  $nextEventsActive = true;
}else{
  $nextEventsStreamingArray = array();
}

if($nextEventsActive==true){
$nextEventsArray = array_merge($nextEventsStreamingArray, $nextEventsPublicArray, $nextEventsLinkedArray);

  // Sort events array by date
    usort($nextEventsArray, function($a, $b) {
      $ad = new DateTime($a['date_event']);
      $bd = new DateTime($b['date_event']);

      if ($ad == $bd) {
        return 0;
      }

      return $ad < $bd ? -1 : 1;
    });
}

// Get Multimedia
$queryMultimedia = mysqli_query($conn, "SELECT * FROM multimedia WHERE id_user='$userid' ORDER BY date_multi DESC");
$multiArray = array();
while($multimediaArray = mysqli_fetch_array($queryMultimedia)){
  $multiArray[] = $multimediaArray;
}

// Get Featured Multimedia
$queryFeaturedMultimedia = mysqli_query($conn, "SELECT * FROM multimedia WHERE id_user='$userid' ORDER BY date_multi DESC LIMIT 1");
$idPost = mysqli_fetch_array($queryFeaturedMultimedia);
$idPost = $idPost['id_multi'];

// Get all ratings values
$queryRatings = mysqli_query($conn, "SELECT id_rating, user_ratings.id_user, id_artist, id_event, number_rating, comment_rating, date_rating, first_name_user, last_name_user FROM user_ratings LEFT JOIN users ON user_ratings.id_user = users.id_user WHERE id_artist='$userid' AND status_rating='closed' ORDER BY date_rating DESC");
$rateArray = array();
while($ratingArray = mysqli_fetch_array($queryRatings)){
  $rateArray[] = $ratingArray;
}

// Profile rating 3
$rateArray3 = array_slice($rateArray, 0, 3, true);

// Modal rating rate 9
$rateArray9 = array_slice($rateArray, 0, 9, true);

// Total rating
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

// Count 5 stars
if(count($rateArray)>0){
  $rateN1 = 0;
  $rateN2 = 0;
  $rateN3 = 0;
  $rateN4 = 0;
  $rateN5 = 0;
  foreach($rateArray as $values){
    switch($values['number_rating']){
      case "1":
        $rateN1 = $rateN1 + 1;
      break;
      case "2":
        $rateN2 = $rateN2 + 1;
      break;
      case "3":
        $rateN3 = $rateN3 + 1;
      break;
      case "4":
        $rateN4 = $rateN4 + 1;
      break;
      case "5":
        $rateN5 = $rateN5 + 1;
      break;
    }
  }
  $countRatings = count($rateArray);
  $rateN1 = (($rateN1 * 100) / $countRatings);
  $rateN2 = (($rateN2 * 100) / $countRatings);
  $rateN3 = (($rateN3 * 100) / $countRatings);
  $rateN4 = (($rateN4 * 100) / $countRatings);
  $rateN5 = (($rateN5 * 100) / $countRatings);
}else{
  $totalRating = "Sin valoraciones";
}

// Get Main stats
$queryFollows = mysqli_query($conn, "SELECT COUNT(*) FROM follow_users WHERE id_user='$userid'");
$countFollows = mysqli_fetch_assoc($queryFollows)['COUNT(*)'];

$queryFollowers = mysqli_query($conn, "SELECT COUNT(*) FROM follow_users WHERE id_artist='$userid'");
$countFollowers = mysqli_fetch_assoc($queryFollowers)['COUNT(*)'];


$queryPublications = mysqli_query($conn, "SELECT COUNT(*) FROM multimedia WHERE id_user='$userid'");
$countPublications = mysqli_fetch_assoc($queryPublications)['COUNT(*)'];


// Plans
$queryPlans = mysqli_query($conn, "SELECT * from plans LEFT JOIN type_reinforcements id1 on plans.backline = id1.id_type_reinforcement
                                                       LEFT JOIN type_reinforcements id2 on plans.sound_engineer = id2.id_type_reinforcement
                                                       LEFT JOIN type_reinforcements id3 on plans.sound_reinforcement = id3.id_type_reinforcement
                                                       LEFT JOIN name_plan ON plans.id_name_plan = name_plan.id_name_plan WHERE plans.id_user='$userid'");
$planArray = array();
while($pricingArray = mysqli_fetch_array($queryPlans)){
  $planArray[] = $pricingArray;
}

// Get instruments
$queryInstrumentInfo = mysqli_query($conn, "SELECT * FROM instruments");
$instrumentsArray = array();
while($instruments = mysqli_fetch_array($queryInstrumentInfo)){
  $instrumentsArray[] = $instruments;
}

// Submit cotizacion

if ( isset($_POST['cotizacion_submit']) ) {

     // clean user inputs to prevent sql injections
     $userForm_id = $_SESSION['user'];

     $asuntoCotizacion = trim($_POST['asuntoCotizacion']);
     $asuntoCotizacion = strip_tags($asuntoCotizacion);
     $asuntoCotizacion = htmlspecialchars($asuntoCotizacion);
     $asuntoCotizacion = mysqli_real_escape_string($conn, $asuntoCotizacion);

     $descCotizacion = trim($_POST['descCotizacion']);
     $descCotizacion = strip_tags($descCotizacion);
     $descCotizacion = htmlspecialchars($descCotizacion);
     $descCotizacion = mysqli_real_escape_string($conn, $descCotizacion);

     // basic first_name validation
     if (empty($asuntoCotizacion)) {
      $error = true;
      $asuntoCotizacionError = "Por favor, ingresa el asunto.";
    } else if (strlen($asuntoCotizacion) < 3) {
      $error = true;
      $asuntoCotizacionError = "El asunto debe tener más de 3 caracteres";
    } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$asuntoCotizacion)) {
      $error = true;
      $asuntoCotizacionError = "El asunto solo puede contener letras";
     }
     // basic desc validation
     if (strlen($descCotizacion) < 50) {
      $error = true;
      $descCotizacionError = "La descripción debe tener más de 50 caracteres.";
    }else if (strlen($descCotizacion) > 10000){
      $error = true;
      $descCotizacionError = "La descripción no puede tener más de 10000 caracteres.";
    }

    $date = date('Y-m-d h:i:s', time());

    $userForm_query = mysqli_query($conn, "SELECT first_name_user, last_name_user, mail_user FROM users WHERE id_user='$userForm_id'");
    $userForm_array = mysqli_fetch_assoc($userForm_query);

     // if there's no error, continue to mail
     if( !$error ) {

       $userFormName = $userForm_array['first_name_user'];
       $userFormLastName = $userForm_array['last_name_user'];
       $userFormMail = $userForm_array['mail_user'];

       $text = '<html><p>Nombre usuario: '.$userFormName.' '.$userFormLastName.'</p> <p>Artista: '.$userid.'</p> <p>'.$descCotizacion.'</p></html>';
       $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
       $headers .= 'From: '.$userFormMail.'' . "\r\n";

       if(mail('booking@echomusic.cl', "Contacto, cotización: ".$asuntoCotizacion, $text, $headers)){
         $errTyp = "success";
         $errMSG = "Cotización enviada, nos pondremos en contacto contigo en un plazo máximo de 48 horas hábiles.";

         $_SESSION['success'] = $errMSG;
         header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
         exit();

      } else {
       $errTyp = "danger";
       $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
      }

    }else{
      $errTyp = "danger";
      $errMSG = "Ha sucedido un error, por favor verifica la información.";
    }


}

if(isset($_SESSION['user'])){

  $checkUserId = $_SESSION['user'];

  $checkUser = false;

  $queryFollow = mysqli_query($conn, "SELECT * FROM follow_users WHERE id_user='$checkUserId' AND id_artist='$userid'");
  if(mysqli_num_rows($queryFollow)){
    $followingUser = true;
  } else {
    $followingUser = NULL;
  }

  if($userid == $checkUserId){

    $checkUser = true;

    if($userInfo_array['first_login'] == 'yes'){
      header('Location: first_login.php');
      die();
    }

// Edit  DESC info
$queryMusicianInfo = mysqli_query($conn, "SELECT * FROM type_musician");
$queryGenresInfo = mysqli_query($conn, "SELECT * FROM genres");
$queryRegionsInfo = mysqli_query($conn, "SELECT * FROM regions");


$error = false;

if ( isset($_POST['submit_desc']) && $checkUser == true ) {

  // $typeMusician = trim($_POST['musician']);
  // $typeMusician = strip_tags($typeMusician);
  // $typeMusician = htmlspecialchars($typeMusician);
  // $typeMusician = mysqli_real_escape_string($conn, $typeMusician);

  // if(isset($_POST['instrument'])){
  //   $instrument = trim($_POST['instrument']);
  //   $instrument = strip_tags($instrument);
  //   $instrument = htmlspecialchars($instrument);
  //   $instrument = mysqli_real_escape_string($conn, $instrument);
  // }

  // $genre = trim($_POST['genre']);
  // $genre = strip_tags($genre);
  // $genre = htmlspecialchars($genre);
  // $genre = mysqli_real_escape_string($conn, $genre);

  $desc = trim($_POST['description_text']);
  $desc = strip_tags($desc);
  $desc = htmlspecialchars($desc);
  $desc = mysqli_real_escape_string($conn, $desc);

  // data validation (AGREGAR preg_match ints)
 //  if (empty($typeMusician)) {
 //   $error = true;
 //   $musicianError = "Por favor elige el tipo de artista";
 // }
 //
 //  if (empty($genre)) {
 //   $error = true;
 //   $genreError = "Por favor elige el género musical";
 // }

 // if (filter_var($genre, FILTER_VALIDATE_INT) === 0 || filter_var($genre, FILTER_VALIDATE_INT)) {
 //
 // } else {
 //   $error=true;
 //   $genreError = "Por favor elige un género válido";
 // }

  if (strlen($desc) > 504) {
   $error = true;
   $descError = "La descripción debe tener menos de 500 caracteres.";
 }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$desc)) {
   $error = true;
   $descError = "La descripción solo puede contener letras y números";
  }

 if( !$error ) {

   // $query1 = "UPDATE users SET id_musician='$typeMusician' WHERE id_user='$userid'";
   // $query2 = "UPDATE genre_user SET id_genre='$genre' WHERE id_user='$userid'";
   $query3 = "UPDATE desc_user SET desc_user='$desc' WHERE id_user='$userid'";

       if (mysqli_query($conn, $query3)) {

         // if($genre != $user_idGenre){
         //   $query5 = "UPDATE subGenres_user SET id_subGenre='0' WHERE id_user='$userid'";
         //   mysqli_query($conn, $query5);
         // }

         // if(isset($instrument)){
         //   $query4 = "UPDATE users SET id_instrument='$instrument' WHERE id_user='$userid'";
         //
         //   if(mysqli_query($conn, $query4)){
         //
         //     $errTyp = "success";
         //     $errMSG = "Información agregada con éxito, redirigiendo a tu perfil...";
         //     unset($type_musician);
         //     unset($genre);
         //     unset($desc);
         //     unset($instrument);
         //     header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
         //     exit();
         //   }else{
         //     $errTyp = "danger";
         //     $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
         //   }
         // }
         // else{

          $errTyp = "success";
          $errMSG = "Información agregada con éxito.";
          unset($type_musician);
          unset($genre);
          unset($desc);
          $_SESSION['success'] = $errMSG;
          header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
          exit();
        // }
       }  else {
    $errTyp = "danger";
    $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
    $error = false;
   }
}else{
  $errTyp = "danger";
  $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo";
}
}

// Edit Audio info
if ( isset($_POST['submit_video']) && $checkUser == true) {

  $audioURL = trim($_POST['url_video']);
  $audioURL = strip_tags($audioURL, '<iframe>');
  $audioURL = htmlspecialchars($audioURL);
  $audioURL = mysqli_real_escape_string($conn, $audioURL);

  $titleVideo = trim($_POST['title_video']);
  $titleVideo = strip_tags($titleVideo);
  $titleVideo = htmlspecialchars($titleVideo);
  $titleVideo = mysqli_real_escape_string($conn, $titleVideo);

  // $descAudio = trim($_POST['desc_audio']);
  // $descAudio = strip_tags($descAudio);
  // $descAudio = htmlspecialchars($descAudio);
  // $descAudio = mysqli_real_escape_string($conn, $descAudio);

  // data validation
  if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $audioURL, $match)) {
      $audioURL = urlencode($match[1]);
      $service = 'youtube';
  }else if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $audioURL, $match)) {
      $audioURL = urlencode($match[3]);
      $service = 'vimeo';
  }else if(preg_match('%(?:soundcloud.com)/(?:tracks/)([0-9]+)%i', $audioURL, $match)){
      $audioURL = urlencode($match[1]);
      $service = 'soundcloud';
  }else{
    $error = true;
    $videoError = 'Este enlace no es válido, por favor inténtalo con otro.';
  }

  if(empty($titleVideo)){
    $error = true;
    $titleVideoError = 'Por favor, escribe un título';
  } else if(strlen($titleVideo) > 30){
    $error = true;
    $titleVideoError = 'El título no puede tener más de 30 caracteres';
  } else if(strlen($titleVideo)<3){
    $error = true;
    $titleVideoError = 'El título debe tener más de 3 caracteres';
  } else if(!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$titleVideo)){
    $error = true;
    $titleVideoError = 'El título tiene caracteres no permitidos.';
  }

  // if(empty($descAudio)){
  //   $error = true;
  //   $descAudioError = 'Por favor, escribe un descripción';
  // } else if(strlen($titleVideo) > 512){
  //   $error = true;
  //   $descAudioError = 'La descripción no puede tener más de 512 caracteres';
  // } else if(strlen($titleVideo)<=1){
  //   $error = true;
  //   $descAudioError = 'La descripción debe tener más de 1 caractere';
  // }else if(!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$descAudio)){
  //   $error = true;
  //   $descAudioError = 'La descripción tiene caracteres no permitidos.';
  // }

  // Get current DateTime
  // $dateAudio = date('Y-m-d H:i:s', time());

 if( !$error ) {

   $queryAudio = "INSERT INTO multimedia(id_user, embed_multi, service_multi, title_multi) VALUES ('$userid', '$audioURL', '$service', '$titleVideo')";
    if (mysqli_query($conn, $queryAudio)) {
      $errTyp = "success";
      $errMSG = "Video publicado con éxito";
      $_SESSION['success'] = $errMSG;
      header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
      exit();
    }else {
     $errTyp = "danger";
     $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
    }
  }
   else {
    $errTyp = "danger";
    $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
   }
}

// Avatar Edits
// if (isset($_POST["submit_avatar"]) && $checkUser == true) {
//
//     // Get Image Dimension
//     $fileinfo = @getimagesize($_FILES["file_avatar"]["tmp_name"]);
//     $width = $fileinfo[0];
//     $height = $fileinfo[1];
//
//     $allowed_image_extension = array(
//         "png",
//         "jpg",
//         "jpeg",
//         "JPG",
//         "JPEG",
//         "PNG"
//     );
//
//     // Get image file extension
//     $file_extension = pathinfo($_FILES["file_avatar"]["name"], PATHINFO_EXTENSION);
//
//     // Validate file input to check if is not empty
//     if (! file_exists($_FILES["file_avatar"]["tmp_name"])) {
//       $error = true;
//       $avatarError = "Por favor elige una imagen para subir.";
//
//     }    // Validate file input to check if is with valid extension
//     else if (! in_array($file_extension, $allowed_image_extension)) {
//       $error = true;
//       $avatarError = "Por favor elige una imagen de formato JPG o PNG.";
//
//     }    // Validate image file size
//     else if (($_FILES["file_avatar"]["size"] > 5000000)) {
//       $error = true;
//       $avatarError = "La imagen excede el peso de 5MB.";
//     }    // Validate image file dimension
//     else if ($width >= "1921" || $height >= "1081") {
//       $error = true;
//       $avatarError = "Las dimensiones de la imagen son superior a...";
//     }
//     if( !$error ){
//
//         $target = "images/avatars/" . $userid . '.jpg';
//         if (move_uploaded_file($_FILES["file_avatar"]["tmp_name"], $target)) {
//           $errTyp = "success";
//           $errMSG = "Imagen agregada con éxito.";
//           header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
//           exit();
//         } else {
//           $errTyp = "danger";
//           $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
//         }
//     } else{
//       $errTyp = "danger";
//       $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
//     }
// }

// Cover Edits
// if (isset($_POST["submit_cover"]) && $checkUser == true) {
//     // Get Image Dimension
//     $fileinfo = @getimagesize($_FILES["file_cover"]["tmp_name"]);
//     $width = $fileinfo[0];
//     $height = $fileinfo[1];
//
//     $allowed_image_extension = array(
//         "png",
//         "jpg",
//         "jpeg",
//         "JPG",
//         "JPEG",
//         "PNG"
//     );
//
//     // Get image file extension
//     $file_extension = pathinfo($_FILES["file_cover"]["name"], PATHINFO_EXTENSION);
//
//     // Validate file input to check if is not empty
//     if (! file_exists($_FILES["file_cover"]["tmp_name"])) {
//       $error = true;
//       $coverError = "Por favor elige una imagen para subir.";
//
//     }    // Validate file input to check if is with valid extension
//     else if (! in_array($file_extension, $allowed_image_extension)) {
//       $error = true;
//       $coverError = "Por favor elige una imagen de formato JPG o PNG.";
//
//     }    // Validate image file size
//     else if (($_FILES["file_cover"]["size"] > 5000000)) {
//       $error = true;
//       $coverError = "La imagen excede el peso de 5MB.";
//     }    // Validate image file dimension
//     else if ($width >= "1921" || $height >= "1081") {
//       $error = true;
//       $coverError = "Las dimensiones de la imagen son superior a...";
//     }
//     if( !$error ){
//         $target = "images/covers/" . $userid . '.jpg';
//         if (move_uploaded_file($_FILES["file_cover"]["tmp_name"], $target)) {
//           $errTyp = "success";
//           $errMSG = "Imagen agregada con éxito.";
//           header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
//           exit();
//         } else {
//           $errTyp = "danger";
//           $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
//         }
//     } else{
//       $errTyp = "danger";
//       $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
//     }
// }

// Submit biography
if ( isset($_POST['submit_bio']) && $checkUser == true) {

  $bio = trim($_POST['bio_text']);
  $bio = strip_tags($bio);
  $bio = htmlspecialchars($bio);
  $bio = mysqli_real_escape_string($conn, $bio);

  if (strlen($bio) > 3001) {
   $error = true;
   $bioError = "La biografía debe tener menos de 3000 caracteres.";
 }else if (empty($bio)){
   $bio = '';
 }else if(!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$bio)) {
   $error = true;
   $bioError = "La biografía solo puede contener letras y números";
  }

 if( !$error ) {

   if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bio_user WHERE id_user='$userid'")) > 0){
    $queryBio = "UPDATE bio_user SET bio_user='$bio' WHERE id_user='$userid'";
  }else{
    $queryBio = "INSERT INTO bio_user(id_user, bio_user) values('$userid', '$bio')";
  }

   if (mysqli_query($conn, $queryBio)) {
      $errTyp = "success";
      $errMSG = "Información agregada con éxito.";
      $_SESSION['success'] = $errMSG;
      header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
      exit();
   }else {
    $errTyp = "danger";
    $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
    $error = false;
   }
  }else{
    $errTyp = "danger";
    $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo";
  }
}

// Submit band member
if ( isset($_POST['submit_member']) && $checkUser == true) {

  $fname_member = trim($_POST['first_name_member']);
  $fname_member = strip_tags($fname_member);
  $fname_member = htmlspecialchars($fname_member);
  $fname_member = mysqli_real_escape_string($conn, $fname_member);

  $lname_member = trim($_POST['last_name_member']);
  $lname_member = strip_tags($lname_member);
  $lname_member = htmlspecialchars($lname_member);
  $lname_member = mysqli_real_escape_string($conn, $lname_member);

  $instrument_member = FILTER_INPUT(INPUT_POST, 'instrument_member', FILTER_VALIDATE_INT, 1);
  $instrument_member = strip_tags($instrument_member);
  $instrument_member = htmlspecialchars($instrument_member);
  $instrument_member = mysqli_real_escape_string($conn, $instrument_member);

  // Band Member Profile pic
  // Get Image Dimension
  $fileinfo = @getimagesize($_FILES["file_member"]["tmp_name"]);
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
  $file_extension = pathinfo($_FILES["file_member"]["name"], PATHINFO_EXTENSION);

  // Validate file input to check if is not empty
  if (! file_exists($_FILES["file_member"]["tmp_name"])) {
    $error = true;
    $avatarMemberError = "Por favor, elige una imagen para subir.";

  }    // Validate file input to check if is with valid extension
  else if (! in_array($file_extension, $allowed_image_extension)) {
    $error = true;
    $avatarMemberError = "Por favor, elige una imagen de formato JPG o PNG.";

  }    // Validate image file size
  else if (($_FILES["file_member"]["size"] > 5000000)) {
    $error = true;
    $avatarMemberError = "La imagen excede el peso de 5MB.";
  }    // Validate image file dimension
  else if ($width >= "1921" || $height >= "1081") {
    $error = true;
    $avatarMemberError = "Las dimensiones de la imagen son superior a...";
  }

  if(!filter_var($instrument_member, FILTER_VALIDATE_INT, 1 )){
    $error = true;
    $instrument_memberError = "Instrumento inválido.";
  }

  if (strlen($fname_member) < 3) {
   $error = true;
   $fname_memberError = "El nombre debe tener más de 3 caracteres.";
 }else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$fname_member)) {
   $error = true;
   $fname_memberError = "El nombre solo puede contener letras";
  }

  if (strlen($lname_member) < 3) {
   $error = true;
   $lname_memberError = "El apellido debe tener más de 3 caracteres.";
 }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$lname_member)) {
   $error = true;
   $lname_memberError = "El apellido solo puede contener letras";
  }

 if( !$error ) {
   $imgRename = str_replace(".", "_", uniqid(mt_rand(), true));
   $target = "images/band_members/".$imgRename.'.jpg';
   if (move_uploaded_file($_FILES["file_member"]["tmp_name"], $target)){
     $queryBandMember = "INSERT INTO band_members(id_user, first_name_member, last_name_member, instrument_member, img_member) VALUES ('$userid', '$fname_member', '$lname_member', '$instrument_member', '$imgRename')";
     if (mysqli_query($conn, $queryBandMember)) {
        $errTyp = "success";
        $errMSG = "Información agregada con éxito.";
        $_SESSION['success'] = $errMSG;
        header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
        exit();
     }else {
      $errTyp = "danger";
      $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
     }
   }
  }else{
    $errTyp = "danger";
    $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo";
  }
}

// Audio submit
  if(isset($_POST['submit_audio']) && $checkUser == true){

      $audioURL = trim($_POST['url_audio']);
      //$audioURL = strip_tags($audioURL);
      //$audioURL = htmlspecialchars($audioURL);
      $audioURL = mysqli_real_escape_string($conn, $audioURL);


      // Validate data
      if(preg_match('%(?:soundcloud.com)/(?:playlists/)([0-9]+)%i', $audioURL, $match)){
        $audioURL = $audioURL;
        $service = 'soundcloud';
      }else{
        $error = true;
        $audioError = 'Este enlace no es válido, por favor inténtalo con otro.';
      }


      if( !$error ) {

         if (mysqli_query($conn, "INSERT INTO multimedia_feature(id_user, service_multi, embed_multi) VALUES('$userid', '$service', '$audioURL') ON DUPLICATE KEY UPDATE service_multi='$service', embed_multi='$audioURL' ")) {
            $errTyp = "success";
            $errMSG = "Información agregada con éxito.";
            $_SESSION['success'] = $errMSG;
            header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
            exit();
          }else{
            $errTyp = "danger";
            $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo";
          }

      }else{

        $errTyp = "danger";
        $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo";
      }
    }

    // End submit audio

}else{
  $checkUser = false;
}

}

?>
