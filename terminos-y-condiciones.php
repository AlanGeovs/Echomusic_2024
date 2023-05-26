<?php  
include "model/models.php";
include "header.php";
 
 
?>

    
 


        <!-- Detalle de Evento SetUp  -->
        <section class="feature-area bg-color ptb-100">
            <div class="container">
                <div class="row align-items-center ">

                    <div class="col-lg-12  ">                        
                        <p>Inicio / Términos y Condiciones</p>
                        <br> 
                    </div>
<!--                    <div class="col-lg-6 col-sm-6 item dev design">
                        <div class="single-case">
                             Carousel Start 
                            <div id="carouselsliderdemo" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://echomusic.cl/images/events/<?php echo $respuesta[0]["img"]; ?>.jpg" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/images/avatars/echo-2.jpg" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/images/avatars/echo-3.jpg" class="d-block w-100">
                                    </div>
                                </div>
                                 Indicator start 
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselsliderdemo" class="active img-thumbnail"
                                            data-bs-slide-to="0">
                                        <img src="https://echomusic.cl/images/events/<?php echo $respuesta[0]["img"]; ?>.jpg" alt="" class="d-block w-100">
                                    </button>
                                    <button type="button" data-bs-target="#carouselsliderdemo" class="img-thumbnail" data-bs-slide-to="1">
                                        <img src="assets/images/avatars/echo-2.jpg" alt="" class="d-block w-100">
                                    </button>
                                    <button type="button" data-bs-target="#carouselsliderdemo" class="img-thumbnail" data-bs-slide-to="2">
                                        <img src="assets/images/avatars/echo-3.jpg" alt="" class="d-block w-100">
                                    </button>
                                </div>
                                 Indicator Close 
                            </div>
                             Carousel Close   
                        </div>         
                    </div>                    
                    -->
                    <div class=" col-lg-6">
                        
                        <div class="row">
                            <div class="col-12 col-sm-12">
<!--                                <div class="feature-tittle">
                                <h2> <?php echo $respuesta[0]["name_event"]; ?> </h2>
                                <span style="font-size: 20px"><?php echo $diaSemana.' '.$dia.' de '.$mes.', '.$anio.' | '.$hora.':'.$minutos.' hrs'; ?>  </span>
                                <span style="font-size: 15px">Evento presencial </span> 
                                 <br>
                                <span style="font-size: 12px"> Ciudad	<?php echo $respuestaCiudadRegion[0]["name_city"]; ?> / Región	<?php echo $respuestaCiudadRegion[0]["name_region"]; ?></span><br>

                                <span style="font-size: 12px">Lugar:	<?php echo $respuesta[0]["name_location"]; ?>,	<?php echo $respuesta[0]["location"]; ?></span>
                                
                                <h3>Descripción del evento</h3>
                                <p><?php echo $respuesta[0]["desc_event"]; ?></p>
                                </div> -->
                            </div>
                            
                            
                            
                            
                            
                             
                            <div class="col-12 col-sm-6 text-center"> 
                                
                                    
                                                               
                            </div>
                        </div> 
                        
                        
                        
 
                    </div>

                    <!--<div class="">-->

                        
                       
                                                
                    <!--</div>-->
                </div>
            </div>  <!--Container--> 
            
            
            
            <!--Divisione smúltiples-->
<!--            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        Level 1: .col-sm-3
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-8 col-sm-6">
                                Level 2: .col-8 .col-sm-6
                            </div>
                            <div class="col-4 col-sm-6">
                                Level 2: .col-4 .col-sm-6
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->

 
            
            
        </section>
        <!-- End Destacados - Características  -->        
        
        
        <section class="home-case ptb-100">
            <div class="container">
                <div class="section-title">
                    <!--<span>Descubre</span>-->
                    <!--<h2>Conoce todo lo que EchoMusic tiene para ti</h2>-->
                    <h2>Términos y Condiciones</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse.</p>
                </div>

               


           >

                
            </div>
        </section>
        <!-- End Case  Eventos Artistas Proyectos  Espacios  --> 

       
        
 

        
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
                                <a href="#" class="box-btn text-center">CREA TU EVENTO</a> 
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