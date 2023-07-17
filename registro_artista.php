<?php 
include "model/models.php";
include "header.php";
?>

        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>Registro</h2>
                    <ul>
                        <li>
                            <a href="index.html">
                                Inicio 
                            </a>
                        </li>
 

                        <li class="active">Registro como artista</li>
                    </ul>
                </div>
            </div> 
        </div>
        <!-- End Page Title Area -->

        <!-- SignUp -->
        <section class="signup-area ptb-35">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="signup-form">
                            <div class="section-tittle text-center">
                                <h2>Regístrate como artista</h2>
                                <p>Crear una cuenta EchoMusic</p>
                            </div>
                             <form action="dashboard/includes/registrarUsuario_db.php" method="post" enctype="multipart/form-data">
                                <div class="row justify-content-center">
                                    
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
                                            <input id="userName" name="userName"  class="form-control" type="text"  placeholder="Nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input id="nick" name="nick"  class="form-control" type="text"  placeholder="Nombre de Banda o Artista" required>
                                        </div>
                                    </div>
<!--                                    <div class="col-md-12 col-sm-12 ">
                                        <div class="form-group">
                                            <input id="correo" name="correo" class="form-control" type="text"  placeholder="Apellido">
                                        </div>
                                    </div>-->
<!--                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="name" placeholder="Usuario">
                                        </div>
                                    </div>-->
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input id="correo" name="correo" class="form-control"   placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input id="correo2" name="correo2" class="form-control"   placeholder="Verificar Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input id="password" name="password" class="form-control" type="text"   placeholder="Contraseña" required>
                                        </div>
                                    </div>
<!--                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="password" placeholder="Verifica tu Contraseña">
                                        </div>
                                    </div>-->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="privecy-txt">
                                            <input type="checkbox" id="chb1" required>
                                            <label>
                                                Acepto los
                                                <a href="terminos-y-condiciones.php">Términos y condiciones.</a> 
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="privecy-txt">                                            
                                            <p><small>Para obtener más información acerca de cómo EchoMusic recopila, utiliza, comparte y protege tus datos personales, consulta la 
                                                    <a href="politica-de-privacidad.php">Política de Privacidad</a> de EchoMusic.</small> </p>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center"> 
                                        <button type="submit" class="box-btn signup-btn"><i class="icon-save mr-2"></i>Registrarme</button>
                                    </div>
                                    <div class="col-12 text-center">
                                        <p class="al-acc">
                                           ¿Ya tienes una cuenta?
                                           <a href="ingresar.php"> Inicia sesión</a> 
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