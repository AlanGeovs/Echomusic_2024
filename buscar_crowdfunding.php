<?php
include "model/models.php";
include "header.php";

//Búsquedas desde la url-> buscador topheader
if (isset($_GET["p"])) {
    $id = $_GET["p"];
    $region   = $_GET["reg"];
    $titleBusqueda = "Proyectos en proceso  " . $id;

    //    $eventosRelacionados = Consultas::eventosCarteleraBusqueda($id);
} else {
    $titleBusqueda = "Proyectos recomendados";
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
if (!isset($_GET["p"])) {
    $_GET["p"] = '';
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
if (trim($_GET["p"]) == '') {
    $valueEvento = '';
} else {
    $valueEvento = 'value="' . $_GET["p"] . '" ';
}

if ($_GET["p"] == '') {
    $_GET["p"] = ' ';
}
$aKeyword = explode(" ", $_GET["p"]);

if ($_GET["p"] == '' and  $_GET["reg"] == '') {
    //        $query = "SELECT * FROM datos_usuario ";
    $eventosRelacionados = Consultas::ultimosCrowdfunding();
}
if ($_GET["p"] != '' and $_GET["reg"] != '') {
    $eventosRelacionados = Consultas::ultimosCrowdfundingBusquedaRegion($_GET["p"], $_GET["reg"]);
    echo "AMBOS -----------";
}
if ($_GET["p"] != '' and $_GET["reg"] == '') {
    $eventosRelacionados = Consultas::ultimosCrowdfundingBusqueda($_GET["p"]);
}
if ($_GET["p"] == '' and $_GET["reg"] != '') {
    $eventosRelacionados = Consultas::ultimosCrowdfundingRegion($_GET["reg"]);
}

$crowfundingFinanciados = Consultas::crowdFinanciados();


//        $query = "SELECT * FROM datos_usuario ";
//        if ( $_GET["p"] != '') {
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
            <span>Crowdfunding</span>
            <h2>Descubre los mejores proyectos para financiar</h2>
            <!--<p>It is a long established fact that a reader will be distracted by the rea dable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more.</p>-->
        </div>

        <div class="row align-items-center choose-c justify-content-md-center">
            <div class="col-lg-9 col-md-12">
                <div class="content">
                    <form id="form2" name="form2" method="GET" action="buscar_crowdfunding.php">
                        <div class="row">
                            <div class="col-lg-5 col-sm-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="p" name="p" data-error="Buscar un proyecto" placeholder="Buscar proyecto" <?php echo $valueEvento; ?> />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>



                            <!--Region-->
                            <div class="col-lg-4 col-md-4">
                                <div class="form12-group">
                                    <select name="reg" id="reg" class="form-control" data-error="Selecciona una región" />
                                    <?php if ($_GET["reg"] != '') {
                                        $RegionesArregle = [
                                            '1' => 'Arica y Parinacota', '2' => 'Tarapacá', '3' => 'Antofagasta', '4' => 'Atacama', '5' => 'Coquimbo',
                                            '6' => 'Valparaíso', '7' => 'Metropolitana', '8' => 'Libertador Gral. Bernando Ohiggins', '9' => 'Maule', '10' => 'Ñuble',
                                            '11' => 'Bío Bío', '12' => 'La Araucanía', '13' => 'Los Ríos', '14' => 'Los Lagos', '15' => 'Aysén', '16' => 'Magallanes'
                                        ]
                                    ?>
                                        <option value="<?php echo $_GET["reg"]; ?>"><?php echo $RegionesArregle[$_GET["reg"]]; ?></option>
                                    <?php } ?>
                                    <option value="">Todas las regiones</option>
                                    <option value="1">Arica y Parinacota</option>
                                    <option value="2">Tarapacá</option>
                                    <option value="3">Antofagasta</option>
                                    <option value="4">Atacama</option>
                                    <option value="5">Coquimbo</option>
                                    <option value="6">Valparaíso</option>
                                    <option value="7">Metropolitana</option>
                                    <option value="8">Libertador Gral. Bernando O'higgins</option>
                                    <option value="9">Maule</option>
                                    <option value="10">Ñuble</option>
                                    <option value="11">Bío Bío</option>
                                    <option value="12">La Araucanía</option>
                                    <option value="13">Los Ríos</option>
                                    <option value="14">Los Lagos</option>
                                    <option value="15">Aysén</option>
                                    <option value="16">Magallanes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <button type="submit" class="default-btn page-btn box-btn">
                                    <i class="bx bx-search"></i> Buscar
                                </button>
                                <div class="btn-clear">
                                    <button type="reset" class="box-btn-clear">Limpiar campos</button>
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
                                <a href="crowdfunding.php?c=' . $eventosRelacionados[$k]["id_project"] . '">
                                    <img class="imgEvent tamano-1" src="https://echomusic.cl/images/avatars/' . $eventosRelacionados[$k]["id_user"] . '.jpg" height="100%"  alt="case"/> 
                                </a>
                            </div>

                            <div class="content">
                                <!--Titulo-->
                                <div class="row text-center titulo-proyecto">
                                    <div class="col-12"> 
                                        <a href="crowdfunding.php?c=' . $eventosRelacionados[$k]["id_project"] . '"> <h3>' . $eventosRelacionados[$k]["project_title"] . '</h3></a>
                                    </div> 
                                </div>
                                
                                <!--Entrada Fecha hora Costo Compra-->
                                <div class="row text-center ">
                                    <div class="col-lg-12 col-sm-12"> 
                                       
                                        <a href="#" class="line-bnt"> 
                                        ' . $respuestaCiudadRegion[0]["name_region"] . ' ' . $respuestaCiudadRegion[0]["name_city"] . '
                                        </a>
                                    </div>';

                $respuestaCrowdfunding = Consultas::crowdfunding($eventosRelacionados[$k]["id_user"]);

                $totalARecaudar = $respuestaCrowdfunding[0]["project_amount"];
                //  Extrae la suma de lo recaudado
                //        $sumaRecaudado = array_sum ( Consultas::recaudadoCrowdfunding( $respuestaCrowdfunding[0]["id_project"]) );
                $sumaRecaudado = Consultas::recaudadoCrowdfunding($respuestaCrowdfunding[0]["id_project"]);
                $recaudadoPorcentaje = Consultas::obtenerPorcentaje($sumaRecaudado[0], $totalARecaudar);
                $porcentajeTruncado = Consultas::truncar($recaudadoPorcentaje, 0);

                echo ' 
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: ' . $recaudadoPorcentaje . '%" aria-valuenow="" aria-valuemin="' . $sumaRecaudado[0] . ' " aria-valuemax="' . $totalARecaudar . '"></div>
                                    </div>
                                    <p style="font-size: 11px;">$ ' . number_format($sumaRecaudado[0]) . ' de $' . number_format($totalARecaudar) . ' del total recaudado </p>
                                    <h4>' . $porcentajeTruncado . '%</h4> 
                                    <div class="col-lg-12 col-sm-12">
                                     <p>Total de recaudar </p>
                                    <h4>$ ' . number_format(($eventosRelacionados[$k]["ticket_value"] + $eventosRelacionados[$k]["project_amount"]), 0, ',', '.') . '</h4>
                                                <a href="crowdfunding.php?c=' . $eventosRelacionados[$k]["id_project"] . '" class="box-btn">Colaborar</a> 
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
<!-- End Case   Artistas Proyectos  Espacios  -->


<!-- Proyectos Financiados -->
<section class="home-case ptb-35">
    <div class="container">
        <div class="section-title">
            <!--<span>Descubre</span>-->
            <!--<h2>Conoce todo lo que EchoMusic tiene para ti</h2>-->
            <h2>Proyectos financiados</h2>
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
            for ($k = 0; $k < count($crowfundingFinanciados); $k++) {
                //Busca CIudad y Región
                $respuestaCiudadRegion = Consultas::buscaCiudadRegion($crowfundingFinanciados[$k]["id_city"], $crowfundingFinanciados[$k]["id_region"]);

                $fechaEntera1 = strtotime($crowfundingFinanciados[$k]["date_event"]);
                $anio = date("Y", $fechaEntera1);
                $mes = date("m", $fechaEntera1);
                $dia = date("d", $fechaEntera1);

                $hora = date("H", $fechaEntera1);
                $minutos = date("i", $fechaEntera1);

                if (preg_match("/|\b/", $crowfundingFinanciados[$k]["IMG"])) {
                    $fotos = explode("|", $crowfundingFinanciados[$k]["IMG"]);
                    //var_dump($fotos);
                    $total = count($fotos) - 1;
                    $indice = mt_rand(0, intval($total));
                    $img = substr($fotos[0], 16);
                    //echo $img."<br>";
                    //echo "verdadero";
                } else {
                    $img = substr($crowfundingFinanciados[$k]["IMG"], 16);
                    //echo "falso";
                }
                echo '                    
                    <div class="col-lg-4 col-sm-6 item cyber">
                        <div class="single-case">
                            <div class="case-img ">
                                <a href="crowdfunding.php?c=' . $crowfundingFinanciados[$k]["id_project"] . '">
                                    <img class="imgEvent tamano-1" src="https://echomusic.cl/images/avatars/' . $crowfundingFinanciados[$k]["id_user"] . '.jpg" height="100%"  alt="case"/> 
                                </a>
                            </div>

                            <div class="content">
                                <!--Titulo-->
                                <div class="row text-center titulo-proyecto">
                                    <div class="col-12"> 
                                        <a href="crowdfunding.php?c=' . $crowfundingFinanciados[$k]["id_project"] . '"> <h3>' . $crowfundingFinanciados[$k]["project_title"] . '</h3></a>
                                    </div> 
                                </div>
                                
                                <!--Entrada Fecha hora Costo Compra-->
                                <div class="row text-center ">
                                    <div class="col-lg-12 col-sm-12"> 
                                       
                                        <!--<a href="#" class="line-bnt"> 
                                        ' . $respuestaCiudadRegion[0]["name_region"] . '  ' . $respuestaCiudadRegion[0]["name_city"] . ' 
                                        </a>-->
                                    </div>';

                $respuestaCrowdfunding1 = Consultas::crowdfunding2($crowfundingFinanciados[$k]["id_user"]);

                $totalARecaudar1 = $respuestaCrowdfunding1[0]["project_amount"];
                //  Extrae la suma de lo recaudado
                //        $sumaRecaudado = array_sum ( Consultas::recaudadoCrowdfunding( $respuestaCrowdfunding[0]["id_project"]) );
                $sumaRecaudado1 = Consultas::recaudadoCrowdfunding($respuestaCrowdfunding1[0]["id_project"]);
                $recaudadoPorcentaje1 = Consultas::obtenerPorcentaje($sumaRecaudado1[0], $totalARecaudar1);
                $porcentajeTruncado1 = Consultas::truncar($recaudadoPorcentaje1, 0);

                //                               echo "<br>id_user: ".$crowfundingFinanciados[$k]["id_user"]."<br>";
                //                               echo "<br>id_project: ".$crowfundingFinanciados[$k]["id_project"]."<br>";
                //                               echo "<br>Respuesta: ".$sumaRecaudado1."<br>";
                //                               echo "<br>Recaudado: ".$sumaRecaudado1[0]."<br>";
                //                               echo "<br>POrcentaje: ".$recaudadoPorcentaje1."<br>";

                echo ' 
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: ' . $recaudadoPorcentaje1 . '%" aria-valuenow="" aria-valuemin="' . $sumaRecaudado1[0] . ' " aria-valuemax="' . $totalARecaudar1 . '"></div>
                                    </div>
                                    <p style="font-size: 11px;">$ ' . number_format($sumaRecaudado1[0]) . ' de $' . number_format($totalARecaudar1) . ' del total recaudado </p>
                                    <h4>' . $porcentajeTruncado1 . '%</h4> 
                                    <div class="col-lg-12 col-sm-12">
                                     <p>Total de recaudar </p>
                                    <h4>$ ' . number_format(($crowfundingFinanciados[$k]["ticket_value"] + $crowfundingFinanciados[$k]["project_amount"]), 0, ',', '.') . '</h4>
                                                <a href="crowdfunding.php?c=' . $crowfundingFinanciados[$k]["id_project"] . '" class="box-btn">Ver proyecto</a> 
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
<!-- End Destacados Carrusel Area -->


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
include 'footer2.php';
?>