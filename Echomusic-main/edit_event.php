<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/edit_event_script.php';
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

		<title>EchoMusic | Editar evento</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

		<link rel="stylesheet" href="assets/css/custom.css">
		<link rel="stylesheet"  href="assets/css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.datetimepicker.css"/>

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

<!-- Comienzo editar evento privado -->
<? switch(key($_GET)):case 'eventid':?>
			<!-- First Banner -->
			<div id=" " class="container pt-5">
			<form action="" method="post">
				<div class="row mt-2 pt-3" id="eventDetailInfo">

					<div id="info-nameartista" class="col-md-6 order-2 order-md-1 ">

							<h2 class="my-4 mb-0  font-weight-bold" ><?=$arrayDataEvent['name_event']?></h2>

					</div>
					<div id="info-nameartista-edit" class="col-md-6 order-1 order-md-2" style="display: none;">
							<input type="text" name="nameEvent" value="<?=(isset($arrayDataEvent)) ? $arrayDataEvent['name_event'] : ''?>" class="form-control form-custom-1 mb-2">

					</div>
					<div class="col-md-6 text-rightcenter order-0 order-md-2 my-2">

							<a  role="button" id="editbtnEvent" class="btn btn-primary"><i class="fas fa-edit"></i> Editar Evento</a>
							<a role="button"  id="saveCoverEvent"  class="btn btn-primary" style="display: none;"><i class="fas fa-edit"></i> Dejar de editar</a>

					</div>
				</div>


			<!-- Container -->


				<!-- Event Main Info -->

				<div class="row mt-4" id="eventDetailInfo">

					<div id="info-artista" class="col-md-6">

							<h2 class="mt-0 mb-0"><?=$arrayDataEvent['nick_user']?></h2>
							<h3 class="mt-0 mb-0"><?=getDayday($dataEventTime)?> de <?=getMonthYear($dataEventTime)?></h3>
							<h3 class="mt-0 mb-0"><?=$arrayDataEvent['location']?></h3>

					</div>
					<div id="infoedit-artista" class="col-md-6" style="display: none;">
							<input type="text" name="" value="<?=$arrayDataEvent['nick_user']?>" readonly class="form-control form-custom-1 mb-2 isDisabled">

							<? if(isset($nameEventError)): ?><span class="text-danger"><strong class="alert"><?=$nameEventError?></strong></span><? endif; ?>
							<div class="col-md-12 m-0 p-0">
									<input type="text" id="fechaticket" name="dateEvent" class="form-control form-custom-1 hasDatepicker " placeholder="   Día del evento" value="<?=(isset($arrayDataEvent)) ? $datePrivateEvent : '' ?>">
									<i class="fas fa-calendar-alt calendarIcon col-1" ></i>
							</div>
							<? if(isset($dateEventError)): ?><span class="text-danger"><strong class="alert"><?=$dateEventError?></strong></span><? endif; ?>
							<input type="text" name="locationEvent" value="<?=(isset($arrayDataEvent)) ? $arrayDataEvent['location'] : '' ?>" class="form-control form-custom-1 mb-2">
							<? if(isset($locationEventError)): ?><span class="text-danger"><strong class="alert"><?=$locationEventError?></strong></span><? endif; ?>
					</div>
				</div>



				<!-- Event desc -->

					<div class="row mt-4" id="eventDetailDesc">

						<div class="col-md-12">
							<h3 class=" mb-0 font-weight-bold">Descripción</h3>
							<p rows="10" style="width: 100%; "> <?=nl2br($arrayDataEvent['desc_event'])?></p>
						</div>

					</div>
					<div class="row mt-4" id="eventDetailDesc-text" style="display: none;">

						<div class="col-md-12">
							<h3 class=" mb-0 font-weight-bold">Descripción</h3>
							<textarea name="eventDesc" rows="10" style="width: 100%; " class="form-control form-custom-2 mb-2"><?=(isset($arrayDataEvent)) ? $arrayDataEvent['desc_event'] : '' ?></textarea>
							<? if(isset($eventDescError)): ?><span class="text-danger"><strong class="alert"><?=$eventDescError?></strong></span><? endif; ?>
						</div>

					</div>


					<div class="row mt-5" id="eventDetailDesc-caracter">
						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Región</h3>
							<h3 class="mt-0 "><?=$arrayDataEvent['name_region']?></h3>
						</div>
						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Comuna</h3>
							<h3 class="mt-0 "><?=$arrayDataEvent['name_city']?></h3>
						</div>
						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Hora del Evento</h3>
							<h3 class="mt-0 "><?=$timeEvent?> Hrs</h3>
						</div>
					</div>
					<!-- Inputs -->
					<div class="row mt-5" id="eventDetailDesc-input" style="display: none;">

						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Región</h3>
							<select id="inputRegion" name="regionEvent" class="form-control form-custom-1" disabled>
							    <? foreach($arrayRegions as $regions): ?>
												<?=$selected = ($arrayDataEvent['id_region'] == $regions['id_region']) ? "selected" : "" ?>
												<option value="<?=$regions['id_region']?>" <?=$selected?>><?=$regions['name_region']?></option>
												<? unset($selected); ?>
									<? endforeach;	?>
				  		</select>
						</div>

						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Comuna</h3>
							<select id="inputCity" name="cityEvent" class="form-control form-custom-1">
							    <? foreach($arrayCities as $cities): ?>
												<?=$selected = ($arrayDataEvent['id_city'] == $cities['id_city']) ? "selected" : "" ?>
												<option value="<?=$cities['id_city']?>" <?=$selected?>><?=$cities['name_city']?></option>
												<? unset($selected); ?>
									<? endforeach;	?>
				  		</select>
						</div>

						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Hora del Evento</h3>
							<select id="inputEventTime" name="timeEvent" class="form-control form-custom-1">
							    <option <?=$selected = ($timeEvent=='08:00') ? 'selected' : '' ?> value="08:00">08:00 hrs</option>

									<option <?=$selected = ($timeEvent=='08:30') ? 'selected' : '' ?> value="08:30">08:30 hrs</option>

									<option <?=$selected = ($timeEvent=='09:00') ? 'selected' : '' ?> value="09:00">09:00 hrs</option>

									<option <?=$selected = ($timeEvent=='09:30') ? 'selected' : '' ?> value="09:30">09:30 hrs</option>

									<option <?=$selected = ($timeEvent=='10:00') ? 'selected' : '' ?> value="10:00">10:00 hrs</option>

									<option <?=$selected = ($timeEvent=='10:30') ? 'selected' : '' ?> value="10:30">10:30 hrs</option>

									<option <?=$selected = ($timeEvent=='11:00') ? 'selected' : '' ?> value="11:00">11:00 hrs</option>

									<option <?=$selected = ($timeEvent=='11:30') ? 'selected' : '' ?> value="11:30">11:30 hrs</option>

									<option <?=$selected = ($timeEvent=='12:00') ? 'selected' : '' ?> value="12:00">12:00 hrs</option>

									<option <?=$selected = ($timeEvent=='12:30') ? 'selected' : '' ?> value="12:30">12:30 hrs</option>

									<option <?=$selected = ($timeEvent=='13:00') ? 'selected' : '' ?> value="13:00">13:00 hrs</option>

									<option <?=$selected = ($timeEvent=='13:30') ? 'selected' : '' ?> value="13:30">13:30 hrs</option>

									<option <?=$selected = ($timeEvent=='14:00') ? 'selected' : '' ?> value="14:00">14:00 hrs</option>

									<option <?=$selected = ($timeEvent=='14:30') ? 'selected' : '' ?> value="14:30">14:30 hrs</option>

									<option <?=$selected = ($timeEvent=='15:00') ? 'selected' : '' ?> value="15:00">15:00 hrs</option>

									<option <?=$selected = ($timeEvent=='15:30') ? 'selected' : '' ?> value="15:30">15:30 hrs</option>

									<option <?=$selected = ($timeEvent=='16:00') ? 'selected' : '' ?> value="16:00">16:00 hrs</option>

									<option <?=$selected = ($timeEvent=='16:30') ? 'selected' : '' ?> value="16:30">16:30 hrs</option>

									<option <?=$selected = ($timeEvent=='17:00') ? 'selected' : '' ?> value="17:00">17:00 hrs</option>

									<option <?=$selected = ($timeEvent=='17:30') ? 'selected' : '' ?> value="17:30">17:30 hrs</option>

									<option <?=$selected = ($timeEvent=='18:00') ? 'selected' : '' ?> value="18:00">18:00 hrs</option>

									<option <?=$selected = ($timeEvent=='18:30') ? 'selected' : '' ?> value="18:30">18:30 hrs</option>

									<option <?=$selected = ($timeEvent=='19:00') ? 'selected' : '' ?> value="19:00">19:00 hrs</option>

									<option <?=$selected = ($timeEvent=='19:30') ? 'selected' : '' ?> value="19:30">19:30 hrs</option>

									<option <?=$selected = ($timeEvent=='20:00') ? 'selected' : '' ?> value="20:00">20:00 hrs</option>

									<option <?=$selected = ($timeEvent=='20:30') ? 'selected' : '' ?> value="20:30">20:30 hrs</option>

									<option <?=$selected = ($timeEvent=='21:00') ? 'selected' : '' ?> value="21:00">21:00 hrs</option>

									<option <?=$selected = ($timeEvent=='21:30') ? 'selected' : '' ?> value="21:30">21:30 hrs</option>

									<option <?=$selected = ($timeEvent=='22:00') ? 'selected' : '' ?> value="22:00">22:00 hrs</option>

									<option <?=$selected = ($timeEvent=='22:30') ? 'selected' : '' ?> value="22:30">22:30 hrs</option>

									<option <?=$selected = ($timeEvent=='23:00') ? 'selected' : '' ?> value="23:00">23:00 hrs</option>

									<option <?=$selected = ($timeEvent=='23:30') ? 'selected' : '' ?> value="23:30">23:30 hrs</option>

									<option <?=$selected = ($timeEvent=='00:00') ? 'selected' : '' ?>value="00:00">00:00 hrs</option>
					  		</select>
						</div>
						<div class="col-md-12 text-leftcenter">
							<input type="submit" name="saveEvent" class="btn btn-primary" value="Guardar Cambios" />
						</div>

					</div>

					<div class="row mt-3">
						<div class="col-md-12 text-leftcenter">
							<a href="dashboard.php" class="btn btn-outline-secondary">Volver </a>
						</div>
					</div>


			</form>

			</div>
	<? break; ?>
	<? case 'publicid': ?>
	<!-- Comienzo edición evento público -->
			<div id="" class="container pt-5">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="row mt-4 pt-3" id="">

					<div id="info-nameartista" class="col-md-6 order-2 order-md-1">

							<h2 class="my-4 mb-0  font-weight-bold"><?=$arrayDataEvent['name_event']?></h2>

					</div>

					<div id="info-nameartista-edit" class="col-md-6 order-2 order-md-1" style="display: none;">
							<h3 class=" mb-0 font-weight-bold">Nombre Evento</h3>
							<input type="text" name="publicNameEvent" value="<?=(isset($arrayDataEvent)) ? $arrayDataEvent['name_event'] : ''?>" class="form-control form-custom-1 mb-2">

					</div>
					<div class="col-md-6 text-rightcenter order-1 order-md-2 my-2">

							<a  role="button" id="editbtnEvent" class="btn btn-primary"><i class="fas fa-edit"></i> Editar Evento</a>
							<a role="button"  id="saveCoverEvent"  class="btn btn-primary" style="display: none;"><i class="fas fa-edit"></i> Dejar de editar</a>

					</div>
				</div>



			<!-- Container -->


				<!-- Event Main Info -->

				<div class="row mt-1" id="">

					<div id="info-artista" class="col-md-6">

							<h2 class="mt-0 mb-0"><?=$arrayDataEvent['name_location']?></h2>
							<h3 class="mt-0 mb-0"><?=$arrayDataEvent['organizer']?></h2>
							<h3 class="mt-0 mb-0"><?=getDayday($dataEventTime)?> de <?=getMonthYear($dataEventTime)?></h3>
							<h3 class="mt-0 mb-0"><?=$arrayDataEvent['location']?></h3>

					</div>
					<div id="infoedit-artista" class="col-md-6" style="display: none;">
							<h3 class="mt-2 mb-0 font-weight-bold">Organizador</h3>
							<input type="text" name="publicOrganizerEvent" value="<?=$arrayDataEvent['organizer']?>" class="form-control form-custom-1 mb-2">
							<? if(isset($publicOrganizerEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicOrganizerEventError?></strong></span><? endif; ?>
							<h3 class="mt-2 mb-0 font-weight-bold">Nombre de lugar</h3>
							<input type="text" name="publicNameLocation" value="<?=$arrayDataEvent['name_location']?>" class="form-control form-custom-1 mb-2">
							<? if(isset($publicNameLocationEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicNameLocationEventError?></strong></span><? endif; ?>
							<div class="col-md-12 m-0 p-0">
								<h3 class="mt-1 mb-0 font-weight-bold">Fecha</h3>
									<div class="row m-0">
										<input type="text" id="fechaticket" name="publicDateEvent" class="form-control form-custom-1 hasDatepicker" placeholder="Día del evento" value="<?=(isset($arrayDataEvent)) ? $datePublicEvent : '' ?>">
											<i class="fas fa-calendar-alt calendarIcon col-1" ></i>
										</input>
									</div>
							</div>
							<? if(isset($publicDateEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicDateEventError?></strong></span><? endif; ?>
							<h3 class="mt-1 mb-0 font-weight-bold">Direccion</h3>
							<input type="text" name="publicLocationEvent" value="<?=(isset($arrayDataEvent)) ? $arrayDataEvent['location'] : '' ?>" class="form-control form-custom-1 mb-2">
							<? if(isset($publicLocationEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicLocationEventError?></strong></span><? endif; ?>
					</div>
				</div>
				<div class="row mt-2" id="eventDetailDesc-input" style="display: none;">

						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Región</h3>
							<select id="inputRegion" name="publicRegionEvent" class="form-control form-custom-1" onChange="changeCities()">
							    <? foreach($arrayRegions as $regions): ?>
												<?=$selected = ($arrayDataEvent['id_region'] == $regions['id_region']) ? "selected" : "" ?>
												<option value="<?=$regions['id_region']?>" <?=$selected?>><?=$regions['name_region']?></option>
												<? unset($selected); ?>
									<? endforeach;	?>
				  			</select>
						</div>

						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Comuna</h3>
							<select id="inputCity" name="publicCityEvent" class="form-control form-custom-1">
							    <? foreach($arrayCities as $cities): ?>
												<?=$selected = ($arrayDataEvent['id_city'] == $cities['id_city']) ? "selected" : "" ?>
												<option value="<?=$cities['id_city']?>" <?=$selected?>><?=$cities['name_city']?></option>
												<? unset($selected); ?>
									<? endforeach;	?>
				  			</select>
						</div>

						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Hora del Evento</h3>
							<select id="inputEventTime" name="publicTimeEvent" class="form-control form-custom-1">
							    <option <?=$selected = ($timeEvent=='08:00') ? 'selected' : '' ?> value="08:00">08:00 hrs</option>

									<option <?=$selected = ($timeEvent=='08:30') ? 'selected' : '' ?> value="08:30">08:30 hrs</option>

									<option <?=$selected = ($timeEvent=='09:00') ? 'selected' : '' ?> value="09:00">09:00 hrs</option>

									<option <?=$selected = ($timeEvent=='09:30') ? 'selected' : '' ?> value="09:30">09:30 hrs</option>

									<option <?=$selected = ($timeEvent=='10:00') ? 'selected' : '' ?> value="10:00">10:00 hrs</option>

									<option <?=$selected = ($timeEvent=='10:30') ? 'selected' : '' ?> value="10:30">10:30 hrs</option>

									<option <?=$selected = ($timeEvent=='11:00') ? 'selected' : '' ?> value="11:00">11:00 hrs</option>

									<option <?=$selected = ($timeEvent=='11:30') ? 'selected' : '' ?> value="11:30">11:30 hrs</option>

									<option <?=$selected = ($timeEvent=='12:00') ? 'selected' : '' ?> value="12:00">12:00 hrs</option>

									<option <?=$selected = ($timeEvent=='12:30') ? 'selected' : '' ?> value="12:30">12:30 hrs</option>

									<option <?=$selected = ($timeEvent=='13:00') ? 'selected' : '' ?> value="13:00">13:00 hrs</option>

									<option <?=$selected = ($timeEvent=='13:30') ? 'selected' : '' ?> value="13:30">13:30 hrs</option>

									<option <?=$selected = ($timeEvent=='14:00') ? 'selected' : '' ?> value="14:00">14:00 hrs</option>

									<option <?=$selected = ($timeEvent=='14:30') ? 'selected' : '' ?> value="14:30">14:30 hrs</option>

									<option <?=$selected = ($timeEvent=='15:00') ? 'selected' : '' ?> value="15:00">15:00 hrs</option>

									<option <?=$selected = ($timeEvent=='15:30') ? 'selected' : '' ?> value="15:30">15:30 hrs</option>

									<option <?=$selected = ($timeEvent=='16:00') ? 'selected' : '' ?> value="16:00">16:00 hrs</option>

									<option <?=$selected = ($timeEvent=='16:30') ? 'selected' : '' ?> value="16:30">16:30 hrs</option>

									<option <?=$selected = ($timeEvent=='17:00') ? 'selected' : '' ?> value="17:00">17:00 hrs</option>

									<option <?=$selected = ($timeEvent=='17:30') ? 'selected' : '' ?> value="17:30">17:30 hrs</option>

									<option <?=$selected = ($timeEvent=='18:00') ? 'selected' : '' ?> value="18:00">18:00 hrs</option>

									<option <?=$selected = ($timeEvent=='18:30') ? 'selected' : '' ?> value="18:30">18:30 hrs</option>

									<option <?=$selected = ($timeEvent=='19:00') ? 'selected' : '' ?> value="19:00">19:00 hrs</option>

									<option <?=$selected = ($timeEvent=='19:30') ? 'selected' : '' ?> value="19:30">19:30 hrs</option>

									<option <?=$selected = ($timeEvent=='20:00') ? 'selected' : '' ?> value="20:00">20:00 hrs</option>

									<option <?=$selected = ($timeEvent=='20:30') ? 'selected' : '' ?> value="20:30">20:30 hrs</option>

									<option <?=$selected = ($timeEvent=='21:00') ? 'selected' : '' ?> value="21:00">21:00 hrs</option>

									<option <?=$selected = ($timeEvent=='21:30') ? 'selected' : '' ?> value="21:30">21:30 hrs</option>

									<option <?=$selected = ($timeEvent=='22:00') ? 'selected' : '' ?> value="22:00">22:00 hrs</option>

									<option <?=$selected = ($timeEvent=='22:30') ? 'selected' : '' ?> value="22:30">22:30 hrs</option>

									<option <?=$selected = ($timeEvent=='23:00') ? 'selected' : '' ?> value="23:00">23:00 hrs</option>

									<option <?=$selected = ($timeEvent=='23:30') ? 'selected' : '' ?> value="23:30">23:30 hrs</option>

									<option <?=$selected = ($timeEvent=='00:00') ? 'selected' : '' ?>value="00:00">00:00 hrs</option>
					  		</select>
						</div>

					</div>


					<div class="row mt-5" id="eventDetailDesc-caracter">
						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Región</h3>
							<h3 class="mt-0 "><?=$arrayDataEvent['name_region']?></h3>
						</div>
						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Comuna</h3>
							<h3 class="mt-0 "><?=$arrayDataEvent['name_city']?></h3>
						</div>
						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Hora del Evento</h3>
							<h3 class="mt-0 "><?=$timeEvent?> Hrs</h3>
						</div>
					</div>
				<!-- Event desc -->

					<div class="row my-4" id="eventDetailDesc">

						<div class="col-md-12">
							<h3 class=" mb-0 font-weight-bold">Descripción</h3>
							<p rows="10" style="width: 100%; "> <?=nl2br($arrayDataEvent['desc_event'])?></p>
						</div>

					</div>
					<div class="row mt-4" id="eventDetailDesc-text" style="display: none;">

						<div class="col-md-12">
							<h3 class=" mb-0 font-weight-bold">Descripción</h3>
							<textarea name="eventDesc" rows="10" style="width: 100%; " class="form-control form-custom-2 mb-2"><?=(isset($arrayDataEvent)) ? $arrayDataEvent['desc_event'] : '' ?></textarea>
							<? if(isset($eventDescError)): ?><span class="text-danger"><strong class="alert"><?=$eventDescError?></strong></span><? endif; ?>
						</div>

					</div>



					<hr class="eventDetailDesc-values">
					<h2 class="mt-0 mb-0 font-weight-bold eventDetailDesc-values">Entradas</h3>
					<div  id="eventDetailDesc-caracter2" class="mt-3" >
						<? foreach($ticketsDataArray as $ticketsData): ?>
						<?
							$ticketStartDate =	$ticketsData['ticket_dateStart'];
							$ticketStartDate = date_create($ticketStartDate);
	            $ticketStartDate = DATE_FORMAT($ticketStartDate, 'd-m-Y H:i');

							$ticketEndDate =	$ticketsData['ticket_dateEnd'];
							$ticketEndDate = date_create($ticketEndDate);
	            $ticketEndDate = DATE_FORMAT($ticketEndDate, 'd-m-Y H:i');
						?>
							<div class="row">
								<div class="col-md-3">
									<h3 class="mt-0 mb-0 font-weight-bold">Nombre</h3>
									<h3 class="mt-0 "><?=$ticketsData['ticket_name']?></h3>
								</div>
								<div class="col-md-2">
									<h3 class="mt-0 mb-0 font-weight-bold">Aforo</h3>
									<h3 class="mt-0 "><?=$ticketsData['ticket_audience']?></h3>
								</div>
								<div class="col-md-2">
									<h3 class="mt-0 mb-0 font-weight-bold">Valor Entrada</h3>
									<h3 class="mt-0 ">$<?=number_format($ticketsData['ticket_value'] , 0, ',', '.')?></h3>
								</div>
								<div class="col-md-2">
									<h3 class="mt-0 mb-0 font-weight-bold">Inicio Venta</h3>
									<h3 class="mt-0 "><?=$ticketStartDate?></h3>
								</div>
								<div class="col-md-2">
									<h3 class="mt-0 mb-0 font-weight-bold">Término Venta</h3>
									<h3 class="mt-0 "><?=$ticketEndDate?></h3>
								</div>
							</div>

						<? endforeach; ?>
					</div>

					<hr class="eventDetailDesc-values">
					<!-- Inputs -->

					<div id="eventDetailDesc-input2" class="form-group col-md-12" style="display:none;">
				      	 <table id="crearEventoPresencialTabla" >
				      	 	<? foreach($ticketsDataArray as $ticketsData): ?>
									<?
									$ticketStartDate =	$ticketsData['ticket_dateStart'];
									$ticketStartDate = date_create($ticketStartDate);
			            $ticketStartDate = DATE_FORMAT($ticketStartDate, 'd-m-Y H:i');

									$ticketEndDate =	$ticketsData['ticket_dateEnd'];
									$ticketEndDate = date_create($ticketEndDate);
			            $ticketEndDate = DATE_FORMAT($ticketEndDate, 'd-m-Y H:i');

								// Check audience
									$publicTicketId = $ticketsData['id_ticket'];
			            $queryAudience = mysqli_query($conn, "SELECT COUNT(*) FROM subscribes_public WHERE id_ticket='$publicTicketId' AND subscribe_status='1'");
			            $countAudience = mysqli_fetch_assoc($queryAudience)['COUNT(*)'];
									unset($publicTicketId);

									?>
						    <tr>
						        <td>
						        	<label class="font-weight-bold" for="inputTicketName_01">Nombre Entrada</label>
									<? if($arrayDataEvent['payment_event'] == '1'): ?>
										<input name="publicNameTicket[]" value="<?=$ticketsData['ticket_name']?>" type="text" class="form-control form-custom-1 isDisabled" readonly id="ticketName_01" aria-describedby="valueHelpBlock" placeholder="Ej: General">
									<? else: ?>
										<input name="publicNameTicket[]" value="<?=$ticketsData['ticket_name']?>" type="text" class="form-control form-custom-1" id="ticketName_01" aria-describedby="valueHelpBlock" placeholder="Ej: General">
									<? endif; ?>
									<? if(isset($ticketName_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketName_01Error?></strong></span><? endif; ?>
						        </td>
						        <td>
						        	<label class="font-weight-bold" for="inputTicketValue_01">Valor Entrada</label>
				        	<? if($arrayDataEvent['active_event'] == '1'): ?>
										<input name="publicValueTicket[]" value="<?=$ticketsData['ticket_value']?>" type="text" class="form-control form-custom-1 isDisabled" readonly >
									<? elseif($arrayDataEvent['payment_event'] == '1'): ?>
										<input name="publicValueTicket[]" value="<?=$ticketsData['ticket_value']?>" type="text" class="form-control form-custom-1 isDisabled" readonly >
									<? else: ?>
										<input name="publicValueTicket[]" value="<?=$ticketsData['ticket_value']?>"type="text" class="form-control form-custom-1">
									<? endif; ?>

									<? if(isset($ticketValue_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketValue_01Error?></strong></span><? endif; ?>
						        </td>
						        <td width="10%">
						            <label class="font-weight-bold" for="inputTicketAudience_01">Cantidad</label>
									<input name="publicAudienceTicket[]"  value="<?=$ticketsData['ticket_audience']?>"  type="text" class="form-control form-custom-1 col-12" id="ticketAudience_01" aria-describedby="valueHelpBlock" placeholder="">
									<? if(isset($ticketAudience_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketAudience_01Error?></strong></span><? endif; ?>
						        </td>
						        <td style="position: relative;">
									<label class="font-weight-bold" for="inputTicketStart_01">Inicio venta</label>
									<div class="row m-0">

										<input name="publicTicketStart[]"  value="<?=$ticketStartDate?>" type="text" id="ticketStart" class="ticketStart form-control form-custom-1 col-12 hasDatepicker datetimepicker-input" placeholder="Fecha" >
										<i class="fas fa-calendar-alt calendarIcon col-1"></i>
									</div>
									<? if(isset($ticketStart_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketStart_01Error?></strong></span><? endif; ?>

						        </td>

						        <td style="position: relative;">

									<label class="font-weight-bold" for="inputTicketEnd_01">Término venta</label>
									<div class="row m-0">

										<input name="publicTicketEnd[]" value="<?=$ticketEndDate?>" type="text" id="ticketEnd" class="ticketEnd form-control form-custom-1 col-12 hasDatepicker datetimepicker-input" placeholder="Fecha">
										<i class="fas fa-calendar-alt calendarIcon col-1"></i>

										<input type="hidden" name="publicTicketId[]" value="<?=$ticketsData['id_ticket']?>">

									</div>
									<? if(isset($ticketEnd_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketEnd_01Error?></strong></span><? endif; ?>

						        </td>
											<? if($arrayDataEvent['payment_event']!='1' && $countAudience == 0): ?>
								        <td width="1%">
								        	<label class="font-weight-bold" for="inputTicketEnd" style="color:white;">.</label>
								        	<a class="icon form-control form-custom-1" style="cursor:pointer;"> <i class="fas fa-trash-alt"></i></a>

								        </td>
											<? endif; ?>
						    </tr>
						    <? endforeach; ?>
							<? if(isset($publicValueEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicValueEventError?></strong></span><? endif; ?>
						</table>

<div id="InputDeletes">
</div>

							<? if($arrayDataEvent['payment_event'] != '1'): ?>
					    		<a id="crearEventoPresencialTablaButton" class="icon" style="cursor:pointer;"> <i class="fas fa-plus-circle h5"></i>  agregar más entradas. </a>
							<? endif; ?>
							</div>

					<h2 class="mt-0 mb-3 font-weight-bold eventDetailDesc-values">Visualización multimedia</h2>
					<div id="eventDetailDesc-input3" class="row mt-5" style="display: none;">
						<div class="col-md-4">
				      		<label class="font-weight-bold" for="inputEventFile">Imagen Promocional del Evento</label>
				      		<label class="btn btn-primary" for="my-file-selector">
							    <input name="file-input" id="my-file-selector" type="file" style="display:none"
							    onchange="$('#upload-file-info').html(this.files[0].name)">
							    Seleccionar Archivo
							</label>
							<span class='label label-info' id="upload-file-info"></span>
							<? if(isset($publicImageEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicImageEventError?></strong></span><? endif; ?>
				   		</div>
					</div>
					<div class="row my-2">

						<!-- Image preview -->
						<div class="col-md-6 col-12">

							<h4 class="mt-0 mb-3 font-weight-bold eventDetailDesc-values">Imagen:</h4>
							<img id="imagenEvento" class="d-none d-sm-block" src="../../images/events/<?=$arrayDataEvent['img']?>.jpg" style="min-height: 400px; width:100%; max-width:400px;"/>
						</div>
					</div>

					<div class="row mt-4" id="eventDetailVideo-input" style="display: none;">
						<div class="form-group col-md-8">
				      		<label class="font-weight-bold" for="inputEventVideo">Video Promocional del Evento (Opcional)</label><br>
								<div class="row">
									<div class="col-md-8">
										<? if(isset($postDetail)): ?>
											<? switch($postDetail['service_multi']):case "youtube":?>
												<input name="eventVideo" type="text" class="form-control form-custom-1" id="inputEventVideo" value="https://www.youtube.com/watch?v=<?=$postDetail['embed_multi']?>">
											<? break; ?>
											<? case "vimeo": ?>
												<input name="eventVideo" type="text" class="form-control form-custom-1" id="inputEventVideo" value="https://vimeo.com/<?=$postDetail['embed_multi']?>">
											<? break; ?>
											<? endswitch; ?>
										<? else: ?>
											<input name="eventVideo" type="text" class="form-control form-custom-1" id="inputEventVideo" value="" placeholder="https://www.youtube.com/watch?v=123456789">
										<? endif; ?>
									</div>
								</div>
						</div>
					</div>

					<!-- Video preview -->

					<? if(isset($postDetail)): ?>
						<? switch($postDetail['service_multi']):case "youtube":?>
							<h4 class="mt-0 mb-3 font-weight-bold eventDetailDesc-values">Video:</h4>

							<iframe style="width: 100%;height: 50vh;" src="https://www.youtube.com/embed/<?=$postDetail['embed_multi']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<? break; ?>
						<? case "vimeo": ?>
							<h4 class="mt-0 mb-3 font-weight-bold eventDetailDesc-values">Video:</h4>

							<iframe style="width: 100%;height: 50vh;" src="https://player.vimeo.com/video/<?=$postDetail['embed_multi']?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
						<? break; ?>
						<? endswitch; ?>
					<? endif; ?>

					<div class="col-md-12 text-leftcenter">
						</div>
					<div class="row mt-3">
						<div class="col-md-12 text-leftcenter">
							<input type="submit" name="savePublicEvent" class="btn btn-primary" value="Guardar Cambios" />
							<a href="dashboard.php" class="btn btn-outline-secondary">Volver </a>
						</div>
					</div>


			</form>

			</div>
	<? break; ?>
	<? case 'streamingid': ?>
	<!-- Comienzo edición evento streaming -->
			<div id=" " class="container pt-5">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="row mt-2 pt-3" id="eventDetailInfo">

					<div id="info-nameartista" class="col-md-6 order-2 order-md-1">

							<h2 class="my-4 mb-0  font-weight-bold"><?=$arrayDataEvent['name_event']?></h2>

					</div>
					<div id="info-nameartista-edit" class="col-md-6" style="display: none;">
							<input type="text" name="nameEvent" value="<?=(isset($arrayDataEvent)) ? $arrayDataEvent['name_event'] : ''?>" class="form-control form-custom-1 mb-2">

					</div>
					<div class="col-md-6 text-rightcenter order-1 order-md-2">

							<a  role="button" id="editbtnEvent" class="btn btn-primary"><i class="fas fa-edit"></i> Editar Evento</a>
							<a role="button"  id="saveCoverEvent"  class="btn btn-primary" style="display: none;"><i class="fas fa-edit"></i> Dejar de editar</a>

					</div>
				</div>


			<!-- Container -->


				<!-- Event Main Info -->

				<div class="row mt-4" id="eventDetailInfo">

					<div id="info-artista" class="col-md-6">

							<h2 class="mt-0 mb-0"><?=$arrayDataEvent['nick_user']?></h2>
							<h3 class="mt-0 mb-0"><?=getDayday($dataEventTime)?> de <?=getMonthYear($dataEventTime)?></h3>

					</div>
					<div id="infoedit-artista" class="col-md-6" style="display: none;">
							<input type="text" name="" value="<?=$arrayDataEvent['nick_user']?>" readonly class="form-control form-custom-1 mb-2 isDisabled">

							<? if(isset($nameEventError)): ?><span class="text-danger"><strong class="alert"><?=$nameEventError?></strong></span><? endif; ?>
							<div class="col-md-12 m-0 p-0">
									<input type="text" id="fechaticket" name="dateEvent" class="form-control form-custom-1" placeholder="   Día del evento" value="<?=(isset($arrayDataEvent)) ? $dateStreamingEvent : '' ?>">
									<i class="fas fa-calendar-alt calendarIcon col-1" ></i>
							</div>
							<? if(isset($dateEventError)): ?><span class="text-danger"><strong class="alert"><?=$dateEventError?></strong></span><? endif; ?>

					</div>
				</div>



				<!-- Event desc -->

					<div class="row mt-4" id="eventDetailDesc">

						<div class="col-md-12">
							<h3 class=" mb-0 font-weight-bold">Descripción</h3>
							<p rows="10" style="width: 100%; "><?=nl2br($arrayDataEvent['desc_event'])?></p>
						</div>

					</div>
					<div class="row mt-4" id="eventDetailDesc-text" style="display: none;">

						<div class="col-md-12">
							<h3 class=" mb-0 font-weight-bold">Descripción</h3>
							<textarea name="eventDesc" rows="10" style="width: 100%; " class="form-control form-custom-2 mb-2"><?=(isset($arrayDataEvent)) ? $arrayDataEvent['desc_event'] : '' ?></textarea>
							<? if(isset($eventDescError)): ?><span class="text-danger"><strong class="alert"><?=$eventDescError?></strong></span><? endif; ?>
						</div>

					</div>


					<div class="row mt-5" id="eventDetailDesc-caracter">
						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Hora del Evento</h3>
							<h3 class="mt-0 "><?=$timeEvent?> Hrs</h3>
						</div>
						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Duración</h3>
							<h3 class="mt-0 "><?=$arrayDataEvent['duration_event']?> Hrs</h3>
						</div>
							<div class="col-md-4">
								<h3 class="mt-0 mb-0 font-weight-bold">Valor Entrada</h3>
								<h3 class="mt-0 ">$<?=$formatedValue?></h3>
							</div>
							<div class="col-md-4">
								<h3 class="mt-0 mb-0 font-weight-bold">Audiencia</h3>
								<h3 class="mt-0 "><?=$arrayDataEvent['audience_event']?> personas</h3>
							</div>
					</div>
					<!-- Inputs -->
					<div class="row mt-5" id="eventDetailDesc-input" style="display: none;">

						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Hora del Evento</h3>
							<select id="inputEventTime" name="timeEvent" class="form-control form-custom-1">
							    <option <?=$selected = ($timeEvent=='08:00') ? 'selected' : '' ?> value="08:00">08:00 hrs</option>

									<option <?=$selected = ($timeEvent=='08:30') ? 'selected' : '' ?> value="08:30">08:30 hrs</option>

									<option <?=$selected = ($timeEvent=='09:00') ? 'selected' : '' ?> value="09:00">09:00 hrs</option>

									<option <?=$selected = ($timeEvent=='09:30') ? 'selected' : '' ?> value="09:30">09:30 hrs</option>

									<option <?=$selected = ($timeEvent=='10:00') ? 'selected' : '' ?> value="10:00">10:00 hrs</option>

									<option <?=$selected = ($timeEvent=='10:30') ? 'selected' : '' ?> value="10:30">10:30 hrs</option>

									<option <?=$selected = ($timeEvent=='11:00') ? 'selected' : '' ?> value="11:00">11:00 hrs</option>

									<option <?=$selected = ($timeEvent=='11:30') ? 'selected' : '' ?> value="11:30">11:30 hrs</option>

									<option <?=$selected = ($timeEvent=='12:00') ? 'selected' : '' ?> value="12:00">12:00 hrs</option>

									<option <?=$selected = ($timeEvent=='12:30') ? 'selected' : '' ?> value="12:30">12:30 hrs</option>

									<option <?=$selected = ($timeEvent=='13:00') ? 'selected' : '' ?> value="13:00">13:00 hrs</option>

									<option <?=$selected = ($timeEvent=='13:30') ? 'selected' : '' ?> value="13:30">13:30 hrs</option>

									<option <?=$selected = ($timeEvent=='14:00') ? 'selected' : '' ?> value="14:00">14:00 hrs</option>

									<option <?=$selected = ($timeEvent=='14:30') ? 'selected' : '' ?> value="14:30">14:30 hrs</option>

									<option <?=$selected = ($timeEvent=='15:00') ? 'selected' : '' ?> value="15:00">15:00 hrs</option>

									<option <?=$selected = ($timeEvent=='15:30') ? 'selected' : '' ?> value="15:30">15:30 hrs</option>

									<option <?=$selected = ($timeEvent=='16:00') ? 'selected' : '' ?> value="16:00">16:00 hrs</option>

									<option <?=$selected = ($timeEvent=='16:30') ? 'selected' : '' ?> value="16:30">16:30 hrs</option>

									<option <?=$selected = ($timeEvent=='17:00') ? 'selected' : '' ?> value="17:00">17:00 hrs</option>

									<option <?=$selected = ($timeEvent=='17:30') ? 'selected' : '' ?> value="17:30">17:30 hrs</option>

									<option <?=$selected = ($timeEvent=='18:00') ? 'selected' : '' ?> value="18:00">18:00 hrs</option>

									<option <?=$selected = ($timeEvent=='18:30') ? 'selected' : '' ?> value="18:30">18:30 hrs</option>

									<option <?=$selected = ($timeEvent=='19:00') ? 'selected' : '' ?> value="19:00">19:00 hrs</option>

									<option <?=$selected = ($timeEvent=='19:30') ? 'selected' : '' ?> value="19:30">19:30 hrs</option>

									<option <?=$selected = ($timeEvent=='20:00') ? 'selected' : '' ?> value="20:00">20:00 hrs</option>

									<option <?=$selected = ($timeEvent=='20:30') ? 'selected' : '' ?> value="20:30">20:30 hrs</option>

									<option <?=$selected = ($timeEvent=='21:00') ? 'selected' : '' ?> value="21:00">21:00 hrs</option>

									<option <?=$selected = ($timeEvent=='21:30') ? 'selected' : '' ?> value="21:30">21:30 hrs</option>

									<option <?=$selected = ($timeEvent=='22:00') ? 'selected' : '' ?> value="22:00">22:00 hrs</option>

									<option <?=$selected = ($timeEvent=='22:30') ? 'selected' : '' ?> value="22:30">22:30 hrs</option>

									<option <?=$selected = ($timeEvent=='23:00') ? 'selected' : '' ?> value="23:00">23:00 hrs</option>

									<option <?=$selected = ($timeEvent=='23:30') ? 'selected' : '' ?> value="23:30">23:30 hrs</option>

									<option <?=$selected = ($timeEvent=='00:00') ? 'selected' : '' ?>value="00:00">00:00 hrs</option>
					  		</select>
								<? if(isset($timeEventError)): ?><span class="text-danger"><strong class="alert"><?=$timeEventError?></strong></span><? endif; ?>
						</div>

						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Duración</h3>
							<select id="inputEventDuration" name="durationEvent" class="form-control form-custom-1">
							    <option <?=$selected = ($arrayDataEvent['duration_event']=='00:30') ? 'selected' : '' ?> value="00:30">00:30 hrs</option>
							    <option <?=$selected = ($arrayDataEvent['duration_event']=='00:45') ? 'selected' : '' ?> value="00:45">00:45 hrs</option>
							    <option <?=$selected = ($arrayDataEvent['duration_event']=='01:00') ? 'selected' : '' ?> value="01:00">01:00 hrs</option>
							    <option <?=$selected = ($arrayDataEvent['duration_event']=='01:30') ? 'selected' : '' ?> value="01:30">01:30 hrs</option>
							    <option <?=$selected = ($arrayDataEvent['duration_event']=='02:00') ? 'selected' : '' ?> value="02:30">02:00 hrs</option>
							    <option <?=$selected = ($arrayDataEvent['duration_event']=='02:30') ? 'selected' : '' ?> value="02:30">02:30 hrs</option>
							    <option <?=$selected = ($arrayDataEvent['duration_event']=='03:00') ? 'selected' : '' ?> value="03:00">03:00 hrs</option>
							    <option <?=$selected = ($arrayDataEvent['duration_event']=='03:30') ? 'selected' : '' ?> value="03:30">03:30 hrs</option>
					  		</select>

								<? if(isset($durationEventError)): ?><span class="text-danger"><strong class="alert"><?=$durationEventError?></strong></span><? endif; ?>
						</div>

						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Valor Entrada</h3>
							<? if($arrayDataEvent['active_event'] == '1'): ?>
								<input type="text" name="publicValueTicket" value="<?=$arrayDataEvent['value']?>" class="form-control form-custom-1 isDisabled" readonly>
							<? elseif($arrayDataEvent['payment_event'] == '1'): ?>
								<input type="text" name="publicValueTicket" value="<?=$arrayDataEvent['value']?>" class="form-control form-custom-1 isDisabled" readonly>
							<? else: ?>
								<input type="text" name="publicValueTicket" value="<?=$arrayDataEvent['value']?>" class="form-control form-custom-1">
							<? endif; ?>
							<? if(isset($valueEventError)): ?><span class="text-danger"><strong class="alert"><?=$valueEventError?></strong></span><? endif; ?>
						</div>
						<div class="col-md-4">
							<h3 class="mt-0 mb-0 font-weight-bold">Audiencia</h3>
							<input type="number" name="audienceEvent" value="<?=$arrayDataEvent['audience_event']?>" class="form-control form-custom-1">
							<? if(isset($audienceEventError)): ?><span class="text-danger"><strong class="alert"><?=$audienceEventError?></strong></span><? endif; ?>
						</div>
			   		</div>
			   		<div class="row" id="eventDetailDesc-input3" style="display: none;">
						<div class="col-md-4">
				      		<h3 class="font-weight-bold" for="inputEventFile">Imagen Promocional del Evento</h3>
									<label class="btn btn-primary" for="my-file-selector">
							    <input name="file-input" id="my-file-selector" type="file" style="display:none"
							    onchange="$('#upload-file-info').html(this.files[0].name)">
							    Seleccionar Archivo
							</label>
							<span class='label label-info' id="upload-file-info"></span>
							<? if(isset($imageEventError)): ?><span class="text-danger"><strong class="alert"><?=$imageEventError?></strong></span><? endif; ?>
			   			</div>


					</div>
					<div class="row my-2">

						<!-- Image preview -->
						<div class="col-md-6 col-12">

							<h4 class="mt-0 mb-3 font-weight-bold eventDetailDesc-values">Imagen:</h4>
							<img id="imagenEvento" class="d-none d-sm-block" src="../../images/events/<?=$arrayDataEvent['img']?>.jpg" style="min-height: 400px; width:100%; max-width:400px;"/>
						</div>
					</div>
					<!-- <div class="row" id="eventDetailVideo-input" style="display: none;">
						<div class="form-group col-md-8">
				      		<label class="font-weight-bold" for="inputEventVideo">Video Promocional del Evento (Opcional)</label><br>
								<div class="row">
									<div class="col-md-8">
										<input name="eventVideo" type="text" class="form-control form-custom-1" id="inputEventVideo" value="" placeholder="https://www.youtube.com/watch?v=123456789">

									</div>
								</div>
						</div>
					</div> -->
					<!-- Video preview -->

					<!-- <? if(isset($postDetail)): ?>
						<? switch($postDetail['service_multi']):case "youtube":?>
							<h4 class="mt-0 mb-3 font-weight-bold eventDetailDesc-values">Video:</h4>

							<iframe style="width: 100%;height: 50vh;" src="https://www.youtube.com/embed/<?=$postDetail['embed_multi']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<? break; ?>
						<? case "vimeo": ?>
							<h4 class="mt-0 mb-3 font-weight-bold eventDetailDesc-values">Video:</h4>

							<iframe style="width: 100%;height: 50vh;" src="https://player.vimeo.com/video/<?=$postDetail['embed_multi']?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
						<? break; ?>
						<? endswitch; ?>
					<? endif; ?> -->
					<div class="col-md-12 text-leftcenter">
						</div>
					<div class="row mt-3">
						<div class="col-md-12 text-leftcenter">
							<input type="submit" name="saveStreamingEvent" class="btn btn-primary" value="Guardar Cambios" />
							<a href="dashboard.php" class="btn btn-outline-secondary">Volver </a>
						</div>
					</div>


			</form>

			</div>
	<? break; ?>
<? endswitch; ?>



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

			<script src="assets/js/ajaxChangeCities.js"></script>

			<script src="assets/js/jquery.datetimepicker.full.js"></script>

			<? include 'resources/login_error_script.php'; ?>

			<? if(isset($errTyp) && $errTyp =='danger'): ?>
        <script type='text/javascript'>alert('<?=$errMSG?>');</script>
      <? endif; ?>

			<? if(isset($_SESSION['success'])): ?>
				<script type='text/javascript'>alert('<?=$_SESSION['success']?>');</script>
				<? unset($_SESSION['success']) ?>
			<? endif; ?>

<!-- Footer -->

	<?php
		include 'resources/footer.php';
	 ?>
	<script>
		jQuery.datetimepicker.setLocale('es');
		jQuery('#fechaticket').datetimepicker({
			 timepicker:false,
			 format:'d-m-Y'
		 });
		jQuery('.ticketStart').datetimepicker({

			 format:'d-m-Y H:i'
		 });
		jQuery('.ticketEnd').datetimepicker({

			 format:'d-m-Y H:i'
		 });
	</script>

	<script type="text/javascript">
		$( "#editbtnEvent" ).click(function() {
			$("#info-artista").css("display", "none");
			$("#info-nameartista").css("display", "none");
			$("#eventDetailDesc").css("display", "none");
			$("#eventDetailDesc-caracter").css("display", "none");
			$("#eventDetailDesc-caracter2").css("display", "none");
			$("#eventDetailDesc-values").css("display", "none");
			$(".eventDetailDesc-values").css("display", "none");

			$("#infoedit-artista").css("display", "block");
			$("#info-nameartista-edit").css("display", "block");
			$("#eventDetailDesc-text").css("display", "block");
			$("#editCoverEvent").css("display", "block");
			$("#saveCoverEvent").css("display", "inline-block");
			$("#eventDetailDesc-input").css("display", "flex");
			$("#eventDetailDesc-input2").css("display", "block");
			$("#eventDetailDesc-input3").css("display", "block");
			$("#eventDetailVideo-input").css("display", "block");


			$("#editbtnEvent").css("display", "none");
		});
		$( "#saveCoverEvent" ).click(function() {
			$("#info-artista").css("display", "block");
			$("#info-nameartista").css("display", "block");
			$("#eventDetailDesc").css("display", "flex");
			$("#eventDetailDesc-caracter").css("display", "flex");
			$("#eventDetailDesc-caracter2").css("display", "block");
			$("#eventDetailDesc-values").css("display", "flex");
			$(".eventDetailDesc-values").css("display", "flex");

			$("#infoedit-artista").css("display", "none");
			$("#editCoverEvent").css("display", "none");
			$("#saveCoverEvent").css("display", "none");
			$("#info-nameartista-edit").css("display", "none");
			$("#eventDetailDesc-text").css("display", "none");
			$("#eventDetailDesc-input").css("display", "none");
			$("#eventDetailDesc-input2").css("display", "none");
			$("#eventDetailDesc-input3").css("display", "none");
			$("#eventDetailVideo-input").css("display", "none");


			$("#editbtnEvent").css("display", "inline-block");
		});
		$( "#botonEditarTicket" ).click(function() {
			$("#eventDetailPrice").css("display", "none");
			$("#eventDetailPriceedit").css("display", "flex");
		});
		$( "#botonsaveTicket" ).click(function() {
			$("#eventDetailPrice").css("display", "flex");
			$("#eventDetailPriceedit").css("display", "none");
		});

$('#crearEventoPresencialTabla').on('click', 'a', function () {
    $(this).closest('tr').remove();
    //delete-ID
    var idValue = $(this).closest('tr').find("input[name='publicTicketId[]").val();
    console.log($(this).closest('tr').find("input[name='publicTicketId[]").val());
    if (idValue === undefined || idValue === null){
    }else{
    	$('#InputDeletes').append('<input type="hidden" name="publicTicketId[]" value="delete-'+idValue+'">');
    }
});

		$('#crearEventoPresencialTablaButton').click(function () {
			var inputRow = '<td>'+
		        	'<label class="font-weight-bold" for="inputTicketName_01">Nombre Entrada</label>'+
					'<input name="publicNameTicket[]" value="" type="text" class="form-control form-custom-1" id="ticketName_01" aria-describedby="valueHelpBlock" placeholder="Ej: General">'+
					'<? if(isset($ticketName_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketName_01Error?></strong></span><? endif; ?>'+
		        '</td><td>'+
		        	'<label class="font-weight-bold" for="inputTicketValue_01">Valor Entrada</label>'+
					'<input name="publicValueTicket[]" value="" type="text" class="form-control form-custom-1" id="ticketValue_01" aria-describedby="valueHelpBlock" placeholder="Ej: $2.500">'+

					'<? if(isset($ticketValue_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketValue_01Error?></strong></span><? endif; ?>
		        </td> <td>'+
		            '<label class="font-weight-bold" for="inputTicketAudience_01">Cantidad</label>'+
					'<input name="publicAudienceTicket[]" value="" type="text" class="form-control form-custom-1 col-12" id="ticketAudience_01" aria-describedby="valueHelpBlock" placeholder="Ej: 10">'+
					'<? if(isset($ticketAudience_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketAudience_01Error?></strong></span><? endif; ?>
		        </td><td style="position: relative;">'+
					'<label class="font-weight-bold" for="inputTicketStart_01">Inicio venta</label>'+
					'<div class="row m-0">'+
						'<input name="publicTicketStart[]"  value="" type="text" id="publicTicketStart" class="ticketStart form-control form-custom-1 col-12 hasDatepicker datetimepicker-input" placeholder="Fecha">'+
						'<i class="fas fa-calendar-alt calendarIcon col-1"></i>'+
					'</div>'+
					'<? if(isset($ticketStart_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketStart_01Error?></strong></span><? endif; ?> </td><td style="position: relative;">'+

					'<label class="font-weight-bold" for="inputTicketEnd_01">Término venta</label>'+
					'<div class="row m-0">'+
						'<input name="publicTicketEnd[]" value="" type="text" id="publicTicketEnd" class="ticketEnd form-control form-custom-1 col-12 hasDatepicker datetimepicker-input" placeholder="Fecha">'+
						'<i class="fas fa-calendar-alt calendarIcon col-1"></i>'+
						'<input type="hidden" name="publicTicketId[]" value="">'+
					'</div>'+
					'<? if(isset($ticketEnd_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketEnd_01Error?></strong></span><? endif; ?> </td>						<td width="1%"><label class="font-weight-bold" for="inputTicketEnd" style="color:white;">.</label><a class="icon form-control form-custom-1" style="cursor:pointer;"> <i class="fas fa-trash-alt"></i></a></td>';



		    $('#crearEventoPresencialTabla').append('<tr>'+inputRow+'</tr>');

				$('.ticketStart').datetimepicker({
           format:'d-m-Y H:i',
           // icons:{
           // time:'far fa-clock'
           // }
         });
        $('.ticketEnd').datetimepicker({
           format:'d-m-Y H:i',
           // icons:{
           // time:'far fa-clock'
           // }
         });
		});



	</script>
	<script>
		// $(function () {
		// 	$.datepicker.regional['es'] = {
		// 		closeText: 'Cerrar',
		// 		prevText: '<',
		// 		nextText: '>',
		// 		currentText: 'Hoy',
		// 		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		// 		monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		// 		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		// 		dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		// 		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		// 		weekHeader: 'Sm',
		// 		dateFormat: 'dd-mm-yy',
		// 		firstDay: 1,
		// 		isRTL: false,
		// 		showMonthAfterYear: false,
		// 		yearSuffix: ''
		// 	};
		// 	$.datepicker.setDefaults($.datepicker.regional['es']);
		// 	$("#fechaticket").datepicker({
		// 		minDate: 0,
		//
		// 	});
		// });
	</script>

	<? include 'resources/googleLoginScript.php'; ?>
	</body>

</html>
