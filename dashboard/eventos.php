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
        <title>Eventos de Artista</title>
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
                                    <a class="btn btn-primary btn-xs r-20" href="crear_evento.php"><i class="icon-plus-circle mr-2" data-bs-toggle="modal" data-bs-target="#crearEventoModal"></i>Crear Evento</a>


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

                                                </tbody>
                                            </table>




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







        <!--/#app -->
        <script src="assets/js/app.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('includes/obtener_eventos.php') // Asegúrate de poner la ruta correcta
                    .then(response => response.json())
                    .then(eventos => {
                        let tabla = document.getElementById('recent-orders').getElementsByTagName('tbody')[0];
                        eventos.forEach(evento => {
                            let fila = tabla.insertRow();
                            fila.innerHTML = `
                        <td><span class="icon-person_pin"></span></td>
                        <td>${evento.id_event}</td> <!-- Asegúrate de que estas son las claves correctas -->
                        <td><a href="https://echomusic.net/eventos.php?e=${evento.id_event}" target="_blank">${evento.name_event}</a></td>
                        <td>${evento.name_location}</td>
                        <td>${evento.date_event}</td>
                        <td><span class="badge badge-light">Estado</span></td>
                        <td>$ ${evento.ventas}</td> <!-- Cambia 'ventas' por la clave correcta -->
                        <!-- Más celdas según sea necesario -->
                    `;
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>


    </body>

    </html>
<?php
}//termina else de login