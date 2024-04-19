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

    $idProjectActual = Consultas::proyectosEnCurso($id);
    // Determina si se debe deshabilitar o no el botón basado en la existencia de un proyecto en curso
    $disabled = isset($idProjectActual) ? '' : 'disabled';

    $proyecto = 0;
    if ($idProjectActual) {
        $proyecto = 1;
    }
    // Verifica multimadia
    $multimedia = Consultas::verificarDatosMultimedia($idProjectActual['id_project']);
    $recompensa = Consultas::verificarDatosRecompensa($idProjectActual['id_project']);
    $monto = Consultas::verificarMontoProyecto($idProjectActual['id_project']);

    $publicarProyecto = $proyecto + $multimedia + $recompensa + $monto;

    // Botón de publicar
    $btnClass = "btn btn-success btn-lg r-20";
    $btnDisabled = "";
    $btnIcon = "<i class='icon-check mr-2'></i>";

    // Si $publicarProyecto NO está listo para publicar
    if ($publicarProyecto < 4) {
        $btnClass = "btn btn-light btn-lg r-20"; // Cambiar la clase para cambiar el color a uno más claro
        $btnDisabled = "disabled"; // Agregar el atributo disabled al botón
        $btnIcon = "<i class='icon-remove  mr-2'></i>";
    }
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
                                <a class="nav-link active" href="crowdfunding.php">
                                    <i class="icon icon-home2"></i>Proyectos
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="crear_proyecto.php">
                                    <i class=" icon icon-edit"></i>Crear Proyecto
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </header>

            <!--Eventos-->
            <div class="container-fluid animatedParent animateOnce my-3">
                <div class="animated fadeInUpShort mb-3">

                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card no-b">


                                <div class="row justify-content-between mb-3 mt-15">
                                    <div class="col-md-4">
                                        <div class="card-header white b-0 p-3">
                                            <h4 class="card-title">Proyecto de crowdfunding</h4>
                                            <small class="card-subtitle mb-2 text-muted">Listado de proyectos.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-primary btn-xs r-20" href="crear_proyecto.php"><i class="icon-plus-circle mr-2"></i>Crear Proyecto</a>
                                    </div>
                                </div>



                                <!-- <div class="collapse show" id="invoiceCard">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table id="recent-projects" class="table table-hover mb-0 ps-container ps-theme-default">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>ID</th>
                                                        <th>Nombre</th>
                                                        <th>Región</th>
                                                        <th>Fecha de ejecución</th>
                                                        <th>Status</th>
                                                        <th>Monto a recaudar</th>
                                                        <th>Acciones</th>
                                                        <th>Activar</th>
                                                        <th>Duplicar</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 

                                                </tbody>
                                            </table>




                                        </div>
                                    </div>
                                </div> -->

                            </div>




                        </div>


                    </div>


                    <!-- Paginador -->
                    <!-- <nav class="my-3" aria-label="Page navigation">
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
                    </nav> -->

                </div>

                <!-- Card para mostrar poryectos de Crowdfunding -->
                <!-- <div class="container animated fadeInUpShort">
                    <div class="card mb-1 mx-auto w-75">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <!-- Contenedor para el video que mantiene la proporción 16:9 -->
                <!-- <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/OZtAiReH6zY" title="Video title" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div> -->
                <!-- </div>
                            <div class="col-md-6"> -->
                <!-- Contenido del card -->
                <!-- <div class="card-body">
                                    <h5 class="card-title">Fantasmas</h5>
                                    <p class="card-text">Video Clip</p>
                                    <a href="#" class="btn btn-primary">Ver más</a>
                                    <hr>
                                    <div class="progress mb-2">
                                        <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="100000" aria-valuemin="0" aria-valuemax="500000">$100.000</div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Total a recaudar <b>$500.000</b></span>
                                        <span class="text-muted">Quedan 90 días</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   -->

                <!-- Card para mostrar poryectos de Crowdfunding -->
                <div id="container-proyectos">
                    <!-- Aquí se cargarán las tarjetas de proyectos -->
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

        <!-- Obtener y listar proyectos  -->
        <script>
            // Cargar proyectos como listado
            // function cargarProyectos(pagina = 1) {
            //     fetch(`includes/obtener_proyectos.php?pagina=${pagina}`)
            //         .then(response => response.json())
            //         .then(respuesta => { // Cambia `proyectos` a `respuesta` para evitar confusiones
            //             let tabla = document.getElementById('recent-projects').getElementsByTagName('tbody')[0];
            //             tabla.innerHTML = ''; // Limpia la tabla antes de agregar los nuevos proyectos
            //             respuesta.proyectos.forEach(proyecto => { // Accede a `respuesta.proyectos` en lugar de `proyectos` directamente
            //                 let fila = tabla.insertRow();
            //                 fila.innerHTML = `
            //         <td><span class="icon-person_pin"></span></td>
            //         <td>${proyecto.id_project}</td>  
            //         <td><a href="https://echomusic.net/eventos.php?e=${proyecto.id_event}" target="_blank">${proyecto.project_title}</a></td>

            //         <td>Metropolitana</td>
            //         <td>${proyecto.project_date_execution}</td>
            //         <td><span class="badge badge-light">Estado</span></td>
            //         <td>$ ${proyecto.project_amount}</td>  
            //         <td> 
            //             <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href="editar_evento.php?id_evento=${proyecto.id_event}"><i class="icon-pencil"></i></a>
            //             <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="confirmarBorrado(${proyecto.id_event})"><i class="icon-trash"></i></a>
            //         </td>
            //         <td>
            //             <div class="material-switch">
            //                 <input id="sw${proyecto.id_event}" name="someSwitchOption001${proyecto.id_event}" type="checkbox" ${proyecto.active_event == 1 ? 'checked' : ''} onchange="cambiarEstadoEvento(${proyecto.id_event}, this.checked)">
            //                 <label for="sw${proyecto.id_event}" class="bg-primary"></label>
            //             </div>
            //         </td>
            //         <td>     
            //             <a class="btn-fab btn-fab-sm btn-primary shadow text-white" onclick="duplicarEvento(${proyecto.id_event});"><i class="icon-control_point_duplicate"></i></a>
            //         </td>
            //     `;
            //             });

            //             // Actualiza el paginador basado en respuesta.paginaActual y respuesta.totalPaginas
            //             actualizarPaginador(respuesta.paginaActual, respuesta.totalPaginas);
            //         })
            //         .catch(error => console.error('Error:', error));
            // }

            // Cargar Proyectos con formato de Card 
            function cargarProyectos(pagina = 1) {
                fetch(`includes/obtener_proyectos.php?pagina=${pagina}`)
                    .then(response => response.json())
                    .then(respuesta => {
                        let contenedor = document.getElementById('container-proyectos'); // Asegúrate de tener un contenedor con este ID
                        contenedor.innerHTML = ''; // Limpia el contenedor antes de agregar los nuevos proyectos
                        respuesta.proyectos.forEach(proyecto => {
                            // Divide la descripción en palabras y limita a las primeras 20 palabras
                            let palabrasDescripcion = proyecto.project_desc.split(" ").slice(0, 20).join(" ") + "...";
                            // Formatear el monto a recaudar y el monto recaudado actual
                            let montoFormateado = new Intl.NumberFormat('de-DE').format(proyecto.project_amount);
                            let montoRecaudadoFormateado = new Intl.NumberFormat('de-DE').format(proyecto.current_funding);
                            // Calcular el porcentaje de financiación
                            let porcentajeFinanciacion = proyecto.project_amount > 0 ? ((proyecto.current_funding / proyecto.project_amount) * 100).toFixed(2) : 0;

                            let card = `
                                <div class="card mb-1 mx-auto w-75">
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            ${proyecto.project_multimedia_name ? 
                                                `<div class="embed-responsive embed-responsive-16by9">${proyecto.project_multimedia_name}
                                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/${proyecto.project_multimedia_name}" title="${proyecto.project_title}" frameborder="0" allowfullscreen></iframe>
                                                </div>` : `<img src="https://echomusic.net/dashboard/images/crowdfunding/${proyecto.project_multimedia_name}">`
                                            }
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <h5 class="card-title">${proyecto.project_title}</h5>
                                                <p class="card-text">${palabrasDescripcion}</p> 

                                                ${!proyecto.status_project ? `<a href='crear_proyecto.php' type='button' class='btn btn-primary btn-xs'>Editar</a>
                                                    <button type="button" id="publicarProyecto" class="<?php echo $btnClass; ?>" <?php echo $btnDisabled; ?>>
                                            <?php echo $btnIcon; ?>Publicar proyecto
                                        </button>
                                                <hr>` : 
                                                `<a href="crear_proyecto.php?p=${proyecto.id_project}" type="button" class="btn btn-primary btn-xs">Editar</a>
                                                <hr>
                                                <span class="text-muted">Quedan ${proyecto.days_remaining} días</span>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar" role="progressbar" style="width: ${porcentajeFinanciacion}%;" aria-valuenow="${proyecto.current_funding}" aria-valuemin="0" aria-valuemax="${proyecto.project_amount}">${porcentajeFinanciacion}%</div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-muted"><b>$${montoRecaudadoFormateado}</b> de <b>$${montoFormateado}</b> del total recaudado.</span>
                                                    
                                                </div>`
                                            }
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            contenedor.innerHTML += card;
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
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarProyectos(${paginaActual - 1})">Anterior</a></li>`;
                }

                // Muestra hasta 2 páginas antes de la actual si es posible
                for (let i = Math.max(1, paginaActual - 2); i < paginaActual; i++) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarProyectos(${i})">${i}</a></li>`;
                }

                // Página actual
                paginador.innerHTML += `<li class="page-item active"><a class="page-link" href="#">${paginaActual}</a></li>`;

                // Muestra hasta 2 páginas después de la actual si es posible
                for (let i = paginaActual + 1; i <= Math.min(paginaActual + 2, totalPaginas); i++) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarProyectos(${i})">${i}</a></li>`;
                }

                // Si hay muchas páginas, muestra puntos suspensivos hacia el final
                if (paginaActual + 2 < totalPaginas) {
                    paginador.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarProyectos(${totalPaginas})">${totalPaginas}</a></li>`;
                }

                // Agrega "Siguiente" si no es la última página
                if (paginaActual < totalPaginas) {
                    paginador.innerHTML += `<li class="page-item"><a class="page-link" href="#" onclick="cargarProyectos(${paginaActual + 1})">Siguiente</a></li>`;
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
                                        cargarProyectos(); // Recargar los eventos
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
                                                cargarProyectos(); // Re-cargar los eventos
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

        <!-- Publicar Proyecto -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var projectId = <?php echo $idProjectActual['id_project']; ?>

                const botonPublicar = document.getElementById('publicarProyecto');
                botonPublicar.addEventListener('click', function() {
                    // const projectId = this.getAttribute('data-project-id'); // Asume que el botón tiene un atributo data-project-id con el ID del proyecto
                    fetch('includes/publicarProyecto.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `id_project=${projectId}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                swal("¡Éxito!", data.message, "success");
                                // Aquí puedes agregar acciones adicionales como redirigir a otra página o actualizar la UI
                            } else {
                                swal("Error", data.message, "error");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            swal("Error", "Error al procesar la solicitud.", "error");
                        });
                });
            });
        </script>



    </body>

    </html>
<?php
}//termina else de login