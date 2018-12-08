


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
// $web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
$date=date('Y-m-d');
$time=date('H:i:s');

            $care_famer_field_group_name=strtolower(trim($_POST['care_famer_field_group_name']));
			$check_query="SELECT * FROM `care_master_farmer_field_group` WHERE `care_famer_field_group_name`='$care_famer_field_group_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where Farmer Field School Group NAME is not present in record
				$insert_query="INSERT INTO `care_master_farmer_field_group`(`slno`, `care_famer_field_group_name`, `status`, `date`, `time`) VALUES (Null,'$care_famer_field_group_name','1','$date','$time')";
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Farmer Field School Group Name Is Add to Our Records');
					header('Location:admin_field_group_new_field_group.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('Farmer Field School Group Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			header('Location:logout.php');
			exit;
		}
		?>