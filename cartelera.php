<?php
include "model/models.php";
include "header.php";

//Búsquedas desde la url-> buscador topheader
if (isset($_GET["r"])) {
    $id = $_GET["r"];
    $tipo = $_GET["t"];
    $fechaInicial   = $_GET["fi"];
    $fechaFinal   = $_GET["ff"];
    $region   = $_GET["reg"];
    $titleBusqueda = "Eventos sobre " . $id;

    //    $eventosRelacionados = Consultas::eventosCarteleraBusqueda($id);
} else {
    $titleBusqueda = "Eventos Recomendados";
    //    $eventosRelacionados = Consultas::ultimosEventos2();
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


/* FILTRO de busqueda//////////////////////////////////////////// */
if (!isset($_GET["r"])) {
    $_GET["r"] = '';
}
if (!isset($_GET["fi"])) {
    $_GET["fi"] = '';
}
if (!isset($_GET["ff"])) {
    $_GET["ff"] = '';
}
if (!isset($_GET["t"])) {
    $_GET["t"] = '';
}
if (!isset($_GET["reg"])) {
    $_GET["reg"] = '';
}

//Para VALUE de Evento
if (trim($_GET["r"]) == '') {
    $valueEvento = '';
} else {
    $valueEvento = 'value="' . $_GET["r"] . '" ';
}

if ($_GET["r"] == '') {
    $_GET["r"] = ' ';
}
$aKeyword = explode(" ", $_GET["r"]);

if ($_GET["r"] == '' and $_GET["t"] == ''  and $_GET["fi"] == '' and $_GET["ff"] == '' and  $_GET["reg"] == '') {
    //        $query = "SELECT * FROM datos_usuario ";
    $eventosRelacionados = Consultas::ultimosEventos2();
} else {
    //Ambas Fechas  
    if ($_GET["fi"] != '' && $_GET["ff"] != '') {
        //Ambas Fechas con  Region 
        if ($_GET["reg"] != '') {
            echo "Fechas: Ambas + Region=" . $_GET["reg"];
            $eventosRelacionados = Consultas::eventosFechasReg($id, $_GET["fi"], $_GET["ff"], $_GET["reg"]);
        }
        //Ambas Fechas sin  Region 
        else {
            echo "Fechas: Ambas";
            $eventosRelacionados = Consultas::eventosFechas($id, $_GET["fi"], $_GET["ff"]);
        }
    }

    if ($_GET["fi"] != '' and $_GET["ff"] = '') {
        echo "Fechas: Inicial";
        $eventosRelacionados = Consultas::eventosFechaInicial($id, $_GET["fi"]);
    }
    if ($_GET["ff"] != '' and $_GET["fi"] = '') {
        echo "Fechas: Final";
        $eventosRelacionados = Consultas::eventosFechaFinal($id, $_GET["ff"]);
    } else {
        $eventosRelacionados = Consultas::eventosCarteleraBusqueda($id);
    }
    //        $query = "SELECT * FROM datos_usuario ";
    //        if ( $_GET["r"] != '') {
    //            $query .= "WHERE (nombre LIKE LOWER('%" . $aKeyword[0] . "%') OR apellidos LIKE LOWER('%" . $aKeyword[0] . "%')) ";
    //
    //            for ($i = 1; $i < count($aKeyword); $i++) {
    //                if (!empty($aKeyword[$i])) {
    //                    $query .= " OR nombre LIKE '%" . $aKeyword[$i] . "%' OR apellidos LIKE '%" . $aKeyword[$i] . "%'";
    //                }
    //            }
    //        }

    //        if ($_POST["buscadepartamento"] != '') {
    //            $query .= " AND departamento = '" . $_POST['buscadepartamento'] . "' ";
    //        }
    //

    //
    //        if ($_POST['buscapreciodesde'] != '') {
    //            $query .= " AND precio >= '" . $_POST['buscapreciodesde'] . "' ";
    //        }
    //
    //        if ($_POST['buscapreciohasta'] != '') {
    //            $query .= " AND precio <= '" . $_POST['buscapreciohasta'] . "' ";
    //        }
    //
    //        if ($_POST["color"] != '') {
    //            $query .= " AND color = '" . $_POST["color"] . "' ";
    //        }

    //    Agregamos el orden
    //        $query .= " ORDER BY nombre ASC ";
    //
} //fin del ELSE


//$sql = $conexion->query($query);
//
//$numeroSql = mysqli_num_rows($sql);
?>

<!-- Slider Area -->
<!--Cambio de imagen en style.css -> "single-slider-bg-1"   -->
<section class="slider-area-2">
    <div class="home-slider owl-carousel owl-theme">
        <div class="single-slider single-slider-bg-1">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 text-center">
                                <div class="slider-content one">
                                    <h1>Crea tu evento presencial o streaming</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida incididunt ut.</p>

                                    <div class="slider-btn text-center">
                                        <a href="#" class="box-btn">Crear evento</a>
                                        <a href="#" class="box-btn border-btn">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-slider single-slider-bg-2">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 text-center">
                                <div class="slider-content one">
                                    <h1>Recauda fondos para tu próximo evento musical</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida incididunt ut.</p>

                                    <div class="slider-btn text-center">
                                        <a href="#" class="box-btn">Recaudar fondos</a>
                                        <a href="#" class="box-btn border-btn">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-slider single-slider-bg-3">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 text-center">
                                <div class="slider-content one">
                                    <h1>Regístrate hoy mismo, fácil, rápido y seguro.</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida incididunt ut.</p>

                                    <div class="slider-btn text-center">
                                        <a href="#" class="box-btn">Registrarme</a>
                                        <a href="#" class="box-btn border-btn">Ver más</a>
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
<!-- End Slider Area -->


<!-- Filtro  -->

<!-- BUscador Avanzado -->
<section class="home-contact-area home-2-contact ptb-35">
    <div class="container">
        <div class="section-title">
            <span>Búsqueda avanzada</span>
            <h2>Encuentra tu evento, artista o espacio favorito</h2>
            <!--<p>It is a long established fact that a reader will be distracted by the rea dable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more.</p>-->
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="content">
                    <form id="formBusquedaArtista" name="form2" method="GET" action="cartelera.php">
                        <div class="row">
                            <div class="col-lg-3 col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="r" name="r" data-error="Buscar un evento o artista" placeholder="Buscar evento, artista o espacio" <?php echo $valueEvento; ?> />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <!--                                     <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <select  name="t" id="t" class="form-control"  data-error="Selecciona un tipo de evento"   />
                                            <?php if ($_GET["t"] != '') { ?>
                                                <option value="<?php echo $_GET["t"]; ?>"><?php echo $_GET["t"]; ?></option>
                                            <?php } ?>                                            
                                                <option value="">Tipo de evento</option>
                                                <option value="Presencial">Presencial</option>
                                                <option value="Online">Online</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>-->

                            <!-- <div class="col-lg-2 col-md-2">                                         
                                        <div class="form-group">
                                            <input type="date" id="fi" name="fi" data-error="Selecciona la fecha inicial" value="<?php echo $_GET["fi"]; ?>" class="form-control" placeholder="Fecha inicial" />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="help-block texto-fechas" style="">Fecha inicial</div>
                                    </div> -->

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <div class="input-group date" id="datepicker">
                                        <input type="date" id="fi" name="fi" class="form-control" data-error="Selecciona la fecha inicial" value="<?php echo $_GET["fi"]; ?>" placeholder="Fecha inicial" />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="help-block texto-fechas">Fecha inicial</div>
                            </div>


                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <input type="date" id="ff" name="ff" data-error="Selecciona la fecha final" value="<?php echo $_GET["ff"]; ?>" class="form-control" placeholder="Fecha final" />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="help-block texto-fechas" style="">Fecha final</div>
                            </div>


                            <!--Region-->
                            <div class="col-lg-2 col-md-2">
                                <div class="form12-group">
                                    <select name="reg" id="reg" class="form-control" data-error="Selecciona una región">
                                        <option value="">Todas las regiones</option>
                                        <?php
                                        $RegionesArregle = [
                                            '1' => 'Arica y Parinacota', '2' => 'Tarapacá', '3' => 'Antofagasta',
                                            '4' => 'Atacama', '5' => 'Coquimbo', '6' => 'Valparaíso',
                                            '7' => 'Metropolitana', '8' => 'Libertador Gral. Bernando Ohiggins',
                                            '9' => 'Maule', '10' => 'Ñuble', '11' => 'Bío Bío',
                                            '12' => 'La Araucanía', '13' => 'Los Ríos', '14' => 'Los Lagos',
                                            '15' => 'Aysén', '16' => 'Magallanes'
                                        ];

                                        foreach ($RegionesArregle as $value => $label) {
                                            $selected = (isset($_GET["reg"]) && $_GET["reg"] == $value) ? 'selected' : '';
                                            echo "<option value='$value' $selected>$label</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <button type="submit" class="default-btn page-btn box-btn">
                                    <i class="bx bx-search"></i> Buscar
                                </button>
                                <div class="btn-clear">
                                    <button type="reset" class="box-btn-clear">Limpiar campos</button>
                                    <button type="button" class="box-btn-clear" onclick="limpiarFormularioCartelera()">Limpiar campos</button>
                                </div>
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
<!-- End BUscador Avanzado-->



<!-- Eventos -->
<section class="home-case ptb-35">
    <div class="container">
        <div class="section-title">
            <!--<span>Descubre</span>-->
            <!--<h2>Conoce todo lo que EchoMusic tiene para ti</h2>-->
            <h2><?php echo $titleBusqueda; ?></h2>
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse.</p>-->
        </div>

        <!--                <div class="case">
                    <ul class="all-case">
                        <li class="active" data-filter="*"><span>Todo</span></li>
                        <li class="active" data-filter="*"><span>Presencial</span></li>
                        <li data-filter=".dev"><span>Online</span></li> 
                    </ul>
                </div>-->


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

        <!--                <div class="case-btn text-center">
                    <p>  <a href="#">Ver más eventos</a></p>
                    <p>    <a href="#" class="box-btn">Ver más eventos</a></p>
                </div>-->
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
                        <a type="button" class="box-btn text-center" data-bs-toggle="modal" data-bs-target="#ModalTipodeRegistro">
                            <i class="bx bxs-log-out"></i> Crea tu perfil</a>
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