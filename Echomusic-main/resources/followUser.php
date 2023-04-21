<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';
include 'nuevoSeguidorMail.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

if(isset($_POST['id']) && !empty($_POST['id'])) {
  $id_user = $_SESSION['user'];
  $id_artist = trim($_POST['id']);
  $id_artist = strip_tags($id_artist);
  $id_artist = htmlspecialchars($id_artist);
  $id_artist = mysqli_real_escape_string($conn, $id_artist);

  $queryDataArtist = mysqli_query($conn, "SELECT mail_user, nick_user FROM users WHERE id_user='$id_artist'");
  $arrayDataArtist = mysqli_fetch_array($queryDataArtist);

  $queryFollowCheck = mysqli_query($conn, "SELECT * FROM follow_users WHERE id_user='$id_user' AND id_artist='$id_artist'");
  if(mysqli_num_rows($queryFollowCheck)>=1){
    die();
  } else if(mysqli_query($conn,"INSERT INTO follow_users (id_user, id_artist) VALUES ('$id_user', '$id_artist')")){

    $textUser = $nuevoSeguidorMail.$arrayDataArtist['nick_user'].$nuevoSeguidorMail1;

    $mail = new PHPMailer();
    $mail->Encoding = 'base64';
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);
    $mail->SetFrom('comunicaciones@echomusic.cl', 'EchoMusic'); //Name is optional
    $mail->Subject   = 'Tienes un nuevo seguidor.';
    $mail->Body     = $textUser;
    $mail->AddAddress($arrayDataArtist['mail_user']);
    $mail->send();

    $data = "success";
    echo $data;
  }
}
?>
