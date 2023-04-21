<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'resources/rate_script.php';
include 'resources/login_script.php';
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

    <title>EchoMusic | Valoración <?=$eventData['nick_user']?></title>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="assets/css/custom.css">

    <link rel="stylesheet" href="assets/css/better-rating.css">

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

      <div class="backgroundImage">



      </div>

      <div class="profileImage text-center">
        <? if(file_exists('images/avatars/'.$eventData['id_user'].'.jpg')): ?>
            <img alt="" src="images/avatars/<?=$eventData['id_user']?>.jpg">
        <? else: ?>
            <img alt="" src="images/avatars/profile_default.jpg">
        <? endif; ?>
      </div>

    </div>



    <!-- Container -->

    <div class="container">


<? if(isset($errTyp) && $errTyp == "success"):?>
<!-- Event info -->
    <div class="row justify-content-center" id="artistHOpinion">

      <div class="col-md-10 text-center">

        <h3 class="mb-0 font-weight-bold"><?=$eventData['nick_user']?></h3>
        <p><b><?=$eventData['name_event']?></b> | <?=$eventData['location']?> | <span class="text-primario"><?=$dateEvent?></span></p>

      </div>

    </div>
<!-- Notification -->
    <div class="row mt-4" id="reserveConfirmNotice">
      <div class="text-center col-12 align-self-center">
          <h2>Proceso de valoración completado</h2>
          <p>Gracias por ser parte de la comunidad EchoMusic, tu reseña ya esta disponible para el artista.</p>
          <i class="far fa-check-circle"></i>
          <h3 class="mt-4">Ya puedes continuar navegando por EchoMusic</h3>
      </div>
    </div>

<? elseif(isset($errTyp) && $errTyp == "unavailable"): ?>
<!-- Notification -->
    <div class="row mt-4" id="reserveConfirmNotice">
      <div class="text-center col-12 align-self-center">
          <h2>Proceso de valoración no disponible</h2>
          <p>Este proceso de valoración no esta disponible. </br>
            <?=($plsLogin==true) ? "<strong>Por favor Inicia Sesión para acceder a este proceso de valoración</strong>" : "Si crees que debería estar disponible por favor entra en contacto con nuestro equipo de soporte"?></p>
          <i class="fas fa-times text-danger"></i>
          <h3 class="mt-4">contacto@echomusic.cl</h3>
      </div>
    </div>

<? else: ?>
<!-- Event info -->
      <div class="row justify-content-center" id="artistHOpinion">

        <div class="col-md-10 text-center">

          <h3 class="mb-0 font-weight-bold"><?=$eventData['nick_user']?></h3>
          <p><b><?=$eventData['name_event']?></b> | <?=$eventData['location']?> | <span class="text-primario"><?=$dateEvent?></span></p>

          <h1 class="mt-2">Tú opinión es importante</h1>

         <h3 class="mb-0 font-weight-bold">¿Cómo fue tu experiencia con el show de <?=$eventData['nick_user']?></h3>

        </div>

      </div>
<!-- Form -->
    <form id="better-rating-form" action="" method="post">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center rating">
          <ul class="list-inline">
            <h2>
              <li class="list-inline-item"><i class="fa fa-star" data-rate="1"></i><i class="fa fa-star" data-rate="2"></i><i class="fa fa-star" data-rate="3"></i><i class="fa fa-star" data-rate="4"></i><i class="fa fa-star" data-rate="5"></i></li>
            </h2>
          </ul>

        </div>
        <input type="hidden" id="rating-count" name="rating" value="0">
        <span class="text-danger"><strong class="alert"><? if ( isset($rateNumberError)) { echo $rateNumberError;} ?></strong></span>
      </div>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <p class="font-weight-bold">Escribe tus comentarios sobre su presentación</p>
          <textarea name="rate_text" cols="40" rows="5" placeholder="Maximo 500 Caracteres." class="textarea-rate"><?if(isset($rateText)){ echo str_replace("\'","'",$rateText);  }?></textarea>
          <span class="text-danger"><strong class="alert"><? if ( isset($rateTextError)) { echo $rateTextError;} ?></strong></span>
        </div>
      </div>
      <!-- <div class="row justify-content-center">
        <div class="col-md-6 text-center">
          <h3 class="my-4 font-weight-bold">¿Que tan probable es que recomiendes Echomusic a tus amigos?</h3>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12 text-center">
          <ul class="list-inline">

            <li class="list-inline-item">
              <i class="far fa-sad-cry icon icon-malo"></i>
              <i class="far fa-sad-tear icon icon-triste"></i>
              <i class="far fa-sad-tear icon icon-triste"></i>
              <i class="far fa-meh icon icon-medio"></i>
              <i class="far fa-meh icon icon-medio"></i>
              <i class="far fa-smile-beam icon icon-bien"></i>
              <i class="far fa-smile-beam icon icon-bien"></i>
              <i class="far fa-grin-hearts icon icon-bueno"></i>
            </li>

          </ul>
        </div>
      </div> -->

      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
          <button type="submit" name="submit_button" class="btn btn-primary btn-block btn-lg my-4" >Enviar valoración</button>
        </div>
      </div>
    </form>

<? endif; ?>

    </div>



  </main>






    <!-- Scripts -->

      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

      <script src="assets/js/better-rating.js"></script>

      <? include 'resources/login_error_script.php'; ?>

      <? if($plsLogin==true): ?>
           <script>
             $(document).ready(function(){
               $('#loginModal').modal('show');
             });
           </script>
      <? endif; ?>

      <? if(isset($errTyp) && $errTyp =='danger'): ?>
        <script type='text/javascript'>alert('<?=$errMSG?>');</script>
      <? endif; ?>

<!-- Footer -->

  <? include 'resources/footer.php'; ?>

  <script>
    $('#better-rating-form').betterRating({
        wrapper:'#better-rating-list'
    });
  </script>


  </body>

</html>
