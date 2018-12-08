<?php

ini_set('display_errors',1);
session_start();

if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();

// 
  $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
  $web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
  $date=date('Y-m-d');
  $time=date('H:i:s');

// Array ( [form_type] => 9ZQy351cQ8U0kTPIXpTe6RVA9YIHUJrBV2zC4uAEMJs= [web_district] => 7O+ZYoFrMuqU9jg93mpIacLh1IB0/t/5cNC/gZyUZg4= [user_roles] => 2 [user_lable] => 2 [location] => kalahandi [user_name] => testuser [designation_name] => mt user [email_id] => testuser_mt@ilab.com [password_user] => 1234phpAP [mobile_no] => 9040777073 )


  $user_roles=trim($_POST['user_roles']);
  
 
  $user_name=trim($_POST['user_name']);
  $designation_name=trim($_POST['designation_name']);
  $email_id=trim($_POST['email_id']);
  $password_user=trim($_POST['password_user']);
  $password_user_hash=md5($password_user);
  $mobile_no=trim($_POST['mobile_no']);

  switch ($user_roles) {
    case '2':
        $user_lable=trim($_POST['user_lable']);
        $location=trim($_POST['location']);
      break;
    case '3':
        $user_lable=trim($_POST['user_lable']);
        $location=trim($_POST['location']);
      break;
    case '4':
        $user_lable=trim($_POST['user_lable']);
        $location=trim($_POST['location']);
      break;
    case '5':
        $user_lable=trim($_POST['user_lable']);
        $location="";
      break;
    
    default:
      $msg->error('This Feature is not avaliable right now ');
      header('Location:index.php');
      exit;
      break;
  }

  $get_check_admin="SELECT * FROM `care_master_admin_info` WHERE `cama_email`='$email_id'";
  $sql_exe_admin=mysqli_query($coon,$get_check_admin);
  $num_admin=mysqli_num_rows($sql_exe_admin);

  if($num_admin==0){
    $get_admin_insert="INSERT INTO `care_master_admin_info`(`cama_slno`, `cama_username`, `cama_email`, `Designation`, `cama_password`, `cama_pass_id`, `cama_status`, `cama_role`, `form_type`, `location_user`, `cama_date`, `cama_time`, `user_mobile_no`) VALUES (Null,'$user_name','$email_id','$designation_name','$password_user_hash','$password_user','1','$user_roles','$user_lable','$location','$date','$time','$mobile_no')";
     $sql_exe__insert_admin=mysqli_query($coon,$get_admin_insert);
     if($sql_exe__insert_admin){ //check if error is in the record
          $msg->success('SuccessFully Admin Is Add to Our Records');
          header('Location:admin_view_userid.php');
          exit;
        }else{
          $msg->error('Some Problem Occur');
          header('Location:index.php');
          exit;
        }
    
    }else{
      $msg->warning('Admin email Id Is Already Present In Our Record');
      header('Location:index.php');
      exit;
    }


}else{
  header('Location:logout.php');
  exit;
}