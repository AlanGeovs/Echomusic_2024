<?php
include 'connect.php';

if(!empty($_GET['event'])){
  $idEvent = filter_input(INPUT_GET, 'event', FILTER_VALIDATE_INT, 1);
  $idEvent = strip_tags($idEvent);
  $idEvent = intval($idEvent);
  $idEvent = mysqli_real_escape_string($conn, $idEvent);
  $id_user = $_SESSION['user'];

  // Waiting message
  $errTyp = "waiting";
  $errMSG = "En proceso, por favor espere...";

  $query1 = mysqli_query($conn, "SELECT * FROM transactions_events LEFT JOIN events_private ON transactions_events.id_event = events_private.id_event
                                                                   LEFT JOIN users ON events_private.id_user_sell = users.id_user
                                                                   LEFT JOIN genre_user ON genre_user.id_user = users.id_user
                                                                   LEFT JOIN genres ON genres.id_genre = genre_user.id_genre
                                                                   LEFT JOIN regions ON regions.id_region = users.id_region
                                                                   LEFT JOIN cities ON cities.id_city = users.id_city
                                                                   LEFT JOIN events_plans ON events_private.id_event = events_plans.id_event WHERE transactions_events.id_event='$idEvent' AND transactions_events.id_user='$id_user' AND payment_status='paid' LIMIT 1");

    if(mysqli_num_rows($query1)>0){
      $arrayDataTransaction = mysqli_fetch_array($query1);
      // Creating payment code
        $idTransaction = $arrayDataTransaction['id_transaction_event'];
        $idEvent = $arrayDataTransaction[1];
        $transactionCode = sprintf('%04d', $idTransaction);
        $eventCode = sprintf('%04d', $idEvent);
        $typeCode = '01';

        $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;
    }else{
      $query2 = mysqli_query($conn, "SELECT * FROM transactions_events LEFT JOIN events_private ON transactions_events.id_event = events_private.id_event
                                                                       LEFT JOIN users ON events_private.id_user_sell = users.id_user
                                                                       LEFT JOIN genre_user ON genre_user.id_user = users.id_user
                                                                       LEFT JOIN genres ON genres.id_genre = genre_user.id_genre
                                                                       LEFT JOIN regions ON regions.id_region = users.id_region
                                                                       LEFT JOIN cities ON cities.id_city = users.id_city
                                                                       LEFT JOIN events_plans ON events_private.id_event = events_plans.id_event WHERE transactions_events.id_event='$idEvent' AND transactions_events.id_user='$id_user' AND payment_status='pending' LIMIT 1");
     $arrayDataTransaction = mysqli_fetch_array($query2);
     // Creating payment code
       $idTransaction = $arrayDataTransaction['id_transaction_event'];
       $idEvent = $arrayDataTransaction[1];
       $transactionCode = sprintf('%04d', $idTransaction);
       $eventCode = sprintf('%04d', $idEvent);
       $typeCode = '01';

       $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;
    }



  include 'functionDateTranslate.php';

  //Event data
  $nameArtist = $arrayDataTransaction['nick_user'];
  $artistGenre = $arrayDataTransaction['name_genre'];
  $artistCity = $arrayDataTransaction['name_city'];
  $artistRegion = $arrayDataTransaction['name_region'];

  $totalValue = $arrayDataTransaction['value_plan_event'] + $arrayDataTransaction['commission_plan_event'];
  $totalValue = ' $'.number_format($totalValue , 0, ',', '.');
  $totalTime = $arrayDataTransaction['duration_hours'].'hr '.$arrayDataTransaction['duration_minutes'].'min';
  $eventBackline = $arrayDataTransaction['backline'];
  $eventEngi = $arrayDataTransaction['sound_engineer'];
  $eventArtistsN = $arrayDataTransaction['artists_amount'];
  $eventReinforcement = $arrayDataTransaction['sound_reinforcement'];

  $nameEvent = $arrayDataTransaction['name_event'];
  $datetimeEvent = DATE_CREATE($arrayDataTransaction['date_event']);
  $timeEvent = DATE_FORMAT($datetimeEvent, 'H:i');
  $locationEvent = $arrayDataTransaction['location'];


// Check payment status

  if($arrayDataTransaction['payment_status'] == 'paid'){
    $errTyp = "success";
    $errMSG = "Pago Verificado";

    unset($idEvent);
    // header( "refresh:3;url=dashboard.php" );
  }else{
    $errTyp = "waiting";
    $errMSG = "En proceso, por favor espere...";
    if(isset($_SESSION['count'])){
      $_SESSION['count'] = $_SESSION['count'] + 1;
      if($_SESSION['count']==12){
        $errTyp = "danger";
        $errMSG = "No se logró verificar el pago.";
        unset($_SESSION['count']);
      }
    }else{
      $_SESSION['count'] = 0;
    }
    header("refresh:5");
  }
}else if(!empty($_GET['streaming'])){
  $idEvent = filter_input(INPUT_GET, 'streaming', FILTER_VALIDATE_INT, 1);
  $idEvent = strip_tags($idEvent);
  $idEvent = intval($idEvent);
  $idEvent = mysqli_real_escape_string($conn, $idEvent);
  $id_user = $_SESSION['user'];

  // Waiting message
  $errTyp = "waiting";
  $errMSG = "En proceso, por favor espere...";

  $query1 = mysqli_query($conn, "SELECT * FROM transactions_streaming LEFT JOIN users ON transactions_streaming.id_user = users.id_user
                                                                      WHERE transactions_streaming.id_event='$idEvent' AND transactions_streaming.id_user='$id_user' AND payment_status='paid' LIMIT 1");

  if(mysqli_num_rows($query1)>0){
    $arrayDataTransaction = mysqli_fetch_array($query1);
    // Creating payment code
      $idTransaction = $arrayDataTransaction['id_transaction_streaming'];
      $idEvent = $arrayDataTransaction[1];
      $transactionCode = sprintf('%04d', $idTransaction);
      $eventCode = sprintf('%04d', $idEvent);
      $typeCode = '04';

      $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;
  }else{
    $query2 = mysqli_query($conn, "SELECT * FROM transactions_streaming LEFT JOIN users ON transactions_streaming.id_user = users.id_user
                                                                        WHERE transactions_streaming.id_event='$idEvent' AND transactions_streaming.id_user='$id_user' AND payment_status='pending' LIMIT 1");
    $arrayDataTransaction = mysqli_fetch_array($query2);
    // Creating payment code
      $idTransaction = $arrayDataTransaction['id_transaction_streaming'];
      $idEvent = $arrayDataTransaction[1];
      $transactionCode = sprintf('%04d', $idTransaction);
      $eventCode = sprintf('%04d', $idEvent);
      $typeCode = '04';

      $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;
  }


  include 'functionDateTranslate.php';


// Check payment status

  if($arrayDataTransaction['payment_status'] == 'paid'){
    $errTyp = "success";
    $errMSG = "Pago Verificado";

    unset($idEvent);
    unset($_SESSION['count']);
    // header( "refresh:3;url=dashboard.php" );
  }else{
    $errTyp = "waiting";
    $errMSG = "En proceso, por favor espere...";
    if(isset($_SESSION['count'])){
      $_SESSION['count'] = $_SESSION['count'] + 1;
      if($_SESSION['count']==12){
        $errTyp = "danger";
        $errMSG = "No se logró verificar el pago.";
        unset($_SESSION['count']);
      }
    }else{
      $_SESSION['count'] = 0;
    }
    header("refresh:5");
  }
}else if(!empty($_GET['public'])){
  $idEvent = filter_input(INPUT_GET, 'public', FILTER_VALIDATE_INT, 1);
  $idEvent = strip_tags($idEvent);
  $idEvent = intval($idEvent);
  $idEvent = mysqli_real_escape_string($conn, $idEvent);
  $id_user = $_SESSION['user'];

  // Waiting message
  $errTyp = "waiting";
  $errMSG = "En proceso, por favor espere...";

  $query1 = mysqli_query($conn, "SELECT * FROM transactions_public LEFT JOIN users ON transactions_public.id_user = users.id_user
                                                                      WHERE transactions_public.id_event='$idEvent' AND transactions_public.id_user='$id_user' AND payment_status='paid' LIMIT 1");

  if(mysqli_num_rows($query1)>0){
    $arrayDataTransaction = mysqli_fetch_array($query1);
    // Creating payment code
      $idTransaction = $arrayDataTransaction['id_transaction_public'];
      $idEvent = $arrayDataTransaction[1];
      $transactionCode = sprintf('%04d', $idTransaction);
      $eventCode = sprintf('%04d', $idEvent);
      $typeCode = '04';

      $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;
  }else{
    $query2 = mysqli_query($conn, "SELECT * FROM transactions_public LEFT JOIN users ON transactions_public.id_user = users.id_user
                                                                        WHERE transactions_public.id_event='$idEvent' AND transactions_public.id_user='$id_user' AND payment_status='pending' LIMIT 1");
    $arrayDataTransaction = mysqli_fetch_array($query2);
    // Creating payment code
      $idTransaction = $arrayDataTransaction['id_transaction_public'];
      $idEvent = $arrayDataTransaction[1];
      $transactionCode = sprintf('%04d', $idTransaction);
      $eventCode = sprintf('%04d', $idEvent);
      $typeCode = '04';

      $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;
  }


  include 'functionDateTranslate.php';


// Check payment status

  if($arrayDataTransaction['payment_status'] == 'paid'){
    $errTyp = "success";
    $errMSG = "Pago Verificado";

    unset($idEvent);
    unset($_SESSION['count']);
    // header( "refresh:3;url=dashboard.php" );
  }else{
    $errTyp = "waiting";
    $errMSG = "En proceso, por favor espere...";
    if(isset($_SESSION['count'])){
      $_SESSION['count'] = $_SESSION['count'] + 1;
      if($_SESSION['count']==12){
        $errTyp = "danger";
        $errMSG = "No se logró verificar el pago.";
        unset($_SESSION['count']);
      }
    }else{
      $_SESSION['count'] = 0;
    }
    header("refresh:5");
  }

}else if(!empty($_GET['crowdfunding'])){
  $idProject = filter_input(INPUT_GET, 'crowdfunding', FILTER_VALIDATE_INT, 1);
  $idProject = strip_tags($idProject);
  $idProject = intval($idProject);
  $idProject = mysqli_real_escape_string($conn, $idProject);
  $id_user = $_SESSION['user'];

  // Waiting message
  $errTyp = "waiting";
  $errMSG = "En proceso, por favor espere...";

  $query1 = mysqli_query($conn, "SELECT * FROM transactions_projects LEFT JOIN users ON transactions_projects.id_user = users.id_user
                                                                      WHERE transactions_projects.id_project='$idProject' AND transactions_projects.id_user='$id_user' AND payment_status='paid' LIMIT 1");

  if(mysqli_num_rows($query1)>0){
    $arrayDataTransaction = mysqli_fetch_array($query1);
    // Creating payment code
      $idTransaction = $arrayDataTransaction['id_transaction_project'];
      $idProject = $arrayDataTransaction[1];
      $transactionCode = sprintf('%04d', $idTransaction);
      $eventCode = sprintf('%04d', $idProject);
      $typeCode = '04';

      $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;
  }else{
    $query2 = mysqli_query($conn, "SELECT * FROM transactions_projects LEFT JOIN users ON transactions_projects.id_user = users.id_user
                                                                        WHERE transactions_projects.id_project='$idProject' AND transactions_projects.id_user='$id_user' AND payment_status='pending' LIMIT 1");
    $arrayDataTransaction = mysqli_fetch_array($query2);
    // Creating payment code
      $idTransaction = $arrayDataTransaction['id_transaction_project'];
      $idProject = $arrayDataTransaction[1];
      $transactionCode = sprintf('%04d', $idTransaction);
      $eventCode = sprintf('%04d', $idProject);
      $typeCode = '04';

      $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;
  }


  include 'functionDateTranslate.php';


// Check payment status

  if($arrayDataTransaction['payment_status'] == 'paid'){
    $errTyp = "success";
    $errMSG = "Pago Verificado";

    unset($idProject);
    unset($_SESSION['count']);
    // header( "refresh:3;url=dashboard.php" );
  }else{
    $errTyp = "waiting";
    $errMSG = "En proceso, por favor espere...";
    if(isset($_SESSION['count'])){
      $_SESSION['count'] = $_SESSION['count'] + 1;
      if($_SESSION['count']==12){
        $errTyp = "danger";
        $errMSG = "No se logró verificar el pago.";
        unset($_SESSION['count']);
      }
    }else{
      $_SESSION['count'] = 0;
    }
    header("refresh:5");
  }

}else if(!empty($_GET['check'])){
  $order_transaction = trim($_GET['check']);
  $order_transaction = strip_tags($order_transaction);
  $order_transaction = mysqli_real_escape_string($conn, $order_transaction);

  $id_user = $_SESSION['user'];

  // Waiting message
  $errTyp = "waiting";
  $errMSG = "En proceso, por favor espere...";

  $query1 = mysqli_query($conn, "SELECT * FROM transactions_public LEFT JOIN users ON transactions_public.id_user = users.id_user
                                                                      WHERE transactions_public.order_transaction='$order_transaction' AND transactions_public.id_user='$id_user' AND payment_status='paid' LIMIT 1");

  if(mysqli_num_rows($query1)>0){
    $arrayDataTransaction = mysqli_fetch_array($query1);
    // Creating payment code
      $idTransaction = $arrayDataTransaction['id_transaction_public'];
      $idEvent = $arrayDataTransaction[1];
      $transactionCode = sprintf('%04d', $idTransaction);
      $eventCode = sprintf('%04d', $idEvent);
      $typeCode = '04';

      $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;
  }else{
    $query2 = mysqli_query($conn, "SELECT * FROM transactions_public LEFT JOIN users ON transactions_public.id_user = users.id_user
                                                                        WHERE transactions_public.order_transaction='$order_transaction' AND transactions_public.id_user='$id_user' AND payment_status='pending' LIMIT 1");
    $arrayDataTransaction = mysqli_fetch_array($query2);
    // Creating payment code
      $idTransaction = $arrayDataTransaction['id_transaction_public'];
      $idEvent = $arrayDataTransaction[1];
      $transactionCode = sprintf('%04d', $idTransaction);
      $eventCode = sprintf('%04d', $idEvent);
      $typeCode = '04';

      $paymentCode = $transactionCode.'-'.$eventCode.'-'.$typeCode;
  }

  if($arrayDataTransaction['payment_status'] == 'paid'){
    $errTyp = "success";
    $errMSG = "Suscripción exitosa";

    unset($idEvent);
  }


}else{
  header('HTTP/1.1 403 Forbidden');
  die();
}
 ?>
