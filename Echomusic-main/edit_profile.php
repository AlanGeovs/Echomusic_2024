<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/profile_script.php';
include 'resources/login_script.php';
include 'resources/multimediaDetail_script.php';
if($checkUser==false){
	http_response_code(403);
  header("HTTP/1.0 403 Forbidden");
	die();
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

		<title>Editar | <?=$userInfo_array['nick_user']?></title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

			<!-- remove band member modal -->
						<div class="modal fade" id="removeBandMemberModal" tabindex="-1" role="dialog" aria-labelledby="removeBandMemberModal" aria-hidden="true">

						  <div class="modal-dialog modal-md">

						    <div class="modal-content modal-border">
						    	<div class="modal-body">
							      	<div id="row-modal" class="row">

										<div class="col-md-8 order-2">
								        	<h3 class="modal-title">Eliminar miembro</h3>
										</div>
										<div class="col-md-4  order-1 order-md-2">
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								        		<span aria-hidden="true">&times;</span>
								        	</button>
								        </div>
										<div class="col-md-12 order-3">
									  		<p>¿Estas seguro que deseas eliminar a este miembro?</p>
								        </div>
								    </div>
							      		<div id="streamMainBanner" class="container">
													<div class="row justify-content-between">
														<input id="removeBandMemberId" type="hidden" value="">
														<button class="btn btn-primary my-1 btn-lg" data-dismiss="modal" aria-label="Close">Volver</button>
														<button class="btn btn-primary my-1 btn-lg" id="removeBandMemberButton" onClick="removeBandMember()">Eliminar</button>
													</div>
										</div>

						    	</div>

						      <div class="modal-footer text-center" style="justify-content: center;">
						      	<img src="images/logo_brand_3.png" class="h-100" width="50">
						      </div>

						    </div>

						  </div>

						</div>

			<!-- remove video modal -->
						<div class="modal fade" id="removeVideoModal" tabindex="-1" role="dialog" aria-labelledby="removeVideoModal" aria-hidden="true">

						  <div class="modal-dialog modal-md">

						    <div class="modal-content modal-border">
						    	<div class="modal-body">
							      	<div id="row-modal" class="row">

										<div class="col-md-8 order-2">
								        	<h3 class="modal-title">Eliminar miembro</h3>
										</div>
										<div class="col-md-4  order-1 order-md-2">
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								        		<span aria-hidden="true">&times;</span>
								        	</button>
								        </div>
										<div class="col-md-12 order-3">
									  		<p>¿Estas seguro que deseas eliminar este video?</p>
								        </div>
								    </div>
							      		<div id="streamMainBanner" class="container">
													<div class="row justify-content-between">
														<input id="removeVideoId" type="hidden" value="">
														<button class="btn btn-primary my-1 btn-lg" data-dismiss="modal" aria-label="Close">Volver</button>
														<button class="btn btn-primary my-1 btn-lg" id="removeVideoButton" onClick="removeVideo()">Eliminar</button>
													</div>
										</div>

						    	</div>

						      <div class="modal-footer text-center" style="justify-content: center;">
						      	<img src="images/logo_brand_3.png" class="h-100" width="50">
						      </div>

						    </div>

						  </div>

						</div>

		<!-- Soundcloud tutorial Modal -->
			<div class="modal fade" id="soundcloudTutorialModal" tabindex="-1" role="dialog" aria-labelledby="soundcloudTutorialModalLabel" aria-hidden="true">

			   <div class="modal-dialog modal-xl">

			     <div class="modal-content">

			       <div class="modal-header">

			         <h5 class="modal-title">PASO A PASO PARA AÑADIR TU LISTA DE REPRODUCCIÓN DE SOUNDCLOUD EN ECHOMUSIC</h5>

			         <button type="button" class="close" data-dismiss="modal" aria-label="Close">

			           <span aria-hidden="true">&times;</span>

			         </button>

			       </div>

			       <div class="modal-body overflow-auto">
							 <p><strong>1.</strong> Primero debes tener tus canciones cargadas en Soundcloud</p>
							 <p><strong>2.</strong> Debes crear una lista con la(s) cancione(s)que quieras compartir en tu perfil de EchoMusic.</p>
							 <p><strong>3.</strong> En <strong>SoundCloud</strong>, anda a <strong>Listas</strong> y busca la lista de reproducción que quieres añadir.</p>
							 <img class="img-fluid mb-3" src="images/soundcloud_1.png" alt="">
							 <p><strong>4.</strong> Haz click en <strong>compartir</strong>, que aparece sobre la lista de reproducción que elijas</p>
							 <img class="img-fluid mb-3" src="images/soundcloud_5.png" alt="">
							 <p><strong>5.</strong> Anda a la pestaña <strong>Integrar:</strong></p>
							 <img class="img-fluid mb-3" src="images/soundcloud_2.png" alt="">
							 <p><strong>6.</strong> Copia el código que está en el recuadro:</p>
							 <img class="img-fluid mb-3" src="images/soundcloud_3.jpg" alt="">
							 <p><strong>7.</strong> Insértalo en la ventana y aprieta <strong>publicar playlist</strong></p>
							 <img class="img-fluid mb-3" src="images/soundcloud_4.png" alt="">
						 </div>

				       <div class="modal-footer">

				         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

				       </div>

				     </div>

				   </div>

				 </div>

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

							<div class="text-rightcenter">
								<p class="font-weight-bold text-left">Biografía</p>
								<form action="" method="post">
									<textarea id="inputBio" name="bio_text" rows="8" class="form-control form-custom-1 my-2"><?if(isset($bio)){echo $bio;}else{ echo $userBio['bio_user'];}?></textarea>
									<?php if ( isset($bioError)) { echo '<p class="text-danger"><strong class="alert">'.$bioError.'</strong></p>';} ?>
									<button id="" name="submit_bio" type="submit" class="btn btn-primary m-1 btn-border">Publicar</button>
								</form>
							</div>

			      </div>

			      <div class="modal-footer">

			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

			      </div>

			    </div>

			  </div>

			</div>

			<!-- Edit Avatar modal -->

				<div id="changeProfilePhotoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="changeProfilePhotoModal" aria-hidden="true">
					<div class="modal-dialog" style="min-width:80%;">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close m-0 ml-auto p-0" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<form id="cropImage" method="post" enctype="multipart/form-data" action="resources/change_photoAvatar.php">
									<div class="row mb-1">
										<div class="col-md-12 text-center">
											<strong>Elige tu mejor foto para que aparezca en el perfil. ¡Será la foto que verá todo el mundo!</strong>
										</div>
									</div>
									<strong style="font-size: 14px;">Actualizar Imagen:</strong>
									<div class="row">
										<div class="col-md-8">
											<label id="lblprofileImage" class="btn btn-primary" for="profileImage">
										    	<input name="profileImage" id="profileImage" type="file" style="display:none"
										    	onchange="$('#upload-file-info').html(this.files[0].name)">
										    	Seleccionar Archivo
											</label>
											<small class="form-text text-muted">Dimensiones máximas 1920x1080 - Peso máximo 5 mb</small>
											<span class='label label-info hidden' id="upload-file-info"></span>
											<!-- <input type="hidden" name="hdn-profile-id" id="hdn-profile-id" value="<?php echo $user['id']; ?>"  /> -->
											<input type="hidden" name="hdn-x1-axis" id="hdn-x1-axis" value="" />
											<input type="hidden" name="hdn-y1-axis" id="hdn-y1-axis" value="" />
											<input type="hidden" name="hdn-x2-axis" value="" id="hdn-x2-axis" />
											<input type="hidden" name="hdn-y2-axis" value="" id="hdn-y2-axis" />
											<input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width" value="" />
											<input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height" value="" />
											<input type="hidden" name="action" value="" id="action" />
											<input type="hidden" name="imageName" value="" id="imageName" />
											<div id='previewProfilePhoto'></div>
											<strong style="font-size: 16px;">Recuerda: Selecciona el área de la imagen que quieres mostrar.</strong>
											<div id="thumbs" style="padding:5px; width:600px"></div>
										</div>
										<div class="col-md-4 text-rightcenter">
											<button type="button" id="savePhoto" class="btn btn-primary" >Cortar y guardar</button>

										</div>
									</div>

								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>

			<!-- Edit Cover modal -->

				<div id="changeCoverPhotoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="changeCoverPhotoModal" aria-hidden="true">
					<div class="modal-dialog" style="min-width:80%;">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close m-0 ml-auto p-0" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<form id="cropCoverImage" method="post" enctype="multipart/form-data" action="resources/change_photoCover.php">
									<div class="row mb-1">
										<div class="col-md-12 text-center">
											<strong>Elige tu mejor foto para que aparezca en tu portada. ¡Será la foto que verá todo el mundo!</strong>
										</div>
									</div>
									<strong style="font-size: 14px;">Actualizar Imagen:</strong>
									<div class="row">
										<div class="col-md-10">
											<label id="lblcoverImage" class="btn btn-primary" for="coverImage">
										    	<input name="coverImage" id="coverImage" type="file" style="display:none"
										    	onchange="$('#upload-cover-info').html(this.files[0].name)">
										    	Seleccionar Archivo
											</label>
											<small class="form-text text-muted">Dimensiones máximas 1920x1080 - Peso máximo 5 mb</small>
											<span class='label label-info hidden' id="upload-cover-info"></span>
											<!-- <input type="hidden" name="hdn-profile-id" id="hdn-profile-id" value="<?php echo $user['id']; ?>"  /> -->
									<input type="hidden" name="hdn-x1-axis" id="hdn-x1-axis" value="" />
									<input type="hidden" name="hdn-y1-axis" id="hdn-y1-axis" value="" />
									<input type="hidden" name="hdn-x2-axis" value="" id="hdn-x2-axis" />
									<input type="hidden" name="hdn-y2-axis" value="" id="hdn-y2-axis" />
									<input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width" value="" />
									<input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height" value="" />
									<input type="hidden" name="action" value="" id="action" />
									<input type="hidden" name="imageName" value="" id="imageName" />
									<div id='previewCoverPhoto'></div>
									<strong style="font-size: 16px;">Recuerda: Selecciona el área de la imagen que quieres mostrar.</strong>
									<div id="thumbs" style="padding:5px; width:600px"></div>
										</div>
										<div class="col-md-2 text-rightcenter">
											<button type="button" id="saveCoverPhoto" class="btn btn-primary" >Cortar y guardar</button>
										</div>
									</div>

								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>


<!-- Band members modal -->
			<div class="modal fade" id="editBandModal" tabindex="-1" role="dialog" aria-labelledby="editBandModal" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content modal-border">

			      <div class="modal-body">
			      	<div id="row-modal" class="row">

						<div class="col-md-8 order-2">
				        	<h2 class="modal-title">Agregar miembros a la banda</h2>
						</div>
						<div class="col-md-4  order-1 order-md-2">
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				        		<span aria-hidden="true">&times;</span>
				        	</button>
				        </div>
						<div class="col-md-12 order-3">
			        		<p>Ingresa los miembros de la banda, fotografía, nombre y rol.</p>
			        </div>
				    </div>
				    <div id="">
							<form id="cropBandMemberImage" enctype="multipart/form-data" action="resources/change_photoBand.php" method="post">
				    		<div class="row fondocloud-inicial text-rightcenter">
					    		<div class="col-md-3 text-rightcenter">
										<p class="font-weight-bold"> Nombre</p>
									</div>
					    		<div class="col-md-9">
										<input type="text" id="first_name_member" name="first_name_member" class="form-control form-custom-2 mb-2">
										<span class="text-danger"><strong class="alert"><?php if ( isset($fname_memberError)) { echo $fname_memberError;} ?></strong></span>
					    		</div>
									<div class="col-md-3 text-rightcenter">
										<p class="font-weight-bold"> Apellido</p>
									</div>
					    		<div class="col-md-9">
										<input type="text" id="last_name_member" name="last_name_member" class="form-control form-custom-2 mb-2">
										<span class="text-danger"><strong class="alert"><?php if ( isset($lname_memberError)) { echo $lname_memberError;} ?></strong></span>
					    		</div>
					    		<div class="col-md-3 text-rightcenter">
										<p class="font-weight-bold"> Instrumento</p>
									</div>
					    		<div class="col-md-9">
										<select id="instrument_member" name="instrument_member" class="form-control form-custom-2 mb-2">
											<? foreach($instrumentsArray as $instruments): ?>
												<option value="<?=$instruments['id_instrument']?>"><?=$instruments['name_instrument']?></option>
											<? endforeach; ?>
										</select>
										<span class="text-danger"><strong class="alert"><?php if ( isset($instrument_memberError)) { echo $instrument_memberError;} ?></strong></span>
					    		</div>
									<div class="col-md-3 text-rightcenter">
										<p class="font-weight-bold"> Fotografía</p>
									</div>
									<div class="col-md-12">
										<label id="lblbandImage" class="btn btn-primary" for="bandImage">
												<input name="bandImage" id="bandImage" type="file" style="display:none"
												onchange="$('#upload-band-info').html(this.files[0].name);$('#editPhotolinkband').click()">
												Seleccionar Archivo
												<!--selecciono y muestra imagen en segundo popup-->
										</label>
											<span class='label label-info' id="upload-band-info"></span>
										<!-- <input type="hidden" name="hdn-profile-id" id="hdn-profile-id" value="<?php echo $user['id']; ?>"  /> -->
											<input type="hidden" name="hdn-x1-axis-b" id="hdn-x1-axis-b" value="" />
											<input type="hidden" name="hdn-y1-axis-b" id="hdn-y1-axis-b" value="" />
											<input type="hidden" name="hdn-x2-axis-b" value="" id="hdn-x2-axis-b" />
											<input type="hidden" name="hdn-y2-axis-b" value="" id="hdn-y2-axis-b" />
											<input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width" value="" />
											<input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height" value="" />
											<input type="hidden" name="action" value="" id="action" />
											<input type="hidden" name="imageName-b" value="" id="imageName-b" />
											<input type="hidden" name="imageName" value="" id="imageName" />
											<!--<div id='previewBandPhoto-b'></div>-->
											<div id="thumbs" style="padding:5px; width:600px"></div>
									</div>
					    			<div class="col-md-12 order-1 text-center">
										<a id="editPhotolinkband" href="" class="hidden" style="cursor:pointer;" data-toggle="modal" data-target="#editBandPhotoModal">editPhoto</a>

								    	<button id="saveBandPhoto" type="button" class="btn btn-primary m-1 btn-border" data-toggle="modal" data-target="#editBandModal" >Guardar</button>
									</div>
								</div>
							</form>
				    </div>

			      </div>

			      <div class="modal-footer text-center" style="justify-content: center;">
			      	<img src="images/logo_brand_3.png" class="h-100" width="50">
			      </div>
			    </div>

			  </div>

			</div>
<!-- Band members photo modal -->
			<div class="modal fade" id="editBandPhotoModal" tabindex="-1" role="dialog" aria-labelledby="editBandPhotoModal" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content modal-border">

			      <div class="modal-body">
			      	<div id="row-modal" class="row">

						<div class="col-md-8 order-2">
				        	<h2 class="modal-title">Fotografía</h2>
						</div>
						<div class="col-md-4  order-1 order-md-2">
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				        		<span aria-hidden="true">&times;</span>
				        	</button>
				        </div>

				    </div>
				    <div id="">

				    		<div class="row fondocloud-inicial text-rightcenter">
									<div class="col-md-12">
										<!--
										<label id="lblbandImage" class="btn btn-primary" for="bandImage">
												<input name="bandImage" id="bandImage" type="file" style="display:none"
												onchange="$('#upload-band-info').html(this.files[0].name)">
												Seleccionar Archivo
										</label>-->

											<span class='label label-info' id="upload-band-info"></span>
										<!-- <input type="hidden" name="hdn-profile-id" id="hdn-profile-id" value="<?php echo $user['id']; ?>"  /> -->
											<input type="hidden" name="hdn-x1-axis-2" id="hdn-x1-axis-2" value="" />
											<input type="hidden" name="hdn-y1-axis-2" id="hdn-y1-axis-2" value="" />
											<input type="hidden" name="hdn-x2-axis-2" value="" id="hdn-x2-axis-2" />
											<input type="hidden" name="hdn-y2-axis-2" value="" id="hdn-y2-axis-2" />
											<input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width" value="" />
											<input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height" value="" />
											<input type="hidden" name="action" value="" id="action" />
											<input type="hidden" name="imageName-2" value="" id="imageName-2" />
											<div id='previewBandPhoto'></div>
											<!--una vez tenga la preseleccion, cargo en popup 1 y duplico datos x y w h desde los  -2-->
											<div id="thumbs-2" style="padding:5px; width:600px"></div>

									</div>
					    			<div class="col-md-12 order-1 text-center">
								    	<button id="saveBandPhoto2" class="btn btn-primary m-1 btn-border" data-toggle="modal" data-target="#editBandPhotoModal" >Guardar</button>
									</div>
								</div>
				    </div>

			      </div>

			      <div class="modal-footer text-center" style="justify-content: center;">
			      	<img src="images/logo_brand_3.png" class="h-100" width="50">
			      </div>
			    </div>

			  </div>

			</div>
		<!-- Edit tracks Modal -->

		 <div class="modal fade" id="editTracksModal" tabindex="-1" role="dialog" aria-labelledby="editTracksModalLabel" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content">

			      <div class="modal-header">

			        <h5 class="modal-title">Editar canciones</h5>

			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

			          <span aria-hidden="true">&times;</span>

			        </button>

			      </div>

			      <div class="modal-body">
						<? if(mysqli_num_rows($queryTracks)>0): ?>
			      	<div class="table-responsive">

							<table class="table">

								<thead>

									<tr>

										<th scope="col">Nombre</th>

										<th scope="col">Album</th>

										<th scope="col">Opciones</th>

									</tr>

								</thead>

								<tbody>

									<? foreach($userTracksArray as $userTracks):?>

									<tr class="track_list_item" id="track_list_item-<?=$userTracks['id_audio_user']?>">

										<td><?=$userTracks['audio_name']?></td>

										<td><?=$userTracks['audio_album']?></td>

										<th class="th-track-remove" scope="row"><button id="" class="btn btn-outline-secondary m-1 btn-border showTrackRemove">Eliminar</button></th>

										<th class="th-track-confirmation" scope="row" style="display:none;"><button id="" class="btn btn-primary m-1 btn-border hideTrackRemove">Cancelar</button><button id="track_button_item-<?=$userTracks['id_audio_user']?>" class="btn btn-outline-secondary m-1 btn-border" onClick="removeTrack(<?=$userTracks['id_audio_user']?>)">Eliminar</button></th>

									</tr>

									<? endforeach; ?>

								</tbody>

							</table>
						</div>
					<? else:?>
					<p>No hay canciones.</p>
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

		<div id="profileiMainBanner" class="jumbotron">

			<div id="profileCover" class="backgroundImage container" style="background-position: center top; background-image: linear-gradient(to top, rgba(50, 50, 50, 0.30), rgba(0, 1, 13, 0.30)), url('../../images/covers/<?=$userInfo_array['id_user']?>.jpg?=<?=filemtime('images/covers/'.$userInfo_array['id_user'].'.jpg')?>');">
				<div class="container text-rightcenter">
					<a id="editCover" class="btn btn-primary" data-toggle="modal" data-target="#changeCoverPhotoModal">Editar Portada <i class="fas fa-camera"></i></a>
					<a id="editFinish" class="btn btn-primary" style="cursor:pointer;" href="profile.php?userid=<?=$userInfo_array['id_user']?>">Terminar Edición <i class="fas fa-check"></i></a>
				</div>
    	</div>



			<div class="profileiImage text-center">

				<!-- <a type="file" id="editAvatar" style="cursor:pointer;" data-toggle="modal" data-target="#editAvatarModal" class="btn btn-primary"><i class="fas fa-camera"></i></a> -->
				<a id="editAvatar" href="" class="btn btn-primary" data-toggle="modal" data-target="#changeProfilePhotoModal"><i class="fas fa-camera"></i></a>

				<? if(file_exists('images/avatars/'.$userInfo_array['id_user'].'.jpg')): ?>
						<img id="profilePhoto" alt="..." src="images/avatars/<?=$userInfo_array['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$userInfo_array['id_user'].'.jpg')?>">
				<? else: ?>
						<img id="profilePhoto" alt="" src="images/avatars/profile_default.jpg">
				<? endif; ?>

			</div>

		</div>



		<!-- Container -->

		<div class="container" id="profileContainer">



			<!-- Name Info -->

			<div class="row justify-content-center artistHeadInfoEdit" id="artistHeadInfo">

				<div class="col-md-12 text-center">

					<h1><?=$userInfo_array['nick_user']?></h1>

				</div>
			</div>
			<div class="row justify-content-center artistHeadInfoEdit" id="artistHeadInfo">

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
					<button class="btn btn-small btn-primary btn-sm mb-3 mb-md-0 col-md-2 btn-profile isDisabled"><i class="fas fa-user-plus"></i> Seguir</button>
					<a href="" data-toggle="modal" data-target="#nextEventsModal" class="btn btn-primary btn-sm mb-3 mb-md-0  col-md-4 btn-profile isDisabled"><i class="fas fa-plus"></i> Proximos Eventos</a>
				</div>

				<div class="col-md-6 text-rightcenter order-1 order-md-2">
					<a href="" class="btn btn-small btn-primary font-weight-bold mb-3 btn-profile" style="cursor:pointer;" data-toggle="modal" data-target="#bioModal">Biografía</a>
				</div>

			</div>



			<!-- Plans -->

			<div class="row" id="artistPlans">

				<div class="col-md-3 text-left first-block">
					<h2 class="my-4 font-weight-bold">Tarifas</h2>
				</div>
				<div role="button" class="col-md-9 text-right second-block">

					<a href="dashboard.php" ><h2 class="my-4">Editar en Panel de Control <i class="fas fa-caret-right"></i></h2></a>

				</div>

				<div class="col-2">

				</div>

			</div>


			<!-- Artist Featured Track and Description -->

			<div class="row mt-5 mb-5">

				<div class="col-md-7 order-2 order-md-1 ">
					<form action="" method="post">
						<div class="col-md-12 fondocloud-inicial text-rightcenter">
							<p class="font-weight-bold text-left"> <i class="fas fa-code"></i> URL Soundcloud de tu playlist <a class="text-orange" style="cursor:pointer;" data-toggle="modal" data-target="#soundcloudTutorialModal"><i class="fas fa-question-circle"></i></a></p>
							<input type="text" name="url_audio" class="form-control form-custom-2 mb-2">
							<? if(isset($audioError)): ?><span class="text-danger"><strong class="alert"><?=$audioError?></strong></span><? endif; ?>

			      	<button id="submit_audio" type="submit" name="submit_audio" class="btn btn-primary m-1 btn-border">Publicar playlist</button>
						</div>
					</form>
				</div>

				<div class="col-md-5 col-md-5 col-sm-12 order-1 order-lg-2 mb-4 mb-md-0" id="artistDescription">
					<form action="" method="post">
						<div class="text-rightcenter">
							<p class="font-weight-bold text-left">Descripción</p>
							<textarea name="description_text" id="inputDescription" class="form-control form-custom-1 my-2"><? if(isset($desc)){ echo $desc; }else{echo $userProfile_array['desc_user'];} ?></textarea>
							<? if(isset($descError)): ?><span class="text-danger"><strong class="alert"><?=$descError?></strong></span><? endif; ?>
					    <button id="" type="submit" name="submit_desc" class="btn btn-primary m-1 btn-border">Publicar</button>
						</div>
					</form>
					<p class="font-weight-bold">Compartir en:</p>
					<div class="row">

						<div class="col-4">

							<a href="#" class="isDisabled"><i class="fab fa-facebook-square"></i> Facebook</a>

						</div>

						<div class="col-4">

							<a href="#" class="isDisabled"><i class="fab fa-whatsapp-square"></i> Whatsapp</a>

						</div>

						<div class="col-4">

							<a href="#" class="isDisabled"><i class="fab fa-twitter-square"></i> Twitter</a>

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

			<div class="row mt-4">

				<div class="col-12 mt-2 mb-4"><h2 class="font-weight-bold">Mis Videos</h2></div>

				<div class="col-lg-7 col-sm-12 mb-3 mb-md-0" id="featuredVideo">
					<form action="" method="post">
						<div class="col-md-12 fondocloud-inicial text-rightcenter">
							<p class="font-weight-bold text-left">Título del Video <i class="fas fa-code"></i></p>
							<input type="text" name="title_video" class="form-control form-custom-2 mb-2">
							<span class="text-danger"><strong class="alert"><?php if ( isset($titleVideoError)) { echo $titleVideoError;} ?></strong></span>
							<p class="font-weight-bold text-left">URL del Video <i class="fab fa-youtube"></i> <i class="fab fa-vimeo"></i> </p>
							<input type="text" name="url_video" class="form-control form-custom-2">
							<span class="text-danger"><strong class="alert"><?php if ( isset($videoError)) { echo $videoError;} ?></strong></span>
			      	<button id="" type="submit" name="submit_video" class="btn btn-primary m-1 btn-border">Publicar</button>
						</div>
					</form>

				</div>

				<div class="col-lg-5 col-sm-12 pt-4 pb-4" id="featuredVideo-box">

						 <div class="row justify-content-between">

							 <div class="col">

								<span>0 </span><span class="font-weight-bold" href=""><i class="far fa-heart"></i> Me Gusta</span>

							 </div>

							 <div class="col text-right">

								 <span>0 comentarios</span>

							 </div>

						 </div>

					<hr>

					<div class="col-12 overflow-auto" id="commentariesBox">



					</div>

				</div>

			</div>



			<!-- Video Carousel -->

			<div class="row mt-5">

				<div class="col-md-12">
				<section class="videos-slick">
				<? if(!empty($multiArray)): ?>
					<? foreach($multiArray as $multimediaArray): ?>
						<? switch($multimediaArray['service_multi']):case "youtube": ?>
								<div id="video_<?=$multimediaArray['id_multi']?>">
									<div class="card videoCarousel-Card">

									  <img src="https://img.youtube.com/vi/<?=$multimediaArray['embed_multi']?>/hqdefault.jpg" class="card-img-top" alt="...">

									  <div class="card-body">

									    <p class="card-text font-weight-bold"><?=$multimediaArray['title_multi']?></p>

									  </div>
										<button data-toggle="modal" data-target="#removeVideoModal" onClick="removeVideoId(<?=$multimediaArray['id_multi']?>)" type="button" class="btn btn-primary" >Eliminar</button>

									</div>
								</div>
							<? break; ?>
							<? case "vimeo": ?>
							<? $vimeo = unserialize(file_get_contents('https://vimeo.com/api/v2/video/'.$multimediaArray['embed_multi'].'.php')); ?>
								<div id="video_<?=$multimediaArray['id_multi']?>">
									<div class="card videoCarousel-Card">

									  <img src="<?=$vimeo[0]['thumbnail_large']?>" class="card-img-top" alt="...">

									  <div class="card-body">

									    <p class="card-text font-weight-bold"><?=$multimediaArray['title_multi']?></p>

									  </div>
										<button data-toggle="modal" data-target="#removeVideoModal" onClick="removeVideoId(<?=$multimediaArray['id_multi']?>)" type="button" class="btn btn-primary" >Eliminar</button>
									</div>
								</div>
							<? break; ?>
						<? endswitch; ?>
					<? endforeach; ?>
				<? endif;?>
        </section>
				</div>

      </div>



			<hr>


		<? if($bandMembersActive == true): ?>

			<!-- Band members -->

			<div class="row">

				<div class="col-md-8 order-2 order-md-1">

					<h2 class="font-weight-bold">Miembros de la Banda</h2>

				</div>
				<div class="col-md-4 order-1 text-rightcenter">
				    <button id="" type="submit" class="btn btn-primary m-1 btn-border"  data-toggle="modal" data-target="#editBandModal" >Editar</button>
				</div>
			</div>

			<div class="row">

					<!-- band member card -->
					<? foreach ($bandMembersArray as $bandMembers): ?>

						<div id="bandMember_<?=$bandMembers['id_band_member']?>" class="col-md-2 text-center mt-4 memberBand">

							<img src="images/band_members/<?=$bandMembers['img_member']?>.jpg" class="card-img-top memberAvatar m-auto" alt="...">

							<div class="card-body">

								<p class="font-weight-bold"><?=ucfirst($bandMembers['first_name_member'])?> <?=ucfirst($bandMembers['last_name_member'])?></p>

								<p class="font-weight-light"><?=$bandMembers['name_instrument']?></p>

							</div>
							<button data-toggle="modal" data-target="#removeBandMemberModal" onClick="removeBandMemberId(<?=$bandMembers['id_band_member']?>)" type="button" class="btn btn-primary" >Eliminar</button>
						</div>
						<? endforeach; ?>

			</div>

		<? endif; ?>


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

			<script src="assets/js/jquery.imgareaselect.js" type="text/javascript"></script>

			<script src="assets/js/jquery.form.js"></script>

			<script src="assets/js/image_crop_save_avatar.js"></script>

			<script src="assets/js/image_crop_save_cover.js"></script>

			<script src="assets/js/image_crop_save_band.js"></script>

			<script src="assets/js/ajaxRemoveTrack.js"></script>

			<script src="assets/js/ajaxRemoveBandMember.js"></script>

			<script src="assets/js/ajaxRemoveVideo.js"></script>

			<script src="assets/js/jquery.charactercounter.js"></script>

			<? if($errTyp=="danger" || $errTyp=="success"): ?>
			   <script type='text/javascript'>alert('<?=$errMSG?>');</script>
			<? endif; ?>

			<? if(isset($_SESSION['success'])): ?>
				<script type='text/javascript'>alert('<?=$_SESSION['success']?>');</script>
				<? unset($_SESSION['success']) ?>
			<? endif; ?>

<!-- Footer -->

	<?php

		include 'resources/footer.php';

	 ?>

  <script type="text/javascript">

	// Change profile pic function

		$("#changeProfilePhotoModal").on('hidden.bs.modal', function () {
				$(".imgareaselect-selection,.imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
			});

	// Change cover pic function

		$("#changeCoverPhotoModal").on('hidden.bs.modal', function () {
				$(".imgareaselect-selection,.imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
			});

		$("#editBandPhotoModal").on('hidden.bs.modal', function () {
				$(".imgareaselect-selection,.imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
			});

	// Add band pic function
		$('#editAvatar').click(function() {


		});

		$('#bandImage').click(function() {
			$('#saveBandPhoto').css("display", "inline-block");

		});
		$("#editBandModal").on('hidden.bs.modal', function () {
				$(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
			});

			// Show less text function
				$(function(){

				  $('.show-less-div').myOwnLineShowMoreLess({

				    showLessLine: 4

				  });

				})
				// Video carousel
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

					$('#submit_audio').click(function(){
						$('#submit_audio').html("<div class='spinner-border' role='status'></div>");
					});

					$("#inputDescription").characterCounter({
					  limit: '500',
						counterFormat: '%1 caracteres restantes'
					});

					$("#inputBio").characterCounter({
					  limit: '3000',
						counterFormat: '%1 caracteres restantes'
					});


			</script>

			<? include 'resources/googleLoginScript.php'; ?>

	</body>

</html>
