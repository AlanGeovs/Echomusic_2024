<?php
include 'connect.php';

// Get url breadcrumb
$breadCrumbUrl = $_SERVER['HTTP_REFERER'];

switch(true){
  case preg_match("/calendar/i", $breadCrumbUrl):
    $breadCrumbUrl = $breadCrumbUrl;
    $breadCrumbName = "Cartelera";
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

if(isset($_SESSION['user'])){
  $userid = $_SESSION['user'];
}
$today = date('Y-m-d H:i:s', time());
if($idEvent = filter_input(INPUT_GET, 'public', FILTER_VALIDATE_INT, 1)){

  // validate and escape Id Event
  $idEvent = intval($idEvent);
  $idEvent = mysqli_real_escape_string($conn, $idEvent);

  // var type event
  $typeEvent = 'public';

  // Query event data and fetch array
  $queryEventDetail = mysqli_query($conn, "SELECT * FROM events_public LEFT JOIN cities ON events_public.id_city = cities.id_city
                                                                 WHERE id_event='$idEvent'");
  $eventDetail = mysqli_fetch_array($queryEventDetail);

  //Query tickets
  $queryTicketsDetail = mysqli_query($conn, "SELECT * FROM tickets_public WHERE id_event='$idEvent' ORDER BY ticket_value ASC LIMIT 1");
  $ticketsDetail = mysqli_fetch_array($queryTicketsDetail);

  $queryTicketsAudience = mysqli_query($conn, "SELECT SUM(ticket_audience) AS total_tickets FROM tickets_public WHERE id_event='$idEvent'");
  $ticketsAudience = mysqli_fetch_array($queryTicketsAudience);

  // Get video
  $queryFeaturedMultimedia = mysqli_query($conn, "SELECT * FROM multimedia_feature_events WHERE id_event='$idEvent' ORDER BY id_multimedia_featured DESC LIMIT 1");
  if(mysqli_num_rows($queryFeaturedMultimedia)>0){
    $postDetail = mysqli_fetch_array($queryFeaturedMultimedia);
  }


// Check if event exists
  if(mysqli_num_rows($queryEventDetail) >= 1){

    // var name Event
    $eventName = $eventDetail['name_event'];

    // Check audience
    $totalAudience = $ticketsAudience['total_tickets'];

    $queryAudience = mysqli_query($conn, "SELECT COUNT(*) FROM subscribes_public WHERE id_event_public='$idEvent' AND subscribe_status='1'");
    $countAudience = mysqli_fetch_assoc($queryAudience)['COUNT(*)'];

    // Total event value
    $totalValue = number_format($ticketsDetail['ticket_value']+$ticketsDetail['ticket_commission'] , 0, ',', '.');
    // Format event value
    $ticketsDetail['ticket_value'] = number_format($ticketsDetail['ticket_value'] , 0, ',', '.');
    // Format event commission
    $ticketsDetail['ticket_commission'] = number_format($ticketsDetail['ticket_commission'] , 0, ',', '.');

    // if($ticketsDetail['ticket_value'] == '0'){
    //   $eventValue = "Entrada Liberada";
    // }else {
    //   $eventValue = '$'.$ticketsDetail['ticket_value'];
    // }

    $eventValue = '$'.$totalValue;

    // Create and Format Date
    $eventDate = $eventDetail['date_event'];
    $eventDate = date($eventDate);
    $eventDate = date_create($eventDate);
    $monthYear = DATE_FORMAT($eventDate, 'M Y');
    $eventTime = DATE_FORMAT($eventDate, 'H:i');

    $day = DATE_FORMAT($eventDate, 'D d');

    // var Image
    $eventImage = $eventDetail['img'];

    // var Location
    $eventLocation = $eventDetail['location'].', '.$eventDetail['name_city'];

    // var Organizer
    $eventOrganizer = $eventDetail['organizer'];

    // var Description
    $eventDescription = $eventDetail['desc_event'];

    //active status
    $eventActiveStatus = $eventDetail['active_event'];

    include 'functionDateTranslate.php';

  }else{
    http_response_code(404);
    header("HTTP/1.0 404 Not Found");
    die();
  }
}else if($idEvent = filter_input(INPUT_GET, 'linked', FILTER_VALIDATE_INT, 1)){

  $idEvent = intval($idEvent);
  $idEvent = mysqli_real_escape_string($conn, $idEvent);

  // var type event
  $typeEvent = 'linked';

  $queryEventDetail = mysqli_query($conn, "SELECT * FROM events_linked LEFT JOIN events_private ON events_linked.id_event_private = events_private.id_event
                                                                        LEFT JOIN cities ON events_private.id_city = cities.id_city
                                                                        WHERE events_linked.id_event='$idEvent'");
  $eventDetail = mysqli_fetch_array($queryEventDetail);
  $idEventPrivate = $eventDetail['id_event'];

  if(mysqli_num_rows($queryEventDetail) >= 1){

    // var name Event
    $nameEvent = $eventDetail['public_name_event'];

    // Query get Artist
    $queryEventArtists = mysqli_query($conn, "SELECT * FROM events_user LEFT JOIN users ON events_user.id_user = users.id_user WHERE id_event='$idEventPrivate'");
    $eventArtistsArray = array();
    while($eventArtists = mysqli_fetch_array($queryEventArtists)){
      $eventArtistsArray[] = $eventArtists;
    }

    // Total event value
    $totalValue = number_format($eventDetail['public_value'] , 0, ',', '.');
    // Format event value
    $eventDetail['public_value'] = number_format($eventDetail['public_value'] , 0, ',', '.');
    // Format event commission
    // $eventDetail['value_commission'] = number_format($eventDetail['value_commission'] , 0, ',', '.');

    if($eventDetail['public_value'] == '0'){
      $eventValue = "Entrada Liberada";
    }else {
      $eventValue = '$'.$totalValue;
    }

    // var name event
    $eventName = $eventDetail['public_name_event'];

    // create and format date time
    $eventDate = $eventDetail['date_event'];
    $eventDate = date($eventDate);
    $eventDate = date_create($eventDate);
    $monthYear = DATE_FORMAT($eventDate, 'M Y');
    $eventTime = $eventDetail['public_time_event'];
    $eventTime = date($eventTime);
    $eventTime = date_create($eventTime);
    $eventTime = DATE_FORMAT($eventTime, 'H:i');

    $day = DATE_FORMAT($eventDate, 'D d');

    // Check if user is subscribed
    $queryCheckSubscribe = mysqli_query($conn, "SELECT subscribes_public.id_user FROM subscribes_public LEFT JOIN  transactions_public ON subscribes_public.id_user = transactions_public.id_user WHERE subscribes_public.id_user='$userid' AND transactions_public.payment_status='paid' AND subscribes_public.id_event_public='$idEvent'");
    if(mysqli_num_rows($queryCheckSubscribe) > 0){
      $userSubscribed = true;
    }else{
      $userSubscribed = false;
    }
    // Check if session is subscribed
    $queryCheckSessionSubscribe = mysqli_query($conn, "SELECT id_user FROM subscribes_public WHERE id_user='$userid' AND id_event_public='$idEvent'");
    if(mysqli_num_rows($queryCheckSessionSubscribe) > 0){
      $userSubscribed = true;
    }else{
      $userSubscribed = false;
    }

    // var Image
    $eventImage = $eventDetail['img'];

    // var Location
    $eventLocation = $eventDetail['location'].', '.$eventDetail['name_city'];

    // var Organizer
    $eventOrganizer = $eventDetail['public_organizer'];

    // var Description
    $eventDescription = $eventDetail['public_desc_event'];

    //active status
    $eventActiveStatus = $eventDetail['active_event'];

    // Artists
    if(!empty($eventArtistsArray)){
      $eventArtist = "";
      foreach($eventArtistsArray as $eventArtists){
        $eventArtist .= '<a href="profile.php?userid='.$eventArtists['id_user'].'">'.$eventArtists['nick_user']." </a>  ";
      }
    }

    include 'functionDateTranslate.php';

  }else{
    http_response_code(404);
    header("HTTP/1.0 404 Not Found");
    die();
  }

}else if($idEvent = filter_input(INPUT_GET, 'streaming', FILTER_VALIDATE_INT, 1)){

  $idEvent = intval($idEvent);
  $idEvent = mysqli_real_escape_string($conn, $idEvent);

  // var type event
  $typeEvent = 'streaming';

  $queryEventDetail = mysqli_query($conn, "SELECT * FROM events_streaming WHERE id_event='$idEvent'");
  $eventDetail = mysqli_fetch_array($queryEventDetail);

  if(mysqli_num_rows($queryEventDetail) >= 1){

    // Check if user is subscribed
    $queryCheckSubscribe = mysqli_query($conn, "SELECT subscribes_streaming.id_user FROM subscribes_streaming LEFT JOIN  transactions_streaming ON subscribes_streaming.id_user = transactions_streaming.id_user WHERE subscribes_streaming.id_user='$userid' AND transactions_streaming.payment_status='paid' AND subscribes_streaming.id_event_streaming='$idEvent'");
    if(mysqli_num_rows($queryCheckSubscribe) > 0){
      $userSubscribed = true;
    }else{
      $userSubscribed = false;
    }
    // Check if session is subscribed
    $queryCheckSessionSubscribe = mysqli_query($conn, "SELECT id_user FROM subscribes_streaming WHERE id_user='$userid' AND id_event_streaming='$idEvent' AND subscribe_status='1'");
    if(mysqli_num_rows($queryCheckSessionSubscribe) > 0){
      $userSubscribed = true;
    }else{
      $userSubscribed = false;
    }

  // Check audience
  $totalAudience = $eventDetail['audience_event']+1;

  $queryAudience = mysqli_query($conn, "SELECT COUNT(*) FROM subscribes_streaming WHERE id_event_streaming='$idEvent' AND subscribe_status='1'");
  $countAudience = mysqli_fetch_assoc($queryAudience)['COUNT(*)'];

  // var name Event
  $eventName = $eventDetail['name_event'];

  // Total event value
  $totalValue = number_format($eventDetail['value']+$eventDetail['value_commission'] , 0, ',', '.');
  // Format event value
  $eventDetail['value'] = number_format($eventDetail['value'] , 0, ',', '.');
  // Format event commission
  $eventDetail['value_commission'] = number_format($eventDetail['value_commission'] , 0, ',', '.');

  if($eventDetail['value'] == '0'){
    $eventValue = "Entrada Liberada";
  }else {
    $eventValue = '$'.$totalValue;
  }

  // Create and Format date time
  $eventDate = $eventDetail['date_event'];
  $eventDate = date($eventDate);
  $eventDate = date_create($eventDate);
  $monthYear = DATE_FORMAT($eventDate, 'M Y');
  $eventTime = DATE_FORMAT($eventDate, 'H:i');

  $day = DATE_FORMAT($eventDate, 'D d');

  // var Image
  $eventImage = $eventDetail['img'];

  // var Location
  $eventLocation = "Streaming";

  // var Organizer
  $eventOrganizer = "";

  // var Description
  $eventDescription = $eventDetail['desc_event'];

  //active status
  $eventActiveStatus = $eventDetail['active_event'];

  include 'functionDateTranslate.php';


  }else{
    http_response_code(404);
    header("HTTP/1.0 404 Not Found");
    die();
  }

}else{
  http_response_code(404);
  header("HTTP/1.0 404 Not Found");
  die();
}

?>
