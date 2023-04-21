<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

include 'resources/login_script.php';

// include 'resources/index_script.php';

// if(isset($_SESSION['loggedTester']) AND $_SESSION['loggedTester'] == true){

//

// }else{

//   header('Location: logintester.php');

//   die();

// }

?>

<!DOCTYPE HTML>

<!--

	Solid State by HTML5 UP

	html5up.net | @ajlkn

	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)

-->

<html>

	<head>

		<title>EchoMusic | ¿Qué es EchoMusic?</title>

		<meta charset="utf-8" />
		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />

		<meta name="og:image" content="https://qa.echomusic.cl/images/logo_brand_3.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="¿Quienes somos? EchoMusic.cl - La música nos conecta" />

		<meta name="description" content="EchoMusic es una plataforma digital colaborativa que conecta a músicos con su gente." />

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>

		<? include_once("resources/Analytics.php"); ?>
	</head>

	<body>

		<!-- Top Navbar -->

		<?php

			include 'resources/topNavbar.php';

		 ?>







<!-- Main Content -->

	<main role="main">



		<!-- First Banner -->

	 <div id="aboutMainBanner" class="jumbotron bg-dark">

		 <div class="container text-center text-white">



			 <img src="images/logo_brand_1.png" class="brandLogo mb-2">



		 </div>

	 </div>



		<!-- Container -->

		<div class="container">



			<!-- About Info -->

			<div class="row justify-content-center" id="aboutFirstIntro">

				<div class="col-md-10 text-center">

					<h2 class="font-weight-bold">¿Qué es EchoMusic?</h2>

					<p>Somos una plataforma digital que conecta músicos/as emergentes con audiencias y espacios de difusión mediante una suite de soluciones digitales:</p>

					<ul class="list-group list-group-flush">

					  <li class="list-group-item">Perfil digital artista</li>

					  <li class="list-group-item">Ticketing</li>

					  <li class="list-group-item">Crowdfunding</li>

					  <li class="list-group-item">Booking de artistas</li>


					</ul>

				</div>

			</div>

			<hr>

			<!-- User and Artist Info Block -->

			<div class="row mt-5 mb-5" id="aboutInfoUsers">

				<div class="col-md-6 text-center first-block">

					<h2 class="font-weight-bold">Si eres Usuari@</h2>

					<div class="row justify-content-center mt-5">

						<div class=" col-sm-12 infoU-h">

							<ul class="list-group list-group-flush">

							<li class="list-group-item">Descubre nuevos/as artistas.</li>

							<li class="list-group-item">Compra entradas presenciales o streaming para los eventos de tus artistas favoritos.</li>

							<li class="list-group-item">Patrocina proyectos musicales a cambio de recompensas.</li>

							<li class="list-group-item">Contrata artistas para eventos públicos o privados.</li>

							</ul>

						</div>

					</div>

					<a href="register.php#user" class="btn btn-primary">Registrarme</a>

				</div>
				<div class="col-sm-12 d-block d-sm-none">

					<hr>

				</div>

				<div class="col-md-6 text-center second-block">

					<h2 class="font-weight-bold">Si eres Artista</h2>

					<div class="row justify-content-center mt-5">

						<div class=" col-sm-12 infoU-h">

							<ul class="list-group list-group-flush">

								<li class="list-group-item">Crea GRATIS tu perfil digital de artista.</li>

								<li class="list-group-item">Crea eventos presenciales o streaming y vende tus entradas a través de la plataforma.</li>

								<li class="list-group-item">Recauda fondos para llevar adelante tus proyectos musicales tales como EP, Album, video clip, entre otros.</li>

								<li class="list-group-item">Define cuánto vale tu show y permite que contraten tus servicios musicales para eventos públicos o privados.</li>

							</ul>

						</div>

					</div>

					<a href="register.php#artist" class="btn btn-primary">Registrarme</a>

				</div>



			</div>



			<hr>



			<!-- FAQs Info -->

			<div class="row justify-content-center" id="aboutFirstIntro">

				<div class="col-10 text-center">

					<h2 class="font-weight-bold">Preguntas Frecuentes</h2>

					<p>Consulta esta lista de preguntas y respuestas para aclarar tus dudas, si no encuentras una solución no dudes en contactarnos contacto@echomusic.cl</p>

				</div>

			</div>



			<!-- Accordion FAQs panels -->

			<div class="accordion mt-5" id="accordionFAQs">



				<!-- Questions cards -->

			  <div class="card">

			    <div class="card-header" id="FAQ-1">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-1" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Las herramientas digitales tienen costo para el artista? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-1" class="collapse show" aria-labelledby="FAQ-1" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>No; las herramientas digitales actuales no tienen costo para el artista. La comisión de uso de la plataforma es pagada por quien solicita los servicios, ya sea de contratación del artista o compra de ticket para un evento de la modalidad presencial o streaming (online) según sea el caso. </p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-2">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-2" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Que es el Crowdfunding de Echomusic?  <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-2" class="collapse" aria-labelledby="FAQ-2" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>El Crowdfunding de Echomusic  es un modelo de financiamiento creado para músicos que consiste en utilizar el capital de numerosos individuos patrocinadores mediante pequeños aportes. Esta Plataforma Crowdfunding de Echomusic  permite que personas en cualquier parte ya sea de Chile o del mundo puedan aportar dinero a los músicos registrados en Echomusic que requieran recaudar fondos para el desarrollo de un proyecto musical como por ejemplo, la grabación de un disco, o la producción de un video clip etc.</p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-3">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-3" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Para quien está enfocado el Crowdfunding de Echomusic? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-3" class="collapse" aria-labelledby="FAQ-3" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>El Crowdfunding de Echomusic está dirigido a cualquier músico  que desee recaudar fondos para el desarrollo de un proyecto artístico relacionado al desarrollo de su carrera musical. Para ello debe estar previamente registrado en www.echomusic.cl </p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-4">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-4" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Que es un patrocinador? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-4" class="collapse" aria-labelledby="FAQ-4" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>Un patrocinador  es cualquier persona natural o jurídica que desee aportar una suma de dinero  a una campaña de recaudación de fondos o Crowdfunding de Echomusic a cambio de una recompensa o premio que el creador de una campaña pondrá a disposición dentro de su proyecto. </p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-5">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-5" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Como puedo ser un patrocinador? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-5" class="collapse" aria-labelledby="FAQ-5" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>Para  ser patrocinador de una campaña de Crowdfunding de Echomusic, solo debes registrarte como usuario general  en la plataforma Echomusic y acceder a los proyectos que se encuentren en curso, puedes elegir el que más te interese o el de tu artista favorito. </p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-6">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-6" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Cuanto debo pagar por crear un proyecto Crowdfunding en Echomusic?<i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-6" class="collapse" aria-labelledby="FAQ-6" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>Para un artista crear una campaña de recaudación de fondos o Crowdfunding  es totalmente gratis, la comisión de Echomusic se deducirá del monto recaudado por el artista, y será de un 5% + IVA correspondiente al uso de la plataforma y un 3% + IVA  correspondiente al costo de la pasarela de pagos (Khipu, Transbank o las que hubiese en el futuro)</p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-7">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-7" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Que son las recompensas? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-7" class="collapse" aria-labelledby="FAQ-7" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>Las recompensas son los premios o incentivos que el creador de una campaña de Crowdfunding pondrá a disposición para los patrocinadores, estas podrán ser una o más,  las que se diferenciaran de acuerdo al monto que el patrocinador desee aportar. Las recompensas serán entregadas a los patrocinadores siempre y cuando, el proyecto recaude los fondos en el plazo establecido y después de desarrollar el proyecto que dio origen al Crowdfunding, por ejemplo si el proyecto fue creado para la grabación de un disco, y la recompensa es una copia autografiada del disco, este premio será entregado al patrocinador después de grabado el disco.</p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-8">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-8" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Que sucederá si el artista no logra la obtención de los fondos de una campaña en el plazo establecido?  <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-8" class="collapse" aria-labelledby="FAQ-8" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>Si una campaña no logra recaudar los fondos requeridos, estos serán devueltos a los “Patrocinadores” descontando un 2% + IVA, costo correspondiente a la pasarela de pago.</p>

			      </div>

			    </div>

			  </div>


			</div>



		</div>



	</main>



<!-- Footer -->

	<? include 'resources/footer.php'; ?>



		<!-- Scripts -->



			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->



			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>



			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>



			<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>



			<? include 'resources/login_error_script.php'; ?>

			<? include 'resources/googleLoginScript.php'; ?>

	</body>

</html>
