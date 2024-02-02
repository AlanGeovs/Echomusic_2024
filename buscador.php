<?php
include "model/models.php";
include "header.php";

//Búsquedas desde la url-> buscador topheader
if (isset($_GET["r"])) {
    $id = $_GET["r"];
    //    if (!preg_match('/[0-9]/', $id)) {
    //        exit();
    //    }
    //    echo "<h1> " . $id . "</h1>";
    $eventosRelacionados = Consultas::eventosCarteleraBusqueda($id);
} else {
    //    echo "<h1>NADA</h1>";
    $eventosRelacionados = Consultas::ultimosEventos2();
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

$idEvento =  $respuesta[0]["id_event"];
$idUsuario = $respuesta[0]["id_user"];

//Buscar Género
$resuestaBuscaGenero = Consultas::buscarGenero($idUsuario);
$idGenero = $resuestaBuscaGenero["id_genre"];

//    BUscar nombre Ciudad Region
$respuestaEventoCiudadRegion = Consultas::buscaCiudadRegion($respuesta[0]["id_city"], $respuesta[0]["id_region"]);

?>

<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Búsqueda: <?php echo $id; ?></h2>
            <ul>
                <li> <a href="index.php"> Inicio </a> </li>
                <li> <a href="cartelera.php"> Cartelera</a> </li>
                <li class="active"><?php echo $id; ?></li>
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


<!--         Filtro  
        <section class="feature-area bg-color ptb-35">
            <div class="container">
                <div class="row align-items-center choose-c justify-content-md-center"> 
                    Filtro Avanzado
                    <div class="col-lg-12 col-sm-12 item  ">
                        <div class="single-case text-center">
                            <h4>Búsqueda avanzada</h4>  
                            <form id="form2" name="form2" method="POST" action="index.php">
                                <div class="col-12 row">  

                                    <div class="col-11">

                                        <table class="table">
                                            <thead>
                                                <tr class="filters">
                                                    <th>
                                                        <label  class="form-label">Evento o artista </label>
                                                        <input type="text" class="form-control" id="buscar" name="buscar" value="<?php // echo $_POST["buscar"]  
                                                                                                                                    ?>" >
                                                        <input type="text" class="form-control" id="buscar" name="buscar" value=" " >   
                                                    </th>
                                                    <th>
                                                        Tipo
                                                        <select id="assigned-tutor-filter" id="buscadepartamento" name="buscadepartamento" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                            <?php // if ($_POST["buscadepartamento"] != '') { 
                                                            ?>
                                                                <option value="//<?php // echo $_POST["buscadepartamento"]; 
                                                                                    ?>"><?php // echo $_POST["buscadepartamento"]; 
                                                                                                                                ?></option>
                                                            <?php // } 
                                                            ?>
                                                            <option value="">Todos</option>
                                                            <option value="Compras">Presencial</option>
                                                            <option value="Ventas">Online</option>
                                                            <option value="Alquileres">Alquileres</option>
                                                        </select>
                                                    </th> 

                                                    <th>
                                                        Fecha desde:
                                                        <input type="date" id="buscafechadesde" name="buscafechadesde" class="form-control mt-2" value="<?php echo $_POST["buscafechadesde"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                        <input type="date" id="buscafechadesde" name="buscafechadesde" class="form-control mt-2" value=" " style="border: #bababa 1px solid; color:#000000;" >
                                                    </th>
                                                    <th>
                                                        Fecha hasta:
                                                        <input type="date" id="buscafechahasta" name="buscafechahasta" class="form-control mt-2" value="<?php echo $_POST["buscafechahasta"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                        <input type="date" id="buscafechahasta" name="buscafechahasta" class="form-control mt-2" value=" " style="border: #bababa 1px solid; color:#000000;" >
                                                    </th>
                                                    <th>
                                                        Región
                                                        <select id="subject-filter" id="color" name="color" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                            <?php // if ($_POST["color"] != '') { 
                                                            ?>
                                                                <option value="<?php // echo $_POST["color"]; 
                                                                                ?>"><?php // echo $_POST["color"]; 
                                                                                                                    ?></option>
                                                            <?php // } 
                                                            ?>
                                                            <option value="">Todos</option>
                                                            <option style="color: blue;" value="Azul">Metropolitana</option>
                                                            <option style="color: red;" value="Rojo">Santiago</option>
                                                            <option style="color: orange;" value="Amarillo"></option>
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>


                                   

                                    <div class="col-1">
                                        <input type="submit" class="btn " value="Ver" style="margin-top: 38px; background-color: purple; color: white;">
                                    </div>
                                </div>


                                <?php
                                /* FILTRO de busqueda//////////////////////////////////////////// */
                                //                                if ($_POST['buscar'] == '') {
                                //                                    $_POST['buscar'] = ' ';
                                //                                }
                                //                                $aKeyword = explode(" ", $_POST['buscar']);
                                //
                                //                                if ($_POST["buscar"] == '' AND $_POST['buscadepartamento'] == '' AND $_POST['color'] == '' AND $_POST['buscafechadesde'] == '' AND $_POST['buscafechahasta'] == '' AND $_POST['buscapreciodesde'] == '' AND $_POST['buscapreciohasta'] == '') {
                                //                                    $query = "SELECT * FROM datos_usuario ";
                                //                                } else {
                                //
                                //
                                //                                    $query = "SELECT * FROM datos_usuario ";
                                //
                                //                                    if ($_POST["buscar"] != '') {
                                //                                        $query .= "WHERE (nombre LIKE LOWER('%" . $aKeyword[0] . "%') OR apellidos LIKE LOWER('%" . $aKeyword[0] . "%')) ";
                                //
                                //                                        for ($i = 1; $i < count($aKeyword); $i++) {
                                //                                            if (!empty($aKeyword[$i])) {
                                //                                                $query .= " OR nombre LIKE '%" . $aKeyword[$i] . "%' OR apellidos LIKE '%" . $aKeyword[$i] . "%'";
                                //                                            }
                                //                                        }
                                //                                    }
                                //
                                //                                    if ($_POST["buscadepartamento"] != '') {
                                //                                        $query .= " AND departamento = '" . $_POST['buscadepartamento'] . "' ";
                                //                                    }
                                //
                                //                                    if ($_POST["buscafechadesde"] != '') {
                                //                                        $query .= " AND fecha BETWEEN '" . $_POST["buscafechadesde"] . "' AND '" . $_POST["buscafechahasta"] . "' ";
                                //                                    }
                                //
                                //                                    if ($_POST['buscapreciodesde'] != '') {
                                //                                        $query .= " AND precio >= '" . $_POST['buscapreciodesde'] . "' ";
                                //                                    }
                                //
                                //                                    if ($_POST['buscapreciohasta'] != '') {
                                //                                        $query .= " AND precio <= '" . $_POST['buscapreciohasta'] . "' ";
                                //                                    }
                                //
                                //                                    if ($_POST["color"] != '') {
                                //                                        $query .= " AND color = '" . $_POST["color"] . "' ";
                                //                                    }
                                //
                                //                                    if ($_POST["orden"] == '1') {
                                //                                        $query .= " ORDER BY nombre ASC ";
                                //                                    }
                                //
                                //                                    if ($_POST["orden"] == '2') {
                                //                                        $query .= " ORDER BY departamento ASC ";
                                //                                    }
                                //
                                //                                    if ($_POST["orden"] == '3') {
                                //                                        $query .= " ORDER BY color ASC ";
                                //                                    }
                                //
                                //                                    if ($_POST["orden"] == '4') {
                                //                                        $query .= " ORDER BY precio ASC ";
                                //                                    }
                                //
                                //                                    if ($_POST["orden"] == '5') {
                                //                                        $query .= " ORDER BY precio DESC ";
                                //                                    }
                                //
                                //                                    if ($_POST["orden"] == '6') {
                                //                                        $query .= " ORDER BY fecha ASC ";
                                //                                    }
                                //
                                //                                    if ($_POST["orden"] == '7') {
                                //                                        $query .= " ORDER BY fecha DESC ";
                                //                                    }
                                //                                }
                                //
                                //
                                //                                $sql = $conexion->query($query);
                                //
                                //                                $numeroSql = mysqli_num_rows($sql);
                                ?>
                                <p style="font-weight: bold; color:purple;"><i class="mdi mdi-file-document"></i> <?php // echo $numeroSql; 
                                                                                                                    ?> Resultados encontrados</p>
                                <p style="font-weight: bold; color:purple;"><i class="mdi mdi-file-document"></i>   Resultados encontrados</p>
                            </form>

                            
                            
                            
                            
                            
                            
                        </div> 
                    </div>   
                </div> 
            </div>            
        </section>
         End Destacados - Características          
        -->

<!-- Eventos -->
<section class="home-case ptb-35">
    <div class="container">
        <div class="section-title">
            <!--<span>Descubre</span>-->
            <!--<h2>Conoce todo lo que EchoMusic tiene para ti</h2>-->
            <h2>Eventos sobre <?php echo $id; ?></h2>
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
                                        ' . $respuestaCiudadRegion[0]["name_region"] . ', ' . $respuestaCiudadRegion[0]["name_city"] . '
                                        </a>
                                    </div>
                                    
                                    <div class="col-lg-6 col-sm-6">';
                if ($eventosRelacionados[$k]["ticket_value"] == 0) {
                    echo  '<h3>Gratuito</h3>
                                                <a href="eventos.php?e=' . $eventosRelacionados[$k]["id_event"] . '" class="box-btn">Reservar</a>';
                } else {
                    echo  '<h4>$ ' . number_format(($eventosRelacionados[$k]["ticket_value"] + $eventosRelacionados[$k]["ticket_commission"]), 0, ',', '.') . '</h4>
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
            <p> <a href="#" class="box-btn">Ver más eventos</a></p>
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
                        <a href="ingresar.php" class="box-btn text-center">CREA TU EVENTO</a>
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
include 'footer2.php';
?>