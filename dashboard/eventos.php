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

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card no-b">
                                <div class="row justify-content-between mb-3 mt-15">
                                    <div class="col-md-4">
                                        <div class="card-header white b-0 p-3">
                                            <h4 class="card-title">Eventos</h4>
                                            <small class="card-subtitle mb-2 text-muted">Listado de eventos próximos y pasados.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-primary btn-xs r-20" href="crear_evento.php"><i class="icon-plus-circle mr-2"></i>Crear Evento</a>
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
                                                        <th>Lugar</th>
                                                        <th>Fecha</th>
                                                        <th>Status</th>
                                                        <th>Audiencia</th>
                                                        <th>Acciones</th>
                                                        <th>Activar</th>
                                                        <th>Duplicar</th>
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







        <!--/#app -->
        <script src="assets/js/app.js"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- Obtener y listar eventos  -->
        <script>
            function cargarEventos(pagina = 1) {
                fetch(`includes/obtener_eventos.php?pagina=${pagina}`)
                    .then(response => response.json())
                    .then(respuesta => { // Cambia `eventos` a `respuesta` para evitar confusiones
                        let tabla = document.getElementById('recent-orders').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpia la tabla antes de agregar los nuevos eventos
                        respuesta.eventos.forEach(evento => { // Accede a `respuesta.eventos` en lugar de `eventos` directamente
                            let fila = tabla.insertRow();
                            fila.innerHTML = `
                    <td><span class="icon-person_pin"></span></td>
                    <td>${evento.id_event}</td>  
                    <td><a href="https://echomusic.net/eventos.php?e=${evento.id_event}" target="_blank">${evento.name_event}</a></td>
                    <td>${evento.name_location}</td>
                    <td>${evento.date_event}</td>
                    <td><span class="badge badge-light">Estado</span></td>
                    <td>${evento.audience_event}</td>  
                    <td> 
                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href="editar_evento.php?id_evento=${evento.id_event}"><i class="icon-pencil"></i></a>
                        <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="confirmarBorrado(${evento.id_event})"><i class="icon-trash"></i></a>
                    </td>
                    <td>
                        <div class="material-switch">
                            <input id="sw${evento.id_event}" name="someSwitchOption001${evento.id_event}" type="checkbox" ${evento.active_event == 1 ? 'checked' : ''} onchange="cambiarEstadoEvento(${evento.id_event}, this.checked)">
                            <label for="sw${evento.id_event}" class="bg-primary"></label>
                        </div>
                    </td>
                    <td>     
                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" onclick="duplicarEvento(${evento.id_event});"><i class="icon-control_point_duplicate"></i></a>
                    </td>
                `;
                        });

                        // Actualiza el paginador basado en respuesta.paginaActual y respuesta.totalPaginas
                        actualizarPaginador(respuesta.paginaActual, respuesta.totalPaginas);
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Función para actualizar paginador 
            function actualizarPaginador(paginaActual, totalPaginas) {
                let paginador = document.querySelector('.pagination');
                paginador.innerHTML = ''; // Limpia el paginador existente

                // Agrega "Anterior" si no es la primera página
                if (paginaActual > 1) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarEventos(${paginaActual - 1})">Anterior</a></li>`;
                }

                // Muestra hasta 2 páginas antes de la actual si es posible
                for (let i = Math.max(1, paginaActual - 2); i < paginaActual; i++) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarEventos(${i})">${i}</a></li>`;
                }

                // Página actual
                paginador.innerHTML += `<li class="page-item active"><a class="page-link" href="#">${paginaActual}</a></li>`;

                // Muestra hasta 2 páginas después de la actual si es posible
                for (let i = paginaActual + 1; i <= Math.min(paginaActual + 2, totalPaginas); i++) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarEventos(${i})">${i}</a></li>`;
                }

                // Si hay muchas páginas, muestra puntos suspensivos hacia el final
                if (paginaActual + 2 < totalPaginas) {
                    paginador.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarEventos(${totalPaginas})">${totalPaginas}</a></li>`;
                }

                // Agrega "Siguiente" si no es la última página
                if (paginaActual < totalPaginas) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarEventos(${paginaActual + 1})">Siguiente</a></li>`;
                }
            }


            // Para llamar a la función al cargar la página:
            document.addEventListener('DOMContentLoaded', function() {
                cargarEventos();
            });


            // Función confirmarBorrado
            function confirmarBorrado(idEvent) {
                swal({
                        title: "¿Estás seguro?",
                        text: "Una vez borrado, ¡no podrás recuperar este evento!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            fetch(`includes/borrar_evento.php?id=${idEvent}`, {
                                    method: 'DELETE',
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        swal("El evento ha sido borrado.", {
                                            icon: "success",
                                        });
                                        // Recargar la tabla de eventos
                                        cargarEventos(); // Recargar los eventos
                                    } else {
                                        swal("Error al borrar el evento.", {
                                            icon: "error",
                                        });
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        } else {
                            swal("Tu evento está seguro.");
                        }
                    });
            }

            // función duplicarEvento que reciba el id del evento a duplicar.
            function duplicarEvento(eventoId) {
                swal({
                        title: "¿Estás seguro?",
                        text: "Esto duplicará el evento y sus tickets.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDuplicate) => {
                        if (willDuplicate) {
                            fetch('includes/duplicar_evento.php', {
                                    method: 'POST',
                                    body: JSON.stringify({
                                        id_event: eventoId
                                    }),
                                    headers: {
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        swal("¡Duplicado!", "El evento ha sido duplicado correctamente.", "success")
                                            .then(() => {
                                                cargarEventos(); // Re-cargar los eventos
                                            });
                                    } else {
                                        swal("Error", "No se pudo duplicar el evento.", "error");
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    });
            }

            // Cambiar estado de Evento con botón Material Switch
            function cambiarEstadoEvento(idEvento, estado) {
                fetch('includes/cambiar_estado_evento.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_event: idEvento,
                            active_event: estado ? 1 : 0
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("Éxito", "El estado del evento ha sido actualizado.", "success");
                        } else {
                            swal("Error", "No se pudo actualizar el estado del evento.", "error");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        swal("Error", "Error al procesar la solicitud.", "error");
                    });
            }
        </script>



    </body>

    </html>
<?php
}//termina else de login