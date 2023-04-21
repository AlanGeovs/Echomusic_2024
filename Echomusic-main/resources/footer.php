<footer class="w-100 py-5 bg-grey text-white" id="footer">

	<div class="container">

	  <div class="row">

	    <div class="col-md-4 d-none d-sm-block first-block">

	      <img src="images/logo_brand_4.png" class="brandLogo">

				<p class="text-white text-left">Conectamos a músicos/as emergentes con audiencias y espacios de difusión mediante una suite de soluciones digitales</p>

	    </div>

	    <div class="col-md-4 d-none d-sm-block second-block justify-content-center text-center">

	      <ul class="list-group list-group-flush list-unstyled">

	        <li><a class="list-group-item" href="index.php">Inicio</a></li>

					<li><a class="list-group-item" href="about.php">¿Qué es EchoMusic?</a></li>

	        <li><a class="list-group-item" href="contacto_empresas.php">Asesoría Empresas</a></li>

	        <li><a class="list-group-item" href="#">Blog</a></li>

	      </ul>

	    </div>

	    <div class="col-md-4 d-none d-sm-block third-block text-center">

			<div class="row">

				<div class="vc_empty_space" style="height:50px;"><span class="vc_empty_space_inner"></span></div>

			</div>

	    	<p>contacto@echomusic.cl</p>

				<ul class="list-group list-group-horizontal justify-content-center">

				  <li class="list-group-item"><a href="https://www.facebook.com/EchoMusic-Chile-113583697083086/"><i class="fab fa-facebook"></i></a></li>

				  <li class="list-group-item"><a href="https://instagram.com/echomusic_cl?igshid=7irwqia5nu1g"><i class="fab fa-instagram"></i></a></li>

				  <li class="list-group-item"><a href="https://www.linkedin.com/company/echomusic-cl"><i class="fab fa-linkedin"></i></a></li>

				  <li class="list-group-item"><a href="https://www.youtube.com/channel/UCdNLF_qGuqamDoTT7ui2hrg"><i class="fab fa-youtube"></i></a></li>

				</ul>

	    </div>

	  </div>

  </div>
  <div class="container">
      <div class="col-md-6 text-leftcenter">
        <img src="images/logo-3ie.png" class="" style="width:150px;">
        <img src="images/logo-corfo.png" class="" style="width: 220px;">
      </div>
    </div>
  </div>
  	<div class="wt-80">
		<hr class="d-none d-sm-block">

		<div class="row">

				<div class="col-md-12 text-center"><strong>EchoMusic</strong> - Todos los Derechos Reservados 2021.</div>

		</div>

	</div>

</footer>


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
