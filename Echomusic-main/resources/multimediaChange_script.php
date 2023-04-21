<?php
include 'connect.php';
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();

// Get id post
if($idPost = FILTER_INPUT(INPUT_POST, 'id', FILTER_VALIDATE_INT, 1)){

$queryPostDetail = mysqli_query($conn, "SELECT * FROM multimedia LEFT JOIN users ON multimedia.id_user = users.id_user WHERE id_multi='$idPost'");
$postDetail = mysqli_fetch_array($queryPostDetail);

$queryPostComments = mysqli_query($conn, "SELECT * FROM multimedia_comments LEFT JOIN users ON multimedia_comments.id_user_comment = users.id_user WHERE id_multimedia='$idPost' ORDER BY id_comment DESC");
$commentsCount = mysqli_num_rows($queryPostComments);
$postCommentsArray = array();
while($postComments = mysqli_fetch_array($queryPostComments)){
  $postCommentsArray[] = $postComments;
}

// Likes
$queryLikes = mysqli_query($conn, "SELECT * FROM multimedia_likes WHERE id_multimedia='$idPost'");
$countLikes = mysqli_num_rows($queryLikes);
$checkUser = false;
$likeMultimedia = false;

if(isset($_SESSION['user'])){

  $checkUserId = $_SESSION['user'];
  $artistId = $postDetail['id_user'];

  $queryLike = mysqli_query($conn, "SELECT * FROM multimedia_likes WHERE id_user='$checkUserId' AND id_multimedia='$idPost'");
  if(mysqli_num_rows($queryLike)){
    $likeMultimedia = true;
  } else {
    $likeMultimedia = false;
  }

  if($artistId == $checkUserId){
    $checkUser = true;
  }
}

$postDetail['date_multi'] = date($postDetail['date_multi']);
$postDetail['date_multi'] = date_create($postDetail['date_multi']);
$postDetail['date_multi'] = DATE_FORMAT($postDetail['date_multi'], 'H:i');

$date = $postDetail['date_multi'];
$date = date_create($date);
$multiDate = DATE_FORMAT($date, 'd/m/Y');

?>

<!-- Response -->
<div class="col-12 mt-2 mb-4"><h2 class="font-weight-bold"><?=$postDetail['title_multi']?></h2></div>

<div class="col-lg-7 col-sm-12 mb-3 mb-md-0" id="featuredVideo">
  <? switch($postDetail['service_multi']):case "youtube":?>
    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?=$postDetail['embed_multi']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  <? break; ?>
  <? case "vimeo": ?>
    <iframe width="100%" height="100%" src="https://player.vimeo.com/video/<?=$postDetail['embed_multi']?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
  <? break; ?>
  <? endswitch; ?>

</div>

<div class="col-lg-5 col-sm-12 pt-4 pb-4" id="featuredVideo-box">
  <div class="row justify-content-between">

      <? if(isset($_SESSION['user'])  && $likeMultimedia == false): ?>
       <div class="col" id="like_button">
         <span id="countLikes1"><?=$countLikes?> </span><a onClick="likeMultimedia(<?=$idPost?>)" class="font-weight-bold"><i class="far fa-heart"></i> Me Gusta</a>
       </div>
       <div class="col" id="liked_button" style="display:none;">
         <span id="countLikes2"><?=$countLikes?> </span><a onClick="unlikeMultimedia(<?=$idPost?>)" class="font-weight-bold"><i class="fas fa-heart"></i> Me Gusta</a>
       </div>
      <? elseif(isset($_SESSION['user'])  && $likeMultimedia == true): ?>
        <div class="col" id="like_button" style="display:none;">
          <span id="countLikes1"><?=$countLikes?> </span><a onClick="likeMultimedia(<?=$idPost?>)" class="font-weight-bold"><i class="far fa-heart"></i> Me Gusta</a>
        </div>
        <div class="col" id="liked_button">
          <span id="countLikes2"><?=$countLikes?> </span><a onClick="unlikeMultimedia(<?=$idPost?>)" class="font-weight-bold"><i class="fas fa-heart"></i> Me Gusta</a>
        </div>
      <? else: ?>
        <div class="col" id="liked_button">
          <span id="countLikes2"><?=$countLikes?> </span><a class="font-weight-bold"><i class="fas fa-heart"></i> Me Gusta</a>
        </div>
      <? endif; ?>


    <div class="col text-right">

      <span><?=$commentsCount?> comentarios</span>

    </div>

  </div>

  <hr>

    <div class="col-12 overflow-auto" id="commentariesBox">

    <ul class="list-unstyled" id="commentariesList">
     <? foreach($postCommentsArray as $postComments): ?>
       <li>

         <div class="row mt-3">

           <? if(file_exists('../images/avatars/'.$postComments['ID_user_comment'].'.jpg')): ?>
             <label for="commentInput" class="col-1 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/<?=$postComments['ID_user_comment']?>.jpg"></label>
           <? else: ?>
             <label for="commentInput" class="col-1 text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/profile_default.jpg"></label>
           <? endif; ?>

           <div class="col-10 commentText pt-2 ml-3">

             <p class="font-weight-bold mb-1"><? echo ($postComments['nick_user'] === NULL) ? $postComments['first_name_user'] : $postComments['nick_user'];?></p>

             <p class="mb-2"><?=$postComments['text_comment']?></p>

           </div>

         </div>

       </li>

     <? endforeach; ?>

    </ul>

    </div>



    <div class="form-group row mt-3">
     <? if(isset($_SESSION['user'])): ?>

         <? if(file_exists('../images/avatars/'.$_SESSION['user'].'.jpg')): ?>
           <label for="commentInput" class="col-1 col-form-label text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/<?=$_SESSION['user']?>.jpg"></label>
         <? else: ?>
           <label for="commentInput" class="col-1 col-form-label text-center pt-0 pr-0 padd-zero"><img class="commentAvatar" src="images/avatars/profile_default.jpg"></label>
         <? endif; ?>
         <div class="col-11">
           <form id="videoComment_form" action="" method="POST">
             <input type="text" name="comment_text" class="form-control form-custom-1" id="commentInput" placeholder="Escribe tu comentario">
             <input type="hidden" name="id_video" value="<?=$idPost?>"/>
             <input type="hidden"  class="button primary fit" name="submit_comment" id="submit_comment" value="Comentar"/>
           </form>
         </div>

     <? else: ?>
       <div class="col-12">

         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Para comentar, debes iniciar sesión</button>

       </div>
     <? endif; ?>

    </div>

  </div>
</div>

<? } ?>
