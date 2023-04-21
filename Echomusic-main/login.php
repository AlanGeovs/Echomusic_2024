<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';
 if ( isset($_SESSION['user'])!="" ) {
  header("Location: index.php");
  exit;
 }
/*
if(isset($_SESSION['loggedTester']) AND $_SESSION['loggedTester'] == true){



}else{

  header('Location: logintester.php');

  die();

}
*/
?>

<!DOCTYPE HTML>


<html>

	<head>

		<title>EchoMusic | Iniciar sesión</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>
    <? include_once("resources/Analytics.php"); ?>
	</head>

	<body>



      <!-- Main Content -->

	<main role="main">

	<div id="loginMobile" class="container" style="min-height:100vh;">

		<!-- Head Banner -->

		<div class="row" id="registerHeader">

			<div class="col-md-12 text-center">

				<img src="images/logo_brand_3.png" alt="EchoMusic">

				<hr>

			</div>

		</div>



		<!-- Main Body -->

		<div class="row">
			<div class="offset-md-3 col-md-6 mb-4">

				<div class="row">

					<h2 class="col-12">Para continuar, inicia sesión:</h2>
          <?php
            if ( isset($errMSG) ) {
              echo '<h2 class="col-12 text-danger">'.$errMSG.'</h2>';
            }
          ?>
          <div class="col-12">
            <div id="my-signin2" class="g-signin2" ></div>

            <form action="" method="post">
                <input type="hidden" name="googleID_token" id="googleID_token">
                <input type="hidden" name="first_name" id="first_name">
                <input type="hidden" name="last_name" id="last_name">
                <input type="hidden" name="email" id="email">
            </form>
          </div>

          <hr>

          <h2 class="col-12">O utiliza tu cuenta EchoMusic:</h2>

					<form class="col-12" action="" method="POST">
						<div class="form-group">
							<input type="email" name="email" class="form-control" id="" placeholder="Correo electrónico">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" id="" placeholder="Contraseña">
						</div>
						<div class="form-group custom-control custom-checkbox">
							<div class="row">
								<div class="col-6 col-md-6">
									<input type="checkbox" class="custom-control-input" id="customCheck1">
									<label class="custom-control-label" for="customCheck1">Recordar mi sesión</label>
								</div>
								<div class="col-6 col-md-6 text-right">
									<button type="submit" name="login_button" class="btn btn-primary px-3">Iniciar Sesión</button>
								</div>
							</div>
						</div>
					</form>
					<div class="col-12 text-center">
            			<a href="recover.php">¿Olvidaste tu contraseña?</a>
          			</div>
				</div>

			</div>
		</div>
		<div class="row" >
			<div class="col-md-12 text-center hr-class">
				<hr>
			</div>
		</div>
		<div class="row text-center">
			<h2 class="col-12 col-md-12">¿Sin cuenta?</h2>
			<div class="col-md-12">
				<a href="register.php" class="btn btn-outline-primary-new px-5">Regístrate</a>
			</div>
		</div>

	</main>



<!-- Footer -->







		<!-- Scripts -->

			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<?php

		include 'resources/footer.php';

	 ?>

   <? include 'resources/googleLoginScript.php'; ?>
	</body>

</html>
