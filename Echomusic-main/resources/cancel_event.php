  <div class="inner">
    <h2>Cancelar Evento</h2>
    <h3>¿Estás seguro que deseas cancelar este evento?</h3>
    <div class="col-12">
      <p>Para cancelar este evento debes explicar tus motivos, éstos serán comunicados a la otra parte para poder asegurar una buena comunicación dentro de nuestro servicio.</p>
      <form action="" method="post">
        <textarea name="cancel_text" id="demo-message" maxlenght="150" rows="2" placeholder=""></textarea>
        <span class="text-danger"><strong class="alert"><?php if ( isset($cancelTextError)) { echo $cancelTextError;} ?></strong></span>
        <input type="hidden" name="id_event" id="id_event-cancelValue" value=""/>
        <ul class="actions fit">
          <li><input type="submit" value="Cancelar Evento" name="cancel_event" class="button primary fit" /></li>
        </ul>
      </form>
    </div>
    <a href="#" class="close">Close</a>
  </div>
