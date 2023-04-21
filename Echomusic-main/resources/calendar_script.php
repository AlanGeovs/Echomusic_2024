<?php
include 'connect.php';

// Get regions
// Query Regions
$queryRegions = mysqli_query($conn, "SELECT * FROM regions");
$regionsArray = array();

while($regions = mysqli_fetch_array($queryRegions)){
	$regionsArray[] = $regions;
}

// Get today date

$today = date('Y-m-d', time());
$todayDate = date_create($today);
$monthYear = date('M Y', time());
$todayStart = $today.' 00:00:00';


if(isset($_GET['nameEvent'])){

	// Check page number
	if (isset($_GET['page_no']) && $_GET['page_no']!="") {
			$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
	}

	$searchTerms = trim($_GET['nameEvent']);
  $searchTerms = strip_tags($searchTerms);
  $searchTerms = htmlspecialchars($searchTerms);
  $searchTerms = mysqli_real_escape_string($conn, $searchTerms);

	$searchRegion = trim($_GET['region']);
  $searchRegion = strip_tags($searchRegion);
  $searchRegion = htmlspecialchars($searchRegion);
  $searchRegion = mysqli_real_escape_string($conn, $searchRegion);

	$searchDate = trim($_GET['date']);
  $searchDate = strip_tags($searchDate);
  $searchDate = htmlspecialchars($searchDate);
  $searchDate = mysqli_real_escape_string($conn, $searchDate);

	include 'functionValidateDate.php';

	if($searchDate==''){

	}else if(validateDate($searchDate)==false){
		 $error = true;
		 $searchDateError = "Fecha inválida";
	 }

	 if(empty($searchDate)){
		 $dateStart = date('Y-m-d', time()).' 00:00:00';
		 $dateEnd = date('Y-m-d', strtotime("+1 year")).' 23:59:59';
	 }else{
		 $searchDate = date_create($searchDate);
		 $searchDate = DATE_FORMAT($searchDate, 'Y-m-d');
		 $dateStart = $searchDate.' 00:00:00';
		 $dateEnd = $searchDate.' 23:59:59';
 	}

	 if($searchRegion==''){

	 }else if(!FILTER_VAR($searchRegion, FILTER_VALIDATE_INT, 1)){
      $error = true;
      $searchRegionError = "La información no es válida.";
  	}

	//Check Length

	  $min_length = 1;
	  $max_length = 50;

		if(strlen($searchTerms) <= $min_length){
	    $error = true;
	  }else if(strlen($searchTerms >= $max_length)){
	    $error = true;
	  }

	  $keys = explode(" ",$searchTerms);

		// Filters
			$filters = array();
			$filters2 = array();

			if(!empty($searchRegion)){
				$filters[] = "id_region='$searchRegion'";
				$filters2[] = "id_region='$searchRegion'";
			}
			if(!empty($searchTerms)){
				$filters[] = "name_event LIKE '%".$searchTerms."%'";
				$filters[] = "name_location LIKE '%".$searchTerms."%'";
				$filters[] = "organizer LIKE '%".$searchTerms."%'";
				$filters2[] = "public_name_event LIKE '%".$searchTerms."%'";
			}

			// Loop through the parameters
			$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
			$host = $_SERVER['HTTP_HOST'];
			$script = $_SERVER['SCRIPT_NAME'];
			$link = $protocol . '://' . $host . $script;
			$i = 1;
			 foreach ($_GET as $parameter => $value) {
				 $value = trim($value);
			   $value = strip_tags($value);
			   $value = htmlspecialchars($value);
			   $value = mysqli_real_escape_string($conn, $value);
				 // Append the parameter and its value to the new path
				 if($i == 1){
				 	$link .= "?" . $parameter . "=" . urlencode($value);
					$link = preg_replace('/&page_no=[0-9]+/', '', $link);
			 	}else{
					$link .= "&" . $parameter . "=" . urlencode($value);
					$link = preg_replace('/&page_no=[0-9]+/', '', $link);
				}
				 $i++;
			 }
			 unset($i);

		 // pagination
		 	$total_records_per_page = 12;

		 	$offset = ($page_no-1) * $total_records_per_page;
		 	$previous_page = $page_no - 1;
		 	$next_page = $page_no + 1;
		 	$adjacents = "2";

			$queryCountEvents = "SELECT id_event, id_type_event, date_event, name_event FROM events_public WHERE (date_event BETWEEN '$dateStart' AND '$dateEnd') AND (id_plan='1') AND active_event='1'";

			if(count($filters)>0){
				$queryCountEvents .= " AND ". "(". implode(" OR ", $filters);
				$queryCountEvents .= ")";
			}
			if(empty($searchRegion)){
				$queryCountEvents .= " UNION SELECT id_event, id_type_event, date_event, name_event FROM events_streaming WHERE (date_event BETWEEN '$dateStart' AND '$dateEnd') AND (id_plan='1') AND active_event='1'";

				if(!empty($searchTerms)){
					$queryCountEvents .= " AND name_event LIKE '%".$searchTerms."%'";
				}
			}

			$queryCountEvents .= " UNION SELECT events_linked.id_event, events_linked.id_type_event, public_date_event AS date_event, public_name_event AS name_event FROM events_linked LEFT JOIN events_private ON events_linked.id_event=events_private.id_event WHERE (public_date_event BETWEEN '$dateStart' AND '$dateEnd') AND (id_public_plan='1') AND active_event='1'";

			if(count($filters2)>0){
				$queryCountEvents .= " AND ". implode(" AND ", $filters2);
			}

			$countEvents = mysqli_query($conn, $queryCountEvents);
			$total_records = mysqli_num_rows($countEvents);

			if($total_records>0){

			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1;

			// Page Links
			$link .= '&';
			$hrefNext_page = $link . 'page_no=' . $next_page;
			$hrefPrevious_page = $link . 'page_no=' . $previous_page;
			$hrefFirst_page = $link . 'page_no=1';
			$hrefLast_page = $link . 'page_no=' . $total_no_of_pages;

			$queryTotalEvents = "SELECT id_event, id_type_event, date_event, name_event FROM events_public WHERE (date_event BETWEEN '$dateStart' AND '$dateEnd') AND (id_plan='1') AND active_event='1'";

			if(count($filters)>0){
				$queryTotalEvents .= " AND ". "(".implode(" OR ", $filters);
				$queryTotalEvents .= ")";
			}
			if(empty($searchRegion)){
				$queryTotalEvents .= " UNION SELECT id_event, id_type_event, date_event, name_event FROM events_streaming WHERE (date_event BETWEEN '$dateStart' AND '$dateEnd') AND (id_plan='1') AND active_event='1'";

				if(!empty($searchTerms)){
					$queryTotalEvents .= " AND name_event LIKE '%".$searchTerms."%'";
				}
			}

			$queryTotalEvents .= " UNION SELECT events_linked.id_event, events_linked.id_type_event, public_date_event AS date_event, public_name_event AS name_event FROM events_linked LEFT JOIN events_private ON events_linked.id_event=events_private.id_event WHERE (public_date_event BETWEEN '$dateStart' AND '$dateEnd') AND (id_public_plan='1') AND active_event='1'";

			if(count($filters2)>0){
				$queryTotalEvents .= " AND ". implode(" AND ", $filters2);
			}

			$queryTotalEvents .= " ORDER BY date_event ASC";

			$queryTotalEvents .= " LIMIT $offset, $total_records_per_page";

			$totalEvents = mysqli_query($conn, $queryTotalEvents);

			$conditionPublic = array(-1);
		  $conditionLinked = array(-1);
		  $conditionStreaming = array(-1);
		  while($array = mysqli_fetch_assoc($totalEvents)){
		    switch($array['id_type_event']){
		      case '2':
		        $conditionPublic[] = $array['id_event'];
		      break;
		      case '3':
		        $conditionLinked[] = $array['id_event'];
		      break;
		      case '4':
		        $conditionStreaming[] = $array['id_event'];
		      break;
		    }
		  }

		  $conditionPublic = implode(",",$conditionPublic);
		  $conditionLinked = implode(",",$conditionLinked);
		  $conditionStreaming = implode(",",$conditionStreaming);

			// Queries events Basic
		  $queryEventsPublicTodayBasic = mysqli_query($conn, "SELECT * FROM events_public LEFT JOIN type_events ON events_public.id_type_event = type_events.id_type_event LEFT JOIN cities ON events_public.id_city = cities.id_city WHERE id_event IN ($conditionPublic)");
		  $queryEventsLinkedTodayBasic = mysqli_query($conn, "SELECT * FROM events_linked LEFT JOIN type_events ON events_linked.id_type_event = type_events.id_type_event LEFT JOIN events_private ON events_linked.id_event_private = events_private.id_event LEFT JOIN cities ON events_private.id_city = cities.id_city WHERE events_linked.id_event IN ($conditionLinked)");
		  $queryEventsStreamingTodayBasic = mysqli_query($conn, "SELECT * FROM events_streaming LEFT JOIN type_events ON events_streaming.id_type_event = type_events.id_type_event WHERE id_event in ($conditionStreaming)");

		  // Array events Basic and Merge
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

		  // Sort events array by date
		    usort($eventsTodayBasicArray, function($a, $b) {
		      $ad = new DateTime($a['date_event']);
		      $bd = new DateTime($b['date_event']);

		      if ($ad == $bd) {
		        return 0;
		      }

		      return $ad < $bd ? -1 : 1;
		    });

		}else {
			$checkNoEvents = true;
		}



}else{

	// Loop through the parameters
	$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
	$host = $_SERVER['HTTP_HOST'];
	$script = $_SERVER['SCRIPT_NAME'];
	$link = $protocol . '://' . $host . $script;

	// Check page number
	if (isset($_GET['page_no']) && $_GET['page_no']!="") {
			$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
	}

	$total_records_per_page = 12;

	$offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2";


	// Query to count total events
	$queryCountEvents = mysqli_query($conn, "SELECT id_event, id_type_event, date_event FROM events_public WHERE (date_event >= '$todayStart') AND (id_plan='1') AND active_event='1' UNION SELECT id_event, id_type_event, date_event FROM events_streaming WHERE (date_event >= '$todayStart') AND (id_plan='1') AND active_event='1' UNION SELECT id_event, id_type_event, public_date_event AS date_event FROM events_linked WHERE (public_date_event >= '$todayStart') AND (id_public_plan='1') AND active_event='1'");


	$total_records = mysqli_num_rows($queryCountEvents);

	if($total_records>0){

	$total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1;

	// Pages Links
	$link .= '?';
	$hrefNext_page = $link . 'page_no=' . $next_page;
	$hrefPrevious_page = $link . 'page_no=' . $previous_page;
	$hrefFirst_page = $link . 'page_no=1';
	$hrefLast_page = $link . 'page_no=' . $total_no_of_pages;


	//Query get all events on first page
	$queryTotalEvents = "SELECT id_event, id_type_event, date_event FROM events_public WHERE (date_event >= '$todayStart') AND (id_plan='1') AND active_event='1'
	                      UNION SELECT id_event, id_type_event, date_event FROM events_streaming WHERE (date_event >= '$todayStart') AND (id_plan='1') AND active_event='1'
	                      UNION SELECT id_event, id_type_event, public_date_event AS date_event FROM events_linked
	                      WHERE (public_date_event >= '$todayStart') AND (id_public_plan='1') AND active_event='1' ORDER BY date_event ASC";

	$queryTotalEvents .= " LIMIT $offset, $total_records_per_page";

	$totalEvents = mysqli_query($conn, $queryTotalEvents);

	  $conditionPublic = array(-1);
	  $conditionLinked = array(-1);
	  $conditionStreaming = array(-1);
	  while($array = mysqli_fetch_assoc($totalEvents)){
	    switch($array['id_type_event']){
	      case '2':
	        $conditionPublic[] = $array['id_event'];
	      break;
	      case '3':
	        $conditionLinked[] = $array['id_event'];
	      break;
	      case '4':
	        $conditionStreaming[] = $array['id_event'];
	      break;
	    }
	  }

	  $conditionPublic = implode(",",$conditionPublic);
	  $conditionLinked = implode(",",$conditionLinked);
	  $conditionStreaming = implode(",",$conditionStreaming);


	  // Queries events Basic
	  $queryEventsPublicTodayBasic = mysqli_query($conn, "SELECT * FROM events_public LEFT JOIN type_events ON events_public.id_type_event = type_events.id_type_event LEFT JOIN cities ON events_public.id_city = cities.id_city WHERE id_event IN ($conditionPublic)");
	  $queryEventsLinkedTodayBasic = mysqli_query($conn, "SELECT * FROM events_linked LEFT JOIN type_events ON events_linked.id_type_event = type_events.id_type_event LEFT JOIN events_private ON events_linked.id_event_private = events_private.id_event LEFT JOIN cities ON events_private.id_city = cities.id_city WHERE events_linked.id_event IN ($conditionLinked)");
	  $queryEventsStreamingTodayBasic = mysqli_query($conn, "SELECT * FROM events_streaming LEFT JOIN type_events ON events_streaming.id_type_event = type_events.id_type_event WHERE id_event in ($conditionStreaming)");

	  // Array events Basic and Merge
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

	  // Sort events array by date
	    usort($eventsTodayBasicArray, function($a, $b) {
	      $ad = new DateTime($a['date_event']);
	      $bd = new DateTime($b['date_event']);

	      if ($ad == $bd) {
	        return 0;
	      }

	      return $ad < $bd ? -1 : 1;
	    });

	}else{
	  $checkNoEvents = true;
	}

}


 include 'functionDateTranslate.php';
?>
