<?php
  // Conectar base de datos
    include 'resources/connect.php';
    include 'resources/functionDateTranslate.php';

  // Set var userid
    $userid = $_SESSION['user'];

  // set error false
      $error = false;

  // Get project id
    if(FILTER_INPUT(INPUT_GET, 'projectid', FILTER_VALIDATE_INT, 1)){
      $prId = $_GET["projectid"];
    }else{
      http_response_code(404);
      header("HTTP/1.0 404 Not Found");
      die();
    }

  // Query imagen de portada y video
    $queryMultimediaProject = mysqli_query($conn, "SELECT * FROM project_multimedia WHERE id_project='$prId'");


  // Query información general del proyecto
    $queryDataProject = mysqli_query($conn, "SELECT * FROM projects_crowdfunding LEFT JOIN project_desc ON projects_crowdfunding.id_project=project_desc.id_project
                                                                                 LEFT JOIN regions ON projects_crowdfunding.project_region = regions.id_region WHERE projects_crowdfunding.id_project='$prId'");
    $dataProjectArray = mysqli_fetch_assoc($queryDataProject);

    if($dataProjectArray['id_user']==$userid){
      $sameUser = true;
    }

    if(!isset($sameUser) && $dataProjectArray['status_project']=='0'){
      http_response_code(404);
      header("HTTP/1.0 404 Not Found");
      die();
    }

  // Calcular monto recaudado
    $queryBackersInfo = mysqli_query($conn, "SELECT id_project_backer, backer_amount, backer_added_amount, backer_fee FROM project_backers WHERE id_project='$prId' AND status_backer='1'");
    $totalBackers = mysqli_num_rows($queryBackersInfo);
    $prBackersAmount = 0;
    while($totalArray = mysqli_fetch_array($queryBackersInfo)){
      $prBackersAmount = $prBackersAmount + $totalArray['backer_amount'] + $totalArray['backer_added_amount'];
    }

    // Calcular porcentaje recaudado
      $x = $prBackersAmount*100;
      $x = $x / $dataProjectArray['project_amount'];
      $prBackersPercentage = $x;
      unset($x);
      $prBackersPercentage = intval($prBackersPercentage);



  // Id artista
    $artistId = $dataProjectArray['id_user'];

  // Query info del artista
    $queryArtistProject = mysqli_query($conn, "SELECT * FROM users LEFT JOIN desc_user ON users.id_user = desc_user.id_user
                                                                   LEFT JOIN type_musician ON users.id_musician = type_musician.id_musician
                                                                   LEFT JOIN instruments ON users.id_instrument = instruments.id_instrument
                                                                   LEFT JOIN regions ON users.id_region = regions.id_region
                                                                   LEFT JOIN cities ON users.id_city = cities.id_city WHERE users.id_user='$artistId'");
    $artistProjectArray = mysqli_fetch_assoc($queryArtistProject);

  // Query categorias proyecto
    $queryProjectCategories = mysqli_query($conn, "SELECT * FROM project_categories LEFT JOIN categories_projects ON project_categories.id_category=categories_projects.id_category WHERE id_project='$prId'");
    // Ciclo while con fetch para categorias
      $projectCategories = array();
      while($projectCategories_array = mysqli_fetch_array($queryProjectCategories)){
        $projectCategoriesArray[] = $projectCategories_array;
      }

  // Query preguntas y respuestas
    $queryQuestions = mysqli_query($conn, "SELECT * FROM project_questions LEFT JOIN project_answers ON project_questions.id_question=project_answers.id_question
                                                                           LEFT JOIN users ON project_questions.id_user = users.id_user WHERE project_questions.id_project='$prId' ORDER BY project_questions.id_question DESC");
    // Ciclo while con fetch para preguntas y respuestas
      $projectQAsArray = array();
      while($projectQAs_array = mysqli_fetch_array($queryQuestions)){
        $projectQAsArray[] = $projectQAs_array;
      }


      if(isset($sameUser) && $dataProjectArray['status_project']=='0'){
        // Query tiers y recompensas
          $queryProjectTiers = mysqli_query($conn, "SELECT * FROM project_tiers WHERE id_project='$prId' ORDER BY tier_amount ASC");
          // Ciclo while con fetch para tiers y recompensas
            $projectTiersArray = array();
            while($projectTiers_array = mysqli_fetch_array($queryProjectTiers)){
              $projectTiersArray[] = $projectTiers_array;
            }
      }else{
        // Query tiers y recompensas
          $queryProjectTiers = mysqli_query($conn, "SELECT * FROM project_tiers WHERE id_project='$prId' AND status_tier='1' ORDER BY tier_amount ASC");
          // Ciclo while con fetch para tiers y recompensas
            $projectTiersArray = array();
            while($projectTiers_array = mysqli_fetch_array($queryProjectTiers)){
              $projectTiersArray[] = $projectTiers_array;
            }
      }
      $queryTierRewards = mysqli_query($conn, "SELECT * FROM project_tiers_rewards WHERE id_project='$prId'");
      $projectRewards_array = array();
      while($projectRewards_array = mysqli_fetch_array($queryTierRewards)){
        $projectRewardsArray[] = $projectRewards_array;
      }

  // Query total patrocinadores
    $queryProjectBackers = mysqli_query($conn, "SELECT * FROM project_backers WHERE id_project='$prId' AND status_backer='1'");
    $totalBackers = mysqli_num_rows($queryProjectBackers);
    // Ciclo while con fetch y suma para patrocinadores
      $projectBackersArray = array();
      $projectActualAmount = 0;
      while($projectBackers_array = mysqli_fetch_array($queryProjectBackers)){
        $projectBackersArray[] = $projectBackers_array;
        // Suma distintos montos para conseguir el total actual
        $projectActualAmount = $projectActualAmount + $projectBackers_array['backer_amount'] + $projectBackers_array['backer_added_amount'];
      }

  // Variables info proyecto

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


  // Query info de artista y variable
    $queryArtistProject = mysqli_query($conn, "SELECT * FROM users LEFT JOIN desc_user ON users.id_user = desc_user.id_user
                                                                   LEFT JOIN type_musician ON users.id_musician = type_musician.id_musician
                                                                   LEFT JOIN instruments ON users.id_instrument = instruments.id_instrument
                                                                   LEFT JOIN regions ON users.id_region = regions.id_region
                                                                   LEFT JOIN cities ON users.id_city = cities.id_city WHERE users.id_user='$artistId'");
    $artistArray = mysqli_fetch_assoc($queryArtistProject);

  // Date create y Date format
    $datetimeProjectEnd = date_create($dataProjectArray['project_date_end']);
    $datetimeProjectStart = date_create($dataProjectArray['project_date_start']);
    $datetimeProjectExec = date_create($dataProjectArray['project_date_execution']);

    $timeProjectEnd = DATE_FORMAT($datetimeProjectEnd, "H:i");
    $dateProjectEnd = DATE_FORMAT($datetimeProjectEnd, "d-m-Y");

    $timeProjectStart = DATE_FORMAT($datetimeProjectStart, "H:i");
    $dateProjectStart = DATE_FORMAT($datetimeProjectStart, "d-m-Y");

    function calculateDiff($x){
      $now = time(); // or your date as well
      $y = DATE_FORMAT($x, "Y-m-d");
      $z = strtotime($y);
      $datediff = $now - $z;

      $datediff = round($datediff / (60 * 60 * 24));
      if($datediff>0){
        $datediff = '0';
      }else{
        $datediff = $datediff*-1;
      }
      return $datediff;
    }

    // Estatus proyecto
    switch($dataProjectArray['status_project']){
      case 1:
        $prStatus = 'En proceso';
        $prStatusClass = 'en-proceso';
      break;
      case 2:
        $prStatus = 'Financiado';
        $prStatusClass = 'cerrado-ok';
      break;
      case 3:
        $prStatus = 'No Financiado';
        $prStatusClass = 'cerrado-nok';
      break;
      case 4:
        $prStatus = 'Cancelado';
        $prStatusClass = 'cerrado-nok';
      break;
    }

    // Query avances
      $queryProjectUpdates = mysqli_query($conn, "SELECT * FROM project_updates LEFT JOIN project_multimedia ON project_updates.id_project_multimedia = project_multimedia.id_project_multimedia WHERE project_updates.id_project='$prId' ORDER BY project_updates.update_date DESC");
      // Ciclo while con fetch para avances
        $projectUpdatesArray = array();
        while($projectUpdates_array = mysqli_fetch_array($queryProjectUpdates)){
          $projectUpdatesArray[] = $projectUpdates_array;
        }


  // Botón reportar
    if(isset($_POST['report'])){

      // Sanitizar inputs
      $reportDesc = trim($_POST['reportDesc']);
      $reportDesc = strip_tags($reportDesc);
      $reportDesc = htmlspecialchars($reportDesc);
      $reportDesc = mysqli_real_escape_string($conn, $reportDesc);

      if (empty($reportDesc)) {
       $error = true;
       $reportDescError = "Por favor ingresa la descripción del reporte.";
     } else if (strlen($reportDesc) < 20) {
        $error = true;
        $reportDescError = "La descripción debe tener más de 20 caracteres.";
     } else if (strlen($reportDesc) > 500) {
        $error = true;
        $reportDescError = "La descripción debe tener menos de 500 caracteres.";
      }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$reportDesc)) {
        $error = true;
        $reportDescError = "La descripción del reporte contiene caracteres no permitidos.";
       }

       // Si no hay errores..
       if(!$error){
         // Query report
          $queryReportProject = "INSERT INTO project_reports(id_project, id_user, report_desc) VALUES('$prId', '$userid', '$reportDesc')";
          if(mysqli_query($conn, $queryReportProject)){
            // Set session success
            $errMSG = "Reporte enviado correctamente, gracias.";
            $_SESSION['success'] = $errMSG;
            header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
            exit();
          }else{
            $errTyp = "danger";
            $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
          }
        // insert into report
       }else{
         $errTyp = "danger";
         $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
       }

    }

 ?>
