<?php

include 'connect.php';
include 'suscripTicketMail.php';
require './vendor/autoload.php';
use Transbank\Webpay\WebpayPlus\Transaction;

// Turn Off and On

// header("location: alpha_test.php");

// die();

// PAGO DE EVENTOS STREAMING

// Random str function
   function random_str(
       int $length = 64,
       string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
   ): string {
       if ($length < 1) {
           throw new \RangeException("Length must be a positive integer");
       }
       $pieces = [];
       $max = mb_strlen($keyspace, '8bit') - 1;
       for ($i = 0; $i < $length; ++$i) {
           $pieces []= $keyspace[random_int(0, $max)];
       }
       return implode('', $pieces);
   }

if(isset($_SESSION['user']) && $_SESSION['user']!=''){
  if(isset($_GET['streaming'])){
    $userid = $_SESSION['user'];
    $addedValueFee = 0;

    if(FILTER_INPUT(INPUT_GET, 'streaming', FILTER_VALIDATE_INT,1)){
      $idEvent = trim($_GET['streaming']);
      $idEvent = mysqli_real_escape_string($conn, $idEvent);

      // Get url breadcrumb
      $breadCrumbUrl = "https://echomusic.cl/event.php?streaming=".$idEvent;
    }else{
      header('HTTP/1.1 403 Forbidden');
      die();
    }


    $eventType = 4;
  // Data event
    $queryEventData = mysqli_query($conn, "SELECT * FROM events_streaming WHERE id_event='$idEvent'");
    $arrayEventData = mysqli_fetch_array($queryEventData);

    $dateEventNotice = date_create($arrayEventData['date_event']);

    $dateNotice = DATE_FORMAT($dateEventNotice, 'd-m-Y');

    $dateEventMail = DATE_FORMAT($dateEventNotice, 'd/m/Y');
    $timeEventMail = DATE_FORMAT($dateEventNotice, 'H:i');

    $timeNotice = DATE_FORMAT($dateEventNotice, 'H:i');

// Data user
    $queryDataUser = mysqli_query($conn, "SELECT id_user, mail_user, first_name_user, last_name_user FROM users WHERE id_user='$userid'");
    $arrayDataUser = mysqli_fetch_array($queryDataUser);

  // Check audience
    $queryAudience = mysqli_query($conn, "SELECT COUNT(*) FROM subscribes_streaming WHERE id_event_streaming='$idEvent' AND subscribe_status='1'");
    $countAudience = mysqli_fetch_assoc($queryAudience)['COUNT(*)'];
    $totalAudience = $arrayEventData['audience_event'];

  // Check entradas disponibles
    if($totalAudience <= $countAudience){
      $audienceComplete = true;
      $error = true;
      $errMSG= "No existen entradas disponibles.";
    }


    // Variables

    $amountPlan = $arrayEventData['value'];

    $amountCommission = $arrayEventData['value_commission'];

    $totalTransaction = $amountPlan+$amountCommission+$addedValue+$addedValueFee;

    $dateTransaction = date('Y-m-d H:i:s', time());

// PAGO DE EVENTOS PRESENCIALES
  if(isset($_POST['submit_data'])){

        if(!empty($_POST['addedValue'])){
          if($addedValue = FILTER_INPUT(INPUT_POST, 'addedValue', FILTER_SANITIZE_NUMBER_INT)){
            if(FILTER_VAR($addedValue, FILTER_VALIDATE_INT)==FALSE){
              $error = true;
              $errMSG= "Valor de donación inválido.";
            }else{
              $addedValue = mysqli_real_escape_string($conn, $addedValue);
              $addedValue = str_replace(".", "",$addedValue);
              // Generate Fee
              $fee = 10;
              $a = $addedValue / 100;
              $a = $a * $fee;
              $addedValueFee = intval($a);
              $addedValue = intval($addedValue);
            }
          }else{
            $error = true;
            $errMSG= "Valor de donación inválido.";
          }
        }else{
          $addedValue = 0;
          $addedValueFee = 0;
        }



    // Check discount Code

    if(!empty($_POST['discountCode'])){

      $discountCode = trim($_POST['discountCode']);
      $discountCode = strip_tags($discountCode);
      $discountCode = mysqli_real_escape_string($conn, $discountCode);
      $getPromoCode = mysqli_query($conn, "SELECT * FROM promo_codes WHERE promo_code='$discountCode' AND date_expiration_promo <= NOW()");


      if(mysqli_num_rows($getPromoCode)>0){

        $arrayPromoCode = mysqli_fetch_array($getPromoCode);
        $amountPromoCode = $arrayPromoCode['promo_amount'];

        $discountValue = ($totalTransaction / 100)*$amountPromoCode;
        $totalTransaction = $totalTransaction - $discountValue;

      }
    }

  $amountCommission = $arrayEventData['value_commission'];

  $totalTransaction = $amountPlan+$amountCommission+$addedValue+$addedValueFee;

  if(FILTER_INPUT(INPUT_POST, 'method_payment', FILTER_VALIDATE_INT, 1)){
    $method_payment = trim($_POST['method_payment']);
    $method_payment = mysqli_real_escape_string($conn, $method_payment);
  }else if(empty($_POST['method_payment']) AND $totalTransaction!=0){
    $error = true;
    $methodError = "Por favor elige un método de pago.";
  }else if(empty($_POST['method_payment']) AND $totalTransaction==0){
    $method='';
  }else{
    $error = true;
    $methodError = "Método de pago inválido.";
  }

  // if there's no error
    if(!$error){

        $queryTransaction = mysqli_query($conn, "INSERT INTO transactions_streaming(id_event, id_type_event, id_user, amount_transaction_streaming, amount_transaction_commission, amount_transaction_tip, amount_transaction_tip_commission, payment_status) VALUES ('$idEvent', '$eventType', '$userid', '$amountPlan', '$amountCommission', '$addedValue', '$addedValueFee', 'pending')");

        $checkTransaction = mysqli_query($conn, "SELECT * FROM transactions_streaming WHERE id_event='$idEvent' AND id_type_event='$eventType' AND payment_status='pending' AND id_user='$userid' AND id_transaction_streaming=(SELECT MAX(id_transaction_streaming) FROM transactions_streaming WHERE id_event='$idEvent' AND id_user='$userid')");

        $arrayTransaction = mysqli_fetch_array($checkTransaction);

        $id_transaction = $arrayTransaction['id_transaction_streaming'];


      // Check if amount is 0

      if($totalTransaction == 0){

        mysqli_query($conn, "INSERT INTO subscribes_streaming (id_event_streaming, id_user, subscribe_status) VALUES ('$idEvent', '$userid', '1')");
        mysqli_query($conn, "UPDATE transactions_streaming SET payment_status='paid' WHERE id_event='$idEvent' AND id_type_event='$eventType' AND id_transaction_streaming='$id_transaction' ");

        // Mails with contact data

        $textUser = $suseventomail.'<p style="margin: 0.5rem 1rem;">Orden de compra: <strong> '.$paymentCode.' </strong> <br>
        Nombre usuario: <strong> '.ucfirst($arrayDataUser['first_name_user']).' '.ucfirst($arrayDataUser['last_name_user']).'</strong> <br>
        Fecha y Hora: <strong> '.$dateTransaction.' a las '.$timeTransaction.' hrs. </strong> <br> </p>'.$suseventomail2;

        $textUser.='<p style="margin: 0.5rem 1rem;">Nombre del Evento: <strong>'.$arrayEventData['name_event'].'</strong> <br>
        Link evento: <strong> https://echomusic.cl/streaming.php?event='.$arrayEventData['id_event'].'</strong><br>
        Fecha y Hora: <strong> '.$dateEventMail.' a las '.$timeEventMail.' hrs. </strong> </p>'.$suseventomail3;

        $headersUser = "MIME-Version: 1.0" . "\r\n";

        $headersUser .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headersUser .= "From: eventos@echomusic.cl" . "\r\n";
        $headersUser .= "Bcc: copiaentradas@echomusic.cl\r\n";

        $emailUser = $arrayDataUser['mail_user'];

        mail($emailUser, "Comprobante de suscripción", $textUser, $headersUser);

        $_SESSION['success'] = "Suscripción exitosa";

        header( "Location: https://echomusic.cl/event.php?streaming=".$idEvent, true, 303 );

        exit();

      }

        // Método de pago y como proceder
            switch($method_payment){
              case '1':

                $commerceCode = '597043183295';
                $apiKeySecret = '40b1a7876020ca1a86076bdea27a0598';
                // $commerceCode = '597055555532';
                // $apiKeySecret = '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';

                $options = Transbank\Webpay\Options::forProduction($commerceCode, $apiKeySecret);
                $transaction = new Transaction($options);

              // variables
                $amount = $totalTransaction;
                $buy_order = $id_transaction;
                $session_id = random_str(12);
                $return_url = 'https://echomusic.cl/payment_verification.php?streaming='.$idEvent;

              // create order
                $response = $transaction->create($buy_order, $session_id, $amount, $return_url);

                $url_payment = $response->url;
                $token_payment = $response->token;

                $_SESSION['url'] = $url_payment;
                $_SESSION['token'] = $token_payment;
                $_SESSION['method'] = '1';

                mysqli_query($conn, "UPDATE transactions_streaming SET order_transaction='$session_id' WHERE id_transaction_streaming='$id_transaction'");
                mysqli_query($conn, "INSERT INTO subscribes_streaming (id_event_streaming, id_user, order_transaction, subscribe_status) VALUES ('$idEvent', '$userid', '$session_id', '0')");

              break;

              case '2':

              // Debemos conocer el $receiverId y el $secretKey de ante mano.
                  $receiverId = 400724;
                  $secretKey = 'cb8a44364a896177330666f8949e57f70dcd2c1a';

                  $configuration = new Khipu\Configuration();
                  $configuration->setReceiverId($receiverId);
                  $configuration->setSecret($secretKey);

                  // $configuration->setDebug(true);

                  $client = new Khipu\ApiClient($configuration);
                  $payments = new Khipu\Client\PaymentsApi($client);


                  try {
                      $opts = array(
                          "transaction_id" => "TE-".$id_transaction,
                          "return_url" => "https://echomusic.cl/payment_verification.php?streaming=$idEvent",
                          "notify_url" => "https://echomusic.cl/resources/notification_script.php",
                          "notify_api_version" => "1.3",
                      );

                      $response = $payments->paymentsPost(
                          "Pago servicio entrada: ".$arrayEventData['name_event'], //Motivo de la compra
                          "CLP", //Monedas disponibles CLP, USD, ARS, BOB
                          $totalTransaction, //Monto. Puede contener ","
                          $opts //campos opcionales
                      );
                  } catch (\Khipu\ApiException $e) {
                      echo print_r($e->getResponseBody(), TRUE);
                  }
                  $_SESSION['method'] = '2';
              break;
            }


    }else{
       $errTyp = "danger";
       $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
    }
  }
  }else{
    header('HTTP/1.1 403 Forbidden');
    die();
  }

    if(isset($_SESSION['method'])){
        $checkTransaction = mysqli_query($conn, "SELECT id_transaction_streaming FROM transactions_streaming WHERE id_event='$idEvent' AND id_type_event='$eventType' AND payment_status='pending' AND id_user='$userid' AND id_transaction_streaming=(SELECT MAX(id_transaction_streaming) FROM transactions_streaming WHERE id_event='$idEvent' AND id_user='$userid')");
        $userDataTransaction = mysqli_fetch_array($checkTransaction);
    }

}else{
  $plsLogin = true;
}

// Header to Khipu payment

if(isset($response) && $_SESSION['method']=='2'){

  $payment_id = $response['payment_id'];

  mysqli_query($conn, "UPDATE transactions_streaming SET order_transaction='$payment_id' WHERE id_transaction_streaming='$id_transaction'");
  mysqli_query($conn, "INSERT INTO subscribes_streaming (id_event_streaming, id_user, order_transaction, subscribe_status) VALUES ('$idEvent', '$userid', '$payment_id', '0')");


  $payment_url = $response['payment_url'];
  $_SESSION['url'] = $payment_url;

}



 ?>
