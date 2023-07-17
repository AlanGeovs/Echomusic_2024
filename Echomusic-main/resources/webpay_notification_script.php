<?php
define('ROOT_PATH', dirname(__DIR__) . '/');

include (ROOT_PATH.'resources/connect.php');
include (ROOT_PATH.'resources/functionDateTranslate.php');
include (ROOT_PATH.'resources/eventoConfirmadoMail.php');
include (ROOT_PATH.'resources/eventoPublicadoMail.php');
include (ROOT_PATH.'resources/compraTicketMail.php');
include (ROOT_PATH.'resources/ticketPresencialMail.php');
include (ROOT_PATH.'resources/ticketMailPdf.php');
include (ROOT_PATH.'resources/metaCumplidaMail.php');
require (ROOT_PATH.'vendor/autoload.php');

include (ROOT_PATH.'resources/nuevoPatrocinadorArtistaMail.php');
include (ROOT_PATH.'resources/nuevoPatrocinadorClienteMail.php');

include (ROOT_PATH.'phpqrcode/qrlib.php');

use Transbank\Webpay\WebpayPlus\Transaction;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

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




$commerceCode = '597043183295';
$apiKeySecret = '40b1a7876020ca1a86076bdea27a0598';
// $commerceCode = '597055555532';
// $apiKeySecret = '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';

$options = Transbank\Webpay\Options::forProduction($commerceCode, $apiKeySecret);
$transaction = new Transaction($options);

  if(!empty($_GET['event'])){

    $id_user = $_SESSION['user'];

    // Check payment
    $token = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    if (!$token) {
        if(!empty($_GET['TBK_TOKEN']) || !empty($_POST['TBK_TOKEN'])){ //Pago abortado

          $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'];
          $id_transaction = mysqli_real_escape_string($conn, $_POST['TBK_ORDEN_COMPRA']);
          $id_session = mysqli_real_escape_string($conn, $_POST['TBK_ID_SESION']);

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_events LEFT JOIN events_private ON transactions_events.id_event = events_private.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_event = $arrayDataTransaction['id_event'];

         $transactionCode = sprintf('%04d', $id_transaction);
         $eventCode = sprintf('%04d', $id_event);
         $typeCode = '01';
         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

          mysqli_query($conn, "UPDATE transactions_events SET payment_status='aborted' WHERE id_transaction_event='$id_transaction' AND order_transaction='$id_session'");

          $errTyp = "danger";
          $errMSG = "Proceso de pago anulado";

        }elseif(!empty($_GET['TBK_ID_SESION']) || !empty($_POST['TBK_ID_SESION'])){ //Timeout

          $id_transaction = mysqli_real_escape_string($conn, $_POST['TBK_ORDEN_COMPRA']);
          $id_session = mysqli_real_escape_string($conn, $_POST['TBK_ID_SESION']);

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_events LEFT JOIN events_private ON transactions_events.id_event = events_private.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_event = $arrayDataTransaction['id_event'];

         $transactionCode = sprintf('%04d', $id_transaction);
         $eventCode = sprintf('%04d', $id_event);
         $typeCode = '01';
         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

          mysqli_query($conn, "UPDATE transactions_events SET payment_status='timeout' WHERE id_transaction_event='$id_transaction' AND order_transaction='$id_session'");

          $errTyp = "danger";
          $errMSG = "Proceso de pago anulado";

        }
        // die ('No es un flujo de pago normal.'););
    }

    $response = $transaction->commit($token);

    if ($response->isApproved()) {
      // Transacción Aprobada
     $id_session = $response->{'sessionId'};
     $id_transaction = $response->{'buyOrder'};

     $authCode = $response->{'authorizationCode'};
     $paymentType = $response->{'paymentTypeCode'};
     $cuotas = $response->{'installmentsNumber'};
     $valorCuota = $response->{'installmentsAmount'};
     $lastDigits = $response->{'cardNumber'};

     $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_events LEFT JOIN events_private ON transactions_events.id_event = events_private.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
     $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
     $id_event = $arrayDataTransaction['id_event'];

     mysqli_query($conn, "UPDATE events_private SET status_payment='paid', status_event='confirmed' WHERE id_event='$id_event'");
     mysqli_query($conn, "UPDATE transactions_events SET payment_status='paid',  method_transaction='$paymentType', cuotas_transaction='$cuotas', amount_cuota='$valorCuota', auth_code_transaction='$authCode', last_digits='$lastDigits' WHERE id_transaction_event='$id_transaction'");

     // Data mail
     $queryDataUser = mysqli_query($conn, "SELECT mail_user, last_name_user, first_name_user, phone_event FROM users LEFT JOIN events_private ON events_private.id_user_buy = users.id_user WHERE events_private.id_event='$id_event'");

     $queryDataArtist = mysqli_query($conn, "SELECT mail_user, last_name_user, first_name_user, phone FROM users LEFT JOIN events_private ON events_private.id_user_sell = users.id_user LEFT JOIN user_data ON user_data.id_user = users.id_user WHERE events_private.id_event='$id_event'");

     $queryDataEvent = mysqli_query($conn, "SELECT * FROM events_private WHERE id_event='$id_event'");

     $arrayDataUser = mysqli_fetch_array($queryDataUser);

     $arrayDataArtist = mysqli_fetch_array($queryDataArtist);

     $arrayDataEvent = mysqli_fetch_array($queryDataEvent);

    //mail al usuario
      $textUser = $eventoconfmail.$arrayDataEvent['name_event'].$eventoCONFAmail2.' <p style="margin: 0.5rem 1rem;"><strong>'.ucfirst($arrayDataUser['first_name_user']).' '.ucfirst($arrayDataUser['last_name_user']).'</strong><br>Teléfono: <strong><a href="tel:+56'.$arrayDataUser['phone_event'].'">'.$arrayDataUser['phone_event'].'</a></strong> <br> Correo: '.$arrayDataUser['mail_user']."</p>".$eventoconfmail3.'
       <p style="margin: 0.5rem 1rem;">
       Nombre del Evento: <strong>'.$arrayDataEvent['name_event'].'</strong> <br>

       Dirección del Evento: <strong>'.$arrayDataEvent['location'].'</strong> <br>

       Fecha del Evento: <strong>'.$arrayDataEvent['date_event'].'</strong></p>'.$eventoconfmail4;

     $headersUser = "MIME-Version: 1.0" . "\r\n";

     $headersUser .= 'Content-type: text/html; charset=utf-8' . "\r\n";

     $headersUser .= "From: reservas@echomusic.cl" . "\r\n";

     $emailArtist = $arrayDataArtist['mail_user'];

     mail($emailArtist, "¡Felicitaciones! Tienes un evento confirmado", $textUser, $headersUser);



    //mail al artista
       $textArtist = $eventoconfmail.$arrayDataEvent['name_event'].$eventoCONFCmail2.' <p style="margin: 0.5rem 1rem;"><strong>'.ucfirst($arrayDataArtist['first_name_user']).' '.ucfirst($arrayDataArtist['last_name_user']).'</strong><br>Teléfono: <strong><a href="tel:+56'.$arrayDataArtist['phone'].'">'.$arrayDataArtist['phone'].'</a></strong> <br> Correo: '.$arrayDataArtist['mail_user']."</p>".$eventoconfmail3.'
       <p style="margin: 0.5rem 1rem;">
       Nombre del Evento: <strong>'.$arrayDataEvent['name_event'].'</strong> <br>

       Dirección del Evento: <strong>'.$arrayDataEvent['location'].'</strong> <br>

       Fecha del Evento: <strong>'.$arrayDataEvent['date_event'].'</strong></p>'.$eventoconfmail4;

     $headersArtist = "MIME-Version: 1.0" . "\r\n";

     $headersArtist .= 'Content-type: text/html; charset=utf-8' . "\r\n";

     $headersArtist .= "From: reservas@echomusic.cl" . "\r\n";

     $emailUser = $arrayDataUser['mail_user'];

     mail($emailUser, "¡Felicitaciones! Tu evento ha sido confirmado", $textArtist, $headersArtist);

     // order code
     $transactionCode = sprintf('%04d', $id_transaction);
     $eventCode = sprintf('%04d', $id_event);
     $typeCode = '01';

     $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

     $errTyp = "success";
     $errMSG = "Pago Verificado";

    } else {

     // Transacción rechazada
     $id_session = $response->{'sessionId'};
     $id_transaction = $response->{'buyOrder'};

     $authCode = $response->{'authorizationCode'};
     $paymentType = $response->{'paymentTypeCode'};
     $cuotas = $response->{'installmentsNumber'};
     $valorCuota = $response->{'installmentsAmount'};
     $lastDigits = $response->{'cardNumber'};

     mysqli_query($conn, "UPDATE transactions_events SET payment_status='failed',  method_transaction='$paymentType', cuotas_transaction='$cuotas', amount_cuota='$valorCuota', auth_code_transaction='$authCode', last_digits='$lastDigits' WHERE id_transaction_event='$id_transaction'");

     $transactionCode = sprintf('%04d', $id_transaction);
     $eventCode = sprintf('%04d', $id_event);
     $typeCode = '01';

     $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

     $errTyp = "danger";
     $errMSG = "Orden de compra rechazada";
    }

  }else if(!empty($_GET['streaming'])){

    $id_user = $_SESSION['user'];

    $token = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    if (!$token) {
        if(!empty($_GET['TBK_TOKEN']) || !empty($_POST['TBK_TOKEN'])){ //Pago abortado

          $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'];
          $id_transaction = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'];
          $id_session = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'];

          $id_transaction = mysqli_real_escape_string($conn, $id_transaction);
          $id_session = mysqli_real_escape_string($conn, $id_session);

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_streaming LEFT JOIN events_streaming ON transactions_streaming.id_event = events_streaming.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_event = $arrayDataTransaction[1];

         $transactionCode = sprintf('%04d', $id_transaction);
         $eventCode = sprintf('%04d', $id_event);
         $typeCode = '04';
         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

          mysqli_query($conn, "UPDATE transactions_streaming SET payment_status='aborted' WHERE id_transaction_streaming='$id_transaction' AND order_transaction='$id_session'");

          $errTyp = "danger";
          $errMSG = "Proceso de pago anulado";

        }elseif(!empty($_GET['TBK_ID_SESION']) || !empty($_POST['TBK_ID_SESION'])){ //Timeout


          $id_transaction = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'];
          $id_session = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'];

          $id_transaction = mysqli_real_escape_string($conn, $_POST['TBK_ORDEN_COMPRA']);
          $id_session = mysqli_real_escape_string($conn, $_POST['TBK_ID_SESION']);

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_streaming LEFT JOIN events_streaming ON transactions_streaming.id_event = events_streaming.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_event = $arrayDataTransaction[1];

         $transactionCode = sprintf('%04d', $id_transaction);
         $eventCode = sprintf('%04d', $id_event);
         $typeCode = '04';
         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

          mysqli_query($conn, "UPDATE transactions_streaming SET payment_status='timeout' WHERE id_transaction_streaming='$id_transaction' AND order_transaction='$id_session'");

          $errTyp = "danger";
          $errMSG = "Proceso de pago anulado";

        }
        // die ('No es un flujo de pago normal.');
    }else{

      $response = $transaction->commit($token);

      if ($response->isApproved()) {
       // Transacción Aprobada
       $id_session = $response->{'sessionId'};
       $id_transaction = $response->{'buyOrder'};

       $authCode = $response->{'authorizationCode'};
       $paymentType = $response->{'paymentTypeCode'};
       $cuotas = $response->{'installmentsNumber'};
       $valorCuota = $response->{'installmentsAmount'};
       $lastDigits = $response->{'cardNumber'};

       // Método de pago
       switch($paymentType){
         case 'VD':
           $cardType = 'Débito';
         break;

         case 'VN':
           $cardType = 'Crédito';
         break;

         case 'SI':
           $cardType = 'Crédito';
         break;

         case 'S2':
           $cardType = 'Crédito';
         break;

         case 'NC':
           $cardType = 'Crédito';
         break;

         case 'VP':
           $cardType = 'Prepago';
         break;
       }

       $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_streaming LEFT JOIN events_streaming ON transactions_streaming.id_event = events_streaming.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
       if(mysqli_num_rows($queryCheckTransaction)>0){
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_user = $arrayDataTransaction[3];

         $id_event = $arrayDataTransaction[1];
         $id_transaction = $arrayDataTransaction['id_transaction_streaming'];
         $amount = $arrayDataTransaction['amount_transaction_streaming']+$arrayDataTransaction['amount_transaction_commission']+$arrayDataTransaction['amount_transaction_tip']+$arrayDataTransaction['amount_transaction_tip_commission'];

         $queryEventData = mysqli_query($conn, "SELECT * FROM events_streaming WHERE id_event='$id_event'");
         $arrayEventData = mysqli_fetch_array($queryEventData);

         mysqli_query($conn, "UPDATE transactions_streaming SET payment_status='paid', method_transaction='$paymentType', cuotas_transaction='$cuotas', amount_cuota='$valorCuota', auth_code_transaction='$authCode', last_digits='$lastDigits' WHERE id_transaction_streaming='$id_transaction'");

         $queryDataUser = mysqli_query($conn, "SELECT id_user, mail_user, first_name_user, last_name_user FROM users WHERE id_user='$id_user'");
         $arrayDataUser = mysqli_fetch_array($queryDataUser);

         $queryEventData = mysqli_query($conn, "SELECT * FROM events_streaming WHERE id_event='$id_event'");
         $arrayEventData = mysqli_fetch_array($queryEventData);

         $queryTransactionData = mysqli_query($conn, "SELECT * FROM transactions_streaming WHERE id_event='$id_event' AND payment_status='paid' AND id_transaction_streaming='$id_transaction'");
         $arrayTransactionData = mysqli_fetch_array($queryTransactionData);

         $dateTimeEvent = date_create($arrayEventData['date_event']);
         $timeEventMail = DATE_FORMAT($dateTimeEvent, 'H:i');
         $dateEventMail = DATE_FORMAT($dateTimeEvent, 'd/m/Y');

         $dateTimeTransaction = date_create($arrayTransactionData['date_transaction']);
         $timeTransaction = DATE_FORMAT($dateTimeTransaction, 'H:i');
         $dateTransaction = DATE_FORMAT($dateTimeTransaction, 'd/m/Y');

         $idTransaction = $arrayTransactionData['id_transaction_streaming'];
         $id_event = $arrayTransactionData['id_event'];
         $transactionCode = sprintf('%04d', $idTransaction);
         $eventCode = sprintf('%04d', $id_event);
         $typeCode = '04';

         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

         mysqli_query($conn, "UPDATE subscribes_streaming SET subscribe_status='1' WHERE order_transaction='$id_session'");

         $textUser = $pagoeventomail.'<p style="margin: 0.5rem 1rem;">
         Nombre usuario: <strong> '.ucfirst($arrayDataUser['first_name_user']).' '.ucfirst($arrayDataUser['last_name_user']).'</strong>
         '.$pagoeventomail2;

         $textUser.='<p style="margin: 0.5rem 1rem;">Nombre del Evento: <strong>'.$arrayEventData['name_event'].'</strong> <br>
         Link evento: <strong> https://echomusic.cl/streaming.php?event='.$arrayEventData['id_event'].'</strong><br>
         Fecha y Hora: <strong> '.$dateEventMail.' a las '.$timeEventMail.' hrs. </strong> </p>'.$pagoeventomail3;


         $headersUser = "MIME-Version: 1.0" . "\r\n";

         $headersUser .= 'Content-type: text/html; charset=utf-8' . "\r\n";

         $headersUser .= "From: eventos@echomusic.cl" . "\r\n";

         $headersUser .= "Bcc: copiaentradas@echomusic.cl\r\n";

         $emailUser = $arrayDataUser['mail_user'];

         mail($emailUser, "Comprobante de compra streaming", $textUser, $headersUser);

         $errTyp = "success";
         $errMSG = "Pago Verificado";
       }else{

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_streaming LEFT JOIN events_streaming ON transactions_streaming.id_event = events_streaming.id_event WHERE order_transaction='$id_session' AND payment_status='paid'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_user = $arrayDataTransaction[3];

         $id_event = $arrayDataTransaction[1];
         $id_transaction = $arrayDataTransaction['id_transaction_streaming'];
         $amount = $arrayDataTransaction['amount_transaction_streaming']+$arrayDataTransaction['amount_transaction_commission']+$arrayDataTransaction['amount_transaction_tip']+$arrayDataTransaction['amount_transaction_tip_commission'];

         $queryDataUser = mysqli_query($conn, "SELECT id_user, mail_user, first_name_user, last_name_user FROM users WHERE id_user='$id_user'");
         $arrayDataUser = mysqli_fetch_array($queryDataUser);

         $queryEventData = mysqli_query($conn, "SELECT * FROM events_streaming WHERE id_event='$id_event'");
         $arrayEventData = mysqli_fetch_array($queryEventData);

         $queryTransactionData = mysqli_query($conn, "SELECT * FROM transactions_streaming WHERE id_event='$id_event' AND payment_status='paid' AND id_transaction_streaming='$id_transaction'");
         $arrayTransactionData = mysqli_fetch_array($queryTransactionData);

         $dateTimeEvent = date_create($arrayEventData['date_event']);
         $timeEventMail = DATE_FORMAT($dateTimeEvent, 'H:i');
         $dateEventMail = DATE_FORMAT($dateTimeEvent, 'd/m/Y');

         $dateTimeTransaction = date_create($arrayTransactionData['date_transaction']);
         $timeTransaction = DATE_FORMAT($dateTimeTransaction, 'H:i');
         $dateTransaction = DATE_FORMAT($dateTimeTransaction, 'd/m/Y');

         $idTransaction = $arrayTransactionData['id_transaction_streaming'];
         $id_event = $arrayTransactionData['id_event'];
         $transactionCode = sprintf('%04d', $idTransaction);
         $eventCode = sprintf('%04d', $id_event);
         $typeCode = '04';

         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

         $errTyp = "success";
         $errMSG = "Pago Verificado";
       }
      } else {
       // Transacción rechazada
       $id_session = $response->{'sessionId'};
       $id_transaction = $response->{'buyOrder'};

       $authCode = $response->{'authorizationCode'};
       $paymentType = $response->{'paymentTypeCode'};
       $cuotas = $response->{'installmentsNumber'};
       $valorCuota = $response->{'installmentsAmount'};
       $lastDigits = $response->{'cardNumber'};

       $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_streaming LEFT JOIN events_streaming ON transactions_streaming.id_event = events_streaming.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
       $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
       $id_event = $arrayDataTransaction[1];

       $transactionCode = sprintf('%04d', $id_transaction);
       $eventCode = sprintf('%04d', $id_event);
       $typeCode = '04';
       $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

       mysqli_query($conn, "UPDATE transactions_streaming SET payment_status='failed', method_transaction='$paymentType', cuotas_transaction='$cuotas', amount_cuota='$valorCuota', auth_code_transaction='$authCode', last_digits='$lastDigits' WHERE id_transaction_streaming='$id_transaction'");

       $errTyp = "danger";
       $errMSG = "Orden de compra rechazada";
      }
  }

  }else if(!empty($_GET['public'])){

    $id_user = $_SESSION['user'];



    $token = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    if (!$token) {
        if(!empty($_GET['TBK_TOKEN']) || !empty($_POST['TBK_TOKEN'])){ //Pago abortado

          $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'];
          $id_transaction = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'];
          $id_session = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'];

          $id_transaction = mysqli_real_escape_string($conn, $id_transaction);
          $id_session = mysqli_real_escape_string($conn, $id_session);

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_public LEFT JOIN events_public ON transactions_public.id_event = events_public.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_event = $arrayDataTransaction['id_event'];

         $transactionCode = sprintf('%04d', $id_transaction);
         $eventCode = sprintf('%04d', $id_event);
         $typeCode = '02';
         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

          mysqli_query($conn, "UPDATE transactions_public SET payment_status='aborted' WHERE id_transaction_public='$id_transaction' AND order_transaction='$id_session'");

          $errTyp = "danger";
          $errMSG = "Proceso de pago anulado";

        }elseif(!empty($_GET['TBK_ID_SESION']) || !empty($_POST['TBK_ID_SESION'])){ //Timeout

          $id_transaction = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'];
          $id_session = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'];

          $id_transaction = mysqli_real_escape_string($conn, $_POST['TBK_ORDEN_COMPRA']);
          $id_session = mysqli_real_escape_string($conn, $_POST['TBK_ID_SESION']);

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_public LEFT JOIN events_public ON transactions_public.id_event = events_public.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_event = $arrayDataTransaction['id_event'];

         $transactionCode = sprintf('%04d', $id_transaction);
         $eventCode = sprintf('%04d', $id_event);
         $typeCode = '02';
         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

          mysqli_query($conn, "UPDATE transactions_public SET payment_status='timeout' WHERE id_transaction_public='$id_transaction' AND order_transaction='$id_session'");

          $errTyp = "danger";
          $errMSG = "Proceso de pago anulado";

        }
        // die ('No es un flujo de pago normal.');
    }else{

      $response = $transaction->commit($token);

      if ($response->isApproved()) {
        $webpayMethod = true;
       // Transacción Aprobada
       $id_session = $response->{'sessionId'};
       $id_transaction = $response->{'buyOrder'};

       $authCode = $response->{'authorizationCode'};
       $paymentType = $response->{'paymentTypeCode'};
       $cuotas = $response->{'installmentsNumber'};
       $valorCuota = $response->{'installmentsAmount'};
       $lastDigits = $response->{'cardNumber'};

      // Método de pago
      switch($paymentType){
        case 'VD':
          $cardType = 'Débito';
        break;

        case 'VN':
          $cardType = 'Crédito';
        break;

        case 'SI':
          $cardType = 'Crédito';
        break;

        case 'S2':
          $cardType = 'Crédito';
        break;

        case 'NC':
          $cardType = 'Crédito';
        break;

        case 'VP':
          $cardType = 'Prepago';
        break;
      }

       $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_public LEFT JOIN events_public ON transactions_public.id_event = events_public.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
       if(mysqli_num_rows($queryCheckTransaction)>0){
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_event = $arrayDataTransaction['id_event'];

         mysqli_query($conn, "UPDATE transactions_public SET payment_status='paid', method_transaction='$paymentType', cuotas_transaction='$cuotas', amount_cuota='$valorCuota', auth_code_transaction='$authCode', last_digits='$lastDigits' WHERE id_transaction_public='$id_transaction'");

         $queryDataUser = mysqli_query($conn, "SELECT id_user, tickets_public.ticket_name, tickets_public.ticket_value, tickets_public.ticket_commission, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email FROM subscribes_public LEFT JOIN tickets_public ON tickets_public.id_ticket=subscribes_public.id_ticket WHERE order_transaction='$id_session' LIMIT 1");
         $arrayDataUser = mysqli_fetch_array($queryDataUser);

         $queryEventData = mysqli_query($conn, "SELECT * FROM events_public LEFT JOIN cities ON cities.id_city=events_public.id_city WHERE id_event='$id_event'");
         $arrayEventData = mysqli_fetch_array($queryEventData);

         $queryTransactionData = mysqli_query($conn, "SELECT * FROM transactions_public WHERE id_event='$id_event' AND payment_status='paid' AND id_transaction_public='$id_transaction'");
         $arrayTransactionData = mysqli_fetch_array($queryTransactionData);

         $idArtist = $arrayEventData['id_user'];

         $queryDataArtist = mysqli_query($conn, "SELECT users.nick_user, user_data.rut FROM users LEFT JOIN user_data ON users.id_user = user_data.id_user WHERE users.id_user='$idArtist'");
         $arrayDataArtist = mysqli_fetch_array($queryDataArtist);

         $dateTimeEvent = date_create($arrayEventData['date_event']);
         $timeEventMail = DATE_FORMAT($dateTimeEvent, 'H:i');
         $dateEventMail = DATE_FORMAT($dateTimeEvent, 'd/m/Y');

         $dateTimeTransaction = date_create($arrayTransactionData['date_transaction']);
         $timeTransaction = DATE_FORMAT($dateTimeTransaction, 'H:i');
         $dateTransaction = DATE_FORMAT($dateTimeTransaction, 'd/m/Y');

         $transactionCode = sprintf('%04d', $id_transaction);
         $eventCode = sprintf('%04d', $id_event);
         $typeCode = '02';
         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

         $nameEvent = $arrayEventData['name_event'];
         $nameLocationEvent = $arrayEventData['name_location'];
         $locationEvent = $arrayEventData['location'].', '.$arrayEventData['name_city'];

         $rawEventValue = $arrayTransactionData['amount_transaction_public'];
         $rawEventValueCommision = $arrayTransactionData['amount_transaction_commission'];
         $rawEventTotal = $rawEventValue + $rawEventValueCommision;

         $singleTicketValue = $arrayDataUser['ticket_value'];
         $singleTicketCommission = $arrayDataUser['ticket_commission'];
         $singleTicketTotal = number_format($singleTicketValue+$singleTicketCommission , 0, ',', '.');

         $eventValue = number_format($rawEventValue , 0, ',', '.');
         $eventValueCommision = number_format($rawEventValueCommision , 0, ',', '.');
         $eventValueTotal = number_format($rawEventTotal , 0, ',', '.');

         $ntickets = $arrayTransactionData['n_tickets'];

        // * NOMBRE BANDA QUE TOCA - CUADRO GRANDE GRIS
         $nick_artist = $arrayDataArtist['nick_user'];
        // * QUIEN ORGANIZA EL EVENTO
         $eventOrganizer = $arrayEventData['organizer'];
        // * RUT ORGANIZADOR
         $rut_artist = $arrayDataArtist['rut'];

         // Generate IVA
          $fee = 1.19;
          $commissionEvent = $rawEventValueCommision;
          $iva = ($fee*$rawEventValue+$fee*$commissionEvent-$rawEventValue-$commissionEvent)/$fee;
          $iva= round($iva, 0);

         // set mail user
         $emailUser = $arrayDataUser['subscribe_email'];
         // Ticket name
         $ticketName = $arrayDataUser['ticket_name'];

         // Start mail object
           $mail = new PHPMailer();
           $mail->Encoding = 'base64';
           $mail->CharSet = 'UTF-8';

         // Get ids subscribes
         $querySubscribes = mysqli_query($conn, "SELECT id_subscribe_public FROM subscribes_public WHERE order_transaction='$id_session'");

         while($ids_subscribes = mysqli_fetch_array($querySubscribes)){
           $id_subscribe = $ids_subscribes['id_subscribe_public'];
         // Generate QR code and unique string
          include 'qr-generator.php';

          $pdfName = random_str(12);

          // mysqli_query($conn, "UPDATE subscribes_public SET verify_string='$randStrURL', subscribe_status='1' WHERE order_transaction='$id_session'");
          mysqli_query($conn, "UPDATE subscribes_public SET verify_string='$randStrURL', subscribe_status='1', ticket_file='$pdfName' WHERE id_subscribe_public='$id_subscribe'");

        // Utilizar qr-temps/$randQRName.php para obtener imagen de código QR
          $varImgQr= '<img id="qr-imgTicket" style="vertical-align: top;width:55%;" src="'.$rutaQR.'" alt="Echomusic">';

         //GENERAMOS EL CUERPO DEL PDF TICKET
          // $cuerpoTicketMail = $ticketMail.$varImgQr.$ticketMail1.$paymentCode.$ticketMail2.$nick_artist.$ticketMail3.$locationEvent.' - '.$dateEventMail.' - '.$timeEventMail.$ticketMail4.ucfirst($arrayDataUser['subscribe_fname']).' '.ucfirst($arrayDataUser['subscribe_lname']).$ticketMail5.$arrayDataUser['subscribe_rut'].$ticketMail6.'EVENTO: '.$nameEvent.$ticketMail7.'ORGANIZA: '.$eventOrganizer.$ticketMail8.'RUT: '.$rut_artist.$ticketMail9.'PRECIO: '.$singleTicketTotal.$ticketMail10;
          $cuerpoTicketMail = $ticketMail.$varImgQr.$ticketMail1.$paymentCode.$ticketMail2.$nick_artist.$ticketMail3.$locationEvent.' - '.$dateEventMail.' - '.$timeEventMail.$ticketMail4.$ticketName.$ticketMail4_5.$id_subscribe.$ticketMail5.$ticketMail6.'EVENTO: '.$nameEvent.$ticketMail7.'ORGANIZA: '.$eventOrganizer.$ticketMail8.'RUT: '.$rut_artist.$ticketMail9.'PRECIO: $'.$singleTicketTotal.$ticketMail10;

          $mpdf = new \Mpdf\Mpdf(['tempDir' => ROOT_PATH . 'images/tmp3']);
          $mpdf->WriteHTML($cuerpoTicketMail);
          $mpdf->Output(ROOT_PATH . 'images/tickets/'.$pdfName.'.pdf', 'F');

          $mail->addAttachment(ROOT_PATH . 'images/tickets/'.$pdfName.'.pdf', $id_subscribe.'.pdf');

         }


        //GENERAMOS CUERPO DEL CORREO ENTRADA
         $varClienteTicket = '<br><br><b>Estimado(a) '.ucfirst($arrayDataUser['subscribe_fname']).' '.ucfirst($arrayDataUser['subscribe_lname']);

         $varTicket= '<b>Orden de compra:</b></td><td>'.$paymentCode.'<br></td></tr>
         <tr><td><b>Nombre:</b></td><td>'.ucfirst($arrayDataUser['subscribe_fname']).' '.ucfirst($arrayDataUser['subscribe_lname']).'<br></td></tr>
         <tr><td><b>RUT:</b></td><td>'.$arrayDataUser['subscribe_rut'].'<br></td></tr>
         <tr><td><b>E-Mail:</b></td><td>'.$emailUser.'<br></td></tr>
         <tr><td><b>Fecha:</b></td><td>'.$dateTransaction.'<br></td></tr>
         <tr><td><b>Hora:</b></td><td>'.$timeTransaction.' hrs.<br></td></tr>

         <tr><td><b style="color:#ff6600;">Resumen del evento</b><br></td></tr>
         <tr><td><b>Evento:</b></td><td>'.$nameEvent.'<br></td></tr>
         <tr><td><b>Lugar:</b></td><td>'.$nameLocationEvent.' <br></td></tr>
         <tr><td><b>Direcci&oacuten:</b></td><td>'.$locationEvent.'. <br></td></tr>
         <tr><td><b>Fecha:</b></td><td>'.$dateEventMail.'<br></td></tr>
         <tr><td><b>Hora:</b></td><td>'.$timeEventMail.' hrs.<br></tr>

         <tr><td><b style="color:#ff6600;">Datos de entrada</b><br></td></tr>
         <tr><td><b>Items:</b></td><td> '.$ntickets.' <br></td></tr>
         <tr><td><b>Precio:</b></td><td> $'.$eventValue.'<br></td></tr>
         <tr><td><b>Cargo por servicio:</b></td><td> $'.$eventValueCommision.'<br></td></tr>
         <tr><td><b>IVA incluido:</b></td><td> $'.number_format($iva, 0, ',', '.').'<br></td></tr>
         <tr><td><b>Total: </b></td><td> $'.$eventValueTotal.'<br>';


         $textUser = $ticketPremail.$paymentCode.$varClienteTicket.$ticketPremail2.$varTicket.$ticketPremail3;


         $mail->isHTML(true);
         $mail->SetFrom('eventos@echomusic.cl', 'Eventos EchoMusic'); //Name is optional
         $mail->Subject   = 'Comprobante de compra entrada';
         $mail->Body     = $textUser;
         $mail->AltBody  = $textUser;
         $mail->AddAddress($emailUser);
         $mail->addBCC('copiaentradas@echomusic.cl');

        $mail->send();

        $errTyp = "success";
        $errMSG = "Pago Verificado";


       }else{

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_public LEFT JOIN events_public ON transactions_public.id_event = events_public.id_event WHERE order_transaction='$id_session' AND payment_status='paid'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_event = $arrayDataTransaction['id_event'];

         $queryDataUser = mysqli_query($conn, "SELECT id_user, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email FROM subscribes_public WHERE order_transaction='$id_session'");
         $arrayDataUser = mysqli_fetch_array($queryDataUser);

         $queryEventData = mysqli_query($conn, "SELECT * FROM events_public LEFT JOIN cities ON cities.id_city=events_public.id_city WHERE id_event='$id_event'");
         $arrayEventData = mysqli_fetch_array($queryEventData);

         $queryTransactionData = mysqli_query($conn, "SELECT * FROM transactions_public WHERE id_event='$id_event' AND payment_status='paid' AND id_transaction_public='$id_transaction'");
         $arrayTransactionData = mysqli_fetch_array($queryTransactionData);

         $dateTimeEvent = date_create($arrayEventData['date_event']);
         $timeEventMail = DATE_FORMAT($dateTimeEvent, 'H:i');
         $dateEventMail = DATE_FORMAT($dateTimeEvent, 'd/m/Y');

         $dateTimeTransaction = date_create($arrayTransactionData['date_transaction']);
         $timeTransaction = DATE_FORMAT($dateTimeTransaction, 'H:i');
         $dateTransaction = DATE_FORMAT($dateTimeTransaction, 'd/m/Y');

         $nameEvent = $arrayEventData['name_event'];
         $nameLocationEvent = $arrayEventData['name_location'];
         $locationEvent = $arrayEventData['location'].', '.$arrayEventData['name_city'];

         $rawEventValue = $arrayEventData['value'];
         $rawEventValueCommision = $arrayEventData['value_commission'];
         $rawEventTotal = $rawEventValue + $rawEventValueCommision;

         $eventValue = number_format($rawEventValue , 0, ',', '.');
         $eventValueCommision = number_format($rawEventValueCommision , 0, ',', '.');
         $eventValueTotal = number_format($rawEventTotal , 0, ',', '.');

         $ntickets = $arrayTransactionData['n_tickets'];

         $transactionCode = sprintf('%04d', $id_transaction);
         $eventCode = sprintf('%04d', $id_event);
         $typeCode = '02';
         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

         $errTyp = "success";
         $errMSG = "Este pago ya fue verificado";

       }
      } else {
       // Transacción rechazada
       $id_session = $response->{'sessionId'};
       $id_transaction = $response->{'buyOrder'};

       $authCode = $response->{'authorizationCode'};
       $paymentType = $response->{'paymentTypeCode'};
       $cuotas = $response->{'installmentsNumber'};
       $valorCuota = $response->{'installmentsAmount'};
       $lastDigits = $response->{'cardNumber'};

       $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_public LEFT JOIN events_public ON transactions_public.id_event = events_public.id_event WHERE order_transaction='$id_session' AND payment_status='pending'");
       $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
       $id_event = $arrayDataTransaction['id_event'];

       $transactionCode = sprintf('%04d', $id_transaction);
       $eventCode = sprintf('%04d', $id_event);
       $typeCode = '02';
       $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

       mysqli_query($conn, "UPDATE transactions_public SET payment_status='failed', method_transaction='$paymentType', cuotas_transaction='$cuotas', amount_cuota='$valorCuota', auth_code_transaction='$authCode', last_digits='$lastDigits' WHERE id_transaction_public='$id_transaction'");

       $errTyp = "danger";
       $errMSG = "Orden de compra rechazada";
      }
    }
  }else if(!empty($_GET['crowdfunding'])){

    $id_user = $_SESSION['user'];

    $token = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    if (!$token) {
        if(!empty($_GET['TBK_TOKEN']) || !empty($_POST['TBK_TOKEN'])){ //Pago abortado

          $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'];
          $id_transaction = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'];
          $id_session = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'];

          $id_transaction = mysqli_real_escape_string($conn, $id_transaction);
          $id_session = mysqli_real_escape_string($conn, $id_session);

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_projects WHERE order_transaction='$id_session' AND payment_status='pending'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_project = $arrayDataTransaction[1];

         $transactionCode = sprintf('%04d', $id_transaction);
         $eventCode = sprintf('%04d', $id_project);
         $typeCode = '05';
         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

          mysqli_query($conn, "UPDATE transactions_projects SET payment_status='aborted' WHERE id_transaction_project='$id_transaction' AND order_transaction='$id_session'");

          $errTyp = "danger";
          $errMSG = "Proceso de pago anulado";

        }elseif(!empty($_GET['TBK_ID_SESION']) || !empty($_POST['TBK_ID_SESION'])){ //Timeout


          $id_transaction = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'];
          $id_session = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'];

          $id_transaction = mysqli_real_escape_string($conn, $_POST['TBK_ORDEN_COMPRA']);
          $id_session = mysqli_real_escape_string($conn, $_POST['TBK_ID_SESION']);

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_projects WHERE order_transaction='$id_session' AND payment_status='pending'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_project = $arrayDataTransaction[1];

         $transactionCode = sprintf('%04d', $id_transaction);
         $eventCode = sprintf('%04d', $id_project);
         $typeCode = '05';
         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

          mysqli_query($conn, "UPDATE transactions_projects SET payment_status='timeout' WHERE id_transaction_project='$id_transaction' AND order_transaction='$id_session'");

          $errTyp = "danger";
          $errMSG = "Proceso de pago anulado";

        }
        // die ('No es un flujo de pago normal.');
    }else{

      $response = $transaction->commit($token);

      if ($response->isApproved()) {
        $webpayMethod = true;
       // Transacción Aprobada
       $id_session = $response->{'sessionId'};
       $id_transaction = $response->{'buyOrder'};

       $authCode = $response->{'authorizationCode'};
       $paymentType = $response->{'paymentTypeCode'};
       $cuotas = $response->{'installmentsNumber'};
       $valorCuota = $response->{'installmentsAmount'};
       $lastDigits = $response->{'cardNumber'};

       // Método de pago
       switch($paymentType){
         case 'VD':
           $cardType = 'Débito';
         break;

         case 'VN':
           $cardType = 'Crédito';
         break;

         case 'SI':
           $cardType = 'Crédito';
         break;

         case 'S2':
           $cardType = 'Crédito';
         break;

         case 'NC':
           $cardType = 'Crédito';
         break;

         case 'VP':
           $cardType = 'Prepago';
         break;
       }

       $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_projects WHERE order_transaction='$id_session' AND payment_status='pending'");
       if(mysqli_num_rows($queryCheckTransaction)>0){
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_user = $arrayDataTransaction[2];

         $id_project = $arrayDataTransaction[1];
         $id_transaction = $arrayDataTransaction['id_transaction_project'];
         $amount = $arrayDataTransaction['amount_transaction_project']+$arrayDataTransaction['amount_transaction_commission']+$arrayDataTransaction['amount_transaction_tip']+$arrayDataTransaction['amount_transaction_tip_commission'];

         $queryDataUser = mysqli_query($conn, "SELECT id_user, mail_user, first_name_user, last_name_user FROM users WHERE id_user='$id_user'");
         $arrayDataUser = mysqli_fetch_array($queryDataUser);

         $queryEventData = mysqli_query($conn, "SELECT * FROM projects_crowdfunding WHERE id_project='$id_project'");
         $arrayEventData = mysqli_fetch_array($queryEventData);

         $id_artist = $arrayEventData['id_user'];

         $queryDataArtist = mysqli_query($conn, "SELECT id_user, mail_user, nick_user FROM users WHERE id_user='$id_artist'");
         $arrayDataArtist = mysqli_fetch_array($queryDataArtist);

         // Calcular monto recaudado pre donación
           $queryBackersInfo = mysqli_query($conn, "SELECT id_project_backer, backer_amount, backer_added_amount, backer_fee FROM project_backers WHERE id_project='$id_project' AND status_backer='1'");
           $prBackersAmount = 0;
           while($totalArray = mysqli_fetch_array($queryBackersInfo)){
             $prBackersAmount = $prBackersAmount + $totalArray['backer_amount'] + $totalArray['backer_added_amount'];
           }
           if($prBackersAmount >= $arrayEventData['project_amount']){
             $prComplete = true;
           }else{
             $prComplete = false;
           }

       // Actualizar DB con donativo
         mysqli_query($conn, "UPDATE transactions_projects SET payment_status='paid', method_transaction='$paymentType', cuotas_transaction='$cuotas', amount_cuota='$valorCuota', auth_code_transaction='$authCode', last_digits='$lastDigits' WHERE id_transaction_project='$id_transaction'");

         $queryTransactionData = mysqli_query($conn, "SELECT * FROM transactions_projects WHERE id_project='$id_project' AND payment_status='paid' AND id_transaction_project='$id_transaction'");
         $arrayTransactionData = mysqli_fetch_array($queryTransactionData);

         $totalPostDonation = $prBackersAmount+$arrayTransactionData['amount_transaction_project']+$arrayTransactionData['amount_transaction_tip'];

         $dateTimeTransaction = date_create($arrayTransactionData['date_transaction']);
         $timeTransaction = DATE_FORMAT($dateTimeTransaction, 'H:i');
         $dateTransaction = DATE_FORMAT($dateTimeTransaction, 'd/m/Y');

         $idTransaction = $arrayTransactionData['id_transaction_project'];
         $id_project = $arrayTransactionData['id_project'];
         $transactionCode = sprintf('%04d', $idTransaction);
         $eventCode = sprintf('%04d', $id_project);
         $typeCode = '05';

         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

         mysqli_query($conn, "UPDATE project_backers SET status_backer='1' WHERE order_transaction='$id_session'");

         $NOMBRE_USUARIO = ucfirst($arrayDataUser['first_name_user']).' '.ucfirst($arrayDataUser['last_name_user']);
         $NOMBRE_BANDA = $arrayDataArtist['nick_user'];
         $NOMBRE_PROYECTO = $arrayEventData['project_title'];
         $NOMBRE_PATROCINADOR = ucfirst($arrayDataUser['first_name_user']).' '.ucfirst($arrayDataUser['last_name_user']);
         $CANTIDAD_PATROCINADOR = "$ ".number_format($arrayTransactionData['amount_transaction_project']+$arrayTransactionData['amount_transaction_tip'] , 0, ',', '.');

       // Check project complete or not
         if(!$prComplete){
           if($totalPostDonation>=$arrayEventData['project_amount']){
             mysqli_query($conn, "UPDATE projects_crowdfunding SET status_project='2' WHERE id_project='$id_project'");

             $textUser3 = $metaCumplidaMail.$NOMBRE_BANDA.$metaCumplidaMail1;
             $mail = new PHPMailer();
             $mail->Encoding = 'base64';
             $mail->CharSet = 'UTF-8';
             $mail->isHTML(true);
             $mail->SetFrom('crowdfunding@echomusic.cl', 'Soporte Crowdfunding Echomusic'); //Name is optional
             $mail->Subject   = 'Tu proyecto ha cumplido la meta';
             $mail->Body     = $textUser3;
             $mail->AddAddress($arrayDataArtist['mail_user']);
             $mail->addBCC('patrocinios@echomusic.cl');
             $mail->send();

           }
         }

         // AQUÍ VA EL CORREO AL PATROCINADOR
          $textUser1 = $nuevoPatrocinadorCMail.$NOMBRE_USUARIO.$nuevoPatrocinadorCMail2.$NOMBRE_PROYECTO."</b> que está llevando a cabo el(la) artista <b>".$NOMBRE_BANDA.$nuevoPatrocinadorCMail3;

           $mail = new PHPMailer();
           $mail->Encoding = 'base64';
           $mail->CharSet = 'UTF-8';
           $mail->isHTML(true);
           $mail->SetFrom('crowdfunding@echomusic.cl', 'Soporte Crowdfunding Echomusic'); //Name is optional
           $mail->Subject   = 'Comprobante de patrocinio crowdfunding';
           $mail->Body     = $textUser1;
           $mail->AddAddress($arrayDataUser['mail_user']);
           $mail->addBCC('patrocinios@echomusic.cl');
           $mail->send();

         // AQUÍ VA EL CORREO AL ARTISTA
          $textUser2 = $nuevoPatrocinadorMail.$NOMBRE_BANDA.$nuevoPatrocinadorMail1.$NOMBRE_PATROCINADOR."<br><b>Cantidad: </b>".$CANTIDAD_PATROCINADOR.$nuevoPatrocinadorMail2;
            $mail = new PHPMailer();
            $mail->Encoding = 'base64';
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
            $mail->SetFrom('crowdfunding@echomusic.cl', 'Soporte Crowdfunding Echomusic'); //Name is optional
            $mail->Subject   = 'Comprobante de patrocinio crowdfunding';
            $mail->Body     = $textUser2;
            $mail->AddAddress($arrayDataArtist['mail_user']);
            // $mail->addBCC('copiaentradas@echomusic.cl');
            $mail->send();

         $errTyp = "success";
         $errMSG = "Pago Verificado";
       }else{

         $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_projects WHERE order_transaction='$id_session' AND payment_status='paid'");
         $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
         $id_user = $arrayDataTransaction[2];

         $id_project = $arrayDataTransaction[1];
         $id_transaction = $arrayDataTransaction['id_transaction_project'];
         $amount = $arrayDataTransaction['amount_transaction_project']+$arrayDataTransaction['amount_transaction_commission']+$arrayDataTransaction['amount_transaction_tip']+$arrayDataTransaction['amount_transaction_tip_commission'];

         $queryDataUser = mysqli_query($conn, "SELECT id_user, mail_user, first_name_user, last_name_user FROM users WHERE id_user='$id_user'");
         $arrayDataUser = mysqli_fetch_array($queryDataUser);

         $queryEventData = mysqli_query($conn, "SELECT * FROM projects_crowdfunding WHERE id_project='$id_project'");
         $arrayEventData = mysqli_fetch_array($queryEventData);

         $queryTransactionData = mysqli_query($conn, "SELECT * FROM transactions_projects WHERE id_event='$id_project' AND payment_status='paid' AND id_transaction_project='$id_transaction'");
         $arrayTransactionData = mysqli_fetch_array($queryTransactionData);

         $dateTimeTransaction = date_create($arrayTransactionData['date_transaction']);
         $timeTransaction = DATE_FORMAT($dateTimeTransaction, 'H:i');
         $dateTransaction = DATE_FORMAT($dateTimeTransaction, 'd/m/Y');

         $idTransaction = $arrayTransactionData['id_transaction_project'];
         $id_project = $arrayTransactionData['id_project'];
         $transactionCode = sprintf('%04d', $idTransaction);
         $eventCode = sprintf('%04d', $id_project);
         $typeCode = '05';

         $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

         $errTyp = "success";
         $errMSG = "Este pago ya fue verificado";
       }
      } else {
       // Transacción rechazada
       $id_session = $response->{'sessionId'};
       $id_transaction = $response->{'buyOrder'};

       $authCode = $response->{'authorizationCode'};
       $paymentType = $response->{'paymentTypeCode'};
       $cuotas = $response->{'installmentsNumber'};
       $valorCuota = $response->{'installmentsAmount'};
       $lastDigits = $response->{'cardNumber'};

       // Query transacciones get payment code
       $queryCheckTransaction = mysqli_query($conn, "SELECT * FROM transactions_projects WHERE order_transaction='$id_session' AND payment_status='pending'");
       $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction);
       $id_project = $arrayDataTransaction[1];

       $transactionCode = sprintf('%04d', $id_project);
       $eventCode = sprintf('%04d', $id_project);
       $typeCode = '05';
       $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

       // Query transacción failed
       mysqli_query($conn, "UPDATE transactions_projects SET payment_status='failed', method_transaction='$paymentType', cuotas_transaction='$cuotas', amount_cuota='$valorCuota', auth_code_transaction='$authCode', last_digits='$lastDigits' WHERE id_transaction_project='$id_transaction'");

       $errTyp = "danger";
       $errMSG = "Orden de compra rechazada";
      }
    }

  }else{
    header('HTTP/1.1 403 Forbidden');
    die();
  }
?>
