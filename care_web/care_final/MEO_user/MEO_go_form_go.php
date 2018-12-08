<?php
// print_r($_REQUEST);
// exit;
ini_set('display_errors',1);
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 // informtionm is gather
	$form_type=web_decryptIt(str_replace(" ", "+", $_REQUEST['form_type']));
    $target=web_decryptIt(str_replace(" ", "+", $_REQUEST['target']));// month
	$care_hhi=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
	 $form_id=web_decryptIt(str_replace(" ", "+",$_REQUEST['form_id']));
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
			
					if($form_uses=='1'){ // edit information of crop diverfication
						// print_r($_REQUEST);
						header('Location:MEO_crop_info_crop.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    					exit;
					}else if($form_uses=='2'){ // view crop diverfivation affter edit 
						header('Location:MEO_crop_info_crop1.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    					exit;
    				}else if($form_uses=='3'){ 
    					$reset=web_decryptIt(str_replace(" ", "+",$_REQUEST['reset']));
    					$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
    					$get_meo_edit="UPDATE `care_master_crop_diversification_crp_meo` SET `care_crop_div_MEO_status`='3' WHERE`care_slno`='$slno'";
    					$get_crp_edit="UPDATE `care_master_crop_diversification_crp` SET `care_crop_div_MEO_status`='0' WHERE`care_slno`='$reset'";

    					$sql_meo_exe=mysqli_query($conn,$get_meo_edit);
    					$sql_crp_exe=mysqli_query($conn,$get_crp_edit);
    					if($sql_crp_exe && $sql_meo_exe){
    						$msg->success('SuccessFully Deleted information of Crop Diverfication ');
							header('Location:index.php');
							exit;
    					}else{
    						$msg->success('Some error occured while deleting of crop diverfication ');
							header('Location:index.php');
							exit;
    					}
    					// print_r($_REQUEST);
    					// exit;
					}else{ // not menstion in program any mis-useage of hacking
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
					header('Location:MEO_crop_info_crop.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('4').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
	    			exit;
    			}else if($form_uses=='2'){
						header('Location:MEO_crop_info_crop1.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('4').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    					exit;
    			}else if($form_uses=='3'){
    				$reset=web_decryptIt(str_replace(" ", "+",$_REQUEST['reset']));
    					$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
    					$get_meo_edit="UPDATE `care_master_crop_diversification_crp_meo` SET `care_crop_div_MEO_status`='3' WHERE`care_slno`='$slno'";
    					$get_crp_edit="UPDATE `care_master_crop_diversification_crp` SET `care_crop_div_MEO_status`='0' WHERE`care_slno`='$reset'";

    					$sql_meo_exe=mysqli_query($conn,$get_meo_edit);
    					$sql_crp_exe=mysqli_query($conn,$get_crp_edit);
    					if($sql_crp_exe && $sql_meo_exe){
    						$msg->success('SuccessFully Deleted information of Crop Diverfication ');
							header('Location:index.php');
							exit;
    					}else{
    						$msg->success('Some error occured while deleting of crop diverfication ');
							header('Location:index.php');
							exit;
    					}

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
					header('Location:MEO_PHL_info_PHL.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
	    			exit;
				}else if($form_uses=='2'){
					header('Location:MEO_PHL_info_PHL1.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('2').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
	    			exit;
	    		}else if($form_uses=='3'){
    				$reset=web_decryptIt(str_replace(" ", "+",$_REQUEST['reset']));
    					$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
    					$get_meo_edit="UPDATE `care_master_post_harvest_loss_meo` SET `care_PHL_MEO_status`='3' WHERE`care_PHL_slno`='$slno'";
    					$get_crp_edit="UPDATE `care_master_post_harvest_loss` SET `care_PHL_MEO_status`='0' WHERE`care_PHL_slno`='$reset'";

    					$sql_meo_exe=mysqli_query($conn,$get_meo_edit);
    					$sql_crp_exe=mysqli_query($conn,$get_crp_edit);
    					if($sql_crp_exe && $sql_meo_exe){
    						$msg->success('SuccessFully Deleted information of PHL');
							header('Location:index.php');
							exit;
    					}else{
    						$msg->success('Some error occured while deleting of PHL');
							header('Location:index.php');
							exit;
    					}
				}else{
					header('Location:logout.php');
	    			exit;
				}
				break;
				
			case '8': //LABOUR SAVING TECHNOLOGY
				if($form_uses=='1'){
					header('Location:MEO_lst_info_lst.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('5').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
	    			exit;
				}else if($form_uses=='2'){
					header('Location:MEO_lst_info_lst1.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('5').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
	    			exit;
	    		}else if($form_uses=='3'){
    				$reset=web_decryptIt(str_replace(" ", "+",$_REQUEST['reset']));
    					$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
    					$get_meo_edit="UPDATE `care_master_mtf_labour_saving_tech_tarina_meo` SET `care_MTF_MEO_status`='3' WHERE`care_MTF_slno`='$slno'";
    					$get_crp_edit="UPDATE `care_master_mtf_labour_saving_tech_tarina` SET `care_MTF_MEO_status`='0' WHERE`care_MTF_slno`='$reset'";

    					$sql_meo_exe=mysqli_query($conn,$get_meo_edit);
    					$sql_crp_exe=mysqli_query($conn,$get_crp_edit);
    					if($sql_crp_exe && $sql_meo_exe){
    						$msg->success('SuccessFully Deleted information of LST ');
							header('Location:index.php');
							exit;
    					}else{
    						$msg->success('Some error occured while deleting of LST ');
							header('Location:index.php');
							exit;
    					}
				}else{
					header('Location:logout.php');
		    		exit;
				}
				break;
			case '9': // GOTERY
				if($form_uses=='1'){
					header('Location:MEO_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    				exit;
				}else if($form_uses=='2'){
					header('Location:MEO_livestock_info_livestock1.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    				exit;
    			}else if($form_uses=='3'){
    				$reset=web_decryptIt(str_replace(" ", "+",$_REQUEST['reset']));
    					$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
    					$get_meo_edit="UPDATE `care_master_mtf_livestock_tarina_meo` SET `care_LS_MEO_status`='3' WHERE`care_LS_slno`='$slno'";
    					$get_crp_edit="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_MEO_status`='0' WHERE`care_LS_slno`='$reset'";
    					$get_med="UPDATE `care_master_livestock_quantity_provided_meo` SET `care_QP_status`='3' WHERE `care_QP_livestock_slno`='$reset'";

    					$sql_meo_exe=mysqli_query($conn,$get_meo_edit);
    					$sql_crp_exe=mysqli_query($conn,$get_crp_edit);
    					$sql_get_med_exe=mysqli_query($conn,$get_med);
    					if($sql_crp_exe && $sql_meo_exe){
    						$msg->success('SuccessFully Deleted information of Goatery ');
							header('Location:index.php');
							exit;
    					}else{
    						$msg->success('Some error occured while deleting of Goatery ');
							header('Location:index.php');
							exit;
    					}
				}else{
					header('Location:logout.php');
		    		exit;
				}
				break;
			case '10': //DIARY
				if($form_uses=='1'){
					header('Location:MEO_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('2').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    				exit;
				}else if($form_uses=='2'){
					header('Location:MEO_livestock_info_livestock1.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('2').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    				exit;
    			}else if($form_uses=='3'){
    				$reset=web_decryptIt(str_replace(" ", "+",$_REQUEST['reset']));
    					$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
    					$get_meo_edit="UPDATE `care_master_mtf_livestock_tarina_meo` SET `care_LS_MEO_status`='3' WHERE`care_LS_slno`='$slno'";
    					$get_crp_edit="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_MEO_status`='0' WHERE`care_LS_slno`='$reset'";
    					$get_med="UPDATE `care_master_livestock_quantity_provided_meo` SET `care_QP_status`='3' WHERE `care_QP_livestock_slno`='$reset'";

    					$sql_meo_exe=mysqli_query($conn,$get_meo_edit);
    					$sql_crp_exe=mysqli_query($conn,$get_crp_edit);
    					$sql_get_med_exe=mysqli_query($conn,$get_med);
    					if($sql_crp_exe && $sql_meo_exe){
    						$msg->success('SuccessFully Deleted information of Dairy ');
							header('Location:index.php');
							exit;
    					}else{
    						$msg->success('Some error occured while deleting of Dairy ');
							header('Location:index.php');
							exit;
    					}
				}else{
					header('Location:logout.php');
		    		exit;
				}
				break;
			case '11':// PLOTRY
				if($form_uses=='1'){
					header('Location:MEO_livestock_info_livestock.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('3').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    				exit;
				}else if($form_uses=='2'){
					header('Location:MEO_livestock_info_livestock1.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('3').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    			exit;
    			}else if($form_uses=='3'){
    				$reset=web_decryptIt(str_replace(" ", "+",$_REQUEST['reset']));
    					$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
    					$get_meo_edit="UPDATE `care_master_mtf_livestock_tarina_meo` SET `care_LS_MEO_status`='3' WHERE`care_LS_slno`='$slno'";
    					$get_crp_edit="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_MEO_status`='0' WHERE`care_LS_slno`='$reset'";
    					$get_med="UPDATE `care_master_livestock_quantity_provided_meo` SET `care_QP_status`='3' WHERE `care_QP_livestock_slno`='$reset'";

    					$sql_meo_exe=mysqli_query($conn,$get_meo_edit);
    					$sql_crp_exe=mysqli_query($conn,$get_crp_edit);
    					$sql_get_med_exe=mysqli_query($conn,$get_med);

    					
    					if($sql_crp_exe && $sql_meo_exe){
    						$msg->success('SuccessFully Deleted information of Poultry ');
							header('Location:index.php');
							exit;
    					}else{
    						$msg->success('Some error occured while deleting of Poultry ');
							header('Location:index.php');
							exit;
    					}
				}else{
					header('Location:logout.php');
		    		exit;
				}
				break;
			case '12': // HHI I/O TRACHING
			;
				if($form_uses==1){
					header('Location:MEO_hhi_input_info_hhi_input.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    			exit;
				}else if($form_uses==2){
					header('Location:MEO_hhi_input_info_hhi_input1.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    			exit;
    			}else if($form_uses=='3'){
    				$reset=web_decryptIt(str_replace(" ", "+",$_REQUEST['reset']));
    					$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
    					$get_meo_edit="UPDATE `care_master_input_output_tracking_tarina_meo` SET `care_IP_OP_MEO_status`='3' WHERE`care_TARINA_slno`='$slno'";
    					$get_crp_edit="UPDATE `care_master_input_output_tracking_tarina` SET `care_IP_OP_MEO_status`='0' WHERE`care_TARINA_slno`='$reset'";
    					

    					$sql_meo_exe=mysqli_query($conn,$get_meo_edit);
    					$sql_crp_exe=mysqli_query($conn,$get_crp_edit);
    					$sql_get_med_exe=mysqli_query($conn,$get_med);

    					
    					if($sql_crp_exe && $sql_meo_exe){
    						$msg->success('SuccessFully Deleted information of Poultry ');
							header('Location:index.php');
							exit;
    					}else{
    						$msg->success('Some error occured while deleting of Poultry ');
							header('Location:index.php');
							exit;
    					}
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
			case '20':
				if($form_uses==1){
					header('Location:MEO_training_single_edit.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    				exit;
				}else if($form_uses==2){
					header('Location:MEO_training_single_view.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    			exit;
    			}else if($form_uses=='3'){
    				$reset=web_decryptIt(str_replace(" ", "+",$_REQUEST['reset']));
    					$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
    					$get_meo_edit="UPDATE `care_master_mrf_exposure_visit_tarina_meo` SET `care_EV_MEO_status`='3' WHERE`care_LS_slno`='$slno'";
    					$get_crp_edit="UPDATE `care_master_mrf_exposure_visit_tarina` SET `care_EV_MEO_status`='0' WHERE`care_LS_slno`='$reset'";
    					

    					$sql_meo_exe=mysqli_query($conn,$get_meo_edit);
    					$sql_crp_exe=mysqli_query($conn,$get_crp_edit);
    					

    					
    					if($sql_crp_exe && $sql_meo_exe){
    						$msg->success('SuccessFully Deleted information of Training Report ');
							header('Location:index.php');
							exit;
    					}else{
    						$msg->success('Some error occured while deleting of Training Report ');
							header('Location:index.php');
							exit;
    					}
				}else{
					exit;
					header('Location:logout.php');
		    		exit;
				}
				break;	
			case '21':
				if($form_uses==1){
					header('Location:MEO_SHG_SINGLE_edit.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('1'));
    				exit;
				}else if($form_uses==2){
					header('Location:MEO_SHG_SINGLE_view.php?ID='.$hhi_enc.'&TOKEN_ID='.$target_enc.'&TYPE='.web_encryptIt('1').'&year='.$year.'&village='.$village.'&form_uses_id='.web_encryptIt('2'));
    			exit;
    			}else if($form_uses=='3'){
    				$reset=web_decryptIt(str_replace(" ", "+",$_REQUEST['reset']));
    					$slno=web_decryptIt(str_replace(" ", "+",$_REQUEST['care_hhi']));
    					$get_meo_edit="UPDATE `care_master_mrf_shg_tracking_under_tarina_meo` SET `care_SHG_MEO_status`='3' WHERE`care_SHG_slno`='$slno'";
    					$get_crp_edit="UPDATE `care_master_mrf_shg_tracking_under_tarina` SET `care_SHG_MEO_status`='0' WHERE`care_SHG_slno`='$reset'";
    					

    					$sql_meo_exe=mysqli_query($conn,$get_meo_edit);
    					$sql_crp_exe=mysqli_query($conn,$get_crp_edit);
    					

    					
    					if($sql_crp_exe && $sql_meo_exe){
    						$msg->success('SuccessFully Deleted information of SHG Report ');
							header('Location:index.php');
							exit;
    					}else{
    						$msg->success('Some error occured while deleting of HG Report ');
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