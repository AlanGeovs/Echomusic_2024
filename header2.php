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
    <!-- Dark CSS -->
    <link rel="stylesheet" href="assets/css/dark.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css" />

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
    <title>EchoMusic - Conectamos artistas con audiencias y espacios de difusión -- </title>
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
                        <ul class="header-contact">
                            <li><a href="#"><i class="bx bxs-log-in"></i> Ingresar</a></li>
                            <li><a href="#"><i class="bx bxs-log-out"></i> Regístrate</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 text-right pl-0">
                    <div class="header-content-right">
                        <ul class="header-social">
                            <li>
                                <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" target="_blank"> <i class="bx bxs-envelope"></i></a>
                            </li>
                            <li>
                                <a href="#" target="_blank"> <i class="bx bxl-youtube"></i></a>
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
                                <a href="index.php" class="nav-link dropdown-toggle active">Inicio</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="index.php" class="nav-link active">Inicio Ingreso</a>
                                    </li>
                                    <!--                                        <li class="nav-item">
                                            <a href="index-2.html" class="nav-link">Home Two</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="index-3.html" class="nav-link">Home Three</a>
                                        </li>-->
                                </ul>
                            </li>
                            <li class="nav-item">


                                <a href="#" class="nav-link">Cartelera</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle">Artistas</a>
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
                                <a href="#" class="nav-link dropdown-toggle">Apoya Crowdfunding</a>
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
                                <a href="#" class="nav-link dropdown-toggle">Blog</a>
                                <!--                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="blog.html" class="nav-link">Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="blog-details.html" class="nav-link">Blog Details</a>
                                        </li>
                                    </ul>-->
                            </li>
                            <!--                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">Pages</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="team.html" class="nav-link">Team</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pricing.html" class="nav-link">Pricing</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="gallery.html" class="nav-link">Gallery</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="testimonials.html" class="nav-link">Testimonials</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="singnup.html" class="nav-link">Sign Up</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="signin.html" class="nav-link">Sign In</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="404.html" class="nav-link">Error 404</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="faq.html" class="nav-link">FAQ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="terms-condition.html" class="nav-link">Terms & Conditions</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="privecy.html" class="nav-link">Privacy Policy</a>
                                        </li>
                                    </ul>
                                </li>-->
                            <li class="nav-item">
                                <a href="#" class="nav-link">Contacto </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-right">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control search" placeholder="Buscar..." />
                            </div>
                            <button type="submit">
                                <i class="bx bx-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="nav-btn">
                        <a href="#" class="box-btn">Regístrate</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->