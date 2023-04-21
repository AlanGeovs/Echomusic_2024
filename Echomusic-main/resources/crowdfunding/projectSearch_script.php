<?php

include 'resources/connect.php';
include 'resources/functionDateTranslate.php';
// Query Categories
$queryCategories = mysqli_query($conn, "SELECT * FROM categories_projects");
$categoriesArray = array();
while($categories = mysqli_fetch_array($queryCategories)){
	$categoriesArray[] = $categories;
}


// Query Regions
$queryRegions = mysqli_query($conn, "SELECT * FROM regions");
$regionsArray = array();
while($regions = mysqli_fetch_array($queryRegions)){
	$regionsArray[] = $regions;
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

	$searchCategory = trim($_GET['category']);
  $searchCategory = strip_tags($searchCategory);
  $searchCategory = htmlspecialchars($searchCategory);
  $searchCategory = mysqli_real_escape_string($conn, $searchCategory);

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
	$filters_2 = array();

	if(!empty($searchRegion)){
		$filters[] = "projects_crowdfunding.project_region='$searchRegion'";
	}
	if(!empty($searchCategory)){
		$filters[] = "project_categories.id_category='$searchCategory'";
	}
	if(!empty($searchTerms)){
		$filters_2[] = "projects_crowdfunding.project_title LIKE '%".$searchTerms."%'";
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
	$total_records_per_page = 6;

	$offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2";

	$queryCountSearch = "SELECT projects_crowdfunding.id_project FROM projects_crowdfunding LEFT JOIN users ON users.id_user = projects_crowdfunding.id_user
																													 LEFT JOIN project_categories ON projects_crowdfunding.id_project = project_categories.id_project
																													 LEFT JOIN regions ON projects_crowdfunding.project_region = regions.id_region
																													 LEFT JOIN categories_projects ON project_categories.id_category = categories_projects.id_category
		              										                     WHERE users.nick_user LIKE '%".$searchTerms."%' AND projects_crowdfunding.status_project>0 AND projects_crowdfunding.status_project<=3 AND project_date_end >  DATE_FORMAT(NOW() ,'%Y-%m-01')";


	if(count($filters)>0){
		$queryCountSearch .= " AND ". implode(" AND ", $filters);
	}
	if(count($filters_2)>0){
		$queryCountSearch .= " OR ". implode(" OR ", $filters_2);
	}
	$queryCountSearch .= " GROUP BY projects_crowdfunding.id_project";

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
	$querySearch = "SELECT * FROM projects_crowdfunding LEFT JOIN users ON users.id_user = projects_crowdfunding.id_user
																											LEFT JOIN project_categories ON projects_crowdfunding.id_project = project_categories.id_project
																											LEFT JOIN regions ON projects_crowdfunding.project_region = regions.id_region
																											LEFT JOIN categories_projects ON project_categories.id_category = categories_projects.id_category
	            										                    WHERE users.nick_user LIKE '%".$searchTerms."%' AND projects_crowdfunding.status_project>0 AND projects_crowdfunding.status_project<=3 AND project_date_end >  DATE_FORMAT(NOW() ,'%Y-%m-01')";

									foreach($keys as $k){
										 // $queryByNick .= " OR nick_user LIKE '%$k%' ";
									}

	if(count($filters)>0){
		$querySearch .= " AND ". implode(" AND ", $filters);
	}
	if(count($filters_2)>0){
		$querySearch .= " OR ". implode(" OR ", $filters_2);
	}

$querySearch .= " GROUP BY projects_crowdfunding.id_project";

$querySearch .= " ORDER BY projects_crowdfunding.project_date_end ASC";

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
			$checkNoProjects = true;
		}
}else{

	// Loop through parameters
		$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
		$host = $_SERVER['HTTP_HOST'];
		$script = $_SERVER['SCRIPT_NAME'];
		$link = $protocol . '://' . $host . $script;


		 // pagination
		 	$total_records_per_page = 6;

		 	$offset = ($page_no-1) * $total_records_per_page;
		 	$previous_page = $page_no - 1;
		 	$next_page = $page_no + 1;
		 	$adjacents = "2";

		// Count query
			$queryCountSearch = "SELECT * FROM projects_crowdfunding WHERE status_project>'0' AND projects_crowdfunding.status_project>0 AND projects_crowdfunding.status_project<=2 GROUP BY projects_crowdfunding.id_project ORDER BY projects_crowdfunding.status_project ASC, projects_crowdfunding.project_date_end ASC";

			$result_count = mysqli_query($conn, $queryCountSearch);
			$total_records = mysqli_num_rows($result_count);

			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1; // total pages minus 1

			// Page Links
			$link .= '?';
			$hrefNext_page = $link . 'page_no=' . $next_page;
			$hrefPrevious_page = $link . 'page_no=' . $previous_page;
			$hrefFirst_page = $link . 'page_no=1';
			$hrefLast_page = $link . 'page_no=' . $total_no_of_pages;

		 // Query Search
		 	$querySearch = "SELECT * FROM projects_crowdfunding LEFT JOIN users ON users.id_user = projects_crowdfunding.id_user
		 																											LEFT JOIN project_categories ON projects_crowdfunding.id_project = project_categories.id_project
		 																											LEFT JOIN categories_projects ON project_categories.id_category = categories_projects.id_category
																													LEFT JOIN regions ON projects_crowdfunding.project_region = regions.id_region
																													WHERE status_project>'0' AND projects_crowdfunding.status_project>0 AND projects_crowdfunding.status_project<=2
																													GROUP BY projects_crowdfunding.id_project
																													ORDER BY projects_crowdfunding.status_project ASC, projects_crowdfunding.project_date_end ASC";


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
			 			$checkNoProjects = true;
			 		}
}

?>
