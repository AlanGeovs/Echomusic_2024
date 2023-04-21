<div class="inner">
  <h2>Publicar un video</h2>


    <form action="" method="post">
      <div class="row gtr-uniform">
        <div class="col-12 col-12-xsmall">
          <label for="demo-audio">Enlace del video <i class="fab fa-youtube"></i>&nbsp;<i class="fab fa-vimeo"></i></label>
          <input type="text" name="url_audio" class="" value="" />
          <span class="text-danger"><strong class="alert"><?php if( isset($audioError)) { echo $audioError;} ?></strong></span>
        </div>
        <div class="col-12 col-12-xsmall">
          <label for="demo-title">Título</label>
          <input type="text" name="title_audio" class="" value="" />
          <span class="text-danger"><strong class="alert"><?php if( isset($titleAudioError)) { echo $titleAudioError;} ?></strong></span>
        </div>
        <div class="col-12 col-12-xsmall">
          <label for="demo-desc">Descripción</label>
          <textarea name="desc_audio" value="" rows="3"></textarea>
          <span class="text-danger"><strong class="alert"><?php if( isset($descAudioError)) { echo $descAudioError;} ?></strong></span>
        </div>
        <div class="col-12 col-12-xsmall">
          <ul class="actions fit">
            <li><input type="submit" value="Publicar" name="submit_audio" class="button primary fit" /></li>
          </ul>
        </div>
      </div>
    </form>

  <a href="#" class="close">Close</a>
</div>
