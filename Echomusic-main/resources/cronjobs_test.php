<?php

include 'connect.php';
  include 'cronjobsMail.php';



$queryDataEvents = mysqli_query($conn, "SELECT * FROM events_private WHERE (date_event BETWEEN DATE_SUB( NOW() , INTERVAL 1 HOUR )  AND  NOW() ) AND id_user_sell > 0 AND status_event = 'confirmed' ");

$arrayDataEvents = array();

while($dataEvents = mysqli_fetch_array($queryDataEvents)){

  $arrayDataEvent[] = $dataEvents;

}

// Ingresar rating abierto en la base de datos

foreach($arrayDataEvent as $dataEvents){

  $id_user = $dataEvents['id_user_buy'];

  $id_artist = $dataEvents['id_user_sell'];

  $id_event = $dataEvents['id_event'];

  mysqli_query($conn, "INSERT INTO user_ratings (id_user, id_artist, id_event, status_rating, mail_sent) VALUES ('$id_user', '$id_artist', '$id_event', 'open', 'no')");

  unset($id_user);

  unset($id_artist);

  unset($id_event);

}



// Revisar los ratings abiertos y mandar un Correo

$queryDataRatings = mysqli_query($conn, "SELECT * FROM user_ratings LEFT JOIN users ON user_ratings.id_user = users.id_user LEFT JOIN events_private ON user_ratings.id_event = events_private.id_event WHERE user_ratings.status_rating='open' AND user_ratings.mail_sent='no'");

$arrayDataRatings = array();

while($dataRatings = mysqli_fetch_array($queryDataRatings)){

  $arrayDataRatings[] = $dataRatings;

}



foreach($arrayDataRatings as $dataRatings){

  $mail_user = $dataRatings['mail_user'];

  $fname = $dataRatings['first_name_user'];

  $lname = $dataRatings['last_name_user'];

  $nameEvent = $dataRatings['name_event'];

  $id_event = $dataRatings['id_event'];

$queryInfoArtist = mysqli_query($conn, "SELECT nick_user AS nick_user FROM users LEFT JOIN events_private ON events_private.id_user_sell = users.id_user WHERE events_private.id_event='$id_event'");

$infoArtist = mysqli_fetch_assoc($queryInfoArtist);
$nameArtist = $infoArtist['nick_user'];

 /* $text = '<p>Hola '.ucfirst($fname).' '.ucfirst($lname).'</p> <p>¿Cómo estuvo el artista de tu evento '.$nameEvent.'? </br> Para valorarlo presiona el siguiente enlace: <a href="https://echomusic.cl/rate.php?event='.$id_event.'">https://echomusic.cl/rate.php?event='.$id_event.'</a></p>

            <p>Si el artista no se presentó, por favor contáctanos de inmediato por cualquiera de nuestros medios habilitados para ello</p> <p>Equipo Echomusic</p>';*/

  $text = $cronjobmail.ucfirst($fname).' '.ucfirst($lname).$cronjobmail1.$nameEvent.$cronjobmail2.$nameArtist.$cronjobmail3.$id_event.$cronjobmail4.$id_event.$cronjobmail5.$id_event.$cronjobmail6.$nameArtist.$cronjobmail7;

  $headers = "MIME-Version: 1.0" . "\r\n";

  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

  $headers .= "From: reservas@echomusic.cl" . "\r\n";



  if(mail($mail_user, "Valora el servicio entregado", $text, $headers)){

    mysqli_query($conn, "UPDATE user_ratings SET mail_sent='yes'");

  }

}

// $headers = "MIME-Version: 1.0" . "\r\n";

// $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

// $headers .= "From: reservas@echomusic.cl" . "\r\n";

// mail("czar_cel@hotmail.com", "Correo de cronjob funcionando", "", $headers);



 ?>
