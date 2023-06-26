<?php  
include "model/models.php";
include "header.php";
 
//Búsquedas de Eventos
if (isset($_GET["a"])) {
    $id=$_GET["a"];
    if (!preg_match('/[0-9]/', $id)) {
        exit();
    }
    $respuesta=Consultas::detallesArtistas($id);
}
 
$biografia=Consultas::bioArtistas($id);
$descripcion=Consultas::descArtistas($id);

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
                        <li> <a href="artistas.php"> Artistas </a> </li>
                        <li class="active"><?php echo $respuesta[0]["nick_user"]; ?></li> 
                    </ul>
                </div>
            </div>
<!--            <div class="page-shape">
                <div class="shape1">
                    <img src="assets/images/shape/1.png" alt="shape" />
                </div>
                <div class="shape3">
                    <img src="assets/images/shape/3.png" alt="shape" />
                </div>
                <div class="shape4">
                    <img src="assets/images/shape/4.png" alt="shape" />
                </div>
                <div class="shape5">
                    <img src="assets/images/shape/5.png" alt="shape" />
                </div>
                <div class="shape6">
                    <img src="assets/images/shape/6.png" alt="shape" />
                </div>
            </div>-->
        </div>
        <!-- End Page Title Area -->
    
        <!-- Detalle de Perfil de Artista  -->
        <section class="feature-area bg-color ptb-35">
            <div class="container">
                <div class="row  "> 
                    <!--Perfil-->
                    <?php
//                    Determino si No hay EVENTOS, si nuevos ni pasados para ajustar diseño  
                    if( count($resultadosProxEventos) || count($resultadosEventosPasa) ){
                        $AnchoColumna = 'col-lg-5 col-sm-5'; 
                    }else{
                        $AnchoColumna = 'col-lg-12 col-sm-12';
                    } 
                    ?>
                    <div class="<?php echo $AnchoColumna; ?> item dev design">
                        <h2 class="text-center"> <?php echo $respuesta[0]["nick_user"]; ?></h2>
                        <div class="single-case text-center">
                            <div class="simple-evento-artista">
                                <a href="#">   
                                    <img class="responsiveArtista" src="https://echomusic.cl/images/avatars/<?php echo $respuesta[0]["id_user"]; ?>.jpg" alt="descatado" /> 
                                </a>
                            </div> 

                            <div class="feature-tittle">
                                
                                <span style="font-size: 20px">Seguidores 1 Seguidos 0 Publicaciones 2</span> 
                                
                                 <!--Descripción-->
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
                                } else {
                                    echo '<br>';
                                }
                                ?>
                            </div> 
                        </div>

                        <!--Playlist-->
                        <?php
                        $playlist = Consultas::playListArtista($respuesta[0]["id_user"]);
                        ?>
                        <div>
                            <?php
                            echo $playlist[0]["embed_multi"];
                            ?>
                        </div>
                    </div>                    


                    <!--Eventos-->
                    <div class=" col-lg-7">
                        <!-- Próximos eventos -->
                        <?php
                                            if (empty($resultadosProxEventos)) {
//                                                echo 'no hay prox eventos';
                                                
                                            }else{
                        ?>
                        <h3 class="text-center">Próximos Eventos (<?php echo count($resultadosProxEventos); ?>)</h3> 

                            <?php
                                for ($e = 0; $e < count($resultadosProxEventos); $e++) {
                             ?>
                            <div class="home-2-contact col-lg-12">                       
                                <div class="content"> 
                                    <div class="row">
                                        <!--img-->
                                        <div class="col-12 col-sm-4  choose-img text-center">  
                                            <img class="responsiveEveArtista" src="https://echomusic.cl/images/events/<?php echo $resultadosProxEventos[$e]["img"]; ?>.jpg" alt="<?php echo ''; ?>"  /> 


                                        </div>
                                        <!--Descripción-->
                                        <div class="col-12 col-sm-8" style="vertical-align: middle;">
                                            <ul>
                                                <li>
                                                    <?php echo $resultadosProxEventos[$e]["name_event"]; ?>                                                    
                                                </li> 
                                            </ul>

                                            <a class="textoCorto" href=" ">
                                                <h3><?php echo $resultadosProxEventos[$e]["name_event"]; ?> </h3> 
                                            </a>


                                            <p style="font-size: .9em; color: grey; "><?php echo substr($resultadosProxEventos[$e]["desc_event"],0,220); ?> </p>


                                            <a href=" " class="box-btn">Ver evento</a>
                                        </div>
                                    </div>
                                    <!--fin del Row-->
                                </div>
                            </div>
                                <?php
                                }//termina el for 
                            } 
//                            Termina else de Proximos Eventos     
                        if (empty($resultadosEventosPasa)) {
//                            echo 'no hay eventos pasados';

                        }else{
                        ?>
                        <!-- Eventos Pasados -->
                        <h3 class="text-center">  Eventos Pasados (<?php echo count($resultadosEventosPasa); ?>)</h3> 

                            <div class="home-2-contact col-lg-12">                       
                                <div class="content"> 
                                    <!--Diseño ANterior-->
                    <!--             <div class="row">
                                        img
                                        <div class="col-12 col-sm-6  choose-img">  
                                            <img src="https://echomusic.cl/images/events/<?php echo $resultadosEventosPasa[$p]["img"]; ?>.jpg" alt="<?php echo ''; ?>" width="350px"/> 
                                        </div>
                                        Descripción
                                        <div class="col-12 col-sm-6" style="vertical-align: middle;">
                                            <ul>
                                                <li>
                                                    <?php echo $resultadosEventosPasa[$p]["name_event"]; ?>                                                    
                                                </li> 
                                            </ul>  
                                            <h3><?php echo $resultadosEventosPasa[$p]["name_event"]; ?> </h3>  
                                            <p>Organizado: 
                                                <?php echo $resultadosEventosPasa[$p]["organizer"]; ?>
                                                <?php echo $resultadosEventosPasa[$p]["name_location"]; ?>
                                                / <?php echo $resultadosEventosPasa[$p]["location"]; ?> </p>
                                            <p><?php echo $resultadosEventosPasa[$p]["desc_event"]; ?> </p>
 
                                        </div>
                                    </div> fin del Row-->
                                    
                                    <!--Diseño Nuevvo-->
                                    <div class="row">
                                        <div class="home-team-slider owl-carousel owl-theme">
                                            <?php
                                            for ($p = 0; $p < count($resultadosEventosPasa); $p++) {
                                                ?>
                                                <div class="single-team">
                                                    <div class="team-img">  
                                                        <img class="tamano-4" src="https://echomusic.cl/images/events/<?php echo $resultadosEventosPasa[$p]["img"]; ?>.jpg" alt="<?php echo ''; ?>" width="350px"/>
                                                    </div>

                                                    <div class="content text-center">
                                                        <h6><?php echo $resultadosEventosPasa[$p]["name_event"]; ?> </h6>
                                                        <p style="font-size: 10px;">Organizado: <?php echo $resultadosEventosPasa[$p]["organizer"]; ?>
                                                            <?php echo $resultadosEventosPasa[$p]["name_location"]; ?>
                                                            / <?php echo $resultadosEventosPasa[$p]["location"]; ?> 
                                                        </p>
                                                    </div>
                                                </div>                                                                                        
                                                <?php
                                            }
                                            ?>
                                        </div>

                                    </div>                    
                                </div>
                            </div>
                            <?php
                             
                        } 
                        //termina else de Eventos Pasados
                        ?>  
                          <!--Nuevo diseño eventos pasados--> 
                          <!--Solo Formato HTML-->
<!--                        <div class="home-2-contact col-lg-12">                       
                            <div class="content"> 
                                <div class="row">
                                    <div class="home-team-slider owl-carousel owl-theme">

                                        <div class="single-team">
                                            <div class="team-img">
                                                <img src="assets/images/avatars/echo-1.jpg" alt="descatado" /> 
                                            </div>

                                            <div class="content text-center">
                                                <h3>Destacado 1</h3>
                                                <p>Texto de destacado 1</p>
                                            </div>
                                        </div>
 
                                    </div>

                                </div>
                            </div>
                        </div>                        -->

                    <!--Condición para mostrar video-->
                    <?php 
                    if( count($resultadosProxEventos) == 0){ // si no hay eventos proximos
                    ?> 
                        <div class="row align-items-center choose-c justify-content-md-center pt-35">
                            <div class="section-title ">
                                <h3>Videos</h3> 
                            </div> 
                            <div class="home-2-contact col-lg-12">                       
                                <div class="content"> 
                                    <div class="row altoVideo">
                                        <iframe src="https://echomusic.genesysapp.com/video/videos.php?a=<?php echo $id;?>" class="altoVideo" style="border: none;" width="100%"  ></iframe>
                                    </div>
                                    <!--fin del Row-->
                                </div>
                            </div>
                        </div>
                                </div>  
                          </div>  
                      </div>
                  </section>
                    <?php  
                    }else{            
                    ?> 
                    </div> 

                </div> 
 
            </div>
        </section>
        <!-- Fin Perfil Artista -->
        
        <!-- Videos -->
        <section class="pricing-area ptb-35">
            <div class="container">
                <div class="row align-items-center choose-c justify-content-md-center">
                    <div class="section-title ">
                        <h2>Videos</h2> 
                    </div> 
                    <div class="home-2-contact col-lg-8">                       
                        <div class="content"> 
                            <div class="row">
                                <iframe src="https://echomusic.genesysapp.com/video/videos.php?a=<?php echo $id;?>" class="altoVideo" style="border: none;" width="100%" ></iframe>
                            </div>
                            <!--fin del Row-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Videos -->  
        
        <?php
         } //Fin del else de Video
        ?>
        
        <!-- Crowdfunding 2 -->
<?php  
    $respuestaCrowdfunding = Consultas::crowdfunding($respuesta[0]["id_user"]);
    
//    si No hay Crowdfunding, no muestra nada
    if( empty($respuestaCrowdfunding) ){
//        echo '<h2>No hay Crowdfunding</h2>';
    }else{
        $totalARecaudar  = $respuestaCrowdfunding[0]["project_amount"];
    //  Extrae la suma de lo recaudado
//        $sumaRecaudado = array_sum ( Consultas::recaudadoCrowdfunding( $respuestaCrowdfunding[0]["id_project"]) );
        $sumaRecaudado =  Consultas::recaudadoCrowdfunding( $respuestaCrowdfunding[0]["id_project"]) ;
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
                                        <img src="https://echomusic.cl/images/avatars/<?php echo $respuesta[0]["id_user"]; ?>.jpg" alt="<?php echo $respuesta[0]["nick_user"]; ?>" width="350px"/> 
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
        
        

        
        
        <!--  Tarifas Area -->
        <section class="home-blog-area bg-color ptb-35">
            <div class="container">
                <div class="section-title">
                    <!--<span>What We Offer</span>-->
                    <h2>Tarifas</h2>
                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ipsum suspendisse.</p>-->
                </div>
                
                <!--Tarifas formato blog-->
                
                 
                
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/bg/fondo-precios-1-morado-min.jpg" alt=""/> 
                                </a>
                            </div>

                            <!--<div class="content single-pricing">--> 
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <h3>$5.000</h3>
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
                                
                            <!--</div>-->
                        </div>
                    </div> 
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/bg/fondo-precios-2-azuljpg-min.jpg" alt=""/> 
                                </a>
                            </div>

                            <!--<div class="content single-pricing">--> 
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <h3>$5.000</h3>
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
                                
                            <!--</div>-->
                        </div>
                    </div> 
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/bg/fondo-precios-3-naranja-min.jpg" alt=""/> 
                                </a>
                            </div>

                            <!--<div class="content single-pricing">--> 
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <h3>$5.000</h3>
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
                                
                            <!--</div>-->
                        </div>
                    </div> 
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
                            <div class="col-12 col-sm-6 ">
                                <br>
                                <h3>¿Necesitas una tarifa a convenir?</h3>
                                <a href="" class="box-btn">Solicitala aquí</a>
                            </div> 
                            <div class="col-12 col-sm-6 ">
                                <br>
                                <h3>Descarga aqui </h3>
                                <a href="" class="box-btn">Ficha Tecnica</a>
                                <a href="" class="box-btn">Dossier</a>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        </section>
        <!-- End Tarifas Area -->        
 
        
        
     

 
        <!-- Footer Area -->
        <footer class="footer-area pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="content">
                            <div class="logo text-center align-items-center" style='vertical-align: middle;'>     
                                <!--<a href="index.html"><img src="assets/images/logo/echimusic-isotipo-blanco-min.png" alt="" width="90px"/></a>-->   
                                <img src="assets/images/Corfo-proyectoapoyadopor-gob-chile-min.png" alt="" width="300px" /> &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <img src="assets/images/logo/3ie-logo-blanco.png" alt="" width="110px"/>
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
                                <li><a href="#">Ticketing</a></li>
                                <li><a href="#">Crowdfunding</a></li>
                                <li><a href="#">Marketplace de artistas</a></li> 
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
                                <li><a href="#">Ticketing</a></li>
                                <li><a href="#">Crowdfunding</a></li>
                                <li><a href="#">Marketplace de artistas</a></li> 
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
                                Copyright @2023 EchoMusic | By
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
            
            $(document).ready(function(){
              $('.owl-carousel').owlCarousel({
                                items:1,
                                merge:true,
                                loop:true,
                                margin:10,
                                video:true,
                                videoWidth: true, // Default false; Type: Boolean/Number
                                videoHeight: true, // Default false; Type: Boolean/Number
                                lazyLoad:true,
                                center:true,
                                responsive:{
                                    480:{
                                        items:2
                                    },
                                    600:{
                                        items:3
                                    }
                                }
                            });
                  $('.owl-carousel-video').owlCarousel({
                        items:1,
                        merge:true,
                        loop:true,
                        margin:10,
                        video:true,
                        lazyLoad:true,
                        center:true,
                        responsive:{
                            480:{
                                items:2
                            },
                            600:{
                                items:4
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