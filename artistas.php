<?php
include "model/models.php";
include "header.php";

//Búsquedas de Eventos
if (isset($_GET["a"])) {
    $id = $_GET["a"];
    if (!preg_match('/[0-9]/', $id)) {
        exit();
    }
    $respuesta = Consultas::detallesArtistas($id);
}

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
            <h2><?php echo $respuesta[0]["nick_user"]; ?></h2>
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
            <div class="col-lg-5 col-sm-5">

                <div class="  text-center">
                    <div class=" ">
                        <a href="#">
                            <img class="responsiveArtista" src="https://echomusic.net/dashboard/images/usuarios/<?php echo $respuesta[0]["id_user"]; ?>.jpg" alt="descatado" />
                        </a>

                        <h2 class="text-center"> <?php echo $respuesta[0]["nick_user"]; ?></h2>
                        <span>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </span>
                    </div>

                    <div class="feature-tittle">




                    </div>
                </div>
            </div>


            <!--Eventos-->
            <div class=" col-lg-7 text-center">

                <!-- Descripción -->
                <?php
                if (!empty($descripcion[0]["desc_user"])) {
                ?>
                    <h3>Descripción</h3>
                    <p style="text-align: center;"><?php echo $descripcion[0]["desc_user"]; ?></p>
                <?php
                } else {
                    echo '<br>';
                }
                ?>

                <!-- Biogración - Button to Open the Modal -->
                <?php
                if (!empty($biografia[0]["bio_user"])) {
                ?>
                    <a type="button" class="box-btn" data-bs-toggle="modal" data-bs-target="#ModalBio">Ver Biografía</a>
                <?php
                }

                if (!empty($presskit[0]["file"])) {
                ?>
                    <a type="button" class="box-btn" href="<?php echo "/dashboard/images/presskit/" . $presskit[0]["file"]; ?>" target="_blank">Descargar Presskit</a>
                <?php
                } else {
                ?>
                    <a type="button" class="box-btn" href="/dashboard/images/presskit/EPK_Dakel_Percusioin_compressed.pdf" target="_blank">Descargar Presskit defecto</a>
                <?php
                }
                ?>
                <!-- Ver Eventos  -->
                <a type="button" class="box-btn" data-bs-toggle="modal" data-bs-target="#ModalEventos">Ver eventos</a>

                <br>
                <?php


                // echo "Genero: " . $respuesta[0]["id_user"];

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
</section>

</div>

</div>

</div>
</section>
<!-- Fin Perfil Artista -->

<!-- Videos -->
<?php
$playlist = Consultas::playListArtista($respuesta[0]["id_user"]);
$videos = Consultas::videoArtista($id);
?>
<section class="pricing-area ptb-35">
    <?php if (!empty($videos[0]["embed_multi"]) || !empty($playlist[0]["embed_multi"])) : ?>
        <div class="container">
            <div class="row align-items-center choose-c justify-content-md-center">
                <div class="col-lg-8 col-sm-8">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php if (!empty($videos[0]["embed_multi"])) : ?>
                            <li class="nav-item">
                                <a class="nav-link active" id="video-tab" data-bs-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="true">Videos</a>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($playlist[0]["embed_multi"])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" id="playlist-tab" data-bs-toggle="tab" href="#playlist" role="tab" aria-controls="playlist" aria-selected="false">Playlist</a>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <?php if (!empty($videos[0]["embed_multi"])) : ?>
                            <div class="tab-pane fade show active" id="video" role="tabpanel" aria-labelledby="video-tab">
                                <!--Video-->
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 col-sm-8 ptb-35">
                                        <iframe src="https://echomusic.net/video/videos.php?a=<?php echo $id; ?>" class="altoVideo" style="border: none;" width="100%"></iframe>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($playlist[0]["embed_multi"])) : ?>
                            <div class="tab-pane fade" id="playlist" role="tabpanel" aria-labelledby="playlist-tab">
                                <!-- Playlist -->
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 col-sm-8 ptb-35">
                                        <?php echo $playlist[0]["embed_multi"]; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<!-- End Videos -->







<!--  Tarifas Area -->
<?php

$tarifasArtista = Consultas::tarifas($respuesta[0]["id_user"]);

// condición para mostrar o no las tarifas 
if (empty($tarifasArtista[0]["value_plan"])) {
    // echo 'No hay tarifas';
} else {
    //Inician tarrifas
?>
    <section class="home-blog-area bg-color ptb-35" id="tarifas">
        <div class="container">
            <div class="section-title">
                <h2>Tarifas</h2>
            </div>

            <!--Tarifas formato blog-->
            <div class="row justify-content-md-center">
                <?php
                for ($t = 0; $t < count($tarifasArtista); $t++) {
                    if ($tarifasArtista[$t]["active"] == 'active') {
                ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-blog">
                                <div class="blog-img">
                                    <img style="height: 200px; width: 200px; border-radius: 50%;" src="https://echomusic.net/dashboard/images/usuarios/<?php echo $respuesta[0]["id_user"]; ?>.jpg" class="responsiveArtista" alt="" />
                                </div>

                                <div class="pricing-top-heading">
                                    <h3>Tarifa <?php echo $t + 1; ?></h3>
                                    <p><?php echo $tarifasArtista[$t]["desc_plan"]; ?></p>
                                </div>
                                <h3>$<?php echo number_format($tarifasArtista[$t]["value_plan"], 0, ",", "."); ?></h3>
                                <ul>
                                    <li>
                                        <i class="bx bx-badge-check"></i>
                                        &nbsp;&nbsp; Duración <?php echo $tarifasArtista[$t]["duration_minutes"]; ?> minutos.
                                    </li>
                                    <li>
                                        <i class="bx bx-badge-check"></i>
                                        &nbsp;&nbsp; Backline <?php echo $tarifasArtista[$t]["backline"]; ?>
                                    </li>
                                    <li>
                                        <i class="bx bx-badge-check"></i>
                                        &nbsp;&nbsp; Ingeniero de Sonido <?php echo $tarifasArtista[$t]["sound_engineer"]; ?>
                                    </li>
                                    <li>
                                        <i class="bx bx-badge-check"></i>
                                        &nbsp;&nbsp; Refuerzo Sonoro <?php echo $tarifasArtista[$t]["sound_reinforcement"]; ?>
                                    </li>
                                    <li>
                                        <i class="bx bx-badge-check"></i>
                                        &nbsp;&nbsp; Sonidista <?php echo $tarifasArtista[$t]["sound_reinforcement"]; ?>
                                    </li>
                                    <li>
                                        <i class="bx bx-badge-check"></i>
                                        &nbsp;&nbsp; Nº de Músicos <?php echo $tarifasArtista[$t]["artists_amount"]; ?>
                                    </li>
                                </ul>
                                <a class="box-btn" href="artistas_contratacion.php?a=<?php echo $id; ?>&id_name_plan=<?php echo $tarifasArtista[$t]["id_name_plan"]; ?>">
                                    Contratar
                                </a>

                            </div>
                        </div>

                <?php
                    } //FIN DEL ELSE
                } //fin del FOR
                ?>




            </div>

            <!--Tarifas formato redondeado-->
            <div class="tab quote-list-tab">
                <!--                    <ul class="tabs">
                        <li>
                            <a href="#">
                                Monthly
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Yearly
                            </a>
                        </li>
                    </ul>-->
                <!--                    <div class="tab_content">
                        <div class="tabs_item">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <span>$5.000</span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Duración 1 hr.
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                               Backline  
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Refuerzo Sonoro
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Sonidista
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Nº de Músicos
                                            </li> 
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Contratar
                                        </a>
                                    </div>
                                </div> 
                                
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <span>$5.000</span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Duración 1 hr.
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                               Backline  
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Refuerzo Sonoro
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Sonidista
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Nº de Músicos
                                            </li> 
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Contratar
                                        </a>
                                    </div>
                                </div> 
                                
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <span>$5.000</span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Duración 1 hr.
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                               Backline  
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Refuerzo Sonoro
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Sonidista
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Nº de Músicos
                                            </li> 
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Contratar
                                        </a>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        
                        <div class="tabs_item">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Basic</h3>
                                            <p>Build A Website</p>
                                        </div>
                                        <span>$39 <sub>/Y</sub></span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                10GB Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                50GB Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                10 Free Sub-Domains
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                10GB Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                50GB Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                10 Free Sub-Domains
                                            </li>
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Get Started
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Standard</h3>
                                            <p>Build A Website</p>
                                        </div>
                                        <span>$79 <sub>/Y</sub></span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                80GB Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                90GB Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                10 Free Sub-Domains
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                70GB Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                50GB Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Sub-Domains
                                            </li>
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Get Started
                                        </a>
                                        <strong class="popular">Popular</strong>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 offset-sm-3 offset-lg-0">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Premium</h3>
                                            <p>Build a website</p>
                                        </div>
                                        <span>$99 <sub>/Y</sub></span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Sub-Domains
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Domains
                                            </li>
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Get Started
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>-->
            </div>


            <!-- <div class="home-2-contact col-lg-8">                       
                        <div class="content"> 
                            <div class="row">-->
            <div class="home-2-contact justify-content-md-center text-center">
                <div class="content ">
                    <div class="row">
                        <div class="col-12 col-sm-12 ">
                            <br>
                            <h3>¿Necesitas una tarifa a convenir?</h3>
                            <a href="" class="box-btn" data-bs-toggle="modal" data-bs-target="#contratarArtistaModal">Solicitala aquí</a>
                            <!-- Botón para abrir el modal -->
                        </div>
                        <!-- <div class="col-12 col-sm-6 ">
                            <br>
                            <h3>Descarga aqui </h3>
                            <a href="" class="box-btn">Ficha Tecnica</a>
                            <a href="" class="box-btn">Dossier</a>
                        </div> -->
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Tarifas Area -->

<?php
} // fin del IF -ELSE para mostrar tarigas
?>





<!-- Crowdfunding 2 -->
<?php
$respuestaCrowdfunding = Consultas::crowdfunding($respuesta[0]["id_user"]);

//    si No hay Crowdfunding, no muestra nada
if (empty($respuestaCrowdfunding)) {
    // echo '<h2>No hay Crowdfunding'.$respuesta[0]["id_user"].'</h2>';
} else {
    $totalARecaudar  = $respuestaCrowdfunding[0]["project_amount"];
    //  Extrae la suma de lo recaudado
    //        $sumaRecaudado = array_sum ( Consultas::recaudadoCrowdfunding( $respuestaCrowdfunding[0]["id_project"]) );
    $sumaRecaudado =  Consultas::recaudadoCrowdfunding($respuestaCrowdfunding[0]["id_project"]);
    $recaudadoPorcentaje = Consultas::obtenerPorcentaje($sumaRecaudado[0], $totalARecaudar);
?>

    <section class="pricing-area ptb-35">
        <div class="container">
            <div class="row align-items-center choose-c justify-content-md-center">

                <div class="section-title ">

                    <h2>Crowdfunding</h2>
                </div>

                <div class="home-2-contact col-lg-8">
                    <div class="content">
                        <div class="row">
                            <!--img-->
                            <div class="col-12 col-sm-6  choose-img">
                                <a href="crowdfunding.php?c=<?php echo $respuestaCrowdfunding[0]["id_project"]; ?>">
                                    <img src="https://echomusic.net/dashboard/images/usuarios/<?php echo $respuesta[0]["id_user"]; ?>.jpg" alt="<?php echo $respuesta[0]["nick_user"]; ?>" width="350px" />
                                </a>
                            </div>
                            <!--Descripción-->
                            <div class="col-12 col-sm-6" style="vertical-align: middle;">
                                <ul>
                                    <li>
                                        <?php echo $respuesta[0]["nick_user"]; ?>
                                    </li>
                                </ul>

                                <a href="crowdfunding.php?c=<?php echo $respuestaCrowdfunding[0]["id_project"]; ?>">
                                    <h3><?php echo $respuestaCrowdfunding[0]["project_title"]; ?> </h3>
                                </a>
                                <h6>Avance del <?php echo $recaudadoPorcentaje; ?>% recaudado</h6>
                                <div class="progress">

                                    <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: <?php echo $recaudadoPorcentaje; ?>%" aria-valuenow="" aria-valuemin="<?php echo $sumaRecaudado[0]; ?>" aria-valuemax="<?php echo $totalARecaudar; ?>"></div>
                                </div>
                                <p><?php echo $respuestaCrowdfunding[0]["project_desc"]; ?> </p>

                                <a href="crowdfunding.php?c=<?php echo $respuestaCrowdfunding[0]["id_project"]; ?>" class="box-btn">Patrocinar</a>
                            </div>
                        </div>
                        <!--fin del Row-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Crwdfunding -->
<?php
} //fin del else 
?>






<!--  Integrantes Area -->
<?php

$muestraIntegrantes = Consultas::integrantes($respuesta[0]["id_user"]);

// condición para mostrar o no las tarifas 
if (empty($muestraIntegrantes[0]["id_user"])) {
    //echo 'No hay tarifas';
} else {
    //Inician Integrantes
?>
    <section class="home-blog-area   ptb-35">
        <div class="container">
            <div class="section-title">
                <!--<span>What We Offer</span>-->
                <h2>Integrantes</h2>
                <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ipsum suspendisse.</p>-->
            </div>

            <!--Integrantes formato blog-->
            <div class="row justify-content-md-center">
                <?php
                for ($t = 0; $t < count($muestraIntegrantes); $t++) {
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <img style="height: 200px; width: 200px; border-radius: 50%;" src="dashboard/images/integrantes/<?php echo $muestraIntegrantes[$t]["img_member"]; ?>" class="responsiveArtista" alt="" />

                            </div>

                            <div class="pricing-top-heading">
                                <h3><?php echo $muestraIntegrantes[$t]["first_name_member"] . " " . $muestraIntegrantes[$t]["last_name_member"]; ?></h3>
                            </div>
                            <p><?php
                                $muestraInstrumento = Consultas::obtenerInstrumento($muestraIntegrantes[$t]["instrument_member"]);
                                echo $muestraInstrumento[0]["name_instrument"];

                                ?>

                            </p>
                            <!-- <a class="box-btn" href="#">
                                Contratar
                            </a> -->

                        </div>
                    </div>

                <?php

                } //fin del FOR
                ?>




            </div>




        </div>
    </section>
    <!-- End Tarifas Area -->

<?php
} // fin del IF -ELSE para mostrar tarigas
?>






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

<?php include "scripts.php"; ?>

<!-- Redirecciona a tarifas -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.location.hash === "#tarifas") {
            var section = document.getElementById("tarifas");
            if (section) {
                section.scrollIntoView({
                    behavior: "smooth"
                });
            }
        }
    });
</script>





</body>

</html>