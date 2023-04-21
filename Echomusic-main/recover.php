<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

include 'resources/recover_script.php';

// if(isset($_SESSION['loggedTester']) AND $_SESSION['loggedTester'] == true){
//
//
//
// }else{
//
//   header('Location: logintester.php');
//
//   die();
//
// }

?>

<!DOCTYPE HTML>


<html>

	<head>

		<title>EchoMusic | Recuperar contraseña</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>
		<? include_once("resources/Analytics.php"); ?>
	</head>

	<body>



      <!-- Main Content -->
			<?
				if ( (isset($errTyp) && $errTyp == "success")):
			?>

					<main role="main">

					<div id="pagoConfirmado" class="container" style="min-height:100vh;">

						<!-- Head Banner reutilizacion de css -->

						<div class="row" id="registerHeader">

							<div class="col-md-12 text-center">

								<img src="images/logo_brand_3.png" alt="EchoMusic" width="150">

							</div>
							<div class="col-md-12 text-center hr-class">
								<hr>
							</div>

						</div>



						<!--  notification -->

						<div class="row mt-4" id="pagoConfirmado">

						    <div class="text-center col-md-12 align-self-center">
							    <h2>EchoMusic</h2>
								</div>
						    <div class="text-center offset-md-3 col-md-6 align-self-center">
							    <p><?=$errMSG?></p>
						    </div>
								<div class="text-center offset-md-3 col-md-6 align-self-center">
									<i class="far fa-check-circle"></i>
								</div>

						 </div>

						<div class="row mt-4" id="pagoConfirmado">
								<div class="text-center offset-md-3 col-md-6 align-self-center mt-5">
							    <p>Si aún necesitas ayuda, ponte en contacto con el <span>Soporte de EchoMusic escribiendo a contacto@echomusic.cl</span></p>
						    </div>
							</div>
						</div>

					</main>
			<?
		else:
			 ?>

			 <? if(isset($_GET['code'])): ?>
					 <main role="main">

						 <div class="container" style="min-height:100vh;">



							 <!-- Head Banner -->

							 <div class="row" id="registerHeader">

								 <div class="col-md-12 text-center">

									 <img src="images/logo_brand_3.png" alt="EchoMusic" width="150">

									 <hr>

								 </div>

							 </div>

						 <!-- Main Body -->
					 <div class="row">

					 </div>
							 <div class="col-md-6 m-auto">

								 <div class="text-center">

									 <h3><b>Escribe tu nueva contraseña</b></h3>

								 </div>


						 <!-- New pass -->

								 <form action="" method="POST" autocomplete="off">


									 <div class="form-group">

										 	<label for="new_pass">Contraseña</label>

										 	<input name="password" value="" type="password" class="form-control" id="new_pass">

										 	<span class="text-danger"><strong class="alert"><?php if ( isset($passError)) { echo $passError;} ?></strong></span>

										 	<span id="checkRegisterPassword_artist" class="text-danger "><strong class="alert"></strong></span>

									 </div>

									 <div class="form-group">

										 	<label for="verify_pass">Verifica tu Contraseña</label>

										 	<input name="password_verify" value="" type="password" class="form-control" id="verify_pass">

										 	<span class="text-danger"><strong class="alert"><?php if ( isset($pass_verError)) { echo $pass_verError;} ?></strong></span>

										 	<span id="checkRegisterVPassword_artist" class="text-danger "><strong class="alert"></strong></span>

									 </div>

								 <div class="form-group text-center">

										 <input type="submit" name="submit_button" class="btn btn-primary col-md-5" value="Cambiar contraseña">

								 </div>

						 </form>

					 </div>

			 	</div>

		 		</main>

			 <? else: ?>
	      	<main role="main">

	          <div class="container" style="min-height:100vh;">



	            <!-- Head Banner -->

	            <div class="row" id="registerHeader">

	              <div class="col-md-12 text-center">

	                <img src="images/logo_brand_3.png" alt="EchoMusic" width="150">

	                <hr>

	              </div>

	            </div>



	          <!-- Main Body -->
	        <div class="row">

	        </div>
	            <div class="col-md-6 m-auto">

								<div class="text-center">

									<h3><b>Recuperar mi contraseña</b></h3>

								</div>


						<!-- pass recover form -->

	              <form action="" method="POST" autocomplete="off">


	                <div class="form-group">

	                  <label for="inputRegisterEmail_artist">Correo Electrónico</label>

	                  <input name="email" value="<?php if ( isset($email)) { echo $email;}; ?>" type="email" class="form-control" id="inputRegisterEmail_artist" placeholder="ejemplo@correo.com">

										<span class="text-danger"><strong class="alert"><?php if ( isset($emailError)) { echo $emailError;} ?></strong></span>

	                </div>

									<div class="form-group text-center">

				            	<input type="submit" name="recover_button" class="btn btn-primary col-md-5" value="Recuperar contraseña">

									</div>

	          	</form>

	        </div>

	    </div>

		</main>
	<? endif; ?>

<? endif; ?>


<!-- Footer -->



	<?php

		include 'resources/footer.php';

	 ?>



		<!-- Scripts -->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="https://www.google.com/recaptcha/api.js" async defer></script>

			<script src="assets/js/validateRegisterUser.js"></script>

			<script src="assets/js/validateRegisterArtist.js"></script>

			<? if($errTyp == "danger"): ?>
				<script type='text/javascript'>alert('<?=$errMSG?>');</script>
			<? endif; ?>

	</body>

</html>
