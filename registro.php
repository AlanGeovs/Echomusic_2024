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


                <li class="active">Registro</li>
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
                        <h2>Selecciona el tipo de usuario</h2>
                        <p>Para crear una cuenta EchoMusic</p>
                    </div>
                    <!-- <form action="dashboard/includes/registrarUsuario_db.php" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-center"> -->
                    <!-- <div class="col-lg-4 col-md-4 col-sm-12">
                                        <a class="box-btn google" href="#" target="_blank">
                                            <i class='bx bxl-google-plus'></i> Google
                                        </a>
                                    </div> -->
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
                    <!-- <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input id="userName" name="userName"  class="form-control" type="text"  placeholder="Nombre" required>
                                        </div>
                                    </div> -->
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
                    <!-- <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input id="correo" name="correo" class="form-control"   placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input id="password" name="password" class="form-control" type="text"   placeholder="Contraseña" required>
                                        </div>
                                    </div> -->
                    <!--                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="password" placeholder="Verifica tu Contraseña">
                                        </div>
                                    </div>-->
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                    <!-- <div class="privecy-txt">
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
                            </form> -->

                    <form id="formRegistroTipoUser" name="formRegistroTipoUser" method="GET" action="seleccionaRegistroUsuario.php">
                        <div class="row justify-content-center">
                            <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="usuario" value="usuario" checked="">
                            <label class="list-group-item d-flex gap-3 rounded-3 py-3" for="usuario">
                                <i class="bi bi-person-fill-add""  style=" font-size: 1rem; "></i>       
         Usuario 
      <span class=" d-block small opacity-50">Compra entradas y sigue a tus artistas favoritos.</span>


                            </label>

                            <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="artista" value="artista">
                            <label class="list-group-item d-flex gap-3 rounded-3 py-3" for="artista">
                                <i class="bi bi-music-note-list""  style=" font-size: 1rem; "></i>
      Artista
      <span class=" d-block small opacity-50">Crea tu perfil como Artista o Banda, registra eventos y busca financiamiento para tu proyecto.</span>
                            </label>

                            <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="espacio" value="espacio">
                            <label class="list-group-item d-flex gap-3 rounded-3 py-3" for="espacio">
                                <i class="bi bi-mic-fill""  style=" font-size: 1rem; "></i>
      Espacio
      <span class=" d-block small opacity-50">Crea un espacio de difución para eventos musicales.</span>
                            </label>

                            <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="agente" value="agente">
                            <label class="list-group-item d-flex gap-3 rounded-3 py-3" for="agente">
                                <i class="bi bi-person-workspace""  style=" font-size: 1rem; "></i>
      Agente
      <span class=" d-block small opacity-50">Regístrate como manager de artistas y plublica eventos relevantes.</span>
                            </label>

                        </div>

                        <div class="col-lg-12 col-sm-12 text-center">
                            <br>
                            <button type="submit" class="default-btn page-btn box-btn">
                                <i class="bi bi-check-square-fill""  style=" font-size: 1rem; "></i>   Registrarme
                                                    </button>
                                                    <div id=" msgSubmit" class="h3 text-center hidden">
                        </div>
                        <div class="clearfix"></div>
                </div>
            </div>
            </form>

            <form id="formRegistroTipoUser2" name="formRegistroTipoUser2" method="GET" action="seleccionaRegistroUsuario.php">
                <div class="list-group list-group-checkable d-grid gap-2 border-0"></div>
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