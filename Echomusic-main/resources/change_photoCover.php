<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include("functionCoverPic.php");
$userObj = new coverPicChange();
$post = isset($_POST) ? $_POST: array();
switch($post['action']) {
	case 'save' :
	$userObj->saveCoverPhoto();
	break;
	default:
	$userObj->changeCoverPhoto();
}

?>
