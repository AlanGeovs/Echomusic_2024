<?php
// ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

require_once "model/model.php";

$id = $_SESSION["id_user"];
$nick = $_SESSION["nick_user"];

if (!isset($_SESSION["id_user"])) {
    header("Location: index.php?error=21&id_user=" . $id . "&nick=" . $nick);
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
        <title>Administrador de Usuarios</title>
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/app.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            // $tabla = "usuarios";
            // $respuesta = Consultas::detalleUsuario($id, $tabla);
            ?>

            <header class="white pt-3 relative shadow">
                <div class="container-fluid">

                    <div class="row">
                        <ul class="nav nav-material responsive-tab">
                            <li>
                                <a class="nav-link active" href="admin.php">
                                    <i class="icon icon-users"></i>Usuarios
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="admin_eventos.php">
                                    <i class=" icon icon-date_range"></i>Eventos
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="admin_crowdfunding.php">
                                    <i class=" icon icon-money"></i>Crowdfunding
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </header>

            <!--Usuarios-->
            <div class="container-fluid animatedParent animateOnce my-3">
                <div class="animated fadeInUpShort">

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card no-b">
                                <div class="row justify-content-between mb-0 mt-15">
                                    <div class="col-md-4">
                                        <div class="card-header white b-0 p-3">
                                            <h4 class="card-title">Administración de usuarios</h4>
                                        </div>
                                    </div>

                                    <div class="col-md-8 d-flex align-items-center justify-content-center">
                                        <div class="row mt-3">
                                            <div class="col-md-9 mb-0">
                                                <div class="form-group">
                                                    <input class="form-control form-control-lg" type="text" placeholder="Buscar usuario" id="filtro">
                                                </div>

                                            </div>
                                            <div class="col-md-3 mb-0 ">
                                                <button type="button" class="btn btn-primary mt-2" onclick="buscarClientes()">
                                                    <i class="icon-search3 mr-2"></i>Buscar
                                                </button>
                                            </div>
                                            <!-- <div class="col-md-3 mb-3 mt-5">
                                                <a href="includes/exporta.php" class="btn btn-primary btn-lg r-20"><i
                                                        class="icon-download mr-2"></i>Descargar datos</a>
                                            </div> -->
                                        </div>
                                        <!-- <a class="btn btn-primary btn-xs r-20" href="crear_evento.php"><i class="icon-plus-circle mr-2"></i>Crear Usuario</a> -->
                                    </div>
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
                                                        <th>Ciudad / Región</th>
                                                        <th>Fecha de registro</th>
                                                        <th>Tipo de usuario</th>
                                                        <th>Verificado</th>
                                                        <th>Acciones</th>
                                                        <th>Verificar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- <tr>
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
                                                    </tr> -->

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>


                    <!-- Paginador -->
                    <nav class="my-3" aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Anterior</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">Siguiente</a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>

        </div>


        <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
        <div class="control-sidebar-bg shadow white fixed"></div>
        </div>



        <!-- Modales -->
        <!-- Modal Editar Datos del Usuario -->
        <div class="modal fade" id="editarDatosUsuario" tabindex="-1" role="dialog" aria-labelledby="editarDatosUsuarioLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarDatosUsuarioLabel">Editar Datos del Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Contenido del modal -->
                    <form id="formEditarUsuario" method="post">
                        <div class="modal-body">

                            <div class="row">
                                <input type="hidden" class="form-control" id="id" name="id" value=" ">

                                <div class="mb-3 col-md-12">
                                    <label for="id_type_user" class="form-label">Tipo de usuario</label>
                                    <select class="form-control" id="id_type_user" name="id_type_user">
                                        <?php
                                        $res = Consultas::listarVariable('type_user');
                                        //var_dump($respuesta);
                                        for ($i = 0; $i < count($res); $i++) {
                                            if ($res[$i]["type_user"] == $busca_Ciudad["type_user"]) {
                                                echo "<option value='" . $res[$i]["id_type_user"] . "' id='" . $res[$i]["id_type_user"] . "' selected>" . $res[$i]["tipo_usuario"] . "</option>";
                                            } else {
                                                echo "<option value='" . $res[$i]["id_type_user"] . "' id='" . $res[$i]["id_type_user"] . "' >" . $res[$i]["tipo_usuario"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Campos específicos para artistas -->
                                <div id="camposArtista" class="row">
                                    <div class="mb-3 col-md-6 ml-3">
                                        <label for="nick_user" class="form-label">Nombre artístico</label>
                                        <input type="text" class="form-control" id="nick_user" name="nick_user">
                                    </div>
                                    <!-- Tipo de Artista -->
                                    <div class="mb-3 col-md-5 mr-3">
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
                                    <!-- Genero -->
                                    <div class="mb-3 col-md-6 ml-3">
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
                                    <div class="mb-3 col-md-5 mr-3">
                                        <label for="id_subgenero" class="form-label">Sub género</label>
                                        <select class="form-control" id="id_subgenero" name="id_subgenero">
                                            <?php
                                            $res = Consultas::listarVariable('sub_genres');
                                            //var_dump($respuesta);
                                            for ($i = 0; $i < count($res); $i++) {
                                                if ($res[$i]["name_genre"] == $busca_Genero["name_subGenre"]) {
                                                    echo "<option value='" . $res[$i]["id_subGenre"] . "' selected>" . $res[$i]["name_subGenre"] . "</option>";
                                                } else {
                                                    echo "<option value='" . $res[$i]["id_subGenre"] . "'>" . $res[$i]["name_subGenre"] . "</option>";
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>

                                </div>


                                <!-- <div class="mb-3 col-md-6">
                                    <label for="nick_user" class="form-label">Nombre artístico</label>
                                    <input type="text" class="form-control" id="nick_user" name="nick_user" value=" ">
                                </div> -->

                                <div class="mb-3 col-md-12">
                                    <label for="mail_user" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="mail_user" name="mail_user" value=" ">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="first_name_user" class="form-label">Nombre </label>
                                    <input type="text" class="form-control" id="first_name_user" name="first_name_user" value=" ">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="last_name_user" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="last_name_user" name="last_name_user" value=" ">
                                </div>
                                <!-- Ubicación Región y Ciudad -->
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

                                <!-- <div class="mb-3 col-md-4">
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
                                 Subgenero  
                                <div class="mb-3 col-md-4">
                                    <label for="id_subgenero" class="form-label">Sub género</label>
                                    <select class="form-control" id="id_subgenero" name="id_subgenero">
                                        <?php
                                        $res = Consultas::listarVariable('sub_genres');
                                        //var_dump($respuesta);
                                        for ($i = 0; $i < count($res); $i++) {
                                            if ($res[$i]["name_genre"] == $busca_Genero["name_subGenre"]) {
                                                echo "<option value='" . $res[$i]["id_subGenre"] . "' selected>" . $res[$i]["name_subGenre"] . "</option>";
                                            } else {
                                                echo "<option value='" . $res[$i]["id_subGenre"] . "'>" . $res[$i]["name_subGenre"] . "</option>";
                                            }
                                        }
                                        ?>

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
                                </div> -->

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>







        <!--/#app -->
        <script src="assets/js/app.js"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- Obtener y listar usuarios  -->
        <script>
            function cargarUsuarios(pagina = 1, filtro = '') {
                const url = `includes/obtener_usuarios.php?pagina=${pagina}&filtro=${encodeURIComponent(filtro)}`;
                fetch(url)
                    .then(response => response.json())
                    .then(respuesta => { // Cambia `eventos` a `respuesta` para evitar confusiones
                        let tabla = document.getElementById('recent-orders').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpia la tabla antes de agregar los nuevos eventos
                        respuesta.usuarios.forEach(usuario => { // Accede a `respuesta.eventos` en lugar de `eventos` directamente
                            let fila = tabla.insertRow();
                            fila.innerHTML = `
                    <td><span class="icon-person_pin"></span></td>
                    <td>${usuario.id_user}</td>  
                    <td>
                        ${usuario.first_name_user} ${usuario.last_name_user} ${usuario.nick_user ? `(<a href="https://echomusic.net/artistas.php?a=${usuario.id_user}" target="_blank">${usuario.nick_user}</a>)` : ''}
                        <br><span class="icon-mail-envelope-closed2"></span> ${usuario.mail_user}
                    </td>
                    <td>
                        ${usuario.nombre_ciudadyregion ? usuario.nombre_ciudadyregion : ' - '}  
                    </td>
                    <td>${usuario.date_register_user}</td>
                    <td>${obtenerTipoUsuario(usuario.id_type_user)}</td>
                    <td>${validarUsuarioVerificado(usuario.verified)}</td>  
                    <td>  
                        <!-- <a class="btn-fab btn-fab-sm btn-primary shadow text-white" ><i class="icon-pencil"></i></a> -->
                        <!-- Botón para abrir modal -->
                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" data-toggle="modal" data-target="#editarDatosUsuario" data-userid="${usuario.id_user}">
                            <i class="icon-pencil"></i>
                        </a>
                        <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="confirmarBorrado(${usuario.id_user})"><i class="icon-trash"></i></a>
                    </td>
                    <td>
                        <div class="material-switch">
                            <input id="sw${usuario.id_user}" name="someSwitchOption001${usuario.id_user}" type="checkbox" ${usuario.verified == 'yes' ? 'checked' : ''} onchange="cambiarEstadoVerificacion(${usuario.id_user}, this.checked)">
                            <label for="sw${usuario.id_user}" class="bg-primary"></label>
                        </div>
                    </td> 
                `;
                        });

                        // Actualiza el paginador basado en respuesta.paginaActual y respuesta.totalPaginas                        
                        actualizarPaginador(respuesta.paginaActual, respuesta.totalPaginas, filtro); // Pasar filtro como argumento adicional

                    })
                    .catch(error => console.error('Error:', error));
            }

            // Función para el Tipo de Usuarios
            function obtenerTipoUsuario(idTypeUser) {
                switch (idTypeUser) {
                    case 1:
                        return '<span class="badge badge-success">Artista</span>';
                    case 2:
                        return '<span class="badge badge-secondary">Usuario</span>';
                    case 3:
                        return '<span class="badge badge-warning">Espacio</span>';
                    case 4:
                        return '<span class="badge badge-dark">Admin</span>';
                    case 5:
                        return '<span class="badge badge-danger">Agente</span>';
                    default:
                        return '<span class="badge badge-light">Desconocido</span>'; // En caso de que idTypeUser tenga un valor no contemplado
                }
            }

            //función para Mostrar usuario verificado
            function validarUsuarioVerificado(verified) {
                switch (verified) {
                    case 'yes':
                        return '<span class="icon icon-circle s-12  mr-2 text-success"></span> Si';
                    case 'no':
                        return '<span class="icon icon-circle s-12  mr-2 text-warning"></span> No';
                    default:
                        return '<span class="icon icon-circle s-12  mr-2 text-light"></span> Desconocido'
                }
            }


            // Función para actualizar paginador incluyendo el filtro
            // function actualizarPaginador(paginaActual, totalPaginas, filtro = '') {
            //     let paginador = document.querySelector('.pagination');
            //     paginador.innerHTML = ''; // Limpia el paginador existente

            //     // Agrega "Anterior" si no es la primera página
            //     if (paginaActual > 1) {
            //         paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarUsuarios(${paginaActual - 1}, '${filtro}')">Anterior</a></li>`;
            //     }

            //     // Muestra hasta 3 páginas antes de la actual si es posible
            //     for (let i = Math.max(1, paginaActual - 3); i < paginaActual; i++) {
            //         paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarUsuarios(${i}, '${filtro}')">${i}</a></li>`;
            //     }

            //     // Página actual
            //     paginador.innerHTML += `<li class="page-item active"><a class="page-link" href="#">${paginaActual}</a></li>`;

            //     // Muestra hasta 3 páginas después de la actual si es posible
            //     for (let i = paginaActual + 1; i <= Math.min(paginaActual + 3, totalPaginas); i++) {
            //         paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarUsuarios(${i}, '${filtro}')">${i}</a></li>`;
            //     }

            //     // Si hay muchas páginas, muestra puntos suspensivos hacia el final y la última página
            //     if (paginaActual + 3 < totalPaginas) {
            //         if (paginaActual + 3 < totalPaginas - 1) {
            //             paginador.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            //         }
            //         paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarUsuarios(${totalPaginas}, '${filtro}')">${totalPaginas}</a></li>`;
            //     }

            //     // Agrega "Siguiente" si no es la última página
            //     if (paginaActual < totalPaginas) {
            //         paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarUsuarios(${paginaActual + 1}, '${filtro}')">Siguiente</a></li>`;
            //     }
            // }
            function actualizarPaginador(paginaActual, totalPaginas, filtro = '') {
                let paginador = document.querySelector('.pagination');
                paginador.innerHTML = ''; // Limpia el paginador existente

                // Agrega "Anterior" si no es la primera página
                if (paginaActual > 1) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarUsuarios(${paginaActual - 1}, '${filtro}')">Anterior</a></li>`;
                }

                // Siempre agrega la primera página
                paginador.innerHTML += `<li class="page-item ${paginaActual === 1 ? 'active' : ''}"><a class="page-link" href="#" onclick="cargarUsuarios(1, '${filtro}')">1</a></li>`;

                // Agrega puntos suspensivos si es necesario
                if (paginaActual > 4) {
                    paginador.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }

                // Muestra hasta 3 páginas antes y después de la actual si es posible
                for (let i = Math.max(2, paginaActual - 3); i <= Math.min(paginaActual + 3, totalPaginas - 1); i++) {
                    paginador.innerHTML += `<li class="page-item ${i === paginaActual ? 'active' : ''}"><a class="page-link" href="#" onclick="cargarUsuarios(${i}, '${filtro}')">${i}</a></li>`;
                }

                // Agrega puntos suspensivos hacia el final si es necesario
                if (paginaActual < totalPaginas - 3) {
                    paginador.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }

                // Siempre agrega la última página si hay más de una página
                if (totalPaginas > 1) {
                    paginador.innerHTML += `<li class="page-item ${paginaActual === totalPaginas ? 'active' : ''}"><a class="page-link" href="#" onclick="cargarUsuarios(${totalPaginas}, '${filtro}')">${totalPaginas}</a></li>`;
                }

                // Agrega "Siguiente" si no es la última página
                if (paginaActual < totalPaginas) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarUsuarios(${paginaActual + 1}, '${filtro}')">Siguiente</a></li>`;
                }
            }



            // Para llamar a la función al cargar la página:
            document.addEventListener('DOMContentLoaded', function() {
                cargarUsuarios();
            });

            // Función confirmarBorrado
            function confirmarBorrado(idUser) {
                swal({
                        title: "¿Estás seguro?",
                        text: "Una vez borrado, ¡no podrás recuperar este usuario!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            fetch(`includes/borrar_usuario.php?id=${idUser}`, {
                                    method: 'DELETE',
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        swal("El usuario ha sido borrado.", {
                                            icon: "success",
                                        });
                                        // Recargar la tabla de usuarios
                                        cargarUsuarios(); // Recargar los usuarios
                                    } else {
                                        swal("Error al borrar el usuario.", {
                                            icon: "error",
                                        });
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        } else {
                            swal("El usuario está seguro.");
                        }
                    });
            }

            // Cambiar estado de verificación del Usuario con botón Material Switch
            function cambiarEstadoVerificacion(idUsuario, estado) {
                fetch('includes/cambiar_estado_verificacion.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_user: idUsuario,
                            verified: estado ? 'yes' : 'no'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("Éxito", "El estado del evento ha sido actualizado.", "success");
                            const filtro = document.getElementById('filtro').value;
                            cargarUsuarios(1, filtro);
                        } else {
                            swal("Error", "No se pudo actualizar el estado del evento.", "error");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        swal("Error", "Error al procesar la solicitud.", "error");
                    });
            }

            // Función para buscar usuarios
            function buscarClientes() {
                const filtro = document.getElementById('filtro').value;
                cargarUsuarios(1, filtro); // Llama a cargarUsuarios con el valor del filtro
            }
        </script>

        <!-- Editar datos del usuario -->
        <script>
            // Ajustar campos segun el tipo de asuario
            function ajustarCamposPorTipoUsuario(tipoUsuario) {
                if (tipoUsuario == "1") { // Suponiendo que "1" es el valor para artistas
                    $('#camposArtista').show(); // Muestra campos específicos de artistas
                } else {
                    $('#camposArtista').hide(); // Oculta campos específicos de artistas
                }
            }

            $('#editarDatosUsuario').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var userId = button.data('userid'); // Extrae el ID del usuario del atributo data-*

                fetch(`includes/obtenerDatosUsuario.php?id=${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Rellena el formulario con los datos obtenidos
                        $('#id').val(data.id_user);
                        $('#id_type_user').val(data.id_type_user).trigger('change');
                        $('#nick_user').val(data.nick_user);
                        $('#mail_user').val(data.mail_user);
                        $('#first_name_user').val(data.first_name_user);
                        $('#last_name_user').val(data.last_name_user);
                        $('#id_city').val(data.id_city);
                        $('#id_region').val(data.id_region);
                        $('#id_genero').val(data.id_genero);
                        $('#id_subgenero').val(data.id_subgenero);
                        $('#id_musician').val(data.id_musician);

                        // Define generoActual y subgeneroActual aquí
                        var generoActual = data.id_genero;
                        var subgeneroActual = data.id_subgenero;
                        var regionActual = data.id_region;
                        var ciudadActual = data.id_city;

                        // Llama a la función para obtener los subgéneros después de definir generoActual y subgeneroActual
                        obtenerSubGeneros(generoActual, subgeneroActual);
                        // Llama la fucnión para obtener la ciudad actual
                        cargarCiudades(regionActual);

                        // Llama a la función para ajustar los campos inmediatamente después de establecer el tipo de usuario
                        ajustarCamposPorTipoUsuario($('#id_type_user').val());

                        // Verifica y selecciona el tipo de usuario en el select
                        $("#id_type_user option").each(function() {
                            if ($(this).val() == data.id_type_user) { // Asegúrate de que la comparación sea correcta
                                $(this).prop('selected', true);
                            }
                        });
                    });

            });

            // Escucha cambios en el selector de tipo de usuario y ajusta la visibilidad de campos
            $('#id_type_user').change(function() {
                ajustarCamposPorTipoUsuario($(this).val());
            });


            // Acción de Guardar datos editados con el botón submit
            $('#formEditarUsuario').on('submit', function(e) {
                e.preventDefault(); // Prevenir el envío tradicional del formulario

                var formData = new FormData(this); // Recolecta los datos del formulario

                fetch('includes/procesarEditarUsuario.php', {
                        method: 'POST',
                        body: formData // Envía los datos del formulario recogidos
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("Éxito", "Los datos del usuario han sido actualizados correctamente.", "success")
                                .then(() => {
                                    $('#editarDatosUsuario').modal('hide'); // Oculta el modal                                    
                                });
                            const filtro = document.getElementById('filtro').value;
                            cargarUsuarios(1, filtro);
                        } else {
                            swal("Error", "No se pudieron actualizar los datos del usuario. " + data.error, "error");
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>


        <!-- Cambio de Región y Ciudad -->
        <!-- <script type="text/javascript">
            $(document).ready(function() {
                $('#id_region').on('change', function() {
                    var id_region = $(this).val();
                    cargarCiudades(id_region);
                });

                // Cargar ciudades al abrir el modal
                $('#editarDatosUsuario').on('show.bs.modal', function() {
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
                        var opciones = '<option value="">-Seleccione una ciudad-</option>';
                        $.each(ciudades, function(index, ciudad) {
                            var selected = (ciudad.name_city == data.name_city) ? ' selected' : '';
                            opciones += '<option value="' + ciudad.id_city + '"' + selected + '> ' + ciudad.name_city + '</option>';
                        });
                        $('#id_city').html(opciones);
                    },
                    error: function() {
                        alert('Error al cargar las ciudades');
                    }
                });
            }
        </script> -->

        <!-- Nueva función para cargar ciudades según selección actual -->
        <script>
            $(document).ready(function() {
                // Definir la función cargarCiudades
                function cargarCiudades(id_region) {
                    if (id_region) {
                        $.ajax({
                            url: 'includes/obtener_regiones_ciudades.php',
                            type: 'POST',
                            data: {
                                id_region: id_region
                            },
                            dataType: 'json',
                            success: function(ciudades) {
                                $('#id_city').empty().append('<option value="">Seleccione una ciudad</option>');
                                ciudades.forEach(function(ciudad) {
                                    $('#id_city').append('<option value="' + ciudad.id_city + '">' + ciudad.name_city + '</option>');
                                });
                                $('#id_city').prop('disabled', false);
                            },
                            error: function() {
                                alert('Error al cargar las ciudades');
                            }
                        });
                    } else {
                        $('#id_city').html('<option value="">Seleccione una región primero</option>').prop('disabled', true);
                    }
                }

                // Asignar el manejador de eventos al cambio en el select de regiones
                $('#id_region').on('change', function() {
                    var id_region = $(this).val();
                    cargarCiudades(id_region); // Llamar a cargarCiudades con el id_region seleccionado
                });

                // Si necesitas llamar a cargarCiudades desde otro lugar, simplemente invoca cargarCiudades(id_region) donde sea necesario.
            });
        </script>


        <!-- Cambio de Región y Ciudad -->
        <!-- <script type="text/javascript">
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
        </script> -->

        <!-- Generos y subgéneros -->
        <script>
            $(document).ready(function() {
                function obtenerSubGeneros(id_genero, subgeneroActual) {
                    if (id_genero) {
                        $.ajax({
                            url: 'includes/obtener_subgeneros.php',
                            type: 'POST',
                            data: {
                                id_genero: id_genero
                            },
                            dataType: 'json',
                            success: function(subgeneros) {
                                $('#id_subgenero').empty().append('<option value="">Seleccione un subgénero</option>');
                                subgeneros.forEach(function(subgenero) {
                                    var selected = subgenero.id_subGenre == subgeneroActual ? ' selected' : '';
                                    $('#id_subgenero').append('<option value="' + subgenero.id_subGenre + '"' + selected + '>' + subgenero.name_subGenre + '</option>');
                                });
                                $('#id_subgenero').prop('disabled', false);
                            },
                            error: function() {
                                alert('Error al cargar los subgéneros');
                            }
                        });
                    } else {
                        $('#id_subgenero').html('<option value="">Seleccione un género primero</option>').prop('disabled', true);
                    }
                }

                $(document).ready(function() {
                    $('#id_genero').on('change', function() {
                        var id_genero = $(this).val();
                        obtenerSubGeneros(id_genero, null); // Llama a la función sin subgénero actual porque se está cambiando el género
                    });
                });
            });
        </script>

    </body>

    </html>
<?php
}//termina else de login