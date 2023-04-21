<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';
include 'resources/crowdfunding/projectPayment_script.php';

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

		<title>EchoMusic | confirmacion</title>

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

	</head>

	<body>
	<main id="" role="main">

		<!-- Top Navbar -->

		<?php

			include 'resources/topNavbar.php';

		 ?>

<!-- Main Content -->

		<!-- Container -->

		<div class="container">

				<!-- Breadcrumb -->
				<nav aria-label="breadcrumb" id="searchBreadcrumb">
				  <ol class="breadcrumb mb-0">
				    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
				    <li class="breadcrumb-item active" aria-current="page"><a href="">Crowdfunding</a></li>
				  </ol>
				</nav>
				<div class="row proyecto-items proyecto-card">
					<div class="col-lg-8 col-md-8 col-sm-12">
						<h2>Resumen de contribución</h2>
					</div>
				</div>

				<!-- Inicio -->

			<div class="row proyecto-items proyecto-card">
				<div class="col-lg-7 col-md-7 col-sm-12">
					<div class="row proyecto-items proyecto-card">
					<!--<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="proyecto-item mb-30">
							<div class="proyecto-foto">
								<img class="proyecto-foto" src="images/crowdf/proyecto-01.jpg"  alt="Foto del portada proyecto">
							</div>
						</div>
					</div>-->
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="proyecto-item mb-30">
								<div class=" ">
									<em class="">Artista</em><br>
									<div class="author">
										<img src="https://qa.echomusic.cl/images/avatars/<?=$artistProjectArray['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$artistProjectArray['id_user'].'.jpg')?>" alt="Foto del nombre autor">
										<a class="" href="https://qa.echomusic.cl/profile.php?userid=<?=$artistProjectArray['id_user']?>"><?=$artistProjectArray['nick_user']?></a>
									</div>
									<p class="colabRating">
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="far fa-star"></span>
							  		</p>
									<a href="https://qa.echomusic.cl/proyecto.php?projectid=<?=$dataProjectArray['id_project']?>" class="font-weight-bold"><?=$dataProjectArray['project_title']?></a>
									<div class="proyecto-stats my-2 ">
										<div class="stats-value">
											<span class="value-title">Total recaudado: <span class="value">$<?=number_format($prBackersAmount , 0, ',', '.')?></span> de <span class="value">$<?=number_format($dataProjectArray['project_amount'] , 0, ',', '.')?></span></span>
											<span class="stats-percentage"><?=$prBackersPercentage?>%</span>
										</div>
										<div class="stats-bar" data-value="<?=$prBackersPercentage?>">
											<div class="bar-line" style="width: <?=$prBackersPercentage?>%;"></div>
										</div>
									</div>
									<span class="date"><i class="far fa-calendar-alt"></i>Hasta el <?getDayday($datetimeProjectEnd); ?> de <? getMonthYear($datetimeProjectEnd); ?></span>
								</div>
							</div>
						</div>
					</div>

			<? if(isset($_SESSION['method'])): ?>
					<div class="row proyecto-items proyecto-card">
						<div class="col-lg-8 col-md-8 col-sm-12">
							<h3 class="font-weight-bold">AGRADECIMIENTO</h3>
							<p>¡Estás a un paso de realizar un aporte importantísimo para el desarrollo musical de<b> <?=$artistProjectArray['nick_user']?> </b>!</p>
							<table class="table">
								<tbody>
									<tr>
										<th scope="row">Aporte</th>
										<td>-</td>
										<td>$<?=number_format($projectTierArray['tier_amount'] , 0, ',', '.')?></td>
									</tr>
									<tr>
										<th scope="row">Aporte adicional</th>
										<td>-</td>
										<td>$<?=number_format($prAdded , 0, ',', '.')?></td>
									</tr>
									<tr>
										<th scope="row">Costo servicio</th>
										<td>-</td>
										<td>$<?=number_format($prFee+$prAddedFee , 0, ',', '.')?></td>
									</tr>
									<tr>
										<th scope="row">Total</th>
										<td>-</td>
										<td class="font-weight-bold">$<span id="totalSpan"><?=number_format($projectTierArray['tier_amount']+$prAdded+$prFee+$prAddedFee , 0, ',', '.')?></span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="col-lg-5 col-md-5 col-sm-12">
						<div style="width: 100%;display: inline-block;position: sticky;top: 4rem;">
							<a class="recompensaCarousel-link" href="#" tabindex="0" style="">
								<label>
									<div class="card recompensaCarousel-Card">
									  <div class="card-body">
									  	<h2 class="text-center font-weight-bold">$<?=number_format($projectTierArray['tier_amount'] , 0, ',', '.')?></h2>
									    <p class="card-text font-weight-bold"><?=$projectTierArray['tier_title']?></p>
									    <p><?=nl2br($projectTierArray['tier_desc'])?></p>
									    <b>Incluye:</b>
									    <ul>
							          <?if($projectTierArray['t_reward_01']!=''):?><li><?=$projectTierArray['t_reward_01']?></li><?endif;?>
						          	<?if($projectTierArray['t_reward_02']!=''):?><li><?=$projectTierArray['t_reward_02']?></li><?endif;?>
						          	<?if($projectTierArray['t_reward_03']!=''):?><li><?=$projectTierArray['t_reward_03']?></li><?endif;?>
						          	<?if($projectTierArray['t_reward_04']!=''):?><li><?=$projectTierArray['t_reward_04']?></li><?endif;?>
							        </ul>
									  </div>
									</div>
								</label>
							</a>
						</div>
					</div>

				</div>
			</div>

		<div class="col-md-6 justify-content-between align-items-center">
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

				<? case '3': ?>
					<form method="POST" action="https://www.paygol.com/pay">
			        <input type="hidden" name="pg_serviceid" value="<?=$commerceCode?>">
			        <input type="hidden" name="pg_currency" value="<?=$currency?>">
			        <input type="hidden" name="pg_price" value="<?=$amount?>">
			        <input type="hidden" name="pg_custom" value="<?=$_SESSION['session_id']?>">
			        <input type="hidden" name="pg_return_url" value="<?=$return_url?>">
			        <input type="hidden" name="pg_cancel_url" value="<?=$return_url?>">
			        <input type="submit" class="btn btn-primary btn-block w-50 mx-auto my-3 btn-lg" value="Ir a pagar" />
			    </form>
					<? unset($_SESSION['method']);?>
					<? unset($_SESSION['session_id']);?>
				<? break; ?>

				<? endswitch;	?>

		</div>

			<? else: ?>
			<form id="form" action="" method="POST">
					<div class="row proyecto-items proyecto-card">
						<div class="col-lg-8 col-md-8 col-sm-12">
							<h3 class="font-weight-bold">AGRADECIMIENTO</h3>
							<p>¡Estás a un paso de realizar un aporte importantísimo para el desarrollo musical de<b> <?=$artistProjectArray['nick_user']?> </b>!
							</p>
							<table class="table">
								<tbody>
									<tr>
										<th scope="row">Aporte</th>
										<td>-</td>
										<td>$<?=number_format($projectTierArray['tier_amount'] , 0, ',', '.')?></td>
									</tr>
									<tr>
										<th scope="row">Aporte adicional</th>
										<td>-</td>
										<td><input id="inputAddedValue" placeholder="Donativo" type="text" name="addedValue" value="<?=(isset($addedValue)) ? $addedValue : '' ?>" class="form-control"></td>
									</tr>
									<tr>
										<th scope="row">Costo servicio</th>
										<td>-</td>
										<td>$<span id="feeSpan"><?=number_format($prFee , 0, ',', '.')?></span></td>
									</tr>
									<tr>
										<th scope="row">Total</th>
										<td>-</td>
										<td class="font-weight-bold">$<span id="totalSpan"><?=number_format($projectTierArray['tier_amount']+$prFee , 0, ',', '.')?></span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>

				<div class="col-lg-5 col-md-5 col-sm-12">
					<div style="width: 100%;display: inline-block;position: sticky;top: 4rem;">
						<a class="recompensaCarousel-link" href="#" tabindex="0" style="">
							<label>
								<div class="card recompensaCarousel-Card">
								  <div class="card-body">
								  	<h2 class="text-center font-weight-bold">$<?=number_format($projectTierArray['tier_amount'] , 0, ',', '.')?></h2>
								    <p class="card-text font-weight-bold"><?=$projectTierArray['tier_title']?></p>
								    <p><?=nl2br($projectTierArray['tier_desc'])?></p>
								    <b>Incluye:</b>
								    <ul>
						          <?if($projectTierArray['t_reward_01']!=''):?><li><?=$projectTierArray['t_reward_01']?></li><?endif;?>
					          	<?if($projectTierArray['t_reward_02']!=''):?><li><?=$projectTierArray['t_reward_02']?></li><?endif;?>
					          	<?if($projectTierArray['t_reward_03']!=''):?><li><?=$projectTierArray['t_reward_03']?></li><?endif;?>
					          	<?if($projectTierArray['t_reward_04']!=''):?><li><?=$projectTierArray['t_reward_04']?></li><?endif;?>
						        </ul>
								  </div>
								</div>
							</label>
						</a>
					</div>
				</div>

			</div>

				<!-- checkbox ToS -->
			<form id="form2" action="" method="POST">
				<div class="form-row mt-3">

					<div class="form-check ml-2">

						<input class="form-check-input show-methods" type="checkbox" value="check" id="defaultCheck1">

						<label class="form-check-label" id="defaultCheck1Label" for="defaultCheck1" value="check">

							<span class="show-methods">He leído los</span> <a href="" data-toggle="modal" data-target="#crowdfundingTosModal">términos y condiciones</a>

						</label>

					</div>

				</div>
				<hr>
				<div id="pagosPatrocinar" class="row justify-content-center mt-5 check" style="display: none;">
					<div class="col-md-6 justify-content-between align-items-center">
						<p><strong>Seleccione su medio de pago.</strong></p>
						<div class="radioPagoEvento-img">
							<p><strong>Nacional:</strong></p>
							<label>
								<input type="radio" name="method_payment" value="1">
								<img src="images/webpay.png" alt="">
							</label>
							<label>
								<input type="radio" name="method_payment" value="2">
								<img src="images/Logo_kiphu.png" alt="">
							</label>
							<p><strong>Nacional e internacional:</strong></p>
							<label>
								<input type="radio" name="method_payment" value="3">
								<img src="images/paygol-logo.svg" alt="">
							</label>
						</div>
					</div>
				</div>

				<hr>
				<div class="row justify-content-center mt-5">

					<div class="text-center">

						<button id="method_submit" class="btn btn-primary btn-block btn-lg px-5" value="Siguiente" name="patrocinar">Siguiente</button>

					</div>

				</div>
			</form>
	<? endif; ?>
		</div>

	</main>





		<!-- Scripts -->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="assets/js/jquery.mask.js"></script>

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

		<script>
			$(document).ready(function() {
						$('input[type="checkbox"]').click(function() {
								var inputValue = $(this).attr("value");
								$("." + inputValue).toggle();
						});
				});
		</script>

	 <script type="text/javascript">
		 	// $('.show-methods').click(function () {
			//
			// if ($('#pagosPatrocinar').hasClass("disabled")) {
		  //       $('#pagosPatrocinar').css("display", "none");
		  //       $('#pagosPatrocinar').removeClass('disabled');
		  //   }
		  //   else
		  //   {
		  //       $('#pagosPatrocinar').css("display", "block");
		  //       $('#pagosPatrocinar').addClass('disabled');
		  //   }
			//
			// });


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

		 <script type="text/javascript">
			 $(document).ready(function(){
				 $('#inputAddedValue').mask('000.000.000.000.000', {reverse: true});
			 });
		 </script>

		 <script>
			 var myFee = <?=$prFee+$prAddedFee?>;
			 var myTotal = <?=$totalTransaction?>;
			 var myTicket = <?=$projectTierArray['tier_amount']?>;
			 $('#inputAddedValue').keyup(function(){
				 var myStr = $('#inputAddedValue').val();
				 var newStr = myStr.replace(/\./g, '');
				 var firstValue  = Number(newStr);
				 var calculatedFee = (firstValue/100)*0;
				 var calculatedFee = calculatedFee+myFee;
				 var calculatedTotal = calculatedFee+myTicket+firstValue;
				 $('#feeSpan').html(Math.round(calculatedFee));
				 $('#totalSpan').html(Math.round(calculatedTotal));
			 });
		 </script>

		 <? include 'resources/googleLoginScript.php'; ?>

	</body>

	<?php

	include 'resources/conditionsModal.php';
	include 'resources/privacyModal.php';
	include 'resources/crowdfunding/crowdfundingTosModal.php';

	?>
</html>
