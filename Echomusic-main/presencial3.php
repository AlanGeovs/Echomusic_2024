<?php
/*
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

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

		<title>EchoMusic</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>

	</head>

	<body>
	<main role="main">
		<!-- Top Navbar -->

		<?php

			include 'resources/topNavbar.php';



		 ?>

<div id="profileMainBanner" class="jumbotron pb-0">
			<div class="backgroundImage"></div>
		</div>



<!-- Main Content -->
<div id="streamMainBanner" class="container">


	<div class="row mt-4">
	  	<!-- Reserve notification -->

		<div class="col-md-12 mt-4" id="streamConfirmNotice">
		    <div class="text-center col-12 align-self-center">
				<h2>Evento Guardado exitosamente</h2>
				<p class="font-weight-bold">Para que tu evento sea publicado en la cartelera de EchoMusic debes terminar la configuración en tu panel de control.</p>
				<i class="far fa-check-circle my-5"></i>
		    </div>
		</div>

		<!-- <div class="col-md-12 mt-4" id="streamConfirmNotice">
		    <div class="text-center col-12 align-self-center">
			      <h2>Código del Evento</h2>
			      <span id="reserveCode">000-026-12</span>
		    </div>
		</div> -->
	</div>
	<div class="row my-5">
	  	<!-- Reserve notification -->

		<div class="col-md-12 text-center" id="streamConfirmNotice">
			<h2>Nombre Evento</h2>
			<hr>
		</div>
		<div class="col-md-6" id="streamConfirmNotice">
		    <div class="text-rightcenter">
		    	<img src="https://localhost/echomusic/images/avatars/56.jpg">
		    </div>
		</div>

		<div class="col-md-6 text-leftcenter" id="streamConfirmNotice">
			<h3>Hora de Inicio</h3>
			<p class="font-weight-bold mb-3">16 Octubre 2020 19:30 hrs</p>
			<h3>Duracion</h3>
			<p class="font-weight-bold mb-3">02:00 hrs</p>
			<h3>Hora de Termino</h3>
			<p class="font-weight-bold">16 Octubre 2020 21:30 hrs</p>
		</div>
	</div>
	<div class="row mt-4">
	  	<!-- Reserve notification -->

		<div class="col-md-12 mt-4" id="streamConfirmNotice">
		    <div class="text-center col-12 align-self-center">
		    	<a class="btn btn-primary btn-lg" href="#" role="button">Ir a ...</a>
		    </div>
		</div>
	</div>
</div>





<!-- Main Content -->




	</main>


<!-- Scripts -->

			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

<!-- Footer -->

	<?php

		include 'resources/footer.php';

	 ?>

	 <? include 'resources/googleLoginScript.php'; ?>


	</body>

</html>
