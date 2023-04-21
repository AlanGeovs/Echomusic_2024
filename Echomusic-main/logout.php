<?php  ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

// if(isset($_SESSION['loggedTester']) AND $_SESSION['loggedTester'] == true){

//

// }else{

//   header('Location: logintester.php');

//   die();

// }

include 'resources/logout_script.php';

?>

<!DOCTYPE HTML>

<!--

	Solid State by HTML5 UP

	html5up.net | @ajlkn

	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)

-->

<html>

	<head>

		<title>EchoMusic | Cerrar sesión</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>
		<? include_once("resources/Analytics.php"); ?>
	</head>

	<body>
<main role="main">

        <div class="container" style="min-height:100vh;">



            <!-- Head Banner -->

            <div class="row" id="registerHeader">

              <div class="col-md-12 text-center">

                <img src="images/logo_brand_3.png" alt="EchoMusic" width="150">

                <hr>

              </div>

            </div>

			<div class="row mt-4" id="pagoConfirmado">

			    <div class="text-center col-md-12 align-self-center">
				    <h2>SESIÓN CERRADA</h2>
				</div>
			    <div class="text-center offset-md-3 col-md-6 align-self-center">
				    <p>REDIRIGIENDO AL INICIO.</p>
			    </div>


			</div>
			<div class="row mt-4" id="pagoConfirmado">
				<div class="text-center offset-md-3 col-md-6 align-self-center mt-5">
				    <p>Si aún necesitas ayuda, ponte en contacto con el <span>Soporte de EchoMusic escribiendo a contacto@echomusic.cl</span></p>
		    	</div>
			</div>
		</div>



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


			<script> Cookies.remove('defaultOpen') </script>


	</body>

</html>
