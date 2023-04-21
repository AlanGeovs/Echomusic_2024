<?php
 include 'connect.php';

 $error = false;

 if ( isset($_POST['contactCompany_submit']) ) {

  // clean user inputs to prevent sql injections
  $first_name = trim($_POST['first_name']);
  $first_name = strip_tags($first_name);
  $first_name = htmlspecialchars($first_name);
  $first_name = mysqli_real_escape_string($conn, $first_name);

  $last_name = trim($_POST['last_name']);
  $last_name = strip_tags($last_name);
  $last_name = htmlspecialchars($last_name);
  $last_name = mysqli_real_escape_string($conn, $last_name);

  $company_name = trim($_POST['company_name']);
  $company_name = strip_tags($company_name);
  $company_name = htmlspecialchars($company_name);
  $company_name = mysqli_real_escape_string($conn, $company_name);

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  $email = mysqli_real_escape_string($conn, $email);

  $phone = trim($_POST['phone']);
  $phone = strip_tags($phone);
  $phone = htmlspecialchars($phone);
  $phone = mysqli_real_escape_string($conn, $phone);

  $position = trim($_POST['position']);
  $position = strip_tags($position);
  $position = htmlspecialchars($position);
  $position = mysqli_real_escape_string($conn, $position);

  $desc = trim($_POST['description_text']);
  $desc = strip_tags($desc);
  $desc = htmlspecialchars($desc);
  $desc = mysqli_real_escape_string($conn, $desc);

  // basic first_name validation
  if (empty($first_name)) {
   $error = true;
   $first_nameError = "Por favor, ingresa tu nombre.";
 } else if (strlen($first_name) < 3) {
   $error = true;
   $first_nameError = "El nombre debe tener más de 3 caracteres";
 } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$first_name)) {
   $error = true;
   $first_nameError = "El nombre solo puede contener letras";
  }
  //basic last_name validation
  if (empty($last_name)) {
   $error = true;
   $lastnameError = "Por favor, ingresa tu apellido.";
 } else if (strlen($last_name) < 3) {
   $error = true;
   $last_nameError = "El apellido debe tener más de 3 caracteres";
 } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$last_name)) {
   $error = true;
   $last_nameError = "El apellido solo puede contener letras";
  }
  //basic position validation
  if (empty($position)) {
   $error = true;
   $positionError = "Por favor, ingresa tu cargo en la empresa.";
 } else if (strlen($position) < 3) {
   $error = true;
   $positionError = "El cargo debe tener más de 3 caracteres";
 } else if (!preg_match("/^[a-zA-Z áéíóúüñÑÁÉÍÓÚÜ]+$/i",$position)) {
   $error = true;
   $positionError = "El nombre del cargo solo puede contener letras";
  }
  //basic company validation
  if (empty($company_name)) {
   $error = true;
   $company_nameError = "Por favor ingresa tu cargo en la empresa.";
 } else if (strlen($company_name) < 3) {
   $error = true;
   $company_nameError = "El cargo debe tener más de 3 caracteres";
 } else if (!preg_match("/^[a-zA-Z0-9 áéíóúüñÑÁÉÍÓÚÜ\W]+$/",$position)) {
   $error = true;
   $company_nameError = "El nombre de la empresa solo puede contener letras y números";
  }
  // basic Phone validation
  if(empty($phone)){
    $error = true;
    $phoneError = "Por favor, ingresa tu número de teléfono.";
  }else if (strlen($phone) < 9){
    $error = true;
    $phoneError = "El número de teléfono debe tener 9 dígitos.";
  }else if(!preg_match("/^[1-9][0-9]*$/", $phone)){
    $error = true;
    $phoneError = "El teléfono solo puede contener números.";
  }
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Por favor, ingresa una dirección de correo válida";
  }
  // basic desc validation
  if (strlen($desc) < 50) {
   $error = true;
   $descError = "La descripción debe tener más de 50 caracteres.";
 }else if (strlen($desc) > 2000){
   $error = true;
   $descError = "La descripción no puede tener más de 2000 caracteres.";
 }

 $date = date('Y-m-d h:i:s', time());

  // if there's no error, continue to query
  if( !$error ) {

   $query = "INSERT INTO requests(fname_request, lname_request, company_request, email_request, phone_request, message_request, position_request, status_request, user_request, date_request) VALUES('$first_name','$last_name','$company_name','$email','$phone','$desc','$position','open','company','$date')";
   //$res = mysqli_query($conn, $query);

   if (mysqli_query($conn, $query)) {

    $text = '<html><p><strong>Nombre: </strong>'.$first_name.' '.$last_name.' </br><strong>Empresa: </strong>'.$company_name.' </br><strong>Cargo: </strong>'.$position.' </br><strong>Email: </strong> '.$email.' </br><strong>Teléfono: </strong>'.$phone.'</p><p>'.$desc.'</p></html>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: '.$email.'' . "\r\n";
    if(mail('contacto@echomusic.cl', "Contacto, Asesoría Empresas", $text, $headers)){
      $errTyp = "success";
      $errMSG = "Mensaje Enviado, nos pondremos en contacto contigo a la brevedad";
    }

    unset($first_name);
    unset($last_name);
    unset($nick);
    unset($email);
    unset($pass);
    unset($type_user);
   } else {
    $errTyp = "danger";
    $errMSG = "Ha sucedido un error, por favor inténtalo de nuevo.";
   }

 }else{
   $errTyp = "danger";
   $errMSG = "Ha sucedido un error, por favor verifica la información.";
 }


 }

?>
