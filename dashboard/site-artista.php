<?php
session_start();

require_once "model/model.php";

if (!isset($_SESSION["id_user"])) {
    header("Location: index.php?error=2");
} else {
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php require  'includes/favicon.php'; ?>
        <title>Admin | EchoMusic </title>
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/app.css">

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
            <?php include "menu.php" ?>
            <div class="container-fluid relative animatedParent animateOnce my-3">
                <div class="row row-eq-height my-3 mt-3">
                    <div class="col-md-12">
                        <div class="row">
                            <!-- Botón -->
                            <!-- <div class="col-md-12 col-sm-12" style="padding-bottom: 15px;">
                                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href='registrar_encuesta.php'">
                                    <i class="icon-plus mr-2"></i> Agregar encuestado</button>
                            </div> -->


                            <div class="col-md-4 col-sm-4">
                                <!-- <a href="perfil.php?u=<?php echo $_SESSION["id_user"]; ?>" style="text-decoration: none; color: inherit;"> -->
                                <a href="perfil-editar.php" style="text-decoration: none; color: inherit;">
                                    <div class="card no-b mb-3 bg-warning text-white">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="text-success"><i class="icon-user-circle-o s-48"></i> </div>
                                            </div>
                                            <div class="text-center">
                                                <div><span class="s-48 my-3 font-weight-lighter">Fan Page </span><br></div>
                                                Edita los datos relevantes de tu cuenta.
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div class="card no-b mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-warning"><i class="icon-ticket s-48"></i> </div>
                                        </div>
                                        <div class="text-center">
                                            <div><span class="s-48 my-3 font-weight-lighter">Mis evento </span><br></div>
                                            Listado de eventos nuevos y pasados.
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div class="card no-b mb-3 bg-warning text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div><i class="icon-piggy-bank s-48"></i></div>
                                        </div>
                                        <div class="text-center">
                                            <?php
                                            // $totalCapturistas = Consultas::listarCapturistas();
                                            ?>
                                            <div><span class="s-48 my-3 font-weight-lighter">Crowdfunding</span></div>
                                            Proyectos con financiamiento.
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Renglon 2 -->
                        <div class="row">

                            <div class="col-md-4 col-sm-4">
                                <div class="card no-b mb-3 ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div><i class="icon-pencil-square-o s-48"></i></div>
                                            <!--<div><span class="badge badge-pill badge-primary">4:30</span></div>-->
                                        </div>

                                        <div class="text-center">
                                            <?php
                                            $totalUsuarios = Consultas::listarUsuariosVerificados();
                                            ?>
                                            <div><span class="s-48 my-3 font-weight-lighter">
                                                    <!-- <?php //echo $totalUsuarios[0]['usuarios']; 
                                                            ?> -->
                                                    Mis datos</span>
                                            </div>
                                            Información básica.
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">

                                <div class="card no-b mb-3 bg-warning text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-success"><i class="icon-line-chart s-48"></i> </div>
                                        </div>
                                        <div class="text-center">
                                            <div><span class="s-48 my-3 font-weight-lighter">Métricas </span><br></div>
                                            Estadísticas generales.
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div class="card no-b mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-warning"><i class="icon-question-circle-o s-48"></i> </div>
                                        </div>
                                        <div class="text-center">
                                            <div><span class="s-48 my-3 font-weight-lighter">Soporte </span><br></div>
                                            Conecta con el equipo de EchoMusic.
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Renglon 3 -->
                        <div class="row">


                        </div>

                        <!-- Renglon 4 -->
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="card no-b mb-3 bg-warning text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div><i class="icon-piggy-bank s-48"></i></div>
                                            <!--<div><span class="badge badge-pill badge-danger">4:30</span></div>-->
                                        </div>
                                        <div class="text-center">
                                            <?php
                                            // $totalCapturistas = Consultas::listarCapturistas();
                                            ?>
                                            <div class="s-48 my-3 font-weight-lighter">Mis tarifas</div>
                                            Edita tus cuotas de cobro por evento.
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 col-sm-6">
                                <div class="card no-b mb-3 ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div><i class="icon-pencil-square-o s-48"></i></div>
                                            <!--<div><span class="badge badge-pill badge-primary">4:30</span></div>-->
                                        </div>

                                        <div class="text-center">
                                            <?php
                                            $totalUsuarios = Consultas::listarUsuariosVerificados();
                                            ?>
                                            <div class="s-48 my-3 font-weight-lighter">
                                                <!-- <?php //echo $totalUsuarios[0]['usuarios']; 
                                                        ?> -->
                                                Reservas
                                            </div>
                                            Reservaciones ...
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Grafica de pastel -->

                    <!-- <div class="col-md-6">
                            <div class="card no-b p-2">
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="height-300">
                                            <canvas data-chart="chartJs" data-chart-type="doughnut" data-dataset="[
                                                [<?php echo  $t1 . "," . $t2 . "," . $t3; ?>]
                                                
                                                ]" data-labels="[['Tipo 1'],['Tipo 2'],['Tipo 3'] ]" data-dataset-options="[
                                                {
                                                label: 'Totales',
                                                backgroundColor: [
                                                '#03a9f4',
                                                '#8f5caf',
                                                '#3f51b5'
                                                ],

                                                },


                                                ]" data-options="{legend: {display: !0,position: 'bottom',labels: {fontColor: '#7F8FA4',usePointStyle: !0}},
                                                }">
                                            </canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                </div>
                <!--<div class="card no-b my-3">
                        <div class="card-body">
                            <div class="my-2 height-300">
                                <canvas
                                        data-chart="bar"
                                        data-dataset="[
                                                    [21, 90, 55, 0, 59, 77, 12,21, 90, 55, 0, 59, 77, 12,21, 90, 55, 0, 59, 77, 12],
                                                    [12, 40, 16, 17, 89, 0, 12,12, 0, 55, 60, 79, 99, 12,12, 0, 55, 60, 79, 99, 12],
                                                    [12, 40, 16, 17, 89, 0,12, 40, 16, 17, 89, 0, 12,12, 40, 16, 17, 89, 0, 12],
                                                    ]"
                                        data-labels="['Blue','Yellow','Green','Purple','Orange','Red','Indigo','Blue','Yellow','Green','Purple','Orange','Red','Indigo','Blue','Yellow','Green','Purple','Orange','Red','Indigo']"
                                        data-dataset-options="[
                                                {
                                                    label: 'HTML',
                                                    backgroundColor: '#7986cb',
                                                    borderWidth: 0,
            
                                                },
                                                {
                                                     label: 'Wordpress',
                                                     backgroundColor: '#88e2ff',
                                                     borderWidth: 0,
            
                                                 },
                                                {
                                                      label: 'Laravel',
                                                      backgroundColor: '#e2e8f0',
                                                      borderWidth: 0,
            
                                                  }
                                                ]"
                                        data-options="{
                                                  legend: { display: true,},
                                                  scales: {
                                                    xAxes: [{
                                                        stacked: true,
                                                         barThickness:5,
                                                         gridLines: {
                                                            zeroLineColor: 'rgba(255,255,255,0.1)',
                                                             color: 'rgba(255,255,255,0.1)',
                                                             display: false,},
                                                         }],
                                                    yAxes: [{
                                                            stacked: true,
                                                                 gridLines: {
                                                                    zeroLineColor: 'rgba(255,255,255,0.1)',
                                                                    color: 'rgba(255,255,255,0.1)',
                                                                }
                                                   }]
            
                                                  }
                                            }"
                                >
                                </canvas>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row my-3 no-gutters">
                                <div class="col-md-3">
                                    <h1>Tasks</h1>
                                    Currently assigned tasks to team.
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <figure class="avatar">
                                                    <img src="assets/img/dummy/u12.png" alt=""></figure>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <figure class="avatar">
                                                    <img src="assets/img/dummy/u2.png" alt=""></figure>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-indigo" role="progressbar" style="width: 75%;"
                                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <div class="avatar-group">
                                                    <figure class="avatar">
                                                        <img src="assets/img/dummy/u4.png" alt=""></figure>
                                                    <figure class="avatar">
                                                        <img src="assets/img/dummy/u11.png" alt=""></figure>
                                                    <figure class="avatar">
                                                        <img src="assets/img/dummy/u1.png" alt=""></figure>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar yellow" role="progressbar" style="width: 75%;"
                                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <figure class="avatar">
                                                    <img src="assets/img/dummy/u5.png" alt=""></figure>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%;"
                                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->

                <!--<div class=" row my-3">
                        <div class="col-md-6">
                            <div class=" card b-0">
                                <div class="card-body p-5">
                                    <canvas id="gradientChart" width="600" height="340"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" card no-b">
                                <div class="card-body">
                                    <table class="table table-hover earning-box">
                                        <tbody>
                                        <tr class="no-b">
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u6.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u9.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u11.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u12.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u5.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>-->

            </div>
        </div>
        <!-- Right Sidebar -->

        <?php
        if ($_SESSION["tipoUsuario"] == "admin") {
        ?>
            <aside class="control-sidebar fixed white ">
                <div class="slimScroll">
                    <div class="sidebar-header">
                        <h4>Bitácora ---- </h4>
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
                            $respuesta = Consultas::bitacoraInicio("bitacora");
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

        <?php
        }
        ?>
        </div>
        <!--/#app -->
        <script src="assets/js/app.js"></script>

    </body>

    </html>

<?php
}//termina else