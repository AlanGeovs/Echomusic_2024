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

    <div class="modal" id="ModalBio">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Biografía </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p style="text-align: left;"><?php echo $biografia[0]["bio_user"]; ?></p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal" id="ModalEventos">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Eventos </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <h3 class="text-center">Próximos Eventos (<?php echo count($resultadosProxEventos); ?>)</h3>

                    <?php
                    for ($e = 0; $e < count($resultadosProxEventos); $e++) {
                    ?>
                        <div class="home-2-contact col-lg-12">
                            <div class="content">
                                <div class="row align-items-center choose-c justify-content-md-center">
                                    <!--img-->
                                    <div class="col-12 col-sm-4  choose-img text-center">
                                        <img class="responsiveEveArtista" src="https://echomusic.cl/images/events/<?php echo $resultadosProxEventos[$e]["img"]; ?>.jpg" alt="<?php echo ''; ?>" />


                                    </div>
                                    <!--Descripción-->
                                    <div class="col-12 col-sm-8" style="vertical-align: middle;">
                                        <ul>
                                            <li>
                                                <?php echo $resultadosProxEventos[$e]["name_event"]; ?>
                                            </li>
                                        </ul>

                                        <a class="textoCorto" href=" ">
                                            <h3><?php echo $resultadosProxEventos[$e]["name_event"]; ?> </h3>
                                        </a>


                                        <p style="font-size: .9em; color: grey; "><?php echo substr($resultadosProxEventos[$e]["desc_event"], 0, 220); ?> </p>


                                        <a href=" " class="box-btn">Ver evento</a>
                                    </div>
                                </div>
                                <!--fin del Row-->
                            </div>
                        </div>
                    <?php
                    } //termina el for 

                    //                            Termina else de Proximos Eventos     
                    if (empty($resultadosEventosPasa)) {
                        //                            echo 'no hay eventos pasados';

                    } else {
                    ?>
                        <!-- Eventos Pasados -->
                        <h3 class="text-center"> Eventos Pasados (<?php echo count($resultadosEventosPasa); ?>)</h3>

                        <div class="home-2-contact col-lg-12">
                            <div class="content">
                                <!--Diseño ANterior-->
                                <!--             <div class="row">
                    img
                    <div class="col-12 col-sm-6  choose-img">  
                        <img src="https://echomusic.cl/images/events/<?php echo $resultadosEventosPasa[$p]["img"]; ?>.jpg" alt="<?php echo ''; ?>" width="350px"/> 
                    </div>
                    Descripción
                    <div class="col-12 col-sm-6" style="vertical-align: middle;">
                        <ul>
                            <li>
                                <?php echo $resultadosEventosPasa[$p]["name_event"]; ?>                                                    
                            </li> 
                        </ul>  
                        <h3><?php echo $resultadosEventosPasa[$p]["name_event"]; ?> </h3>  
                        <p>Organizado: 
                            <?php echo $resultadosEventosPasa[$p]["organizer"]; ?>
                            <?php echo $resultadosEventosPasa[$p]["name_location"]; ?>
                            / <?php echo $resultadosEventosPasa[$p]["location"]; ?> </p>
                        <p><?php echo $resultadosEventosPasa[$p]["desc_event"]; ?> </p>

                    </div>
                </div> fin del Row-->

                                <!--Diseño Nuevvo-->
                                <div class="row">
                                    <div class="home-team-slider owl-carousel owl-theme">
                                        <?php
                                        for ($p = 0; $p < count($resultadosEventosPasa); $p++) {
                                        ?>
                                            <div class="single-team">
                                                <div class="team-img">
                                                    <img class="tamano-4" src="https://echomusic.cl/images/events/<?php echo $resultadosEventosPasa[$p]["img"]; ?>.jpg" alt="<?php echo ''; ?>" width="350px" />
                                                </div>

                                                <div class="content text-center">
                                                    <h6><?php echo $resultadosEventosPasa[$p]["name_event"]; ?> </h6>
                                                    <p style="font-size: 10px;">Organizado: <?php echo $resultadosEventosPasa[$p]["organizer"]; ?>
                                                        <?php echo $resultadosEventosPasa[$p]["name_location"]; ?>
                                                        / <?php echo $resultadosEventosPasa[$p]["location"]; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php

                    } ?>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>