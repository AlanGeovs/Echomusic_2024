<?php

include 'connect.php';

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

if(isset($_POST['genre']) && !empty($_POST['genre'])) {

  $genre = $_POST['genre'];

  $genre = mysqli_real_escape_string($conn, $genre);



     $querySubGenres = mysqli_query($conn, "SELECT * FROM genres_subs LEFT JOIN sub_genres ON genres_subs.id_subGenre=sub_genres.id_subGenre WHERE id_genre='$genre'");

     $arraySubGenres = array();

     while($subGenres = mysqli_fetch_array($querySubGenres)){

       $arraySubGenres[] = $subGenres;

     }



    // Print DATA

    // echo '<label for="demo-genre">Subgénero</label>';

    // echo '<select  name="subgenres" id="dropdownSubGenres">';

    echo '<option value="">-</option>';

    foreach($arraySubGenres as $subGenres)

        {

          echo '<option value="'.$subGenres['id_subGenre'].'">'.$subGenres['name_subGenre'].'</option>';

        }

    // echo '</select>';



}else if(empty($_POST['genre'])){

  // Print DATA

  // echo '<label for="demo-genre">Subgénero</label>';

  // echo '<select  name="subgenres" id="dropdownSubGenres">';

  echo '<option value="">-</option>';

  // echo '</select>';

}

?>

