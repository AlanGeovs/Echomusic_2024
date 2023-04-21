<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';
include 'resources/contract_script.php';

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

		<title>EchoMusic | Reservar <?=$arrayInfoSeller['nick_user']?></title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

		<link rel="stylesheet" href="assets/css/custom.css">
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

		<div id="profileMainBanner" class="jumbotron pb-0">

			<div class="backgroundImage">



      </div>



		</div>



		<!-- Container -->

		<div class="container">



			<!-- Artist Info -->

			<div class="row justify-content-center" id="reserveHeadInfo">

				<div class="col-md-2 text-rightcenter">
						<img src="images/avatars/<?=$arrayInfoSeller['id_user']?>.jpg" class="" id="reserveAvatar" alt="...">
				</div>
				<div class="col-md-10 text-leftcenter">
					<h2 class="mt-0 mb-0"><?=$arrayInfoSeller['nick_user']?></h2>
					<!-- <h5>Registrado desde $VARIABLE_MES de $VARIABLE_AÑO</h5> -->
				</div>
			</div>
			<div class="row">
				<div class="col-11 offset-1">

					<ul class="list-inline">

					  <li class="list-inline-item">Valoración <i class="fas fa-star text-orange"></i><?=displayTotalRating($rateArray)?></li>

					  <li class="list-inline-item"><i class="far fa-comment text-orange"></i> <?=count($rateArray)?> Reseñas</li>

					</ul>

				</div>

				<div class="col-11 offset-1">

					<ul class="list-inline">

					  <li class="list-inline-item"><i class="fas fa-music"></i> Género Musical <span class="font-weight-bold"><?=$genreSeller?></span></li>

					  <li class="list-inline-item"><i class="fas fa-map-marker-alt"></i> Región <?=$arrayInfoSeller['name_region']?> <span class="font-weight-bold"><?=$arrayInfoSeller['name_city']?></span></li>

					</ul>

				</div>

			</div>

			<hr>


		<? if(isset($errTyp) && $errTyp == "success"): ?>
				<!-- Reserve notification -->
				<div class="row mt-4" id="reserveConfirmNotice">
					<div class="text-center col-12 align-self-center">
							<h2>Reserva Agendada</h2>
							<p>Hemos enviado un mail notificando al artista</p>
							<i class="far fa-check-circle"></i>
							<h3 class="mt-4">Tu reserva ha sido agendada con éxito</h3>
					</div>
				</div>

			<!-- Reservation Info -->

				<div class="row" id="reserveDataValidation">
					<div class="col-md-3 text-leftcenter">

						<h2 class=""><?=$arrayInfoSeller['nick_user']?></h2>

						<p class="mb-1 font-weight-bold"><?=$genreSeller?></p>

						<p class="mb-1 font-weight-bold"><?=$arrayInfoSeller['name_city']?></p>
						<p class="mb-1 font-weight-bold">Región <?=$arrayInfoSeller['name_region']?></p>

					</div>
					<div class="col-md-3 d-block d-sm-none">
						<div class="vc_empty_space" style="height:25px;"><span class="vc_empty_space_inner"></span>
						</div>
					</div>
					<div class="col-md-3 text-leftcenter">

						<h2 class="">$<?=number_format($arrayPlan['value_plan']+$arrayPlan['commission_plan'] , 0, ',', '.')?></h2>

						<p class="mb-1 font-weight-bold">Plan <?=$arrayPlan['name_plan']?></p>

						<ul class="list-group list-group-flush">

						  <li class="list-group-item"><span class="font-weight-bold">Tiempo: </span><span><?=$planHours?>hr <?=$planMinutes?>min</span></li>

						  <li class="list-group-item"><span class="font-weight-bold">Backline: </span><span><?=$arrayPlan[15]?></span></li>

						  <li class="list-group-item"><span class="font-weight-bold">Refuerzo Sonoro: </span><span><?=$arrayPlan[19]?></span></li>

						  <li class="list-group-item"><span class="font-weight-bold">Sonidista: </span><span><?=$arrayPlan[17]?></span></li>

						  <li class="list-group-item"><span class="font-weight-bold">Nº de Músicos: </span><span><?=$arrayPlan['artists_amount']?></span></li>

						</ul>

					</div>
					<div class="col-md-4 d-block d-sm-none">
						<div class="vc_empty_space" style="height:25px;"><span class="vc_empty_space_inner"></span>
						</div>
					</div>
					<div class="col-md-4 text-leftcenter">

						<h4 class="" id="displayReserveDate"><?=$eventDate?></h4>

						<h4 class="" id="displayReserveTime"><?=$eventTime?> hrs</h4>

						<ul class="list-group list-group-flush">

						  <li class="list-group-item"><span class="font-weight-bold" id="displayNameEvent"><?=$eventName?></span></li>

						  <li class="list-group-item"><span class="font-weight-bold" id="displayReserveLocation"><?=$eventLocation?></span></li>

						  <li class="list-group-item"><span class="font-weight-bold" id="displayReservePhone">(+56) <?=$eventPhone?>)</span></li>

						</ul>

					</div>

				</div>

		<? else: ?>
			<!-- Plan select -->

			<div class="row justify-content-between" id="reserveChangePlan">

				<div class="col-6 text-left">

							<span class="font-weight-bold">Plan: </span>$<?=number_format($arrayPlan['value_plan'] , 0, ',', '.')?> <span class="font-weight-bold">Costo por servicio: </span> $<?=number_format($arrayPlan['commission_plan'] , 0, ',', '.')?> <span class="font-weight-bold">Total:</span> $<?=number_format($arrayPlan['value_plan']+$arrayPlan['commission_plan'] , 0, ',', '.')?> <br>

							<span>Plan <?=$arrayPlan['name_plan']?></span>

				</div>

				<div class="col-6 text-right" role="button" data-toggle="collapse" data-target="#collapsePlans" aria-expanded="false" aria-controls="collapseFilters">

						<span>Cambiar Plan</span>

						<i class="fas fa-caret-down"></i>

				</div>

			</div>

			<div class="row collapse mb-5" id="collapsePlans">



					<? foreach($planArray as $pricingArray): ?>
						<? if($pricingArray['active'] == "active"): ?>

							<div class="col-sm-12 col-md-6 col-lg-4 collapse show order-<?=$b?>" id="planSlot-<?=$b?>">

								<div class="card">

									<div class="card-body text-center">

											<p class="card-title plan-title"><?=$pricingArray['name_plan']?></p>

									<hr>

										<p class="card-text plan-price">$<?=number_format($pricingArray['value_plan'] , 0, ',', '.')?></p>

									<hr>

										<dl class="row">

											<dt class="col-7 text-left">Duración</dt>

											<dd class="col-5"><?=$pricingArray['duration_hours']?>hr <?=$pricingArray['duration_minutes']?>min</dd>


											<dt class="col-7 text-left">Backline</dt>

											<dd class="col-5"><?=$pricingArray[15]?></dd>


											<dt class="col-7 text-left">Refuerzo Sonoro</dt>

											<dd class="col-5"><?=$pricingArray[19]?></dd>


											<dt class="col-7 text-left">Sonidista</dt>

											<dd class="col-5"><?=$pricingArray[17]?></dd>


											<dt class="col-7 text-left">Nº de Músicos</dt>

											<dd class="col-5"><?=$pricingArray['artists_amount']?></dd>

										</dl>

									<hr>

										<p class="">

											<?=$pricingArray['desc_plan']?>

										</p>
										<? if(isset($_SESSION['user']) && $checkUser == false): ?>
											<form action="reserve_artist.php" method="post">
												<input type="hidden" name="planInfo" value="<?=$pricingArray['id_plan']?>" />
												<input type="hidden" name="idArtist" value="<?=$sellerId?>" />
												<button type="submit" name="submit_contract" class="btn btn-primary btn-block">Reservar</button>
											</form>
										<? endif; ?>
									</div>

								</div>

							</div>

						<? endif; ?>

					<? endforeach; ?>

			</div>



			<hr>



			<!-- Plan Detail Info -->

			<div class="row">

				<div class="col-md-12 col-sm-6">

					<ul class="list-inline">

					  <li class="list-inline-item list-Mobile"><span class="font-weight-bold">Tiempo: </span><span><?=$planHours?>hr <?=$planMinutes?>min</span></li>

					  <li class="list-inline-item list-Mobile"><span class="font-weight-bold">Backline: </span><span><?=$arrayPlan[15]?></span></li>

					  <li class="list-inline-item list-Mobile"><span class="font-weight-bold">Refuerzo Sonoro: </span><span><?=$arrayPlan[19]?></span></li>

					  <li class="list-inline-item list-Mobile"><span class="font-weight-bold">Sonidista: </span><span><?=$arrayPlan[17]?></span></li>

					  <li class="list-inline-item list-Mobile"><span class="font-weight-bold">Nº de Músicos: </span><span><?=$arrayPlan['artists_amount']?></span></li>

					</ul>

				</div>

			</div>



			<hr>



			<!-- Select Date -->



			<div class="row">

				<div class="col-md-12 mb-3">

					<span class="font-weight-bold">Fecha del Evento</span><br>

					<span class="">Selecciona la fecha y hora reservar</span>

				</div>

			</div>

			<div class="row">
				<div class="col-md-12 calendar-reserve">
 					<div id="datepicker"></div>
	 			</div>
	 		</div>




			<hr>



			<!-- Form reserve data -->



			<div class="row">

				<div class="col-12">

					<span class="font-weight-bold">Revisa e ingresa los datos del evento</span><br>

					<span class="">Ingresa tus datos de contacto e información del evento</span>

				</div>

			</div>

			<form action="" method="post" id="reserveForm">

				<div class="form-row mt-5">

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputEventMode">Nombre del Evento</label>

						<input type="text" name="eventName" id="inputReserveNameEvent" class="form-control form-custom-1" value="<?php if ( isset($eventName)) { echo $eventName;} ?>" placeholder="ej: Fiesta de Aniversario">

						<span class="text-danger"><strong class="alert"><?php if ( isset($eventNameError)) { echo $eventNameError;} ?></strong></span>

					</div>

					<div class="form-group col-lg-2">

						<label class="font-weight-bold" for="inputEventMode">Fecha</label>

						<input type="text" name="eventDate" class="form-control form-custom-1" id="inputReserveDate" >

						<span class="text-danger"><strong class="alert"><?php if ( isset($eventDateError)) { echo $eventDateError;} ?></strong></span>

					</div>

					<div class="form-group col-lg-2">

						<label class="font-weight-bold" for="inputEventMode">Hora</label>

						<select name="eventTime" class="form-control form-custom-1" id="inputReserveTime" >

							<option value="08:00">08:00 hrs</option>

							<option value="08:30">08:30 hrs</option>

							<option value="09:00">09:00 hrs</option>

							<option value="09:30">09:30 hrs</option>

							<option value="10:00">10:00 hrs</option>

							<option value="10:30">10:30 hrs</option>

							<option value="11:00">11:00 hrs</option>

							<option value="11:30">11:30 hrs</option>

							<option value="12:00">12:00 hrs</option>

							<option value="12:30">12:30 hrs</option>

							<option value="13:00">13:00 hrs</option>

							<option value="13:30">13:30 hrs</option>

							<option value="14:00">14:00 hrs</option>

							<option value="14:30">14:30 hrs</option>

							<option value="15:00">15:00 hrs</option>

							<option value="15:30">15:30 hrs</option>

							<option value="16:00">16:00 hrs</option>

							<option value="16:30">16:30 hrs</option>

							<option value="17:00">17:00 hrs</option>

							<option value="17:30">17:30 hrs</option>

							<option value="18:00">18:00 hrs</option>

							<option value="18:30">18:30 hrs</option>

							<option value="19:00">19:00 hrs</option>

							<option value="19:30">19:30 hrs</option>

							<option value="20:00">20:00 hrs</option>

							<option value="20:30">20:30 hrs</option>

							<option value="21:00">21:00 hrs</option>

							<option value="21:30">21:30 hrs</option>

							<option value="22:00">22:00 hrs</option>

							<option value="22:30">22:30 hrs</option>

							<option value="23:00">23:00 hrs</option>

							<option value="23:30">23:30 hrs</option>

							<option value="00:00">00:00 hrs</option>

							</select>

					</div>

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputEventPay">Teléfono</label>

						<input type="text" name="eventPhone" id="inputReservePhone" class="form-control form-custom-1" value="><?php if ( isset($eventPhone)) { echo '+56 9'.$eventPhone;} ?>" placeholder="(+56) 99 1234567">

						<span class="text-danger"><strong class="alert"><?php if ( isset($eventPhoneError)) { echo $eventPhoneError;} ?></strong></span>

					</div>

				</div>

				<div class="form-row mt-3">

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputEventRegion">Región</label>

						<select id="inputReserveRegion" readonly name="eventRegion" class="form-control form-custom-1">

							<option value="<?=$arrayInfoSeller['id_region']?>"><?=$arrayInfoSeller['name_region']?></option>

						</select>

						<span class="text-danger"><strong class="alert"><?php if ( isset($eventRegionError)) { echo $eventRegionError;} ?></strong></span>

					</div>

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputEventCity">Comuna</label>

						<select id="inputReserveCity" name="eventCity" class="form-control form-custom-1">

							<? foreach($arrayCities as $cities): ?>
								<? $selected = ($arrayInfoSeller['id_city'] == $cities['id_city']) ? "selected" : ""; ?>
									<option value="<?=$cities['id_city']?>" <?=$selected?>><?=$cities['name_city']?></option>
								<? unset($selected); ?>
							<? endforeach; ?>

						</select>

						<span class="text-danger"><strong class="alert"><?php if ( isset($eventCityError)) { echo $eventCityError;} ?></strong></span>

					</div>

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputEventOrganizer">Dirección</label>

						<input type="text" name="eventLocation" class="form-control form-custom-1" id="inputReserveLocation" value="<?php if ( isset($eventLocation)) { echo $eventLocation;} ?>" placeholder="Calle 1234">

						<span class="text-danger"><strong class="alert"><?php if ( isset($eventLocationError)) { echo $eventLocationError;} ?></strong></span>

					</div>

				</div>

				<div class="form-row mt-3">

					<div class="form-group col-12">

						<label class="font-weight-bold" for="inputEventDesc">Descripción del Evento</label>

						<textarea name="eventDesc" class="form-control form-custom-1" id="inputEventDesc" rows="6" placeholder="Mínimo 50 caracteres"><?php if ( isset($eventDesc)) { echo $eventDesc;} ?></textarea>

						<span class="text-danger"><strong class="alert"><?php if ( isset($eventDescError)) { echo $eventDescError;} ?></strong></span>

					</div>

				</div>

				<div class="form-row mt-3">

					<div class="form-check ml-2">

						<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">

						<label class="form-check-label" id="defaultCheck1Label" for="defaultCheck1">

							He leído los <a href="" data-toggle="modal" data-target="#conditionsModal">términos y condiciones</a>

						</label>

					</div>

				</div>


			<hr>



			<!-- Reserve validation data -->



			<div class="row" >

				<div class="col-md-12 mb-3">

					<span class="font-weight-bold">Comprueba que todos los datos de tu reserva sean correctos antes de proceder</span>

				</div>
			</div>
			<div class="row" id="reserveDataValidation">
				<div class="col-md-3 text-leftcenter">

					<h2 class=""><?=$arrayInfoSeller['nick_user']?></h2>

					<p class="mb-1 font-weight-bold"><?=$genreSeller?></p>

					<p class="mb-1 font-weight-bold"><?=$arrayInfoSeller['name_city']?></p>
					<p class="mb-1 font-weight-bold">Región <?=$arrayInfoSeller['name_region']?></p>

				</div>
				<div class="col-md-3 d-block d-sm-none">
					<div class="vc_empty_space" style="height:25px;"><span class="vc_empty_space_inner"></span>
					</div>
				</div>
				<div class="col-md-3 text-leftcenter">

					<h2 class="">$<?=number_format($arrayPlan['value_plan']+$arrayPlan['commission_plan'] , 0, ',', '.')?></h2>

					<p class="mb-1 font-weight-bold">Plan <?=$arrayPlan['name_plan']?></p>

					<ul class="list-group list-group-flush">

					  <li class="list-group-item"><span class="font-weight-bold">Tiempo: </span><span><?=$planHours?>hr <?=$planMinutes?>min</span></li>

					  <li class="list-group-item"><span class="font-weight-bold">Backline: </span><span><?=$arrayPlan[15]?></span></li>

					  <li class="list-group-item"><span class="font-weight-bold">Refuerzo Sonoro: </span><span><?=$arrayPlan[19]?></span></li>

					  <li class="list-group-item"><span class="font-weight-bold">Sonidista: </span><span><?=$arrayPlan[17]?></span></li>

					  <li class="list-group-item"><span class="font-weight-bold">Nº de Músicos: </span><span><?=$arrayPlan['artists_amount']?></span></li>

					</ul>

				</div>
				<div class="col-md-4 d-block d-sm-none">
					<div class="vc_empty_space" style="height:25px;"><span class="vc_empty_space_inner"></span>
					</div>
				</div>
				<div class="col-md-4 text-leftcenter">

					<h4 class="" id="displayReserveDate">Fecha</h4>

					<h4 class="" id="displayReserveTime">08:00 hrs</h4>

					<ul class="list-group list-group-flush">

					  <li class="list-group-item"><span class="font-weight-bold" id="displayNameEvent">Nombre Evento</span></li>

					  <li class="list-group-item"><span class="font-weight-bold" id="displayReserveLocation">Dirección</span></li>

					  <li class="list-group-item"><span class="font-weight-bold" id="displayReservePhone">Teléfono</span></li>

					</ul>

				</div>

			</div>






			<!-- Captcha -->
			<div class="row justify-content-center mt-5">

					<div class="g-recaptcha" data-sitekey="6Ld2EqUZAAAAAJsDvCnZgrYOlEjnWPvgkcgCjXhr">No soy un robot</div>

					<span class="text-danger"><strong class="alert"><?php if ( isset($reCaptchaError)) { echo $reCaptchaError;} ?></strong></span>

			</div>

			</div>
			<!-- Reserve Button -->
			<div class="row justify-content-center mt-5">

				<div class="text-center">

					<input id="reserveButton" type="submit" form="reserveForm" class="btn btn-primary btn-block btn-lg px-5" value="Reservar" name="submit_button">

				</div>

			</div>


		</form>

		<? endif; ?>


	</main>



<!-- Footer -->






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

			<script src="https://www.google.com/recaptcha/api.js" async defer></script>

			<script src="assets/js/jquery.mask.js"></script>

			<script src="assets/js/jquery.charactercounter.js"></script>


		<?php

			include 'resources/footer.php';

			include 'resources/conditionsModal.php';

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
				$("#datepicker").datepicker({
					minDate: 0,
				firstDay: 1,
				numberOfMonths: 3
				});

				var debounce;
				// Your window resize function
				$(window).resize(function() {
				// Clear the last timeout we set up.
				clearTimeout(debounce);
				// Your if statement
				if ($(window).width() < 768) {
				  // Assign the debounce to a small timeout to "wait" until resize is over
				  debounce = setTimeout(function() {
				    // Here we're calling with the number of months you want - 1
				    debounceDatepicker(1);
				  }, 250);
				// Presumably you want it to go BACK to 2 or 3 months if big enough
				// So set up an "else" condition
				} else {
				  debounce = setTimeout(function() {
				    // Here we're calling with the number of months you want - 3?
				    debounceDatepicker(3)
				  }, 250);
				}
				// To be sure it's the right size on load, chain a "trigger" to the
				// window resize to cause the above code to run onload
				}).trigger('resize');

				// our function we call to resize the datepicker
				function debounceDatepicker(no) {
					$("#datepicker").datepicker("option", "numberOfMonths", no);
				}

			});
		</script>

		<script>
			$("#datepicker").datepicker({
					onSelect: function(dateText) {
							$('#inputReserveDate').val(dateText);
							$('#displayReserveDate').text(dateText);
					}
			});
		</script>

		<script type="text/javascript">
			$(document).ready(function(){
				$('#inputReservePhone').mask('(+56) 90 0000000');
				$('.valuePlan').mask('000.000.000.000.000', {reverse: true});
			});
		</script>

		<script>
			$('#inputReserveNameEvent').keyup(function() {
				var val = this.value;
				$('#displayNameEvent').text(val);
			});

			$('#inputReserveLocation').keyup(function() {
				var val = this.value;
				$('#displayReserveLocation').text(val);
			});

			$('#inputReservePhone').keyup(function() {
				var val = this.value;
				$('#displayReservePhone').text(val);
			});

			$('#inputReserveTime').change(function() {
				var val = this.value;
				$('#displayReserveTime').text(val+'hrs');
			});
		</script>

		<? if(isset($errTyp) && $errTyp=="danger"):?>
			<script type='text/javascript'>alert('<?=$errMSG?>');</script>
		<? endif; ?>

		<script>
		  $(document).ready(function () {

				function validateTermsConditions() {
		      if ($('#defaultCheck1').prop('checked')) {
		          termsConditionsError = true;
		          return true;
		      }
		      else {
		        termsConditionsError = false;
						$('#defaultCheck1Label').addClass('font-weight-bold');
						alert("Debes aceptar los términos y condiciones");
		        return false;
		      }
		    }

				// Submitt button
			    $('#reserveButton').click(function () {
			      validateTermsConditions();
			      if ((termsConditionsError == true)) {
			        return true;
			      } else {
			        return false;
			      }
			    });
			});
		</script>

		<script>
			$("#inputEventDesc").characterCounter({
				limit: '1200',
				counterFormat: '%1 caracteres restantes'
			});
		</script>

		<? include 'resources/googleLoginScript.php'; ?>

	</body>

</html>
