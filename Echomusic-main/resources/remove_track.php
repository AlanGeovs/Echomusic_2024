<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';
// Likes
  if(!empty($_POST['id'])){
    $id_user = $_SESSION['user'];
  // Get data
    $removeTrack = FILTER_INPUT(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $removeTrack = mysqli_real_escape_string($conn, $removeTrack);

  // Data Validation
  if(!FILTER_VAR($removeTrack, FILTER_VALIDATE_INT, 1)){
     $error = true;
     $removeTrack = "La información no es válida.";
   }

   if( !$error ) {
     $getTrackName = mysqli_query($conn, "SELECT audio FROM audio_user WHERE id_user='$id_user' and id_audio_user='$removeTrack'");
     $trackName = mysqli_fetch_array($getTrackName);
     // Query update genres
     $queryRemoveTrack = "DELETE FROM audio_user WHERE id_user='$id_user' AND id_audio_user='$removeTrack'";

      if (mysqli_query($conn, $queryRemoveTrack)) {
        if(unlink('../audios/'.$id_user.'/'.$trackName['audio'].'.mp3')){
          $errTyp = "success";
          $errMSG = "Información agregada con éxito";
          $data = "success";
          echo $data;
        }
       } else {
         $errTyp = "danger";
         $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
       }

     }
   }
?>
