<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
// Likes
  if(isset($_POST['save_likes'])){

  // Get data
    $genreFollow = trim($_POST['genreFollow']);
    $genreFollow = mysqli_real_escape_string($conn, $genreFollow);

  // Data Validation
  if(!FILTER_VAR($genreFollowOne, FILTER_VALIDATE_INT, 1)){
     $error = true;
     $genreFollowOneError = "La información no es válida.";
   }

   if( !$error ) {
     // Get genre names
     $queryGenres = mysqli_query($conn, "SELECT * FROM genres WHERE id_genre='$genreFollow'");
     $genres = mysqli_fetch_array($queryGenres);

     // Query update genres
     $queryGenreFollowOne = "UPDATE follow_genres SET id_genre='$genreFollow' WHERE id_user='$userid' AND id_slot='1'";

      if (mysqli_query($conn, $queryGenreFollow)) {
        $errTyp = "success";
        $errMSG = "Información agregada con éxito";
        ?>
        <li class="list-inline-item" rel="<?=$genres['id_genre']?>" ><button type="button" class="btn btn-primary btn-lg btn-border my-2"><?=$genres['name_genre']?> <i class="fas fa-times ml-5"></i></button></li>
       <?
       } else {
         $errTyp = "danger";
         $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
       }

     }
   }
?>
