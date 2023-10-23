<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.x.x/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Hoja de estilos de Croppie -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

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
            font-size: 1.5rem;
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
                    <!--Perfil-->
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header bg-white">
                                <div class="image  ">
                                    <img class="user_avatar2 no-b no-p" src="images/usuarios/<?php echo $_SESSION["nick_user"]; ?>.jpg" alt="<?php echo  $_SESSION["nick_user"]; ?> ">


                                    <!-- Button  modal Editar Foto -->
                                    <button id="upload-trigger">Subir Foto de Perfil</button>

                                    <div id="upload-modal" style="display: none;">
                                        <input type="file" id="upload-image" accept="image/*">
                                        <div id="preview-image"></div>
                                        <button id="save">Guardar</button>
                                    </div>


                                </div>
                                <div class="text-center mt-3 mb-3">
                                    <strong class="card-title">
                                        Seguidores 1 | Seguidos 1 | Publicaciones 10
                                    </strong>

                                    <!-- Nombre del Artista -->
                                    <!-- <h2><?php echo $_SESSION['nick_user']; ?></h2> -->
                                    <h2>Juan Perez</h2>
                                    <!-- Social Media -->
                                    <strong class="card-title">
                                        Facebook | Instagram | YouTube
                                    </strong>
                                    <!-- Biografía -->
                                    <div class="text-center mt-3 mb3">
                                        <p>Esta es la descripción ... </p>
                                    </div>

                                </div>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="icon icon-user "></i><strong class="s-12">Nicknate: </strong> JuanPerez<span class="float-right s-12"><?php //echo $respuesta["telefono"]; 
                                                                                                                                                                            ?></span></li>

                                <li class="list-group-item"><i class="icon icon-map-marker "></i><strong class="s-12">Ciudad</strong> <span class="float-right s-12"><?php echo $respuesta["telefono"]; ?></span></li>
                                <li class="list-group-item"><i class="icon icon-music_note  "></i><strong class="s-12">Género</strong> <span class="float-right s-12"><?php echo $respuesta["correo"]; ?></span></li>
                                <li class="list-group-item"><i class="icon icon-music   "></i><strong class="s-12">SubGénero</strong> <span class="float-right s-12"><?php echo $respuesta["correo"]; ?></span></li>
                                <li class="list-group-item"><i class="icon icon-document-music  "></i><strong class="s-12">Tipo de Artista</strong> <span class="float-right s-12"><?php echo $respuesta["direccion"]; ?></span></li>

                            </ul>

                            <div class="card-header bg-white text-right">
                                <div class="form-group">
                                    <div class="col-sm-offset-12 col-sm-12">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal"> Editar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3 mb-3">
                            <div class="card-header bg-white">
                                <strong class="card-title">
                                    Biografía
                                </strong>
                                <p>Desde el 2019, Safo999 utiliza la música como una vía para narrar sus vivencias personales. Sensibilizando a una realidad nocturna y melancólica, cargada de emociones personales, sensibilizando hacia una realidad nocturna, melancólica y cargada de emociones personales. De esta forma, el sonido de la artista experimenta tanto el dream pop como el indie rock para crear canciones con una marcada identidad.</p>

                            </div>
                            <!-- <ul class="no-b">
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

                            </ul> -->

                        </div>

                    </div>

                    <!--Portada Dashboard-->
                    <div class="col-md-8">
                        <div class="row">
                            <!--Videos-->
                            <div class="col-lg-6">
                                <div class="card r-3">
                                    <div class="p-4">
                                        <div class="float-right">
                                            <span class="icon-plus text-light-blue s-48"> </span>
                                        </div>
                                        <div class="counter-title">Videos</div>
                                        <!-- <h6 class="sc-counter mt-3"><?php echo count($datosMarca); ?></h6> -->
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Mi lista de videos</h3>
                                                <div class="box-tools">
                                                    <ul class="pagination pagination-sm no-margin float-right">
                                                        <li class="page-item"><a href="#" class="page-link">«</a>
                                                        </li>
                                                        <li class="page-item"><a href="#" class="page-link">1</a>
                                                        </li>
                                                        <li class="page-item"><a href="#" class="page-link">2</a>
                                                        </li>
                                                        <li class="page-item"><a href="#" class="page-link">3</a>
                                                        </li>
                                                        <li class="page-item"><a href="#" class="page-link">»</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body no-padding">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Video</th>
                                                            <th>Tiempo</th>
                                                            <th>Editar</th>
                                                        </tr>
                                                        <tr>
                                                            <td>1.</td>
                                                            <td>Update software</td>
                                                            <td>
                                                                <div class="progress progress-xs">
                                                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                                </div>
                                                            </td>
                                                            <td><span class="badge text-white bg-red">55%</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2.</td>
                                                            <td>Clean database</td>
                                                            <td>
                                                                <div class="progress progress-xs">
                                                                    <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                                                                </div>
                                                            </td>
                                                            <td><span class="badge text-white bg-yellow">70%</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3.</td>
                                                            <td>Cron job running</td>
                                                            <td>
                                                                <div class="progress progress-xs progress-striped active">
                                                                    <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                                                </div>
                                                            </td>
                                                            <td><span class="badge text-white bg-light-blue">30%</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>4.</td>
                                                            <td>Fix and squish bugs</td>
                                                            <td>
                                                                <div class="progress progress-xs progress-striped active">
                                                                    <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                                                </div>
                                                            </td>
                                                            <td><span class="badge text-white bg-green">90%</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
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
                                            <span class="icon-plus text-light-blue s-48"> </span>
                                        </div>
                                        <div class="counter-title">Spotify</div>
                                        <!-- <h6 class="sc-counter mt-3"><?php echo count($datosMarca); ?></h6> -->

                                        <iframe width="100%" height="300" scrolling="no" frameborder="no" allow="" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/1585941613&color=%23151f29&auto_play=true&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>

                                    </div>

                                    <div class="float-right">
                                        <button type="button" class="btn btn-outline-danger btn-xs"> <i class="icon-delete"></i> Borrar </button>
                                        <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-edit"></i> Editar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Fotografias-->
                    <div class="row my-3">
                        <!-- Fotografias -->
                        <div class="col-md-12">
                            <div class="card r-3">
                                <div class="card-header white">
                                    <h6>Fotografías <small> </small></h6>
                                </div>

                                <div class="container mt-5">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                            <?php for ($i = 1; $i < 10; $i++) : ?>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"></li>
                                            <?php endfor; ?>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="https://picsum.photos/800/400?random=1" class="d-block w-100" alt="...">
                                            </div>
                                            <?php for ($i = 2; $i <= 10; $i++) : ?>
                                                <div class="carousel-item">
                                                    <img src="https://picsum.photos/800/400?random=<?php echo $i; ?>" class="d-block w-100" alt="...">
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="float-right mt-3 text-right">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                        Insertar Galería
                                    </button>
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
                                    <h6>Integrantes <small> </small></h6>


                                    <div class="container mt-5">
                                        <div id="teamCarousel" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="d-flex justify-content-around">
                                                        <!-- Usuario 1 -->
                                                        <div class="card user-card">
                                                            <img src="https://picsum.photos/100/100?random=1" alt="User 1" class="card-img-top mx-auto mt-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Usuario 1</h5>
                                                                <p class="card-text">Cargo 1</p>
                                                            </div>
                                                        </div>
                                                        <!-- Usuario 2 -->
                                                        <div class="card user-card">
                                                            <img src="https://picsum.photos/100/100?random=2" alt="User 2" class="card-img-top mx-auto mt-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Usuario 2</h5>
                                                                <p class="card-text">Cargo 2</p>
                                                            </div>
                                                        </div>
                                                        <!-- Usuario 3 -->
                                                        <div class="card user-card">
                                                            <img src="https://picsum.photos/100/100?random=3" alt="User 3" class="card-img-top mx-auto mt-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Usuario 3</h5>
                                                                <p class="card-text">Cargo 3</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="d-flex justify-content-around">
                                                        <!-- Usuario 4 -->
                                                        <div class="card user-card">
                                                            <img src="https://picsum.photos/100/100?random=4" alt="User 4" class="card-img-top mx-auto mt-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Usuario 4</h5>
                                                                <p class="card-text">Cargo 4</p>
                                                            </div>
                                                        </div>
                                                        <!-- Usuario 5 -->
                                                        <div class="card user-card">
                                                            <img src="https://picsum.photos/100/100?random=5" alt="User 5" class="card-img-top mx-auto mt-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Usuario 5</h5>
                                                                <p class="card-text">Cargo 5</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#teamCarousel" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#teamCarousel" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>



                                </div>

                                <div class="float-right mt-3 text-right">
                                    <!-- Botón para abrir el modal -->
                                    <button class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#addMemberModal">Agregar Integrante</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Presskit-->
                    <div class="row my-3">

                        <div class="col-md-12">
                            <div class="card r-3">
                                <div class="card-header white">
                                    <h6>Presskit <small> </small></h6>
                                </div>

                                <div class="float-right">
                                    <button type="button" class="btn btn-outline-danger btn-xs"> <i class="icon-delete"></i> Borrar </button>
                                    <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-edit"></i> Editar </button>
                                </div>
                            </div>
                        </div>
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
    </div>

    </div>

    <!-- Modales -->
    <!-- Modal Editar datos -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar datos de usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <!-- <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close"></button> -->

                </div>
                <div class="modal-body">
                    <form action="ruta_tu_archivo_php.php" method="post">
                        <div class="col-md-6  ">
                            <label for="nick_user" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" id="nick_user" name="nick_user" value="<?php echo $nick_user; ?>">
                        </div>
                        <div class="col-md-6  ">
                            <label for="mail_user" class="form-label">Email</label>
                            <input type="email" class="form-control" id="mail_user" name="mail_user" value="<?php echo $mail_user; ?>">
                        </div>
                        <div class="col-md-6 ">
                            <label for="nick_user" class="form-label">Género</label>
                            <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $genero; ?>">
                        </div>
                        <div class="col-md-6  ">
                            <label for="id_city" class="form-label">Tipo de artista</label>
                            <input type="text" class="form-control" id="type_artist" name="type_artist" value="<?php echo $type_artist; ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Fotos -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel">Galería Fotográfica</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <!-- Usamos un bucle para generar los 10 campos -->
                            <?php for ($i = 1; $i <= 10; $i++) : ?>
                                <div class="mb-3 col-md-6">
                                    <label for="photo<?php echo $i; ?>" class="form-label">Foto <?php echo $i; ?>:</label>
                                    <input type="file" class="form-control" id="photo<?php echo $i; ?>" name="photo<?php echo $i; ?>">
                                </div>
                            <?php endfor; ?>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar fotos</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Integrantes -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Agregar Integrante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Subir foto -->
                        <div class="mb-3">
                            <label for="memberPhoto" class="form-label">Foto del integrante</label>
                            <input type="file" class="form-control" id="memberPhoto" accept="image/*">
                        </div>
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="memberName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="memberName" placeholder="Ej. Juan Pérez">
                        </div>
                        <!-- Puesto -->
                        <div class="mb-3">
                            <label for="memberRole" class="form-label">Rol</label>
                            <input type="text" class="form-control" id="memberRole" placeholder="Ej. Cantante">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
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


    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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

    <!-- Croppie uEditar foto de perfil -->
    <script>
        let croppieInstance = null;

        document.getElementById('upload-trigger').addEventListener('click', function() {
            document.getElementById('upload-modal').style.display = 'block';
        });

        document.getElementById('upload-image').addEventListener('change', function(event) {
            let reader = new FileReader();

            reader.onload = function(e) {
                if (croppieInstance !== null) {
                    croppieInstance.destroy();
                }

                let el = document.getElementById('preview-image');
                croppieInstance = new Croppie(el, {
                    viewport: {
                        width: 150,
                        height: 150,
                        type: 'circle'
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    }
                });

                croppieInstance.bind({
                    url: e.target.result
                });
            }

            reader.readAsDataURL(this.files[0]);
        });

        document.getElementById('save').addEventListener('click', function() {
            croppieInstance.result('base64').then(function(base64Image) {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'includes/upload_image_profile.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        // La imagen fue guardada correctamente
                        alert('Imagen guardada exitosamente! ');
                    } else {
                        // Error al guardar la imagen
                        alert('Error al guardar la imagen.');
                    }
                };

                xhr.send('image=' + base64Image);
            });
        });
    </script>

</body>

</html>