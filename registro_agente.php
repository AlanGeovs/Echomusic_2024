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


                <li class="active">Registro de agente</li>
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
                        <h2>Regístrate como Agente</h2>
                        <p>Crear una cuenta EchoMusic</p>
                    </div>



                    <form id="formRegistroUsuario" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input id="id_type_user" name="id_type_user" class="form-control" type="hidden" value="5">
                                    <input id="first_name_user" name="first_name_user" class="form-control" type="text" placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input id="last_name_user" name="last_name_user" class="form-control" type="text" placeholder="Apellidos" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input id="nick_user" name="nick_user" class="form-control" type="text" placeholder="Nombre de Agencia / Agente" required>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <select name="type_agent" id="type_agent" class="form-control" data-error="Selecciona un tipo de agente" required />
                                    <option value="">Selecciona un tipo </option>
                                    <option value="1">Sello </option>
                                    <option value="2">Booking</option>
                                    <option value="3">Agente cultural</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input id="mail_user" name="mail_user" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email" required>
                                </div>
                            </div>
                            <!-- <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input id="mail_user_2" name="mail_user_2" class="form-control" placeholder="Verificar Email" required>
                                </div>
                            </div> -->
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group position-relative">
                                    <input type="password" name="password" id="password" class="form-control form-control-lg no-b" placeholder="Contraseña" required>
                                    <i class='bx bxs-show icon-eye' id="togglePassword" style="position: absolute; cursor: pointer; right: 10px; top: 25px;"></i>
                                </div>
                            </div>
                            <!-- Campo de confirmación de contraseña -->
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group position-relative">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-lg no-b" placeholder="Confirmar contraseña" required>
                                    <i class='bx bxs-show icon-eye' id="toggleConfirmPassword" style="position: absolute; cursor: pointer; right: 10px; top: 25px;"></i>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="privecy-txt">
                                    <input type="checkbox" id="chb1" required>
                                    <label>
                                        Acepto los
                                        <a href="terminos-y-condiciones.php" target="_blank">Términos y condiciones.</a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="privecy-txt">
                                    <p><small>Para obtener más información acerca de cómo EchoMusic recopila, utiliza, comparte y protege tus datos personales, consulta la
                                            <a href="politica-de-privacidad.php" target="_blank">Política de Privacidad</a> de EchoMusic.</small> </p>
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