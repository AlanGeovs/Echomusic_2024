<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

include 'resources/first_login_script.php';
include 'resources/login_script.php';

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

		<title>EchoMusic | Configuración inicial</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>
		<? include_once("resources/Analytics.php"); ?>
	</head>

	<body>

      	<main role="main">

          <div class="container" style="min-height:100vh;">

            <!-- Head Banner -->

            <div class="row" id="registerHeader">

              <div class="col-md-12 text-center">

                <img src="images/logo_brand_5.png" alt="EchoMusic">

                <hr>

              </div>

            </div>



          <!-- Main Body -->
        <div class="row">

        </div>
            <div class="col-md-6 m-auto">

							<div class="text-center">

								<h3><b>Tu cuenta de Artista esta casi lista, por favor completa estos últimos datos.</b></h3>

							</div>

							<!-- User Form -->

              <form id="formRegister_user" action="" method="POST" autocomplete="off">

                  <div class="form-group">

                    <label for="inputMusician">¿Qué tipo de artista eres?</label>

										<select name="musician" class="form-control form-custom-1" id="inputMusician" onChange="togglebutton(this);">
											<option value="">-</option>
											<? while($arrayMusician = mysqli_fetch_array($queryMusicianInfo)): ?>
													<option value="<?=$arrayMusician['0']?>"><?=$arrayMusician['1']?></option>
											<? endwhile; ?>
										</select>

										<span class="text-danger "><strong class="alert"><?php if ( isset($musicianError)) { echo $musicianError;} ?></strong></span>

                  </div>

                  <div class="form-group" id="instrument" style="display:none;">

										<select name="instrument" class="form-control form-custom-1" id="inputInstrument">
											<option value="0">Elige tu instrumento</option>
											<? while($arrayInstrument = mysqli_fetch_array($queryInstrumentInfo)): ?>
													<option value="<?=$arrayInstrument['0']?>"><?=$arrayInstrument['1']?></option>
											<? endwhile; ?>
										</select>

										<span class="text-danger"><strong class="alert"><?php if ( isset($instrumentError)) { echo $instrumentError;} ?></strong></span>

                  </div>

                <div class="form-group">

                  <label for="inputGenre">¿A qué género musical perteneces?</label>

									<select name="genre" class="form-control form-custom-1" id="inputGenre">
										<option value="">-</option>
										<? while($arrayGenres = mysqli_fetch_array($queryGenresInfo)): ?>
												<option value="<?=$arrayGenres['0']?>"><?=$arrayGenres['1']?></option>
										<? endwhile;	?>
									</select>

									<span class="text-danger"><strong class="alert"><?php if ( isset($genreError)) { echo $genreError;} ?></strong></span>

                </div>

                <div class="form-group">

                  <label for="inputRegion">Región</label>

									<select name="region" class="form-control form-custom-1" id="inputRegion" onChange="changeCities()">
										<? while($arrayRegions = mysqli_fetch_array($queryRegionsInfo)): ?>
												<option value="<?=$arrayRegions['0']?>"><?=$arrayRegions['1']?></option>
										<? endwhile;	?>
									</select>

									<span class="text-danger"><strong class="alert"><?php if ( isset($regionError)) { echo $regionError;} ?></strong></span>

                </div>

                <div class="form-group">

                  <label for="inputCity">Comuna</label>

									<select  name="comuna" class="form-control form-custom-1" id="inputCity">
											<option value="1">Arica</option>
											<option value="2">Putre</option>
											<option value="3">Camarones</option>
											<option value="4">General Lagos</option>
									</select>

									<span class="text-danger"><strong class="alert"><?php if ( isset($comunaError)) { echo $comunaError;} ?></strong></span>

                </div>

                <div class="form-group">

                  <label for="inputCity">Escribe una breve descripción</label>

									<textarea name="description_text" class="form-control form-custom-1" id="inputDescription" maxlenght="500" rows="4" placeholder="Máximo 500 caracteres"><? if(isset($desc)){ echo str_replace("\'","'",$desc); } ?></textarea>

									<span class="text-danger"><strong class="alert"><?php if ( isset($descError)) { echo $descError;} ?></strong></span>

                </div>


								<div class="form-group text-center">

	                <button type="submit" name="submit_button" class="btn btn-primary col-4">Siguiente</button>

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

			<script src="assets/js/ajaxChangeCities.js"></script>

			<script src="assets/js/jquery.charactercounter.js"></script>

			<? if($errTyp == "danger"): ?>
				<script type='text/javascript'>alert('<?=$errMSG?>');</script>
			<? endif; ?>

			<script>
			// Show instruments
			  function togglebutton(musician) {
			        options = musician.children;
			        if (options['4'].selected) {
			            document.getElementById("instrument").style.display = "block";
			        } else {
			            document.getElementById("instrument").style.display = "none";
			        }

			  }
			</script>

			<script>
				$("#inputDescription").characterCounter({
				  limit: '500',
					counterFormat: '%1 caracteres restantes'
				});
			</script>

			<? include 'resources/googleLoginScript.php'; ?>


	</body>

</html>
