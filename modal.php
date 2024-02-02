    <!--Modal area-->

    <!-- Modal para contratar artistas -->

    <!-- Modal  Tarifa a convenir-->
    <div class="modal fade" id="contratarArtistaModal" tabindex="-1" aria-labelledby="contratarArtistaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contratarArtistaModalLabel">Contratar Artista</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formContratarArtista">
                        <div class="mb-3">
                            <label for="nombre-artista" class="col-form-label">Nombre del Artista:</label>
                            <input type="text" class="form-control" id="nombre-artista" value="<?php echo $respuesta[0]['nick_user']; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="asunto" class="col-form-label">Asunto:</label>
                            <input type="text" class="form-control" id="asunto" placeholder="Ej. Cotización evento de cumpleaños">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" placeholder="Describe los detalles de tu evento, lugar y tiempo requerido"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="enviarFormulario()">Enviar Solicitud</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Tarifa  1 -->
    <div class="modal fade" id="contratarTarifaModal" tabindex="-1" aria-labelledby="contratarTarifaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contratarTarifaModalLabel">Contratar Artista</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre-artista" class="col-form-label">Nombre del Artista:</label>
                            <input type="text" class="form-control" id="nombre-artista" value="<?php echo $respuesta[0]['nick_user']; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="asunto" class="col-form-label">Incluye:</label>
                            <!-- <input type="text" class="form-control" id="asunto" placeholder="Ej. Cotización evento de cumpleaños"> -->
                            Duración <?php echo $tarifasArtista[$t]["duration_minutes"]; ?> minutos | Backline <?php echo $tarifasArtista[$t]["backline"]; ?> | Ingeniero de Sonido <?php echo $tarifasArtista[$t]["sound_engineer"]; ?>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="asunto" class="col-form-label">Asunto:</label>
                             <input type="text" class="form-control" id="asunto" placeholder="Ej. Cotización evento de cumpleaños">
                </div> -->
                        <div class="mb-3">
                            <label for="descripcion" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" placeholder="Describe los detalles de tu evento, lugar y tiempo requerido"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Enviar Solicitud</button>
                </div>
            </div>
        </div>
    </div>


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

                                <!--Diseño Nuevvo-->
                                <div class="container">
                                    <div class="row">
                                        <?php
                                        for ($p = 0; $p < count($resultadosEventosPasa); $p++) {
                                        ?>
                                            <div class="col-md-6">
                                                <div class="card" style="width: 18rem;">
                                                    <img class="card-img-top" src="https://echomusic.cl/images/events/<?php echo $resultadosEventosPasa[$p]["img"]; ?>.jpg" alt="<?php echo ''; ?>">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $resultadosEventosPasa[$p]["name_event"]; ?></h5>
                                                        <p class="card-text">Organizado: <?php echo $resultadosEventosPasa[$p]["organizer"]; ?>
                                                            <?php echo $resultadosEventosPasa[$p]["name_location"]; ?>
                                                            / <?php echo $resultadosEventosPasa[$p]["location"]; ?></p>
                                                    </div>
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