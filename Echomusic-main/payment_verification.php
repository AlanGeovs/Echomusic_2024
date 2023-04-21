<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
if(!empty($_GET['token_ws']) || !empty($_POST['token_ws']) || !empty($_GET['TBK_TOKEN']) || !empty($_POST['TBK_TOKEN']) || !empty($_GET['TBK_ID_SESION']) || !empty($_POST['TBK_ID_SESION'])){
	include 'resources/webpay_notification_script.php';
}elseif(empty($_GET['token_ws'])){
	include 'resources/payment_verification_script.php';
}
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

		<title>EchoMusic | Verificación de pago <?=$nameArtist?></title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>
		<? include_once("resources/Analytics.php"); ?>
	</head>

	<body>



      <!-- Main Content -->

	<main role="main">

	<div id="pagoConfirmado" class="container" style="min-height:100vh;">

		<!-- Head Banner reutilizacion de css -->

		<div class="row" id="registerHeader">

			<div class="col-md-12 text-center">

				<img src="images/logo_brand_5.png" alt="EchoMusic">

			</div>
			<div class="col-md-12 text-center hr-class">
				<hr>
			</div>

		</div>



			<!--  notification -->

			<div class="row mt-4" id="pagoConfirmado">
		    <div class="text-center col-md-12 align-self-center">
			    <h2><?php if(isset($errTyp)){ echo $errMSG; }?></h2>
			</div>
		    <div class="text-center offset-md-3 col-md-6 align-self-center">
					<?php
						switch($errTyp){
							case 'success':
								if($_GET['crowdfunding']){
									echo
									'<p>El pago de tu patrocinio ha sido realizado exitosamente.</p>
										<p>Has hecho un aporte importantísimo para el desarrollo musical.
											Agradecemos tu aporte y esperamos que disfrutes el resultado de este proyecto.</p>
									<i class="far fa-check-circle"></i>;';
								}elseif($_GET['event']){
									echo
										'<p>El pago de tu evento ha sido <strong>realizado exitosamente</strong>.</p>
										<i class="far fa-check-circle"></i>';
								}else{
									echo
										'<p>El pago de tu evento ha sido <strong>realizado exitosamente</strong>, enviaremos un <strong>correo electrónico con tu entrada digital</strong>, la cuál también puedes <strong>descargar desde tu historial de compras en el panel de control</strong>.</p>
										<i class="far fa-check-circle"></i>';
								}
							break;
							case 'waiting':
								if($_GET['crowdfunding']){
									echo
										'<p>El pago de tu patrocinio esta siendo verificado, por favor espere...</p>
										<i class="far fa-clock"></i>';

								}else{
								echo
									'<p>El pago de tu evento esta siendo verificado, por favor espere...</p>
									<i class="far fa-clock"></i>';
								}
							break;
							case 'danger':
								if($_GET['crowdfunding']){
									echo
										'<p>El pago de tu patrocinio no pudo ser verificado. Si tiene dudas o problemas, contacte a soporte EchoMusic.</p>
										<i class="fas fa-times danger"></i>';
								}else{
								echo
									'<p>El pago de tu evento no pudo ser verificado. Si tiene dudas o problemas, contacte a soporte EchoMusic.</p>
									<i class="fas fa-times danger"></i>';
								}
							break;
						}


					?>
		    </div>

		  </div>

			<div class="row mt-4" id="pagoConfirmado">

				<div class="text-leftcenter col-md-8 offset-md-2 col-12 align-self-center">

					<h3 class="text-center" >Código de Transacción</h3>

				</div>
				<div class="text-center col-md-8 offset-md-2 col-12 align-self-center">

					<span id="reserveCode"><?php echo $paymentCode; ?></span>

				</div>


			</div>


		<? if(isset($webpayMethod)):?>
			<div class="row mt-4" id="pagoConfirmado">

				<div class="text-leftcenter col-md-8 offset-md-2 col-12 align-self-center">

					<h3 class="text-center">Comprobante de pago</h3>
							<table class="table table-comprobante" style="font-size: 12px;">
							  <tbody>
							    <tr>
							      <th scope="row">Número de orden de pedido</th>
							      <td><?=$transactionCode?></td>
							    </tr>
							    <tr>
							      <th scope="row">Monto y moneda de la transacción</th>
							      <td><?=$eventValueTotal?></td>
							    </tr>
							    <tr>
							      <th scope="row">Tipo de pago realizado (Débito,Crédito o Prepago)</th>
							      <td><?=$cardType?></td>
							    </tr>
							    <tr>
							      <th scope="row">Cantidad de cuotas</th>
							      <td><?=$cuotas?></td>
							    </tr>
							    <tr>
							      <th scope="row">Monto de cada cuota</th>
							      <td><?=$valorCuota?></td>
							    </tr>
							    <tr>
							      <th scope="row">Descripción de los bienes y/o servicios</th>
										<? if($_GET['crowdfunding']): ?>
							      	<td>1 Patrocinio</td>
										<? else: ?>
											<td>
												<? if(isset($ntickets)): ?>
													<? if($ntickets=='1'): ?>
														1 Entrada
													<? elseif($ntickets>'1'): ?>
													<?=$ntickets?> Entradas
													<? endif; ?>
												<? else: ?>
													1 Entrada
												<? endif; ?>
											</td>
										<? endif; ?>
							    </tr>
							  </tbody>
							</table>


				</div>

			</div>
		<? endif; ?>

			<? if(!empty($_GET['event'])): ?>
			<!--  data -->

			<div class="row justify-content-center mt-5" id="pagoDataValidation">


			</div>

			<? endif; ?>



			<!-- Reserve Button -->



			<div class="row justify-content-center mt-5">

				<div class="col-md-3 text-center mt-1">

					<a class="btn btn-outline-secondary btn-block btn-lg" href="index.php">Inicio EchoMusic</a>

				</div>

				<div class="col-md-3 text-center mt-1">

					<a class="btn btn-primary btn-block btn-lg" href="dashboard.php">Panel de Control</a>

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

			<script src="https://www.google.com/recaptcha/api.js" async defer></script>

			<? include 'resources/login_error_script.php'; ?>

			<? include 'resources/googleLoginScript.php'; ?>



	</body>

</html>
