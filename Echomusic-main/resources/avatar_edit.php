  <div class="inner">
    <h2>Editar</h2>
    <h3>Sube tu Foto de Perfil</h3>
    <div class="col-12">
      <form id="frm-image-upload" action="" name='img' method="post" enctype="multipart/form-data">
          <input type="file" class="file-input" name="file-input">
        </div>
        <span class="text-danger"><strong class="alert"><?php if( isset($avatarError)) { echo $avatarError;} ?></strong></span>
      <p>Tamaño Máximo: 1920x1080 </br> Peso Máximo: 5 mbs</p>
        <ul class="actions fit">
          <li><input type="submit" value="Guardar Cambios" name="submit_avatar" class="button primary fit" /></li>
        </ul>
      </form>
    <a href="#" class="close">Close</a>
  </div>
