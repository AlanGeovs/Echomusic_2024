<?php
session_start();

require_once "model/model.php";

if (!isset($_SESSION["idUser"]) && $_SESSION["tipoUsuairo"]!="admin") {
    header("Location: index.php?error=2");
}else{



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php    require  'includes/favicon.php'; ?> 
    <title>Admin | AutoMayoreo</title>
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
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
<?php include "menu.php"; ?>
    <div class="container-fluid pt-3">
        <div class="row my-3">
            <div class="col-12"><!-- col-12 col-xl-6 -->
                <div class="card no-b">
                    <div class="card-header bg-primary text-white">
                        <h4>Estadísticas</h4>
                        <div class="row justify-content-end">
                           <div class="col">
                            <ul id="myTab4" role="tablist" class="nav nav-tabs card-header-tabs nav-material nav-material-white float-right">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="tab1" data-toggle="tab" href="#v-pills-tab1" role="tab" aria-controls="tab1" aria-expanded="true" aria-selected="true">Estadístico de marcas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab2" data-toggle="tab" href="#v-pills-tab2" role="tab" aria-controls="tab2" aria-selected="false">Marcas registradas</a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link" id="tab3" data-toggle="tab" href="#v-pills-tab3" role="tab" aria-controls="tab3" aria-selected="false">Tab 3</a>
                                </li>-->
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card-body no-p">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="v-pills-tab1" role="tabpanel" aria-labelledby="v-pills-tab1">
                                <h4 class="card-title m-3">Estadístico de marcas</h4>
                                <div class="col-12 row">
                                    <div class="table-responsive  mt-3 pt-3">
                                        <div id="estadisticasGraficaBarra" style="height: 400px;" class=""></div>
                                    </div>
                                </div>

                                <div class="col-12 row">
                                    <p class="card-text mt-5">Total de las marcas registradas por Categoría.</p>
                                    <div class="table-responsive">
                                        <table class="table table-hover earning-box m-3">
                                            <thead class="no-b">
                                            <tr>
                                                <th>Categoría</th>
                                                <th>Total de marcas</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $respuesta=Consultas::estadisticasPorCategorias();
                                                //var_dump($respuesta);
                                                $total=0;
                                                $datos="";
                                                for ($i=0; $i < count($respuesta); $i++) { 
                                                    echo "<tr>";
                                                        echo "<td>".$respuesta[$i]["tag"]."</td>";
                                                        echo "<td>".$respuesta[$i]["total"]."</td>";
                                                        $total+=intval($respuesta[$i]["total"]);
                                                    echo "</tr>";
                                                    $datos.=$respuesta[$i]["tag"]."|".$respuesta[$i]["total"]."\r\n";
                                                }
                                                echo "<tr>";
                                                    echo "<td><strong>Total: </strong></td>";
                                                    echo "<td><strong>".$total."</strong></td>";
                                                echo "</tr>";
                                            ?>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    <textarea style="display: none;" name="datosGrafica" id="datosGrafica"><?php echo $datos; ?></textarea>
                                </div>
                                
                            </div>
                            <div class="tab-pane fade text-center p-5" id="v-pills-tab2" role="tabpanel" aria-labelledby="v-pills-tab2">
                                
                                    <h4 class="card-title">Marcas registradas</h4>
                                    <p class="card-text">Lista de todas las marcas registradas por Capturistas.</p>
                                    <div class="table-responsive">
                                        
                                        <table class="table table-hover earning-box">
                                            <thead class="no-b">
                                                <tr>
                                                    <th>Denominación</th>
                                                    <th>Titular</th>
                                                    <th>Num. Registro</th>
                                                    <th>Num. Solicitud</th>
                                                    <th>Vigencia</th>
                                                    <th>País de Origen</th>
                                                    <th>Enlace</th>
                                                    <th>Contacto</th>
                                                    <th>Correo</th>
                                                    <th>Usuario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                    
                                            <?php

                                            $respuesta1=Consultas::listarMarcasPorCapturistas();
                                            for ($i=0; $i < count($respuesta1); $i++) { 
                                                echo "<tr>";
                                                    echo "<td>".$respuesta1[$i]["DENOM"]."</td>";
                                                    echo "<td>".$respuesta1[$i]["TITULAR"]."</td>";
                                                    echo "<td>".$respuesta1[$i]["NO_REG"]."</td>";
                                                    echo "<td>".$respuesta1[$i]["NO_SOL"]."</td>";
                                                    echo "<td>".$respuesta1[$i]["VIGENCIA"]."</td>";
                                                    echo "<td>".$respuesta1[$i]["PAIS_ORI"]."</td>";
                                                    echo "<td>".$respuesta1[$i]["C_LINK"]."</td>";
                                                    echo "<td>".$respuesta1[$i]["AUTORIZADOS"]."</td>";
                                                    echo "<td>".$respuesta1[$i]["C_EMAIL"]."</td>";
                                                    echo "<td>".$respuesta1[$i]["usuario"]."</td>";
                                                echo "</tr>";
                                            }

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                               
                            </div>
                            <div class="tab-pane fade text-center p-5" id="v-pills-tab3" role="tabpanel" aria-labelledby="v-pills-tab3">
                                <h4 class="card-title">Tab 3</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
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
            $hoyCorto=date("Y-m-d");
            $hoyFin=date("Y-m-d")." 23:59:59";
            $hoyInicio=date("Y-m-d")." 00:00:00";

            $fechas=Consultas::bitacoraFechas("bitacora");
            $respuesta=Consultas::bitacora("bitacora");
            for ($j=0; $j < 3; $j++) { 
                if ($fechas[$j]["fechas"]==$hoyCorto) {
                    //<!-- timeline time label -->
                    echo '<li class="time-label">
                        <span class="badge badge-danger r-3">
                            Hoy
                        </span>
                    </li>';
                   //<!-- /.timeline-label -->
                    for ($i=0; $i < count($respuesta); $i++) {
                        if ($respuesta[$i]["fecha"]<=$hoyFin && $respuesta[$i]["fecha"]>=$hoyInicio) {  
                            if (preg_match("/Inici\b/", $respuesta[$i]["accion"])) {
                               //<!-- timeline item -->
                                echo '<li>
                                    <i class="ion icon-sign-in bg-primary"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($respuesta[$i]["fecha"],11).'</span></h6></div>
                                    </div>
                                </li>';
                                //<!-- END timeline item -->
                            }elseif(preg_match("/Registr\b/", $respuesta[$i]["accion"])) {
                                //<!-- timeline item -->
                                echo '<li>
                                    <i class="ion icon-plus-circle bg-success"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($respuesta[$i]["fecha"],11).'</span></h6></div>
                                    </div>
                                </li>';
                                //<!-- END timeline item -->
                            }elseif(preg_match("/Elimin\b/", $respuesta[$i]["accion"])){
                                echo '<li>
                                    <i class="ion icon-trash bg-danger"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($respuesta[$i]["fecha"],11).'</span></h6></div>
                                    </div>
                                </li>';
                            }elseif(preg_match("/Modific\b/", $respuesta[$i]["accion"])){
                                echo '<li>
                                    <i class="ion icon-mode_edit bg-warning"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($respuesta[$i]["fecha"],11).'</span></h6></div>
                                    </div>
                                </li>';
                            } 
                        }
                        
                    }
                }else{
                    $date1 = new DateTime($fechas[$j]["fechas"]);
                    //var_dump($date1);
                    $date2 = new DateTime("now");
                    $diff = $date1->diff($date2);
                    //<!-- timeline time label -->
                    echo '<li class="time-label">
                        <span class="badge badge-danger r-3">
                            Hace '.$diff->days.' día(s)
                        </span>
                    </li>';
                    //<!-- /.timeline-label --> 

                    for ($i=0; $i < count($respuesta); $i++) {
                        //echo substr($respuesta[$i]["fecha"],0,10);
                        if ($diff->days!=0 && substr($respuesta[$i]["fecha"],0,10)==$fechas[$j]["fechas"]) {
                            
                            if (preg_match("/Inici\b/", $respuesta[$i]["accion"])) {
                               //<!-- timeline item -->
                                echo '<li>
                                    <i class="ion icon-sign-in bg-primary"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($respuesta[$i]["fecha"]).'</span></h6></div>
                                    </div>
                                </li>';
                                //<!-- END timeline item -->
                            }elseif(preg_match("/Registr\b/", $respuesta[$i]["accion"])) {
                                //<!-- timeline item -->
                                echo '<li>
                                    <i class="ion icon-plus-circle bg-success"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($respuesta[$i]["fecha"]).'</span></h6></div>
                                    </div>
                                </li>';
                                //<!-- END timeline item -->
                            }elseif(preg_match("/Elimin\b/", $respuesta[$i]["accion"])){
                                echo '<li>
                                    <i class="ion icon-trash bg-danger"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($respuesta[$i]["fecha"]).'</span></h6></div>
                                    </div>
                                </li>';
                            }elseif(preg_match("/Modific\b/", $respuesta[$i]["accion"])){
                                echo '<li>
                                    <i class="ion icon-mode_edit bg-warning"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($respuesta[$i]["fecha"]).'</span></h6></div>
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
  google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(columnChart);

      function columnChart() {
        var datos=document.getElementById('datosGrafica').value;
        var dato=datos.split("\n");
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string', 'Categoría');
        dataTable.addColumn('number', 'Total');
        // A column for custom tooltip content
        //dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
        var filas=[];
        //d.push(["Fecha","cm"]);
        var cols="";
        for (var i = 0; i < (dato.length - 1); i++) {
          cols=dato[i].split("|");
          //cols[1]=parseFloat(cols[1]).toFixed(2);
          //d.push([cols[0],parseFloat(cols[1]),"<div style='padding:5px 5px 5px 5px;'><p><b>"+cols[0]+"</b><br><label>$/cm:</label> <b>"+cols[1]+"</b></p><img src='images/obras/"+cols[2]+".jpg' style='width:85px;height:100px'/></div>"]);
          filas.push([cols[0],parseInt(cols[1])]);
          
        }
        console.log("filas", filas);
        //var data = google.visualization.arrayToDataTable(d);
        dataTable.addRows(filas);

        var options = {
            title:"Estadísticas"
            /*tooltip: {isHtml: true},
            legend: { position: 'left', maxLines: 3 },
            isStacked: true,
            titleTextStyle: {fontSize: 18},*/
            //chartArea: {'width': '65%', 'height': '65%'}
            //hAxis: { textPosition: 'none' },
            //hAxis: {slantedText:true, slantedTextAngle:90,maxTextLines: 10,textStyle: {fontSize: 12}}*/
        };

        
        var chart = new google.visualization.PieChart(document.getElementById("estadisticasGraficaBarra"));

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

<?php
}//termina else