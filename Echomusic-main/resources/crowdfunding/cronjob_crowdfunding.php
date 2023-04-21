<?php

// Conectar base de datos
define('ROOT_PATH', dirname(__DIR__) . '/');
  include (ROOT_PATH.'connect.php');
  include (ROOT_PATH.'metaCumplidaMail.php');
  include (ROOT_PATH.'metaFallidaMail.php');
  require ('../../vendor/autoload.php');

  use PHPMailer\PHPMailer\PHPMailer;

  use PHPMailer\PHPMailer\Exception;

  $queryCheckProjects = mysqli_query($conn, "SELECT id_project FROM projects_crowdfunding WHERE (project_date_end BETWEEN DATE_SUB( NOW() , INTERVAL 1 HOUR )  AND  NOW() ) AND status_project IN ('1','2')");

  $idsProjects_array = array();

  while($idsProjectsArray = mysqli_fetch_array($queryCheckProjects)){

    $id_project = $idsProjectsArray['id_project'];

    $queryBackersInfo = mysqli_query($conn, "SELECT projects_crowdfunding.id_project, users.mail_user, projects_crowdfunding.project_title, projects_crowdfunding.project_amount, SUM(backer_amount+backer_added_amount) as total FROM project_backers LEFT JOIN projects_crowdfunding ON projects_crowdfunding.id_project = project_backers.id_project LEFT JOIN users ON users.id_user = projects_crowdfunding.id_user WHERE projects_crowdfunding.id_project='$id_project' AND status_backer='1'");
    // $queryBackersInfo = mysqli_query($conn, "SELECT project_backers.id_project, projects_crowdfunding.project_title, projects_crowdfunding.project_amount, SUM(backer_amount+backer_added_amount) as total FROM project_backers LEFT JOIN projects_crowdfunding ON projects_crowdfunding.id_project = project_backers.id_project WHERE project_backers.id_project IN ('42','58') AND status_backer='1' GROUP BY project_backers.id_project");
    $totalBackers = mysqli_fetch_array($queryBackersInfo);
      print_r($totalBackers);
      // Comparar recaudado vs solicitado
      if($totalBackers['project_amount'] > $totalBackers['total']){

        // Generate csv
            $data = mysqli_query($conn, "SELECT users.id_user, first_name_user, last_name_user, mail_user, backer_amount+backer_added_amount AS total_amount FROM users LEFT JOIN project_backers ON project_backers.id_user=users.id_user WHERE id_project='$id_project' AND status_backer='1'");
            // Open temp file pointer
            ob_start();
            $fp = fopen('php://output', 'w');
            fputcsv($fp, array('Id_usuario', 'Nombre', 'Apellido', 'Correo','Monto aporte'));
            // Loop data and write to file pointer
            while ($line = mysqli_fetch_assoc($data)) fputcsv($fp, $line);
            // Return the data
            fclose($fp);
            $csv_string = ob_get_contents();
            ob_end_clean();

            // Mail artist
            $mailArtist = $totalBackers['mail_user'];

            $mail1 = new PHPMailer();
            $mail1->Encoding = 'base64';
            $mail1->CharSet = 'UTF-8';
            $mail1->isHTML(true);
            $mail1->SetFrom('crowdfunding@echomusic.cl', 'Soporte Crowdfunding EchoMusic');
            $mail1->Subject   = 'Lista de patrocinadores proyecto fallido';
            $mail1->Body     = 'El proyecto '.$totalBackers['project_title'].' no ha cumplido la meta. Adjunto lista de patrocinadores para ser notificados.';
            $mail1->AddAddress('crowdfunding@echomusic.cl');
            $mail1->addStringAttachment($csv_string,"file_name.csv");
            $mail1->send();

            $NOMBRE_BANDA = 'artista';
            $textUser = $metaFallidaMail.$NOMBRE_BANDA.$metaFallidaMail1;

            $mail2 = new PHPMailer();
            $mail2->Encoding = 'base64';
            $mail2->CharSet = 'UTF-8';
            $mail2->isHTML(true);
            $mail2->SetFrom('crowdfunding@echomusic.cl', 'Soporte Crowdfunding EchoMusic');
            $mail2->Subject   = 'Tu proyecto ha finalizado el período de recaudación';
            $mail2->Body     = $textUser;
            $mail2->AddAddress($mailArtist);
            $mail2->send();

            mysqli_query($conn, "UPDATE projects_crowdfunding SET status_project='3' WHERE id_project='$id_project'");

        // echo 'proyecto: '.$totalBackers['id_project'];
        // echo " fail </br>";
      }elseif($totalBackers['project_amount'] <= $totalBackers['total']){

          $id_project = $totalBackers['id_project'];

      // Generate csv
          $data = mysqli_query($conn, "SELECT users.id_user, first_name_user, last_name_user, mail_user, backer_amount+backer_added_amount AS total_amount FROM users LEFT JOIN project_backers ON project_backers.id_user=users.id_user WHERE id_project='$id_project' AND status_backer='1'");
          // Open temp file pointer
          ob_start();
          $fp = fopen('php://output', 'w');
          fputcsv($fp, array('Id_usuario', 'Nombre', 'Apellido', 'Correo','Monto aporte'));
          // Loop data and write to file pointer
          while ($line = mysqli_fetch_assoc($data)) fputcsv($fp, $line);
          // Return the data
          fclose($fp);
          $csv_string = ob_get_contents();
          ob_end_clean();

          // Mail artist
          $mailArtist = $totalBackers['mail_user'];

          $mail1 = new PHPMailer();
          $mail1->Encoding = 'base64';
          $mail1->CharSet = 'UTF-8';
          $mail1->isHTML(true);
          $mail1->SetFrom('crowdfunding@echomusic.cl', 'Soporte Crowdfunding EchoMusic');
          $mail1->Subject   = 'Lista de patrocinadores proyecto financiado';
          $mail1->Body     = 'El proyecto '.$totalBackers['project_title'].' ha llegado a la meta. Adjunto lista de patrocinadores para ser notificados.';
          $mail1->AddAddress('crowdfunding@echomusic.cl');
          $mail1->addStringAttachment($csv_string,"file_name.csv");
          $mail1->send();

          $NOMBRE_BANDA = 'artista';
          $textUser = $metaCumplidaMail.$NOMBRE_BANDA.$metaCumplidaMail1;

          $mail2 = new PHPMailer();
          $mail2->Encoding = 'base64';
          $mail2->CharSet = 'UTF-8';
          $mail2->isHTML(true);
          $mail2->SetFrom('crowdfunding@echomusic.cl', 'Soporte Crowdfunding EchoMusic');
          $mail2->Subject   = 'Tu proyecto ha finalizado el período de recaudación';
          $mail2->Body     = $textUser;
          $mail2->AddAddress($mailArtist);
          $mail2->send();

        // echo 'proyecto: '.$totalBackers['id_project'];
        // echo " success </br>";
      }

  }

  // Array ids
    if(!empty($idsProjects_array)){
      // Proyectos que cumplen con la fecha de recaudación
      $idsProjects = join("','", $idsProjects_array);
    }


  // Calcular monto recaudado







    // AQUI SALE EL CORREO DE META COMPLETA
      $textUser = $metaCumplidaMail.$NOMBRE_BANDA.$metaCumplidaMail1;

      // $mail = new PHPMailer();
      // $mail->Encoding = 'base64';
      // $mail->CharSet = 'UTF-8';
      // $mail->isHTML(true);
      // $mail->SetFrom('eventos@echomusic.cl', 'CROWDFUNDING ECHOMUSIC'); //Name is optional
      // $mail->Subject   = 'Tu proyecto ha cumplida la meta';
      // $mail->Body     = $textUser;
      // $mail->AltBody  = $textUser;
      // $mail->AddAddress($emailUser);
      // $mail->addBCC('copiaentradas@echomusic.cl');
      // $mail->send();



    // AQUI SALE EL CORREO DE META FALLIDA
     $textUser = $metaFallidaMail.$NOMBRE_BANDA.$metaFallidaMail1;

      // $mail = new PHPMailer();
      // $mail->Encoding = 'base64';
      // $mail->CharSet = 'UTF-8';
      // $mail->isHTML(true);
      // $mail->SetFrom('eventos@echomusic.cl', 'CROWDFUNDING ECHOMUSIC'); //Name is optional
      // $mail->Subject   = 'Tu proyecto no a cumplida la meta';
      // $mail->Body     = $textUser;
      // $mail->AltBody  = $textUser;
      // $mail->AddAddress($emailUser);
      // $mail->addBCC('copiaentradas@echomusic.cl');
      // $mail->send();


    // AQUI SALE EL CORREO DE EVALUACIÓN

     // falta crear

      // $mail = new PHPMailer();
      // $mail->Encoding = 'base64';
      // $mail->CharSet = 'UTF-8';
      // $mail->isHTML(true);
      // $mail->SetFrom('eventos@echomusic.cl', 'CROWDFUNDING ECHOMUSIC'); //Name is optional
      // $mail->Subject   = 'ASUNTO';
      // $mail->Body     = $textUser;
      // $mail->AltBody  = $textUser;
      // $mail->AddAddress($emailUser);
      // $mail->addBCC('copiaentradas@echomusic.cl');
      // $mail->send();



    // ESPECIFICAR LAS VARIABLES REQUERIDAS PARA CADA CASO

    // EJ: "FALTA NOMBRE DE ARTISTA"

    // FALTA NOMBRE BANDA $NOMBRE_BANDA = ;

?>
