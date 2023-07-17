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

// Check correct data
if(isset($_SESSION['user']) && $_SESSION['user']!=''){
  if(isset($_GET['public'])){

    $userid = $_SESSION['user'];

    if(FILTER_INPUT(INPUT_GET, 'public', FILTER_VALIDATE_INT,1)){
      $idEvent = trim($_GET['public']);
      $idEvent = mysqli_real_escape_string($conn, $idEvent);

      // Get url breadcrumb
      $breadCrumbUrl = "https://echomusic.cl/event.php?public=".$idEvent;
    }else{
      header('HTTP/1.1 403 Forbidden');
      die();
    }

    // Query event data
      $eventType = 2;

      $queryEventData = mysqli_query($conn, "SELECT * FROM events_public WHERE id_event='$idEvent'");
      $arrayEventData = mysqli_fetch_array($queryEventData);

      $dateEventNotice = date_create($arrayEventData['date_event']);

      $dateNotice = DATE_FORMAT($dateEventNotice, 'd-m-Y');

      $dateEventMail = DATE_FORMAT($dateEventNotice, 'd/m/Y');
      $timeEventMail = DATE_FORMAT($dateEventNotice, 'H:i');

      $timeNotice = DATE_FORMAT($dateEventNotice, 'H:i');

    // Query tickets
      $queryTicketsData = mysqli_query($conn, "SELECT * FROM tickets_public WHERE id_event='$idEvent'");
      $ticketDataArray = array();

      while($ticketsData = mysqli_fetch_array($queryTicketsData)){
      	$ticketsDataArray[] = $ticketsData;
      }


    // Check audience

      $queryTicketsAudience = mysqli_query($conn, "SELECT SUM(ticket_audience) AS total_tickets FROM tickets_public WHERE id_event='$idEvent'");
      $ticketsAudience = mysqli_fetch_array($queryTicketsAudience);

      $queryAudience = mysqli_query($conn, "SELECT COUNT(*) FROM subscribes_public WHERE id_event_public='$idEvent' AND subscribe_status='1'");
      $countAudience = mysqli_fetch_assoc($queryAudience)['COUNT(*)'];

      $totalAudience = $ticketsAudience['total_tickets'];



    // Check entradas disponibles
      if($totalAudience <= $countAudience){
        $audienceComplete = true;
        $error = true;
        $errMSG= "No existen entradas disponibles.";
      }elseif(strtotime('+12 hours', strtotime($arrayEventData['date_event']))<time()){
        $audienceComplete = true;
        $error = true;
        $errMSG= "No existen entradas disponibles.";
      }

    // payment event
      $paymentEvent = $arrayEventData['payment_event'];

    // Variables montos
      // $amountPlan = $arrayEventData['value'];
      $amountPlan = 0;
      $amountCommission = $arrayEventData['value_commission'];
      // $totalTransaction = $amountPlan+$amountCommission;
      $totalTransaction = 0;
      $totalTickets = 0;

  // PAGO DE EVENTOS PRESENCIALES
    if(isset($_POST['submit_data'])){

    // Get data
      $fname = trim($_POST['fname']);
      $fname = strip_tags($fname);
      $fname = htmlspecialchars($fname);
      $fname = mysqli_real_escape_string($conn, $fname);

      $lname = trim($_POST['lname']);
      $lname = strip_tags($lname);
      $lname = htmlspecialchars($lname);
      $lname= mysqli_real_escape_string($conn, $lname);

      $rut = trim($_POST['rut']);
      $rut = strip_tags($rut);
      $rut = htmlspecialchars($rut);
      $rut = mysqli_real_escape_string($conn, $rut);

      $email = trim($_POST['email']);
      $email = strip_tags($email);
      $email = htmlspecialchars($email);
      $email = mysqli_real_escape_string($conn, $email);


      if(FILTER_INPUT(INPUT_POST, 'method_payment', FILTER_VALIDATE_INT, 1)){
        $method_payment = trim($_POST['method_payment']);
        $method_payment = mysqli_real_escape_string($conn, $method_payment);
      }else if(empty($_POST['method_payment']) AND $paymentEvent==2){
        $error = true;
        $methodError = "Por favor elige un método de pago.";
      }else if(empty($_POST['method_payment']) AND $paymentEvent==1){
        $method='';
      }else{
        $error = true;
        $methodError = "Método de pago inválido.";
      }

       //Data Validation
        // fname
       if (empty($fname)) {
          $error = true;
          $fnameError = "Por favor ingresa tu nombre.";
        } else if (strlen($fname) < 3) {
          $error = true;
          $fnameError = "El nombre debe tener más de 3 caracteres";
        } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$fname)) {
          $error = true;
          $fnameError = "El nombre solo puede contener letras";
        }

        // lname
         if (empty($lname)) {
          $error = true;
          $lnameError = "Por favor ingresa tu apellido.";
        } else if (strlen($lname) < 3) {
          $error = true;
          $lnameError = "El apellido debe tener más de 3 caracteres";
        } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$lname)) {
          $error = true;
          $lnameError = "El apellido solo puede contener letras";
         }

      // Check RUT
        if(valida_rut($rut) == false){
          $error = true;
          $rutError = "Por favor ingresa un RUT válido.";
        }

      // Check Email
        if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
         $error = true;
         $emailError = "Por favor ingresa una dirección de correo válida";
        }

    // Check entries
      foreach($ticketsDataArray as $ticketsData){
        $i = $ticketsData['id_ticket'];
        $amountPlan = $ticketsData['ticket_value'];
        $amountCommission = $ticketsData['ticket_commission'];

        // echo $_POST['nTicket'][$i];
        $nTickets = trim($_POST['nTicket'][$i]);
        $nTickets = mysqli_real_escape_string($conn, $nTickets);

        if(!preg_match("/^[0-9]*$/", $nTickets)){
          $error = true;
          $nTicketsError = "La cantidad de entradas solo puede contener números.";
        }else if($nTickets=='' && $nTickets!=0){
          $error = true;
          $nTicketsError = "Por favor elige cuantas entradas quieres.";
        }

        // if(time()<strtotime($ticketsData['ticket_dateStart']) || time()>strtotime($ticketsData['ticket_dateEnd'])){
        //   $error = true;
        //   $nTicketsError = "Una o más entradas no están disponibles.";
        // }

        $nTickets = (int)$nTickets;

      // Check audience
        $queryAudience = mysqli_query($conn, "SELECT COUNT(*) FROM subscribes_public WHERE id_ticket='$i' AND subscribe_status='1'");
        $countAudience = mysqli_fetch_assoc($queryAudience)['COUNT(*)'];
        $totalAudience = $ticketsData['ticket_audience'];

        $ticketsAvailable = $totalAudience-$countAudience;

        $arrayTickets[$i] = $nTickets;

      // Check entradas disponibles
        if($ticketsAvailable<$nTickets){
          $error = true;
          $nTicketsError= "Una o más entradas seleccionadas se encuentran agotadas.";
        }

      // total amount

        $amountPlan = intval($amountPlan*$nTickets);
        $amountCommission = intval($amountCommission*$nTickets);
        $totalPlan = $totalPlan+$amountPlan;
        $totalCommission = $totalCommission+$amountCommission;
        $totalTransaction = $totalTransaction+$amountPlan+$amountCommission;
        $totalTickets = $totalTickets+$nTickets;

      // total tickets control
        if($nTickets>10){
            $error = true;
            $nticketsError = "Lo sentimos, no puedes comprar más de 10 entradas.";
        }

        if($nTickets>2 && $paymentEvent==1){
            $error = true;
            $nTicketsError = "Lo sentimos, no puedes comprar más de 2 entradas.";
        }
        // cantidad de entradas por entrada
        // monto total
        // id ticket
        // generar un array
      }


      $dateTransaction = date('Y-m-d H:i:s', time());

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


      // echo "INSERT INTO subscribes_public (id_event_public, id_user, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email, order_transaction, subscribe_status) VALUES $values";

    // if there's no error
      if(!$error){

          $queryTransaction = mysqli_query($conn, "INSERT INTO transactions_public(id_event, id_type_event, id_user, n_tickets, amount_transaction_public, amount_transaction_commission, payment_status) VALUES ('$idEvent', '$eventType', '$userid', '$totalTickets', '$totalPlan', '$totalCommission', 'pending')");

          $checkTransaction = mysqli_query($conn, "SELECT id_transaction_public FROM transactions_public WHERE id_event='$idEvent' AND id_type_event='$eventType' AND payment_status='pending' AND id_user='$userid' AND id_transaction_public=(SELECT MAX(id_transaction_public) FROM transactions_public WHERE id_event='$idEvent' AND id_user='$userid')");

          $arrayTransaction = mysqli_fetch_array($checkTransaction);

          $id_transaction = $arrayTransaction['id_transaction_public'];


        // Check if amount is 0

        if($paymentEvent == 1){

          $session_id = random_str(12);

          foreach($arrayTickets as $ticketsKey=>$nTickets){
            for($y = 1; $y <=$nTickets; $y++){
              $sqlSubscribe .= "INSERT INTO subscribes_public (id_event_public, id_user, id_ticket, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email, order_transaction, subscribe_status) VALUES ('$idEvent', '$userid', '$ticketsKey', '$fname', '$lname', '$rut', '$email', '$session_id', '0');";
            }
          }
          mysqli_multi_query($conn, $sqlSubscribe);
          while (mysqli_next_result($conn)) // flush multi_queries
            {
              if (!mysqli_more_results($conn)) break;
            }
          mysqli_query($conn, "UPDATE transactions_public SET payment_status='paid', order_transaction='$session_id' WHERE id_event='$idEvent' AND id_type_event='$eventType' AND id_transaction_public='$id_transaction' ");

          $queryDataUser = mysqli_query($conn, "SELECT id_user, tickets_public.ticket_name, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email FROM subscribes_public LEFT JOIN tickets_public ON tickets_public.id_ticket=subscribes_public.id_ticket WHERE order_transaction='$session_id' LIMIT 1");
          $arrayDataUser = mysqli_fetch_array($queryDataUser);

          $queryEventData = mysqli_query($conn, "SELECT * FROM events_public LEFT JOIN cities ON cities.id_city=events_public.id_city WHERE id_event='$idEvent'");
          $arrayEventData = mysqli_fetch_array($queryEventData);

          $queryTransactionData = mysqli_query($conn, "SELECT * FROM transactions_public WHERE id_event='$idEvent' AND payment_status='paid' AND id_transaction_public='$id_transaction'");
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
          $eventCode = sprintf('%04d', $idEvent);
          $typeCode = '02';
          $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

          $nameEvent = $arrayEventData['name_event'];
          $nameLocationEvent = $arrayEventData['name_location'];
          $locationEvent = $arrayEventData['location'].', '.$arrayEventData['name_city'];

          $rawEventValue = $arrayTransactionData['amount_transaction_public'];
          $rawEventValueCommision = $arrayTransactionData['amount_transaction_commission'];
          $rawEventTotal = $rawEventValue + $rawEventValueCommision;

          $singleTicketValue = $arrayEventData['value'];
          $singleTicketCommission = $arrayEventData['value_commission'];
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
          // $fee = 16;
          // $commissionEvent = 0;
          // $a = $rawEventTotal / 100;
          // $a = $a * $fee;
          $iva= intval(0);

          // set mail user
          $emailUser = $arrayDataUser['subscribe_email'];
          // Ticket name
          $ticketName = $arrayDataUser['ticket_name'];

          // Start mail object
            $mail = new PHPMailer();
            $mail->Encoding = 'base64';
            $mail->CharSet = 'UTF-8';

          // Get ids subscribes
          $querySubscribes = mysqli_query($conn, "SELECT id_subscribe_public FROM subscribes_public WHERE order_transaction='$session_id'");

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

           $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/images/tmp3']);
           $mpdf->WriteHTML($cuerpoTicketMail);
           // $mpdf->Output(__DIR__ . '/images/tmp3/'.$pdfName.'.pdf', 'F');
           $mpdf->Output(ROOT_PATH . 'images/tickets/'.$pdfName.'.pdf', 'F');

           // $mail->addAttachment(__DIR__ . '/images/tmp3/'.$pdfName.'.pdf', $id_subscribe.'.pdf');
           $mail->addAttachment(ROOT_PATH. 'images/tickets/'.$pdfName.'.pdf', $id_subscribe.'.pdf');

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

          // $_SESSION['success'] = "Suscripción exitosa";

          header( "Location: https://echomusic.cl/payment_verification.php?check=".$session_id );

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
          $return_url = 'https://echomusic.cl/payment_verification.php?public='.$idEvent;

        // create order
          $response = $transaction->create($buy_order, $session_id, $amount, $return_url);

          $url_payment = $response->url;
          $token_payment = $response->token;

          $_SESSION['url'] = $url_payment;
          $_SESSION['token'] = $token_payment;
          $_SESSION['method'] = '1';

          mysqli_query($conn, "UPDATE transactions_public SET order_transaction='$session_id' WHERE id_transaction_public='$id_transaction'");
          // mysqli_query($conn, "INSERT INTO subscribes_public (id_event_public, id_user, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email, order_transaction, subscribe_status) VALUES ('$idEvent', '$userid', '$fname', '$lname', '$rut', '$email', '$session_id', '0')");
          // Prepare multi_query subscribes
          foreach($arrayTickets as $ticketsKey=>$nTickets){
            for($y = 1; $y <=$nTickets; $y++){
              $sqlSubscribe .= "INSERT INTO subscribes_public (id_event_public, id_user, id_ticket, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email, order_transaction, subscribe_status) VALUES ('$idEvent', '$userid', '$ticketsKey', '$fname', '$lname', '$rut', '$email', '$session_id', '0');";
            }
          }

          mysqli_multi_query($conn, $sqlSubscribe);
          while (mysqli_next_result($conn)) // flush multi_queries
            {
              if (!mysqli_more_results($conn)) break;
            }

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
                    "return_url" => "https://echomusic.cl/payment_verification.php?public=$idEvent",
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

      } else{
         $errTyp = "danger";
         $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";
      }
    }
  }else{
    header('HTTP/1.1 403 Forbidden');
    die();
  }

  if(isset($_SESSION['method'])){
      $checkTransaction = mysqli_query($conn, "SELECT id_transaction_public FROM transactions_public WHERE id_event='$idEvent' AND id_type_event='$eventType' AND payment_status='pending' AND id_user='$userid' AND id_transaction_public=(SELECT MAX(id_transaction_public) FROM transactions_public WHERE id_event='$idEvent' AND id_user='$userid')");
      $userDataTransaction = mysqli_fetch_array($checkTransaction);
  }

}else{
  $plsLogin = true;
}
// Header to Khipu payment

if(isset($response) && $_SESSION['method']=='2'){

  $payment_id = $response['payment_id'];

  mysqli_query($conn, "UPDATE transactions_public SET order_transaction='$payment_id' WHERE id_transaction_public='$id_transaction'");
  foreach($arrayTickets as $ticketsKey=>$nTickets){
    for($y = 1; $y <=$nTickets; $y++){
      $sqlSubscribe .= "INSERT INTO subscribes_public (id_event_public, id_user, id_ticket, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email, order_transaction, subscribe_status) VALUES ('$idEvent', '$userid', '$ticketsKey', '$fname', '$lname', '$rut', '$email', '$payment_id', '0');";
    }
  }
  // mysqli_query($conn, "INSERT INTO subscribes_public (id_event_public, id_user, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email, order_transaction, subscribe_status) VALUES ('$idEvent', '$userid', '$fname', '$lname', '$rut', '$email', '$payment_id', '0')");
  mysqli_multi_query($conn, $sqlSubscribe);
  while (mysqli_next_result($conn)) // flush multi_queries
    {
      if (!mysqli_more_results($conn)) break;
    }
  $payment_url = $response['payment_url'];
  $_SESSION['url'] = $payment_url;

}





 ?>
