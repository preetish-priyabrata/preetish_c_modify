

<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Admin View Farmer Field School Group List";

// $access=web_decryptIt(str_replace(" ", "+",$_REQUEST['access']));
$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['slno']));
$status=web_decryptIt(str_replace(" ", "+",$_REQUEST['status']));

if($status=='1'){
			$status_query="UPDATE `care_master_farmer_field_group` SET `status`='2' WHERE `slno`='$slno' ";
			$msg->success('SuccessFully Inactive');
		}else{
			$status_query="UPDATE `care_master_farmer_field_group` SET `status`='1' WHERE `slno`='$slno' ";
			$msg->success('SuccessFully Active');
		}	
		$sql_exe=mysqli_query($conn,$status_query);
		header('Location:admin_field_group_view_field_group.php');
		exit;
}else{
	header('Location:logout.php');
	exit;
}
?>