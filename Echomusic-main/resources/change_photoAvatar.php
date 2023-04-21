<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include("functionProfilePic.php");
$userObj = new avatarPicChange();
$post = isset($_POST) ? $_POST: array();
switch($post['action']) {
	case 'save' :
	$userObj->saveProfilePhoto();
	break;
	default:
	$userObj->changeProfilePhoto();
}

?>
