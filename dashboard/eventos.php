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
        // $tabla = "usuarios";
        // $respuesta = Consultas::detalleUsuario($id, $tabla);
        ?>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearEventoModal">
            Crear Evento
        </button>
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
                            <a class="nav-link" href="">
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
                                <a class="btn btn-primary btn-xs r-20"><i class="icon-plus-circle mr-2" data-bs-toggle="modal" data-bs-target="#crearEventoModal"></i>Cerar Evento</a>
                                <!-- Botón para Abrir el Modal de Crear Evento -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearEventoModal">
                                    Crear Evento
                                </button>

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




                                        <br><br><br>
                                        <form id="crearEventoForm">
                                            <!-- Título del evento -->
                                            <div class="mb-3">
                                                <label for="tituloEvento" class="form-label">Título del Evento</label>
                                                <input type="text" class="form-control" id="tituloEvento" name="tituloEvento" required>
                                            </div>

                                            <!-- Descripción -->
                                            <div class="mb-3">
                                                <label for="descripcionEvento" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="descripcionEvento" name="descripcionEvento" rows="3"></textarea>
                                            </div>

                                            <!-- Dirección -->
                                            <div class="mb-3">
                                                <label for="direccionEvento" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="direccionEvento" name="direccionEvento">
                                            </div>

                                            <!-- Ciudad, Región o Provincia, y Recinto -->
                                            <!-- Asumiendo que estas listas son proporcionadas por el backend o son listas estáticas -->
                                            <div class="mb-3">
                                                <label for="ciudadEvento" class="form-label">Ciudad</label>
                                                <input type="text" class="form-control" id="ciudadEvento" name="ciudadEvento">
                                            </div>

                                            <!-- Fecha y Hora -->
                                            <div class="mb-3">
                                                <label for="fechaEvento" class="form-label">Fecha</label>
                                                <input type="date" class="form-control" id="fechaEvento" name="fechaEvento">
                                            </div>
                                            <div class="mb-3">
                                                <label for="horaEvento" class="form-label">Hora</label>
                                                <input type="time" class="form-control" id="horaEvento" name="horaEvento">
                                            </div>

                                            <!-- Aforo -->
                                            <div class="mb-3">
                                                <label for="aforoEvento" class="form-label">Aforo</label>
                                                <input type="number" class="form-control" id="aforoEvento" name="aforoEvento">
                                            </div>

                                            <!-- Tipo de Asistentes -->
                                            <div class="mb-3">
                                                <label class="form-label">Tipo de Asistentes</label>
                                                <div>
                                                    <input type="checkbox" id="normativo" name="tipoAsistentes">
                                                    <label for="normativo">Normativo</label>
                                                </div>
                                                <div>
                                                    <input type="checkbox" id="alPortador" name="tipoAsistentes">
                                                    <label for="alPortador">Al Portador</label>
                                                </div>
                                            </div>

                                            <!-- Tipo de Entrada -->
                                            <div class="mb-3">
                                                <label class="form-label">Tipo de Entrada</label>
                                                <div class="mb-2">
                                                    <input type="text" class="form-control mb-1" placeholder="Agregar nombre">
                                                    <input type="text" class="form-control mb-1" placeholder="Agregar precio">
                                                    <input type="number" class="form-control" placeholder="Cantidad">
                                                </div>
                                            </div>

                                            <!-- Video Promocional (opcional) -->
                                            <div class="mb-3">
                                                <label for="videoPromocional" class="form-label">Video Promocional (opcional)</label>
                                                <input type="text" class="form-control" id="videoPromocional" name="videoPromocional">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Crear Evento</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg shadow white fixed"></div>
    </div>



    <!-- Modales -->



    <!-- Modal para Crear Evento -->
    <div class="modal fade" id="crearEventoModal" tabindex="-1" aria-labelledby="crearEventoModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearEventoModalLabel">Crear Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="crearEventoForm">
                        <!-- Título del evento -->
                        <div class="mb-3">
                            <label for="tituloEvento" class="form-label">Título del Evento</label>
                            <input type="text" class="form-control" id="tituloEvento" name="tituloEvento" required>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcionEvento" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcionEvento" name="descripcionEvento" rows="3"></textarea>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-3">
                            <label for="direccionEvento" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccionEvento" name="direccionEvento">
                        </div>

                        <!-- Ciudad, Región o Provincia, y Recinto -->
                        <!-- Asumiendo que estas listas son proporcionadas por el backend o son listas estáticas -->
                        <div class="mb-3">
                            <label for="ciudadEvento" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudadEvento" name="ciudadEvento">
                        </div>

                        <!-- Fecha y Hora -->
                        <div class="mb-3">
                            <label for="fechaEvento" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fechaEvento" name="fechaEvento">
                        </div>
                        <div class="mb-3">
                            <label for="horaEvento" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="horaEvento" name="horaEvento">
                        </div>

                        <!-- Aforo -->
                        <div class="mb-3">
                            <label for="aforoEvento" class="form-label">Aforo</label>
                            <input type="number" class="form-control" id="aforoEvento" name="aforoEvento">
                        </div>

                        <!-- Tipo de Asistentes -->
                        <div class="mb-3">
                            <label class="form-label">Tipo de Asistentes</label>
                            <div>
                                <input type="checkbox" id="normativo" name="tipoAsistentes">
                                <label for="normativo">Normativo</label>
                            </div>
                            <div>
                                <input type="checkbox" id="alPortador" name="tipoAsistentes">
                                <label for="alPortador">Al Portador</label>
                            </div>
                        </div>

                        <!-- Tipo de Entrada -->
                        <div class="mb-3">
                            <label class="form-label">Tipo de Entrada</label>
                            <div class="mb-2">
                                <input type="text" class="form-control mb-1" placeholder="Agregar nombre">
                                <input type="text" class="form-control mb-1" placeholder="Agregar precio">
                                <input type="number" class="form-control" placeholder="Cantidad">
                            </div>
                        </div>

                        <!-- Video Promocional (opcional) -->
                        <div class="mb-3">
                            <label for="videoPromocional" class="form-label">Video Promocional (opcional)</label>
                            <input type="text" class="form-control" id="videoPromocional" name="videoPromocional">
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Evento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!--/#app -->
    <script src="assets/js/app.js"></script>



</body>

</html>