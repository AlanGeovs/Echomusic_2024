<?php
include 'connect.php';
if(!empty($_GET['code'])){

  $code = trim($_GET['code']);
  $code = strip_tags($code);
  $code = htmlspecialchars($code);
  $code = mysqli_real_escape_string($conn, $code);

  $userQuery = mysqli_query($conn, "SELECT id_user FROM users WHERE verify_code='$code' AND verified='no'");

  if(mysqli_num_rows($userQuery)>0){
    if(!empty($_GET['code']) && isset($_GET['code'])){

      $query1 = "UPDATE users SET verified='yes' WHERE verify_code='$code'";
      mysqli_query($conn, $query1);
      if(mysqli_affected_rows($conn) > 0){
        $errTyp = "success";
        // $errMSG = "Verificación exitosa. Redirigiendo...";
        unset($code);
        // header( "refresh:3;url=login.php" );
      }else{
        $errTyp = "danger";
        // $errMSG = "Ha sucedido un error, inténtalo de nuevo.";
        unset($code);
      }
    }
  }else{
    $errTyp = "danger";
    $errMSG = "Esta cuenta ya ha sido verificada.";
    // header( "refresh:3;url=login.php" );
    unset($code);
  }
}else{
  header('HTTP/1.1 403 Forbidden');
  die();
}
 ?>
