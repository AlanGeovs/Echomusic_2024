<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';
include 'resources/search_script.php';
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

		<title>EchoMusic | Buscador</title>

		<meta charset="utf-8" />
		<meta name="author" content="EchoMusic" />

		<meta name="keywords" content="Artistas para Eventos, Musicos para matrimonio, Contrata músicos para eventos, Contrata Dj para eventos, Músicos para cumpleaños, Djs para fiestas, Productora de eventos, Booking de artistas, Eventos para empresas, Cantantes para eventos, Bandas para eventos" />

		<meta name="og:image" content="https://qa.echomusic.cl/images/logo_brand_3.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="Buscador EchoMusic.cl - La música nos conecta" />

		<meta name="description" content="Encuentra a tu artista favorito y proximos eventos." />

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>
		<? include_once("resources/Analytics.php"); ?>
	</head>

	<body>
	<main role="main">

		<!-- Top Navbar -->

		<?php

			include 'resources/topNavbar.php';

		 ?>





<!-- Main Content -->




		<!-- First Banner -->

		<div id="searchMainBanner" class="jumbotron bg-dark mb-0">

			<div class="container text-center text-white">

				<h2>Encuentra al artista <strong>EchoMusic</strong> que más te guste</h2>

			</div>

		</div>



		<!-- Container -->

		<div class="container">

				<!-- Breadcrumb -->

				<nav aria-label="breadcrumb" id="searchBreadcrumb">

				  <ol class="breadcrumb mb-0">

				    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>

				    <li class="breadcrumb-item active" aria-current="page">Artistas</li>

				  </ol>

				</nav>



				<!-- Filters -->

				<div class="row " id="searchFilters">

					<div class="col-xl-2 col-lg-3 col-md-6 col-6">

						<h2 class="font-weight-bold">Artistas</h2>

					</div>

					<div class="col">

						<h2 class="" data-toggle="collapse" data-target="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">Filtros <i class="fas fa-caret-down"></i></h2>

					</div>

				</div>

				<div class="row collapse" id="collapseFilters">

					<form method="GET" action="" class="form-inline w-100" id="searchFiltersForm">

					  <input type="text" name="search" class="form-control col-lg-2 col-md-2 col-12 filtro-artista" id="inlineFormInputName2" placeholder="Nombre">

						<select id="selectGenero" name="genre" class="custom-select select-artista col-lg-2 col-md-2 col-12">

						  <option value="" selected>Género</option>

						  <? foreach($genresArray as $genres): ?>
								<option value="<?=$genres['id_genre']?>"><?=$genres['name_genre']?></option>
							<? endforeach; ?>

						</select>

						<select id="selectSubgenero" name="subgenres" class="custom-select select-artista col-lg-2 col-md-2 col-12">

						  <option value="" selected>Sub-Género</option>

						</select>

						<select  name="artist" class="custom-select select-artista col-lg-2 col-md-2 col-12">

						  <option value="" selected>Tipo de Artista</option>

						  <? foreach($typeMusicianArray as $typeMusician): ?>
								<option value="<?=$typeMusician['id_musician']?>"><?=$typeMusician['name_musician']?></option>
							<? endforeach; ?>

						</select>

						<select id="selectRegion" name="region" class="custom-select select-artista col-lg-2 col-md-2 col-12">

						  <option value="" selected>Región</option>

						  <? foreach($regionsArray as $regions): ?>
								<option value="<?=$regions['id_region']?>"><?=$regions['name_region']?></option>';
							<? endforeach; ?>

						</select>
					<button type="submit" class="btn btn-primary col-lg-2 col-md-2 col-12" >Buscar <i class="fas fa-search" style="margin: 0 0 0 1rem;"></i></button>


					</form>

				</div>



				<!-- Artists Cards -->

				<div class="row artistsDeckRow row-cols-1 row-cols-md-2 row-cols-lg-3">

					<!-- <div class="card-deck"> -->
					<?php
					if(isset($_GET['search'])){
						if(isset($resultsArray)){
							displayArtists($resultsArray);
						}
						else{
							echo '<h3>No se han encontrado resultados</h3>';
						}
					} else{
						include 'resources/search_trending_script.php';
					}
					?>

				</div>

				<!-- </div> -->


				<!-- Pagination -->
				<?php
					include 'resources/functionSearchPagination.php';
				?>

		</div>



	</main>





		<!-- Scripts -->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="assets/js/ajaxChangeGenres.js"></script>

			<? include 'resources/login_error_script.php'; ?>

<!-- Footer -->

<? include 'resources/footer.php'; ?>
		 <script type="text/javascript">

		$('.select-artista').each(function(){

		    var $this = $(this), numberOfOptions = $(this).children('option').length;
		  	var $idSelect = $(this).attr("id");
		    $this.attr('id', $idSelect+"-hidden");

		    $this.addClass('select-hidden');
		    $this.wrap('<div class="select filtro-artista col-md-2 col-12"></div>');
		    $this.after('<div id="'+$idSelect+'-div" class="select-stylesearch"></div>');

		    var $styledSelect = $this.next('div.select-stylesearch');
		    $styledSelect.text($this.children('option').eq(0).text());

		    var $list = $('<ul />', {
		        'class': 'select-options'
		    }).insertAfter($styledSelect);
		    $list.attr('id', $idSelect);

		    for (var i = 0; i < numberOfOptions; i++) {
		        $('<li />', {
		            text: $this.children('option').eq(i).text(),
		            rel: $this.children('option').eq(i).val()
		        }).appendTo($list);
		    }

		    var $listItems = $list.children('li');

		    $styledSelect.click(function(e) {
		        e.stopPropagation();
		        $('div.select-stylesearch.active').not(this).each(function(){
		            $(this).removeClass('active').next('ul.select-options').hide();
		        });
		        $(this).toggleClass('active').next('ul.select-options').toggle();
		    });

		    $listItems.click(function(e) {
		        e.stopPropagation();
		        $styledSelect.text($(this).text()).removeClass('active');
		        $this.val($(this).attr('rel'));
		        $list.hide();
		    });

		    $(document).click(function() {
		        $styledSelect.removeClass('active');
		        $list.hide();
		    });

		});

		$(function() {
		    $(document).on('click', '.subgeneros', function(event) {
		      var valor = $(this).val();
		      var nombre = $(this).text();
		      /*alert("value: "+valor+", "+nombre);*/
			  $("#selectSubgenero-hidden option[value='"+valor+"']").attr("selected",true);
			  $("#selectSubgenero-div").text(nombre);
  		    });
		});

		$(document).ready(function() {
			$("#selectGenero > li").on('click', function () {
				var rel = $(this).attr('rel');
	    		changeGenres(rel);
		    });
	    });
		 </script>

		 <? include 'resources/googleLoginScript.php'; ?>
	</body>

</html>
