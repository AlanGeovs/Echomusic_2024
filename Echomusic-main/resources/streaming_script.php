<?php

include 'connect.php';

if(isset($_GET['event'])){

// Get event
  $idEventStreaming = trim($_GET['event']);
  $idEventStreaming = strip_tags($idEventStreaming);
  $idEventStreaming = htmlspecialchars($idEventStreaming);
  $idEventStreaming = mysqli_real_escape_string($conn, $idEventStreaming);

  // Query Event Info
  $queryEventsStreaming = mysqli_query($conn, "SELECT * FROM events_streaming WHERE id_event='$idEventStreaming'");
  $eventsStreaming_array = mysqli_fetch_array($queryEventsStreaming);

  $timeEventsStreamingData = date_create($eventsStreaming_array['date_event']);
  $dateEventStreaming = DATE_FORMAT($timeEventsStreamingData, 'm/d/Y H:i:s');

  // Check audience
  $totalAudience = $eventsStreaming_array['audience_event']+1;

  $queryAudience = mysqli_query($conn, "SELECT COUNT(*) FROM subscribes_streaming WHERE id_event_streaming='$idEventStreaming'");
  $countAudience = mysqli_fetch_assoc($queryAudience)['COUNT(*)'];


  // if zoom -5 minutes to time
  if($eventsStreaming_array['id_streaming_platform']=='3'){
    $dateEventStreaming = date('m/d/Y H:i:s', strtotime("-5 minutes", strtotime($eventsStreaming_array['date_event'])));
  }
  // if vimeo -5 minutes to time
  if($eventsStreaming_array['id_streaming_platform']=='2'){
    $dateEventStreaming = date('m/d/Y H:i:s', strtotime("-5 minutes", strtotime($eventsStreaming_array['date_event'])));
  }

  $today = date('m/d/Y H:i:s', time());

}

if(isset($_SESSION['user'])){

  $userid = $_SESSION['user'];

  $querySubscribedUser = mysqli_query($conn, "SELECT * FROM subscribes_streaming WHERE id_event_streaming='$idEventStreaming' AND id_user='$userid' AND subscribe_status='1'");

  if(mysqli_num_rows($querySubscribedUser) > 0){
    $userSubscription = 1;
  }else{
    $userSubscription = 0;
  }

}else{
  $plsLogin = true;
}

 ?>
