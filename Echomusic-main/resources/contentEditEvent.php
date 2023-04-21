<div class="wrapper dash">
  <div class="inner">
    <div class="" >
      <h1 class="major">Editar </h1>
      <div id="publishForm" class="">
        <form action="" method="POST" enctype="multipart/form-data">
          <div id="event_public_form">
            <p>Modifica los campos que necesites y luego presiona en <strong>"Guardar Cambios"</strong></br>
            El artista será notificado por correo acerca de estos cambios.</p>
            <div class="row gtr-uniform">
              <div class="col-6 col-12-small">
                <label for="demo-name">Nombre del Evento</label>
                <input type="text" name="nameEvent" id="demo-nameEvent" value="<?php if(isset($arrayDataEvent)){ echo $arrayDataEvent['name_event']; } ?>" />
                <span class="text-danger"><strong class="alert"><?php if ( isset($nameEventError)) { echo $nameEventError;}; ?></strong></span>
              </div>
              <div class="col-6 col-12-small">
                <label for="demo-region">Región</label>
                <select name="regionEvent" id="demo-region" disabled>
                  <?php
                  foreach($arrayRegions as $regions)
                      {
                        if($arrayDataEvent['id_region'] == $regions['id_region']){ $selected = "selected";} else {$selected = "";}
                        echo '<option value="'.$regions['id_region'].'" '.$selected.'>'.$regions['name_region'].'</option>';
                        unset($selected);
                      }
                  ?>
                </select>
              </div>
              <div class="col-6 col-12-small">
                <label for="demo-city">Comuna</label>
                <select  name="cityEvent" id="size">
                  <?php
                  foreach($arrayCities as $cities)
                      {
                        if($arrayDataEvent['id_city'] == $cities['id_city']){ $selected = "selected";} else {$selected = "";}
                        echo '<option value="'.$cities['id_city'].'" '.$selected.'>'.$cities['name_city'].'</option>';
                        unset($selected);
                      }
                  ?>
                </select>
              </div>
              <div class="col-6 col-12-small">
                <label for="demo-location">Dirección del Evento</label>
                <input type="text" name="locationEvent" id="demo-nameLocation" value="<?php if(isset($arrayDataEvent)){ echo $arrayDataEvent['location']; } ?>" />
                <span class="text-danger"><strong class="alert"><?php if ( isset($locationEventError)) { echo $locationEventError;} ?></strong></span>
              </div>
              <div class="col-6 col-12-small">
                <label for="demo-time">Fecha y Hora</label>
                  <input name="dateEvent" value="<?php if(isset($arrayDataEvent)){ echo $arrayDataEvent['date_event']; } ?>" id="datetimepicker" type="text" >
                  <span class="text-danger"><strong class="alert"><?php if ( isset($dateEventError)) { echo $dateEventError;} ?></strong></span>
              </div>
              <div class="col-12 col-12-small">
                <label for="demo-desc">Descripción del Evento</label>
                <textarea name="eventDesc" value="" rows="5" id="demo-nameDesc" type="text" placeholder="La descripción es muy importante para atraer a los usuarios y explicar el evento."><?php if ( isset($arrayDataEvent)) { echo $arrayDataEvent['desc_event'];} ?></textarea>
                <span class="text-danger"><strong class="alert"><?php if ( isset($eventDescError)) { echo $eventDescError;}; ?></strong></span>
              </div>
              <div class="col-12 col-12-small">
                <ul class="actions">
                  <li><input class="button primary" type="submit" name="saveEvent" value="Guardar Cambios"/></li>
                  <li><a href="dashboard.php" class="button" >Volver sin guardar</a></li>
                </ul>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>

  </div>
</div>
