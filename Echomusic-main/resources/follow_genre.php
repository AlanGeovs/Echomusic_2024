<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';
// Likes
  if(!empty($_POST['follow_genre'])){
    $id_user = $_SESSION['user'];
  // Get data
    $genreFollow = FILTER_INPUT(INPUT_POST, 'follow_genre', FILTER_SANITIZE_NUMBER_INT);
    $genreFollow = mysqli_real_escape_string($conn, $genreFollow);

  // Data Validation
  if(!FILTER_VAR($genreFollow, FILTER_VALIDATE_INT, 1)){
     $error = true;
     $genreFollowError = "La información no es válida.";
   }

   // Check if genre is followed
   $queryCheckGenre = mysqli_query($conn, "SELECT id_genre FROM follow_genres WHERE id_user='$id_user' AND id_genre='$genreFollow'");
   if(mysqli_num_rows($queryCheckGenre)>0){
     $errTyp = "danger";
     $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
     echo '<script type="text/javascript">alert("Ya sigues este género musical");</script>';
     die();
   }

   if( !$error ) {
     // Get genre names
     $queryGenres = mysqli_query($conn, "SELECT * FROM genres WHERE id_genre='$genreFollow'");
     $genres = mysqli_fetch_array($queryGenres);

     // Query update genres
     $queryGenreFollow = "UPDATE follow_genres SET id_genre='$genreFollow' WHERE id_user='$id_user' AND id_genre='0' ORDER BY id_follow_genre ASC LIMIT 1";

      if (mysqli_query($conn, $queryGenreFollow)) {
        if(mysqli_affected_rows($conn)){
          $errTyp = "success";
          $errMSG = "Información agregada con éxito";
          ?>
          <li id="genre-follow-<?=$genres['id_genre']?>" class="list-inline-item" rel="<?=$genres['id_genre']?>" ><button type="button" class="btn btn-primary btn-lg btn-border my-2"><?=$genres['name_genre']?> <i class="fas fa-times ml-5" onClick="unfollowGenre(<?=$genres['id_genre']?>)" ></i></button></li>
         <?
         }else{
           $errTyp = "danger";
           $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";?>
           <script type="text/javascript">alert('No puedes agregar más de 5 géneros');</script>
     <? }
       } else {
         $errTyp = "danger";
         $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
       }

     }
   }
?>
