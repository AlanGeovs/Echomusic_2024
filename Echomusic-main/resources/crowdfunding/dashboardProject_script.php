<?php
  // Conectar DB
    // En dashboard_script.php

  // Set session $userid
    // En dashboard_script.php como $userid

  // Query info proyecto
    // -Título -Descripción -Portada -Video -Actividades -Montos -Plazos -Tiers
    $queryDataProject = mysqli_query($conn, "SELECT * FROM projects_crowdfunding LEFT JOIN project_desc ON projects_crowdfunding.id_project=project_desc.id_project
                                                                                 LEFT JOIN regions ON projects_crowdfunding.project_region = regions.id_region WHERE projects_crowdfunding.id_user='$userid' AND status_project IN ('0','1','2','3','4') ORDER BY projects_crowdfunding.id_project DESC LIMIT 1");
    $dataProjectArray = mysqli_fetch_assoc($queryDataProject);
    $prId = $dataProjectArray['id_project'];


    // Calcular monto recaudado
      $queryBackersInfo = mysqli_query($conn, "SELECT id_project_backer, backer_amount, backer_added_amount, backer_fee FROM project_backers WHERE id_project='$prId' AND status_backer='1'");
      $totalBackers = mysqli_num_rows($queryBackersInfo);
      $prBackersAmount = 0;
      while($totalArray = mysqli_fetch_array($queryBackersInfo)){
        $prBackersAmount = $prBackersAmount + $totalArray['backer_amount'] + $totalArray['backer_added_amount'];
      }

    // Calcular porcentaje recaudado
    if($totalBackers>0){
      $x = $prBackersAmount*100;
      $x = $x / $dataProjectArray['project_amount'];
      $prBackersPercentage = $x;
      unset($x);
      $prBackersPercentage = intval($prBackersPercentage);
    }else{
      $prBackersPercentage = '0';
    }
    // Query total patrocinadores
      $queryProjectBackers = mysqli_query($conn, "SELECT * FROM project_backers LEFT JOIN users ON project_backers.id_user = users.id_user
                                                                                LEFT JOIN project_tiers ON project_backers.id_tier = project_tiers.id_tier WHERE project_backers.id_project='$prId' AND status_backer='1'");
      $totalBackers = mysqli_num_rows($queryProjectBackers);
      // Ciclo while con fetch y suma para patrocinadores
        $projectBackersArray = array();
        $projectActualAmount = 0;
        while($projectBackers_array = mysqli_fetch_array($queryProjectBackers)){
          $projectBackersArray[] = $projectBackers_array;
          // Suma distintos montos para conseguir el total actual
          $projectActualAmount = $projectActualAmount + $projectBackers_array['backer_amount'] + $projectBackers_array['backer_added_amount'];
        }

    // Query categorias proyecto
      $queryProjectCategories = mysqli_query($conn, "SELECT * FROM project_categories LEFT JOIN categories_projects ON project_categories.id_category=categories_projects.id_category WHERE id_project='$prId'");
      // Ciclo while con fetch para categorias
        $projectCategories = array();
        while($projectCategories_array = mysqli_fetch_array($queryProjectCategories)){
          $projectCategoriesArray[] = $projectCategories_array;
        }

    // Date create y Date format

    if($dataProjectArray['status_project']=='0'){

      $queryDatesProject = mysqli_query($conn, "SELECT * FROM project_times WHERE id_project=$prId");
      $datesProject = mysqli_fetch_assoc($queryDatesProject);

      $recTimeDays = $datesProject['rec_time'];
      $execTimeMonths = $datesProject['exec_time'];

   		$datetimeProjectEnd = date('Y-m-d', strtotime("+".$recTimeDays." day")).' 23:59:59';
      $datetimeProjectExec = date('Y-m-d', strtotime($datetimeProjectEnd. "+".$execTimeMonths." month"));
   		$datetimeProjectEnd = date_create($datetimeProjectEnd);
      $datetimeProjectExec = date_create($datetimeProjectExec);

    }else{
      $datetimeProjectEnd = date_create($dataProjectArray['project_date_end']);
      $datetimeProjectStart = date_create($dataProjectArray['project_date_start']);
      $datetimeProjectExec = date_create($dataProjectArray['project_date_execution']);

      $timeProjectEnd = DATE_FORMAT($datetimeProjectEnd, "H:i");
      $dateProjectEnd = DATE_FORMAT($datetimeProjectEnd, "d-m-Y");

      $timeProjectStart = DATE_FORMAT($datetimeProjectStart, "H:i");
      $dateProjectStart = DATE_FORMAT($datetimeProjectStart, "d-m-Y");
    }

  // Query preguntas
      $queryQuestions = mysqli_query($conn, "SELECT * FROM project_questions LEFT JOIN project_answers ON project_questions.id_question=project_answers.id_question
                                                                             LEFT JOIN users ON project_questions.id_user = users.id_user WHERE project_questions.id_project='$prId' AND question_status='0' ORDER BY project_questions.id_question DESC");
      $totalQuestions = mysqli_num_rows($queryQuestions);
      // Ciclo while con fetch para preguntas y respuestas
        $projectQAsArray = array();
        while($projectQAs_array = mysqli_fetch_array($queryQuestions)){
          $projectQAsArray[] = $projectQAs_array;
        }

      // Estatus proyecto
      switch($dataProjectArray['status_project']){
        case 0:
          $prStatus = 'Por publicar';
          $prStatusClass = 'en-proceso';
        break;
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


 ?>
