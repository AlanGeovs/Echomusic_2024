<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

include 'resources/register_script.php';


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

		<title>EchoMusic | Registro</title>

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
			<?php
				if ( (isset($errMSG) && $errTyp == "success") || isset($_SESSION['email'])) {
			?>

					<main role="main">

					<div id="pagoConfirmado" class="container" style="min-height:100vh;">

						<!-- Head Banner reutilizacion de css -->

						<div class="row" id="registerHeader">

							<div class="col-md-12 text-center">

								<a href="index.php"><img src="images/logo_brand_3.png" alt="EchoMusic" width="150"></a>

							</div>
							<div class="col-md-12 text-center hr-class">
								<hr>
							</div>

						</div>



						<!--  notification -->

						<div class="row mt-4" id="pagoConfirmado">

						    <div class="text-center col-md-12 align-self-center">
							    <h2>Bienvenido a EchoMusic</h2>
							</div>
						    <div class="text-center offset-md-3 col-md-6 align-self-center">
							    <p>Tu cuenta EchoMusic se ha creado correctamente.</p>
						    </div>
						    <div class="text-center offset-md-3 col-md-6 align-self-center">
							    <p>Eso sí, para continuar te hemos enviado un correo para verificar tu cuenta.</p>
						    </div>
						    <div class="text-center offset-md-3 col-md-6 align-self-center">
							    <p>Recuerda revisar también la carpeta de spam.</p>
						    </div>
						    <div class="text-center offset-md-3 col-md-6 align-self-center">
							    <p>Si no has recibido nuestro correo en un lapso de 10 a 15 minutos, intenta reenviándolo desde el botón que encuentras a continuación:</p>
						    </div>
						    <div class="offset-md-4 col-md-4 text-center mt-1">
								<form action="" method="post">
									<input class="btn btn-primary btn-block btn-lg" type="submit" name="resend" value="Reenviar Correo Electrónico"/>
								</form>
							</div>
						    <div class="offset-md-4 col-md-4 text-center mt-1">
								<form action="" method="post">
									<input class="btn btn-outline-primary text-orange btn-block btn-lg" type="submit" name="register_form_submit" value="Volver al registro"/>
								</form>
							</div>

						 </div>

						<div class="row mt-4" id="pagoConfirmado">
								<div class="text-center offset-md-3 col-md-6 align-self-center mt-5">
							    <p>Si aún necesitas más ayuda, ponte en contacto con el Soporte de EchoMusic escribiendo a: contacto@echomusic.cl</p>
						    </div>
							</div>
						</div>

					</main>
			<?php
				}else{
			 ?>

      	<main role="main">

          <div class="container" style="min-height:100vh;">



            <!-- Head Banner -->

            <div class="row" id="registerHeader">

              <div class="col-md-12 text-center">

                <a href="index.php"><img src="images/logo_brand_3.png" alt="EchoMusic" width="150"></a>

                <hr>

              </div>

            </div>



          <!-- Main Body -->
        <div class="row">

        </div>
            <div class="col-md-6 m-auto">

							<div class="text-center">

								<h3><b>Registrarme en EchoMusic</b></h3>

								<div class="custom-control custom-radio custom-control-inline">

								  <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">

								  <label class="custom-control-label" for="customRadioInline1">Usuario</label>

								</div>

								<div class="custom-control custom-radio custom-control-inline">

								  <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">

								  <label class="custom-control-label" for="customRadioInline2">Artista</label>

								</div>

							</div>


					    <form action="" method="post">
					        <input type="hidden" name="googleID_token" id="googleID_token">
					        <input type="hidden" name="first_name" id="first_name">
					        <input type="hidden" name="last_name" id="last_name">
					        <input type="hidden" name="email" id="email">
					    </form>



							<!-- User Form -->

              <form id="formRegister_user" action="" method="POST" autocomplete="off" class="collapse pt-4">

								<h3>Registrarme usando mis redes</h3>

								<div id="my-signin2" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" ></div>

								<span class="text-danger"><strong class="alert"><?php if ( isset($emailError)) { echo $emailError;}; ?></strong></span>

								<hr>

								<h3>Crear una cuenta EchoMusic</h3>

                  <div class="form-group">

                    <label for="inputRegisterName_user">Nombre</label>

                    <input name="first_name" value="<?php if ( isset($first_name)) { echo $first_name;} ?>" type="text" class="form-control" id="inputRegisterName_user">

										<span class="text-danger "><strong class="alert"><?php if ( isset($first_nameError)) { echo $first_nameError;}; ?></strong></span>

										<span id="checkRegisterName_user" class="text-danger "><strong class="alert"></strong></span>

                  </div>

                  <div class="form-group">

                    <label for="inputRegisterLastName_user">Apellido</label>

                    <input name="last_name" value="<?php if ( isset($last_name)) { echo $last_name;} ?>" type="text" class="form-control" id="inputRegisterLastName_user">

										<span class="text-danger"><strong class="alert"><?php if ( isset($last_nameError)) { echo $last_nameError;}; ?></strong></span>

										<span id="checkRegisterLastName_user" class="text-danger "><strong class="alert"></strong></span>

                  </div>

                <div class="form-group">

                  <label for="inputRegisterEmail_user">Correo Electrónico</label>

                  <input name="email" value="<?php if ( isset($email)) { echo $email;} ?>" type="email" class="form-control" id="inputRegisterEmail_user" placeholder="ejemplo@correo.com">

									<span class="text-danger"><strong class="alert"><?php if ( isset($emailError)) { echo $emailError;}; ?></strong></span>

                </div>

                <div class="form-group">

                  <label for="inputRegisterPassword_user">Contraseña</label>

                  <input name="password" value="" type="password" class="form-control" id="inputRegisterPassword_user">

									<span class="text-danger"><strong class="alert"><?php if ( isset($passError)) { echo $passError;}; ?></strong></span>

									<span id="checkRegisterPassword_user" class="text-danger "><strong class="alert"></strong></span>

                </div>

                <div class="form-group">

                  <label for="inputRegisterVPassword_user">Verifica tu Contraseña</label>

                  <input name="password_verify" value="" type="password" class="form-control" id="inputRegisterVPassword_user">

									<span class="text-danger"><strong class="alert"><?php if ( isset($pass_verError)) { echo $pass_verError;}; ?></strong></span>

									<span id="checkRegisterVPassword_user" class="text-danger "><strong class="alert"></strong></span>

                </div>



                <div class="form-group">

										<div class="g-recaptcha" data-sitekey="6Ld2EqUZAAAAAJsDvCnZgrYOlEjnWPvgkcgCjXhr">No soy un robot</div>

										<span class="text-danger"><strong class="alert"><?php if ( isset($reCaptchaError)) { echo $reCaptchaError;} ?></strong></span>

                </div>

								<div class="form-group">


										<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">

										<label class="form-check-label" id="defaultCheck1Label" for="defaultCheck1">

											Acepto los <a href="" data-toggle="modal" data-target="#conditionsModal">términos y condiciones</a>

										</label>


								</div>

								<div class="text-center" id="registerDisclaimer">

									<p>

										Para obtener más información acerca de cómo EchoMusic recopila, utiliza,

										comparte y protege tus datos personales, consulta la <a href="" data-toggle="modal" data-target="#privacyModal">Política de

										Privacidad</a> de EchoMusic.

									</p>

								</div>

								<div class="form-group text-center">

	                <button id="submit_button_user" type="submit" name="register_button_user" class="btn btn-primary col-4">Registrarme</button>

								</div>

          </form>

					<!-- Artist Form -->

              <form id="formRegister_artist" action="" method="POST" autocomplete="off" class="collapse">

                  <div class="form-group">

                    <label for="inputRegisterName_artist">Nombre</label>

                    <input name="first_name" value="<?php if ( isset($first_name)) { echo $first_name;}; ?>" type="text" class="form-control" id="inputRegisterName_artist">

										<span class="text-danger"><strong class="alert"><?php if ( isset($first_nameError)) { echo $first_nameError;} ?></strong></span>

										<span id="checkRegisterName_artist" class="text-danger "><strong class="alert"></strong></span>

                  </div>

                  <div class="form-group">

                    <label for="inputRegisterLastName_artist">Apellido</label>

                    <input name="last_name" value="<?php if ( isset($last_name)) { echo $last_name;}; ?>" type="text" class="form-control" id="inputRegisterLastName_artist">

										<span class="text-danger"><strong class="alert"><?php if ( isset($last_nameError)) { echo $last_nameError;} ?></strong></span>

										<span id="checkRegisterLastName_artist" class="text-danger "><strong class="alert"></strong></span>

                  </div>

                <div class="form-group">

                  <label for="inputRegisterNick_artist">Nombre de Banda o Artista</label>

                  <input name="nick" value="<?php if ( isset($nick)) { echo $nick;} ?>" type="text" class="form-control" id="inputRegisterNick_artist">

									<span class="text-danger"><strong class="alert"><?php if ( isset($nickError)) { echo $nickError;} ?></strong></span>

									<span id="checkRegisterNick_artist" class="text-danger "><strong class="alert"></strong></span>

                </div>

                <div class="form-group">

                  <label for="inputRegisterEmail_artist">Correo Electrónico</label>

                  <input name="email" value="<?php if ( isset($email)) { echo $email;}; ?>" type="email" class="form-control" id="inputRegisterEmail_artist" placeholder="ejemplo@correo.com">

									<span class="text-danger"><strong class="alert"><?php if ( isset($emailError)) { echo $emailError;} ?></strong></span>

                </div>

                <div class="form-group">

                  <label for="inputRegisterPassword_artist">Contraseña</label>

                  <input name="password" value="" type="password" class="form-control" id="inputRegisterPassword_artist">

									<span class="text-danger"><strong class="alert"><?php if ( isset($passError)) { echo $passError;} ?></strong></span>

									<span id="checkRegisterPassword_artist" class="text-danger "><strong class="alert"></strong></span>

                </div>

                <div class="form-group">

                  <label for="inputRegisterVPassword_artist">Verifica tu Contraseña</label>

                  <input name="password_verify" value="" type="password" class="form-control" id="inputRegisterVPassword_artist">

									<span class="text-danger"><strong class="alert"><?php if ( isset($pass_verError)) { echo $pass_verError;} ?></strong></span>

									<span id="checkRegisterVPassword_artist" class="text-danger "><strong class="alert"></strong></span>

                </div>



                <div class="form-group">

										<div class="g-recaptcha" data-sitekey="6Ld2EqUZAAAAAJsDvCnZgrYOlEjnWPvgkcgCjXhr">No soy un robot</div>

										<span class="text-danger"><strong class="alert"><?php if ( isset($reCaptchaError)) { echo $reCaptchaError;} ?></strong></span>

                </div>

								<div class="form-group">


										<input class="form-check-input" type="checkbox" value="" id="defaultCheck2">

										<label class="form-check-label" id="defaultCheck2Label" for="defaultCheck1">

											Acepto los <a href="" data-toggle="modal" data-target="#conditionsModal">términos y condiciones</a>

										</label>


								</div>

								<div class="text-center" id="registerDisclaimer">

									<p>

										Para obtener más información acerca de cómo EchoMusic recopila, utiliza,

										comparte y protege tus datos personales, consulta la <a href="" data-toggle="modal" data-target="#privacyModal">Política de

										Privacidad</a> de EchoMusic.

									</p>

								</div>

					<div class="form-group text-center">

            	<button id="submit_button_artist" type="submit" name="register_button_musician" class="btn btn-primary col-md-5">Registrarme</button>

					</div>

          </form>

        </div>

    </div>

	</main>

<?php } ?>


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

			<script src="assets/js/validateRegisterUser.js"></script>

			<script src="assets/js/validateRegisterArtist.js"></script>


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


			<? include 'resources/googleLoginScript.php'; ?>

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
<?php

include 'resources/conditionsModal.php';
include 'resources/privacyModal.php';

?>
</html>
