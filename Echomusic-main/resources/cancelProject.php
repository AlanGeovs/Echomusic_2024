<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';
// Likes
  if(isset($_POST['cancelProject']) && $_POST['cancelProject']!=''){
    $userid = $_SESSION['user'];

   if( !$error ) {

      $queryCancelProject = "UPDATE projects_crowdfunding SET status_project='4' WHERE id_user='$userid' AND status_project IN ('0','1')";

      if (mysqli_query($conn, $queryCancelProject)) {
        if(mysqli_affected_rows($conn)){
          $errTyp = "success";
          echo $errTyp;
         }else{
           $errTyp = "danger";
           echo $errTyp;
         }
       } else {
         $errTyp = "danger";
         echo $errTyp;
       }
   }else{
       $errTyp = "danger";
       echo $errTyp;
   }
 }
?>
