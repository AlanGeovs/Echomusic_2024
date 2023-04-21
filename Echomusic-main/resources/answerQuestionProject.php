<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';
include 'answerProyectoMail.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

// Likes
  if(isset($_POST['id']) && $_POST['id']!=''){

    $userid = $_SESSION['user'];

    $id = trim($_POST['id']);

    $desc = trim($_POST['text']);
    $desc = strip_tags($desc);
    $desc = htmlspecialchars($desc);
    $desc = mysqli_real_escape_string($conn, $desc);

    if(!FILTER_VAR($id, FILTER_VALIDATE_INT, 1)){
       $error = true;
       $idError = "La información no es válida.";
   	}

    if (strlen($desc) > 201) {
     $error = true;
     $descError = "La descripción debe tener menos de 200 caracteres.";
   }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$desc)) {
     $error = true;
     $descError = "La descripción solo puede contener letras y números";
   }else if(empty($desc)){
     $error = true;
     $descError = "Respuesta vacía";
   }

   // Check project and user
   $queryCheckUser = mysqli_query($conn, "SELECT id_project, project_title FROM projects_crowdfunding WHERE id_user='$userid' AND status_project IN ('1','2') ORDER BY id_project DESC LIMIT 1");
   $checkUserArray = mysqli_fetch_assoc($queryCheckUser);
   $id_project = $checkUserArray['id_project'];

   if( !$error ) {

      $queryAnswerQuestion = "UPDATE project_questions SET question_status='1' WHERE id_question='$id' AND question_status='0' AND id_project='$id_project'";

      if (mysqli_query($conn, $queryAnswerQuestion)) {
        if(mysqli_affected_rows($conn)){

          mysqli_query($conn, "INSERT INTO project_answers(id_question, answer_desc, answer_status) VALUES ('$id', '$desc', '1')");

          $queryDataArtist = mysqli_query($conn, "SELECT nick_user FROM users WHERE id_user='$userid'");
          $dataArtist = mysqli_fetch_array($queryDataArtist);

          $queryDataUser = mysqli_query($conn, "SELECT users.mail_user, users.first_name_user, users.last_name_user FROM users LEFT JOIN project_questions ON users.id_user = project_questions.id_user WHERE project_questions.id_question='$id'");
          $dataUser = mysqli_fetch_array($queryDataUser);

          // Aqui sale el correo al usuario avisándole que su pregunta fue respondida
          $NOMBRE_PATROCINADOR = ucfirst($dataUser['first_name_user']).' '.ucfirst($dataUser['last_name_user']);
          $NOMBRE_PROYECTO = $checkUserArray['project_title'];
          $CODIGO_PROYECTO = $id_project;

          $text = $submitProyectoMail.$NOMBRE_PATROCINADOR.$submitProyectoMail1.$NOMBRE_PROYECTO.$submitProyectoMail2.$CODIGO_PROYECTO.$submitProyectoMail3.$CODIGO_PROYECTO.$submitProyectoMail4.$CODIGO_PROYECTO.$submitProyectoMail5;

          $mail = new PHPMailer();
          $mail->Encoding = 'base64';
          $mail->CharSet = 'UTF-8';
          $mail->isHTML(true);
          $mail->SetFrom('crowdfunding@echomusic.cl', 'Soporte Crowdfunding Echomusic'); //Name is optional
          $mail->Subject   = 'Tu pregunta ha sido respondida';
          $mail->Body     = $text;
          $mail->AddAddress($dataUser['mail_user']);
          $mail->send();

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
       $errTyp = "error";
       echo $errTyp;
   }
 }
?>
