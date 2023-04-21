<?php
session_set_cookie_params(3600,"/");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
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

		<title>EchoMusic | Crear evento</title>

		<meta charset="utf-8" />

		<meta name="keywords" content="echomusic, musica, cartelera, artistas, digital, eventos, en linea, Streaming, noticias, blog, conciertos, playlist, Frank's White Canvas" />

    <meta name="og:image" content="https://qa.echomusic.cl/images/logo_brand_3.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="og:title" content="Crea tu Evento EchoMusic.cl - La música nos conecta" />
    <meta name="description" content="Crea tu evento EchoMusic streaming o presencial y monetiza tu talento." />

		<? include 'resources/googleLoginMeta.html'; ?>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


		<link rel="stylesheet" href="assets/css/custom.css?ver=1.2">

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



		<div class="" id="">

          <div class="div-echomusic" style="text-align: center;">


          	<p>
          		<span class="font-weight-bold h1">Crea tu evento EchoMusic</span><br/>
          		<span class="h5">Puedes hacerlo de manera presencial o vía streaming</span><br/>
          		<a class="btn btn-outline-primary btn-lg" href="presencial2.php" role="button">Crea tu evento<br>PRESENCIAL</a>
          		<a class="btn btn-outline-primary btn-lg text-white col-lg-2 col-md-6 col-6 my-2" href="stream1.php" role="button">Crea tu evento<br>STREAMING</a>

          		<!-- <a class="btn btn-outline-primary btn-lg isDisabled" href="cuidemonos/index.php" role="button">Crear tu Evento<br>PRESENCIAL</a> -->
          	</p>


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

			<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->

			<? include 'resources/login_error_script.php'; ?>
			<script type="text/javascript">
	$(document).ready(function() {

  function toggleSidebar() {
    $(".button-sidebar").toggleClass("active");
    $("main").toggleClass("move-to-left");
    $(".sidebar-item").toggleClass("active");
    /*$("#sidebarRight").css("right", "70%");*/
  }

  $(".button-sidebar").on("click tap", function() {
    toggleSidebar();
  });


});

	(function($) {

  /*
  	Responsive Flat Menu
  	http://cssmenumaker.com/menu/responsive-flat-menu
  */

  $.fn.menumaker = function(options) {

    var cssmenu = $(this),
      settings = $.extend({
        title: "Artista",
        format: "dropdown",
        sticky: false
      }, options);

    return this.each(function() {
      cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
      $(this).find("#menu-button").on('click', function() {
        $(this).toggleClass('menu-opened');
        var mainmenu = $(this).next('ul');
        if (mainmenu.hasClass('open')) {
          mainmenu.hide().removeClass('open');
        } else {
          mainmenu.show().addClass('open');
          if (settings.format === "dropdown") {
            mainmenu.find('ul').show();
          }
        }
      });

      cssmenu.find('li ul').parent().addClass('has-sub');

      multiTg = function() {
        cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
        cssmenu.find('.submenu-button').on('click', function() {

          $(this).toggleClass('submenu-opened');
          if ($(this).siblings('ul').hasClass('open')) {

            $(this).siblings('ul').removeClass('open').hide();
          } else {
            $(this).siblings('ul').addClass('open').show();
          }
        });
        cssmenu.find('.submenu-menu').on('click', function() {


          $(this).toggleClass('submenu-opened');
          if ($(this).siblings('ul').hasClass('open')) {
            $(this).siblings('ul').removeClass('open').hide();
          } else {
            $(this).siblings('ul').addClass('open').show();
          }
        });
      };

      if (settings.format === 'multitoggle') multiTg();
      else cssmenu.addClass('dropdown');

      if (settings.sticky === true) cssmenu.css('position', 'fixed');

      resizeFix = function() {
        if ($(window).width() > 768) {
          cssmenu.find('ul').show();
        }

        if ($(window).width() <= 768) {
          cssmenu.find('ul').hide().removeClass('open');
        }
      };
      resizeFix();
      return $(window).on('resize', resizeFix);

    });
  };
})(jQuery);

/*
	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License
*/

;
(function($, window, document, undefined) {
  $.fn.doubleTapToGo = function(params) {
    if (!('ontouchstart' in window) &&
      !navigator.msMaxTouchPoints &&
      !navigator.userAgent.toLowerCase().match(/windows phone os 7/i)) return false;

    this.each(function() {
      var curItem = false;

      $(this).on('click', function(e) {

        var item = $(this);
        if (item[0] != curItem[0]) {
          e.preventDefault();
          curItem = item;
        }
      });

      $(document).on('click touchstart MSPointerDown', function(e) {

        var resetItem = true,
          parents = $(e.target).parents();

        for (var i = 0; i < parents.length; i++)
          if (parents[i] == curItem[0]){
            resetItem = false;
			}
        if (resetItem)
          curItem = false;
      });
    });
    return this;
  };
})(jQuery, window, document);

/**
 * doubleTapToGoDecorator
 * Adds the ability to remove the need for a second tap
 * when in the mobile view
 *
 * @param {function} f - doubleTapToGo
 */
function doubleTapToGoDecorator(f) {
  return function() {

    this.each(function() {
      $(this).on('click', function(e) {

        // If mobile menu view
        if ($('#menu-button').css('display') == 'block') {


          // If this is not a submenu button
          if (!$(e.target).hasClass('submenu-button')) {

            // Remove the need for a second tap
            window.location.href = $(e.target).attr('href');
          }
        }

      });
    });

    return f.apply(this);
  }
}

// Add decorator to the doubleTapToGo plugin
jQuery.fn.doubleTapToGo = doubleTapToGoDecorator(jQuery.fn.doubleTapToGo);

/**
 * jQuery
 */
(function($) {
  $(document).ready(function() {

    $("#cssmenu").menumaker({
      title: "Artista",
      format: "multitoggle"
    });

    $('#cssmenu li:has(ul)').doubleTapToGo();

  });
})(jQuery);

$('#selectBuscador').each(function(){
    var $this = $(this), numberOfOptions = $(this).children('option').length;

    $this.addClass('select-hidden');
    $this.wrap('<div class="select "></div>');
    $this.after('<div class="select-styled"></div>');

    var $styledSelect = $this.next('div.select-styled');
    $styledSelect.text($this.children('option').eq(0).text());

    var $list = $('<ul />', {
        'class': 'select-options'
    }).insertAfter($styledSelect);

    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }

    var $listItems = $list.children('li');

    $styledSelect.click(function(e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function(){
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
    });

    $listItems.click(function(e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
        //console.log($this.val());
    });

    $(document).click(function() {
        $styledSelect.removeClass('active');
        $list.hide();
    });

});
</script>

<? include 'resources/googleLoginScript.php'; ?>

	</body>

</html>
