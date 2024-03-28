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
                                <a class="nav-link" href="perfil-editar.php">
                                    <i class="icon icon-home2"></i>Editar
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="perfil-tarifas.php">
                                    <i class="icon icon-edit"></i>Mis tarifas
                                </a>
                            </li>
                            <li>
                                <a class="nav-link active" href="perfil-reservas.php">
                                    <i class="icon icon-cog"></i>Reservas
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </header>

            <!--Reservas-->
            <div class="container-fluid animatedParent animateOnce my-3">
                <div class="animated fadeInUpShort">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card no-b">


                                <div class="collapse show" id="invoiceCard">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>ID</th>
                                                        <th>Nombre</th>
                                                        <th>Ubicación</th>
                                                        <th>Descripción</th>
                                                        <th>Fecha</th>
                                                        <th>Status</th>
                                                        <th>Plan</th>
                                                        <th>Precio</th>
                                                        <th>Acciones</th>
                                                        <th>Aceptar</th>
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

        <!-- Obtener y listar reservas  -->
        <script>
            function cargarEventos(pagina = 1) {
                fetch(`includes/obtener_reservas.php?pagina=${pagina}`)
                    .then(response => response.json())
                    .then(respuesta => { // Cambia `reservas` a `respuesta` para evitar confusiones
                        let tabla = document.getElementById('recent-orders').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpia la tabla antes de agregar los nuevos eventos
                        respuesta.reservas.forEach(reserva => { // Accede a `respuesta.reservas` en lugar de `reservas` directamente
                            let fila = tabla.insertRow();
                            fila.innerHTML = `
                    <td><span class="icon-person_pin"></span></td>
                    <td>${reserva.id_event}</td>  
                    <td><a href="#" target="_blank">${reserva.name_event}</a></td>
                    <td>${reserva.location} <br> ${reserva.name_region} / ${reserva.name_city} </td>
                    <td>${reserva.desc_event}</td>
                    <td>${reserva.date_event}</td>
                    <td><span class="badge badge-light">Estado</span></td>
                    <td>${getPlanName(reserva.id_name_plan)}</td>
                    <td>$ ${reserva.value_plan+reserva.commission_plan}</td>  
                    <td> 
                        <!-- <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href="detalles_reserva.php?id_evento=${reserva.id_event}"><i class="icon-eye"></i></a> -->
                        <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="confirmarBorrado(${reserva.id_event})"><i class="icon-trash"></i></a>
                    </td>
                    <td>
                        <div class="material-switch">
                            <input id="sw${reserva.id_event}" name="someSwitchOption001${reserva.id_event}" type="checkbox" ${reserva.status_event == 'reserved' ? 'checked' : ''} onchange="cambiarEstadoReserva(${reserva.id_event}, this.checked)">
                            <label for="sw${reserva.id_event}" class="bg-primary"></label>
                        </div>
                    </td> 
                `;
                        });

                        // Actualiza el paginador basado en respuesta.paginaActual y respuesta.totalPaginas
                        actualizarPaginador(respuesta.paginaActual, respuesta.totalPaginas);
                    })
                    .catch(error => console.error('Error:', error));
            }
            // Función para cambiar nombre del plan
            function getPlanName(planId) {
                const planNames = {
                    '1': 'Básico',
                    '2': 'Estándar',
                    '3': 'Profesional'
                };
                return planNames[planId] || 'Desconocido'; // Devuelve 'Desconocido' si el id no coincide
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
                        text: "Una vez borrado, ¡no podrás recuperar esta reservación!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            fetch(`includes/borrar_reserva.php?id=${idEvent}`, {
                                    method: 'DELETE',
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        swal("La reserva ha sido borrado.", {
                                            icon: "success",
                                        });
                                        // Recargar la tabla de reservas
                                        cargarEventos(); // Recargar los reservas
                                    } else {
                                        swal("Error al borrar la reserva.", {
                                            icon: "error",
                                        });
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        } else {
                            swal("Tu reserva está segura.");
                        }
                    });
            }


            // Cambiar estado de Evento con botón Material Switch
            function cambiarEstadoReserva(idEvento, estado) {
                fetch('includes/cambiar_estado_reserva.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_event: idEvento,
                            status_event: estado ? 'reserved' : 'pending'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("Éxito", "El estado de la reservación ha sido actualizado.", "success");
                        } else {
                            swal("Error", "No se pudo actualizar el estado de la reservación.", "error");
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