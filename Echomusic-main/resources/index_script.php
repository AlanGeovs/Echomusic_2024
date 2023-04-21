<?php

include 'connect.php';

include 'functionDateTranslate.php';

// $artistCounterQuery = mysqli_query($conn, "SELECT COUNT(id_user) AS artistCount FROM users WHERE id_type_user='1'");

// $artistCounterArray = mysqli_fetch_array($artistCounterQuery);



// Query for artists pane

// $artistPaneQuery = mysqli_query($conn, "SELECT * FROM users LEFT JOIN desc_user ON desc_user.id_user = users.id_user
//                                                             LEFT JOIN regions ON users.id_region = regions.id_region
//                                                             LEFT JOIN genre_user ON users.id_user = genre_user.id_user
//                                                             LEFT JOIN genres ON genres.id_genre = genre_user.id_genre WHERE users.id_type_user='1' AND users.first_login='no' ORDER BY users.id_user ASC LIMIT 6");

$artistPaneQuery = mysqli_query($conn, "SELECT * FROM users LEFT JOIN desc_user ON desc_user.id_user = users.id_user
                                                            LEFT JOIN regions ON users.id_region = regions.id_region
                                                            LEFT JOIN genre_user ON users.id_user = genre_user.id_user
                                                            LEFT JOIN genres ON genres.id_genre = genre_user.id_genre WHERE users.id_type_user='1' AND users.first_login='no' AND users.id_user<>'5' ORDER BY users.id_user DESC LIMIT 6");

$artistsArray = array();



while($artists = mysqli_fetch_array($artistPaneQuery)){

  $artistsArray[] = $artists;

}



// Query for events pane

$eventsPaneQuery = mysqli_query($conn, "SELECT * FROM events_public WHERE active_event=1 ORDER BY date_event ASC LIMIT 6");

$eventsArray = array();



while($events = mysqli_fetch_array($eventsPaneQuery)){

  $eventsArray[] = $events;

}

$today = date('Y-m-d', time());

// Query for calendar First month

$calendarPane1mQuery = mysqli_query($conn, "SELECT id_event, id_type_event, date_event, name_event, img, cities.id_city, cities.name_city FROM events_public LEFT JOIN cities ON events_public.id_city = cities.id_city WHERE active_event=1 AND date_event >= '$today' UNION SELECT id_event, id_type_event, date_event, name_event, img, NULL as id_city, NULL as name_city FROM events_streaming WHERE active_event=1 AND date_event >= '$today' ORDER BY date_event ASC LIMIT 6");


$calendar1mArray = array();

while($calendar1m = mysqli_fetch_array($calendarPane1mQuery)){

  $calendar1mArray[] = $calendar1m;

}

// Query for crowdfunding pane
  $queryProjects = mysqli_query($conn, "SELECT projects_crowdfunding.id_project, projects_crowdfunding.project_title, categories_projects.name_category, users.nick_user FROM projects_crowdfunding LEFT JOIN users ON users.id_user = projects_crowdfunding.id_user
																											LEFT JOIN project_categories ON projects_crowdfunding.id_project = project_categories.id_project
																											LEFT JOIN regions ON projects_crowdfunding.project_region = regions.id_region
																											LEFT JOIN categories_projects ON project_categories.id_category = categories_projects.id_category
	            										                    WHERE projects_crowdfunding.status_project>'0' AND projects_crowdfunding.status_project<='2' AND projects_crowdfunding.project_date_end>='$today'");

$projectsArray = array();

while($projects = mysqli_fetch_array($queryProjects)){

  $projectsArray[] = $projects;

}
 ?>
