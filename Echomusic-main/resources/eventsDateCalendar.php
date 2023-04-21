<?php
include 'connect.php';
if(isset($_POST['date']) && !empty($_POST['date'])) {
  $date = $_POST['date'];
  $date = date_create($date);
  $date = DATE_FORMAT($date, 'Y-m-d');
  $dateStart = $date.' 00:00:00';
  $dateEnd = $date.' 23:59:59';

  // Query events Basic
  $queryEventsPublicTodayBasic = mysqli_query($conn, "SELECT * FROM events_public WHERE (date_event BETWEEN '$dateStart' AND '$dateEnd') AND (id_plan='1')");
  $queryEventsLinkedTodayBasic = mysqli_query($conn, "SELECT * FROM events_linked LEFT JOIN events_private ON events_linked.id_event_private = events_private.id_event WHERE (events_private.date_event BETWEEN '$dateStart' AND '$dateEnd') AND (events_linked.id_public_plan='1')");
  $queryEventsStreamingTodayBasic = mysqli_query($conn, "SELECT * FROM events_streaming WHERE (date_event BETWEEN '$dateStart' AND '$dateEnd') AND (id_plan='1')");

  // Query events standard
  $queryEventsPublicTodayStandard = mysqli_query($conn, "SELECT * FROM events_public WHERE (date_event BETWEEN '$dateStart' AND '$dateEnd') AND (id_plan='2')");
  $queryEventsLinkedTodayStandard = mysqli_query($conn, "SELECT * FROM events_linked LEFT JOIN events_private ON events_linked.id_event_private = events_private.id_event WHERE (events_private.date_event BETWEEN '$todayStart' AND '$todayEnd') AND (events_linked.id_public_plan='2')");
  $queryEventsStreamingTodayStandard = mysqli_query($conn, "SELECT * FROM events_streaming WHERE (date_event BETWEEN '$dateStart' AND '$dateEnd') AND (id_plan='2')");

  // Array events basic and merge
  $eventsPublicTodayBasicArray = array();
  while($eventsPublicTodayBasic = mysqli_fetch_array($queryEventsPublicTodayBasic)){
    $eventsPublicTodayBasicArray[] = $eventsPublicTodayBasic;
  }
  $eventsLinkedTodayBasicArray = array();
  while($eventsLinkedTodayBasic = mysqli_fetch_array($queryEventsLinkedTodayBasic)){
    $eventsLinkedTodayBasicArray[] = $eventsLinkedTodayBasic;
  }
  $eventsStreamingTodayBasicArray = array();
  while($eventsStreamingTodayBasic = mysqli_fetch_array($queryEventsStreamingTodayBasic)){
    $eventsStreamingTodayBasicArray[] = $eventsStreamingTodayBasic;
  }

  $eventsTodayBasicArray = array_merge($eventsPublicTodayBasicArray, $eventsLinkedTodayBasicArray, $eventsStreamingTodayBasicArray);

  // Array events Standard and Merge
  $eventsPublicTodayStandardArray = array();
  while($eventsPublicTodayStandard = mysqli_fetch_array($queryEventsPublicTodayStandard)){
    $eventsPublicTodayStandardArray[] = $eventsPublicTodayStandard;
  }
  $eventsLinkedTodayStandardArray = array();
  while($eventsLinkedTodayStandard = mysqli_fetch_array($queryEventsLinkedTodayStandard)){
    $eventsLinkedTodayStandardArray[] = $eventsLinkedTodayStandard;
  }
  $eventsStreamingTodayStandardArray = array();
  while($eventsStreamingTodayStandard = mysqli_fetch_array($queryEventsStreamingTodayStandard)){
    $eventsStreamingTodayStandardArray[] = $eventsStreamingTodayStandard;
  }

  $eventsTodayStandardArray = array_merge($eventsPublicTodayStandardArray, $eventsLinkedTodayStandardArray, $eventsStreamingTodayStandardArray);

  // Display Today Events
    foreach($eventsTodayStandardArray as $eventsTodayStandard){
      switch($eventsTodayStandard['id_type_event']){
        case '2':
          echo '<article class="col-12 col-12-small">';
          echo '<div class="calendar-event-standard">';
          echo '<a class="image" href="event.php?public='.$eventsTodayStandard['id_event'].'">';
          echo '<img src="images/events/'.$eventsTodayStandard['img'].'.jpg"/>';
          echo '</a>';
          echo '<div class="text-block-calendar">';
          echo '<a href=""><strong>'.$eventsTodayStandard['name_event'].'</strong></a>';
          echo '</div>';
          echo '<div class="title-calendar-event-standard">';
          echo '</div>';
          echo '</div>';
          echo '</article>';
        break;
        case '3':
          echo '<article class="col-12 col-12-small">';
          echo '<div class="calendar-event-standard">';
          echo '<a class="image" href="event.php?linked='.$eventsTodayStandard['id_event'].'">';
          echo '<img src="images/events/'.$eventsTodayStandard['img'].'.jpg"/>';
          echo '</a>';
          echo '<div class="text-block-calendar">';
          echo '<a href=""><strong>'.$eventsTodayStandard['public_name_event'].'</strong></a>';
          echo '</div>';
          echo '<div class="title-calendar-event-standard">';
          echo '</div>';
          echo '</div>';
          echo '</article>';
        break;
        case '4':
          echo '<article class="col-12 col-12-small">';
          echo '<div class="calendar-event-standard">';
          echo '<a class="image" href="event.php?streaming='.$eventsTodayStandard['id_event'].'">';
          echo '<img src="images/events/'.$eventsTodayStandard['img'].'.jpg"/>';
          echo '</a>';
          echo '<div class="text-block-calendar">';
          echo '<a href=""><strong>'.$eventsTodayStandard['name_event'].'</strong></a>';
          echo '</div>';
          echo '<div class="title-calendar-event-standard">';
          echo '</div>';
          echo '</div>';
          echo '</article>';
        break;
      }
    }

    foreach($eventsTodayBasicArray as $eventsTodayBasic){

      switch($eventsTodayBasic['id_type_event']){
        case '2':
          echo '<article class="calendar-event-basic col-12 col-12-small">';
          echo '<a class="image left avatar" href="event.php?public='.$eventsTodayBasic['id_event'].'">';
          echo '<img src="images/events/'.$eventsTodayBasic['img'].'.jpg"/>';
          echo '</a>';
          echo '<strong>'.$eventsTodayBasic['name_event'].'</strong>';
          echo '<div class="block-with-text">';
          echo '<p>'.$eventsTodayBasic['desc_event'].'</p>';
          echo '</div>';
          echo '</article>';
        break;
        case '3':
          echo '<article class="calendar-event-basic col-12 col-12-small">';
          echo '<a class="image left avatar" href="event.php?linked='.$eventsTodayBasic['id_event'].'">';
          echo '<img src="images/events/'.$eventsTodayBasic['img'].'.jpg"/>';
          echo '</a>';
          echo '<strong>'.$eventsTodayBasic['public_name_event'].'</strong>';
          echo '<div class="block-with-text">';
          echo '<p>'.$eventsTodayBasic['public_desc_event'].'</p>';
          echo '</div>';
          echo '</article>';
        break;
        case '4':
          echo '<article class="calendar-event-basic col-12 col-12-small">';
          echo '<a class="image left avatar" href="event.php?streaming='.$eventsTodayBasic['id_event'].'">';
          echo '<img src="images/events/'.$eventsTodayBasic['img'].'.jpg"/>';
          echo '</a>';
          echo '<strong>'.$eventsTodayBasic['name_event'].'</strong>';
          echo '<div class="block-with-text">';
          echo '<p>'.$eventsTodayBasic['desc_event'].'</p>';
          echo '</div>';
          echo '</article>';
        break;
      }
    }

}
?>
