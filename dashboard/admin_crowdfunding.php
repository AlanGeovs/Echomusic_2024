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
        <title>Administador de Crowdfunding</title>
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
                    <div class="spinner-layer spinner-yellow-only">
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
                                <a class="nav-link" href="admin_eventos.php">
                                    <i class=" icon icon-date_range"></i>Eventos
                                </a>
                            </li>
                            <li>
                                <a class="nav-link active" href="admin_crowdfunding.php">
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
                                            <h4 class="card-title">Administración de Crowdfunding</h4>
                                        </div>
                                    </div>

                                    <div class="col-md-8 d-flex align-items-center justify-content-center">
                                        <div class="row mt-3">
                                            <div class="col-md-9 mb-0">
                                                <div class="form-group">
                                                    <input class="form-control form-control-lg" type="text" placeholder="Buscar eventos" id="filtro">
                                                </div>

                                            </div>
                                            <div class="col-md-3 mb-0 ">
                                                <button type="button" class="btn btn-primary mt-2" onclick="buscarProyectos()">
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
                                            <table id="recent-projects" class="table table-hover mb-0 ps-container ps-theme-default">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>ID Proyecto</th>
                                                        <th>Nombre de Proyecto / Artista / Ciudad / Región</th>
                                                        <th>Fechas</th>
                                                        <th>Montos</th>
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

        <!-- Modal para recompensas -->
        <div class="modal fade" id="modalRecompensas" tabindex="-1" role="dialog" aria-labelledby="modalRecompensasLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRecompensasLabel">Recompensas del Proyecto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="contenidoRecompensas">
                        <!-- Las recompensas se cargarán aquí -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
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

        <!-- Obtener y listar Proyectos  -->
        <script>
            function cargarProyectos(pagina = 1, filtro = '') {
                const url = `includes/obtener_proyectos_admin.php?pagina=${pagina}&filtro=${encodeURIComponent(filtro)}`;
                fetch(url)
                    .then(response => response.json())
                    .then(respuesta => { // Cambia `eventos` a `respuesta` para evitar confusiones
                        let tabla = document.getElementById('recent-projects').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpia la tabla antes de agregar los nuevos eventos
                        respuesta.proyectos.forEach(proyecto => {
                            // Formatear el monto a recaudar y el monto recaudado actual
                            let montoFormateado = new Intl.NumberFormat('de-DE').format(proyecto.project_amount);
                            let montoRecaudadoFormateado = new Intl.NumberFormat('de-DE').format(proyecto.current_funding);
                            // Calcular el porcentaje de financiación
                            let porcentajeFinanciacion = proyecto.project_amount > 0 ? ((proyecto.current_funding / proyecto.project_amount) * 100).toFixed(2) : 0;

                            let fila = tabla.insertRow();
                            fila.innerHTML = `
                    
                    <td>${proyecto.id_project}</td>  
                    <td>
                        ${proyecto.project_title ? `<span class="icon-playlist_add_check"></span> <a href="https://echomusic.net/crowdfunding.php?e=${proyecto.id_project}" target="_blank">${proyecto.project_title}</a>` : '' }                                              
                        <br><span class="icon-user"></span> ${proyecto.datos_artista.first_name_user} ${proyecto.datos_artista.last_name_user} ${proyecto.datos_artista.nick_user ? `(<a href="https://echomusic.net/artistas.php?a=${proyecto.id_user}" target="_blank">${proyecto.datos_artista.nick_user}</a>)` : ''}
                        <br><span class="icon-map-marker"></span> ${proyecto.name_region ? proyecto.name_region : ' - '}  
                    </td> 
                    <td> 
                        ${proyecto.project_date_execution ? `<span class="icon-calendar-check-o"></span> Ejecución: <b> ${proyecto.project_date_execution}</b>` : ''}
                    <br>${proyecto.project_date_creation ? `<span class="icon-date_range"></span> Creación: ${proyecto.project_date_creation}` : ''}
                    <br>${proyecto.project_date_start ? `<span class="icon-calendar-plus-o"></span> Inicio: ${proyecto.project_date_start}` : ''}
                    <br>${proyecto.project_date_end ? `<span class="icon-calendar-minus-o"></span> Término: ${proyecto.project_date_end}` : ''}
                    </td>
                    <td>
                           ${proyecto.project_amount ? `Recaudado: $ ${montoRecaudadoFormateado} (${porcentajeFinanciacion} %) <br>de <b>$ ${montoFormateado}</b>` : '' }
                    </td>
                    <td>${obtenerStatus(proyecto.status_project)}</td> 
                    <td>  
                        <!-- <a class="btn-fab btn-fab-sm btn-primary shadow text-white" ><i class="icon-pencil"></i></a> -->
                        <!-- Botón para abrir modal -->
                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white"  href="https://echomusic.net/dashboard/editar_proyecto.php?id_project=${proyecto.id_project}" target="_blank">
                            <i class="icon-pencil"></i></a>
                        <a class="btn-fab btn-fab-sm btn-warning shadow text-white"  href="https://echomusic.net/dashboard/ver_aportaciones_proyecto.php?id_project=${proyecto.id_project}" target="_blank">
                            <i class="icon-attach_money"></i></a>
                        <a class="btn-fab btn-fab-sm btn-success shadow text-white" onclick="abrirModalRecompensas(${proyecto.id_project})">
                        <i class="icon-gift"></i></a>
                        
                        <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="confirmarBorrado(${proyecto.id_project})">
                            <i class="icon-trash"></i></a>
                    </td>
                    <td>
                        <div class="material-switch">
                            <input id="sw${proyecto.id_project}" name="someSwitchOption001${proyecto.id_project}" type="checkbox" ${proyecto.status_project == 1 ? 'checked' : ''} onchange="cambiarEstadoProyecto(${proyecto.id_project}, this.checked)">
                            <label for="sw${proyecto.id_project}" class="bg-primary"></label>
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
                        return '<span class="badge badge-light">0 - Desactivado</span>';
                    case 1:
                        return '<span class="badge badge-success">1 - Activo</span>';
                    case 2:
                        return '<span class="badge badge-warning">2 - Pasado</span>';
                    case 3:
                        return '<span class="badge badge-warning">3 - Finalizado</span>';
                    case 4:
                        return '<span class="badge badge-warning">4 - Cancelado</span>';
                    case 5:
                        return '<span class="badge badge-warning">5 - Pasado</span>';
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
            function actualizarPaginador(paginaActual, totalPaginas, filtro = '') {
                let paginador = document.querySelector('.pagination');
                paginador.innerHTML = ''; // Limpia el paginador existente

                // Agrega "Anterior" si no es la primera página
                if (paginaActual > 1) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarProyectos(${paginaActual - 1}, '${filtro}')">Anterior</a></li>`;
                }

                // Siempre agrega la primera página
                paginador.innerHTML += `<li class="page-item ${paginaActual === 1 ? 'active' : ''}"><a class="page-link" href="#" onclick="cargarProyectos(1, '${filtro}')">1</a></li>`;

                // Agrega puntos suspensivos si es necesario
                if (paginaActual > 4) {
                    paginador.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }

                // Muestra hasta 3 páginas antes y después de la actual si es posible
                for (let i = Math.max(2, paginaActual - 3); i <= Math.min(paginaActual + 3, totalPaginas - 1); i++) {
                    paginador.innerHTML += `<li class="page-item ${i === paginaActual ? 'active' : ''}"><a class="page-link" href="#" onclick="cargarProyectos(${i}, '${filtro}')">${i}</a></li>`;
                }

                // Agrega puntos suspensivos hacia el final si es necesario
                if (paginaActual < totalPaginas - 3) {
                    paginador.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }

                // Siempre agrega la última página si hay más de una página
                if (totalPaginas > 1) {
                    paginador.innerHTML += `<li class="page-item ${paginaActual === totalPaginas ? 'active' : ''}"><a class="page-link" href="#" onclick="cargarProyectos(${totalPaginas}, '${filtro}')">${totalPaginas}</a></li>`;
                }

                // Agrega "Siguiente" si no es la última página
                if (paginaActual < totalPaginas) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarProyectos(${paginaActual + 1}, '${filtro}')">Siguiente</a></li>`;
                }
            }



            // Para llamar a la función al cargar la página:
            document.addEventListener('DOMContentLoaded', function() {
                cargarProyectos();
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
                                        const filtro = document.getElementById('filtro').value;
                                        cargarProyectos(1, filtro);
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


            // Cambiar estado de Evento con botón Material Switch
            function cambiarEstadoProyecto(idEvento, estado) {
                fetch('includes/cambiar_estado_proyecto.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_project: idEvento,
                            status_project: estado ? 1 : 0
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("Éxito", "El estado del evento ha sido actualizado.", "success");
                            // Recargar la tabla de eventos
                            const filtro = document.getElementById('filtro').value;
                            cargarProyectos(1, filtro);
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
            function buscarProyectos() {
                const filtro = document.getElementById('filtro').value;
                cargarProyectos(1, filtro); // Llama a cargarProyectos con el valor del filtro
            }


            // Event Listener para actualizar la imagen del modal:
            $('#modalImagenEvento').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Elemento que disparó el modal
                var imgSrc = button.data('img'); // Extrae la ruta de la imagen del data-img
                var modal = $(this);
                modal.find('.modal-body #imagenEnModal').attr('src', imgSrc); // Actualiza el src de la imagen en el modal
            });
        </script>

        <!-- Enlistar recompensas -->
        <script>
            function abrirModalRecompensas(idProject) {
                fetch(`includes/obtenerRecompensas.php?id=${idProject}`)
                    .then(response => response.json())
                    .then(recompensas => {
                        let contenido = '';

                        // Verifica si el array de recompensas está vacío
                        if (recompensas.length === 0) {
                            // Si no hay recompensas, muestra un mensaje indicándolo
                            contenido = '<p>No hay recompensas disponibles para este proyecto.</p>';
                        } else {
                            // Si hay recompensas, construye el contenido del modal con ellas
                            contenido += '<div class="box-body no-padding"><table class="table table-striped"><tbody>';
                            contenido += '<tr><th>#</th><th>Recompensa</th><th>Monto</th><th>Descripción</th><th>Recompensas</th></tr>';

                            recompensas.forEach((recompensa, index) => {
                                contenido += `
                            <tr>
                                <td>${index + 1}.</td>
                                <td>${recompensa.tier_title}</td>
                                <td>$${recompensa.tier_amount}</td>
                                <td>${recompensa.tier_desc}</td>
                                <td>
                                    ${recompensa.t_reward_01 ? `- ${recompensa.t_reward_01}<br>` : '' }
                                    ${recompensa.t_reward_02 ? `- ${recompensa.t_reward_02}<br>` : '' }
                                    ${recompensa.t_reward_03 ? `- ${recompensa.t_reward_03}<br>` : '' }
                                    ${recompensa.t_reward_04 ? `- ${recompensa.t_reward_04}` : '' }
                                </td> 
                            </tr>
                        `;
                            });

                            contenido += '</tbody></table></div>';
                        }

                        document.getElementById('contenidoRecompensas').innerHTML = contenido;
                        $('#modalRecompensas').modal('show');
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>



        <!-- Editar datos del usuario -->
        <script>
            $('#editarDatosUsuario').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var userId = button.data('userid'); // Extrae el ID del usuario del atributo data-*

                fetch(`includes/obtenerDatosUsuario.php?id=${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Rellena el formulario con los datos obtenidos
                        $('#id').val(data.id_user);
                        $('#id_type_user').val(data.id_type_user);
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

                        // Llama a la función para obtener los subgéneros después de definir generoActual y subgeneroActual
                        obtenerSubGeneros(generoActual, subgeneroActual);

                        // Verifica y selecciona el tipo de usuario en el select
                        $("#id_type_user option").each(function() {
                            if ($(this).val() == data.id_type_user) { // Asegúrate de que la comparación sea correcta
                                $(this).prop('selected', true);
                            }
                        });
                    });
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
                                    cargarProyectos(); // Recarga la lista de usuarios si tienes una función para esto
                                });
                        } else {
                            swal("Error", "No se pudieron actualizar los datos del usuario. " + data.error, "error");
                        }
                    })
                    .catch(error => console.error('Error:', error));
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
        </script>

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