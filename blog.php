<?php  
include "model/models.php";
include "header.php";
 
 
?>

        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>BLOG</h2>
                    <ul>
                        <li> <a href="index.php"> Inicio </a> </li> 
                        <li class="active">BLOG</li> 
                    </ul>
                </div>
            </div> 
        </div>
        <!-- End Page Title Area -->            
 
        <!-- Blog Area -->
        <section class="home-blog-area ptb-70">
            <div class="container">
                <div class="section-title">
                    <span>Aprende</span>
                    <h2>Echotips</h2>                    
                </div>

                <div class="row">
                    
<?php

$img = array(
        'https://echomusic.cl/blog/wp-content/uploads/2023/06/como-planificar-tu-proximo-lanzamiento-1024x1024.jpg',
        'https://echomusic.cl/blog/wp-content/uploads/2023/06/LINE-UP-1024x1024.jpg',
        'https://echomusic.cl/blog/wp-content/uploads/2023/04/Como-crean-un-plan-de-marketing-musical-1024x683.jpg',
        );

$xml = new DomDocument();
$xml->load('https://echomusic.cl/blog/feed/');
$raiz = $xml->documentElement;
$entradas = $raiz->getElementsByTagName('item');                    
for($i=0;$i<3;$i++){
    $titulo = $entradas->item($i)->getElementsByTagName('title')->item(0)->nodeValue;
    $vinculo = $entradas->item($i)->getElementsByTagName('link')->item(0)->nodeValue; 
    $desc= $entradas->item($i)->getElementsByTagName('description')->item(0)->nodeValue; 
    $category= $entradas->item($i)->getElementsByTagName('category')->item(0)->nodeValue; 
    $fecha = $entradas->item($i)->getElementsByTagName('pubDate')->item(0)->nodeValue;
    $fecha_unix = strtotime($fecha);
    $fecha = strftime("%d/%m/%Y",$fecha_unix);
?>                        
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="<?php echo $vinculo;?>" target="_blank">
                                    <img src="<?php echo $img[$i];?>" class="imgEvent tamano-1" alt="blog"/> 
                                </a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        <?php echo $fecha;?>
                                    
                                        <a href="<?php echo $vinculo;?>" target="_blank"><?php echo $category;?></a>
                                    </li>
                                </ul>
                                
                                <a href="<?php echo $vinculo;?>" taget="_blank">
                                    <h3><?php echo substr($titulo, 0,55);?></h3>
                                </a>
                                <p><?php echo substr($desc,0,110);?> ...</p>
                                <div class="text-center">
                                    <a href="<?php echo $vinculo;?>" target="_blank" class="box-btn text-center">Leer más</a>
                                </div>
                                
                            </div>
                        </div>
                    </div> 

<?php                     
//    echo '<li><a href="'.$vinculo.'">'.$titulo.'</a> '.$fecha.'</li>';   
}
?>                    
                    
                    
<!--                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/avatars/13.jpg" alt="blog"/> 
                                </a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        20 April 2023
                                    </li>
                                    <li>
                                        <a href="#">Formación</a>
                                    </li>
                                </ul>
                                
                                <a href="blog-details.html">
                                    <h3>¿Qué es un Tiktok Live?</h3>
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>
                                <div class="text-center">
                                    <a href="#" class="box-btn text-center">Leer más</a>
                                </div>
                                
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="assets/images/avatars/13.jpg" alt="blog"/> 
                                </a>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        20 April 2023
                                    </li>
                                    <li>
                                        <a href="#">Formación</a>
                                    </li>
                                </ul>
                                
                                <a href="blog-details.html">
                                    <h3>¿Qué es un Tiktok Live?</h3>
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in fugit minima modi perspiciatis nam aspernatur porro</p>
                                <div class="text-center">
                                    <a href="#" class="box-btn text-center">Leer más</a>
                                </div>
                                
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="blog-btn text-center">
                    <a class="box-btn text-center" href="https://echomusic.cl/blog/" target="_blank">Ver más artículos</a> 
                </div>
            </div>
        </section>
        <!-- End Blog Area -->      
        
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