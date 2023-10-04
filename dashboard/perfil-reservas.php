<?php
session_start();

require_once "model/model.php";

// if (!isset($_SESSION["idUser"])) {
//     header("Location: index.php?error=2");
// } else {
//     if ($_SESSION["tipoUsuario"] == "capturista") {
//         if (isset($_GET["u"])) {
//             //header("Location: listar_usuarios.php");
//             $id = $_GET["u"];
//             if ($id != $_SESSION["idUser"]) {
//                 header("Location: site.php");
//             }
//         } else {
//             header("Location: listar_usuarios.php");
//         }
//     } else {
//         if (isset($_GET["u"])) {
//             //header("Location: listar_usuarios.php");
//             $id = $_GET["u"];
//         } else {
//             header("Location: listar_usuarios.php");
//         }
//     }
// }
$id = $_SESSION["id_user"];


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
    </style>

</head>

<body class="light sidebar-mini sidebar-collapse">
    <!-- Pre loader -->
    <div id="loader" class="loader">
        <div class="plane-container">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue">
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

                <div class="spinner-layer spinner-red">
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

                <div class="spinner-layer spinner-yellow">
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

                <div class="spinner-layer spinner-green">
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
        $tabla = "usuarios";
        $respuesta = Consultas::detalleUsuario($id, $tabla);
        ?>
        <header class="white pt-3 relative shadow">
            <div class="container-fluid">
                <!-- <div class="row p-t-b-10 ">
                    <div class="col-md-6">
                        <div class="pb-3">
                            <div class="image mr-3  float-left">
                                <img class="user_avatar no-b no-p" src="images/usuarios/<?php echo $respuesta["usuario"]; ?>.jpg" alt="<?php echo  $respuesta["usuario"]; ?>">
                            </div>
                            <div>
                                <h6 class="p-t-10"><?php echo $respuesta["usuario"]; ?></h6>
                                <?php echo $respuesta["correo"]; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-right">
                        <div class="pb-3">
                            <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-plus"></i> Evento </button>
                            <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-plus"></i> Crowdfunding </button>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <ul class="nav nav-material responsive-tab">
                        <li>
                            <a class="nav-link" href="perfil-editar.php">
                                <i class="icon icon-home2"></i>Editar
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="perfil-tarifas.php">
                                <i class="icon icon-edit"></i>Mis tarifas
                            </a>
                        </li>
                        <li>
                            <a class="nav-link active" href="perfil-reservas.php">
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
                    <!--Perfil-->
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header bg-white">
                                <h5>Tipo de Plan</h5>
                                <form></form>
                            </div>

                            <!-- Editar  -->
                            <div class="card-header bg-white text-right">
                                <div class="form-group">
                                    <div class="col-sm-offset-12 col-sm-12">
                                        <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-clipboard-edit2"></i> Editar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarifas -->
                    <div class="col-md-8">
                        <div class="row">

                            <!--Tarifa 1-->
                            <div class="col-lg-6">
                                <div class="card r-3">
                                    <div class="p-4">
                                        <div class="float-right">
                                            <span class="icon-youtube-play text-light-blue s-48"> </span>
                                        </div>
                                        <div class="counter-title">Tarifa 1</div>
                                        <h6 class="sc-counter mt-3"><?php echo count($datosMarca); ?></h6>
                                        <div class="float-right">
                                            <button type="button" class="btn btn-outline-danger btn-xs"> <i class="icon-delete"></i> Borrar </button>
                                            <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-edit"></i> Editar </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tarifa 2 -->
                            <div class="col-lg-6">
                                <div class="card r-3">
                                    <div class="p-4">
                                        <div class="float-right">
                                            <span class="icon-spotify text-light-blue s-48"> </span>
                                        </div>
                                        <div class="counter-title">Tarifa 2</div>
                                        <h6 class="sc-counter mt-3"><?php echo count($datosMarca); ?></h6>
                                        <div class="float-right">
                                            <button type="button" class="btn btn-outline-danger btn-xs"> <i class="icon-delete"></i> Borrar </button>
                                            <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-edit"></i> Editar </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!--Bloque 2-->
                        <!-- <div class="row my-3"> 
                            <div class="col-md-12">
                                <div class="card r-3">
                                    <div class="card-header white">
                                        <h6>Fotografías <small> </small></h6>
                                    </div>

                                    <div class="float-right">
                                        <button type="button" class="btn btn-outline-danger btn-xs"> <i class="icon-delete"></i> Borrar </button>
                                        <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-edit"></i> Editar </button>
                                    </div>
                                </div>
                            </div>
                        </div>  -->


                    </div>






                </div>
            </div>
        </div>

    </div>

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

    <script>
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        google.charts.setOnLoadCallback(pieChart);

        function pieChart() {
            var datos = document.getElementById('datosGrafica').value;
            var dato = datos.split("|");
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn('string', 'Marcas registradas');
            dataTable.addColumn('number', 'Total de marcas');
            // A column for custom tooltip content
            //dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
            var filas = [];
            //d.push(["Fecha","cm"]);

            filas.push(["Mis marcas", parseInt(dato[0])]);
            filas.push(["Total de marcas", parseInt(dato[1])]);


            console.log("filas", filas);
            //var data = google.visualization.arrayToDataTable(d);
            dataTable.addRows(filas);

            var options = {
                title: "Marcas registrdas por el usuario / total de marcas"
                /*tooltip: {isHtml: true},
                legend: { position: 'left', maxLines: 3 },
                isStacked: true,
                titleTextStyle: {fontSize: 18},*/
                //chartArea: {'width': '65%', 'height': '65%'}
                //hAxis: { textPosition: 'none' },
                //hAxis: {slantedText:true, slantedTextAngle:90,maxTextLines: 10,textStyle: {fontSize: 12}}*/
            };


            var chart = new google.visualization.PieChart(document.getElementById("grafica"));

            /*google.visualization.events.addListener(chart, 'ready', function () {
                  $.ajax({
                    type: 'POST',
                    url: 'includes/guardarPng.php',
                    data: {
                      // send image string as data
                      imgStr: chart.getImageURI(),
                      titulo: "$xcm vs año de venta",
                      opcion: 3
                    },
                  }).success(function(response) {
                    document.getElementById("columnasPng").value=response;
                    console.log('image saved');
                  });
                });*/

            chart.draw(dataTable, options);
        }
    </script>

</body>

</html>