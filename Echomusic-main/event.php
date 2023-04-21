<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/eventDetail_script.php';
include 'resources/login_script.php';
// include 'resources/streaming_ticket_script.php';
// include 'resources/presencial_ticket_script.php';
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

		<title><?=$eventDetail['name_event']?> - EchoMusic</title>

		<meta charset="utf-8" />
		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Crea tu evento EchoMusic streaming o presencial y monetiza tu talento." />

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>

		<!-- FB meta share -->
		<meta property="og:url"           content="https://qa.echomusic.cl/event.php?<?=$typeEvent?>=<?=$idEvent?>" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="<?=$eventDetail['name_event']?> - EchoMusic" />
		<meta property="og:description"   content="<?=$eventDetail['desc_event']?>" />
		<meta property="og:image"         content="https://qa.echomusic.cl/images/events/<?=$eventDetail['img']?>.jpg" />
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
		<div id="space" style="height:50px;" class="d-none d-sm-block"></div>

		<div id="eventMainBanner" class="jumbotron bg-dark d-block d-sm-none" style="background-image: linear-gradient(to top, rgba(50, 50, 50, 0.8), rgba(0, 1, 13, 0.5)), url('../../images/events/<?=$eventDetail['img']?>.jpg');">

			 <div class="container text-center text-white">



			 </div>

		</div>



<!-- Name and Share -->

	 <div class="wt-80" id="eventHeaderShare">

		 <div class="row justify-content-between">

			 <div class="col-md-6 col-6 first-block">

			 	<nav aria-label="breadcrumb" id="eventBreadcrumb">

				  <ol class="breadcrumb mb-0">

				    <li class="breadcrumb-item"><a href="<?=$breadCrumbUrl?>"><?=$breadCrumbName?></a></li>

				    <li class="breadcrumb-item active" aria-current="page"><?=$eventName?></li>

				  </ol>

				</nav>

			</div>

			<div class="col-md-6 col-12 text-right second-block">

				<ul class="list-inline">

					<li class="list-inline-item"><h2>Compartir</h2></li>
					<li class="list-inline-item list-fb"><a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/sharer.php?u=https://qa.echomusic.cl/event.php?<?=$typeEvent?>=<?=$idEvent?>" target="_blank"><i class="fab fa-facebook-f share-fb"></i></a> </li>
					<li class="list-inline-item list-tw"><a target="_blank" rel="noopener noreferrer" href="https://twitter.com/share?url=https://qa.echomusic.cl/event.php?<?=$typeEvent?>=<?=$idEvent?>&amp;text=EchoMusic&amp;hashtags=echomusic" target="_blank"><i class="fab fa-twitter share-tw"></i></a> </li>
					<li class="list-inline-item list-wpp"><a href="https://api.whatsapp.com/send?text=https://qa.echomusic.cl/event.php?<?=$typeEvent?>=<?=$idEvent?>" data-action="share/whatsapp/share" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp share-wpp"></i></a></li>
					</h2>

			</div>

		 </div>

	 </div>



		<!-- Container -->

		<div class="container">

			<!-- Event Main Info

			<div class="row mt-4" id="eventDetailInfo">

				<div class="col-md-6">

					<h2 class="mt-0 mb-0"><?=$eventName?></h2>


					<h3 class="mt-0 mb-0"><?getDayday($eventDate); ?> de <? getMonthYear($eventDate); ?> - <?=$eventTime?> hrs</h3>

					<h3 class="mt-0 mb-0"><?=$eventLocation?></h3>

				</div>

			</div>
		-->


			<!-- Event desc -->

			<div class="row mt-4" id="eventDetailDesc">

				<div class="col-md-6 col-12"  id="eventDetailInfo">
					<div class="align-middle">
						<h2 class="mt-0 mb-0"><?=$eventName?></h2>


						<h3 class="mt-0 mb-0"><?getDayday($eventDate); ?> de <? getMonthYear($eventDate); ?> - <?=$eventTime?> hrs</h3>

						<h3 class="mt-0 mb-0"><?=$eventLocation?></h3>

						<br>

						<p><?=nl2br($eventDescription)?></p>
					</div>
				</div>
				<div class="col-md-6 col-12">

					<img id="imagenEvento" class="d-none d-sm-block" src="../../images/events/<?=$eventDetail['img']?>.jpg" style="min-height: 400px; width:100%; max-width:400px;"/>

				</div>

			</div>

			<!-- Video Section -->
			<? if(mysqli_num_rows($queryFeaturedMultimedia)>0):?>
				<div class="row mt-4" id="videoContainerSection">

					<div class="col-lg-7 col-sm-12 mb-3 mb-md-0" id="featuredVideo">
						<? switch($postDetail['service_multi']):case "youtube":?>
							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?=$postDetail['embed_multi']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<? break; ?>
						<? case "vimeo": ?>
							<iframe width="100%" height="100%" src="https://player.vimeo.com/video/<?=$postDetail['embed_multi']?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
						<? break; ?>
						<? endswitch; ?>

					</div>
				</div>
			<? endif; ?>



			<!-- Price and Date -->

			<div class="row mt-3" id="eventDetailPrice">

				<div class="col-md-auto first-block font-weight-bold">

					TICKETS

				<div class="row d-block d-sm-none">
					<div class="vc_empty_space" style="height:25px;"><span class="vc_empty_space_inner"></span></div>
				</div>

				</div>

				<div class="col-md-auto second-block">

					<div class="media">

					  <i class="fas fa-dollar-sign fa-2x mr-3 align-self-center"></i>

					  <div class="media-body">

					    <span>Precio</span>

							<br>
							<? if(isset($_GET['public'])):?>

									<span class="font-weight-bold">Desde <?=$eventValue?></span>

							<? elseif(isset($_GET['streaming'])): ?>

								<? if($eventDetail['value'] == "0"):?>
						    	<span class="font-weight-bold"><?=$eventValue?></span>
								<? else: ?>
									<span class="font-weight-bold">Desde <?=$eventValue?></span>
								<? endif; ?>

							<? endif;?>
					  </div>

					</div>
				<div class="row d-block d-sm-none">
					<div class="vc_empty_space" style="height:25px;"><span class="vc_empty_space_inner"></span></div>
				</div>

				</div>

				<div class="col-md-auto third-block">

					<div class="media">

					  <i class="far fa-calendar-alt fa-2x mr-3 align-self-center"></i>

					  <div class="media-body">

					    <span>Fecha</span>

							<br>

					    <span class="font-weight-bold"><?getDayday($eventDate); ?> de <? getMonthYear($eventDate); ?> - <?=$eventTime?> hrs</span>

					  </div>

					</div>
					<div class="row d-block d-sm-none">
						<div class="vc_empty_space" style="height:25px;"><span class="vc_empty_space_inner"></span></div>
					</div>

				</div>

				<div class="col-sm fourth-block align-self-center">

					<!-- <a href="" class="btn btn-secondary btn-plus">
						<div class="media">
							<i class="fas fa-plus fa-2x mr-3 align-self-center"></i>
							<div class="media-body">
								ver todas las <br> <b>fechas y precios</b>
							</div>
						</div>
					</a> -->
					<? if($typeEvent=='streaming' AND $eventActiveStatus=='1'): ?>

						<? if($userSubscribed == true): ?>
							<a href="streaming.php?event=<?=$eventDetail['id_event']?>" class="btn btn-primary px-5" style="line-height: 30px;">Ir al Streaming</a>
						<? else: ?>

								<? if(strtotime('+12 hours', strtotime($eventDetail['date_event']))>time()): ?>

										<? if($totalAudience <= $countAudience): ?>
											<a class="btn btn-primary px-5 isDisabled" style="line-height: 30px;">Entradas agotadas</a>
										<? else: ?>

											<? if(isset($_SESSION['user'])): ?>
												<a href="ticket_buy.php?streaming=<?=$eventDetail['id_event']?>" class="btn btn-primary px-5" style="line-height: 30px;"><?=$textButtonTicket = ($eventDetail['value']=='0') ? "Suscribirme" : "Comprar Entrada" ?></a>
											<? else: ?>

												<a data-toggle="modal" data-target="#loginModal" class="btn btn-primary px-5" style="line-height: 30px;"><?=$textButtonTicket = ($eventDetail['value']=='0') ? "Suscribirme" : "Comprar Entrada" ?></a>
											<? endif; ?>

										<? endif; ?>

								<? endif; ?>

						<? endif; ?>

					<? elseif($typeEvent=='public' AND $eventActiveStatus=='1'): ?>

						<? if($userSubscribed == true): ?>
							<a href="" class="btn btn-primary px-5" style="line-height: 30px;">Entrada comprada</a>
						<? else: ?>

								<? if(strtotime("+12 hours", strtotime($eventDetail['date_event']))>time()): ?>

										<? if($totalAudience <= $countAudience): ?>
											<a class="btn btn-primary px-5 isDisabled" style="line-height: 30px;">Entradas agotadas</a>
										<? else: ?>

											<? if(isset($_SESSION['user'])): ?>
												<a href="ticket_buy.php?public=<?=$eventDetail['id_event']?>" class="btn btn-primary px-5" style="line-height: 30px;"><?=$textButtonTicket = ($ticketValue=='0') ? "Suscribirme" : "Comprar Entrada" ?></a>
											<? else: ?>

												<a data-toggle="modal" data-target="#loginModal" class="btn btn-primary px-5" style="line-height: 30px;"><?=$textButtonTicket = ($ticketValue=='0') ? "Suscribirme" : "Comprar Entrada" ?></a>
											<? endif; ?>

								<? endif; ?>

						<? endif; ?>

				 	<? endif; ?>
				 	<? endif; ?>
				</div>

			</div>



			<!-- Location -->

			<!-- <div class="row mt-3" id="eventDetailLocation">

				<div class="col">

					<span class="font-weight-bold">Lugar del evento</span><span> <?=$eventDetail['location']?></span><span> <?=$eventDetail['name_city']?></span>

				</div>

				<div class="col-lg-12 mt-3">

					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26644.744017688252!2d-70.56067722382703!3d-33.407780939528756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662cf3e8f79f32d%3A0x20e644675483b8f6!2sClub%20de%20Golf%20Los%20Leones!5e0!3m2!1ses!2scl!4v1600708092197!5m2!1ses!2scl" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

				</div>

			</div> -->

			<!-- Second compra -->
			<!-- <div class="row" id="eventSegundaCompra" >
				<div class="col-md-6 first-block">
					<h2 class="mt-0 mb-0">Artista</h2>

					<h3 class="mt-0 mb-1">Título Evento</h3>
				</div>
				<div class="col-md-6 second-block">
					<a href="" class="btn btn-primary px-5" style="    line-height: 30px;">Comprar</a>
				</div>
			</div> -->
			<div class="row" id="" >
				<div class="col-md-12">
					<ul class="list-inline list-border">
						<li class="list-inline-item"><a href=""> Métodos de pago</a></li>
						<li class="list-inline-item"><a href="" data-toggle="modal" data-target="#conditionsModal"> Términos y Condiciones</a></li>
					</ul>
				</div>
			</div>
		</div>



	</main>







		<!-- Scripts -->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

			<script src="assets/js/jquery.rut.js"></script>

			<script>
        $("input#inputRut").rut({formatOn: 'keyup', ignoreControlKeys: false})
      </script>

			<? include 'resources/login_error_script.php'; ?>

			<? if(isset($errTyp) && $errTyp =='danger'): ?>
        <script type='text/javascript'>alert('<?=$errMSG?>');</script>
      <? endif; ?>

			<? if(isset($_SESSION['success'])): ?>
				<script type='text/javascript'>alert('<?=$_SESSION['success']?>');</script>
				<? unset($_SESSION['success']) ?>
			<? endif; ?>

<!-- Footer -->

	<? include 'resources/footer.php'; ?>

	<? include 'resources/googleLoginScript.php'; ?>

	</body>

	<?php

	include 'resources/conditionsModal.php';
	include 'resources/privacyModal.php';

	?>

</html>
