<?php
define('ROOT_PATH', dirname(__DIR__) . '/');

include 'connect.php';
include 'eventoConfirmadoMail.php';
include 'eventoPublicadoMail.php';
include 'compraTicketMail.php';
include 'ticketPresencialMail.php';
include 'ticketMailPdf.php';
include 'metaCumplidaMail.php';
include 'nuevoPatrocinadorArtistaMail.php';
include 'nuevoPatrocinadorClienteMail.php';
require '../vendor/autoload.php';

include '../phpqrcode/qrlib.php';

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

if(!empty($_POST)){

  $receiver_id = 400724;
  $secret = 'cb8a44364a896177330666f8949e57f70dcd2c1a';

  // $receiver_id = 278124;
  // $secret = 'e63a0203a564843ca4b39e8a0908dda28974815e';

  $api_version = $_POST['api_version'];  // Parámetro api_version
  $notification_token = $_POST['notification_token']; //Parámetro notification_token


  try {

      if ($api_version == '1.3') {

          $configuration = new Khipu\Configuration();

          $configuration->setSecret($secret);

          $configuration->setReceiverId($receiver_id);

          // $configuration->setDebug(true);

          $client = new Khipu\ApiClient($configuration);

          $payments = new Khipu\Client\PaymentsApi($client);



          $response = $payments->paymentsGet($notification_token);

          // Check transaction_id and event_id

          $id_khipu_transaction = $response['payment_id'];

          $queryCheckTransaction_1 = mysqli_query($conn, "SELECT * FROM transactions_events LEFT JOIN events_private ON transactions_events.id_event = events_private.id_event WHERE order_transaction='$id_khipu_transaction' AND payment_status='pending'");

          $queryCheckTransaction_2= mysqli_query($conn, "SELECT * FROM transactions_visibility LEFT JOIN events_public ON transactions_visibility.id_event = events_public.id_event WHERE order_transaction='$id_khipu_transaction' AND payment_status='pending'");

          $queryCheckTransaction_3 = mysqli_query($conn, "SELECT * FROM transactions_streaming LEFT JOIN events_streaming ON transactions_streaming.id_event = events_streaming.id_event WHERE order_transaction='$id_khipu_transaction' AND payment_status='pending'");

          $queryCheckTransaction_4 = mysqli_query($conn, "SELECT * FROM transactions_public LEFT JOIN events_public ON transactions_public.id_event = events_public.id_event WHERE order_transaction='$id_khipu_transaction' AND payment_status='pending'");

          $queryCheckTransaction_5 = mysqli_query($conn, "SELECT * FROM transactions_projects LEFT JOIN projects_crowdfunding ON transactions_projects.id_project = projects_crowdfunding.id_project WHERE order_transaction='$id_khipu_transaction' AND payment_status='pending'");

          if(mysqli_num_rows($queryCheckTransaction_1)>0){

            $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction_1);

            // Variables

            $id_event = $arrayDataTransaction['id_event'];

            $id_transaction = $arrayDataTransaction['id_transaction_event'];

            $amount = $arrayDataTransaction['value_plan_event']+$arrayDataTransaction['commission_plan_event'];

            // Continue kihpu code

            if ($response->getReceiverId() == $receiver_id) {

                if ($response->getStatus() == 'done' && $response->getAmount() == $amount) {



                  mysqli_query($conn, "UPDATE events_private SET status_payment='paid', status_event='confirmed' WHERE id_event='$id_event'");

                  mysqli_query($conn, "UPDATE transactions_events SET payment_status='paid' WHERE id_transaction_event='$id_transaction'");



                  $queryDataUser = mysqli_query($conn, "SELECT mail_user, last_name_user, first_name_user, phone_event FROM users LEFT JOIN events_private ON events_private.id_user_buy = users.id_user WHERE events_private.id_event='$id_event'");

                  $queryDataArtist = mysqli_query($conn, "SELECT mail_user, last_name_user, first_name_user, phone FROM users LEFT JOIN events_private ON events_private.id_user_sell = users.id_user LEFT JOIN user_data ON user_data.id_user = users.id_user WHERE events_private.id_event='$id_event'");

                  $queryDataEvent = mysqli_query($conn, "SELECT * FROM events_private WHERE id_event='$id_event'");

                  $arrayDataUser = mysqli_fetch_array($queryDataUser);

                  $arrayDataArtist = mysqli_fetch_array($queryDataArtist);

                  $arrayDataEvent = mysqli_fetch_array($queryDataEvent);



                  // Mails with contact data

                 //mail al usuario
                   $textUser = $eventoconfmail.$arrayDataEvent['name_event'].$eventoCONFAmail2.' <p style="margin: 0.5rem 1rem;"><strong>'.ucfirst($arrayDataUser['first_name_user']).' '.ucfirst($arrayDataUser['last_name_user']).'</strong><br>Teléfono: <strong><a href="tel:+56'.$arrayDataUser['phone_event'].'">'.$arrayDataUser['phone_event'].'</a></strong> <br> Correo: '.$arrayDataUser['mail_user']."</p>".$eventoconfmail3.'
                    <p style="margin: 0.5rem 1rem;">
                    Nombre del Evento: <strong>'.$arrayDataEvent['name_event'].'</strong> <br>

                    Dirección del Evento: <strong>'.$arrayDataEvent['location'].'</strong> <br>

                    Fecha del Evento: <strong>'.$arrayDataEvent['date_event'].'</strong></p>'.$eventoconfmail4;

                  $headersUser = "MIME-Version: 1.0" . "\r\n";

                  $headersUser .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                  $headersUser .= "From: reservas@echomusic.cl" . "\r\n";
                  $headersUser .= "Bcc: copiaentradas@echomusic.cl\r\n";

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
                  $headersArtist .= "Bcc: copiaentradas@echomusic.cl\r\n";

                  $emailUser = $arrayDataUser['mail_user'];

                  mail($emailUser, "¡Felicitaciones! Tu evento ha sido confirmado", $textArtist, $headersArtist);



                  http_response_code(200);

                }

            } else {



                // receiver_id no coincide

            }

          }else if(mysqli_num_rows($queryCheckTransaction_2)>0){

            $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction_2);

            // Variables

            $id_event = $arrayDataTransaction['id_event'];

            $id_transaction = $arrayDataTransaction['id_transaction_event'];

            $amount = $arrayDataTransaction['amount_transaction_visibility'];

            // Continue kihpu code

            if ($response->getReceiverId() == $receiver_id) {

                if ($response->getStatus() == 'done' && $response->getAmount() == $amount) {



                  mysqli_query($conn, "UPDATE events_public SET active_event='1' WHERE id_event='$id_event'");

                  mysqli_query($conn, "UPDATE transactions_visibility SET payment_status='paid' WHERE id_transaction_visibility='$id_transaction'");



                  $queryDataUser = mysqli_query($conn, "SELECT mail_user, last_name_user, first_name_user FROM users LEFT JOIN events_public ON events_public.id_user = users.id_user WHERE events_public.id_event='$id_event'");

                  $queryDataEvent = mysqli_query($conn, "SELECT * FROM events_public WHERE id_event='$id_event'");

                  $arrayDataUser = mysqli_fetch_array($queryDataUser);

                  $arrayDataEvent = mysqli_fetch_array($queryDataEvent);



                  // Mails with contact data




                  /*$text = '<html><p>Felicitaciones, el evento: <strong>'.$arrayDataEvent['name_event'].'</strong> ha sido publicado. </p>

                                  <p> Datos del Evento </br>

                                    Nombre del Evento: <strong>'.$arrayDataEvent['name_event'].'</strong> </br>

                                    Dirección del Evento: <strong>'.$arrayDataEvent['location'].'</strong> </br>

                                    Fecha del Evento: <strong>'.$arrayDataEvent['date_event'].'</strong></p>

                                    <p>Equipo Echomusic</p></html>';*/

                   $text = $eventopubmail.$arrayDataEvent['name_event'].$eventopubmail3.'<p style="margin: 0.5rem 1rem;">
                          Nombre del Evento: <strong>'.$arrayDataEvent['name_event'].'</strong> <br>
                          Dirección del Evento: <strong>'.$arrayDataEvent['location'].'</strong> <br>
                          Fecha del Evento: <strong>'.$arrayDataEvent['date_event'].'</strong></p>'.$eventopubmail4;

                  $headers = "MIME-Version: 1.0" . "\r\n";

                  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                  $headers .= "From: reservas@echomusic.cl" . "\r\n";
                  $headers .= "Bcc: copiaentradas@echomusic.cl\r\n";

                  $emailUser = $arrayDataUser['mail_user'];

                  mail($emailUser, "Felicitaciones, tu evento ha sido publicado", $text, $headers);



                  http_response_code(200);

                }

            } else {



                // receiver_id no coincide

            }

          }else if(mysqli_num_rows($queryCheckTransaction_3)>0){

            $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction_3);

            // Variables

            $id_event = $arrayDataTransaction['id_event'];

            $userid = $arrayDataTransaction[3];

            $id_transaction = $arrayDataTransaction['id_transaction_streaming'];

            $amount = $arrayDataTransaction['amount_transaction_streaming']+$arrayDataTransaction['amount_transaction_commission']+$arrayDataTransaction['amount_transaction_tip']+$arrayDataTransaction['amount_transaction_tip_commission'];

            // Continue kihpu code

            if ($response->getReceiverId() == $receiver_id) {

                if ($response->getStatus() == 'done' && $response->getAmount() == $amount) {





                  mysqli_query($conn, "UPDATE transactions_streaming SET payment_status='paid' WHERE id_transaction_streaming='$id_transaction'");

                  if(mysqli_affected_rows($conn)){

                    mysqli_query($conn, "UPDATE subscribes_streaming SET subscribe_status='1' WHERE order_transaction='$id_khipu_transaction'");


                    $queryDataUser = mysqli_query($conn, "SELECT id_user, mail_user, first_name_user, last_name_user FROM users WHERE id_user='$userid'");

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
                    $idEvent = $arrayTransactionData['id_event'];
                    $transactionCode = sprintf('%04d', $idTransaction);
                    $eventCode = sprintf('%04d', $idEvent);
                    $typeCode = '04';

                    $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;

                    // Mails with contact data

                    /*$textUser = '<html><p>Compra completada</p>

                                  <p> Datos del Evento </br>

                                    Nombre del Evento: <strong>'.$arrayEventData['name_event'].'</strong> </br>

                                    Dirección del Evento: <strong> https://qa.echomusic.cl/streaming.php?event='.$id_event.'</strong> </br>

                                    <p>Equipo Echomusic</p></html>';*/

                $textUser = $pagoeventomail.'<p style="margin: 0.5rem 1rem;">
                Nombre usuario: <strong> '.ucfirst($arrayDataUser['first_name_user']).' '.ucfirst($arrayDataUser['last_name_user']).'</strong>
                '.$pagoeventomail2;

                $textUser.='<p style="margin: 0.5rem 1rem;">Nombre del Evento: <strong>'.$arrayEventData['name_event'].'</strong> <br>
                Link evento: <strong> https://qa.echomusic.cl/streaming.php?event='.$arrayEventData['id_event'].'</strong><br>
                Fecha y Hora: <strong> '.$dateEventMail.' a las '.$timeEventMail.' hrs. </strong> </p>'.$pagoeventomail3;


                    $headersUser = "MIME-Version: 1.0" . "\r\n";

                    $headersUser .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                    $headersUser .= "From: eventos@echomusic.cl" . "\r\n";
                    $headersUser .= "Bcc: copiaentradas@echomusic.cl\r\n";

                    $emailUser = $arrayDataUser['mail_user'];

                    mail($emailUser, "Comprobante de compra streaming", $textUser, $headersUser);



                    http_response_code(200);

                  }



                }

            } else {



                // receiver_id no coincide

            }



          }else if(mysqli_num_rows($queryCheckTransaction_4)>0){

            $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction_4);

            // Variables

            $id_event = $arrayDataTransaction['id_event'];

            $userid = $arrayDataTransaction[3];

            $id_transaction = $arrayDataTransaction['id_transaction_public'];

            $amount = $arrayDataTransaction['amount_transaction_public']+$arrayDataTransaction['amount_transaction_commission'];




            // Continue kihpu code

            if ($response->getReceiverId() == $receiver_id) {

                if ($response->getStatus() == 'done' && $response->getAmount() == $amount) {


                  mysqli_query($conn, "UPDATE transactions_public SET payment_status='paid' WHERE id_transaction_public='$id_transaction'");

                  if(mysqli_affected_rows($conn)){

                    $queryDataUser = mysqli_query($conn, "SELECT id_user, tickets_public.ticket_name, tickets_public.ticket_value, tickets_public.ticket_commission, subscribe_fname, subscribe_lname, subscribe_rut, subscribe_email FROM subscribes_public LEFT JOIN tickets_public ON tickets_public.id_ticket=subscribes_public.id_ticket WHERE id_user='$userid' AND order_transaction='$id_khipu_transaction' LIMIT 1");

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

                    $idTransaction = $arrayTransactionData['id_transaction_public'];
                    $idEvent = $arrayTransactionData['id_event'];
                    $transactionCode = sprintf('%04d', $idTransaction);
                    $eventCode = sprintf('%04d', $idEvent);
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

                   $mail = new PHPMailer();
                   $mail->Encoding = 'base64';
                   $mail->CharSet = 'UTF-8';

                   // Get ids subscribes
                   $querySubscribes = mysqli_query($conn, "SELECT id_subscribe_public FROM subscribes_public WHERE order_transaction='$id_khipu_transaction'");


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

                $errTyp = "success";
                $errMSG = "Pago Verificado";


                http_response_code(200);

              }



            }
              }else {



                // receiver_id no coincide

            }

            } else if(mysqli_num_rows($queryCheckTransaction_5)>0){

              $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction_5);

              // Variables

              $id_project = $arrayDataTransaction['id_project'];

              $userid = $arrayDataTransaction[2];

              $id_transaction = $arrayDataTransaction['id_transaction_project'];

              $amount = $arrayDataTransaction['amount_transaction_project']+$arrayDataTransaction['amount_transaction_commission']+$arrayDataTransaction['amount_transaction_tip']+$arrayDataTransaction['amount_transaction_tip_commission'];

              // Continue kihpu code

              if ($response->getReceiverId() == $receiver_id) {

                  if ($response->getStatus() == 'done' && $response->getAmount() == $amount) {

                    $queryProjectData = mysqli_query($conn, "SELECT * FROM projects_crowdfunding WHERE id_project='$id_project'");
                    $arrayProjectData = mysqli_fetch_array($queryProjectData);

                    $id_artist = $arrayProjectData['id_user'];

                    // Calcular monto recaudado pre donación
                      $queryBackersInfo = mysqli_query($conn, "SELECT id_project_backer, backer_amount, backer_added_amount, backer_fee FROM project_backers WHERE id_project='$id_project' AND status_backer='1'");
                      $prBackersAmount = 0;
                      while($totalArray = mysqli_fetch_array($queryBackersInfo)){
                        $prBackersAmount = $prBackersAmount + $totalArray['backer_amount'] + $totalArray['backer_added_amount'];
                      }
                      if($prBackersAmount >= $arrayProjectData['project_amount']){
                        $prComplete = true;
                      }else{
                        $prComplete = false;
                      }

                    mysqli_query($conn, "UPDATE transactions_projects SET payment_status='paid' WHERE id_transaction_project='$id_transaction'");

                    if(mysqli_affected_rows($conn)){

                    $queryTransactionData = mysqli_query($conn, "SELECT * FROM transactions_projects WHERE id_project='$id_project' AND payment_status='paid' AND id_transaction_project='$id_transaction'");
                    $arrayTransactionData = mysqli_fetch_array($queryTransactionData);

                    $totalPostDonation = $prBackersAmount+$arrayTransactionData['amount_transaction_project']+$arrayTransactionData['amount_transaction_tip'];

                    mysqli_query($conn, "UPDATE project_backers SET status_backer='1' WHERE order_transaction='$id_khipu_transaction'");

                    $queryDataUser = mysqli_query($conn, "SELECT id_user, mail_user, first_name_user, last_name_user FROM users WHERE id_user='$userid'");
                    $arrayDataUser = mysqli_fetch_array($queryDataUser);


                    $queryDataArtist = mysqli_query($conn, "SELECT id_user, mail_user, nick_user FROM users WHERE id_user='$id_artist'");
                    $arrayDataArtist = mysqli_fetch_array($queryDataArtist);

                    $dateTimeTransaction = date_create($arrayTransactionData['date_transaction']);
                    $timeTransaction = DATE_FORMAT($dateTimeTransaction, 'H:i');
                    $dateTransaction = DATE_FORMAT($dateTimeTransaction, 'd/m/Y');

                    $idTransaction = $arrayTransactionData['id_transaction_streaming'];
                    $id_project = $arrayTransactionData['id_project'];
                    $transactionCode = sprintf('%04d', $idTransaction);
                    $projectCode = sprintf('%04d', $id_project);
                    $typeCode = '05';

                    $paymentCode = $transactionCode.'-'.$projectCode.'-'.$typeCode;

                    $NOMBRE_USUARIO = ucfirst($arrayDataUser['first_name_user']).' '.ucfirst($arrayDataUser['last_name_user']);
                    $NOMBRE_BANDA = $arrayDataArtist['nick_user'];
                    $NOMBRE_PROYECTO = $arrayProjectData['project_title'];
                    $NOMBRE_PATROCINADOR = ucfirst($arrayDataUser['first_name_user']).' '.ucfirst($arrayDataUser['last_name_user']);
                    $CANTIDAD_PATROCINADOR = "$ ".number_format($arrayTransactionData['amount_transaction_project']+$arrayTransactionData['amount_transaction_tip'] , 0, ',', '.');

                    // Check project complete or not
                      if(!$prComplete){
                        if($totalPostDonation>=$arrayProjectData['project_amount']){
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


                    http_response_code(200);

                    }

                  }

            }else {

                // receiver_id no coincide

            }



          }



      } else {



          // Usar versión anterior de la API de notificación

      }

  } catch (\Khipu\ApiException $exception) {

      print_r($exception->getResponseObject());

  }

}else{

  die();

}



?>
