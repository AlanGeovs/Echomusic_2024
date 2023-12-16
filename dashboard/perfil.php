 <?php
    session_start();

    require_once "model/model.php";

    if (!isset($_SESSION["id_user"])) {
        header("Location: index.php?error=2");
    } else {


        // if (!isset($_SESSION["id_user"])) {
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
                                 <a class="nav-link active" data-toggle="pill" href="editar.php">
                                     <i class="icon icon-home2"></i>Editar
                                 </a>
                             </li>
                             <li>
                                 <a class="nav-link" data-toggle="pill" href="mis-tarifas.php">
                                     <i class="icon icon-edit"></i>Mis tarifas
                                 </a>
                             </li>
                             <li>
                                 <a class="nav-link" data-toggle="pill" href="reservas.php">
                                     <i class="icon icon-cog"></i>Reservas
                                 </a>
                             </li>

                         </ul>
                     </div>

                     <div class="row">
                         <ul class="nav nav-material responsive-tab" id="v-pills-tab" role="tablist">
                             <li>
                                 <a class="nav-link active" id="perfil-tab" data-toggle="pill" href="#perfil" role="tab" aria-controls="perfil">
                                     <i class="icon icon-home2"></i>Perfil
                                 </a>
                             </li>
                             <li>
                                 <a class="nav-link" id="v-pills-timeline-tab" data-toggle="pill" href="#eventos" role="tab" aria-controls="v-pills-timeline" aria-selected="false"><i class="icon icon-event_note"></i>Eventos</a>
                             </li>
                             <li>
                                 <a class="nav-link" id="v-pills-timeline-tab" data-toggle="pill" href="#crowdfunding" role="tab" aria-controls="v-pills-timeline" aria-selected="false"><i class="icon icon-attach_money"></i>Crowdfunding</a>
                             </li>
                             <li>
                                 <a class="nav-link" id="v-pills-timeline-tab" data-toggle="pill" href="#v-pills-timeline" role="tab" aria-controls="v-pills-timeline" aria-selected="false"><i class="icon icon-cog"></i>Bitácora</a>
                             </li>
                             <li>
                                 <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="icon icon-cog"></i>Editar accesos</a>
                             </li>
                         </ul>
                     </div>

                 </div>
             </header>

             <div class="container-fluid animatedParent animateOnce my-3">
                 <div class="animated fadeInUpShort">
                     <!--Perfíl-->
                     <div class="tab-content" id="v-pills-tabContent">
                         <div class="tab-pane fade show active" id="perfil" role="tabpanel" aria-labelledby="v-pills-home-tab">
                             <div class="row">
                                 <!--Perfil-->
                                 <div class="col-md-4">
                                     <div class="card ">
                                         <div class="card-header bg-white">
                                             <div class="image  ">
                                                 <img class="user_avatar2 no-b no-p" src="images/usuarios/<?php echo $respuesta["usuario"]; ?>.jpg" alt="<?php echo  $respuesta["usuario"]; ?>">
                                             </div>
                                             <div class="text-center mt-3 mb-3">
                                                 <strong class="card-title">
                                                     Seguidores 1 | Seguidos 1 | Publicaciones 10
                                                 </strong>

                                                 <!-- Nombre del Artista -->
                                                 <h2><?php echo $respuesta['usuario']; ?></h2>
                                                 <!-- Social Media -->
                                                 <strong class="card-title">
                                                     Facebook | Instagram | YouTube
                                                 </strong>
                                                 <!-- Biografía -->
                                                 <div class="text-center mt-3 mb3">
                                                     <p>Esta es la biografía asd ... </p>
                                                 </div>

                                             </div>
                                         </div>

                                         <ul class="list-group list-group-flush">
                                             <li class="list-group-item"><i class="icon icon-map-marker "></i><strong class="s-12">Ciudad</strong> <span class="float-right s-12"><?php echo $respuesta["telefono"]; ?></span></li>
                                             <li class="list-group-item"><i class="icon icon-music_note  "></i><strong class="s-12">Género</strong> <span class="float-right s-12"><?php echo $respuesta["correo"]; ?></span></li>
                                             <li class="list-group-item"><i class="icon icon-document-music  "></i><strong class="s-12">Tipo de Artista</strong> <span class="float-right s-12"><?php echo $respuesta["direccion"]; ?></span></li>
                                             <li class="list-group-item"><i class="icon icon-web  "></i> <strong class="s-12">Website</strong> <span class="float-right s-12">pappertemplate.com</span></li>
                                         </ul>

                                         <div class="card-header bg-white text-right">
                                             <div class="form-group">
                                                 <div class="col-sm-offset-12 col-sm-12">
                                                     <!--<button type="submit" class="btn btn-success">  </button>-->
                                                     <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-clipboard-edit2"></i> Editar </button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <!-- <div class="card mt-3 mb-3">
                                    <div class="card-header bg-white">
                                        <strong class="card-title">
                                            <?php
                                            $totalMarcas = Consultas::listarMarcas();
                                            if ($respuesta["tipo"] == "admin") {
                                                echo "Administrador";
                                                $datosMarca = Consultas::listarMarcasCapturista($_SESSION["idUser"]);
                                            } elseif ($respuesta["tipo"] == "capturista") {
                                                echo "Capturista";
                                                $datosMarca = Consultas::listarMarcasCapturista($id);
                                                //$datosCategoria=Consultas::listarCategoriasCapturistas($id);
                                            }
                                            ?></strong>
                                        <p>Datos bancarios</p>

                                    </div>
                                    <ul class="no-b">
                                        <li class="list-group-item">
                                            <a href="">
                                                <div class="image mr-3  float-left">
                                                    <img class="user_avatar" src="images/usuarios/<?php echo  $respuesta["usuario"]; ?>.jpg" alt="<?php echo  $respuesta["usuario"]; ?>">
                                                </div>
                                                <h6 class="p-t-10"><?php echo $respuesta["usuario"]; ?></h6>
                                                <span><i class="icon-mobile-phone"></i><?php echo $respuesta["telefono"]; ?></span>
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><i class="icon icon-bank"></i><strong class="s-12"><a href="">Agregar cuenta bancaria</a> </strong> <span class="float-right s-12"><?php echo $respuesta["telefono"]; ?></span></li>

                                    </ul>
 

                                </div> -->

                                 </div>

                                 <!--Portada Dashboard-->

                                 <div class="col-md-8">
                                     <div class="row">

                                         <!--Eventos-->
                                         <!-- <div class="col-lg-4">
                                        <div class="card r-3">
                                            <div class="p-4">
                                                <div class="float-right">
                                                    <span class="icon-event_available text-light-blue s-48"> </span>
                                                </div>
                                                <div class="counter-title">Eventos nuevos</div>
                                                <h6 class="sc-counter mt-3"><?php echo count($datosMarca); ?></h6>

                                            </div>
                                        </div>
                                    </div> -->

                                         <!--Eventsopasados-->
                                         <!-- <div class="col-lg-4">
                                        <div class="card r-3">
                                            <div class="p-4">
                                                <div class="float-right">
                                                    <span class="icon-event_busy text-light-blue s-48"> </span>
                                                </div>
                                                <div class="counter-title">Eventos anteriores</div>
                                                <h6 class="sc-counter mt-3"><?php echo count($datosMarca); ?></h5>
                                            </div>
                                        </div>
                                    </div> -->

                                         <!--Videos-->
                                         <div class="col-lg-6">
                                             <div class="card r-3">
                                                 <div class="p-4">
                                                     <div class="float-right">
                                                         <span class="icon-youtube-play text-light-blue s-48"> </span>
                                                     </div>
                                                     <div class="counter-title">Videos</div>
                                                     <h6 class="sc-counter mt-3"><?php echo count($datosMarca); ?></h6>
                                                     <div class="float-right">
                                                         <button type="button" class="btn btn-outline-danger btn-xs"> <i class="icon-delete"></i> Borrar </button>
                                                         <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-edit"></i> Editar </button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>

                                         <!-- Spotify -->
                                         <div class="col-lg-6">
                                             <div class="card r-3">
                                                 <div class="p-4">
                                                     <div class="float-right">
                                                         <span class="icon-spotify text-light-blue s-48"> </span>
                                                     </div>
                                                     <div class="counter-title">Spotify</div>
                                                     <h6 class="sc-counter mt-3"><?php echo count($datosMarca); ?></h6>
                                                     <div class="float-right">
                                                         <button type="button" class="btn btn-outline-danger btn-xs"> <i class="icon-delete"></i> Borrar </button>
                                                         <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-edit"></i> Editar </button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <!--Graficos-->
                                     <div class="row my-3">
                                         <!-- Fotografias -->
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
                                     </div>

                                     <!--integrantes-->
                                     <div class="row my-3">

                                         <!-- integrantes -->
                                         <div class="col-md-12">
                                             <div class="card r-3">
                                                 <div class="card-header white">
                                                     <h6>integrantes <small> </small></h6>
                                                 </div>

                                                 <div class="float-right">
                                                     <button type="button" class="btn btn-outline-danger btn-xs"> <i class="icon-delete"></i> Borrar </button>
                                                     <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-edit"></i> Editar </button>
                                                 </div>
                                             </div>
                                         </div>
                                         <!-- /bar charts group -->


                                     </div>


                                     <!--Reservas-->
                                     <!-- <div class="row my-3">
 
                                    <div class="col-md-6">
                                        <div class="card r-3">
                                            <div class="card-header white">
                                                <h6>Mis Reservas <small> </small></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card r-3">
                                            <div class="card-header white">
                                                <h6>Mis Reservas <small> </small></h6>
                                            </div>
                                        </div>
                                    </div>


                                </div> -->


                                 </div>






                             </div>

                         </div>
                         <!--Eventos-->
                         <div class="tab-pane fade" id="eventos" role="tabpanel" aria-labelledby="v-pills-payments-tab">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="card no-b">
                                         <div class="card-header white b-0 p-3">
                                             <h4 class="card-title">Eventos</h4>
                                             <small class="card-subtitle mb-2 text-muted">Listado de eventos próximos y pasados.</small>
                                         </div>
                                         <div class="col-md-6 mb-3 mt-15">
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

                         <!--Crowdfounding-->
                         <div class="tab-pane fade" id="crowdfunding" role="tabpanel" aria-labelledby="v-pills-timeline-tab">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="card no-b">
                                         <div class="card-header white b-0 p-3">
                                             <h4 class="card-title">Crowdfounding</h4>
                                             <small class="card-subtitle mb-2 text-muted">Listado de Crowdfounding.</small>
                                         </div>
                                         <div class="col-md-6 mb-3 mt-15">
                                             <a href="registrar_marca.php" class="btn btn-primary btn-xs r-20"><i class="icon-plus-circle mr-2"></i>Proyecto</a>
                                         </div>
                                         <div class="collapse show" id="invoiceCard">
                                             <div class="card-body p-0">
                                                 <div class="table-responsive">
                                                     <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                                                         <thead class="bg-light">
                                                             <tr>
                                                                 <th>ID</th>
                                                                 <th>Nombre</th>
                                                                 <th>Lugar</th>
                                                                 <th>Plazo de ejecució</th>
                                                                 <th>Status</th>
                                                                 <th>Total recaudado</th>
                                                                 <th>Acciones</th>
                                                             </tr>
                                                         </thead>
                                                         <tbody>
                                                             <tr>
                                                                 <td>CF-1324</td>
                                                                 <td><a href="#">Alto Voltaje Nuevo disco</a></td>
                                                                 <td>Metropolitana</td>
                                                                 <td>19 de Jul, 2023</td>
                                                                 <td><span class="badge badge-danger">Expirado</span></td>
                                                                 <td>$790,000 de $8,000,000</td>
                                                                 <td>
                                                                     <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href=""><i class="icon-pencil"></i></a>
                                                                     <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick=""><i class="icon-trash"></i></a>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td>CF-1546</td>
                                                                 <td><a href="#">Alto Voltaje Nuevo disco</a></td>
                                                                 <td>Metropolitana</td>
                                                                 <td>19 de Oct, 2023</td>
                                                                 <td><span class="badge badge-warning">En proceso</span></td>
                                                                 <td>$50,000 de $8,000,000</td>
                                                                 <td>
                                                                     <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href=""><i class="icon-pencil"></i></a>
                                                                     <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick=""><i class="icon-trash"></i></a>
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

                         <!--Bitácora-->
                         <div class="tab-pane fade" id="v-pills-timeline" role="tabpanel" aria-labelledby="v-pills-timeline-tab">
                             <div class="row">
                                 <div class="col-md-12">
                                     <!-- The time line -->
                                     <ul class="timeline">
                                         <?php
                                            $hoyCorto = date("Y-m-d");
                                            $hoyFin = date("Y-m-d") . " 23:59:59";
                                            $hoyInicio = date("Y-m-d") . " 00:00:00";

                                            $fechas = Consultas::bitacoraFechas("bitacora");
                                            $res = Consultas::bitacoraPerfil("bitacora", $respuesta["usuario"]);
                                            for ($j = 0; $j < count($fechas); $j++) {
                                                if ($fechas[$j]["fechas"] == $hoyCorto) {
                                                    //<!-- timeline time label -->
                                                    echo '<li class="time-label">
                                      <span class="badge badge-danger r-3">
                                          Hoy
                                      </span>
                                  </li>';
                                                    //<!-- /.timeline-label -->
                                                    for ($i = 0; $i < count($res); $i++) {
                                                        if ($res[$i]["fecha"] <= $hoyFin && $res[$i]["fecha"] >= $hoyInicio) {
                                                            if (preg_match("/Inici\b/", $res[$i]["accion"])) {
                                                                //<!-- timeline item -->
                                                                echo '<li>
                                                <i class="ion icon-sign-in bg-primary"></i>
                                                <div class="timeline-item card">
                                                    <div class="card-header white"><h6>' . $res[$i]["usuario"] . ' ' . $res[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($res[$i]["fecha"], 11) . '</span></h6></div>
                                                </div>
                                            </li>';
                                                                //<!-- END timeline item -->
                                                            } elseif (preg_match("/Registr\b/", $res[$i]["accion"])) {
                                                                //<!-- timeline item -->
                                                                echo '<li>
                                                <i class="ion icon-plus-circle bg-success"></i>
                                                <div class="timeline-item card">
                                                    <div class="card-header white"><h6>' . $res[$i]["usuario"] . ' ' . $res[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($res[$i]["fecha"], 11) . '</span></h6></div>
                                                </div>
                                            </li>';
                                                                //<!-- END timeline item -->
                                                            } elseif (preg_match("/Elimin\b/", $res[$i]["accion"])) {
                                                                echo '<li>
                                                <i class="ion icon-trash bg-danger"></i>
                                                <div class="timeline-item card">
                                                    <div class="card-header white"><h6>' . $res[$i]["usuario"] . ' ' . $res[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($res[$i]["fecha"], 11) . '</span></h6></div>
                                                </div>
                                            </li>';
                                                            } elseif (preg_match("/Modific\b/", $res[$i]["accion"])) {
                                                                echo '<li>
                                                <i class="ion icon-mode_edit bg-warning"></i>
                                                <div class="timeline-item card">
                                                    <div class="card-header white"><h6>' . $res[$i]["usuario"] . ' ' . $res[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($res[$i]["fecha"], 11) . '</span></h6></div>
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

                                                    for ($i = 0; $i < count($res); $i++) {
                                                        //echo substr($respuesta[$i]["fecha"],0,10);
                                                        if ($diff->days != 0 && substr($res[$i]["fecha"], 0, 10) == $fechas[$j]["fechas"]) {

                                                            if (preg_match("/Inici\b/", $res[$i]["accion"])) {
                                                                //<!-- timeline item -->
                                                                echo '<li>
                                                  <i class="ion icon-sign-in bg-primary"></i>
                                                  <div class="timeline-item card">
                                                      <div class="card-header white"><h6>' . $res[$i]["usuario"] . ' ' . $res[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($res[$i]["fecha"]) . '</span></h6></div>
                                                  </div>
                                              </li>';
                                                                //<!-- END timeline item -->
                                                            } elseif (preg_match("/Registr\b/", $res[$i]["accion"])) {
                                                                //<!-- timeline item -->
                                                                echo '<li>
                                                  <i class="ion icon-plus-circle bg-success"></i>
                                                  <div class="timeline-item card">
                                                      <div class="card-header white"><h6>' . $res[$i]["usuario"] . ' ' . $res[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($res[$i]["fecha"]) . '</span></h6></div>
                                                  </div>
                                              </li>';
                                                                //<!-- END timeline item -->
                                                            } elseif (preg_match("/Elimin\b/", $res[$i]["accion"])) {
                                                                echo '<li>
                                                  <i class="ion icon-trash bg-danger"></i>
                                                  <div class="timeline-item card">
                                                      <div class="card-header white"><h6>' . $res[$i]["usuario"] . ' ' . $res[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($res[$i]["fecha"]) . '</span></h6></div>
                                                  </div>
                                              </li>';
                                                            } elseif (preg_match("/Modific\b/", $res[$i]["accion"])) {
                                                                echo '<li>
                                                  <i class="ion icon-mode_edit bg-warning"></i>
                                                  <div class="timeline-item card">
                                                      <div class="card-header white"><h6>' . $res[$i]["usuario"] . ' ' . $res[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($res[$i]["fecha"]) . '</span></h6></div>
                                                  </div>
                                              </li>';
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                            ?>


                                         <li>
                                             <i class="ion icon-clock-o bg-gray"></i>
                                         </li>
                                     </ul>
                                 </div>
                                 <!-- /.col -->
                             </div>
                         </div>

                         <!--Editar Accesos-->
                         <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                             <?php
                                $datos = Consultas::datosPerfil($id, "usuarios");
                                ?>
                             <form class="form-horizontal" action="includes/editarUsuario_db.php" enctype="multipart/form-data" method="post">
                                 <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $id; ?>">
                                 <div class="form-group">
                                     <label for="nombre" class="col-sm-2 control-label">Usuario</label>

                                     <div class="col-sm-10">
                                         <input class="form-control" id="nombre" name="nombre" value="<?php echo $datos["usuario"]; ?>" type="text">
                                     </div>
                                 </div>
                                 <!--<div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                           <div class="col-sm-10">
                               <input class="form-control" id="inputEmail" placeholder="Email" type="email">
                           </div>
                       </div>-->
                                 <div class="form-group">
                                     <label for="pass" class="col-sm-2 control-label">Contraseña</label>

                                     <div class="col-sm-10">
                                         <input class="form-control" id="pass" name="pass" value="<?php echo $datos["password"]; ?>" type="password">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="passNuevo" class="col-sm-2 control-label">Nueva contraseña</label>

                                     <div class="col-sm-10">
                                         <input class="form-control" id="passNuevo" name="passNuevo" placeholder="Nueva contraseña" type="password">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="passNuevoConfirm" class="col-sm-2 control-label">Confirmar contraseña</label>

                                     <div class="col-sm-10">
                                         <input class="form-control" id="passNuevoConfirm" name="passNuevoConfirm" placeholder="Confirmar nueva contraseña" type="password">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="nuevaFoto" class="col-sm-2 control-label">Cambiar foto</label>

                                     <div class="col-sm-10">
                                         <input class="form-control" id="nuevaFoto" name="nuevaFoto" placeholder="Confirmar nueva contraseña" type="file">
                                     </div>
                                 </div>
                                 <!--<div class="form-group">
                           <div class="col-sm-offset-2 col-sm-10">
                               <div class="checkbox">
                                   <label>
                                       <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                   </label>
                               </div>
                           </div>
                       </div>-->
                                 <div class="form-group">
                                     <div class="col-sm-offset-2 col-sm-10">
                                         <button type="submit" class="btn btn-warning">Guardar <i class="icon-save2"></i></button>
                                     </div>
                                 </div>
                             </form>
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
 <?php
    }//termina else