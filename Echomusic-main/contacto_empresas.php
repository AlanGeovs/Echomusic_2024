<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

include 'resources/companies_script.php';
include 'resources/login_script.php';
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

		<title>EchoMusic | Asesoría empresas</title>

		<meta charset="utf-8" />
		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />

		<meta name="og:image" content="https://qa.echomusic.cl/images/logo_brand_3.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="Contacto Empresas EchoMusic.cl - La música nos conecta" />

		<meta name="description" content="Si buscas asesoría para un evento de empresas, contáctanos y te ayudaremos." />

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>

		<? include_once("resources/Analytics.php"); ?>
	</head>

	<body>

<!-- Main Content -->

	<main role="main">
		<!-- Top Navbar -->

		<?php

			include 'resources/topNavbar.php';

		 ?>





		<!-- First Banner -->

	 <div id="contactCompanyMainBanner" class="jumbotron bg-dark">

		 <div class="container text-center text-white">

			 <h1>Contacto Empresas u Organizaciones</h1>

			 <h2>¿Buscas asesoría para un evento de empresas? ¿Quieres gestionar tus eventos con EchoMusic?</h2>

		 </div>

	 </div>



		<!-- Container -->

		<div class="container">



			<!-- About Info -->

			<div class="row justify-content-center" id="contactCompanyIntro">

				<div class="col-10 text-center">

					<h2 class="font-weight-bold">Formulario Contacto</h2>
					<? if ( isset($errMSG) && $errTyp = "success"): ?>
					 	<h3 class="major font-weight-bold text-success"><?=$errMSG?></h3>
					<? elseif(isset($errMSG) && $errTyp = "danger"): ?>
						<h3 class="major font-weight-bold text-danger"><?=$errMSG?></h3>
					<? endif;?>

				</div>

			</div>

			<hr>



				<form method="POST" action="">

					<div class="form-row mt-3">

						<div class="form-group col-lg-4">

							<label class="font-weight-bold" for="inputContactName">Nombre</label>

							<input type="text" name="first_name" value="<?if(isset($first_name)){ echo str_replace("\'","'",$first_name);  }?>" class="form-control form-custom-1" id="inputContactName">

							<span class="text-danger"><strong class="alert"><?php if ( isset($first_nameError)) { echo $first_nameError;}; ?></strong></span>

						</div>

						<div class="form-group col-lg-4">

							<label class="font-weight-bold" for="inputContactLastName">Apellido</label>

							<input type="text" name="last_name" value="<?if(isset($last_name)){ echo str_replace("\'","'",$last_name);  }?>" class="form-control form-custom-1" id="inputContactLastName">

							<span class="text-danger"><strong class="alert"><?php if ( isset($last_nameError)) { echo $last_nameError;}; ?></strong></span>

						</div>

						<div class="form-group col-lg-4">

							<label class="font-weight-bold" for="inputContactCompany">Nombre de Empresa/Organización</label>

							<input type="text" name="company_name" value="<?if(isset($company_name)){ echo str_replace("\'","'",$company_name);  }?>" class="form-control form-custom-1" id="inputContactCompany">

							<span class="text-danger"><strong class="alert"><?php if ( isset($company_nameError)) { echo $company_nameError;}; ?></strong></span>

						</div>

					</div>

					<div class="form-row mt-3">

						<div class="form-group col-lg-4">

							<label class="font-weight-bold" for="inputContactName">Cargo en la Empresa</label>

							<input type="text" name="position" value="<?php if ( isset($position)) { echo $position;} ?>" class="form-control form-custom-1" id="inputContactPosition">

							<span class="text-danger"><strong class="alert"><?php if ( isset($positionError)) { echo $positionError;}; ?></strong></span>

						</div>

						<div class="form-group col-lg-4">

							<label class="font-weight-bold" for="inputContactLastName">Correo</label>

							<input type="email" name="email" value="<?php if ( isset($email)) { echo $email;} ?>" class="form-control form-custom-1" id="inputContactEmail">

							<span class="text-danger"><strong class="alert"><?php if ( isset($emailError)) { echo $emailError;}; ?></strong></span>

						</div>

						<div class="form-group col-lg-4">

							<label class="font-weight-bold" for="inputContactCompany">Teléfono</label>

							<input type="text" name="phone" value="<?php if ( isset($phone)) { echo $phone;} ?>" class="form-control form-custom-1" id="inputContactPhone">

							<span class="text-danger"><strong class="alert"><?php if ( isset($phoneError)) { echo $phoneError;} ?></strong></span>

						</div>

					</div>

					<div class="form-row mt-3">

						<div class="form-group col-md-8 col-sm-12">

							<label class="font-weight-bold" for="inputContactMessage">Escribe tu solicitud:</label>

							<textarea name="description_text" placeholder="Mínimo 50 caracteres" class="form-control form-custom-1" id="inputContactMessage" rows="6"><?if(isset($desc)){ echo str_replace("\'","'",$desc);  }?></textarea>

							<span class="text-danger"><strong class="alert"><?php if ( isset($descError)) { echo $descError;} ?></strong></span>

						</div>

					</div>

					<div class="form-row mt-3">

						<button type="submit" name="contactCompany_submit" class="btn btn-primary btn-lg">Enviar solicitud</button>

					</div>

				</form>



		</div>



	</main>







		<!-- Scripts -->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

			<script src="assets/js/jquery.charactercounter.js"></script>

			<? include 'resources/login_error_script.php'; ?>

			<? if($errTyp=="danger" || $errTyp=="success"): ?>
			   <script type='text/javascript'>alert('<?=$errMSG?>');</script>
			<? endif; ?>

			<script>
				$("#inputContactMessage").characterCounter({
				  limit: '2000',
					counterFormat: '%1 caracteres restantes'
				});
			</script>


<!-- Footer -->

	<? include 'resources/footer.php'; ?>

	<? include 'resources/googleLoginScript.php'; ?>

	</body>

</html>
