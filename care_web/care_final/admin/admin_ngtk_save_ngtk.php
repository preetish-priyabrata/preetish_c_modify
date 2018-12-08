


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

            $care_NGTK_name=strtolower(trim($_POST['care_NGTK_name']));
			$check_query="SELECT * FROM `care_master_NGTK_group` WHERE `care_NGTK_name`='$care_NGTK_name'";
			$sql_exe=mysqli_query($conn,$check_query);
			$num_check=mysqli_num_rows($sql_exe);
			if($num_check=="0"){  // if numcheck='0' where NGTK NAME is not present in record
				$insert_query="INSERT INTO `care_master_NGTK_group`(`slno`, `care_NGTK_name`, `status`, `date`, `time`) VALUES (Null,'$care_NGTK_name','1','$date','$time')";
				$sql_exe=mysqli_query($conn,$insert_query);
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully NGTK Name Is Add to Our Records');
					header('Location:admin_ngtk_new_ngtk.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			}else{
				$msg->warning('NGTK Name Is Already Present In Our Record');
				header('Location:index.php');
				exit;
			}


		}else{
			header('Location:logout.php');
			exit;
		}
		?>