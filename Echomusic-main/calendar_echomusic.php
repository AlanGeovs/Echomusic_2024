<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/calendar_script.php';
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

		<title>EchoMusic | Cartelera</title>

		<meta charset="utf-8" />
		<meta name="author" content="EchoMusic" />

		<meta name="keywords" content="Venta de entradas, Venta de tickets, Crea tu evento, Cartelera de eventos, vender mi evento, venta entradas online, Eventos streaming, Eventos online" />

		<meta name="og:image" content="https://qa.echomusic.cl/images/logo_brand_3.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="Cartelera EchoMusic.cl - La música nos conecta" />

		<meta name="description" content="Explora y conoce los proximos eventos de EchoMusic." />

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet"  href="assets/css/custom.css">
		<link rel="stylesheet"  href="assets/css/jquery-ui.css">
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

		<div id="calendarMainBanner" class="jumbotron bg-dark mb-0">

			<div class="container text-center text-white">

				<h1>Explora y Conoce</h1>

				<h2>Los eventos de la Cartelera EchoMusic</h2>

			</div>

		</div>



		<!-- Container -->

		<div class="wt-80">

				<!-- Breadcrumb -->

				<nav aria-label="breadcrumb" id="calendarBreadcrumb">

				  <ol class="breadcrumb mb-0">

				    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>

				    <li class="breadcrumb-item active" aria-current="page">Cartelera EchoMusic</li>

				  </ol>

				</nav>



				<!-- Filters -->


		<div class=" ml-1 mr-1" id="calendarFilters">
			<div class="container" >
				<form action="" method="GET">
					<div class="row " style="align-items: flex-end;">

							<div class="col-md-3">
								<input name="date" type="text" id="dateEventInput" class="form-control form-custom-1" placeholder="Día del evento">
								<i class="fas fa-calendar-alt calendarIcon" style="top:0;"></i>
							</div>


							<div class="col-md-3">

								<input type="text" class="form-control form-custom-1" placeholder="Buscar por nombre" name="nameEvent">

							</div>

							<div class="col-md-auto">

								<select name="region" class="form-control form-custom-1">

								  <option value="" selected>Región</option>

								  <? foreach($regionsArray as $regions): ?>
										<option value="<?=$regions['id_region']?>"><?=$regions['name_region']?></option>';
									<? endforeach; ?>

								</select>

							</div>


							<div class="col-md-2 btn-filtrar">

								<button type="submit" class="btn btn-primary">Filtrar</button>

							</div>

					</div>
				</form>
			</div>
		</div>


<!-- Events Container -->
		<div class="container">

<!-- Standard events row -->
				<!-- <div class="row eventsDeckRow mt-5">
					<? foreach($eventsTodayStandardArray as $eventsTodayStandard):?>
						<?if($eventsTodayStandard['id_type_event']=='3'){
							$dateTimeEvent = date_create($eventsTodayStandard['public_date_event']);
							$timeEvent = DATE_FORMAT($dateTimeEvent, "H:i");
							$dateEvent = DATE_FORMAT($dateTimeEvent, "d-m-Y");
						}else{
							$dateTimeEvent = date_create($eventsTodayStandard['date_event']);
							$timeEvent = DATE_FORMAT($dateTimeEvent, "H:i");
							$dateEvent = DATE_FORMAT($dateTimeEvent, "d-m-Y");
						}?>
						<div class="col-12 col-md-6">
						  <div class="card">
						    <a href="event.php?<?=$eventsTodayStandard['name_type_event']?>=<?=$eventsTodayStandard[0]?>"><img src="images/events/<?=$eventsTodayStandard['img']?>.jpg" class="card-img-top img-fluid" alt="..."></a>
						    <div class="card-body">
						      <div class="col col-sm-7">
								    <? if($eventsTodayStandard['public_name_event']==''): ?>
											<h5 class="card-title mb-0"><?=$eventsTodayStandard['name_event']?></h5>
										<? else: ?>
											<h5 class="card-title mb-0"><?=$eventsTodayStandard['public_name_event']?></h5>
										<? endif; ?>

										<? if($eventsTodayStandard['id_type_event']=='4'): ?>
											<p class="card-text mb-0">Streaming</p>
										<? else: ?>
								    	<p class="card-text mb-0"><?=$eventsTodayStandard['name_city']?></p>
										<? endif; ?>
									<p class="eventDate mb-0"><?=$dateEvent?> <?=$timeEvent?> hrs</p>

								</div>
						    </div>
						  </div>
						 </div>
					 <? endforeach; ?>

				</div> -->

				<!-- Basic events row -->

				<div class="row eventsDeckRow2">
					<? if($checkNoEvents==false): ?>
						<? foreach($eventsTodayBasicArray as $eventsTodayBasic):?>
							<?if($eventsTodayBasic['id_type_event']=='3'){
								$dateTimeEvent = date_create($eventsTodayBasic['public_date_event']);
				        $timeEvent = DATE_FORMAT($dateTimeEvent, "H:i");
								$dateEvent = DATE_FORMAT($dateTimeEvent, "d-m-Y");
							}else{
								$dateTimeEvent = date_create($eventsTodayBasic['date_event']);
				        $timeEvent = DATE_FORMAT($dateTimeEvent, "H:i");
								$dateEvent = DATE_FORMAT($dateTimeEvent, "d-m-Y");
							}?>
							<div class="col-md-4 col-6">

							  <div class="card">

							    <a href="event.php?<?=$eventsTodayBasic['name_type_event']?>=<?=$eventsTodayBasic[0]?>"><img src="images/events/<?=$eventsTodayBasic['img']?>.jpg?=<?=filemtime('images/events/'.$eventsTodayBasic['img'].'.jpg')?>" class="card-img-top" alt="evento <?=$eventsTodayBasic['name_event']?>"></a>

							    <div class="row card-body">
							    	<div class="col col-sm-7">
											<? if($eventsTodayBasic['public_name_event']==''): ?>
												<h5 class="card-title mb-0"><?=$eventsTodayBasic['name_event']?></h5>
											<? else: ?>
												<h5 class="card-title mb-0"><?=$eventsTodayBasic['public_name_event']?></h5>
											<? endif; ?>
											<? if($eventsTodayBasic['id_type_event']=='4'): ?>
												<p class="card-text mb-0">Streaming</p>
											<? endif; ?>
									    <p class="card-text mb-0"><?=$eventsTodayBasic['name_city']?></p>

											<p class="eventDate mb-0"><?=$dateEvent?> <?=$timeEvent?> hrs</p>

									</div>

							    </div>
							  </div>

							 </div>
						 <? endforeach; ?>
				 <? elseif($checkNoEvents==true): ?>
				 	<h2>No se encontraron eventos</h2>
				 <? endif; ?>

					</div>



				<!-- Pagination -->

				<? include 'resources/functionSearchPagination.php'; ?>



		</div>



	</main>







<!-- Scripts

			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>-->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

			<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
			<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

			<? include 'resources/login_error_script.php'; ?>


<!-- Footer -->

	<?php

		include 'resources/footer.php';

	 ?>
	<script>
		$(function () {
			$.datepicker.regional['es'] = {
				closeText: 'Cerrar',
				prevText: '<',
				nextText: '>',
				currentText: 'Hoy',
				monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
				dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
				weekHeader: 'Sm',
				dateFormat: 'dd-mm-yy',
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''
			};
			$.datepicker.setDefaults($.datepicker.regional['es']);
			$("#dateEventInput").datepicker({
				minDate: 0,

			});
		});
	</script>

	<? include 'resources/googleLoginScript.php'; ?>
	</body>

</html>
