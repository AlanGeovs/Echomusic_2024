<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';

if(isset($_POST['id'])){

  $userid = $_SESSION['user'];

  $error = false;

  $eventId = trim($_POST['id']);
  $eventId = FILTER_VAR($eventId, FILTER_SANITIZE_NUMBER_INT);
  $eventId = htmlspecialchars($eventId);
  $eventId = mysqli_real_escape_string($conn, $eventId);

  $streamURL = trim($_POST['url']);
  // $streamURL = strip_tags($streamURL, '<iframe>');
  // $streamURL = htmlspecialchars($streamURL);
  $streamURL = mysqli_real_escape_string($conn, $streamURL);
  // $streamURL = filter_var($streamURL, FILTER_SANITIZE_URL);

  $streamChat = trim($_POST['chat']);
  $streamChat = mysqli_real_escape_string($conn, $streamChat);

  // data validation
  if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $streamURL, $match)) {
      $streamURL = urlencode($match[1]);
      $service = '1';
  }else if (preg_match('%(?:vimeo.com)/(?:event/)([0-9]+)%i', $streamURL, $match)) {
      $streamURL = $streamURL;
      $service = '2';
  }else if (preg_match('%(?:player.vimeo.com)/(?:video/)([0-9]+)%i', $streamURL, $match)) {
      $streamURL = substr($streamURL, 0, strpos($streamURL, "<script"));
      $streamURL = $streamURL;
      $service = '2';
      //new commit
  }else if(strpos($streamURL, 'zoom')){
      $streamURL = $streamURL;
      $service = '3';
  }else{
    $error = true;
    $videoError = 'Este enlace no es válido, por favor inténtalo con otro.';
  }

  if(preg_match('%(?:vimeo.com)/(?:event/)([0-9]+)%i', $streamChat, $match)){
    $streamChat = $streamChat;
  }else{
    $streamChat = NULL;
  }

  if(!FILTER_VAR($eventId, FILTER_VALIDATE_INT, 1)){
    $error = true;
    $videoError = 'Evento inválido.';
  }

  if(!$error){
    $query = "UPDATE events_streaming SET streaming_multi='$streamURL', id_streaming_platform='$service', streaming_chat='$streamChat' WHERE id_user='$userid' AND id_event='$eventId'";
    if(mysqli_query($conn, $query)){
      $errTyp = 'success';
      echo $errTyp;
      die();
    }else{
      $errTyp = 'danger';
      echo $errTyp;
      die();
    }
  }else{
    $errTyp = 'danger';
    echo $errTyp;
    die();
  }

}

 ?>
