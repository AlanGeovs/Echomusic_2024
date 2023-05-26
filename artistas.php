<?php  
include "model/models.php";
include "header.php";
 
//Búsquedas de Eventos
if (isset($_GET["a"])) {
    $id=$_GET["a"];
    if (!preg_match('/[0-9]/', $id)) {
        exit();
    }
    $respuesta=Consultas::detallesArtistas($id);
}
 
$biografia=Consultas::bioArtistas($id);
?>

        <!-- Detalle de Perfil de Artista  -->
        <section class="feature-area bg-color ptb-10">
            <div class="container">
                <div class="row align-items-center ">

                    <div class="col-lg-12  ">
                        <p>Inicio / Artistas / <?php echo $respuesta[0]["nick_user"]; ?></p>
                        <br> 
                    </div>
                    
                    <!--Perfil-->
                    <div class="col-lg-5 col-sm-5 item dev design">
                        <div class="single-case text-center">
                            <div class=" ">
                                <a href="#">   
                                    <img src="https://echomusic.cl/images/avatars/<?php echo $respuesta[0]["id_user"]; ?>.jpg" alt="descatado" /> 
                                </a>
                            </div> 
                            
                             <div class="feature-tittle">
                                <h2> <?php echo $respuesta[0]["nick_user"]; ?></h2>
                                <span style="font-size: 20px">Seguidores 1 Seguidos 0 Publicaciones 2</span> 
                                
                                <h3>Biografía</h3>
                                <p><?php echo $biografia[0]["bio_user"]; ?></p>
                               </div> 
                        </div>
                        
                        
                        <!--Playlist-->
                        <div>
                            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DWSpF87bP6JSF?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>                            
                        </div>
                    </div>                    
                    
                    
                    <!--Eventos-->
                    <div class=" col-lg-7">
                        
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <h2>Eventos</h2>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="feature-tittle"> 
                                    <img src="assets/images/eventos.jpg" alt=""/>
                                </div> 
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="feature-tittle"> 
                                    <img src="assets/images/eventos.jpg" alt=""/>
                                </div> 
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="feature-tittle"> 
                                    <img src="assets/images/eventos.jpg" alt=""/>
                                </div> 
                            </div> 

                        </div> 
                        
                        
                        
 
                    </div>

                    <!--<div class="">-->

                        
                       
                                                
                    <!--</div>-->
                </div>
                
                
                
                <!--Videos Primera Versión-->
                <section class="choose-area ptb-100">
                    <div class="container">
                        <div class="row align-items-center justify-content-md-center"> 
<!--                            Principa-->
                            <div class="col-lg-10 col-sm-10 item dev design">
                                <div class="single-case text-center">
                                    <div class="" >
                                        <iframe width="100%" height="430px" src="https://www.youtube.com/embed/pjxa_BEZOHU" title="Dua Lipa, Calvin Harris, Coldplay, Martin Garrix &amp; Kygo, The Chainsmokers Style - Feeling Me" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    </div> 

                                </div> 
                            </div>                    

<!--                            Secundarios-->
<!--                            <div class=" col-lg-5">                        
                                <div class="row text-center"> 
                                    <div class="col-12 col-sm-12">
                                        <div class="feature-tittle"> 
                                            <iframe width="70%" height="200px" src="https://www.youtube.com/embed/2JVAUzx1BsE" title="Korolova - Live @ Cordoba, Argentina / Melodic Techno &amp; Progressive House Mix" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        </div> 
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="feature-tittle"> 
                                            <iframe width="70%" height="200px" src="https://www.youtube.com/embed/sGnjY5IgKP0" title="TOMORROWLAND 2020 🔥 La Mejor Música Electrónica 🔥 Lo Mas Nuevo - Electronica Mix" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        </div> 
                                    </div> 

                                </div> 




                            </div>-->

                            <div class="">




                            <!--Row-->
                        </div>

                    <!--</div>  Container--> 

                </section>
            
            
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
        
        

        <!-- Sección flotante ****************************************** --> 
<!--        <section class="bg-color ptb-10">
            <div class="container bg-color pb-70  ">
                <div class="row  align-items-center choose-c justify-content-md-center">

                    <div class="section-title ">

                        <h2>Videos</h2>

                    </div> 

                    <div class="home-2-contact col-lg-10">                       
                        <div class="content"> 
                            <div class="row">
                                img
                                <div class="col-12 col-sm-6  choose-img">  
                                    <img src="assets/images/avatars/13.jpg" alt="choose" width="350px" />

                                </div>
                                Descripción
                                <div class="col-12 col-sm-6" style="vertical-align: middle;">
                                    <ul>
                                        <li>
                                            EP Sinceridad 
                                        </li> 
                                    </ul>

                                    <a href=" ">
                                        <h3>Cari Monteci</h3>
                                    </a>

                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>

                                    <a href=" " class="box-btn">Patrocinar</a>
                                </div>
                            </div>
                            fin del Row
                        </div>
                    </div>
                </div>
            </div>

        </section>-->
        <!-- End Video Area ******************************************** -->    
        
        <!-- Video Area --> 
        <section class="bg-color ptb-10">
            <div class="container bg-color pb-70  ">
                <div class="row  align-items-center choose-c justify-content-md-center">

<!--                    <div class="section-title ">

                        <h2>Videos</h2>

                    </div> -->

                    
                    
                    
                                           

                        <!--Nuevo Código-->
                        <!-- Destacados Carrusel Area -->
                        <section class="content home-team-area  "> 
                            <div class="row"> 
                                

                                <div class="home-team-slider owl-carousel owl-theme">

                                    
                                    <div class="single-team">
                                        <div class="team-img">  
                                            <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" > <img src="assets/images/case/play.jpg" alt="descatado" /></a>
                                            
                                        </div>
 
                                    </div>  
                                    
                                    <div class="single-team">
                                        <div class="team-img">  
                                            <a href="#"> <img src="assets/images/case/play.jpg" alt="descatado" /></a>
                                            
                                        </div>
 
                                    </div>  
                                    
                                    <div class="single-team">
                                        <div class="team-img">  
                                            <a href="#"> <img src="assets/images/case/play.jpg" alt="descatado" /></a>
                                            
                                        </div>
 
                                    </div>  
                                    
                                    <div class="single-team">
                                        <div class="team-img">  
                                            <a href="#"> <img src="assets/images/case/play.jpg" alt="descatado" /></a>
                                            
                                        </div>
 
                                    </div>  
                                    
                                    <div class="single-team">
                                        <div class="team-img">  
                                            <a href="#"> <img src="assets/images/case/play.jpg" alt="descatado" /></a>
                                            
                                        </div>
 
                                    </div>  
                                     
                                </div>
                            </div>
                        </section>
                        <!-- End Destacados Carrusel Area -->                                                        

 
                </div>
            </div>

        </section>
        <!-- End Video Area -->         
        
        
      

        <!-- Team Area -->
<!--        <section class="home-team-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <span>Team Members</span>
                    <h2>People Who are Behind the Achievements</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse.</p>
                </div>

                <div class="home-team-slider owl-carousel owl-theme">
                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t1.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>John Smith</h3>
                            <p>Full Stack Developer</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t2.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Evana Doe</h3>
                            <p>Web Developer</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t3.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Bread Mc</h3>
                            <p>IT Consulting</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t4.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Maria Fread</h3>
                            <p>UI/UX Designer</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t1.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>John Smith</h3>
                            <p>Full Stack Developer</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t2.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Evana Doe</h3>
                            <p>Web Developer</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t3.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Bread Mc</h3>
                            <p>IT Consulting</p>
                        </div>
                    </div>

                    <div class="single-team">
                        <div class="team-img">
                            <img src="assets/images/team/t4.jpg" alt="team" />
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="bx bxs-envelope"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content text-center">
                            <h3>Maria Fread</h3>
                            <p>UI/UX Designer</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        <!-- End Team Area -->

        
        <!-- Crowdfunding 1-->
<!--        <section class="home-blog-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <span>Blog Post</span>
                    <h2>Crowdfunding</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A facilis vel consequatur tempora atque blanditiis exercitationem incidunt, alias corporis quam assumenda dicta.</p>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6"></div>
                    <div class="col-lg-6 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="#">
                                    <img src="assets/images/avatars/13.jpg" alt=""/> 
                                </a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        EP Sinceridad 
                                    </li> 
                                </ul>
                                
                                <a href=" ">
                                    <h3>Cari Monteci</h3>
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>
                                
                                <a href=" " class="box-btn">Patrocinar</a>
                            </div>
                        </div>
                    </div> 
 
                </div> 
            </div>
        </section>-->
        <!-- End Blog Area -->

        
                <!-- Crowdfunding 2 -->
        <section class="pricing-area pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center choose-c justify-content-md-center">
                    
                    <div class="section-title ">
                        
                        <h2>Crowdfunding</h2>
                        
                    </div> 

                    <div class="home-2-contact col-lg-8">                       
                        <div class="content"> 
                            <div class="row">
                                <!--img-->
                                <div class="col-12 col-sm-6  choose-img">  
                                    <img src="assets/images/avatars/13.jpg" alt="choose" width="350px" />

                                </div>
                                <!--Descripción-->
                                <div class="col-12 col-sm-6" style="vertical-align: middle;">
                                    <ul>
                                        <li>
                                            EP Sinceridad 
                                        </li> 
                                    </ul>

                                    <a href=" ">
                                        <h3>Cari Monteci</h3>
                                    </a>

                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>

                                    <a href=" " class="box-btn">Patrocinar</a>
                                </div>
                            </div>
                            <!--fin del Row-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Technology Area -->
        
        

        
        
        <!--  Tarifas Area -->
        <section class="home-blog-area bg-color ptb-100">
            <div class="container">
                <div class="section-title">
                    <!--<span>What We Offer</span>-->
                    <h2>Tarifas</h2>
                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ipsum suspendisse.</p>-->
                </div>
                
                <!--Tarifas formato blog-->
                
                 
                
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/bg/fondo-precios-1-morado-min.jpg" alt=""/> 
                                </a>
                            </div>

                            <!--<div class="content single-pricing">--> 
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <h3>$5.000</h3>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Duración 1 hr.
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                               Backline  
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Refuerzo Sonoro
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Sonidista
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Nº de Músicos
                                            </li> 
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Contratar
                                        </a> 
                                
                            <!--</div>-->
                        </div>
                    </div> 
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/bg/fondo-precios-2-azuljpg-min.jpg" alt=""/> 
                                </a>
                            </div>

                            <!--<div class="content single-pricing">--> 
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <h3>$5.000</h3>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Duración 1 hr.
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                               Backline  
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Refuerzo Sonoro
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Sonidista
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Nº de Músicos
                                            </li> 
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Contratar
                                        </a> 
                                
                            <!--</div>-->
                        </div>
                    </div> 
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/bg/fondo-precios-3-naranja-min.jpg" alt=""/> 
                                </a>
                            </div>

                            <!--<div class="content single-pricing">--> 
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <h3>$5.000</h3>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Duración 1 hr.
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                               Backline  
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Refuerzo Sonoro
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Sonidista
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Nº de Músicos
                                            </li> 
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Contratar
                                        </a> 
                                
                            <!--</div>-->
                        </div>
                    </div> 
                </div>
                
                <!--Tarifas formato redondeado-->
                <div class="tab quote-list-tab">
<!--                    <ul class="tabs">
                        <li>
                            <a href="#">
                                Monthly
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Yearly
                            </a>
                        </li>
                    </ul>-->
<!--                    <div class="tab_content">
                        <div class="tabs_item">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <span>$5.000</span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Duración 1 hr.
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                               Backline  
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Refuerzo Sonoro
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Sonidista
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Nº de Músicos
                                            </li> 
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Contratar
                                        </a>
                                    </div>
                                </div> 
                                
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <span>$5.000</span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Duración 1 hr.
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                               Backline  
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Refuerzo Sonoro
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Sonidista
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Nº de Músicos
                                            </li> 
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Contratar
                                        </a>
                                    </div>
                                </div> 
                                
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Tarifa S</h3>
                                            <p>1 hora de show</p>
                                        </div>
                                        <span>$5.000</span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Duración 1 hr.
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                               Backline  
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Refuerzo Sonoro
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Sonidista
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Nº de Músicos
                                            </li> 
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Contratar
                                        </a>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        
                        <div class="tabs_item">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Basic</h3>
                                            <p>Build A Website</p>
                                        </div>
                                        <span>$39 <sub>/Y</sub></span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                10GB Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                50GB Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                10 Free Sub-Domains
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                10GB Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                50GB Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                10 Free Sub-Domains
                                            </li>
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Get Started
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Standard</h3>
                                            <p>Build A Website</p>
                                        </div>
                                        <span>$79 <sub>/Y</sub></span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                80GB Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                90GB Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                10 Free Sub-Domains
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                70GB Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                50GB Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Sub-Domains
                                            </li>
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Get Started
                                        </a>
                                        <strong class="popular">Popular</strong>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 offset-sm-3 offset-lg-0">
                                    <div class="single-pricing">
                                        <div class="pricing-top-heading">
                                            <h3>Premium</h3>
                                            <p>Build a website</p>
                                        </div>
                                        <span>$99 <sub>/Y</sub></span>
                                        <ul>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Sub-Domains
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Storage Space
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Bandwidth
                                            </li>
                                            <li>
                                                <i class="bx bx-badge-check"></i>
                                                Unlimited Domains
                                            </li>
                                        </ul>
                                        <a class="box-btn" href="shared-hosting.html">
                                            Get Started
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>-->
                </div>
                
                 
<!-- <div class="home-2-contact col-lg-8">                       
                        <div class="content"> 
                            <div class="row">-->
                <div class="home-2-contact justify-content-md-center text-center">            
                    <div class="content ">
                        <div class="row">
                            <div class="col-12 col-sm-6 ">
                                <br>
                                <h3>¿Necesitas una tarifa a convenir?</h3>
                                <a href="" class="box-btn">Solicitala aquí</a>
                            </div> 
                            <div class="col-12 col-sm-6 ">
                                <br>
                                <h3>Descarga aqui </h3>
                                <a href="" class="box-btn">Ficha Tecnica</a>
                                <a href="" class="box-btn">Dossier</a>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        </section>
        <!-- End Tarifas Area -->        
 
        
        
     

 
        <!-- Footer Area -->
        <footer class="footer-area pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="content">
                            <div class="logo text-center align-items-center" style='vertical-align: middle;'>     
                                <!--<a href="index.html"><img src="assets/images/logo/echimusic-isotipo-blanco-min.png" alt="" width="90px"/></a>-->   
                                <img src="assets/images/Corfo-proyectoapoyadopor-gob-chile-min.png" alt="" width="300px" /> &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <img src="assets/images/logo/3ie-logo-blanco.png" alt="" width="110px"/>
                            </div> 
                           <!-- <div class="subscribe">
                                <h4>Suscríbete a nuestro Newsletter</h4>
                                <form class="newsletter-form" data-toggle="validator">
                                    <input type="email" id="emails" class="form-control" placeholder="Your Email" name="EMAIL" required autocomplete="off">

                                    <button class="box-btn" type="submit">
                                        Subscribirme
                                    </button>

                                    <div id="validator-newsletter" class="form-result"></div>
                                </form>
                            </div>-->

<!--                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook' ></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter' ></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram' ></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest' ></i></a>
                                </li>
                            </ul>-->
                        </div>
                    </div>
<!--                    <div class="col-lg-3 col-md-6">
                        <div class="content ml-15">
                            <h3>Servicios</h3>
                            <ul class="footer-list">
                                <li><a href="#">Perfil de Artistas</a></li>
                                <li><a href="#">Ticketing</a></li>
                                <li><a href="#">Crowdfunding</a></li>
                                <li><a href="#">Marketplace de artistas</a></li> 
                            </ul>
                        </div>
                    </div>-->
                    <div class="col-lg-3 col-md-6">
                        <div class="content"> 
                            
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Open modal
                            </button>

                                    
                                    
                            <h3>Servicios</h3>
                            <ul class="footer-list"> 
                                <li><a href="#">Ticketing</a></li>
                                <li><a href="#">Crowdfunding</a></li>
                                <li><a href="#">Marketplace de artistas</a></li> 
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="content contacts">
                            <h3 class="ml-40">Contacto</h3>
                            <ul class="footer-list foot-social">
                                <li><a href="tel:56958049159"><i class="bx bx-mobile-alt"></i>+ 56 9 58049159</a></li> 
                                <li><a href="mailto:contacto@echomusic.cl"><i class="bx bxs-envelope"></i> contacto@echomusic.cl</a></li> 
                                <li><i class="bx bxs-map"></i> Av. Del Valle Norte 937, oficina 253, Huechuraba, Santiago, RM.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Newsletter -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6"> 
                    </div> 
                    
                    <div class="col-lg-6 col-md-6"> 
                        <div class="content">
                            <div class="subscribe text-center ">
                                <h4>Suscríbete a nuestro Newsletter</h4>
                                <form class="newsletter-form" data-toggle="validator">
                                    <input type="email" id="emails" class="form-control" placeholder="Tu Email" name="EMAIL" required autocomplete="off">

                                    <button class="box-btn" type="submit">
                                        Subscribirme
                                    </button>

                                    <div id="validator-newsletter" class="form-result"></div>
                                </form>
                            </div>

                            <ul class="social text-center">
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-facebook' ></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-twitter' ></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-instagram' ></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class='bx bxl-pinterest' ></i></a>
                                </li>
                            </ul>  
                        </div> 
                    </div>

                    <div class="col-lg-3 col-md-6"> 
                    </div>
                </div>
            </div>
            <div class="copy-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="menu">
                                <li><a href="#">Inicio</a></li>
                                <li><a href="#">Nosotros</a></li>
                                <li><a href="#">FAQ's</a></li>
                                 <li><a href="#">Política de Privacidad</a></li>
                                <li><a href="#">Términos y Condiciones</a></li> 
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <p class="right">
                                Copyright @2023 EchoMusic | By
                                <a href="https://www.genesysapp.com/" target="_blank">GenesysApp.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer Area -->
        
        
        
        
        <!--Modal area-->
        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Video </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      <iframe width="450" height="300" src="https://www.youtube.com/embed/xXfyxX7tyBM" title="Group Therapy 523 with Above &amp; Beyond and Maor Levi" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Start Go Top Area -->
        <div class="go-top">
            <i class='bx bx-chevrons-up'></i>
            <i class='bx bx-chevrons-up'></i>
        </div>
        <!-- End Go Top Area -->
        
  


        <!-- MeanMenu Min JS -->
        <script src="assets/js/meanmenu.min.js"></script>
        <!-- Magnific Popup Min JS -->
        <script src="assets/js/magnific-popup.min.js"></script> 
        <!-- Wow Min js -->
        <script src="assets/js/wow.min.js"></script>
        <!-- Isotope MinJs -->
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <!-- Form Ajaxchimp Min JS -->
        <script src="assets/js/ajaxchimp.min.js"></script>
        <!-- Form Validator Js  -->
        <script src="assets/js/form-validator.min.js"></script>
        <!-- Contact Form Min Js -->
        <script src="assets/js/contact-form-script.js"></script>
        <!-- Main js -->
        <script src="assets/js/main.js"></script>
    
        

        <!-- Owl carasol Min Js -->
        <script src="assets/js/owl.carousel.min.js"></script>        
        <!--Script para OWL  
        Ver demos: https://owlcarousel2.github.io/OwlCarousel2/demos/demos.html
        -->
        <script>           
            
            $(document).ready(function(){
              $('.owl-carousel').owlCarousel({
                                items:1,
                                merge:true,
                                loop:true,
                                margin:10,
                                video:true,
                                videoWidth: true, // Default false; Type: Boolean/Number
                                videoHeight: true, // Default false; Type: Boolean/Number
                                lazyLoad:true,
                                center:true,
                                responsive:{
                                    480:{
                                        items:2
                                    },
                                    600:{
                                        items:4
                                    }
                                }
                            });
            });            
            
               
        </script>  
               
    </body>
</html>