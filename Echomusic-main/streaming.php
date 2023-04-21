<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

include 'resources/streaming_script.php';

// include 'resources/streaming_ticket_script.php';

include 'resources/login_script.php';

// mm/dd/yyyy hh:ii:ss

$timeCountdown = $dateEventStreaming;

// if(isset($_SESSION['loggedTester']) AND $_SESSION['loggedTester'] == true){

//

// }else{

//   header('Location: logintester.php');

//   die();

// }

?>

<!DOCTYPE HTML>


<html>

	<head>

		<title>Streaming | <?=$eventsStreaming_array['name_event']?></title>

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



    <!-- Top Navbar -->

		<?php

			include 'resources/topNavbar.php';

		 ?>



		<!-- Container -->

		<div class="container">

			<div class="row justify-content-center">

				<div class="col-12 text-center mt-5 pt-5 row">

					<? if($plsLogin==true): ?>

						<h1>Inicia Sesión</h1>

					<? else: ?>



							<? if($userSubscription==1): ?>



									<? if($timeCountdown<$today): ?>

										<? switch($eventsStreaming_array['id_streaming_platform']):case '1': ?>

											<div class="col-md-12 col-12 text-center mt-5 pt-5">
												<iframe width="100%" height="400" src="https://www.youtube.com/embed/<?=$eventsStreaming_array['streaming_multi']?>" frameborder="0" allow="autoplay" allowfullscreen></iframe>
											</div>

											<? break; ?>

											<? case '2':?>

													<div class="col-md-8 col-sm-12 col-12 text-center mt-5 pt-5">
														<?=$eventsStreaming_array['streaming_multi']?>
													</div>
													<div class="col-md-4 col-sm-12 col-12 text-center mt-5 pt-5" style="height: 65vh;">
														<?=$eventsStreaming_array['streaming_chat']?>
													</div>

											<?break; ?>

											<? case '3': ?>
											<div class="col-md-12 col-12 text-center mt-5 pt-5">
												<a href="<?=$eventsStreaming_array['streaming_multi']?>">Para iniciar la transmisión, pincha este link</a>
											</div>

											<? break; ?>

										<? endswitch; ?>

									<? elseif($timeCountdown>$today): ?>

										<h2>El evento comienza en:</h2>

										<div class="col-md-12 col-12 text-center" id="countdown"></div>

										<div class="col-md-12 col-12 text-center row"  id="videoContainer"></div>

									<? endif; ?>

							<? elseif($userSubscription==0): ?>

								<h2 class="col-md-12 col-12">El evento comienza en:</h2>

								<div class="col-md-12 col-12 text-center" id="countdown"></div>

									<? if($totalAudience <= $countAudience): ?>

										<a class="btn btn-primary px-5 isDisabled" style="line-height: 30px;">Entradas agotadas</a>

									<? else: ?>

										<? if($eventsStreaming_array['value']>0): ?>

											<a href="ticket_buy.php?streaming=<?=$eventsStreaming_array['id_event']?>" class="btn btn-primary px-5" style="line-height: 30px;">Comprar entrada</a>

										<? elseif($eventsStreaming_array['value']==0): ?>

											<a href="ticket_buy.php?streaming=<?=$eventsStreaming_array['id_event']?>" class="btn btn-primary px-5" style="line-height: 30px;">Suscribirse para ver</a>

										<? endif; ?>

									<? endif; ?>

							<? endif; ?>



					<? endif; ?>







				</div>

			</div>

		</div>



	</main>



<!-- Footer -->

	<?php

		include 'resources/footer.php';



	 ?>



		<!-- Scripts -->

			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="/assets/js/showmoreless.min.js"></script>

			<script src="/assets/js/jquery.countdown.js"></script>



			<? include 'resources/login_error_script.php'; ?>



      <? if($plsLogin==true): ?>

           <script>

             $(document).ready(function(){

               $('#loginModal').modal('show');

             });

           </script>

      <? endif; ?>



			<script type="text/javascript">

			  $("#countdown").countdown("<?=$timeCountdown?>", function(event) {

			    $(this).text(

			      event.strftime('%D días %H:%M:%S')

			    );

			  })

				.on('finish.countdown', function(event){

				  <? if($userSubscription==1): ?>

					<? switch($eventsStreaming_array['id_streaming_platform']):case '1': ?>

						$('#videoContainer').html('<iframe width="100%" height="400" src="https://www.youtube.com/embed/<?=$eventsStreaming_array['streaming_multi']?>" frameborder="0" allow="autoplay" allowfullscreen></iframe>');

					<? break; ?>

					<? case '2': ?>

						$('#videoContainer').html('<div class="col-md-8 col-sm-12 col-12 text-center mt-5 pt-5"><?=$eventsStreaming_array['streaming_multi']?></div><div class="col-md-4 col-sm-12 col-12 text-center mt-5 pt-5" style="height: 65vh;"><?=$eventsStreaming_array['streaming_chat']?></div>');

					<? break; ?>

					<? case '3': ?>

						$('#videoContainer').html('<a href="<?=$eventsStreaming_array['streaming_multi']?>">Para iniciar la transmisión, pincha este link</a>');

					<? break; ?>

					<? endswitch; ?>

				  <? endif; ?>

				});

			</script>



			<script>

				$(function(){

				  $('.show-less-div').myOwnLineShowMoreLess({

				    showLessLine: 4

				  });

				})

			</script>

			<? include 'resources/googleLoginScript.php'; ?>

	</body>

</html>
