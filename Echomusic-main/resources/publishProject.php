<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';
// Likes
  if(isset($_POST['publishProject']) && $_POST['publishProject']!=''){
    $userid = $_SESSION['user'];

  // Get project data
    $queryDataProject = mysqli_query($conn, "SELECT * FROM projects_crowdfunding LEFT JOIN project_desc ON projects_crowdfunding.id_project=project_desc.id_project
                                                                                 LEFT JOIN regions ON projects_crowdfunding.project_region = regions.id_region WHERE projects_crowdfunding.id_user='$userid' AND status_project='0' ORDER BY projects_crowdfunding.id_project DESC LIMIT 1");
    $dataProjectArray = mysqli_fetch_assoc($queryDataProject);
    $prId = $dataProjectArray['id_project'];

  // Get project times
    $queryDatesProject = mysqli_query($conn, "SELECT * FROM project_times WHERE id_project=$prId");
    $datesProject = mysqli_fetch_assoc($queryDatesProject);

  // Query categorias proyecto
    $queryProjectCategories = mysqli_query($conn, "SELECT * FROM project_categories LEFT JOIN categories_projects ON project_categories.id_category=categories_projects.id_category WHERE id_project='$prId'");
    $projectCategories_array = mysqli_fetch_array($queryProjectCategories);

  // Query imagen de portada y video
    $queryMultimediaProject = mysqli_query($conn, "SELECT * FROM project_multimedia WHERE id_project='$prId' AND project_multimedia_type='2'");
    $multimediaProject_array = mysqli_fetch_assoc($queryMultimediaProject);
  // Check complete dataProjectArray
    if($dataProjectArray['project_title']=='' || $dataProjectArray['project_amount']=='' || $dataProjectArray['project_desc']=='' || $datesProject['rec_time']=='' || $datesProject['exec_time']=='' || $projectCategories_array['id_category']=='0' || $multimediaProject_array['project_multimedia_name']==''
    || !file_exists('../images/crowdfunding/pr_'.$prId.'/'.$prId.'.jpg')){
      $error = true;
      echo "dataProject-";
    }else{
      // Query tiers y recompensas
        $queryProjectTiers = mysqli_query($conn, "SELECT * FROM project_tiers WHERE id_project='$prId' AND status_tier='0'");
        // Ciclo while con fetch para tiers y recompensas
          $projectTiersArray = array();
          $tiersArray = array();
          while($projectTiers_array = mysqli_fetch_array($queryProjectTiers)){
            $tier_ready = false;
            if($projectTiers_array['tier_title']!='' && $projectTiers_array['tier_amount']!='' && $projectTiers_array['tier_desc']!=''){
              $tiersArray[] = $projectTiers_array['id_tier'];
              $tier_ready = true;
            }else if($projectTiers_array['tier_title']=='' && ($projectTiers_array['tier_amount']=='' || $projectTiers_array['tier_amount']=='0') && $projectTiers_array['tier_desc']==''){
              $tier_ready = false;
              $tier_not_ready = true;
            }else if(($projectTiers_array['tier_title']=='' || $projectTiers_array['tier_amount']=='' || $projectTiers_array['tier_amount']=='0' || $projectTiers_array['tier_desc']=='') && !isset($tier_not_ready)){
              $error = true;
              echo "incomplete-";
            }
          }

        if(!empty($tiersArray)){
          $ids = join("','", $tiersArray);
        }else{
          $error = true;
          echo "missing-";
        }
      }

  // Check if user has data ready
   $bankData = mysqli_query($conn, "SELECT data_ready FROM users WHERE id_user='$userid'");
   $arrayBankData = mysqli_fetch_assoc($bankData);

   if($arrayBankData['data_ready']=='no'){
     $error = true;
     $errTyp = "dataNotReady";
     echo $errTyp;
     die();
   }

   if( !$error ) {

      $recTimeDays = $datesProject['rec_time'];
      $execTimeMonths = $datesProject['exec_time'];

      $dateStart = date('Y-m-d H:i:s');
   		$dateEnd = date('Y-m-d', strtotime("+".$recTimeDays." day")).' 23:59:59';
      $dateExec = date('Y-m-d', strtotime($dateEnd. "+".$execTimeMonths." month"));


      $queryPublishProject = "UPDATE projects_crowdfunding SET status_project='1', project_date_start='$dateStart', project_date_end='$dateEnd', project_date_execution='$dateExec' WHERE id_user='$userid' AND status_project='0'";
      $queryTiersReady = "UPDATE project_tiers SET status_tier='1' WHERE id_tier IN('$ids')";
      $submitDataQuery = implode(";", array_filter([$queryPublishProject, $queryTiersReady])) ;

      if (mysqli_multi_query($conn, $submitDataQuery)) {
        if(mysqli_affected_rows($conn)){
          $errTyp = "success";
          echo $errTyp;
         }else{
           $errTyp = "danger";
           echo $errTyp;
         }
       } else {
         $errTyp = "danger";
         echo $errTyp;
       }
   }else{
       $errTyp = "danger";
       echo $errTyp;
   }
 }
?>
