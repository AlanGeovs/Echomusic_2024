<?php

// Conectar base de datos

  include 'resources/connect.php';

  include 'resources/functionDateTranslate.php';
  include 'resources/avancesPatrocinadorMail.php';
  include 'vendor/autoload.php';

  use PHPMailer\PHPMailer\PHPMailer;

  use PHPMailer\PHPMailer\Exception;



// check session

  if(!isset($_SESSION['user']) AND $_SESSION['user']!=''){

    $errTyp=="loginError";

  }else{

    // user id

    $userid = $_SESSION['user'];

    $queryCheckType_user = mysqli_query($conn, "SELECT id_type_user FROM users WHERE id_user='$userid'");

    $arrayCheckType_user = mysqli_fetch_assoc($queryCheckType_user);

    if($arrayCheckType_user['id_type_user']!=1){

      	http_response_code(403);

        header("HTTP/1.0 403 Forbidden");

      	die();

    }

  }



// Query info proyecto

  $queryDataProject = mysqli_query($conn, "SELECT id_project, project_title FROM projects_crowdfunding WHERE id_user='$userid' AND status_project IN ('1','2') ORDER BY id_project DESC LIMIT 1");

  $dataProjectArray = mysqli_fetch_assoc($queryDataProject);

  $prId = $dataProjectArray['id_project'];



// Query avances

  $queryProjectUpdates = mysqli_query($conn, "SELECT * FROM project_updates LEFT JOIN project_multimedia ON project_updates.id_project_multimedia = project_multimedia.id_project_multimedia WHERE project_updates.id_project='$prId' ORDER BY project_updates.update_date DESC");

  // Ciclo while con fetch para avances

    $projectUpdatesArray = array();

    while($projectUpdates_array = mysqli_fetch_array($queryProjectUpdates)){

      $projectUpdatesArray[] = $projectUpdates_array;

    }





// Submit project update

  if(isset($_POST['submit_update']) && $_POST['submit_update']!=''){



    // set var error to false

    $error = false;



    $desc = trim($_POST['description']);

    $desc = strip_tags($desc);

    $desc = htmlspecialchars($desc);

    $desc = mysqli_real_escape_string($conn, $desc);





    if (empty($desc)) {

      $desc = "";

    } else if (strlen($desc) < 20) {

      $error = true;

      $descError = "La descripción debe tener más de 20 caracteres.";

    } else if (strlen($desc) > 3001) {

      $error = true;

      $descError = "La descripción debe tener menos de 3000 caracteres.";

      }else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$desc)) {

      $error = true;

      $descError = "La descripción del proyecto contiene caracteres no permitidos.";

     }



     // Check project is published

      if(mysqli_num_rows($queryDataProject)<1){

        $error = true;

      }



      // Get image file extension

      $file_extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);



      // Get Image Dimension

      $fileinfo = @getimagesize($_FILES["file-input"]["tmp_name"]);

      $width = $fileinfo[0];

      $height = $fileinfo[1];



      $allowed_image_extension = array(

          "png",

          "jpg",

          "jpeg",

          "JPG",

          "JPEG",

          "PNG"

      );





   // Validate file input to check if is not empty

     if (!file_exists($_FILES["file-input"]["tmp_name"])) {

       $multimediaId = '';

     } // Validate file input to check if is with valid extension

     else if (! in_array($file_extension, $allowed_image_extension)) {

       $error = true;

       $imageError = "Por favor, elige una imagen de formato JPG o PNG.";



     } // Validate image file size

     else if (($_FILES["file-input"]["size"] > 10485760)) {

       $error = true;

       $imageError = "La imagen excede el peso de 10MB.";

     } // Validate image file dimension

     else if ($width >= "5001" || $height >= "5001") {

       $error = true;

       $imageError = "Las dimensiones de la imagen son muy grandes";

     }



     if(!$error){



       if (file_exists($_FILES["file-input"]["tmp_name"])) {

           // Create image from format

           $sourceImage = $_FILES["file-input"]["tmp_name"];
           $infoImage = getimagesize($sourceImage);



           if ($infoImage['mime'] == 'image/jpeg'){

         		$sourceImage = imagecreatefromjpeg($sourceImage);

           }

         	elseif ($infoImage['mime'] == 'image/gif'){

         		$sourceImage = imagecreatefromgif($sourceImage);

           }

         	elseif ($infoImage['mime'] == 'image/png'){

         		$sourceImage = imagecreatefrompng($sourceImage);

           }

           // Redimensionado de imagen

           if(($width > '1920' && $width <= '2500') || ($height > '1920' && $height <= '2500')){
             $newWidth = $width*0.80;
             $newHeight = $height*0.80;
           }else if(($width > '2501' && $width <= '3500') || ($height > '2501' && $height <= '3500')){
             $newWidth = $width*0.50;
             $newHeight = $height*0.50;
           }else if($width > '3501' || $height > '3501'){
             $newWidth = $width*0.25;
             $newHeight = $height*0.25;
           }

           $resized = imagecreatetruecolor($newWidth, $newHeight);
           imagecopyresampled($resized, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

           $imgRename = str_replace(".", "_", uniqid(mt_rand(), true));
           $target = "images/crowdfunding/pr_".$prId."/". $imgRename . '.jpg';



           if (imagejpeg($resized, $target, 60)) {



            mysqli_query($conn, "INSERT INTO project_multimedia(id_project, project_multimedia_type, project_multimedia_name) VALUES ('$prId', '1', '$imgRename')");

            $queryImage = mysqli_query($conn, "SELECT MAX(id_project_multimedia) AS id_project_multimedia FROM project_multimedia WHERE id_project='$prId'");

            $arrayImage = mysqli_fetch_array($queryImage);

            $multimediaId = $arrayImage['id_project_multimedia'];



            $queryUpdate = "INSERT INTO project_updates(id_project, id_project_multimedia, update_desc) VALUES('$prId', '$multimediaId', '$desc')";



            if(mysqli_query($conn, $queryUpdate)){



              $errTyp = "success";
              $errMSG = "Avance publicado con éxito.";
              $_SESSION['success'] = $errMSG;

              $queryBackersInfo = mysqli_query($conn, "SELECT DISTINCT first_name_user, mail_user FROM project_backers LEFT JOIN users ON users.id_user = project_backers.id_user WHERE project_backers.id_project='$prId' AND status_backer='1'");
              while($arrayBackersInfo = mysqli_fetch_array($queryBackersInfo)){

                $NOMBRE_USUARIO = ucfirst($arrayBackersInfo['first_name_user']);
                $emailUser = $arrayBackersInfo['mail_user'];
                $LINK_PROYECTO = 'https://qa.echomusic.cl/proyecto.php?projectid='.$prId;

                // AQUI VA EL MAIL DE AVANCE DE PROYECTO
                  $textUser = $avancesProyectoMail.$NOMBRE_USUARIO.$avancesProyectoMail1.$LINK_PROYECTO.$avancesProyectoMail2;

                  $mail = new PHPMailer();
                  $mail->Encoding = 'base64';
                  $mail->CharSet = 'UTF-8';
                  $mail->isHTML(true);
                  $mail->SetFrom('crowdfunding@echomusic.cl', 'Crowdfunding EchoMusic'); //Name is optional
                  $mail->Subject   = 'Tenemos novedades del proyecto';
                  $mail->Body     = $textUser;
                  $mail->AddAddress($emailUser);
                  $mail->addBCC('patrocinio@echomusic.cl');
                  $mail->send();

              }


              header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

              exit();



            }else{

              $errTyp = 'danger';

              $errMSG = 'Ha sucedido un error, por favor vuelve a intentarlo.';

            }



           }else{

             $errTyp = 'danger';

             $errMSG = 'Ha sucedido un error, por favor vuelve a intentarlo.';

           }

         }else{



           $queryUpdate = "INSERT INTO project_updates(id_project, id_project_multimedia, update_desc) VALUES('$prId', '$multimediaId', '$desc')";



           if(mysqli_query($conn, $queryUpdate)){



             $errTyp = "success";

             $errMSG = "Avance publicado con éxito.";

             $_SESSION['success'] = $errMSG;

             $queryBackersInfo = mysqli_query($conn, "SELECT DISTINCT first_name_user, mail_user FROM project_backers LEFT JOIN users ON users.id_user = project_backers.id_user WHERE project_backers.id_project='$prId' AND status_backer='1'");

             while($arrayBackersInfo = mysqli_fetch_array($queryBackersInfo)){

               $NOMBRE_USUARIO = ucfirst($arrayBackersInfo['first_name_user']);
               $emailUser = $arrayBackersInfo['mail_user'];
               $LINK_PROYECTO = 'https://qa.echomusic.cl/proyecto.php?projectid='.$prId;

               // AQUI VA EL MAIL DE AVANCE DE PROYECTO
                 $textUser = $avancesProyectoMail.$NOMBRE_USUARIO.$avancesProyectoMail1.$LINK_PROYECTO.$avancesProyectoMail2;

                 $mail = new PHPMailer();
                 $mail->Encoding = 'base64';
                 $mail->CharSet = 'UTF-8';
                 $mail->isHTML(true);
                 $mail->SetFrom('crowdfunding@echomusic.cl', 'Crowdfunding EchoMusic'); //Name is optional
                 $mail->Subject   = 'Tenemos novedades del proyecto';
                 $mail->Body     = $textUser;
                 $mail->AddAddress($emailUser);
                 $mail->addBCC('patrocinio@echomusic.cl');
                 $mail->send();

             }

             header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );

             exit();



           }else{

             $errTyp = 'danger';

             $errMSG = 'Ha sucedido un error, por favor vuelve a intentarlo.';

           }

         }



     }else{

       $errTyp = 'danger';

       $errMSG = 'Ha sucedido un error, por favor revisa la información y vuelve a intentarlo.';

     }





  }



 ?>
