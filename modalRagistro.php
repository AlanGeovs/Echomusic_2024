<?php
?>

    <!-- MODAL Tipo de Registro Usuarios  -->
                        <div class="modal" id="ModalTipodeRegistro">
                            <div class="modal-dialog">
                                <div class="modal-content"> 

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Selecciona el tipo de usuario</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body registroUsuario"> 
                                        <form id="formRegistroTipoUser"  name="formRegistroTipoUser" method="GET" action="seleccionaRegistroUsuario.php"> 
                                            <div class="row justify-content-center"> 
<!--                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="form-group"> 
                                                        <input type="radio" id="usuario" name="formRegistroTipoUser" value="usuario">
                                                        <label for="usuario">Usuario</label><br> 
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="form-group"> 
                                                        <input type="radio" id="artista" name="formRegistroTipoUser" value="artista">
                                                        <label for="artista">Artista</label><br>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="form-group"> 
                                                        <input type="radio" id="espacio" name="formRegistroTipoUser" value="espacio">
                                                        <label for="espacio">Espacio</label>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="form-group"> 
                                                        <input type="radio" id="agente" name="formRegistroTipoUser" value="agente">
                                                        <label for="agente">Agente</label>
                                                        
                                                    </div>
                                                </div>-->                                              
    <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="usuario" value="usuario" checked="">            
    <label class="list-group-item d-flex gap-3 rounded-3 py-3" for="usuario">
        <i class="bi bi-person-fill-add""  style="font-size: 1rem;  "></i>       
         Usuario 
      <span class="d-block small opacity-50">Compra entradas y sigue a tus artistas favoritos.</span>
    
      
    </label>

    <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="artista" value="artista">
    <label class="list-group-item d-flex gap-3 rounded-3 py-3" for="artista">
      <i class="bi bi-music-note-list""  style="font-size: 1rem;  "></i>
      Artista
      <span class="d-block small opacity-50">Crea tu perfil como Artista o Banda, registra eventos y busca financiamiento para tu proyecto.</span>
    </label>
    <!--Opción a dos renglones-->
<!--    <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="artista" value="artista">
    <label class="list-group-item rounded-3 py-3" for="artista">
      <i class="bi bi-music-note-list""  style="font-size: 1rem;  "></i>
      Artista
      <span class="d-block small opacity-50">Crea tu perfil como artista o banda, registra eventos y busca financiamiento de tu proyecto</span>
    </label>-->

    <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="espacio" value="espacio"  >
    <label class="list-group-item d-flex gap-3 rounded-3 py-3" for="espacio">
      <i class="bi bi-mic-fill""  style="font-size: 1rem;  "></i>
      Espacio
      <span class="d-block small opacity-50">Crea un espacio de difución para eventos musicales.</span>
    </label>    
    
    <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="agente" value="agente">
    <label class="list-group-item d-flex gap-3 rounded-3 py-3" for="agente">
      <i class="bi bi-person-workspace""  style="font-size: 1rem;  "></i>
      Agente
      <span class="d-block small opacity-50">Regístrate como manager de artistas y plublica eventos relevantes.</span>
    </label>

  </div>
                                                
                                                <div class="col-lg-12 col-sm-12 text-center">
                                                    <br>
                                                    <button type="submit" class="default-btn page-btn box-btn">
                                                        <i class="bi bi-check-square-fill""  style="font-size: 1rem;  "></i>   Registrarme
                                                    </button>
                                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </form>
                                   
<form id="formRegistroTipoUser2"  name="formRegistroTipoUser2" method="GET" action="seleccionaRegistroUsuario.php"> 
<!--    <div class="list-group">
        <label class="list-group-item d-flex gap-2">
            <input class="form-check-input flex-shrink-0" type="radio" name="listGroupRadios" id="listGroupRadios1" value="" checked="">
            <span>
                First radio
                <small class="d-block text-body-secondary">With support text underneath to add more detail</small>
            </span>
        </label>
        <label class="list-group-item d-flex gap-2">
            <input class="form-check-input flex-shrink-0" type="radio" name="listGroupRadios" id="listGroupRadios2" value="">
            <span>
                Second radio
                <small class="d-block text-body-secondary">Some other text goes here</small>
            </span>
        </label>
        <label class="list-group-item d-flex gap-2">
            <input class="form-check-input flex-shrink-0" type="radio" name="listGroupRadios" id="listGroupRadios3" value="">
            <span>
                Third radio
                <small class="d-block text-body-secondary">And we end with another snippet of text</small>
            </span>
        </label>
    </div>-->

<div class="list-group list-group-checkable d-grid gap-2 border-0">
<!--    <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="usuario" value="usuario" checked="">
    <label class="list-group-item rounded-3 py-3" for="usuario">
      Usuario
      <span class="d-block small opacity-50">With support text underneath to add more detail</span>
    </label>

    <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="artista" value="artista">
    <label class="list-group-item rounded-3 py-3" for="artista">
      Artista
      <span class="d-block small opacity-50">Some other text goes here</span>
    </label>

    <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="agente" value="agente">
    <label class="list-group-item rounded-3 py-3" for="agente">
      Agente
      <span class="d-block small opacity-50">And we end with another snippet of text</span>
    </label>

    <input class="list-group-item-check pe-none" type="radio" name="formRegistroTipoUser" id="espacio" value="espacio"  >
    <label class="list-group-item rounded-3 py-3" for="espacio">
      Espacio
      <span class="d-block small opacity-50">This option is disabled</span>
    </label>
  </div>-->
    
</form>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>                    
    <!-- FINAL  MODAL Tipo de Registro Usuarios  --> 