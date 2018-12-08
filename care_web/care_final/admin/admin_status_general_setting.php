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
	case 'group_status':
		if($status=='1'){
			$status_query="UPDATE `care_master_group_info` SET `care_group_status`='2' WHERE `care_group_slno`='$slno' ";
			$msg->success('SuccessFully Inactive');
		}else{
			$status_query="UPDATE `care_master_group_info` SET `care_group_status`='1' WHERE `care_group_slno`='$slno' ";
			$msg->success('SuccessFully Active');
		}	
		$sql_exe=mysqli_query($conn,$status_query);
		header('Location:admin_group_view_group.php');
		exit;
		
		break;
	case 'them_status':
		if($status=='1'){
			$status_query="UPDATE `care_master_thematic_interventions_info` SET `care_thi_status`='2' WHERE `care_thi_slno`='$slno' ";
			$msg->success('SuccessFully Inactive');
		}else{
			$status_query="UPDATE `care_master_thematic_interventions_info` SET `care_thi_status`='1' WHERE `care_thi_slno`='$slno' ";
			$msg->success('SuccessFully Active');
		}	
		$sql_exe=mysqli_query($conn,$status_query);
		header('Location:admin_thematic_view_thematic.php');
		exit;
		
		break;
	case 'training_status':
		if($status=='1'){
			$status_query="UPDATE `care_master_training_info` SET `care_trng_status`='2' WHERE `care_trng_slno`='$slno' ";
			$msg->success('SuccessFully Inactive');
		}else{
			$status_query="UPDATE `care_master_training_info` SET `care_trng_status`='1' WHERE `care_trng_slno`='$slno' ";
			$msg->success('SuccessFully Active');
		}	
		$sql_exe=mysqli_query($conn,$status_query);
		header('Location:admin_training_view_training.php');
		exit;
		break;
	case 'trainingt_status':
		if($status=='1'){
			$status_query="UPDATE `care_master_training_theme_info` SET `care_training_status`='2' WHERE `care_train_slno`='$slno' ";
			$msg->success('SuccessFully Inactive');
		}else{
			$status_query="UPDATE `care_master_training_theme_info` SET `care_training_status`='1' WHERE `care_train_slno`='$slno' ";
			$msg->success('SuccessFully Active');
		}	
		$sql_exe=mysqli_query($conn,$status_query);
		header('Location:admin_Training_Thematic_view_Training_Thematic.php');
		exit;
		break;
	case 'technical_status':
			if($status=='1'){
			$status_query="UPDATE `care_master_technical_support_providers_info` SET `care_tsp_status`='2' WHERE `care_tsp_slno`='$slno' ";
			$msg->success('SuccessFully Inactive');
			}else{
				$status_query="UPDATE `care_master_technical_support_providers_info` SET `care_tsp_status`='1' WHERE `care_tsp_slno`='$slno' ";
				$msg->success('SuccessFully Active');
			}	
			$sql_exe=mysqli_query($conn,$status_query);
			header('Location:admin_ts_view_ts.php');
			exit;
			
		break;
	case 'Committee_status':
		if($status=='1'){
			$status_query="UPDATE `care_master_committee_info` SET `care_comm_status`='2' WHERE `care_comm_slno`='$slno' ";
			$msg->success('SuccessFully Inactive');
			}else{
				$status_query="UPDATE `care_master_committee_info` SET `care_comm_status`='1' WHERE `care_comm_slno`='$slno' ";
				$msg->success('SuccessFully Active');
			}	
			$sql_exe=mysqli_query($conn,$status_query);
			header('Location:admin_committee_view_committee.php');
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