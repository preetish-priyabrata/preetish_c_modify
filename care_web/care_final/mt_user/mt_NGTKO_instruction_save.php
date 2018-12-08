<?php
//  print_r($_POST);
// exit;
ini_set('display_errors',1);
session_start();
ob_start();
if($_SESSION['mt_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));

// Array ( [form_type] => WzlczfpA8DUDUryn7D83xCaohU3WbZQ78ZwZ+C4KGEA= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [district] => kalahandi [GP_name] => bankpalas [Block] => junagarh [Village] => bankpalas [type_group] => Array ( [0] => farmers_field_school_group [1] => self_help_group ) [farmers] => 1 [shg_name] => usha [male_qnty] => 9 [female_qnty] => 11 [total_qnty] => 11 [ngtk_name] => Array ( [0] => 3 [1] => 4 ) [times] => 2 [observation] => 1 [support_material] => 1 [message] => hello )
// 
// Array ( [form_type] => L0hnZ3lXZmlzYlJBYkNsNkZiV05YZWVQK3BIOWJHWWNpNTJYdkxpSmJ2MD0= [lat2] => 20.3112448 [lat] => 20.3112448 [long2] => 85.82184960000001 [long] => 85.82184960000001 [district] => kalahandi [GP_name] => dwarsuni [Block] => bhawanipatna [Village] => bandelguda [type_group] => Array ( [0] => Self_Help_Group ) [farmers] => 1 [shg_name] => Skh_0098 [male_qnty] => 15 [female_qnty] => 12 [ngtk_name] => Array ( [0] => pile sort ) [times] => 2 [observation] => 2 [support_material] => 1 [message] => something )

    $district=$_POST['district'];
    $Block=$_POST['Block'];
    $GP_name=$_POST['GP_name'];
    $Village=$_POST['Village'];
    $type_group=json_encode($_POST['type_group']);
    $farmers=$_POST['farmers'];
    $shg_name=$_POST['shg_name'];
    $male_qnty=$_POST['male_qnty'];
    $female_qnty=$_POST['female_qnty'];
    $total_qnty=$male_qnty + $female_qnty ;
    $ngtk_name=json_encode($_POST['ngtk_name']);
    $times=$_POST['times'];
    $observation=$_POST['observation'];
    $support_material=$_POST['support_material'];
    $message=$_POST['message'];
    $date=date('Y-m-d');
    $time=date('H:i:s');
    $mt_id=$_SESSION['mt_user'];
     // $_SESSION['mt_user']=$res['cama_email'];
     $insert_query="INSERT INTO `care_master_mt_NGTKO_instruction_form`(`slno`, `care_administration_date`, `care_district_name`, `care_block_name`, `care_gp_name`, `care_villege_name`, `care_group_type`, `care_farmer_field_group`, `care_shg_name`, `care_male_participants`, `care_female_participants`, `care_total_participants`, `care_NGTK_name`, `care_rolling_time`, `care_observation_tool`, `care_support_materials`, `care_key_message`, `date`, `time`,`care_MT_id`) VALUES (NULL,'$date','$district','$Block','$GP_name','$Village','$type_group','$farmers','$shg_name','$male_qnty','$female_qnty','$total_qnty','$ngtk_name','$times','$observation','$support_material','$message','$date','$time','$mt_id')";
    
	

	$insert_query_exe=mysqli_query($conn,$insert_query);
	// echo mysqli_error($conn);
	// exit;
	

	if($insert_query_exe){ //check if error is in the record

				$msg->success('SuccessFully Submited Instruction of NGTKO'. strtoupper($Village));
				header('Location:index.php');
					 //header('Location:mt_NGTKO_instruction_view.php?slno='.web_encryptIt($slno));
				exit;
		    }else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
		        }

}else{
 	header('Location:logout.php');
  	exit;
 }
 ?>