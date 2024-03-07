<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap Min CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- MeanMenu Min CSS -->
    <link rel="stylesheet" href="assets/css/meanmenu.min.css" />
    <!-- Boxicon Min CSS -->
    <link rel="stylesheet" href="assets/css/boxicons.min.css" />
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="assets/css/flaticon.css" />
    <!-- Magnific Min CSS -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css" />
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="assets/css/animate.min.css" />
    <!-- Owl Carousel Min CSS -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/styleEchoMusic.css" type="text/css" />
    <!-- Dark CSS -->
    <link rel="stylesheet" href="assets/css/dark.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <!--Iconos Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!--Para Artistas-->

    <link rel="stylesheet" href="video/assets/css/animate.css">
    <link rel="stylesheet" href="video/assets/css/media-queries.css">

    <!-- jQuery Min JS -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Bootstrap Bundle Min JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--fin artistas-->

    <!-- reCaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="assets/images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">
    <link rel="manifest" href="assets/images/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/images/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="icon" type="image/png" href="assets/images/favicon-96x96.png" />
    <!-- Tittle -->
    <title>EchoMusic - Marketplace de servicios musicales </title>

    <!-- Librería de Google OAuth -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>


</head>

<body>
    <!-- PreLoader Start -->
    <div class="loader-content">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="sk-folding-cube">
                    <div class="sk-cube1 sk-cube"></div>
                    <div class="sk-cube2 sk-cube"></div>
                    <div class="sk-cube4 sk-cube"></div>
                    <div class="sk-cube3 sk-cube"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- PreLoader End -->




    <!-- Header Area -->
    <header class="header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-sm-0">
                    <div class="logo">
                        <a href="index.php"><img src="assets/images/logo/echomusic-LOGO-HOR-BIC.png" alt="logo" /></a>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-8 text-right pr-0">
                    <div class="header-content-right">
                        <?php

                        // Verificar si la sesión está iniciada
                        if (isset($_SESSION["id_type_user"])) {
                            // La sesión está iniciada
                            // Determinar el tipo de usuario y almacenarlo en una variable
                            $tipoUsuario = '';
                            switch ($_SESSION["id_type_user"]) {
                                case 1:
                                    $tipoUsuario = "Artista";
                                    break;
                                case 2:
                                    $tipoUsuario = "Usuario";
                                    break;
                                case 3:
                                    $tipoUsuario = "Espacio";
                                    break;
                                case 4:
                                    $tipoUsuario = "Admin";
                                    break;
                                case 5:
                                    $tipoUsuario = "Agente";
                                    break;
                                default:
                                    $tipoUsuario = "Usuario Desconocido";
                                    break;
                            }

                            // Menú para usuarios logueados
                            echo '<ul class="header-contact">
            <li><i class="bx bxs-user-circle"></i> Perfil de ' . $tipoUsuario . '</li>
            <li>
                <a href="dashboard/includes/cerrarSesion.php" class="text-center">
                    <i class="bx bxs-user-circle"></i> Cerrar sesión</a>
            </li>
          </ul>';
                        } else {
                            // La sesión no está iniciada
                            // Menú para usuarios no logueados
                            echo '<ul class="header-contact">
            <li><a href="ingresar.php"><i class="bx bxs-log-in"></i> Ingresar</a></li>
            <li>
                <a type="button" class="text-center" data-bs-toggle="modal" data-bs-target="#ModalTipodeRegistro">
                    <i class="bx bxs-log-out"></i> Regístrate</a>
            </li>
          </ul>';
                        }
                        ?>




                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 text-right pl-0">
                    <div class="header-content-right">
                        <ul class="header-social">
                            <li>
                                <a href="https://www.facebook.com/EchoMusic-Chile-113583697083086/" target="_blank"><i class="bx bxl-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://instagram.com/echomusic_cl" target="_blank"><i class="bx bxl-instagram"></i></a>
                            </li>
                            <li>
                                <a href="https://www.tiktok.com/@echomusic_cl" target="_blank"> <i class="bx bxl-tiktok"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/echomusic-cl" target="_blank"> <i class="bx bxl-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    <!--Navbar Area -->
    <div class="navbar-area">
        <div class="mobile-nav">
            <a href="index.php" class="logo">
                <img src="assets/images/logo/echomusic-logo-144x30px.png" alt="logo" />
                <!--<img src="assets/images/logo.png" alt="logo" />-->
            </a>
        </div>

        <div class="main-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav text-left">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link dropdown-toggle">Inicio</a>

                            </li>
                            <li class="nav-item">


                                <a href="cartelera.php" class="nav-link">Cartelera</a>
                            </li>
                            <li class="nav-item">
                                <a href="buscar_artista.php" class="nav-link dropdown-toggle">Artistas</a>
                                <!--                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">Apoya Crowdfunding</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">Solutions Details</a>
                                        </li>
                                    </ul>-->
                            </li>
                            <li class="nav-item">
                                <a href="buscar_crowdfunding.php" class="nav-link dropdown-toggle">Apoya Crowdfunding</a>
                                <!--                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">Case Studies</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">Case Studies Details</a>
                                        </li>
                                    </ul>-->
                            </li>
                            <li class="nav-item">
                                <a href="blog.php" class="nav-link dropdown-toggle">Blog</a>

                            </li>

                            <li class="nav-item">
                                <a href="contacto.php" class="nav-link">Contacto </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-right">
                        <!-- <form method="GET" action="buscador.php"> -->
                        <form method="GET" action="cartelera.php">
                            <div class="input-group">
                                <input type="text" class="form-control search" id="res" name="r" placeholder="Buscar evento..." />
                            </div>
                            <button type="submit">
                                <i class="bx bx-search"></i>
                            </button>
                        </form>
                    </div>

                    <?php

                    if (isset($_SESSION["id_type_user"])) {

                    ?>
                        <!-- Dropdown Menu -->
                        <div class="dropdown">
                            <button class="btn box-btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

                                <?php
                                echo   $_SESSION["nick_user"] . " - " . $_SESSION["id_user"];
                                ?>
                                <i class='bx bxs-down-arrow'></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="https://echomusic.net/dashboard/perfil-editar.php">Mi Perfil</a></li>
                                <li><a class="dropdown-item" href="https://echomusic.net/dashboard/eventos.php">Mis Eventos</a></li>
                                <li><a class="dropdown-item" href="https://echomusic.net/dashboard/crowdfunding.php">Crowdfunding</a></li>
                                <li><a class="dropdown-item" href="#">Datos</a></li>
                                <li><a class="dropdown-item" href="#">Mis gustos</a></li>
                                <li><a class="dropdown-item" href="dashboard/includes/cerrarSesion.php">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    <?php
                    } else {
                    ?>
                        <!-- Botón Regsitrata desaparece cuando está logueado -->
                        <div class="nav-btn">
                            <a type="button" class="box-btn text-center" data-bs-toggle="modal" data-bs-target="#ModalTipodeRegistro">
                                <i class="bx bxs-log-out"></i> Regístrate</a>
                        </div>
                    <?php
                    }

                    ?>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->