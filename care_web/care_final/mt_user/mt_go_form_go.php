<?php
// print_r($_REQUEST);
// exit;
ini_set('display_errors',1);
session_start();
ob_start();
if($_SESSION['mt_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 // informtionm is gather
	$form_type=web_decryptIt(str_replace(" ", "+", $_REQUEST['form_type']));
    $target=web_decryptIt(str_replace(" ", "+", $_REQUEST['target']));// month
	$care_hhi=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
	echo $form_id=web_decryptIt(str_replace(" ", "+",$_REQUEST['form_id']));

	$hhi_enc=$_REQUEST['care_hhi'];
	$target_enc=$_REQUEST['target'];
	$year=$_REQUEST['year'];
	$village=$_REQUEST['village'];
	$form_uses=$_REQUEST['form_uses'];

	$form_id=web_decryptIt(str_replace(" ", "+",$_REQUEST['form_id']));
	// exit;
	// $form_name_link=$_REQUEST['form_name_link'];
	if($form_type=='ilab'){
		switch ($form_id) {
			case '1': //PULCLES
					if($form_uses=='1'){
						header('Location:mt_crop_info_crop.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    					exit;
					}else if($form_uses=='2'){
						header('Location:mt_crop_info_crop.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    					exit;
					}else{
						header('Location:logout.php');
    					exit;
					}
					break;
			case '2': //
				# code...
				break;
			case '3':
				# code...
				break;
			case '4':// KITCHEN GARDEN
				if($form_uses=='1'){
					header('Location:mt_crop_info_crop.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('4').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
	    			exit;
    			}else if($form_uses=='2'){
						header('Location:mt_crop_info_crop.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('4').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    					exit;
					}else{
						header('Location:logout.php');
    					exit;
					}
				break;
			case '5':
				# code...
				break;
			case '6':
				# code...
				break;
			case '7': //POST HARVES LOS
				if($form_uses=='1'){
					header('Location:mt_PHL_info_PHL.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
	    			exit;
				}else if($form_uses=='2'){
					header('Location:mt_PHL_info_PHL.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('2').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
	    			exit;
				}else{
					header('Location:logout.php');
	    			exit;
				}
				break;
			case '8': //LABOUR SAVING TECHNOLOGY
				if($form_uses=='1'){
					header('Location:mt_lst_info_lst.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('5').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
	    			exit;
				}else if($form_uses=='2'){
					header('Location:mt_lst_info_lst.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('5').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
	    			exit;
				}else{
					header('Location:logout.php');
		    		exit;
				}
				break;
			case '9': // GOTERY
				if($form_uses=='1'){
					header('Location:mt_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    				exit;
				}else if($form_uses=='2'){
					header('Location:mt_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    				exit;
				}else{
					header('Location:logout.php');
		    		exit;
				}
				break;
			case '10': //DIARY
				if($form_uses=='1'){
					header('Location:mt_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('2').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    				exit;
				}else if($form_uses=='2'){
					header('Location:mt_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('2').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    				exit;
				}else{
					header('Location:logout.php');
		    		exit;
				}
				break;
			case '11':// PLOTRY
				if($form_uses=='1'){
					header('Location:mt_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('3').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    				exit;
				}else if($form_uses=='2'){
					header('Location:mt_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('3').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    			exit;
				}else{
					header('Location:logout.php');
		    		exit;
				}
				break;
			case '12': // HHI I/O TRACHING
			;
				if($form_uses==1){
					header('Location:mt_hhi_input_info_hhi_input.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    			exit;
				}else if($form_uses==2){
					header('Location:mt_hhi_input_info_hhi_input.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    			exit;
				}else{
					exit;
					header('Location:logout.php');
		    		exit;
				}
				break;
			case '15':
				# code...
				break;
			case '16':
				# code...
				break;
			case '17':
				# code...
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

}else{
	header('Location:logout.php');
    exit;
}