<?php  
include "model/models.php";
include "header.php";
 
//Búsquedas de Eventos
if (isset($_GET["e"])) {
    $id=$_GET["e"];
    if (!preg_match('/[0-9]/', $id)) {
        exit();
    }
    $respuesta=Consultas::detallesBusqueda2($id);
}

 
//Fecha
 $fechaEntera = strtotime($respuesta[0]["date_event"]);
$anio = date("Y", $fechaEntera);
$mes = date("M", $fechaEntera);
$dia = date("d", $fechaEntera);
$diaSemana = date("D", $fechaEntera);

$hora = date("H", $fechaEntera);
$minutos = date("i", $fechaEntera); 

//var_dump($respuesta);

$idEvento=  $respuesta[0]["id_event"];
$idUsuario= $respuesta[0]["id_user"];

//Buscar Género
$resuestaBuscaGenero =Consultas::buscarGenero($idUsuario); 
$idGenero= $resuestaBuscaGenero["id_genre"];

//    BUscar nombre Ciudad Region
$respuestaEventoCiudadRegion = Consultas::buscaCiudadRegion($respuesta[0]["id_city"], $respuesta[0]["id_region"] ) ; 

?>

    
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2> <?php echo $respuesta[0]["name_event"]; ?></h2>
                    <ul>
                        <li><a href="index.php"> Inicio </a> </li>
                        <li><a href="eventos.php"> Eventos </a></li>
                        <li><a href="eventos.php"> <?php echo $resuestaBuscaGenero["name_genre"]; ?></a></li> 
                        <li class="active"><?php echo $respuesta[0]["name_event"]; ?></li> 
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


        <!-- Detalle de Evento SetUp  -->
        <section class="feature-area bg-color pb-100 pt-35">
            <div class="container">
                <div class="row align-items-center "> 
                    <div class="col-lg-6 col-sm-6 item dev design">
                        <div class="single-case">
                            <!-- Carousel Start -->
                            <div id="carouselsliderdemo" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner simple-evento-artista">
                                    <div class="carousel-item active">
                                        <img src="https://echomusic.cl/images/events/<?php echo $respuesta[0]["img"]; ?>.jpg" class="d-block w-100">
                                    </div>
<!--                                    <div class="carousel-item">
                                        <img src="assets/images/avatars/echo-2.jpg" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/images/avatars/echo-3.jpg" class="d-block w-100">
                                    </div>-->
                                </div>
                                <!-- Indicator start -->
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselsliderdemo" class="active img-thumbnail"
                                            data-bs-slide-to="0">
                                        <img src="https://echomusic.cl/images/events/<?php echo $respuesta[0]["img"]; ?>.jpg" alt="" class="d-block w-50">
                                    </button>
<!--                                    <button type="button" data-bs-target="#carouselsliderdemo" class="img-thumbnail" data-bs-slide-to="1">
                                        <img src="assets/images/avatars/echo-2.jpg" alt="" class="d-block w-100">
                                    </button>
                                    <button type="button" data-bs-target="#carouselsliderdemo" class="img-thumbnail" data-bs-slide-to="2">
                                        <img src="assets/images/avatars/echo-3.jpg" alt="" class="d-block w-100">
                                    </button>-->
                                </div>
                                <!-- Indicator Close -->
                            </div>
                            <!-- Carousel Close -->  
                        </div>         
                    </div>                    
                    
                    <div class=" col-lg-6">
                        
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="feature-tittle"> 
                                <h2> <?php echo $respuesta[0]["name_event"]; ?> </h2>
                                <span style="font-size: 20px"><?php echo $diaSemana.' '.$dia.' de '.$mes.', '.$anio.' | '.$hora.':'.$minutos.' hrs'; ?>  </span>
                                <span style="font-size: 15px">Evento presencial </span> 
                                 <br>
                                <span style="font-size: 12px">  	<?php echo $respuestaEventoCiudadRegion[0]["name_city"]; ?> / Región <?php echo $respuestaEventoCiudadRegion[0]["name_region"]; ?></span><br>

                                <span style="font-size: 12px">Lugar	<?php echo $respuesta[0]["name_location"]; ?>,	<?php echo $respuesta[0]["location"]; ?></span>
                                
                                <h3>Descripción del evento</h3>
                                <p><?php echo $respuesta[0]["desc_event"]; ?></p>
                                </div> 
                            </div>
                            
                             <?php

                                for ($j=0; $j < count($respuesta); $j++) { 
                                    
                                    echo '<!--<div class="col-12 col-sm-1 text-center"></div>-->
                                            <div class="col-6 col-sm-4 text-left">
                                               <h6><i class="bx bxs-coupon"></i> '.$respuesta[$j]["ticket_name"].' ('.$respuesta[$j]["ticket_audience"].')</h6>
                                            </div>'; 
                                    echo '<div class="col-6 col-sm-3 text-center">';
                                    
                                    if( $respuesta[$j]["ticket_value"]== 0 ){
                                        echo ' <h3> Gratis </h3> 
                                                </div>
                                                <div class="col-12 col-sm-4 text-center">
                                                    <a href="#" class="box-btn">Reservar</a>
                                                </div>';
                                    } else {
                                        echo ' <h3> $'. number_format( ($respuesta[$j]["ticket_value"]+$respuesta[$j]["ticket_commission"]), 0, ',', '.').' </h3> 
                                            </div>
                                            <div class="col-12 col-sm-4 text-center">
                                                <a href="#" class="box-btn">Comprar</a>
                                            </div>';
                                    }
                                            
                                    echo '  <div class="col-12 col-sm-1 text-right"></div>';  
                                    
                                    } 
                                ?>
                            
                            
                            
                            <div class="col-12 col-sm-6 text-center">Métodos de pago / <a href="terminos-y-condiciones.php" target="_blank"> Términos y Condiciones</a></div>
                            <div class="col-12 col-sm-6 text-center"> 
                                
                                    <span   style="text-align: right;"> 
                                        <ul class="social">
                                            <li> <p>Comparte</p></li>
                                            <li> <a href="#" target="_blank"><i class='bx bxl-whatsapp' ></i></a></li>
                                            <li> <a href="#" target="_blank"><i class='bx bxl-facebook' ></i></a></li>                                            
                                            <li> <a href="#" target="_blank"><i class='bx bxl-instagram' ></i></a> </li>
                                        </ul> 
                                    </span>
                                                               
                            </div>
                        </div> 
                        
                        
                        
 
                    </div>

                    <!--<div class="">-->

                        
                       
                                                
                    <!--</div>-->
                </div>
            </div>  <!--Container--> 
            
            
            
            <!--Divisione smúltiples-->
<!--            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        Level 1: .col-sm-3
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-8 col-sm-6">
                                Level 2: .col-8 .col-sm-6
                            </div>
                            <div class="col-4 col-sm-6">
                                Level 2: .col-4 .col-sm-6
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->

 
            
            
        </section>
        <!-- End Destacados - Características  -->        
        
        
        <!-- Video Area -->
<?php         
//Extrae VIdeo del evento si es qeu existe
$respuestaVideoEvento=Consultas::videoEvento($idEvento);   
if (empty($respuestaVideoEvento["embed_multi"])){
//    echo  'No Hay Video';
}else{ 
    echo '
        <section class="home-contact-area home-2-contact ptb-35">
            <div class="container"> 

                <div class="row">
                    <div class="col-lg-2 col-md-2"></div>
                    <div class="col-lg-8 col-md-8">
                        <div class="content">
                            <iframe width="100%" height="430px" src="https://www.youtube.com/embed/'.$respuestaVideoEvento["embed_multi"].'" title="'.$respuesta[0]["name_event"].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>

                    
                </div>
            </div>
        </section>';
 
}//fin del else de VIDEO
?>        
        <!-- End Video Area -->        
        
        
        <!--  Eventos  Recoemndados Artistas Proyectos  Espacios  -->
<?php        

        echo "ID User: ".$respuesta[0]["id_user"];
        echo "<br>Género: ".$resuestaBuscaGenero["name_genre"];
        echo "<br>ID Género: ".$resuestaBuscaGenero["id_genre"];
?>        
        <section class="home-case ptb-35">
            <div class="container">
                <div class="section-title">
                    <!--<span>Descubre</span>-->
                    <!--<h2>Conoce todo lo que EchoMusic tiene para ti</h2>-->
                    <h2>Eventos recomendados</h2>
                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse.</p>-->
                </div>

                <div class="case">
                    <ul class="all-case">
                        <!--<li class="active" data-filter="*"><span>Todo</span></li>-->
                        <li class="active" data-filter="*"><span>Presencial</span></li>
                        <li data-filter=".dev"><span>Online</span></li> 
                    </ul>
                </div>


                <div class="row case-list">   

                    <?php
//                    Si el artista no tiene género, buscamos en una tabla de generos aleatoria
//                    mostrar recomendaciones cuando artistas no tenga definido estilo musical buscar solo por región.
                    if(empty($idGenero)){
                        $eventosRelacionados = Consultas::eventosRelacionadosRegion($respuesta[0]["id_region"]);
                    }else{
//                        Si no tiene género envoio el ID región para recomendar´por region 
                        $eventosRelacionados = Consultas::eventosRelacionadosGenero($idGenero);
                    }
                    
                    #Notar que es lo mismo que hacer
                    # date("Y-m-d H:i:s")                                
                    for ($k = 0; $k < count($eventosRelacionados); $k++) {                        
                        //Busca CIudad y Región
                        $respuestaCiudadRegion = Consultas::buscaCiudadRegion($eventosRelacionados[$k]["id_city"], $eventosRelacionados[$k]["id_region"]);
                    
                        $fechaEntera1 = strtotime($eventosRelacionados[$k]["date_event"]);
                        $anio = date("Y", $fechaEntera1);
                        $mes = date("m", $fechaEntera1);
                        $dia = date("d", $fechaEntera1);

                        $hora = date("H", $fechaEntera1);
                        $minutos = date("i", $fechaEntera1);

                        if (preg_match("/|\b/", $eventosRelacionados[$k]["IMG"])) {
                            $fotos = explode("|", $eventosRelacionados[$k]["IMG"]);
                            //var_dump($fotos);
                            $total = count($fotos) - 1;
                            $indice = mt_rand(0, intval($total));
                            $img = substr($fotos[0], 16);
                            //echo $img."<br>";
                            //echo "verdadero";
                        } else {
                            $img = substr($eventosRelacionados[$k]["IMG"], 16);
                            //echo "falso";
                        }
                        echo '                    
                    <div class="col-lg-4 col-sm-6 item cyber">
                        <div class="single-case">
                            <div class="case-img ">
                                <a href="eventos.php?e=' . $eventosRelacionados[$k]["id_event"] . '">
                                    <img class="imgEvent tamano-1" src="https://echomusic.cl/images/events/' . $eventosRelacionados[$k]["img"] . '.jpg" height="100%"  alt="case"/> 
                                </a>
                            </div>

                            <div class="content">
                                <!--Titulo-->
                                <div class="row text-center">
                                    <div class="col-12"> 
                                        <a href="eventos.php?e=' . $eventosRelacionados[$k]["id_event"] . '"> <h3>' . $eventosRelacionados[$k]["name_event"] . '</h3></a>
                                    </div> 
                                </div>
                                
                                <!--Entrada Fecha hora Costo Compra-->
                                <div class="row text-center ">
                                    <div class="col-lg-6 col-sm-6">
                                        <p>' . $dia . '-' . $mes . '-' . $anio . ' | ' . $hora . ':' . $minutos . ' hrs.</p>

                                        <a href="#" class="line-bnt"> 
                                        '.$respuestaCiudadRegion[0]["name_region"].', '.$respuestaCiudadRegion[0]["name_city"].'
                                        </a>
                                    </div>
                                    
                                    <div class="col-lg-6 col-sm-6">';
                                    if($eventosRelacionados[$k]["ticket_value"]==0 ){
                                        echo  '<h3>Gratuito</h3>
                                                <a href="eventos.php?e=' . $eventosRelacionados[$k]["id_event"] . '" class="box-btn">Reservar</a>';
                                    }else{
                                        echo  '<h4>$ ' .number_format( ($eventosRelacionados[$k]["ticket_value"]+$eventosRelacionados[$k]["ticket_commission"]), 0, ',', '.'). '</h4>
                                                <a href="eventos.php?e=' . $eventosRelacionados[$k]["id_event"] . '" class="box-btn">Comprar</a>';
                                    }
                                    
                                    echo '
                                    </div> 
                                </div>                                                                                               
                            </div>
                            
                        </div>
                    </div>';
                    }
                    ?>  
                </div>

                <div class="case-btn text-center">
                    <!--<p>  <a href="#">Ver más eventos</a></p>-->
                    <p>    <a href="#" class="box-btn">Ver más eventos</a></p>
                </div>
            </div>
        </section>
        <!-- End Case  Eventos Artistas Proyectos  Espacios  --> 

       
        
       
        <!-- Artistas - Características  -->
<!--        <section class="feature-area bg-color ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="contnet">
                            <div class="feature-tittle">
                                <span>Artistas</span>
                                <h2>Crea tu perfil de Artista y conoce todos los beneficios</h2>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt consectetur, beatae quod eaque reprehenderit non ab quibusdam doloribus voluptatibus! Voluptatum aspernatur quasi id dolore doloremque quo vero</p>
                            </div>

                            <ul>
                                <li>
                                    <i class="flaticon-correct"></i>
                                    Lorem ipsum dolor
                                </li>
                                <li>
                                    <i class="flaticon-correct"></i>
                                    Lorem ipsum dolor
                                </li>
                                <li>
                                    <i class="flaticon-correct"></i>
                                    Lorem ipsum dolor
                                </li>
                                <li>
                                    <i class="flaticon-correct"></i>
                                    Lorem ipsum dolor
                                </li>
                                <li>
                                    <i class="flaticon-correct"></i>
                                    Lorem ipsum dolor
                                </li>
                            </ul>
                            <a href="#" class="box-btn">Regístrate como Artista</a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="feature-img">
                            <img src="assets/images/bg/echomusic-isostipo-rock-guitarra-1.png" alt="Artistas Echomusic"/> 
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        <!-- End Artistas - Características  -->

        <!-- Team Area -->
<!--        <section class="home-team-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <span>Team Members</span>
                    <h2>People Who are Behind the Achievements</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse.</p>
                </div>

                <div class="home-team-slider owl-carousel owl-theme">
                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t1.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>John Smith</h3>
                            <p>Full Stack Developer</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t2.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Evana Doe</h3>
                            <p>Web Developer</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t3.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Bread Mc</h3>
                            <p>IT Consulting</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t4.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Maria Fread</h3>
                            <p>UI/UX Designer</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t1.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>John Smith</h3>
                            <p>Full Stack Developer</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t2.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Evana Doe</h3>
                            <p>Web Developer</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t3.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Bread Mc</h3>
                            <p>IT Consulting</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t4.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Maria Fread</h3>
                            <p>UI/UX Designer</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        <!-- End Team Area -->

        <!-- Start Client Area -->
<!--        <section class="client-area ptb-100 bg-color">
            <div class="container">
                <div class="section-title">
                    <span>Testimonials</span>
                    <h2>What Our Client’s Say</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A facilis vel consequatur tempora atque blanditiis exercitationem incidunt, alias corporis quam assumenda dicta.</p>
                </div>

                <div class="client-wrap owl-carousel owl-theme">
                    <div class="single-client">
                        <img src="assets/images/client/1.jpg" alt="img">

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem Ipsum is simply dummy text of the printing Quis suspendisse typesetting ipsum dolor sit amet,</p>

                        <h3>Steven Jony</h3>
                        <span>CEO of Company</span>
                    </div>
                    
                    <div class="single-client">
                        <img src="assets/images/client/2.jpg" alt="img">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem Ipsum is simply dummy text of the printing Quis suspendisse typesetting ipsum dolor sit amet,</p>

                        <h3>Omit Jacson</h3>
                        <span>Company Founder</span>
                    </div>
                </div>
            </div>
        </section>-->
        <!-- End Client Area -->

        <!-- Blog Area -->
<!--        <section class="home-blog-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <span>Blog Post</span>
                    <h2>Our Regular Blogs</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A facilis vel consequatur tempora atque blanditiis exercitationem incidunt, alias corporis quam assumenda dicta.</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/blog/1.jpg" alt="blog">
                                </a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        10 April 2020
                                    </li>
                                    <li>
                                        <a href="#">By Admin</a>
                                    </li>
                                </ul>
                                
                                <a href="blog-details.html">
                                    <h3>Joe’s Company Software Development Case</h3>
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>
                                
                                <a href="blog-details.html" class="line-bnt">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/blog/5.jpg" alt="blog">
                                </a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        10 April 2020
                                    </li>
                                    <li>
                                        <a href="#">By Admin</a>
                                    </li>
                                </ul>

                                <a href="blog-details.html">
                                    <h3>Temperature App UX Studies & Development Case</h3>
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>

                                <a href="blog-details.html" class="line-bnt">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/blog/3.jpg" alt="blog">
                                </a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        10 April 2020
                                    </li>
                                    <li>
                                        <a href="#">By Admin</a>
                                    </li>
                                </ul>

                                <a href="blog-details.html">
                                    <h3>IT Software Company Development Case</h3>
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>

                                <a href="blog-details.html" class="line-bnt">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-btn text-center">
                    <p>We Have More Usefull Blogs For You. <a href="blog.html">View More</a></p>
                </div>
            </div>
        </section>-->
        <!-- End Blog Area -->

        
            <!-- CTA -->
        <section class="home-cta-2-morado pt-100 pb-35">
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
                                <a href="#" class="box-btn text-center">CREA TU EVENTO</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2"></div>
                 </div>
            </div>
        </section>
        <!-- End CTA -->    
 
             
    <!--Footer-->
    <?php 
        include 'footer.php';
    ?>