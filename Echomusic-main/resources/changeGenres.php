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

    echo '<li value="">-</li>';

    foreach($arraySubGenres as $subGenres)

        {

          echo '<li class="subgeneros" rel="'.$subGenres['id_subGenre'].'" value="'.$subGenres['id_subGenre'].'">'.$subGenres['name_subGenre'].'</li>';

        }

    // echo '</select>';



}else if(empty($_POST['genre'])){

  // Print DATA

  // echo '<label for="demo-genre">Subgénero</label>';

  // echo '<select  name="subgenres" id="dropdownSubGenres">';

  echo '<li value="">-</li>';

  // echo '</select>';

}

?>

