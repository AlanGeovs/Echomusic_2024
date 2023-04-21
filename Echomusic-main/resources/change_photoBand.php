<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
session_start();
include("functionBandPic.php");
include("connect.php");
$userObj = new bandPicChange();
$post = isset($_POST) ? $_POST: array();
switch($post['action']) {
	case 'save' :
	$userObj->saveBandPhoto();
	$userObj->saveBandInfo();
	break;
	default:
	$userObj->changeBandPhoto();
	break;
}

?>
