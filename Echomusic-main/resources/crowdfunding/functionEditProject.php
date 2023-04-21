<?php
define('ROOT_PATH', dirname(__DIR__) . '/');
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include '../connect.php';

// Recibir form con If isset $_POST y Session user
if( isset($_SESSION['user']) && isset($_POST['prTitle'])){ //Actualizar info general

  // set user id
  $userid = $_SESSION['user'];

  // set var error to false
  $error = false;

  // Sanitizar inputs
  $prTitle = trim($_POST['prTitle']);
  $prTitle = strip_tags($prTitle);
  $prTitle = htmlspecialchars($prTitle);
  $prTitle = mysqli_real_escape_string($conn, $prTitle);

  $prCategory = trim($_POST['prCategory']);
  $prCategory = strip_tags($prCategory);
  $prCategory = htmlspecialchars($prCategory);
  $prCategory = mysqli_real_escape_string($conn, $prCategory);

  $prRegion = trim($_POST['prRegion']);
  $prRegion = strip_tags($prRegion);
  $prRegion = htmlspecialchars($prRegion);
  $prRegion = mysqli_real_escape_string($conn, $prRegion);

  $prDesc = trim($_POST['prDescription']);
  $prDesc = strip_tags($prDesc);
  $prDesc = htmlspecialchars($prDesc);
  $prDesc = mysqli_real_escape_string($conn, $prDesc);

  // Validar data
  if (empty($prTitle)) {
   $prTitle = '';
  } else if (strlen($prTitle) < 3) {
   $error = true;
   $prTitleError = "El nombre del proyecto debe tener más de 3 caracteres";
  } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prTitle)) {
   $error = true;
   $prTitleError = "El nombre del proyecto solo puede contener letras y números";
  }

  if (empty($prCategory)) {
   $prCategory = "";
  }else if(!preg_match("/^[1-9][0-9]*$/", $prCategory)){
   $error = true;
   $prCategoryError = "La categoría no es válida.";
  }

  if (empty($prRegion)) {
    $prRegion = 0;
  }else if(!preg_match("/^[1-9][0-9]*$/", $prRegion)){
   $error = true;
   $prRegionError = "La región no es válida.";
  }

  if (empty($prDesc)) {
     $prDesc = "";
  } else if (strlen($prDesc) < 20) {
    $error = true;
    $prDescError = "La descripción debe tener más de 20 caracteres.";
    echo 'nonDesc-';
  } else if (strlen($prDesc) > 5001) {
    $error = true;
    $prDescError = "La descripción debe tener menos de 5000 caracteres.";
    echo 'nonDesc-';
    }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prDesc)) {
    $error = true;
    $prDescError = "La descripción del proyecto contiene caracteres no permitidos.";
    echo 'nonDesc-';
   }

   // Revisar si el usuario tiene eventos o si el actual ya existe
    $queryCheckProject = mysqli_query($conn, "SELECT id_project, status_project FROM projects_crowdfunding WHERE id_user='$userid' AND status_project = '0' ORDER BY id_project DESC LIMIT 1");
    if(mysqli_num_rows($queryCheckProject) >= 1){
      $projectExist = true;
      $infoProject = mysqli_fetch_assoc($queryCheckProject);
      $idProject = $infoProject['id_project'];
    }else{
      $projectExist = false;
      $error = true;
      echo 'nonEdit-';
    }

  // si no hay errores
    if(!$error){
      // Si el proyecto no existe: INSERT de lo contrario UPDATE
      if(isset($projectExist)){
        // Query info actualizada de proyecto
          $queryProject_1 = "UPDATE projects_crowdfunding SET project_title='$prTitle', project_region='$prRegion' WHERE id_project='$idProject'";
          $queryProject_2 = "UPDATE project_categories SET id_category='$prCategory' WHERE id_project='$idProject'";
          $queryProject_3 = "UPDATE project_desc SET project_desc='$prDesc' WHERE id_project='$idProject'";

         if(mysqli_query($conn, $queryProject_1) AND mysqli_query($conn, $queryProject_2) AND mysqli_query($conn, $queryProject_3)){
           $errTyp = "success";
           echo $errTyp;
         }else{
           $errTyp = "danger";
           $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
           echo $errTyp;
         }
       }

    }else{
      $errTyp = "danger";
      $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
      echo $errTyp;
    }


}else if( isset($_SESSION['user']) && isset($_POST['prAmount'])){ //Actualizar Montos

  // set user id
  $userid = $_SESSION['user'];

  // set var error to false
  $error = false;

  // Sanitizar inputs
  $prAmount = trim($_POST['prAmount']);
  $prAmount = strip_tags($prAmount);
  $prAmount = htmlspecialchars($prAmount);
  $prAmount = mysqli_real_escape_string($conn, $prAmount);

  $prRecTime = trim($_POST['prRecTime']);
  $prRecTime = strip_tags($prRecTime);
  $prRecTime = htmlspecialchars($prRecTime);
  $prRecTime = mysqli_real_escape_string($conn, $prRecTime);

  $prExecTime = trim($_POST['prExecTime']);
  $prExecTime = strip_tags($prExecTime);
  $prExecTime = htmlspecialchars($prExecTime);
  $prExecTime = mysqli_real_escape_string($conn, $prExecTime);

  $prAmount = str_replace(".", "",$prAmount);

  // Validar data

  if (empty($prAmount)) {
   $prAmount = "";
  }else if(!preg_match("/^[1-9][0-9]*$/", $prAmount)){
   $error = true;
   $prAmountError = "El monto no es válido.";
  }

  if (empty($prRecTime)) {
   $prRecTime = "";
 }else if(!in_array($prRecTime, ['','30','45','60'], true)){
   $error = true;
   $prRecTimeError = "El tiempo de recaudación no es válido.";
  }

  if (empty($prExecTime)) {
    $prExecTime = '';
  }else if(!preg_match("/^[1-9][0-9]*$/", $prExecTime)){
   $error = true;
   $prExecTimeError = "El tiempo de ejecución no es válido.";
  }


   // Revisar si el usuario tiene eventos o si el actual ya existe
    $queryCheckProject = mysqli_query($conn, "SELECT id_project, status_project FROM projects_crowdfunding WHERE id_user='$userid' AND status_project = '0' ORDER BY id_project DESC LIMIT 1");
    if(mysqli_num_rows($queryCheckProject) >= 1){
      $projectExist = true;
      $infoProject = mysqli_fetch_assoc($queryCheckProject);
      $idProject = $infoProject['id_project'];
    }else{
      $projectExist = false;
      $error = true;
      echo 'nonEdit-';
    }

  // si no hay errores
    if(!$error){
      // Si el proyecto existe UPDATE
      if(isset($projectExist)){
        $queryProject_1 = "UPDATE projects_crowdfunding SET project_amount='$prAmount' WHERE id_project='$idProject'";
        $queryProject_2 = "UPDATE project_times SET rec_time='$prRecTime', exec_time='$prExecTime' WHERE id_project='$idProject'";
      }

      // set array para multi query
      $submitProjectQuery = implode(";", array_filter([$queryProject_1, $queryProject_2]));

      if(mysqli_query($conn, $queryProject_1) AND mysqli_query($conn, $queryProject_2)){
        $errTyp = "success";
        echo $errTyp;
      }else{
        $errTyp = "danger";
        $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
        echo $errTyp;
      }

    }else{
      $errTyp = "danger";
      $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
      echo $errTyp;
    }


}else if( isset($_SESSION['user']) && isset($_POST['prTiersSubmit'])){ //Actualizar Montos

  // set user id
  $userid = $_SESSION['user'];

  // set var error to false
  $error = false;

  // Vars tier 1
  $prNameTier_1 = trim($_POST['prNameTier_1']);
  $prNameTier_1 = strip_tags($prNameTier_1);
  $prNameTier_1 = htmlspecialchars($prNameTier_1);
  $prNameTier_1 = mysqli_real_escape_string($conn, $prNameTier_1);

  $prAmountTier_1 = trim($_POST['prAmountTier_1']);
  $prAmountTier_1 = strip_tags($prAmountTier_1);
  $prAmountTier_1 = htmlspecialchars($prAmountTier_1);
  $prAmountTier_1 = mysqli_real_escape_string($conn, $prAmountTier_1);

  $prDescTier_1 = trim($_POST['prDescTier_1']);
  $prDescTier_1 = strip_tags($prDescTier_1);
  $prDescTier_1 = htmlspecialchars($prDescTier_1);
  $prDescTier_1 = mysqli_real_escape_string($conn, $prDescTier_1);

  $tReward_1_01 = trim($_POST['tReward_1_01']);
  $tReward_1_01 = strip_tags($tReward_1_01);
  $tReward_1_01 = htmlspecialchars($tReward_1_01);
  $tReward_1_01 = mysqli_real_escape_string($conn, $tReward_1_01);

  $tReward_1_02 = trim($_POST['tReward_1_02']);
  $tReward_1_02 = strip_tags($tReward_1_02);
  $tReward_1_02 = htmlspecialchars($tReward_1_02);
  $tReward_1_02 = mysqli_real_escape_string($conn, $tReward_1_02);

  $tReward_1_03 = trim($_POST['tReward_1_03']);
  $tReward_1_03 = strip_tags($tReward_1_03);
  $tReward_1_03 = htmlspecialchars($tReward_1_03);
  $tReward_1_03 = mysqli_real_escape_string($conn, $tReward_1_03);

  $tReward_1_04 = trim($_POST['tReward_1_04']);
  $tReward_1_04 = strip_tags($tReward_1_04);
  $tReward_1_04 = htmlspecialchars($tReward_1_04);
  $tReward_1_04 = mysqli_real_escape_string($conn, $tReward_1_04);

  // Vars tier 2
  $prNameTier_2 = trim($_POST['prNameTier_2']);
  $prNameTier_2 = strip_tags($prNameTier_2);
  $prNameTier_2 = htmlspecialchars($prNameTier_2);
  $prNameTier_2 = mysqli_real_escape_string($conn, $prNameTier_2);

  $prAmountTier_2 = trim($_POST['prAmountTier_2']);
  $prAmountTier_2 = strip_tags($prAmountTier_2);
  $prAmountTier_2 = htmlspecialchars($prAmountTier_2);
  $prAmountTier_2 = mysqli_real_escape_string($conn, $prAmountTier_2);

  $prDescTier_2 = trim($_POST['prDescTier_2']);
  $prDescTier_2 = strip_tags($prDescTier_2);
  $prDescTier_2 = htmlspecialchars($prDescTier_2);
  $prDescTier_2 = mysqli_real_escape_string($conn, $prDescTier_2);

  $tReward_2_01 = trim($_POST['tReward_2_01']);
  $tReward_2_01 = strip_tags($tReward_2_01);
  $tReward_2_01 = htmlspecialchars($tReward_2_01);
  $tReward_2_01 = mysqli_real_escape_string($conn, $tReward_2_01);

  $tReward_2_02 = trim($_POST['tReward_2_02']);
  $tReward_2_02 = strip_tags($tReward_2_02);
  $tReward_2_02 = htmlspecialchars($tReward_2_02);
  $tReward_2_02 = mysqli_real_escape_string($conn, $tReward_2_02);

  $tReward_2_03 = trim($_POST['tReward_2_03']);
  $tReward_2_03 = strip_tags($tReward_2_03);
  $tReward_2_03 = htmlspecialchars($tReward_2_03);
  $tReward_2_03 = mysqli_real_escape_string($conn, $tReward_2_03);

  $tReward_2_04 = trim($_POST['tReward_2_04']);
  $tReward_2_04 = strip_tags($tReward_2_04);
  $tReward_2_04 = htmlspecialchars($tReward_2_04);
  $tReward_2_04 = mysqli_real_escape_string($conn, $tReward_2_04);

  // Vars tier 3
  $prNameTier_3 = trim($_POST['prNameTier_3']);
  $prNameTier_3 = strip_tags($prNameTier_3);
  $prNameTier_3 = htmlspecialchars($prNameTier_3);
  $prNameTier_3 = mysqli_real_escape_string($conn, $prNameTier_3);

  $prAmountTier_3 = trim($_POST['prAmountTier_3']);
  $prAmountTier_3 = strip_tags($prAmountTier_3);
  $prAmountTier_3 = htmlspecialchars($prAmountTier_3);
  $prAmountTier_3 = mysqli_real_escape_string($conn, $prAmountTier_3);

  $prDescTier_3 = trim($_POST['prDescTier_3']);
  $prDescTier_3 = strip_tags($prDescTier_3);
  $prDescTier_3 = htmlspecialchars($prDescTier_3);
  $prDescTier_3 = mysqli_real_escape_string($conn, $prDescTier_3);

  $tReward_3_01 = trim($_POST['tReward_3_01']);
  $tReward_3_01 = strip_tags($tReward_3_01);
  $tReward_3_01 = htmlspecialchars($tReward_3_01);
  $tReward_3_01 = mysqli_real_escape_string($conn, $tReward_3_01);

  $tReward_3_02 = trim($_POST['tReward_3_02']);
  $tReward_3_02 = strip_tags($tReward_3_02);
  $tReward_3_02 = htmlspecialchars($tReward_3_02);
  $tReward_3_02 = mysqli_real_escape_string($conn, $tReward_3_02);

  $tReward_3_03 = trim($_POST['tReward_3_03']);
  $tReward_3_03 = strip_tags($tReward_3_03);
  $tReward_3_03 = htmlspecialchars($tReward_3_03);
  $tReward_3_03 = mysqli_real_escape_string($conn, $tReward_3_03);

  $tReward_3_04 = trim($_POST['tReward_3_04']);
  $tReward_3_04 = strip_tags($tReward_3_04);
  $tReward_3_04 = htmlspecialchars($tReward_3_04);
  $tReward_3_04 = mysqli_real_escape_string($conn, $tReward_3_04);

  // Vars tier 4
  $prNameTier_4 = trim($_POST['prNameTier_4']);
  $prNameTier_4 = strip_tags($prNameTier_4);
  $prNameTier_4 = htmlspecialchars($prNameTier_4);
  $prNameTier_4 = mysqli_real_escape_string($conn, $prNameTier_4);

  $prAmountTier_4 = trim($_POST['prAmountTier_4']);
  $prAmountTier_4 = strip_tags($prAmountTier_4);
  $prAmountTier_4 = htmlspecialchars($prAmountTier_4);
  $prAmountTier_4 = mysqli_real_escape_string($conn, $prAmountTier_4);

  $prDescTier_4 = trim($_POST['prDescTier_4']);
  $prDescTier_4 = strip_tags($prDescTier_4);
  $prDescTier_4 = htmlspecialchars($prDescTier_4);
  $prDescTier_4 = mysqli_real_escape_string($conn, $prDescTier_4);

  $tReward_4_01 = trim($_POST['tReward_4_01']);
  $tReward_4_01 = strip_tags($tReward_4_01);
  $tReward_4_01 = htmlspecialchars($tReward_4_01);
  $tReward_4_01 = mysqli_real_escape_string($conn, $tReward_4_01);

  $tReward_4_02 = trim($_POST['tReward_4_02']);
  $tReward_4_02 = strip_tags($tReward_4_02);
  $tReward_4_02 = htmlspecialchars($tReward_4_02);
  $tReward_4_02 = mysqli_real_escape_string($conn, $tReward_4_02);

  $tReward_4_03 = trim($_POST['tReward_4_03']);
  $tReward_4_03 = strip_tags($tReward_4_03);
  $tReward_4_03 = htmlspecialchars($tReward_4_03);
  $tReward_4_03 = mysqli_real_escape_string($conn, $tReward_4_03);

  $tReward_4_04 = trim($_POST['tReward_4_04']);
  $tReward_4_04 = strip_tags($tReward_4_04);
  $tReward_4_04 = htmlspecialchars($tReward_4_04);
  $tReward_4_04 = mysqli_real_escape_string($conn, $tReward_4_04);

  // Vars tier 5
  $prNameTier_5 = trim($_POST['prNameTier_5']);
  $prNameTier_5 = strip_tags($prNameTier_5);
  $prNameTier_5 = htmlspecialchars($prNameTier_5);
  $prNameTier_5 = mysqli_real_escape_string($conn, $prNameTier_5);

  $prAmountTier_5 = trim($_POST['prAmountTier_5']);
  $prAmountTier_5 = strip_tags($prAmountTier_5);
  $prAmountTier_5 = htmlspecialchars($prAmountTier_5);
  $prAmountTier_5 = mysqli_real_escape_string($conn, $prAmountTier_5);

  $prDescTier_5 = trim($_POST['prDescTier_5']);
  $prDescTier_5 = strip_tags($prDescTier_5);
  $prDescTier_5 = htmlspecialchars($prDescTier_5);
  $prDescTier_5 = mysqli_real_escape_string($conn, $prDescTier_5);

  $tReward_5_01 = trim($_POST['tReward_5_01']);
  $tReward_5_01 = strip_tags($tReward_5_01);
  $tReward_5_01 = htmlspecialchars($tReward_5_01);
  $tReward_5_01 = mysqli_real_escape_string($conn, $tReward_5_01);

  $tReward_5_02 = trim($_POST['tReward_5_02']);
  $tReward_5_02 = strip_tags($tReward_5_02);
  $tReward_5_02 = htmlspecialchars($tReward_5_02);
  $tReward_5_02 = mysqli_real_escape_string($conn, $tReward_5_02);

  $tReward_5_03 = trim($_POST['tReward_5_03']);
  $tReward_5_03 = strip_tags($tReward_5_03);
  $tReward_5_03 = htmlspecialchars($tReward_5_03);
  $tReward_5_03 = mysqli_real_escape_string($conn, $tReward_5_03);

  $tReward_5_04 = trim($_POST['tReward_5_04']);
  $tReward_5_04 = strip_tags($tReward_5_04);
  $tReward_5_04 = htmlspecialchars($tReward_5_04);
  $tReward_5_04 = mysqli_real_escape_string($conn, $tReward_5_04);

  $prAmountTier_1 = str_replace(".", "",$prAmountTier_1);
  $prAmountTier_2 = str_replace(".", "",$prAmountTier_2);
  $prAmountTier_3 = str_replace(".", "",$prAmountTier_3);
  $prAmountTier_4 = str_replace(".", "",$prAmountTier_4);
  $prAmountTier_5 = str_replace(".", "",$prAmountTier_5);

  // Validar data
  if (empty($prNameTier_1)) {
   $prNameTier_1 = '';
  } else if (strlen($prNameTier_1) < 3) {
   $error = true;
   $prNameTier_1Error = "El nombre del tier debe tener más de 3 caracteres";
  } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prNameTier_1)) {
   $error = true;
   $prNameTier_1Error = "El nombre del tier solo puede contener letras y números";
  }

  if (empty($prNameTier_2)) {
   $prNameTier_2 = '';
 } else if (strlen($prNameTier_2) < 3) {
   $error = true;
   $prNameTier_2Error = "El nombre del tier debe tener más de 3 caracteres";
 } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prNameTier_2)) {
   $error = true;
   $prNameTier_2Error = "El nombre del tier solo puede contener letras y números";
  }

  if (empty($prNameTier_3)) {
   $prNameTier_3 = '';
 } else if (strlen($prNameTier_3) < 3) {
   $error = true;
   $prNameTier_3Error = "El nombre del tier debe tener más de 3 caracteres";
 } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prNameTier_3)) {
   $error = true;
   $prNameTier_3Error = "El nombre del tier solo puede contener letras y números";
  }

  if (empty($prNameTier_4)) {
   $prNameTier_4 = '';
 } else if (strlen($prNameTier_4) < 3) {
   $error = true;
   $prNameTier_4Error = "El nombre del tier debe tener más de 3 caracteres";
 } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prNameTier_4)) {
   $error = true;
   $prNameTier_4Error = "El nombre del tier solo puede contener letras y números";
  }

  if (empty($prNameTier_5)) {
   $prNameTier_5 = '';
 } else if (strlen($prNameTier_5) < 3) {
   $error = true;
   $prNameTier_5Error = "El nombre del tier debe tener más de 3 caracteres";
 } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prNameTier_5)) {
   $error = true;
   $prNameTier_5Error = "El nombre del tier solo puede contener letras y números";
  }

  if (empty($prAmountTier_1)) {
   $prAmountTier_1 = "";
  }else if(!preg_match("/^[1-9][0-9]*$/", $prAmountTier_1)){
   $error = true;
   $prAmountTier_1Error = "El monto no es válida.";
  }

  if (empty($prAmountTier_2)) {
   $prAmountTier_2 = "";
 }else if(!preg_match("/^[1-9][0-9]*$/", $prAmountTier_2)){
   $error = true;
   $prAmountTier_2Error = "El monto no es válida.";
  }

  if (empty($prAmountTier_3)) {
   $prAmountTier_3 = "";
 }else if(!preg_match("/^[1-9][0-9]*$/", $prAmountTier_3)){
   $error = true;
   $prAmountTier_3Error = "El monto no es válida.";
  }

  if (empty($prAmountTier_4)) {
   $prAmountTier_4 = "";
 }else if(!preg_match("/^[1-9][0-9]*$/", $prAmountTier_4)){
   $error = true;
   $prAmountTier_4Error = "El monto no es válida.";
  }

  if (empty($prAmountTier_5)) {
   $prAmountTier_5 = "";
 }else if(!preg_match("/^[1-9][0-9]*$/", $prAmountTier_5)){
   $error = true;
   $prAmountTier_5Error = "El monto no es válida.";
  }

  if (empty($prDescTier_1)) {
     $prDescTier_1 = "";
  } else if (strlen($prDescTier_1) < 3) {
    $error = true;
    $prDescTier_1Error = "La descripción debe tener más de 3 caracteres.";
  } else if (strlen($prDescTier_1) > 301) {
    $error = true;
    $prDescTier_1Error = "La descripción debe tener menos de 300 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prDescTier_1)) {
    $error = true;
    $prDescTier_1Error = "La descripción del proyecto contiene caracteres no permitidos.";
   }

  if (empty($prDescTier_2)) {
     $prDescTier_2 = "";
  } else if (strlen($prDescTier_2) < 3) {
    $error = true;
    $prDescTier_2Error = "La descripción debe tener más de 3 caracteres.";
  } else if (strlen($prDescTier_2) > 301) {
    $error = true;
    $prDescTier_2Error = "La descripción debe tener menos de 300 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prDescTier_2)) {
    $error = true;
    $prDescTier_2Error = "La descripción del proyecto contiene caracteres no permitidos.";
   }

  if (empty($prDescTier_3)) {
     $prDescTier_3 = "";
  } else if (strlen($prDescTier_3) < 3) {
    $error = true;
    $prDescTier_3Error = "La descripción debe tener más de 3 caracteres.";
  } else if (strlen($prDescTier_3) > 301) {
    $error = true;
    $prDescTier_3Error = "La descripción debe tener menos de 300 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prDescTier_3)) {
    $error = true;
    $prDescTier_3Error = "La descripción del proyecto contiene caracteres no permitidos.";
   }

  if (empty($prDescTier_4)) {
     $prDescTier_4 = "";
  } else if (strlen($prDescTier_4) < 3) {
    $error = true;
    $prDescTier_4Error = "La descripción debe tener más de 3 caracteres.";
  } else if (strlen($prDescTier_4) > 301) {
    $error = true;
    $prDescTier_4Error = "La descripción debe tener menos de 300 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prDescTier_4)) {
    $error = true;
    $prDescTier_4Error = "La descripción del proyecto contiene caracteres no permitidos.";
   }

  if (empty($prDescTier_5)) {
     $prDescTier_5 = "";
  } else if (strlen($prDescTier_5) < 3) {
    $error = true;
    $prDescTier_5Error = "La descripción debe tener más de 3 caracteres.";
  } else if (strlen($prDescTier_5) > 301) {
    $error = true;
    $prDescTier_5Error = "La descripción debe tener menos de 300 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$prDescTier_5)) {
    $error = true;
    $prDescTier_5Error = "La descripción del proyecto contiene caracteres no permitidos.";
   }

  if (empty($tReward_1_01)) {
     $tReward_1_01 = "";
  } else if (strlen($tReward_1_01) < 2) {
    $error = true;
    $tReward_1_01Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_1_01) > 56) {
    $error = true;
    $tReward_1_01Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_1_01)) {
    $error = true;
    $tReward_1_01Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_1_02)) {
     $tReward_1_02 = "";
  } else if (strlen($tReward_1_02) < 2) {
    $error = true;
    $tReward_1_02Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_1_02) > 56) {
    $error = true;
    $tReward_1_02Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_1_02)) {
    $error = true;
    $tReward_1_02Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_1_03)) {
     $tReward_1_03 = "";
  } else if (strlen($tReward_1_03) < 2) {
    $error = true;
    $tReward_1_03Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_1_03) > 56) {
    $error = true;
    $tReward_1_03Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_1_03)) {
    $error = true;
    $tReward_1_03Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_1_04)) {
     $tReward_1_04 = "";
  } else if (strlen($tReward_1_04) < 2) {
    $error = true;
    $tReward_1_04Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_1_04) > 56) {
    $error = true;
    $tReward_1_04Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_1_04)) {
    $error = true;
    $tReward_1_04Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_2_01)) {
     $tReward_2_01 = "";
  } else if (strlen($tReward_2_01) < 2) {
    $error = true;
    $tReward_2_01Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_2_01) > 56) {
    $error = true;
    $tReward_2_01Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_2_01)) {
    $error = true;
    $tReward_2_01Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_2_02)) {
     $tReward_2_02 = "";
  } else if (strlen($tReward_2_02) < 2) {
    $error = true;
    $tReward_2_02Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_2_02) > 56) {
    $error = true;
    $tReward_2_02Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_2_02)) {
    $error = true;
    $tReward_2_02Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_2_03)) {
     $tReward_2_03 = "";
  } else if (strlen($tReward_2_03) < 2) {
    $error = true;
    $tReward_2_03Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_2_03) > 56) {
    $error = true;
    $tReward_2_03Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_2_03)) {
    $error = true;
    $tReward_2_03Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_2_04)) {
     $tReward_2_04 = "";
  } else if (strlen($tReward_2_04) < 2) {
    $error = true;
    $tReward_2_04Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_2_04) > 56) {
    $error = true;
    $tReward_2_04Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_2_04)) {
    $error = true;
    $tReward_2_04Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_3_01)) {
     $tReward_3_01 = "";
  } else if (strlen($tReward_3_01) < 2) {
    $error = true;
    $tReward_3_01Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_3_01) > 56) {
    $error = true;
    $tReward_3_01Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_3_01)) {
    $error = true;
    $tReward_3_01Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_3_02)) {
     $tReward_3_02 = "";
  } else if (strlen($tReward_3_02) < 2) {
    $error = true;
    $tReward_3_02Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_3_02) > 56) {
    $error = true;
    $tReward_3_02Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_3_02)) {
    $error = true;
    $tReward_3_02Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_3_03)) {
     $tReward_3_03 = "";
  } else if (strlen($tReward_3_03) < 2) {
    $error = true;
    $tReward_3_03Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_3_03) > 56) {
    $error = true;
    $tReward_3_03Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_3_03)) {
    $error = true;
    $tReward_3_03Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_3_04)) {
     $tReward_3_04 = "";
  } else if (strlen($tReward_3_04) < 2) {
    $error = true;
    $tReward_3_04Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_3_04) > 56) {
    $error = true;
    $tReward_3_04Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_3_04)) {
    $error = true;
    $tReward_3_04Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_4_01)) {
     $tReward_4_01 = "";
  } else if (strlen($tReward_4_01) < 2) {
    $error = true;
    $tReward_4_01Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_4_01) > 56) {
    $error = true;
    $tReward_4_01Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_4_01)) {
    $error = true;
    $tReward_4_01Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_4_02)) {
     $tReward_4_02 = "";
  } else if (strlen($tReward_4_02) < 2) {
    $error = true;
    $tReward_4_02Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_4_02) > 56) {
    $error = true;
    $tReward_4_02Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_4_02)) {
    $error = true;
    $tReward_4_02Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_4_03)) {
     $tReward_4_03 = "";
  } else if (strlen($tReward_4_03) < 2) {
    $error = true;
    $tReward_4_03Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_4_03) > 56) {
    $error = true;
    $tReward_4_03Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_4_03)) {
    $error = true;
    $tReward_4_03Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_4_04)) {
     $tReward_4_04 = "";
  } else if (strlen($tReward_4_04) < 2) {
    $error = true;
    $tReward_4_04Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_4_04) > 56) {
    $error = true;
    $tReward_4_04Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_4_04)) {
    $error = true;
    $tReward_4_04Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_5_01)) {
     $tReward_5_01 = "";
  } else if (strlen($tReward_5_01) < 2) {
    $error = true;
    $tReward_5_01Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_5_01) > 56) {
    $error = true;
    $tReward_5_01Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_5_01)) {
    $error = true;
    $tReward_5_01Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_5_02)) {
     $tReward_5_02 = "";
  } else if (strlen($tReward_5_02) < 2) {
    $error = true;
    $tReward_5_02Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_5_02) > 56) {
    $error = true;
    $tReward_5_02Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_5_02)) {
    $error = true;
    $tReward_5_02Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_5_03)) {
     $tReward_5_03 = "";
  } else if (strlen($tReward_5_03) < 2) {
    $error = true;
    $tReward_5_03Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_5_03) > 56) {
    $error = true;
    $tReward_5_03Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_5_03)) {
    $error = true;
    $tReward_5_03Error = "La recompensa contiene caracteres no permitidos.";
   }

  if (empty($tReward_5_04)) {
     $tReward_5_04 = "";
  } else if (strlen($tReward_5_04) < 2) {
    $error = true;
    $tReward_5_04Error = "La recompensa debe tener más de 3 caracteres.";
  } else if (strlen($tReward_5_04) > 56) {
    $error = true;
    $tReward_5_04Error = "La recompensa debe tener menos de 55 caracteres.";
  }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$tReward_5_04)) {
    $error = true;
    $tReward_5_04Error = "La recompensa contiene caracteres no permitidos.";
   }


   // Revisar si el usuario tiene eventos o si el actual ya existe
    $queryCheckProject = mysqli_query($conn, "SELECT id_project, status_project FROM projects_crowdfunding WHERE id_user='$userid' AND status_project = '0' ORDER BY id_project DESC LIMIT 1");
    if(mysqli_num_rows($queryCheckProject) >= 1){
      $projectExist = true;
      $infoProject = mysqli_fetch_assoc($queryCheckProject);
      $idProject = $infoProject['id_project'];
    }else{
      $projectExist = false;
      $error = true;
      echo 'nonEdit-';
    }

    // ^ OPTIMIZAR CON UNA FUNCIÓN!! ^

  // si no hay errores
    if(!$error){
      // Si el proyecto existe UPDATE
      if(isset($projectExist)){
        $queryProject_1 = "UPDATE project_tiers SET tier_title='$prNameTier_1', tier_amount='$prAmountTier_1', tier_desc='$prDescTier_1', t_reward_01='$tReward_1_01', t_reward_02='$tReward_1_02', t_reward_03='$tReward_1_03', t_reward_04='$tReward_1_04' WHERE id_project='$idProject' AND tier_slot='1'";
        $queryProject_2 = "UPDATE project_tiers SET tier_title='$prNameTier_2', tier_amount='$prAmountTier_2', tier_desc='$prDescTier_2', t_reward_01='$tReward_2_01', t_reward_02='$tReward_2_02', t_reward_03='$tReward_2_03', t_reward_04='$tReward_2_04' WHERE id_project='$idProject' AND tier_slot='2'";
        $queryProject_3 = "UPDATE project_tiers SET tier_title='$prNameTier_3', tier_amount='$prAmountTier_3', tier_desc='$prDescTier_3', t_reward_01='$tReward_3_01', t_reward_02='$tReward_3_02', t_reward_03='$tReward_3_03', t_reward_04='$tReward_3_04' WHERE id_project='$idProject' AND tier_slot='3'";
        $queryProject_4 = "UPDATE project_tiers SET tier_title='$prNameTier_4', tier_amount='$prAmountTier_4', tier_desc='$prDescTier_4', t_reward_01='$tReward_4_01', t_reward_02='$tReward_4_02', t_reward_03='$tReward_4_03', t_reward_04='$tReward_4_04' WHERE id_project='$idProject' AND tier_slot='4'";
        $queryProject_5 = "UPDATE project_tiers SET tier_title='$prNameTier_5', tier_amount='$prAmountTier_5', tier_desc='$prDescTier_5', t_reward_01='$tReward_5_01', t_reward_02='$tReward_5_02', t_reward_03='$tReward_5_03', t_reward_04='$tReward_5_04' WHERE id_project='$idProject' AND tier_slot='5'";
      }

      if(mysqli_query($conn, $queryProject_1) AND mysqli_query($conn, $queryProject_2) AND mysqli_query($conn, $queryProject_3) AND mysqli_query($conn, $queryProject_4) AND mysqli_query($conn, $queryProject_5)){
        $errTyp = "success";
        echo $errTyp;
      }else{
        $errTyp = "danger";
        $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
        echo $errTyp;
      }

    }else{
      $errTyp = "danger";
      $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
      echo $errTyp;
    }


}else if( isset($_SESSION['user']) && isset($_POST['prVideoURL'])){ //Actualizar Montos

    // set user id
    $userid = $_SESSION['user'];

    $videoURL = trim($_POST['prVideoURL']);
    $videoURL = strip_tags($videoURL, '<iframe>');
    $videoURL = htmlspecialchars($videoURL);
    $videoURL = mysqli_real_escape_string($conn, $videoURL);

    // data validation
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoURL, $match)) {
        $videoURL = urlencode($match[1]);
        $service = 'youtube';
    }else if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $videoURL, $match)) {
        $videoURL = urlencode($match[3]);
        $service = 'vimeo';
    }else if(emtpy($videoURL)){
        $videoURL = '';
        $service = '';
    }else{
        $error = true;
        $videoError = 'Este enlace no es válido, por favor inténtalo con otro.';
    }

// Get current DateTime
$dateVideo = date('Y-m-d H:i:s', time());

   // Revisar si el usuario tiene eventos o si el actual ya existe
    $queryCheckProject = mysqli_query($conn, "SELECT id_project, status_project FROM projects_crowdfunding WHERE id_user='$userid' AND status_project = '0' ORDER BY id_project DESC LIMIT 1");
    if(mysqli_num_rows($queryCheckProject) >= 1){
      $projectExist = true;
      $infoProject = mysqli_fetch_assoc($queryCheckProject);
      $idProject = $infoProject['id_project'];
    }else{
      $projectExist = false;
      $error = true;
      echo 'nonEdit-';
    }

   if( !$error ) {
     if(isset($projectExist)){
       $queryVideo = "UPDATE project_multimedia SET project_multimedia_service='$service', project_multimedia_name='$videoURL', project_multimedia_date='$dateVideo' WHERE id_project='$idProject' AND project_multimedia_type='2'";
     }
      if (mysqli_query($conn, $queryVideo)) {
        $errTyp = "success";
        echo $errTyp.','.$videoURL.','.$service;
      }else {
       $errTyp = "danger";
       echo $errTyp;
      }
    }
     else {
      $errTyp = "danger";
      echo $errTyp;
     }
}

?>
