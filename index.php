<?php
include "model/models.php";
include "header.php";
?>


<!--video 2-->
<!-- Carousel wrapper -->
<div id="carouselVideoExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-mdb-target="#carouselVideoExample" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-mdb-target="#carouselVideoExample" data-mdb-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-mdb-target="#carouselVideoExample" data-mdb-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <!-- Inner -->
    <div class="carousel-inner">
        <!-- Single item -->
        <div class="carousel-item active">
            <div class="carousel-caption d-none d-md-block">
                <img src="assets/images/logo/logo-naranja-blanco.png" alt="" width="450px" />
                <h4>Marketplace de servicios musicales</h4>
                <p>
                    Encuentra eventos presenciales o streaming, contrata servicios musicales de artistas o patrocina proyectos musicales (Crowdfunding).
                </p>
            </div>
            <video class="img-fluid" autoplay loop muted>
                <!--<source src="assets/videos/echomusic-home-2.mp4" type="video/mp4"  />-->
                <source src="https://res.cloudinary.com/dsaz7y8t1/video/upload/v1685557254/Echomusic/BannerWeb2.0_Morado.mp4_vtjmui.mp4" type="video/mp4" />
            </video>
        </div>

        <!-- Single item -->
        <!--    <div class="carousel-item">
      <video class="img-fluid" autoplay loop muted>
        <source src="https://mdbcdn.b-cdn.net/img/video/forest.mp4" type="video/mp4" />
      </video>
      <div class="carousel-caption d-none d-md-block">
        <h5>2 Second slide label</h5>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </p>
      </div>
    </div>-->

        <!-- Single item -->
        <!--    <div class="carousel-item">
      <video class="img-fluid" autoplay loop muted>
        <source src="https://mdbcdn.b-cdn.net/img/video/Agua-natural.mp4" type="video/mp4" />
        <source src="https://player.vimeo.com/video/813569550?h=1dc8d8f438&autoplay=1&title=0&byline=0&portrait=0" type="video/mp4" />
      </video>
      <div class="carousel-caption d-none d-md-block">
                                        <div class="banner-content">
                                    <h1>
                                        Marketplace de servicios musicales   
                                    </h1>
                                    <p>
                                        Encuentra eventos presenciales o streaming, contrata servicios musicales de artistas o patrocina proyectos musicales (Crowdfunding).
                                    </p>
                                    <div class="banner-btn">
                                        <a href="#" class="box-btn"> <i class="bx bxs-user-plus"></i> Registrate</a>
                                        <a href="#" class="box-btn border-btn"> <i class="bx bxs-log-in"></i>Ingresar</a>
                                    </div>
                                </div> 
      </div>
    </div>-->
    </div>
    <!-- Inner -->

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-mdb-target="#carouselVideoExample" data-mdb-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-mdb-target="#carouselVideoExample" data-mdb-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- Carousel wrapper -->


<!--        Header VIdeo
        <div class="video-container">
            <video autoplay loop class="fillWidth visible-lg">
                <source src="https://player.vimeo.com/video/813569550?h=1dc8d8f438&autoplay=1&title=0&byline=0&portrait=0" type="video/mp4; "/>        
                Your browser does not support the video tag.
            </video>
        </div>      -->

<!-- Banner Area -->
<!--        <section class="banner-area">
            <div style="z-index: 0;padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/813569550?h=1dc8d8f438&autoplay=1&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="banner-content">
                                    <h1>
                                        Marketplace de servicios musicales   
                                    </h1>
                                    <p>
                                        Encuentra eventos presenciales o streaming, contrata servicios musicales de artistas o patrocina proyectos musicales (Crowdfunding).
                                    </p>
                                    <div class="banner-btn">
                                        <a href="#" class="box-btn"> <i class="bx bxs-user-plus"></i> Registrate</a>
                                        <a href="#" class="box-btn border-btn"> <i class="bx bxs-log-in"></i>Ingresar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="banner-img">
                                    <img src="assets/images/bg/echomusic-isotipo-01-min.png"  alt="banner-img"/> 
                                    <img src="assets/images/bg/echomusic-isostipo-rock-acustica-1.png" alt="banner-img"/> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-shape">
                <div class="shape1">
                    <img src="assets/images/shape/icono-echomusic-1.png" alt="shape"> 
                </div>
                <div class="shape2">
                    <img src="assets/images/shape/icono-echomusic-2.png" alt="shape">
                </div>
                <div class="shape3">
                    <img src="assets/images/shape/icono-echomusic-3.png" alt="shape">
                </div>
                <div class="shape4">
                    <img src="assets/images/shape/icono-echomusic-4.png" alt="shape">
                </div>
                <div class="shape5">
                    <img src="assets/images/shape/icono-echomusic-5.png" alt="shape">
                </div>
                <div class="shape6">
                    <img src="assets/images/shape/icono-echomusic-1.png" alt="shape">
                </div>
            </div>
        </section>-->
<!-- End Banner Area -->

<!--<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/813569550?h=1dc8d8f438&autoplay=1&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>-->

<!-- Soluciones Digitales EchoMusic quitado temparalemnte, debe ir a sección de perfil de artista -->
<!--        <section class="home-service-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span>Conectamos artistas</span>
                    <h2>Contamos con una suite de soluciones digitales</h2>
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse.</p>
                </div>

                <div class="row">
                    <div class="col-lg-2 col-sm-2"></div>
                    
                    <div class="col-lg-4 col-sm-4">
                        <div class="single-service">
                            <div class="service-img">
                                <img src="assets/images/bg/echomusic-isostipo-rock-acustica.png" alt="service"/>  
                            </div>

                            <div class="service-content">
                                <h3>Perfil</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque vel sit maxime assumenda. maiores, magnam</p>
                                
                                <a href="#" class="line-bnt">
                                    Ver más
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-4">
                        <div class="single-service">
                            <div class="service-img">
                                <img src="assets/images/iconos/ICON-25.png" alt=""/> 
                            </div>

                            <div class="service-content">
                                <h3>Ticketing</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque vel sit maxime assumenda. maiores, magnam</p>
                            
                                <a href="#" class="line-bnt">
                                    Ver más
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-sm-2"></div>
                        
                    
                    <div class="col-lg-2 col-sm-2"></div>
                    
                    <div class="col-lg-4 col-sm-4">
                        <div class="single-service">
                            <div class="service-img">
                                <img src="assets/images/iconos/ICON-35.png" alt=""/> 
                            </div>

                            <div class="service-content">
                                <h3>Crowdfunding</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque vel sit maxime assumenda. maiores, magnam</p>

                                <a href="#" class="line-bnt">
                                    Ver más
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-4">
                        <div class="single-service">
                            <div class="service-img">
                                <img src="assets/images/iconos/ICON-36.png" alt=""/> 
                            </div>

                            <div class="service-content">
                                <h3>Marketplace de artistas</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque vel sit maxime assumenda. maiores, magnam</p>
                            
                                <a href="#" class="line-bnt">
                                    Ver más
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-sm-2"></div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="single-service">
                            <div class="service-img">
                                <img src="assets/images/service/s5.png" alt="service" />
                            </div>

                            <div class="service-content">
                                <h3> Cyber Security</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque vel sit maxime assumenda. maiores, magnam</p>

                                <a href="solutions-details.html" class="line-bnt">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="single-service">
                            <div class="service-img">
                                <img src="assets/images/service/s6.png" alt="service" />
                            </div>

                            <div class="service-content">
                                <h3> Wireless Connectivity</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque vel sit maxime assumenda. maiores, magnam</p>

                                <a href="solutions-details.html" class="line-bnt">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
<!-- End Soluciones Digitales EchoMusic -->



<!-- Destacados - Características  -->
<section class="feature-area bg-color pt-70 pb-35">
    <div class="container">
        <div class="row align-items-center ">
            <div class=" col-lg-4">
                <div class="contnet">
                    <div class="feature-tittle">
                        <span style="font-size: 20px">Sección </span>
                        <h2>Destacados </h2>
                        <p>Encuentra lo más relevante en cuanto a eventos, proyectos, noticias y convocatorias.</p>
                    </div>

                    <a href="buscar_artista.php" class="box-btn">Ver más destacados</a>
                </div>
            </div>


            <div class="col-lg-8 col-sm-12 item dev design">

                <!--Nuevo Código-->
                <!-- Destacados Carrusel Area -->
                <section class="home-team-area  ">
                    <div class="container">

                        <div class="home-team-slider owl-carousel owl-theme">

                            <div class="single-team">
                                <div class="team-img">
                                    <img src="assets/images/avatars/echo-1.jpg" alt="descatado" />
                                    <ul class="social">
                                        <li>
                                            <a href="#" target="_blank"><i class='bx bx-search'></i></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="content text-center">
                                    <h3>Destacado 1</h3>
                                    <p>Texto de destacado 1</p>
                                </div>
                            </div>

                            <div class="single-team">
                                <div class="team-img">
                                    <img src="assets/images/avatars/echo-2.jpg" alt="descatado" />
                                    <ul class="social">
                                        <li>
                                            <a href="#" target="_blank"><i class='bx bx-search'></i></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="content text-center">
                                    <h3>Destacado 2</h3>
                                    <p>Texto de destacado 2</p>
                                </div>
                            </div>

                            <div class="single-team">
                                <div class="team-img">
                                    <img src="assets/images/avatars/echo-3.jpg" alt="descatado" />
                                    <ul class="social">
                                        <li>
                                            <a href="#" target="_blank"><i class='bx bx-search'></i></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="content text-center">
                                    <h3>Destacado 3</h3>
                                    <p>Texto de destacado 3</p>
                                </div>
                            </div>

                            <div class="single-team">
                                <div class="team-img">
                                    <img src="assets/images/avatars/echo-4.jpg" alt="descatado" />
                                    <ul class="social">
                                        <li>
                                            <a href="#" target="_blank"><i class='bx bx-search'></i></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="content text-center">
                                    <h3>Destacado 4</h3>
                                    <p>Texto de destacado 4</p>
                                </div>
                            </div>

                            <div class="single-team">
                                <div class="team-img">
                                    <img src="assets/images/avatars/echo-2.jpg" alt="descatado" />
                                    <ul class="social">
                                        <li>
                                            <a href="#" target="_blank"><i class='bx bx-search'></i></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="content text-center">
                                    <h3>Destacado 5</h3>
                                    <p>Texto de destacado 5</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                <!-- End Destacados Carrusel Area -->


            </div>

            <!--</div>-->
        </div>
    </div>
</section>
<!-- End Destacados - Características  -->



<!--  Case Eventos Artistas Proyectos  Espacios  -->
<section class="home-case ptb-35">
    <div class="container">
        <div class="section-title">
            <!--<span>Descubre</span>-->
            <!--<h2>Conoce todo lo que EchoMusic tiene para ti</h2>-->
            <h2>Cartelera</h2>
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse.</p>-->
        </div>

        <!-- <div class="case">
            <ul class="all-case">
                <li class="active" data-filter="*"><span>Todo</span></li>
                <li class="active" data-filter="*"><span>Presencial</span></li>
                <li data-filter=".dev"><span>Online</span></li>
            </ul>
        </div> -->

        <div class="row case-list">

            <?php
            $respuesta = Consultas::ultimosEventos2();
            //Busca CIudad y Región
            $respuestaCiudadRegion = Consultas::buscaCiudadRegion($respuesta[0]["id_city"], $respuesta[0]["id_region"]);

            #Notar que es lo mismo que hacer
            # date("Y-m-d H:i:s")                                
            for ($j = 0; $j < count($respuesta); $j++) {

                $fechaEntera = strtotime($respuesta[$j]["date_event"]);
                $anio = date("Y", $fechaEntera);
                $mes = date("m", $fechaEntera);
                $dia = date("d", $fechaEntera);

                $hora = date("H", $fechaEntera);
                $minutos = date("i", $fechaEntera);

                if (preg_match("/|\b/", $respuesta[$j]["IMG"])) {
                    $fotos = explode("|", $respuesta[$j]["IMG"]);
                    //var_dump($fotos);
                    $total = count($fotos) - 1;
                    $indice = mt_rand(0, intval($total));
                    $img = substr($fotos[0], 16);
                    //echo $img."<br>";
                    //echo "verdadero";
                } else {
                    $img = substr($respuesta[$j]["IMG"], 16);
                    //echo "falso";
                }
                echo     '                    
                    <div class="col-lg-4 col-sm-6 item cyber">
                        <div class="single-case">
                            <div class="case-img ">
                                <a href="eventos.php?e=' . $respuesta[$j]["id_event"] . '">
                                    <img class="imgEvent tamano-1" src="https://echomusic.net/dashboard/images/eventos/' . $respuesta[$j]["img"] . '.jpg" height="100%"  alt="case"/> 
                                </a>
                            </div>

                            <div class="content">
                                <!--Titulo-->
                                <div class="row text-center">
                                    <div class="col-12"> 
                                        <a href="eventos.php?e=' . $respuesta[$j]["id_event"] . '"> <h3>' . $respuesta[$j]["name_event"] . '</h3></a>
                                    </div> 
                                </div>
                                
                                <!--Entrada Fecha hora Costo Compra-->
                                <div class="row text-center ">
                                    <div class="col-lg-6 col-sm-6">
                                        <p>' . $dia . '-' . $mes . '-' . $anio . ' | ' . $hora . ':' . $minutos . ' hrs.</p>

                                        <a href="#" class="line-bnt">
                                            Ciudad ' . $respuestaCiudadRegion[$j]["name_region"] . ', ' . $respuesta[$j]["name_location"] . '
                                        </a>
                                    </div>
                                    
                                     <div class="col-lg-6 col-sm-6">';
                if ($respuesta[$j]["ticket_value"] == 0) {
                    echo  '<h3>Gratuito</h3>
                                                    <a href="eventos.php?e=' . $respuesta[$j]["id_event"] . '" class="box-btn">Reservar</a>';
                } else {
                    echo  '<h4>$ ' . number_format(($respuesta[$j]["ticket_value"] + $respuesta[$j]["ticket_commission"]), 0, ',', '.') . '</h4>
                                                    <a href="eventos.php?e=' . $respuesta[$j]["id_event"] . '" class="box-btn">Comprar</a>';
                }

                echo '
                                    </div> 
                                </div>                                                                                               
                            </div>
                            
                        </div>
                    </div>';
            }
            ?>
            <!--                    
                    <div class="col-lg-4 col-sm-6 item cyber">
                        <div class="single-case">
                            <div class="case-img">
                                <a href="#">
                                    <img src="assets/images/avatars/108105582263af4cca67c5b1_66751955.jpg"  alt="case"/> 
                                </a>
                            </div>

                            <div class="content">
                                Titulo
                                <div class="row text-center">
                                    <div class="col-12">
                                        <a href="#"> <h3>JCatStevens Experience</h3></a>
                                    </div> 
                                </div>
                                
                                Entrada Fecha hora Costo Compra
                                <div class="row text-center ">
                                    <div class="col-lg-6 col-sm-6">
                                        <p>20 Abril | 19:30 hrs</p>

                                        <a href="#" class="line-bnt">
                                            Presencial Online 
                                        </a>
                                    </div>
                                    
                                    <div class="col-lg-6 col-sm-6">
                                        <h4>$5.000</h4>
                                        <a href class="box-btn">Comprar</a>
                                    </div> 
                                </div>                                                                                               
                            </div>
                            
                        </div>
                    </div>

                    -->
        </div>

        <div class="case-btn text-center">
            <!--<p>  <a href="#">Ver más eventos</a></p>-->
            <p> <a href="cartelera.php" class="box-btn">Ver más eventos</a></p>
        </div>
    </div>
</section>
<!-- End Case  Eventos Artistas Proyectos  Espacios  -->


<!-- CTA Artista Productira-->
<section class="home-cta-1-azul pt-100 pb-70">
    <div class="container">


        <div class="row">
            <div class="col-lg-2 col-sm-2"></div>

            <div class="col-lg-5 col-sm-5">
                <div class="section-title">
                    <h2>¿Eres artista, productora o espacio de difusión?</h2>
                </div>
            </div>

            <div class="col-lg-3 col-sm-3" style="vertical-align: middle; ">
                <div class="text-center">
                    <div class="nav-btn">
                        <br>
                        <a href="cartelera.php" class="box-btn text-center">CREA TU EVENTO</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2"></div>
        </div>
    </div>
</section>
<!-- End CTA -->


<!-- Artistas - Características  -->
<?php
$respuestaArtistas = Consultas::ultimosArtistas();
?>

<section class="feature-area bg-color ptb-70">
    <div class="container">
        <div class="row align-items-center ">
            <div class=" col-lg-3">
                <div class="contnet">
                    <div class="feature-tittle">
                        <span style="font-size: 20px">Conoce</span>
                        <h2>Artistas EchoMusic</h2>
                        <p>Descubre nuevos artistas y contrata sus servicios musicales de manera fácil, digital y segura.</p>
                    </div>

                    <a href="buscar_artista.php" class="box-btn">Ver todos los Artista</a>
                </div>
            </div>


            <div class="col-lg-9 col-sm-12 item dev design">
                <!-- Artistas Carrusel Area -->
                <section class="home-team-area  ">
                    <div class="container">
                        <div class="home-team-slider owl-carousel owl-theme">

                            <?php
                            for ($i = 0; $i < count($respuesta); $i++) {
                                //                                BUscar nombre Ciudad Region
                                $respuestaArtistasCiudadRegion = Consultas::buscaCiudadRegion($respuestaArtistas[$i]["id_city"], $respuestaArtistas[$i]["id_region"]);
                                echo '          
                                    <div class="single-team">
                                        <div class="team-img">
                                            <a href="artistas.php?a=' . $respuestaArtistas[$i]["id_user"] . '"  >
                                                <img src="https://echomusic.cl/images/avatars/' . $respuestaArtistas[$i]["id_user"] . '.jpg" alt="descatado" />
                                            </a>
                                            <ul class="social">
                                                <li> 
                                                    <a href="artistas.php?a=' . $respuestaArtistas[$i]["id_user"] . '" target="_blank"><i class="bx bx-search"></i></a>
                                                </li> 
                                            </ul>
                                        </div> 
                                                                                
                                        <div class="content">
                                            <!--Titulo-->
                                            <div class="row text-center">
                                                <div class="col-12">
                                                    <a href="artistas.php?a=' . $respuestaArtistas[$i]["id_user"] . '"> <h3>' . $respuestaArtistas[$i]["nick_user"] . '</h3></a>
                                                </div> 
                                            </div>
                                            <!--Entrada Fecha hora Costo Compra-->
                                            <div class="row ">
                                                <div class="col-lg-6 col-sm-6">
                                                    <p>' . $respuestaArtistas[$i]["name_genre"] . ' <br>' . $respuestaArtistasCiudadRegion[0]["name_city"] . ' / ' . $respuestaArtistasCiudadRegion[0]["name_region"] . '</p>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 text-center ">
                                                    <a href="artistas.php?a=' . $respuestaArtistas[$i]["id_user"] . '" class="box-btn">Ver perfil</a>
                                                </div> 
                                            </div>                                                                                               
                                        </div>                                        
                                    </div> ';
                            } //fin del for

                            ?>


                        </div>
                    </div>
                </section>
                <!-- End Artistas Carrusel Area -->


            </div>


        </div>
    </div>
</section>
<!-- End Artistas - Características  -->


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
                        <a href="buscar_artista.php" class="box-btn text-center">Crea tu perfíl</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2"></div>
        </div>
    </div>
</section>
<!-- End CTA 2 unete-->

<!-- Crowdfunding - Características  -->
<section class="feature-area bg-color ptb-70">
    <div class="container">
        <div class="row align-items-center ">
            <div class=" col-lg-3">
                <div class="contnet">
                    <div class="feature-tittle">
                        <span style="font-size: 20px">Crowdfunding</span>
                        <h2>Conoce los proyectos</h2>
                        <p>Apoya artistas, ayudándoles a financiar sus proyectos musicales y llévate una recompensa.</p>
                    </div>

                    <a href="buscar_crowdfunding.php" class="box-btn">Ver más proyectos</a>
                </div>
            </div>


            <div class="col-lg-9 col-sm-12 item dev design">
                <!-- Crowdfunding Carrusel Area -->
                <section class="home-team-area  ">
                    <div class="container">

                        <div class="home-team-slider owl-carousel owl-theme">

                            <?php
                            $eventosRelacionados = Consultas::ultimosCrowdfundingPaginaInicio();


                            for ($k = 0; $k < count($eventosRelacionados); $k++) {
                                $respuestaCrowdfunding = Consultas::crowdfunding($eventosRelacionados[$k]["id_user"]);

                                // Recaudado
                                $totalARecaudar = $respuestaCrowdfunding[$k]["project_amount"];
                                $sumaRecaudado[$k] = Consultas::recaudadoCrowdfunding($respuestaCrowdfunding[$k]["id_project"]);
                                $recaudadoPorcentaje = Consultas::obtenerPorcentaje($sumaRecaudado[$k][0], $totalARecaudar);


                                $artistaCrowd = Consultas::detallesArtistas($eventosRelacionados[$k]["id_user"]);
                            ?>

                                <div class="single-team">
                                    <div class="team-img overlay-container">
                                        <a href="crowdfunding.php?c=<?php echo $eventosRelacionados[$k]["id_project"]; ?>">
                                            <img src="https://echomusic.cl/images/avatars/<?php echo $eventosRelacionados[$k]["id_user"]; ?>.jpg" alt="destacado" />
                                        </a>

                                        <div class="author">
                                            <!-- <img src="https://echomusic.cl/images/avatars/<?php echo $artistaCrowd[0]["id_user"]; ?>.jpg" alt="Foto del autor"> -->
                                            <?php echo '<a href="https://echomusic.cl/profile.php?userid=' . $artistaCrowd[0]["id_user"] . '">' . $artistaCrowd[0]["nick_user"] . '</a>'; ?>
                                        </div>

                                        <ul class="social">
                                            <li>
                                                <a href="crowdfunding.php?c=<?php echo $eventosRelacionados[$k]["id_project"]; ?>"><i class='bx bx-search'></i></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="content ">


                                        <!--Titulo-->
                                        <div class="row text-center">
                                            <div class="col-12 titulo-proyecto-home">
                                                <a href="crowdfunding.php?c=<?php echo $eventosRelacionados[$k]["id_project"]; ?>">
                                                    <h3><?php echo $eventosRelacionados[$k]["project_title"]; ?></h3>
                                                </a>
                                            </div>
                                        </div>
                                        <!--Entrada Fecha hora Costo Compra-->
                                        <div class="row ">
                                            <div class="col-lg-6 col-sm-6">
                                                <p class="descripcion">
                                                    <?php
                                                    if ($eventosRelacionados[$k]["status_project"] == 2) {
                                                        echo "<span class='badge badge-warning'>Finalizado</span> ";
                                                    } else {
                                                        echo "<span class='badge badge-primary'>En proceso</span> ";
                                                    }

                                                    ?> </p>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 text-center " style="vertical-align: middle;">
                                                <a href="crowdfunding.php?c=<?php echo $eventosRelacionados[$k]["id_project"]; ?>" class="box-btn">
                                                    Ver más</a>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 text-center" style="vertical-align: middle; margin-top: 10px;">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: <?php echo $recaudadoPorcentaje; ?>%" aria-valuenow="" aria-valuemin="<?php echo $sumaRecaudado[$k]; ?>" aria-valuemax="<?php echo $totalARecaudar; ?>"></div>

                                                </div>
                                                <p style="font-size: 11px;">$<?php echo number_format($sumaRecaudado[$k][0]) . " de $" . number_format($totalARecaudar); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php

                            }
                            ?>


                        </div>
                    </div>



            </div>
        </div>
</section>
<!-- End Artistas Carrusel Area -->
</div>

</div>
</div>
</section>
<!-- End Crowdfunding - Características  -->


<!-- CTA -->
<!--<section class="home-process-area pt-100 pb-70">-->
<section class="home-cta-3-naranja pt-100 pb-35">
    <div class="container">


        <div class="row">
            <div class="col-lg-2 col-sm-2"></div>

            <div class="col-lg-5 col-sm-5">
                <div class="section-title">
                    <h2>Financia tu próximo proyecto musical</h2>
                </div>
            </div>

            <div class="col-lg-3 col-sm-3" style="vertical-align: middle; ">
                <div class="text-center">
                    <div class="nav-btn">
                        <br>
                        <a href="buscar_crowdfunding.php" class="box-btn text-center">Crea tu proyecto</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2"></div>
        </div>
    </div>
</section>
<!-- End CTA -->

<!-- Blog Area -->
<section class="home-blog-area ptb-70">
    <div class="container">
        <div class="section-title">
            <span>Aprende</span>
            <h2>Echotips</h2>
        </div>

        <div class="row">

            <?php

            $img = array(
                'https://echomusic.cl/blog/wp-content/uploads/2023/06/como-planificar-tu-proximo-lanzamiento-1024x1024.jpg',
                'https://echomusic.cl/blog/wp-content/uploads/2023/06/LINE-UP-1024x1024.jpg',
                'https://echomusic.cl/blog/wp-content/uploads/2023/04/Como-crean-un-plan-de-marketing-musical-1024x683.jpg',
            );

            $xml = new DomDocument();
            $xml->load('https://echomusic.cl/blog/feed/');
            $raiz = $xml->documentElement;
            $entradas = $raiz->getElementsByTagName('item');
            for ($i = 0; $i < 3; $i++) {
                $titulo = $entradas->item($i)->getElementsByTagName('title')->item(0)->nodeValue;
                $vinculo = $entradas->item($i)->getElementsByTagName('link')->item(0)->nodeValue;
                $desc = $entradas->item($i)->getElementsByTagName('description')->item(0)->nodeValue;
                $category = $entradas->item($i)->getElementsByTagName('category')->item(0)->nodeValue;
                $fecha = $entradas->item($i)->getElementsByTagName('pubDate')->item(0)->nodeValue;
                $fecha_unix = strtotime($fecha);
                $fecha = strftime("%d/%m/%Y", $fecha_unix);
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog">
                        <div>
                            <a href="<?php echo $vinculo; ?>" target="_blank">
                                <img src="<?php echo $img[$i]; ?>" class="imgEvent" alt="blog" />
                            </a>
                        </div>

                        <div class="content">
                            <ul>
                                <li>
                                    <?php echo $fecha; ?>

                                    <a href="<?php echo $vinculo; ?>" target="_blank"><?php echo $category; ?></a>
                                </li>
                            </ul>

                            <a href="<?php echo $vinculo; ?>" taget="_blank">
                                <h3><?php echo substr($titulo, 0, 55); ?></h3>
                            </a>
                            <p><?php echo substr($desc, 0, 110); ?> ...</p>
                            <div class="text-center">
                                <a href="<?php echo $vinculo; ?>" target="_blank" class="box-btn text-center">Leer más</a>
                            </div>

                        </div>
                    </div>
                </div>

            <?php
                //    echo '<li><a href="'.$vinculo.'">'.$titulo.'</a> '.$fecha.'</li>';   
            }
            ?>


            <!--                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/avatars/13.jpg" alt="blog"/> 
                                </a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        20 April 2023
                                    </li>
                                    <li>
                                        <a href="#">Formación</a>
                                    </li>
                                </ul>
                                
                                <a href="blog-details.html">
                                    <h3>¿Qué es un Tiktok Live?</h3>
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>
                                <div class="text-center">
                                    <a href="#" class="box-btn text-center">Leer más</a>
                                </div>
                                
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/avatars/13.jpg" alt="blog"/> 
                                </a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        20 April 2023
                                    </li>
                                    <li>
                                        <a href="#">Formación</a>
                                    </li>
                                </ul>
                                
                                <a href="blog-details.html">
                                    <h3>¿Qué es un Tiktok Live?</h3>
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>
                                <div class="text-center">
                                    <a href="#" class="box-btn text-center">Leer más</a>
                                </div>
                                
                            </div>
                        </div>
                    </div> -->
        </div>
        <div class="blog-btn text-center">
            <a class="box-btn text-center" href="https://echomusic.cl/blog/" target="_blank">Ver más artículos</a>
        </div>
    </div>
</section>
<!-- End Blog Area -->


<!--  Contacto Area -->
<section class="home-contact-area   ptb-35">
    <div class="container">
        <div class="section-title">
            <span>Escríbenos</span>
            <h2>Déjanos tu mensaje, queremos ayudarte</h2>

        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="contact-img">
                    <img src="assets/images/bg/echomusic-isostipo-rock-acustica-1.png" alt="contacto" />
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="content">


                    <form id="contacto" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="fname_request" id="fname_request" class="form-control" required data-error="Ingresa tu nombre" placeholder="Nombre" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="lname_request" id="lname_request" class="form-control" required data-error="Ingresa tus apellidos" placeholder="Apellidos" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="subject_request" id="subject_request" class="form-control" required data-error="Asunto" placeholder="Asunto" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="company_request" id="company_request" class="form-control" required data-error="Empresa" placeholder="Empresa/Organización" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="email" name="email_request" id="email_request" class="form-control" required data-error="Escribe tu email" placeholder="Email" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="phone_request" id="phone_request" required data-error="Ingresa tu número celular" class="form-control" placeholder="Número celular" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>



                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <textarea name="message_request" class="form-control" id="message_request" cols="30" rows="5" required data-error="Deja tu mensaje" placeholder="Tu mensaje"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn page-btn box-btn">
                                    Enviar
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
</section>
<!-- End Contact Area -->


<!--Footer-->
<?php
include 'footer.php';
?>