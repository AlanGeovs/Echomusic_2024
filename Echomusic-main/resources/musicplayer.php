<div id="musicPlayer" class="player" style="background-color: rgb(229, 231, 233);">

    <div class="player__header open-header">

      <div class="player__img player__img--absolute slider open-slider">

        <button class="player__button player__button--absolute--nw playlist">

          <img src="https://physical-authority.surge.sh/imgs/icon/playlist.svg" alt="playlist-icon">

        </button>

        <button class="player__button player__button--absolute--center play">

          <img src="https://physical-authority.surge.sh/imgs/icon/play.svg" alt="play-icon">
          <img src="https://physical-authority.surge.sh/imgs/icon/pause.svg" alt="pause-icon">

        </button>

        <div class="slider__content">

          <? foreach($userTracksArray as $userTracks): ?>
            <script type="text/javascript">console.log(<?=$userTracks['id_audio_user']?>)</script>
            <!-- <img class="img slider__img" src="https://qa.echomusic.cl/images/track_default.jpg" alt="cover"> -->
            <? if(file_exists('images/avatars/'.$userTracks['id_user'].'.jpg')):?>
              <img class="img slider__img" src="https://qa.echomusic.cl/images/avatars/<?=$userTracks['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$userTracks['id_user'].'.jpg')?>" alt="cover">
            <? else: ?>
              <img class="img slider__img" src="https://qa.echomusic.cl/images/logo_brand_4.png">
            <? endif; ?>
          <? endforeach; ?>

        </div>

      </div>

      <div class="player__controls move">

        <button class="player__button back">

          <img class="img" src="https://physical-authority.surge.sh/imgs/icon/back.svg" alt="back-icon">

        </button>

        <p class="player__context slider__context">

          <strong class="slider__name"></strong>
          <span class="player__title slider__title"></span>

        </p>

        <button class="player__button next">

          <img class="img" src="https://physical-authority.surge.sh/imgs/icon/next.svg" alt="next-icon">

        </button>

        <div class="progres">

          <div class="progres__filled"></div>

        </div>

      </div>

    </div>

    <ul class="player__playlist list">
<? $nTrack = 1; ?>
<? foreach ($userTracksArray as $userTracks): ?>
    <li id="play__song_<?=$nTrack?>" class="player__song">
      <? if(file_exists('https://qa.echomusic.cl/images/avatars/'.$userTracks['id_user'].'.jpg')):?>
        <img class="player__img img" src="https://qa.echomusic.cl/images/avatars/<?=$userTracks['id_user']?>.jpg?=<?=filemtime('images/avatars/'.$userTracks['id_user'].'.jpg')?>" alt="cover">
      <? else: ?>
        <img class="player__img img" src="https://qa.echomusic.cl/images/logo_brand_4.png">
      <? endif; ?>

      <p class="player__context">

        <b id="song-name_<?=$userTracks['id_audio_user']?>" class="player__song-name"><?=$userTracks['audio_name']?></b>
        <span class="flex">

          <span id="album-name_<?=$userTracks['id_audio_user']?>" class="player__title"><?=$userTracks['audio_album']?></span>
          <span class="player__song-time"></span>

        </span>

      </p>

      <audio class="audio" src="https://qa.echomusic.cl/audios/<?=$userid?>/<?=$userTracks['audio']?>.mp3"></audio>

    </li>
    <? $nTrack++; ?>
<? endforeach; ?>



    </ul>

  </div>
