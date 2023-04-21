<?php
include 'connect.php';
include 'submitProyectoMail.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
if(isset($_POST['submit_question']) && isset($_SESSION['user']) && FILTER_INPUT(INPUT_POST, 'id_project', FILTER_VALIDATE_INT, 1)){


  $error = false;

  $questionUserId = $_SESSION['user'];
  $questionSubmit = trim($_POST['submit_question']);
  $questionSubmit = strip_tags($questionSubmit);
  $questionSubmit = htmlspecialchars($questionSubmit);
  $questionSubmit = mysqli_real_escape_string($conn, $questionSubmit);

  $idProject = $_POST['id_project'];
  $idProject = mysqli_real_escape_string($conn, $idProject);



  $dateQuestion = date('d-m-Y', time());

  if(empty($questionSubmit)){
    $error= true;
    $questionError = "Por favor escribe tu pregunta.";
  }
  else if (strlen($questionSubmit) <= 1) {
   $error = true;
   $questionError = "La pregunta debe tener más de 1 caracter.";
 }

 if(!$error){
  $queryQuestionInfo = "INSERT INTO project_questions(id_project, id_user, question_desc) VALUES ('$idProject', '$questionUserId', '$questionSubmit')";
  if(mysqli_query($conn, $queryQuestionInfo)){
    $errTyp = 'success';
    $errMSG = 'Pregunta publicada con éxito';
    $queryQuestions = mysqli_query($conn, "SELECT * FROM project_questions LEFT JOIN project_answers ON project_questions.id_question=project_answers.id_question
                                                                           LEFT JOIN users ON project_questions.id_user = users.id_user WHERE project_questions.id_project='$idProject' ORDER BY project_questions.id_question DESC");
    $projectQAs = mysqli_fetch_array($queryQuestions);

    $queryDataProject = mysqli_query($conn, "SELECT project_title FROM projects_crowdfunding WHERE id_project='$idProject'");
    $dataProject = mysqli_fetch_array($queryDataProject);

    $queryDataArtist = mysqli_query($conn, "SELECT mail_user, nick_user FROM users LEFT JOIN projects_crowdfunding ON users.id_user = projects_crowdfunding.id_user WHERE projects_crowdfunding.id_project='$idProject'");
    $dataArtist = mysqli_fetch_array($queryDataArtist);

    // Aqui sale el correo al artista avisándole que recibió una pregunta
    $NOMBRE_BANDA = $dataArtist['nick_user'];
    $CODIGO_PROYECTO = $idProject;
    $text = $answerProyectoMail.$NOMBRE_BANDA.$answerProyectoMail2.$answerProyectoMail3.$answerProyectoMail4.$answerProyectoMail5;


    $mail = new PHPMailer();
    $mail->Encoding = 'base64';
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);
    $mail->SetFrom('crowdfunding@echomusic.cl', 'Soporte Crowdfunding Echomusic'); //Name is optional
    $mail->Subject   = 'Tu proyecto ha recibido una pregunta';
    $mail->Body     = $text;
    $mail->AddAddress($dataArtist['mail_user']);
    $mail->send();
       ?>
      <!-- Comment Return -->

      <? $projectQuestionDatetime = date_create($projectQAs['question_date']); ?>
      <? $projectQuestionDatetime = DATE_FORMAT($projectQuestionDatetime, "d-m-Y"); ?>
        <li>
          <div class="row mt-3">
            <? if(file_exists('../images/avatars/'.$projectQAs['id_user'].'.jpg')): ?>
              <label for="commentInput" class="col-1 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="../images/avatars/<?=$projectQAs['id_user']?>.jpg?=<?=filemtime('../images/avatars/'.$projectQAs['id_user'].'.jpg')?>"></label>
            <? else: ?>
              <label for="commentInput" class="col-1 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/profile_default.jpg"></label>
            <? endif; ?>
            <div class="col-10 commentText pt-2 ml-3">
              <p class="font-weight-bold mb-1"><? echo ($projectQAs['nick_user'] === NULL) ? $projectQAs['first_name_user'] : $projectQAs['nick_user'];?></p>
              <p class="mb-2"><?=$projectQAs['question_desc']?></p>
              <span class="date sub-text"><?=$dateQuestion?></span>
            </div>
          </div>
        </li>
    <?
  } else{
    $errTyp = 'danger';
    $errMSG = 'Ha sucedido un error, por favor inténtalo de nuevo.';?>
    <script type="text/javascript">alert('<?=$errMSg?>');</script>
    <?
  }
}else{
  $errTyp = 'danger';
  $errMSG = 'Ha sucedido un error, por favor inténtalo de nuevo.';?>
  <script type="text/javascript">alert('<?=$questionError?>');</script>
  <?
}

}

?>
