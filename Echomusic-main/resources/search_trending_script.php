<?php

include 'connect.php';
// Query Genres
$queryGenres = mysqli_query($conn, "SELECT * FROM genres");
$genresArray = array();

while($genres = mysqli_fetch_array($queryGenres)){
	$genresArray[] = $genres;
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

if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
	$queryFollowGenres = mysqli_query($conn, "SELECT id_genre FROM follow_genres WHERE id_user='$user'");
	$followGenresArray = array();
	while($followGenres = mysqli_fetch_array($queryFollowGenres)){
		$followGenresArray[] = $followGenres;
	}
	$genre1 = $followGenresArray[0][0];
	$genre2 = $followGenresArray[1][0];
	$genre3 = $followGenresArray[2][0];
	$genre4 = $followGenresArray[3][0];
	$genre5 = $followGenresArray[4][0];
}
	//
	// // Loop through the parameters
	// $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
	// $host = $_SERVER['HTTP_HOST'];
	// $script = $_SERVER['SCRIPT_NAME'];
	// $link = $protocol . '://' . $host . $script;
	// $i = 1;
	//  foreach ($_GET as $parameter => $value) {
	// 	 $value = trim($value);
	// 	 $value = strip_tags($value);
	// 	 $value = htmlspecialchars($value);
	// 	 $value = mysqli_real_escape_string($conn, $value);
	// 	 // Append the parameter and its value to the new path
	// 	 if($i == 1){
	// 		$link .= "?" . $parameter . "=" . urlencode($value);
	// 		$link = preg_replace('/?page_no=[0-9]+/', '', $link);
	// 	}else{
	// 		$link .= "&" . $parameter . "=" . urlencode($value);
	// 		$link = preg_replace('/?page_no=[0-9]+/', '', $link);
	// 	}
	// 	 $i++;
	//  }
	//  unset($i);

// pagination
	 $total_records_per_page = 12;

	 $offset = ($page_no-1) * $total_records_per_page;
	 $previous_page = $page_no - 1;
	 $next_page = $page_no + 1;
	 $adjacents = "2";

	$queryCountArtists = "SELECT COUNT(*) As total_records FROM users LEFT JOIN genre_user ON genre_user.id_user = users.id_user
																																LEFT JOIN regions ON users.id_region = regions.id_region
																																LEFT JOIN cities ON users.id_city = cities.id_city WHERE id_type_user='1' AND first_login='no' AND picture_ready='1'";


	$result_count = mysqli_query($conn, $queryCountArtists);
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
	$total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total pages minus 1
	// Pages Links
	$link .= '?';
	$hrefNext_page = $link . 'page_no=' . $next_page;
	$hrefPrevious_page = $link . 'page_no=' . $previous_page;
	$hrefFirst_page = $link . 'page_no=1';
	$hrefLast_page = $link . 'page_no=' . $total_no_of_pages;

	$queryTrendingUsersInfo = "SELECT * FROM users LEFT JOIN genre_user ON genre_user.id_user = users.id_user
																																LEFT JOIN regions ON users.id_region = regions.id_region
																																LEFT JOIN genres ON genre_user.id_genre = genres.id_genre
																																LEFT JOIN cities ON users.id_city = cities.id_city WHERE id_type_user='1' AND first_login='no' AND picture_ready='1' ORDER BY FIELD(genre_user.id_genre, '$genre1', '$genre2', '$genre3', '$genre4', '$genre5') DESC, users.id_user DESC";

	$queryTrendingUsersInfo .= " LIMIT $offset, $total_records_per_page";

	$queryTrendingUsers = mysqli_query($conn, $queryTrendingUsersInfo);
	$resultsArray = array();
	while($trendingUsers = mysqli_fetch_array($queryTrendingUsers)){
		$resultsArray[] = $trendingUsers;
	}

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

?>

		<!-- Artist card display -->
			<div class="col">

					<div class="card">

					<? if(file_exists('images/avatars/'.$results['id_user'] .'.jpg')):?>

						<a title="perfil de <?=$results['nick_user']?>"  href="profile.php?userid=<?=$results['id_user']?>"><img src="images/avatars/<?=$results['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$results['id_user'].'.jpg')?>" class="card-img-top" alt="foto de <?=$results['nick_user']?>"></a>

					<? else: ?>
						<a title="perfil de <?=$results['nick_user']?>"  href="profile.php?userid=<?=$results['id_user']?>"><img src="images/avatars/profile_default.jpg" class="card-img-top" alt="foto por defecto"></a>
					<? endif; ?>
						<div class="card-body">

							<a title="perfil de <?=$results['nick_user']?>" href="profile.php?userid=<?=$results['id_user']?>"><h5 class="card-title"><?=$results['nick_user']?></h5></a>

							<!-- <p class="card-text"><span class="">Seguidores: </span><span class="font-weight-bold"><?=$countFollowers?></span></p> -->

							<p class="card-text"><i class="fas fa-music"></i> <?=$results['name_genre']?></p>

							<p class="card-text"><i class="fas fa-map-marker-alt"></i> <?=$results['name_region']?></p>

						</div>

					</div>

				</div>

	<? } ?>
