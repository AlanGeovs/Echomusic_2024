<?php

if(isset($_SESSION['user'])){
  $userid = $_SESSION["user"];
  include 'connect.php';
  $queryFirstLogin = mysqli_query($conn, "SELECT first_login FROM users WHERE id_user='$userid'");
  $firstLoginData = mysqli_fetch_array($queryFirstLogin);

  if($firstLoginData['0'] == "yes"){
    $queryMusicianInfo = mysqli_query($conn, "SELECT * FROM type_musician");
    $queryInstrumentInfo = mysqli_query($conn, "SELECT * FROM instruments");
    $queryGenresInfo = mysqli_query($conn, "SELECT * FROM genres");
    $queryRegionsInfo = mysqli_query($conn, "SELECT * FROM regions");



    $error = false;

    if ( isset($_POST['submit_button']) ) {

      $typeMusician = trim($_POST['musician']);
      $typeMusician = strip_tags($typeMusician);
      $typeMusician = htmlspecialchars($typeMusician);
      $typeMusician = mysqli_real_escape_string($conn, $typeMusician);

      // Validate instrument
      if(isset($_POST['instrument']) && $typeMusician == 4){
        $instrument = $_POST['instrument'];
        if($instrument == 0){
          $error = true;
          $instrumentError = "Por favor elige un instrumento.";
        }
      }

      $genre = trim($_POST['genre']);
      $genre = strip_tags($genre);
      $genre = htmlspecialchars($genre);
      $genre = mysqli_real_escape_string($conn, $genre);

      $desc = trim($_POST['description_text']);
      $desc = strip_tags($desc);
      $desc = htmlspecialchars($desc);
      $desc = mysqli_real_escape_string($conn, $desc);

      $region = trim($_POST['region']);
      $region = strip_tags($region);
      $region = htmlspecialchars($region);
      $region = mysqli_real_escape_string($conn, $region);

      $comuna = trim($_POST['comuna']);
      $comuna = strip_tags($comuna);
      $comuna = htmlspecialchars($comuna);
      $comuna = mysqli_real_escape_string($conn, $comuna);

      // data validation
      if (empty($typeMusician)) {
       $error = true;
       $musicianError = "Por favor elige el tipo de artista";
     }else if(!FILTER_VAR($typeMusician, FILTER_VALIDATE_INT, 1)){
        $error = true;
        $musicianError = "El tipo de artista no es válido.";
      }

      if (empty($genre)) {
       $error = true;
       $genreError = "Por favor elige el género musical";
     }else if(!FILTER_VAR($genre, FILTER_VALIDATE_INT, 1)){
        $error = true;
        $genreError = "El género musical no es válido.";
      }

      if (empty($region)) {
       $error = true;
       $regionError = "Por favor elige una región";
     }else if(!FILTER_VAR($region, FILTER_VALIDATE_INT, 1)){
        $error = true;
        $regionError = "La región no es válida.";
      }

      if (empty($comuna)) {
       $error = true;
       $comunaError = "Por favor elige una comuna";
     }else if(!FILTER_VAR($comuna, FILTER_VALIDATE_INT, 1)){
        $error = true;
        $comunaError = "La comuna no es válida.";
      }

      if (strlen($desc) < 1) {
       $error = true;
       $descError = "La descripción debe tener más de 1 caracteres.";
     }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$desc)) {
       $error = true;
       $descError = "La descripción solo puede contener letras y números";
     }else if (mb_strlen($desc) > 501) {
       $error = true;
       $descError = "La descripción debe tener menos de 500 caracteres";
      }

     // if there's no error, insert data
    if( !$error ) {

      $query1 = "UPDATE users SET id_musician='$typeMusician', id_region='$region', id_city='$comuna' WHERE id_user='$userid'";
      $query2 = "INSERT INTO genre_user(id_genre,id_user) VALUES('$genre','$userid')";
      $query3 = "INSERT INTO desc_user(id_user,desc_user) VALUES('$userid','$desc')";
      $query4 = "INSERT INTO subGenres_user(id_subGenre,id_user,subGenre_slot) VALUES('0','$userid','1'),('0','$userid','2'),('0','$userid','3')";

      $submitDataQuery = implode(";", array_filter([$query1, $query2, $query3, $query4]));

          if (mysqli_multi_query($conn, $submitDataQuery)) {

            while (mysqli_next_result($conn)) // flush multi_queries
              {
                  if (!mysqli_more_results($conn)) break;
              }

                if(isset($instrument)){
                  $query5 = "UPDATE users SET id_instrument='$instrument' WHERE id_user='$userid'";

                  if(mysqli_query($conn, $query5)){

                    mysqli_query($conn, "INSERT INTO plans(id_user, id_name_plan, value_plan, desc_plan, active, slot_plan) VALUES('$userid','0','0','','none','1'), ('$userid','0','0','','none','2'), ('$userid','0','0','','none','3')");

                    $errTyp = "success";
                    $errMSG = "Información agregada con éxito + instrumento";
                    unset($type_musician);
                    unset($genre);
                    unset($region);
                    unset($comuna);
                    unset($desc);
                    unset($audio);
                    mysqli_query($conn, "UPDATE users SET first_login='no' WHERE id_user='$userid'");
                    mysqli_query($conn, "INSERT INTO follow_genres (id_user, id_genre, id_slot) VALUES ('$userid', '$genre', '1'), ('$userid', '0', '2'), ('$userid', '0', '3'), ('$userid', '0', '4'), ('$userid', '0', '5')");
                    // header ('Location: profile.php?userid='.$userid);
                    header ('Location: profile.php?userid='.$userid.'');
                  }
                }
                else{
               mysqli_query($conn, "INSERT INTO plans(id_user, id_name_plan, value_plan, desc_plan, active, slot_plan) VALUES('$userid','0','0','','none','1'), ('$userid','0','0','','none','2'), ('$userid','0','0','','none','3')");
               $errTyp = "success";
               $errMSG = "Información agregada con éxito";
               unset($type_musician);
               unset($genre);
               unset($region);
               unset($comuna);
               unset($desc);
               unset($audio);
               mysqli_query($conn, "UPDATE users SET first_login='no' WHERE id_user='$userid'");
               mysqli_query($conn, "INSERT INTO follow_genres (id_user, id_genre, id_slot) VALUES ('$userid', '$genre', '1'), ('$userid', '0', '2'), ('$userid', '0', '3'), ('$userid', '0', '4'), ('$userid', '0', '5')");
               // header ('Location: profile.php?userid='.$userid);
               header ('Location: profile.php?userid='.$userid.'');
              }

      }
      else {
       $errTyp = "danger";
       $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
      }
    }else {
     $errTyp = "danger";
     $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
    }

    }
  } else if($firstLoginData['0'] == "no"){
    // header('Location: profile.php?userid='.$_SESSION['user']);
    header('Location: dashboard.php');
    die();
    }
}
else {
  header('Location: index.php');
  die();
}
 ?>
