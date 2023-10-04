<?php
session_start();

require_once "model/model.php";

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

                <div class="row">
                    <ul class="nav nav-material responsive-tab">
                        <li>
                            <a class="nav-link active" href="eventos.php">
                                <i class="icon icon-home2"></i>Eventos
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href=" >
                                <i class=" icon icon-edit"></i>Herramientas
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href=" ">
                                <i class="icon icon-line-chart"></i>Estadísticas
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href=" ">
                                <i class="icon icon-cog"></i>Servicios adicionales
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </header>
        <!--Eventos-->
        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card no-b">
                            <div class="col-md-4  mb-3 mt-15">
                                <div class="card-header white b-0 p-3">
                                    <h4 class="card-title">Eventos</h4>
                                    <small class="card-subtitle mb-2 text-muted">Listado de eventos próximos y pasados.</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mt-15">
                                <a href="registrar_marca.php" class="btn btn-primary btn-xs r-20"><i class="icon-plus-circle mr-2"></i>Evento</a>
                            </div>

                            <div class="collapse show" id="invoiceCard">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Lugar</th>
                                                    <th>Fecha</th>
                                                    <th>Status</th>
                                                    <th>Ventas</th>
                                                    <th>Acciones</th>
                                                    <th>Activar</th>
                                                    <th>Duplicar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span class="icon-person_pin"></span>
                                                    </td>
                                                    <td>10521</td>
                                                    <td><a href="#">Concierto en vivo</a></td>
                                                    <td>Metropolitana</td>
                                                    <td>19/07/2022 19 hrs</td>
                                                    <td><span class="badge badge-light">Borrador</span></td>
                                                    <td>$ 1250</td>
                                                    <td>
                                                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href=""><i class="icon-pencil"></i></a>
                                                        <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick=""><i class="icon-trash"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="material-switch">
                                                            <input id="sw1" name="someSwitchOption001" type="checkbox">
                                                            <label for="sw1" class="bg-primary"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href=""><i class="icon-control_point_duplicate"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="icon-wifi_tethering"></span>
                                                    </td>
                                                    <td>10525</td>
                                                    <td><a href="#">Concierto en vivo 2</a></td>
                                                    <td>Metropolitana</td>
                                                    <td>20/07/2022 19 hrs</td>
                                                    <td><span class="badge badge-warning">Pasado</span></td>
                                                    <td>$ 1250</td>
                                                    <td>
                                                        <a class="btn-fab btn-fab-sm btn-success shadow text-white" href=""><i class="icon-cog"></i></a>
                                                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href=""><i class="icon-pencil"></i></a>
                                                        <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick=""><i class="icon-trash"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="material-switch">
                                                            <input id="sw1" name="someSwitchOption001" type="checkbox" checked>
                                                            <label for="sw1" class="bg-primary"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href=""><i class="icon-control_point_duplicate"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="icon-wifi_tethering"></span>
                                                    </td>
                                                    <td>10550</td>
                                                    <td><a href="#">Concierto en vivo 3</a></td>
                                                    <td>Metropolitana</td>
                                                    <td>15/09/2023 20 hrs</td>
                                                    <td><span class="badge badge-success">Publicado</span></td>
                                                    <td>$ 5000 </td>
                                                    <td>
                                                        <a class="btn-fab btn-fab-sm btn-success shadow text-white" href=""><i class="icon-cog"></i></a>
                                                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href=""><i class="icon-pencil"></i></a>
                                                        <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick=""><i class="icon-trash"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="material-switch">
                                                            <input id="sw1" name="someSwitchOption001" type="checkbox" checked>
                                                            <label for="sw1" class="bg-primary"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href=""><i class="icon-control_point_duplicate"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="icon-person_pin"></span>
                                                    </td>
                                                    <td>10555</td>
                                                    <td><a href="#">Concierto en vivo 4</a></td>
                                                    <td>Metropolitana</td>
                                                    <td>15/09/2023 22 hrs</td>
                                                    <td><span class="badge badge-success">Publicado</span></td>
                                                    <td>$ 0</td>
                                                    <td>
                                                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href=""><i class="icon-pencil"></i></a>
                                                        <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick=""><i class="icon-trash"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="material-switch">
                                                            <input id="sw4" name="someSwitchOption001" type="checkbox" checked>
                                                            <label for="sw4" class="bg-primary"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href=""><i class="icon-control_point_duplicate"></i></a>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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