<?php
include 'connect.php';

if(isset($_SESSION['user']) && isset($_GET['event'])){

  $userid = $_SESSION['user'];

  // SANITIZAR
  $eventId = trim($_GET['event']);
  $eventId = strip_tags($eventId);
  $eventId = htmlspecialchars($eventId);
  $eventId = mysqli_real_escape_string($conn, $eventId);

  $eventUser = FALSE;
  $queryCheckData = mysqli_query($conn, "SELECT * FROM user_ratings LEFT JOIN events_private ON user_ratings.id_event = events_private.id_event
                                                                    LEFT JOIN users ON events_private.id_user_sell = users.id_user WHERE user_ratings.id_user='$userid' AND user_ratings.id_event='$eventId' AND user_ratings.status_rating='open'");
// Check if event and user correlates
  if(mysqli_num_rows($queryCheckData)==1){
    $eventUser = TRUE;
    $eventData = mysqli_fetch_array($queryCheckData);
    $date = date_create($eventData['date_event']);
    $timeEvent = DATE_FORMAT($date, 'H:i');
    $dateEvent = DATE_FORMAT($date, 'd-m-Y');

    if(isset($_POST['submit_button'])){

      $error = false;

      $rateNumber = trim($_POST['rating']);
      $rateNumber = strip_tags($rateNumber);
      $rateNumber = htmlspecialchars($rateNumber);
      $rateNumber = mysqli_real_escape_string($conn, $rateNumber);

      $rateText = trim($_POST['rate_text']);
      $rateText = strip_tags($rateText);
      $rateText = htmlspecialchars($rateText);
      $rateText = mysqli_real_escape_string($conn, $rateText);

      $rateDate = date('Y-m-d h:i:s', time());

      if (empty($rateNumber)) {
       $error = true;
       $rateNumberError = "Calificación inválida";
     } else if (strlen($rateNumber) > 1) {
       $error = true;
       $rateNumberError = "Calificación inválida";
     }

     if (empty($rateText)) {
      $error = true;
      $rateTextError = "Por favor, escribe un comentario";
    } else if (strlen($rateText) < 3) {
      $error = true;
      $rateTextError = "El comentario debe tener más de 3 caracteres";
    } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$rateText)) {
      $error = true;
      $rateTextError = "El comentario solo puede contener letras y números";
     }

     if(empty($_SESSION['user'])){
       $error = true;
       $errTyp = 'danger';
       $errMSG = "Por favor, inicia sesión";
     }

     if(!$error){
       $queryRating = "UPDATE user_ratings SET number_rating='$rateNumber', comment_rating='$rateText', date_rating='$rateDate', status_rating='closed' WHERE id_event='$eventId' AND status_rating='open'";
       if(mysqli_query($conn, $queryRating)){
         $errTyp = "success";
         $errMSG = "Usuario calificado exitosamente, muchas gracias.";
       }else{
         $errTyp = "danger";
         $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
       }
     }else{
       $errTyp="danger";
       $errMSG="Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
     }

    }

  }else{
    $errTyp="unavailable";
    $errMSG="Proceso de valoración no disponible.";
  }

}else{
  $errTyp="unavailable";
  $plsLogin = true;
}
?>
