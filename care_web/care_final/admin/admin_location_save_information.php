<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();
// print_r($_POST);
// exit;
// Array ( [form_type] => CaQA02Jbm8guLZbEGFv7XA0Jjt7pWRnk1QwombkesXA= [web_district] => W3NNgDJjt3PTy4Z8jh+XUPkLWj4hytjkoITub3qlASA= [District_name] => kalahandi )
// 
$form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
$web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
$date=date('Y-m-d');
$time=date('H:i:s');
switch ($form_type) {
	case 'Admin Add District':
		$web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
		if($web_district=="district_information"){
			$District_name=strtolower(trim($_POST['District_name']));
			$check_query="SELECT * FROM `care_master_district_info` WHERE `care_dis_name`='$District_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where district is not present in record
				$insert_query="INSERT INTO `care_master_district_info`(`care_dis_slno`, `care_dis_name`, `care_dis_status`, `care_dis_date`, `care_dis_time`) VALUES (Null,'$District_name','1','$date','$time')";
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully District Name Is Add to Our Records');
					header('Location:admin_district_new_district.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('District Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			header('Location:logout.php');
			exit;
		}
		
		break;
	case 'Admin Add Block':
		
		if($web_district=="block_information"){
			$District_name=strtolower($_POST['District_name']);
			$block_name=strtolower(trim($_POST['block_name']));
			
			$check_query="SELECT * FROM `care_master_block_info` WHERE `care_block_name`='$block_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where district is not present in record
				$insert_query="INSERT INTO `care_master_block_info`(`care_block_sl_no`, `care_block_name`, `care_block_dis_name`, `care_block_status`, `care_block_date`, `care_block_time`) VALUES (Null,'$block_name','$District_name','1','$date','$time')";
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Block Name Is Add to Our Records');
					header('Location:admin_block_new_block.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('Block Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			header('Location:logout.php');
			exit;
		}
		
		break;
	case 'Admin Add GP':
		
		if($web_district=="gp_information"){
			$District_name=strtolower($_POST['District_name']);
			$block_name=strtolower(trim($_POST['block_name']));
			$gp_name=strtolower(trim($_POST['gp_name']));
			$check_query="SELECT * FROM `care_master_gp_info` WHERE `care_gp_name`='$gp_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where district is not present in record
				$insert_query="INSERT INTO `care_master_gp_info`(`care_gp_slno`, `care_gp_district`, `care_gp_block`, `care_gp_name`, `care_gp_status`, `care_gp_date`, `care_gp_time`) VALUES (Null,'$District_name','$block_name','$gp_name','1','$date','$time')";
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully GP Name Is Add to Our Records');
					header('Location:admin_gp_new_gp.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('GP Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			header('Location:logout.php');
			exit;
		}
		
		break;
		case 'Admin Add village':
		// Array ( [form_type] => RephdwHG84rBVupD5iBqzDK1bReMzO8bgjQYnr1F8Og= [web_district] => BfwPvNlpCF59aFYtXxkjRJHU1lhBxsIiamoV7qyPnI0= [District_name] => kalahandi [block_name] => junagarh [gp_name] => bankpalas [village_name] => balarampur )
		if($web_district=="village_information"){
			$District_name=strtolower($_POST['District_name']);
			$block_name=strtolower(trim($_POST['block_name']));
			$gp_name=strtolower(trim($_POST['gp_name']));
			$village_name=strtolower(trim($_POST['village_name']));
               
			$check_query="SELECT * FROM `care_master_village_info` WHERE `care_vlg_name`='$village_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where district is not present in record
				 $insert_query="INSERT INTO `care_master_village_info`(`care_vlg_slno`, `care_vlg_district`, `care_vlg_block`,`care_vlg_gp`, `care_vlg_name`, `care_vlg_status`, `care_vlg_date`, `care_vlg_time`) VALUES (Null,'$District_name','$block_name','$gp_name','$village_name','1','$date','$time')";
				// exit;
				$sql_exe=mysqli_query($conn,$insert_query);
				
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Village Name Is Add to Our Records');
					header('Location:admin_village_new_village.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('Village Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


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