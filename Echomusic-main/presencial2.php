<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/publicCreate_script.php';
include 'resources/login_script.php';


// Get url breadcrumb
$breadCrumbUrl = $_SERVER['HTTP_REFERER'];

switch(true){
  case preg_match("/search/i", $breadCrumbUrl):
    $breadCrumbUrl = $breadCrumbUrl;
    $breadCrumbName = "Buscador";
  break;

  case preg_match("/index/i", $breadCrumbUrl):
    $breadCrumbUrl = "https://qa.echomusic.cl/index.php";
    $breadCrumbName = "Inicio";
  break;
  case true:
    $breadCrumbUrl = "https://qa.echomusic.cl/startEvent.php";
    $breadCrumbName = "Crear Evento";
  break;
}
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

		<title>EchoMusic | Crear evento presencial</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />

		<link rel="stylesheet" href="assets/css/custom.css">
		<link rel="stylesheet"  href="assets/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.datetimepicker.css"/>
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

		<? if(isset($_SESSION['success'])): ?>
				<!-- Reserve notification -->
				<div class="row mt-4" id="reserveConfirmNotice">
					<div class="text-center col-12 align-self-center">
							<h2>Evento creado con éxito</h2>
							<p>Ahora puedes publicar tu evento desde tu panel de control</p>
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

						    <li class="breadcrumb-item"><a href="<?=$breadCrumbUrl?>"><?=$breadCrumbName?></a></li>

						    <li class="breadcrumb-item active" aria-current="page">Presencial</li>

						  </ol>

						</nav>
	<!-- Form -->
		<div class="row">
			<div class="col-md-12 my-2">

				<h2 class="font-weight-bold">Ingresa los datos de tu evento</h2>

			</div>
		</div>
		<form id="formEvento" enctype="multipart/form-data" style="width: 100%;" action="" method="post">
			<div class="row mt-4">
				<div class="form-group col-md-4">

					<label class="font-weight-bold" for="inputEventName">Nombre Oficial del Evento</label>

					<input name="publicNameEvent" type="text" class="form-control form-custom-1" id="inputEventName" value="<?if(isset($publicNameEvent)){ echo str_replace("\'","'",$publicNameEvent);  }?>">

					<? if(isset($publicNameEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicNameEventError?></strong></span><? endif; ?>

				</div>
				<div class="form-group col-md-4">

					<label class="font-weight-bold" for="inputNameLocation">Nombre del Lugar</label>

					<input name="publicNameLocationEvent" type="text" class="form-control form-custom-1" id="inputNameLocation" value="<?if(isset($publicNameLocationEvent)){ echo str_replace("\'","'",$publicNameLocationEvent);  }?>">

					<? if(isset($publicNameLocationEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicNameLocationEventError?></strong></span><? endif; ?>

				</div>
				<div class="form-group col-md-4">

					<label class="font-weight-bold" for="inputOrganizer">Organizador</label>

					<input name="publicOrganizerEvent" type="text" class="form-control form-custom-1" id="inputOrganizer" value="<?if(isset($publicOrganizerEvent)){ echo str_replace("\'","'",$publicOrganizerEvent);  }?>">

					<? if(isset($publicOrganizerEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicOrganizerEventError?></strong></span><? endif; ?>

				</div>

			</div>
			<div class="row">
				<div class="form-group col-md-4">

		  		<label class="font-weight-bold" for="inputRegion">Región</label>
					<select id="inputRegion" name="publicRegionEvent" class="form-control form-custom-1" autcomplete="off" onChange="changeCities()">

						<? foreach($arrayRegions as $regions): ?>
              <? $selected = ($publicRegionEvent == $regions['id_region']) ? "selected" : "" ?>
									<option value="<?=$regions['id_region']?>" <?=$selected?>><?=$regions['name_region']?></option>
							<? unset($selected); ?>
						<? endforeach ?>

					</select>

					<? if(isset($publicRegionEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicRegionEventError?></strong></span><? endif; ?>

				</div>
				<div class="form-group col-md-4">

		  		<label class="font-weight-bold" for="inputCity">Comuna</label>
					<select  name="publicCityEvent" class="form-control form-custom-1" id="inputCity">
							<option value="1">Arica</option>
							<option value="2">Putre</option>
							<option value="3">Camarones</option>
							<option value="4">General Lagos</option>
					</select>

					<? if(isset($publicCityEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicCityEventError?></strong></span><? endif; ?>

				</div>

				<div class="form-group col-md-4">

					<label class="font-weight-bold" for="inputLocation">Dirección</label>

					<input name="publicLocationEvent" type="text" class="form-control form-custom-1" id="inputLocation" value="<?if(isset($publicLocationEvent)){ echo str_replace("\'","'",$publicLocationEvent);  }?>">

					<? if(isset($publicLocationEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicLocationEventError?></strong></span><? endif; ?>

				</div>

			</div>
			<div class="row">
				<div class="form-group col-md-4 input-calendar">

	  			<label class="font-weight-bold" for="inputEventDay">Fecha y hora</label>
					<div class="row m-0">

						<input name="publicDateEvent" value="<?if(isset($publicDateEventValue)){ echo $publicDateEventValue;  }?>" type="text" id="startStreaming" class="form-control form-custom-1 col-6" placeholder="Día del evento">
						<!-- <i class="fas fa-calendar-alt calendarIcon col-1"></i> -->

						<select name="publicTimeEvent" id="inputEventTime" class="form-control form-custom-1 col-5 mx-1">
						    <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='08:00'){ echo 'selected';  }?> value="08:00">08:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='08:30'){ echo 'selected';  }?> value="08:30">08:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='09:00'){ echo 'selected';  }?> value="09:00">09:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='09:30'){ echo 'selected';  }?> value="09:30">09:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='10:00'){ echo 'selected';  }?> value="10:00">10:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='10:30'){ echo 'selected';  }?> value="10:30">10:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='11:00'){ echo 'selected';  }?> value="11:00">11:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='11:30'){ echo 'selected';  }?> value="11:30">11:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='12:00'){ echo 'selected';  }?> value="12:00">12:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='12:30'){ echo 'selected';  }?> value="12:30">12:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='13:00'){ echo 'selected';  }?> value="13:00">13:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='13:30'){ echo 'selected';  }?> value="13:30">13:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='14:00'){ echo 'selected';  }?> value="14:00">14:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='14:30'){ echo 'selected';  }?> value="14:30">14:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='15:00'){ echo 'selected';  }?> value="15:00">15:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='15:30'){ echo 'selected';  }?> value="15:30">15:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='16:00'){ echo 'selected';  }?> value="16:00">16:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='16:30'){ echo 'selected';  }?> value="16:30">16:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='17:00'){ echo 'selected';  }?> value="17:00">17:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='17:30'){ echo 'selected';  }?> value="17:30">17:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='18:00'){ echo 'selected';  }?> value="18:00">18:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='18:30'){ echo 'selected';  }?> value="18:30">18:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='19:00'){ echo 'selected';  }?> value="19:00">19:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='19:30'){ echo 'selected';  }?> value="19:30">19:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='20:00'){ echo 'selected';  }?> value="20:00">20:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='20:30'){ echo 'selected';  }?> value="20:30">20:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='21:00'){ echo 'selected';  }?> value="21:00">21:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='21:30'){ echo 'selected';  }?> value="21:30">21:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='22:00'){ echo 'selected';  }?> value="22:00">22:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='22:30'){ echo 'selected';  }?> value="22:30">22:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='23:00'){ echo 'selected';  }?> value="23:00">23:00 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='23:30'){ echo 'selected';  }?> value="23:30">23:30 hrs</option>

				              <option <?if(isset($publicTimeEvent) && $publicTimeEvent=='00:00'){ echo 'selected';  }?> value="00:00">00:00 hrs</option>
				  		</select>

			  		</div>

						<? if(isset($publicDateEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicDateEventError?></strong></span><? endif; ?>
						<? if(isset($publicTimeEventError)): ?><span class="text-danger"><strong class="alert"><?=$publicTimeEventError?></strong></span><? endif; ?>

				</div>

        <div class="form-group col-md-4">

	  			<label class="font-weight-bold" for="inputPaymentEvent">Tipo de evento</label>

					<select name="paymentEvent" id="inputPaymentEvent" class="form-control form-custom-1">
					    <option <?if(isset($paymentEvent) && $paymentEvent=='1'){ echo 'selected';  }?> value="1">Gratuito</option>
					    <option <?if(isset($paymentEvent) && $paymentEvent=='2'){ echo 'selected';  }?> value="2">De pago</option>
					    <!--segun opcion, ocultar id="crearEventoPresencialTabla-id" -->
          			</select>
          <? if(isset($paymentEventError)): ?><span class="text-danger"><strong class="alert"><?=$paymentEventError?></strong></span><? endif; ?>
        </div>

        <div id="ColAudienceEvent" class="form-group col-md-4" <?if(isset($paymentEvent) && $paymentEvent=='2'){ echo 'style="display:none;"';  }?>>

					<label class="font-weight-bold" for="inputOrganizer">Audiencia</label>
					<input type="number" value="<?if(isset($audienceEvent)){ echo $audienceEvent;  }?>" name="audienceEvent" min="1" max="5000" class="form-control form-custom-1" id="inputOrganizer" placeholder="10 personas">

					<? if(isset($audienceEventError)): ?><span class="text-danger"><strong class="alert"><?=$audienceEventError?></strong></span><? endif; ?>

				</div>

			</div>

    <div class="row">
      	<div id="crearEventoPresencialTabla-id" class="form-group col-md-12" <?if(isset($paymentEvent) && $paymentEvent=='2'){ echo '';  }else{ echo 'style="display:none;"'; }?> >
      	 <table id="crearEventoPresencialTabla" >
           <!-- Check ticket array if error to preload -->

       <? if(!$error && isset($arrayPublicTicket)): ?>
         <? $keys = array_keys($arrayPublicTicket['ticketName']); ?>

         <? for($i = 0; $i < count($keys); $i++): ?>
         <?
           // variables para query
             $publicTicketName = $arrayPublicTicket['ticketName'][$i];
             $publicTicketValue = $arrayPublicTicket['ticketValue'][$i];
             $publicTicketAudience = $arrayPublicTicket['ticketAudience'][$i];
           // reconfig date start
             $publicTicketStart = $arrayPublicTicket['ticketStart'][$i];
             $publicTicketStart = date_create($publicTicketStart);
             $publicTicketStart = DATE_FORMAT($publicTicketStart, 'd-m-Y H:i');
           // reconfig date end
             $publicTicketEnd = $arrayPublicTicket['ticketEnd'][$i];
             $publicTicketEnd = date_create($publicTicketEnd);
             $publicTicketEnd = DATE_FORMAT($publicTicketEnd, 'd-m-Y H:i');
           ?>

             <tr>
     		        <td>
     		        	<label class="font-weight-bold" for="inputTicketName_01">Nombre Entrada</label>
     					<input name="ticketName[]" value="<?if(isset($publicTicketName)){ echo $publicTicketName;  }?>" type="text" class="form-control form-custom-1" id="ticketName_01" aria-describedby="valueHelpBlock" placeholder="Ej: General">
     					<? if(isset($ticketName_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketName_01Error?></strong></span><? endif; ?>
     		        </td>
     		        <td>
     		        	<label class="font-weight-bold" for="inputTicketValue_01">Valor Entrada</label>
     					<input name="ticketValue[]" value="<?if(isset($publicTicketValue)){ echo $publicTicketValue;  }?>" type="text" class="form-control form-custom-1" id="ticketValue_01" aria-describedby="valueHelpBlock" placeholder="Ej: $2.500">

     					<? if(isset($ticketValue_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketValue_01Error?></strong></span><? endif; ?>
     		        </td>
     		        <td width="10%">
     		            <label class="font-weight-bold" for="inputTicketAudience_01">Cantidad</label>
     					<input name="ticketAudience[]" value="<?if(isset($publicTicketAudience)){ echo $publicTicketAudience;  }?>" type="text" class="form-control form-custom-1 col-12" id="ticketAudience_01" aria-describedby="valueHelpBlock" placeholder="">
     					<? if(isset($ticketAudience_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketAudience_01Error?></strong></span><? endif; ?>
     		        </td>
     		        <td style="position: relative;">
     					<label class="font-weight-bold" for="inputTicketStart_01">Inicio venta</label>
     					<div class="row m-0">

     						<input name="ticketStart[]"  value="<?if(isset($publicTicketStart)){ echo $publicTicketStart;  }?>" type="text" id="ticketStart" class="ticketStart form-control form-custom-1 col-12 hasDatepicker datetimepicker-input" placeholder="Fecha" >
     						<i class="fas fa-calendar-alt calendarIcon col-1"></i>
     					</div>
     					<? if(isset($ticketStart_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketStart_01Error?></strong></span><? endif; ?>

     		        </td>

     		        <td style="position: relative;">

     					<label class="font-weight-bold" for="inputTicketEnd_01">Término venta</label>
     					<div class="row m-0">

     						<input name="ticketEnd[]" value="<?if(isset($publicTicketEnd)){ echo $publicTicketEnd;  }?>" type="text" id="ticketEnd" class="ticketEnd form-control form-custom-1 col-12 hasDatepicker datetimepicker-input" placeholder="Fecha">
     						<i class="fas fa-calendar-alt calendarIcon col-1"></i>
     					</div>
     					<? if(isset($ticketEnd_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketEnd_01Error?></strong></span><? endif; ?>

     		        </td>
     		        <td>
     		            <!--<input type="button" value="Borrar" />-->
     		        </td>
     		    </tr>

         <? endfor; ?>
       <? else: ?>
  		    <tr>
  		        <td>
  		        	<label class="font-weight-bold" for="inputTicketName_01">Nombre Entrada</label>
  					<input name="ticketName[]" value="<?if(isset($ticketName_01)){ echo $ticketName_01;  }?>" type="text" class="form-control form-custom-1" id="ticketName_01" aria-describedby="valueHelpBlock" placeholder="Ej: General">
  					<? if(isset($ticketName_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketName_01Error?></strong></span><? endif; ?>
  		        </td>
  		        <td>
  		        	<label class="font-weight-bold" for="inputTicketValue_01">Valor Entrada</label>
  					<input name="ticketValue[]" value="<?if(isset($ticketValue_01)){ echo $ticketValue_01;  }?>" type="text" class="form-control form-custom-1" id="ticketValue_01" aria-describedby="valueHelpBlock" placeholder="Ej: $2.500">

  					<? if(isset($ticketValue_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketValue_01Error?></strong></span><? endif; ?>
  		        </td>
  		        <td width="10%">
  		            <label class="font-weight-bold" for="inputTicketAudience_01">Cantidad</label>
  					<input name="ticketAudience[]" value="<?if(isset($ticketAudience_01)){ echo $ticketAudience_01;  }?>" type="text" class="form-control form-custom-1 col-12" id="ticketAudience_01" aria-describedby="valueHelpBlock" placeholder="">
  					<? if(isset($ticketAudience_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketAudience_01Error?></strong></span><? endif; ?>
  		        </td>
  		        <td style="position: relative;">
  					<label class="font-weight-bold" for="inputTicketStart_01">Inicio venta</label>
  					<div class="row m-0">

  						<input name="ticketStart[]"  value="<?if(isset($ticketStart_01)){ echo $ticketStart_01;  }?>" type="text" id="ticketStart" class="ticketStart form-control form-custom-1 col-12 hasDatepicker datetimepicker-input"  placeholder="Fecha" >
  						<i class="fas fa-calendar-alt calendarIcon col-1"></i>
  					</div>
  					<? if(isset($ticketStart_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketStart_01Error?></strong></span><? endif; ?>

  		        </td>

  		        <td style="position: relative;">

  					<label class="font-weight-bold" for="inputTicketEnd_01">Término venta</label>
  					<div class="row m-0">

  						<input name="ticketEnd[]" value="<?if(isset($ticketEnd_01)){ echo $ticketEnd_01;  }?>" type="text" id="ticketEnd" class="ticketEnd form-control form-custom-1 col-12 hasDatepicker datetimepicker-input"  placeholder="Fecha">
  						<i class="fas fa-calendar-alt calendarIcon col-1"></i>
  					</div>
  					<? if(isset($ticketEnd_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketEnd_01Error?></strong></span><? endif; ?>

  		        </td>
  		        <td>
  		            <!--<input type="button" value="Borrar" />-->
  		        </td>
  		    </tr>
        <? endif; ?>

		</table>
    	<a id="crearEventoPresencialTablaButton" class="icon" style="cursor:pointer;"> <i class="fas fa-plus-circle h5"></i>  agregar más entradas. </a>
      </div>
    </div>
	<hr>


			<div class="row">

		    	<div class="form-group col-md-12">

		      		<label class="font-weight-bold" for="inputEventFile">Imagen Promocional del Evento</label><br>
							<label class="btn btn-primary" for="my-file-selector">
					    <input name="file-input" id="my-file-selector" type="file" style="display:none"
					    onchange="$('#upload-file-info').html(this.files[0].name)">
					    Seleccionar Archivo
					</label>
					<span class='label label-info' id="upload-file-info"></span>

					<a href="" data-toggle="modal" data-target="#kitDigitalModal" data-toggle="tooltip" data-placement="top" title="Utiliza estos logos para tus graficas"> Descarga logos EchoMusic </a>

					<small id="valueHelpBlock" class="form-text text-muted">Dimensiones óptimas 1080x1080 - Peso máximo 5 mb</small>

					<? if(isset($publicImageEventError)): ?>
            <span class="text-danger"><strong class="alert"><?=$publicImageEventError?></strong></span>
          <? elseif(isset($errTyp) && $errTyp =='danger'): ?>
            <span class="text-danger"><strong class="alert">Por favor vuelve a cargar la imagen</strong></span>
          <? endif; ?>


		   		</div>
			</div>
			<div class="row">
				<div class="form-group col-md-8">
		      		<label class="font-weight-bold" for="inputEventVideo">Video Promocional del Evento (Opcional)</label><br>
						<div class="row">
							<div class="col-md-8">
								<input name="eventVideo" type="text" class="form-control form-custom-1" id="inputEventVideo" value="<?if(isset($audioURLraw)){ echo $audioURLraw;  }?>" placeholder="https://www.youtube.com/watch?v=123456798">
                <? if(isset($videoError)): ?><span class="text-danger"><strong class="alert"><?=$videoError?></strong></span><? endif; ?>
							</div>
						</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="form-group col-md-8">

			    	<label class="font-weight-bold" for="inputEventDesc">Descripción del Evento</label>
			    	<textarea name="eventDesc" class="form-control form-custom-1" id="inputEventDesc" placeholder="Mínimo 50 caracteres - La descripción es muy importante para atraer a los usuarios y explicar el evento" rows="6"><?if(isset($eventDesc)){ echo str_replace('\r\n', "\n", str_replace("\'","'",$eventDesc));   }?></textarea>

						<? if(isset($eventDescError)): ?><span class="text-danger"><strong class="alert"><?=$eventDescError?></strong></span><? endif; ?>

			  	</div>
		  	</div>
			<div class="row">

				<div class="col-md-12 my-3">

					<div class="form-check">

					  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">

					  <label class="form-check-label" for="defaultCheck1" id="defaultCheck1Label">

					    He leído los <a href="" data-toggle="modal" data-target="#conditionsEventsModal">términos y condiciones</a>

					  </label>

					</div>

				</div>
			</div>
			<div class="row my-2">
				<div class="offset-md-4 col-md-4 text-center">

					<button name="submitPublicEvent" id="submitPublicEvent" type="submit" class="btn btn-primary my-2">Crear Evento</button>
					<a href="" class="btn btn-secondary my-2">limpiar campos</a>

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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script> -->
			<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
			<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

			<script src="assets/js/ajaxChangeCities.js"></script>

			<script src="assets/js/jquery.imgareaselect.js" type="text/javascript"></script>

			<script src="assets/js/image_crop_save_evento.js"></script>

			<script src="assets/js/validatePublicCreate.js"></script>

      <script src="assets/js/jquery.charactercounter.js"></script>

      <script src="assets/js/jquery.mask.js"></script>

      <script src="assets/js/jquery.datetimepicker.full.js"></script>

      <script>
  			$("#inputEventDesc").characterCounter({
  				limit: '3000',
  				counterFormat: '%1 caracteres restantes'
  			});
  		</script>

      <script type="text/javascript">
 			 $(document).ready(function(){
 				 $('#inputEventValue').mask('000.000.000.000.000', {reverse: true});
 			 });
 		 </script>

			<? include 'resources/login_error_script.php'; ?>

      <? if($plsLogin==true): ?>
           <script>
             $(document).ready(function(){
               $('#loginModal').modal('show');
             });
           </script>
      <? endif; ?>


<!-- Footer -->

	<?php

		include 'resources/footer.php';

    include 'resources/conditionsEventsModal.php';

	 ?>
	 <script type="text/javascript">
   jQuery.datetimepicker.setLocale('es');
   jQuery('#startStreaming').datetimepicker({
      timepicker:false,
      format:'d-m-Y'
    });
   jQuery('.ticketStart').datetimepicker({

      format:'d-m-Y H:i'
    });
   jQuery('.ticketEnd').datetimepicker({

      format:'d-m-Y H:i'
    });

	 	// $(function () {
    //   $('#crearEventoPresencialTabla').on('focus',".ticketStart", function(){
    //       $(this).datetimepicker({
		// 		    format:'d-m-Y H:i',
		// 		    // icons:{
		// 		    // time:'far fa-clock'
		// 		    // }
		// 		 });
		// 	 });
    //
    //    $('#crearEventoPresencialTabla').on('focus',".ticketEnd", function(){
    //      $(this).datetimepicker({
		// 		    format:'d-m-Y H:i',
		// 		    // icons:{
		// 		    // time:'far fa-clock'
		// 		    // }
		// 	    });
		//     });
    //   });
	 </script>

	 <script>
	 	$("#editEventPhotoModal").on('hidden.bs.modal', function () {
				$(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
			});
	 	$('#inputPaymentEvent').on('change', function() {
	 		var target = $(this).val();

			if(target == "1"){
		    	$('#crearEventoPresencialTabla-id').css("display", "none");
		    	$('#ColAudienceEvent').css("display", "block");
		    	//$('#crearEventoPresencialTabla').remove();
			}else if(target == "2"){
		    	$('#crearEventoPresencialTabla-id').css("display", "block");
		    	$('#ColAudienceEvent').css("display", "none");
		    	//$('#crearEventoPresencialTabla-id').append('<table id="crearEventoPresencialTabla" >');
		    	//$('#crearEventoPresencialTablaButton').trigger("click");
			}else{
			}
		})
		$('#crearEventoPresencialTabla').on('click', 'a', function () {
		    $(this).closest('tr').remove();
		})
		$('#crearEventoPresencialTablaButton').click(function () {

			var inputRow = '<td>'+
		        	'<label class="font-weight-bold" for="inputTicketName_01">Nombre Entrada</label>'+
					'<input name="ticketName[]" value="<?if(isset($ticketName_01)){ echo $ticketName_01;  }?>" type="text" class="form-control form-custom-1" id="ticketName_01" aria-describedby="valueHelpBlock" placeholder="Ej: General">'+
					'<? if(isset($ticketName_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketName_01Error?></strong></span><? endif; ?>'+
		        '</td><td>'+
		        	'<label class="font-weight-bold" for="inputTicketValue_01">Valor Entrada</label>'+
					'<input name="ticketValue[]" value="<?if(isset($ticketValue_01)){ echo $ticketValue_01;  }?>" type="text" class="form-control form-custom-1" id="ticketValue_01" aria-describedby="valueHelpBlock" placeholder="Ej: $2.500">'+

					'<? if(isset($ticketValue_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketValue_01Error?></strong></span><? endif; ?>
		        </td> <td>'+
		            '<label class="font-weight-bold" for="inputTicketAudience_01">Cantidad</label>'+
					'<input name="ticketAudience[]" value="<?if(isset($ticketAudience_01)){ echo $ticketAudience_01;  }?>" type="text" class="form-control form-custom-1 col-12" id="ticketAudience_01" aria-describedby="valueHelpBlock" placeholder="">'+
					'<? if(isset($ticketAudience_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketAudience_01Error?></strong></span><? endif; ?>
		        </td><td style="position: relative;">'+
					'<label class="font-weight-bold" for="inputTicketStart_01">Inicio venta</label>'+
					'<div class="row m-0">'+
						'<input name="ticketStart[]"  value="<?if(isset($ticketStart_01)){ echo $ticketStart_01;  }?>" type="text" id="ticketStart" class="ticketStart form-control form-custom-1 col-12 hasDatepicker datetimepicker-input"  placeholder="Fecha">'+
						'<i class="fas fa-calendar-alt calendarIcon col-1"></i>'+
					'</div>'+
					'<? if(isset($ticketStart_01Error)): ?><span class="text-danger"><strong class="alert"><?=$ticketStart_01Error?></strong></span><? endif; ?> </td><td style="position: relative;">'+

					'<label class="font-weight-bold" for="inputTicketEnd_01">Término venta</label>'+
					'<div class="row m-0">'+
						'<input name="ticketEnd[]" value="<?if(isset($ticketEnd_01)){ echo $ticketEnd_01;  }?>" type="text" id="ticketEnd" class="ticketEnd form-control form-custom-1 col-12 hasDatepicker datetimepicker-input" placeholder="Fecha">'+
						'<i class="fas fa-calendar-alt calendarIcon col-1"></i>'+
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
		// 	$("#startStreaming").datepicker({
		// 		minDate: 0,
    //
		// 	});
		// });
	</script>

  <script>
    $(document).ready(function(){
        var valueRegion = $('#inputRegion').val();

         $.ajax({

           type: "POST",
           url: 'resources/changeCities.php',
           data: "region="+valueRegion,
           dataType: 'html',
           cache: false,
           beforeSend: function() {

          },
           success: function(data) {
                 //
                $('#inputCity').html(data);
           },
            error: function(req, err){ console.log(data); }

         });
    });
  </script>

  <? if(isset($errTyp) && $errTyp =='danger'): ?>
    <script type='text/javascript'>alert('<?=$errMSG?>');</script>
  <? endif; ?>

  <? if(isset($_SESSION['success'])): ?>
    <script type='text/javascript'>alert('<?=$_SESSION['success']?>');</script>
    <? unset($_SESSION['success']) ?>
    <? unset($_SESSION['selectedCity']) ?>
  <? endif; ?>

  <? include 'resources/googleLoginScript.php'; ?>
	</body>

</html>
