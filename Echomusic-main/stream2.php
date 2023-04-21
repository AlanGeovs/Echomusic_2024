<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/streamCreate_script.php';
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

		<title>EchoMusic | Crear evento streaming</title>

		<meta charset="utf-8" />
		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />

		<meta name="og:image" content="https://qa.echomusic.cl/images/logo_brand_3.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="Crea tu Evento EchoMusic.cl - La música nos conecta" />
 		<meta name="description" content="Crea tu evento EchoMusic streaming o presencial y monetiza tu talento." />

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">
		<link rel="stylesheet"  href="assets/css/jquery-ui.css">

		<link rel=icon href=/favicon.ico>
		<? include_once("resources/Analytics.php"); ?>
	</head>

	<body>
<main role="main">

	<!-- Top Navbar -->
	<?php

		include 'resources/topNavbar.php';



	?>

	<div id="streamTMainBanner" class="jumbotron pb-0">
		<div class="backgroundImage"></div>
	</div>



	<!-- Main Content -->
	<div id="streamMainBanner" class="container">

		<? if(isset($errTyp) && $errTyp == "success"): ?>
				<!-- Reserve notification -->
				<div class="row mt-4" id="reserveConfirmNotice">
					<div class="text-center col-12 align-self-center">
							<h2>Evento creado con éxito</h2>
							<p>Ahora puedes configurar tu evento desde tu panel de control</p>
							<i class="far fa-check-circle"></i>
							<h3 class="mt-4">Evento creado</h3>
					</div>
				</div>
				<div class="row justify-content-center mt-5">

					<div class="col-md-3 text-center mt-1">

						<a class="btn btn-outline-secondary btn-block btn-lg" href="index.php">Volver al inicio</a>

					</div>

					<div class="col-md-3 text-center mt-1">

						<a class="btn btn-primary btn-block btn-lg" href="dashboard.php">Panel de Control</a>

					</div>

				</div>
		<? else: ?>

<!-- Breadcrumb -->

			<nav aria-label="breadcrumb" id="streamTBreadcrumb">

			  <ol class="breadcrumb mb-0">

			    <li class="breadcrumb-item"><a href="https://qa.echomusic.cl/startEvent.php">Crear Evento</a></li>
			    <li class="breadcrumb-item"><a href="https://qa.echomusic.cl/stream1.php">Requerimientos</a></li>

			    <li class="breadcrumb-item active" aria-current="page">Formulario Streaming</li>

			  </ol>

			</nav>

  <!-- First Banner -->
		<div class="row">
			<div class="col-md-12 my-2">

				<h2 class="font-weight-bold">Ingresa los datos para tu Evento Streaming</h2>

			</div>
		</div>
		<form enctype="multipart/form-data" action="" method="post">
			<div class="row mt-4">
				<div class="form-group col-md-4">

					<label class="font-weight-bold" for="inputEventName">Nombre oficial del evento</label>

					<input type="text" value="<?if(isset($nameEvent)){ echo str_replace("\'","'",$nameEvent);  }?>" name="nameEvent" class="form-control form-custom-1" id="inputEventName">

					<? if(isset($nameEventError)): ?><span class="text-danger"><strong class="alert"><?=$nameEventError?></strong></span><? endif; ?>

				</div>
				<div class="form-group col-md-4">

					<label class="font-weight-bold" for="inputEventPay">Tipo de evento</label>
					<select id="inputEventPay" name="typeEvent" class="form-control form-custom-1">
						<option> - </option>
						<option <?if(isset($typeEvent) && $typeEvent=='1'){ echo 'selected';  }?> value="1">Gratuito</option>
						<option <?if(isset($typeEvent) && $typeEvent=='2'){ echo 'selected';  }?> value="2">De pago</option>
					</select>

					<? if(isset($typeEventError)): ?><span class="text-danger"><strong class="alert"><?=$typeEventError?></strong></span><? endif; ?>

				</div>
				<div class="form-group col-md-4">

					<label class="font-weight-bold" for="inputOrganizer">Audiencia</label>
					<input type="number" value="<?if(isset($audienceEvent)){ echo $audienceEvent;  }?>" name="audienceEvent" min="1" max="5000" class="form-control form-custom-1" id="inputOrganizer" placeholder="10 personas">

					<? if(isset($audienceEventError)): ?><span class="text-danger"><strong class="alert"><?=$audienceEventError?></strong></span><? endif; ?>

				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4 input-calendar">

	  			<label class="font-weight-bold" for="inputEventDay">Fecha y hora inicio streaming</label>
					<div class="row m-0">

						<input type="text" value="<?if(isset($dateEventValue)){ echo $dateEventValue;  }?>" id="startStreaming" name="dateEvent" class="form-control form-custom-1 col-6" placeholder="Día del evento">
						<i class="fas fa-calendar-alt calendarIcon col-1"></i>

						<select id="inputEventTime" name="timeEvent" class="form-control form-custom-1 col-5 mx-1">
						    <option <?if(isset($timeEvent) && $timeEvent=='08:00'){ echo 'selected';  }?> value="08:00">08:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='08:30'){ echo 'selected';  }?> value="08:30">08:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='09:00'){ echo 'selected';  }?> value="09:00">09:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='09:30'){ echo 'selected';  }?> value="09:30">09:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='10:00'){ echo 'selected';  }?> value="10:00">10:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='10:30'){ echo 'selected';  }?> value="10:30">10:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='11:00'){ echo 'selected';  }?> value="11:00">11:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='11:30'){ echo 'selected';  }?> value="11:30">11:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='12:00'){ echo 'selected';  }?> value="12:00">12:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='12:30'){ echo 'selected';  }?> value="12:30">12:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='13:00'){ echo 'selected';  }?> value="13:00">13:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='13:30'){ echo 'selected';  }?> value="13:30">13:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='14:00'){ echo 'selected';  }?> value="14:00">14:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='14:30'){ echo 'selected';  }?> value="14:30">14:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='15:00'){ echo 'selected';  }?> value="15:00">15:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='15:30'){ echo 'selected';  }?> value="15:30">15:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='16:00'){ echo 'selected';  }?> value="16:00">16:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='16:30'){ echo 'selected';  }?> value="16:30">16:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='17:00'){ echo 'selected';  }?> value="17:00">17:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='17:30'){ echo 'selected';  }?> value="17:30">17:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='18:00'){ echo 'selected';  }?> value="18:00">18:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='18:30'){ echo 'selected';  }?> value="18:30">18:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='19:00'){ echo 'selected';  }?> value="19:00">19:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='19:30'){ echo 'selected';  }?> value="19:30">19:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='20:00'){ echo 'selected';  }?> value="20:00">20:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='20:30'){ echo 'selected';  }?> value="20:30">20:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='21:00'){ echo 'selected';  }?> value="21:00">21:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='21:30'){ echo 'selected';  }?> value="21:30">21:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='22:00'){ echo 'selected';  }?> value="22:00">22:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='22:30'){ echo 'selected';  }?> value="22:30">22:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='23:00'){ echo 'selected';  }?> value="23:00">23:00 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='23:30'){ echo 'selected';  }?> value="23:30">23:30 hrs</option>

								<option <?if(isset($timeEvent) && $timeEvent=='00:00'){ echo 'selected';  }?> value="00:00">00:00 hrs</option>
			  		</select>
						<? if(isset($dateEventError)): ?><span class="text-danger"><strong class="alert"><?=$dateEventError?></strong></span><? endif; ?>
						<? if(isset($timeEventError)): ?><span class="text-danger"><strong class="alert"><?=$timeEventError?></strong></span><? endif; ?>

		  		</div>
				</div>
				<div class="form-group col-md-4">

					<label class="font-weight-bold" for="inputEventDay">Duración de streaming</label>
					<select id="inputEventDuration" name="durationEvent" class="form-control form-custom-1">
					    <option <?if(isset($durationEvent) && $durationEvent=='00:30'){ echo 'selected';  }?> value="00:30">30 minutos</option>
					    <option <?if(isset($durationEvent) && $durationEvent=='00:45'){ echo 'selected';  }?> value="00:45">45 minutos</option>
					    <option <?if(isset($durationEvent) && $durationEvent=='01:00'){ echo 'selected';  }?> value="01:00">1 hora</option>
					    <option <?if(isset($durationEvent) && $durationEvent=='01:30'){ echo 'selected';  }?> value="01:30">1:30 horas</option>
					    <option <?if(isset($durationEvent) && $durationEvent=='02:00'){ echo 'selected';  }?> value="02:00">2 horas</option>
					    <option <?if(isset($durationEvent) && $durationEvent=='02:30'){ echo 'selected';  }?> value="02:30">2:30 horas</option>
					    <option <?if(isset($durationEvent) && $durationEvent=='03:00'){ echo 'selected';  }?> value="03:00">3 horas</option>
					    <option <?if(isset($durationEvent) && $durationEvent=='03:30'){ echo 'selected';  }?> value="03:30">3:30 horas</option>
			  		</select>

						<? if(isset($durationEventError)): ?><span class="text-danger"><strong class="alert"><?=$durationEventError?></strong></span><? endif; ?>

				</div>
				<div class="form-group col-md-4">

					<label class="font-weight-bold" for="inputEventValue">Valor entrada</label>
					<input type="text" value="<?if(isset($valueEvent)){ echo $valueEvent;  }?>" name="valueEvent" class="form-control form-custom-1" id="inputEventValue" aria-describedby="valueHelpBlock" placeholder="Ej: 2500">
					<small id="valueHelpBlock" class="form-text text-muted">Escribe 0 si la entrada es liberada</small>

					<? if(isset($valueEventError)): ?><span class="text-danger"><strong class="alert"><?=$valueEventError?></strong></span><? endif; ?>

				</div>
			</div>
			<div class="row">

		    	<div class="form-group col-md-12">

		      		<label class="font-weight-bold" for="inputEventFile">Imagen promocional del evento</label><br>
							<label class="btn btn-primary" for="my-file-selector">
					    <input id="my-file-selector" name="imageEvent" type="file" style="display:none"
					    onchange="$('#upload-file-info').html(this.files[0].name)">
					    Seleccionar archivo
					</label>
					<span class='label label-info' id="upload-file-info"></span>

					<a href="" data-toggle="modal" data-target="#kitDigitalModal" data-toggle="tooltip" data-placement="top" title="Utiliza estos logos para tus graficas"> Descarga logos EchoMusic </a>


					<small id="valueHelpBlock" class="form-text text-muted">Dimensiones óptimas 1080x1080 - Peso máximo 5 mb</small>

					<? if(isset($imageEventError)): ?><span class="text-danger"><strong class="alert"><?=$imageEventError?></strong></span><? endif; ?>

		   		</div>
			</div>
			<div class="row">
				<div class="form-group col-md-8">

			    	<label class="font-weight-bold" for="inputEventDesc">Descripción del evento</label>
			    	<textarea class="form-control form-custom-1" name="descEvent" id="inputEventDesc" placeholder="Mínimo 50 caracteres - La descripción es muy importante para atraer a los usuarios y explicar el evento" rows="6"><?if(isset($descEvent)){ echo str_replace("\'","'",$descEvent);  }?></textarea>
						<? if(isset($descEventError)): ?><span class="text-danger"><strong class="alert"><?=$descEventError?></strong></span><? endif; ?>

			  	</div>
		  	</div>
			<div class="row">

				<div class="col-md-12 my-3">

					<div class="form-check">

					  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">

					  <label class="form-check-label" for="defaultCheck1" id="defaultCheck1Label">

					    He leído los <a href="" data-toggle="modal" data-target="#conditionsEventsModal">términos y condiciones.</a>

					  </label>

					</div>

				</div>
			</div>
			<div class="row my-2">
				<div class="offset-md-4 col-md-4 text-center">

					<button type="submit" id="submitEvent" name="submitEvent" class="btn btn-primary my-2">Crear Evento</button>
					<input type="reset" class="btn btn-secondary my-2" value="Limpiar campos">

				</div>

			</div>
		</form>
	<? endif; ?>
	</div>

 <!-- modal KitDigital-->
			<div class="modal fade" id="kitDigitalModal" tabindex="-1" role="dialog" aria-labelledby="kitDigitalModal" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content">

			      <div class="modal-header">

			        <h5 class="modal-title">Kit Digital</h5>

			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

			          <span aria-hidden="true">&times;</span>

			        </button>

			      </div>

			      <div class="modal-body">

			        El Kit Digital consiste de un archivo con imagenes para facilitar el uso de nuestro logo oficial tanto para difusiones, comunicación digital, diseño y otros.
			        <br>
			        <br>
			        <a href="/assets/kitdigital/EM_ Logos_descarga.zip" class="d-block m-auto my-3 text-center" style="font-size: 40px;"><i class="fas fa-download m-auto my-3"></i>
			        <em class="d-table text-center m-auto"  style="font-size: 14px;">Descargar Kitdigital EchoMusic</em></a>
			        <br>

			      </div>

			      <div class="modal-footer">

			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

			      </div>

			    </div>

			  </div>

			</div>


<!-- Main Content -->

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

			<script src="assets/js/validateStreamingCreate.js"></script>

			<script src="assets/js/jquery.charactercounter.js"></script>

			<script src="assets/js/jquery.mask.js"></script>

			<? include 'resources/login_error_script.php'; ?>

			<script type="text/javascript">
 			 $(document).ready(function(){
 				 $('#inputEventValue').mask('000.000.000.000.000', {reverse: true});
 			 });
 		 </script>

      <? if($plsLogin==true): ?>
           <script>
             $(document).ready(function(){
               $('#loginModal').modal('show');
             });
           </script>
      <? endif; ?>

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
			$("#startStreaming").datepicker({
				minDate: 0,

			});
		});
	</script>

		<script>
			$('#inputEventPay').change(function(){
				if($('#inputEventPay').val()=='1'){
					$('#inputEventValue').val('0');
					$('#inputEventValue').prop('readonly', true);
				}else{
					$('#inputEventValue').val('');
					$('#inputEventValue').prop('readonly', false);
				}
			});
		</script>

		<script>
			$("#inputEventDesc").characterCounter({
				limit: '3000',
				counterFormat: '%1 caracteres restantes'
			});
		</script>

		<? include 'resources/googleLoginScript.php'; ?>

	</body>
	<?
		include 'resources/conditionsEventsModal.php';
	?>
</html>
