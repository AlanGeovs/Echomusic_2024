<?php include 'modalRagistro.php'; ?>
<!-- Footer Area -->
<footer class="footer-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="content">
                    <div class="logo text-center align-items-center" style='vertical-align: middle;'>
                        <!--<a href="index.html"><img src="assets/images/logo/echimusic-isotipo-blanco-min.png" alt="" width="90px"/></a>-->
                        <img src="assets/images/Corfo-proyectoapoyadopor-gob-chile-min.png" alt="" width="300px" /> &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="assets/images/logo/3ie-logo-blanco.png" alt="" width="110px" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="content">
                    <h3>Servicios</h3>
                    <ul class="footer-list">
                        <li><a href="cartelera.php">Ticketing</a></li>
                        <li><a href="buscar_crowdfunding.php">Crowdfunding</a></li>
                        <li><a href="buscar_artista.php">Marketplace de artistas</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="content contacts">
                    <h3 class="ml-40">Contacto</h3>
                    <ul class="footer-list foot-social">
                        <li><a href="tel:56958049159"><i class="bx bx-mobile-alt"></i>+ 56 9 58049159</a></li>
                        <li><a href="mailto:contacto@echomusic.cl"><i class="bx bxs-envelope"></i> contacto@echomusic.cl</a></li>
                        <li><i class="bx bxs-map"></i> Av. Del Valle Norte 937, oficina 253, Huechuraba, Santiago, RM.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="content">
                    <div class="subscribe text-center ">
                        <h4>Suscríbete a nuestro Newsletter</h4>
                        <form class="newsletter-form" data-toggle="validator">
                            <input type="email" id="emails" class="form-control" placeholder="Tu Email" name="EMAIL" required autocomplete="off">

                            <button class="box-btn" type="submit">
                                Subscribirme
                            </button>

                            <div id="validator-newsletter" class="form-result"></div>
                        </form>
                    </div>

                    <ul class="social text-center">
                        <li>
                            <a href="https://www.facebook.com/EchoMusic-Chile-113583697083086/" target="_blank"><i class='bx bxl-facebook'></i></a>
                        </li>
                        <li>
                            <a href="https://instagram.com/echomusic_cl" target="_blank"><i class='bx bxl-instagram'></i></a>
                        </li>
                        <li>
                            <a href="https://www.tiktok.com/@echomusic_cl" target="_blank"><i class='bx bxl-tiktok'></i></a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/company/echomusic-cl" target="_blank"><i class='bx bxl-linkedin'></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
            </div>
        </div>
    </div>
    <div class="copy-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="menu">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="nosotros.php">Nosotros</a></li>
                        <li><a href="faqs.php">FAQ's</a></li>
                        <li><a href="politica-de-privacidad.php">Política de Privacidad</a></li>
                        <li><a href="terminos-y-condiciones.php">Términos y Condiciones</a></li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <p class="right">
                        Copyright @2024 EchoMusic | By
                        <a href="https://www.genesysapp.com/" target="_blank">GenesysApp.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>



</footer>
<!-- End Footer Area -->

<!-- Start Go Top Area -->
<div class="go-top">
    <i class='bx bx-chevrons-up'></i>
    <i class='bx bx-chevrons-up'></i>
</div>
<!-- End Go Top Area -->

<!-- reCaptcha -->
<button class="g-recaptcha" data-sitekey="6LdRjVQpAAAAALErmJXGFDCcXgyHUq9V22XxaeHH" data-callback='onSubmit' data-action='submit'></button>

<!-- reCaptcha -->
<script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
</script>

<!--Script Tarjetas carrusel-->



<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script>
    $('.carousel .carousel-item').each(function() {
        var minPerSlide = 4;
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i = 0; i < minPerSlide; i++) {
            next = next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
        }
    });
</script>

<!-- jQuery Min JS -->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap Bundle Min JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- MeanMenu Min JS -->
<script src="assets/js/meanmenu.min.js"></script>
<!-- Magnific Popup Min JS -->
<script src="assets/js/magnific-popup.min.js"></script>

<!-- Wow Min js -->
<script src="assets/js/wow.min.js"></script>
<!-- Isotope MinJs -->
<script src="assets/js/isotope.pkgd.min.js"></script>
<!-- Form Ajaxchimp Min JS -->
<script src="assets/js/ajaxchimp.min.js"></script>
<!-- Form Validator Js  -->
<script src="assets/js/form-validator.min.js"></script>
<!-- Contact Form Min Js -->
<script src="assets/js/contact-form-script.js"></script>
<!-- Main js -->
<script src="assets/js/main.js"></script>

<!-- Bootstrap Bundle JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- Owl carasol Min Js -->
<script src="assets/js/owl.carousel.min.js"></script>
<!--Script para OWL  
        Ver demos: https://owlcarousel2.github.io/OwlCarousel2/demos/demos.html
        -->
<script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        loop: true,
        nav: true,
        margin: 10,
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
                //                            nav:false
            },
            600: {
                items: 2,
                //                            nav:false
            },
            1000: {
                items: 3,
                //                            nav:false 
            }
        }
    });
    $('.play').on('click', function() {
        owl.trigger('play.owl.autoplay', [1000]);
    })
    $('.stop').on('click', function() {
        owl.trigger('stop.owl.autoplay');
    })
</script>

<!-- Limpiar / Resetea los campos del buscador de artistas -->
<script>
    function limpiarFormulario() {
        document.getElementById('r').value = '';
        document.getElementById('gen').selectedIndex = 0;
        document.getElementById('tip').selectedIndex = 0;
        document.getElementById('reg').selectedIndex = 0;
        // Resto de tu lógica de limpieza...
    }
</script>


<!-- Script para ver contraseña escrita Agrega este script para alternar entre mostrar y ocultar la contraseña: -->
<script>
    // valida solo un campo de contraseña 'password'
    // document.getElementById('togglePassword').addEventListener('click', function(e) {
    //     const password = document.getElementById('password');
    //     const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    //     password.setAttribute('type', type);

    //     // Cambiar el ícono si estás utilizando uno
    //     this.classList.toggle('icon-eye');
    //     this.classList.toggle('icon-eye-off');
    // });
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar clic en el ícono de mostrar/ocultar para la contraseña
        document.getElementById('togglePassword').addEventListener('click', function() {
            togglePasswordVisibility('password', this);
        });

        // Manejar clic en el ícono de mostrar/ocultar para la confirmación de contraseña
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            togglePasswordVisibility('confirm_password', this);
        });

        function togglePasswordVisibility(passwordFieldId, iconElement) {
            const passwordInput = document.getElementById(passwordFieldId);
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Cambiar el ícono
            iconElement.classList.toggle('icon-eye');
            iconElement.classList.toggle('icon-eye-off');
        }
    });
</script>




<!-- Registro de Usuarios -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('formRegistroUsuario').addEventListener('submit', function(e) {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            // Validación para que las contraseñas sean las mismas 
            if (password !== confirmPassword) {
                e.preventDefault(); // Evita que se envíe el formulario
                swal("Error", "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.", "error");
            } else {
                e.preventDefault();

                var formData = new FormData(this);

                fetch('dashboard/includes/registrarUsuario_db.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("Registro exitoso", data.message, "success")
                                .then((value) => {
                                    window.location.href = 'ingresar.php'; // Redirigir al usuario
                                });
                        } else {
                            swal("Error", data.message, "error");
                        }
                    })
                    .catch(error => {
                        swal("Error", "Error al procesar la solicitud: " + error, "error");
                    });
            }


        });
    });
</script>

<!-- Pginación artistas -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Función para generar los enlaces de paginación
        function generarPaginador(totalPaginas, paginaActual) {
            const ulPaginador = document.getElementById('pagination');
            ulPaginador.innerHTML = ''; // Limpiar contenido anterior

            // Botón de página anterior
            const liPrev = document.createElement('li');
            liPrev.className = 'page-item ' + (paginaActual === 1 ? 'disabled' : '');
            liPrev.innerHTML = `<a class="page-link" href="#" data-page="${paginaActual - 1}">Previous</a>`;
            ulPaginador.appendChild(liPrev);

            // Enlaces de páginas
            for (let i = 1; i <= totalPaginas; i++) {
                const liPage = document.createElement('li');
                liPage.className = 'page-item ' + (i === paginaActual ? 'active' : '');
                liPage.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
                ulPaginador.appendChild(liPage);
            }

            // Botón de página siguiente
            const liNext = document.createElement('li');
            liNext.className = 'page-item ' + (paginaActual === totalPaginas ? 'disabled' : '');
            liNext.innerHTML = `<a class="page-link" href="#" data-page="${paginaActual + 1}">Next</a>`;
            ulPaginador.appendChild(liNext);
        }

        // Función para cargar artistas
        function cargarArtistas(pagina) {
            // Aquí debes implementar la lógica para cargar los artistas
            // Por ejemplo, haciendo una solicitud AJAX a tu servidor
            console.log('Cargando artistas para la página:', pagina);
            // Ejemplo para generar el paginador
            generarPaginador(10, pagina); // 10 es el total de páginas (debes calcularlo)
        }

        // Manejar clic en los enlaces del paginador
        document.getElementById('pagination').addEventListener('click', function(e) {
            e.preventDefault();
            if (e.target.tagName === 'A' && !e.target.parentNode.classList.contains('disabled')) {
                const paginaSeleccionada = parseInt(e.target.getAttribute('data-page'));
                cargarArtistas(paginaSeleccionada);
            }
        });

        // Cargar artistas para la página inicial
        cargarArtistas(1); // Cargar la primera página al inicio
    });
</script>

<?php include "scripts.php"; ?>




<!--        
        <script>             
            var owl = $('.owl-carousel-artistas');
                owl.owlCarousel({
                    loop:true,
                    nav:true,
                    margin:10,
                    responsiveClass:true,
                    autoplay:true,
                    autoplayTimeout:2500,
                    autoplayHoverPause:true,
                    responsive:{
                        0:{
                            items:3,
                            nav:false
                        },
                        600:{
                            items:3,
                            nav:false
                        },
                        1000:{
                            items:3,
                            nav:false 
                        }
                }
            });
            $('.play').on('click',function(){
                owl.trigger('play.owl.autoplay',[1000])
            })
            $('.stop').on('click',function(){
                owl.trigger('stop.owl.autoplay')
            })
        </script>        -->
</body>

</html>