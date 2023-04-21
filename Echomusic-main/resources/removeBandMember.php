<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include 'connect.php';

if(isset($_POST['id']) && !empty($_POST['id'])) {
  $id_user = $_SESSION['user'];
  $id_member = trim($_POST['id']);
  $id_member = strip_tags($id_member);
  $id_member = htmlspecialchars($id_member);
  $id_member = mysqli_real_escape_string($conn, $id_member);

  if(!FILTER_VAR($id_member, FILTER_VALIDATE_INT, 1)){
    $error = true;
  }

  if( !$error ) {
      $queryBandMember = mysqli_query($conn, "SELECT img_member AS img_member FROM band_members WHERE id_band_member='$id_member'");
      $arrayBandMember = mysqli_fetch_assoc($queryBandMember);
      $bandMembersImgPath = $arrayBandMember['img_member'];

      if(mysqli_query($conn,"DELETE FROM band_members WHERE id_user='$id_user' AND id_band_member='$id_member'")){
        unlink('../images/band_members/'.$bandMembersImgPath.'.jpg');
        $data = "success";
        echo $data;
      }
  }else{
    echo "danger";
  }

}
?>
