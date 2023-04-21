<?php



 include 'connect.php';

  include 'welcomemail.php';
  include 'contractMail.php';
  include 'cronjobsMail.php';
  include 'recovermail.php';
include 'eventoAceptadoMail.php';
include 'eventoRechazadoMail.php';
include 'eventoModificadoMail.php';
include 'eventoCanceladoMail.php';
include 'eventoConfirmadoMail.php';
include 'eventoPublicadoMail.php';



 $error = false;



 //Register User

 if ( isset($_POST['submit_button_mail']) ) {



  $email = trim($_POST['email']);

  $email = strip_tags($email);

  $email = htmlspecialchars($email);

  $email = mysqli_real_escape_string($conn, $email);



  $mailToSend = trim($_POST['mailToSend']);

  $mailToSend = strip_tags($mailToSend);

  $mailToSend = htmlspecialchars($mailToSend);

  $mailToSend = mysqli_real_escape_string($conn, $mailToSend);





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





  //basic email validation

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $emailError = "Por favor ingresa una dirección de correo válida";

  }



  

  if (empty($mailToSend)){

   $error = true;

   $mailToSendError = "Por favor elige un correo";

 } 


 switch($mailToSend){

   case '1':

    // Mail de Verificación
   $verify_code = "00";

   $text .= $welcomemail.$verify_code.$welcomemail1.$verify_code.$welcomemail2.$verify_code.$welcomemail3;

   $headers = "From: verificacion@echomusic.cl" . "\r\n";

   $headers = "MIME-Version: 1.0" . "\r\n";

   $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

   $headers .= "From: verificacion@echomusic.cl" . "\r\n";


    if( !$error ) {



      if(mail($email, "TITULO", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Enviado.";

      }else{

         $errTyp = "danger";

         $errMSG = "Ha sucedido un error.";

      }

    }else{

       $errTyp = "danger";

       $errMSG = "Ha sucedido un error";

    }

   break;

   case '2':

    // Mail de Reserva
      $dateNotice=" 01/01/2021 ";
      $timeNotice=" 00:00 ";

      $text = $reservamail.$dateNotice.'</b> a las <b>'.$timeNotice.$reservamail1;
      $headers = "From: verificacion@echomusic.cl" . "\r\n";

      $headers = "MIME-Version: 1.0" . "\r\n";

      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

      $headers .= "From: verificacion@echomusic.cl" . "\r\n";

    if( !$error ) {

      if(mail($email, "TITULO", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Enviado.";
      }else{

         $errTyp = "danger";

         $errMSG = "Ha sucedido un error.";

      }
        echo "<script>console.log(".$errTyp.");</script>";
    }

   break;

   case '3':

    // Mail de Evento Aceptado

      $text = $eventomail." Juanin Juan Harry ".$eventomail1;
      
      $headers = "MIME-Version: 1.0" . "\r\n";

      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

      $headers .= "From: reservas@echomusic.cl" . "\r\n";

    if( !$error ) {



      if(mail($email, "TITULO", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Enviado.";

      }else{

         $errTyp = "danger";

         $errMSG = "Ha sucedido un error.";

      }

    }else{

       $errTyp = "danger";

       $errMSG = "Ha sucedido un error";

    }

   break;

   case '4':

    // Mail de Evento Rechazado

        $text = $eventoremail." nombre artista apellido ".$eventoremail1;

        $headers = "MIME-Version: 1.0" . "\r\n";

        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headers .= "From: reservas@echomusic.cl" . "\r\n";

    if( !$error ) {



      if(mail($email, "TITULO", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Enviado.";

      }else{

         $errTyp = "danger";

         $errMSG = "Ha sucedido un error.";

      }

    }else{

       $errTyp = "danger";

       $errMSG = "Ha sucedido un error";

    }

   break;

   case '5':

    // Mail de Evento Cancelado

    $text= $eventocamail.$eventoCAAmail1." juanin juan Harry ".$eventocamail2." LOLLAPELUSA ".$eventocamail3." Por lluvia en la zona o por cuarentena...".$eventocamail4;
              
              $headers = "MIME-Version: 1.0" . "\r\n";

              $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

              $headers .= "From: reservas@echomusic.cl" . "\r\n";


    if( !$error ) {



      if(mail($email, "Evento Cancelado ", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Enviado.";

      }else{

         $errTyp = "danger";

         $errMSG = "Ha sucedido un error.";

      }

    }else{

       $errTyp = "danger";

       $errMSG = "Ha sucedido un error";

    }

   break;

   case '6':

    // Mail de Evento Confirmado
$text = $eventoconfmail."NOMBRE EVENTO".$eventoCONFAmail2.' <p style="margin: 0.5rem 1rem;"><strong> JUANIN JUAN HARRY</strong><br>Teléfono: <strong><a href="tel:+569123456">+569123456</a></strong> <br> Correo: CORREOECHO@CORRE.CL'."</p>".$eventoconfmail3.'
                    <p style="margin: 0.5rem 1rem;">
                    Nombre del Evento: <strong> LOLLAPELUSA </strong> <br>

                    Dirección del Evento: <strong> PARQUE LOTA </strong> <br>

                    Fecha del Evento: <strong> 30 FEBRERO </strong></p>'.$eventoconfmail4;

    $headers = "MIME-Version: 1.0" . "\r\n";

    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    $headers .= "From: reservas@echomusic.cl" . "\r\n";


    if( !$error ) {



      if(mail($email, "TITULO", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Enviado.";

      }else{

         $errTyp = "danger";

         $errMSG = "Ha sucedido un error.";

      }

    }else{

       $errTyp = "danger";

       $errMSG = "Ha sucedido un error";

    }

   break;

   case '7':

    // Mail de Evento Modificado

        $text = $eventomomail1." LOLLAPELUSA ".$eventomomail1;

        $headers = "MIME-Version: 1.0" . "\r\n";

        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headers .= "From: reservas@echomusic.cl" . "\r\n";


    if( !$error ) {



      if(mail($email, "Modificación de Evento", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Enviado.";

      }else{

         $errTyp = "danger";

         $errMSG = "Ha sucedido un error.";

      }

    }else{

       $errTyp = "danger";

       $errMSG = "Ha sucedido un error";

    }

   break;

   case '8':

    // Mail de Evento Publicado

      $text = $eventopubmail."LOLLAPELUSA".$eventopubmail3.'<p style="margin: 0.5rem 1rem;">
                          Nombre del Evento: <strong> LOLLAPELUSA </strong> <br>
                          Dirección del Evento: <strong> PARQUE LOTA </strong> <br>
                          Fecha del Evento: <strong>30 FEBRERO </strong></p>'.$eventopubmail4;

        $headers = "MIME-Version: 1.0" . "\r\n";

        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headers .= "From: reservas@echomusic.cl" . "\r\n";


    if( !$error ) {



      if(mail($email, "TITULO", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Enviado.";

      }else{

         $errTyp = "danger";

         $errMSG = "Ha sucedido un error.";

      }

    }else{

       $errTyp = "danger";

       $errMSG = "Ha sucedido un error";

    }

   break;

   case '9':

    // Mail de Recuperación contraseña
      $codeRecovery = "00";
      $text = $recovermail.$codeRecovery.$recovermail1.$codeRecovery.$recovermail2.$codeRecovery.$recovermail3;

      $headers = "MIME-Version: 1.0" . "\r\n";

      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

      $headers .= "From: recuperacion@echomusic.cl" . "\r\n";


    if( !$error ) {



      if(mail($email, "TITULO", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Enviado.";

      }else{

         $errTyp = "danger";

         $errMSG = "Ha sucedido un error.";

      }

    }else{

       $errTyp = "danger";

       $errMSG = "Ha sucedido un error";

    }

   break;

   case '10':

    // Mail de Valoración
     $id_event = '1';

      $text = $cronjobmail."juanito perez".$cronjobmail1."nombre evento".$cronjobmail2." nombre artista".$cronjobmail3.$id_event.$cronjobmail4.$id_event.$cronjobmail5.$id_event.$cronjobmail6." nombre artista".$cronjobmail7;

      $headers = "From: valoracion@echomusic.cl" . "\r\n";

      $headers = "MIME-Version: 1.0" . "\r\n";

      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

      $headers .= "From: valoracion@echomusic.cl" . "\r\n";

    if( !$error ) {



      if(mail($email, "TITULO", $text, $headers)){

        $errTyp = "success";

        $errMSG = "Enviado.";

      }else{

         $errTyp = "danger";

         $errMSG = "Ha sucedido un error.";

      }

    }else{

       $errTyp = "danger";

       $errMSG = "Ha sucedido un error";

    }

   break;

 }





 }

 include 'close.php';

?>

