<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';
include 'resources/crowdfunding/projectPage_script.php';
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

		<title>EchoMusic | Proyecto-Crowdfunding</title>

		<meta charset="utf-8" />
		<meta name="author" content="EchoMusic" />

		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />

		<meta name="og:image" content="https://qa.echomusic.cl/images/crowdfunding/pr_<?=$dataProjectArray['id_project']?>/<?=$dataProjectArray['id_project']?>.jpg" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="<?=$dataProjectArray['project_title']?> | Crowdfunding" />

		<meta name="description" content="<?=nl2br($dataProjectArray['project_desc'])?>" />

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

<!-- Main Content -->
	 <div id="" class="p-5"></div>



	<!-- Name and Share -->

	 <div class="wt-80" id="eventHeaderShare">
		 <div class="row justify-content-between">

			 <div class="first-block">
				<!-- Breadcrumb -->
				<nav aria-label="breadcrumb" id="searchBreadcrumb">
				  <ol class="breadcrumb mb-0">
				    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
				    <li class="breadcrumb-item active" aria-current="page"><?=$dataProjectArray['project_title']?></li>
				  </ol>
				</nav>
			</div>

			<div class="text-rightcenter second-block">
				<ul class="list-inline">
					<li class="list-inline-item"><h2>Compartir</h2></li>
					<li class="list-inline-item list-fb"><a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/sharer.php?u=https://qa.echomusic.cl/proyecto.php?projectid=<?=$dataProjectArray['id_project']?>" target="_blank"><i class="fab fa-facebook-f share-fb"></i></a> </li>
					<li class="list-inline-item list-tw"><a target="_blank" rel="noopener noreferrer" href="https://twitter.com/share?url=https://qa.echomusic.cl/proyecto.php?projectid=<?=$dataProjectArray['id_project']?>&amp;text=EchoMusic&amp;hashtags=echomusic" target="_blank"><i class="fab fa-twitter share-tw"></i></a> </li>
					<li class="list-inline-item list-wpp"><a href="https://api.whatsapp.com/send?text=https://qa.echomusic.cl/proyecto.php?projectid=<?=$dataProjectArray['id_project']?>" data-action="share/whatsapp/share" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp share-wpp"></i></a></li>
				</ul>
			</div>

		 </div>
	 </div>
		<!-- Container -->
		<div class="container mt-4">


		<!-- Inicio Proyecto -->
			<div class="row align-items-center justify-content-center">
				<!--<div class="col-lg-12 col-md-12 text-center proyecto-items">
					<div class="proyecto-item">
	    				<h1 class="title-proyecto">
							<a href="#">AYUDA PARA CONTRUIR MI TALLER.</a>
	    				</h1>
	    			</div>
       			</div>-->
				<div class="col-lg-6 col-md-10">
					<div class="project-thumb mb-md-50">
						<? switch($coverVideoService):case "youtube":?>
							<iframe style="width: 100%;height: 50vh;" src="https://www.youtube.com/embed/<?=$projectCoverVideo?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<? break; ?>
						<? case "vimeo": ?>
							<iframe style="width: 100%;height: 50vh;" src="https://player.vimeo.com/video/<?=$projectCoverVideo?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
						<? break; ?>
						<? endswitch; ?>
					</div>
				</div>
				<div class="col-lg-6 proyecto-items proyecto-card no-shadow">
					<div class="proyecto-item mb-30">
							<div class="content project-summery p-4">
								<h1 class="title text-leftcenter">
									<a><?=$dataProjectArray['project_title']?></a>
			    				</h1>
								<em class="">Etapa</em>
								<div class="categoria-detalle">
									<a class="<?=$prStatusClass?>"><?=$prStatus?></a>
									<!--cerrado completado.
									cerrado no completado.-->
								</div>
								<div class="region-proyecto my-2">
									<em class="">Región</em><br>
									<b class="text-black mx-2"><?=$dataProjectArray['name_region']?></b>
								</div>
								<div class="proyecto-stats">
									<div class="stats-value">
										<em class="">Monto</em>
										<span class="stats-percentage"><?=$prBackersPercentage?>%</span>
									</div>
									<div class="progress">
										  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
									</div><!--
									<div class="stats-bar-detalle" data-value="59">
										<div class="bar-line" style="width: 59%;">
											$ 59.689
										</div>
									</div>-->
									<div class="stats-value">
										<span class="value-title"><span class="value">$<?=number_format($prBackersAmount , 0, ',', '.')?></span> de <span class="value">$<?=number_format($dataProjectArray['project_amount'] , 0, ',', '.')?></span></span>

									</div><span class="value-title">del total recaudado.</span>
								</div>

								<div class="project-funding-info">
									<div class="info-box col">
										<span><?=$totalBackers?></span>
										<span class="info-title"><?=($totalBackers == 1) ? 'Patrocinador' : 'Patrocinadores';?></span>
									</div>
									<div class="info-box col">
										<span><?=calculateDiff($datetimeProjectEnd)?></span>
										<span class="info-title">Días restantes para recaudar</span>
										<span class="info-bajada"><?getDayday($datetimeProjectEnd); ?> de <? getMonthYear($datetimeProjectEnd); ?></span>
									</div>
									<div class="info-box col">
										<span><?=calculateDiff($datetimeProjectExec)?></span>
										<span class="info-title">Plazo de ejecución</span>
										<span class="info-plazo"><?getDayday($datetimeProjectExec); ?> de <? getMonthYear($datetimeProjectExec); ?></span>
									</div>
								</div>
								<div class="text-center">
									<? if(strtotime($dateProjectEnd.' '.$timeProjectEnd)<time()):?>
										<a class="btn btn-primary btn-lg text-white my-2 isDisabled" disabled>Patrocinar</a>
									<? else: ?>
										<a class="btn btn-primary btn-lg text-white my-2" href="#recompensasPatrocinar">Patrocinar</a>
									<? endif; ?>
								</div>
							</div>
						</div>
				</div>
			</div>
			<hr>
			<div class="row justify-content-center" style="text-align: justify; padding: 2rem 15px;">
				<div id="" class="col-md-12">
					<b>Conoce más de <?=$artistArray['nick_user']?></b><br>
					<em>Asegurate de saber a quien vas a patrocinar.</em>
				</div>
				<div id="" class="col-md-5">
					<a href="https://qa.echomusic.cl/profile.php?userid=<?=$artistArray['id_user']?>">
					<label class="link-card-horizontal">
						<div class="card-horizontal">
						    <div class="card-img-horizontal-detalle">
						    	<img src="https://qa.echomusic.cl/images/avatars/<?=$artistArray['id_user']?>.jpg" class="card-img-left-detalle" alt="Foto del autor">
						   	</div>
						    <div class="card-body-horizontal">
						      <p class="card-text m-0"><i class="fas fa-map-marker-alt"></i> <?=$artistArray['name_city']?>, Región <?=$artistArray['name_region']?>.</p>
						      <p class="m-0 font-weight-bold text-black">Nombre artista</p>
						      <h5 class="card-title mb-1"><?=$artistArray['nick_user']?></h5>
						      
						    </div>

						</div>
					</label>
				</a>
				</div>
				<div id="" class="col-md-7 py-2">
					<a href="https://echomusic.cl/profile.php?userid=<?=$artistArray['id_user']?>">
						<label class="link-card-horizontal">
							<p class="m-0 font-weight-bold text-black">Descripción del artista:</p>
						   	<p class="card-text-descripcion mb-0"><?=$artistArray['desc_user']?></p>
						</label>
					</a>
				</div>
			</div>
			<hr>
			<div class="row justify-content-center my-5">
			  <div class="col-md-3 col-12 text-leftcenter my-1">
			    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			      <a class="nav-link active" id="v-pills-descripcion-tab" data-toggle="pill" href="#v-pills-descripcion" role="tab" aria-controls="v-pills-descripcion" aria-selected="true">Descripcion</a>
			      <a class="nav-link" id="v-pills-preguntas-tab" data-toggle="pill" href="#v-pills-preguntas" role="tab" aria-controls="v-pills-preguntas" aria-selected="false">Preguntas</a>
			      <a class="nav-link" id="v-pills-avances-tab" data-toggle="pill" href="#v-pills-avances" role="tab" aria-controls="v-pills-avances" aria-selected="false">Avances</a>
			    </div>
			  </div>
			  <div class="col-md-9 col-12 my-1" style="border-left: 1px solid #DBDBDB;">
			    <div class="tab-content" id="v-pills-tabContent">
			      <div class="tab-pane fade show active" id="v-pills-descripcion" role="tabpanel" aria-labelledby="v-pills-descripcion-tab">
			      	<b>Descripción</b><br><br>
					<p><?=nl2br($dataProjectArray['project_desc'])?></p>
			      </div>

			      <div class="tab-pane fade" id="v-pills-preguntas" role="tabpanel" aria-labelledby="v-pills-preguntas-tab">
			      	<b>Preguntas</b><br><br>
							<div id="preguntas-proyecto" class="actionBox">
				        <ul class="commentList" id="questionsList">

											<? foreach($projectQAsArray as $projectQAs): ?>
											<? $projectQuestionDatetime = date_create($projectQAs['question_date']); ?>
											<? $projectQuestionDatetime = DATE_FORMAT($projectQuestionDatetime, "d-m-Y"); ?>
											<? if($projectQAs['answer_date']!=''){
														$projectAnswerDatetime = date_create($projectQAs['answer_date']);
														$projectAnswerDatetime = DATE_FORMAT($projectAnswerDatetime, "d-m-Y");
												} ?>
												<li>
													<div class="row mt-3">
														<? if(file_exists('images/avatars/'.$projectQAs['id_user'].'.jpg')): ?>
												    	<label for="commentInput" class="col-1 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/<?=$projectQAs['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$projectQAs['id_user'].'.jpg')?>"></label>
						                <? else: ?>
												    	<label for="commentInput" class="col-1 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/profile_default.jpg"></label>
						                <? endif; ?>
												    <div class="col-12 commentText pt-2 ml-3">
															<p class="font-weight-bold mb-1"><? echo ($projectQAs['nick_user'] === NULL) ? $projectQAs['first_name_user'] : $projectQAs['nick_user'];?></p>
												      <p class="mb-2"><?=$projectQAs['question_desc']?></p>
															<span class="date sub-text"><?=$projectQuestionDatetime?></span>
												    </div>
												  </div>


												</li>
												<? if($projectQAs['answer_desc']!=''): ?>
													<li class="container answerProject-li">
														<div class="row mt-3">
															<? if(file_exists('images/avatars/'.$artistArray['id_user'].'.jpg')): ?>
													    	<label for="commentInput" class="col-md-2 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/<?=$artistArray['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$artistArray['id_user'].'.jpg')?>"></label>
							                <? else: ?>
													    	<label for="commentInput" class="col-md-2 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/profile_default.jpg"></label>
							                <? endif; ?>
													    <div class="col-md-10 commentText pt-2 ml-3">
																<p class="font-weight-bold mb-1"><i class="fas fa-reply fa-rotate-180 mr-2" style="font-size: 25px;color: #ff6600;"></i><? echo ($artistArray['nick_user'] === NULL) ? $artistArray['first_name_user'] : $artistArray['nick_user'];?></p>
													      <p class="mb-2"><?=$projectQAs['answer_desc']?></p>
																<span class="date sub-text"><?=$projectAnswerDatetime?></span>
													    </div>
													  </div>
													</li>
												<? endif; ?>

											<? endforeach; ?>

				        </ul>

							<? if(isset($_SESSION['user'])): ?>
					        <form id="projectQuestion_form" action="" class="form-inline my-5" role="form" method="POST">
										<input type="hidden" name="id_project" value="<?=$prId?>"/>
					            <div class="form-group col-12">
					                <input name="question_text" id="question_text" class="form-control" type="text" placeholder="Tu pregunta">
					            </div>
					            <div class="form-group col-12">
					                <input type="submit" id="submit_question" class="btn btn-primary" value="Preguntar">
					            </div>
					        </form>
							<? else: ?>
								<div class="col-md-12 mt-5 button-featuredServicio text-center">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Para comentar, debes iniciar sesión</button>
								</div>
							<? endif; ?>

				    </div>
			      </div>

			      <div class="tab-pane fade" id="v-pills-avances" role="tabpanel" aria-labelledby="v-pills-avances-tab">
			      	<b>Avances</b><br><br>
							<? foreach($projectUpdatesArray as $projectUpdates): ?>
							<? $dateTimeUpdate = date_create($projectUpdates['update_date']);?>
							<h3 class="text-right">Actualización <?getDayday($dateTimeUpdate); ?> de <? getMonthYear($dateTimeUpdate); ?></h3>
								<? if(file_exists('images/crowdfunding/pr_'.$prId.'/'.$projectUpdates['project_multimedia_name'].'.jpg')): ?>
									<img src="images/crowdfunding/pr_<?=$prId?>/<?=$projectUpdates['project_multimedia_name']?>.jpg"/>
								<? endif; ?>
								<p><pre><?=$projectUpdates['update_desc']?></pre></p>
								<hr>
							<? endforeach; ?>
			      </div>
			    </div>
			  </div>
			</div>

			<hr>

			<div id="recompensasPatrocinar" class="row my-5">

				<div class="col-md-12">
				<section class="recompensaCarousel-slick">

					<? foreach($projectTiersArray as $projectTiers): ?>
					<div>
						<? if(strtotime($dateProjectEnd.' '.$timeProjectEnd)<time()):?>
							<a class="recompensaCarousel-link disabled">
						<? else: ?>
							<a class="recompensaCarousel-link" href="https://qa.echomusic.cl/confirm_project.php?tier=<?=$projectTiers['id_tier']?>">
						<? endif;?>
							<label>
								<div class="card recompensaCarousel-Card">
								  <div class="card-body">
								  	<h2 class="text-center font-weight-bold">$ <?=number_format($projectTiers['tier_amount'] , 0, ',', '.')?> o más</h2>
								    <p class="card-text font-weight-bold"><?=$projectTiers['tier_title']?></p>
								    <p><?=$projectTiers['tier_desc']?></p>
								    <b>Incluye:</b>
								    <ul>
					          	<?if($projectTiers['t_reward_01']!=''):?><li><?=$projectTiers['t_reward_01']?></li><?endif;?>
					          	<?if($projectTiers['t_reward_02']!=''):?><li><?=$projectTiers['t_reward_02']?></li><?endif;?>
					          	<?if($projectTiers['t_reward_03']!=''):?><li><?=$projectTiers['t_reward_03']?></li><?endif;?>
					          	<?if($projectTiers['t_reward_04']!=''):?><li><?=$projectTiers['t_reward_04']?></li><?endif;?>
						        </ul>
								  </div>
								</div>
							</label>
						</a>
					</div>
				<? endforeach; ?>

		        </section>
				</div>

		      </div>
			<hr>

			<div class="row" id="">
				<div class="col-md-12">
					<ul class="list-inline list-border">
  						<li class="list-inline-item"><a href="mailto: contacto@echomusic.cl"> Denunciar</a></li>
						<li class="list-inline-item"><a href="about.php#aboutFirstIntro"> Preguntas Frecuentes</a></li>
						<li class="list-inline-item"><a href="" data-toggle="modal" data-target="#crowdfundingTosModal"> Términos y Condiciones Crowdfunding</a></li>
					</ul>
				</div>
			</div>
	</main>

		<!-- Scripts -->

			<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<script src="assets/slick/slick.js" type="text/javascript" charset="utf-8"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script src="assets/js/ajaxChangeGenres.js"></script>

			<script src="assets/js/ajaxSubmitProjectQuestion.js"></script>

			<? include 'resources/login_error_script.php'; ?>

			<!-- Footer -->

			<? include 'resources/footer.php'; ?>

			<script type="text/javascript">
				$(".progress-bar").animate({
				    width: "<?=$prBackersPercentage?>%"
				}, 2500 );
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
	</body>

	<?php

	include 'resources/conditionsModal.php';
	include 'resources/privacyModal.php';
	include 'resources/crowdfunding/crowdfundingTosModal.php';

	?>

</html>
