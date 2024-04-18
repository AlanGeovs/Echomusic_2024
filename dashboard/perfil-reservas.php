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
                                                        <?php
                                                        if ($_SESSION["id_type_user"] == 1 || $_SESSION["id_type_user"] == 4) {
                                                            echo  "<th>Aceptar</th>";
                                                        }

                                                        ?>
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

        <!-- Modal Detalles de Reserva -->
        <div class="modal fade" id="modalDetallesReserva" tabindex="-1" role="dialog" aria-labelledby="modalDetallesReservaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetallesReservaLabel">Detalles de la Reserva</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario para editar los datos-->
                        <form id="contratarTarifa" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id_event" name="id_event" value="">
                            <input type="hidden" id="id_user_buy" name="id_user_buy" value="<?php echo $_SESSION["id_user"];  ?>">
                            <input type="hidden" id="id_user_sell" name="id_user_sell" value="<?php echo $_GET['a']; ?>">
                            <input type="hidden" id="id_plan_key" name="id_plan_key" value="<?php echo $tarifasArtista[0]["id_plan_key"]; ?>">
                            <input type="hidden" id="id_plan" name="id_plan" value="<?php echo $tarifasArtista[0]["id_plan"]; ?>">
                            <input type="hidden" id="value_plan_event" name="value_plan_event" value="<?php echo $tarifasArtista[0]["value_plan"]; ?>">
                            <input type="hidden" id="id_name_plan" name="id_name_plan" value="<?php echo $id_name_plan; ?>">
                            <!-- Evento -->
                            <div class="row justify-content-center">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="evento">Evento</label>
                                        <input type="text" class="form-control" id="name_event" name="name_event" placeholder="Nombre del Evento" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Dirección, Región, Ciudad -->
                            <div class="row justify-content-center">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Dirección" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="id_region">Región</label>
                                        <select class="form-control" id="id_region" name="id_region" required>
                                            <option>Selecciona una región</option>
                                            <?php
                                            $res = Consultas::listarVariable('regions');
                                            // var_dump($res);
                                            for ($i = 0; $i < count($res); $i++) {
                                                echo "<option value='" . $res[$i]["id_region"] . "' id='" . $res[$i]["id_region"] . "' >" . $res[$i]["name_region"] . "</option>";
                                            }
                                            ?>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="id_city">Ciudad</label>
                                        <select class="form-control" id="id_city" name="id_city" required>
                                            <option>Selecciona una ciudad</option>
                                            <?php
                                            $res = Consultas::listarVariable('cities');
                                            //var_dump($respuesta);
                                            for ($i = 0; $i < count($res); $i++) {
                                                echo "<option value='" . $res[$i]["id_city"] . "' id='" . $res[$i]["id_city"] . "' >" . $res[$i]["name_city"] . "</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Fecha y Hora, Teléfono -->
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-sm-">
                                    <div class="form-group">
                                        <label for="date_event">Fecha y Hora</label>



                                        <input type="text" class="date-time-picker form-control" id="date_event" name="date_event" data-options='{"timepicker":true, "format":"Y-m-d H:i", "step":30}'>


                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-">
                                    <div class="form-group">
                                        <label for="phone_event">Teléfono</label>
                                        <input type="phone" class="form-control" id="phone_event" name="phone_event" placeholder="Teléfono de contacto" required>
                                    </div>
                                </div>
                            </div>



                            <!-- Escribe tu solicitud -->
                            <div class="row justify-content-center">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="solicitud">Edita la solicitud</label>
                                        <textarea class="form-control" id="desc_event" name="desc_event" rows="5" placeholder="Detalles de tu solicitud..." required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón de enviar -->
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="box-btn  btn-sm text-center comprar-btn" onclick="guardarContratacionTarifa();">Guardar cambios de Solicitud</button>
                                </div>
                            </div>
                        </form>

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

        <!-- Obtener y listar reservas  -->
        <script>
            // function cargarEventos(pagina = 1) {
            //     fetch(`includes/obtener_reservas.php?pagina=${pagina}`)
            //         .then(response => response.json())
            //         .then(respuesta => { // Cambia `reservas` a `respuesta` para evitar confusiones
            //             let tabla = document.getElementById('recent-orders').getElementsByTagName('tbody')[0];
            //             tabla.innerHTML = ''; // Limpia la tabla antes de agregar los nuevos eventos
            //             respuesta.reservas.forEach(reserva => { // Accede a `respuesta.reservas` en lugar de `reservas` directamente
            //                 let fila = tabla.insertRow();
            //                 fila.innerHTML = `
            //                     <td><span class="icon-person_pin"></span></td>
            //                     <td>${reserva.id_event}</td>  
            //                     <td><a href="#" target="_blank">${reserva.name_event}</a></td>
            //                     <td>${reserva.location} <br> ${reserva.name_region} / ${reserva.name_city} </td>
            //                     <td>${reserva.desc_event}</td>
            //                     <td>${reserva.date_event}</td>
            //                     <td><span class="badge badge-light">Estado</span></td>
            //                     <td>${getPlanName(reserva.id_name_plan)}</td>
            //                     <td>$ ${parseInt(reserva.value_plan) + parseInt(reserva.commission_plan)}</td>  
            //                     <td> 
            //                         <!-- <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href="detalles_reserva.php?id_evento=${reserva.id_event}"><i class="icon-eye"></i></a> -->
            //                         <!-- <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="confirmarBorrado(${reserva.id_event})"><i class="icon-trash"></i></a> -->
            //                         ${
            //                             reserva.status_event === 'reserved' && !reserva.status_payment ? 
            //                             `<a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="pagarReserva(${reserva.id_event})"><i class="icon-payment"></i></a>` : 
            //                             ''
            //                         }
            //                     </td>
            //                     <td>
            //                         <div class="material-switch">
            //                             <input id="sw${reserva.id_event}" name="someSwitchOption001${reserva.id_event}" type="checkbox" ${reserva.status_event == 'reserved' ? 'checked' : ''} onchange="cambiarEstadoReserva(${reserva.id_event}, this.checked)">
            //                             <label for="sw${reserva.id_event}" class="bg-primary"></label>
            //                         </div>
            //                     </td> 
            //                 `;
            //             });

            //             // Actualiza el paginador basado en respuesta.paginaActual y respuesta.totalPaginas
            //             actualizarPaginador(respuesta.paginaActual, respuesta.totalPaginas);
            //         })
            //         .catch(error => console.error('Error:', error));
            // }

            document.addEventListener('DOMContentLoaded', function() {
                // Asigna el valor de PHP a una variable de JavaScript
                var tipoUsuario = <?php echo $_SESSION["id_type_user"]; ?>;

                function cargarEventos(pagina = 1) {
                    fetch(`includes/obtener_reservas.php?pagina=${pagina}&type_user=${tipoUsuario}`)
                        .then(response => response.json())
                        .then(respuesta => {
                            let tabla = document.getElementById('recent-orders').getElementsByTagName('tbody')[0];
                            tabla.innerHTML = '';
                            respuesta.reservas.forEach(reserva => {
                                let fila = tabla.insertRow();
                                fila.innerHTML = `
                            <td><span class="icon-person_pin"></span></td>
                            <td>${reserva.id_event}</td>  
                            <td><a href="#" onclick="abrirModalReserva(${reserva.id_event})">${reserva.name_event}</a></td>
                            <td>${reserva.location} <br> ${reserva.name_region} / ${reserva.name_city} </td>
                            <td>${reserva.desc_event}</td>
                            <td>${reserva.date_event}</td>
                            <td>
                                ${
                                    reserva.status_payment === 'paid' ? 
                                    `<span class="badge badge-primary">Pagado</span>` :
                                    (
                                        reserva.status_event === 'reserved' ?
                                        `<span class="badge badge-success">Aceptado</span>` : 
                                        `<span class="badge badge-light">Pendiente</span>`
                                    )
                                }
                            </td>
                            <td>${getPlanName(reserva.id_name_plan)}</td>
                            <td>$ ${parseInt(reserva.value_plan) + parseInt(reserva.commission_plan)}</td>  
                            <td> 
                                ${
                                    reserva.status_event === 'reserved' && !reserva.status_payment && tipoUsuario == 2 ? 
                                    `<a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="pagarReserva(${reserva.id_event})"><i class="icon-payment"></i></a>` : 
                                    ''
                                }
                            </td>
                            <td>
                            
                            <!-- Botón para abrir modal -->
                                <a class="btn-fab btn-fab-sm btn-primary shadow text-white" onclick="abrirModalReserva(${reserva.id_event})" >
                                    <i class="icon-pencil"></i>
                                </a>
                            </td>
                            <td>
                            ${
                                    tipoUsuario == 1 || tipoUsuario == 4  ? 
                                    `<div class="material-switch">
                                        <input id="sw${reserva.id_event}" name="someSwitchOption001${reserva.id_event}" type="checkbox" ${reserva.status_event == 'reserved' ? 'checked' : ''} onchange="cambiarEstadoReserva(${reserva.id_event}, this.checked)">
                                        <label for="sw${reserva.id_event}" class="bg-primary"></label>
                                    </div>` : 
                                    ''
                                }
                            </td> 
                        `;
                            });

                            actualizarPaginador(respuesta.paginaActual, respuesta.totalPaginas);
                        })
                        .catch(error => console.error('Error:', error));
                }

                cargarEventos(); // llamar a cargarEventos para cargar inicialmente las reservas
            });

            // // Abre modal 
            // function abrirModalReserva(idReserva) {
            //     // Aquí puedes hacer una solicitud a un endpoint para obtener los detalles de la reserva
            //     fetch(`includes/obtener_detalle_reserva.php?id_reserva=${idReserva}`)
            //         .then(response => response.json())
            //         .then(detalleReserva => {
            //             document.getElementById('detalleReserva').textContent = `Nombre del evento: ${detalleReserva.name_event}, Descripción: ${detalleReserva.desc_event}, Fecha: ${detalleReserva.date_event}`;
            //             $('#modalDetallesReserva').modal('show');
            //         })
            //         .catch(error => {
            //             console.error('Error al cargar los detalles de la reserva:', error);
            //             document.getElementById('detalleReserva').textContent = 'Error al cargar los detalles de la reserva.';
            //             $('#modalDetallesReserva').modal('show');
            //         });
            // }

            // Abre modal con detalle de Evento
            function abrirModalReserva(idReserva) {
                // Aquí puedes hacer una solicitud a un endpoint para obtener los detalles de la reserva
                fetch(`includes/obtener_detalle_reserva.php?id_reserva=${idReserva}`)
                    .then(response => response.json())
                    .then(detalleReserva => {
                        // Ahora, además de establecer el texto del detalle, rellenamos el formulario
                        // Suponiendo que detalleReserva contenga todos los campos necesarios
                        document.getElementById('id_event').value = detalleReserva.id_event;
                        document.getElementById('id_user_sell').value = detalleReserva.id_user_sell;
                        document.getElementById('id_plan_key').value = detalleReserva.id_plan_key;
                        document.getElementById('id_plan').value = detalleReserva.id_plan;
                        document.getElementById('value_plan_event').value = detalleReserva.value_plan;
                        // Suponiendo que id_name_plan viene en la respuesta, ajusta según tu respuesta real
                        document.getElementById('id_name_plan').value = detalleReserva.id_name_plan;
                        document.getElementById('name_event').value = detalleReserva.name_event;
                        document.getElementById('location').value = detalleReserva.location;
                        // Para los selects, tendrías que asegurarte de que la opción correspondiente esté seleccionada
                        document.getElementById('id_region').value = detalleReserva.id_region;
                        document.getElementById('id_city').value = detalleReserva.id_city;
                        document.getElementById('date_event').value = detalleReserva.date_event;
                        document.getElementById('phone_event').value = detalleReserva.phone_event;
                        document.getElementById('desc_event').innerText = detalleReserva.desc_event;

                        // var regionActual = detalleReserva.id_region;
                        // cargarCiudades(regionActual);

                        $('#modalDetallesReserva').modal('show');
                    })
                    .catch(error => {
                        console.error('Error al cargar los detalles de la reserva:', error);
                        document.getElementById('detalleReserva').textContent = 'Error al cargar los detalles de la reserva.';
                        $('#modalDetallesReserva').modal('show');
                    });
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
                // Mostrar un diálogo de confirmación con SweetAlert
                swal({
                        title: "¿Estás seguro?",
                        text: "Estás a punto de cambiar el estado de la reservación.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willChange) => {
                        if (willChange) {
                            // Si el usuario confirma, procede con el cambio de estado
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
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1500);
                                    } else {
                                        swal("Error", "No se pudo actualizar el estado de la reservación.", "error");
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    swal("Error", "Error al procesar la solicitud.", "error");
                                });
                        } else {
                            // Si el usuario cancela, recarga la página para restaurar el estado original del switch
                            location.reload();
                        }
                    });
            }
        </script>

        <!-- Cambio de Región y Ciudad -->
        <!-- <script type="text/javascript">
            $(document).ready(function() {
                $('#id_region').on('change', function() {
                    var id_region = $(this).val();
                    cargarCiudades(id_region);
                });

                // Cargar ciudades al abrir el modal
                $('#modalDetallesReserva').on('show.bs.modal', function() {
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
 -->
        <!-- Cambia Ciudad y región -->
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

                // Si se necesita llamar a cargarCiudades desde otro lugar,   invocar cargarCiudades(id_region) donde sea necesario.
            });
        </script>

        <!-- Actualziar datos de reserva en particular -->
        <script>
            function guardarContratacionTarifa() {
                event.preventDefault(); // Previene el envío estándar del formulario

                var formData = new FormData(document.getElementById("contratarTarifa"));

                fetch('includes/modificar_detalles_reserva.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Mensaje de éxito con SweetAlert
                            Swal.fire({
                                title: '¡Éxito!',
                                text: 'Detalles de la reserva actualizados con éxito.',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#modalDetallesReserva').modal('hide');
                                }
                            });
                        } else {
                            // Mensaje de error con SweetAlert
                            Swal.fire({
                                title: 'Error',
                                text: 'Error al actualizar los detalles: ' + data.error,
                                icon: 'error',
                                confirmButtonText: 'Entendido'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error al actualizar los detalles de la reserva:', error);
                        // Mensaje de error con SweetAlert
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al actualizar los detalles de la reserva. Por favor, intente de nuevo.',
                            icon: 'error',
                            confirmButtonText: 'Entendido'
                        });
                    });
            }
        </script>

        <!-- date time picker para calendario en modal  -->
        <!-- flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



    </body>

    </html>
<?php
}//termina else de login