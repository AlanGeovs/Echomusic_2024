<?php  
include "model/models.php";
include "header.php";

//Búsquedas de Crowdfunding
if (isset($_GET["c"])) {
    $id=$_GET["c"];
    if (!preg_match('/[0-9]/', $id)) {
        exit();
    }
    $respuesta=Consultas::detallesCrowdfunding($id);
}

$idUser =$respuesta[0]['id_user'];

$biografia=Consultas::bioArtistas($idUser);

//    BUscar nombre Ciudad Region
$respuestaCiudadRegion = Consultas::buscaCiudadRegion($respuesta[0]["id_city"], $respuesta[0]["id_region"] ) ; 

//Fecha
$fechaEntera = strtotime($respuesta[0]["project_date_end"]);
$anio = date("Y", $fechaEntera);
$mes = date("M", $fechaEntera);
$dia = date("d", $fechaEntera);
$diaSemana = date("D", $fechaEntera);

$hora = date("H", $fechaEntera);
$minutos = date("i", $fechaEntera); 
?>

    
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2><?php echo $respuesta[0]["project_title"]; ?></h2>
                    <ul>
                        <li><a href="index.php"> Inicio </a> </li>
                        <li><a href="artistas.php?a=<?php echo $respuesta[0]['id_user']; ?>"> <?php echo $respuesta[0]['nick_user']; ?> </a></li>
                        <li><a href="#"> Crowdfunding <?php echo $respuesta[0]["project_title"]; ?></a></li>  
                    </ul>
                </div>
            </div> 
        </div>
        <!-- End Page Title Area -->  
        
     
        <!-- CTA INICIO  -->
        <!--<section class="home-process-area pt-100 pb-70">-->
        <section class="home-cta-gris ptb-35">
            <div class="container">
                

                 <div class="row align-items-center choose-c justify-content-md-center">
                    
                    <div class="col-lg-2 col-sm-2">
<!--                        <div class="section-title ">  
                            <p style="font-size: 25px; padding-bottom: -15px;">Conoce más de </p>
                            <h2><?php echo $respuesta[0]['nick_user']; ?></h2> 
                        </div>-->
                    </div>
                    
                    <div class="col-lg-6 col-sm-6" style="vertical-align: middle; ">
                        <div class="content text-center">

                            <div class="row">
                                <div class="col-4 col-sm-4">
                                    <a href="artistas.php?a=<?php echo $respuesta[0]['id_user']; ?>">   
                                        <img style="height: 200px; width: 200px; border-radius: 50%;" class="responsiveArtista" src="https://echomusic.cl/images/avatars/<?php echo $respuesta[0]['id_user']; ?>.jpg" alt="descatado" /> 
                                    </a>
                                </div> 
                                <div class="col-8 col-sm-8">
                                    <p style="font-size: 20px;  ">Conoce más de </p>
                                    <h2><a href="artistas.php?a=<?php echo $respuesta[0]['id_user']; ?>"> <?php echo $respuesta[0]['nick_user']; ?> </a></h2>
                                    <p><span><?php echo $respuestaCiudadRegion[0]["name_city"]; ?> / Región <?php echo $respuestaCiudadRegion[0]["name_region"]; ?></span></p>
                                    <!--Biogración - Button to Open the Modal--> 
                                     <?php
                                        if (!empty($biografia[0]["bio_user"])) {
                                            ?>
                                            <a type="button" class="box-btn text-center" data-bs-toggle="modal" data-bs-target="#ModalBio">Ver Biografía</a>
                                            <?php
                                        } else {
                                            echo '<br>';
                                        }
                                    ?>
                                </div> 
                                
                               
                                
                            </div> 
                            
                        </div>
                    </div>
                     <div class="col-lg-2 col-sm-2">
<!--                         <div class="nav-btn">         
                              Biogración - Button to Open the Modal 
                                <?php
                                if (!empty($biografia[0]["bio_user"])) {
                                    ?>
                                    <a type="button" class="box-btn text-center" data-bs-toggle="modal" data-bs-target="#ModalBio">Ver Biografía</a>
                                    <?php
                                } else {
                                    echo '<br>';
                                }
                                ?> 
                         </div>-->
                     </div>
                 </div>
            </div>
        </section>
        <!-- End CTA INICIO -->         
        
        
        <!-- Crowdfunding 2 -->
        
<?php
    $respuestaCrowdfunding = Consultas::crowdfunding($respuesta[0]["id_user"]);
    $respuestaMultimediaCrow = Consultas::multimaediaCrowdfunding($respuesta[0]['id_project']);
    $respuestaTierCrow = Consultas::tierCrowdfunding($respuesta[0]['id_project']);

    $totalARecaudar = $respuestaCrowdfunding[0]["project_amount"];
    //  Extrae la suma de lo recaudado
    //        $sumaRecaudado = array_sum ( Consultas::recaudadoCrowdfunding( $respuestaCrowdfunding[0]["id_project"]) );
    $sumaRecaudado = Consultas::recaudadoCrowdfunding($respuestaCrowdfunding[0]["id_project"]);
    $recaudadoPorcentaje = Consultas::obtenerPorcentaje($sumaRecaudado[0], $totalARecaudar);
  
//Diferencia de Años, meses, dias, horas, segundos
//https://programacion.net/articulo/calcular_la_diferencia_entre_dos_fechas_con_php_1566    
//function get_format($df) { 
//        $str = '';
//        $str .= ($df->invert == 1) ? ' - ' : '';
//        if ($df->y > 0) {
//            // years
//            $str .= ($df->y > 1) ? $df->y . ' Years ' : $df->y . ' Year ';
//        } if ($df->m > 0) {
//            // month
//            $str .= ($df->m > 1) ? $df->m . ' Months ' : $df->m . ' Month ';
//        } if ($df->d > 0) {
//            // days
//            $str .= ($df->d > 1) ? $df->d . ' Days ' : $df->d . ' Day ';
//        } if ($df->h > 0) {
//            // hours
//            $str .= ($df->h > 1) ? $df->h . ' Hours ' : $df->h . ' Hour ';
//        } if ($df->i > 0) {
//            // minutes
//            $str .= ($df->i > 1) ? $df->i . ' Minutes ' : $df->i . ' Minute ';
//        } if ($df->s > 0) {
//            // seconds
//            $str .= ($df->s > 1) ? $df->s . ' Seconds ' : $df->s . ' Second ';
//        } 
//        echo $str;
//    }   
////    Diferencia de fechas
// 
//    $date1 = new DateTime("1990-04-02");
//    $date2 = new DateTime("now");
//    $diff = $date1->diff($date2);
//    echo get_format($diff);    
    
    
//Diferencia de dias
$fechaNueva = $anio."-".$mes."-".$dia;    
$date1 = new DateTime("$fechaNueva");
$date2 = new DateTime("now");
$diff = $date1->diff($date2);
// will output 2 days
//echo $diff->days . ' días ';    
?>
        
        <section class="pricing-area ptb-35">
            <div class="container">
                <div class="row align-items-center choose-c justify-content-md-center">
 

                    <div class="home-2-contact col-lg-8">                       
                        <div class="content"> 
                            <div class="row">
                                <!--img-->
                                <div class="col-12 col-sm-7  choose-img">  
                                    <!--<img src="assets/images/avatars/13.jpg" alt="choose" width="350px" />-->
                                    <iframe width="450" height="290" src="https://www.youtube.com/embed/<?php echo $respuestaMultimediaCrow[0]['project_multimedia_name']; ?>" title="<?php echo $respuesta[0]['nick_user']." - ".$respuesta[0]['project_title']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>
                                <!--Descripción-->
                                <div class="col-12 col-sm-5" style="vertical-align: middle;">
                                    <i class="flaticon-calendar"></i> &nbsp; <b>Plazo de ejecución</b> <?php echo $diaSemana.' '.$dia.' de '.$mes.', '.$anio; ?> 
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
                                    <p style="font-size: 11px;">$<?php echo number_format($sumaRecaudado[0]). " de $".number_format($totalARecaudar)." del total recaudado."; ?></p>
                                    <div class="text-center">
                                        
                                        <a href="#recompensas" class="btn btn-outline-success btn-lg position-relative">
                                            Patrocinar
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                               <?php echo  $diff->days; ?> días restantes
                                                <span class="visually-hidden">unread messages</span>
                                            </span>                                       
                                        </a>
                                        
<!--                                        <button type="button" class="btn btn-primary position-relative">
                                            Patrocinar
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                99 dias restantes
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        </button>-->
                                    </div>
                                    <div class=" ">
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
                            <!--fin del Row-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Technology Area -->
        
        
                       
        
        <!-- Acordeon.........--> 
        <section class="  ">
            <div class="container   ">
                <div class="row  align-items-center choose-c justify-content-md-center">
 

                    <div class="home-2-contact col-lg-6">                       
                        <div class="content"> 
                            <div class="row">
                             
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                               <i class="flaticon-info"></i> &nbsp;  Descripción 
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p> <?php echo $respuesta[0]["project_desc"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                               <i class="flaticon-info"></i> &nbsp;   Preguntas
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Aún no cuenta con preguntas.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                               <i class="flaticon-award"></i>&nbsp;    Avances
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Aún no hay avances.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>                
                
                
                
                </div>
            </div>

        </section>
        <!-- End Video Area ******************************************** -->            
        

        <!-- Sección flotante ****************************************** --> 
<!--        <section class="bg-color ptb-10">
            <div class="container bg-color pb-70  ">
                <div class="row  align-items-center choose-c justify-content-md-center">

                    <div class="section-title ">

                        <h2>Videos</h2>

                    </div> 

                    <div class="home-2-contact col-lg-10">                       
                        <div class="content"> 
                            <div class="row">
                                img
                                <div class="col-12 col-sm-6  choose-img">  
                                    <img src="assets/images/avatars/13.jpg" alt="choose" width="350px" />

                                </div>
                                Descripción
                                <div class="col-12 col-sm-6" style="vertical-align: middle;">
                                    <ul>
                                        <li>
                                            EP Sinceridad 
                                        </li> 
                                    </ul>

                                    <a href=" ">
                                        <h3>Cari Monteci</h3>
                                    </a>

                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>

                                    <a href=" " class="box-btn">Patrocinar</a>
                                </div>
                            </div>
                            fin del Row
                        </div>
                    </div>
                </div>
            </div>

        </section>-->
        <!-- End Video Area ******************************************** -->    
        
         
        
        
      

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

        
        <!-- Crowdfunding 1-->
<!--        <section class="home-blog-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <span>Blog Post</span>
                    <h2>Crowdfunding</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A facilis vel consequatur tempora atque blanditiis exercitationem incidunt, alias corporis quam assumenda dicta.</p>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6"></div>
                    <div class="col-lg-6 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="#">
                                    <img src="assets/images/avatars/13.jpg" alt=""/> 
                                </a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        EP Sinceridad 
                                    </li> 
                                </ul>
                                
                                <a href=" ">
                                    <h3>Cari Monteci</h3>
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>
                                
                                <a href=" " class="box-btn">Patrocinar</a>
                            </div>
                        </div>
                    </div> 
 
                </div> 
            </div>
        </section>-->
        <!-- End Blog Area -->


        
        
        <!-- CTA -->
        <!--<section class="home-process-area pt-100 pb-70">-->
<!--        <section class="home-cta-3-naranja pt-100 pb-70">
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
                                <a href="#" class="box-btn text-center">Crea tu proyecto</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2"></div>
                 </div>
            </div>
        </section>-->
        <!-- End CTA -->  
        
        
        <section class="home-team-area  ">
            <div class="container"> 

                <div class="home-team-slider owl-carousel owl-theme">

<!--                    <div class="single-team">
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
                    </div>        -->
                    

                    <!--TIERS Tarifas Bucle-->
                    <?php
                    for ($i = 0; $i < count($respuestaTierCrow); $i++) {
                        ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="#">
                                        <img style="height: 200px; width: 200px; border-radius: 50%;" class="responsiveArtista" src="https://echomusic.cl/images/avatars/<?php echo $respuesta[0]['id_user']; ?>.jpg" alt="descatado" />  
                                    </a>
                                </div>

                                <div class="pricing-top-heading">
                                    <h3><?php echo $respuestaTierCrow[$i]['tier_title']; ?></h3>
                                    <!--<p><?php echo $respuestaTierCrow[$i]['tier_desc']; ?></p>-->
                                </div> 
                                <h3>$<?php echo number_format($respuestaTierCrow[$i]['tier_amount']); ?></h3>
                                <ul  style="  margin: 0 auto 10px;" > 
                                    <li> <i class="bx bx-gift"></i> <?php echo $respuestaTierCrow[$i]['t_reward_01']; ?> </li> 
                                    <li> <i class="bx bx-gift"></i> <?php echo $respuestaTierCrow[$i]['t_reward_02']; ?> </li> 
                                    <li> <i class="bx bx-gift"></i> <?php echo $respuestaTierCrow[$i]['t_reward_03']; ?> </li> 

                                </ul>
                                <div style="  margin: 0 auto 10px;">
                                    <i class="bx bx-arrow-to-right"></i><a type="button" class=" text-center" data-bs-toggle="modal" data-bs-target="#ModalRecompensa<?php echo $i; ?>">Ver todas las recompensas</a><br> 
                                </div>
                                <div>
                                    <a class="box-btn" href="pago_crowdfunding.php?c=<?php echo $id; ?>&t=<?php echo $respuestaTierCrow[$i]['id_tier']; ?>">
                                        Colaborar
                                    </a>   
                                </div>
                               
                                
                            </div>
                        </div> 
                
                    
                    
    <!-- MODAL Croudfunding Recompensas  -->
                        <div class="modal" id="ModalRecompensa<?php echo $i; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $respuestaTierCrow[$i]['tier_title']; ?> </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body"> 
                                        <p style="text-align: left;"><?php echo $respuestaTierCrow[$i]['tier_desc']; ?></p> 
                                        <ul>
                                            
                                        <?php 
                                        for ($j = 1; $j <= 4; $j++) {
                                            $t_reward_num = 't_reward_0' . $j;
                                            ?>
                                            <?php if (!empty($respuestaTierCrow[$i][$t_reward_num])) { ?> 
                                            <li> <i class="bx bx-gift"></i>  <?php echo $respuestaTierCrow[$i][$t_reward_num]; ?> </li>

                                                    <?php
                                                } //fin del IF
                                            } // fin del FOR
                                            ?>   
                                                
                                        </ul> 
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>                    
    <!-- FINAL MODAL Croudfunding Recompensas  -->                    
                    
                        <?php
                     } //fin del FOR
                    ?>


                </div>
            </div>

        </section>
        
        
        <!--  Tarifas Recompensas  Area -->
        <section class="home-blog-area ptb-100" id="recompensas">
            <div class="container">
<!--                <div class="section-title">
                    <span>What We Offer</span>
                    <h2>Tarifas</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ipsum suspendisse.</p>
                </div>-->
                
                <!--Tarifas formato blog-->
                
                 
                <div class="row text-center pb-35">
                    <h2>Recompensas</h2>
                </div>
                <div class="row">
                    
                    <!--TIERS Tarifas Bucle-->
                    <?php
                    for ($i = 0; $i < count($respuestaTierCrow); $i++) {
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="#">
                                        <img style="height: 200px; width: 200px; border-radius: 50%;" class="responsiveArtista" src="https://echomusic.cl/images/avatars/<?php echo $respuesta[0]['id_user']; ?>.jpg" alt="descatado" />  
                                    </a>
                                </div>

                                <div class="pricing-top-heading">
                                    <h3><?php echo $respuestaTierCrow[$i]['tier_title']; ?></h3>
                                    <!--<p><?php echo $respuestaTierCrow[$i]['tier_desc']; ?></p>-->
                                </div> 
                                <h3>$<?php echo number_format($respuestaTierCrow[$i]['tier_amount']); ?></h3>
                                <ul  style="  margin: 0 auto 10px;" > 
                                    <li> <i class="bx bx-gift"></i> <?php echo $respuestaTierCrow[$i]['t_reward_01']; ?> </li> 
                                    <li> <i class="bx bx-gift"></i> <?php echo $respuestaTierCrow[$i]['t_reward_02']; ?> </li> 
                                    <li> <i class="bx bx-gift"></i> <?php echo $respuestaTierCrow[$i]['t_reward_03']; ?> </li> 

                                </ul>
                                <div style="  margin: 0 auto 10px;">
                                    <i class="bx bx-arrow-to-right"></i><a type="button" class=" text-center" data-bs-toggle="modal" data-bs-target="#ModalRecompensa<?php echo $i; ?>">Ver todas las recompensas</a><br> 
                                </div>
                                <div>
                                    <a class="box-btn" href="pago_crowdfunding.php?c=<?php echo $id; ?>&t=<?php echo $respuestaTierCrow[$i]['id_tier']; ?>">
                                        Colaborar
                                    </a>   
                                </div>
                               
                                
                            </div>
                        </div> 
                    
                    
    <!-- MODAL Croudfunding Recompensas  -->
                        <div class="modal" id="ModalRecompensa<?php echo $i; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $respuestaTierCrow[$i]['tier_title']; ?> </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body"> 
                                        <p style="text-align: left;"><?php echo $respuestaTierCrow[$i]['tier_desc']; ?></p> 
                                        <ul>
                                            
                                        <?php 
                                        for ($j = 1; $j <= 4; $j++) {
                                            $t_reward_num = 't_reward_0' . $j;
                                            ?>
                                            <?php if (!empty($respuestaTierCrow[$i][$t_reward_num])) { ?> 
                                            <li> <i class="bx bx-gift"></i>  <?php echo $respuestaTierCrow[$i][$t_reward_num]; ?> </li>

                                                    <?php
                                                } //fin del IF
                                            } // fin del FOR
                                            ?>   
                                                
                                        </ul> 
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>                    
    <!-- FINAL MODAL Croudfunding Recompensas  -->                    
                    
                        <?php
                     } //fin del FOR
                    ?>
                      
<!--                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/bg/fondo-precios-1-morado-min.jpg" alt=""/> 
                                </a>
                            </div>

                            <div class="pricing-top-heading">
                                <h3>EP Físico</h3>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                            </div>
                            <h3>$3.000</h3>
                            <ul>
                                <li>
                                    <i class="bx bx-badge-check"></i>
                                    100 colaboradores
                                </li>  
                            </ul>
                            <a class="box-btn" href="shared-hosting.html">
                                Colaborar
                            </a>  
                        </div>
                    </div> -->
                   
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
                <div class="home-2-contact ">            
                    <div class="content justify-content-md-center text-center">
                        <div class="row "> 
                            <div class="col-12 col-sm-12 ">
                                <a href="" class="">Denunciar</a> | <a href="" class=" ">Preguntas Frecuentes</a> | <a href="" class=" ">Términos y Condiciones Crowdfunding</a>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        </section>
        <!-- End Tarifas Area -->      
        
        
        <!-- Algunos proyectos similares--->
        <section class="home-blog-area bg-color ptb-100">
            <div class="container">
                <div class="section-title">
                    <span>Algunos</span>
                    <h2>Proyectos</h2>    <span>similares</span>                 
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/avatars/13.jpg" alt="blog"/> 
                                </a>
                            </div>

                            <div class="content">
                                <a href="#">
                                    <h3>Ep Sincerdidad</h3>
                                </a>
                                <ul> 
                                    <li>
                                        <a href="#">Cari Monteci</a>
                                    </li>
                                </ul>
                                
                                
                                <p>Primer Disco Ep que contiene 5 canciones inéditas compuestas por Cari Monteci. Ep que será lanzado durante este año 2022.</p>
                                
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    
                                </div>
                                <div class="text-center">
                                    <p style="font-size: 11px;">$100.000 de $3.500.000 del total recaudado.</p>
                                    <a href="#" class="box-btn text-center">Patrocinar</a>
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
                                <a href="#">
                                    <h3>Ep Sincerdidad</h3>
                                </a>
                                <ul> 
                                    <li>
                                        <a href="#">Cari Monteci</a>
                                    </li>
                                </ul>
                                
                                
                                <p>Primer Disco Ep que contiene 5 canciones inéditas compuestas por Cari Monteci. Ep que será lanzado durante este año 2022.</p>
                                
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    
                                </div>
                                <div class="text-center">
                                    <p style="font-size: 11px;">$1.750.000 de $3.500.000 del total recaudado.</p>
                                    <a href="#" class="box-btn text-center">Patrocinar</a>
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
                                <a href="#">
                                    <h3>Ep Sincerdidad</h3>
                                </a>
                                <ul> 
                                    <li>
                                        <a href="#">Cari Monteci</a>
                                    </li>
                                </ul>
                                
                                
                                <p>Primer Disco Ep que contiene 5 canciones inéditas compuestas por Cari Monteci. Ep que será lanzado durante este año 2022.</p>
                                
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    
                                </div>
                                <div class="text-center">
                                    <p style="font-size: 11px;">$2.100.000 de $3.500.000 del total recaudado.</p>
                                    <a href="#" class="box-btn text-center">Patrocinar</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>  
                    
                </div>
                 
            </div>
        </section>
        <!-- End Algunos proyectos similares-->           
 
                
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
                                <a href="#" class="box-btn text-center">Crea tu proyecto</a> 
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
    include 'modal.php';
    include 'footer.php';
    ?>