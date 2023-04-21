<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';

if(isset($_POST['id']) && !empty($_POST['id'])) {
  $id_user = $_SESSION['user'];
  $id_artist = trim($_POST['id']);
  $id_artist = strip_tags($id_artist);
  $id_artist = htmlspecialchars($id_artist);
  $id_artist = mysqli_real_escape_string($conn, $id_artist);

  if(!FILTER_VAR($id_artist, FILTER_VALIDATE_INT, 1)){
    $error = true;
  }

  if( !$error ){
    if(mysqli_query($conn,"DELETE FROM follow_users WHERE id_user='$id_user' AND id_artist='$id_artist'")){
      $data = "success";
      echo $data;
    }
  }else{
    echo "danger";
  }
}
?>
