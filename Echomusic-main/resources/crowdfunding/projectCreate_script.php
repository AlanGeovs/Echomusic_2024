<?php
  // Conectar base de datos
include 'resources/connect.php';

// check session
if(!isset($_SESSION['user']) || $_SESSION['user']==''){
  $errTyp=="loginError";
  $plsLogin = true;
}else{
  // user id
  $userid = $_SESSION['user'];

}

// Check if data ready
  $queryCheckData = mysqli_query($conn, "SELECT data_ready FROM users WHERE id_user='$userid'");
  $checkData = mysqli_fetch_assoc($queryCheckData);
  if($checkData['data_ready'] == 'yes'){
    $dataReady = true;
  }

// Revisar si el usuario tiene eventos o si el actual ya existe
 $queryCheckProject = mysqli_query($conn, "SELECT id_project, status_project FROM projects_crowdfunding WHERE id_user='$userid' AND status_project IN ('0', '1') ORDER BY id_project DESC LIMIT 1");
 if(mysqli_num_rows($queryCheckProject) >= 1){
   $projectExist = true;
   $infoProject = mysqli_fetch_assoc($queryCheckProject);
   $idProject = $infoProject['id_project'];
 }else{
   $projectExist = false;
 }

// Query datos de categorías
$queryCategoriesInfo = mysqli_query($conn, "SELECT * FROM categories_projects");
$arrayCategories = array();
while($categories = mysqli_fetch_array($queryCategoriesInfo)){
  $arrayCategories[] = $categories;
}

// Query Regions
$queryRegions = mysqli_query($conn, "SELECT * FROM regions");
$regionsArray = array();
while($regions = mysqli_fetch_array($queryRegions)){
	$regionsArray[] = $regions;
}

// Query multimedia
  $queryMultimediaProject = mysqli_query($conn, "SELECT * FROM project_multimedia WHERE id_project='$idProject'");
// Ciclo para discriminar multimedia content
  $multimediaProjectArray = array();
  while($multimediaProject_array = mysqli_fetch_assoc($queryMultimediaProject)){
    $multimediaProjectArray[] = $multimediaProject_array;
  }
  foreach($multimediaProjectArray as $multimediaProject_array){
    if($multimediaProject_array['project_multimedia_type']=='1'){
      $projectCoverImg = $multimediaProject_array['project_multimedia_name'];
    }else if($multimediaProject_array['project_multimedia_type']=='2'){
      $projectCoverVideo = $multimediaProject_array['project_multimedia_name'];
      $coverVideoService = $multimediaProject_array['project_multimedia_service'];
    }
  }

// Query tiempo ejecución
if($projectExist){
  $queryTimes = mysqli_query($conn, "SELECT * FROM project_times WHERE id_project='$idProject'");
  $arrayTimes = mysqli_fetch_assoc($queryTimes);
}

// Query tiers y recompensas
  $queryProjectTiers = mysqli_query($conn, "SELECT * FROM project_tiers WHERE id_project='$idProject' ORDER BY tier_slot ASC");
  // Ciclo while con fetch para tiers y recompensas
    $projectTiersArray = array();
    while($projectTiers_array = mysqli_fetch_array($queryProjectTiers)){
      $projectTiersArray[] = $projectTiers_array;
    }


// Query data project if exists
$queryDataProject = mysqli_query($conn, "SELECT * FROM projects_crowdfunding LEFT JOIN project_desc ON projects_crowdfunding.id_project=project_desc.id_project
                                                                             LEFT JOIN regions ON projects_crowdfunding.project_region = regions.id_region
                                                                             LEFT JOIN project_categories ON projects_crowdfunding.id_project = project_categories.id_project
                                                                             WHERE projects_crowdfunding.id_user='$userid' AND projects_crowdfunding.status_project IN ('0', '1') ORDER BY projects_crowdfunding.id_project DESC LIMIT 1");
if(mysqli_num_rows($queryDataProject)>0){
  $dataProject = mysqli_fetch_assoc($queryDataProject);
}

// montos y comisiones
  $projectAmount = $dataProject['project_amount'];
  // Generate Fee
    $fee = 9.52;
    $commissionProject = 0;
    $a = $projectAmount / 100;
    $a = $a * $fee;
    $commissionProject = round($a, 0);

if(isset($_POST['create_project']) AND $_POST['create_project']!='' AND isset($_SESSION['user'])){
    if(!$projectExist && isset($dataReady)){
      // Query info insertada de proyecto
       $queryProject_1 = "INSERT INTO projects_crowdfunding(id_user) VALUES ('$userid')";

       if(mysqli_query($conn, $queryProject_1)){
         $queryLastProject = mysqli_query($conn, "SELECT MAX(id_project) FROM projects_crowdfunding WHERE id_user='$userid' AND status_project='0'");
         $arrayLastProject = mysqli_fetch_assoc($queryLastProject);
         $lastProject_id = $arrayLastProject['MAX(id_project)'];

          $queryProject_2 = "INSERT INTO project_categories(id_project, id_category) VALUES ('$lastProject_id', '')";
          $queryProject_3 = "INSERT INTO project_desc(id_project, project_desc) VALUES ('$lastProject_id', '')";
          $queryProject_4 = "INSERT INTO project_times(id_project) VALUES ('$lastProject_id')";
          $queryProject_5 = "INSERT INTO project_multimedia(id_project, project_multimedia_type) VALUES ('$lastProject_id', '1'), ('$lastProject_id', '2')";
          $queryProject_6 = "INSERT INTO project_tiers(id_project, tier_slot) VALUES ('$lastProject_id', '1'), ('$lastProject_id', '2'), ('$lastProject_id', '3'), ('$lastProject_id', '4'), ('$lastProject_id', '5')";

         if(mysqli_query($conn, $queryProject_2) AND mysqli_query($conn, $queryProject_3) AND mysqli_query($conn, $queryProject_4) AND mysqli_query($conn, $queryProject_5) AND mysqli_query($conn, $queryProject_6) AND mkdir('images/crowdfunding/pr_'.$lastProject_id.'', 0755)){
           $errTyp = "success";
           $errMSG = 'Proyecto creado con éxito';
           header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
           exit();
        }else{
          mysqli_query($conn, "UPDATE projects_crowdfunding SET status_project='5' WHERE id_project='$lastProject_id'");
          $errTyp = "danger";
          $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.1";
        }
       }else{
         $errTyp = "danger";
         $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
       }

    }else{
      $errTyp = "danger";
      $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
      echo $errTyp;
    }
  }
 ?>
