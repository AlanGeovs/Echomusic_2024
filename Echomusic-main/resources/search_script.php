<?php

include 'connect.php';
// Query Genres
$queryGenres = mysqli_query($conn, "SELECT * FROM genres");
$genresArray = array();

while($genres = mysqli_fetch_array($queryGenres)){
	$genresArray[] = $genres;
}

//Get subGenres
$querySubGenres = mysqli_query($conn, "SELECT * FROM sub_genres LEFT JOIN genres_subs ON sub_genres.id_subGenre = genres_subs.id_subGenre WHERE genres_subs.id_genre='$user_idGenre'");
$arraySubGenres = array();
while($subGenres = mysqli_fetch_array($querySubGenres)){
	$arraySubGenres[] = $subGenres;
}

// Query Regions
$queryRegions = mysqli_query($conn, "SELECT * FROM regions");
$regionsArray = array();

while($regions = mysqli_fetch_array($queryRegions)){
	$regionsArray[] = $regions;
}

// Query Type musician
$queryTypeMusician = mysqli_query($conn, "SELECT * FROM type_musician");
$typeMusicianArray = array();

while($typeMusician = mysqli_fetch_array($queryTypeMusician)){
	$typeMusicianArray[] = $typeMusician;
}

// Check page number
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
		$page_no = $_GET['page_no'];
} else {
	$page_no = 1;
}

// Search
//Get terms
if(isset($_GET['search'])){
	// SANITIZAR
	$searchTerms = trim($_GET['search']);
  $searchTerms = strip_tags($searchTerms);
  $searchTerms = htmlspecialchars($searchTerms);
  $searchTerms = mysqli_real_escape_string($conn, $searchTerms);

	$searchGenre = trim($_GET['genre']);
  $searchGenre = strip_tags($searchGenre);
  $searchGenre = htmlspecialchars($searchGenre);
  $searchGenre = mysqli_real_escape_string($conn, $searchGenre);

	$searchSubGenre = trim($_GET['subgenres']);
  $searchSubGenre = strip_tags($searchSubGenre);
  $searchSubGenre = htmlspecialchars($searchSubGenre);
  $searchSubGenre = mysqli_real_escape_string($conn, $searchSubGenre);

	$searchMusician = trim($_GET['artist']);
  $searchMusician = strip_tags($searchMusician);
  $searchMusician = htmlspecialchars($searchMusician);
  $searchMusician = mysqli_real_escape_string($conn, $searchMusician);

	$searchRegion = trim($_GET['region']);
  $searchRegion = strip_tags($searchRegion);
  $searchRegion = htmlspecialchars($searchRegion);
  $searchRegion = mysqli_real_escape_string($conn, $searchRegion);


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

	if(!empty($searchMusician)){
		$filters[] = "users.id_musician='$searchMusician'";
	}
	if(!empty($searchRegion)){
		$filters[] = "users.id_region='$searchRegion'";
	}
	if(!empty($searchGenre)){
		$filters[] = "genre_user.id_genre='$searchGenre'";
	}
	if(!empty($searchSubGenre)){
		$filters[] = "subGenres_user.id_subGenre='$searchSubGenre'";
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

	$queryCountSearch = "SELECT * FROM users LEFT JOIN desc_user ON users.id_user = desc_user.id_user
																			LEFT JOIN type_musician ON users.id_musician = type_musician.id_musician
																			LEFT JOIN regions ON users.id_region = regions.id_region
																			LEFT JOIN cities ON users.id_city = cities.id_city
																			LEFT JOIN genre_user ON users.id_user = genre_user.id_user
																		 	LEFT JOIN subGenres_user ON users.id_user = subGenres_user.id_user
		              										WHERE nick_user LIKE '%".$searchTerms."%' AND id_type_user='1' AND first_login='no'";


	if(count($filters)>0){
		$queryCountSearch .= " AND ". implode(" AND ", $filters);
	}
	$queryCountSearch .= " GROUP BY users.id_user";

	$result_count = mysqli_query($conn, $queryCountSearch);
	// $total_records = mysqli_fetch_array($result_count);
	$total_records = mysqli_num_rows($result_count);
	// $total_records = $total_records['total_records'];
	$total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total pages minus 1
	// Page Links
	$link .= '&';
	$hrefNext_page = $link . 'page_no=' . $next_page;
	$hrefPrevious_page = $link . 'page_no=' . $previous_page;
	$hrefFirst_page = $link . 'page_no=1';
	$hrefLast_page = $link . 'page_no=' . $total_no_of_pages;

// Query Search
	$querySearch = "SELECT * FROM users LEFT JOIN desc_user ON users.id_user = desc_user.id_user
																			LEFT JOIN type_musician ON users.id_musician = type_musician.id_musician
																			LEFT JOIN regions ON users.id_region = regions.id_region
																			LEFT JOIN cities ON users.id_city = cities.id_city
																			LEFT JOIN genre_user ON users.id_user = genre_user.id_user
																			LEFT JOIN genres ON genre_user.id_genre = genres.id_genre
																			LEFT JOIN subGenres_user ON users.id_user = subGenres_user.id_user
																			LEFT JOIN sub_genres ON sub_genres.id_subGenre = subGenres_user.id_subGenre
		              										WHERE nick_user LIKE '%".$searchTerms."%' AND id_type_user='1' AND first_login='no'";

									foreach($keys as $k){
										 // $queryByNick .= " OR nick_user LIKE '%$k%' ";
									}

	if(count($filters)>0){
		$querySearch .= " AND ". implode(" AND ", $filters);
	}

$querySearch .= " GROUP BY users.id_user";

$querySearch .= " ORDER BY users.id_user DESC";

$querySearch .= " LIMIT $offset, $total_records_per_page";

	$raw_results = mysqli_query($conn, $querySearch);
	$raw_results_count = mysqli_num_rows($raw_results);

		if( $raw_results_count > 0){
			$resultsArray = array();
			while($results = mysqli_fetch_array($raw_results)){
				$resultsArray[] = $results;
			}
		}
	  else{ // if there is no matching rows do following
			$errTyp = "Danger";
			$errMSG = "No hay resultados";
		}
}

function displayArtists($resultsArray){
	include 'connect.php';


	foreach($resultsArray as $results){

				$userid = $results['id_user'];
				$queryFollowers = mysqli_query($conn, "SELECT * FROM follow_users WHERE id_artist='$userid'");
				$countFollowers = mysqli_num_rows($queryFollowers);

				$queryRatings = mysqli_query($conn, "SELECT number_rating FROM user_ratings LEFT JOIN users ON user_ratings.id_user = users.id_user WHERE id_artist='$userid' AND status_rating='closed' ORDER BY date_rating DESC");
				$rateArray = array();
				while($ratingArray = mysqli_fetch_array($queryRatings)){
				  $rateArray[] = $ratingArray;
				}

					$y = 0;
					$count=0;
				  if(mysqli_num_rows($queryRatings)>0){
						foreach($rateArray as $values){
							$count += 1;
							$z = $values['number_rating'];
							$y = $y + $z;
						}
						$totalRating = $y / $count;
						$totalRating = round($totalRating, 1);
						if(is_nan($totalRating)){
							$totalRating = "0";
						}
					}else{
						$totalRating = "0";
					}

					// echo '<article>';
					// echo '<a onClick="clearProfileCookie()" href="profile.php?userid='.$results['id_user'].'" class="image">';
					// if(file_exists('images/avatars/'.$results['id_user'] .'.jpg')){
					// echo '<img src="images/avatars/'.$results['id_user'] .'.jpg" alt="">';
					// }
					// else{
					// echo	'<img src="images/avatars/profile_default.jpg" alt="">';
					// }
					// echo '</a>';
					// echo '<a onClick="clearProfileCookie()" href="profile.php?userid='.$results['id_user'].'"><h3 class="major">'.$results['nick_user'].'</h3></a>';
					// echo '<p class="">'.$results['name_genre'].'</br>';
					// echo $results['name_region'].'</p>';
					// echo '<h4 class="major">'.$countFollowers.' Seguidores '.$totalRating.'★</h4>';
					// // echo '<a href="profile.php?userid='.$results['id_user'].'" class="special">Ver Perfil</a>';
					// echo '</article>';

					// Artist card display
						echo '<div class="col">';

							  echo '<div class="card">';

								if(file_exists('images/avatars/'.$results['id_user'] .'.jpg')){

							    echo '<a href="profile.php?userid='.$results['id_user'].'"><img src="images/avatars/'.$results['id_user'].'.jpg?='.filemtime('images/avatars/'.$results['id_user'].'.jpg').'" class="card-img-top" alt="..."></a>';
								}else{
									echo '<a href="profile.php?userid='.$results['id_user'].'"><img src="images/avatars/profile_default.jpg" class="card-img-top" alt="..."></a>';
								}
							    echo '<div class="card-body">';

							      echo '<a class="" href="profile.php?userid='.$results['id_user'].'"><h5 class="card-title">'.$results['nick_user'].'</h5></a>';

							      echo '<p class="card-text"><i class="fas fa-music"></i> '.$results['name_genre'].'</p>';

							      echo '<p class="card-text"><i class="fas fa-map-marker-alt"></i> '.$results['name_region'].'</p>';

							    echo '</div>';

							  echo '</div>';

						  echo '</div>';

	}
}
?>
