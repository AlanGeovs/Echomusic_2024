<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';
include 'resources/crowdfunding/projectSearch_script.php';
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

		<meta name="keywords" content="Recaudar fondos, Financiar proyectos musicales, Producción de EP, Producción de Disco, Grabación de album, Grabación de video clip, Estudio de grabación, Patrocinar proyecto musical" />

		<meta name="og:image" content="https://echomusic.cl/images/logo_brand_3.png" />
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
	<main id="crowdfunding-main" role="main">

		<!-- Top Navbar -->

		<?php

			include 'resources/topNavbar.php';

		 ?>

<!-- Main Content -->

		<!-- First Banner -->
		<div id="searchMainBanner_CrowdF" class="jumbotron bg-dark mb-0">
			<div class="container text-center text-white">
				<h2>Ayuda a recaudar los fondos que necesitan tus artistas en <strong>EchoMusic</strong>.</h2>
			</div>
		</div>



		<!-- Container -->

		<div class="container">

				<!-- Breadcrumb -->

				<nav aria-label="breadcrumb" id="searchBreadcrumb">

				  <ol class="breadcrumb mb-0">

				    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>

				    <li class="breadcrumb-item active" aria-current="page">Crowdfunding</li>

				  </ol>

				</nav>

<!-- AGREGAR CONDICIONAL POR SI HAY PROYECTOS PENDIENTES-->
		<? if(isset($_SESSION['type_user']) && $_SESSION['type_user']=='1'): ?>
				<div class="row " id="">

					<div class="col-xl-12 col-lg-12 col-md-12 col-12 mt-3 mb-3">

						<h3 class="font-weight-bold">Recauda fondos para tu proyecto musical <a class="btn-primary btn-lg" href="crear_proyecto.php">Crear Crowdfunding</a></h3>

					</div>

				</div>
		<? endif; ?>


				<!-- Filters -->

				<div class="row " id="searchFilters">

					<div class="col-xl-4 col-lg-6 col-md-6 col-12 ">

						<h2 class="font-weight-bold text-rightcenter">Proyecto crowdfunding</h2>

					</div>

					<div class="col">

						<h2 class="" data-toggle="collapse" data-target="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">Filtros <i class="fas fa-caret-down"></i></h2>

					</div>

				</div>

				<div class="row collapse" id="collapseFilters">

					<form method="GET" action="" class="form-inline w-100" id="searchFiltersForm">

					  <input type="text" name="search" class="form-control col-lg-3 col-md-3 col-12 filtro-artista" id="inlineFormInputName2" placeholder="Nombre">

						<select  name="category" class="custom-select select-artista col-lg-3 col-md-3 col-12">

						  <option value="" selected>Tipo de Proyecto</option>

						  <? foreach($categoriesArray as $categories): ?>
								<option value="<?=$categories['id_category']?>"><?=$categories['name_category']?></option>
							<? endforeach; ?>

						</select>

						<select id="selectRegion" name="region" class="custom-select select-artista col-lg-3 col-md-3 col-12">

						  <option value="" selected>Región</option>

						  <? foreach($regionsArray as $regions): ?>
								<option value="<?=$regions['id_region']?>"><?=$regions['name_region']?></option>';
							<? endforeach; ?>

						</select>
					<button type="submit" class="btn btn-primary col-lg-3 col-md-2 col-12" >Buscar <i class="fas fa-search" style="margin: 0 0 0 1rem;"></i></button>


					</form>

				</div>



				<!-- Artists Cards -->

				<div class="row proyecto-items proyecto-card">
					<? if($checkNoProjects==false): ?>
						<? foreach($resultsArray as $results):?>
						<?
							$dateTimeProject = date_create($results['project_date_end']);
							$timeProjectEnd = DATE_FORMAT($dateTimeProject, "H:i");
							$dateProjectEnd = DATE_FORMAT($dateTimeProject, "d-m-Y");
						?>
						<?
						// Calculate actual amount colected
							$prId = $results[0];
							$queryBackersInfo = mysqli_query($conn, "SELECT id_project_backer, backer_amount, backer_added_amount, backer_fee FROM project_backers WHERE id_project='$prId' AND status_backer='1'");
							$totalBackers = mysqli_num_rows($queryBackersInfo);
							$prBackersAmount = 0;
							while($totalArray = mysqli_fetch_array($queryBackersInfo)){
							  $prBackersAmount = $prBackersAmount + $totalArray['backer_amount'] + $totalArray['backer_added_amount'];
							}

							// Calcular porcentaje recaudado
								$x = $prBackersAmount*100;
								$x = $x / $results['project_amount'];
								$prBackersPercentage = $x;
								unset($x);
								$prBackersPercentage = intval($prBackersPercentage);

							// Estatus proyecto
							switch($results['status_project']){
								case 1:
									$prStatus = 'En proceso';
									$prStatusClass = 'en-proceso';
								break;
								case 2:
									$prStatus = 'Financiado';
									$prStatusClass = 'cerrado-ok';
								break;
								case 3:
									$prStatus = 'No Financiado';
									$prStatusClass = 'cerrado-nok';
								break;
								case 4:
									$prStatus = 'Cancelado';
									$prStatusClass = 'cerrado-nok';
								break;
							}
						?>
						<div class="col-lg-4 col-md-4 col-sm-10 my-2">
							<div class="proyecto-item mb-30">
								<div class="proyecto-foto">
									<a href="https://qa.echomusic.cl/proyecto.php?projectid=<?=$results[0]?>"><img class="proyecto-foto" src="images/crowdfunding/pr_<?=$results[0]?>/<?=$results[0]?>.jpg"  alt="Foto del portada proyecto"></a>
								</div>
								<div class="content">
									<div class="categoria">
										<a class="<?=$prStatusClass?>"><?=$prStatus?></a>
										<!--cerrado completado.
										cerrado no completado.-->
									</div>
									<div class="author">
										<img src="https://qa.echomusic.cl/images/avatars/<?=$results['id_user']?>.jpg" alt="Foto del nombre autor">
										<a href="https://qa.echomusic.cl/profile.php?userid=<?=$results['id_user']?>"><?=$results['nick_user']?></a>
									</div>
									<div class="region-proyecto my-2">
										<i class="fas fa-map-marker-alt"></i><em class="">Región</em><br>
										<b class="text-black mx-3"><?=$results['name_region']?></b>
									</div>
									<h5 class="title">
										<a href="https://qa.echomusic.cl/proyecto.php?projectid=<?=$results[0]?>"><?=$results['project_title']?></a>
									</h5>
									<div class="proyecto-stats">
										<div class="stats-value">
											<span class="value-title">Total recaudado: <span class="value">$<?=number_format($prBackersAmount , 0, ',', '.')?></span> de <span class="value">$<?=number_format($results['project_amount'] , 0, ',', '.')?></span></span>
											<span class="stats-percentage"><?=$prBackersPercentage?>%</span>
										</div>
										<div class="stats-bar" data-value="<?=$prBackersPercentage?>">
											<div class="bar-line" style="width: <?=$prBackersPercentage?>%;"></div>
										</div>
									</div>
									<span class="date"><i class="far fa-calendar-alt"></i>Hasta el <?getDayday($dateTimeProject); ?> de <? getMonthYear($dateTimeProject); ?></span>
								</div>
							</div>
						</div>
						 <? endforeach; ?>
				 <? elseif($checkNoProjects==true): ?>
					<h2>No se encontraron proyectos</h2>
				 <? endif; ?>

				</div>


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
		    $this.wrap('<div class="select filtro-artista col-md-3 col-12"></div>');
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
