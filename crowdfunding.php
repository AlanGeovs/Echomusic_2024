<?php
include "model/models.php";
include "header.php";

//Búsquedas de Crowdfunding
if (isset($_GET["c"])) {
    $id = $_GET["c"];
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
$fechaNueva = $anio . "-" . $mes . "-" . $dia;
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
                            <iframe width="450" height="290" src="https://www.youtube.com/embed/<?php echo $respuestaMultimediaCrow[0]['project_multimedia_name']; ?>" title="<?php echo $respuesta[0]['nick_user'] . " - " . $respuesta[0]['project_title']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                        <!--Descripción-->
                        <div class="col-12 col-sm-5" style="vertical-align: middle;">
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
                                <span style="text-align: right;">

                                    <ul class="social">
                                        <li>
                                            <p>Comparte</p>
                                        </li>
                                        <li> <a href="#" target="_blank"><i class='bx bxl-whatsapp'></i></a></li>
                                        <li> <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                                        <li> <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a> </li>
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
                                        <i class="flaticon-info"></i> &nbsp; Descripción
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
                                        <i class="flaticon-info"></i> &nbsp; Preguntas
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
                                        <i class="flaticon-award"></i>&nbsp; Avances
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
        <div class="row text-center pb-35">
            <br><br><br>
            <h2>Recompensas</h2>
        </div>

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
                        <ul style="  margin: 0 auto 10px;">
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
                <!--                        <div class="modal" id="ModalRecompensa<?php echo $i; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                     Modal Header 
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $respuestaTierCrow[$i]['tier_title']; ?> </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                     Modal body 
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

                                     Modal footer 
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>                    -->
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
                        <ul style="  margin: 0 auto 10px;">
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
                <!--                        <div class="modal" id="ModalRecompensa<?php echo $i; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                     Modal Header 
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $respuestaTierCrow[$i]['tier_title']; ?> </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                     Modal body 
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

                                     Modal footer 
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>                    -->
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
                        <a href="mailto:contacto@echomusic.cl" class="">Denunciar</a> |
                        <a href="" class=" ">FAQ's </a> |
                        <a href="#" data-bs-toggle="modal" data-bs-target="#crowdfundingTosModal">Leer Términos y Condiciones Crowdfunding</a>



                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- End Tarifas Area -->


<!--         Algunos proyectos similares-
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
         End Algunos proyectos similares           
 -->

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
                        <a type="button" class="box-btn text-center" data-bs-toggle="modal" data-bs-target="#ModalTipodeRegistro">
                            <i class="bx bxs-log-out"></i> Crea tu proyecto</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2"></div>
        </div>
    </div>
</section>
<!-- End CTA -->



<!-- Modal Términos y Condiciones Crowdfunding -->
<div class="modal fade" id="crowdfundingTosModal" tabindex="-1" aria-labelledby="crowdfundingTosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Términos de uso para la creación de una campaña de recaudación de Fondos "Crowdfunding"</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body overflow-auto">

                <h3 class="font-weight-bold">1. Le damos la bienvenida a campaña de recaudación de Fondos "Crowdfunding" de ECHOMUSIC.</h3>

                <p>Las presentes condiciones de uso regulan el acceso o uso que Ud. haga, como persona natural, desde Chile, de la aplicación móvil, página web, contenidos y servicios puestos a disposición por ECHOMUSIC SPA, RUT N° 77.287.293-3, en adelante ECHOMUSIC SPA, sociedad por acciones constituida en Chile, con domicilio, para todos los efectos legales, en calle Canadá N° 253, comuna de Providencia, Región Metropolitana, Chile, representada legalmente por don Marcelo René Saavedra Toro, RUT N° 13.831.770-6, y por don César Antonio Sepúlveda Swidersky, RUT N° 13.462.495-7, específicamente las que se materialicen a través de la plataforma electrónica ECHOMUSIC disponible en www.ECHOMUSIC.cl y en la aplicación para dispositivos móviles “ECHOMUSICAPP”, operada y de propiedad de dicha empresa</p>

                <p>Al usar este sitio web www.ECHOMUSIC.cl, acepta las presentes normas legalmente vinculantes los "Términos y Condiciones y Política de Privacidad y se compromete a seguir el resto de normas incluidas en el Sitio como, por ejemplo, Reglas de la comunidad y normas para iniciar proyectos en la campaña de recaudación de fondos en adelante "Crowdfunding" que se pone a disposición en la página www.echomusic.cl.</p>

                <p>Cada vez que exista una modificación en los Términos y Condiciones, será informado de los cambios que se realicen, esto será comunicado mediante un aviso en el sitio www.echomusic.cl o a través de un correo electrónico. Cualquier modificación a los Términos y Condiciones serán informadas con anticipación a su entrada en vigor, si un usuario registrado en www.echomusic.cl, sigue utilizando el sitio después de realizada una modificación, se considerará que acepta los nuevos Términos y Condiciones y sus modificaciones.</p>

                <h3 class="font-weight-bold">2. Creación de una cuenta para una campaña de recaudación de Fondos "Crowdfunding" de ECHOMUSIC.</h3>

                <p>Para acceder a una campaña de recaudación de Fondos "Crowdfunding" debe estar previamente registrado como un usuario artista en www.echomusic.cl aceptando los Términos y Condiciones estipulados para ello, y proveer la información personal necesaria para la creación de su respectivo perfil de usuario, se exigirá que los datos proporcionados sean exactos, veraces y completos, está estrictamente prohibido suplantar la identidad de otra persona, o elegir nombres ofensivos o que atenten los derechos de terceros. ECHOMUSIC se reserva el derecho de cancelar su cuenta, por el incumplimiento de estas normas.</p>

                <p>Cada usuario registrado es responsable de la actividad generada en su cuenta y de mantener y cuidar su contraseña. </p>

                <p>Para la creación de una cuenta, el usuario debe tener al menos 18 años, en caso de ser el usuario menor de 18 años, éste debe contar con la autorización notarial de su madre, padre, apoderado o tutor legal que tenga el cuidado personal de éste, según corresponda, donde expresamente consienta en autorizar su inscripción y registro en la presente aplicación y pagina web. Este documento debe ser remitido a ECHOMUSIC SPA, conjuntamente con copia de la cédula de identidad del menor.</p>

                <h3 class="font-weight-bold">3. Prohibiciones en el uso de una campaña de recaudación de Fondos "Crowdfunding" de ECHOMUSIC.</h3>

                <p>El sitio www.echomusic.cl pone a disposición una serie de herramientas y soluciones digitales para el desarrollo de la carrera musical de artistas independientes en sus etapas tempranas o cualquier artista que requiera de ellas, es por esto que en ECHOMUSIC promueve valores como el respeto, dignidad y privacidad de las personas, y en general normas de buen comportamiento entre los usuarios, es por eso que se exige no realizar las siguientes acciones:</p>

                <ol class="list-group list-group-numbered">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">a)</div>
                            Respetar los Términos y Condiciones y Política de Privacidad aceptados en el registro de usuario de la plataforma.
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">b)</div>
                            b) No se debe incumplir la ley vigente, y no realizar acciones que atente contra los derechos de otros usuarios registrados en el sitio www.echomusic.cl.
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">c)</div>
                            Esta totalmente prohibido publicar en el sitio www.echomusic.cl información falsa o inexacta, que engañe a otros usuarios que puedan o quieran interactuar en la plataforma.
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">d)</div>
                            No ofrecer artículos que se encuentren prohibidos en nuestra legislación vigente o que atenten contra los Términos y Condiciones y Política de Privacidad del sitio www.echomusic.cl.
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">e)</div>
                            Esta prohibido realizar acciones de acoso, acciones ofensivas, difamatorias o de dolo a otros usuarios, esta actitud reserva el derecho a ECHOMUSIC de cancelar su cuenta de usuario.
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">f)</div>
                            Está prohibido el envío de software, códigos, películas o programas creados para interferir en el correcto funcionamiento del sitio www.echomusic.cl, ya sea a los usuarios registrados como al sitio.
                        </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">g)</div>
                            Está prohibido el uso ilícito de la información de carácter personal de los usuarios registrados en www.ECHOMUSIC.cl, al realizar una campaña de recaudación de fondos "Crowdfunding" recibirá la información de sus patrocinadores, como nombre, dirección, teléfono y correo electrónico, con el fin de mantenerlo informado de quienes están patrocinando su campaña de "Crowdfunding".
                        </div>
                    </li>

                </ol>
                <br>

                <h3 class="font-weight-bold">4. Funcionamiento de la Creación de una campaña de recaudación de Fondos “Crowdfunding” de ECHOMUSIC.</h3>

                <p>El sitio www.echomusic.cl pone a disposición dentro de su plataforma un espacio para que los músicos y DJs puedan financiar sus proyectos musicales a través de la recaudación de fondos por parte de un financiadores que llamaremos “Patrocinadores”, entre los proyectos a financiar podemos mencionar a modo de ejemplo, los siguientes: </p>

                <ol class="list-group list-group-numbered">
                    <li class="list-group-item">Grabación de un EP</li>
                    <li class="list-group-item">Grabación de un Álbum</li>
                    <li class="list-group-item">Grabación y Producción de un video Clip</li>
                    <li class="list-group-item">Realización de Shows</li>
                    <li class="list-group-item">Otros a fin</li>
                </ol>
                <br>

                <p>Cuando un artista registrado en www.echomisic.cl crea y publica un proyecto en el sitio, está convocando e invitando a otras personas a formalizar un contrato con él. Por otra parte cualquier persona que patrocine o financie una campaña o proyecto está aceptando la oferta del creador y, por tanto, dicho contrato.
                    Es muy importante tener total conocimiento y claridad de que ECHOMUSIC no es una de las partes de este contrato, ECHOMUSIC solo pone a disposición su plataforma para facilitar al artista la realización de su recaudación de fondos o “Crowdfunding”. El contrato es un acuerdo jurídico directo entre los artistas creadores de una campaña de recaudación de Fondos “Crowfunding” y sus “Patrocinadores”. Estos son los términos que rigen dicho contrato:</p>

                <p>El músico independiente o DJ define un proyecto a financiar, monto, plazo de campaña y recompensas. El financiador realiza un aporte voluntario o definido según las recompensas. Si el monto a financiar es completado por uno o varios patrocinadores y el plazo de ejecución es cumplido, se procede a cerrar el proceso. </p>

                <p>Cuando un proyecto de recaudación de fondos “Crowdfunding” es finalizado en buenos términos y este ha recibido todo el financiamiento requerido, ECHOMUSIC entregara los fondos recaudados al artista descontando la comisión por el uso de la plataforma ascendente a un 5% + IVA del monto recaudado, descontando adicionalmente un 3% + IVA correspondiente al costo de la pasarela de pago, inmediatamente y posterior a la entrega de los fondos por parte de ECHOMUSIC, el artista y creador del “Crowdfunding” debe realizar el proyecto que dio origen a la recaudación de Fondos o Crowdfunding, una vez finalizado, y en los plazos pre establecidos, deberá entregar todas las recompensas comprometidas al momento de la creación del proyecto Crowdfunding, una vez entregadas las recompensas, se considerará que ya ha cumplido con las obligaciones acordadas con sus patrocinadores.</p>

                <p>Durante todo el tiempo que dure el proceso de ejecución del proyecto ya financiado, los artistas creadores del “Crowdfunding” prometen a sus patrocinadores el más alto nivel de esfuerzo, sinceridad en la comunicación y su dedicación para que el proyecto llegue a buen término de acuerdo a lo planificado al momento de la creación del proyecto. Por otra parte, los “Patrocinadores” deberán comprender y tener absoluta claridad de que, cuando se patrocinan un proyecto, están ayudando y participando en la creación de algo nuevo y original, y no adquiriendo algo que ya existe. Pueden producirse cambios o retrasos, o la posibilidad de ocurra algo que impida al creador terminar el proyecto ya sea por fuerza mayor o cualquier otro motivo incumpliendo con lo comprometido en la creación del proyecto.</p>

                <p>Si un artista no puede finalizar su proyecto y no logra entregar las recompensas comprometidas, se considerará que ha incumplido sus obligaciones básicas de conformidad con el presente acuerdo. Para subsanar esta situación, deberá realizar todos los esfuerzos posibles para encontrar otra manera de lograr la mejor conclusión posible del proyecto para los patrocinadores. Un creador que se encuentre en esta situación solo habrá subsanado la situación y satisfecho sus obligaciones con los patrocinadores si:</p>

                <ol class="list-group list-group-numbered">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">a)</div>
                            Publica una actualización que explique qué parte del trabajo se ha realizado, cómo se han empleado los fondos y qué le impide finalizar el proyecto según estaba previsto;
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">b)</div>
                            trabaja de forma diligente y de buena fe para llevar el proyecto a la mejor conclusión posible en un plazo de tiempo comunicado a los patrocinadores;
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">c)</div>
                            puede demostrar que ha empleado los fondos de la forma más apropiada y que ha realizado todo el esfuerzo posible para finalizar el proyecto según lo prometido;
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">d)</div>
                            ha sido sincero y no ha realizado ninguna afirmación falsa en sus comunicaciones con sus patrocinadores; y
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">e)</div>
                            ofrece devolver los fondos restantes (si los hubiere) a los patrocinadores que no hayan recibido su recompensa (proporcionalmente a los importes de cada contribución), o bien, les explica cómo se emplearán esos fondos para finalizar el proyecto de manera alternativa.
                        </div>
                    </li>

                </ol>
                <br>

                <p>El artista creador de una campaña de recaudación de fondos “Crowdfunding” es el único responsable de cumplir sus promesas en todo lo referente a su proyecto, ECHOMUSIC se exime de esta responsabilidad. Si no puede cumplir los términos de este acuerdo, estará sujeto a las acciones legales que puedan emprender los patrocinadores.</p>

                <p>Terminado el plazo de entrega de las recompensas asociadas a un proyecto, cada artista creador de un proyecto de “Crowdfunding” estará sometido a una evaluación por parte de sus patrocinadores para tomar conocimiento si las recompensas fueron entregadas de acuerdo a lo acordado. Si las recompensas fueron entregadas de forma correcta y en buenos términos el artista estará bien evaluado, de no ser así, el artista no podrá realizar futuras campañas de recaudación de fondos. </p>

                <h3 class="font-weight-bold">5. Funcionamiento del Financiamiento de una campaña de recaudación de Fondos “Crowdfunding” de ECHOMUSIC.</h3>

                <p>Términos y Condiciones que aplican al patrocinio de una Campaña de Recaudación de Fondos:</p>

                <p>Cualquier persona natural o jurídica que desee acceder y/o usar la plataforma ECHOMUSIC deberá sujetarse a estos Términos y Condiciones, junto con todas las demás políticas y principios que rigen a ECHOMUSIC, las que son aceptadas al momento de registrarse en la plataforma y que son incorporados al presente por referencia, y en caso de corresponder, deberá sujetarse a las Condiciones Particulares para Creadores de Proyectos y/o a las Condiciones Particulares para Patrocinadores (disponibles en términos y condiciones).</p>

                <p>Cualquier persona natural o jurídica podrá ser “Patrocinador” de un proyecto de Crowdfunding creado en la plataforma ECHOMUSIC, para ello deberá estar previamente registrado en la plataforma como usuario general o usuario artista y/o. músico, para ello deberá completar todos los campos del formulario de inscripción con datos válidos, se le exigirá que los datos proporcionados sean exactos, vigentes, veraces y completos, asimismo asumirá el compromiso de actualizar los Datos Personales cada vez que los mismos sufran modificaciones.
                    ECHOMUSIC podrá utilizar diversos medios para identificar a los usuarios registrados, pero no se responsabiliza por la certeza de los datos personales que sus usuarios registrados pongan a su disposición.</p>

                <p>Cualquier persona natural o jurídica que quiera patrocinar algún proyecto que se encuentre disponible en nuestra plataforma deberá ingresar al perfil de “Crowfunding” del artista al que desea patrocinar, luego deberá seleccionar el monto de dinero que quiere aportar de acuerdo a las recompensas dispuestas en la plataforma por el creador del proyecto.
                    Una vez haya elegido el monto a aportar, la plataforma lo direccionara hacia la pasarela de pagos dispuesta en la plataforma (Khipu, Transbank y las que hubiese en el futuro) para efectuar el pago.</p>

                <p>Una vez que un “Patrocinador” realiza un aporte a una campaña de recaudación de fondos o “Crowdfunding”, ECHOMUSIC custodiara los fondos aportados por el patrocinador hasta un plazo de 3 días hábiles después de terminado el plazo de recaudación de fondos, solo se le entregara el monto recaudado al artista, músico y/o creador de una campaña de “Crowdfunding” si el proyecto alcanza su objetivo de financiamiento en el plazo previamente establecido, descontando la comisión por el uso de la plataforma ascendente a un 5% + IVA del monto recaudado, descontando adicionalmente un 3% + IVA correspondiente al costo de la pasarela de pago.</p>

                <p>La fecha de entrega aproximada de las recompensas es una estimación del creador del proyecto sobre cuándo podrá entregarla, no una garantía de cumplimiento de dicho plazo. Esta estimación puede cambiar a medida que el creador trabaja en el proyecto. Pedimos a los creadores que determinen una fecha de entrega estimada que consideren que van a poder cumplir sin problemas y que comuniquen a los patrocinadores cualquier cambio que se pueda producir.</p>

                <p>Es posible que el creador necesite enviarle alguna pregunta en relación con su recompensa. Para entregar las recompensas, el creador podría necesitar determinados datos de los patrocinadores como, por ejemplo, su dirección o su talla de camiseta. Podrán solicitar esos datos una vez finalizada con éxito la campaña. Para recibir la recompensa, deberá facilitarle los datos pertinentes en un plazo razonable. Los creadores no deberían solicitar datos personales que no resulten necesarios para la entrega de recompensas y no solicitarán en ningún caso datos sensibles el número cedula de identidad o datos bancarios. Contacte con nosotros a través de la dirección soporte@ echomusic.cl en caso de recibir una solicitud de información aparentemente inadecuada o excesiva.</p>

                <p>ECHOMUSIC no realiza reembolsos. La responsabilidad de finalizar un proyecto ya financiado y en los plazos pres establecidos, es exclusiva del creador del proyecto. ECHOMUSIC no retiene fondos en nombre del creador, no puede garantizar el trabajo del creador y no ofrece reembolsos.</p>

                <p>En el caso que un proyecto no complete el financiamiento requerido por el creador, en el plazo establecido por el mismo, se cerrara el proyecto y ECHOMUSIC procederá a devolver a los patrocinadores los aportes de dinero entregados, descontando del monto aportado un 2%+IVA equivalente al costo de la pasarela de pago.
                    Para la correcta ejecución de la devolución del monto aportado por los Patrocinadores, ECHOMUSIC se contactara con cada patrocinador al correo electrónico registrado al momento de registrase en la plataforma ECHOMUSIC, y por esta vía solicitara los datos e información necesaria para la correcta devolución. </p>


                <h3 class="font-weight-bold">6. Comisión de ECHOMUSIC.</h3>

                <p>La creación de una cuenta en www. echomusic.cl es totalmente gratuita a todas las personas interesadas obtener una cuenta. Si un usuario registrado crea un proyecto que alcanza su objetivo de financiamiento, ECOMUSIC cobrará una comisión del 5% del monto recaudado más un 3% correspondiente al cobro de la pasarela de pago (Khipu, Transbank o las que hubiese en el futuro).</p>

                <p>ECHOMUSIC no cobrará ningún monto adicional a la indicada en el punto anterior, Si modificásemos las comisiones, lo comunicaremos oportunamente en el Sitio.</p>

                <h3 class="font-weight-bold">7. Derechos de Propiedad Intelectual e Industrial.</h3>

                <p>En virtud de lo dispuesto en la Ley N° 17.336, de Propiedad Intelectual, y otras normas afines, quedan expresamente prohibidas la reproducción, la distribución y la comunicación pública, incluida su modalidad de puesta a disposición, de todo o parte de los contenidos disponibles de la plataforma ECHOMUSIC, la aplicación móvil ECHOMUSICAPP y/o el sitio web www. echomusic.cl, con fines comerciales, en cualquier soporte y por cualquier medio técnico, sin la autorización expresa, específica y por escrito de ECHOMUSIC SPA. </p>

                <p>A su vez, el usuario asume el compromiso de respetar los derechos de propiedad intelectual e industrial de titularidad o que conciernan a ECHOMUSIC SPA. </p>

                <p>El usuario conoce y acepta que la totalidad de la plataforma ECHOMUSIC, la aplicación móvil ECHOMUSICAPP y el sitio web www. echomusic.cl, conteniendo, sin carácter exhaustivo ni taxativo, los textos, softwares, contenidos (incluyendo estructura, selección, ordenación y presentación de los mismos), podcasts, fotografías, imágenes, material audiovisual y gráficos, entre otros, están protegidos por derechos marcarios, derechos de autor y otros derechos legítimos, de acuerdo con la legislación chilena y los tratados internacionales en los que Chile es parte.</p>

                <p>En especial, los usuarios músicos, sean cantantes, bandas, cover bands, agrupaciones u otros, que ofrezcan sus servicios a través de la plataforma ECHOMUSIC, y que tributen, imiten o interpreten el catálogo musical de un determinado artista, músico, grupo musical o banda, sea que emulen o no sus estilos musicales y vocales, sus apariencias y sus estéticas audiovisuales, aceptan y declaran especialmente ser los titulares de todos los derechos patrimoniales de autor, o contar con todas las autorizaciones pertinentes de los titulares de los derechos patrimoniales de autor o de otros derechos de terceros involucrados, respecto del catálogo musical que ofrezcan mediante la plataforma ECHOMUSIC, la aplicación móvil ECHOMUSICAPP y/o el sitio web www. echomusic.cl, como los contenidos audiovisuales que incorporen en ellas. De acuerdo a ello, ECHOMUSIC SPA no asume ninguna responsabilidad a consecuencia de la eventual vulneración de derechos de terceros en que puedan incurrir los usuarios músicos a los que se refiere este párrafo ni tampoco respecto de los contenidos que éstos incorporen o introduzcan a dicha plataforma, aplicación y sitio web, sea en su perfil de usuario o en otros aplicativos.</p>

                <p>En el caso de que un usuario o un tercero consideren que se ha producido una violación de sus legítimos derechos de propiedad intelectual por la introducción de un determinado contenido en la plataforma ECHOMUSIC, la aplicación móvil ECHOMUSICAPP y/o el sitio web www. echomusic.cl, deberá notificar inmediatamente dicha circunstancia a ECHOMUSIC SPA, indicando: a) Datos personales del interesado titular de los derechos presuntamente infringidos, o indicar la representación con la que actúa, en caso de que la reclamación la presente un tercero distinto del interesado; b) Señalar singularizadamente los contenidos protegidos por los derechos de propiedad intelectual y su ubicación en la plataforma, aplicación móvil y/o web, la acreditación de los derechos de propiedad intelectual señalados, y la forma específica en que se ha producido la vulneración o violación de derechos; y c) Declaración expresa en la que el interesado se responsabiliza de la veracidad de las informaciones facilitadas en la notificación. Sobre la base de la respectiva comunicación, ECHOMUSIC SPA adoptará las medidas que se consideren pertinentes, oyendo previamente a todos los intervinientes, pudiendo, en definitiva, disponer la eliminación o remoción de los contenidos objetados. </p>

                <p>Asimismo, el usuario acepta y declara ser el titular de todos los derechos patrimoniales de autor, o contar con todas las autorizaciones pertinentes de los titulares de los derechos patrimoniales de autor, respecto de los contenidos que incorpore en la plataforma ECHOMUSIC, la aplicación móvil ECHOMUSICAPP y/o el sitio web www. echomusic.cl. Conforme a ello, <span class="font-weight-bold">ECHOMUSIC SPA no asume ninguna responsabilidad respecto de los contenidos que incorporen o introduzcan los usuarios a dicha plataforma, aplicación y sitio web.</span> Con todo, y en el caso de que un usuario o un tercero consideren que se ha producido una violación de sus legítimos derechos de propiedad intelectual por la introducción, en dicha plataforma, aplicación móvil y/o sitio web, de contenidos por parte de otro usuario, se seguirá el procedimiento indicado en el párrafo precedente. </p>

                <p>Asimismo, ECHOMUSIC SPA, en caso que un determinado usuario registrado en la plataforma ECHOMUSIC haya sido previamente eliminado, suspendido o dado de baja de otras plataformas o aplicaciones por vulneración de derechos patrimoniales de autor o por infracción de otros derechos de terceros, no asume ninguna responsabilidad respecto del actuar del mismo, en particular en acciones que impliquen nuevas transgresiones de derechos de titularidad de otros usuarios o terceros. Sin perjuicio de ello, cualquier usuario o persona podrá poner en conocimiento de ECHOMUSIC SPA el hecho de que un determinado usuario ha sido ya eliminado, suspendido o dado de baja en otra plataforma o aplicación o de cualquier otra vulneración de derechos en que ésta haya podido incurrir, debiendo, en tal caso, notificar inmediatamente dicha circunstancia a ECHOMUSIC SPA y seguirse el procedimiento señalado en el párrafo anteprecedente.</p>

                <p><span class="font-weight-bold">De igual forma, el usuario, en su calidad de titular de todos los derechos patrimoniales de autor, o contando de todas las autorizaciones pertinentes de los titulares de los derechos patrimoniales de autor, en su caso, cede a ECHOMUSIC SPA la totalidad de sus derechos patrimoniales de autor sobre los contenidos que haya incorporado en la plataforma (Ósea el artista registrado en la plataforma autoriza a ECHOMUSIC a disponer del material audiovisual en cualquier tipo</span> de formato subido a la página) ECHOMUSIC, la aplicación móvil ECHOMUSICAPP y/o el sitio web www. echomusic.cl, incluidos, pero sin limitarse, todos los derechos señalados en el artículo 18 de la Ley N° 17.336, de Propiedad Intelectual, y especialmente los derechos de radiodifusión, publicación, edición, traducción, distribución, comercialización, reproducción, comunicación pública, transformación y adaptación, en cualquier tipo de soporte conocido o por conocer y desarrollar, con el único objeto y finalidad de operar dichas plataforma, aplicación y sitio web y ofrecer las funcionalidades y facilidades de éstas a los usuarios y público en general.</p>

                <p>El Usuario Creador declara y garantiza que los proyectos que publique en ECHOMUSIC serán únicamente obras originales, creadas por él mismo y que de ningún modo se tratará de copias o reproducciones que violen derechos de propiedad intelectual de terceros. ECHOMUSIC podrán cancelar las cuentas de aquellos Usuarios Registrados que infrinjan cualquier derecho de propiedad intelectual de terceros.</p>

                <h3 class="font-weight-bold">8. Renuncias, Exclusión de Garantías y Limitación de Responsabilidad. </h3>

                <p>ECHOMUSIC SPA, a través de su plataforma ECHOMUSIC, disponible en la aplicación móvil ECHOMUSICAPP y en el sitio web www. echomusic.cl, no otorga ninguna garantía ni se hace responsable, en caso alguno, de los daños y perjuicios, de cualquier naturaleza que pudieran ser, y que pudieran generarse como causa de: </p>

                <ol class="list-group list-group-numbered">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">a)</div>
                            La falta de disponibilidad temporal y de mantenimiento y efectivo funcionamiento ininterrumpido de la plataforma ECHOMUSIC, aplicación móvil ECHOMUSICAPP y sitio web www. echomusic.cl, o de sus servicios y contenidos. Conforme a ello, ECHOMUSIC SPA no está en condiciones de garantizar que los servicios que ofrece se brindarán ininterrumpidamente o estarán libres de errores, sin perjuicio de la adopción de las medidas preventivas y correctivas razonables y oportunas que sean procedentes.
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">b)</div>
                            La existencia de malwares, programas maliciosos o lesivos en los contenidos;
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">c)</div>
                            El uso ilícito, negligente, fraudulento o contrario a este aviso legal, que realicen usuarios o terceros;
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">d)</div>
                            La falta de licitud, calidad, fiabilidad, utilidad y disponibilidad de los servicios prestados por terceros y puestos a disposición de los usuarios en la plataforma ECHOMUSIC, aplicación móvil ECHOMUSICAPP y sitio web www. echomusic.cl, sin perjuicio de la adopción, por parte de ECHOMUSIC SPA, de las medidas preventivas y correctivas razonables y oportunas que sean procedentes;
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">e)</div>
                            La mala, deficiente, negligente o dolosa prestación de los servicios por parte de los usuarios músicos creadores de proyectos “Crowfunding”, en el desarrollo de una campaña de recaudación de fondos “Crowfunding”, desde la plataforma ECHOMUSIC, aplicación móvil ECHOMUSICAPP y sitio web www. echomusic.cl, ni fuera de éstos, sin perjuicio de la adopción, por parte de ECHOMUSIC SPA, de las medidas preventivas y correctivas razonables y oportunas que sean procedentes. En este caso, la responsabilidad principal recaerá en los usuarios artista creador de la campaña de Crowfunding.
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">f)</div>
                            El retraso o la falta de ejecución, por parte de los usuarios músicos el desarrollo de una campaña de recaudación de fondos “Crowfunding”, de los servicios solicitados, resultante de causas que vayan más allá de una previsión y control razonable de ECHOMUSIC SPA. En este caso, la responsabilidad principal recaerá en los usuarios artista creador de la campaña de Crowfunding;
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="font-weight-bold">g)</div>
                            El uso ilícito, negligente, fraudulento o contrario a este aviso legal, que realicen los usuarios respecto del contenido o material, de cualquier tipo, que introduzcan o agreguen a la plataforma ECHOMUSIC, aplicación móvil ECHOMUSICAPP y/o sitio web www. echomusic.cl, y que vulnere los derechos de propiedad intelectual e industrial de titularidad o que conciernan a terceros, o que transgreda cualquier derecho de titularidad de otros usuario o terceros.
                        </div>
                    </li>

                </ol>
                <br>


            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>

        </div>
    </div>
</div>



<!--Footer-->
<?php
include 'modal.php';
include 'footer.php';
?>