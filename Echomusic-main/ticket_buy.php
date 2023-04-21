<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';
if(isset($_GET['streaming'])){
	include 'resources/streaming_ticket_script.php';
}else if(isset($_GET['public'])){
	include 'resources/presencial_ticket_script.php';
}else if(isset($_GET['private'])){
	include 'resources/private_pay_script.php';
}

?>

<!DOCTYPE HTML>

<html>

	<head>

		<title>Portal de pago - EchoMusic</title>

		<meta charset="utf-8" />
		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Crea tu evento EchoMusic streaming o presencial y monetiza tu talento." />

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

	 <div id="eventPayMainBanner" class="jumbotron bg-dark" style="background-image: linear-gradient(to top, rgba(50, 50, 50, 0.8), rgba(0, 1, 13, 0.5)), url('../../images/ IMG PORTAL DE PAGO">

		 <div class="container text-center text-white"> </div>

	 </div>



<!-- Name and Share -->

	 <div class="wt-80" id="eventHeaderShare">

		 <div class="row justify-content-between">

			 <div class="col-md-6 col-6 first-block">

			 	<nav aria-label="breadcrumb" id="eventBreadcrumb">

				  <ol class="breadcrumb mb-0">

				    <li class="breadcrumb-item"><a href="<?=$breadCrumbUrl?>">Anterior</a></li>

				    <li class="breadcrumb-item active" aria-current="page">Portal de pago</li>

				  </ol>

				</nav>

			</div>

			<div class="col-md-6 col-6 text-right second-block">

			</div>

		 </div>

	 </div>

		<!-- Container -->
		<div class="container">
			<div class="row mt-4" id="eventDetailInfo">
				<div class="col-md-6">
					<h2 class="mt-0 mb-0">Portal de pago</h2>
					<h3 class="mt-0 mb-0"><?=$arrayEventData['name_event']?></h3>
				</div>
			</div>

			<hr>
<!-- Form data -->
<? if(isset($_SESSION['method'])): ?>
			<div id="" class="container ">
				<div class="row my-5">
				  	<div class="col-md-6">
					  	<div id="datosEntradaPago" class="">

								<? if(isset($_GET['public'])): ?>
									<p><strong>Datos de la entrada:</strong></p>
									<ul class="list-group">
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<!-- <p><?=$userDataTransaction['subscribe_fname']?></p> -->
											<p>Nombre: <?=$fname?></p>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<!-- <p><?=$userDataTransaction['subscribe_lname']?></p> -->
											<p>Apellido: <?=$lname?></p>
										</li>

										<li class="list-group-item d-flex justify-content-between align-items-center">
											<!-- <p><?=$userDataTransaction['subscribe_rut']?></p> -->
											<p>RUT: <?=$rut?></p>
										</li>

										<li class="list-group-item d-flex justify-content-between align-items-center">
											<!-- <p><?=$userDataTransaction['subscribe_email']?></p> -->
											<p>E-Mail: <?=$email?></p>
										</li>

										<li class="list-group-item d-flex justify-content-between align-items-center">
											
											<p>Cantidad entradas: <?=$totalTickets?></p>
										</li>
									</ul>

									<p><strong>Valores:</strong></p>
									<ul class="list-group">
										<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
											Sub total:
											<span class="font-weight-bold">$ <?=number_format($totalPlan , 0, ',', '.')?></span>
										</li>
											<li id="itemdatosEntradaPago"  class="list-group-item d-flex justify-content-between align-items-center">
											Costo por servicio
											<span class="font-weight-bold">$ <?=number_format($totalCommission , 0, ',', '.')?></span>
										</li>
										<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
											Total:
											<span class="font-weight-bold">$ <?=number_format($totalTransaction , 0, ',', '.')?></span>
										</li>
									</ul>
								<? elseif(isset($_GET['streaming'])): ?>
									<p><strong>Datos de la suscripción:</strong></p>
									<ul class="list-group">
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<!-- <p><?=$userDataTransaction['subscribe_fname']?></p> -->
											<p>Nombre: <?=$arrayDataUser['first_name_user']?></p>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<!-- <p><?=$userDataTransaction['subscribe_lname']?></p> -->
											<p>Apellido: <?=$arrayDataUser['last_name_user']?></p>
										</li>

										<li class="list-group-item d-flex justify-content-between align-items-center">
											<!-- <p><?=$userDataTransaction['subscribe_email']?></p> -->
											<p>E-Mail: <?=$arrayDataUser['mail_user']?></p>
										</li>

										<li class="list-group-item d-flex justify-content-between align-items-center">
											<p>Cantidad entradas: 1</p>
										</li>
									</ul>

									<p><strong>Valores:</strong></p>
									<ul class="list-group">
										<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
											Sub total:
											<span class="font-weight-bold">$ <?=number_format($amountPlan , 0, ',', '.')?></span>
										</li>
										<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
											Donativo:
											<span class="font-weight-bold">$ <?=number_format($addedValue , 0, ',', '.')?></span>
										</li>
											<li id="itemdatosEntradaPago"  class="list-group-item d-flex justify-content-between align-items-center">
											Costo por servicio
											<span class="font-weight-bold">$ <?=number_format($amountCommission+$addedValueFee , 0, ',', '.')?></span>
										</li>
										<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
											Total:
											<span class="font-weight-bold">$ <?=number_format($totalTransaction , 0, ',', '.')?></span>
										</li>
									</ul>
								<? elseif(isset($_GET['private'])): ?>

									<p><strong>Datos de la contratación:</strong></p>
									<ul class="list-group">
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<p>Nombre: <?=$arrayDataUser['first_name_user']?></p>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<p>Apellido: <?=$arrayDataUser['last_name_user']?></p>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<p>E-Mail: <?=$arrayDataUser['mail_user']?></p>
										</li>

									</ul>

									<p><strong>Valores:</strong></p>
									<ul class="list-group">
										<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
											Valor contratación:
											<span class="font-weight-bold">$ <?=number_format($amountPlan , 0, ',', '.')?></span>
										</li>
											<li id="itemdatosEntradaPago"  class="list-group-item d-flex justify-content-between align-items-center">
											Costo por servicio
											<span class="font-weight-bold">$ <?=number_format($amountCommission , 0, ',', '.')?></span>
										</li>
										<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
											Total:
											<span class="font-weight-bold">$ <?=number_format($totalTransaction , 0, ',', '.')?></span>
										</li>
									</ul>
								<? endif; ?>

					  	</div>
					</div>
				  	<div class="col-md-6 justify-content-between align-items-center mt-3">
						<p><strong>Usted será dirigido(a) al medio de pago seleccionado para completar la transacción.</strong></p>

						<? switch($_SESSION['method']):case '1':?>
									<form method="post" action="<?=$_SESSION['url']?>">
		                <input type="hidden" name="token_ws" value="<?=$_SESSION['token']?>" />
		                <input type="submit" class="btn btn-primary btn-block w-50 mx-auto my-3 btn-lg" value="Ir a pagar" />
		              </form>
									<? unset($_SESSION['method']);?>
									<? unset($_SESSION['url']);?>
									<? unset($_SESSION['token']);?>
							<? break; ?>

							<? case '2': ?>
								<a href="<?=$_SESSION['url']?>" class="btn btn-primary btn-block w-50 mx-auto my-3 btn-lg">Ir a pagar</a>
								<? unset($_SESSION['method']);?>
								<? unset($_SESSION['url']);?>
							<? break; ?>

						<? endswitch;	?>

					</div>
				</div>
			</div>
		<!-- End form data -->
<? else: ?>
		<!-- Check data and payment -->
			<div id="" class="container ">
				<form action="" method="POST">
				<div class="row my-5">

				  	<div class="col-md-6">
							<? if(isset($_GET['public'])): ?>
							<!-- Formulario eventos Presenciales -->
					  	<div id="datosEntradaPago" class="">
								<p><strong>Ingrese sus datos:</strong></p>
								<ul class="list-group">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<input placeholder="Nombre" type="text" name="fname" value="<?=(isset($fname)) ? $fname : '' ?>" class="form-control">
									</li>
									<? if(isset($fnameError)): ?><span class="text-danger"><strong class="alert"><?=$fnameError?></strong></span><? endif; ?>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<input placeholder="Apellido" type="text" name="lname" value="<?=(isset($lname)) ? $lname : '' ?>" class="form-control">
									</li>
									<? if(isset($lnameError)): ?><span class="text-danger"><strong class="alert"><?=$lnameError?></strong></span><? endif; ?>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<input id="inputRut" placeholder="RUT" type="text" name="rut" value="<?=(isset($rut)) ? $rut : '' ?>" class="form-control">
									</li>
									<? if(isset($rutError)): ?><span class="text-danger"><strong class="alert"><?=$rutError?></strong></span><? endif; ?>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<input placeholder="Correo electrónico" type="email" name="email" value="<?=(isset($email)) ? $email : '' ?>" class="form-control">
									</li>
									<? if(isset($emailError)): ?><span class="text-danger"><strong class="alert"><?=$emailError?></strong></span><? endif; ?>
<!--
									<li class="list-group-item d-flex justify-content-between align-items-center">
				<?/* foreach($ticketsDataArray as $ticketsData): ?>
										<?=$ticketsData['ticket_name']?>

										<? if(time()<strtotime($ticketsData['ticket_dateStart']) || time()>strtotime($ticketsData['ticket_dateEnd'])){
											$ticketDisabled = true;
										}?>
										$ <?=number_format($ticketsData['ticket_value'] , 0, ',', '.')?>

										<select id="inputEntries" name="nTicket[<?=$ticketsData['id_ticket']?>]" class="form-control" <?=isset($ticketDisabled) ? 'disabled readonly' : ''?>>
											<? if($paymentEvent==1): ?>

												<?for($i=1; $i<=2; $i++):?>
												<? $selected = ($entries == $i) ? "selected" : "" ?>
													<option  value="<?=$i?>" <?=$selected?>><?=$i?></option>
													<? unset($selected); ?>
												<?endfor;?>

											<? else: ?>

												<?for($i=0; $i<=10; $i++):?>
												<? $selected = ($entries == $i) ? "selected" : "" ?>
													<option  value="<?=$i?>" <?=$selected?>><?=$i?></option>
													<? unset($selected); ?>
												<?endfor;?>

											<? endif; ?>
										</select>

									<? endforeach; ?>

									</li>

									<? if(isset($nTicketsError)): ?><span class="text-danger"><strong class="alert"><?=$nTicketsError?></strong></span><? endif; */?>
								-->
								</ul>

<div class="row my-5">
    <div id="tiposEntradaTabla-id" class="form-group col-md-12">
      	 <table id="tiposEntradaTabla" >
		    <tr>
		    	<th>Nombre Entrada</th>
		    	<th>Valor</th>
		    	<th>Cantidad</th>
		    </tr>
     	<? foreach($ticketsDataArray as $ticketsData): ?>
		    <tr>
		        <td>
		        	<?=$ticketsData['ticket_name']?>
		        </td>
		        <td>
		        	<?
							if(time()<strtotime($ticketsData['ticket_dateStart']) || time()>strtotime($ticketsData['ticket_dateEnd'])){
								$ticketDisabled = true;
							}
							$k = $ticketsData['id_ticket'];
							$queryAudience = mysqli_query($conn, "SELECT COUNT(*) FROM subscribes_public WHERE id_ticket='$k' AND subscribe_status='1'");
			        $countAudience = mysqli_fetch_assoc($queryAudience)['COUNT(*)'];
			        $totalAudience = $ticketsData['ticket_audience'];

			        $ticketsAvailable = $totalAudience-$countAudience;

			        $arrayTickets[$k] = $nTickets;

			      // Check entradas disponibles
			        if($ticketsAvailable<=$nTickets){
			          $ticketUnavailable = true;
			        }

							?>
					$ <?=number_format($ticketsData['ticket_value'] , 0, ',', '.')?>
					<input id="valor_<?=$ticketsData['id_ticket']?>" type="hidden" value="<?=$ticketsData['ticket_value']?>" class="inputHiddenSelect">
					<input id="comision_<?=$ticketsData['id_ticket']?>" type="hidden" value="<?=$ticketsData['ticket_commission']?>" class="inputHiddenSelectComision">
		        </td>
		        <td>
		        	<select id="inputEntries" name="nTicket[<?=$ticketsData['id_ticket']?>]" class="form-control cantidadTicketSelect" <?if(isset($ticketDisabled)): echo 'disabled'; elseif(isset($ticketUnavailable)): echo 'disabled'; else: endif;?>>
						<? if($paymentEvent==1): ?>

									<?for($i=1; $i<=2; $i++):?>
										<? $selected = ($entries == $i) ? "selected" : "" ?>
											<option  value="<?=$i?>" <?=$selected?>><?=$i?></option>
										<? unset($selected); ?>
									<?endfor;?>

								<? else: ?>

									<? if(isset($ticketDisabled)): ?>
												<option value="">No disponible</option>
									<? unset($ticketDisabled); ?>
									<? elseif(isset($ticketUnavailable)): ?>
												<option value="">Agotadas</option>
									<? unset($ticketUnavailable); ?>
									<? else: ?>
										<?for($i=0; $i<=10; $i++):?>
											<? $selected = ($entries == $i) ? "selected" : "" ?>
												<option  value="<?=$i?>" <?=$selected?>><?=$i?></option>
											<? unset($selected); ?>
										<?endfor;?>

								<? endif; ?>

						<? endif; ?>
					</select>
		        </td>
		    </tr>
		<? endforeach; ?>
		<? if(isset($nTicketsError)): ?><span class="text-danger"><strong class="alert"><?=$nTicketsError?></strong></span><? endif; ?>
		</table>
    </div>

</div>

								<p><strong>Valores:</strong></p>
								<ul class="list-group">
									<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
										Sub total:
										<span class="font-weight-bold">$ <span id="entradaSpanPublic"><?=number_format($amountPlan , 0, ',', '.')?></span></span>
										<input type="hidden" id="entradaInputPublic" value="">
									</li>
										<li id="itemdatosEntradaPago"  class="list-group-item d-flex justify-content-between align-items-center">
										Costo por servicio
										<span class="font-weight-bold">$ <span id="feeSpanPublic"><?=number_format($amountCommission , 0, ',', '.')?></span></span>
										<input type="hidden" id="feeInputPublic" value="">
									</li>
									<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
										Total:
										<span class="font-weight-bold">$ <span id="totalSpanPublic"><?=number_format($totalTransaction , 0, ',', '.')?></span></span>
										<input type="hidden" id="totalInputPublic" value="">
									</li>
								</ul>
					  	</div>
						<? elseif(isset($_GET['streaming'])): ?>
							<!-- Formulario eventos Streaming -->
							<div id="datosEntradaPago" class="">
							<p><strong>Datos de la entrada:</strong></p>
							<ul class="list-group">
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<p>Nombre: <?=$arrayDataUser['first_name_user']?></p>
								</li>

								<li class="list-group-item d-flex justify-content-between align-items-center">
									<p>Apellido: <?=$arrayDataUser['last_name_user']?></p>
								</li>

								<li class="list-group-item d-flex justify-content-between align-items-center">
									<p>E-Mail: <?=$arrayDataUser['mail_user']?></p>
								</li>

								<li class="list-group-item d-flex justify-content-between align-items-center">
									<input placeholder="Donativo al artista" id="inputAddedValue" type="text" name="addedValue" value="<?=(isset($addedValue)) ? $addedValue : '' ?>" class="form-control">
								</li>
								<? if(isset($addedValueError)): ?><span class="text-danger"><strong class="alert"><?=$addedValueError?></strong></span><? endif; ?>

							</ul>
							<p><strong>Valores:</strong></p>
							<ul class="list-group">
								<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
									Sub total:
									<span class="font-weight-bold">$ <span id="entradaSpan"><?=number_format($amountPlan , 0, ',', '.')?> </span> </span>
								</li>
									<li id="itemdatosEntradaPago"  class="list-group-item d-flex justify-content-between align-items-center">
									Costo por servicio
									<span class="font-weight-bold">$ <span id="feeSpan"><?=number_format($amountCommission+$addedValueFee , 0, ',', '.')?></span></span>
								</li>
								<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
									Total:
									<span class="font-weight-bold">$ <span id="totalSpan"><?=number_format($totalTransaction , 0, ',', '.')?></span></span>
								</li>
							</ul>
					  	</div>
							<? elseif(isset($_GET['private'])): ?>
								<!-- Formulario eventos privados -->
								<div id="datosEntradaPago" class="">
								<p><strong>Datos del contratante:</strong></p>
								<ul class="list-group">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<p>Nombre: <?=$arrayDataUser['first_name_user']?></p>
									</li>

									<li class="list-group-item d-flex justify-content-between align-items-center">
										<p>Apellido: <?=$arrayDataUser['last_name_user']?></p>
									</li>

									<li class="list-group-item d-flex justify-content-between align-items-center">
										<p>E-Mail: <?=$arrayDataUser['mail_user']?></p>
									</li>

								</ul>
								<p><strong>Valores:</strong></p>
								<ul class="list-group">
									<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
										Valor contratación:
										<span class="font-weight-bold">$  <span id="entradaSpan"><?=number_format($amountPlan , 0, ',', '.')?> </span> </span>
									</li>
										<li id="itemdatosEntradaPago"  class="list-group-item d-flex justify-content-between align-items-center">
										Costo por servicio
										<span class="font-weight-bold">$ <span id="feeSpan"><?=number_format($amountCommission+$addedValueFee , 0, ',', '.')?></span></span>
									</li>
									<li id="itemdatosEntradaPago" class="list-group-item d-flex justify-content-between align-items-center">
										Total:
										<span class="font-weight-bold">$ <span id="totalSpan"><?=number_format($totalTransaction , 0, ',', '.')?></span></span>
									</li>
								</ul>
						  	</div>
							<? endif; ?>

							<div id="subscribeContainer" style="display:none;">
							<? if(isset($audienceComplete)): ?>
								<button class="btn btn-primary btn-block w-50 mx-auto my-3 isDisabled">Entradas agotadas</button>
							<? else: ?>
								<input type="submit" name="submit_data" class="btn btn-primary btn-block w-50 mx-auto my-3" value="Suscribirme">
							<? endif; ?>
							</div>
					</div>

				<!-- contenedor métodos de pago -->

			  	<div id="methodsContainer" class="col-md-6 justify-content-between align-items-center mt-3">
						<p><strong>Seleccione su medio de pago.</strong></p>
						<div class="radioPagoEvento-img">
							<label>
								<input type="radio" name="method_payment" value="1">
								<img src="images/webpay.png" alt="">
							</label>
							<label>
								<input type="radio" name="method_payment" value="2">
								<img src="images/Logo_kiphu.png" alt="">
							</label>
						</div>
						<? if(isset($methodError)): ?><span class="text-danger"><strong class="alert"><?=$methodError?></strong></span><? endif; ?>
						<? if(isset($audienceComplete)): ?>
							<button class="btn btn-primary btn-block w-50 mx-auto my-3 isDisabled">Entradas agotadas</button>
						<? else: ?>
							<input type="submit" name="submit_data" class="btn btn-primary btn-block w-50 mx-auto my-3" value="Siguiente">
						<? endif; ?>
					</div>

				</div>
			</form>
			</div>
		<!-- End check data -->
<? endif; ?>
			<hr>

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

			<script src="assets/js/jquery.mask.js"></script>

			<script>
        $("input#inputRut").rut({formatOn: 'keyup', ignoreControlKeys: false})
      </script>



			<script type="text/javascript">

				$(document).ready(function(){
				  $('#inputAddedValue').mask('000.000.000.000.000', {reverse: true});
				});
			</script>

	<? if(isset($_GET['streaming'])): ?>
			<script>
				<? if($amountPlan=='0'): ?>
						$(document).ready(function(){
							$('#methodsContainer').hide();
							$('#subscribeContainer').show();
						});
				<? endif ?>
			</script>

			<script>
				var myFee = <?=$amountCommission+$addedValueFee?>;
				var myTotal = <?=$totalTransaction?>;
				var myTicket = <?=$amountPlan?>;
				$('#inputAddedValue').keyup(function(){
					var myStr = $('#inputAddedValue').val();
					var newStr = myStr.replace(/\./g, '');
			    	var firstValue  = Number(newStr);
					var calculatedFee = (firstValue/100)*10;
					var calculatedFee = calculatedFee+myFee;
					var calculatedTotal = calculatedFee+myTicket+firstValue;
					$('#feeSpan').html(Math.round(calculatedFee));
					$('#totalSpan').html(Math.round(calculatedTotal));

					if(myStr>0){
						$('#methodsContainer').show();
						$('#subscribeContainer').hide();
					}
					if(myStr<=0){
						$('#methodsContainer').hide();
						$('#subscribeContainer').show();
					}
				});
			</script>
	<? elseif(isset($_GET['public'])): ?>
			<script>
				<? if($paymentEvent=='1'): ?>
						$(document).ready(function(){
							$('#methodsContainer').hide();
							$('#subscribeContainer').show();
						});
				<? endif ?>
			</script>
			<script>
				const nombre_select = [];
				const valor_entrada = [];
				const fee_entrada = [];
				var index =0;


				var entradaInputPublic=0;
				var feeInputPublic=0;
				var totalInputPublic =0;
				var totalTicket = 0;
				var totalFee =0;
				var totalValor =0;
				var total = 0;
				var totalComision = 0;


				<? foreach($ticketsDataArray as $ticketsData): ?>
					index = <?=$ticketsData['id_ticket']?>;
					valor_entrada[index] = <?=$ticketsData['ticket_value']?>;
					fee_entrada[index] = <?=$ticketsData['ticket_commission']?>;
				<? endforeach; ?>


			 	$('.cantidadTicketSelect').change(function(){

      				var indexCadena = ($(this).attr("name")).match(/\[(.*)\]/).pop();
      				var cantidadTicket = $(this).val();

      				//var valorTicket = cantidadTicket * valor_entrada[indexCadena];

      				var valorTicket =0;
      				var valorComision =0;

      				var com = fee_entrada[indexCadena]*cantidadTicket;


					$('.cantidadTicketSelect').each(function(){
					  var cantidad=$(this).val();
					  var valor = $(this).parents('tr').find('.inputHiddenSelect').val();
					  var comision = $(this).parents('tr').find('.inputHiddenSelectComision').val();

					  total = ( Math.round(cantidad) * Math.round(valor) ) + Math.round(total);
					  totalComision = ( Math.round(cantidad) * Math.round(comision) ) + Math.round(totalComision);
					  //total = Math.round(valor) ;

					  console.log(cantidad + ' ' + valor+ ' total:'+ Math.round(total));
					  console.log(cantidad + ' ' + comision+ ' comision:'+ Math.round(totalComision));

					  valorTicket=valorTicket+Math.round(total);
					  valorComision=valorComision+Math.round(totalComision);

					  console.log(valorTicket);
					  console.log(valorComision);

					  total = 0;
					  totalComision = 0;
					});

      				 totalTicket = Math.round(valorTicket);
      				 totalFee = Math.round(valorComision);
      				 totalValor = Math.round(valorTicket+valorComision);

					entradaInputPublic=totalTicket;
					feeInputPublic=totalFee;
					totalInputPublic =totalValor;

					$('#entradaInputPublic').val(totalTicket);
					$('#feeInputPublic').val(totalFee);
					$('#totalInputPublic').val(totalValor);

					$('#entradaSpanPublic').html(totalTicket.toLocaleString('de-DE'));
					$('#feeSpanPublic').html(totalFee.toLocaleString('de-DE'));
					$('#totalSpanPublic').html(totalValor.toLocaleString('de-DE'));

      			});


				/*$('#inputEntries').change(function(){
			    	var firstValue  = Number(myStr);
					var calculatedFee = myFee*firstValue;
					var calculatedTicket = myTicket*firstValue;
					var calculatedTotal = calculatedTicket+calculatedFee;
					$('#feeSpan').html(Math.round(calculatedFee));
					$('#totalSpan').html(Math.round(calculatedTotal));
				});*/


			</script>
	<? endif; ?>

			<? include 'resources/login_error_script.php'; ?>

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

	<? include 'resources/footer.php'; ?>

	<? include 'resources/googleLoginScript.php'; ?>

	</body>

	<?php

	include 'resources/conditionsModal.php';
	include 'resources/privacyModal.php';

	?>

</html>
