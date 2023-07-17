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
                            <a href="index.html">
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
                                <p>O seleciona la plataforma de ingreso</p>
                            </div>
                            <form>
                                <div class="row justify-content-center">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <a class="box-btn google" href="#" target="_blank">
                                            <i class='bx bxl-google'></i> Google
                                        </a>
                                    </div>
<!--                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <a class="box-btn facebook" href="#" target="_blank">
                                            <i class='bx bxl-facebook'></i> Facebook
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <a class="box-btn twitter" href="#" target="_blank">
                                            <i class='bx bxl-twitter'></i> Twitter
                                        </a>
                                    </div>-->
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="name" placeholder="Usario">
                                        </div>
                                    </div>
<!--                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control" type="email" name="email" placeholder="Email">
                                        </div>
                                    </div>-->
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="password" placeholder="Contraseña">
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
                                        <a class="box-btn signup-btn" href="">
                                            Ingresar
                                        </a>
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