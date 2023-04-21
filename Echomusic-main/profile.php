<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

include 'resources/profile_script.php';
include 'resources/login_script.php';
include 'resources/multimediaDetail_script.php';
/*
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

		<title>Perfil | <?=$userProfile_array['nick_user']?></title>

		<meta charset="utf-8" />
		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />

		<meta name="og:image" content="https://qa.echomusic.cl/images/avatars/<?=$userInfo_array['id_user']?>.jpg" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="<?=$userProfile_array['nick_user']?> | EchoMusic.cl" />

		<meta name="description" content="<?=$userProfile_array['desc_user']?>" />

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="assets/slick/slick.css">
		<link rel="stylesheet" type="text/css" href="assets/slick/slick-theme.css">

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


		 <!-- All Ratings -->

		 <?php

			 include 'resources/ratings_modal.php';

			?>


		 <!-- Bio Modal -->

		 <div class="modal fade" id="bioModal" tabindex="-1" role="dialog" aria-labelledby="bioModalLabel" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content">

			      <div class="modal-header">

			        <h5 class="modal-title">Biografía</h5>

			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

			          <span aria-hidden="true">&times;</span>

			        </button>

			      </div>

			      <div class="modal-body">

			        <p><?=nl2br($userBio['bio_user'])?></p>

			      </div>

			      <div class="modal-footer">

			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

			      </div>

			    </div>

			  </div>

			</div>

			<!-- Next Events Modal -->

		 <div class="modal fade" id="nextEventsModal" tabindex="-1" role="dialog" aria-labelledby="nextEventsModalLabel" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content">

			      <div class="modal-header">

			        <h5 class="modal-title">Próximos Eventos de <?=$userProfile_array['nick_user']?></h5>

			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

			          <span aria-hidden="true">&times;</span>

			        </button>

			      </div>

			      <div class="modal-body">
						<? if($nextEventsActive == true): ?>
			      	<div class="table-responsive">

							<table class="table">

								<thead>

									<tr>

										<th scope="col">Nombre</th>

										<th scope="col">Hora</th>

										<th scope="col">Fecha</th>

									</tr>

								</thead>

								<tbody>

									<? foreach($nextEventsArray as $nextEvents):?>
									<? $nextEventsDate = date_create($nextEvents['date_event']); ?>
									<tr>

										<!-- <td><a href="event.php?linked=<?=$nextEvents[0]?>"><?=$nextEvents['public_name_event']?></a></td> -->
										<? switch($nextEvents['id_type_event']):case '2':?>
												<td><a href="event.php?public=<?=$nextEvents['id_event']?>"><?=$nextEvents['name_event']?></a></td>
											<? break;?>
											<?case '3';?>
												<td><a href="event.php?linked=<?=$nextEvents['id_event']?>"><?=$nextEvents['name_event']?></a></td>
											<?break;?>
											<?case '4';?>
												<td><a href="event.php?streaming=<?=$nextEvents['id_event']?>"><?=$nextEvents['name_event']?></a></td>
											<?break;?>
										<?endswitch;?>
										<td><?=date_format($nextEventsDate, "H:i")?></td>

										<th scope="row"><?=date_format($nextEventsDate, "d-m-Y")?></th>

									</tr>

									<? endforeach; ?>

								</tbody>

							</table>
						</div>
					<? else:?>
					<p>No hay eventos cercanos.</p>
					<? endif; ?>
			      </div>

			      <div class="modal-footer">

			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

			      </div>

			    </div>

			  </div>

			</div>





<!-- Main Content -->



		<!-- First Banner -->

		<div id="profileMainBanner" class="jumbotron">

			<div class="backgroundImage container" style="background-position: center top; background-image: linear-gradient(to top, rgba(50, 50, 50, 0.20), rgba(0, 1, 13, 0.20)), url('../../images/covers/<?=$userInfo_array['id_user']?>.jpg?=<?=filemtime('images/covers/'.$userInfo_array['id_user'].'.jpg')?>');">
				<div class="container text-right">
					<? if(isset($checkUser) && $checkUser==true): ?>
						<a id="editProfile" class="btn btn-primary" style="cursor:pointer;" href="edit_profile.php?userid=<?=$userid?>" >Editar Perfil <i class="fas fa-cog"></i></a>
					<? endif; ?>
				</div>
    	</div>



			<div class="profileImage text-center">

				<? if(file_exists('images/avatars/'.$userInfo_array['id_user'].'.jpg')): ?>
					<img alt="..." src="images/avatars/<?=$userInfo_array['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$userInfo_array['id_user'].'.jpg')?>">
				<? else: ?>
					<img alt="" src="images/avatars/profile_default.jpg">
				<? endif; ?>

			</div>

		</div>



		<!-- Container -->

		<div class="container" id="profileContainer">
<!-- Breadcrumb -->

				<nav aria-label="breadcrumb" id="profileBreadcrumb">

				  <ol class="breadcrumb mb-0">

				    <li class="breadcrumb-item"><a href="<?=$breadCrumbUrl?>"><?=$breadCrumbName?></a></li>

				    <li class="breadcrumb-item active" aria-current="page">Perfil</li>

				  </ol>

				</nav>


			<!-- Name Info -->

			<div class="row justify-content-center" id="artistHeadInfo">

				<div class="col-md-12 text-center">

					<h1><?=$userInfo_array['nick_user']?></h1>

				</div>
			</div>
			<div class="row justify-content-center" id="artistHeadInfo">

				<div class="col-md-auto col-sm-12 text-center">

					<p class="mb-0 mb-md-3 mb-lg-3">Seguidores <b><?=$countFollowers?></b></p>

				</div>

				<div class="col-md-auto col-sm-12 text-center">

					<p class="mb-0 mb-md-3 mb-lg-3">Seguidos <b><?=$countFollows?></b></p>

				</div>

				<div class="col-md-auto col-sm-12 text-center">

					<p class="mb-3 mb-md-3 mb-lg-3">Publicaciones <b><?=$countPublications?></b></p>

				</div>

			</div>



			<!-- Profile Options -->

			<div class="row">

				<div class="col-md-6  text-leftcenter order-2">
					<? if(isset($_SESSION['user']) && $checkUser == false && $followingUser == NULL): ?>
						<button id="follow_button" onClick="followUser(<?=$userInfo_array['id_user']?>)" class="btn btn-small btn-primary btn-sm mb-3 mb-md-0 col-md-2 btn-profile"><i class="fas fa-user-plus"></i> Seguir</button>
						<button id="following_button" onClick="unfollowUser(<?=$userInfo_array['id_user']?>)" class="btn btn-small btn-primary btn-sm mb-3 mb-md-0 col-md-4 btn-profile" style="display:none;"><i class="fas fa-user-minus"></i> Dejar de seguir</button>
					<? elseif(isset($_SESSION['user']) && $checkUser == false && $followingUser == true): ?>
						<button id="follow_button" onClick="followUser(<?=$userInfo_array['id_user']?>)" class="btn btn-small btn-primary btn-sm mb-3 mb-md-0 col-md-2 btn-profile" style="display:none;"><i class="fas fa-user-plus"></i> Seguir</button>
						<button id="following_button" onClick="unfollowUser(<?=$userInfo_array['id_user']?>)" class="btn btn-small btn-primary btn-sm mb-3 mb-md-0 col-md-4 btn-profile"><i class="fas fa-user-minus"></i> Dejar de seguir</button>
					<? elseif(isset($_SESSION['user']) && $checkUser == true): ?>
						<button class="btn btn-small btn-primary btn-sm mb-3 mb-md-0 col-md-2 btn-profile isDisabled"><i class="fas fa-user-plus"></i> Seguir</button>
					<? else: ?>
						<button data-toggle="modal" data-target="#loginModal" class="btn btn-small btn-primary btn-sm mb-3 mb-md-0 col-md-2 btn-profile"><i class="fas fa-user-plus"></i> Seguir</button>
					<? endif; ?>
					<a href="" data-toggle="modal" data-target="#nextEventsModal" class="btn btn-primary btn-sm mb-3 mb-md-0  col-md-4 btn-profile"><i class="fas fa-plus"></i> Próximos Eventos</a>
				</div>

				<div class="col-md-6 text-rightcenter order-1 order-md-2">
					<a href="" class="btn btn-small btn-primary font-weight-bold mb-3 btn-profile " style="cursor:pointer;" data-toggle="modal" data-target="#bioModal">Biografía</a>
				</div>

			</div>



			<!-- Plans -->

			<div class="row" id="artistPlans">

				<div class="col-md-3 text-left first-block">
					<h2 class="my-4 font-weight-bold">Tarifas</h2>
				</div>
				<div role="button" class="col-md-9 text-right second-block">

					<h2 data-toggle="collapse" data-target="#collapsePlans" aria-expanded="false" aria-controls="collapseFilters" class="my-4">Ver Tarifas <i class="fas fa-caret-down"></i></h2>

				</div>

				<div class="col-2">

				</div>

			</div>

			<div class="row collapse" id="collapsePlans">
				<? $a = 0;?>
				<? foreach($planArray as $pricingArray): ?>
					<? if($pricingArray['active'] == "active"): ?>

						<div class="col-sm-12 col-md-6 col-lg-4 collapse show order-<?=$b?>" id="planSlot-<?=$b?>">

							<div class="card">

								<div class="card-body text-center">

										<p class="card-title plan-title"><?=$pricingArray['name_plan']?></p>

								<hr>

									<p class="card-text plan-price">$<?=number_format($pricingArray['value_plan'] , 0, ',', '.')?></p>

								<hr>

									<dl class="row">

										<dt class="col-7 text-left">Duración</dt>

										<dd class="col-5"><?=$pricingArray['duration_hours']?>hr <?=$pricingArray['duration_minutes']?>min</dd>


										<dt class="col-7 text-left">Backline</dt>

										<dd class="col-5"><?=$pricingArray[15]?></dd>


										<dt class="col-7 text-left">Refuerzo Sonoro</dt>

										<dd class="col-5"><?=$pricingArray[19]?></dd>


										<dt class="col-7 text-left">Sonidista</dt>

										<dd class="col-5"><?=$pricingArray[17]?></dd>


										<dt class="col-7 text-left">Nº de Músicos</dt>

										<dd class="col-5"><?=$pricingArray['artists_amount']?></dd>

									</dl>

								<hr>

									<p class="">

										<?=$pricingArray['desc_plan']?>

									</p>
									<? if(isset($_SESSION['user']) && $checkUser == false): ?>
										<form action="reserve_artist.php" method="post">
											<input type="hidden" name="planInfo" value="<?=$pricingArray['id_plan']?>" />
											<input type="hidden" name="idArtist" value="<?=$userid?>" />
											<button type="submit" name="submit_contract" class="btn btn-primary btn-block">Reservar</button>
										</form>
									<? elseif(isset($_SESSION['user']) && $checkUser == true): ?>
										<a type="button" href="dashboard.php" class="btn btn-primary btn-block">Editar en Panel de Control</a>
									<? else: ?>
										<button type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-block">Reservar</button>
									<? endif; ?>
								</div>

							</div>

						</div>

					<? elseif($pricingArray['active'] == "none"): ?>
						<? $a++; ?>
					<? endif; ?>

				<? endforeach; ?>

				<? if($a==3): ?>
				<div class="col-12">
					<p>El artista no tienen fijada sus tarifas de cobro. Solicita tu cotización aquí</p>
				</div>
					<? if(isset($_SESSION['user'])): ?>
							<div class="col-12">
									<form acion="" method="post">
										<div class="form-row mt-3">
											<div class="form-group col-lg-6">

												<label class="font-weight-bold" for="artistCotizacion">Artista</label>

												<input type="text" value="<?=$userInfo_array['nick_user']?>" class="form-control form-custom-1 disabled" id="artistCotizacion" readonly disabled>

												<span class="text-danger"><strong class="alert"><?php if ( isset($first_nameError)) { echo $first_nameError;}; ?></strong></span>

											</div>

											<div class="form-group col-lg-6">

												<label class="font-weight-bold" for="asuntoCotizacion">Asunto</label>

												<input placeholder="ej: Cotización evento cumpleaños" type="text" name="asuntoCotizacion" value="<?if(isset($first_name)){ echo $first_name;  }?>" class="form-control form-custom-1" id="asuntoCotizacion">

												<span class="text-danger"><strong class="alert"><?php if ( isset($asuntoCotizacionError)) { echo $asuntoCotizacionError;}; ?></strong></span>

											</div>
										</div>

											<div class="form-row mt-3">

												<div class="form-group col-md-8 col-sm-12">

													<label class="font-weight-bold" for="descCotizacion">Cotiza una contratación</label>

													<textarea name="descCotizacion" placeholder="Mínimo 50 caracteres" class="form-control form-custom-1" id="descCotizacion" rows="6"><?if(isset($desc)){ echo str_replace("\'","'",$desc);  }?></textarea>

													<span class="text-danger"><strong class="alert"><?php if ( isset($descCotizacionError)) { echo $descCotizacionError;} ?></strong></span>

												</div>

											</div>
											<div class="form-row mt-3">

												<button type="submit" name="cotizacion_submit" class="btn btn-primary btn-lg">Enviar</button>

											</div>
										<!-- </div> -->
									</form>
								</div>
					<? else: ?>
							<button data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-lg">Inicia sesión</button>
					<? endif; ?>
				<? endif; ?>

			</div>

			<!-- Artist Featured Track and Description -->

			<div class="row mt-5 mb-5">

				<div class="col-md-7 col-lg-7 col-sm-12 order-2 order-lg-1">
					<!-- Soundcloud iframe -->
					<?=$userTracks['embed_multi']?>
				</div>

				<div class="col-md-5 col-md-5 col-sm-12 order-1 order-lg-2 mb-4 mb-md-0" id="artistDescription">

					<p class="font-weight-bold">Descripción</p>

					<p><?=$userProfile_array['desc_user']?></p>

					<p class="font-weight-bold">Compartir en:</p>
					<div class="row">

						<div class="col-4">

							<a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/sharer.php?u=https://qa.echomusic.cl/profile.php?userid=<?=$userid?>"><i class="fab fa-facebook-square"></i> Facebook</a>

						</div>

						<div class="col-4">

							<a href="https://api.whatsapp.com/send?text=https://qa.echomusic.cl/profile.php?userid=<?=$userid?>" data-action="share/whatsapp/share" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp-square"></i> Whatsapp</a>

						</div>

						<div class="col-4">

							<a target="_blank" rel="noopener noreferrer" href="https://twitter.com/share?url=https://qa.echomusic.cl/profile.php?userid=<?=$userid?>"><i class="fab fa-twitter-square"></i> Twitter</a>

						</div>

					</div>

				</div>

			</div>

			<div class="row mb-5">

				<div class="col-md-3">

					<i class="fas fa-guitar"></i> Tipo de Artista <span class="font-weight-bold"><?=$userProfile_array['name_musician']?></span>

				</div>

				<div class="col-md-3">

					<i class="fas fa-music"></i> Género Musical <span class="font-weight-bold"><?=$userGenre_array['name_genre']?></span>

				</div>

				<div class="col-md-4">

					<i class="fas fa-map-marker-alt"></i> Región <?=$userProfile_array['name_region']?> <span class="font-weight-bold"><?=$userProfile_array['name_city']?></span>

				</div>

			</div>



			<hr>

			<!-- Video Section -->
			<? if(mysqli_num_rows($queryMultimedia)>0):?>
			<div class="row mt-4" id="videoContainerSection">

				<div class="col-12 mt-2 mb-4"><h2 class="font-weight-bold"><?=$postDetail['title_multi']?></h2></div>

				<div class="col-lg-7 col-sm-12 mb-3 mb-md-0" id="featuredVideo">
					<? switch($postDetail['service_multi']):case "youtube":?>
						<iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?=$postDetail['embed_multi']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<? break; ?>
					<? case "vimeo": ?>
						<iframe width="100%" height="100%" src="https://player.vimeo.com/video/<?=$postDetail['embed_multi']?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
					<? break; ?>
					<? endswitch; ?>

				</div>

				<div class="col-lg-5 col-sm-12 pt-4 pb-4" id="featuredVideo-box">

						 <div class="row justify-content-between">

								 <? if(isset($_SESSION['user'])  && $likeMultimedia == false): ?>
								 	<div class="col" id="like_button">
									 	<span id="countLikes1"><?=$countLikes?> </span><a onClick="likeMultimedia(<?=$idPost?>)" class="font-weight-bold"><i class="far fa-heart"></i> Me Gusta</a>
									</div>
									<div class="col" id="liked_button" style="display:none;">
										<span id="countLikes2"><?=$countLikes?> </span><a onClick="unlikeMultimedia(<?=$idPost?>)" class="font-weight-bold"><i class="fas fa-heart"></i> Me Gusta</a>
									</div>
								 <? elseif(isset($_SESSION['user'])  && $likeMultimedia == true): ?>
									 <div class="col" id="like_button" style="display:none;">
										 <span id="countLikes1"><?=$countLikes?> </span><a onClick="likeMultimedia(<?=$idPost?>)" class="font-weight-bold"><i class="far fa-heart"></i> Me Gusta</a>
									 </div>
									 <div class="col" id="liked_button">
										 <span id="countLikes2"><?=$countLikes?> </span><a onClick="unlikeMultimedia(<?=$idPost?>)" class="font-weight-bold"><i class="fas fa-heart"></i> Me Gusta</a>
									 </div>
								 <? else: ?>
									 <div class="col" id="liked_button">
										 <span id="countLikes2"><?=$countLikes?> </span><a class="font-weight-bold"><i class="fas fa-heart"></i> Me Gusta</a>
									 </div>
								 <? endif; ?>


							 <div class="col text-right">

								 <span><?=$commentsCount?> comentarios</span>

							 </div>

						 </div>

					<hr>

					<div class="col-12 overflow-auto" id="commentariesBox">

						<ul class="list-unstyled" id="commentariesList">
							<? foreach($postCommentsArray as $postComments): ?>
								<li>

									<div class="row mt-3">

										<? if(file_exists('images/avatars/'.$postComments['ID_user_comment'].'.jpg')): ?>
								    	<label for="commentInput" class="col-1 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/<?=$postComments['ID_user_comment']?>.jpg?=<?=filemtime('images/avatars/'.$postComments['ID_user_comment'].'.jpg')?>"></label>
		                <? else: ?>
								    	<label for="commentInput" class="col-1 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/profile_default.jpg"></label>
		                <? endif; ?>

								    <div class="col-10 commentText pt-2 ml-3">

											<p class="font-weight-bold mb-1"><? echo ($postComments['nick_user'] === NULL) ? $postComments['first_name_user'] : $postComments['nick_user'];?></p>

								      <p class="mb-2"><?=$postComments['text_comment']?></p>

								    </div>

								  </div>

								</li>

							<? endforeach; ?>

						</ul>

					</div>



					  <div class="form-group row mt-3">
							<? if(isset($_SESSION['user'])): ?>

									<? if(file_exists('images/avatars/'.$_SESSION['user'].'.jpg')): ?>
							    	<label for="commentInput" class="col-1 col-form-label text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/<?=$_SESSION['user']?>.jpg?=<?=filemtime('images/avatars/'.$_SESSION['user'].'.jpg')?>"></label>
									<? else: ?>
							    	<label for="commentInput" class="col-1 col-form-label text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/profile_default.jpg"></label>
									<? endif; ?>
							    <div class="col-11">
										<form id="videoComment_form" action="" method="POST">
								      <input type="text" name="comment_text" class="form-control form-custom-1" id="commentInput" placeholder="Escribe tu comentario">
											<input type="hidden" name="id_video" value="<?=$idPost?>"/>
											<input type="hidden"  class="button primary fit" name="submit_comment" id="submit_comment" value="Comentar"/>
										</form>
							    </div>

							<? else: ?>
								<div class="col-12">

									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Para comentar, debes iniciar sesión</button>

								</div>
							<? endif; ?>

					  </div>



				</div>

			</div>



			<!-- Video Carousel -->

			<div class="row mt-5">

				<div class="col-md-12">
				<section class="videos-slick">
					<? foreach($multiArray as $multimediaArray): ?>
						<? switch($multimediaArray['service_multi']):case "youtube": ?>
								<div>
									<div class="card videoCarousel-Card">

									  <a style="cursor:pointer;" onclick="changeVideo(<?=$multimediaArray['id_multi']?>)"><img src="https://img.youtube.com/vi/<?=$multimediaArray['embed_multi']?>/hqdefault.jpg" class="card-img-top" alt="..."></a>

									  <div class="card-body">

									    <a onclick="changeVideo(<?=$multimediaArray['id_multi']?>)"><p class="card-text font-weight-bold"><?=$multimediaArray['title_multi']?></p></a>

									  </div>

									</div>
								</div>
							<? break; ?>
							<? case "vimeo": ?>
							<? $vimeo = unserialize(file_get_contents('https://vimeo.com/api/v2/video/'.$multimediaArray['embed_multi'].'.php')); ?>
								<div>
									<div class="card videoCarousel-Card">

									  <a style="cursor:pointer;" onclick="changeVideo(<?=$multimediaArray['id_multi']?>)"><img src="<?=$vimeo[0]['thumbnail_large']?>" class="card-img-top" alt="..."></a>

									  <div class="card-body">

									    <a onclick="changeVideo(<?=$multimediaArray['id_multi']?>)"><p class="card-text font-weight-bold"><?=$multimediaArray['title_multi']?></p></a>

									  </div>

									</div>
								</div>
							<? break; ?>
						<? endswitch; ?>
					<? endforeach; ?>
        </section>
				</div>

      </div>

			<hr>

			<? endif; ?>

			<!-- Band members -->
			<? if($bandMembersDisplay == true): ?>
			<div class="row">

				<div class="col-12">

					<h2 class="font-weight-bold">Miembros de la Banda</h2>

				</div>

				<!-- band member card -->
				<? foreach ($bandMembersArray as $bandMembers): ?>

					<div class="col-md-2 text-center mt-4 memberBand">
						<? if(file_exists('images/band_members/'.$bandMembers['img_member'].'.jpg')): ?>
							<img src="images/band_members/<?=$bandMembers['img_member']?>.jpg" class="card-img-top memberAvatar m-auto" alt="...">
						<? else: ?>
							<img src="images/band_members/profile_default.jpg" class="card-img-top memberAvatar m-auto" alt="...">
						<? endif; ?>

						<div class="card-body">

							<p class="font-weight-bold"><?=ucfirst($bandMembers['first_name_member'])?> <?=ucfirst($bandMembers['last_name_member'])?></p>

							<p class="font-weight-light"><?=$bandMembers['name_instrument']?></p>

						</div>

					</div>
					<? endforeach; ?>

			</div>

			<hr>
		<? endif; ?>


			<!-- Ratings -->

			<div class="row mt-4" id="artistRatings">

				<div class="col-md-12" id="artistRatingStar">

					<i class="fas fa-star"></i><span class="font-weight-bold"><?=displayTotalRating($rateArray)?> </span><span class="font-weight-bold">(<?=count($rateArray)?> reseñas)</span>

				</div>

			</div>



			<div class="row mt-4" id="commentRatings">
				<? foreach($rateArray3 as $ratingArray):?>
					<div class="col-sm-12 col-md-6 col-lg-4 mb-3">

						<div class="card pl-4 pr-4 pt-3">

							<div class="media">
							<? if(file_exists('images/avatars/'.$ratingArray['id_user'].'.jpg')): ?>
								<img src="images/avatars/<?=$ratingArray['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$ratingArray['id_user'].'.jpg')?>" class="commentAvatar mr-3 mt-1" alt="...">
							<? else: ?>
								<img src="images/avatars/profile_default.jpg" class="commentAvatar mr-3 mt-1" alt="...">
							<? endif; ?>
								<div class="media-body">

									<h5 class="mt-0 mb-0"><?=ucfirst($ratingArray['first_name_user'])?> <?=ucfirst($ratingArray['last_name_user'])?></h5>

									<span class="ratingDate"><?=$ratingArray['date_rating']?></span>

								</div>

							</div>

							<p class="mt-3"><?=$ratingArray['comment_rating']?></p>

						</div>

					</div>
				<? endforeach; ?>

				</div>



				<!-- More ratings button -->

				<div class="row justify-content-center mt-5" id="showMoreRatings">

					<div class="col-lg-4">

						<a href="" data-toggle="modal" data-target="#ratingsModal" class="btn btn-primary btn-block">Mostrar más reseñas</a>

					</div>

				</div>



		</div>



	</main>






		<!-- Scripts

			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>-->

			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>


  			<script src="assets/slick/slick.js" type="text/javascript" charset="utf-8"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="assets/js/showmoreless.min.js"></script>

			<script src="assets/js/musicplayer.js"></script>

			<script src="assets/js/ajaxFollowUser.js"></script>

			<script src="assets/js/ajaxMultiLike.js"></script>

			<script src="assets/js/ajaxMultimediaChange.js"></script>

			<script type="text/javascript" src="assets/js/ajaxSubmitVideoComment.js"></script>

			<? include 'resources/login_error_script.php'; ?>


<!-- Footer -->

	<?php include 'resources/footer.php'; ?>

  <script type="text/javascript">

				$(function(){

				  $('.show-less-div').myOwnLineShowMoreLess({

				    showLessLine: 4

				  });

				})

$('.videos-slick').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: true,
				dots: false,
					pauseOnHover: false,
					responsive: [{
					breakpoint: 768,
					settings: {
						slidesToShow: 2
					}
				}, {
					breakpoint: 520,
					settings: {
						slidesToShow: 1
					}
				}]
			});


			</script>

			<? include 'resources/googleLoginScript.php'; ?>

			<? if(isset($errTyp) && $errTyp =='danger'): ?>
		    <script type='text/javascript'>alert('<?=$errMSG?>');</script>
		  <? endif; ?>

		  <? if(isset($_SESSION['success'])): ?>
		    <script type='text/javascript'>alert('<?=$_SESSION['success']?>');</script>
		    <? unset($_SESSION['success']) ?>
		  <? endif; ?>


	</body>

</html>
