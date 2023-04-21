<?php
include 'connect.php';
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
if(isset($_POST['submit_comment']) && isset($_SESSION['user']) && FILTER_INPUT(INPUT_POST, 'id_video', FILTER_VALIDATE_INT, 1)){


  $error = false;

  $commentUserId = $_SESSION['user'];
  $commentSubmit = trim($_POST['submit_comment']);
  $commentSubmit = strip_tags($commentSubmit);
  $commentSubmit = htmlspecialchars($commentSubmit);
  $commentSubmit = mysqli_real_escape_string($conn, $commentSubmit);

  $idPost = $_POST['id_video'];

  $queryPostComments = mysqli_query($conn, "SELECT * FROM multimedia_comments LEFT JOIN users ON multimedia_comments.id_user_comment = users.id_user WHERE id_multimedia='$idPost' ORDER BY id_comment DESC");
  $postComments = mysqli_fetch_array($queryPostComments);

  $dateComment = date('Y-m-d h:i:s', time());

  if(empty($commentSubmit)){
    $error= true;
    $commentError = "Por favor escribe tu comentario.";
  }
  else if (strlen($commentSubmit) <= 1) {
   $error = true;
   $commentError = "El comentario debe tener más de 1 caracteres.";
 }

 if(!$error){
  $queryCommentInfo = "INSERT INTO multimedia_comments(ID_user_comment, ID_multimedia, text_comment, date_comment) VALUES ('$commentUserId', '$idPost', '$commentSubmit', '$dateComment')";
  if(mysqli_query($conn, $queryCommentInfo)){
    $errTyp = 'success';
    $errMSG = 'Comentario publicado con éxito'; ?>
      <!-- Comment Return -->

      <li>

        <div class="row mt-3">

          <? if(file_exists('../images/avatars/'.$commentUserId.'.jpg')): ?>
            <label for="commentInput" class="col-1 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/<?=$commentUserId?>.jpg"></label>
          <? else: ?>
            <label for="commentInput" class="col-1 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/profile_default.jpg"></label>
          <? endif; ?>

          <div class="col-10 commentText pt-2 ml-3">

            <p class="font-weight-bold mb-1"><?=($postComments['nick_user'] === NULL) ? $postComments['first_name_user'] : $postComments['nick_user']?></p>

            <p class="mb-2"><?=$commentSubmit?></p>

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
  <script type="text/javascript">alert('<?=$commentError?>');</script>
  <?
}

}

?>
