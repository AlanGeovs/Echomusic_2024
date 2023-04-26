<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/favico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/favico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/favico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/favico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/favico/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/favico/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/favico/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/favico/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favico/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/assets/favico/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/favico/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favico/favicon-16x16.png">
    <link rel="manifest" href="/assets/favico/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/favico/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    
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
<main>
    <div id="primary" class="gray p-t-b-100 height-full responsive-phone">
        <div class="container"> 
            <div class="row">
                <div class="col-lg-6"> 
                    <img src="../assets/images/logo/echomusic-LOGO-HOR-BIC.png" width="400px" alt="logo" /> 
                    
                </div>
                <div class="col-lg-6 p-t-100">
                    <div class="text">
                        <h1>Inicio de Sesión</h1>
                        <p class="s-18 p-t-b-20 font-weight">Ingresa con tu usuario y contraseña!</p>
                    </div>
                    <form action="includes/validarLogin.php" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                                    <input type="email" name="correo" id="correo" class="form-control form-control-lg no-b" placeholder="Usuario">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group has-icon"><i class="icon-user-secret"></i>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg no-b" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-success btn-lg btn-block" value="Acceder">
                                <p class="forget-pass text">Problemas con tu usuario o contraseña?</p> 
                            </div>
                        </div>
                    </form>
                    <?php
                        if(@$_GET["error"]=="1"){
                            echo "<div class='alert alert-danger'>Tu correo y/o contraseña no son correctos, intentalo de nuevo...</div>";
                        }elseif(@$_GET["error"]=="2"){
                            echo "<div class='alert alert-danger'> Debes iniciar sesión para acceder al panel...</div>"; 
                        }  
                    ?>  
                </div>
            </div>
        </div>
    </div>
    <!-- #primary -->
</main>
<!-- Right Sidebar -->
<aside class="control-sidebar fixed white ">
    <div class="slimScroll">
        <div class="sidebar-header">
            <h4>Activity List</h4>
            <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
        </div>
        <div class="p-3">
            <div>
                <div class="my-3">
                    <small>25% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>45% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 45%;" aria-valuenow="45"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>60% Complete</small>
                    `
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;" aria-valuenow="60"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>75% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>100% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 bg-primary text-white">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="font-weight-normal s-14">Sodium</h5>
                    <span class="font-weight-lighter text-primary">Spark Bar</span>
                    <div> Oxygen
                        <span class="text-primary">
                                                    <i class="icon icon-arrow_downward"></i> 67%</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <canvas width="100" height="70" data-chart="spark" data-chart-type="bar"
                            data-dataset="[[28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100]]"
                            data-labels="['a','b','c','d','e','f','g','h','i','j','k','l','m','n','a','b','c','d','e','f','g','h','i','j','k','l','m','n']">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                <tbody>
                <tr>
                    <td>
                        <a href="#">INV-281281</a>
                    </td>
                    <td>
                        <span class="badge badge-success">Paid</span>
                    </td>
                    <td>$ 1228.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-01112</a>
                    </td>
                    <td>
                        <span class="badge badge-warning">Overdue</span>
                    </td>
                    <td>$ 5685.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-281012</a>
                    </td>
                    <td>
                        <span class="badge badge-success">Paid</span>
                    </td>
                    <td>$ 152.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-01112</a>
                    </td>
                    <td>
                        <span class="badge badge-warning">Overdue</span>
                    </td>
                    <td>$ 5685.28</td>
                </tr>
                <tr> 
                    <td>
                        <a href="#">INV-281012</a>
                    </td>
                    <td>
                        <span class="badge badge-success">Paid</span>
                    </td>
                    <td>$ 152.28</td>
                </tr>
                </tbody> 
            </table> 
        </div>
        <div class="sidebar-header">
            <h4>Activity</h4>
            <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
        </div>
        <div class="p-4">
            <div class="activity-item activity-primary">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 5 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit amet conse ctetur which ascing elit users.</p>
                </div>
            </div>
            <div class="activity-item activity-danger">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 8 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit ametcon the sectetur that ascing elit users.</p>
                </div>
            </div>
            <div class="activity-item activity-success">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 10 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit amet cons the ecte tur and adip ascing elit users.</p>
                </div>
            </div>
            <div class="activity-item activity-warning">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 12 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit amet consec tetur adip ascing elit users.</p>
                </div>
            </div>
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

</body>
</html>