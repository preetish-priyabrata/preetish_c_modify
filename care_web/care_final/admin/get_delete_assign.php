<?php
session_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages(); 
 	$form_type=web_decryptIt(str_replace(" ", "+", $_GET['token']));
 	$GET_DELETE="DELETE FROM `care_master_assigned_user_info` WHERE `care_assU_slno`='$form_type'";
 	$GET_SQL_EXE=mysqli_query($conn,$GET_DELETE);
 	if($GET_SQL_EXE){ //check if error is in the record
		$msg->success('SuccessFully Employee is removed from village ');
		header('Location:index.php');
		exit;
	}else{
		$msg->error('Some Problem Occur');
		header('Location:index.php');
		exit;
	}
// 
}else{
  header('Location:logout.php');
  exit;
}