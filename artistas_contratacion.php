<?php
include "model/models.php";
include "header.php";
// include "dashboard/model/model.php";

//Búsquedas de Eventos
if (isset($_GET["a"])) {
    $id = $_GET["a"];
    if (!preg_match('/[0-9]/', $id)) {
        exit();
    }
    $respuesta = Consultas::detallesArtistas($id);
}
$id_name_plan = $_GET["id_name_plan"];

$biografia = Consultas::bioArtistas($id);
$presskit  = Consultas::bioPresskit($id);
$descripcion = Consultas::descArtistas($id);

//Eventos                    
$resultadosProxEventos = Consultas::eventosPorArtista($respuesta[0]["id_user"]);
$resultadosEventosPasa = Consultas::eventosPasadosArtista($respuesta[0]["id_user"]);

?>

<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Contratación de Artistas</h2>
            <ul>
                <li> <a href="index.php"> Inicio </a> </li>
                <!-- <li> <a href="buscar_artista.php"> Artistas </a> </li> -->
                <li><a href="#" onclick="onBackClick(); return false;">Artistas</a></li>
                <li class="active"><?php echo $respuesta[0]["nick_user"]; ?></li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Detalle de Perfil de Artista  -->
<section class="feature-area bg-color ptb-35">
    <div class="container">
        <div class="row align-items-center choose-c justify-content-md-center ">
            <!--Perfil-->
            <div class="col-lg-7 col-sm-7 d-flex align-items-center">
                <div class="row w-100">
                    <div class="col-lg-4 col-sm-4 text-center d-flex flex-column justify-content-center">
                        <a href="#">
                            <img class="responsiveArtista" src="https://echomusic.cl/images/avatars/<?php echo $respuesta[0]["id_user"]; ?>.jpg" alt="destacado" />
                        </a>
                    </div>
                    <div class="col-lg-8 col-sm-8 feature-tittle d-flex align-items-center justify-content-center">
                        <div>
                            <h2> <?php echo $respuesta[0]["nick_user"]; ?></h2>
                            <?php
                            $respuestaCiudadRegion = Consultas::buscaCiudadRegion($respuesta[0]["id_city"], $respuesta[0]["id_region"]);
                            $respuestaMusician = Consultas::buscaTipoArtista($respuesta[0]["id_musician"]);
                            $respuestaBuscaGenero = Consultas::buscarGenero($respuesta[0]["id_user"]);

                            echo "<span class='flaticon-award'></span> " . $respuestaCiudadRegion[0]["name_region"] . " / " . $respuestaCiudadRegion[0]["name_city"];
                            echo "  <span class='flaticon-award'></span> " . $respuestaMusician[0]["name_musician"];
                            echo "  <span class='flaticon-award'></span> " . $respuestaBuscaGenero["name_genre"];
                            ?>
                        </div>
                    </div>
                </div>
            </div>


            <!--Detalles de tarifa-->
            <?php
            $tarifasArtista = Consultas::tarifasPorId($respuesta[0]["id_user"], $id_name_plan);
            ?>
            <div class=" col-lg-5 text-center">

                <div class="row justify-content-md-center">
                    <div class="col-lg-8 col-md-8">
                        <a type="button" class="text-center" onclick='cambiarPlan("<?php echo $respuesta[0]["id_user"]; ?>"); return false;'>
                            <icon class="icon-return"></icon>Cambiar plan
                        </a>

                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="single-blog">

                            <div class="pricing-top-heading">
                                <h3>Tarifa <?php echo $t + 1; ?></h3>
                                <p><?php echo $tarifasArtista[0]["desc_plan"]; ?></p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li> Duración <?php echo $tarifasArtista[0]["duration_minutes"]; ?> minutos.</li>
                                        <li> Backline <?php echo $tarifasArtista[0]["backline"]; ?></li>
                                        <li> Ingeniero de Sonido <?php echo $tarifasArtista[0]["sound_engineer"]; ?></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li> Refuerzo Sonoro <?php echo $tarifasArtista[0]["sound_reinforcement"]; ?></li>
                                        <li> Sonidista <?php echo $tarifasArtista[0]["sound_reinforcement"]; ?></li>
                                        <li> Nº de Músicos <?php echo $tarifasArtista[0]["artists_amount"]; ?></li>
                                    </ul>
                                </div>
                                <div class="col.md-12">
                                    <h2>$<?php echo number_format($tarifasArtista[0]["value_plan"], 0, ",", "."); ?></h2>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <button type="button" class="box-btn  btn-sm text-center" onclick="onBackClick(); return false;">Cambiar plan</button>
                    </div>



                </div>
            </div>
        </div>
    </div>
</section>




<!-- FORMULARIO -->

<section class="comprar-area ptb-35">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="comprar-form">
                    <div class="section-tittle text-center">
                        <p>LLena los siguientes datos para contratar el servicio</p>
                    </div>

                    <form id="contratarTarifa" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="id_plan" name="id_plan" value="<?php echo $tarifasArtista[0]["id_plan"]; ?>">
                        <input type="hidden" id="value_plan_event" name="value_plan_event" value="<?php echo $tarifasArtista[0]["value_plan"]; ?>">
                        <input type="hidden" id="id_name_plan" name="id_name_plan" value="<?php echo $id_name_plan; ?>">
                        <!-- Evento -->
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="evento">Evento</label>
                                    <input type="text" class="form-control" id="name_event" name="name_event" placeholder="Nombre del Evento" required>
                                </div>
                            </div>
                        </div>

                        <!-- Dirección, Región, Ciudad -->
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Dirección" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="id_region">Región</label>
                                    <select class="form-control" id="id_region" name="id_region" required>
                                        <option>Selecciona una región</option>
                                        <?php
                                        $res = Consultas::listarVariable('regions');
                                        // var_dump($res);
                                        for ($i = 0; $i < count($res); $i++) {
                                            echo "<option value='" . $res[$i]["id_region"] . "' id='" . $res[$i]["id_region"] . "' >" . $res[$i]["name_region"] . "</option>";
                                        }
                                        ?>

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="id_city">Ciudad</label>
                                    <select class="form-control" id="id_city" name="id_city" required>
                                        <option>Selecciona una ciudad</option>
                                        <?php
                                        $res = Consultas::listarVariable('cities');
                                        //var_dump($respuesta);
                                        for ($i = 0; $i < count($res); $i++) {
                                            echo "<option value='" . $res[$i]["id_city"] . "' id='" . $res[$i]["id_city"] . "' >" . $res[$i]["name_city"] . "</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Fecha y Hora, Teléfono -->
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-">
                                <div class="form-group">
                                    <label for="date_event">Fecha y Hora</label>
                                    <input type="datetime-local" class="form-control" id="date_event" name="date_event" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-">
                                <div class="form-group">
                                    <label for="phone_event">Teléfono</label>
                                    <input type="phone" class="form-control" id="phone_event" name="phone_event" placeholder="Teléfono de contacto" required>
                                </div>
                            </div>
                        </div>



                        <!-- Escribe tu solicitud -->
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="solicitud">Escribe tu solicitud</label>
                                    <textarea class="form-control" id="desc_event" name="desc_event" rows="5" placeholder="Detalles de tu solicitud..." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="privecy-txt">
                                <p><small>Para obtener más información acerca de cómo EchoMusic recopila, utiliza, comparte y protege tus datos personales, consulta la
                                        <a href="politica-de-privacidad.php" target="_blank">Política de Privacidad</a> de EchoMusic.</small> </p>
                            </div>
                        </div>

                        <!-- Botón de enviar -->
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="box-btn  btn-sm text-center comprar-btn" onclick="enviarContratacionTarifa();">Enviar Solicitud</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8">

        </div>
    </div>
</div>




<!-- End Videos -->




















<!-- CTA 2 unete -->
<section class="home-cta-2-morado pt-100 pb-35">
    <div class="container">


        <div class="row">
            <div class="col-lg-2 col-sm-2"></div>

            <div class="col-lg-5 col-sm-5">
                <div class="section-title">
                    <h2 style="color: white;">¿Eres artista?<br> Rentabiliza tu talento</h2>
                </div>
            </div>

            <div class="col-lg-3 col-sm-3" style="vertical-align: middle; ">
                <div class="text-center">
                    <div class="nav-btn">
                        <br>
                        <a href="#" class="box-btn text-center">Crea tu perfíl</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2"></div>
        </div>
    </div>
</section>
<!-- End CTA 2 unete-->



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
                    <!-- <div class="subscribe">
                                <h4>Suscríbete a nuestro Newsletter</h4>
                                <form class="newsletter-form" data-toggle="validator">
                                    <input type="email" id="emails" class="form-control" placeholder="Your Email" name="EMAIL" required autocomplete="off">

                                    <button class="box-btn" type="submit">
                                        Subscribirme
                                    </button>

                                    <div id="validator-newsletter" class="form-result"></div>
                                </form>
                            </div>-->

                    <!--                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook' ></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter' ></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram' ></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest' ></i></a>
                                </li>
                            </ul>-->
                </div>
            </div>
            <!--                    <div class="col-lg-3 col-md-6">
                        <div class="content ml-15">
                            <h3>Servicios</h3>
                            <ul class="footer-list">
                                <li><a href="#">Perfil de Artistas</a></li>
                                <li><a href="cartelera.php">Ticketing</a></li>
                                <li><a href="buscar_crowdfunding.php">Crowdfunding</a></li>
                                <li><a href="buscar_artista.php">Marketplace de artistas</a></li> 
                            </ul>
                        </div>
                    </div>-->
            <div class="col-lg-3 col-md-6">
                <div class="content">

                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Open modal
                    </button>



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
                            <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                        </li>
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                        </li>
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                        </li>
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-pinterest'></i></a>
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
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Nosotros</a></li>
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Política de Privacidad</a></li>
                        <li><a href="#">Términos y Condiciones</a></li>
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




<!--Modal area-->
<?php
include 'modal.php';
?>

<!-- Start Go Top Area -->
<div class="go-top">
    <i class='bx bx-chevrons-up'></i>
    <i class='bx bx-chevrons-up'></i>
</div>
<!-- End Go Top Area -->


<!-- Para Video -->
<!-- Javascript -->
<script src="video/assets/js/jquery-3.3.1.min.js"></script>
<script src="video/assets/js/jquery-migrate-3.0.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="video/assets/js/jquery.backstretch.min.js"></script>
<script src="video/assets/js/wow.min.js"></script>
<script src="video/assets/js/waypoints.min.js"></script>
<script src="video/assets/js/scripts.js"></script>
<!-- Fin VIDEO  -->

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



<!-- Owl carasol Min Js -->
<script src="assets/js/owl.carousel.min.js"></script>
<!--Script para OWL  
        Ver demos: https://owlcarousel2.github.io/OwlCarousel2/demos/demos.html
        -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            items: 1,
            merge: true,
            loop: true,
            margin: 10,
            video: true,
            videoWidth: true, // Default false; Type: Boolean/Number
            videoHeight: true, // Default false; Type: Boolean/Number
            lazyLoad: true,
            center: true,
            responsive: {
                480: {
                    items: 2
                },
                600: {
                    items: 3
                }
            }
        });
        $('.owl-carousel-video').owlCarousel({
            items: 1,
            merge: true,
            loop: true,
            margin: 10,
            video: true,
            lazyLoad: true,
            center: true,
            responsive: {
                480: {
                    items: 2
                },
                600: {
                    items: 4
                }
            }
        });
    });
</script>


<!--        
        <script>             
            var owl = $('.owl-carousel-artistas');
                owl.owlCarousel({
                    loop:true,
                    margin:10,
                    responsiveClass:true,
                    autoplay:true,
                    autoplayTimeout:2500,
                    autoplayHoverPause:true,
                    responsive:{
                        0:{
                            items:2,
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
                owl.trigger('play.owl.autoplay',[1000]);
            })
            $('.stop').on('click',function(){
                owl.trigger('stop.owl.autoplay');
            })
        </script>          
               -->


<!-- Script para enviar email de Tarifa a convenir -->
<script>
    function enviarFormulario() {
        var formData = new FormData();
        formData.append('nombreArtista', document.getElementById('nombre-artista').value);
        formData.append('asunto', document.getElementById('asunto').value);
        formData.append('descripcion', document.getElementById('descripcion').value);

        fetch('includes/enviar_email_tarifaAConvenir.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#contratarArtistaModal').modal('hide'); // Cierra el modal antes de mostrar la alerta
                    // Mensaje de éxito usando SweetAlert
                    swal("¡Éxito!", "Mensaje enviado con éxito.", "success");
                } else {
                    // Mensaje de error usando SweetAlert
                    swal("Error", "Error al enviar el mensaje.", "error");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Mensaje de error usando SweetAlert
                swal("Error", "Error al procesar la solicitud: " + error, "error");
            });
    }
</script>

<!-- Script migas de pan -->
<script>
    function onBackClick() {
        window.history.back();
    }
</script>


<!-- Cambio de Región y Ciudad -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_region').on('change', function() {
            var id_region = $(this).val();
            cargarCiudades(id_region);
        });

        // Cargar ciudades al abrir el modal
        $('#editDatos').on('show.bs.modal', function() {
            var id_region = $('#id_region').val();
            if (id_region) {
                cargarCiudades(id_region);
            }
        });
    });

    function cargarCiudades(id_region) {
        $.ajax({
            url: 'dashboard/includes/obtener_regiones_ciudades.php',
            type: 'POST',
            data: {
                id_region: id_region
            },
            dataType: 'json',
            success: function(ciudades) {
                var opciones = '<option value="">Seleccione una ciudad</option>';
                $.each(ciudades, function(index, ciudad) {
                    var selected = (ciudad.name_city == "<?php echo $busca_Ciudad["name_city"]; ?>") ? ' selected' : '';
                    opciones += '<option value="' + ciudad.id_city + '"' + selected + '>' + ciudad.name_city + '</option>';
                });
                $('#id_city').html(opciones);
            },
            error: function() {
                alert('Error al cargar las ciudades');
            }
        });
    }
</script>

<!-- Redirecciona a Tarifas -->
<script>
    function cambiarPlan(idUser) {
        // Construye la URL con el id_user y el ancla #tarifas
        var url = "artistas.php?a=" + idUser + "#tarifas";
        // Redirige a la URL
        window.location.href = url;
    }
</script>

<!-- Contratar Tarifa -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('contratarTarifa').addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            fetch('includes/contratarTarifa.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        swal("Solicitud enviada", data.message, "success")
                            .then((value) => {
                                //redireccionar
                                //window.location.href =
                                //   'listar_clientes.php'; // Redirigir al usuario

                                //limpiar form
                                document.getElementById('contratarTarifa').reset();
                            });
                    } else {
                        swal("Error", data.message, "error");
                    }
                })
                .catch(error => {
                    swal("Error", "Error al procesar la solicitud: " + error, "error");
                });
        });
    });
</script>






</body>

</html>