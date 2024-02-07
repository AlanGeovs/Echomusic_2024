<?php
include "model/models.php";
include "header.php";

//Búsquedas de Crowdfunding
if (isset($_GET["c"])) {
    $id = $_GET["c"];
    $idTier = $_GET['t'];
    if (!preg_match('/[0-9]/', $id)) {
        exit();
    }
    $respuesta = Consultas::detallesCrowdfunding($id);
}

$idUser = $respuesta[0]['id_user'];

$biografia = Consultas::bioArtistas($idUser);

//    BUscar nombre Ciudad Region
$respuestaCiudadRegion = Consultas::buscaCiudadRegion($respuesta[0]["id_city"], $respuesta[0]["id_region"]);

//Fecha
$fechaEntera = strtotime($respuesta[0]["project_date_end"]);
$anio = date("Y", $fechaEntera);
$mes = date("M", $fechaEntera);
$dia = date("d", $fechaEntera);
$diaSemana = date("D", $fechaEntera);

$hora = date("H", $fechaEntera);
$minutos = date("i", $fechaEntera);

//**************************

$respuestaCrowdfunding = Consultas::crowdfunding($respuesta[0]["id_user"]);
$respuestaMultimediaCrow = Consultas::multimaediaCrowdfunding($respuesta[0]['id_project']);
$respuestaTierCrow = Consultas::tierCrowdfundingIDtier($idTier);

$totalARecaudar = $respuestaCrowdfunding[0]["project_amount"];
//  Extrae la suma de lo recaudado
//        $sumaRecaudado = array_sum ( Consultas::recaudadoCrowdfunding( $respuestaCrowdfunding[0]["id_project"]) );
$sumaRecaudado = Consultas::recaudadoCrowdfunding($respuestaCrowdfunding[0]["id_project"]);
$recaudadoPorcentaje = Consultas::obtenerPorcentaje($sumaRecaudado[0], $totalARecaudar);
//Diferencia de dias
$fechaNueva = $anio . "-" . $mes . "-" . $dia;
$date1 = new DateTime("$fechaNueva");
$date2 = new DateTime("now");
$diff = $date1->diff($date2);


?>

<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2><?php echo $respuesta[0]["nick_user"]; ?></h2>
            <ul>
                <li> <a href="index.php"> Inicio </a> </li>
                <li> <a href="pago_crowdfunding.php"> Portal de Pago </a> </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Detalle de Perfil de Artista  -->
<section class="feature-area bg-color ptb-35">
    <div class="container">
        <div class="row  ">
            <!--Bloque izquierdo-->
            <div class="col-lg-6 col-sm-6    ">
                <div class="single-case text-center">
                    <div class="simple-evento-artista">
                        <div class="row">
                            <div class="col-6 col-sm-4">
                                <a href="artistas.php?a=<?php echo $respuesta[0]['id_user']; ?>">
                                    <img style="height: 100px; width: 100px; border-radius: 50%;" class="responsiveArtista" src="https://echomusic.cl/images/avatars/<?php echo $respuesta[0]['id_user']; ?>.jpg" alt="descatado" />
                                </a>
                                <p>Comparte:</p>
                                <span style="text-align: right;">
                                    <ul class="social">
                                        <li> <a href="#" target="_blank"><i class='bx bxl-whatsapp'></i></a></li>
                                        <li> <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                                        <li> <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a> </li>
                                    </ul>


                                </span>

                            </div>
                            <div class="col-6 col-sm-8">
                                <h3>Portal de Pago</h3>
                                <i class="flaticon-calendar"></i> &nbsp; <b>Plazo de ejecución</b> <?php echo $diaSemana . ' ' . $dia . ' de ' . $mes . ', ' . $anio; ?>
                                <ul>
                                    <li>
                                        <?php echo $respuesta[0]['project_title']; ?>
                                    </li>
                                </ul>
                                <a href="artistas.php?a=<?php echo $respuesta[0]['id_user']; ?>">
                                    <h3><?php echo $respuesta[0]['nick_user']; ?></h3>
                                </a>


                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: <?php echo $recaudadoPorcentaje; ?>%" aria-valuenow="" aria-valuemin="<?php echo $sumaRecaudado[0]; ?>" aria-valuemax="<?php echo $totalARecaudar; ?>"></div>

                                </div>
                                <p style="font-size: 11px;">$<?php echo number_format($sumaRecaudado[0]) . " de $" . number_format($totalARecaudar) . " del total recaudado."; ?></p>
                                <div class="text-center">

                                    <a href="#recompensas" class="btn btn-outline-success btn-lg position-relative">
                                        Patrocinar
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            <?php echo $diff->days; ?> días restantes
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </a>

                                </div>


                            </div>
                        </div>

                    </div>

                    <div class="feature-tittle">


                    </div>
                </div>
            </div>


            <!--Bloque derecho-->
            <div class="col-lg-6 col-sm-6 ">
                <div class="home-2-contact col-lg-12">
                    <div class="content">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h2>$ <?php echo number_format($respuestaTierCrow[0]['tier_amount'], 0, '', '.'); ?></h2>
                                <h3><?php echo $respuestaTierCrow[0]['tier_title']; ?></h3>

                                <p> <?php echo $respuestaTierCrow[0]['tier_desc']; ?></p>
                            </div>
                            <div class="col-12 col-sm-6">
                                <p><b>Incluye:</b></p>
                                <ul>
                                    <li> <i class="bx bx-gift"></i> <?php echo $respuestaTierCrow[0]['t_reward_01']; ?> </li>
                                    <li> <i class="bx bx-gift"></i> <?php echo $respuestaTierCrow[0]['t_reward_02']; ?> </li>
                                    <li> <i class="bx bx-gift"></i> <?php echo $respuestaTierCrow[0]['t_reward_03']; ?> </li>
                                    <!--<li> <i class="bx bx-gift"></i> <?php echo $respuestaTierCrow[$i]['t_reward_04']; ?> </li>-->
                                </ul>
                            </div>
                        </div>

                        <hr>
                        <h5 class="text-center">Pago</h5>
                        <div class="row">
                            <p>¡Estás a un paso de realizar un aporte importantísimo para el desarrollo musical de <b><?php echo $respuesta[0]["nick_user"]; ?></b></p>
                            <form id="form2" name="form2" method="GET" action="">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="form-group">
                                            <label for="ap">Aporte</label>
                                            <input type="text" class="form-control" id="ap" name="ap" placeholder="$ <?php echo number_format($respuestaTierCrow[0]['tier_amount'], 0, '', '.'); ?>" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="form-group">
                                            <label for="ad">Aporte adicional</label>
                                            <input type="text" class="form-control" id="ad" name="ad" placeholder="Tu donativo" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <!--                                                <div class="col-lg-4 col-sm-4">
                                                    <div class="form-group">
                                                        <p>Costo servicio</p>
                                                        <input type="text" class="form-control" id="r" name="r"   placeholder="$ 0"    />
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>  -->
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="form-group">
                                            <label for="tot">Total</label>
                                            <input type="text" class="form-control" id="tot" name="tot" placeholder="$ <?php echo number_format($respuestaTierCrow[0]['tier_amount'], 0, '', '.'); ?>" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <br>
                                            <input type="checkbox" id="tyc" name="tyc" />
                                            <label for="tyc">He leído los <a href="#">términos y condiciones</a></label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <br>
                                        <button type="submit" class="default-btn page-btn box-btn">
                                            <i class="bx bx-search"></i> Pagar
                                        </button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>



    </div>
</section>
<!-- Fin Perfil Artista -->





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
</body>

</html>