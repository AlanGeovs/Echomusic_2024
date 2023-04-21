<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/login_script.php';

// Get url breadcrumb
$breadCrumbUrl = $_SERVER['HTTP_REFERER'];

switch(true){
  case preg_match("/search/i", $breadCrumbUrl):
    $breadCrumbUrl = $breadCrumbUrl;
    $breadCrumbName = "Buscador";
  break;

  case preg_match("/index/i", $breadCrumbUrl):
    $breadCrumbUrl = "https://qa.echomusic.cl/index.php";
    $breadCrumbName = "Inicio";
  break;
  case true:
    $breadCrumbUrl = "https://qa.echomusic.cl/startEvent.php";
    $breadCrumbName = "Crear Evento";
  break;
}
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

		<title>EchoMusic | Requerimientos streaming</title>

		<meta charset="utf-8" />
		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />

		<meta name="og:image" content="https://qa.echomusic.cl/images/logo_brand_3.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="og:title" content="Crea tu Evento EchoMusic.cl - La música nos conecta" />
 		<meta name="description" content="Crea tu evento EchoMusic streaming o presencial y monetiza tu talento." />

    <? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<link rel="stylesheet" href="assets/css/custom.css">

		<link rel=icon href=/favicon.ico>
		<style type="text/css">
			html {
			  scroll-behavior: smooth;
			}
		</style>
    <? include_once("resources/Analytics.php"); ?>
	</head>

	<body>
	<main role="main">
		<!-- Top Navbar -->

		<?php

			include 'resources/topNavbar.php';



		 ?>
		 <!-- modal test-->
			<div class="modal fade" id="netModal" tabindex="-1" role="dialog" aria-labelledby="netModalLabel" aria-hidden="true">

			  <div class="modal-dialog modal-lg">

			    <div class="modal-content">

			      <div class="modal-header">

			        <h5 class="modal-title">Tester Banda ancha</h5>

			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

			          <span aria-hidden="true">&times;</span>

			        </button>

			      </div>

			      <div class="modal-body">

			        <div style="text-align:right;"><div style="min-height:360px;"><div style="width:100%;height:0;padding-bottom:50%;position:relative;"><iframe style="border:none;position:absolute;top:0;left:0;width:100%;height:100%;min-height:360px;border:none;overflow:hidden !important;" src="https://www.metercustom.net/plugin/?th=w"></iframe></div></div>Provided by <a href="https://www.meter.net">Meter.net</a></div>

			      </div>

			      <div class="modal-footer">

			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

			      </div>

			    </div>

			  </div>

			</div>

      <!-- modal video tutorial-->
 			<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">

 			  <div class="modal-dialog modal-lg">

 			    <div class="modal-content">

 			      <div class="modal-header">

 			        <!-- <h5 class="modal-title">Tester Banda ancha</h5> -->

 			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

 			          <span aria-hidden="true">&times;</span>

 			        </button>

 			      </div>

 			      <div class="modal-body">
              <!-- Insertar video de youtube -->
              <iframe id="tutorialVideo" width="100%" height="400rem" src="" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
 			      </div>

 			      <div class="modal-footer">

 			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

 			      </div>

 			    </div>

 			  </div>

 			</div>

<div id="streamTMainBanner" class="jumbotron pb-0">
			<div class="backgroundImage"></div>
		</div>



<!-- Main Content -->
<div id="streamMainBanner" class="container">

<!-- Breadcrumb -->

		<nav aria-label="breadcrumb" id="streamTBreadcrumb">

		  <ol class="breadcrumb mb-0">

		    <li class="breadcrumb-item"><a href="<?=$breadCrumbUrl?>"><?=$breadCrumbName?></a></li>

		    <li class="breadcrumb-item active" aria-current="page">Requerimientos</li>

		  </ol>

		</nav>

	  <!-- First Banner -->

	  <div class="row">
	  	<div class="col-md-12 my-2">
		  	<h2 class="font-weight-bold">Requerimientos mínimos</h2>
		  	<p>¿Qué es lo mínimo que necesito para transmitir un concierto o presentación vía online o streaming en EchoMusic?</p>
	  	</div>
	  </div>

	  <div class="row my-5 text-center">
	  	<div class="col-md-2 iconos-requerimientos">
	  		<i class="fas fa-laptop"></i><br>
	  		COMPUTADOR</div>
	  	<div class="col-md-2 iconos-requerimientos">
	  		<i class="fas fa-wifi"></i><br>
	  		CONEXIÓN A INTERNET<br><em>*Al menos 5MB en Velocidad de subida</em></div>
	  	<div class="col-md-2 iconos-requerimientos">
	  		<i class="fas fa-microphone-alt"></i><br>
	  		MICRÓFONO<br></div>
	  	<div class="col-md-2 iconos-requerimientos">
	  		<i class="fas fa-video"></i><br>
	  		CÁMARA<br><em>*Puede ser los integrados al computador</em></div>
	  	<div class="col-md-2 iconos-requerimientos">
			<img src="assets/icon/faz-audio.png" class="icon-logo" alt="" style="width: 100px;margin: 1rem;"><br>
			INTERFAZ DE AUDIO
	  	</div>
	  </div>
	  <div class="row my-5 text-center">
	  	<div class="col-md-12 text-left">
	  		<h5 class="font-weight-bold">Cuenta en plataforma de transmisión</h5>
	  	</div>
	  	<div class="col-md-3 iconos-requerimientos-s iconos-requerimientos-red">
	  		<i class="fab fa-youtube"></i><br>
	  		YOUTUBE
	  	</div>
	  	<div class="col-md-3 iconos-requerimientos-s iconos-requerimientos-sky">
	  		<i class="fab fa-vimeo-v"></i><br>
	  		VIMEO
	  	</div>
	  	<div class="col-md-3 iconos-requerimientos-s">
			<img src="assets/icon/zoom.png" class="icon-logo" alt="..."><br>
	  		ZOOM
	  	</div>

	  </div>

	  <div class="row mt-3">
	  	<div class="col-md-12">
	  		<h5 class="font-weight-bold">Adicionales para un concierto de Alto Impacto</h5>
	  	</div>
	  	<div class="col-md-4 mt-1 iconos-requerimientos-s text-center">
			<img src="assets/icon/obs.png" class="icon-logo" alt="...">
			<img src="assets/icon/streamyard.png" class="icon-logo" alt="..."><br>
	  		<p class="font-weight-bold mb-0 text-left h6">Software para transmisión en vivo:</p>
	  		<p class="mb-0 text-left h6">OBS Studio, Zoom o StreamYard, las que se vinculan a la plataforma de transmisión.</p>
	  	</div>
	  	<div class="col-md-3 mt-1 iconos-requerimientos-s text-center">
			<img src="assets/icon/prologic.png" class="icon-logo" alt="...">
			<img src="assets/icon/protools.png" class="icon-logo" alt="..."><br>
	  		<p class="font-weight-bold mb-0">DAW</p>
	  		<p class="mb-0 text-center h6">Digital Audio Workstation</p>
		</div>

	  </div>

	  <div class="row mt-4">
	  	<div class="col-md-12 text-center">
	  		<a class="btn btn-outline-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#netModal">Testear Ancho de Banda</a>
	  		<a class="btn btn-outline-primary btn-lg" href="#videosTutoriales" role="button" id="displaytutoriales">Ver Tutoriales</a>
	  		<a class="btn btn-outline-primary btn-lg" href="#preguntasFrecuentes" role="button" id="verPregFrecuentes">Preguntas Frecuentes</a>
	  		<a class="btn btn-primary btn-lg" href="stream2.php" role="button">Aceptar y Continuar</a>
	  	</div>
	  </div>
	  <div class="row mt-4" id="videosTutoriales"  style="display: none;">
	  	<div class="col-md-12 text-right">
	  		<a class="btn btn-primary btn-lg text-white mb-4" id="noneTutoriales" role="button">Ocultar Tutoriales <i class="fas fa-caret-up"></i></a>
	  	</div>
    	<div class="col-md-4 text-center">
  			<div class="card videoCarousel-Card ">

  				<a href="#" id="tutorialLink_1" data-toggle="modal" data-target="#tutorialModal"><img src="https://img.youtube.com/vi/pjFqPaRDRLg/hqdefault.jpg" class="card-img-top h-100" alt="Como crear un concierto streaming"></a>
          <input type="hidden" id="tutorialValue_1" value="https://www.youtube.com/embed/pjFqPaRDRLg">
  				<div class="card-body">

  					<p class="card-text font-weight-bold">Como crear un concierto streaming.</p>
		        <p class="card-text text-left">Aprende a crear tu concierto streaming en la plataforma EchoMusic, tomando en cuenta todos los requerimientos mínimos necesarios para realizarlo.</p>

          </div>

  			</div>
  		</div>
	  	<div class="col-md-4 text-center">

			<div class="card videoCarousel-Card">

				<a href="#" id="tutorialLink_2" data-toggle="modal" data-target="#tutorialModal"><img src="https://img.youtube.com/vi/Lh3dzRlhR3o/hqdefault.jpg" class="card-img-top h-100" alt="Configuración de Zoom en EchoMusic."></a>
        <input type="hidden" id="tutorialValue_2" value="https://www.youtube.com/embed/Lh3dzRlhR3o">
				<div class="card-body">

					<p class="card-text font-weight-bold">Configuración de Zoom en EchoMusic.</p>
					<p class="card-text text-left">Con este tutorial podrás configurar la plataforma Zoom para transmitir a través de Echomusic. Conoce las ventajas y desventajas de esta modalidad, además de saber cómo enlazar la url resultante en la plataforma de transmisión que te dará la oportunidad de rentabilizar tu talento a través de EchoMusic.</p>

				</div>

			</div>
	  </div>
	  	<div class="col-md-4 text-center">

			<div class="card videoCarousel-Card">

				<a href="#" id="tutorialLink_3" data-toggle="modal" data-target="#tutorialModal"><img src="https://img.youtube.com/vi/FN9V1TQzYKA/hqdefault.jpg" class="card-img-top h-100" alt="Configuración transmisión desde Zoom"></a>
        <input type="hidden" id="tutorialValue_3" value="https://www.youtube.com/embed/FN9V1TQzYKA">
				<div class="card-body">

					<p class="card-text font-weight-bold">Configuración transmisión desde Zoom a Youtube y a EchoMusic.</p>
					<p class="card-text text-left">Con este tutorial, podrás aprender a configurar la plataforma Zoom para trasmitir por Youtube live. Conoce las ventajas y desventajas de esta modalidad. Con todo eso ok, ¡ya estás list@ para transmitir a través de EchoMusic</p>

				</div>

			</div>
	  </div>
	  	<div class="col-md-4 text-center">

			<div class="card videoCarousel-Card">

				<a href="#" id="tutorialLink_4" data-toggle="modal" data-target="#tutorialModal"><img src="https://img.youtube.com/vi/umdn3DwKcpM/hqdefault.jpg" class="card-img-top h-100" alt="Configuración audio Zoom"></a>
        <input type="hidden" id="tutorialValue_4" value="https://www.youtube.com/embed/umdn3DwKcpM">
				<div class="card-body">

					<p class="card-text font-weight-bold">Configuración audio Zoom para streaming.</p>
					<p class="card-text text-left">Aprende a configurar los parámetros de audio de la plataforma Zoom para que tu audiencia escuche el sonido en estéreo y con niveles adecuados a la transmisión de música en vivo. Cuando esto ya esté listo, podrás realizar un evento al máximo nivel.</p>

				</div>

			</div>
	  </div>
	</div>
	<div class="row mt-4" id="preguntasFrecuentes"  style="display: none;">
	  	<div class="col-md-12 text-right">
	  		<a class="btn btn-primary btn-lg text-white" id="nonepreguntasFrecuentes" role="button">Ocultar Preguntas <i class="fas fa-caret-up"></i></a>
	  	</div>
	  	<!-- Accordion FAQs panels -->
	  	<div class="col-md-12">

			<div class="accordion mt-5" id="accordionFAQs">



				<!-- Questions cards -->

			  <div class="card">

			    <div class="card-header" id="FAQ-1">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-1" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Es necesario tener cuenta de YouTube, Vimeo o Zoom para transmitir en vivo? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-1" class="collapse show" aria-labelledby="FAQ-1" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>Sí, es necesario contar con cuenta de YouTube, Vimeo o Zoom. Al menos una. Mediante esta cuenta se genera el enlace de tu transmisión que luego será incorporado en el evento creado en el sitio de EchoMusic.cl</p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-2">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-2" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Cuáles son las diferencias para transmitir por YouTube, Vimeo o Zoom? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-2" class="collapse" aria-labelledby="FAQ-2" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>La cuenta de YouTube Live es gratuita, mientras que la de Vimeo y Zoom son de pago mensual con cargo a una tarjeta de crédito o débito.  Vimeo y Zoom ofrecen la posibilidad de generar eventos online, o streaming, con mayores niveles de seguridad y controles de acceso. Generalmente YouTube está pensado para eventos con suscripción gratuita o donaciones que están afectas a comisiones del portal YouTube, mientras que Zoom y Vimeo para eventos con un costo de entrada, es decir, con pago.</p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-3">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-3" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Qué pasa si quiero crear un evento con costo de entrada, pero no tengo suscripción a Vimeo o Zoom? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-3" class="collapse" aria-labelledby="FAQ-3" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>Esto no es un problema grande pero necesita seguimiento para la solución. Por eso, si quieres hacer tu evento, puedes solicitarlo escribiendo un correo al equipo de EchoMusic, donde te asesoraremos para llevar a cabo tu evento. Este servicio tiene un recargo por servicio especificado en los términos y condiciones.</p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-4">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-4" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Cuál es la diferencia entre las plataformas de transmisión (YouTube, Vimeo o Zoom) con los Software de transmisión en vivo? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-4" class="collapse" aria-labelledby="FAQ-4" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>La principal diferencia es que las plataformas de transmisión (Youtube, Vimeo o Zoom) son aquellas sobre las cuales el contenido es llevado a los distintos computadores o dispositivos en el mundo, mientras los softwares de transmisión en vivo o también llamados Codificadores (OBS, Streamlabs, Streamyard, Zoom, etc.) son los sistemas encargados de emitir el contenido que el usuario puede ver en las plataformas de transmisión.</p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-5">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-5" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Es necesario tener un software o programa de transmisión en vivo o Codificador? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-5" class="collapse" aria-labelledby="FAQ-5" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>Sí, es necesario, ya que este software convierte el formato de tu vídeo en uno adecuado y optimizado para que puedas hacer el streaming, o transmisión en vivo. Esto, aunque dispongas de una excelente conexión a Internet. Si no has descargado un software de transmisión, no podrás hacer directos. La buena noticia es que algunos son gratuitos y de buena calidad como OBS studio y Streamlabs OBS.</p>

			      </div>

			    </div>

			  </div>

			  <div class="card">

			    <div class="card-header" id="FAQ-6">

			      <h2 class="mb-0">

			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFAQ-6" aria-expanded="true" aria-controls="collapseMyEvents">

			          ¿Cuál es una secuencia lógica de transmisión de un evento de EchoMusic? <i class="fas fa-caret-down"></i>

			        </button>

			      </h2>

			    </div>

			    <div id="collapseFAQ-6" class="collapse" aria-labelledby="FAQ-6" data-parent="#accordionFAQs">

			      <div class="card-body">

							<p>Existen diferentes combinatorias según las características del evento, sin embargo la secuencia completa sería:</p>

              				<img src="images/grafica_streaming.jpg" alt="..." style="width: 100%;">

			      </div>

			    </div>

			  </div>



			</div>

		</div>
	</div>
</div>





<!-- Main Content -->




	</main>


<!-- Scripts

			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>-->

			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>


			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

			<script type="text/javascript">
				$( "#displaytutoriales" ).click(function() {
					$("#videosTutoriales").css("display", "flex");
				});
				$( "#verPregFrecuentes" ).click(function() {
					$("#preguntasFrecuentes").css("display", "flex");
				});
				$( "#noneTutoriales" ).click(function() {
					$("#videosTutoriales").css("display", "none");
				});
				$( "#nonepreguntasFrecuentes" ).click(function() {
					$("#preguntasFrecuentes").css("display", "none");
				});
			</script>

      <script>
      // Display video tutorial on modal
        $('#tutorialLink_1').on('click', function(){
          var videoValue = $("#tutorialValue_1").val();
          $("#tutorialVideo").attr("src",videoValue);
        })

        $('#tutorialLink_2').on('click', function(){
          var videoValue = $("#tutorialValue_2").val();
          $("#tutorialVideo").attr("src",videoValue);
        })

        $('#tutorialLink_3').on('click', function(){
          var videoValue = $("#tutorialValue_3").val();
          $("#tutorialVideo").attr("src",videoValue);
        })

        $('#tutorialLink_4').on('click', function(){
          var videoValue = $("#tutorialValue_4").val();
          $("#tutorialVideo").attr("src",videoValue);
        })

      // Stop video when modal closes
        $('#tutorialModal').on('hidden.bs.modal', function (e) {
          var video = $("#tutorialVideo").attr("src");
          $("#tutorialVideo").attr("src","");
          // $("#tutorialVideo").attr("src",video);
        })

      </script>

			<? include 'resources/login_error_script.php'; ?>
<!-- Footer -->

	<?php

		include 'resources/footer.php';

	 ?>

   <? include 'resources/googleLoginScript.php'; ?>


	</body>

</html>
