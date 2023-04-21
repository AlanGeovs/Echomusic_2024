<?php
include 'connect.php';
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
if(isset($_POST['date']) && !empty($_POST['date'])) {
  $date = $_POST['date'];
  $date = date_create($date);
  $date = DATE_FORMAT($date, 'Y-m-d');
  $dateStart = $date.' 00:00:00';
  $dateEnd = $date.' 23:59:59';
  // Query events and Stuff
  if(isset($_SESSION['user'])){
    $userid = $_SESSION['user'];
    $queryFollows = mysqli_query($conn, "SELECT * FROM events_private LEFT JOIN events_user ON events_private.id_event = events_user.id_event
                                                               LEFT JOIN follow_users ON events_user.id_user = follow_users.id_artist WHERE (events_private.date_event BETWEEN '$dateStart' AND '$dateEnd') AND (follow_users.id_user='$userid')");

    if(!empty($queryFollows)){
      $eventsFollowsArray = array();
      while($eventsFollow = mysqli_fetch_array($queryFollows)){
        $eventsFollowsArray [] = $eventsFollow;
      }

      // Display Events Follow
      foreach($eventsFollowsArray as $eventsFollow){
        echo '<article class="col-12 col-12-small">';
        echo '<div class="calendar-event-follow">';
        echo '<a class="image" href="event.php?eventid='.$eventsFollow['id_event'].'">';
        echo '<img src="images/events/'.$eventsFollow['public_img'].'.jpg"/>';
        echo '</a>';
        echo '</div>';
        echo '</article>';
      }
    }
}
}
?>
