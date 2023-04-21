<?php
 define('ROOT_PATH', dirname(__DIR__) . '/');

 include 'connect.php';
 include (ROOT_PATH.'vendor/autoload.php');

 // it will never let you open index(login) page if session is set
 // if ( isset($_SESSION['user'])!="" ) {
 //  header("Location: profile.php?userid=".$_SESSION['user']);
 //  exit;
 // }

 $error = false;

 if( isset($_POST['login_button']) ) {

  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = mysqli_real_escape_string($conn, $email);

  $pass = trim($_POST['password']);
  $pass = strip_tags($pass);
  $pass = mysqli_real_escape_string($conn, $pass);


  if(empty($email)){
   $error = true;
   $emailError = "Por favor ingresa tu correo electronico.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Por favor ingresa un correo válido";
  }

  if(empty($pass)){
   $error = true;
   $passError = "Por favor ingresa tu contraseña.";
  }

  // if there's no error, continue to login
  if (!$error) {
   $password = hash('sha256', $pass); // password hashing using SHA256
   $res=mysqli_query($conn, "SELECT * FROM users WHERE mail_user='$email' AND method_login='1'");
   $row=mysqli_fetch_array($res);
   $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

// Check if password is correct and user is verified
   if( $count == 1 && $row['password_user']==$password && $row['verified']=='yes') {
    $_SESSION['user'] = $row['id_user'];
    $_SESSION['type_user'] = $row['id_type_user'];
    if($row['id_type_user'] == '2'){
      $_SESSION['name_user'] = ucfirst($row['first_name_user']);
    }elseif($row['id_type_user'] == '1'){
      $_SESSION['name_user'] = ucfirst($row['nick_user']);
    }
    $userid = $row['id_user'];

    // Insert login log DB
      mysqli_query($conn, "INSERT INTO user_login (id_user) VALUES ('$userid')");

    // Check what type of user is
      if($row['id_type_user'] == 1){
        // Check if First Login
        if($row['first_login'] == "yes"){
          header("Location: first_login.php");
          die();
        }
        else if($row['first_login'] == "no"){
          // Check if redirect plans
          if(isset($_SESSION['user_contract_redirect'])){
            header('Location: profile.php?userid='.$_SESSION['user_contract_redirect'].'#pricing');
            unset($_SESSION['user_contract_redirect']);
          } else if(isset($_GET['location'])){
            $headTo = trim($_GET['location']);
            $headTo = strip_tags($headTo);
            $headTo = htmlspecialchars($headTo);

            header('Location: '.$headTo.'');
            die();
          } else{
            // header('Location: index.php');
            header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
            die();
          }
        }
      }
      else if($row['id_type_user'] == 2){
        // Check if First Login
        if($row['first_login'] == "yes"){
          // Update First login Data (Update first login and set follow genres slots)
          if(mysqli_query($conn, "UPDATE users SET first_login = 'no' WHERE id_user='$userid'")){
            if(mysqli_query($conn, "INSERT INTO follow_genres (id_user, id_genre, id_slot) VALUES ('$userid', '0', '1'), ('$userid', '0', '2'), ('$userid', '0', '3'), ('$userid', '0', '4'), ('$userid', '0', '5')")){
              // Check if redirect
              if(isset($_GET['location'])){
                $headTo = trim($_GET['location']);
                $headTo = strip_tags($headTo);
                $headTo = htmlspecialchars($headTo);

                header('Location:'.$headTo.'');

              } else{
                // header('Location: dashboard.php');
                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
              }
            }else{
              $errTyp = "danger";
              $errMSG = "Ha sucedido un error, por favor inténtalo nuevamente.";
            }
          } else {
            $errTyp = "danger";
            $errMSG = "Ha sucedido un error, por favor inténtalo nuevamente.";
          }
        }
        else if($row['first_login'] == "no"){
          // Check if redirect plans
          if(isset($_GET['location'])){
            $headTo = trim($_GET['location']);
            $headTo = strip_tags($headTo);
            $headTo = htmlspecialchars($headTo);

            // header('Location: '.$headTo.'');
            header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
            die();

          } else{
            // header('Location: index.php');
            header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
            die();
          }
        }
      }
  }else{
    $errTyp = "loginError";
    $errMSG = "Correo o contraseña incorrectos";
  }
}else{
  $errTyp = "loginError";
  $errMSG = "Los datos ingresados son inválidos";
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
       $userDataquery = "SELECT id_user,id_type_user,first_name_user, mail_user, method_login FROM users WHERE mail_user='$email'";
       $result = mysqli_query($conn, $userDataquery);
       $count = mysqli_num_rows($result);
       $userArray = mysqli_fetch_array($result);

        if($count!=0){

          if($userArray['method_login']=='2'){

            $userid = $userArray['id_user'];

            $_SESSION['user'] = $userid;
            $_SESSION['type_user'] = $userArray['id_type_user'];
            $_SESSION['name_user'] = ucfirst($userArray['first_name_user']);

            if(isset($_GET['location'])){
              $headTo = trim($_GET['location']);
              $headTo = strip_tags($headTo);
              $headTo = htmlspecialchars($headTo);

              // header('Location: '.$headTo.'');
              header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
              die();

            } else{
              // header('Location: index.php');
              header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
              die();
            }

          }elseif($userArray['method_login']=='1'){


            $redirect = $_SERVER['REQUEST_URI'];

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
                            alert('La dirección de correo ingresada ya posee una cuenta EchoMusic.');
                          </script>
                          <script>
                              window.onLoadCallback = function(){
                                  gapi.load('auth2', function() {
                                      gapi.auth2.init().then(function(){
                                          var auth2 = gapi.auth2.getAuthInstance();
                                          auth2.signOut().then(function () {
                                              document.location.href = '".$redirect."';
                                          });
                                      });
                                  });
                              };
                          </script>
                      </body>
                  </html>";
              die();

          }


        }elseif($count==0){

          $query1 = "INSERT INTO users(mail_user,last_name_user,first_name_user,id_type_user,first_login,method_login,verified) VALUES('$email','$last_name','$first_name','$type_user','no', '$login_method','yes')";

            if (mysqli_query($conn, $query1)) {

              $queryUser_id = mysqli_query($conn, "SELECT id_user,id_type_user,first_name_user FROM users WHERE id_user=(SELECT max(id_user) FROM users) AND mail_user='$email'");
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

                  // header('Location: '.$headTo.'');
                  header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                  die();

                } else{
                  // header('Location: index.php');
                  header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
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

        }
      }


    } else {
      // Invalid ID token
      $errTyp = "danger";
      $errMSG = "Token de Google inválido.";
    }
  }
?>
