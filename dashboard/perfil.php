<?php
session_start();

require_once "model/model.php";

if(!isset($_SESSION["idUser"])){
    header("Location: index.php?error=2");
}else{
  if ($_SESSION["tipoUsuario"]=="capturista") {
    if (isset($_GET["u"])) {
      //header("Location: listar_usuarios.php");
      $id=$_GET["u"];
      if ($id!=$_SESSION["idUser"]) {
        header("Location: site.php");
      }
    }else{
      header("Location: listar_usuarios.php");
    }
  }else{
    if (isset($_GET["u"])) {
      //header("Location: listar_usuarios.php");
      $id=$_GET["u"];
    }else{
      header("Location: listar_usuarios.php");
    }
  }
}
  


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
    <?php
      $tabla="usuarios";
      $respuesta=Consultas::detalleUsuario($id,$tabla);
    ?>
        <header class="white pt-3 relative shadow">
            <div class="container-fluid">
                <div class="row p-t-b-10 ">
                    <div class="col">
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
                </div>

              <div class="row">
                  <ul class="nav nav-material responsive-tab" id="v-pills-tab" role="tablist">
                      <li>
                          <a class="nav-link active" id="v-pills-tab1-tab" data-toggle="pill" href="#v-pills-tab1" role="tab" aria-controls="v-pills-tab1">
                              <i class="icon icon-home2"></i>Perfil
                          </a>
                      </li>
                      <!--<li>
                          <a class="nav-link" id="v-pills-payments-tab" data-toggle="pill" href="#v-pills-payments" role="tab" aria-controls="v-pills-payments" aria-selected="false"><i class="icon icon-money-1"></i>Payments</a>
                      </li>-->
                      <li>
                          <a class="nav-link" id="v-pills-timeline-tab" data-toggle="pill" href="#v-pills-timeline" role="tab" aria-controls="v-pills-timeline" aria-selected="false"><i class="icon icon-cog"></i>Bitácora</a>
                      </li>
                      <li>
                          <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="icon icon-cog"></i>Editar perfil</a>
                      </li>
                  </ul>
              </div>

            </div>
        </header>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
           <div class="tab-content" id="v-pills-tabContent">
               <div class="tab-pane fade show active" id="v-pills-tab1" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <div class="row">
                       <div class="col-md-3">
                           <div class="card ">

                               <ul class="list-group list-group-flush">
                                   <li class="list-group-item"><i class="icon icon-mobile text-primary"></i><strong class="s-12">Telefono</strong> <span class="float-right s-12"><?php echo $respuesta["telefono"]; ?></span></li>
                                   <li class="list-group-item"><i class="icon icon-mail text-success"></i><strong class="s-12">Correo</strong> <span class="float-right s-12"><?php echo $respuesta["correo"]; ?></span></li>
                                   <li class="list-group-item"><i class="icon icon-address-card-o text-warning"></i><strong class="s-12">Dirección</strong> <span class="float-right s-12"><?php echo $respuesta["direccion"]; ?></span></li>
                                   <li class="list-group-item"><i class="icon icon-web text-danger"></i> <strong class="s-12">Website</strong> <span class="float-right s-12">pappertemplate.com</span></li>
                               </ul>
                           </div>
                           <div class="card mt-3 mb-3">
                               <div class="card-header bg-white">
                                   <strong class="card-title">
                                    <?php
                                    $totalMarcas=Consultas::listarMarcas();
                                    if ($respuesta["tipo"]=="admin") {
                                      echo "Administrador";
                                      $datosMarca= Consultas::listarMarcasCapturista($_SESSION["idUser"]);
                                    }elseif ($respuesta["tipo"]=="capturista") {
                                      echo "Capturista";
                                      $datosMarca=Consultas::listarMarcasCapturista($id);
                                      //$datosCategoria=Consultas::listarCategoriasCapturistas($id);
                                    }
                                    ?></strong>

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

                               <!--<div class="card-header bg-white">
                                   <strong class="card-title">Siblings</strong>
                               </div>
                               <div>
                                   <ul class="list-group list-group-flush">
                                       <li class="list-group-item">
                                           <div class="image mr-3  float-left">
                                               <img class="user_avatar" src="assets/img/dummy/u1.png" alt="User Image">
                                           </div>
                                           <h6 class="p-t-10">Alexander Pierce</h6>
                                           <span> 4th Grade</span>
                                       </li>
                                       <li class="list-group-item">
                                           <div class="image mr-3  float-left">
                                               <img class="user_avatar" src="assets/img/dummy/u2.png" alt="User Image">
                                           </div>
                                           <h6 class="p-t-10">Alexander Pierce</h6>
                                           <span> 5th Grade</span>
                                       </li>
                                       <li class="list-group-item">
                                           <div class="image mr-3  float-left">
                                               <img class="user_avatar" src="assets/img/dummy/u5.png" alt="User Image">
                                           </div>
                                           <h6 class="p-t-10">Alexander Pierce</h6>
                                           <span> 6th Grade</span>
                                       </li>
                                       <li class="list-group-item">
                                           <div class="image mr-3  float-left">
                                               <img class="user_avatar" src="assets/img/dummy/u4.png" alt="User Image">
                                           </div>
                                           <h6 class="p-t-10">Alexander Pierce</h6>
                                           <span> 10th Grade</span>
                                       </li>
                                   </ul>
                               </div>-->

                           </div>

                       </div>
                       <div class="col-md-9">

                           <div class="row">
                               <div class="col-lg-4">
                                   <div class="card r-3">
                                       <div class="p-4">
                                           <div class="float-right">
                                               <span class="icon-award text-light-blue s-48"></span>
                                           </div>
                                           <div class="counter-title">Marcas registradas</div>
                                           <h5 class="sc-counter mt-3"><?php echo count($datosMarca); ?></h5>
                                       </div>
                                   </div>
                               </div>
                               <?php
                                  if ($_SESSION["tipoUsuario"]=="admin") {
                                    /*echo '<div class="col-lg-4">
                                       <div class="card r-3">
                                           <div class="p-4">
                                               <div class="float-right"><span class="icon-stop-watch3 s-48"></span>
                                               </div>
                                               <div class="counter-title ">Categorías registradas</div>
                                               <h5 class="sc-counter mt-3">12</h5>
                                           </div>
                                       </div>
                                   </div>';*/
                                  }
                               ?>
                               <div class="col-lg-4">
                                   <div class="white card">
                                       <div class="p-4">
                                           <div class="float-right"><span class="icon-orders s-48"></span>
                                           </div>
                                           <div class="counter-title">Id de usuario</div>
                                           <h5 class="sc-counter mt-3"><?php echo $id; ?></h5>
                                       </div>
                                   </div>
                               </div>
                           </div>

                           <div class="row my-3">
                               <!-- bar charts group -->
                               <div class="col-md-12">
                                   <div class="card">
                                       <div class="card-header white">
                                           <h6>Marcas registradas por <small><?php echo $respuesta["usuario"]; ?></small></h6>
                                       </div>
                                       <div class="card-body">
                                           <!--<div id="graphx" class="height-300"></div>-->
                                          <div class="table-responsive">
                                              <div id="grafica" style="height: 400px;"></div>
                                          </div>
                                          <textarea name="datosGrafica" id="datosGrafica" style="display: none;"><?php echo count($datosMarca)."|".(intval(count($totalMarcas)) - intval(count($datosMarca))); ?></textarea>
                                           
                                       </div>
                                   </div>
                               </div>
                               <!-- /bar charts group -->
                           </div>
                           
                       </div>
                   </div>
               </div>
               <div class="tab-pane fade" id="v-pills-payments" role="tabpanel" aria-labelledby="v-pills-payments-tab">
                   <div class="row">
                       <div class="col-md-12">
                           <div class="card no-b">
                               <div class="card-header white b-0 p-3">
                                   <h4 class="card-title">Invoices</h4>
                                   <small class="card-subtitle mb-2 text-muted">Items purchase by users.</small>
                               </div>
                               <div class="collapse show" id="invoiceCard">
                                   <div class="card-body p-0">
                                       <div class="table-responsive">
                                           <table id="recent-orders"
                                                  class="table table-hover mb-0 ps-container ps-theme-default">
                                               <thead class="bg-light">
                                               <tr>
                                                   <th>SKU</th>
                                                   <th>Invoice#</th>
                                                   <th>Customer Name</th>
                                                   <th>Status</th>
                                                   <th>Amount</th>
                                               </tr>
                                               </thead>
                                               <tbody>
                                               <tr>
                                                   <td>PAP-10521</td>
                                                   <td><a href="#">INV-281281</a></td>
                                                   <td>Baja Khan</td>
                                                   <td><span class="badge badge-success">Paid</span></td>
                                                   <td>$ 1228.28</td>
                                               </tr>
                                               <tr>
                                                   <td>PAP-532521</td>
                                                   <td><a href="#">INV-01112</a></td>
                                                   <td>Khan Sab</td>
                                                   <td><span class="badge badge-warning">Overdue</span>
                                                   </td>
                                                   <td>$ 5685.28</td>
                                               </tr>
                                               <tr>
                                                   <td>PAP-05521</td>
                                                   <td><a href="#">INV-281012</a></td>
                                                   <td>Bin Ladin</td>
                                                   <td><span class="badge badge-success">Paid</span></td>
                                                   <td>$ 152.28</td>
                                               </tr>
                                               <tr>
                                                   <td>PAP-15521</td>
                                                   <td><a href="#">INV-281401</a></td>
                                                   <td>Zoor Shoor</td>
                                                   <td><span class="badge badge-success">Paid</span></td>
                                                   <td>$ 1450.28</td>
                                               </tr>
                                               <tr>
                                                   <td>PAP-532521</td>
                                                   <td><a href="#">INV-01112</a></td>
                                                   <td>Khan Sab</td>
                                                   <td><span class="badge badge-warning">Overdue</span>
                                                   </td>
                                                   <td>$ 5685.28</td>
                                               </tr>
                                               <tr>
                                                   <td>PAP-05521</td>
                                                   <td><a href="#">INV-281012</a></td>
                                                   <td>Bin Ladin</td>
                                                   <td><span class="badge badge-success">Paid</span></td>
                                                   <td>$ 152.28</td>
                                               </tr>
                                               <tr>
                                                   <td>PAP-15521</td>
                                                   <td><a href="#">INV-281401</a></td>
                                                   <td>Zoor Shoor</td>
                                                   <td><span class="badge badge-success">Paid</span></td>
                                                   <td>$ 1450.28</td>
                                               </tr>
                                               <tr>
                                                   <td>PAP-32521</td>
                                                   <td><a href="#">INV-288101</a></td>
                                                   <td>Walter R.</td>
                                                   <td><span class="badge badge-warning">Overdue</span>
                                                   </td>
                                                   <td>$ 685.28</td>
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
               <div class="tab-pane fade" id="v-pills-timeline" role="tabpanel" aria-labelledby="v-pills-timeline-tab">
                   <div class="row">
                       <div class="col-md-12">
                           <!-- The time line -->
                            <ul class="timeline">
                              <?php
                              $hoyCorto=date("Y-m-d");
                              $hoyFin=date("Y-m-d")." 23:59:59";
                              $hoyInicio=date("Y-m-d")." 00:00:00";

                              $fechas=Consultas::bitacoraFechas("bitacora");
                              $res=Consultas::bitacoraPerfil("bitacora",$respuesta["usuario"]);
                              for ($j=0; $j < count($fechas); $j++) { 
                                if ($fechas[$j]["fechas"]==$hoyCorto) {
                                  //<!-- timeline time label -->
                                  echo '<li class="time-label">
                                      <span class="badge badge-danger r-3">
                                          Hoy
                                      </span>
                                  </li>';
                                 //<!-- /.timeline-label -->
                                  for ($i=0; $i < count($res); $i++) {
                                    if ($res[$i]["fecha"]<=$hoyFin && $res[$i]["fecha"]>=$hoyInicio) {  
                                        if (preg_match("/Inici\b/", $res[$i]["accion"])) {
                                           //<!-- timeline item -->
                                            echo '<li>
                                                <i class="ion icon-sign-in bg-primary"></i>
                                                <div class="timeline-item card">
                                                    <div class="card-header white"><h6>'.$res[$i]["usuario"].' '.$res[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($res[$i]["fecha"],11).'</span></h6></div>
                                                </div>
                                            </li>';
                                            //<!-- END timeline item -->
                                        }elseif(preg_match("/Registr\b/", $res[$i]["accion"])) {
                                            //<!-- timeline item -->
                                            echo '<li>
                                                <i class="ion icon-plus-circle bg-success"></i>
                                                <div class="timeline-item card">
                                                    <div class="card-header white"><h6>'.$res[$i]["usuario"].' '.$res[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($res[$i]["fecha"],11).'</span></h6></div>
                                                </div>
                                            </li>';
                                            //<!-- END timeline item -->
                                        }elseif(preg_match("/Elimin\b/", $res[$i]["accion"])){
                                            echo '<li>
                                                <i class="ion icon-trash bg-danger"></i>
                                                <div class="timeline-item card">
                                                    <div class="card-header white"><h6>'.$res[$i]["usuario"].' '.$res[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($res[$i]["fecha"],11).'</span></h6></div>
                                                </div>
                                            </li>';
                                        }elseif(preg_match("/Modific\b/", $res[$i]["accion"])){
                                            echo '<li>
                                                <i class="ion icon-mode_edit bg-warning"></i>
                                                <div class="timeline-item card">
                                                    <div class="card-header white"><h6>'.$res[$i]["usuario"].' '.$res[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($res[$i]["fecha"],11).'</span></h6></div>
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

                                  for ($i=0; $i < count($res); $i++) {
                                      //echo substr($respuesta[$i]["fecha"],0,10);
                                      if ($diff->days!=0 && substr($res[$i]["fecha"],0,10)==$fechas[$j]["fechas"]) {
                                          
                                          if (preg_match("/Inici\b/", $res[$i]["accion"])) {
                                             //<!-- timeline item -->
                                              echo '<li>
                                                  <i class="ion icon-sign-in bg-primary"></i>
                                                  <div class="timeline-item card">
                                                      <div class="card-header white"><h6>'.$res[$i]["usuario"].' '.$res[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($res[$i]["fecha"]).'</span></h6></div>
                                                  </div>
                                              </li>';
                                              //<!-- END timeline item -->
                                          }elseif(preg_match("/Registr\b/", $res[$i]["accion"])) {
                                              //<!-- timeline item -->
                                              echo '<li>
                                                  <i class="ion icon-plus-circle bg-success"></i>
                                                  <div class="timeline-item card">
                                                      <div class="card-header white"><h6>'.$res[$i]["usuario"].' '.$res[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($res[$i]["fecha"]).'</span></h6></div>
                                                  </div>
                                              </li>';
                                              //<!-- END timeline item -->
                                          }elseif(preg_match("/Elimin\b/", $res[$i]["accion"])){
                                              echo '<li>
                                                  <i class="ion icon-trash bg-danger"></i>
                                                  <div class="timeline-item card">
                                                      <div class="card-header white"><h6>'.$res[$i]["usuario"].' '.$res[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($res[$i]["fecha"]).'</span></h6></div>
                                                  </div>
                                              </li>';
                                          }elseif(preg_match("/Modific\b/", $res[$i]["accion"])){
                                              echo '<li>
                                                  <i class="ion icon-mode_edit bg-warning"></i>
                                                  <div class="timeline-item card">
                                                      <div class="card-header white"><h6>'.$res[$i]["usuario"].' '.$res[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($res[$i]["fecha"]).'</span></h6></div>
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
               <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                  <?php
                    $datos=Consultas::datosPerfil($id,"usuarios");
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

    google.charts.setOnLoadCallback(pieChart);

    function pieChart() {
      var datos=document.getElementById('datosGrafica').value;
      var dato=datos.split("|");
      var dataTable = new google.visualization.DataTable();
      dataTable.addColumn('string', 'Marcas registradas');
      dataTable.addColumn('number', 'Total de marcas');
      // A column for custom tooltip content
      //dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
      var filas=[];
      //d.push(["Fecha","cm"]);

      filas.push(["Mis marcas",parseInt(dato[0])]);
      filas.push(["Total de marcas",parseInt(dato[1])]);
          

      console.log("filas", filas);
      //var data = google.visualization.arrayToDataTable(d);
      dataTable.addRows(filas);

      var options = {
          title:"Marcas registrdas por el usuario / total de marcas"
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
