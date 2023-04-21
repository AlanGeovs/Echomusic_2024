<?php
include 'connect.php';

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

}

$postDetail['date_multi'] = date($postDetail['date_multi']);
$postDetail['date_multi'] = date_create($postDetail['date_multi']);
$postDetail['date_multi'] = DATE_FORMAT($postDetail['date_multi'], 'H:i');

$date = $postDetail['date_multi'];
$date = date_create($date);
$multiDate = DATE_FORMAT($date, 'd/m/Y');


?>
