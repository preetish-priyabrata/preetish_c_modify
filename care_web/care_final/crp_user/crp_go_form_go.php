<?php

session_start();
ob_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();

//Array ( [form_type] => 1Z7hJdfFM0oLvACK4QlV4LMr2e8QvPEfwDzGFR1A/70= [care_hhi] => 12345 [care_hhi_slno] => 1 [form_id] => 1 [form_name_link] => Get Fill )
//
	$form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
        if(isset($_POST['care_hhi']) && isset($_POST['care_hhi_slno'])){
		$care_hhi=web_decryptIt(str_replace(" ", "+",$_POST['care_hhi']));
		$care_hhi_slno=web_decryptIt(str_replace(" ", "+",$_POST['care_hhi_slno']));

		$hhi_enc=$_POST['care_hhi'];
		$care_hhi_slno_ENC=$_POST['care_hhi_slno'];
	}

	$form_id=$_POST['form_id'];
	$form_name_link=$_POST['form_name_link'];
	if($form_type=='go_form_ids'){
		switch ($form_id) {
			case '1': //PULCLES
					
				header('Location:crp_crop_info_crop.php?ID='.$hhi_enc.'&TOKEN_ID='.$care_hhi_slno_ENC.'&TYPE='.web_encryptIt('1'));
    			exit;
				break;
			case '2': // 
				# code...
				break;
			case '3':
				# code...
				break;
			case '4':// KITCHEN GARDEN
				header('Location:crp_crop_info_crop.php?ID='.$hhi_enc.'&TOKEN_ID='.$care_hhi_slno_ENC.'&TYPE='.web_encryptIt('4'));
    			exit;
				break;
			case '5':
				# code...
				break;
			case '6':
				# code...
				break;
			case '7': //POST HARVES LOS
				header('Location:crp_PHL_info_PHL.php?ID='.$hhi_enc.'&TOKEN_ID='.$care_hhi_slno_ENC.'&TYPE='.web_encryptIt('5'));
    			exit;
				break;
			case '8': //LABOUR SAVING TECHNOLOGY
				header('Location:crp_lst_info_lst.php?ID='.$hhi_enc.'&TOKEN_ID='.$care_hhi_slno_ENC.'&TYPE='.web_encryptIt('5'));
    			exit;
				break;
			case '9': // GOTERY
				header('Location:crp_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$care_hhi_slno_ENC.'&TYPE='.web_encryptIt('1'));
    			exit;
				break;
			case '10': //DIARY
				header('Location:crp_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$care_hhi_slno_ENC.'&TYPE='.web_encryptIt('2'));
    			exit;
				break;
			case '11':// PLOTRY
				header('Location:crp_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$care_hhi_slno_ENC.'&TYPE='.web_encryptIt('3'));
    			exit;
				break;
			case '12': // HHI I/O TRACHING
				$care_hhi=web_decryptIt(str_replace(" ", "+",$_POST['care_hhi']));
		                $care_hhi_slno=web_decryptIt(str_replace(" ", "+",$_POST['care_hhi_slno']));

		               $hhi_enc=$_POST['care_hhi'];
		               $care_hhi_slno_ENC=$_POST['care_hhi_slno'];
				header('Location:crp_hhi_input_info_hhi_input.php?ID='.$hhi_enc.'&TOKEN_ID='.$care_hhi_slno_ENC.'&TYPE='.web_encryptIt('1'));
    			exit;
				break;
			case '14':
				$care_shg_id=$_POST['care_shg_id'];
				$care_shg_slno=$_POST['care_shg_slno'];
				
				header('Location:crp_shg_info_shg.php?ID='.$care_shg_id.'&TOKEN_ID='.$care_shg_slno.'&TYPE='.web_encryptIt('1'));
    			exit;
				# crp_shg_info_shg
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
				# code...
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