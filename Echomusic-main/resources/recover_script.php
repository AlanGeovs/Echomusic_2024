<?php



 include 'connect.php';
 include 'recovermail.php';



 $error = false;



 if( isset($_POST['recover_button']) ) {



  // prevent sql injections/ clear user invalid inputs

  $email = trim($_POST['email']);

  $email = strip_tags($email);

  $email = htmlspecialchars($email);

  $email = mysqli_real_escape_string($conn, $email);





  if(empty($email)){

   $error = true;

   $emailError = "Por favor ingresa tu correo electronico.";

  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $emailError = "Por favor ingresa un correo válido";

  }



  if($getUserQuery = mysqli_query($conn, "SELECT * FROM users WHERE mail_user='$email'")){

    if(mysqli_num_rows($getUserQuery) == 1){

      $getUser = mysqli_fetch_array($getUserQuery);

      $userid = $getUser['id_user'];

    }else{

      $error = true;

      $errTyp = 'danger';

      $errMSG = 'Usuario incorrecto.';

    }

  }else{

    $error = true;

    $errTyp = 'danger';

    $errMSG = 'Ha sucedido un error, inténtalo nuevamente.';

  }



  $date = date('Y-m-d h:i:s', time());

  $code = uniqid(mt_rand(), true);

  $codeRecovery = hash('sha256', $code);

  // if there's no error, continue to login

  if (!$error) {



    if(mysqli_query($conn, "INSERT INTO recoveries (id_user, date_recovery, status_recovery, code_recovery) VALUES ('$userid', '$date', 'open', '$codeRecovery')")){


      //$text = '<html><p>Se ha solicitado una recuperación de contraseña para una cuenta Echomusic registrada a este correo. </br> Para establecer una nueva contraseña, haz click en el siguiente enlace:</p> <a href="http://echomusic.cl/recover.php?code='.$codeRecovery.'">http://echomusic.cl/recover.php?code='.$codeRecovery.'</a></html>';

      $text = $recovermail.$codeRecovery.$recovermail1.$codeRecovery.$recovermail2.$codeRecovery.$recovermail3;

      $headers = "MIME-Version: 1.0" . "\r\n";

      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

      $headers .= "From: recuperacion@echomusic.cl" . "\r\n";

        if(mail($email, "Recuperación de contraseña EchoMusic", $text, $headers)){

          mysqli_query($conn, "UPDATE recoveries SET status_recovery='closed' WHERE id_user='$userid' AND code_recovery!='$codeRecovery'");

          unset($email);

          unset($error);

          $errTyp = 'success';

          $errMSG = 'Se ha enviado un correo para la recuperación de tu cuenta.';

        }else{

          $errTyp = "danger";

          $errMSG = "Ha sucedido un error, por favor inténtalo nuevamente.";

        }



    } else {

      $errTyp = "danger";

      $errMSG = "Ha sucedido un error, por favor inténtalo nuevamente.";

    }

  }

 }



if(isset($_GET['code'])){

  if(CheckCode($_GET['code'])==false){

    http_response_code(404);

    // include('my_404.php'); // provide your own HTML for the error page

    die();

  } else if(CheckCode($_GET['code']) == true){



    if(isset($_POST['submit_button'])){



      $error = false;



      $pass = trim($_POST['password']);

      $pass = strip_tags($pass);

      $pass = htmlspecialchars($pass);

      $pass = mysqli_real_escape_string($conn, $pass);



      $pass_ver = trim($_POST['password_verify']);

      $pass_ver = strip_tags($pass_ver);

      $pass_ver = htmlspecialchars($pass_ver);

      $pass_ver = mysqli_real_escape_string($conn, $pass_ver);



      $code = trim($_GET['code']);

      $code = strip_tags($code);

      $code = htmlspecialchars($code);

      $code = mysqli_real_escape_string($conn, $code);



      // Get user id

      if($getUserQuery = mysqli_query($conn, "SELECT * FROM recoveries WHERE code_recovery='$code'")){

        $getUser = mysqli_fetch_array($getUserQuery);

        $userid = $getUser['id_user'];

      }else{

        $error = true;

        $errTyp = 'danger';

        $errMSG = 'Ha sucedido un error, inténtalo nuevamente.';

      }



      // password validation

      if (empty($pass)){

       $error = true;

       $passError = "Por favor ingresa una contraseña";

      } else if(strlen($pass) < 6) {

       $error = true;

       $passError = "La contraseña debe tener al menos 6 caracteres";

      }

      // password verification

      if (empty($pass_ver)){

       $error = true;

       $pass_verError = "Por favor verifica tu contraseña";

      } else if($pass != $pass_ver) {

       $error = true;

       $pass_verError = "Las contraseñas no coinciden";

      }



      $password = hash('sha256', $pass);



      if( !$error ) {



       $query1 = "UPDATE users SET password_user='$password' WHERE id_user='$userid'";

       $query2 = "UPDATE recoveries SET status_recovery='closed' WHERE id_user='$userid' AND code_recovery='$code'";



       if (mysqli_query($conn, $query1)) {

         if(mysqli_query($conn, $query2)){



           $errTyp = "success";

           $errMSG = "Contraseña cambiada con éxito. Te redirigiremos al inicio de sesión.";

           header("Refresh:1; url=login.php");

        }else{

          $errTyp = "danger";

          $errMSG = "Ha sucedido un error, inténtalo de nuevo.";

        }

       } else {

        $errTyp = "danger";

        $errMSG = "Ha sucedido un error, inténtalo de nuevo.";

       }

       }

    }

  }

}



function CheckCode($code){



  include 'connect.php';



  $code = trim($code);

  $code = strip_tags($code);

  $code = htmlspecialchars($code);

  $code = mysqli_real_escape_string($conn, $code);



  $codeQuery = mysqli_query($conn, "SELECT * FROM recoveries WHERE code_recovery='$code' AND status_recovery='open'");

  if(mysqli_num_rows($codeQuery) == 1){

    $result = true;

  }else{

    $result = false;



  }

  return $result;

}

?>
