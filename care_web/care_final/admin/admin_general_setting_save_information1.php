<?php
// print_r($_POST);
ini_set('display_errors',1);
session_start();
print_r($_SESSION);
echo $_SESSION['admin'];
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();
print_r($_POST);
exit;
// Array ( [form_type] => CaQA02Jbm8guLZbEGFv7XA0Jjt7pWRnk1QwombkesXA= [web_district] => W3NNgDJjt3PTy4Z8jh+XUPkLWj4hytjkoITub3qlASA= [District_name] => kalahandi )
// 
echo $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
$web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
$date=date('Y-m-d');
$time=date('H:i:s');
exit;
switch ($form_type) {
	case 'Admin Add Group':
		// $web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
		if($web_district=="group_information"){
			$group_name=strtolower(trim($_POST['group_name']));
			$check_query="SELECT * FROM `care_master_group_info` WHERE `care_group_name`='$group_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where district is not present in record
				$insert_query="INSERT INTO `care_master_group_info`(`care_group_slno`, `care_group_name`, `care_group_status`, `care_group_date`, `care_group_time`) VALUES (Null,'$group_name','1','$date','$time')";
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Group Name Is Add to Our Records');
					header('Location:admin_group_new_group.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('Group Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			header('Location:logout.php');
			exit;
		}
		
		break;
	case 'Admin Add Thematic Intervention' :
		if($web_district=="Thematic_Interventions"){
			$thematic_name=strtolower(trim($_POST['thematic_name']));
			$check_query="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_thematic_name`='$thematic_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where district is not present in record
				echo $insert_query="INSERT INTO `care_master_thematic_interventions_info`(`care_thi_slno`, `care_thi_thematic_name`, `care_thi_status`, `care_thi_date`, `care_thi_time`) VALUES (Null,'$thematic_name','1','$date','$time')";
				exit;
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Group Name Is Add to Our Records');
					header('Location:admin_thematic_new_thematic.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('Group Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			exit;
			header('Location:logout.php');
			exit;
		}
			
		break;
	default:
	exit;
		header('Location:logout.php');
		exit;
		
		break;
}


}else{
	exit;
	header('Location:logout.php');
	exit;
}

?>