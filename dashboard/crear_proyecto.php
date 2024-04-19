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

    //Función para verificar que el usuario actual tiene proyectos pendientes 
    // Llamada a la función

    if (isset($_GET['p'])) {
        $idProjectGET = $_GET['p'];
        $editar = 1;
        echo "EDITAR";
        $idProjectActual = Consultas::proyectosEnCursoEditar($id, $idProjectGET);
    } else {
        $editar = 0;
        echo "NOO EDITAR";
        $idProjectActual = Consultas::proyectosEnCurso($id);
    }

    // $idProjectActual = Consultas::proyectosEnCurso($id);
    // Determina si se debe deshabilitar o no el botón basado en la existencia de un proyecto en curso
    $disabled = isset($idProjectActual) ? '' : 'disabled';

    $proyecto = 0;
    if (isset($idProjectActual['id_project'])) {
        $proyecto = 1;
    }
    // Verifica multimedia

    // echo "Proyecto id: " . $idProjectActual['id_project'];
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

        <!-- Hoja de estilos de Cropper -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

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
                                <a class="nav-link" href="crowdfunding.php">
                                    <i class="icon icon-home2"></i>Proyectos
                                </a>
                            </li>
                            <li>
                                <a class="nav-link active" href="crear_proyecto.php">
                                    <i class=" icon icon-edit"></i>Crear Proyecto
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </header>

            <!--Proyectos-->
            <div class="container-fluid animatedParent animateOnce my-3">
                <div class="animated fadeInUpShort mb-3">

                    <div class="row justify-content-center">
                        <!-- <div class="col-md-4">
                            <div class="counter-box white r-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-note-list text-light-blue s-48"></span>

                                    </div>
                                    <div class="counter-title ">Crear nuevo proyecto</div>
                                    <h5 class="sc-counter mt-3 counter-animated">1,228</h5>
                                </div>

                            </div>
                        </div> -->

                        <div class="col-md-8">
                            <div class="counter-box white r-3">
                                <div class="p-4">
                                    <div class="float-left">
                                        <span class="icon icon-note-list text-light-blue s-48"></span>
                                    </div>
                                    <div class="float-right ml-3">
                                        <!-- <button type="button" class="btn btn-success btn-lg r-20"><i class="icon-note-checked2 mr-2"></i>Publicar proyecto</button> -->
                                        <button type="button" id="publicarProyecto" class="<?php echo $btnClass; ?>" <?php echo $btnDisabled; ?>>
                                            <?php echo $btnIcon; ?>Publicar proyecto
                                        </button>
                                    </div>
                                    <div class="counter-title">Nuevo proyecto de Crowdfunding</div>
                                    <h5 class=" "><?php echo $publicarProyecto * 25; ?>% de avance</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $publicarProyecto * 25; ?>%;" aria-valuenow="<?php echo $publicarProyecto * 25; ?>" aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


                <!-- Card para mostrar poryectos de Crowdfunding -->
                <div id="container-proyectos">
                    <!-- Aquí se cargarán las tarjetas de proyectos -->
                    <div class="row justify-content-center mb-3 mt-15">
                        <div class="col-12 col-xl-8">
                            <div class="card no-b">
                                <div class="card-header white pb-0">
                                    <div class="d-flex justify-content-between">
                                        <div class="align-self-center">
                                            <ul class="nav nav-pills mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link r-20 active show" id="w3--tab1" data-toggle="tab" href="#w3-tab1" role="tab" aria-controls="tab1" aria-expanded="true" aria-selected="true">
                                                        <?php if (!empty($idProjectActual['project_title'])) {
                                                            echo "<span class='icon-check_circle'></span>";
                                                        } else {
                                                            echo "<span class='icon-remove_circle'></span>";
                                                        }
                                                        ?>
                                                        Datos proyecto</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link r-20" id="w3--tab2" data-toggle="tab" href="#w3-tab2" role="tab" aria-controls="tab2" aria-selected="false">
                                                        <?php if ($monto == 1) {
                                                            echo "<span class='icon-check_circle'></span>";
                                                        } else {
                                                            echo "<span class='icon-remove_circle'></span>";
                                                        }
                                                        ?>
                                                        Montos y plazos</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link r-20" id="w3--tab3" data-toggle="tab" href="#w3-tab3" role="tab" aria-controls="tab3" aria-selected="false">
                                                        <?php if ($recompensa == 1) {
                                                            echo "<span class='icon-check_circle'></span>";
                                                        } else {
                                                            echo "<span class='icon-remove_circle'></span>";
                                                        }
                                                        ?>
                                                        Recompensas</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link r-20" id="w3--tab4" data-toggle="tab" href="#w3-tab4" role="tab" aria-controls="tab4" aria-selected="false">
                                                        <?php if ($multimedia == 1) {
                                                            echo "<span class='icon-check_circle'></span>";
                                                        } else {
                                                            echo "<span class='icon-remove_circle'></span>";
                                                        }
                                                        ?>
                                                        Multimedia</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="align-self-center">
                                            <?php
                                            if ($publicarProyecto != 4) {
                                                echo "<p>Completa la información pendiente.</p>";
                                            } else {
                                                echo "<p>¡Información completa!.</p>";
                                            }
                                            ?>

                                        </div>

                                    </div>
                                </div>
                                <div class="card-body no-p">
                                    <div class="tab-content">
                                        <div class="tab-pane fade text-center active show p-1" id="w3-tab1" role="tabpanel" aria-labelledby="w3-tab1">
                                            <div class="card-body">
                                                <!-- Tab 1 - Crear Proyecto -->
                                                <?php
                                                if (!empty($idProjectActual['project_title'])) {

                                                    // Obtiene datos del proyecto  Multimadia y descripcion 
                                                    $datosProyectos = Consultas::obtenerProyectosPorId($idProjectActual['id_project']);

                                                ?>
                                                    <!-- Form para EDITAR PROYECTO -->
                                                    <form id="formEditarProyecto" method="post">
                                                        <div class="form-row">

                                                            <div class="col-md-12 mb-3">
                                                                <input type="hidden" id="edit_id_user" name="edit_id_user" value="<?php echo $datosProyectos['id_user']; ?>">
                                                                <input type="hidden" id="edit_id_project" name="edit_id_project" value="<?php echo $datosProyectos['id_project']; ?>">
                                                                <label for="edit_prTitle_Input" class="form-label fw-bold">Nombre del proyecto</label>
                                                                <input type="text" value="<?php echo $datosProyectos['project_title']; ?>" name="edit_project_title" class="form-control" id="edit_project_title" placeholder="ej: Nuevo videoclip" required>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="edit_prCategory_Input" class="form-label fw-bold">Categoría del proyecto </label>
                                                                <select id="edit_id_category" name="edit_id_category" class="form-control" required>

                                                                    <option value="1" value="<?php echo ($datosProyectos['id_category'] == "1" ? 'selected' : ''); ?>">Single</option>
                                                                    <option value="2" value="<?php echo ($datosProyectos['id_category'] == "2" ? 'selected' : ''); ?>">EP</option>
                                                                    <option value="3" value="<?php echo ($datosProyectos['id_category'] == "3" ? 'selected' : ''); ?>">Albúm</option>
                                                                    <option value="4" value="<?php echo ($datosProyectos['id_category'] == "4" ? 'selected' : ''); ?>">Videoclip</option>
                                                                    <option value="5" value="<?php echo ($datosProyectos['id_category'] == "5" ? 'selected' : ''); ?>">Show</option>
                                                                    <option value="6" value="<?php echo ($datosProyectos['id_category'] == "6" ? 'selected' : ''); ?>">Gira de medios regional</option>
                                                                    <option value="7" value="<?php echo ($datosProyectos['id_category'] == "7" ? 'selected' : ''); ?>">Gira de show regional</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="edit_prRegion_Input" class="form-label fw-bold">Región del proyecto (Solo si es presencial)</label>
                                                                <select id="edit_project_region" name="edit_project_region" class="form-control" required>
                                                                    <option value="0" <?php echo ($datosProyectos['project_region'] == "0" ? 'selected' : ''); ?>>No aplica</option>
                                                                    <option value="1" <?php echo ($datosProyectos['project_region'] == "1" ? 'selected' : ''); ?>>Arica y Parinacota</option>
                                                                    <option value="2" <?php echo ($datosProyectos['project_region'] == "2" ? 'selected' : ''); ?>>Tarapacá</option>
                                                                    <option value="3" <?php echo ($datosProyectos['project_region'] == "3" ? 'selected' : ''); ?>>Antofagasta</option>
                                                                    <option value="4" <?php echo ($datosProyectos['project_region'] == "4" ? 'selected' : ''); ?>>Atacama</option>
                                                                    <option value="5" <?php echo ($datosProyectos['project_region'] == "5" ? 'selected' : ''); ?>>Coquimbo</option>
                                                                    <option value="6" <?php echo ($datosProyectos['project_region'] == "6" ? 'selected' : ''); ?>>Valparaíso</option>
                                                                    <option value="7" <?php echo ($datosProyectos['project_region'] == "7" ? 'selected' : ''); ?>>Metropolitana</option>
                                                                    <option value="8" <?php echo ($datosProyectos['project_region'] == "8" ? 'selected' : ''); ?>>Libertador Gral. Bernando O'higgins</option>
                                                                    <option value="9" <?php echo ($datosProyectos['project_region'] == "9" ? 'selected' : ''); ?>>Maule</option>
                                                                    <option value="10" <?php echo ($datosProyectos['project_region'] == "10" ? 'selected' : ''); ?>>Ñuble</option>
                                                                    <option value="11" <?php echo ($datosProyectos['project_region'] == "11" ? 'selected' : ''); ?>>Bío Bío</option>
                                                                    <option value="12" <?php echo ($datosProyectos['project_region'] == "12" ? 'selected' : ''); ?>>La Araucanía</option>
                                                                    <option value="13" <?php echo ($datosProyectos['project_region'] == "13" ? 'selected' : ''); ?>>Los Ríos</option>
                                                                    <option value="14" <?php echo ($datosProyectos['project_region'] == "14" ? 'selected' : ''); ?>>Los Lagos</option>
                                                                    <option value="15" <?php echo ($datosProyectos['project_region'] == "15" ? 'selected' : ''); ?>>Aysén</option>
                                                                    <option value="16" <?php echo ($datosProyectos['project_region'] == "16" ? 'selected' : ''); ?>>Magallanes</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-12 mb-3">
                                                                <label for="edit_prDescription_Input" class="form-label fw-bold">Descripción del proyecto</label>
                                                                <textarea class="form-control" name="edit_project_desc" id="edit_project_desc" placeholder="Mínimo 50 caracteres - La descripción es muy importante para explicar tu proyecto a los usuarios" rows="6" maxlength="500" required><?php echo $datosProyectos['project_desc']; ?></textarea>
                                                                <div class="form-text" id="edit_caracteresRestantes">500 caracteres restantes</div>
                                                            </div>

                                                            <div class="d-flex justify-content-center gap-2">
                                                                <button id="editProjectSubmit" name="" class="btn btn-primary">
                                                                    <i class="icon-plus-circle"></i> Editar Proyecto</button>
                                                                &nbsp;
                                                                <input type="reset" class="btn btn-secondary" value="Limpiar campos">
                                                            </div>
                                                        </div>
                                                    </form>

                                                <?php
                                                } else {
                                                ?>
                                                    <!-- Form para CREAR PROYECTO -->
                                                    <form id="formCrearProyecto" method="post">
                                                        <div class="form-row">

                                                            <div class="col-md-12 mb-3">
                                                                <input type="hidden" id="id_user" name="id_user" value="<?php echo $id; ?>">
                                                                <label for="prTitle_Input" class="form-label fw-bold">Nombre del proyecto</label>
                                                                <input type="text" value="" name="project_title" class="form-control" id="project_title" placeholder="ej: Nuevo videoclip" required>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="prCategory_Input" class="form-label fw-bold">Categoría del proyecto</label>
                                                                <select id="id_category" name="id_category" class="form-control" required>
                                                                    <option value="" disabled selected>Categoría</option>
                                                                    <option value="1">Single</option>
                                                                    <option value="2">EP</option>
                                                                    <option value="3">Albúm</option>
                                                                    <option value="4">Videoclip</option>
                                                                    <option value="5">Show</option>
                                                                    <option value="6">Gira de medios regional</option>
                                                                    <option value="7">Gira de show regional</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="prRegion_Input" class="form-label fw-bold">Región del proyecto (Solo si es presencial)</label>
                                                                <select id="project_region" name="project_region" class="form-control" required>
                                                                    <option value="1">Arica y Parinacota</option>
                                                                    <option value="2">Tarapacá</option>
                                                                    <option value="3">Antofagasta</option>
                                                                    <option value="4">Atacama</option>
                                                                    <option value="5">Coquimbo</option>
                                                                    <option value="6">Valparaíso</option>
                                                                    <option value="7">Metropolitana</option>
                                                                    <option value="8">Libertador Gral. Bernando O'higgins</option>
                                                                    <option value="9">Maule</option>
                                                                    <option value="10">Ñuble</option>
                                                                    <option value="11">Bío Bío</option>
                                                                    <option value="12">La Araucanía</option>
                                                                    <option value="13">Los Ríos</option>
                                                                    <option value="14">Los Lagos</option>
                                                                    <option value="15">Aysén</option>
                                                                    <option value="16">Magallanes</option>
                                                                </select>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-12 mb-3">
                                                                <label for="prDescription_Input" class="form-label fw-bold">Descripción del proyecto</label>
                                                                <textarea class="form-control" name="project_desc" id="project_desc" placeholder="Mínimo 50 caracteres - La descripción es muy importante para explicar tu proyecto a los usuarios" rows="6" maxlength="500" required></textarea>
                                                                <div class="form-text" id="caracteresRestantes">500 caracteres restantes</div>
                                                            </div>


                                                            <div class="d-flex justify-content-center gap-2">
                                                                <button id="projectEditMain_submit" name="" class="btn btn-primary">
                                                                    <i class="icon-plus-circle"></i> Crear Proyecto</button>
                                                                &nbsp;
                                                                <input type="reset" class="btn btn-secondary" value="Limpiar campos">
                                                            </div>
                                                        </div>
                                                    </form>

                                                <?php
                                                }
                                                //fin del else
                                                ?>
                                            </div>
                                        </div>

                                        <!-- Tab 2 - Crear Montos y Plazos -->
                                        <div class="tab-pane fade text-center p-1" id="w3-tab2" role="tabpanel" aria-labelledby="w3-tab2">
                                            <div class="card-body">
                                                <?php
                                                if ($monto == 1) {

                                                    // Obtiene datos del proyecto  Multimadia y descripcion                                                     
                                                    $montosyPlazos = Consultas::obtenerMontosPorId($idProjectActual['id_project']);

                                                ?>
                                                    <!-- Form EDITAR Montos   -->
                                                    <form id="formEditarMontosYPlazos" method="post">
                                                        <div class="form-row">

                                                            <div class="col-md-6 mb-3">
                                                                <input type="hidden" id="edit_id_user" name="edit_id_user" value="<?php echo $id; ?>">
                                                                <input type="hidden" id="edit_id_project" name="edit_id_project" value="<?php echo $idProjectActual['id_project']; ?>">
                                                                <input type="hidden" id="edit_project_date_creation" name="edit_project_date_creation" value="<?php echo $idProjectActual['project_date_creation']; ?>">

                                                                <label for="edit_project_amount" class="form-label fw-bold">Monto a financiar (Pesos chilenos)</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroupPrepend3">$</span>
                                                                    </div>
                                                                    <input type="text" name="edit_project_amount" class="form-control" id="edit_project_amount" value="<?php echo $montosyPlazos['project_amount']; ?>" maxlength=" 20" required <?php echo $disabled; ?>>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="edit_project_comision" class="form-label fw-bold">Costo servicio de recaudación (8% +IVA)</label>
                                                                <h4 class="text-center" id="edit_comisionProyecto">$95.200</h4>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="edit_rec_time" class="form-label fw-bold">Plazo de recaudación.</label>
                                                                <!-- <button class="btn btn-success btn-lg toast-action" data-title="Plazo de recaudación" data-message="Plazo que tendrán tus patrocinadores para aportar fondos a tu proyecto." data-type="success" data-position-class="toast-bottom-left">
                                                                    <i class="icon-heart-o"></i></button> -->

                                                                <select id="edit_rec_time" name="edit_rec_time" class="form-control" required <?php echo $disabled; ?>>
                                                                    <option value="30" <?php echo ($montosyPlazos['rec_time'] == "30" ? 'selected' : ''); ?>>30 días</option>
                                                                    <option value="45" <?php echo ($montosyPlazos['rec_time'] == "45" ? 'selected' : ''); ?>>45 días</option>
                                                                    <option value="60" <?php echo ($montosyPlazos['rec_time'] == "60" ? 'selected' : ''); ?>>60 días</option>
                                                                </select>

                                                                <div role="alert" class="alert alert-success"><small>Plazo que tendrán tus patrocinadores para aportar fondos a tu proyecto.</small>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="edit_exec_time" class="form-label fw-bold">Plazo de ejecución </label>

                                                                <select id="edit_exec_time" name="edit_exec_time" class="form-control" required <?php echo $disabled; ?>>
                                                                    <option value="1" <?php echo ($montosyPlazos['exec_time'] == "1" ? 'selected' : ''); ?>>1 mes</option>
                                                                    <option value="2" <?php echo ($montosyPlazos['exec_time'] == "2" ? 'selected' : ''); ?>>2 meses</option>
                                                                    <option value="3" <?php echo ($montosyPlazos['exec_time'] == "3" ? 'selected' : ''); ?>>3 meses</option>
                                                                    <option value="4" <?php echo ($montosyPlazos['exec_time'] == "4" ? 'selected' : ''); ?>>4 meses</option>
                                                                    <option value="5" <?php echo ($montosyPlazos['exec_time'] == "5" ? 'selected' : ''); ?>>5 meses</option>
                                                                    <option value="6" <?php echo ($montosyPlazos['exec_time'] == "6" ? 'selected' : ''); ?>>6 meses</option>
                                                                    <option value="7" <?php echo ($montosyPlazos['exec_time'] == "7" ? 'selected' : ''); ?>>7 meses</option>
                                                                    <option value="8" <?php echo ($montosyPlazos['exec_time'] == "8" ? 'selected' : ''); ?>>8 meses</option>
                                                                    <option value="9" <?php echo ($montosyPlazos['exec_time'] == "9" ? 'selected' : ''); ?>>9 meses</option>
                                                                </select>

                                                                <div role="alert" class="alert alert-success"><small>Plazo que tendrás como artista para ejecutar el proceso del proyecto y posterior entrega de recompensas.</small>
                                                                </div>
                                                            </div>


                                                            <div class="d-flex justify-content-center gap-2">
                                                                <button id="edit_formMontosBoton" name="" class="btn btn-primary" <?php echo $disabled; ?>>
                                                                    <i class="icon-plus-circle"></i> Editar montos y plazos al proyecto
                                                                </button>

                                                                &nbsp;
                                                                <input type="reset" class="btn btn-secondary" value="Limpiar campos">
                                                            </div>
                                                        </div>
                                                    </form>
                                                <?php
                                                } else {
                                                ?>
                                                    <!-- Form CREAR Montos   -->
                                                    <form id="formCrearMontosYPlazos" method="post">
                                                        <div class="form-row">

                                                            <div class="col-md-6 mb-3">
                                                                <input type="hidden" id="id_user" name="id_user" value="<?php echo $id; ?>">
                                                                <input type="hidden" id="id_project" name="id_project" value="<?php echo $idProjectActual['id_project']; ?>">
                                                                <input type="hidden" id="project_date_creation" name="project_date_creation" value="<?php echo $idProjectActual['project_date_creation']; ?>">

                                                                <label for="project_amount" class="form-label fw-bold">Monto a financiar (Pesos chilenos)</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroupPrepend3">$</span>
                                                                    </div>
                                                                    <input type="text" name="project_amount" class="form-control" id="project_amount" placeholder="1.000.000" maxlength="20" required <?php echo $disabled; ?>>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="project_comision" class="form-label fw-bold">Costo servicio de recaudación (8% +IVA)</label>
                                                                <h4 class="text-center" id="comisionProyecto">$95.200</h4>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="prCategory_Input" class="form-label fw-bold">Plazo de recaudación.</label>
                                                                <!-- <button class="btn btn-success btn-lg toast-action" data-title="Plazo de recaudación" data-message="Plazo que tendrán tus patrocinadores para aportar fondos a tu proyecto." data-type="success" data-position-class="toast-bottom-left">
                                                                    <i class="icon-heart-o"></i></button> -->

                                                                <select id="duration" name="duration" class="form-control" required <?php echo $disabled; ?>>
                                                                    <option value="30">30 días</option>
                                                                    <option value="45">45 días</option>
                                                                    <option value="60">60 días</option>
                                                                </select>

                                                                <div role="alert" class="alert alert-success"><small>Plazo que tendrán tus patrocinadores para aportar fondos a tu proyecto.</small>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="inputEventDay" class="form-label fw-bold">Plazo de ejecución </label>

                                                                <select id="project_date_execution" name="project_date_execution" class="form-control" required <?php echo $disabled; ?>>
                                                                    <option value="1">1 mes</option>
                                                                    <option value="2">2 meses</option>
                                                                    <option value="3">3 meses</option>
                                                                    <option value="4">4 meses</option>
                                                                    <option value="5">5 meses</option>
                                                                    <option value="6">6 meses</option>
                                                                    <option value="7">7 meses</option>
                                                                    <option value="8">8 meses</option>
                                                                    <option value="9">9 meses</option>
                                                                </select>

                                                                <div role="alert" class="alert alert-success"><small>Plazo que tendrás como artista para ejecutar el proceso del proyecto y posterior entrega de recompensas.</small>
                                                                </div>
                                                            </div>


                                                            <div class="d-flex justify-content-center gap-2">
                                                                <button id="formMontosBoton" name="" class="btn btn-primary" <?php echo $disabled; ?>>
                                                                    <i class="icon-plus-circle"></i> Agregar montos y plazos al proyecto
                                                                </button>

                                                                &nbsp;
                                                                <input type="reset" class="btn btn-secondary" value="Limpiar campos">
                                                            </div>
                                                        </div>
                                                    </form>

                                                <?php
                                                }
                                                //fin del else
                                                ?>
                                            </div>
                                        </div>

                                        <!-- Tab 3 - Crear Recompensas -->
                                        <div class="tab-pane fade text-center p-1" id="w3-tab3" role="tabpanel" aria-labelledby="w3-tab3">
                                            <div class="card no-b">
                                                <div class="card-body">
                                                    <?php
                                                    if ($recompensa == 1) {

                                                        // Obtiene datos del proyecto  Multimadia y descripcion                                                     
                                                        $recompensasVal = Consultas::obtenerRecompensasPorId($idProjectActual['id_project']);

                                                    ?>


                                                        <!-- Form EDITAR Recompensas   -->
                                                        <form id="editformRecompensas" method="post">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <div class="nav flex-column nav-pills" id="v-pills-tab22" role="tablist" aria-orientation="vertical">
                                                                        <?php for ($i = 0; $i < 5; $i++) : ?>
                                                                            <a class="nav-link r-20 <?php echo $i == 0 ? 'active show' : ''; ?>" id="v-pills-edit-recompensa<?php echo $i + 1; ?>-tab" data-toggle="pill" href="#v-pills-edit-recompensa<?php echo $i + 1; ?>" role="tab" aria-controls="v-pills-edit-recompensa<?php echo $i + 1; ?>" aria-selected="<?php echo $i == 0 ? 'true' : 'false'; ?>">Recompensa <?php echo $i + 1; ?></a>
                                                                        <?php endfor; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="tab-content" id="v-pills-tabContent3">
                                                                        <?php for ($i = 0; $i < 5; $i++) : ?>
                                                                            <div class="tab-pane fade <?php echo $i == 0 ? 'active show' : ''; ?>" id="v-pills-edit-recompensa<?php echo $i + 1; ?>" role="tabpanel" aria-labelledby="v-pills-edit-recompensa<?php echo $i + 1; ?>-tab">
                                                                                <div class="form-row">
                                                                                    <?php if ($i == 0) : ?>
                                                                                        <input type="hidden" id="edit_id_project" name="edit_id_project" value="<?php echo $idProjectActual['id_project']; ?>">
                                                                                    <?php endif; ?>

                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="edit_r<?php echo $i + 1; ?>_tier_title" class="form-label fw-bold">Nombre recompensa</label>
                                                                                        <input type="text" name="edit_r<?php echo $i + 1; ?>_tier_title" class="form-control" id="edit_r<?php echo $i + 1; ?>_tier_title" value="<?php echo $recompensasVal[$i]['tier_title']; ?>">
                                                                                    </div>

                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="edit_r<?php echo $i + 1; ?>_tier_amount" class="form-label fw-bold">Monto de apoyo</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-prepend">
                                                                                                <span class="input-group-text" id="inputGroupPrepend">$</span>
                                                                                            </div>
                                                                                            <input type="text" name="edit_r<?php echo $i + 1; ?>_tier_amount" class="form-control" id="edit_r<?php echo $i + 1; ?>_tier_amount" value="<?php echo $recompensasVal[$i]['tier_amount']; ?>">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12 mb-0">
                                                                                        <label for="edit_r<?php echo $i + 1; ?>_t_reward" class="form-label fw-bold">Recompensas específicas</label>
                                                                                        <input type="text" id="edit_r<?php echo $i + 1; ?>_t_reward" name="edit_r<?php echo $i + 1; ?>_t_reward" class="tags-input" value="<?php echo isset($recompensasVal[$i]['t_reward_01']) ? implode(', ', array_filter([$recompensasVal[$i]['t_reward_01'], $recompensasVal[$i]['t_reward_02'],  $recompensasVal[$i]['t_reward_03'],  $recompensasVal[$i]['t_reward_04'], $recompensasVal[$i]['t_reward_05']])) : ''; ?>" data-options='{ "tagClass":  "badge badge-danger" }'>
                                                                                    </div>

                                                                                    <div class="col-md-12 mb-3">
                                                                                        <label for="edit_r<?php echo $i + 1; ?>_project_desc" class="form-label fw-bold">Descripción</label>
                                                                                        <textarea class="form-control" name="edit_r<?php echo $i + 1; ?>_project_desc" id="edit_r<?php echo $i + 1; ?>_project_desc" rows="6" maxlength="500"><?php echo $recompensasVal[$i]['tier_desc']; ?></textarea>
                                                                                        <div class="form-text" id="edit_caracteresRestantes<?php echo $i + 1; ?>">300 caracteres restantes</div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        <?php endfor; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <button id="editarRecompensasBtn" class="btn btn-primary">
                                                                    <i class="icon-plus-circle"></i> Editar recompensas
                                                                </button>
                                                                <input type="reset" class="btn btn-secondary" value="Limpiar campos">
                                                            </div>
                                                        </form>


                                                    <?php
                                                    } else {
                                                        echo "Crear";
                                                    ?>
                                                        <!-- Form CREAR Recompensas   -->
                                                        <form id="formRecompensas" method="post">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <div class="nav flex-column nav-pills" id="v-pills-tab22" role="tablist" aria-orientation="vertical">
                                                                        <a class="nav-link r-20 active show" id="v-pills-recompensa1-tab2" data-toggle="pill" href="#v-pills-recompensa12" role="tab" aria-controls="v-pills-recompensa1" aria-selected="true">Recompensa 1</a>
                                                                        <a class="nav-link r-20" id="v-pills-recompensa2-tab2" data-toggle="pill" href="#v-pills-recompensa22" role="tab" aria-controls="v-pills-recompensa2" aria-selected="false">Recompensa 2</a>
                                                                        <a class="nav-link r-20" id="v-pills-recompensa3-tab2" data-toggle="pill" href="#v-pills-recompensa32" role="tab" aria-controls="v-pills-recompensa3" aria-selected="false">Recompensa 3</a>
                                                                        <a class="nav-link r-20" id="v-pills-recompensa4-tab2" data-toggle="pill" href="#v-pills-recompensa42" role="tab" aria-controls="v-pills-recompensa4" aria-selected="false">Recompensa 4</a>
                                                                        <a class="nav-link r-20" id="v-pills-recompensa5-tab2" data-toggle="pill" href="#v-pills-recompensa52" role="tab" aria-controls="v-pills-recompensa5" aria-selected="false">Recompensa 5</a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="tab-content" id="v-pills-tabContent3">


                                                                        <div class="tab-pane fade active show" id="v-pills-recompensa12" role="tabpanel" aria-labelledby="v-pills-recompensa1-tab">

                                                                            <div class="form-row">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <input type="hidden" id="id_project" name="id_project" value="<?php echo $idProjectActual['id_project']; ?>">

                                                                                    <label for="r1_tier_title" class="form-label fw-bold">Nombre recompensa</label>
                                                                                    <input type="text" value="" name="r1_tier_title" class="form-control" id="r1_tier_title" placeholder="ej: Apoyo básico" required>
                                                                                </div>


                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="r1_tier_amount" class="form-label fw-bold">Monto de apoyo</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text" id="inputGroupPrepend3">$</span>
                                                                                        </div>
                                                                                        <input type="text" name="r1_tier_amount" class="form-control" id="r1_tier_amount" placeholder="5.000" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12 mb-0">
                                                                                    <label for="r1_t_reward" class="form-label fw-bold">Recompensas</label>
                                                                                    <input type="text" id="r1_t_reward" name="r1_t_reward" class="tags-input" value="Autógrafo, Entradas" data-options='{ "tagClass":   "badge badge-danger" }'>
                                                                                </div>

                                                                                <!-- <div class="col-md-6 mb-3">
                                                                                <label for="r1_tier_amount" class="form-label fw-bold">Cantidad disponible</label>
                                                                                <input type="text" value="0" name="r1_tier_amount" class="form-control" id="r1_tier_amount" required>
                                                                            </div> -->


                                                                                <div class="col-md-12 mb-3">
                                                                                    <label for="r1_project_desc" class="form-label fw-bold">Descripción</label>
                                                                                    <textarea class="form-control" name="r1_project_desc" id="r1_project_desc" placeholder="Máximo 300 caracteres" rows="6" maxlength="500" required></textarea>
                                                                                    <div class="form-text" id="caracteresRestantes1">300 caracteres restantes</div>
                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                        <!-- Form recomepensas 2 -->
                                                                        <div class="tab-pane fade" id="v-pills-recompensa22" role="tabpanel" aria-labelledby="v-pills-recompensa2-tab">
                                                                            <div class="form-row">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="r2_tier_title" class="form-label fw-bold">Nombre recompensa</label>
                                                                                    <input type="text" value="" name="r2_tier_title" class="form-control" id="r2_tier_title" placeholder="ej: Apoyo básico">
                                                                                </div>


                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="r2_tier_amount" class="form-label fw-bold">Monto de apoyo</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text" id="inputGroupPrepend3">$</span>
                                                                                        </div>
                                                                                        <input type="text" name="r2_tier_amount" class="form-control" id="r2_tier_amount" placeholder="5.000">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12 mb-0">
                                                                                    <label for="r2_t_reward" class="form-label fw-bold">Recompensas</label>
                                                                                    <input type="text" id="r2_t_reward" name="r2_t_reward" class="tags-input" data-options='{ "tagClass":   "badge badge-danger" }'>
                                                                                </div>

                                                                                <!-- <div class="col-md-6 mb-3">
                                                                                <label for="r1_tier_amount" class="form-label fw-bold">Cantidad disponible</label>
                                                                                <input type="text" value="0" name="r1_tier_amount" class="form-control" id="r1_tier_amount" required>
                                                                            </div> -->


                                                                                <div class="col-md-12 mb-3">
                                                                                    <label for="r2_project_desc" class="form-label fw-bold">Descripción</label>
                                                                                    <textarea class="form-control" name="r2_project_desc" id="r2_project_desc" placeholder="Máximo 300 caracteres" rows="6" maxlength="500"></textarea>
                                                                                    <div class="form-text" id="caracteresRestantes2">300 caracteres restantes</div>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <!-- Form recomepensas 3 -->
                                                                        <div class="tab-pane fade" id="v-pills-recompensa32" role="tabpanel" aria-labelledby="v-pills-recompensa3-tab">
                                                                            <div class="form-row">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="r3_tier_title" class="form-label fw-bold">Nombre recompensa</label>
                                                                                    <input type="text" value="" name="r3_tier_title" class="form-control" id="r3_tier_title" placeholder="ej: Apoyo básico">
                                                                                </div>


                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="r3_tier_amount" class="form-label fw-bold">Monto de apoyo</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text" id="inputGroupPrepend3">$</span>
                                                                                        </div>
                                                                                        <input type="text" name="r3_tier_amount" class="form-control" id="r3_tier_amount" placeholder="5.000">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12 mb-0">
                                                                                    <label for="r3_t_reward" class="form-label fw-bold">Recompensas</label>
                                                                                    <input type="text" id="r3_t_reward" name="r3_t_reward" class="tags-input" data-options='{ "tagClass":   "badge badge-danger" }'>
                                                                                </div>

                                                                                <!-- <div class="col-md-6 mb-3">
                                                                                <label for="r1_tier_amount" class="form-label fw-bold">Cantidad disponible</label>
                                                                                <input type="text" value="0" name="r1_tier_amount" class="form-control" id="r1_tier_amount" >
                                                                            </div> -->


                                                                                <div class="col-md-12 mb-3">
                                                                                    <label for="r3_project_desc" class="form-label fw-bold">Descripción</label>
                                                                                    <textarea class="form-control" name="r3_project_desc" id="r3_project_desc" placeholder="Máximo 300 caracteres" rows="6" maxlength="500"></textarea>
                                                                                    <div class="form-text" id="caracteresRestantes3">300 caracteres restantes</div>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <!-- Form recomepensas 4 -->
                                                                        <div class="tab-pane fade" id="v-pills-recompensa42" role="tabpanel" aria-labelledby="v-pills-recompensa4-tab">
                                                                            <div class="form-row">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="r4_tier_title" class="form-label fw-bold">Nombre recompensa</label>
                                                                                    <input type="text" value="" name="r4_tier_title" class="form-control" id="r4_tier_title" placeholder="ej: Apoyo básico">
                                                                                </div>


                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="r4_tier_amount" class="form-label fw-bold">Monto de apoyo</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text" id="inputGroupPrepend3">$</span>
                                                                                        </div>
                                                                                        <input type="text" name="r4_tier_amount" class="form-control" id="r4_tier_amount" placeholder="5.000">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12 mb-0">
                                                                                    <label for="r4_t_reward" class="form-label fw-bold">Recompensas</label>
                                                                                    <input type="text" id="r4_t_reward" name="r4_t_reward" class="tags-input" data-options='{ "tagClass":   "badge badge-danger" }'>
                                                                                </div>

                                                                                <!-- <div class="col-md-6 mb-3">
                                                                                <label for="r1_tier_amount" class="form-label fw-bold">Cantidad disponible</label>
                                                                                <input type="text" value="0" name="r1_tier_amount" class="form-control" id="r1_tier_amount" >
                                                                            </div> -->


                                                                                <div class="col-md-12 mb-3">
                                                                                    <label for="r4_project_desc" class="form-label fw-bold">Descripción</label>
                                                                                    <textarea class="form-control" name="r4_project_desc" id="r4_project_desc" placeholder="Máximo 300 caracteres" rows="6" maxlength="500"></textarea>
                                                                                    <div class="form-text" id="caracteresRestantes4">300 caracteres restantes</div>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <!-- Form recomepensas 5 -->
                                                                        <div class="tab-pane fade" id="v-pills-recompensa52" role="tabpanel" aria-labelledby="v-pills-recompensa5-tab">
                                                                            <div class="form-row">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="r5_tier_title" class="form-label fw-bold">Nombre recompensa</label>
                                                                                    <input type="text" value="" name="r5_tier_title" class="form-control" id="r5_tier_title" placeholder="ej: Apoyo básico">
                                                                                </div>


                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="r5_tier_amount" class="form-label fw-bold">Monto de apoyo</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text" id="inputGroupPrepend3">$</span>
                                                                                        </div>
                                                                                        <input type="text" name="r5_tier_amount" class="form-control" id="r5_tier_amount" placeholder="5.000">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12 mb-0">
                                                                                    <label for="r5_t_reward" class="form-label fw-bold">Recompensas</label>
                                                                                    <input type="text" id="r5_t_reward" name="r5_t_reward" class="tags-input" data-options='{ "tagClass":   "badge badge-danger" }'>
                                                                                </div>

                                                                                <!-- <div class="col-md-6 mb-3">
                                                                                <label for="r1_tier_amount" class="form-label fw-bold">Cantidad disponible</label>
                                                                                <input type="text" value="0" name="r1_tier_amount" class="form-control" id="r1_tier_amount" >
                                                                            </div> -->


                                                                                <div class="col-md-12 mb-3">
                                                                                    <label for="r5_project_desc" class="form-label fw-bold">Descripción</label>
                                                                                    <textarea class="form-control" name="r5_project_desc" id="r5_project_desc" placeholder="Máximo 300 caracteres" rows="6" maxlength="500"></textarea>
                                                                                    <div class="form-text" id="caracteresRestantes5">300 caracteres restantes</div>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="d-flex justify-content-center gap-2">
                                                                <button id="crearRecompensasBtn" name="" class="btn btn-primary">
                                                                    <i class="icon-plus-circle"></i> Guardar recompensas</button>
                                                                &nbsp;
                                                                <input type="reset" class="btn btn-secondary" value="Limpiar campos">
                                                            </div>
                                                        </form>

                                                    <?php
                                                    }
                                                    //fin del else
                                                    ?>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tab 4 - Crear Multimedia -->
                                        <div class="tab-pane fade text-center p-1" id="w3-tab4" role="tabpanel" aria-labelledby="w3-tab4">

                                            <div class="card-body">


                                                <?php
                                                if ($multimedia == 1) {

                                                    // Obtiene datos del proyecto  Multimadia y descripcion                                                     
                                                    $multimediosVal = Consultas::obtenerMultimediaPorId($idProjectActual['id_project']);

                                                ?>
                                                    <!-- EDITAR Multimedia -->
                                                    <!-- <form id="editformMultimedia" method="post"> -->
                                                    <form id="editformMultimedia" method="post" enctype="multipart/form-data">
                                                        <div class="form-row">
                                                            <div class="col-md-6 mb-3">
                                                                <input type="hidden" id="id_project" name="edit_id_project" value="<?php echo $idProjectActual['id_project']; ?>">

                                                                <label for="video" class="form-label fw-bold">Video explicativo actual</label>

                                                                <?php
                                                                if ($multimediosVal[0]['project_multimedia_service'] == 'vimeo') {
                                                                    $videoId = $multimediosVal[0]['project_multimedia_name'];
                                                                    echo '<div class="video-container">';
                                                                    echo '<iframe src="https://player.vimeo.com/video/' . htmlspecialchars($videoId) . '" width="320" height="180" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
                                                                    echo '</div>';
                                                                } elseif ($multimediosVal[0]['project_multimedia_service'] == 'youtube') {
                                                                    $videoId = $multimediosVal[0]['project_multimedia_name'];
                                                                    echo '<div class="video-container">';
                                                                    echo '<iframe src="https://www.youtube.com/embed/' . htmlspecialchars($videoId) . '" width="320" height="180" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                                                    echo '</div>';
                                                                }

                                                                ?>
                                                                <br>
                                                                <label for="imageInput" class="form-label fw-bold">Cambiar video </label>
                                                                <input type="text" value="" name="edit_video" class="form-control" id="edit_video" placeholder="https://www.youtube.com/watch?v=123456789" required>
                                                            </div>



                                                            <div class="col-md-6 mb-3">
                                                                <label for="imageInput" class="form-label fw-bold">Foto de portada actual </label>
                                                                <?php
                                                                if ($multimediosVal[1]['project_multimedia_service'] == 'image') {
                                                                    $videoId = $multimediosVal[1]['project_multimedia_name'];
                                                                    echo '<div  >';
                                                                    echo '<img src="https://echomusic.net/dashboard/images/crowdfunding/' . htmlspecialchars($multimediosVal[1]['project_multimedia_name']) . '.jpg" height="180" >';
                                                                    echo '</div>';
                                                                }

                                                                ?>
                                                                <br>
                                                                <label for="imageInput" class="form-label fw-bold ">Cambiar portada </label>
                                                                <!-- Image Input -->
                                                                <input type="file" id="imageInput" accept="image/*">
                                                                <!-- Image Preview -->
                                                                <div id="imagePreview" style="width:100%; height:300px;"></div>
                                                            </div>

                                                            <div class="d-flex justify-content-center gap-2">
                                                                <button id="saveButtonActualizar" type="submit" class="btn btn-primary">
                                                                    <i class="icon-plus-circle"></i> Actualizar
                                                                </button>

                                                                &nbsp;
                                                                <input type="reset" class="btn btn-secondary" value="Limpiar campos">
                                                            </div>



                                                        </div>
                                                    </form>
                                                <?php
                                                } else {
                                                ?>
                                                    <!-- CREAR Multimedia -->
                                                    <form id="formMultimedia" method="post">
                                                        <div class="form-row">
                                                            <div class="col-md-6 mb-3">
                                                                <input type="hidden" id="id_project" name="id_project" value="<?php echo $idProjectActual['id_project']; ?>">

                                                                <label for="video" class="form-label fw-bold">Video explicativo</label>
                                                                <input type="text" value="" name="video" class="form-control" id="video" placeholder="https://www.youtube.com/watch?v=123456789" required>
                                                            </div>


                                                            <div class="col-md-6 mb-3">
                                                                <label for="imageInput" class="form-label fw-bold">Foto de portada</label>
                                                                <!-- Image Input -->
                                                                <input type="file" id="imageInput" accept="image/*">
                                                                <!-- Image Preview -->
                                                                <div id="imagePreview" style="width:100%; height:300px;"></div>
                                                            </div>

                                                            <div class="d-flex justify-content-center gap-2">
                                                                <button id="saveButton" type="submit" class="btn btn-primary">
                                                                    <i class="icon-plus-circle"></i> Guardar
                                                                </button>

                                                                &nbsp;
                                                                <input type="reset" class="btn btn-secondary" value="Limpiar campos">
                                                            </div>



                                                        </div>
                                                    </form>
                                                <?php
                                                }
                                                //fin del else
                                                ?>

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

            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

            <!-- Obtener y listar las regiones  -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    fetch('includes/obtener_regiones.php') // Ajusta la ruta según corresponda
                        .then(response => response.json())
                        .then(regiones => {
                            const selectRegiones = document.getElementById('project_region');
                            selectRegiones.innerHTML = '<option value="0" selected>No aplica</option>';
                            regiones.forEach(region => {
                                const opcion = new Option(region.nombre, region.id);
                                selectRegiones.add(opcion);
                            });
                        })
                        .catch(error => console.error('Error al cargar las regiones:', error));
                });
            </script>




            <!-- Tab 1 - Crero Proyecto -->
            <!-- Enviar datos de formulario  -->
            <!-- <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const formCrearProyecto = document.getElementById('formCrearProyecto');

                    formCrearProyecto.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const formData = new FormData(this);

                        fetch('includes/crearProyectoEndpoint.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data); // Esto te mostrará la respuesta del servidor en la consola.
                                if (data.success) {
                                    swal("¡Éxito!", "El proyecto ha sido creado correctamente. Puedes pasar al siguiente paso y crear los Montos y plazos", "success")
                                        .then((value) => {
                                            // Este código se ejecutará después de que el Swal se cierre
                                            window.location = window.location.href.split('#')[0] + '#w3-tab2';
                                            window.location.reload(); // Recarga la página
                                        });
                                } else {
                                    swal("Error", "No se pudo crear el proyecto: " + data.message, "error");
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                swal("Error", "Error al procesar la solicitud.", "error");
                            });
                    });

                    // Verifica si la URL tiene un hash (para seleccionar un tab específico)
                    if (window.location.hash) {
                        // Activa el tab correspondiente al hash de la URL
                        $('a[href="' + window.location.hash + '"]').tab('show');
                    }
                });
            </script> -->

            <!-- Crear Proyecto -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const descripcion = document.getElementById('project_desc');
                    const contador = document.getElementById('caracteresRestantes');
                    const formCrearProyecto = document.getElementById('formCrearProyecto');

                    // Función para actualizar el contador de caracteres
                    function actualizarContador() {
                        const caracteresIngresados = descripcion.value.length;
                        const caracteresRestantes = 500 - caracteresIngresados;
                        contador.innerText = `${caracteresRestantes} caracteres restantes`;

                        // Cambiar el color del texto si los caracteres ingresados son demasiado bajos o muy cercanos al límite
                        if (caracteresRestantes > 450 || caracteresRestantes < 50) {
                            contador.classList.add('text-warning');
                        } else {
                            contador.classList.remove('text-warning');
                        }
                    }

                    // Escuchar eventos de entrada en el textarea para actualizar el contador
                    descripcion.addEventListener('input', actualizarContador);

                    // Inicializar el contador al cargar la página
                    actualizarContador();

                    // Procesar el envío del formulario
                    formCrearProyecto.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const caracteresIngresados = descripcion.value.length;

                        // Validar que se hayan ingresado al menos 50 caracteres
                        if (caracteresIngresados < 50) {
                            swal("Error", "La descripción debe tener al menos 50 caracteres.", "error");
                            return; // Detiene la ejecución si no se cumple la validación
                        }

                        const formData = new FormData(this);
                        fetch('includes/crearProyectoEndpoint.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    swal("¡Éxito!", "El proyecto ha sido creado correctamente. Puedes pasar al siguiente paso y crear los Montos y plazos", "success")
                                        .then(() => {
                                            window.location = window.location.href.split('#')[0] + '#w3-tab2';
                                            window.location.reload(); // Recarga la página
                                        });
                                } else {
                                    swal("Error", "No se pudo crear el proyecto: " + data.message, "error");
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                swal("Error", "Error al procesar la solicitud.", "error");
                            });
                    });

                    // Verifica si la URL tiene un hash (para seleccionar un tab específico)
                    if (window.location.hash) {
                        // Activa el tab correspondiente al hash de la URL
                        $('a[href="' + window.location.hash + '"]').tab('show');
                    }

                });
            </script>

            <!-- Editar proyecto -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const descripcionEdit = document.getElementById('edit_project_desc');
                    const contadorEdit = document.getElementById('edit_caracteresRestantes');
                    const formEditarProyecto = document.getElementById('formEditarProyecto');

                    const projectAmount = document.getElementById('project_amount');

                    // Función para validar y permitir solo valores numéricos y puntos como separadores de miles
                    function validarSoloNumerosYPuntos(e) {
                        // Permite números y puntos
                        e.target.value = e.target.value.replace(/[^0-9.]/g, '');
                    }

                    // Validación al perder el foco
                    function validarValor(e) {
                        // Quita los puntos del valor para validar el número sin el formato de miles
                        const valorSinFormato = e.target.value.replace(/\./g, '');
                        const valor = parseInt(valorSinFormato, 10);

                        if (valor < 1000 || valor === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Valor inválido',
                                text: 'El monto a financiar debe ser un número positivo mayor o igual a 1000.',
                            });
                            e.target.value = ''; // Resetea el campo
                        } else {
                            // Opcionalmente, puedes reformatear el valor para mostrarlo con puntos como separadores de miles
                            e.target.value = valor.toLocaleString('es-CL');
                        }
                    }

                    // Agregar eventos para validar el input project_amount
                    projectAmount.addEventListener('input', validarSoloNumerosYPuntos);
                    projectAmount.addEventListener('blur', validarValor); // Evento blur se dispara cuando el input pierde el foco


                    descripcionEdit.addEventListener('input', actualizarContadorEdit);
                    actualizarContadorEdit();

                    formEditarProyecto.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const caracteresIngresados = descripcionEdit.value.length;
                        if (caracteresIngresados < 50) {
                            swal("Error", "La descripción debe tener al menos 50 caracteres.", "error");
                            return;
                        }

                        const formData = new FormData(this);
                        fetch('includes/editarProyectoEndpoint.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    swal("¡Éxito!", "El proyecto ha sido actualizado correctamente.", "success")
                                        .then(() => {
                                            window.location.reload();
                                        });
                                } else {
                                    swal("Error", "No se pudo actualizar el proyecto: " + data.message, "error");
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                swal("Error", "Error al procesar la solicitud.", "error");
                            });
                    });

                    // Verifica si la URL tiene un hash (para seleccionar un tab específico)
                    if (window.location.hash) {
                        // Activa el tab correspondiente al hash de la URL
                        $('a[href="' + window.location.hash + '"]').tab('show');
                    }
                });
            </script>



            <!-- Tab 2 - Montos y plazos del Proyecto -->

            <!-- Calcula comisión y da formato a los valores de precios -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const inputMontoFinanciar = document.getElementById('project_amount');
                    const comisionProyecto = document.getElementById('comisionProyecto');

                    // Función para formatear números a formato de moneda chilena
                    function formatearMonto(monto) {
                        return new Intl.NumberFormat('es-CL', {
                            style: 'currency',
                            currency: 'CLP',
                            minimumFractionDigits: 0
                        }).format(monto);
                    }

                    // Escuchador de eventos para cuando se cambia el valor del input
                    inputMontoFinanciar.addEventListener('input', function() {
                        // Remueve los puntos antes de hacer el cálculo
                        let montoSinFormato = this.value.replace(/\./g, '');
                        // Calcula la comisión (considerando que quieras el 8% del monto)
                        let comision = montoSinFormato * 0.08 * 1.19;
                        // Actualiza el texto de comisionProyecto con el valor formateado
                        comisionProyecto.textContent = formatearMonto(comision);
                    });

                    // Función para transformar el input a formato de moneda al escribir
                    inputMontoFinanciar.addEventListener('input', function(e) {
                        // Extrae el valor limpio del input (sin puntos ni comas)
                        let valorLimpiado = this.value.replace(/\./g, '');
                        // Actualiza el input con el valor formateado
                        this.value = formatearMonto(valorLimpiado).replace(/[CLP|\$\s]/g, '');
                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const einputMontoFinanciar = document.getElementById('edit_project_amount');
                    const ecomisionProyecto = document.getElementById('edit_comisionProyecto');

                    // Función para formatear números a formato de moneda chilena
                    function eformatearMonto(monto) {
                        return new Intl.NumberFormat('es-CL', {
                            style: 'currency',
                            currency: 'CLP',
                            minimumFractionDigits: 0
                        }).format(monto);
                    }

                    // Escuchador de eventos para cuando se cambia el valor del input
                    einputMontoFinanciar.addEventListener('input', function() {
                        // Remueve los puntos antes de hacer el cálculo
                        let emontoSinFormato = this.value.replace(/\./g, '');
                        // Calcula la comisión (considerando que quieras el 8% del monto)
                        let ecomision = emontoSinFormato * 0.08 * 1.19;
                        // Actualiza el texto de comisionProyecto con el valor formateado
                        ecomisionProyecto.textContent = eformatearMonto(ecomision);
                    });

                    // Función para transformar el input a formato de moneda al escribir
                    einputMontoFinanciar.addEventListener('input', function(e) {
                        // Extrae el valor limpio del input (sin puntos ni comas)
                        let evalorLimpiado = this.value.replace(/\./g, '');
                        // Actualiza el input con el valor formateado
                        this.value = eformatearMonto(evalorLimpiado).replace(/[CLP|\$\s]/g, '');
                    });
                });
            </script>

            <!-- CREAR MONTOS -->
            <!-- Procesa los datos para crear los montos y plazos y guardarlos en la BD -->
            <script>
                document.getElementById('formCrearMontosYPlazos').addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Prepara los datos del formulario para enviar
                    const formData = new FormData(this);

                    fetch('includes/crearMontosProyecto.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                swal("¡Éxito!", "Los montos y plazos han sido agregados al proyecto.", "success")
                                    .then((value) => {
                                        // Este código se ejecutará después de que el Swal se cierre
                                        window.location = window.location.href.split('#')[0] + '#w3-tab3';
                                        window.location.reload(); // Recarga la página
                                    });
                            } else {
                                swal("Error", "No se pudieron agregar los montos y plazos: " + data.error, "error");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            swal("Error", "Error al procesar la solicitud.", "error");
                        });

                    // Verifica si la URL tiene un hash (para seleccionar un tab específico)
                    if (window.location.hash) {
                        // Activa el tab correspondiente al hash de la URL
                        $('a[href="' + window.location.hash + '"]').tab('show');
                    }
                });
            </script>

            <!-- EDITAR MONTOS -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const formEditarMontosYPlazos = document.getElementById('formEditarMontosYPlazos');

                    formEditarMontosYPlazos.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const formData = new FormData(this);

                        fetch('includes/editar_montos_proyecto.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('¡Actualizado!', 'Los montos y plazos han sido actualizados exitosamente.', 'success')
                                        .then(() => {
                                            window.location = window.location.href.split('#')[0] + '#w3-tab3';
                                            window.location.reload(); // Recarga la página
                                        });
                                } else {
                                    Swal.fire('Error', 'No se pudo actualizar: ' + data.error, 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error', 'Ocurrió un error al procesar la solicitud.', 'error');
                            });
                    });

                    // Verifica si la URL tiene un hash (para seleccionar un tab específico)
                    if (window.location.hash) {
                        // Activa el tab correspondiente al hash de la URL
                        $('a[href="' + window.location.hash + '"]').tab('show');
                    }
                });
            </script>

            <script>
                $(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>


            <!-- Tab 3 - Recompensas del Proyecto -->
            <!-- Envia los datos del form de recompensas  -->
            <script>
                // document.getElementById('formRecompensas').addEventListener('submit', function(e) {
                //     e.preventDefault();
                //     // Construir un objeto FormData para enviar los datos del formulario
                //     const formData = new FormData(this);

                //     // Realizar la solicitud POST al endpoint de PHP
                //     fetch('includes/crearRecompensasProyecto.php', {
                //             method: 'POST',
                //             body: formData
                //         })
                //         .then(response => response.json())
                //         .then(data => {
                //             if (data.success) {
                //                 // Usando SweetAlert para la alerta de éxito
                //                 swal("¡Éxito!", "Recompensas creadas exitosamente.", "success")
                //                     .then((value) => {
                //                         // Este código se ejecutará después de que el Swal se cierre
                //                         window.location = window.location.href.split('#')[0] + '#w3-tab4';
                //                         window.location.reload(); // Recarga la página
                //                     });


                //             } else {
                //                 // Usando SweetAlert para la alerta de error
                //                 swal("Error", "Error al crear recompensas: " + data.message, "error");
                //             }
                //         })
                //         .catch(error => {
                //             console.error('Error:', error);
                //             // Usando SweetAlert para la alerta de error de fetch
                //             swal("Error", "Error al procesar la solicitud.", "error");
                //         });

                //     // Verifica si la URL tiene un hash (para seleccionar un tab específico)
                //     if (window.location.hash) {
                //         // Activa el tab correspondiente al hash de la URL
                //         $('a[href="' + window.location.hash + '"]').tab('show');
                //     }
                // });

                // Valida no escribir caracteres en los montos CREAR
                document.addEventListener('DOMContentLoaded', function() {
                    // Añadir evento de input para validar en tiempo real los campos de monto 
                    const camposDeMonto = document.querySelectorAll('[id^=r][id$=_tier_amount]');

                    camposDeMonto.forEach(function(campo) {
                        campo.addEventListener('input', function() {
                            // Eliminar caracteres no numéricos excepto el punto (.)
                            this.value = this.value.replace(/[^\d.]/g, '');

                            // Validación extra para asegurar que el valor sea mayor a 1000 y no negativo
                            let valor = parseInt(this.value.replace(/\./g, ''), 10);
                            if (valor <= 1000) {
                                this.setCustomValidity('El monto debe ser mayor a 1000');
                            } else {
                                this.setCustomValidity('');
                            }
                        });
                    });
                });

                document.addEventListener('DOMContentLoaded', function() {
                    // Añadir evento de input para validar en tiempo real los campos de monto 
                    const camposDeMonto = document.querySelectorAll('[id^=edit_r][id$=_tier_amount]');

                    camposDeMonto.forEach(function(campo) {
                        campo.addEventListener('input', function() {
                            // Eliminar caracteres no numéricos excepto el punto (.)
                            this.value = this.value.replace(/[^\d.]/g, '');

                            // Validación extra para asegurar que el valor sea mayor a 1000 y no negativo
                            let valor = parseInt(this.value.replace(/\./g, ''), 10);
                            if (valor <= 1000) {
                                this.setCustomValidity('El monto debe ser mayor a 1000');
                            } else {
                                this.setCustomValidity('');
                            }
                        });
                    });
                });

                // Envía el form para guardar las recompensas
                document.getElementById('formRecompensas').addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Validar montos de apoyo antes de enviar el formulario
                    if (!validarMontos()) {
                        return; // Detiene el envío del formulario si la validación falla
                    }

                    // Construir un objeto FormData para enviar los datos del formulario
                    const formData = new FormData(this);

                    // Realizar la solicitud POST al endpoint de PHP
                    fetch('includes/crearRecompensasProyecto.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Usando SweetAlert para la alerta de éxito
                                swal("¡Éxito!", "Recompensas creadas exitosamente.", "success")
                                    .then((value) => {
                                        window.location = window.location.href.split('#')[0] + '#w3-tab4';
                                        window.location.reload(); // Recarga la página
                                    });
                            } else {
                                // Usando SweetAlert para la alerta de error
                                swal("Error", "Error al crear recompensas: " + data.message, "error");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Usando SweetAlert para la alerta de error de fetch
                            swal("Error", "Error al procesar la solicitud.", "error");
                        });
                });

                // Función para validar montos de apoyo
                function validarMontos() {
                    for (let i = 1; i <= 5; i++) {
                        let monto = document.getElementById(`r${i}_tier_amount`).value.trim();
                        monto = monto.replace(/\./g, ""); // Asume que el punto se usa para separar miles

                        // Permitir que los campos de las recompensas 2 a la 5 estén vacíos
                        if (monto === "" && i > 1) continue; // Si el campo está vacío y no es la recompensa 1, sigue con el siguiente

                        // Verificar que el monto sea un número válido, mayor a 1000 y no negativo
                        if (!monto || isNaN(monto) || Number(monto) <= 1000 || Number(monto) < 0) {
                            swal("Error", `El monto de apoyo en Recompensa ${i} debe ser un número mayor a 1000 y no negativo.`, "error");
                            return false;
                        }
                    }
                    return true;
                }


                // Función para contador de caracteres CREAR
                document.addEventListener('DOMContentLoaded', function() {
                    // Seleccionar todos los campos de descripción del proyecto
                    const camposDeDescripcion = document.querySelectorAll('[id^=r][id$=_project_desc]');

                    camposDeDescripcion.forEach(function(campo) {
                        // Evento de entrada para cada campo de descripción
                        campo.addEventListener('input', function() {
                            // Truncar el valor a 300 caracteres si es necesario
                            if (this.value.length > 300) {
                                this.value = this.value.substring(0, 300);
                            }

                            // Extraer el número al final del id del campo actual
                            const numero = this.id.match(/\d+/)[0];
                            // Seleccionar el div correspondiente de caracteres restantes
                            const contador = document.getElementById(`caracteresRestantes${numero}`);
                            // Calcular caracteres restantes
                            const caracteresRestantes = 300 - this.value.length;
                            // Actualizar el texto del contador
                            contador.textContent = `${caracteresRestantes} caracteres restantes`;

                            // Validación adicional para color del texto según caracteres restantes
                            if (caracteresRestantes >= 100) {
                                contador.style.color = 'green';
                            } else if (caracteresRestantes >= 50) {
                                contador.style.color = 'orange';
                            } else {
                                contador.style.color = 'red';
                            }
                        });
                    });
                });



                // Actualziar recompenzas EDITAR
                // actualizarRecompensasProyecto.php
                // document.addEventListener('DOMContentLoaded', function() {
                //     const formEditarRecompensas = document.getElementById('editformRecompensas');

                //     formEditarRecompensas.addEventListener('submit', function(e) {
                //         e.preventDefault();

                //         // Construir el objeto FormData a partir del formulario
                //         const formData = new FormData(this);

                //         // Realizar la solicitud POST al endpoint PHP
                //         fetch('includes/actualizarRecompensasProyecto.php', {
                //                 method: 'POST',
                //                 body: formData
                //             })
                //             .then(response => response.json())
                //             .then(data => {
                //                 if (data.success) {
                //                     Swal.fire({
                //                         title: '¡Éxito!',
                //                         text: 'Recompensas actualizadas correctamente.',
                //                         icon: 'success',
                //                         confirmButtonText: 'Ok'
                //                     }).then((result) => {
                //                         // Opcional: Recargar la página o redirigir si es necesario
                //                         window.location.reload();
                //                     });
                //                 } else {
                //                     Swal.fire({
                //                         title: 'Error',
                //                         text: 'No se pudieron actualizar las recompensas: ' + data.error,
                //                         icon: 'error',
                //                         confirmButtonText: 'Entendido'
                //                     });
                //                 }
                //             })
                //             .catch(error => {
                //                 console.error('Error:', error);
                //                 Swal.fire({
                //                     title: 'Error',
                //                     text: 'Ocurrió un error al procesar la solicitud.',
                //                     icon: 'error',
                //                     confirmButtonText: 'Entendido'
                //                 });
                //             });
                //     });
                // });



                // Valida envío del form con los campos requeridos
                // document.getElementById('formRecompensas').addEventListener('submit', function(e) {
                // Impide el envío del formulario por defecto
                // e.preventDefault();

                // Verificación de la primera recompensa como ejemplo
                // let r1TierTitle = document.getElementById('r1_tier_title').value.trim();
                // let r1TierAmount = document.getElementById('r1_tier_amount').value.trim();
                // let r1ProjectDesc = document.getElementById('r1_project_desc').value.trim();

                // if (!r1TierTitle || !r1TierAmount || r1ProjectDesc.length < 50) { // Asume un mínimo de 50 caracteres para la descripción
                //     alert('Por favor, rellena todos los campos requeridos en la primera recompensa.');
                //     return false; // Detiene el envío del formulario
                // }

                // Si todo está correcto, procede a enviar el formulario (aquí puedes usar fetch o XMLHttpRequest)
                // });
            </script>

            <!-- Función encapsulada para Actualizar Recompensas -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Encapsulando la lógica de envío en una función
                    function enviarFormularioRecompensas() {
                        const formEditarRecompensas = document.getElementById('editformRecompensas');
                        const formData = new FormData(formEditarRecompensas);

                        fetch('includes/actualizarRecompensasProyecto.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: '¡Éxito!',
                                        text: 'Recompensas actualizadas correctamente.',
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        // Opcional: Recargar la página o redirigir si es necesario
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'No se pudieron actualizar las recompensas: ' + data.error,
                                        icon: 'error',
                                        confirmButtonText: 'Entendido'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Ocurrió un error al procesar la solicitud.',
                                    icon: 'error',
                                    confirmButtonText: 'Entendido'
                                });
                            });
                    }

                    // Asignar el evento click al botón
                    const btnEditarRecompensas = document.getElementById('editarRecompensasBtn');
                    if (btnEditarRecompensas) {
                        btnEditarRecompensas.addEventListener('click', function(e) {
                            e.preventDefault(); // Prevenir el comportamiento por defecto del botón si es necesario
                            enviarFormularioRecompensas(); // Llamar a la función de envío cuando se haga clic en el botón
                        });
                    }
                });
            </script>

            <!-- Tab 4 - Multimedia del Proyecto -->
            <!-- Editar foto de Proyecto - Implementa la lógica para inicializar Cropper.js, cargar la imagen seleccionada, recortarla y enviar la imagen recortada al servidor. -->
            <script type="text/javascript">
                $(document).ready(function() {
                    var cropper;

                    $('#imageInput').on('change', function(e) {
                        var files = e.target.files;
                        var done = function(url) {
                            $('#imagePreview').html('<img src="' + url + '" />');
                            if (cropper) {
                                cropper.destroy();
                            }
                            cropper = new Cropper($('#imagePreview img')[0], {
                                aspectRatio: 16 / 9,
                                viewMode: 1,
                            });
                        };

                        if (files && files.length > 0) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                done(reader.result);
                            };
                            reader.readAsDataURL(files[0]);
                        }
                    });

                    // Cambio aquí: Usar 'submit' en lugar de 'click', y prevenir el comportamiento predeterminado
                    $('#formMultimedia').on('submit', function(e) {
                        e.preventDefault(); // Previene la recarga de la página

                        var formData = new FormData(this);
                        var videoURL = $('#video').val();
                        var projectId = $('#id_project').val();

                        formData.append('video_url', videoURL);
                        formData.append('project_id', projectId);

                        if (cropper) {
                            cropper.getCroppedCanvas().toBlob(function(blob) {
                                formData.append('image', blob, 'project_image.jpg');

                                $.ajax({
                                    url: 'includes/subir_multimedia_proyectos.php',
                                    method: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        var data = JSON.parse(response); // Asegúrate de que tu PHP devuelve JSON
                                        if (data.success) {
                                            swal("¡Éxito!", data.message, "success");
                                        } else {
                                            swal("Error", data.message, "error");
                                        }
                                    },
                                    error: function() {
                                        swal("Error", "Error al guardar multimedia.", "error");
                                    },
                                });
                            });
                        }
                    });
                });
            </script>


            <!-- función para cambiar multimedia -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Encapsula la lógica de envío en una función
                    function enviarFormularioMultimedia() {
                        const form = document.getElementById('editformMultimedia');
                        const formData = new FormData(form);

                        const imageInput = document.getElementById('imageInput');
                        if (imageInput && imageInput.files.length > 0) {
                            formData.append('imageFile', imageInput.files[0]); // Asegúrate de que el nombre del campo coincida con el esperado en tu script PHP
                        }

                        fetch('includes/editar_multimedia_proyectos.php', {
                                method: 'POST',
                                body: formData,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('¡Éxito!', 'La multimedia ha sido actualizada correctamente.', 'success');
                                } else {
                                    Swal.fire('Error', 'No se pudo actualizar la multimedia: ' + data.error, 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error', 'Ocurrió un error al procesar la solicitud.', 'error');
                            });
                    }

                    // Añade un listener al botón de guardar para invocar la función de envío
                    const saveButton = document.getElementById('saveButtonActualizar');
                    if (saveButton) {
                        saveButton.addEventListener('click', function(e) {
                            e.preventDefault(); // Previene el comportamiento por defecto del formulario
                            enviarFormularioMultimedia(); // Llama a la función de envío
                        });
                    }
                });
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