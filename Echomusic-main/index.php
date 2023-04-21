<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';
include 'resources/index_script.php';
	function isMobileDevice() {
		    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
		|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
		, $_SERVER["HTTP_USER_AGENT"]);
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

		<title>EchoMusic | Inicio</title>

		<meta charset="utf-8" />
		<meta name="author" content="EchoMusic" />

		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos,playlist, Frank's White Canvas" />

		<meta name="og:image" content="https://qa.echomusic.cl/images/logo_brand_3.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="EchoMusic.cl - La música nos conecta" />

		<? include 'resources/googleLoginMeta.html'; ?>

		<meta name="description" content="Somos una plataforma digital colaborativa que conecta a músicos independientes con sus fans." />
		<meta name="facebook-domain-verification" content="jd2ke52f8s0zb7yjv9ce0f4tisua53" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="assets/slick/slick.css">
		<link rel="stylesheet" type="text/css" href="assets/slick/slick-theme.css">

		<link rel="stylesheet" href="assets/css/custom.css?=<?=filemtime('assets/css/custom.css')?>">

		<!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->

		<link rel=icon href=/favicon.png>

		<? include_once("resources/Analytics.php"); ?>
	</head>

	<body>
	<main role="main">
		<!-- Top Navbar -->

		<?php

			include 'resources/topNavbar.php';



		 ?>




<!-- Main Content -->





	  <!-- First Banner

	  <div id="indexMainBanner" class="jumbotron bg-dark">

	    <div class="container text-center text-white">

	      <img src="images/logo_brand_1.png" class="brandLogo mb-2">

	      <h2 class="mx-auto my-2 mb-4">La música nos Conecta</h2>
				<? if(isset($_SESSION['user'])): ?>
				<? else: ?>
	      <p><a class="btn btn-primary btn-lg text-white col-lg-2 col-md-6 col-6 my-2" href="register.php" role="button">Registrarme</a></p>
				<? endif; ?>
	    </div>

	  </div>-->

<div id="carouselIndexEchoMusic" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselIndexEchoMusic" data-slide-to="0" class="active"></li>
    <li data-target="#carouselIndexEchoMusic" data-slide-to="1"></li>
    <li data-target="#carouselIndexEchoMusic" data-slide-to="2"></li>
    <li data-target="#carouselIndexEchoMusic" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner">

	<div class="carousel-item img-carousel-item active" style="background-image:url('../../images/slider/2/slider-fondo-1.jpg?=<?=filemtime('images/slider/2/slider-fondo-1.jpg')?>');">
    	<!-- Slider REGISTRATE GRATIS-->
    	<div class="text-right ">
	      <img src="images/slider/1/slider-logoe-1.png" class="logo-slider mb-2">
	  	</div>
	  	<div class="container cuerpo-slider">
		  	<div class="text-center ">
		      <img src="images/slider/2/slider-letra-1.png" class="slider-letra mb-2">
		  	</div>
	    	<div class="text-center slider-letrabajo mt-4">
	    		<? if(isset($_SESSION['user'])): ?>
				<? else: ?>
	      		<p><a class="btn btn-primary btn-lg text-white col-lg-2 col-md-6 col-6 my-2" href="register.php" role="button">Registrarme</a></p>
				<? endif; ?>

		      <img src="images/slider/2/slider-letrabajo-1.png" class="w-75 mb-2 d-none d-sm-block mx-auto">


		    </div>
		</div>
    </div>

    <div class="carousel-item img-carousel-item" style="background-image:url('../../images/slider/1/slider-fondo-1.jpg?=<?=filemtime('images/slider/1/slider-fondo-1.jpg')?>');">
    	<!-- Slider Evento Streaming-->
    	<div class="text-right ">
	      <img src="images/slider/1/slider-logoe-1.png" class="logo-slider mb-2">
	  	</div>
	  	<div class="container cuerpo-slider">
		  	<div class="text-center ">
		      <img src="images/slider/1/slider-letra-1.png" class=" mb-2 w-75" style="">
		  	</div>
	    	<div class="text-center slider-letrabajo mt-4">
		      <p><a class="btn btn-primary btn-lg text-white col-lg-2 col-md-6 col-6 my-2" href="https://landing.echomusic.cl/ticketing" role="button">Crea tu evento</a></p>
		    </div>
		</div>
    </div>

    <div class="carousel-item img-carousel-item" style="background-image:url('../../images/slider/4/slider-fondo-1.jpg?=<?=filemtime('images/slider/4/slider-fondo-1.jpg')?>');background-position: bottom;">
    	<!-- Slider acustico-->
	  	<div class="container cuerpo-slider mt-4">
		  	<div class="text-center">
		      <img src="images/slider/4/slider-letrabajo-1.png" class="w-75 mb-2">
					<p><a class="btn btn-primary btn-lg text-white col-lg-4 col-md-6 col-6 my-2" href="https://landing.echomusic.cl/crowdfunding" role="button">Crear Crowdfunding</a></p>
		  	</div>
		</div>
    </div>

    <div class="carousel-item img-carousel-item" style="background-image:url('../../images/slider/3/slider-fondo-1.jpg?=<?=filemtime('images/slider/3/slider-fondo-1.jpg')?>');">
    	<!-- Slider Naranja-->
	  	<div class="container cuerpo-slider-img">
		  	<div class="text-center">
		      <img src="images/slider/3/slider-letrabajo-1.png" class="slider-letra mb-2">
		  	</div>
		</div>
    </div>

  </div>
</div>


<!-- Main Content -->
<div class="row mt-5" id="cuerpoIndex">
	<div class="col col-120">
		<a title="Crear Evento" href="startEvent.php"><div class="skhis-left">publicidad</div></a>
	</div>
	  <div class="col">

			<!--Middle Navbar-->
			<div class="navbar navbar-expand-md navbar-light row pl-0 pr-0 pt-0 pb-0">
				<div id='cssmenu' class="col-md-12">
					<ul class="navbar-nav m-auto col-12 pr-0 h-100 nav-tabs nav">
						<li class="nav-item col-md-3 text-center pl-0 pr-0">
				   			<a title="Cartelera" id="calendar-pane-a" class="nav-link active" href="#calendar_pane" data-toggle="tab" >Cartelera</a></li>
						<li class="nav-item col-md-3 text-center pl-0 pr-0">
				  			<a title="Artista" class="nav-link " href="#artists_pane" data-toggle="tab" >Artistas</a></li>
				   		<li class="nav-item col-md-3 text-center pl-0 pr-0">
				   			<a title="crowdfunding" id="crowdfunding-pane-a" class="nav-link" href="#crowdfunding_pane" data-toggle="tab" >Proyectos</a></li>
						<li class="nav-item col-md-3 text-center pl-0 pr-0">
				   			<a title="Blog" class="nav-link" href="#news_pane" data-toggle="tab" >Espacios</a></li>
					</ul>
				</div>
			</div>



<!-- Tab Panes -->



<div class="tab-content">

<!-- Artists Pane -->

		<div id="artists_pane" class="tab-pane fade in">

	<?// displayArtistPane($artistsArray)
		if(isMobileDevice()){

		 $i=1; ?>
		<? $lenghtArtists = count($artistsArray); ?>
		<? foreach($artistsArray as $artists):?>
		  <? if($i == 1 || $i == 3 || $i == 5): ?>
					<div class="row pt-lg-4">
			<? endif; ?>

			  <div class="col-md-4 card text-white artistCard align-items-end mt-4 mt-md-0 <? echo $i; ?>">
						<? if(file_exists('images/avatars/'.$artists['id_user'].'.jpg')): ?>
			      	<a href="profile.php?userid=<?=$artists['id_user']?>"><img src="images/avatars/<?=$artists['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$artists['id_user'].'.jpg')?>" class="card-img" alt="..."></a>
						<? else:?>
			      	<a href="profile.php?userid=<?=$artists['id_user']?>"><img src="images/avatars/profile_default.jpg" class="card-img" alt="..."></a>
						<? endif; ?>
			      <div class="card-img-overlay" style="display: block !important;">

			        <h2 class="card-title"><?=$artists['nick_user']?></h2>

			        <h3 class="card-text"><i class="fas fa-music"></i> <?=$artists['name_genre']?></h3>
			        <h3 class="card-text"><i class="fas fa-map-marker-alt"></i> <?=$artists['name_region']?></h3>

			      </div>

			   </div>

				<? if($i % 2 === 0 ): ?>
						</div>
				<? elseif($i == 5): ?>

				<? elseif($i == $lenghtArtists): ?>
					</div>
				<? endif; ?>

			  <? $i++; ?>
		<? endforeach;?>
		<? unset($i);

		}else{
				?>
		<? $i=1; ?>
		<? $lenghtArtists = count($artistsArray); ?>
		<? foreach($artistsArray as $artists):?>
		  <? if($i % 4 === 0 || $i == 1): ?>
					<div class="row pt-lg-4">
			<? endif; ?>

			   	<div class="col-md-4 card text-white artistCard <? echo ($i % 3 === 0) ? 'artistCardm' : '' ?> align-items-end mt-4 mt-md-0">

						<? if(file_exists('images/avatars/'.$artists['id_user'].'.jpg')): ?>
			      	<a href="profile.php?userid=<?=$artists['id_user']?>"><img src="images/avatars/<?=$artists['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$artists['id_user'].'.jpg')?>" class="card-img" alt="..."></a>
						<? else:?>
			      	<a href="profile.php?userid=<?=$artists['id_user']?>"><img src="images/avatars/profile_default.jpg" class="card-img" alt="..."></a>
						<? endif; ?>
			      <div class="card-img-overlay">

			        <h2 class="card-title"><?=$artists['nick_user']?></h2>

			        <h3 class="card-text"><i class="fas fa-music"></i> <?=$artists['name_genre']?></h3>
			        <h3 class="card-text"><i class="fas fa-map-marker-alt"></i> <?=$artists['name_region']?></h3>

			      </div>

			    </div>
				<? if($i % 3 === 0 ): ?>
						</div>
				<? elseif($i == $lenghtArtists): ?>
					</div>
				<? endif; ?>
			  <? $i++; ?>
		<? endforeach;?>
		<? unset($i);
		}?>
			<div class="row justify-content-center exploreCall">

				<div class="col-md-4 ">

					<a title="Buscador artistas" href="/search.php" type="button" class="btn btn-primary btn-lg btn-block text-white">Conoce más artistas</a>

				</div>

			</div>



		</div>

			<!-- Espacios -->

			<div id="news_pane" class="tab-pane fade in">

	 					<div class="row pt-lg-4">

							 <div class="col-md-4 card text-white artistCard align-items-end mt-4 mt-md-0">

								 <a href="https://landing.echomusic.cl/labodeguita"><img src="images/LBF.jpg?=<?=filemtime('images/LBF.jpg')?>" class="card-img" alt=""></a>

								 <div class="card-img-overlay">

									 <h2 class="card-title">La bodeguita de Fernando</h2>
									 <h3 class="card-title font-weight-bold"><i class="fas fa-map-marker-alt"></i> Ñuñoa</h3>

								 </div>

							 </div>


							 <div class="col-md-4 card text-white artistCard align-items-end mt-4 mt-md-0">

								 <a href="https://drive.google.com/file/d/1ASbTW1_tWsenKXwjs7ekfk9cdhPRdCaD/view?usp=sharing"><img src="images/CR.jpg?=<?=filemtime('images/CR.jpg')?>" class="card-img" alt=""></a>

								 <div class="card-img-overlay">

									 <h2 class="card-title">CreaRock</h2>
									 <h3 class="card-title font-weight-bold"><i class="fas fa-map-marker-alt"></i> Santiago</h3>

								 </div>

							 </div>

							 <div class="col-md-4 card text-white artistCard align-items-end mt-4 mt-md-0">

								 <a href="https://landing.echomusic.cl/barpuertamarilla"><img src="images/LPA.jpg?=<?=filemtime('images/LPA.jpg')?>" class="card-img" alt=""></a>

								 <div class="card-img-overlay">

									 <h2 class="card-title">La puerta amarilla</h2>
									 <h3 class="card-title font-weight-bold"><i class="fas fa-map-marker-alt"></i> Providencia</h3>

								 </div>

							 </div>

					 </div>

					 <div class="row pt-lg-4">

							 <div class="col-md-4 card text-white artistCard align-items-end mt-4 mt-md-0">

								 <a href="https://plectrum.cl/wp-content/uploads/2022/06/PLTM-Brochure-Servicios-y-Tarifas-2022.pdf"><img src="images/PLKTRM.jpg?=<?=filemtime('images/PLKTRM.jpg')?>" class="card-img" alt=""></a>

								 <div class="card-img-overlay">

									 <h2 class="card-title">Plectrum Studio</h2>
									 <h3 class="card-title font-weight-bold"><i class="fas fa-map-marker-alt"></i> Santiago</h3>

								 </div>

							 </div>


							 <div class="col-md-4 card text-white artistCard align-items-end mt-4 mt-md-0">

								 <a href="https://landing.echomusic.cl/mesondellago"><img src="images/MSN.jpg?=<?=filemtime('images/MSN.jpg')?>" class="card-img" alt=""></a>

								 <div class="card-img-overlay">

									 <h2 class="card-title">Mesón del lago</h2>
									 <h3 class="card-title font-weight-bold"><i class="fas fa-map-marker-alt"></i> Villarrica</h3>

								 </div>

							 </div>

							 <!-- <div class="col-md-4 card text-white artistCard align-items-end mt-4 mt-md-0">

								 <a href="https://landing.echomusic.cl/barpuertamarilla"><img src="images/LPA.jpg?=<?=filemtime('images/LPA.jpg')?>" class="card-img" alt=""></a>

								 <div class="card-img-overlay">

									 <h2 class="card-title">La puerta amarilla</h2>
									 <h3 class="card-title font-weight-bold"><i class="fas fa-map-marker-alt"></i> Providencia</h3>

								 </div>

							 </div> -->

					 </div>

					 <div class="row justify-content-center exploreCall">

		 				<div class="col-md-4 ">

		 					<a title="encuentra mas noticias" href="/contacto_empresas.php" class="btn btn-primary btn-lg btn-block text-white">¿Tienes un espacio?</button></a>

		 				</div>

		 			</div>

		</div>


<!-- Calendar Pane -->

		<div id="calendar_pane" class="tab-pane fade in  active show">

			<? $i=1; ?>
			<? $lenghtEvents = count($calendar1mArray); ?>
			<? foreach($calendar1mArray as $index => $events):?>
			<? switch($events['id_type_event']){
				case '2':
					$typeEvent = 'public';
					$dateTimeEvent = date_create($events['date_event']);
					$timeEvent = DATE_FORMAT($dateTimeEvent, "H:i");
					$dateEvent = DATE_FORMAT($dateTimeEvent, "d-m-Y");
				break;
				case '3':
					$typeEvent = 'linked';
					$dateTimeEvent = date_create($events['public_date_event']);
					$timeEvent = DATE_FORMAT($dateTimeEvent, "H:i");
					$dateEvent = DATE_FORMAT($dateTimeEvent, "d-m-Y");
				break;
				case '4':
					$typeEvent = 'streaming';
					$dateTimeEvent = date_create($events['date_event']);
					$timeEvent = DATE_FORMAT($dateTimeEvent, "H:i");
					$dateEvent = DATE_FORMAT($dateTimeEvent, "d-m-Y");
				break;
			}?>
			  <? if($i % 4 === 0 || $i == 1): ?>
						<div class="row pt-lg-4">
				<? endif; ?>

				   	<div class="col-md-4 card text-white artistCard <? echo ($i % 3 === 0) ? 'artistCardm' : '' ?> align-items-end mt-4 mt-md-0">

				      <a title="evento <?=$events['name_event']?>" href="event.php?<?=$typeEvent?>=<?=$events['id_event']?>"><img src="images/events/<?=$events['img']?>.jpg?=<?=filemtime('images/events/'.$events['img'].'.jpg')?>" class="card-img" alt="foto del evento <?=$events['name_event']?>"></a>

				      <div class="card-img-overlay">

				        <h2 class="card-title"><?=$events['name_event']?></h2>

								<? if($events['id_type_event']=='4'): ?>
									<h3 class="card-text mb-0">Streaming</h3>
								<? else: ?>
									<h3 class="card-text mb-0"><?=$events['name_city']?></h3>
								<? endif; ?>
				        <h3 class="card-text"><?=$dateEvent?> <?=$timeEvent?> hrs</h3>

				      </div>

				    </div>
						<? if($i % 3 === 0 ): ?>
								</div>
						<? elseif($i == $lenghtEvents): ?>
							</div>
						<? endif; ?>
				  <? $i++; ?>
			<? endforeach;?>
			<? unset($i);?>

			<div class="row justify-content-center exploreCall">
				<div class="col-md-4 ">
					<a title="calendario eventos" href="/calendar_echomusic.php" type="button" class="btn btn-primary btn-lg btn-block text-white">Conoce nuestra cartelera</a>
				</div>
			</div>
		</div>
<!-- crowdfunding Pane -->

   <div id="crowdfunding_pane" class="tab-pane fade in">
	<?// displayArtistPane($artistsArray)
		if(isMobileDevice()){

		 $i=1; ?>
		<? $lenghtProjects = count($projectsArray); ?>
		<? foreach($projectsArray as $projects):?>
		  <? if($i == 1 || $i == 3 || $i == 5): ?>
					<div class="row pt-lg-4">
			<? endif; ?>

			   	<div class="col-md-4 card text-white artistCard align-items-end mt-4 mt-md-0 <? echo $i; ?>">

			      	<a href="proyecto.php?projectid=<?=$projects['id_project']?>"><img src="images/crowdfunding/pr_<?=$projects['id_project']?>/<?=$projects['id_project']?>.jpg?=<?=filemtime('images/crowdfunding/pr_'.$projects['id_project'].'/'.$projects['id_project'].'.jpg')?>" class="card-img" alt="..."></a>

						<div class="card-img-overlay">

			        <h2 class="card-title"><?=$projects['project_title']?></h2>

			        <h3 class="card-text"><i class="fas fa-music"></i> <?=$projects['name_category']?></h3>
			        <h3 class="card-text"><i class="fas fa-user"></i> <?=$projects['nick_user']?></h3>

			      </div>

			    </div>

				<? if($i % 2 === 0 ): ?>
						</div>
				<? elseif($i == 5): ?>

			<? elseif($i == $lenghtProjects): ?>
					</div>
				<? endif; ?>

			  <? $i++; ?>
		<? endforeach;?>
		<? unset($i);

		}else{
				?>
		<? $i=1; ?>
		<? $lenghtProjects = count($projectsArray); ?>
		<? foreach($projectsArray as $projects):?>
		  <? if($i % 4 === 0 || $i == 1): ?>
					<div class="row pt-lg-4">
			<? endif; ?>

			   	<div class="col-md-4 card text-white artistCard <? echo ($i % 2 === 0) ? ' ' : '' ?> align-items-end mt-4 mt-md-0">

			      	<a href="proyecto.php?projectid=<?=$projects['id_project']?>"><img src="images/crowdfunding/pr_<?=$projects['id_project']?>/<?=$projects['id_project']?>.jpg?=<?=filemtime('images/crowdfunding/pr_'.$projects['id_project'].'/'.$projects['id_project'].'.jpg')?>" class="card-img" alt="..."></a>

			      <div class="card-img-overlay">

			        <h2 class="card-title"><?=$projects['project_title']?></h2>

			        <h3 class="card-text"><i class="fas fa-music"></i> <?=$projects['name_category']?></h3>
			        <h3 class="card-text"><i class="fas fa-user"></i> <?=$projects['nick_user']?></h3>

			      </div>

			    </div>
				<? if($i % 3 === 0 ): ?>
						</div>
				<? elseif($i == $lenghtProjects): ?>
					</div>
				<? endif; ?>
			  <? $i++; ?>
		<? endforeach;?>
		<? unset($i);
		}?>

			<div class="row justify-content-center exploreCall">

				<div class="col-md-4 ">

					<a title="encuentra mas proyectos" href="search_crowdfunding.php" class="btn btn-primary btn-lg btn-block text-white">Conoce más proyectos</a>

				</div>

			</div>



		</div>


    </div>



   </div>


	<div class="col col-120">
		<div class="skhis-right">publicidad</div>
	</div>

	</div>

</div>

<div class="videoWrapper videoWrapper169 js-videoWrapper">

	      <iframe class="videoIframe js-videoIframe"  allowfullscreen data-src="https://player.vimeo.com/video/585924288?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479&amp;h=7450f42d76" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"  style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Spot EchoMusic con Subt&amp;iacute;tulos"></iframe><script src="https://player.vimeo.com/api/player.js"></script>
	    <!--<div id="text-video-conocenos" class="text-video" >Conoce más de EchoMusic</div>-->
	    <button id="button-video-conocenos" class="videoPoster js-videoPoster" style="background-image:url(images/index/fondo-video-index.png);">
	   		<svg class="video-overlay-play-button" viewBox="0 0 200 200" alt="Play video">
	   			<circle cx="100" cy="100" r="90" fill="none" stroke-width="15" stroke=""/>
	   			<polygon points="70, 55 70, 145 145, 100" fill=""/>
	   		</svg>
		</button>
  </div>

<div class="" id="">
	<div class="row wt-80 justify-content-center" id="">
		<div id="home-cuadrosvca" class="col-lg-4 col-md-6 col-6 text-center text-black">
		  <label class="text-vca">
		    <img width="120" src="images/index/carrera-musical.png">
		  <h3 style="font-weight: 700;">DESARROLLA TU CARRERA MUSICAL</h3>
		<div class="service-description">
			Crea gratis tu perfil digital para conseguir nuevos fans, oportunidades de negocios o recauda fondos para tu próximo proyecto.
		  </div>
		  </label>
		</div>
		<div id="home-cuadrosvca" class="col-lg-4 col-md-6 col-6 text-center text-black" >
			<label class="text-vca">
			<img width="120" src="images/index/Emplea-servicios.png">
			<h3 style="font-weight: 700;">RENTABILIZA TU TALENTO</h3>
			<div class="service-description">
			Con tu perfil digital podrás ser contratado para eventos. Crea tu evento presencial o streaming y genera ingresos a través de venta de ticket o donaciones.
			</div>
			</label>
		</div>
		<div id="home-cuadrosvca" class="col-lg-4 col-md-6 col-12 text-center text-black">
			<label class="text-vca">
			<img width="120" src="images/index/Monetiza-carrera.png">
			<h3 style="font-weight: 700;">EMPLEABILIDAD DE SERVICIOS</h3>
			<div class="service-description">
			Obtén ingresos empleando tus servicios profesionales afines en la comunidad. (próximamente)
			</div>
			</label>
		</div>
	</div>
</div>

<!-- aqui-->
	<div class="wt-80">
		<div class="row justify-content-center adContainer">
			<div class="col-12 "></div>
		</div>
	</div>


<!-- Second Banner -->

	<div class="row text-white mx-0 my-5">

	    <div id="indexSecondBanner" class="col-lg-6 col-md-6 col-12 m-0 px-5">

	      <h2 class="text-center">Crea tu evento en nuestra Cartelera</h2>

	      <h3 class="text-center">En nuestra plataforma puedes crear tu propio evento presencial
					o streaming para llevar tu música a todo el mundo
					y rentabilizar tu talento.
				</h3>

	      <div class="indexSecondBanner-btn text-center"><a title="Crear eventos" class="btn btn-outline-primary btn-lg" href="https://landing.echomusic.cl/ticketing" role="button">Crear mi Evento &raquo;</a></div>

	    </div>


	    <div id="indexThirdBanner" class="col-lg-6 col-md-6 col-12 m-0 px-5">

	      <h2 class="text-center">Recauda fondos para tu proyecto musical</h2>

	      <h3 class="text-center">Reúne los fondos para tu próximo proyecto musical que puede ir desde un single hasta un álbum o un video clip. ¡Anímate! </h3>

	      <div class="indexSecondBanner-btn text-center"><a title="Crear crowdfunding" class="btn btn-outline-primary btn-lg" href="https://landing.echomusic.cl/crowdfunding" role="button">Crear mi proyecto Crowdfunding</a></div>

	    </div>

    </div>


<!-- Call to Action

		<div class="container">

			<div class="row" id="indexMainCall">

		    <div class="text-center col-12 align-self-center">

					<div class="col-12 first-block">

			      <h1>Únete a nuestra comunidad</h1>

			      <h2>Y encuentra bandas, DJ´s y eventos en vivo.</h2>

					</div>

		      <div class="col-lg-3 col-md-6 col-8 second-block"><a title="Crear tu cuenta" class="btn btn-primary btn-lg btn-block" href="register.php" role="button">Crea tu cuenta</a></div>

		      <div class="third-block"><span>¿Ya tienes cuenta?</span> <a class="btn btn-outline-info btn-lg" data-toggle="modal" data-target="#loginModal" role="button">Inicia Sesión</a></div>

		    </div>

		  </div>

	  </div>
-->
	<!-- Testimonios-->
		<div class="wt-80 my-5">
			<div id="card-testimonios" class="row justify-content-center">
		        <div id="card-testimonios-col" class="col-lg-4 col-md-6 col-12">
		          <div class="card shadow-sm card-testimonios-card" >
						<img  src="images/index/testimonial-1.png" alt="foto testimonio de Franks White canvas">
		          	<em class="mx-5">"Un punto de encuentro para la industria de la música en Chile".</em> <br>
		          	<div style="top: 2rem; position: relative;">
		          	Artista</div>
		          	<a class="card-testimonios-button" href="https://qa.echomusic.cl/profile.php?userid=13">Frank's White Canvas</a>
		          </div>
		        </div>
		        <div id="card-testimonios-col" class="col-lg-4 col-md-6 col-12">
		          <div class="card shadow-sm card-testimonios-card" >
						<img  src="images/index/testimonial-2.png" alt="foto testimonio de Kato">
		          	<em class="mx-5">"Era justo lo que necesitabamos los artistas emergentes para empezar a monetizar nuestro show con herramientas que tod@s tenemos en casa".</em> <br>
		          	<div style="top: 2rem; position: relative;">
		          	Artista</div>
		          	<a class="card-testimonios-button" href="https://qa.echomusic.cl/profile.php?userid=11">Kato</a>
		          </div>
		        </div>
		        <div id="card-testimonios-col" class="col-lg-4 col-md-6 col-12">
		          <div class="card shadow-sm card-testimonios-card" >
						<img  src="images/index/testimonial-3.png" alt="foto testimonio de Kato">
		          	<em class="mx-5">"EchoMusic va a romper lo tradicional en cuanto a la difusion digital de contenido via streaming".</em> <br>
		          	<div style="top: 2rem; position: relative;">
		          	Ingeniero sonido live & streaming</div>
		          	<div class="card-testimonios-button" style="">Carlos Hormazabal</div>
		          </div>
		        </div>
			</div>
		</div>

	  	<div class="wt-80">
			<div class="row justify-content-center adContainer">
				<div class="col-12"></div>
			</div>
		</div>

		<!-- /container -->

	</main>

	<!-- Publish Modal -->
				<div class="modal" id="alertModal" tabindex="-1" role="dialog">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Aviso importante</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <p>Actualmente estamos presentando demoras en el envío de los correos desde nuestros servidores. </br>Nuestro equipo esta trabajando para solucionar este problema a la brevedad</p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
				</div>


<!-- Scripts -->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<script src="assets/slick/slick.js" type="text/javascript" charset="utf-8"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->

			<? include 'resources/login_error_script.php'; ?>

<!-- Footer -->

	<?php

		include 'resources/footer.php';

	 ?>





		<script type="text/javascript">
			$(document).on('click','#button-video-conocenos',function(ev) {
			  $("#text-video-conocenos").css("display","none");
			});
			// poster frame click event
			$(document).on('click','.js-videoPoster',function(ev) {
			  ev.preventDefault();
			  var $poster = $(this);
			  var $wrapper = $poster.closest('.js-videoWrapper');
			  videoPlay($wrapper);
			});

			// play the targeted video (and hide the poster frame)
			function videoPlay($wrapper) {
			  var $iframe = $wrapper.find('.js-videoIframe');
			  var src = $iframe.data('src');
			  // hide poster
			  $wrapper.addClass('videoWrapperActive');
			  // add iframe src in, starting the video
			  $iframe.attr('src',src);
			}

			// stop the targeted/all videos (and re-instate the poster frames)
			function videoStop($wrapper) {
			  // if we're stopping all videos on page
			  if (!$wrapper) {
			    var $wrapper = $('.js-videoWrapper');
			    var $iframe = $('.js-videoIframe');
			  // if we're stopping a particular video
			  } else {
			    var $iframe = $wrapper.find('.js-videoIframe');
			  }
			  // reveal poster
			  $wrapper.removeClass('videoWrapperActive');
			  // remove youtube link, stopping the video from playing in the background
			  $iframe.attr('src','');
			}

			// Script overlay Artists Cards

			$('.artistCard').hover( function() {



				var parent = $(this).closest('.artistCard'); // find closest sub_page

	 			$('.card-img-overlay', parent).show();



			});



			$('.artistCard').on( "mouseleave", function() {



				var parent = $(this).closest('.artistCard'); // find closest sub_page

	 			$('.card-img-overlay', parent).hide();



			});
			$('.projectCard').hover( function() {
				var parent = $(this).closest('.projectCard'); // find closest sub_page
	 			$('.card-img-overlay', parent).show();
			});

			$('.projectCard').on( "mouseleave", function() {
				var parent = $(this).closest('.projectCard'); // find closest sub_page
	 			$('.card-img-overlay', parent).hide();
			});



			// Script overlay Events Cards

			$('.newsCard').hover( function() {



				var parent = $(this).closest('.newsCard'); // find closest sub_page

	 			$('.card-img-overlay', parent).show();



			});



			$('.newsCard').on( "mouseleave", function() {



				var parent = $(this).closest('.newsCard'); // find closest sub_page

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


			// Slick
$(document).ready(function(){
	$("#calendar-pane-a").click(function(){
		$(".slick-track").css("transform","translate3d(-50%, 0px, 0px)");
		$(".slick-list").css("height","59vh");
	});

});

$(window).on('load', function() {

	$('.calendar-slick').slick({

				slidesToShow: 3,
				slidesToScroll: 1,
				arrows: true,
				dots: true,
				pauseOnHover: false,
				responsive: [{
					breakpoint: 768,
					settings: {
						slidesToShow: 1
					}
				}, {
					breakpoint: 520,
					settings: {
						slidesToShow: 1
					}
				}]
			});
});

			</script>

		<? include 'resources/googleLoginScript.php'; ?>

			<!-- <script type="text/javascript">
			    $(window).on('load', function() {
			        $('#alertModal').modal('show');
			    });
			</script> -->


	</body>

</html>
