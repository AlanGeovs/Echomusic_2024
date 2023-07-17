<?php

include 'connect.php';
include 'suscripTicketMail.php';
include 'ticketPresencialMail.php';
include 'compraTicketMail.php';
include 'ticketMailPdf.php';
require './vendor/autoload.php';
include './phpqrcode/qrlib.php';

use Transbank\Webpay\WebpayPlus\Transaction;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

  // Turn Off and On

  // header("location: alpha_test.php");

  // die();


    // Check RUT function

   function valida_rut($rut)

   {

       if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {

           return false;

       }

       $rut = preg_replace('/[\.\-]/i', '', $rut);

       $dv = substr($rut, -1);

       $numero = substr($rut, 0, strlen($rut) - 1);

       $i = 2;

       $suma = 0;

       foreach (array_reverse(str_split($numero)) as $v) {

           if ($i == 8)

               $i = 2;

           $suma += $v * $i;

           ++$i;

       }

       $dvr = 11 - ($suma % 11);

       if ($dvr == 11)

           $dvr = 0;

       if ($dvr == 10)

           $dvr = 'K';

       if ($dvr == strtoupper($dv))

           return true;

       else

           return false;

   }

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

  $userid = $_SESSION['user'];

  if(isset($_GET['private'])){

      if($idEvent = FILTER_INPUT(INPUT_GET, 'private', FILTER_VALIDATE_INT, 1)){
        $idEvent = mysqli_real_escape_string($conn, $idEvent);
        // Get url breadcrumb
        $breadCrumbUrl = "https://echomusic.cl/dashboard.php";
      }else{
        header('HTTP/1.1 403 Forbidden');
        die();
      }

      $typeEvent = 1;

      $queryEventData = mysqli_query($conn, "SELECT * FROM events_private WHERE id_event='$idEvent' AND id_user_buy='$userid'");
      if(mysqli_num_rows($queryEventData)>0){
        $arrayEventData = mysqli_fetch_array($queryEventData);
      }else{
        header('HTTP/1.1 403 Forbidden');
        die();
      }

      $dateEventNotice = date_create($arrayEventData['date_event']);
      $dateNotice = DATE_FORMAT($dateEventNotice, 'd-m-Y');
      $timeNotice = DATE_FORMAT($dateEventNotice, 'H:i');

      $queryDataUser = mysqli_query($conn, "SELECT mail_user, last_name_user, first_name_user, phone_event FROM users LEFT JOIN events_private ON events_private.id_user_buy = users.id_user WHERE events_private.id_event='$idEvent'");
      $queryDataArtist = mysqli_query($conn, "SELECT mail_user, last_name_user, first_name_user, phone FROM users LEFT JOIN events_private ON events_private.id_user_sell = users.id_user LEFT JOIN user_data ON user_data.id_user = users.id_user WHERE events_private.id_event='$idEvent'");
      $queryDataEvent = mysqli_query($conn, "SELECT * FROM events_private WHERE id_event='$idEvent'");

      $arrayDataUser = mysqli_fetch_array($queryDataUser);
      $arrayDataArtist = mysqli_fetch_array($queryDataArtist);
      $arrayDataEvent = mysqli_fetch_array($queryDataEvent);

      // Variables

      $amountPlan = $arrayEventData['value_plan_event'];
      $amountCommission = $arrayEventData['commission_plan_event'];
      $totalTransaction = $amountPlan+$amountCommission;

      $dateTransaction = date('Y-m-d H:i:s', time());

    if(isset($_POST['submit_data'])){

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

      // Check transaction on DB

        $queryTransaction = mysqli_query($conn, "INSERT INTO transactions_events(id_event, id_type_event, id_user, amount_transaction_plan, amount_transaction_commission, payment_status, date_transaction) VALUES ('$idEvent', '$typeEvent', '$userid', '$amountPlan', '$amountCommission', 'pending', '$dateTransaction')");
        $checkTransaction = mysqli_query($conn, "SELECT * FROM transactions_events WHERE id_event='$idEvent' AND id_type_event='$typeEvent' AND payment_status='pending' AND id_user='$userid' ORDER BY date_transaction DESC LIMIT 1");
        $arrayTransaction = mysqli_fetch_array($checkTransaction);
        $id_transaction = $arrayTransaction['id_transaction_event'];

      // Check if amount is 0

      if($totalTransaction == 0){

        mysqli_query($conn, "UPDATE events_private SET status_payment='paid', status_event='confirmed'  WHERE id_event='$idEvent'");
        mysqli_query($conn, "UPDATE transactions_events SET payment_status='paid' WHERE id_event='$idEvent' AND id_type_event='$typeEvent'");

        // Mails with contact data
                //mail al usuario
                        $text = $eventoconfmail.$arrayDataEvent['name_event'].$eventoCONFAmail2.' <p style="margin: 0.5rem 1rem;"><strong> '.ucfirst($arrayDataUser['first_name_user']).' '.ucfirst($arrayDataUser['last_name_user']).'</strong><br>
                        Teléfono: <strong><a href="tel:+56'.$arrayDataUser['phone_event'].'">+569'.$arrayDataUser['phone_event'].'</a></strong> <br>
                        Correo: '.$arrayDataUser['mail_user']."</p>".$eventoconfmail3.'
                        <p style="margin: 0.5rem 1rem;">
                        Nombre del Evento: <strong> '.$arrayDataEvent['name_event'].' </strong> <br>
                        Dirección del Evento: <strong>'.$arrayDataEvent['location'].'</strong> <br>
                        Fecha del Evento: <strong>'.$arrayDataEvent['date_event'].'</strong></p>'.$eventoconfmail4;


        $headersUser = "MIME-Version: 1.0" . "\r\n";

        $headersUser .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headersUser .= "From: reservas@echomusic.cl" . "\r\n";

        $emailArtist = $arrayDataArtist['mail_user'];

        mail($emailArtist, "¡Felicitaciones! Tienes un evento confirmado", $textUser, $headersUser);

        //mail al artista
           $textArtist = $eventoconfmail.$arrayDataEvent['name_event'].$eventoCONFAmail2.' <p style="margin: 0.5rem 1rem;"><strong> '.ucfirst($arrayDataArtist['first_name_user']).' '.ucfirst($arrayDataArtist['last_name_user']).'</strong><br>
                        Teléfono: <strong><a href="tel:+56'.$arrayDataArtist['phone_event'].'">+569'.$arrayDataArtist['phone_event'].'</a></strong> <br>
                        Correo: '.$arrayDataArtist['mail_user']."</p>".$eventoconfmail3.'
                        <p style="margin: 0.5rem 1rem;">
                        Nombre del Evento: <strong> '.$arrayDataEvent['name_event'].' </strong> <br>
                        Dirección del Evento: <strong>'.$arrayDataEvent['location'].'</strong> <br>
                        Fecha del Evento: <strong>'.$arrayDataEvent['date_event'].'</strong></p>'.$eventoconfmail4;
        $headersArtist = "MIME-Version: 1.0" . "\r\n";

        $headersArtist .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headersArtist .= "From: reservas@echomusic.cl" . "\r\n";

        $emailUser = $arrayDataUser['mail_user'];

        mail($emailUser, "¡Felicitaciones! Tu evento ha sido confirmado", $textArtist, $headersArtist);

        header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

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
              $return_url = 'https://echomusic.cl/payment_verification.php?event='.$idEvent;

            // create order
              $response = $transaction->create($buy_order, $session_id, $amount, $return_url);

              $url_payment = $response->url;
              $token_payment = $response->token;

              $_SESSION['url'] = $url_payment;
              $_SESSION['token'] = $token_payment;
              $_SESSION['method'] = '1';

              mysqli_query($conn, "UPDATE transactions_events SET order_transaction='$session_id' WHERE id_transaction_event='$id_transaction'");

            break;

            case '2':

              // Debemos conocer el $receiverId y el $secretKey de ante mano.
                  $receiverId = 400724;
                  $secretKey = 'cb8a44364a896177330666f8949e57f70dcd2c1a';

                  // $receiverId = 278124;
                  // $secretKey = 'e63a0203a564843ca4b39e8a0908dda28974815e';

                  $configuration = new Khipu\Configuration();
                  $configuration->setReceiverId($receiverId);
                  $configuration->setSecret($secretKey);

                  // $configuration->setDebug(true);

                  $client = new Khipu\ApiClient($configuration);
                  $payments = new Khipu\Client\PaymentsApi($client);

                  try {
                      $opts = array(
                          "transaction_id" => "TE-".$id_transaction,
                          "return_url" => "https://echomusic.cl/payment_verification.php?event=$idEvent",
                          "notify_url" => "https://echomusic.cl/resources/notification_script.php",
                          "notify_api_version" => "1.3",
                      );

                      $response = $payments->paymentsPost(
                          "Confirmación del evento: ".$arrayEventData['name_event'], //Motivo de la compra
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


    }

  }else{
    header('HTTP/1.1 403 Forbidden');
    die();
  }

  // if(isset($_SESSION['method'])){
  //     $checkTransaction = mysqli_query($conn, "SELECT id_transaction_event FROM transactions_events WHERE id_event='$idEvent' AND id_type_event='$typeEvent' AND payment_status='pending' AND id_user='$userid' AND id_transaction_public=(SELECT MAX(id_transaction_public) FROM transactions_public WHERE id_event='$idEvent' AND id_user='$userid')");
  //     $userDataTransaction = mysqli_fetch_array($checkTransaction);
  // }

}else{
  $plsLogin = true;
}

// Header to Khipu payment

if(isset($response) && $_SESSION['method']=='2'){

  $payment_id = $response['payment_id'];

  mysqli_query($conn, "UPDATE transactions_events SET order_transaction='$payment_id' WHERE id_transaction_event='$id_transaction'");

  $payment_url = $response['payment_url'];
  $_SESSION['url'] = $payment_url;

}

?>
