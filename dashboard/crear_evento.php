<?php
session_start();

require_once "model/model.php";

$id = $_SESSION["id_user"];

if (!isset($_SESSION["id_user"])) {
    header("Location: index.php?error=2");
} else {
?>

    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php require  'includes/favicon.php'; ?>
        <title>Perfil de Artista</title>
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/app.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.x.x/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Hoja de estilos de Cropper -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
        <!-- Para galería de fotos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>


        <style>
            .user_avatar2 {
                width: 250px;
                height: 250px;
                border: 1px solid #eee;
                background: #fff;
                padding: 5px;
                border-radius: 50%;
                display: block;
                margin: auto;
            }

            .custom-close-btn {
                background-color: transparent;
                border: none;
                font-size: 1.1rem;
                line-height: 1;
                color: rgba(0, 0, 0, 0.5);
                text-shadow: 0 1px 0 #fff;
                opacity: 0.5;
                cursor: pointer;
            }

            .custom-close-btn:hover {
                color: rgba(0, 0, 0, 0.7);
                opacity: 0.7;
            }

            .custom-close-btn:focus {
                outline: none;
                box-shadow: none;
                color: rgba(0, 0, 0, 0.9);
                opacity: 0.9;
            }

            .user-card img {
                border-radius: 50%;
                width: 100px;
                height: 100px;
                object-fit: cover;
            }

            /* Contador de carecteres en Descripción */
            #char-count {
                font-size: 12px;
                color: #666;
                margin-top: 5px;
            }

            .flotaderecha {
                float: right;
            }

            .btn-fab {
                border-radius: 50%;
                padding: 13px;
            }

            /* Estilizar las Miniaturas: */
            .carousel-indicators {
                bottom: -25px;
            }

            .carousel-indicators img {
                height: auto;
                width: 50px;
                margin: 0px;
                cursor: pointer;
            }
        </style>

    </head>

    <body class="light sidebar-mini sidebar-collapse">
        <!-- Pre loader -->
        <div id="loader" class="loader">
            <div class="plane-container">
                <div class="preloader-wrapper small active">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="app">
            <?php include "menu.php"; ?>
            <?php
            $tabla = "users";
            $respuesta = Consultas::detalleUsuario($id, $tabla);
            ?>
            <header class="white pt-3 relative shadow">
                <div class="container-fluid">
                    <div class="row">
                        <ul class="nav nav-material responsive-tab">
                            <li>
                                <a class="nav-link active" href="perfil-editar.php">
                                    <i class="icon icon-home2"></i>Editar
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="perfil-tarifas.php">
                                    <i class="icon icon-edit"></i>Mis tarifas
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="perfil-reservas.php">
                                    <i class="icon icon-cog"></i>Reservas
                                </a>
                            </li>

                        </ul>
                    </div>


                </div>
            </header>


            <div class="container-fluid animatedParent animateOnce my-3">
                <div class="animated fadeInUpShort">


                    <!--Perfíl-->
                    <div class="row">


                        <!--Izquierda 4-->
                        <!-- <div class="col-md-4">
                            <div class="card mb-3 shadow no-b r-0">
                                <div class="card-header bg-white">
                                    <h6>Card 1</h6>
                                </div>
                                <div class="card-body">


                                </div>

                            </div>


                            <div class="card mb-3 shadow no-b r-0">
                                <div class="card-header bg-white">
                                    <h6>Card 2</h6>
                                </div>
                                <div class="card-body">


                                </div>

                            </div>

                        </div> -->

                        <!--Derecha 8 Dashboard-->
                        <div class="col-md-12">
                            <div class="row">


                                <!--Izq 4-->
                                <div class="col-lg-12">
                                    <div class="card mb-3 shadow no-b r-0">
                                        <div class="">
                                            <div class="float-right">
                                                <span class="icon-sound text-light-blue s-48"> </span>
                                            </div>
                                            <div class="card-header white">
                                                <h2>Ingresa los datos de tu evento</h2>
                                            </div>

                                            <div class="card-body">
                                                <div class="card-body">
                                                    <form class="needs-validation" novalidate="">
                                                        <div class="form-row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Nombre del Evento</label>
                                                                <input type="text" class="form-control" id="validationCustom01" placeholder="Nombre del evento ..." required="">
                                                                <div class="valid-feedback">
                                                                    Nombre de evento
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom02">Nombre del Lugar</label>
                                                                <input type="text" class="form-control" id="validationCustom02" placeholder="Lugar del evento" required="">
                                                                <div class="valid-feedback">
                                                                    Lugar
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustomUsername">Organizador</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="validationCustomUsername" placeholder="Nombre del organizador" aria-describedby="inputGroupPrepend" required="">
                                                                    <div class="invalid-feedback">
                                                                        Lugar
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Región</label>
                                                                <select id="inputRegion" name="publicRegionEvent" class="form-control form-custom-1" onchange="changeCities()">

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
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom02">Ciudad</label>
                                                                <select name="publicCityEvent" class="form-control form-custom-1" id="inputCity">
                                                                    <!-- Print DATA -->

                                                                    <option value="1">Arica</option>
                                                                    <option value="2">Camarones</option>
                                                                    <option value="3">General Lagos</option>
                                                                    <option value="4">Putre</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustomUsername">Dirección</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="validationCustomUsername" placeholder=" " aria-describedby="inputGroupPrepend" required="">
                                                                    <div class="invalid-feedback">
                                                                        Lugar
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Fecha y hora</label>
                                                                <input type="text" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;d-m-Y&quot;}" value="2023/06/01">
                                                                <!-- <span class="input-group-append">
                                                                    <span class="input-group-text add-on white">
                                                                        <i class="icon-calendar"></i>
                                                                    </span>
                                                                </span> -->
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom02">Tipo de evento</label>
                                                                <select name="publicCityEvent" class="form-control form-custom-1" id="inputCity">
                                                                    <!-- Print DATA -->

                                                                    <option value="1">Gratuito</option>
                                                                    <option value="2">De pago</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustomUsername">Audiencia</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="validationCustomUsername" placeholder="Cantidad total de entradas" aria-describedby="inputGroupPrepend" required="">
                                                                    <div class="invalid-feedback">
                                                                        Lugar
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- <div class="form-row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="validationCustom03">City</label>
                                                                <input type="text" class="form-control" id="validationCustom03" placeholder="City" required="">
                                                                <div class="invalid-feedback">
                                                                    Please provide a valid city.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="validationCustom04">State</label>
                                                                <input type="text" class="form-control" id="validationCustom04" placeholder="State" required="">
                                                                <div class="invalid-feedback">
                                                                    Please provide a valid state.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="validationCustom05">Zip</label>
                                                                <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required="">
                                                                <div class="invalid-feedback">
                                                                    Please provide a valid zip.
                                                                </div>
                                                            </div>
                                                        </div> -->

                                                        <div class="form-group">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required="">
                                                                <label class="form-check-label" for="invalidCheck">
                                                                    He leído los términos y condiciones
                                                                </label>
                                                                <div class="invalid-feedback">
                                                                    You must agree before submitting.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary" type="submit">Registrar evento</button>
                                                    </form>


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>



                            <!-- Card 6 -->
                            <div class="row">
                                <!-- integrantes -->
                                <!-- <div class="col-md-12">
                                    <div class="card mb-3 shadow no-b r-0">
                                        <div class="card-header white">
                                            <h6>Card 6 <small> </small></h6>
                                        </div>

                                        <div class="card-body">


                                        </div>

                                        <div class="float-right mt-3 text-right">
                                        </div>
                                    </div>
                                </div> -->
                            </div>

                            <!-- Card 7 -->
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-3 shadow no-b r-0">
                                        <div class="card-header white">
                                            <h6>Card 7 </h6>
                                        </div>

                                        <div class="card-body ">
                                        </div>

                                        <div class="float-right">
                                        </div>
                                    </div>
                                </div>
                            </div> -->


                        </div>









                    </div>


                </div>
            </div>
        </div>

        </div>

        <!-- Modales -->


        <!-- Right Sidebar -->
        <aside class="control-sidebar fixed white ">
            <div class="slimScroll">
                <div class="sidebar-header">
                    <h4>Bitácora</h4>
                    <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
                </div>
                <div class="p-3">
                    <!-- The time line -->
                    <ul class="timeline">
                        <?php
                        $hoyCorto = date("Y-m-d");
                        $hoyFin = date("Y-m-d") . " 23:59:59";
                        $hoyInicio = date("Y-m-d") . " 00:00:00";

                        $fechas = Consultas::bitacoraFechas("bitacora");
                        $respuesta = Consultas::bitacora("bitacora");
                        for ($j = 0; $j < 3; $j++) {
                            if ($fechas[$j]["fechas"] == $hoyCorto) {
                                //<!-- timeline time label -->
                                echo '<li class="time-label">
                        <span class="badge badge-danger r-3">
                            Hoy
                        </span>
                    </li>';
                                //<!-- /.timeline-label -->
                                for ($i = 0; $i < count($respuesta); $i++) {
                                    if ($respuesta[$i]["fecha"] <= $hoyFin && $respuesta[$i]["fecha"] >= $hoyInicio) {
                                        if (preg_match("/Inici\b/", $respuesta[$i]["accion"])) {
                                            //<!-- timeline item -->
                                            echo '<li>
                                    <i class="ion icon-sign-in bg-primary"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                            //<!-- END timeline item -->
                                        } elseif (preg_match("/Registr\b/", $respuesta[$i]["accion"])) {
                                            //<!-- timeline item -->
                                            echo '<li>
                                    <i class="ion icon-plus-circle bg-success"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                            //<!-- END timeline item -->
                                        } elseif (preg_match("/Elimin\b/", $respuesta[$i]["accion"])) {
                                            echo '<li>
                                    <i class="ion icon-trash bg-danger"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                        } elseif (preg_match("/Modific\b/", $respuesta[$i]["accion"])) {
                                            echo '<li>
                                    <i class="ion icon-mode_edit bg-warning"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                        }
                                    }
                                }
                            } else {
                                $date1 = new DateTime($fechas[$j]["fechas"]);
                                //var_dump($date1);
                                $date2 = new DateTime("now");
                                $diff = $date1->diff($date2);
                                //<!-- timeline time label -->
                                echo '<li class="time-label">
                        <span class="badge badge-danger r-3">
                            Hace ' . $diff->days . ' día(s)
                        </span>
                    </li>';
                                //<!-- /.timeline-label -->

                                for ($i = 0; $i < count($respuesta); $i++) {
                                    //echo substr($respuesta[$i]["fecha"],0,10);
                                    if ($diff->days != 0 && substr($respuesta[$i]["fecha"], 0, 10) == $fechas[$j]["fechas"]) {

                                        if (preg_match("/Inici\b/", $respuesta[$i]["accion"])) {
                                            //<!-- timeline item -->
                                            echo '<li>
                                    <i class="ion icon-sign-in bg-primary"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                            //<!-- END timeline item -->
                                        } elseif (preg_match("/Registr\b/", $respuesta[$i]["accion"])) {
                                            //<!-- timeline item -->
                                            echo '<li>
                                    <i class="ion icon-plus-circle bg-success"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                            //<!-- END timeline item -->
                                        } elseif (preg_match("/Elimin\b/", $respuesta[$i]["accion"])) {
                                            echo '<li>
                                    <i class="ion icon-trash bg-danger"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                        } elseif (preg_match("/Modific\b/", $respuesta[$i]["accion"])) {
                                            echo '<li>
                                    <i class="ion icon-mode_edit bg-warning"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                </div>
            </div>
        </aside>
        <!-- /.right-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
        <div class="control-sidebar-bg shadow white fixed"></div>
        </div>
        <!--/#app -->
        <script src="assets/js/app.js"></script>

        <!-- google chart api -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    </body>

    </html>
<?php
}//termina else de login