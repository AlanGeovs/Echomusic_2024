<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';

if(isset($_POST['id']) && !empty($_POST['id'])) {
  $id_user = $_SESSION['user'];
  $id_multimedia = trim($_POST['id']);
  $id_multimedia = strip_tags($id_multimedia);
  $id_multimedia = htmlspecialchars($id_multimedia);
  $id_multimedia = mysqli_real_escape_string($conn, $id_multimedia);
  $queryLikeCheck = mysqli_query($conn, "SELECT * FROM multimedia_likes WHERE id_user='$id_user' AND id_multimedia='$id_multimedia'");
  if(mysqli_num_rows($queryLikeCheck)>=1){
    die();
  } else if(mysqli_query($conn,"INSERT INTO multimedia_likes (id_user, id_multimedia) VALUES ('$id_user', '$id_multimedia')")){
    $queryLikes = mysqli_query($conn, "SELECT * FROM multimedia_likes WHERE id_multimedia='$id_multimedia'");
    $countLikes = mysqli_num_rows($queryLikes);
    $data = $countLikes;
    echo json_encode($data);
  }
}
?>
