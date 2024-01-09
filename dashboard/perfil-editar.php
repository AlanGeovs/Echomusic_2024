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
            $biografia = Consultas::biografia($id);
            $videos = Consultas::videos($id);
            $portada = Consultas::fotoPortada($id);
            $playlist = Consultas::playlista($id);

            // $respuesta1 = Consultas::listarAsociados();
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
                            <div class="card mb-3 shadow no-b r-0">
                                <div class="card-header bg-white">
                                    <div class="image  text-center">
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#imageModal">
                                            <img class="user_avatar2 no-b no-p" src="images/usuarios/<?php echo $_SESSION["id_user"]; ?>.jpg" alt="<?php echo  $_SESSION["nick_user"]; ?> ">
                                        </a><br>
                                        <!-- Button  modal Editar Foto -->
                                        <button type="button" class="btn btn-outline-primary btn-xs" data-bs-toggle="modal" data-bs-target="#imageModal"><i class="icon-edit mr-2"></i> Cambiar Foto de Perfil </button>

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
                                        <h2><?php echo $respuesta["nick_user"]; ?></h2>
                                        <!-- Social Media -->
                                        <strong class="card-title">
                                            <?php echo  $respuesta["mail_user"];

                                            ?>
                                        </strong>
                                        <!-- Descripcion -->
                                        <div class="text-center mt-3 mb3">
                                            <p><?php echo $respuesta["descripcion"]; ?></p>
                                        </div>

                                    </div>
                                </div>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="icon icon-user"></i><strong class="s-12">Nombre: </strong> <b><?php echo $respuesta["first_name_user"] . " " . $respuesta["last_name_user"] . " (" . $respuesta["nick_user"] . ")"; ?></b> </li>
                                    <li class="list-group-item"><i class="icon icon-map"></i><strong class="s-12">Región: </strong> <b><?php
                                                                                                                                        $busca_Ciudad = Consultas::obtenerNombreCiudadRegion($respuesta["id_city"]);

                                                                                                                                        if ($busca_Ciudad) {
                                                                                                                                            echo  $busca_Ciudad['name_region'];
                                                                                                                                            echo " / " . $busca_Ciudad['name_city'];
                                                                                                                                        } else {
                                                                                                                                            echo "No se encontraron coincidencias para el ID de la ciudad proporcionado.";
                                                                                                                                        }
                                                                                                                                        ?></b> </li>
                                    <li class="list-group-item"><i class="icon icon-music"></i><strong class="s-12">Género: </strong> <b><?php
                                                                                                                                            $busca_Genero = Consultas::buscaGenero($respuesta["id_genero"]);
                                                                                                                                            $busca_SubGenero = Consultas::buscaSubGenero($respuesta["id_subgenero"]);
                                                                                                                                            echo $busca_Genero["name_genre"]; ?></b> / <?php echo $busca_SubGenero["name_subGenre"]; ?> </li>
                                    <li class="list-group-item"><i class="icon icon-library_music"></i><strong class="s-12">Tipo de Artista: </strong> <b><?php echo Consultas::tipoMusico($respuesta["id_musician"]); ?></b> </li>

                                </ul>

                                <?php echo Consultas::botonEditar('editDatos'); ?>

                            </div>

                            <div class="card mb-3 shadow no-b r-0">
                                <div class="card-header bg-white">
                                    <h6>Biografía</h6>
                                </div>
                                <div class="card-body">

                                    <p><?php
                                        if ($biografia == null) {
                                            echo "<div class='text-center'>Agrega tu biografía</div>";
                                            echo Consultas::botonAgregar('agregaBio');
                                        } else {
                                            echo $biografia["bio_user"];
                                            echo Consultas::botonEditar('editBio');
                                        }
                                        ?>

                                </div>

                            </div>

                            <!-- Foto portada -->
                            <div class="card mb-3 shadow no-b r-0">
                                <div class="card-header bg-white">
                                    <h6>Foto de portada</h6>
                                </div>
                                <div class="card-body">

                                    <!-- Button trigger modal -->


                                    <?php
                                    if ($portada == null) {
                                        echo "<div class='text-center '>Agregar foto de portada</div>";
                                        echo Consultas::botonAgregar('galleryModal');
                                    } else {
                                        echo "<div class='text-center '>  <img src=\"" . $portada[0]['name_photo'] . "\"  ></div>";
                                        // echo Consultas::botonEditar('editarPortada');
                                        echo '<div class ="text-right"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePortadaModal"><span class="icon-delete"></span>  Borrar portada</button></div>';
                                    }
                                    ?>


                                </div>

                            </div>

                        </div>

                        <!--Portada Dashboard-->
                        <div class="col-md-8">
                            <!-- Video + Spoty -->
                            <div class="row">
                                <!--Videos-->
                                <div class="col-lg-6">
                                    <div class="card mb-3 shadow no-b r-0">
                                        <div class="">
                                            <!-- Alerta de videos actualziados -->
                                            <?php
                                            if (isset($_GET['alerta']) && $_GET['alerta'] === 'video') {
                                            ?>
                                                <div class="alert alert-success alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                                    </button>
                                                    <strong>Tu video!</strong> fue actualizado.
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="card-header white">
                                                <h6>Videos</h6>
                                            </div>

                                            <?php
                                            if ($videos == null) {
                                                echo "<div class='text-center '>Agrega tus videos</div>";
                                                echo Consultas::botonAgregar('agregaVideo');
                                            } else {

                                                // Invocar videos
                                                $videos = Consultas::listarVideos($id);
                                            ?>
                                                <div class="card-body">
                                                    <!-- <div class="box"> -->
                                                    <!-- <div class="box-header">
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
                                            </div> -->
                                                    <!-- /.box-header -->
                                                    <div class="box-body no-padding">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Video</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                                <?php
                                                                $counter = 1;  // Inicializar un contador
                                                                foreach ($videos as $video) {
                                                                    echo "<tr>";
                                                                    echo "<td>{$counter}.</td>";
                                                                    echo "<td>{$video['title_multi']}</td>";
                                                                    echo "<td>";
                                                                    echo "<button type='button' class='btn btn-outline-success btn-xs' onclick='verVideo(\"{$video['embed_multi']}\")'> <i class='icon-play'></i> Ver </button>";
                                                                    echo "<button type='button' class='btn btn-outline-primary btn-xs' onclick='mostrarEditar(\"{$video['id_multi']}\", \"{$video['title_multi']}\", \"https://youtube.com/watch?v={$video['embed_multi']}\")'> <i class='icon-edit'></i> Editar </button>";
                                                                    echo "<button type='button' class='btn btn-outline-danger btn-xs' onclick='mostrarBorrar(\"{$video['id_multi']}\")'> <i class='icon-delete'></i> Borrar </button>";
                                                                    echo "</td>";
                                                                    echo "</tr>";
                                                                    $counter++;  // Incrementar el contador
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>
                                                        <?php echo Consultas::botonAgregar('agregaVideo'); ?>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>

                                            <?php
                                                // Cierra else de videos
                                            }

                                            ?>

                                            <!-- <div class="float-right">
                                            <button type="button" class="btn btn-outline-danger btn-xs"> <i class="icon-delete"></i> Borrar </button>
                                            <button type="button" class="btn btn-outline-primary btn-xs"> <i class="icon-edit"></i> Editar </button>
                                        </div> -->
                                        </div>
                                    </div>
                                </div>

                                <!-- PlayList Spotify -->
                                <div class="col-lg-6">
                                    <div class="card mb-3 shadow no-b r-0">
                                        <div class="">
                                            <div class="float-right">
                                                <span class="icon-sound text-light-blue s-48"> </span>
                                            </div>
                                            <!-- <div class="counter-title">Playlist</div> -->
                                            <div class="card-header white">
                                                <h6>Playlist </h6>
                                            </div>

                                            <div class="card-body">

                                                <?php
                                                if ($playlist == null) {
                                                    echo "<div class='text-center'>Agrega tu Playlist</div>";
                                                    echo Consultas::botonAgregar('playlistModal');
                                                } else {
                                                    echo "<b>" . $playlist[0]["service_multi"] . "</b>";
                                                    echo $playlist[0]["embed_multi"];
                                                    echo Consultas::botonEditar('editPlaylistModal');
                                                }
                                                ?>
                                                <!-- <iframe width="100%" height="300" scrolling="no" frameborder="no" allow="" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/1585941613&color=%23151f29&auto_play=true&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe> -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fotografias -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-3 shadow no-b r-0">
                                        <div class="card-header white">
                                            <h6>Fotografías </h6>
                                        </div>
                                        <div class="card-body">
                                            <!-- <div id="galeriaUsuario" class="row"> -->
                                            <!-- Aquí se cargarán las imágenes -->
                                            <!-- </div> -->

                                            <div id="galeriaCarousel" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner" id="galeriaUsuario">
                                                    <!-- Las imágenes se cargarán aquí -->
                                                </div>
                                                <a class="carousel-control-prev" href="#galeriaCarousel" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Anterior</span>
                                                </a>
                                                <a class="carousel-control-next" href="#galeriaCarousel" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Siguiente</span>
                                                </a>
                                                <!-- Contenedor de miniaturas -->
                                                <ol class="carousel-indicators text-right" id="miniaturas">
                                                    <!-- Las miniaturas se cargarán aquí -->
                                                </ol>
                                            </div>


                                        </div>

                                        <div class="float-right mt-3 text-right">
                                            <!-- <button id="btnCargarGaleria" class="btn btn-primary">Cargar Imágenes</button> -->
                                            <!-- Botón para abrir el modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalGaleria">
                                                Ver y Borrar Fotos
                                            </button>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                                Insertar Galería
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Integrantes -->
                            <div class="row">
                                <!-- integrantes -->
                                <div class="col-md-12">
                                    <div class="card mb-3 shadow no-b r-0">
                                        <div class="card-header white">
                                            <h6>Integrantes <small> </small></h6>
                                        </div>

                                        <div class="card-body">
                                            <!-- Tarjetas de Integrantes -->
                                            <div id="carruselIntegrantes" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <!-- Las tarjetas se cargarán aquí dentro de contenedores .row -->
                                                </div>
                                                <!-- <a class="carousel-control-prev" href="#carruselIntegrantes" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carruselIntegrantes" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a> -->
                                            </div>


                                        </div>

                                        <div class="float-right mt-3 text-right">
                                            <!-- Botón para abrir el modal -->
                                            <button class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#addMemberModal">Agregar Integrante</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Presskit -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-3 shadow no-b r-0">
                                        <div class="card-header white">
                                            <h6>Presskit </h6>
                                        </div>

                                        <div class="card-body ">
                                            <br>
                                            <div id="presskitSection" class="text-center">
                                                <h4>Descarga tu presskit</h4>
                                                <p id="presskitNote"></p>
                                                <p id="presskitDate"><small></small></p>
                                                <a href="#" id="downloadPresskitBtn" class="btn btn-primary" style="display:none;"> <span class="icon-cloud-download"></span> Descargar Presskit</a>
                                            </div>


                                            <br>
                                            <!-- Botón para abrir el modal -->
                                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#presskitModal">
                                                Subir Presskit
                                            </button> -->
                                        </div>

                                        <div class="float-right">
                                            <br>
                                            <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePresskitModal">Borrar Presskit</button> -->

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>






                        <!--Reservas-->
                        <!-- <div class="row my-3">

                                    <div class="col-md-6">
                                        <div class="card mb-3 shadow no-b r-0">
                                            <div class="card-header white">
                                                <h6>Mis Reservas <small> </small></h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card mb-3 shadow no-b r-0">
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
        <!-- Foto de Perfíl -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Cambiar imagen de perfil</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Image Input -->
                        <input type="file" id="imageInput" accept="image/*">
                        <!-- Image Preview -->
                        <div id="imagePreview" style="width:100%; height:300px;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="saveButton">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar datos -->
        <div class="modal fade" id="editDatos" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar datos de usuario</h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button> -->
                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">X</button>

                    </div>
                    <div class="modal-body">
                        <form action="includes/editarPerfilDatos_db.php" method="post">
                            <div class="row">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">

                                <div class="mb-3 col-md-6">
                                    <label for="nick_user" class="form-label">Nombre artístico</label>
                                    <input type="text" class="form-control" id="nick_user" name="nick_user" value="<?php echo $respuesta["nick_user"]; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="mail_user" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="mail_user" name="mail_user" value="<?php echo $respuesta["mail_user"]; ?>">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="first_name_user" class="form-label">Nombre </label>
                                    <input type="text" class="form-control" id="first_name_user" name="first_name_user" value="<?php echo $respuesta["first_name_user"]; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="last_name_user" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="last_name_user" name="last_name_user" value="<?php echo $respuesta["last_name_user"]; ?>">
                                </div>
                                <!-- Unicación Región y Ciudad -->
                                <div class="mb-3 col-md-6">
                                    <label for="id_region" class="form-label">Región</label>
                                    <select class="form-control" id="id_region" name="id_region">
                                        <?php
                                        $res = Consultas::listarVariable('regions');
                                        //var_dump($respuesta);
                                        for ($i = 0; $i < count($res); $i++) {
                                            if ($res[$i]["name_region"] == $busca_Ciudad["name_region"]) {
                                                echo "<option value='" . $res[$i]["id_region"] . "' id='" . $res[$i]["id_region"] . "' selected>" . $res[$i]["name_region"] . "</option>";
                                            } else {
                                                echo "<option value='" . $res[$i]["id_region"] . "' id='" . $res[$i]["id_region"] . "' >" . $res[$i]["name_region"] . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="id_city" class="form-label">Ciudad</label>
                                    <select class="form-control" id="id_city" name="id_city">
                                        <?php
                                        $res = Consultas::listarVariable('cities');
                                        //var_dump($respuesta);
                                        for ($i = 0; $i < count($res); $i++) {
                                            if ($res[$i]["name_city"] == $busca_Ciudad["name_city"]) {
                                                echo "<option value='" . $res[$i]["id_city"] . "' id='" . $res[$i]["id_city"] . "'  selected>" . $res[$i]["name_city"] . "</option>";
                                            } else {
                                                echo "<option value='" . $res[$i]["id_city"] . "' id='" . $res[$i]["id_city"] . "' >" . $res[$i]["name_city"] . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>

                                <!-- Genero -->
                                <div class="mb-3 col-md-4">
                                    <label for="id_genero" class="form-label">Género</label>
                                    <select class="form-control" id="id_genero" name="id_genero">
                                        <?php
                                        $res = Consultas::listarVariable('genres');
                                        //var_dump($respuesta);
                                        for ($i = 0; $i < count($res); $i++) {
                                            if ($res[$i]["name_genre"] == $busca_Genero["name_genre"]) {
                                                echo "<option value='" . $res[$i]["id_genre"] . "' selected>" . $res[$i]["name_genre"] . "</option>";
                                            } else {
                                                echo "<option value='" . $res[$i]["id_genre"] . "'>" . $res[$i]["name_genre"] . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <!-- Subgenero -->
                                <div class="mb-3 col-md-4">
                                    <label for="id_subgenero" class="form-label">Sub género</label>
                                    <select class="form-control" id="id_subgenero" name="id_subgenero">


                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="id_musician" class="form-label">Tipo de artista</label>
                                    <select class="form-control" id="id_musician" name="id_musician">
                                        <?php
                                        $res = Consultas::listarVariable('type_musician');
                                        //var_dump($respuesta);
                                        for ($i = 0; $i < count($res); $i++) {
                                            if ($res[$i]["name_musician"] == Consultas::tipoMusico($respuesta["id_musician"])) {
                                                echo "<option value='" . $res[$i]["id_musician"] . "' selected>" . $res[$i]["name_musician"] . "</option>";
                                            } else {
                                                echo "<option value='" . $res[$i]["id_musician"] . "'>" . $res[$i]["name_musician"] . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $respuesta["descripcion"]; ?></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Edita Biografía -->
        <div class="modal fade" id="editBio" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar biografía</h5>
                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">X</button>

                    </div>
                    <div class="modal-body">
                        <form action="includes/editarBiografia_db.php" method="post">
                            <div class="row">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" class="form-control" id="accion" name="accion" value="Editar">

                                <div class="col-md-12">
                                    <label for="bio" class="form-label">Biografía</label>
                                    <textarea class="form-control" id="bio" name="bio" rows="6"><?php echo $biografia["bio_user"]; ?></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Agrega Biografía -->
        <div class="modal fade" id="agregaBio" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Agrega tu biografía</h5>
                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">X</button>

                    </div>
                    <div class="modal-body">
                        <form action="includes/editarBiografia_db.php" method="post">
                            <div class="row">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" class="form-control" id="accion" name="accion" value="Agregar">


                                <div class="col-md-12">
                                    <label for="bio" class="form-label">Biografía</label>
                                    <textarea type="text" class="form-control" id="bio" name="bio" placeholder="Agrega tu biografía...."" rows=" 6"></textarea>
                                </div>

                                <div class=" col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edita Videos -->
        <div class="modal fade" id="editBio" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar biografía</h5>
                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">X</button>

                    </div>
                    <div class="modal-body">
                        <form action="includes/editarBiografia_db.php" method="post">
                            <div class="row">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" class="form-control" id="accion" name="accion" value="Editar">

                                <div class="col-md-12">
                                    <label for="bio" class="form-label">Descripción</label>
                                    <input type="text" class="form-control" id="bio" name="bio" value="<?php echo $biografia["bio_user"]; ?>">
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Agrega Videos -->
        <div class="modal fade" id="agregaVideo" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Agrega tu lista de videos</h5>
                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">X</button>

                    </div>
                    <div class="modal-body">
                        <form action="includes/editarPerfilVideos_db.php" method="post" id="agregaVideos">
                            <div class="row">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" class="form-control" id="accion" name="accion" value="Agregar">

                                <?php for ($i = 1; $i <= 3; $i++) : ?>
                                    <div class="mb-3 col-md-4">
                                        <label for="title_multi<?php echo $i; ?>" class="form-label">Video <?php echo $i; ?></label>
                                        <input type="text" class="form-control" id="title_multi<?php echo $i; ?>" name="title_multi<?php echo $i; ?>" placeholder="Título <?php echo $i; ?>">
                                    </div>

                                    <div class="mb-3 col-md-8">
                                        <label for="embed_multi<?php echo $i; ?>" class="form-label">URL <?php echo $i; ?></label>
                                        <input type="text" class="form-control" id="embed_multi<?php echo $i; ?>" name="embed_multi<?php echo $i; ?>" placeholder="https://www.youtube.com/watch?v=YrpxJ1Yn3x0">
                                    </div>
                                <?php endfor; ?>


                                <button type="button" id="addButton" class="btn btn-outline-info btn-xs">Agregar más</button>



                                <div class=" col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal para Ver videos-->
        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Ver Video</h5>
                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <iframe id="videoFrame" width="450" height="300" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Editar Videos -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Video</h5>
                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="videoId">
                        <div class="form-group">
                            <label for="videoTitle">Título</label>
                            <input type="text" class="form-control" id="videoTitle" placeholder="Título del video">
                        </div>
                        <div class="form-group">
                            <label for="videoUrl">Link de YouTube</label>
                            <input type="text" class="form-control" id="videoUrl" placeholder="https://youtube.com/watch?v=...">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                        <button type=" button" class="btn btn-primary" onclick="editarVideo()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Borrar Videos -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar Borrado</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro que deseas borrar este video?
                        <input type="hidden" id="deleteVideoId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                        <button type="button" class="btn btn-danger" onclick="borrarVideo()">Borrar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal para Agregar Playlist -->
        <div class="modal fade" id="playlistModal" tabindex="-1" role="dialog" aria-labelledby="playlistModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="playlistModalLabel">Agregar Playlist</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="playlistForm">
                            <input type="hidden" name="id_user" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="service_multi">Servicio</label>
                                <select class="form-control" id="service_multi" name="service_multi" required>
                                    <option value="Soundcloud">Soundcloud</option>
                                    <option value="Spotify">Spotify</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="embed_multi">Código Embed de la Playlist</label>
                                <input type="text" class="form-control" id="embed_multi" name="embed_multi" placeholder="Código Embed" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                        <button type="submit" class="btn btn-primary" onclick="agregarPlaylist()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal para Editar Playlist -->
        <div class="modal fade" id="editPlaylistModal" tabindex="-1" role="dialog" aria-labelledby="editPlaylistModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPlaylistModalLabel">Editar Playlist</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editPlaylistForm">
                            <input type="hidden" name="playlist_id" id="playlist_id" value="<?php echo $playlist[0]["id_multimedia_featured"]; ?>">
                            <input type="hidden" name="id_user" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="edit_service_multi">Servicio</label>
                                <select class="form-control" id="edit_service_multi" name="service_multi">

                                    <?php
                                    if ($playlist[0]["service_multi"] == 'Soundcloud') {
                                        echo '<option value="Soundcloud" selected>Soundcloud</option>';
                                        echo '<option value="Spotify">Spotify</option>';
                                    } else {
                                        echo '<option value="Soundcloud">Soundcloud</option>';
                                        echo '<option value="Spotify" selected>Spotify</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_embed_multi">Código Embed de la Playlist</label>
                                <input type="text" class="form-control" id="edit_embed_multi" name="embed_multi">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="editarPlaylist()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>




        <!-- Modal Fotos -->
        <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalLabel">Subir Imágenes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <form id="uploadForm" enctype="multipart/form-data">
                            <input type="file" name="images[]" id="galleryImages" multiple accept="image/*">
                            <input type="hidden" name="id_user" value="<?php echo $id; ?>">
                            <p>Seleccione hasta 10 imágenes (JPG, PNG).</p>
                            <div id="preview"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="uploadImages()">Subir Imágenes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Borrar Fotos -->
        <div class="modal fade" id="modalGaleria" tabindex="-1" role="dialog" aria-labelledby="modalGaleriaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalGaleriaLabel">Galería de Fotos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="listadoFotos" class="row">
                            <!-- Aquí se cargarán las imágenes -->
                        </div>
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
                        <form id="formAddMember" enctype="multipart/form-data">
                            <input type="hidden" name="id_user" value="<?php echo $id; ?>">
                            <!-- Subir foto -->
                            <div class="mb-3">
                                <label for="memberPhoto" class="form-label">Foto del integrante</label>
                                <input type="file" class="form-control" id="memberPhoto" name="memberPhoto" accept="image/*" required>
                            </div>
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="memberName" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="memberName" name="memberName" placeholder="Ej. Juan  " required>
                            </div>
                            <!-- Apellidos -->
                            <div class="mb-3">
                                <label for="memberLastName" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="memberLastName" name="memberLastName" placeholder="  Pérez" required>
                            </div>
                            <!-- Puesto/Rol con Select -->
                            <div class="mb-3">
                                <label for="memberRole" class="form-label">Rol</label>
                                <select class="form-control" id="memberRole" name="memberRole" required>
                                    <!-- Las opciones se cargarán aquí -->
                                </select>
                            </div>

                        </form>
                        <button type="button" class="btn btn-primary" id="btnGuardarIntegrante">Guardar</button>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Integrantes -->
        <!-- Estructura similar a addMemberModal, pero para editar -->
        <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMemberModalLabel">Agregar Integrante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddMember" enctype="multipart/form-data">
                            <input type="hidden" name="id_user" value="<?php echo $id; ?>">
                            <!-- Subir foto -->
                            <div class="mb-3">
                                <label for="memberPhoto" class="form-label">Foto del integrante</label>
                                <input type="file" class="form-control" id="memberPhoto" name="memberPhoto" accept="image/*" required>
                            </div>
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="memberName" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="memberName" name="memberName" placeholder="Ej. Juan  " required>
                            </div>
                            <!-- Apellidos -->
                            <div class="mb-3">
                                <label for="memberLastName" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="memberLastName" name="memberLastName" placeholder="  Pérez" required>
                            </div>
                            <!-- Puesto/Rol con Select -->
                            <div class="mb-3">
                                <label for="memberRole" class="form-label">Rol</label>
                                <select class="form-control" id="memberRole" name="memberRole" required>
                                    <!-- Las opciones se cargarán aquí -->
                                </select>
                            </div>

                        </form>
                        <button type="button" class="btn btn-primary" id="btnGuardarIntegrante">Guardar</button>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Integrantes Confirmación de Borrado -->
        <div class="modal fade" id="deleteMemberModal" tabindex="-1" aria-labelledby="deleteMemberModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Borrado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas borrar este integrante?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="confirmDelete">Borrar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Foto Portada -->
        <div class="modal fade" id="portadaModal" tabindex="-1" aria-labelledby="portadaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="portadaModalLabel">Subir Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <form id="uploadForm" enctype="multipart/form-data">
                            <input type="file" name="images[]" id="galleryImages" multiple accept="image/*">
                            <input type="hidden" name="id_user" value="<?php echo $id; ?>">
                            <p>Seleccione una imagen (JPG, PNG).</p>
                            <div id="preview"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="uploadImages()">Subir foto</button>
                    </div>
                </div>
            </div>
        </div> >
        </div>

        <!-- Modal de Confirmación de Borrar  Foto Portada -->
        <div class="modal fade" id="deletePortadaModal" tabindex="-1" aria-labelledby="deletePortadaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePortadaModalLabel">Confirmar Borrado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas borrar tu presskit?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDeletePortada">Borrar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Presskit-->
        <div class="modal fade" id="presskitModal" tabindex="-1" aria-labelledby="presskitModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="presskitModalLabel">Presskit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="presskitForm" enctype="multipart/form-data">
                            <input type="hidden" id="idUser" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">

                            <div class="mb-3">
                                <label for="file" class="form-label">Subir PDF</label>
                                <input type="file" class="form-control" id="file" name="file" accept=".pdf">
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label">Comentario</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="submitPresskit">Subir</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmación de borrado Presskit -->
        <div class="modal fade" id="deletePresskitModal" tabindex="-1" aria-labelledby="deletePresskitModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePresskitModalLabel">Confirmar Borrado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas borrar tu presskit?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDeletePresskit">Borrar</button>
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

        <!-- Editar foto de Perfíl - Implementa la lógica para inicializar Cropper.js, cargar la imagen seleccionada y enviar la imagen recortada al servidor. -->
        <script type="text/javascript">
            $(document).ready(function() {
                var cropper;

                // Inicializa Cropper.js cuando se selecciona una imagen
                $('#imageInput').on('change', function(e) {
                    var file = e.target.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#imagePreview').html('<img src="' + e.target.result + '" />');
                            cropper = new Cropper($('#imagePreview img')[0], {
                                aspectRatio: 1, // Ajusta según tus necesidades
                                viewMode: 1,
                            });
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Envía la imagen recortada al servidor cuando se hace clic en "Guardar"
                $('#saveButton').on('click', function() {
                    if (cropper) {
                        cropper.getCroppedCanvas().toBlob(function(blob) {
                            var formData = new FormData();
                            formData.append('image', blob, 'image.jpg');
                            formData.append('user_id', "<?php echo $id; ?>"); // Agrega el ID del usuario

                            $.ajax('includes/subir_imagen.php', {
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function() {
                                    $('#imageModal').modal('hide');
                                    // Actualiza la imagen de perfil en la página o muestra un mensaje de éxito
                                    location.reload();
                                },
                                error: function() {
                                    alert('Hubo un error al subir la imagen.');
                                },
                            });
                        });
                    }
                });
            });
        </script>


        <!-- Script para cerrar alerta en X segundos -->
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $(".alert").alert('close');
                }, 10000);
            });
        </script>
        <!-- Script para contador de caracteres en descripción     -->
        <script type="text/javascript">
            $(document).ready(function() {
                // Para el campo Descripción
                $('#descripcion').on('input', function() {
                    var remaining = 500 - $(this).val().length;
                    $('#desc-char-count').text('Caracteres restantes: ' + remaining);
                }).trigger('input'); // Dispara el evento input para inicializar el contador

                // Para el campo Biografía
                $('#bio').on('input', function() {
                    var remaining = 1000 - $(this).val().length;
                    $('#bio-char-count').text('Caracteres restantes: ' + remaining);
                }).trigger('input'); // Dispara el evento input para inicializar el contador

                // Inserta los contadores después de los campos de texto
                $('<div id="desc-char-count">Caracteres restantes: 500</div>').insertAfter('#descripcion');
                $('<div id="bio-char-count">Caracteres restantes: 1000</div>').insertAfter('#bio');
            });
        </script>

        <!-- Ver videos -->
        <script type="text/javascript">
            function verVideo(videoId) {
                var src = 'https://www.youtube.com/embed/' + videoId;
                $('#videoFrame').attr('src', src);
                $('#viewModal').modal('show');
            }
        </script>

        <!-- Editar y Borrar  VIdeos -->
        <script type="text/javascript">
            function mostrarEditar(videoId, videoTitle, videoUrl) {
                $('#videoId').val(videoId);
                $('#videoTitle').val(videoTitle);
                $('#videoUrl').val(videoUrl);
                $('#editModal').modal('show');
            }

            function editarVideo() {
                var videoId = $('#videoId').val();
                var videoTitle = $('#videoTitle').val();
                var videoUrl = $('#videoUrl').val();

                // Suponiendo que tienes un endpoint 'editar_video.php' para manejar la edición del video
                $.post('includes/editar_videos.php', {
                    videoId: videoId,
                    videoTitle: videoTitle,
                    videoUrl: videoUrl
                }, function(response) {
                    // Maneja la respuesta del servidor
                    console.log(response);
                    // Recarga la página
                    location.reload();
                });
            }


            function mostrarBorrar(videoId) {
                $('#deleteVideoId').val(videoId);
                $('#deleteModal').modal('show');
            }

            function borrarVideo() {
                var videoId = $('#deleteVideoId').val();

                // Suponiendo que tienes un endpoint 'borrar_video.php' para manejar el borrado del video
                $.post('includes/borrar_videos.php', {
                    videoId: videoId
                }, function(response) {
                    // Maneja la respuesta del servidor
                    console.log(response);
                    $('#deleteModal').modal('hide');
                    // Recarga la página
                    location.reload();
                });
            }
        </script>

        <script type="text/javascript">
            // Variable global para mantener un registro del número de campos
            var campoCount = 3;

            // Función para agregar nuevos campos
            function agregarCampos() {
                campoCount++;
                var html = '<div class="mb-3 col-md-4">' +
                    '<label for="title_multi' + campoCount + '" class="form-label">Video ' + campoCount + '</label>' +
                    '<input type="text" class="form-control" id="title_multi' + campoCount + '" name="title_multi' + campoCount + '" placeholder="Título ' + campoCount + '">' +
                    '</div>' +
                    '<div class="mb-3 col-md-8">' +
                    '<label for="embed_multi' + campoCount + '" class="form-label">URL ' + campoCount + '</label>' +
                    '<input type="text" class="form-control" id="embed_multi' + campoCount + '" name="embed_multi' + campoCount + '" placeholder="https://www.youtube.com/watch?v=YrpxJ1Yn3x0">' +
                    '</div>';
                // Agregar los nuevos campos al final de la fila
                $('#addButton').before(html);
            }

            // Vincular la función agregarCampos al botón
            $(document).ready(function() {
                $('#addButton').on('click', agregarCampos);
            });
        </script>

        <!-- Agrega PlayList -->
        <script type="text/javascript">
            function agregarPlaylist() {
                var formData = new FormData(document.getElementById('playlistForm'));

                // Suponiendo que tienes un endpoint 'agregar_playlist.php' para manejar la adición de la playlist
                $.ajax({
                    url: 'includes/agregar_playlist.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response); // Manejar la respuesta del servidor
                        $('#playlistModal').modal('hide'); // Cerrar el modal
                        location.reload();
                    }
                });
            }
        </script>

        <!-- Editar playlist -->
        <script type="text/javascript">
            function editarPlaylist() {
                var formData = new FormData(document.getElementById('editPlaylistForm'));

                // Suponiendo que tienes un endpoint 'editar_playlist.php' para manejar la edición de la playlist
                $.ajax({
                    url: 'includes/editar_playlist.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response); // Manejar la respuesta del servidor
                        $('#editPlaylistModal').modal('hide'); // Cerrar el modal
                        location.reload();
                    }
                });
            }
        </script>



        <!-- Carga de Fotos - Implementa la lógica para inicializar Dropzone.js y Cropper.js, cargar las imágenes seleccionadas, y editar y guardar las imágenes.  -->

        <!-- <script type="text/javascript">
            $(document).ready(function() {

                // Dropzone.autoDiscover = false; // Desactiva el auto-descubrimiento
                var cropper;

                // Inicializa Dropzone.js
                var myDropzone = new Dropzone("#dropzoneArea", {
                    url: "includes/subir_fotos.php",
                    maxFiles: 10,
                    acceptedFiles: "image/*",
                    addRemoveLinks: true
                });

                // Escucha el evento 'addedfile' para mostrar la imagen en el área de visualización y edición
                myDropzone.on("addedfile", function(file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').html('<img src="' + e.target.result + '" />').show();
                        cropper = new Cropper($('#imagePreview img')[0], {
                            aspectRatio: 1, // Ajusta según tus necesidades
                            viewMode: 1,
                        });
                    };
                    reader.readAsDataURL(file);
                });

                // Envía las imágenes recortadas al servidor cuando se hace clic en "Guardar"
                $('#saveButton').on('click', function() {
                    if (cropper) {
                        cropper.getCroppedCanvas().toBlob(function(blob) {
                            var formData = new FormData();
                            formData.append('image', blob, 'image.jpg');

                            $.ajax('includes/subir_fotos.php', {
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function() {
                                    $('#imagesModal').modal('hide');
                                    // Actualiza la galería de imágenes en la página o muestra un mensaje de éxito
                                },
                                error: function() {
                                    alert('Hubo un error al subir la imagen.');
                                },
                            });
                        });
                    }
                });
            });
        </script> -->


        <!-- Generos y subgéneros -->
        <script type="text/javascript">
            var generoActual = "<?php echo $busca_Genero['id_genre']; ?>";
            var subgeneroActual = "<?php echo $busca_SubGenero['name_subGenre']; ?>";
        </script>

        <script type="text/javascript">
            $(document).ready(function() {

                // Función para obtener los subgéneros
                function obtenerSubGeneros(id_genero) {
                    if (id_genero) {
                        $.ajax({
                            url: 'includes/obtener_subgeneros.php',
                            type: 'POST',
                            data: {
                                id_genero: id_genero
                            },
                            dataType: 'json',
                            success: function(data) {
                                $('#id_subgenero').html('<option value="">Seleccione un subgénero</option>');
                                $.each(data, function(key, value) {
                                    var selected = (value.name_subGenre == subgeneroActual) ? ' selected' : '';
                                    $('#id_subgenero').append('<option value="' + value.id_subGenre + '"' + selected + '>' + value.name_subGenre + '</option>');
                                });
                                $('#id_subgenero').prop('disabled', false); // Habilita el select de subgéneros
                            }
                        });
                    } else {
                        $('#id_subgenero').html('<option value="">Seleccione un género primero</option>');
                        $('#id_subgenero').prop('disabled', true); // Deshabilita el select de subgéneros
                    }
                }

                // Llamada inicial para obtener los subgéneros del género actual
                obtenerSubGeneros(generoActual);

                // Manejador de eventos para cuando el género cambia
                $('#id_genero').on('change', function() {
                    var id_genero = $(this).val();
                    obtenerSubGeneros(id_genero); // Llama a la función para obtener los subgéneros
                });

            });
        </script>




        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Subida de imágenes -->
        <script type="text/javascript">
            function uploadImages() {
                var formData = new FormData(document.getElementById('uploadForm'));
                $.ajax({
                    url: 'includes/upload_images.php', // Endpoint para la subida de imágenes
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        swal("Subiendo...", "Por favor espera mientras las imágenes se cargan.", "info", {
                            buttons: false,
                            timer: 3000,
                        });
                    },
                    success: function(response) {
                        console.log(response); // Manejar la respuesta del servidor
                        swal("¡Éxito!", "Imágenes subidas correctamente.", "success");
                        $('#galleryModal').modal('hide');
                        // Recargar la página o actualizar la vista para mostrar las nuevas imágenes
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la subida: ", xhr, status, error);
                        swal("Error", "Ha ocurrido un error al subir las imágenes.", "error");
                    }
                });
            }
        </script>

        <!-- Subida de Foto Portada -->
        <script type="text/javascript">
            function uploadImages() {
                var formData = new FormData(document.getElementById('uploadForm'));
                $.ajax({
                    url: 'includes/upload_images_portada.php', // Endpoint para la subida de imágenes
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        swal("Subiendo...", "Por favor espera mientras las imágenes se cargan.", "info", {
                            buttons: false,
                            timer: 3000,
                        });
                    },
                    success: function(response) {
                        console.log(response); // Manejar la respuesta del servidor
                        swal("¡Éxito!", "Foto de portada subidas correctamente.", "success");
                        $('#portadaModal').modal('hide');
                        // Recargar la página o actualizar la vista para mostrar las nuevas imágenes

                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la subida: ", xhr, status, error);
                        swal("Error", "Ha ocurrido un error al subir las imágenes.", "error");
                    }
                });
            }
        </script>



        <!-- Borrado de Foto Portada -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#confirmDeletePortada').click(function() {
                    $.ajax({
                        url: 'includes/borrar_portada.php', //  
                        type: 'POST',
                        data: {
                            id_user: "<?php echo $_SESSION['id_user']; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                // Actualiza el contenido del div presskitSection
                                $('#presskitSection').html('<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#presskitModal">Subir Presskit</button>');
                            } else {
                                alert('Error al borrar la portada');
                            }
                            $('#deletePresskitModal').modal('hide');
                            swal("¡Éxito!", "Portada borrada con éxito", "success");

                            location.reload();
                        },
                        error: function() {
                            alert('Error en la solicitud de borrado');
                        }
                    });
                });
            });
        </script>

        <!-- Función para cargar y mostrar las imágenes: -->
        <script type="text/javascript">
            function cargarGaleria() {
                var id_user = <?php echo $_SESSION["id_user"]; ?>;

                $.ajax({
                    url: 'includes/obtener_fotos_usuario.php',
                    type: 'POST',
                    dataType: 'json',
                    success: function(fotos) {
                        var galeriaHTML = '';
                        fotos.forEach(function(foto) {
                            galeriaHTML += '<div class="col-md-4"><img src="' + foto.name_photo + '" class="img-fluid"></div>';
                        });
                        $('#galeriaUsuario').html(galeriaHTML);
                    },
                    error: function() {
                        console.log("Error al cargar las fotos");
                    }
                });
            }

            $(document).ready(function() {
                cargarGaleria();
            });
        </script>

        <!-- Vincular el Evento Click del Botón con cargarGaleria() -->
        <script type="text/javascript">
            $(document).ready(function() {
                // Vincular el evento click del botón con la función cargarGaleria
                $('#btnCargarGaleria').on('click', function() {
                    cargarGaleria();
                });

                // También puedes cargar la galería automáticamente al cargar la página
                cargarGaleria();
            });

            function cargarGaleria() {
                var id_user = <?php echo $_SESSION["id_user"]; ?>;

                $.ajax({
                    url: 'includes/obtener_fotos_usuario.php',
                    type: 'POST',
                    dataType: 'json',
                    // success: function(fotos) {
                    //     var galeriaHTML = '';
                    //     fotos.forEach(function(foto) {
                    //         galeriaHTML += '<div class="col-md-4"><img src="' + foto.name_photo + '" class="img-fluid"></div>';
                    //     });


                    success: function(fotos) {
                        var galeriaHTML = '';
                        var miniaturasHTML = '';
                        fotos.forEach(function(foto, index) {
                            // Agregar imagen al carrusel
                            galeriaHTML += '<div class="carousel-item ' + (index === 0 ? 'active' : '') + '">';
                            galeriaHTML += '<img src="' + foto.name_photo + '" class="d-block w-100">';
                            galeriaHTML += '</div>';

                            // Agregar miniatura
                            miniaturasHTML += '<li data-target="#galeriaCarousel" data-slide-to="' + index + '" class="' + (index === 0 ? 'active' : '') + '">';
                            miniaturasHTML += '<img src="' + foto.name_photo + '" class="img-fluid">';
                            miniaturasHTML += '</li>';
                        });
                        $('#galeriaUsuario').html(galeriaHTML);
                        $('#miniaturas').html(miniaturasHTML);
                    },


                    error: function() {
                        console.log("Error al cargar las fotos");
                    }
                });
            }

            $(document).ready(function() {
                cargarGaleria();
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#modalGaleria').on('show.bs.modal', function(e) {
                    cargarFotos();
                });
            });

            function cargarFotos() {
                var id_user = <?php echo $_SESSION["id_user"]; ?>;
                $.ajax({
                    url: 'includes/obtener_fotos_usuario.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_user: id_user
                    },
                    success: function(fotos) {
                        var htmlFotos = fotos.map(function(foto) {
                            return '<div class="col-md-4 mb-3">' +
                                '   <img src="' + foto.name_photo + '" class="img-fluid">' +
                                '   <button class="btn btn-danger btn-sm" onclick="borrarFoto(\'' + foto.name_photo + '\')">Borrar</button>' +
                                '</div>';
                        }).join('');
                        $('#listadoFotos').html(htmlFotos);
                    },
                    error: function() {
                        alert("Error al cargar las fotos");
                    }
                });
            }

            function borrarFoto(nombreFoto) {
                var confirmacion = confirm("¿Estás seguro de que quieres borrar esta foto?");
                if (confirmacion) {
                    $.ajax({
                        url: 'includes/borrar_foto_usuario.php',
                        type: 'POST',
                        data: {
                            nombreFoto: nombreFoto
                        },
                        success: function(respuesta) {
                            // Aquí podrías mostrar un mensaje de éxito
                            // También recargar el listado de fotos
                            cargarFotos();
                        },
                        error: function() {
                            alert("Error al borrar la foto");
                        }
                    });
                }
            }
        </script>


        <!-- Integrantes -->
        <script type="text/javascript">
            function cargarIntegrantes() {
                $.ajax({
                    url: 'includes/instrumentos.php', // Endpoint para obtener instrumentos
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Suponiendo que response es un array de objetos con id y nombre
                        var opciones = response.map(function(instrumento) {
                            return `<option value="${instrumento.id_instrument}">${instrumento.name_instrument}</option>`;
                        });
                        $('#memberRole').html(opciones.join(''));
                    },
                    error: function() {
                        console.log('Error al cargar los roles');
                    }
                });
            }

            $(document).ready(function() {
                // Cargar roles al abrir el modal
                cargarIntegrantes(); // Carga inicial de integrantes
                //Lo de abajo se reemplaza con la función cargarIntegrantes()
                // $('#addMemberModal').on('show.bs.modal', function(e) {
                //     $.ajax({
                //         url: 'includes/instrumentos.php', // Endpoint para obtener instrumentos
                //         type: 'GET',
                //         dataType: 'json',
                //         success: function(response) {
                //             // Suponiendo que response es un array de objetos con id y nombre
                //             var opciones = response.map(function(instrumento) {
                //                 return `<option value="${instrumento.id_instrument}">${instrumento.name_instrument}</option>`;
                //             });
                //             $('#memberRole').html(opciones.join(''));
                //         },
                //         error: function() {
                //             console.log('Error al cargar los roles');
                //         }
                //     });
                // });


                // Manejar el clic en el botón "Guardar" del modal
                $('#btnGuardarIntegrante').click(function() {
                    var formDataMember = new FormData($('#formAddMember')[0]);
                    $.ajax({
                        url: 'includes/guardar_integrante.php', // El endpoint que manejará la solicitud
                        type: 'POST',
                        data: formDataMember,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Mostrar mensaje de éxito

                            swal("¡Éxito!", "Integrante guardado con éxito", "success");
                            // Cerrar el modal
                            $('#addMemberModal').modal('hide');
                            // Limpiar el formulario (opcional)
                            $('#formAddMember')[0].reset();
                            cargarIntegrantes(); // Recargar los integrantes
                            location.reload();
                        },
                        error: function() {
                            // Manejar error en la solicitud
                            console.log('Error al guardar los datos del integrante');
                        }
                    });
                });


                // Manejar clic en botón de editar
                $(document).on('click', '.btn-edit', function() {
                    var idMember = $(this).data('id');
                    // Aquí puedes cargar los datos del integrante y mostrar el modal de edición
                    // Por ejemplo, haciendo una solicitud AJAX para obtener los datos del integrante
                    $.ajax({
                        url: 'includes/obtener_datos_integrante.php',
                        type: 'POST',
                        data: {
                            id: idMember
                        },
                        dataType: 'json',
                        success: function(response) {
                            // Rellenar los campos del formulario de edición con los datos obtenidos
                            $('#editMemberModal').find('#memberName').val(response.first_name);
                            $('#editMemberModal').find('#memberLastName').val(response.last_name);
                            // ... más campos ...
                            $('#editMemberModal').modal('show');
                        },
                        error: function() {
                            console.log('Error al obtener los datos del integrante');
                        }
                    });
                });

                // Manejar clic en botón de borrar
                $(document).on('click', '.btn-delete', function() {
                    var idMember = $(this).data('id');
                    $('#deleteMemberModal').modal('show');
                    $('#confirmDelete').data('id', idMember); // Pasar ID al botón de confirmar
                });

                // Confirmar borrado
                $('#confirmDelete').click(function() {
                    var idMember = $(this).data('id');
                    // Realiza la solicitud AJAX para borrar el integrante
                    $.ajax({
                        url: 'includes/borrar_integrante.php',
                        type: 'POST',
                        data: {
                            id: idMember
                        },
                        success: function(response) {
                            $('#deleteMemberModal').modal('hide');
                            // Recargar la lista de integrantes
                            // Puedes llamar a la función que carga los integrantes de nuevo aquí
                            cargarIntegrantes();
                            location.reload();
                        },
                        error: function() {
                            console.log('Error al borrar el integrante');
                        }
                    });
                });

            });
        </script>

        <!-- Cargar datos de integrantes actuales -->

        <script type="text/javascript">
            $(document).ready(function() {
                $.ajax({
                    url: 'includes/obtener_integrantes.php', // Ajusta al endpoint correcto
                    type: 'GET',
                    dataType: 'json',
                    success: function(integrantes) {
                        var contenidoCarrusel = '';
                        if (integrantes.length > 0) {
                            integrantes.forEach(function(integrante, index) {
                                if (index % 10 === 0 || index === 0) { // Nueva fila para desktop y tablet
                                    contenidoCarrusel += (index !== 0 ? '</div>' : '') + '<div class="carousel-item ' + (index === 0 ? 'active' : '') + '"><div class="row">';
                                }
                                contenidoCarrusel += '<div class="col-lg-3 col-md-3 col-sm-6 col-6">'; // 4 columnas en lg y md, 2 en sm y xs
                                contenidoCarrusel += '<div class="card">';
                                contenidoCarrusel += '<img src="images/integrantes/' + integrante.img_member + '" class="card-img-top">';
                                contenidoCarrusel += '<div class="card-body">';
                                contenidoCarrusel += '<h4>' + integrante.first_name_member + ' ' + integrante.last_name_member + ' </h4>';
                                contenidoCarrusel += '<h5>' + integrante.name_instrument + '</h5>'; // Usando name_instrument directamente

                                contenidoCarrusel += '<button class="btn btn-outline-primary btn-xs btn-edit" data-id="' + integrante.id_band_member + '">Editar</button>';
                                contenidoCarrusel += '<button class="btn btn-outline-danger  btn-xs btn-delete" data-id="' + integrante.id_band_member + '">Borrar</button>';

                                contenidoCarrusel += '</div></div></div>';
                                if (index === integrantes.length - 1) { // Cerrar la última fila
                                    contenidoCarrusel += '</div></div>';
                                }
                            });
                        } else {
                            contenidoCarrusel = '<div class="carousel-item active"><div class="row"><div class="col-12"><p>Agrega los integrantes de tu banda o grupo</p></div></div></div>';
                        }
                        $('#carruselIntegrantes .carousel-inner').html(contenidoCarrusel);
                    },
                    error: function() {
                        console.log("Error al cargar los integrantes");
                    }
                });
            });
        </script>



        <!-- Cambio de Región y Ciudad -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#id_region').on('change', function() {
                    var id_region = $(this).val();
                    cargarCiudades(id_region);
                });

                // Cargar ciudades al abrir el modal
                $('#editDatos').on('show.bs.modal', function() {
                    var id_region = $('#id_region').val();
                    if (id_region) {
                        cargarCiudades(id_region);
                    }
                });
            });

            function cargarCiudades(id_region) {
                $.ajax({
                    url: 'includes/obtener_regiones_ciudades.php',
                    type: 'POST',
                    data: {
                        id_region: id_region
                    },
                    dataType: 'json',
                    success: function(ciudades) {
                        var opciones = '<option value="">Seleccione una ciudad</option>';
                        $.each(ciudades, function(index, ciudad) {
                            var selected = (ciudad.name_city == "<?php echo $busca_Ciudad["name_city"]; ?>") ? ' selected' : '';
                            opciones += '<option value="' + ciudad.id_city + '"' + selected + '>' + ciudad.name_city + '</option>';
                        });
                        $('#id_city').html(opciones);
                    },
                    error: function() {
                        alert('Error al cargar las ciudades');
                    }
                });
            }
        </script>


        <!-- muestra el Presskit -->
        <script type="text/javascript">
            $(document).ready(function() {
                // Función para actualizar el contenido de presskitSection
                function actualizarPresskit() {
                    $.ajax({
                        url: 'includes/obtener_presskit.php', // Asegúrate de reemplazar esto con la ruta correcta
                        type: 'POST',
                        data: {
                            id_user: "<?php echo $_SESSION['id_user']; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            // console.log("Respuesta: " + response);
                            if (response.success && response.data) {
                                // Si hay datos del presskit, muestra la información y el botón
                                $('#presskitNote').text(response.data.note);
                                $('#presskitDate').text('Fecha de subida: ' + response.data.date);
                                $('#downloadPresskitBtn').attr('href', 'images/presskit/' + response.data.file);
                                $('#downloadPresskitBtn').attr('target', '_blank'); // Abrir en una nueva ventana
                                $('#downloadPresskitBtn').show(); // Asegúrate de que el botón se muestre
                                //  Activa botón  para borrar
                                var botonBorrarPresskit = '    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePresskitModal"><span class="icon-delete"></span>  Borrar Presskit</button>';
                                $('#downloadPresskitBtn').after(botonBorrarPresskit);
                            } else {
                                // Si no hay presskit, muestra el botón para subir uno
                                $('#presskitSection').html('<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#presskitModal">Subir Presskit</button>');
                            }
                        },
                        error: function() {
                            alert('Error al cargar los datos del presskit');
                        }
                    });
                }

                // Actualizar presskit al cargar la página
                actualizarPresskit();



                // código AJAX para subir el presskit
                $('#submitPresskit').click(function() {
                    var formData = new FormData($('#presskitForm')[0]);

                    $.ajax({
                        url: 'includes/presskit_endpoint.php', // Cambia a tu ruta del endpoint
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Manejo de la respuesta del servidor
                            console.log(response);
                            $('#presskitModal').modal('hide');
                            // Aquí puedes agregar acciones adicionales, como mostrar un mensaje de éxito.
                            // Llamada a actualizarPresskit() después de una subida exitosa
                            actualizarPresskit();
                            swal("¡Éxito!", "Presskit guardado con éxito", "success");
                            location.reload();

                        },
                        error: function(xhr, status, error) {
                            console.error("Error: " + error);
                            // Aquí puedes manejar errores, como mostrar un mensaje.
                        }
                    });
                });

                // Agrega un oyente de eventos para el cierre del modal
                $('#presskitModal').on('hidden.bs.modal', function(e) {
                    actualizarPresskit(); // Actualizar presskit al cerrar el modal
                    // console.log('Oyente modal cerrado');
                });

            });
        </script>



        <!-- Borrado del Presskit -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#confirmDeletePresskit').click(function() {
                    $.ajax({
                        url: 'includes/borrar_presskit.php', //  
                        type: 'POST',
                        data: {
                            id_user: "<?php echo $_SESSION['id_user']; ?>"
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                // Actualiza el contenido del div presskitSection
                                $('#presskitSection').html('<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#presskitModal">Subir Presskit</button>');
                            } else {
                                alert('Error al borrar el presskit');
                            }
                            $('#deletePresskitModal').modal('hide');
                            swal("¡Éxito!", "Presskit borrado con éxito", "success");
                        },
                        error: function() {
                            alert('Error en la solicitud de borrado');
                        }
                    });
                });
            });
        </script>





    </body>

    </html>
<?php
}//termina else de login