<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

include 'resources/login_script.php';
include 'resources/dashboard_script.php';
include 'resources/crowdfunding/dashboardProject_script.php';
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

		<title>EchoMusic | Panel de control</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<? include 'resources/googleLoginMeta.html'; ?>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
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

		<div id="profileMainBanner" class="jumbotron">

			<? if($userInfo_array['id_type_user'] == '1'): ?>
				<div class="backgroundImage container" style="background-position: center center; background-image: linear-gradient(to top, rgba(50, 50, 50, 0.20), rgba(0, 1, 13, 0.20)), url('../../images/covers/<?=$userInfo_array['id_user']?>.jpg?nocache=<?php echo time(); ?>');">
			<? else: ?>
				<div class="backgroundImage container" style="background-position: center center; background-image: linear-gradient(to top, rgba(50, 50, 50, 0.20), rgba(0, 1, 13, 0.20)), url('../../images/bg-1.4.jpg?nocache=<?php echo time(); ?>');">
			<?endif; ?>
			</div>

			<div class="profileImage text-center">

				<? if(file_exists('images/avatars/'.$userid.'.jpg')): ?>
						<img alt="" src="images/avatars/<?=$userid?>.jpg?=<?=filemtime('images/avatars/'.$userid.'.jpg')?>">
				<? else: ?>
					<!-- <img alt="" src="images/avatars/profile_default.jpg"> -->
				<? endif; ?>

			</div>

		</div>


		<!-- Container -->

		<div class="container">

			<? switch($userInfo_array['id_type_user']):case "1":?>
					<? include 'resources/contentDashboardArtist.php';?>
				<? break; ?>
				<? case "2": ?>
					<? include 'resources/contentDashboardUser.php';?>
				<? break; ?>
			<? endswitch; ?>




		</div>



	</main>

<!-- Config URL stream -->
			<div class="modal fade" id="configEventroStreamModalLabel" tabindex="-1" role="dialog" aria-labelledby="configEventroStreamModalLabel" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content modal-border">
			    	<div class="modal-body">
				      	<div id="row-modal" class="row">

							<div class="col-md-8 order-2">
					        	<h3 class="modal-title">Configuración de Streaming</h3>
							</div>
							<div class="col-md-4  order-1 order-md-2">
					        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        		<span aria-hidden="true">&times;</span>
					        	</button>
					        </div>
							<div class="col-md-12 order-3">
						  		<p>Configura tu plataforma de stream para la transmisión de tu evento en EchoMusic</p>
					        </div>
					    </div>
				      		<div id="streamMainBanner" class="container">
										<input type="hidden" value="" id="streamingEventId">
								  <div class="row my-5 text-center">
								  	<div class="col-md-4 iconos-requerimientos iconos-requerimientos-red">
								  		<i class="fab fa-youtube"></i><br>
								  		<input value="" type="text" id="youtubeURL" placeholder="Enlace del vídeo" class="form-control form-custom-1">
								  		<a id="youtubeURLButton" class="btn btn-primary my-1 btn-lg" onClick="configYoutubeURL()" role="button">Guardar URL</a>
								  	</div>
								  	<div class="col-md-4 iconos-requerimientos iconos-requerimientos-sky">
								  		<i class="fab fa-vimeo-v"></i><br>
								  		<input value="" type="text" id="vimeoURL" placeholder="Código evento" class="form-control form-custom-1">
											<input value="" type="text" id="vimeoChat" placeholder="Código chat" class="form-control form-custom-1 mt-1">
								  		<a id="vimeoURLButton" class="btn btn-primary my-1 btn-lg" onClick="configVimeoURL()" role="button">Guardar URL</a>
								  	</div>
								  	<div class="col-md-4 iconos-requerimientos-s">
								  		<img src="assets/icon/zoom.png" class="icon-logo" alt="..."><br>
								  		<input value="" type="text" id="zoomURL" placeholder="Enlace reunión" class="form-control form-custom-1">
								  		<a id="zoomURLButton" class="btn btn-primary my-1 btn-lg" onClick="configZoomURL()" role="button">Guardar URL</a>

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

		<!-- Descarga tickets Modal -->
			 <div class="modal fade" id="downloadTicketsModal" tabindex="-1" role="dialog" aria-labelledby="downloadTicketsModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Entradas</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body table-responsive">

									<table id="ticketsDownloadId" class="table">



									</table>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>

<!-- Cancel event -->
			<div class="modal fade" id="cancelEventModal" tabindex="-1" role="dialog" aria-labelledby="cancelEventModal" aria-hidden="true">

			  <div class="modal-dialog modal-md">

			    <div class="modal-content modal-border">
			    	<div class="modal-body">
				      	<div id="row-modal" class="row">

							<div class="col-md-8 order-2">
					        	<h3 class="modal-title">Cancelar evento</h3>
							</div>
							<div class="col-md-4  order-1 order-md-2">
					        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        		<span aria-hidden="true">&times;</span>
					        	</button>
					        </div>
							<div class="col-md-12 order-3">
						  		<p>¿Estas segur@ que deseas cancelar este evento?</p>
					        </div>
					    </div>
				      		<div id="streamMainBanner" class="container">
										<div class="row justify-content-between">
											<input id="cancelEventId" type="hidden" value="">
											<input id="cancelEventType" type="hidden" value="">
											<button class="btn btn-primary my-1 btn-lg" data-dismiss="modal" aria-label="Close">Volver</button>
											<button class="btn btn-primary my-1 btn-lg" id="cancelEventButton" onClick="cancelEvent()">Cancelar Evento</button>
										</div>
							</div>

			    	</div>

			      <div class="modal-footer text-center" style="justify-content: center;">
			      	<img src="images/logo_brand_3.png" class="h-100" width="50">
			      </div>

			    </div>

			  </div>

			</div>

<!-- Publish event -->
			<div class="modal fade" id="publishEventModal" tabindex="-1" role="dialog" aria-labelledby="publishEventModal" aria-hidden="true">

			  <div class="modal-dialog modal-md">

			    <div class="modal-content modal-border">
			    	<div class="modal-body">
				      	<div id="row-modal" class="row">

							<div class="col-md-8 order-2">
					        	<h3 class="modal-title">Publicar evento</h3>
							</div>
							<div class="col-md-4  order-1 order-md-2">
					        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        		<span aria-hidden="true">&times;</span>
					        	</button>
					        </div>
							<div class="col-md-12 order-3">
						  		<p>¿Estas segur@ que deseas publicar este evento?</p>
					        </div>
					    </div>
				      		<div id="streamMainBanner" class="container">
										<div class="row justify-content-between">
											<input id="publishEventId" type="hidden" value="">
											<input id="publishEventType" type="hidden" value="">
											<button class="btn btn-primary my-1 btn-lg" data-dismiss="modal" aria-label="Close">Volver</button>
											<button class="btn btn-primary my-1 btn-lg" id="publishEventButton" onClick="publishEvent()">Publicar Evento</button>
										</div>
							</div>

			    	</div>

			      <div class="modal-footer text-center" style="justify-content: center;">
			      	<img src="images/logo_brand_3.png" class="h-100" width="50">
			      </div>

			    </div>

			  </div>

			</div>

<!-- cancel private modal -->
			<div class="modal fade" id="cancelPrivateModal" tabindex="-1" role="dialog" aria-labelledby="cancelPrivateModal" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content modal-border">

						<div class="modal-header">
			        <h5 class="modal-title">¿Deseas cancelar este evento?</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			    	<div class="modal-body">
							<div class="col-12">
					      <p>Para cancelar este evento debes explicar tus motivos, éstos serán comunicados a la otra parte para poder asegurar una buena comunicación dentro de nuestro servicio.</p>
					      <form action="" method="post">
					        <textarea placeholder="Mínimo 10 caracteres..." class="form-control form-custom-1" name="cancel_text" id="inputCancelPrivate" maxlenght="200" rows="2" placeholder=""></textarea>
									<? if(isset($cancelTextError)): ?><span class="text-danger"><strong class="alert"><?=$cancelTextError?></strong></span><? endif; ?>
					        <input class="" type="hidden" name="id_event" id="id_event-cancelValue" value=""/></br>
									<input type="submit" value="Cancelar Evento" name="cancel_event" class="btn btn-primary my-1" />
					      </form>
					    </div>
			    	</div>

			      <div class="modal-footer text-center" style="justify-content: center;">
			      	<img src="images/logo_brand_3.png" class="h-100" width="50">
			      </div>

			    </div>

			  </div>

			</div>

<!-- cancel Event modal -->
			<div class="modal fade" id="estadisticaStreamModalLabel" tabindex="-1" role="dialog" aria-labelledby="estadisticaStreamModalLabel" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content modal-border">
			    	<div class="modal-body">
			      	<div id="row-modal" class="row">
							<div class="col-md-8 order-2">
					        	<h3 class="modal-title">Estadísticas del evento</h3>
							</div>
							<div class="col-md-4  order-1 order-md-2">
					        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        		<span aria-hidden="true">&times;</span>
					        	</button>
					        </div>
							<div class="col-md-12 order-3">
						  		<p>Aquí podrás visualizar todas las estadísticas de tu evento ya sea de pago, por suscripción gratuita o donaciones.</p>
					        </div>
						    </div>
				      		<div id="statsStreamingContainer" class="container">



							</div>

			    	</div>

			      <div class="modal-footer text-center" style="justify-content: center;">
			      	<img src="images/logo_brand_3.png" class="h-100" width="50">
			      </div>

			    </div>

			  </div>

			</div>

<!--  Invitaciones Event modal -->
			<div class="modal fade" id="InvitacionesModalLabel" tabindex="-1" role="dialog" aria-labelledby="InvitacionesModalLabel" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content modal-border">
			    	<div class="modal-body">
			      	<div id="row-modal" class="row">
						<div class="col-md-8 order-2">
				        	<h3 class="modal-title">Invitaciones del evento</h3>
						</div>
						<div class="col-md-4  order-1 order-md-2">
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				        		<span aria-hidden="true">&times;</span>
				        	</button>
				        </div>
				        <div class="col-md-12 order-3">
					  		<p>Ingresa los datos y cantidad para poder enviar invitaciones.</p>
				        </div>
				    </div>
		      		<div id="" class="container">
		      			<form action="" method="post">
									<ul class="list-group">
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<input placeholder="Nombre" type="text" name="invitation_fname" value="" class="form-control">
											<? if(isset($invitation_fnameError)): ?><span class="text-danger"><strong class="alert"><?=$invitation_fnameError?></strong></span><? endif; ?>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<input placeholder="Apellido" type="text" name="invitation_lname" value="" class="form-control">
											<? if(isset($invitation_lnameError)): ?><span class="text-danger"><strong class="alert"><?=$invitation_lnameError?></strong></span><? endif; ?>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<input id="inputRut" placeholder="RUT" type="text" name="invitation_rut" value="" class="form-control">
											<? if(isset($invitation_rutError)): ?><span class="text-danger"><strong class="alert"><?=$invitation_rutError?></strong></span><? endif; ?>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<input placeholder="Correo electrónico" type="email" name="invitation_email" value="" class="form-control">
											<? if(isset($invitation_emailError)): ?><span class="text-danger"><strong class="alert"><?=$invitation_emailError?></strong></span><? endif; ?>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<select id="inputEntries" name="invitation_entries" class="form-control w-50">
		                      <?for($i=1; $i<=4; $i++):?>
		                        <option  value="<?=$i?>" <?=$selected?>><?=$i?></option>
		                      <?endfor;?>
		                  </select>
										</li>
									</ul>
									<input type="hidden" id="invitation_id" name="invitation_id" value="">
									<button id="enviarEntrada" name="invitation_submit" onClick="" class="btn btn-primary  m-2">Enviar</button>
								</form>
						</div>

			    	</div>

			      <div class="modal-footer text-center" style="justify-content: center;">
			      	<img src="images/logo_brand_3.png" class="h-100" width="50">
			      </div>

			    </div>

			  </div>

			</div>

			<? if($userProfile_array['id_type_user'] == '1'): ?>
				<!-- Patrocinadores Modal -->
				 <div class="modal fade" id="patrocinadoresModal" tabindex="-1" role="dialog" aria-labelledby="patrocinadoresModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title">Patrocinadores</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
						      <div class="tabla-patrocinadores">
						        <table class="table">
								  <tbody>
									<? foreach($projectBackersArray as $projectBackers_array): ?>
								    <tr>
								      <th scope="row"><?=$projectBackers_array['first_name_user']?> <?=$projectBackers_array['last_name_user']?></th>
								      <td>Recompensa <?=$projectBackers_array['tier_slot']?></td>
								      <td>$<?=number_format($projectBackers_array['backer_amount']+$projectBackers_array['backer_added_amount'] , 0, ',', '.')?></td>
								    </tr>
									<? endforeach; ?>
								  </tbody>
								</table>
						      </div>
					      </div>
					      <div class="modal-footer">
					        <a href="https://qa.echomusic.cl/resources/crowdfunding/dataDownload.php" class="btn btn-primary">Exportar planilla</a>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					      </div>
					    </div>
					  </div>
					</div>
				</div>

				<!-- Preguntas project Modal -->
				 <div class="modal fade" id="preguntasModal" tabindex="-1" role="dialog" aria-labelledby="preguntasModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title">Preguntas</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
							<table id="tableresponsive-event" class="table">
							    <tbody>
										<? foreach($projectQAsArray as $projectQAs): ?>
								      <tr id="questionContainer_<?=$projectQAs[0]?>" class="tr-responsive">
								        <!-- <th scope="row">1</th> -->
								        <td>
													<?=$projectQAs['question_desc']?>
													<input type="text" placeholder="Respuesta..." class="form-control form-custom-1" name="" value="" id="answerInput_<?=$projectQAs[0]?>">
													<input id="questionId" type="hidden" value="<?=$projectQAs[0]?>" name="id_question" />
													<a id="answerButton_<?=$projectQAs[0]?>" onClick="answerQuestion(<?=$projectQAs[0]?>)" class="btn btn-primary m-2">Responder</a>
												</td>
								      </tr>
										<? endforeach; ?>
							    </tbody>
							</table>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					      </div>
					    </div>
					  </div>
					</div>

			<!-- Publish Project -->
						<div class="modal fade" id="publishProjectModal" tabindex="-1" role="dialog" aria-labelledby="publishProjectModal" aria-hidden="true">

						  <div class="modal-dialog modal-md">

						    <div class="modal-content modal-border">
						    	<div class="modal-body">
							      	<div id="row-modal" class="row">

										<div class="col-md-8 order-2">
								        	<h3 class="modal-title">Publicar proyecto</h3>
										</div>
										<div class="col-md-4  order-1 order-md-2">
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								        		<span aria-hidden="true">&times;</span>
								        	</button>
								        </div>
										<div class="col-md-12 order-3">
									  		<p>¿Estas segur@ que deseas publicar este proyecto?</p>
								        </div>
								    </div>
							      		<div id="streamMainBanner" class="container">
													<div class="row justify-content-between">
														<button class="btn btn-primary my-1 btn-lg" data-dismiss="modal" aria-label="Close">Volver</button>
														<button class="btn btn-primary my-1 btn-lg" id="publishProjectButton" onClick="publishProject()">Publicar proyecto</button>
													</div>
										</div>

						    	</div>

						      <div class="modal-footer text-center" style="justify-content: center;">
						      	<img src="images/logo_brand_3.png" class="h-100" width="50">
						      </div>

						    </div>

						  </div>

						</div>

						<!-- Cancel project -->
									<div class="modal fade" id="cancelProjectModal" tabindex="-1" role="dialog" aria-labelledby="cancelProjectModal" aria-hidden="true">

									  <div class="modal-dialog modal-md">

									    <div class="modal-content modal-border">
									    	<div class="modal-body">
										      	<div id="row-modal" class="row">

													<div class="col-md-8 order-2">
											        	<h3 class="modal-title">Cancelar proyecto</h3>
													</div>
													<div class="col-md-4  order-1 order-md-2">
											        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											        		<span aria-hidden="true">&times;</span>
											        	</button>
											        </div>
													<div class="col-md-12 order-3">
												  		<p>¿Estas segur@ que deseas cancelar este proyecto?</p>
											        </div>
											    </div>
										      		<div id="streamMainBanner" class="container">
																<div class="row justify-content-between">
																	<button class="btn btn-primary my-1 btn-lg" data-dismiss="modal" aria-label="Close">Volver</button>
																	<button class="btn btn-primary my-1 btn-lg" id="cancelProjectButton" onClick="cancelProject()">Cancelar proyecto</button>
																</div>
													</div>

									    	</div>

									      <div class="modal-footer text-center" style="justify-content: center;">
									      	<img src="images/logo_brand_3.png" class="h-100" width="50">
									      </div>

									    </div>

									  </div>

									</div>

			<? endif; ?>



		<!-- Scripts-->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

			<script src="assets/js/instruments.js"></script>

			<script src="assets/js/ajaxChangeCities.js"></script>

			<script src="assets/js/ajaxFollowGenre.js"></script>

			<script src="assets/js/ajaxChangeGenresDashboard.js"></script>

			<script src="assets/js/ajaxChangeInboxEvents.js"></script>

			<script src="assets/js/ajaxUnFollowDashboard.js"></script>

			<script src="assets/js/ajaxUnfollowGenre.js"></script>

			<script src="assets/js/ajaxCancelEvent.js"></script>

			<script src="assets/js/ajaxPublishEvent.js"></script>

			<script src="assets/js/ajaxTicketsDownload.js"></script>

			<script src="assets/js/events.js"></script>

			<script src="assets/js/jquery.rut.js"></script>

			<script src="assets/js/jquery.mask.js"></script>

			<? if($userProfile_array['id_type_user'] == '1'): ?>

					<script src="assets/js/ajaxEventsArtist.js"></script>
					<script src="assets/js/ajaxConfigStream.js"></script>
					<script src="assets/js/ajaxStatsStream.js"></script>
					<script src="assets/js/jquery.charactercounter.js"></script>

					<script src="assets/js/ajaxCancelProject.js"></script>
					<script src="assets/js/ajaxPublishProject.js"></script>
					<script src="assets/js/ajaxAnswerProject.js"></script>

					<script>
						$("#inputPlandesc1").characterCounter({
						  limit: '300',
							counterFormat: '%1 caracteres restantes'
						});
						$("#inputPlandesc2").characterCounter({
						  limit: '300',
							counterFormat: '%1 caracteres restantes'
						});
						$("#inputPlandesc3").characterCounter({
						  limit: '300',
							counterFormat: '%1 caracteres restantes'
						});
					</script>

					<script type="text/javascript">

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
		 			 $(".progress-bar").animate({
		 						 width: "<?=$prBackersPercentage?>%"
		 				 }, 500 );
		 			 $('.recompensaCarousel-slick').slick({
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

		 <? elseif($userProfile_array['id_type_user'] == '2'): ?>

					<script src="assets/js/ajaxEventsUser.js"></script>
					<script src="assets/js/ajaxConfigStream.js"></script>
					<script src="assets/js/ajaxStatsStream.js"></script>

			<? endif; ?>

			<? if(isset($errTyp) && $errTyp =='danger'): ?>
        <script type='text/javascript'>alert('<?=$errMSG?>');</script>
      <? endif; ?>

			<? if(isset($_SESSION['success'])): ?>
				<script type='text/javascript'>alert('<?=$_SESSION['success']?>');</script>
				<? unset($_SESSION['success']) ?>
			<? endif; ?>

			<? if(isset($_SESSION['tab'])): ?>
				<script>
					// $_SESSION['tab'] contiene el ID del div colapsado ej: $_SESSION['tab'] = 'collapseMyEvents'

				</script>
				<? unset($_SESSION['tab']) ?>
			<? endif; ?>


<!-- Footer -->

	<?php

		include 'resources/footer.php';

	 ?>

			<script>

				$(function() {

				  $('.selectpicker').selectpicker();

				});
				$(function (){

			    	$("[data-toggle=popover]").each(function(i, obj) {

						$(this).popover({
						 trigger: 'focus',
						  html: true,
						  content: function() {
						    var id = $(this).attr('id')
						    return $('#popover-content-' + id).html();
						  }
						});

					});
				});

			</script>
			<script type="text/javascript">
				$( "#acceso-eventostream1" ).click(function() {
					$("#tablaeventosstream").css("display", "none");
					$("#detalleEventoStream").css("display", "flex");
				});
				$( "#acceso-eventostream2" ).click(function() {
					$("#tablaeventosstream").css("display", "none");
					$("#detalleEventoStream").css("display", "flex");
				});
				$( "#acceso-eventostream3" ).click(function() {
					$("#tablaeventosstream").css("display", "none");
					$("#detalleEventoStream").css("display", "flex");
				});
				$( "#acceso-eventostream4" ).click(function() {
					$("#tablaeventosstream").css("display", "none");
					$("#detalleEventoStream").css("display", "flex");
				});
				$( "#acceso-eventostream5" ).click(function() {
					$("#tablaeventosstream").css("display", "none");
					$("#detalleEventoStream").css("display", "flex");
				});
				$( "#acceso-eventostream6" ).click(function() {
					$("#tablaeventosstream").css("display", "none");
					$("#detalleEventoStream").css("display", "flex");
				});
				$( "#return-eventostream1" ).click(function() {
					$("#detalleEventoStream").css("display", "none");
					$("#tablaeventosstream").css("display", "flex");
				});
				$( "#return-v-eventostream1" ).click(function() {
					$("#detalleEventoStream").css("display", "none");
					$("#tablaeventosstream").css("display", "flex");
				});
			</script>

			<script>
        $("input#inputRut").rut({formatOn: 'keyup', ignoreControlKeys: false})
      </script>

			<script>
	      function writeCancelValue(val){
	        document.getElementById('id_event-cancelValue').value = val;
	      }
      </script>

			<script type="text/javascript">
				$(document).ready(function(){
				  $('#inputPhone').mask('(+56) 90 0000000');
				  $('.valuePlan').mask('000.000.000.000.000', {reverse: true});
				});
			</script>

			<script type="text/javascript">
				$( "#editPlanButton-1" ).click(function() {
					$("#planSlot-1").css("display", "none");
					$("#editPlanSlot-1").css("display", "flex");
				});
				$( "#editPlanButton-2" ).click(function() {
					$("#planSlot-2").css("display", "none");
					$("#editPlanSlot-2").css("display", "flex");
				});
				$( "#editPlanButton-3" ).click(function() {
					$("#planSlot-3").css("display", "none");
					$("#editPlanSlot-3").css("display", "flex");
				});

				$( "#closePlanButton-1" ).click(function() {
					$("#editPlanSlot-1").css("display", "none");
					$("#planSlot-1").css("display", "flex");
				});
				$( "#closePlanButton-2" ).click(function() {
					$("#editPlanSlot-2").css("display", "none");
					$("#planSlot-2").css("display", "flex");
				});
				$( "#closePlanButton-3" ).click(function() {
					$("#editPlanSlot-3").css("display", "none");
					$("#planSlot-3").css("display", "flex");
				});
			</script>

			<script>
				$("#inputCancelPrivate").characterCounter({
					limit: '200',
					counterFormat: '%1 caracteres restantes'
				});
				$("#inputContactMessage").characterCounter({
					limit: '1200',
					counterFormat: '%1 caracteres restantes'
				});
			</script>

			<? include 'resources/googleLoginScript.php'; ?>
	</body>

</html>
