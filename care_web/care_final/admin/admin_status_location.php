<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();
// Array ( [access] => 9wpja7mYPzzx9a4XeBeftMR7RhgX64fIu fqfk2WrE= [slno] => TVGhMhqJNCoOSLGbQDiJe2LsbLRlyK eZ6vABEMsEZg= [status] => TVGhMhqJNCoOSLGbQDiJe2LsbLRlyK eZ6vABEMsEZg= )
// 
$access=web_decryptIt(str_replace(" ", "+",$_REQUEST['access']));
$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['slno']));
$status=web_decryptIt(str_replace(" ", "+",$_REQUEST['status']));

switch ($access) {
	//district status is update
	case 'district_status':
		if($status=='1'){
			$status_query="UPDATE `care_master_district_info` SET `care_dis_status`='2' WHERE `care_dis_slno`='$slno' ";
			$msg->success('SuccessFully Inactive');
		}else{
			$status_query="UPDATE `care_master_district_info` SET `care_dis_status`='1' WHERE `care_dis_slno`='$slno' ";
			$msg->success('SuccessFully Active');
		}	
		$sql_exe=mysqli_query($conn,$status_query);
		header('Location:admin_district_view_district.php');
		exit;

		break;
		// here block status is update
	case 'block_status':
		if($status=='1'){
			$status_query="UPDATE `care_master_block_info` SET `care_block_status`='2' WHERE `care_block_sl_no`='$slno' ";
			$msg->success('SuccessFully Inactive');
		}else{
			$status_query="UPDATE `care_master_block_info` SET `care_block_status`='1' WHERE `care_block_sl_no`='$slno' ";
			$msg->success('SuccessFully Active');
		}	
		$sql_exe=mysqli_query($conn,$status_query);
		header('Location:admin_block_view_block.php');
		exit;
		
		break;
	case 'gp_status':
		if($status=='1'){
			$status_query="UPDATE `care_master_gp_info` SET `care_gp_status`='2' WHERE `care_gp_slno`='$slno' ";
			$msg->success('SuccessFully Inactive');
		}else{
			$status_query="UPDATE `care_master_gp_info` SET `care_gp_status`='1' WHERE `care_gp_slno`='$slno' ";
			$msg->success('SuccessFully Active');
		}	
		$sql_exe=mysqli_query($conn,$status_query);
		header('Location:admin_gp_view_gp.php');
		exit;
		
		break;
	case 'vlg_status':
		if($status=='1'){
			$status_query="UPDATE `care_master_village_info` SET `care_vlg_status`='2' WHERE `care_vlg_slno`='$slno' ";
			$msg->success('SuccessFully Inactive');
		}else{
			$status_query="UPDATE `care_master_village_info` SET `care_vlg_status`='1' WHERE `care_vlg_slno`='$slno' ";
			$msg->success('SuccessFully Active');
		}	
		$sql_exe=mysqli_query($conn,$status_query);
		header('Location:admin_village_view_village.php');
		exit;
		break;
	case 'userId_status':
		if($status=='1'){
			$status_query="UPDATE `care_master_system_user` SET `status`='2' WHERE `sl_no`='$slno' ";
			$msg->success('SuccessFully Inactive');
		}else{
			$status_query="UPDATE `care_master_system_user` SET `status`='1' WHERE `sl_no`='$slno' ";
			$msg->success('SuccessFully Active');
		}	
		$sql_exe=mysqli_query($conn,$status_query);
		header('Location:admin_userid_view_userid.php');
		exit;
		
		break;
	
	default:
		header('Location:logout.php');
		exit;
		break;
}
}else{
	header('Location:logout.php');
	exit;
}