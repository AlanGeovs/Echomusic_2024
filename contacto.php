<?php
include "model/models.php";
include "header.php";


?>

<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>CONTACTO</h2>
            <ul>
                <li> <a href="index.php"> Inicio </a> </li>
                <li class="active">CONTACTO</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->



<!-- Home Contacto Area -->
<section class="home-contact-area   ptb-100">
    <div class="container">
        <div class="section-title">
            <span>Escríbenos</span>
            <h2>Déjanos tu mensaje, queremos ayudarte</h2>

        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="contact-img">
                    <img src="assets/images/bg/echomusic-isostipo-rock-acustica-1.png" alt="contacto" />
                </div>
            </div>

            <div class="col-lg-6 col-md-6">



                <div class="content">

                    <!-- <form id="contratarTarifa" method="post" enctype="multipart/form-data">
                                    <input type="hidden" id="id_plan" name="id_plan" value="2875">
                                    <input type="hidden" id="value_plan_event" name="value_plan_event" value="30000">
                                    <input type="hidden" id="id_name_plan" name="id_name_plan" value="1">
                                    
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="evento">Evento</label>
                                                <input type="text" class="form-control" id="name_event" name="name_event" placeholder="Nombre del Evento" required="">
                                            </div>
                                        </div>
                                    </div> -->

                    <form id="contacto" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="fname_request" id="fname_request" class="form-control" required data-error="Ingresa tu nombre" placeholder="Nombre" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="lname_request" id="lname_request" class="form-control" required data-error="Ingresa tus apellidos" placeholder="Apellidos" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="subject_request" id="subject_request" class="form-control" required data-error="Asunto" placeholder="Asunto" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="company_request" id="company_request" class="form-control" required data-error="Empresa" placeholder="Empresa/Organización" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="email" name="email_request" id="email_request" class="form-control" required data-error="Escribe tu email" placeholder="Email" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="phone_request" id="phone_request" required data-error="Ingresa tu número celular" class="form-control" placeholder="Número celular" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>



                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <textarea name="message_request" class="form-control" id="message_request" cols="30" rows="5" required data-error="Deja tu mensaje" placeholder="Tu mensaje"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn page-btn box-btn">
                                    Enviar
                                </button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->


<!-- CTA -->
<section class="home-cta-2-morado pt-100 pb-70">
    <div class="container">


        <div class="row">
            <div class="col-lg-2 col-sm-2"></div>

            <div class="col-lg-5 col-sm-5">
                <div class="section-title">
                    <h2>¿Eres artista, productora o espacio de difusión?</h2>
                </div>
            </div>

            <div class="col-lg-3 col-sm-3" style="vertical-align: middle; ">
                <div class="text-center">
                    <div class="nav-btn">
                        <br>
                        <a type="button" class="box-btn text-center" data-bs-toggle="modal" data-bs-target="#ModalTipodeRegistro">
                            <i class="bx bxs-log-out"></i> Crea tu perfil</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2"></div>
        </div>
    </div>
</section>
<!-- End CTA -->




<!--Footer-->
<?php
include 'footer.php';
?>