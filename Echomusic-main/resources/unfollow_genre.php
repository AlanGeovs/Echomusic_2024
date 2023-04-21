<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';
// Likes
  if(!empty($_POST['id'])){
    $id_user = $_SESSION['user'];
  // Get data
    $genreUnfollow = FILTER_INPUT(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $genreUnfollow = mysqli_real_escape_string($conn, $genreUnfollow);

  // Data Validation
  if(!FILTER_VAR($genreUnfollow, FILTER_VALIDATE_INT, 1)){
     $error = true;
     $genreUnfollowError = "La información no es válida.";
   }

   if( !$error ) {

     // Query update genres
     $queryGenreUnfollow = "UPDATE follow_genres SET id_genre='0' WHERE id_user='$id_user' AND id_genre='$genreUnfollow'";

      if (mysqli_query($conn, $queryGenreUnfollow)) {
        $errTyp = "success";
        $errMSG = "Información agregada con éxito";
        $data = "success";
        echo $data;
       } else {
         $errTyp = "danger";
         $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
       }

     }else{
       echo "danger";
     }
   }
?>
