<?php



 if( isset($_SESSION['user'])!="" ){
   switch($_SESSION['type_user']){
     case '1':
       header("Location: profile.php?userid=".$_SESSION['user']);
     break;
     case '2':
       header("Location: index.php");
     break;
    }
 }

 include 'connect.php';
 include 'welcomemail.php';
 require 'vendor/autoload.php';



 $error = false;

// Reenvio correo

 if(isset($_POST['resend'])){

   // $verificationCheckQuery = mysqli_query($conn, "SELECT verificatio");

   $email = $_SESSION['email'];

   $verify_code = $_SESSION['code'];


   $text = $welcomemail.$verify_code.$welcomemail1.$verify_code.$welcomemail2.$verify_code.$welcomemail3;

   $headers = "From: verificacion@echomusic.cl" . "\r\n";

   $headers = "MIME-Version: 1.0" . "\r\n";

   $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

   $headers .= "From: verificacion@echomusic.cl" . "\r\n";
   $headers .= "Bcc: copiaregistro@echomusic.cl\r\n";

   mail($email, "Verificación de Cuenta EchoMusic", $text, $headers);

   $errTyp = "success";

   $errMSG = "Correo de verificación reenviado.";

 }



// Eliminar session y registrar de nuevo

if(isset($_POST['register_form_submit'])){

  session_unset();

  session_destroy();

  unset($errTyp);

  unset($errMSG);

}



//Register Artist

 if ( isset($_POST['register_button_musician']) ) {



  // clean user inputs to prevent sql injections

  $first_name = trim($_POST['first_name']);

  $first_name = strip_tags($first_name);

  $first_name = htmlspecialchars($first_name);

  $first_name = mysqli_real_escape_string($conn, $first_name);



  $last_name = trim($_POST['last_name']);

  $last_name = strip_tags($last_name);

  $last_name = htmlspecialchars($last_name);

  $last_name = mysqli_real_escape_string($conn, $last_name);



  $nick = trim($_POST['nick']);

  $nick = strip_tags($nick);

  $nick = htmlspecialchars($nick);

  $nick = mysqli_real_escape_string($conn, $nick);



  $email = trim($_POST['email']);

  $email = strip_tags($email);

  $email = htmlspecialchars($email);

  $email = mysqli_real_escape_string($conn, $email);



  $pass = trim($_POST['password']);

  $pass = strip_tags($pass);

  $pass = htmlspecialchars($pass);

  $pass = mysqli_real_escape_string($conn, $pass);



  $pass_ver = trim($_POST['password_verify']);

  $pass_ver = strip_tags($pass_ver);

  $pass_ver = htmlspecialchars($pass_ver);

  $pass_ver = mysqli_real_escape_string($conn, $pass_ver);



// reCaptcha start

  $g_recaptcha = $_POST['g-recaptcha-response'];



  $data = [

      'secret' => '6Ld2EqUZAAAAAMdpggqnsIwwKaSWzbxmja8XYNZj',

      'response' => $g_recaptcha,

  ];



  $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);



  // execute!

  $response = curl_exec($ch);



  // close the connection, release resources used

  curl_close($ch);



  $g_recaptcha_response = json_decode($response, true);



  if($g_recaptcha_response['success'] == false){

    $error = true;

    $reCaptchaError = "Error, por favor vuelve a intentarlo";

  }



  // reCaptcha End



  $type_user = '1';





  // basic first_name validation

  if (empty($first_name)) {

   $error = true;

   $first_nameError = "Por favor ingresa tu nombre.";

 } else if (strlen($first_name) < 3) {

   $error = true;

   $first_nameError = "El nombre debe tener más de 3 caracteres";

 } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$first_name)) {

   $error = true;

   $first_nameError = "El nombre solo puede contener letras";

  }

  //basic last_name validation

  if (empty($last_name)) {

   $error = true;

   $last_nameError = "Por favor ingresa tu apellido.";

 } else if (strlen($last_name) < 3) {

   $error = true;

   $last_nameError = "El apellido debe tener más de 3 caracteres";

 } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$last_name)) {

   $error = true;

   $last_nameError = "El apellido solo puede contener letras";

  }

  //basic nick validation

  if (empty($nick)) {

   $error = true;

   $nickError = "Por favor ingresa un Nombre de Usuario.";

 } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$nick)) {

   $error = true;

   $nickError = "El Nombre de Usuario solo puede contener letras y/o números";

   }else{

    // check email exist or not

    $nickquery = "SELECT nick_user FROM users WHERE nick_user='$nick'";

    $result = mysqli_query($conn, $nickquery);

    $count = mysqli_num_rows($result);

    if($count!=0){

     $error = true;

     $nickError = "El nombre de banda o artista ya está registrado.";

    }
  }



  //basic email validation

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $emailError = "Por favor ingresa una dirección de correo válida";

  } else {

   // check email exist or not

   $mailquery = "SELECT mail_user FROM users WHERE mail_user='$email'";

   $result = mysqli_query($conn, $mailquery);

   $count = mysqli_num_rows($result);

   if($count!=0){

    $error = true;

    $emailError = "La dirección de correo ingresada ya esta en uso.";

   }

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



  // password encrypt using SHA256();

  $password = hash('sha256', $pass);



  // Change when implementing system

  // $password = password_hash($pass, PASSWORD_DEFAULT);



  //verify code

  $code = uniqid(mt_rand(), true);

  $verify_code = hash('sha256', $code);

  //Text email

  //$text = '<html><p>2 Para verificar tu cuenta Echomusic haz click en el siguiente enlace:</p> <a href="https://qa.echomusic.cl/verify.php?code='.$verify_code.'">https://qa.echomusic.cl/verify.php?code='.$verify_code.'</a></html>';
   $text = $welcomemail.$verify_code.$welcomemail1.$verify_code.$welcomemail2.$verify_code.$welcomemail3;

  $headers = "From: verificacion@echomusic.cl" . "\r\n";

  $headers = "MIME-Version: 1.0" . "\r\n";

  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

  $headers .= "From: verificacion@echomusic.cl" . "\r\n";
  $headers .= "Bcc: copiaregistro@echomusic.cl\r\n";

  // if there's no error, continue to signup

  if( !$error ) {



   $query = "INSERT INTO users(mail_user,password_user,last_name_user,first_name_user,id_type_user,nick_user,first_login,data_ready,plan_ready,verify_code) VALUES('$email','$password','$last_name','$first_name','$type_user','$nick','yes','no','no','$verify_code')";

   //$res = mysqli_query($conn, $query);



   if (mysqli_query($conn, $query)) {

    mail($email, "Verificación de Cuenta EchoMusic", $text, $headers);

    $errTyp = "success";

    $errMSG = "Registro exitoso. Se te ha enviado un correo para verificar tu cuenta.";

    unset($first_name);

    unset($last_name);

    unset($nick);

    $_SESSION['email'] = $email;

    $_SESSION['code'] = $verify_code;

    unset($pass);

   } else {

    $errTyp = "danger";

    $errMSG = "Ha sucedido un error, inténtalo de nuevo.";

   }

  }else {

   $errTyp = "danger";

   $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

  }





 }



 //Register User

 if ( isset($_POST['register_button_user']) ) {



  // clean user inputs to prevent sql injections

  $first_name = trim($_POST['first_name']);

  $first_name = strip_tags($first_name);

  $first_name = htmlspecialchars($first_name);

  $first_name = mysqli_real_escape_string($conn, $first_name);



  $last_name = trim($_POST['last_name']);

  $last_name = strip_tags($last_name);

  $last_name = htmlspecialchars($last_name);

  $last_name = mysqli_real_escape_string($conn, $last_name);



  $email = trim($_POST['email']);

  $email = strip_tags($email);

  $email = htmlspecialchars($email);

  $email = mysqli_real_escape_string($conn, $email);



  $pass = trim($_POST['password']);

  $pass = strip_tags($pass);

  $pass = htmlspecialchars($pass);

  $pass = mysqli_real_escape_string($conn, $pass);



  $pass_ver = trim($_POST['password_verify']);

  $pass_ver = strip_tags($pass_ver);

  $pass_ver = htmlspecialchars($pass_ver);

  $pass_ver = mysqli_real_escape_string($conn, $pass_ver);



  // reCaptcha start

    $g_recaptcha = $_POST['g-recaptcha-response'];



    $data = [

        'secret' => '6Ld2EqUZAAAAAMdpggqnsIwwKaSWzbxmja8XYNZj',

        'response' => $g_recaptcha,

    ];



    $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);



    // execute!

    $response = curl_exec($ch);



    // close the connection, release resources used

    curl_close($ch);



    $g_recaptcha_response = json_decode($response, true);



    if($g_recaptcha_response['success'] == false){

      $error = true;

      $reCaptchaError = "Error, por favor vuelve a intentarlo";

    }



    // reCaptcha End



  $type_user = '2';





  // basic first_name validation

  if (empty($first_name)) {

   $error = true;

   $first_nameError = "Por favor ingresa tu nombre.";

 } else if (strlen($first_name) < 3) {

   $error = true;

   $first_nameError = "El nombre debe tener más de 3 caracteres";

 } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$first_name)) {

   $error = true;

   $first_nameError = "El nombre solo puede contener letras";

  }

  //basic last_name validation

  if (empty($last_name)) {

   $error = true;

   $lastnameError = "Por favor ingresa tu apellido.";

 } else if (strlen($last_name) < 3) {

   $error = true;

   $last_nameError = "El apellido debe tener más de 3 caracteres";

 } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$last_name)) {

   $error = true;

   $last_nameError = "El apellido solo puede contener letras";

  }



  //basic email validation

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $emailError = "Por favor ingresa una dirección de correo válida";

  } else {

   // check email exist or not

   $mailquery = "SELECT mail_user FROM users WHERE mail_user='$email'";

   $result = mysqli_query($conn, $mailquery);

   $count = mysqli_num_rows($result);

   if($count!=0){

    $error = true;

    $emailError = "La dirección de correo ingresada ya esta en uso.";

   }

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



  // password encrypt using SHA256();

  $password = hash('sha256', $pass);

  //verify code

  $code = uniqid(mt_rand(), true);

  $verify_code = hash('sha256', $code);

  //Text email

  //$text = '<html><p>3 Para verificar tu cuenta Echomusic haz click en el siguiente enlace:</p> <a href="https://qa.echomusic.cl/verify.php?code='.$verify_code.'">https://qa.echomusic.cl/verify.php?code='.$verify_code.'</a></html>';
   $text = $welcomemail.$verify_code.$welcomemail1.$verify_code.$welcomemail2.$verify_code.$welcomemail3;



  $headers = "MIME-Version: 1.0" . "\r\n";

  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

  $headers .= "From: verificacion@echomusic.cl" . "\r\n";
  $headers .= "Bcc: copiaregistro@echomusic.cl\r\n";

  // if there's no error, continue to signup

  if( !$error ) {



   $query1 = "INSERT INTO users(mail_user,password_user,last_name_user,first_name_user,id_type_user,first_login,verify_code) VALUES('$email','$password','$last_name','$first_name','$type_user','yes','$verify_code')";



   //$res = mysqli_query($conn, $query);



   if (mysqli_query($conn, $query1)) {

    mail($email, "Verificación de Cuenta EchoMusic", $text, $headers);

    $errTyp = "success";

    $errMSG = "Registro exitoso. Se ha enviado un correo para verificar tu cuenta.";

    unset($first_name);

    unset($last_name);

    $_SESSION['email'] = $email;

    $_SESSION['code'] = $verify_code;

    unset($pass);

   } else {

    $errTyp = "danger";

    $errMSG = "Ha sucedido un error, inténtalo de nuevo.";

   }

  }else{

     $errTyp = "danger";

     $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

  }

 }

// Register google
 if(isset($_POST['googleID_token'])){

   // Get $id_token via HTTPS POST.
   $id_token = trim($_POST['googleID_token']);
   $id_token = mysqli_real_escape_string($conn, $id_token);


   $client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
   $payload = $client->verifyIdToken($id_token);
   if ($payload) {
     $userid = $payload['sub'];

     $first_name = $payload['given_name'];
     $last_name = $payload['family_name'];
     $email = $payload['email'];
     $type_user = '2';
     $login_method = '2';


     if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

      $error = true;
      $emailError = "Por favor ingresa una dirección de correo válida";

     } else {

      // check email exist or not
      $mailquery = "SELECT mail_user FROM users WHERE mail_user='$email'";
      $result = mysqli_query($conn, $mailquery);
      $count = mysqli_num_rows($result);

      if($count!=0){

       $error = true;
       $emailError = "La dirección de correo ingresada ya esta en uso.";


        session_start();
        session_unset();
        session_destroy();
        echo "
              <html>
                  <head>
                      <meta name='google-signin-client_id' content='958916104006-d2ev1j2u6lvkognvhjroljlcs8mhbbrl.apps.googleusercontent.com'>
                  </head>
                  <body>
                      <script src='https://apis.google.com/js/platform.js?onload=onLoadCallback' async defer></script>
                      <script>
                        alert('La dirección de correo ingresada ya esta en uso.');
                      </script>
                      <script>
                          window.onLoadCallback = function(){
                              gapi.load('auth2', function() {
                                  gapi.auth2.init().then(function(){
                                      var auth2 = gapi.auth2.getAuthInstance();
                                      auth2.signOut().then(function () {
                                          document.location.href = 'register.php';
                                      });
                                  });
                              });
                          };
                      </script>
                  </body>
              </html>";
          die();

      }
     }

     $query1 = "INSERT INTO users(mail_user,last_name_user,first_name_user,id_type_user,first_login,method_login) VALUES('$email','$last_name','$first_name','$type_user','no', '$login_method')";

     if(!$error){
       if (mysqli_query($conn, $query1)) {

         $queryUser_id = mysqli_query($conn, "SELECT id_user,id_type_user,first_name_user FROM users WHERE id_user=(SELECT max(id_user) FROM users)");
         $userArray = mysqli_fetch_array($queryUser_id);
         $userid = $userArray['id_user'];

         if(mysqli_query($conn, "INSERT INTO follow_genres (id_user, id_genre, id_slot) VALUES ('$userid', '0', '1'), ('$userid', '0', '2'), ('$userid', '0', '3'), ('$userid', '0', '4'), ('$userid', '0', '5')")){

            $_SESSION['user'] = $userid;
            $_SESSION['type_user'] = $userArray['id_type_user'];
            $_SESSION['name_user'] = ucfirst($userArray['first_name_user']);
           // Check if redirect
           if(isset($_GET['location'])){

             $headTo = trim($_GET['location']);
             $headTo = strip_tags($headTo);
             $headTo = htmlspecialchars($headTo);
             header('Location:'.$headTo.'');
             die();

           } else{

             $errTyp = "success";
             $errMSG = "Registro exitoso. Se ha enviado un correo para verificar tu cuenta.";
             header("Location: https://qa.echomusic.cl");
             die();

           }

         }else{
           $errTyp = "danger";
           $errMSG = "Ha sucedido un error, por favor inténtalo nuevamente.";
         }

       } else {

        $errTyp = "danger";
        $errMSG = "Ha sucedido un error, inténtalo de nuevo.";

       }
     } else {

      $errTyp = "danger";
      $errMSG = "Ha sucedido un error, inténtalo de nuevo.";

     }


   } else {
     // Invalid ID token
     $errTyp = "danger";
     $errMSG = "Token de Google inválido.";
   }
 }

 include 'close.php';

?>
