<?php
include "model/models.php";
include "header.php";

//Búsquedas desde la url-> buscador topheader
if (isset($_GET["r"])) {
    $id = $_GET["r"];
    $tipo = $_GET["tip"];
    $gener = $_GET["gen"];
    $region   = $_GET["reg"];
    $titleBusqueda = "Artistas sobre " . $id;

    //    $eventosRelacionados = Consultas::eventosCarteleraBusqueda($id);
} else {
    $titleBusqueda = "Artistas Recomendados";
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

//    BUscar nombre Ciudad Region
$respuestaEventoCiudadRegion = Consultas::buscaCiudadRegion($respuesta[0]["id_city"], $respuesta[0]["id_region"]);

// Determinar la página actual
$paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$resultadosPorPagina = 6;  // Número de resultados por página
$inicio = ($paginaActual - 1) * $resultadosPorPagina;



/* FILTRO de busqueda//////////////////////////////////////////// */
if (!isset($_GET["r"])) {
    $_GET["r"] = '';
}
if (!isset($_GET["tip"])) {
    $_GET["tip"] = '';
}
if (!isset($_GET["gen"])) {
    $_GET["gen"] = '';
}
if (!isset($_GET["reg"])) {
    $_GET["reg"] = '';
}

//Para VALUE de Artista
$arregloValues = ['r', 'tip', 'gen', 'reg'];


//Para VALUE de Tipo
if (trim($_GET['r']) == '') {
    $valueForm  = '';
} else {
    $valueForm  =  $_GET["r"];
}

//    if ($_GET["r"] == '') {
//        $_GET["r"] = ' ';
//    }
//    $aKeyword = explode(" ", $_GET["r"]);

if ($_GET["r"] == '' and $_GET["tip"] == ''  and $_GET["gen"] == '' and  $_GET["reg"] == '') {
    //        $query = "SELECT * FROM datos_usuario ";
    $query  = "SELECT u.*, gu.*, g.* FROM users u INNER JOIN genre_user gu ON u.id_user=gu.id_user INNER JOIN genres g ON gu.id_genre = g.id_genre ";
    $query .= "WHERE picture_ready=1 AND verified like 'yes' AND user_destacado=1 ";
    $condicionesPag = " AND user_destacado=1  ";
    $artistasRelacionados = Consultas::busquedaArtistas($query);
} else {

    $query  = "SELECT u.*, gu.*, g.* FROM users u INNER JOIN genre_user gu ON u.id_user=gu.id_user INNER JOIN genres g ON gu.id_genre = g.id_genre ";
    $query .= "WHERE picture_ready=1 AND verified like 'yes' ";
    $condicionesPag = "";

    if ($_GET["r"] != '') {
        $query .= " AND nick_user like '%" . $_GET["r"] . "%' ";
        $condicionesPag .= " AND nick_user like '%" . $_GET["r"] . "%' ";
        //            echo 'Tipo: '.$_GET["tip"].'<br>';             
    }
    if ($_GET["tip"] != '') {
        $query .= " AND u.id_musician = '" . $_GET["tip"] . "' ";
        $condicionesPag .= " AND u.id_musician = '" . $_GET["tip"] . "' ";
        //            echo 'Tipo: '.$_GET["tip"].'<br>';             
    }
    if ($_GET["gen"] != '') {
        $query .= " AND gu.id_genre = '" . $_GET["gen"] . "' ";
        $condicionesPag .= " AND gu.id_genre = '" . $_GET["gen"] . "' ";
        //            echo 'Genero: '.$_GET["gen"].'<br>';
    }
    if ($_GET["reg"] != '') {
        $query .= " AND u.id_region = '" . $_GET["reg"] . "' ";
        $condicionesPag .= " AND u.id_region = '" . $_GET["reg"] . "' ";
        //            echo 'Region: '.$_GET["reg"].'<br>';
    }
} //fin del ELSE

//    Agregamos el orden
//        $query .= " ORDER BY RAND() LIMIT 12; ";
// $query .= " ORDER BY id_musician DESC LIMIT 12; ";
// Modificar la consulta para agregar límite y offset para la paginación
$query .= " ORDER BY id_musician DESC LIMIT $inicio, $resultadosPorPagina;";
$condicionesPag .= " ORDER BY id_musician DESC ";


// Consulta para contar el total de artistas
$totalArtistas = Consultas::contarArtistas($condicionesPag);
// Calcular el total de páginas
$totalPaginas = ceil($totalArtistas / $resultadosPorPagina);
// echo "Total de artistas:" . $totalArtistas . "<br>Total de páginas: " . $totalPaginas . "<br>";


$artistasRelacionados = Consultas::busquedaArtistas($query);
//        echo 'Artista: '.$artistasRelacionados[0]["id_user"] ;
//        echo '<br><br><br><br><br><br><br>DB: '.$query;




//$sql = $conexion->query($query);
//
//$numeroSql = mysqli_num_rows($sql);
?>

<!-- Artista Destacados - Características  -->
<section class="feature-area bg-color-azul pt-70 pb-35">
    <div class="container">
        <div class="row align-items-center ">
            <div class=" col-lg-4">
                <div class="contnet">
                    <div class="feature-tittle">
                        <span style="font-size: 20px">Sección </span>
                        <h2 style="color: #FFF;">Artistas Destacados </h2>
                        <p>Encuentra lo más relevante en cuanto a eventos, proyectos, noticias y convocatorias.</p>
                    </div>

                    <a href="#" class="box-btn">Ver más destacados</a>
                </div>
            </div>


            <div class="col-lg-8 col-sm-12 item dev design">

                <!--Nuevo Código-->
                <!-- Destacados Carrusel Area -->
                <section class="home-team-area  ">
                    <div class="container">

                        <div class="home-team-slider owl-carousel owl-theme">


                            <?php
                            // Asumiendo que $ultimosArtistasDestacados ya contiene los datos de los artistas destacados
                            $ultimosArtistasDestacados = Consultas::ultimosArtistas();

                            // Verificar si hay artistas destacados
                            if (!empty($ultimosArtistasDestacados)) {
                                foreach ($ultimosArtistasDestacados as $artista) {
                                    // Sustituir los valores dinámicamente
                                    echo '
                                        <div class="single-team">
                                            <div class="team-img">
                                                <a href="artistas.php?a=' . htmlspecialchars($artista["id_user"]) . '">
                                                    <img src="https://echomusic.cl/images/avatars/' . htmlspecialchars($artista["id_user"]) . '.jpg" alt="' . htmlspecialchars($artista["nick_user"]) . '" />
                                                </a>
                                                <ul class="social">
                                                    <li>
                                                        <a href="artistas.php?a=' . htmlspecialchars($artista["id_user"]) . '" target="_blank"><i class=\'bx bx-search\'></i></a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="content text-center">
                                                <h5><a href="artistas.php?a=' . htmlspecialchars($artista["id_user"]) . '"> ' . htmlspecialchars($artista["nick_user"]) . '</a></h5>
                                                
                                            </div>
                                        </div>';
                                }
                            } else {
                                echo '<p>No se encontraron artistas destacados.</p>';
                            }
                            ?>



                            <!-- <div class="single-team">
                                <div class="team-img">
                                    <a href="artistas.php?a=7488">
                                        <img src="https://echomusic.cl/images/avatars/7488.jpg" alt="descatado" />
                                    </a>
                                    <ul class="social">
                                        <li>
                                            <a href="artistas.php?a=7488" target="_blank"><i class='bx bx-search'></i></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="content text-center">
                                    <h3><a href="artistas.php?a=7488"> Safo999</a></h3>
                                     
                                </div>
                            </div> -->


                        </div>
                    </div>
                </section>
                <!-- End Destacados Carrusel Area -->


            </div>

            <!--</div>-->
        </div>
    </div>
</section>
<!-- End Artista Destacados - Características  -->

<!-- Filtro  -->

<!-- BUscador Avanzado -->
<section class="home-contact-area home-2-contact ptb-35">
    <div class="container">
        <div class="section-title">
            <span>Búsqueda avanzada</span>
            <h2>Encuentra artista </h2>
            <?php
            //echo "Total de artistas: " . $totalArtistas .
            // "<br>Total de páginas: " . $totalPaginas .
            // "<br>Inicio: " . $inicio .
            // "<br>Página actual: " . $paginaActual;

            ?>
            <!--<p>It is a long established fact that a reader will be distracted by the rea dable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more.</p>-->
        </div>

        <div class="row align-items-center choose-c justify-content-md-center">
            <div class="col-lg-12 col-md-12 ">
                <div class="content">
                    <form id="formBusquedaArtista" name="form2" method="GET" action="buscar_artista.php">
                        <div class="row">
                            <div class="col-lg-3 col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="r" name="r" data-error="Buscar un artista" placeholder="Buscar artista" value="<?php echo $valueForm; ?>" />
                                    <!-- <input type="text" class="form-control" id="r" name="r" data-error="Buscar un artista" placeholder="Buscar artista" value="<?php echo $valueForm; ?>" /> -->
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>


                            <!--Género-->
                            <div class="col-lg-2 col-md-2">
                                <div class="form12-group">
                                    <select name="gen" id="gen" class="form-control" data-error="Selecciona un Género">
                                        <option value="">Todos los Géneros</option>
                                        <?php
                                        $GeneroArregle = [
                                            '1' => 'Ambient', '2' => 'Balada', '3' => 'Blues', '4' => 'Country',
                                            '5' => 'Cumbia', '6' => 'Electrónica', '7' => 'Folk', '8' => 'Folklore',
                                            '9' => 'Funk', '10' => 'Grunge', '11' => 'Indie', '12' => 'Jazz',
                                            '13' => 'Latino', '14' => 'Metal', '15' => 'Pop', '16' => 'Punk',
                                            '17' => 'Ranchera', '18' => 'Reggae', '19' => 'Rock', '20' => 'Clásica',
                                            '21' => 'Disco', '22' => 'DJ', '23' => 'SKA', '24' => 'Soul', '25' => 'Tango'
                                        ];

                                        foreach ($GeneroArregle as $value => $label) {
                                            $selected = (isset($_GET["gen"]) && $_GET["gen"] == $value) ? 'selected' : '';
                                            echo "<option value='$value' $selected>$label</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <!--Tipo de Artista-->
                            <div class="col-lg-2 col-md-2">
                                <div class="form12-group">
                                    <select name="tip" id="tip" class="form-control" data-error="Selecciona un tipo de artista">
                                        <option value="">Todos los tipos</option>
                                        <?php
                                        $TipArregle = [
                                            '1' => 'Cantante', '2' => 'Banda', '3' => 'Solista',
                                            '4' => 'Músico Instrumentista', '5' => 'Tributo',
                                            '6' => 'DJ', '7' => 'Músico Home Studio'
                                        ];

                                        foreach ($TipArregle as $value => $label) {
                                            $selected = (isset($_GET["tip"]) && $_GET["tip"] == $value) ? 'selected' : '';
                                            echo "<option value='$value' $selected>$label</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
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


                            <div class="col-lg-3 col-md-3">
                                <button type="submit" class="default-btn page-btn box-btn">
                                    <i class="bx bx-search"></i> Buscar Artista
                                </button>
                                <div class="btn-clear">
                                    <button type="button" class="box-btn-clear" onclick="limpiarFormulario()">Limpiar campos</button>

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



<!-- Artistas -->
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
            for ($k = 0; $k < count($artistasRelacionados); $k++) {
                //Busca CIudad y Región
                $respuestaCiudadRegion = Consultas::buscaCiudadRegion($artistasRelacionados[$k]["id_city"], $artistasRelacionados[$k]["id_region"]);
                //Buscar Género
                $resuestaBuscaGenero = Consultas::buscarGenero($artistasRelacionados[$k]["id_user"]);


                $fechaEntera1 = strtotime($artistasRelacionados[$k]["date_event"]);
                $anio = date("Y", $fechaEntera1);
                $mes = date("m", $fechaEntera1);
                $dia = date("d", $fechaEntera1);

                $hora = date("H", $fechaEntera1);
                $minutos = date("i", $fechaEntera1);

                if (preg_match("/|\b/", $artistasRelacionados[$k]["IMG"])) {
                    $fotos = explode("|", $artistasRelacionados[$k]["IMG"]);
                    //var_dump($fotos);
                    $total = count($fotos) - 1;
                    $indice = mt_rand(0, intval($total));
                    $img = substr($fotos[0], 16);
                    //echo $img."<br>";
                    //echo "verdadero";
                } else {
                    $img = substr($artistasRelacionados[$k]["IMG"], 16);
                    //echo "falso";
                }
                echo '                    
                    <div class="col-lg-4 col-sm-6 item cyber">
                        <div class="single-case">
                            <div class="case-img ">
                                <a href="artistas.php?a=' . $artistasRelacionados[$k]["id_user"] . '">
                                    <img class="imgEvent tamano-1" src="https://echomusic.cl/images/avatars/' . $artistasRelacionados[$k]["id_user"] . '.jpg" height="100%"  alt="case"/> 
                                </a>
                            </div>

                            <div class="content">
                                <!--Titulo-->
                                <div class="row text-center">
                                    <div class="col-12"> 
                                        <a href="artistas.php?a=' . $artistasRelacionados[$k]["id_user"] . '"> <h3>' . $artistasRelacionados[$k]["nick_user"] . '</h3></a>
                                    </div> 
                                </div>
                                
                                <!--Entrada Fecha hora Costo Compra-->
                                <div class="row text-center ">
                                    <div class="col-lg-6 col-sm-6"> 

                                        <a href="#" class="line-bnt"> 
                                        ' . $respuestaCiudadRegion[0]["name_region"] . ', ' . $respuestaCiudadRegion[0]["name_city"] . '
                                        </a>
                                        <p>' . $resuestaBuscaGenero["name_genre"] . '</p>
                                    </div>
                                    
                                    <div class="col-lg-6 col-sm-6"> 
                                
                                                <a href="artistas.php?a=' . $artistasRelacionados[$k]["id_user"] . '" class="box-btn">Ver artista</a> 
                                    </div> 
                                </div>                                                                                               
                            </div>
                            
                        </div>
                    </div>';
            }
            ?>
        </div>
        <!-- paginación -->
        <!-- <div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                    <a href="#" class="pagination-link" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>

        </div> -->


        <nav aria-label="Page navigation example">
            <ul class="pagination">

                <!-- Página Anterior -->
                <li class="page-item <?= ($paginaActual <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= max($paginaActual - 1, 1) ?>&r=<?= $_GET["r"] ?>&gen=<?= $_GET["gen"] ?>&tip=<?= $_GET["tip"] ?>&reg=<?= $_GET["reg"] ?>">Anterior</a>
                </li>

                <?php
                $rango = 2; // Rango de páginas alrededor de la página actual
                $desde = max(1, $paginaActual - $rango);
                $hasta = min($totalPaginas, $paginaActual + $rango);

                // Siempre mostrar la primera página
                if ($desde > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=1&r=' . $_GET["r"] . '&gen=' . $_GET["gen"] . '&tip=&reg=' . '">1</a></li>';
                    if ($desde > 2) { // Puntos suspensivos para omisión
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                }

                // Generar los números de página alrededor de la página actual
                for ($i = $desde; $i <= $hasta; $i++) {
                    echo '<li class="page-item ' . ($i == $paginaActual ? 'active' : '') . '">';
                    echo '<a class="page-link" href="?page=' . $i . '&r=' . $_GET["r"] . '&gen=' . $_GET["gen"] . '&tip=&reg=' . '">' . $i . '</a>';
                    echo '</li>';
                }

                // Siempre mostrar la última página
                if ($hasta < $totalPaginas) {
                    if ($hasta < $totalPaginas - 1) { // Puntos suspensivos para omisión
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                    echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPaginas . '&r=' . $_GET["r"] . '&gen=' . $_GET["gen"] . '&tip=&reg=' . '">' . $totalPaginas . '</a></li>';
                }
                ?>

                <!-- Página Siguiente -->
                <li class="page-item <?= ($paginaActual >= $totalPaginas) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= min($paginaActual + 1, $totalPaginas) ?>&r=<?= $_GET["r"] ?>&gen=<?= $_GET["gen"] ?>&tip=<?= $_GET["tip"] ?>&reg=<?= $_GET["reg"] ?>">Siguiente</a>
                </li>
            </ul>
        </nav>





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
                        <a type="button" class="box-btn text-center" data-bs-toggle="modal" data-bs-target="#ModalTipodeRegistro">
                            <i class="bx bxs-log-out"></i> Crea tu perfil</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2"></div>
        </div>
    </div>
</section>
<!-- End CTA 2 unete-->




<!--Footer-->
<?php
include 'footer.php';
?>