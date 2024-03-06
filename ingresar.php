<?php
include "model/models.php";
include "header.php";
?>

<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Ingresar</h2>
            <ul>
                <li>
                    <a href="index.php">
                        Inicio
                    </a>
                </li>


                <li class="active">Ingresar</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- SignUp -->
<section class="signup-area ptb-35">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="signup-form">
                    <div class="section-tittle text-center">
                        <h2>Ingresar</h2>
                        <p>Seleciona la plataforma de ingreso</p>
                    </div>

                    <form action="dashboard/includes/validarLogin.php" method="post">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php
                                if ($_GET['m'] == 1) {
                                    echo '<div class="alert alert-warning" role="alert">
                                        Ya estás registrado con la cuenta de Google, favor de ingresar
                                      </div>';
                                }

                                ?>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <a class="box-btn google" href="loginConGoogle.php">
                                    <i class='bx bxl-google'></i> Ingresar con Google
                                </a>
                            </div>

                            <div class="col-md-12 col-sm-12 justify-content-center ">
                                <div class="text-center">
                                    <p>--- o ---</p>
                                    <p>Ingresa con una cuenta de email</p>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 pt-35">
                                <div class="form-group">
                                    <input type="email" name="correo" id="correo" class="form-control form-control-lg no-b" placeholder="Correo" required>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group position-relative">
                                    <input type="password" name="password" id="password" class="form-control form-control-lg no-b" placeholder="Password" required>
                                    <i class='bx bxs-show icon-eye' id="togglePassword" style="position: absolute; cursor: pointer; right: 10px; top: 25px;"></i>
                                </div>
                            </div>


                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="privecy-txt">
                                    <input type="checkbox" id="chb1">
                                    <label>
                                        Recordarme
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input type="submit" class="btn btn-success btn-lg btn-block" value="Acceder">
                            </div>
                            <div class="col-12 text-center">
                                <p class="al-acc">
                                    ¿Aún no estas registrado?
                                    <a href="registro.php"> Regístrate</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End SignUp -->

<!--Footer-->
<?php
include 'footer.php';
?>