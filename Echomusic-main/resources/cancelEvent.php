<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';
// Likes
  if(isset($_POST['id']) && $_POST['id']!=''){
    $userid = $_SESSION['user'];
  // Get data
    $eventId = FILTER_INPUT(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $eventId = mysqli_real_escape_string($conn, $eventId);

    $typeEvent = FILTER_INPUT(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT);
    $typeEvent = mysqli_real_escape_string($conn, $typeEvent);

  // Data Validation
  if(!FILTER_VAR($eventId, FILTER_VALIDATE_INT, 1)){
     $error = true;
     $eventIdError = "La información no es válida.";
   }

  if(!FILTER_VAR($typeEvent, FILTER_VALIDATE_INT, 1)){
     $error = true;
     $typeEventError = "La información no es válida.";
   }

   if( !$error ) {

     switch($typeEvent){
       case '2':
        $queryCancelEvent = "UPDATE events_public SET active_event='2' WHERE id_user='$userid' AND id_event='$eventId' AND id_type_event='$typeEvent'";
       break;
       case '4':
        $queryCancelEvent = "UPDATE events_streaming SET active_event='2' WHERE id_user='$userid' AND id_event='$eventId' AND id_type_event='$typeEvent'";
       break;
     }

      if (mysqli_query($conn, $queryCancelEvent)) {
        if(mysqli_affected_rows($conn)){
          $errTyp = "success";
          echo $errTyp;
         }else{
           $errTyp = "danger";
           echo $errTyp;
         }
       } else {
         $errTyp = "danger";
         echo $errTyp;
       }
   }else{
       $errTyp = "danger";
       echo $errTyp;
   }
 }
?>
