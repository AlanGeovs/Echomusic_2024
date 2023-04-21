<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';

if(isset($_POST['id']) && !empty($_POST['id'])) {
  $id_user = $_SESSION['user'];
  $id_video = trim($_POST['id']);
  $id_video = strip_tags($id_video);
  $id_video = htmlspecialchars($id_video);
  $id_video = mysqli_real_escape_string($conn, $id_video);

  if(!FILTER_VAR($id_video, FILTER_VALIDATE_INT, 1)){
    $error = true;
  }

  if( !$error ) {

      if(mysqli_query($conn,"DELETE FROM multimedia WHERE id_user='$id_user' AND id_multi='$id_video'")){
        $data = "success";
        echo $data;
      }
  }else{
    echo "danger";
  }

}
?>
