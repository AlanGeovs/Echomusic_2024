<?php

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

  // Get JSON data
$content_json  = file_get_contents('php://input');
$payload = json_decode($content_json, true);

// Get headers
$headers = getallheaders();

// Merchant secret_key
$secret = 'eb17bfe3-bddc-4408-9e1e-03b83239264c';

ksort($payload);

$signature = hash_hmac('sha256', json_encode($payload), $secret);

// Check data integrity
if (!empty($headers['X-Pg-Sig']) && $headers['X-Pg-Sig'] == $signature) {

  $id_session = $payload['custom'];

  $queryCheckTransaction_5 = mysqli_query($conn, "SELECT * FROM transactions_projects LEFT JOIN projects_crowdfunding ON transactions_projects.id_project = projects_crowdfunding.id_project WHERE order_transaction='$id_session' AND payment_status='pending'");

  if(mysqli_num_rows($queryCheckTransaction_5)>0){

    $arrayDataTransaction = mysqli_fetch_array($queryCheckTransaction_5);

    // Variables

    $id_project = $arrayDataTransaction['id_project'];

    $userid = $arrayDataTransaction[2];

    $id_transaction = $arrayDataTransaction['id_transaction_project'];

    $amount = $arrayDataTransaction['amount_transaction_project']+$arrayDataTransaction['amount_transaction_commission']+$arrayDataTransaction['amount_transaction_tip']+$arrayDataTransaction['amount_transaction_tip_commission'];

    $payload['price'] = (int)$payload['price'];


    if ($payload['status'] == 'completed' && $payload['price'] == $amount) {


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

        mysqli_query($conn, "UPDATE project_backers SET status_backer='1' WHERE order_transaction='$id_session'");

        $queryDataUser = mysqli_query($conn, "SELECT id_user, mail_user, first_name_user, last_name_user FROM users WHERE id_user='$userid'");
        $arrayDataUser = mysqli_fetch_array($queryDataUser);


        $queryDataArtist = mysqli_query($conn, "SELECT id_user, mail_user, nick_user FROM users WHERE id_user='$id_artist'");
        $arrayDataArtist = mysqli_fetch_array($queryDataArtist);

        $dateTimeTransaction = date_create($arrayTransactionData['date_transaction']);
        $timeTransaction = DATE_FORMAT($dateTimeTransaction, 'H:i');
        $dateTransaction = DATE_FORMAT($dateTimeTransaction, 'd/m/Y');

        $idTransaction = $arrayTransactionData['id_transaction_project'];
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


  }


}

http_response_code(200);

 ?>
