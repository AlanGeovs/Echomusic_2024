<?php
// ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

require_once "model/model.php";

$id = $_SESSION["id_user"];
$nick = $_SESSION["nick_user"];

$idEvento = $_GET['id_evento'];
$datosEvento = Consultas::obtenerEventoPorId($idEvento); //  devuelve los datos del evento

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
        <title>Administador de Eventos</title>
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
                                <a class="nav-link" href="admin.php">
                                    <i class="icon icon-users"></i>Usuarios
                                </a>
                            </li>
                            <li>
                                <a class="nav-link active" href="admin_eventos.php">
                                    <i class=" icon icon-date_range"></i>Eventos > Entradas
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
                                    <div class="col-md-2">
                                        <div class="card-header white b-0 p-3">
                                            <img src="/dashboard/images/eventos/<?php echo htmlspecialchars($datosEvento['img']); ?>.jpg" width="100px" alt="Evento <?php echo htmlspecialchars($datosEvento['name_event']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-header white b-0 p-3">
                                            <h4 class="card-title">Evento: <?php echo htmlspecialchars($datosEvento['name_event']) . " <small> " . htmlspecialchars($datosEvento['id_event']); ?></small></h4>
                                            <p>Fecha y hora: <?php echo htmlspecialchars($datosEvento['date_event']); ?>
                                                <br>Lugar: <?php echo htmlspecialchars($datosEvento['name_location']); ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <div class="row mt-3">
                                            <div class="col-md-9 mb-0">
                                                <div class="form-group">
                                                    <input class="form-control form-control-lg" type="text" placeholder="Buscar entradas" id="filtro">
                                                </div>

                                            </div>
                                            <div class="col-md-3 mb-0 ">
                                                <button type="button" class="btn btn-primary mt-2" onclick="buscarEntradas()">
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
                                            <table id="recent-tickets" class="table table-hover mb-0 ps-container ps-theme-default">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th> </th>
                                                        <th>ID usuario</th>
                                                        <th>Nombre / Email / RUT</th>
                                                        <th># Orden / Fecha de compra</th>
                                                        <th># Tickets / Precio</th>
                                                        <th>Estatus</th>
                                                        <th>Acciones</th>
                                                        <th>Activar</th>
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
                                    <select class="form-control" id="id_type_user" name="id_type_user" required>
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
                                <div class="mb-3 col-md-6">
                                    <label for="nick_user" class="form-label">Nombre artístico</label>
                                    <input type="text" class="form-control" id="nick_user" name="nick_user" value=" " required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="mail_user" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="mail_user" name="mail_user" value=" " required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="first_name_user" class="form-label">Nombre </label>
                                    <input type="text" class="form-control" id="first_name_user" name="first_name_user" value=" " required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="last_name_user" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="last_name_user" name="last_name_user" value=" " required>
                                </div>
                                <!-- Ubicación Región y Ciudad -->
                                <div class="mb-3 col-md-6">
                                    <label for="id_region" class="form-label">Región</label>
                                    <select class="form-control" id="id_region" name="id_region" required>
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
                                    <select class="form-control" id="id_city" name="id_city" required>
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
                                    <select class="form-control" id="id_genero" name="id_genero" required>
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
                                    <select class="form-control" id="id_subgenero" name="id_subgenero" required>
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
                                    <select class="form-control" id="id_musician" name="id_musician" required>
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


        <!-- Modal para imagen del evento -->
        <div class="modal fade" id="modalImagenEvento" tabindex="-1" aria-labelledby="modalImagenEventoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalImagenEventoLabel">Imagen del Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="" id="imagenEnModal" class="img-fluid" alt="Imagen del Evento">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>





        <!--/#app -->
        <script src="assets/js/app.js"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- Obtener y listar Entradas por evento  -->
        <script>
            function cargarTickets(pagina = 1, filtro = '') {
                var idEvento = <?php echo json_encode($idEvento); ?>;
                const url = `includes/obtener_entradas_admin.php?evento=${idEvento}&pagina=${pagina}&filtro=${encodeURIComponent(filtro)}`;
                fetch(url)
                    .then(response => response.json())
                    .then(respuesta => { // Cambia `eventos` a `respuesta` para evitar confusiones
                        let tabla = document.getElementById('recent-tickets').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpia la tabla antes de agregar los nuevos eventos
                        respuesta.entradas.forEach(entrada => { // Accede a `respuesta.eventos` en lugar de `eventos` directamente
                            let fila = tabla.insertRow();
                            fila.innerHTML = `
                    <td>
                        ${entrada.id_subscribe_public}
                    </td>
                    <td>${entrada.id_user}</td>  
                    <td>                
                        ${entrada.subscribe_fname} ${entrada.subscribe_lname} 
                        <br><span class="icon-mail-envelope-closed2"></span> ${entrada.subscribe_email}                                                                                        
                        <br><span class="icon-calculator"></span> ${entrada.subscribe_rut}                                                                                        
                    </td> 
                    <td>
                           <b> <span class="icon-ticket"></span> ${entrada.order_transaction}</b> 
                           <br><span class="icon-date_range"></span> ${entrada.date_transaction}</b> 
                    </td>
                    <td>
                           <b> <span class="icon-ticket"></span> ${entrada.n_tickets}</b> 
                           <br><span class="icon-date_range"></span>Costo: $ ${entrada.amount_transaction_public}</b> 
                           <br><span class="icon-date_range"></span>Comisión: $ ${entrada.amount_transaction_commission}</b> 
                           <br><span class="icon-date_range"></span>Total: $ ${entrada.amount_transaction_commission + entrada.amount_transaction_public }</b> 
                    </td>
                    <td>   ${obtenerStatus(entrada.subscribe_status)}</td> 
                    <td>                          
                        <a class="btn-fab btn-fab-sm btn-success shadow text-white" onclick="reenviarEmail(${entrada.id_subscribe_public})">
                            <i class="icon-send"></i>
                        </a>
                        <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="confirmarBorrado(${entrada.id_subscribe_public})">
                            <i class="icon-trash"></i></a>
                    </td>
                    <td>
                        <div class="material-switch">
                            <input id="sw${entrada.id_subscribe_public}" name="someSwitchOption001${entrada.id_subscribe_public}" type="checkbox" ${entrada.subscribe_status == 1 ? 'checked' : ''} onchange="cambiarEstadoEntrada(${entrada.id_subscribe_public}, this.checked)"> 
                            <label for="sw${entrada.id_subscribe_public}" class="bg-primary"></label>
                        </div>
                    </td> 
                `;
                        });

                        // Actualiza el paginador basado en respuesta.paginaActual y respuesta.totalPaginas                        
                        actualizarPaginador(respuesta.paginaActual, respuesta.totalPaginas, filtro); // Pasar filtro como argumento adicional

                    })
                    .catch(error => console.error('Error:', error));
            }


            // Función para el Status del evento
            function obtenerStatus(status) {
                switch (status) {
                    case 0:
                        return '<span class="badge badge-light">0 - Pendiente</span>';
                    case 1:
                        return '<span class="badge badge-success">1 - Activo</span>';
                    case 2:
                        return '<span class="badge badge-warning">2 - Invalidado</span>';
                    default:
                        return '<span class="badge badge-light">Desconocido</span>'; // En caso de que idTypeUser tenga un valor no contemplado
                }
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
            //         paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarTickets(${paginaActual - 1}, '${filtro}')">Anterior</a></li>`;
            //     }

            //     // Muestra hasta 3 páginas antes de la actual si es posible
            //     for (let i = Math.max(1, paginaActual - 3); i < paginaActual; i++) {
            //         paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarTickets(${i}, '${filtro}')">${i}</a></li>`;
            //     }

            //     // Página actual
            //     paginador.innerHTML += `<li class="page-item active"><a class="page-link" href="#">${paginaActual}</a></li>`;

            //     // Muestra hasta 3 páginas después de la actual si es posible
            //     for (let i = paginaActual + 1; i <= Math.min(paginaActual + 3, totalPaginas); i++) {
            //         paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarTickets(${i}, '${filtro}')">${i}</a></li>`;
            //     }

            //     // Si hay muchas páginas, muestra puntos suspensivos hacia el final y la última página
            //     if (paginaActual + 3 < totalPaginas) {
            //         if (paginaActual + 3 < totalPaginas - 1) {
            //             paginador.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            //         }
            //         paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarTickets(${totalPaginas}, '${filtro}')">${totalPaginas}</a></li>`;
            //     }

            //     // Agrega "Siguiente" si no es la última página
            //     if (paginaActual < totalPaginas) {
            //         paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarTickets(${paginaActual + 1}, '${filtro}')">Siguiente</a></li>`;
            //     }
            // }
            function actualizarPaginador(paginaActual, totalPaginas, filtro = '') {
                let paginador = document.querySelector('.pagination');
                paginador.innerHTML = ''; // Limpia el paginador existente

                // Agrega "Anterior" si no es la primera página
                if (paginaActual > 1) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarTickets(${paginaActual - 1}, '${filtro}')">Anterior</a></li>`;
                }

                // Siempre agrega la primera página
                paginador.innerHTML += `<li class="page-item ${paginaActual === 1 ? 'active' : ''}"><a class="page-link" href="#" onclick="cargarTickets(1, '${filtro}')">1</a></li>`;

                // Agrega puntos suspensivos si es necesario
                if (paginaActual > 4) {
                    paginador.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }

                // Muestra hasta 3 páginas antes y después de la actual si es posible
                for (let i = Math.max(2, paginaActual - 3); i <= Math.min(paginaActual + 3, totalPaginas - 1); i++) {
                    paginador.innerHTML += `<li class="page-item ${i === paginaActual ? 'active' : ''}"><a class="page-link" href="#" onclick="cargarTickets(${i}, '${filtro}')">${i}</a></li>`;
                }

                // Agrega puntos suspensivos hacia el final si es necesario
                if (paginaActual < totalPaginas - 3) {
                    paginador.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }

                // Siempre agrega la última página si hay más de una página
                if (totalPaginas > 1) {
                    paginador.innerHTML += `<li class="page-item ${paginaActual === totalPaginas ? 'active' : ''}"><a class="page-link" href="#" onclick="cargarTickets(${totalPaginas}, '${filtro}')">${totalPaginas}</a></li>`;
                }

                // Agrega "Siguiente" si no es la última página
                if (paginaActual < totalPaginas) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarTickets(${paginaActual + 1}, '${filtro}')">Siguiente</a></li>`;
                }
            }




            // Para llamar a la función al cargar la página:
            document.addEventListener('DOMContentLoaded', function() {
                cargarTickets();
            });


            // Función confirmarBorrado
            function confirmarBorrado(idEntrada) {
                swal({
                        title: "¿Estás seguro?",
                        text: "Una vez borrado, ¡no podrás recuperar este evento!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            fetch(`includes/borrar_entrada.php?id=${idEntrada}`, {
                                    method: 'DELETE',
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        swal("La entrada ha sido borrado.", {
                                            icon: "success",
                                        });
                                        // Recargar la tabla de eventos
                                        const filtro = document.getElementById('filtro').value;
                                        cargarTickets(1, filtro);
                                    } else {
                                        swal("Error al borrar la entrada.", {
                                            icon: "error",
                                        });
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        } else {
                            swal("Tu entrada está segura.");
                        }
                    });
            }


            // Cambiar estado de Entrada con botón Material Switch
            function cambiarEstadoEntrada(idEvento, estado) {
                fetch('includes/cambiar_estado_entrada.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_subscribe_public: idEvento,
                            subscribe_status: estado ? 1 : 2
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("Éxito", "El estado del evento ha sido actualizado.", "success");
                            // Recargar la tabla de eventos
                            const filtro = document.getElementById('filtro').value;
                            cargarTickets(1, filtro);
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
            function buscarEntradas() {
                const filtro = document.getElementById('filtro').value;
                cargarTickets(1, filtro); // Llama a cargarTickets con el valor del filtro
            }


            // Event Listener para actualizar la imagen del modal:
            $('#modalImagenEvento').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Elemento que disparó el modal
                var imgSrc = button.data('img'); // Extrae la ruta de la imagen del data-img
                var modal = $(this);
                modal.find('.modal-body #imagenEnModal').attr('src', imgSrc); // Actualiza el src de la imagen en el modal
            });

            // Reenvia entradas al Usuario comprador de Tickets
            function reenviarEmail(idEntrada) {
                swal({
                        title: "¿Estás seguro de querer reenviar el correo?",
                        text: "Esto enviará los detalles de la entrada al correo del usuario.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willSend) => {
                        if (willSend) {
                            fetch('includes/reenviar_email_entrada.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        id_entrada: idEntrada
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        swal("Correo reenviado con éxito!", {
                                            icon: "success",
                                        });
                                    } else {
                                        swal("Error al reenviar el correo", {
                                            icon: "error",
                                        });
                                    }
                                });
                        }
                    });
            }
        </script>


    </body>

    </html>
<?php
}//termina else de login