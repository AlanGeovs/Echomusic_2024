<?php
session_start();

require_once "model/model.php";

$id = $_SESSION["id_user"];

$tarifas = Consultas::obtenerTarifasPorUsuario($id);

if (!isset($_SESSION["id_user"])) {
    header("Location: index.php?error=2");
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
                                <a class="nav-link active" href="perfil-tarifas.php">
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


                        <!--Ver Tarifas 8 -->
                        <div class="col-md-8">
                            <div class="card mb-3 shadow no-b r-0">
                                <div class="card-header bg-white">
                                    <h6>Tarifas</h6>
                                </div>
                                <div class="card-body">

                                    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                                        <?php foreach ($tarifas as $tarifa) : ?>
                                            <div class="col">
                                                <div class="card mb-4 rounded-3 shadow-sm">
                                                    <div class="card-header py-3">
                                                        <h4 class="my-0 fw-normal">
                                                            <?php
                                                            switch ($tarifa['id_name_plan']) {
                                                                case 1:
                                                                    echo "Básico";
                                                                    break;
                                                                case 2:
                                                                    echo "Estándar";
                                                                    break;
                                                                case 3:
                                                                    echo "Profesional";
                                                                    break;
                                                                default:
                                                                    echo "No especificado";
                                                            }
                                                            ?>
                                                        </h4>
                                                    </div>

                                                    <div class="card-body">
                                                        <h1 class="card-title pricing-card-title">$<?= number_format(($tarifa['value_plan'] + $tarifa['commission_plan']), 2); ?><small class="text-body-secondary fw-light"></small></h1>
                                                        <ul class="list-unstyled mt-3 mb-4">
                                                            <li>Duración: <?= $tarifa['duration_hours']; ?> hrs <?= $tarifa['duration_minutes']; ?> min</li>
                                                            <li>Backline: <?= $tarifa['backline']; ?></li>
                                                            <li>Refuerzo Sonoro: <?= $tarifa['sound_reinforcement']; ?></li>
                                                            <li>Sonidista: <?= $tarifa['sound_engineer']; ?></li>
                                                            <li>Nº de Músicos: <?= $tarifa['artists_amount']; ?></li>
                                                            <li>Descripción: <?= $tarifa['desc_plan']; ?></li>
                                                            <!-- Agrega más detalles según tu base de datos -->
                                                        </ul>
                                                        <div class="d-flex justify-content-around">
                                                            <button type="button" class="btn btn-warning btn-lg" data-id-tarifa="<?= $tarifa['id_plan_key']; ?>">Borrar</button>

                                                            <button type="button" class="btn btn-primary btn-lg">Editar</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>


                                </div>

                            </div>

                            <!-- Card 2 -->
                            <!-- <div class="card mb-3 shadow no-b r-0">
                                <div class="card-header bg-white">
                                    <h6>Card 2</h6>
                                </div>
                                <div class="card-body"> 
                                </div>

                            </div> -->

                        </div>

                        <!--Crear Tarifa 4 -->
                        <div class="col-md-4">
                            <div class="row">
                                <!--Izq 4-->
                                <div class="col-lg-12">
                                    <div class="card mb-3 shadow no-b r-0">
                                        <div class="">
                                            <div class="float-right">
                                                <span class="icon-sound text-light-blue s-48"> </span>
                                            </div>
                                            <div class="card-header white">
                                                <h6>Crear nueva tarifa</h6>
                                            </div>

                                            <div class="card-body">

                                                <!-- Formulario crear tarifas -->
                                                <form id="formTarifas" method="post">
                                                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $id; ?>">

                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <label for="musician" class="form-label">Tipo de Plan</label>
                                                            <select class="form-control" name="id_name_plan" id="id_name_plan" required>
                                                                <option value="1">Básico</option>
                                                                <option value="2">Estándar</option>
                                                                <option value="3">Profesional</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <input type="text" class="form-control" name="value_plan" placeholder="Valor del plan" id="value_plan" maxlength="19" required>
                                                        </div>

                                                        <hr>

                                                        <div class="row">
                                                            <div class="col-4 text-left">
                                                                <label>Duración</label>
                                                            </div>
                                                            <div class="col-4 pr-0">
                                                                <select class="form-control" id="duration_hours" name="duration_hours" required>
                                                                    <option value="0" selected>0hr</option>
                                                                    <option value="1" selected>1 hr</option>
                                                                    <option value="2" selected>2 hr</option>
                                                                    <option value="3" selected>3 hr</option>
                                                                    <option value="4" selected>4 hr</option>
                                                                    <option value="5" selected>5 hr</option>
                                                                    <!-- Agrega más opciones según sea necesario -->
                                                                </select>
                                                            </div>
                                                            <div class="col-4 pl-1">
                                                                <select class="form-control" id="duration_minutes" name="duration_minutes" required>
                                                                    <option value="0" selected>0 min</option>
                                                                    <option value="15" selected>15 min</option>
                                                                    <option value="30" selected>30 min</option>
                                                                    <option value="45" selected>45 min</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-7 text-left">
                                                                <label>Backline</label>
                                                            </div>
                                                            <div class="col-5">
                                                                <select class="form-control" id="backline" name="backline" required>
                                                                    <option value="1">No</option>
                                                                    <option value="2">Sí</option>
                                                                    <option value="3">No aplica</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-7 text-left">
                                                                <label>Refuerzo Sonoro</label>
                                                            </div>
                                                            <div class="col-5">
                                                                <select class="form-control" id="sound_reinforcement" name="sound_reinforcement" required>
                                                                    <option value="1">No</option>
                                                                    <option value="2">Sí</option>
                                                                    <option value="3">No aplica</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-7 text-left">
                                                                <label>Sonidista</label>
                                                            </div>
                                                            <div class="col-5">
                                                                <select class="form-control" id="sound_engineer" name="sound_engineer" required>
                                                                    <option value="1">No</option>
                                                                    <option value="2">Sí</option>
                                                                    <option value="3">No aplica</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-7 text-left">
                                                                <label>Nº de Músicos</label>
                                                            </div>
                                                            <div class="col-5">
                                                                <input type="text" class="form-control" name="artists_amount" id="artists_amount" required>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <textarea class="form-control" name="desc_plan" id="desc_plan" rows="4" placeholder="Descripción del plan" required></textarea>
                                                            <div class="form-text">300 caracteres restantes</div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary btn-block mb-2" name="submit_plan_1">Guardar Plan</button>
                                                    </div>
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

        </div>

        <!-- Modales -->


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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- google chart api -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <!-- Script enviar formulario de reservas -->
        <script type="text/javascript">
            document.getElementById('formTarifas').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('commission_plan', parseFloat(formData.get('value_plan')) * 0.1 + parseFloat(formData.get('value_plan')));

                fetch('includes/enviar_tarifas.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("¡Éxito!", data.message, "success").then(() => {
                                // Limpia el formulario después de mostrar el mensaje de éxito 
                                // recargarTarifas(); // Recargar las tarifas
                                location.reload();
                                limpiarFormulario();
                            });
                        } else {
                            swal("Error", data.message, "error");
                        }
                    })
                    .catch(error => swal("Error", "No se pudo procesar la solicitud.", "error"));
            });

            function limpiarFormulario() {
                document.getElementById('formTarifas').reset();
            }
        </script>

        <!-- borrar tarifa -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const botonesBorrar = document.querySelectorAll('.btn-warning');

                botonesBorrar.forEach(boton => {
                    boton.addEventListener('click', function() {
                        const planId = this.getAttribute('data-id-tarifa'); // Cambiado aquí
                        swal({
                                title: "¿Estás seguro?",
                                text: "Una vez borrado, no podrás recuperar este plan!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    // Llamada AJAX para borrar el plan
                                    fetch('includes/borrar_tarifa.php', {
                                            method: 'POST',
                                            body: JSON.stringify({
                                                id: planId
                                            }), // Asegúrate de que `planId` tiene el valor correcto
                                            headers: {
                                                'Content-Type': 'application/json'
                                            }
                                        }).then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                swal("¡El plan ha sido borrado!", {
                                                    icon: "success",
                                                });
                                                // Recargar la lista o eliminar el elemento del DOM
                                                recargarTarifas(); // Recargar las tarifas

                                                boton.closest('.col').remove(); // Asumiendo que '.col' es el contenedor de la tarifa
                                            } else {
                                                swal("Error", data.message, "error");
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));
                                }
                            });
                    });
                });
            });
        </script>

        <!-- recargar tarifas -->
        <script>
            function recargarTarifas() {
                fetch('includes/obtener_tarifas.php') // Ajusta esta ruta
                    .then(response => response.json())
                    .then(tarifas => {
                        let contenidoTarifas = '';
                        tarifas.forEach(tarifa => {
                            // Construye el HTML para cada tarifa, esto es solo un ejemplo
                            contenidoTarifas += `
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <!-- Contenido de la tarjeta -->
                        <button type="button" class="btn btn-warning btn-lg" data-id-tarifa="${tarifa.id_plan_key}">Borrar</button>
                        <button type="button" class="btn btn-primary btn-lg">Editar</button>
                    </div>
                </div>
            `;
                        });
                        document.querySelector('.row.row-cols-1.row-cols-md-3.mb-3.text-center').innerHTML = contenidoTarifas;
                        agregarEventosBotones(); // Asegúrate de volver a agregar los eventos a los botones de borrar/editar
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Asegúrate de llamar esta función para agregar eventos a los botones después de recargar las tarifas
            function agregarEventosBotones() {
                // Agregar eventos a los botones de borrar y editar aquí
            }
        </script>


    </body>

    </html>
<?php
}//termina else de login