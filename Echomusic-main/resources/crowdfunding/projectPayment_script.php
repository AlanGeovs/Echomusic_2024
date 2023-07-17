<?php
// Conectar a la DB
  include 'resources/connect.php';
  include 'resources/functionDateTranslate.php';
  require './vendor/autoload.php';
  use Transbank\Webpay\WebpayPlus\Transaction;

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

if(isset($_GET['tier'])){
	  // Data Validation
    if(!FILTER_INPUT(INPUT_GET, 'tier', FILTER_VALIDATE_INT, 1)){
       $error = true;
       $errTyp = "La información no es válida.";
     }else{
    	$tierId = trim($_GET['tier']);
      $tierId = strip_tags($tierId);
      $tierId = htmlspecialchars($tierId);
      $tierId = mysqli_real_escape_string($conn, $tierId);
    }


  // Query tiers y recompensas
    $queryProjectTiers = mysqli_query($conn, "SELECT * FROM project_tiers WHERE id_tier='$tierId' AND status_tier='1'");
    if(mysqli_num_rows($queryProjectTiers)<1){
      http_response_code(404);
      header("HTTP/1.0 404 Not Found");
      die();
    }
    $projectTierArray = mysqli_fetch_array($queryProjectTiers);

  // project id
    $prId = $projectTierArray['id_project'];

  // Query información general del proyecto
    $queryDataProject = mysqli_query($conn, "SELECT * FROM projects_crowdfunding LEFT JOIN project_desc ON projects_crowdfunding.id_project=project_desc.id_project
                                                                                 LEFT JOIN regions ON projects_crowdfunding.project_region = regions.id_region WHERE projects_crowdfunding.id_project='$prId'");
    $dataProjectArray = mysqli_fetch_assoc($queryDataProject);

    if($dataProjectArray['status_project']=='4' || $dataProjectArray['status_project']=='3' || $dataProjectArray['status_project']=='5' || $dataProjectArray['status_project']=='0'){
      http_response_code(404);
      header("HTTP/1.0 404 Not Found");
      die();
    }

  // Calcular monto recaudado
    $queryBackersInfo = mysqli_query($conn, "SELECT id_project_backer, backer_amount, backer_added_amount, backer_fee FROM project_backers WHERE id_project='$prId' AND status_backer='1'");
    $totalBackers = mysqli_num_rows($queryBackersInfo);
    $prBackersAmount = 0;
    while($totalArray = mysqli_fetch_array($queryBackersInfo)){
      $prBackersAmount = $prBackersAmount + $totalArray['backer_amount'] + $totalArray['backer_added_amount'];
    }

  // Calcular porcentaje recaudado
    $x = $prBackersAmount*100;
    $x = $x / $dataProjectArray['project_amount'];
    $prBackersPercentage = $x;
    unset($x);
    $prBackersPercentage = intval($prBackersPercentage);

  // Id artista
    $artistId = $dataProjectArray['id_user'];

  // Query info del artista
    $queryArtistProject = mysqli_query($conn, "SELECT * FROM users LEFT JOIN desc_user ON users.id_user = desc_user.id_user
                                                                   LEFT JOIN type_musician ON users.id_musician = type_musician.id_musician
                                                                   LEFT JOIN instruments ON users.id_instrument = instruments.id_instrument
                                                                   LEFT JOIN regions ON users.id_region = regions.id_region
                                                                   LEFT JOIN cities ON users.id_city = cities.id_city WHERE users.id_user='$artistId'");
    $artistProjectArray = mysqli_fetch_assoc($queryArtistProject);

  // Generate Fee
    $fee = 0;
    $y = $projectTierArray['tier_amount'] / 100;
    $y = $y * $fee;
    $prFee = intval($y);

    // Variables
    $prAdded = 0;

    $totalTransaction = $projectTierArray['tier_amount']+$prFee+$prAdded+$prAddedFee;

  // Date create y Date format
    $datetimeProjectEnd = date_create($dataProjectArray['project_date_end']);
    $datetimeProjectStart = date_create($dataProjectArray['project_date_start']);
    $datetimeProjectExec = date_create($dataProjectArray['project_date_execution']);

    $timeProjectEnd = DATE_FORMAT($datetimeProjectEnd, "H:i");
    $dateProjectEnd = DATE_FORMAT($datetimeProjectEnd, "d-m-Y");

    $timeProjectStart = DATE_FORMAT($datetimeProjectStart, "H:i");
    $dateProjectStart = DATE_FORMAT($datetimeProjectStart, "d-m-Y");

    if(strtotime($dateProjectEnd.' '.$timeProjectEnd)<time()){
      http_response_code(403);
      header("HTTP/1.0 403 Forbidden");
      die();
    }

    function calculateDiff($x){
      $now = time(); // or your date as well
      $y = DATE_FORMAT($x, "Y-m-d");
      $z = strtotime($y);
      $datediff = $now - $z;

      $datediff = round($datediff / (60 * 60 * 24));
      if($datediff>0){
        $datediff = '0';
      }else{
        $datediff = $datediff*-1;
      }
      return $datediff;
    }

  //Check session log
  if(isset($_SESSION['user'])){

    $backerId = $_SESSION['user'];

    // Botón financiamiento
    if(isset($_POST['patrocinar'])){
      $prAdded = 0;
      // Amount variables
      $amountTier = $projectTierArray['tier_amount'];

      // Set added value
      if(!empty($_POST['addedValue'])){
        if($addedValue = FILTER_INPUT(INPUT_POST, 'addedValue', FILTER_SANITIZE_NUMBER_INT)){
          if(FILTER_VAR($addedValue, FILTER_VALIDATE_INT)==FALSE){
            $error = true;
            $errMSG= "Valor de donación inválido.";
          }else{
            $addedValue = mysqli_real_escape_string($conn, $addedValue);
            $addedValue = str_replace(".", "",$addedValue);
            // Generate Fee
            $fee = 0;
            $a = $addedValue / 100;
            $a = $a * $fee;
            $prAddedFee = intval($a);
            $prAdded = intval($addedValue);
          }
        }else{
          $error = true;
          $errMSG= "Valor de donación inválido.";
        }
      }else{
        $prAddedFee = 0;
        $prAdded = 0;
      }

      $totalTransaction = $projectTierArray['tier_amount']+$prFee+$prAdded+$prAddedFee;

      // Total user fee
      $amountCommission = $prFee+$prAddedFee;

      if(FILTER_INPUT(INPUT_POST, 'method_payment', FILTER_VALIDATE_INT, 1)){
        $method_payment = trim($_POST['method_payment']);
        $method_payment = mysqli_real_escape_string($conn, $method_payment);
      }else if(empty($_POST['method_payment'])){
        $error = true;
        $methodError = "Por favor elige un método de pago.";
      }else{
        $error = true;
        $methodError = "Método de pago inválido.";
      }


      // proceder si no hay errores Insert transaction
        if(!$error){

            $queryTransaction = mysqli_query($conn, "INSERT INTO transactions_projects(id_project, id_user, id_tier, amount_transaction_project, amount_transaction_commission, amount_transaction_tip, amount_transaction_tip_commission, payment_status) VALUES ('$prId', '$backerId', '$tierId', '$amountTier', '$prFee', '$prAdded', '$prAddedFee', 'pending')");
            $checkTransaction = mysqli_query($conn, "SELECT * FROM transactions_projects WHERE id_project='$prId' AND payment_status='pending' AND id_user='$backerId' AND id_transaction_project=(SELECT MAX(id_transaction_project) FROM transactions_projects WHERE id_project='$prId' AND id_user='$backerId')");
            $arrayTransaction = mysqli_fetch_array($checkTransaction);
            $id_transaction = $arrayTransaction['id_transaction_project'];

            switch($method_payment){
              case '1':

                $commerceCode = '597043183295';
                $apiKeySecret = '40b1a7876020ca1a86076bdea27a0598';

                $options = Transbank\Webpay\Options::forProduction($commerceCode, $apiKeySecret);
                $transaction = new Transaction($options);

              // variables
                $amount = $totalTransaction;
                $buy_order = $id_transaction;
                $session_id = random_str(12);
                $return_url = 'https://echomusic.cl/payment_verification.php?crowdfunding='.$prId;

              // create order
                $response = $transaction->create($buy_order, $session_id, $amount, $return_url);

                $url_payment = $response->url;
                $token_payment = $response->token;

                $_SESSION['url'] = $url_payment;
                $_SESSION['token'] = $token_payment;
                $_SESSION['method'] = '1';

                mysqli_query($conn, "UPDATE transactions_projects SET order_transaction='$session_id' WHERE id_transaction_project='$id_transaction'");
                mysqli_query($conn, "INSERT INTO project_backers (id_project, id_user, id_tier, backer_amount, backer_added_amount, backer_fee, order_transaction, status_backer) VALUES ('$prId', '$backerId', '$tierId', '$amountTier', '$prAdded', '$amountCommission', '$session_id', '0')");

              break;

              case '2':
              // Inicio de Khipu

                // Debemos conocer el $receiverId y el $secretKey de ante mano.
                  // MODO DESARROLLADOR
                    $receiverId = 400724;
                    $secretKey = 'cb8a44364a896177330666f8949e57f70dcd2c1a';

                    $configuration = new Khipu\Configuration();
                    $configuration->setReceiverId($receiverId);
                    $configuration->setSecret($secretKey);

                    $client = new Khipu\ApiClient($configuration);
                    $payments = new Khipu\Client\PaymentsApi($client);

                    try {

                      $opts = array(
                          "transaction_id" => "TE-".$id_transaction,
                          "return_url" => "https://echomusic.cl/payment_verification.php?crowdfunding=$prId",
                          "notify_url" => "https://echomusic.cl/resources/notification_script.php",
                          "notify_api_version" => "1.3",
                      );

                      $response = $payments->paymentsPost(
                          "Pago servicio crowdfunding", //Motivo de la compra
                          "CLP", //Monedas disponibles CLP, USD, ARS, BOB
                          $totalTransaction, //Monto. Puede contener ","
                          $opts //campos opcionales
                      );
                      $_SESSION['method'] = '2';
                    } catch (\Khipu\ApiException $e) {
                      echo print_r($e->getResponseBody(), TRUE);
                    }

              break;

              case '3':
                // variables
                  $commerceCode = '479109';
                  $currency = 'CLP';
                  $amount = $totalTransaction;
                  $buy_order = $id_transaction;
                  $session_id = random_str(12);
                  $return_url = 'https://echomusic.cl/payment_verification.php?crowdfunding='.$prId;

                  $_SESSION['method'] = '3';
                  $_SESSION['session_id'] = $session_id;

                  mysqli_query($conn, "UPDATE transactions_projects SET order_transaction='$session_id' WHERE id_transaction_project='$id_transaction'");
                  mysqli_query($conn, "INSERT INTO project_backers (id_project, id_user, id_tier, backer_amount, backer_added_amount, backer_fee, order_transaction, status_backer) VALUES ('$prId', '$backerId', '$tierId', '$amountTier', '$prAdded', '$amountCommission', '$session_id', '0')");

              break;

            }

        }
        else{
           $errTyp = "danger";
           $errMSG = "Ha sucedido un error, por favor revisa la información e inténtalo de nuevo.";

        }

      }

      if(isset($_SESSION['method'])){
          $checkTransaction = mysqli_query($conn, "SELECT * FROM transactions_projects WHERE id_project='$prId' AND payment_status='pending' AND id_user='$backerId' AND id_transaction_project=(SELECT MAX(id_transaction_project) FROM transactions_projects WHERE id_project='$prId' AND id_user='$backerId')");
          $userDataTransaction = mysqli_fetch_array($checkTransaction);
      }

      // Header to Khipu payment

      if(isset($response) && $_SESSION['method']=='2'){

        $payment_id = $response['payment_id'];

        mysqli_query($conn, "UPDATE transactions_projects SET order_transaction='$payment_id' WHERE id_transaction_project='$id_transaction'");
        mysqli_query($conn, "INSERT INTO project_backers (id_project, id_user, id_tier, backer_amount, backer_added_amount, backer_fee, order_transaction, status_backer) VALUES ('$prId', '$backerId', '$tierId', '$amountTier', '$prAdded', '$amountCommission', '$payment_id', '0')");

        $payment_url = $response['payment_url'];
        $_SESSION['url'] = $payment_url;

      }

  } else{

    $plsLogin = true;

  }

}else{
  http_response_code(404);
  header("HTTP/1.0 404 Not Found");
  die();

}

 ?>
