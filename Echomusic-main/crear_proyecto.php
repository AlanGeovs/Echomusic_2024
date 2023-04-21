<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';
include 'resources/crowdfunding/projectCreate_script.php';
/*
include 'resources/index_script.php';

if(isset($_SESSION['loggedTester']) AND $_SESSION['loggedTester'] == true){



}else{

  header('Location: logintester.php');

  die();

}*/

		function isMobileDevice() {
			    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
			|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
			, $_SERVER["HTTP_USER_AGENT"]);
		}

?>

<!DOCTYPE HTML>


<html>

	<head>

		<title>EchoMusic | Proyecto-Crowdfunding</title>

		<meta charset="utf-8" />
		<meta name="author" content="EchoMusic" />

		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />

		<meta name="og:image" content="https://echomusic.cl/images/logo_brand_3.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="Proyecto-Crowdfunding EchoMusic.cl - La música nos conecta" />

		<meta name="description" content="descripcion de Proyecto-Crowdfunding." />

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

		 <div id="streamMainBanner" class="container">

		<div id="" class="p-4"></div>
<!-- Breadcrumb -->

			<nav aria-label="breadcrumb" id="streamTBreadcrumb">

			  <ol class="breadcrumb mb-0">

			    <li class="breadcrumb-item"><a href="dashboard.php">Panel de control</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Crear proyecto</li>

			  </ol>

			</nav>
			<hr>
		<? if(!$projectExist): ?>
			<? if($_SESSION['type_user']=='1'): ?>
					<div class="row">
						<div class="col-md-12 my-2">
								<h3 class="font-weight-bold text-center">¿Deseas iniciar un proyecto Crowdfunding?</h3>
						</div>
						<!-- Data ready check -->
					<?if(isset($dataReady)): ?>
						<div class="col-md-12 my-2 text-center">
								<form action="" method="POST">
									<div class="form-group">
											<input class="form-check-input" type="checkbox" value="check" id="defaultCheck1">
											<label class="form-check-label" id="defaultCheck1Label" for="defaultCheck1">
												Acepto los <a href="" data-toggle="modal" data-target="#crowdfundingTosModal">términos y condiciones</a>
											</label>
									</div>
									<a href="search_crowdfunding.php" class="btn btn-secondary my-2">Volver</a>
									<input type="submit" class="btn btn-primary my-2 check" name="create_project" value="Si, iniciar crowdfunding" style="display: none;"/>
									<button class="btn btn-primary my-2 check" disabled>Si, iniciar crowdfunding</button>
								</form>
						</div>
					<? else: ?>
						<p>Antes de crear un proyecto, primero debes registrar los datos de tu cuenta para poder realizar los pagos correspondientes. Puedes hacerlo desde la pestaña <strong>"Mi Cuenta"</strong></p>
					<? endif; ?>
					</div>
			<? elseif($_SESSION['type_user']=='2'): ?>
					<div class="row">
						<div class="col-md-12 my-2 text-center">
								<h3 class="font-weight-bold text-center">Lo sentimos, pero esta sección está destinada solo para artistas</h3>
						</div>
						<a href="https://qa.echomusic.cl/index.php" class="btn btn-primary m-auto" disabled>Volver al inicio</a>
					</div>

			<? elseif($plsLogin==true): ?>
				<div class="row">
					<div class="col-md-12 my-2 text-center">
							<h3 class="font-weight-bold text-center">Debes iniciar sesión para acceder a la creación de proyectos Crowdfunding</h3>
					</div>
				</div>
			<? endif; ?>
		<? else: ?>
			<div class="row">
				<div class="col-md-12 my-2">

					<h3 class="font-weight-bold">Ingresa los datos de tu proyecto para recaudar fondos.</h3>
					<p class="font-weight.bold"> una vez que hayas completado todas las etapas del formulario, puedes publicar el proyecto desde tu <a href="dashboard.php">Panel de control</a> | Pestaña Crowdfunding</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-12" id="pills-tab-crearproyecto">

			<ul class="nav nav-pills"  role="tablist">
			  <li class="nav-item" role="presentation">
			    <a class="nav-link active" id="pills-datos-tab" data-toggle="pill" href="#pills-datos" role="tab" aria-controls="pills-datos" aria-selected="true">Datos proyecto</a>
			  </li>
			  <li class="nav-item <?=(!$projectExist) ? 'd-none' : ''?>" role="presentation" id="li-monto-tab">
			    <a class="nav-link" id="pills-monto-tab" data-toggle="pill" href="#pills-monto" role="tab" aria-controls="pills-monto" aria-selected="false">Montos y Plazos</a>
			  </li>
			  <li class="nav-item <?=(!$projectExist) ? 'd-none' : ''?>" role="presentation" id="li-recompensas-tab">
			    <a class="nav-link" id="pills-recompensas-tab" data-toggle="pill" href="#pills-recompensas" role="tab" aria-controls="pills-recompensas" aria-selected="false">Recompensas</a>
			  </li>
			  <li class="nav-item <?=(!$projectExist) ? 'd-none' : ''?>" role="presentation" id="li-multimedia-tab">
			    <a class="nav-link" id="pills-multimedia-tab" data-toggle="pill" href="#pills-multimedia" role="tab" aria-controls="pills-multimedia" aria-selected="false">Multimedia</a>
			  </li>
			</ul>
			<div class="tab-content" id="pills-tabContent" style="border-top: 2px solid #ff6600;">
			  <div class="tab-pane fade show active" id="pills-datos" role="tabpanel" aria-labelledby="pills-datos-tab">
			  	<form enctype="multipart/form-data" action="" method="post">
					<div class="row mt-4">
						<div class="form-group col-md-8">
							<label class="font-weight-bold" for=" ">Nombre del proyecto</label>
							<input type="text" value="<?=$dataProject['project_title']?>" name="title" class="form-control form-custom-1" id="prTitle_Input" placeholder="ej: Nuevo videoclip">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-8">
							<label class="font-weight-bold" for=" ">Categoría del proyecto</label>
							<select id="prCategory_Input" name="category" class="form-control form-custom-1 col-lg-12 col-md-12 col-12">

						  		<option value="" disabled selected>Categoría</option>

					  		<? foreach($arrayCategories as $categories): ?>
									<? $selected = ($dataProject['id_category'] == $categories['id_category']) ? "selected" : "" ?>
										<option value="<?=$categories['id_category']?>" <?=$selected?>><?=$categories['name_category']?></option>';
									<? unset($selected); ?>
								<? endforeach; ?>

							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-8">
							<label class="font-weight-bold" for=" ">Región del proyecto (Solo si es presencial)</label>
							<select id="prRegion_Input" name="region" class="form-control form-custom-1 col-lg-12 col-md-12 col-12">

						  		<!-- <option value="" disabled selected>Región</option> -->
						  		<option value="0" selected>No aplica</option>

						  		<? foreach($regionsArray as $regions): ?>
										<? $selected = ($dataProject['project_region'] == $regions['id_region']) ? "selected" : "" ?>
											<option value="<?=$regions['id_region']?>" <?=$selected?>><?=$regions['name_region']?></option>
									  <? unset($selected); ?>
								<? endforeach; ?>

							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
				    	<label class="font-weight-bold" for=" ">Descripción del proyecto</label>
				    	<textarea class="form-control form-custom-1" name="description" id="prDescription_Input" placeholder="Mínimo 50 caracteres - La descripción es muy importante para explicar tu proyecto a los usuarios" rows="6"><?=$dataProject['project_desc']?></textarea>
				  	</div>
			  	</div>
					<div class="row">
						<div class="offset-md-3 col-md-6 text-center">
							<button id="projectEditMain_submit" name="" class="btn btn-primary my-2">Guardar</button>
							<input type="reset" class="btn btn-secondary my-2" value="Limpiar campos">
						</div>
					</div>
				</form>
			  </div>

			  <div class="tab-pane fade" id="pills-monto" role="tabpanel" aria-labelledby="pills-monto-tab">
			  	<form enctype="multipart/form-data" action="" method="post">
					<div class="row">
						<div class="form-group col-md-4">
							<label class="font-weight-bold" for=" "> </label>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label class="font-weight-bold" for=" ">Monto a financiar (Pesos chilenos)</label>
							<input type="text" value="<?=number_format($projectAmount , 0, ',', '.')?>" name="" class="form-control form-custom-1" id="prAmount_Input" placeholder="1.000.000">
						</div>
						<div class="form-group col-md-4">
							<label class="font-weight-bold" for=" ">Costo servicio de recaudación (8% +IVA)</label>
							<p>$<span id="feeCalculate_section"><?=number_format($commissionProject , 0, ',', '.')?></span></p>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-4">
							<label class="font-weight-bold" for=" "> </label>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
			  				<label class="font-weight-bold" for=" ">Plazo de recaudación</label> <a class="btn btn-primary ml-1 px-2 py-0" data-toggle="modal" data-target="#plazosRModal"> ? </a>
							<div class="row m-0">
								<select id="prRecTime_Input" name=" " class="form-control form-custom-1">
									<option value=""> - </option>
									<?for($i=30; $i<=60; $i+=15):?>
									<? $selected = ($arrayTimes['rec_time'] == $i) ? "selected" : "" ?>
										<option  value="<?=$i?>" <?=$selected?>><?=$i?> días</option>
										<? unset($selected); ?>
									<?endfor;?>
								</select>
							</div>
						</div>
						<div class="form-group col-md-4">
			  				<label class="font-weight-bold" for="inputEventDay">Plazo de ejecución</label> <a class="btn btn-primary ml-1 px-2 py-0" data-toggle="modal" data-target="#plazosEModal"> ? </a>
									<div class="row m-0">
										<select id="prExecTime_Input" name=" " class="form-control form-custom-1">
											<option value=""> - </option>
											<?for($i=1; $i<10; $i++):?>
											<? $selected = ($arrayTimes['exec_time'] == $i) ? "selected" : "" ?>
											<? if($i=='1'): ?>
												<option  value="<?=$i?>" <?=$selected?>><?=$i?> mes</option>
											<? elseif($i>'1'): ?>
												<option  value="<?=$i?>" <?=$selected?>><?=$i?> meses</option>
											<? endif; ?>
												<? unset($selected); ?>
											<?endfor;?>
										</select>
					  			</div>
						</div>
					</div>
					<div class="row my-2">
						<div class="offset-md-3 col-md-6 text-center">

							<button type="submit" id="projectEditAmount_submit" name="" class="btn btn-primary my-2">Guardar</button>
							<input type="reset" class="btn btn-secondary my-2" value="Limpiar campos">

						</div>

					</div>
				</form>
			  </div>

			  <div class="tab-pane fade" id="pills-recompensas" role="tabpanel" aria-labelledby="pills-recompensas-tab">
			  	<div class="row mt-4">
					  <div class="col-3">
					    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					      <a class="nav-link active" id="v-pills-rec1-tab" data-toggle="pill" href="#v-pills-rec1" role="tab" aria-controls="v-pills-rec1" aria-selected="true">
					      	<?php
					      	if(isMobileDevice()){echo '1';}else{echo 'Recompensa 1';}
					      	?></a>
					      <a class="nav-link" id="v-pills-rec2-tab" data-toggle="pill" href="#v-pills-rec2" role="tab" aria-controls="v-pills-rec2" aria-selected="false">
					      	<?php
					      	if(isMobileDevice()){echo '2';}else{echo 'Recompensa 2';}
					      	?></a>
					      <a class="nav-link" id="v-pills-rec3-tab" data-toggle="pill" href="#v-pills-rec3" role="tab" aria-controls="v-pills-rec3" aria-selected="false">
					      	<?php
					      	if(isMobileDevice()){echo '3';}else{echo 'Recompensa 3';}
					      	?></a>
					      <a class="nav-link" id="v-pills-rec4-tab" data-toggle="pill" href="#v-pills-rec4" role="tab" aria-controls="v-pills-rec4" aria-selected="false">
					      	<?php
					      	if(isMobileDevice()){echo '4';}else{echo 'Recompensa 4';}
					      	?></a>
					      <a class="nav-link" id="v-pills-rec5-tab" data-toggle="pill" href="#v-pills-rec5" role="tab" aria-controls="v-pills-rec5" aria-selected="false">
					      	<?php
					      	if(isMobileDevice()){echo '5';}else{echo 'Recompensa 5';}
					      	?></a>
					    </div>
					  </div>
					  <div class="col-9">
					    <div class="tab-content" id="v-pills-tabContent">
					    	<!--1a Recompensa -->
								<? foreach($projectTiersArray as $projectTiers): ?>
						      <div class="tab-pane fade show <?=($projectTiers['tier_slot']=='1') ? 'active' : '' ?>" id="v-pills-rec<?=$projectTiers['tier_slot']?>" role="tabpanel" aria-labelledby="v-pills-rec<?=$projectTiers['tier_slot']?>-tab">
						      	<div class="row">
									<div class="form-group col-md-10">
										<label class="font-weight-bold" for=" ">Nombre recompensa</label>
										 <input type="text" value="<?=$projectTiers['tier_title']?>" name="prNameTier_<?=$projectTiers['tier_slot']?>" class="form-control form-custom-1" id="prNameTier_<?=$projectTiers['tier_slot']?>" placeholder="ej: Apoyo básico">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-10">
										<label class="font-weight-bold" for=" ">Monto de apoyo</label>
										 <input type="text" value="<?=number_format($projectTiers['tier_amount'] , 0, ',', '.')?>" name="prAmountTier_<?=$projectTiers['tier_slot']?>" class="form-control form-custom-1 amountTier" id="prAmountTier_<?=$projectTiers['tier_slot']?>" placeholder="1.000.000">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-10">
								    	<label class="font-weight-bold" for=" ">Descripción</label>
								    	<textarea class="form-control form-custom-1" name="prDescTier_<?=$projectTiers['tier_slot']?>" id="prDescTier_<?=$projectTiers['tier_slot']?>" placeholder="Máximo 300 caracteres" rows="3"><?=$projectTiers['tier_desc']?></textarea>
								  	</div>
							  	</div>
							  	<div class="row">
									<div class="form-group col-md-10">
								    	<label class="font-weight-bold" for=" ">Recompensa</label>
								    	<div class="wrapperRem<?=$projectTiers['tier_slot']?> mb-2">
												<? $a = 'tier_count_'.$projectTiers['tier_slot']; ?>
												<? $i = 1; ?>
								          	<?if($projectTiers['t_reward_01']!=''):		?><div><input id="t_reward_<?=$projectTiers['tier_slot']?>_01" class="form-control form-custom-1 mb-3 col-8" type="text" name="input_array_nameRem<?=$projectTiers['tier_slot']?>[]" placeholder="De 2 a 55 caracteres" value="<?=$projectTiers['t_reward_01']?>" maxlength="55"/></div><?endif;?>
								          	<?if($projectTiers['t_reward_02']!=''):$i+=1;?><div><input id="t_reward_<?=$projectTiers['tier_slot']?>_02" class="form-control form-custom-1 mb-3 col-8" type="text" name="input_array_nameRem<?=$projectTiers['tier_slot']?>[]" placeholder="De 2 a 55 caracteres" value="<?=$projectTiers['t_reward_02']?>" maxlength="55"/><a href="javascript:void(0);" class="remove_field mb-1">Eliminar recompensa</a></div><?endif;?>
								          	<?if($projectTiers['t_reward_03']!=''):$i+=1;?><div><input id="t_reward_<?=$projectTiers['tier_slot']?>_03" class="form-control form-custom-1 mb-3 col-8" type="text" name="input_array_nameRem<?=$projectTiers['tier_slot']?>[]" placeholder="De 2 a 55 caracteres" value="<?=$projectTiers['t_reward_03']?>" maxlength="55"/><a href="javascript:void(0);" class="remove_field mb-1">Eliminar recompensa</a></div><?endif;?>
								          	<?if($projectTiers['t_reward_04']!=''):$i+=1;?><div><input id="t_reward_<?=$projectTiers['tier_slot']?>_04" class="form-control form-custom-1 mb-3 col-8" type="text" name="input_array_nameRem<?=$projectTiers['tier_slot']?>[]" placeholder="De 2 a 55 caracteres" value="<?=$projectTiers['t_reward_04']?>" maxlength="55"/><a href="javascript:void(0);" class="remove_field mb-1">Eliminar recompensa</a></div><?endif;?>

											<?if($projectTiers['t_reward_01']=='' && $projectTiers['t_reward_02']=='' && $projectTiers['t_reward_03']=='' && $projectTiers['t_reward_04']==''):?> <div><input id="t_reward_<?=$projectTiers['tier_slot']?>_01" class="form-control form-custom-1 mb-3 col-8" type="text" name="input_array_nameRem<?=$projectTiers['tier_slot']?>[]" placeholder="De 2 a 55 caracteres xx" maxlength="55"/></div> <?endif;?>
												<?$$a = $i;?>
												<?unset($i);?>

													<!-- <div><input class="form-control form-custom-1 mb-3 col-8" type="text" name="input_array_nameRem<?=$projectTiers['tier_slot']?>[1]" placeholder="Texto" /></div> -->

											<!-- <div><input class="form-control form-custom-1 mb-3 col-8" type="text" name="input_array_nameRem1[1]" placeholder="Texto" /></div> -->
										</div>
										<p><button id="add_fieldsRem<?=$projectTiers['tier_slot']?>" class="btn btn-primary my-2">Agregar </button></p>
								  	</div>

							  	</div>
						      </div>
								<? endforeach; ?>

					    </div>
					  </div>

				</div>
				<div class="row my-2">
					<div class="offset-md-3 col-md-6 text-center">

						<button type="submit" id="prTiers_submit" name="" class="btn btn-primary my-2">Guardar</button>
						<input type="reset" class="btn btn-secondary my-2" value="Limpiar campos">

					</div>
				</div>
			  </div>


			  <div class="tab-pane fade" id="pills-multimedia" role="tabpanel" aria-labelledby="pills-multimedia-tab">
			  	<div class="row my-2">
				  	<div class="col-12 mt-2 mb-4"><h3 class="font-weight-bold">Video explicativo</h3></div>

					<div class="col-lg-7 col-sm-12 mb-3 mb-md-0" id="">
						<form action="" method="post">
							<div class="col-md-12 text-rightcenter">
								<p class="font-weight-bold text-left">URL del Video <i class="fab fa-youtube"></i> <i class="fab fa-vimeo"></i> </p>
								<input type="text" id="prVideoURL_Input" name="url_video" value="<?switch($coverVideoService):case'youtube': echo 'https://www.youtube.com/watch?v='.$projectCoverVideo; break; case'vimeo': echo 'https://vimeo.com/'.$projectCoverVideo; break; case'': echo ''; break; endswitch;?>" class="form-control form-custom-1" placeholder="https://www.youtube.com/watch?v=123456789">
								<span class="text-danger"><strong class="alert"><?php if ( isset($videoError)) { echo $videoError;} ?></strong></span>
							</div>
							<? if(isset($projectCoverVideo)): ?>
									<div id="editProjectVideoContainer" class="project-thumb mb-md-50">
										<? switch($coverVideoService):case "youtube":?>
											<iframe style="width: 100%;height: 50vh;" src="https://www.youtube.com/embed/<?=$projectCoverVideo?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										<? break; ?>
										<? case "vimeo": ?>
											<iframe style="width: 100%;height: 50vh;" src="https://player.vimeo.com/video/<?=$projectCoverVideo?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
										<? break; ?>
										<? endswitch; ?>
									</div>
							<? else: ?>
									<div id="editProjectVideoContainer" class="project-thumb mb-md-50">
									</div>
							<? endif; ?>
							<div class="col-md-6 text-left">

								<button type="submit" id="saveProjectVideo" name="" class="btn btn-primary my-2">Guardar video</button>

							</div>
						</form>

					</div>

				<!--corte foto-->
				  	<div class="col-12 my-2"><hr></div>
				  	<div class="col-12 mt-2 mb-4"><h3 class="font-weight-bold">Foto de portada</h3></div>
					<div class="col-lg-7 col-sm-12 mb-3 mb-md-0" id="">
						<form id="cropCoverImage" method="post" enctype="multipart/form-data" action="resources/change_photoProjectCover.php">


							<strong style="font-size: 14px;">Actualizar Imagen:</strong>
							<div class="row">
								<div class="col-md-12">
									<label id="lblcoverImage" class="btn btn-primary" for="coverImage">
								    	<input name="coverImage" id="coverImage" type="file" style="display:none"
								    	onchange="$('#upload-cover-info').html(this.files[0].name)">
								    	Seleccionar Archivo
									</label>
									<small class="form-text text-muted">Dimensiones sugeridas 1620x900 - Peso máximo 5 mb</small>
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
							<strong style="font-size: 16px;">Recuerda: selecciona el área de la imagen que quieres mostrar.</strong>
							<div id="thumbs" style="padding:5px; width:600px"></div>
								</div>
								<div class="col-md-12 text-leftcenter">
									<!--<button type="button" id="saveCoverPhoto" class="btn btn-primary" >Cortar y guardar</button>-->
								</div>
							</div>

						</form>
					</div>
				</div>


					<div class="row">
						<div class="col-md-12" id="editProjectImageContainer">
							<img class="col-md-12" alt="" src="
							<? if(file_exists('images/crowdfunding/pr_'.$idProject.'/'.$idProject.'.jpg')): ?>
								images/crowdfunding/pr_<?=$idProject?>/<?=$idProject?>.jpg?<?=time()?>
							<? endif; ?>
							"/>
						</div>
					</div>


				<div class="row my-2">
					<div class="col-md-6 text-left">

						<button type="submit" id="saveCoverPhoto" name="" class="btn btn-primary my-2">Guardar imagen</button>
						<input id="limpiarCampoMultimedia" type="reset" class="btn btn-secondary my-2" value="Limpiar recorte">

					</div>

				</div>
			  </div>

			</div>
			</div>
		</div>
<? endif; ?>

	</main>
	<div class="modal fade" id="plazosRModal" tabindex="-1" role="dialog" aria-labelledby="plazosRModal" aria-hidden="true">

	  <div class="modal-dialog modal-md">

	    <div class="modal-content modal-border">
	    	<div class="modal-body">
		      	<div id="row-modal" class="row">

					<div class="col-md-8 order-2">
			        	<h3 class="modal-title">Descripci&oacuten de plazos</h3>
					</div>
					<div class="col-md-4  order-1 order-md-2">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        		<span aria-hidden="true">&times;</span>
			        	</button>
			        </div>
					<div class="col-md-12 order-3">
				  		<ul style="list-style: none;" class="p-0">
				  			<li>Plazo de Recaudación: plazo que tendrán tus patrocinadores para aportar fondos a tu proyecto.</li>
				  		</ul>
			        </div>
			    </div>

	    	</div>

	      <div class="modal-footer text-center" style="justify-content: center;">
	      	<img src="images/logo_brand_3.png" class="h-100" width="25">
	      </div>

	    </div>

	  </div>

	</div>
	<div class="modal fade" id="plazosEModal" tabindex="-1" role="dialog" aria-labelledby="plazosEModal" aria-hidden="true">

	  <div class="modal-dialog modal-md">

	    <div class="modal-content modal-border">
	    	<div class="modal-body">
		      	<div id="row-modal" class="row">

					<div class="col-md-8 order-2">
			        	<h3 class="modal-title">Descripción de plazos</h3>
					</div>
					<div class="col-md-4  order-1 order-md-2">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        		<span aria-hidden="true">&times;</span>
			        	</button>
			        </div>
					<div class="col-md-12 order-3">
				  		<ul style="list-style: none;" class="p-0">
				  			<li>Plazo de ejecución: plazo que tendrás como artista para ejecutar el proceso del proyecto y posterior entrega de recompensas.</li>
				  		</ul>
			        </div>
			    </div>

	    	</div>

	      <div class="modal-footer text-center" style="justify-content: center;">
	      	<img src="images/logo_brand_3.png" class="h-100" width="25">
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

			<script src="assets/js/image_crop_save_projectCover.js"></script>

			<script src="assets/js/jquery.imgareaselect.js" type="text/javascript"></script>

			<script src="assets/js/jquery.form.js"></script>

			<script src="assets/js/jquery.charactercounter.js"></script>

			<script src="assets/js/jquery.mask.js"></script>

			<script src="assets/js/ajaxEditProject.js"></script>

			<? include 'resources/login_error_script.php'; ?>


			<!-- Footer -->

			<? include 'resources/footer.php'; ?>

			<script type="text/javascript">
				//Add Input Fields
				$(document).ready(function() {
				    var max_fields = 4; //Maximum allowed input fields
				    var wrapperRem1    = $(".wrapperRem1"); //Input fields wrapper
				    var add_buttonRem1 = $("#add_fieldsRem1"); //Add button class or ID
				    var x = <?=$tier_count_1?>; //Initial input field is set to 1

				 //When user click on add input button
				 	$(add_buttonRem1).click(function(e){
				        e.preventDefault();
				 //Check maximum allowed input fields
				        if(x < max_fields){
				            x++; //input field increment
				 //add input field
				            $(wrapperRem1).append('<div class="mb-1"><input id="t_reward_1_0'+x+'" class="form-control form-custom-1 col-8"  type="text" name="input_array_nameRem1[]" placeholder="De 2 a 55 caracteres" maxlength="55"/> <a href="javascript:void(0);" class="remove_field mb-1">Eliminar recompensa</a></div>');
				        }
				    });

				    //when user click on remove button
				    $(wrapperRem1).on("click",".remove_field", function(e){
				        e.preventDefault();
				 		$(this).parent('div').remove(); //remove inout field
				 		x--; //inout field decrement
				    })
				});
				$(document).ready(function() {
				    var max_fields = 4; //Maximum allowed input fields
				    var wrapperRem2    = $(".wrapperRem2"); //Input fields wrapper
				    var add_buttonRem2 = $("#add_fieldsRem2"); //Add button class or ID
				    var x = <?=$tier_count_2?>; //Initial input field is set to 1

				 //When user click on add input button
				 	$(add_buttonRem2).click(function(e){
				        e.preventDefault();
				 //Check maximum allowed input fields
				        if(x < max_fields){
				            x++; //input field increment
				 //add input field
				            $(wrapperRem2).append('<div class="mb-1"><input id="t_reward_2_0'+x+'" class="form-control form-custom-1 col-8"  type="text"	name="input_array_nameRem2[]" placeholder="De 2 a 55 caracteres" maxlength="55"/> <a href="javascript:void(0);" class="remove_field mb-1">Eliminar recompensa</a></div>');
				        }
				    });

				    //when user click on remove button
				    $(wrapperRem2).on("click",".remove_field", function(e){
				        e.preventDefault();
				 		$(this).parent('div').remove(); //remove inout field
				 		x--; //inout field decrement
				    })
				});
				$(document).ready(function() {
				    var max_fields = 4; //Maximum allowed input fields
				    var wrapperRem3    = $(".wrapperRem3"); //Input fields wrapper
				    var add_buttonRem3 = $("#add_fieldsRem3"); //Add button class or ID
				    var x = <?=$tier_count_3?>; //Initial input field is set to 1

				 //When user click on add input button
				 	$(add_buttonRem3).click(function(e){
				        e.preventDefault();
				 //Check maximum allowed input fields
				        if(x < max_fields){
				            x++; //input field increment
				 //add input field
				            $(wrapperRem3).append('<div class="mb-1"><input id="t_reward_3_0'+x+'" class="form-control form-custom-1 col-8"  type="text" 	name="input_array_nameRem3[]" placeholder="De 2 a 55 caracteres" maxlength="55"/> <a href="javascript:void(0);" class="remove_field mb-1">Eliminar recompensa</a></div>');
				        }
				    });

				    //when user click on remove button
				    $(wrapperRem3).on("click",".remove_field", function(e){
				        e.preventDefault();
				 		$(this).parent('div').remove(); //remove inout field
				 		x--; //inout field decrement
				    })
				});
				$(document).ready(function() {
				    var max_fields = 4; //Maximum allowed input fields
				    var wrapperRem4    = $(".wrapperRem4"); //Input fields wrapper
				    var add_buttonRem4 = $("#add_fieldsRem4"); //Add button class or ID
				    var x = <?=$tier_count_4?>; //Initial input field is set to 1

				 //When user click on add input button
				 	$(add_buttonRem4).click(function(e){
				        e.preventDefault();
				 //Check maximum allowed input fields
				        if(x < max_fields){
				            x++; //input field increment
				 //add input field
				            $(wrapperRem4).append('<div class="mb-1"><input id="t_reward_4_0'+x+'" class="form-control form-custom-1 col-8"  type="text" 	name="input_array_nameRem4[]" placeholder="De 2 a 55 caracteres" maxlength="55"/> <a href="javascript:void(0);" class="remove_field mb-1">Eliminar recompensa</a></div>');
				        }
				    });

				    //when user click on remove button
				    $(wrapperRem4).on("click",".remove_field", function(e){
				        e.preventDefault();
				 		$(this).parent('div').remove(); //remove inout field
				 		x--; //inout field decrement
				    })
				});
				$(document).ready(function() {
				    var max_fields = 4; //Maximum allowed input fields
				    var wrapperRem5    = $(".wrapperRem5"); //Input fields wrapper
				    var add_buttonRem5 = $("#add_fieldsRem5"); //Add button class or ID
				    var x = <?=$tier_count_5?>; //Initial input field is set to 1

				 //When user click on add input button
				 	$(add_buttonRem5).click(function(e){
				        e.preventDefault();
				 //Check maximum allowed input fields
				        if(x < max_fields){
				            x++; //input field increment
				 //add input field
				            $(wrapperRem5).append('<div class="mb-1"><input id="t_reward_5_0'+x+'" class="form-control form-custom-1 col-8"  type="text" 	name="input_array_nameRem5[]" placeholder="De 2 a 55 caracteres" maxlength="55"/> <a href="javascript:void(0);" class="remove_field mb-1">Eliminar recompensa</a></div>');
				        }
				    });

				    //when user click on remove button
				    $(wrapperRem5).on("click",".remove_field", function(e){
				        e.preventDefault();
				 		$(this).parent('div').remove(); //remove inout field
				 		x--; //inout field decrement
				    })
				});

				$(".nav-link").click(function(e){
					$('img#photoPResize').imgAreaSelect({hide: true});
				});
				$("#limpiarCampoMultimedia").click(function(e){
					$('img#photoPResize').imgAreaSelect({hide: true});
				});
				$("#lblcoverImage").click(function(e){
					$('img#photoPResize').imgAreaSelect({hide: true});
				});

				$("#prDescription_Input").characterCounter({
					limit: '5000',
					counterFormat: '%1 caracteres restantes'
				});

				$("#prDescTier_1").characterCounter({
					limit: '300',
					counterFormat: '%1 caracteres restantes'
				});
				$("#prDescTier_2").characterCounter({
					limit: '300',
					counterFormat: '%1 caracteres restantes'
				});
				$("#prDescTier_3").characterCounter({
					limit: '300',
					counterFormat: '%1 caracteres restantes'
				});
				$("#prDescTier_4").characterCounter({
					limit: '300',
					counterFormat: '%1 caracteres restantes'
				});
				$("#prDescTier_5").characterCounter({
					limit: '300',
					counterFormat: '%1 caracteres restantes'
				});

			</script>

			<script type="text/javascript">
				$(document).ready(function(){
				  $('#inputPhone').mask('(+56) 90 0000000');
				  $('#prAmount_Input').mask('$000.000.000.000.000', {reverse: true});
				  $('.amountTier').mask('000.000.000.000.000', {reverse: true});
				});
			</script>

			<!-- commission calculator -->
			<script type="text/javascript">
				$('#prAmount_Input').keyup(function(){
					var myStr = $('#prAmount_Input').val();
					var newStr = myStr.replace(/\./g, '');
			    var firstValue  = Number(newStr);
					var calculatedFee = (firstValue/100)*9.52;
			    $('#feeCalculate_section').html(Math.round(calculatedFee));
					$('#feeCalculate_section').mask('000.000.000.000.000', {reverse: true});
				});
			</script>

			<script>
				$(document).ready(function() {
	            $('input[type="checkbox"]').click(function() {
	                var inputValue = $(this).attr("value");
	                $("." + inputValue).toggle();
	            });
	        });
			</script>

			<? if(isset($errTyp) && $errTyp =='danger'): ?>
        <script type='text/javascript'>alert('<?=$errMSG?>');</script>
      <? endif; ?>

			<? if($plsLogin==true): ?>
					 <script>
						 $(document).ready(function(){
							 $('#loginModal').modal('show');
						 });
					 </script>
			<? endif; ?>

			<? include 'resources/googleLoginScript.php'; ?>
	</body>

<? include 'resources/crowdfunding/crowdfundingTosModal.php'; ?>

</html>
