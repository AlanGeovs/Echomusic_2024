<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';
include 'resources/crowdfunding/projectUpdate_script.php';
/*
include 'resources/index_script.php';

if(isset($_SESSION['loggedTester']) AND $_SESSION['loggedTester'] == true){



}else{

  header('Location: logintester.php');

  die();

}*/

?>

<!DOCTYPE HTML>


<html>

	<head>

		<title>EchoMusic | PANEL DE CONTROL</title>

		<meta charset="utf-8" />
		<meta name="author" content="EchoMusic" />

		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />

		<meta name="og:image" content="https://echomusic.cl/images/logo_brand_3.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="Buscador EchoMusic.cl - La música nos conecta" />

		<meta name="description" content="Encuentra a tu artista favorito y proximos eventos." />

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>
		<? include_once("resources/Analytics.php"); ?>
		<style type="text/css">
			:root {
			  --animate-duration: 800ms;
			}
			.d_none{
			  display:none;
			}
		</style>
	</head>

	<body>
	<main id="" role="main">

		<!-- Top Navbar -->

		<?php

			include 'resources/topNavbar.php';

		 ?>

<!-- Main Content -->

		<!-- First Banner -->
		<div id="searchMainBanner_CrowdF" class="jumbotron bg-dark mb-0">
			<div class="container text-center text-white">
				<h2><strong>EchoMusic</strong>.</h2>
			</div>
		</div>



		<!-- Container -->

		<div class="container">

				<!-- Breadcrumb -->

				<nav aria-label="breadcrumb" id="searchBreadcrumb">

				  <ol class="breadcrumb mb-0">

				    <li class="breadcrumb-item"><a href="dashboard.php">Panel de Control</a></li>

				    <li class="breadcrumb-item active" aria-current="page">Avance crowdfunding</li>

				  </ol>

				</nav>



				<!-- Filters -->

				<div class="row " id="">

					<div class="col-xl-4 col-lg-6 col-md-6 col-6">

						<h2 class="font-weight-bold">Avances <?=$dataProjectArray['project_title']?></h2>

					</div>

				</div>

				<!-- Artists Cards -->

			<div id="proyecto-items-avance" class="row proyecto-items proyecto-card" style="width: 100%;">
				<div class="accordion mt-5" id="accordionDashboard" style="width: 100%;">
					<? $i = 1; ?>
					<? foreach($projectUpdatesArray as $projectUpdates): ?>

					<? $dateTimeUpdate = date_create($projectUpdates['update_date']);?>
					<? $datemdy = DATE_FORMAT($dateTimeUpdate, 'd/m/Y');?>
						<div class="card">
						    <div class="card-header" id="">
						      <h2 class="mb-0">
						        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#avanceProyecto<?=$i?>" aria-expanded="true" aria-controls="avanceProyecto<?=$i?>">
						          Avance <?=$datemdy?> <i class="fas fa-caret-down"></i>
						        </button>
						      </h2>
						    </div>

						    <div id="avanceProyecto<?=$i?>" class="collapse" aria-labelledby="avanceProyecto<?=$i?>" data-parent="#accordionDashboard" style="">
						    	<div class="card-body">
						    		<p class="font-weight-bold">Actualización <?getDayday($dateTimeUpdate); ?> de <? getMonthYear($dateTimeUpdate); ?></p>
										<img src="images/crowdfunding/pr_<?=$prId?>/<?=$projectUpdates['project_multimedia_name']?>.jpg"/>
						    		<p><?=nl2br($projectUpdates['update_desc'])?></p>
								</div>
						    </div>
						</div>
					<? $i++; ?>
					<? endforeach; ?>
					<? unset($i); ?>

				</div>
			</div>
			<div class="row proyecto-items proyecto-card">
				<div class="col-md-12">
					<div class="card-body">
						<p class="font-weight-bold">Ingresar nuevo Avance</p>
						<p>Con fecha <?=date('d/m/Y', time())?></p>
						<p>Al publicar un avance, éste será visible en la página de tu proyecto y estará disponible de manera pública. Asegurate de revisar bien la información de deseas subir.</p>
						<p>Los patrocinadores del proyecto serán notificados cuando publiques un avance de tu crowdfunding.</p>

						<form id="form-update" method="post" enctype="multipart/form-data" action="">


							<div class="form-row mt-3">
								<div class="form-group  col-md-12">
									<label class="font-weight-bold" for="">Avance</label>
									<textarea class="form-control form-custom-1" name="description" id="descUpdate" rows="6" placeholder="Describe el progreso del proyecto y las etapas que se han completado"></textarea>
									<? if(isset($descError)): ?><span class="text-danger"><strong class="alert"><?=$descError?></strong></span><? endif; ?>
								</div>
							</div>

							<div class="form-row mt-3">
								<div class="form-group col-md-8">
									<label class="font-weight-bold" for="">Imagen (Opcional)</label>
									<input type="file" class="file-input" name="file-input">
									<? if(isset($imageError)): ?><span class="text-danger"><strong class="alert"><?=$imageError?></strong></span><? endif; ?>
								</div>
							</div>

							<div class="form-row mt-3">
								<input type="submit" name="submit_update" value="Publicar avance" class="btn btn-primary px-5 py-2 btn-border"/>
							</div>
						</form>

					</div>
				</div>
			</div>
				<!-- </div> -->

			</div>

	</main>





		<!-- Scripts -->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="assets/js/ajaxChangeGenres.js"></script>

			<script src="assets/js/jquery.charactercounter.js"></script>

			<? include 'resources/login_error_script.php'; ?>

<!-- Footer -->

<? include 'resources/footer.php'; ?>

	 <script type="text/javascript">

			function change_page(from_sel,to_sel){
			  var from = document.querySelector(from_sel);
			  var to = document.querySelector(to_sel);
			  from.classList.add('animate__zoomOut');
			  from.onanimationend = () => {
			    from.classList.remove('animate__zoomOut');
			    from.classList.add('d_none');
			    to.classList.remove('d_none');
			    to.classList.add('animate__zoomIn');
			    to.onanimationend = () => {
			      to.classList.remove('animate__zoomIn');
			    }
			  }
			}

			let buttons = document.querySelectorAll('.btn_tab');

			for (var item of buttons) {
			  item.addEventListener("click", function (event) {
			    event.preventDefault();
			    console.log(this);
			    console.log(this.getAttribute("data-from"));
			    change_page(this.getAttribute("data-from"),this.getAttribute("data-to"))
			  });
			}

		 </script>

		 <script>
			 $("#descUpdate").characterCounter({
				 limit: '3000',
				 counterFormat: '%1 caracteres restantes'
			 });
		 </script>

		 <? if(isset($errTyp) && $errTyp =='danger'): ?>
			 <script type='text/javascript'>alert('<?=$errMSG?>');</script>
		 <? endif; ?>

		 <? if(isset($_SESSION['success'])): ?>
			 <script type='text/javascript'>alert('<?=$_SESSION['success']?>');</script>
			 <? unset($_SESSION['success']) ?>
		 <? endif; ?>

		 <? include 'resources/googleLoginScript.php'; ?>
	</body>

</html>
