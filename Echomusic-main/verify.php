<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/verify_script.php';
/*
include 'resources/index_script.php';

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

		<title>EchoMusic | Verificación</title>

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

	<div id="pagoConfirmado" class="container" style="min-height:100vh;">

		<!-- Head Banner reutilizacion de css -->

		<div class="row" id="registerHeader">

			<div class="col-md-12 text-center">

				<img src="images/logo_brand_5.png" alt="EchoMusic">

			</div>
			<div class="col-md-12 text-center hr-class">
				<hr>
			</div>

		</div>



			<!--  notification -->

		<div class="row mt-4" id="pagoConfirmado">
			<div class="text-center col-md-12 align-self-center">
				<h2><?php if(isset($errTyp)){ echo $errMSG; }?></h2>
			</div>
			<div class="text-center offset-md-3 col-md-6 align-self-center">
				<?php
					switch($errTyp){
						case 'success':
							echo
								'<p>Su cuenta EchoMusic ha sido verificada correctamente.</p>
								<i class="far fa-check-circle"></i>';
						break;
						case 'waiting':
						echo
							'<p>Estamos verificando su cuenta, por favor espere...</p>
							<i class="far fa-clock"></i>';
						break;
						case 'danger':
						echo
							'<p>Su cuenta EchoMusic no pudo ser verificada, por favor inténtelo más tarde.</p>
							<i class="fas fa-times"></i>';
						break;
					}


				?>
			</div>

		</div>

			<div class="row justify-content-center mt-5">

				<div class="col-md-3 text-center mt-1">

					<a class="btn btn-outline-secondary btn-block btn-lg" href="index.php">Volver al inicio</a>

				</div>

				<div class="col-md-3 text-center mt-1">

					<a class="btn btn-primary btn-block btn-lg" href="login.php">Iniciar Sesión</a>

				</div>

			</div>

		</div>

	</main>



<!-- Footer -->





		<!-- Scripts -->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
