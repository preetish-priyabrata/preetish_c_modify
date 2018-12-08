<?php
// print_r($_POST);
ini_set('display_errors',1);
session_start();
// print_r($_SESSION);
// echo $_SESSION['admin'];
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();
// print_r($_POST);
// exit;
// Array ( [form_type] => CaQA02Jbm8guLZbEGFv7XA0Jjt7pWRnk1QwombkesXA= [web_district] => W3NNgDJjt3PTy4Z8jh+XUPkLWj4hytjkoITub3qlASA= [District_name] => kalahandi ) 
$form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
$web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
$date=date('Y-m-d');
$time=date('H:i:s');

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

	case 'Admin Add Thematic':
		if($web_district=="Thematic_information"){
			$thematic_name=strtolower(trim($_POST['thematic_name']));
			$check_query="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_thematic_name`='$thematic_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where district is not present in record
				 $insert_query="INSERT INTO `care_master_thematic_interventions_info`(`care_thi_slno`, `care_thi_thematic_name`, `care_thi_status`, `care_thi_date`, `care_thi_time`) VALUES (Null,'$thematic_name','1','$date','$time')";
				
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Thematic Intervention Name Is Add to Our Records');
					header('Location:admin_thematic_new_thematic.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('Thematic Intervention Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			
			header('Location:logout.php');
			exit;
		}
			
		break;
	case 'Admin Add Training':
		// $web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
		if($web_district=="training_information"){
			$training_name=strtolower(trim($_POST['training_name']));
			$check_query="SELECT * FROM `care_master_training_info` WHERE `care_trng_name`='$training_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where district is not present in record
				$insert_query="INSERT INTO `care_master_training_info`(`care_trng_slno`, `care_trng_name`, `care_trng_status`, `care_trng_date`, `care_trng_time`) VALUES (Null,'$training_name','1','$date','$time')";
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Training Name Is Add to Our Records');
					header('Location:admin_training_new_training.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('Training Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			header('Location:logout.php');
			exit;
		}
		
		break;
	case 'Admin Add Technical':
		if($web_district=="Technical_information"){
			$Technical_name=strtolower(trim($_POST['Technical_name']));
			$check_query="SELECT * FROM `care_master_technical_support_providers_info` WHERE `care_tsp_name`='$Technical_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where district is not present in record
				$insert_query="INSERT INTO `care_master_technical_support_providers_info`(`care_tsp_slno`, `care_tsp_name`, `care_tsp_status`, `care_tsp_date`, `care_tsp_time`) VALUES  (Null,'$Technical_name','1','$date','$time')";
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Technical Support Provider Name Is Add to Our Records');
					header('Location:admin_ts_new_ts.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('Technical Support Provider Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			header('Location:logout.php');
			exit;
		}

		break;

		case 'Admin Add Committee':
		// $web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
		if($web_district=="committee_information"){
			$committee_name=strtolower(trim($_POST['committee_name']));
			$check_query="SELECT * FROM `care_master_committee_info` WHERE `care_comm_name`='$committee_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where district is not present in record
				$insert_query="INSERT INTO `care_master_committee_info`(`care_comm_slno`, `care_comm_name`, `care_comm_status`, `care_comm_date`, `care_comm_time`) VALUES (Null,'$committee_name','1','$date','$time')";
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Committee Name Is Add to Our Records');
					header('Location:admin_committee_new_committee.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('Committee Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			header('Location:logout.php');
			exit;
		}
		break;
	case 'Admin Add Training Thematic':
		// $web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
		if($web_district=="training_Thematic_information"){
			$thematic_interventions=strtolower(trim($_POST['thematic_interventions']));
			$training_name=strtolower(trim($_POST['training_name']));
			// $check_query="SELECT * FROM `care_master_training_theme_info` WHERE `care_training_name`='$training_name'";
			// $sql_exe=mysqli_query($conn,$check_query);
			// $num_check=mysqli_num_rows($sql_exe);
			// if($num_check=="0"){  // if numcheck='0' where district is not present in record
				$insert_query="INSERT INTO `care_master_training_theme_info`(`care_train_slno`, `care_training_name`, `care_training_thematic`, `care_training_status`, `care_training_date`, `care_training_time`) VALUES (Null,'$training_name','$thematic_interventions','1','$date','$time')";
				$sql_exe=mysqli_query($conn,$insert_query);
				// echo mysqli_error($conn);
				// exit;
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Training Name Is Add to Our Records');
					header('Location:admin_Training_Thematic_new_Training_Thematic.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			// }else{
			// 	$msg->warning('Training Name Is Already Present In Our Record');
			// 	header('Location:index.php');
			// 	exit;
			// }


		}else{
			header('Location:logout.php');
			exit;
		}
		
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

?>