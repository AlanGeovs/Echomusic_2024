<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

include 'resources/mail_test_script.php';

// if(isset($_SESSION['loggedTester']) AND $_SESSION['loggedTester'] == true){
//
//
//
// }else{
//
//   header('Location: logintester.php');
//
//   die();
//
// }

?>

<!DOCTYPE HTML>


<html>

	<head>

		<title>EchoMusic</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>

	</head>

	<body>



      <!-- Main Content -->


      	<main role="main">

          <div class="container" style="min-height:100vh;">



            <!-- Head Banner -->

            <div class="row" id="registerHeader">

              <div class="col-md-12 text-center">

                <img src="images/logo_brand_3.png" alt="EchoMusic" width="150">

                <hr>

              </div>

            </div>



          <!-- Main Body -->
        <div class="row">

        </div>
            <div class="col-md-6 m-auto">

							<div class="text-center">

								<h3><b>Prueba de correos</b></h3>

							</div>

							<!-- User Form -->

              <form action="" method="POST" autocomplete="off">

                <div class="form-group">

                  <label for="inputRegisterEmail_user">Correo Electrónico</label>

                  <input name="email" value="" type="email" class="form-control" id="inputEmail_user" placeholder="ejemplo@correo.com">


                </div>

                <div class="form-group">

                  <label for="inputSendMail">Correo a enviar</label>

                  <select class="form-control" id="inputSendMail" name="mailToSend">
										<option value="1">Verificación</option>
										<option value="9">Recuperación contraseña</option>
										<option value="2">Reserva</option>
										<option value="10">Valoración</option>
										<option value="3">Evento Aceptado</option>
										<option value="4">Evento Rechazado</option>
										<option value="5">Evento Cancelado</option>
										<option value="6">Evento Confirmado</option>
										<option value="7">Evento Modificado</option>
										<option value="8">Evento Publicado</option>
									</select>

                </div>



                <div class="form-group">

										<div class="g-recaptcha" data-sitekey="6Ld2EqUZAAAAAJsDvCnZgrYOlEjnWPvgkcgCjXhr">No soy un robot</div>

										<span class="text-danger"><strong class="alert"><?php if ( isset($reCaptchaError)) { echo $reCaptchaError;} ?></strong></span>

                </div>

								<div class="form-group text-center">

	                <button id="submit_button_mail" type="submit" name="submit_button_mail" class="btn btn-primary col-4">Enviar</button>

								</div>

          </form>

        </div>

    </div>

	</main>


<!-- Footer -->



	<?php

		include 'resources/footer.php';

	 ?>



		<!-- Scripts -->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="https://www.google.com/recaptcha/api.js" async defer></script>

			<script>



			// Script overlay Artists Cards

			$('.artistCard').hover( function() {



				var parent = $(this).closest('.artistCard'); // find closest sub_page

	 			$('.card-img-overlay', parent).show();



			});



			$('.artistCard').on( "mouseleave", function() {



				var parent = $(this).closest('.artistCard'); // find closest sub_page

	 			$('.card-img-overlay', parent).hide();



			});



			// Script overlay Events Cards

			$('.eventCard').hover( function() {



				var parent = $(this).closest('.eventCard'); // find closest sub_page

	 			$('.card-img-overlay', parent).show();



			});



			$('.eventCard').on( "mouseleave", function() {



				var parent = $(this).closest('.eventCard'); // find closest sub_page

	 			$('.card-img-overlay', parent).hide();



			});



			// Script overlay Calendar Cards

			$('.calendarCard').hover( function() {



				var parent = $(this).closest('.calendarCard'); // find closest sub_page

	 			$('.card-img-overlay', parent).show();



			});



			$('.calendarCard').on( "mouseleave", function() {



				var parent = $(this).closest('.calendarCard'); // find closest sub_page

	 			$('.card-img-overlay', parent).hide();



			});





			// Show Artist or User Form

			$('#customRadioInline1').change(

		    function(){

		        if (this.checked) {

		            $('#formRegister_user').collapse('show')

		            $('#formRegister_artist').collapse('hide')

		        }

		    });



			$('#customRadioInline2').change(

		    function(){

		        if (this.checked) {
		        	$('#formRegister_artist').collapse('show');

		            $('#formRegister_user').collapse('hide');



		        }

		    });

				function userChecked(){
						$('#formRegister_user').collapse('show');
						$('#formRegister_artist').collapse('hide');
						$('#customRadioInline1').click();
				}

				function artistChecked(){
						$('#formRegister_artist').collapse('show');
						$('#formRegister_user').collapse('hide');
						$('#customRadioInline2').click();
				}

			// Script redirect user or artist

			 $(document).ready(function () {
		    if (window.location.hash.indexOf('user') !== -1) {
		        window.location.hash = ''; // remove the hash
		        userChecked();
					}else if(window.location.hash.indexOf('artist') !== -1){
						window.location.hash = ''; // remove the hash
		        artistChecked();
					}
				});

			</script>

			<? if($errTyp == "danger"): ?>
				<script type='text/javascript'>alert('<?=$errMSG?>');</script>
				<? if($type_user == '1'): ?>
					<script>
						$(window).on('load', function () {
						    $('#customRadioInline2').click();
						})
					</script>
				<? elseif($type_user == '2'): ?>
					<script>
						$(window).on('load', function () {
						    $('#formRegister_user').collapse('show');
								$('#formRegister_artist').collapse('hide');
								$('#customRadioInline1').click();
						})
					</script>
				<? endif; ?>
			<? endif; ?>

	</body>

</html>
