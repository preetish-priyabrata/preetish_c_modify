<?php

session_start();
ob_start();

if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();


	$form_type_new=web_decryptIt(str_replace(" ", "+", $_POST['form_type_new']));
	 $form_type_id=web_decryptIt(str_replace(" ", "+", $_POST['form_type_id'])); //to acess switcjh value
	// $slno=web_decryptIt(str_replace(" ", "+", $_POST['form_type_id_div'])); // serilano tobe impact
	$months=web_decryptIt(str_replace(" ", "+", $_POST['form_type_user']));// month
	$comments_mt=$_POST['comments_mt'];
	$slno=$_POST['form_type_id_div'];//
	$date=date('Y-m-d');
	$time=date('H:i:s');
	$meo_user=$_SESSION['meo_user'];
	// exit;
	if($form_type_new=='MEO_comment'){
		switch ($form_type_id) {
			case 'form1':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form1']); // serial mo
				
				
				$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form1']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form1']);

				$datepicker=$_POST['datepicker'];
				$Activity=$_POST['Activity'];
				$Support=$_POST['Support'];
				$Production=$_POST['Production'];
				$Consumption=$_POST['Consumption'];
				$Remarks=$_POST['Remarks'];
				$Signature=$_POST['Signature'];
				$Sale=$_POST['Sale'];
				
				if(count($Activity)==count($slno)){
					 for ($j=0; $j < count($slno); $j++) { 
							 $slno_single=web_decryptIt(str_replace(" ", "+", $slno[$j]));
							 // here update of meo in crp table of i/o tracking
							 $update_meo="UPDATE `care_master_input_output_tracking_tarina` SET `care_IP_OP_MEO_status`='1',`care_IP_OP_MEO_date`='$date',`care_IP_OP_MEO_time`='$time',`care_IP_OP_MEO_id`='$meo_user' WHERE`care_TARINA_slno`='$slno_single'";
							 $sql_get_detail_update_meo=mysqli_query($conn,$update_meo);
							 // here basic information of crp table is uploade in one go
							 $check_before_uploade="SELECT * FROM `care_master_input_output_tracking_tarina_meo` where `care_crp_slno_entry`='$slno_single' and `care_MTF_MEO_status`='1'";
							 $sql_check=mysqli_query($conn,$check_before_uploade);
							 $num_upload_hhi=mysqli_num_rows($sql_check);
							 if($num_upload_hhi==0){
							 	$get_info="INSERT INTO `care_master_input_output_tracking_tarina_meo`(`care_crp_slno_entry`, `care_TARINA_year`, `care_TARINA_month`, `care_TARINA_district_name`, `care_TARINA_block_name`, `care_TARINA_gp_name`, `care_TARINA_vlg_name`, `care_TARINA_hhi`, `care_TARINA_hhi_slno`, `care_TARINA_w_farmer_name`, `care_TARINA_spouse_name`, `care_TARINA_event_date`, `care_TARINA_activity_name`, `care_TARINA_support_provide`, `care_TARINA_production`, `care_TARINA_consumption`, `care_TARINA_sale`, `care_TARINA_remarks`, `care_TARINA_participant_sign`, `care_TARINA_shg_name`, `care_TARINA_social_caste`, `care_TARINA_status`, `care_TARINA_entry_date`, `care_TARINA_entry_time`, `care_TARINA_long_id`, `care_TARINA_lat_id`, `care_TARINA_employee_id`, `care_IP_OP_mt_comment_empty`, `care_IP_OP_mt_comment_date`, `care_IP_OP_mt_comment_time`, `care_IP_OP_mt_id`, `care_IP_OP_mt_status`, `care_IP_OP_CBO_comment_empty`, `care_IP_OP_CBO_comment_date`, `care_IP_OP_CBO_comment_time`, `care_IP_OP_CBO_comment_status`, `care_IP_OP_CBO_id`, `care_IP_OP_MEO_status`, `care_IP_OP_MEO_date`, `care_IP_OP_MEO_time`, `care_IP_OP_MEO_id`) SELECT * FROM `care_master_input_output_tracking_tarina` WHERE `care_master_input_output_tracking_tarina`.`care_TARINA_slno`= '$slno_single'";
								$sql_get_detail_int=mysqli_query($conn,$get_info);
							}

						}
						for ($i=0; $i <count($slno) ; $i++) {
							$din[]=$slno_singles=web_decryptIt(str_replace(" ", "+", $slno[$i]));
							$datepicker_single=date('Y-m-d',strtotime(trim($datepicker[$i])));
							$Activity_single=$Activity[$i];
							$Support_single=$Support[$i];
							$Production_single=$Production[$i];
							$Consumption_single=$Consumption[$i];
							$Remarks_single=$Remarks[$i];
							$Signature_single=$Signature[$i];
							$Sale_s=$Sale[$i];

							$update="UPDATE `care_master_input_output_tracking_tarina_meo` SET `care_TARINA_event_date_edit`='$datepicker_single',`care_TARINA_event_date_status`='2',`care_TARINA_activity_name_edit`='$Activity_single',`care_TARINA_activity_name_status`='2',`care_TARINA_support_provider_edit`='$Support_single',`care_TARINA_support_provider_status`='2',`care_TARINA_production_edit`='$Production_single',`care_TARINA_production_status`='2',`care_TARINA_consumption_edit`='$Consumption_single',`care_TARINA_consumption_status`='2',`care_TARINA_sale_edit`='$Sale_s',`care_TARINA_sale_status`='2',`care_TARINA_remarks_edit`='$Remarks_single',`care_TARINA_remarks_status`='2',`care_TARINA_participant_sign_edit`='$Signature_single',`care_TARINA_participant_sign_status`='2',`care_TARINA_entry_date_edit`='$date',`care_TARINA_entry_time_edit`='$time' WHERE `care_crp_slno_entry`='$slno_singles'";
							$sql_get_detailsss=mysqli_query($conn,$update);


						}
						// here information is uploaded once
					// Consumption_single
					$update_1="UPDATE `care_master_input_output_tracking_tarina_meo` INNER JOIN `care_master_input_output_tracking_tarina` ON `care_master_input_output_tracking_tarina`.`care_TARINA_slno` = `care_master_input_output_tracking_tarina_meo`.`care_crp_slno_entry` AND `care_master_input_output_tracking_tarina`.`care_TARINA_consumption`=`care_master_input_output_tracking_tarina_meo`.`care_TARINA_consumption_edit`SET `care_master_input_output_tracking_tarina_meo`.`care_TARINA_consumption_status`= '1'";
					$sql_get_detail1=mysqli_query($conn,$update_1);
					// datepicker_single
					$update_2="UPDATE `care_master_input_output_tracking_tarina_meo` INNER JOIN `care_master_input_output_tracking_tarina` ON `care_master_input_output_tracking_tarina`.`care_TARINA_slno` = `care_master_input_output_tracking_tarina_meo`.`care_crp_slno_entry` AND `care_master_input_output_tracking_tarina`.`care_TARINA_event_date`=`care_master_input_output_tracking_tarina_meo`.`care_TARINA_event_date_edit`SET `care_master_input_output_tracking_tarina_meo`.`care_TARINA_event_date_status`= '1'";
					$sql_get_detail2=mysqli_query($conn,$update_2);
					// Activity_single
					$update_3="UPDATE `care_master_input_output_tracking_tarina_meo` INNER JOIN `care_master_input_output_tracking_tarina` ON `care_master_input_output_tracking_tarina`.`care_TARINA_slno` = `care_master_input_output_tracking_tarina_meo`.`care_crp_slno_entry` AND `care_master_input_output_tracking_tarina`.`care_TARINA_activity_name`=`care_master_input_output_tracking_tarina_meo`.`care_TARINA_activity_name_edit`SET `care_master_input_output_tracking_tarina_meo`.`care_TARINA_activity_name_status`= '1'";
					$sql_get_detail3=mysqli_query($conn,$update_3);
					// Support_single
					$update_4="UPDATE `care_master_input_output_tracking_tarina_meo` INNER JOIN `care_master_input_output_tracking_tarina` ON `care_master_input_output_tracking_tarina`.`care_TARINA_slno` = `care_master_input_output_tracking_tarina_meo`.`care_crp_slno_entry` AND `care_master_input_output_tracking_tarina`.`care_TARINA_support_provide`=`care_master_input_output_tracking_tarina_meo`.`care_TARINA_support_provider_edit`SET `care_master_input_output_tracking_tarina_meo`.`care_TARINA_support_provider_status`= '1'";
					$sql_get_detail4=mysqli_query($conn,$update_4);
					// Production_single
					$update_5="UPDATE `care_master_input_output_tracking_tarina_meo` INNER JOIN `care_master_input_output_tracking_tarina` ON `care_master_input_output_tracking_tarina`.`care_TARINA_slno` = `care_master_input_output_tracking_tarina_meo`.`care_crp_slno_entry` AND `care_master_input_output_tracking_tarina`.`care_TARINA_production`=`care_master_input_output_tracking_tarina_meo`.`care_TARINA_production_edit`SET `care_master_input_output_tracking_tarina_meo`.`care_TARINA_production_status`= '1'";
					$sql_get_detail5=mysqli_query($conn,$update_5);
					// Remarks_single
					$update_6="UPDATE `care_master_input_output_tracking_tarina_meo` INNER JOIN `care_master_input_output_tracking_tarina` ON `care_master_input_output_tracking_tarina`.`care_TARINA_slno` = `care_master_input_output_tracking_tarina_meo`.`care_crp_slno_entry` AND `care_master_input_output_tracking_tarina`.`care_TARINA_remarks`=`care_master_input_output_tracking_tarina_meo`.`care_TARINA_remarks_edit`SET `care_master_input_output_tracking_tarina_meo`.`care_TARINA_remarks_status`= '1'";
					$sql_get_detail6=mysqli_query($conn,$update_6);
					// Signature_single
					$update_7="UPDATE `care_master_input_output_tracking_tarina_meo` INNER JOIN `care_master_input_output_tracking_tarina` ON `care_master_input_output_tracking_tarina`.`care_TARINA_slno` = `care_master_input_output_tracking_tarina_meo`.`care_crp_slno_entry` AND `care_master_input_output_tracking_tarina`.`care_TARINA_participant_sign`=`care_master_input_output_tracking_tarina_meo`.`care_TARINA_participant_sign_edit`SET `care_master_input_output_tracking_tarina_meo`.`care_TARINA_participant_sign_status`= '1'";
					$sql_get_detail7=mysqli_query($conn,$update_7);
					// Sale_s
					$update_8="UPDATE `care_master_input_output_tracking_tarina_meo` INNER JOIN `care_master_input_output_tracking_tarina` ON `care_master_input_output_tracking_tarina`.`care_TARINA_slno` = `care_master_input_output_tracking_tarina_meo`.`care_crp_slno_entry` AND `care_master_input_output_tracking_tarina`.`care_TARINA_sale`=`care_master_input_output_tracking_tarina_meo`.`care_TARINA_sale_edit`SET `care_master_input_output_tracking_tarina_meo`.`care_TARINA_sale_status`= '1'";
					$sql_get_detail8=mysqli_query($conn,$update_8);
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}
				
				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_MEO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]=$get_userilaze_form1_date_single;
						$array_form1[]=$care_MEO_status_form1[$i];
						
					}

				}
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form1);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form1`='$care_MEO_status_form1_new',`care_MEO_date_form1`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully Edited information of Input & Output tracking of HHI '.$hhi);
				header('Location:index.php');
				exit;				
				break;
			case 'form2':
			
				$care_CT_status=$_POST['care_CT_status'];
				$care_CT_subject_matter=$_POST['care_CT_subject_matter'];
				$care_CT_male_present=$_POST['care_CT_male_present'];
				$care_CT_feamle_present=$_POST['care_CT_feamle_present'];
				$care_DP_status=$_POST['care_DP_status'];
				$care_DP_subject_matter=$_POST['care_DP_subject_matter'];
				$care_DP_male_present=$_POST['care_DP_male_present'];
				$care_DP_female_present=$_POST['care_DP_female_present'];
				$care_IP_name=$_POST['care_IP_name'];
				// $care_IP_others=$_POST['care_IP_others'];
				$care_implements=$_POST['care_implements'];
				$care_farmer_parcticing=$_POST['care_farmer_parcticing'];
				
				if(count($slno)==count($care_CT_status)){
					for ($i=0; $i <count($slno) ; $i++) { 
						$care_CT_status_edit=$care_CT_status[$i];
						$care_CT_subject_matter_edit=$care_CT_subject_matter[$i];
						$care_CT_male_present_edit=$care_CT_male_present[$i];
						$care_CT_female_present_edit=$care_CT_feamle_present[$i];
						$care_DP_status_edit=$care_DP_status[$i];
						$care_DP_subject_matter_edit=$care_DP_subject_matter[$i];
						$care_DP_male_present_edit=$care_DP_male_present[$i];
						$care_DP_female_present_edit=$care_DP_female_present[$i];
						$care_IP_name_edit=$care_IP_name[$i];
						$care_implements_edit=$care_implements[$i];
						$care_farmer_parcticing_edit=$care_farmer_parcticing[$i];

						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$phl_update="UPDATE `care_master_post_harvest_loss` SET `care_PHL_MEO_status`='1',`care_PHL_MEO_date`='$date',`care_PHL_MEO_time`='$time',`care_PHL_MEO_id`='$meo_user' WHERE `care_PHL_slno`='$slno_single'";
						mysqli_query($conn,$phl_update);
						$check_meo_phl="SELECT * FROM `care_master_post_harvest_loss_meo` WHERE `care_phl_serial_id`='$slno_single' and `care_PHL_MEO_status`='1'";
						$sql_exe_check=mysqli_query($conn,$phl_update);
						$num_check_phl=mysqli_num_rows($sql_exe_check);
						if($num_check_phl==0){

							$insert_phl=" INSERT INTO `care_master_post_harvest_loss_meo`(`care_phl_serial_id`, `care_PHL_hhid`, `care_PHL_women_farmer`, `care_PHL_spouse_name`, `care_CT_status`, `care_CT_date`, `care_CT_subject_matter`, `care_CT_male_present`, `care_CT_feamle_present`, `care_DP_status`, `care_DP_date`, `care_DP_subject_matter`, `care_DP_male_present`, `care_DP_female_present`, `care_IP_name`, `care_IP_others`, `care_implements`, `care_farmer_parcticing`, `care_PHL_lat_id`, `care_PHL_long_id`, `care_PHL_employee_id`, `care_PHL_villege_name`, `care_PHL_block_name`, `care_PHL_district_name`, `care_PHL_month`, `care_PHL_year`, `care_PHL_status`, `care_PHL_date`, `care_PHL_time`, `care_PHL_mt_comment_empty`, `care_PHL_mt_comment_date`, `care_PHL_mt_comment_time`, `care_PHL_mt_comment_status`, `care_PHL_mt_id`, `care_PHL_CBO_comment_empty`, `care_PHL_CBO_comment_date`, `care_PHL_CBO_comment_time`, `care_PHL_CBO_comment_status`, `care_PHL_CBO_id`, `care_PHL_MEO_status`, `care_PHL_MEO_date`, `care_PHL_MEO_time`, `care_PHL_MEO_id`) SELECT * FROM `care_master_post_harvest_loss` where `care_master_post_harvest_loss`.`care_PHL_slno`='$slno_single'";
							$sql_insert=mysqli_query($conn,$insert_phl);
							if($sql_insert){
								$update_info_meo="UPDATE `care_master_post_harvest_loss_meo` SET `care_CT_status_edit`='$care_CT_status_edit',`care_CT_status_status`='2',`care_CT_subject_matter_edit`='$care_CT_subject_matter_edit',`care_CT_subject_matter_status`='2',`care_CT_male_present_edit`='$care_CT_male_present_edit',`care_CT_male_present_status`='2',`care_CT_female_present_edit`='$care_CT_female_present_edit',`care_CT_female_present_status`='2',`care_DP_status_edit`='$care_DP_status_edit',`care_DP_status_status`='2',`care_DP_subject_matter_edit`='$care_DP_subject_matter_edit',`care_DP_subject_matter_status`='2',`care_DP_male_present_edit`='$care_DP_male_present_edit',`care_DP_male_present_status`='2',`care_DP_female_present_edit`='$care_DP_female_present_edit',`care_DP_female_present_status`='2',`care_IP_name_edit`='$care_IP_name_edit',`care_IP_name_status`='2',`care_implements_edit`='$care_implements_edit',`care_implements_status`='2',`care_farmer_parcticing_edit`='$care_farmer_parcticing_edit',`care_farmer_parcticing_status`='2' WHERE `care_phl_serial_id`='$slno_single'";
								mysqli_query($conn,$update_info_meo);
							}
						}
					}
					// update_1
					$update_1="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_CT_status`=`care_master_post_harvest_loss_meo`.`care_CT_status_edit`SET`care_master_post_harvest_loss_meo`.`care_CT_status_status`= '1'";
					$sql_get_detail1=mysqli_query($conn,$update_1);
					// update_2
					$update_2="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_CT_subject_matter`=`care_master_post_harvest_loss_meo`.`care_CT_subject_matter_edit`SET`care_master_post_harvest_loss_meo`.`care_CT_subject_matter_status`= '1'";
					$sql_get_detail2=mysqli_query($conn,$update_2);
					// update_3
					$update_3="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_CT_male_present`=`care_master_post_harvest_loss_meo`.`care_CT_male_present_edit`SET`care_master_post_harvest_loss_meo`.`care_CT_male_present_status`= '1'";
					$sql_get_detail3=mysqli_query($conn,$update_3);
					// update_4
					$update_4="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_CT_feamle_present`=`care_master_post_harvest_loss_meo`.`care_CT_female_present_edit`SET`care_master_post_harvest_loss_meo`.`care_CT_female_present_status`= '1'";
					$sql_get_detail4=mysqli_query($conn,$update_4);
					// update_5
					$update_5="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_DP_status`=`care_master_post_harvest_loss_meo`.`care_DP_status_edit`SET`care_master_post_harvest_loss_meo`.`care_DP_status_status`= '1'";
					$sql_get_detail5=mysqli_query($conn,$update_5);
					// update_6
					$update_6="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_DP_subject_matter`=`care_master_post_harvest_loss_meo`.`care_DP_subject_matter_edit`SET`care_master_post_harvest_loss_meo`.`care_DP_subject_matter_status`= '1'";
					$sql_get_detail6=mysqli_query($conn,$update_6);
					// update_7
					$update_7="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_DP_male_present`=`care_master_post_harvest_loss_meo`.`care_DP_male_present_edit`SET`care_master_post_harvest_loss_meo`.`care_DP_male_present_status`= '1'";
					$sql_get_detail7=mysqli_query($conn,$update_7);
					// update_8
					$update_8="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_DP_female_present`=`care_master_post_harvest_loss_meo`.`care_DP_female_present_edit`SET`care_master_post_harvest_loss_meo`.`care_DP_female_present_status`= '1'";
					$sql_get_detail8=mysqli_query($conn,$update_8);
					// update_9
					$update_9="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_IP_name`=`care_master_post_harvest_loss_meo`.`care_IP_name_edit`SET`care_master_post_harvest_loss_meo`.`care_IP_name_status`= '1'";
					$sql_get_detail9=mysqli_query($conn,$update_9);
					// update_10
					$update_10="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_implements`=`care_master_post_harvest_loss_meo`.`care_implements_edit`SET`care_master_post_harvest_loss_meo`.`care_implements_status`= '1'";
					$sql_get_detail10=mysqli_query($conn,$update_10);
					// update_11
					$update_11="UPDATE`care_master_post_harvest_loss_meo` INNER JOIN`care_master_post_harvest_loss` ON`care_master_post_harvest_loss`.`care_PHL_slno` =`care_master_post_harvest_loss_meo`.`care_phl_serial_id` AND`care_master_post_harvest_loss`.`care_farmer_parcticing`=`care_master_post_harvest_loss_meo`.`care_farmer_parcticing_edit`SET`care_master_post_harvest_loss_meo`.`care_farmer_parcticing_status`= '1'";
					$sql_get_detail11=mysqli_query($conn,$update_11);
				

				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}



				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form2']); // serial mo
				$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form2']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form2']);


				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_MEO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]=$get_userilaze_form1_date_single;
						$array_form1[]=$care_MEO_status_form1[$i];
						
					}

				}
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form1);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form2`='$care_MEO_status_form1_new',`care_MEO_date_form2`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);
				$msg->success('SuccessFully Edited information on Post Harvest Loss of HHI '.$hhi);
				header('Location:index.php');
				exit;
				break;
			case "form3" :
			
				$care_LS_IP_training=$_POST['care_LS_IP_training'];
				$care_LS_IP_extension_support=$_POST['care_LS_IP_extension_support'];
				$care_LS_ES_no_of_animal=$_POST['care_LS_ES_no_of_animal'];
				$care_LS_IP_medicine=$_POST['care_LS_IP_medicine'];
				$care_LS_Med_no_of_animal=$_POST['care_LS_Med_no_of_animal'];
				$care_LS_IP_vaccination=$_POST['care_LS_IP_vaccination'];
				$care_LS_VN_no_of_animal=$_POST['care_LS_VN_no_of_animal'];
				$care_LS_IP_others=$_POST['care_LS_IP_others'];
				$care_LS_IP_others_specify=$_POST['care_LS_IP_others_specify'];
				$care_LS_other_no_of_animal=$_POST['care_LS_other_no_of_animal'];
				$care_LS_total_animal=$_POST['care_LS_total_animal'];
				$care_LS_cultivating_fodder=$_POST['care_LS_cultivating_fodder'];
				$care_LS_cultivated_area=$_POST['care_LS_cultivated_area'];
				$care_LS_new_farmer=$_POST['care_LS_new_farmer'];
				$care_LS_continued_farmer=$_POST['care_LS_continued_farmer'];
				$care_LS_QP_extension_support=$_POST['care_LS_QP_extension_support'];
				$care_QP_slno=$_POST['care_QP_slno'];
				$care_QP_item_name=$_POST['care_QP_item_name'];
				$care_QP_quantity=$_POST['care_QP_quantity'];
				$care_QP_type=$_POST['care_QP_type'];
				if(count($slno)==count($care_LS_IP_training)){
					for ($i=0; $i <count($slno) ; $i++) {

						$care_LS_IP_training_edit=$care_LS_IP_training[$i];
						$care_LS_IP_extension_support_edit=$care_LS_IP_extension_support[$i];
						$care_LS_ES_no_of_animal_edit=$care_LS_ES_no_of_animal[$i];
						$care_LS_IP_medicine_edit=$care_LS_IP_medicine[$i];
						$care_LS_Med_no_of_animal_edit=$care_LS_Med_no_of_animal[$i];
						$care_LS_IP_vaccination_edit=$care_LS_IP_vaccination[$i];
						$care_LS_VN_no_of_animal_edit=$care_LS_VN_no_of_animal[$i];
						$care_LS_IP_others_edit=$care_LS_IP_others[$i];

						$care_LS_IP_others_specify_edits=$care_LS_IP_others_specify[$i];
						if(!empty($care_LS_IP_others_specify_edits)){
							$care_LS_IP_others_specify_edit=$care_LS_IP_others_specify_edits;
						}else{
							$care_LS_IP_others_specify_edit="--";
						}
						$care_LS_other_no_of_animal_edits=$care_LS_other_no_of_animal[$i];
						if(!empty($care_LS_other_no_of_animal_edits)){
							$care_LS_other_no_of_animal_edit=$care_LS_other_no_of_animal_edits;
						}else{
							$care_LS_other_no_of_animal_edit=0;
						}
						$care_LS_total_animal_edit=$care_LS_total_animal[$i];
						$care_LS_cultivating_fodder_edit=$care_LS_cultivating_fodder[$i];
						$care_LS_cultivated_area_edit=$care_LS_cultivated_area[$i];
						$care_LS_new_farmer_edit=$care_LS_new_farmer[$i];
						$care_LS_continued_farmer_edit=$care_LS_continued_farmer[$i];
						$care_LS_QP_extension_support_edit=$care_LS_QP_extension_support[$i];

						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$update_ls="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_MEO_date`='$date',`care_LS_MEO_time`='$time',`care_LS_MEO_status`='1',`care_LS_MEO_id`='$meo_user' WHERE `care_LS_slno`='$slno_single'";
						$sql_ls_update=mysqli_query($conn,$update_ls);
						if($sql_ls_update){
							$check_ls="SELECT * FROM `care_master_mtf_livestock_tarina_meo` where `$care_serial_id`='$slno_single' and `care_LS_MEO_status`='1'";
							$sql_check_ls=mysqli_query($conn,$check_ls);
							$num_check_ls=mysqli_num_rows($sql_check_ls);
							if($num_check_ls==0){
								$insert_ls="INSERT INTO `care_master_mtf_livestock_tarina_meo`( `care_serial_id`, `care_LS_hhid`, `care_LS_women_farmer`, `care_LS_spouse_name`, `care_LS_IP_training`, `care_LS_IP_extension_support`, `care_LS_ES_no_of_animal`, `care_LS_IP_medicine`, `care_LS_Med_no_of_animal`, `care_LS_IP_vaccination`, `care_LS_VN_no_of_animal`, `care_LS_IP_others`, `care_LS_IP_others_specify`, `care_LS_other_no_of_animal`, `care_LS_total_animal`, `care_LS_cultivating_fodder`, `care_LS_cultivated_area`, `care_LS_new_farmer`, `care_LS_continued_farmer`, `care_LS_QP_extension_support`, `care_LS_district_name`, `care_LS_block_name`, `care_LS_gp_name`, `care_LS_vlg_name`, `care_LS_employee_id`, `care_LS_lat_id`, `care_LS_long_id`, `care_LS_month`, `care_LS_year`, `care_LS_date`, `care_LS_time`, `care_LS_status`, `livestock`, `care_LS_mt_comment_empty`, `care_LS_mt_comment_date`, `care_LS_mt_comment_time`, `care_LS_mt_comment_status`, `care_LS_mt_id`, `care_LS_CBO_comment_empty`, `care_LS_CBO_comment_date`, `care_LS_CBO_comment_time`, `care_LS_CBO_comment_status`, `care_LS_CBO_id`, `care_LS_MEO_date`, `care_LS_MEO_time`, `care_LS_MEO_status`, `care_LS_MEO_id`) SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_slno`='$slno_single'";
								$sql_insert_ls=mysqli_query($conn,$insert_ls);
								if($sql_insert_ls){
									$update_meo_ls="UPDATE `care_master_mtf_livestock_tarina_meo` SET `care_LS_IP_training_edit`='$care_LS_IP_training_edit',`care_LS_IP_training_status`='2',`care_LS_IP_extension_support_edit`='$care_LS_IP_extension_support_edit',`care_LS_IP_extension_support_status`='2',`care_LS_ES_no_of_animal_edit`='$care_LS_ES_no_of_animal_edit',`care_LS_ES_no_of_animal_status`='2',`care_LS_IP_medicine_edit`='$care_LS_IP_medicine_edit',`care_LS_IP_medicine_status`='2',`care_LS_Med_no_of_animal_edit`='$care_LS_Med_no_of_animal_edit',`care_LS_Med_no_of_animal_status`='2',`care_LS_IP_vaccination_edit`='$care_LS_IP_vaccination_edit',`care_LS_IP_vaccination_status`='2',`care_LS_VN_no_of_animal_edit`='$care_LS_VN_no_of_animal_edit',`care_LS_VN_no_of_animal_status`='2',`care_LS_IP_others_edit`='$care_LS_IP_others_edit',`care_LS_IP_others_status`='2',`care_LS_IP_others_specify_edit`='$care_LS_IP_others_specify_edit',`care_LS_IP_others_specify_status`='2',`care_LS_other_no_of_animal_edit`='$care_LS_other_no_of_animal_edit',`care_LS_other_no_of_animal_status`='2',`care_LS_total_animal_edit`='$care_LS_total_animal_edit',`care_LS_total_animal_status`='2',`care_LS_cultivating_fodder_edit`='$care_LS_cultivating_fodder_edit',`care_LS_cultivating_fodder_status`='2',`care_LS_cultivated_area_edit`='$care_LS_cultivated_area_edit',`care_LS_cultivated_area_status`='2',`care_LS_new_farmer_edit`='$care_LS_new_farmer_edit',`care_LS_new_farmer_status`='2',`care_LS_continued_farmer_edit`=$care_LS_continued_farmer_edit,`care_LS_continued_farmer_status`='2',`care_LS_QP_extension_support_edit`=$care_LS_QP_extension_support_edit,`care_LS_QP_extension_support_status`='2' WHERE `care_serial_id`='$slno_single'";
									$sql_usp_ls=mysqli_query($conn,$update_meo_ls);
								}
							}
						}

					}
					// care_LS_IP_training_edit
									$update_1="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_training`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_training_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_training_status`= '1'";
									$sql_get_detail1=mysqli_query($conn,$update_1);

									// care_LS_IP_extension_support_edit

									$update_2="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_extension_support`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_extension_support_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_extension_support_status`= '1'";
									$sql_get_detail2=mysqli_query($conn,$update_2);

									// care_LS_ES_no_of_animal_edit

									$update_3="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_ES_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_ES_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_ES_no_of_animal_status`= '1'";
									$sql_get_detail3=mysqli_query($conn,$update_3);

									// care_LS_IP_medicine_edit

									$update_4="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_medicine`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_medicine_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_medicine_status`= '1'";
									$sql_get_detail4=mysqli_query($conn,$update_4);

									// care_LS_Med_no_of_animal_edit

									$update_5="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_Med_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_Med_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_Med_no_of_animal_status`= '1'";
									$sql_get_detail5=mysqli_query($conn,$update_5);

									// care_LS_IP_vaccination_edit

									$update_6="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_vaccination`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_vaccination_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_vaccination_status`= '1'";
									$sql_get_detail6=mysqli_query($conn,$update_6);

									// care_LS_VN_no_of_animal_edit

									$update_7="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_VN_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_VN_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_VN_no_of_animal_status`= '1'";
									$sql_get_detail7=mysqli_query($conn,$update_7);

									// care_LS_IP_others_edit

									$update_8="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_others`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_status`= '1'";
									$sql_get_detail8=mysqli_query($conn,$update_8);

									// care_LS_IP_others_specify_edit

									$update_9="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_others_specify`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_specify_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_specify_status`= '1'";
									$sql_get_detail9=mysqli_query($conn,$update_9);

									// care_LS_other_no_of_animal_edit

									$update_10="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_other_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_other_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_other_no_of_animal_status`= '1'";
									$sql_get_detail10=mysqli_query($conn,$update_10);

									// care_LS_total_animal_edit

									$update_11="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_total_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_total_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_total_animal_status`= '1'";
									$sql_get_detail11=mysqli_query($conn,$update_11);

									// care_LS_cultivating_fodder_edit

									$update_12="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_cultivating_fodder`=`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivating_fodder_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivating_fodder_status`= '1'";
									$sql_get_detail12=mysqli_query($conn,$update_12);

									// care_LS_cultivated_area_edit

									$update_13="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_cultivated_area`=`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivated_area_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivated_area_status`= '1'";
									$sql_get_detail13=mysqli_query($conn,$update_13);

									// care_LS_new_farmer_edit

									$update_14="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_new_farmer`=`care_master_mtf_livestock_tarina_meo`.`care_LS_new_farmer_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_new_farmer_status`= '1'";
									$sql_get_detail14=mysqli_query($conn,$update_14);

									// care_LS_continued_farmer_edit

									$update_15="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_continued_farmer`=`care_master_mtf_livestock_tarina_meo`.`care_LS_continued_farmer_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_continued_farmer_status`= '1'";
									$sql_get_detail15=mysqli_query($conn,$update_15);

									// care_LS_QP_extension_support_edit
									
									$update_16="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_QP_extension_support`=`care_master_mtf_livestock_tarina_meo`.`care_LS_QP_extension_support_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_QP_extension_support_status`= '1'";
									$sql_get_detail16=mysqli_query($conn,$update_16);


					for ($j=0; $j < count($care_QP_slno) ; $j++) { 
						$care_QP_slno_edit=$care_QP_slno[$j];
						$care_QP_item_name_edit=$care_QP_item_name[$j];
						$care_QP_quantity_edit=$care_QP_quantity[$j];
						$care_QP_type_edit=$care_QP_type[$j];

						$check_med=" SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_med_serial`='$care_QP_slno_edit' and `care_QP_status`='1'";
						$sql_med_check=mysqli_query($conn,$check_med);
						$num_med=mysqli_num_rows($sql_med_check);
						
						if($num_med==0){
							$sql_qnty="INSERT INTO `care_master_livestock_quantity_provided_meo`( `care_med_serial`, `care_QP_hhid`, `live_stock_id`, `care_QP_livestock_slno`, `care_QP_item_name`, `care_QP_quantity`, `care_QP_type`, `care_QP_month`, `care_QP_date`, `care_QP_time`, `care_QP_status`, `care_QP_year`) SELECT * FROM `care_master_livestock_quantity_provided` WHERE `care_QP_slno`='$care_QP_slno_edit'";
							$sql_med_check_insert=mysqli_query($conn,$sql_qnty);
							if($sql_med_check_insert){
								$query_update="UPDATE `care_master_livestock_quantity_provided_meo` SET `care_QP_item_name_edit`='$care_QP_item_name_edit',`care_QP_item_name_status`='2',`care_QP_quantity_edit`='$care_QP_quantity_edit',`care_QP_quantity_status`='2',`care_QP_type_edit`='$care_QP_type_edit',`care_QP_type_status`='2' WHERE `care_med_serial`='$care_QP_slno_edit'";
								$sql_med_check_insert12=mysqli_query($conn,$query_update);
								
							}
						}
						

					}
					// care_QP_quantity_edit

					$update_17="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_item_name`=`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_status`= '1'";
					$sql_get_detail17=mysqli_query($conn,$update_17);

					// care_QP_quantity_edit

					$update_18="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_quantity`=`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_status`= '1'";
					$sql_get_detail18=mysqli_query($conn,$update_18);

					// care_QP_type_edit
					
					$update_19="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_type`=`care_master_livestock_quantity_provided_meo`.`care_QP_type_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_type_status`= '1'";
					$sql_get_detail16=mysqli_query($conn,$update_19);
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}
	// usha fill here
				$hhi=$_POST['care_hhi'];
					$Year=$_POST['Year'];
					$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
					$sql_get_detail=mysqli_query($conn,$get_details);

					$fetch_check=mysqli_fetch_assoc($sql_get_detail);
					$slno_md=$fetch_check['care_hhi_sl_no'];
					$get_userilaze_form1=unserialize($fetch_check['care_form3']); // serial mo
					$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form3']);//
					$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form3']);


					for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
						$get_userilaze_form1_q=$get_userilaze_form1[$i];
						$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
						if(in_array($get_userilaze_form1_q,$din)){
							if($care_MEO_status_form1[$i]==2){
								$array_date[]=$date;
								$array_form1[]=1;
								$array_form2[]=2;
							}else{
								$array_date[]=$get_userilaze_form1_date_single;
								$array_form1[]=1;
								$array_form2[]=2;
							}
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=$care_MEO_status_form1[$i];
							
						}

					}
						$date_mt=serialize($array_date);
						$care_CBO_status_form1_new=serialize($array_form1);
						$care_MEO_status_form1_new=serialize($array_form1);
					 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form3`='$care_MEO_status_form1_new',`care_MEO_date_form3`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
					mysqli_query($conn,$update);
					$msg->success('SuccessFully Edited information on Post Harvest Loss of HHI '.$hhi);
					header('Location:index.php');
					exit;

				break;
		case "form4" :
			
				$care_LS_IP_training=$_POST['care_LS_IP_training'];
				$care_LS_IP_extension_support=$_POST['care_LS_IP_extension_support'];
				$care_LS_ES_no_of_animal=$_POST['care_LS_ES_no_of_animal'];
				$care_LS_IP_medicine=$_POST['care_LS_IP_medicine'];
				$care_LS_Med_no_of_animal=$_POST['care_LS_Med_no_of_animal'];
				$care_LS_IP_vaccination=$_POST['care_LS_IP_vaccination'];
				$care_LS_VN_no_of_animal=$_POST['care_LS_VN_no_of_animal'];
				$care_LS_IP_others=$_POST['care_LS_IP_others'];
				$care_LS_IP_others_specify=$_POST['care_LS_IP_others_specify'];
				$care_LS_other_no_of_animal=$_POST['care_LS_other_no_of_animal'];
				$care_LS_total_animal=$_POST['care_LS_total_animal'];
				$care_LS_cultivating_fodder=$_POST['care_LS_cultivating_fodder'];
				$care_LS_cultivated_area=$_POST['care_LS_cultivated_area'];
				$care_LS_new_farmer=$_POST['care_LS_new_farmer'];
				$care_LS_continued_farmer=$_POST['care_LS_continued_farmer'];
				$care_LS_QP_extension_support=$_POST['care_LS_QP_extension_support'];
				$care_QP_slno=$_POST['care_QP_slno'];
				$care_QP_item_name=$_POST['care_QP_item_name'];
				$care_QP_quantity=$_POST['care_QP_quantity'];
				$care_QP_type=$_POST['care_QP_type'];
				if(count($slno)==count($care_LS_IP_training)){
					for ($i=0; $i <count($slno) ; $i++) {

						$care_LS_IP_training_edit=$care_LS_IP_training[$i];
						$care_LS_IP_extension_support_edit=$care_LS_IP_extension_support[$i];
						$care_LS_ES_no_of_animal_edit=$care_LS_ES_no_of_animal[$i];
						$care_LS_IP_medicine_edit=$care_LS_IP_medicine[$i];
						$care_LS_Med_no_of_animal_edit=$care_LS_Med_no_of_animal[$i];
						$care_LS_IP_vaccination_edit=$care_LS_IP_vaccination[$i];
						$care_LS_VN_no_of_animal_edit=$care_LS_VN_no_of_animal[$i];
						$care_LS_IP_others_edit=$care_LS_IP_others[$i];

						$care_LS_IP_others_specify_edits=$care_LS_IP_others_specify[$i];
						if(!empty($care_LS_IP_others_specify_edits)){
							$care_LS_IP_others_specify_edit=$care_LS_IP_others_specify_edits;
						}else{
							$care_LS_IP_others_specify_edit="--";
						}
						$care_LS_other_no_of_animal_edits=$care_LS_other_no_of_animal[$i];
						if(!empty($care_LS_other_no_of_animal_edits)){
							$care_LS_other_no_of_animal_edit=$care_LS_other_no_of_animal_edits;
						}else{
							$care_LS_other_no_of_animal_edit=0;
						}
						$care_LS_total_animal_edit=$care_LS_total_animal[$i];
						$care_LS_cultivating_fodder_edit=$care_LS_cultivating_fodder[$i];
						$care_LS_cultivated_area_edit=$care_LS_cultivated_area[$i];
						$care_LS_new_farmer_edit=$care_LS_new_farmer[$i];
						$care_LS_continued_farmer_edit=$care_LS_continued_farmer[$i];
						$care_LS_QP_extension_support_edit=$care_LS_QP_extension_support[$i];

						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$update_ls="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_MEO_date`='$date',`care_LS_MEO_time`='$time',`care_LS_MEO_status`='1',`care_LS_MEO_id`='$meo_user' WHERE `care_LS_slno`='$slno_single'";
						$sql_ls_update=mysqli_query($conn,$update_ls);
						if($sql_ls_update){
							$check_ls="SELECT * FROM `care_master_mtf_livestock_tarina_meo` where `$care_serial_id`='$slno_single' and `care_LS_MEO_status`='1'";
							$sql_check_ls=mysqli_query($conn,$check_ls);
							$num_check_ls=mysqli_num_rows($sql_check_ls);
							if($num_check_ls==0){
								$insert_ls="INSERT INTO `care_master_mtf_livestock_tarina_meo`( `care_serial_id`, `care_LS_hhid`, `care_LS_women_farmer`, `care_LS_spouse_name`, `care_LS_IP_training`, `care_LS_IP_extension_support`, `care_LS_ES_no_of_animal`, `care_LS_IP_medicine`, `care_LS_Med_no_of_animal`, `care_LS_IP_vaccination`, `care_LS_VN_no_of_animal`, `care_LS_IP_others`, `care_LS_IP_others_specify`, `care_LS_other_no_of_animal`, `care_LS_total_animal`, `care_LS_cultivating_fodder`, `care_LS_cultivated_area`, `care_LS_new_farmer`, `care_LS_continued_farmer`, `care_LS_QP_extension_support`, `care_LS_district_name`, `care_LS_block_name`, `care_LS_gp_name`, `care_LS_vlg_name`, `care_LS_employee_id`, `care_LS_lat_id`, `care_LS_long_id`, `care_LS_month`, `care_LS_year`, `care_LS_date`, `care_LS_time`, `care_LS_status`, `livestock`, `care_LS_mt_comment_empty`, `care_LS_mt_comment_date`, `care_LS_mt_comment_time`, `care_LS_mt_comment_status`, `care_LS_mt_id`, `care_LS_CBO_comment_empty`, `care_LS_CBO_comment_date`, `care_LS_CBO_comment_time`, `care_LS_CBO_comment_status`, `care_LS_CBO_id`, `care_LS_MEO_date`, `care_LS_MEO_time`, `care_LS_MEO_status`, `care_LS_MEO_id`) SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_slno`='$slno_single'";
								$sql_insert_ls=mysqli_query($conn,$insert_ls);
								if($sql_insert_ls){
									$update_meo_ls="UPDATE `care_master_mtf_livestock_tarina_meo` SET `care_LS_IP_training_edit`='$care_LS_IP_training_edit',`care_LS_IP_training_status`='2',`care_LS_IP_extension_support_edit`='$care_LS_IP_extension_support_edit',`care_LS_IP_extension_support_status`='2',`care_LS_ES_no_of_animal_edit`='$care_LS_ES_no_of_animal_edit',`care_LS_ES_no_of_animal_status`='2',`care_LS_IP_medicine_edit`='$care_LS_IP_medicine_edit',`care_LS_IP_medicine_status`='2',`care_LS_Med_no_of_animal_edit`='$care_LS_Med_no_of_animal_edit',`care_LS_Med_no_of_animal_status`='2',`care_LS_IP_vaccination_edit`='$care_LS_IP_vaccination_edit',`care_LS_IP_vaccination_status`='2',`care_LS_VN_no_of_animal_edit`='$care_LS_VN_no_of_animal_edit',`care_LS_VN_no_of_animal_status`='2',`care_LS_IP_others_edit`='$care_LS_IP_others_edit',`care_LS_IP_others_status`='2',`care_LS_IP_others_specify_edit`='$care_LS_IP_others_specify_edit',`care_LS_IP_others_specify_status`='2',`care_LS_other_no_of_animal_edit`='$care_LS_other_no_of_animal_edit',`care_LS_other_no_of_animal_status`='2',`care_LS_total_animal_edit`='$care_LS_total_animal_edit',`care_LS_total_animal_status`='2',`care_LS_cultivating_fodder_edit`='$care_LS_cultivating_fodder_edit',`care_LS_cultivating_fodder_status`='2',`care_LS_cultivated_area_edit`='$care_LS_cultivated_area_edit',`care_LS_cultivated_area_status`='2',`care_LS_new_farmer_edit`='$care_LS_new_farmer_edit',`care_LS_new_farmer_status`='2',`care_LS_continued_farmer_edit`=$care_LS_continued_farmer_edit,`care_LS_continued_farmer_status`='2',`care_LS_QP_extension_support_edit`=$care_LS_QP_extension_support_edit,`care_LS_QP_extension_support_status`='2' WHERE `care_serial_id`='$slno_single'";
									$sql_usp_ls=mysqli_query($conn,$update_meo_ls);
								}
							}
						}

				    }
					// care_LS_IP_training_edit
									$update_1="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_training`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_training_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_training_status`= '1'";
									$sql_get_detail1=mysqli_query($conn,$update_1);

									// care_LS_IP_extension_support_edit

									$update_2="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_extension_support`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_extension_support_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_extension_support_status`= '1'";
									$sql_get_detail2=mysqli_query($conn,$update_2);

									// care_LS_ES_no_of_animal_edit

									$update_3="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_ES_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_ES_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_ES_no_of_animal_status`= '1'";
									$sql_get_detail3=mysqli_query($conn,$update_3);

									// care_LS_IP_medicine_edit

									$update_4="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_medicine`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_medicine_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_medicine_status`= '1'";
									$sql_get_detail4=mysqli_query($conn,$update_4);

									// care_LS_Med_no_of_animal_edit

									$update_5="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_Med_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_Med_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_Med_no_of_animal_status`= '1'";
									$sql_get_detail5=mysqli_query($conn,$update_5);

									// care_LS_IP_vaccination_edit

									$update_6="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_vaccination`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_vaccination_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_vaccination_status`= '1'";
									$sql_get_detail6=mysqli_query($conn,$update_6);

									// care_LS_VN_no_of_animal_edit

									$update_7="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_VN_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_VN_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_VN_no_of_animal_status`= '1'";
									$sql_get_detail7=mysqli_query($conn,$update_7);

									// care_LS_IP_others_edit

									$update_8="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_others`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_status`= '1'";
									$sql_get_detail8=mysqli_query($conn,$update_8);

									// care_LS_IP_others_specify_edit

									$update_9="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_others_specify`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_specify_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_specify_status`= '1'";
									$sql_get_detail9=mysqli_query($conn,$update_9);

									// care_LS_other_no_of_animal_edit

									$update_10="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_other_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_other_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_other_no_of_animal_status`= '1'";
									$sql_get_detail10=mysqli_query($conn,$update_10);

									// care_LS_total_animal_edit

									$update_11="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_total_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_total_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_total_animal_status`= '1'";
									$sql_get_detail11=mysqli_query($conn,$update_11);

									// care_LS_cultivating_fodder_edit

									$update_12="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_cultivating_fodder`=`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivating_fodder_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivating_fodder_status`= '1'";
									$sql_get_detail12=mysqli_query($conn,$update_12);

									// care_LS_cultivated_area_edit

									$update_13="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_cultivated_area`=`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivated_area_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivated_area_status`= '1'";
									$sql_get_detail13=mysqli_query($conn,$update_13);

									// care_LS_new_farmer_edit

									$update_14="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_new_farmer`=`care_master_mtf_livestock_tarina_meo`.`care_LS_new_farmer_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_new_farmer_status`= '1'";
									$sql_get_detail14=mysqli_query($conn,$update_14);

									// care_LS_continued_farmer_edit

									$update_15="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_continued_farmer`=`care_master_mtf_livestock_tarina_meo`.`care_LS_continued_farmer_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_continued_farmer_status`= '1'";
									$sql_get_detail15=mysqli_query($conn,$update_15);

									// care_LS_QP_extension_support_edit
									
									$update_16="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_QP_extension_support`=`care_master_mtf_livestock_tarina_meo`.`care_LS_QP_extension_support_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_QP_extension_support_status`= '1'";
									$sql_get_detail16=mysqli_query($conn,$update_16);


					for ($j=0; $j < count($care_QP_slno) ; $j++) { 
						$care_QP_slno_edit=$care_QP_slno[$j];
						$care_QP_item_name_edit=$care_QP_item_name[$j];
						$care_QP_quantity_edit=$care_QP_quantity[$j];
						$care_QP_type_edit=$care_QP_type[$j];

						$check_med=" SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_med_serial`='$care_QP_slno_edit' and `care_QP_status`='1'";
						$sql_med_check=mysqli_query($conn,$check_med);
						$num_med=mysqli_num_rows($sql_med_check);
						
						if($num_med==0){
							$sql_qnty="INSERT INTO `care_master_livestock_quantity_provided_meo`( `care_med_serial`, `care_QP_hhid`, `live_stock_id`, `care_QP_livestock_slno`, `care_QP_item_name`, `care_QP_quantity`, `care_QP_type`, `care_QP_month`, `care_QP_date`, `care_QP_time`, `care_QP_status`, `care_QP_year`) SELECT * FROM `care_master_livestock_quantity_provided` WHERE `care_QP_slno`='$care_QP_slno_edit'";
							$sql_med_check_insert=mysqli_query($conn,$sql_qnty);
							if($sql_med_check_insert){
								$query_update="UPDATE `care_master_livestock_quantity_provided_meo` SET `care_QP_item_name_edit`='$care_QP_item_name_edit',`care_QP_item_name_status`='2',`care_QP_quantity_edit`='$care_QP_quantity_edit',`care_QP_quantity_status`='2',`care_QP_type_edit`='$care_QP_type_edit',`care_QP_type_status`='2' WHERE `care_med_serial`='$care_QP_slno_edit'";
								$sql_med_check_insert12=mysqli_query($conn,$query_update);
							}
						}	

					}
					// care_QP_quantity_edit

					$update_17="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_item_name`=`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_status`= '1'";
					$sql_get_detail17=mysqli_query($conn,$update_17);

					// care_QP_quantity_edit

					$update_18="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_quantity`=`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_status`= '1'";
					$sql_get_detail18=mysqli_query($conn,$update_18);

					// care_QP_type_edit
					
					$update_19="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_type`=`care_master_livestock_quantity_provided_meo`.`care_QP_type_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_type_status`= '1'";
					$sql_get_detail16=mysqli_query($conn,$update_19);
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}
	// usha fill here
				$hhi=$_POST['care_hhi'];
					$Year=$_POST['Year'];
					$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
					$sql_get_detail=mysqli_query($conn,$get_details);

					$fetch_check=mysqli_fetch_assoc($sql_get_detail);
					$slno_md=$fetch_check['care_hhi_sl_no'];
					$get_userilaze_form1=unserialize($fetch_check['care_form4']); // serial mo
					$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form4']);//
					$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form4']);


					for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
						$get_userilaze_form1_q=$get_userilaze_form1[$i];
						$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
						if(in_array($get_userilaze_form1_q,$din)){
							if($care_MEO_status_form1[$i]==2){
								$array_date[]=$date;
								$array_form1[]=1;
								$array_form2[]=2;
							}else{
								$array_date[]=$get_userilaze_form1_date_single;
								$array_form1[]=1;
								$array_form2[]=2;
							}
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=$care_MEO_status_form1[$i];
							
						}

					}
						$date_mt=serialize($array_date);
						$care_CBO_status_form1_new=serialize($array_form1);
						$care_MEO_status_form1_new=serialize($array_form1);
					 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form4`='$care_MEO_status_form1_new',`care_MEO_date_form4`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
					mysqli_query($conn,$update);
					$msg->success('SuccessFully Edited information on Post Harvest Loss of HHI '.$hhi);
					header('Location:index.php');
					exit;

				break;
			case "form5" :
			
				$care_LS_IP_training=$_POST['care_LS_IP_training'];
				$care_LS_IP_extension_support=$_POST['care_LS_IP_extension_support'];
				$care_LS_ES_no_of_animal=$_POST['care_LS_ES_no_of_animal'];
				$care_LS_IP_medicine=$_POST['care_LS_IP_medicine'];
				$care_LS_Med_no_of_animal=$_POST['care_LS_Med_no_of_animal'];
				$care_LS_IP_vaccination=$_POST['care_LS_IP_vaccination'];
				$care_LS_VN_no_of_animal=$_POST['care_LS_VN_no_of_animal'];
				$care_LS_IP_others=$_POST['care_LS_IP_others'];
				$care_LS_IP_others_specify=$_POST['care_LS_IP_others_specify'];
				$care_LS_other_no_of_animal=$_POST['care_LS_other_no_of_animal'];
				$care_LS_total_animal=$_POST['care_LS_total_animal'];
				$care_LS_cultivating_fodder=$_POST['care_LS_cultivating_fodder'];
				$care_LS_cultivated_area=$_POST['care_LS_cultivated_area'];
				$care_LS_new_farmer=$_POST['care_LS_new_farmer'];
				$care_LS_continued_farmer=$_POST['care_LS_continued_farmer'];
				$care_LS_QP_extension_support=$_POST['care_LS_QP_extension_support'];
				$care_QP_slno=$_POST['care_QP_slno'];
				$care_QP_item_name=$_POST['care_QP_item_name'];
				$care_QP_quantity=$_POST['care_QP_quantity'];
				$care_QP_type=$_POST['care_QP_type'];
				if(count($slno)==count($care_LS_IP_training)){
					for ($i=0; $i <count($slno) ; $i++) {

						$care_LS_IP_training_edit=$care_LS_IP_training[$i];
						$care_LS_IP_extension_support_edit=$care_LS_IP_extension_support[$i];
						$care_LS_ES_no_of_animal_edit=$care_LS_ES_no_of_animal[$i];
						$care_LS_IP_medicine_edit=$care_LS_IP_medicine[$i];
						$care_LS_Med_no_of_animal_edit=$care_LS_Med_no_of_animal[$i];
						$care_LS_IP_vaccination_edit=$care_LS_IP_vaccination[$i];
						$care_LS_VN_no_of_animal_edit=$care_LS_VN_no_of_animal[$i];
						$care_LS_IP_others_edit=$care_LS_IP_others[$i];

						$care_LS_IP_others_specify_edits=$care_LS_IP_others_specify[$i];
						if(!empty($care_LS_IP_others_specify_edits)){
							$care_LS_IP_others_specify_edit=$care_LS_IP_others_specify_edits;
						}else{
							$care_LS_IP_others_specify_edit="--";
						}
						$care_LS_other_no_of_animal_edits=$care_LS_other_no_of_animal[$i];
						if(!empty($care_LS_other_no_of_animal_edits)){
							$care_LS_other_no_of_animal_edit=$care_LS_other_no_of_animal_edits;
						}else{
							$care_LS_other_no_of_animal_edit=0;
						}
						$care_LS_total_animal_edit=$care_LS_total_animal[$i];
						$care_LS_cultivating_fodder_edit=$care_LS_cultivating_fodder[$i];
						$care_LS_cultivated_area_edit=$care_LS_cultivated_area[$i];
						$care_LS_new_farmer_edit=$care_LS_new_farmer[$i];
						$care_LS_continued_farmer_edit=$care_LS_continued_farmer[$i];
						$care_LS_QP_extension_support_edit=$care_LS_QP_extension_support[$i];

						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$update_ls="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_MEO_date`='$date',`care_LS_MEO_time`='$time',`care_LS_MEO_status`='1',`care_LS_MEO_id`='$meo_user' WHERE `care_LS_slno`='$slno_single'";
						$sql_ls_update=mysqli_query($conn,$update_ls);
						if($sql_ls_update){
							$check_ls="SELECT * FROM `care_master_mtf_livestock_tarina_meo` where `$care_serial_id`='$slno_single' and `care_LS_MEO_status`='1'";
							$sql_check_ls=mysqli_query($conn,$check_ls);
							$num_check_ls=mysqli_num_rows($sql_check_ls);
							if($num_check_ls==0){
								$insert_ls="INSERT INTO `care_master_mtf_livestock_tarina_meo`( `care_serial_id`, `care_LS_hhid`, `care_LS_women_farmer`, `care_LS_spouse_name`, `care_LS_IP_training`, `care_LS_IP_extension_support`, `care_LS_ES_no_of_animal`, `care_LS_IP_medicine`, `care_LS_Med_no_of_animal`, `care_LS_IP_vaccination`, `care_LS_VN_no_of_animal`, `care_LS_IP_others`, `care_LS_IP_others_specify`, `care_LS_other_no_of_animal`, `care_LS_total_animal`, `care_LS_cultivating_fodder`, `care_LS_cultivated_area`, `care_LS_new_farmer`, `care_LS_continued_farmer`, `care_LS_QP_extension_support`, `care_LS_district_name`, `care_LS_block_name`, `care_LS_gp_name`, `care_LS_vlg_name`, `care_LS_employee_id`, `care_LS_lat_id`, `care_LS_long_id`, `care_LS_month`, `care_LS_year`, `care_LS_date`, `care_LS_time`, `care_LS_status`, `livestock`, `care_LS_mt_comment_empty`, `care_LS_mt_comment_date`, `care_LS_mt_comment_time`, `care_LS_mt_comment_status`, `care_LS_mt_id`, `care_LS_CBO_comment_empty`, `care_LS_CBO_comment_date`, `care_LS_CBO_comment_time`, `care_LS_CBO_comment_status`, `care_LS_CBO_id`, `care_LS_MEO_date`, `care_LS_MEO_time`, `care_LS_MEO_status`, `care_LS_MEO_id`) SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_slno`='$slno_single'";
								$sql_insert_ls=mysqli_query($conn,$insert_ls);
								if($sql_insert_ls){
									$update_meo_ls="UPDATE `care_master_mtf_livestock_tarina_meo` SET `care_LS_IP_training_edit`='$care_LS_IP_training_edit',`care_LS_IP_training_status`='2',`care_LS_IP_extension_support_edit`='$care_LS_IP_extension_support_edit',`care_LS_IP_extension_support_status`='2',`care_LS_ES_no_of_animal_edit`='$care_LS_ES_no_of_animal_edit',`care_LS_ES_no_of_animal_status`='2',`care_LS_IP_medicine_edit`='$care_LS_IP_medicine_edit',`care_LS_IP_medicine_status`='2',`care_LS_Med_no_of_animal_edit`='$care_LS_Med_no_of_animal_edit',`care_LS_Med_no_of_animal_status`='2',`care_LS_IP_vaccination_edit`='$care_LS_IP_vaccination_edit',`care_LS_IP_vaccination_status`='2',`care_LS_VN_no_of_animal_edit`='$care_LS_VN_no_of_animal_edit',`care_LS_VN_no_of_animal_status`='2',`care_LS_IP_others_edit`='$care_LS_IP_others_edit',`care_LS_IP_others_status`='2',`care_LS_IP_others_specify_edit`='$care_LS_IP_others_specify_edit',`care_LS_IP_others_specify_status`='2',`care_LS_other_no_of_animal_edit`='$care_LS_other_no_of_animal_edit',`care_LS_other_no_of_animal_status`='2',`care_LS_total_animal_edit`='$care_LS_total_animal_edit',`care_LS_total_animal_status`='2',`care_LS_cultivating_fodder_edit`='$care_LS_cultivating_fodder_edit',`care_LS_cultivating_fodder_status`='2',`care_LS_cultivated_area_edit`='$care_LS_cultivated_area_edit',`care_LS_cultivated_area_status`='2',`care_LS_new_farmer_edit`='$care_LS_new_farmer_edit',`care_LS_new_farmer_status`='2',`care_LS_continued_farmer_edit`=$care_LS_continued_farmer_edit,`care_LS_continued_farmer_status`='2',`care_LS_QP_extension_support_edit`=$care_LS_QP_extension_support_edit,`care_LS_QP_extension_support_status`='2' WHERE `care_serial_id`='$slno_single'";
									$sql_usp_ls=mysqli_query($conn,$update_meo_ls);
								}
							}
						}

					}
					// care_LS_IP_training_edit
									$update_1="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_training`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_training_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_training_status`= '1'";
									$sql_get_detail1=mysqli_query($conn,$update_1);

									// care_LS_IP_extension_support_edit

									$update_2="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_extension_support`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_extension_support_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_extension_support_status`= '1'";
									$sql_get_detail2=mysqli_query($conn,$update_2);

									// care_LS_ES_no_of_animal_edit

									$update_3="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_ES_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_ES_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_ES_no_of_animal_status`= '1'";
									$sql_get_detail3=mysqli_query($conn,$update_3);

									// care_LS_IP_medicine_edit

									$update_4="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_medicine`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_medicine_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_medicine_status`= '1'";
									$sql_get_detail4=mysqli_query($conn,$update_4);

									// care_LS_Med_no_of_animal_edit

									$update_5="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_Med_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_Med_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_Med_no_of_animal_status`= '1'";
									$sql_get_detail5=mysqli_query($conn,$update_5);

									// care_LS_IP_vaccination_edit

									$update_6="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_vaccination`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_vaccination_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_vaccination_status`= '1'";
									$sql_get_detail6=mysqli_query($conn,$update_6);

									// care_LS_VN_no_of_animal_edit

									$update_7="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_VN_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_VN_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_VN_no_of_animal_status`= '1'";
									$sql_get_detail7=mysqli_query($conn,$update_7);

									// care_LS_IP_others_edit

									$update_8="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_others`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_status`= '1'";
									$sql_get_detail8=mysqli_query($conn,$update_8);

									// care_LS_IP_others_specify_edit

									$update_9="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_IP_others_specify`=`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_specify_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_IP_others_specify_status`= '1'";
									$sql_get_detail9=mysqli_query($conn,$update_9);

									// care_LS_other_no_of_animal_edit

									$update_10="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_other_no_of_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_other_no_of_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_other_no_of_animal_status`= '1'";
									$sql_get_detail10=mysqli_query($conn,$update_10);

									// care_LS_total_animal_edit

									$update_11="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_total_animal`=`care_master_mtf_livestock_tarina_meo`.`care_LS_total_animal_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_total_animal_status`= '1'";
									$sql_get_detail11=mysqli_query($conn,$update_11);

									// care_LS_cultivating_fodder_edit

									$update_12="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_cultivating_fodder`=`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivating_fodder_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivating_fodder_status`= '1'";
									$sql_get_detail12=mysqli_query($conn,$update_12);

									// care_LS_cultivated_area_edit

									$update_13="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_cultivated_area`=`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivated_area_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_cultivated_area_status`= '1'";
									$sql_get_detail13=mysqli_query($conn,$update_13);

									// care_LS_new_farmer_edit

									$update_14="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_new_farmer`=`care_master_mtf_livestock_tarina_meo`.`care_LS_new_farmer_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_new_farmer_status`= '1'";
									$sql_get_detail14=mysqli_query($conn,$update_14);

									// care_LS_continued_farmer_edit

									$update_15="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_continued_farmer`=`care_master_mtf_livestock_tarina_meo`.`care_LS_continued_farmer_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_continued_farmer_status`= '1'";
									$sql_get_detail15=mysqli_query($conn,$update_15);

									// care_LS_QP_extension_support_edit
									
									$update_16="UPDATE`care_master_mtf_livestock_tarina_meo` INNER JOIN`care_master_mtf_livestock_tarina` ON`care_master_mtf_livestock_tarina`.`care_LS_slno` =`care_master_mtf_livestock_tarina_meo`.`care_serial_id` AND`care_master_mtf_livestock_tarina`.`care_LS_QP_extension_support`=`care_master_mtf_livestock_tarina_meo`.`care_LS_QP_extension_support_edit`SET`care_master_mtf_livestock_tarina_meo`.`care_LS_QP_extension_support_status`= '1'";
									$sql_get_detail16=mysqli_query($conn,$update_16);


					for ($j=0; $j < count($care_QP_slno) ; $j++) { 
						$care_QP_slno_edit=$care_QP_slno[$j];
						$care_QP_item_name_edit=$care_QP_item_name[$j];
						$care_QP_quantity_edit=$care_QP_quantity[$j];
						$care_QP_type_edit=$care_QP_type[$j];

						$check_med=" SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_med_serial`='$care_QP_slno_edit' and `care_QP_status`='1'";
						$sql_med_check=mysqli_query($conn,$check_med);
						$num_med=mysqli_num_rows($sql_med_check);
						
						if($num_med==0){
							$sql_qnty="INSERT INTO `care_master_livestock_quantity_provided_meo`( `care_med_serial`, `care_QP_hhid`, `live_stock_id`, `care_QP_livestock_slno`, `care_QP_item_name`, `care_QP_quantity`, `care_QP_type`, `care_QP_month`, `care_QP_date`, `care_QP_time`, `care_QP_status`, `care_QP_year`) SELECT * FROM `care_master_livestock_quantity_provided` WHERE `care_QP_slno`='$care_QP_slno_edit'";
							$sql_med_check_insert=mysqli_query($conn,$sql_qnty);
							if($sql_med_check_insert){
								$query_update="UPDATE `care_master_livestock_quantity_provided_meo` SET `care_QP_item_name_edit`='$care_QP_item_name_edit',`care_QP_item_name_status`='2',`care_QP_quantity_edit`='$care_QP_quantity_edit',`care_QP_quantity_status`='2',`care_QP_type_edit`='$care_QP_type_edit',`care_QP_type_status`='2' WHERE `care_med_serial`='$care_QP_slno_edit'";
								$sql_med_check_insert12=mysqli_query($conn,$query_update);
								
							}
						}
						

					}
					// care_QP_quantity_edit

					$update_17="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_item_name`=`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_status`= '1'";
					$sql_get_detail17=mysqli_query($conn,$update_17);

					// care_QP_quantity_edit

					$update_18="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_quantity`=`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_status`= '1'";
					$sql_get_detail18=mysqli_query($conn,$update_18);

					// care_QP_type_edit
					
					$update_19="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_type`=`care_master_livestock_quantity_provided_meo`.`care_QP_type_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_type_status`= '1'";
					$sql_get_detail16=mysqli_query($conn,$update_19);
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}
	// usha fill here
				$hhi=$_POST['care_hhi'];
					$Year=$_POST['Year'];
					$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
					$sql_get_detail=mysqli_query($conn,$get_details);

					$fetch_check=mysqli_fetch_assoc($sql_get_detail);
					$slno_md=$fetch_check['care_hhi_sl_no'];
					$get_userilaze_form1=unserialize($fetch_check['care_form5']); // serial mo
					$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form5']);//
					$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form5']);


					for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
						$get_userilaze_form1_q=$get_userilaze_form1[$i];
						$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
						if(in_array($get_userilaze_form1_q,$din)){
							if($care_MEO_status_form1[$i]==2){
								$array_date[]=$date;
								$array_form1[]=1;
								$array_form2[]=2;
							}else{
								$array_date[]=$get_userilaze_form1_date_single;
								$array_form1[]=1;
								$array_form2[]=2;
							}
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=$care_MEO_status_form1[$i];
							
						}

					}
						$date_mt=serialize($array_date);
						$care_CBO_status_form1_new=serialize($array_form1);
						$care_MEO_status_form1_new=serialize($array_form1);
					 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form5`='$care_MEO_status_form1_new',`care_MEO_date_form5`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
					mysqli_query($conn,$update);
					$msg->success('SuccessFully Edited information on Post Harvest Loss of HHI '.$hhi);
					header('Location:index.php');
					exit;

				break;
			case 'form6':
			
				$care_MTF_implement_name=$_POST['care_MTF_implement_name'];
				$care_MTF_target_activity=$_POST['care_MTF_target_activity'];
				$care_MTF_classroom_trained=$_POST['care_MTF_classroom_trained'];
				$care_MTF_demo_date=$_POST['care_MTF_demo_date'];
				$care_MTF_male_present=$_POST['care_MTF_male_present'];
				$care_MTF_female_present=$_POST['care_MTF_female_present'];
				$care_MTF_implements=$_POST['care_MTF_implements'];
				$care_MTF_male_farmer_using=$_POST['care_MTF_male_farmer_using'];
				$care_MTF_female_farmer_using=$_POST['care_MTF_female_farmer_using'];
				if(!empty($care_MTF_implement_name)){
					for ($i=0; $i < count($care_MTF_implement_name); $i++) {
						$care_MTF_implement_name_edit=$care_MTF_implement_name[$i];
						$care_MTF_target_activity_edit=$care_MTF_target_activity[$i];
						$care_MTF_classroom_trained_edit=$care_MTF_classroom_trained[$i];
						$care_MTF_demo_date_edit=date('Y-m-d',strtotime(trim($care_MTF_demo_date[$i])));
						$care_MTF_male_present_edit=$care_MTF_male_present[$i];
						$care_MTF_female_present_edit=$care_MTF_female_present[$i];
						$care_MTF_implements_edit=$care_MTF_implements[$i];
						$care_MTF_male_farmer_using_edit=$care_MTF_male_farmer_using[$i];
						$care_MTF_female_using_edit=$care_MTF_female_farmer_using[$i];

						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$update_meo="UPDATE `care_master_mtf_labour_saving_tech_tarina` SET `care_MTF_MEO_status`='1', `care_MTF_MEO_date`='$date', `care_MTF_MEO_time`='$time', `care_MTF_MEO_id`='$meo_user 'where `care_MTF_slno`='$slno_single'";
						$sql_update_meo=mysqli_query($conn,$update_meo);
						if($sql_update_meo){
							$check_lst="SELECT * FROM `care_master_mtf_labour_saving_tech_tarina_meo` WHERE `care_lst_serial_id`='$slno_single' and `care_MTF_MEO_status`='1'";
							$sql_check_lst_exe=mysqli_query($conn,$check_lst);
							$check_num=mysqli_num_rows($sql_check_lst_exe);
							if($check_num==0){
								$lst_query="INSERT INTO `care_master_mtf_labour_saving_tech_tarina_meo`( `care_lst_serial_id`, `care_MTF_hhid`, `care_MTF_women_farmer`, `care_MTF_spouse_name`, `care_MTF_implement_name`, `care_MTF_target_activity`, `care_MTF_classroom_trained`, `care_MTF_demo_date`, `care_MTF_male_present`, `care_MTF_female_present`, `care_MTF_implements`, `care_MTF_male_farmer_using`, `care_MTF_female_farmer_using`, `care_MTF_vlg_name`, `care_MTF_block_name`, `care_MTF_gp_name`, `care_MTF_district_name`, `care_MTF_month`, `care_MTF_year`, `care_MTF_employee_id`, `care_MTF_lat_id`, `care_MTF_long_id`, `care_MTF_date`, `care_MTF_time`, `care_MTF_status`, `care_MTF_mt_comment_empty`, `care_MTF_mt_comment_date`, `care_MTF_mt_comment_time`, `care_MTF_mt_comment_status`, `care_MTF_mt_id`, `care_MTF_CBO_comment_empty`, `care_MTF_CBO_comment_date`, `care_MTF_CBO_comment_time`, `care_MTF_CBO_comment_status`, `care_MTF_CBO_id`, `care_MTF_MEO_status`, `care_MTF_MEO_date`, `care_MTF_MEO_time`, `care_MTF_MEO_id`) SELECT * FROM `care_master_mtf_labour_saving_tech_tarina` WHERE `care_MTF_slno`='$slno_single'";
								$sql_exe_lst_query=mysqli_query($conn,$lst_query);
								if($sql_exe_lst_query){
									$sql_lst_update="UPDATE `care_master_mtf_labour_saving_tech_tarina_meo` SET `care_MTF_implement_name_edit`='$care_MTF_implement_name_edit',`care_MTF_implement_name_status`='2',`care_MTF_target_activity_edit`='$care_MTF_target_activity_edit',`care_MTF_target_activity_status`='2',`care_MTF_classroom_trained_edit`='$care_MTF_classroom_trained_edit',`care_MTF_classroom_trained_status`='2',`care_MTF_demo_date_edit`='$care_MTF_demo_date_edit',`care_MTF_demo_date_status`='2',`care_MTF_male_present_edit`='$care_MTF_male_present_edit',`care_MTF_male_present_status`='2',`care_MTF_female_present_edit`='$care_MTF_female_present_edit',`care_MTF_female_present_status`='2',`care_MTF_implements_edit`='$care_MTF_implements_edit',`care_MTF_implements_status`='2',`care_MTF_male_farmer_using_edit`='$care_MTF_male_farmer_using_edit',`care_MTF_male_farmer_using_status`='2',`care_MTF_female_using_edit`='$care_MTF_female_using_edit',`care_MTF_female_using_status`='2' WHERE `care_lst_serial_id`='$slno_single'";
									$sql_exe_lst_update_query=mysqli_query($conn,$sql_lst_update);
									
								}
								
							}
							
						}
						
						
					}
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}
					// care_MTF_implement_name_edit
					$update_1="UPDATE`care_master_mtf_labour_saving_tech_tarina_meo` INNER JOIN`care_master_mtf_labour_saving_tech_tarina` ON`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_slno` =`care_master_mtf_labour_saving_tech_tarina_meo`.`care_lst_serial_id` AND`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_implement_name`=`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_implement_name_edit`SET`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_implement_name_status`= '1'";
					$sql_get_detail1=mysqli_query($conn,$update_1);

					// care_MTF_target_activity_edit

					$update_2="UPDATE`care_master_mtf_labour_saving_tech_tarina_meo` INNER JOIN`care_master_mtf_labour_saving_tech_tarina` ON`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_slno` =`care_master_mtf_labour_saving_tech_tarina_meo`.`care_lst_serial_id` AND`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_target_activity`=`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_target_activity_edit`SET`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_target_activity_status`= '1'";
					$sql_get_detail2=mysqli_query($conn,$update_2);

					// care_MTF_classroom_trained_edit

					$update_3="UPDATE`care_master_mtf_labour_saving_tech_tarina_meo` INNER JOIN`care_master_mtf_labour_saving_tech_tarina` ON`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_slno` =`care_master_mtf_labour_saving_tech_tarina_meo`.`care_lst_serial_id` AND`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_classroom_trained`=`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_classroom_trained_edit`SET`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_classroom_trained_status`= '1'";
					$sql_get_detail3=mysqli_query($conn,$update_3);

					// care_MTF_demo_date_edit

					$update_4="UPDATE`care_master_mtf_labour_saving_tech_tarina_meo` INNER JOIN`care_master_mtf_labour_saving_tech_tarina` ON`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_slno` =`care_master_mtf_labour_saving_tech_tarina_meo`.`care_lst_serial_id` AND`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_demo_date`=`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_demo_date_edit`SET`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_demo_date_status`= '1'";
					$sql_get_detail4=mysqli_query($conn,$update_4);

					// care_MTF_male_present_edit

					$update_5="UPDATE`care_master_mtf_labour_saving_tech_tarina_meo` INNER JOIN`care_master_mtf_labour_saving_tech_tarina` ON`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_slno` =`care_master_mtf_labour_saving_tech_tarina_meo`.`care_lst_serial_id` AND`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_male_present`=`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_male_present_edit`SET`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_male_present_status`= '1'";
					$sql_get_detail5=mysqli_query($conn,$update_5);

					// care_MTF_female_present_edit

					$update_6="UPDATE`care_master_mtf_labour_saving_tech_tarina_meo` INNER JOIN`care_master_mtf_labour_saving_tech_tarina` ON`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_slno` =`care_master_mtf_labour_saving_tech_tarina_meo`.`care_lst_serial_id` AND`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_female_present`=`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_female_present_edit`SET`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_female_present_status`= '1'";
					$sql_get_detail6=mysqli_query($conn,$update_6);

					// care_MTF_implements_edit

					$update_7="UPDATE`care_master_mtf_labour_saving_tech_tarina_meo` INNER JOIN`care_master_mtf_labour_saving_tech_tarina` ON`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_slno` =`care_master_mtf_labour_saving_tech_tarina_meo`.`care_lst_serial_id` AND`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_implements`=`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_implements_edit`SET`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_implements_status`= '1'";
					$sql_get_detail7=mysqli_query($conn,$update_7);

					// care_MTF_male_farmer_using_edit

					$update_8="UPDATE`care_master_mtf_labour_saving_tech_tarina_meo` INNER JOIN`care_master_mtf_labour_saving_tech_tarina` ON`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_slno` =`care_master_mtf_labour_saving_tech_tarina_meo`.`care_lst_serial_id` AND`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_male_farmer_using`=`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_male_farmer_using_edit`SET`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_male_farmer_using_status`= '1'";
					$sql_get_detail8=mysqli_query($conn,$update_8);

					// care_MTF_female_using_edit

					$update_9="UPDATE`care_master_mtf_labour_saving_tech_tarina_meo` INNER JOIN`care_master_mtf_labour_saving_tech_tarina` ON`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_slno` =`care_master_mtf_labour_saving_tech_tarina_meo`.`care_lst_serial_id` AND`care_master_mtf_labour_saving_tech_tarina`.`care_MTF_female_using`=`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_female_using_edit`SET`care_master_mtf_labour_saving_tech_tarina_meo`.`care_MTF_female_using_status`= '1'";
					$sql_get_detail9=mysqli_query($conn,$update_9);

					$hhi=$_POST['care_hhi'];
					$Year=$_POST['Year'];
					$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
					$sql_get_detail=mysqli_query($conn,$get_details);

					$fetch_check=mysqli_fetch_assoc($sql_get_detail);
					$slno_md=$fetch_check['care_hhi_sl_no'];
					$get_userilaze_form1=unserialize($fetch_check['care_form6']); // serial mo
					$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form6']);//
					$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form6']);


					for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
						$get_userilaze_form1_q=$get_userilaze_form1[$i];
						$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
						if(in_array($get_userilaze_form1_q,$din)){
							if($care_MEO_status_form1[$i]==2){
								$array_date[]=$date;
								$array_form1[]=1;
								$array_form2[]=2;
							}else{
								$array_date[]=$get_userilaze_form1_date_single;
								$array_form1[]=1;
								$array_form2[]=2;
							}
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=$care_MEO_status_form1[$i];
							
						}

					}
					 $date_mt=serialize($array_date);
					 $care_CBO_status_form1_new=serialize($array_form1);
					 $care_MEO_status_form1_new=serialize($array_form1);
					 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form6`='$care_MEO_status_form1_new',`care_MEO_date_form6`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
					mysqli_query($conn,$update);
					$msg->success('SuccessFully Edited information on Post Harvest Loss of HHI '.$hhi);
					header('Location:index.php');
					exit;				
				break;

			case 'form7':

				// Array ( [form_type_new] => 9f0QwTMUioqFjbXXZtFGLv8lmvQ455Q/ZQeFcf8UAi4= [form_type_id] => 4N2hI/3OP0oPXBMcAhTCIYbUPC17/+mXywepWW0rdvo= [form_type_user] => x8mFQV7/zmcrGyAQTUyVK6Lw1B5dCohIIxLgJHQYWGk= [form_type] => 1RgtQ2SK3ckjCWaMhRpqPNbS2RbsnKxdomzJWo+6SSk= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [care_hhi] => 102020200743 [care_hhi_slno] => [type_insert] => 1 [district] => kalahandi [GP_name] => bankapalas [hhi] => 102020200743 [Block] => bankapalas [Village] => bankapalas [Year] => 2017 [women] => nilendri majhi [Spouse] => makardhwajmajhi [form_type_id_div] => Array ( [0] => Nzq6mzbwAYNGhKPhBYtu39f5vH7nnvpp/IV9+8nsc4I= ) [care_pulses_type] => Array ( [0] => legumes ) [care_area_cultivated] => Array ( [0] => 1122 ) [care_continued_farmer] => Array ( [0] => 2 [1] => 2 ) [care_demo_plot_farmer] => Array ( [0] => 1 ) [care_IR_training] => Array ( [0] => 1 ) [care_IR_seed] => Array ( [0] => 1 ) [care_IR_fertiliser] => Array ( [0] => 2 ) [care_IR_pesticides] => Array ( [0] => 1 ) [care_IR_extension_support] => Array ( [0] => 1 ) [care_IR_other] => Array ( [0] => 2 ) [care_CRP_other_detail] => Array ( [0] => 11 ) [care_QR_seed] => Array ( [0] => 122 ) [care_QR_fertiliser] => Array ( [0] => 011 ) [care_QR_pesticides] => Array ( [0] => 0113 ) [care_QR_other] => Array ( [0] => 01 ) [care_P_consumption] => Array ( [0] => 02 ) [care_P_sale] => Array ( [0] => 03434 ) [care_P_total_production] => Array ( [0] => 0333 ) [care_avg_price] => Array ( [0] => 13 ) [save] => save )

				$care_pulses_type=$_POST['care_pulses_type'];
				$care_area_cultivated=$_POST['care_area_cultivated'];
				$care_continued_farmer=$_POST['care_continued_farmer'];
				$care_demo_plot_farmer=$_POST['care_demo_plot_farmer'];
				$care_IR_training=$_POST['care_IR_training'];
				$care_IR_seed=$_POST['care_IR_seed'];
				$care_IR_fertiliser=$_POST['care_IR_fertiliser'];
				$care_IR_pesticides=$_POST['care_IR_pesticides'];
				$care_IR_extension_support=$_POST['care_IR_extension_support'];
				$care_IR_other=$_POST['care_IR_other'];
				$care_CRP_other_detail=$_POST['care_CRP_other_detail'];
				$care_QR_seed=$_POST['care_QR_seed'];
				$care_QR_fertiliser=$_POST['care_QR_fertiliser'];
				$care_QR_pesticides=$_POST['care_QR_pesticides'];
				$care_QR_other=$_POST['care_QR_other'];
				$care_P_consumption=$_POST['care_P_consumption'];
				$care_P_sale=$_POST['care_P_sale'];
				$care_P_total_production=$_POST['care_P_total_production'];
				$care_avg_price=$_POST['care_avg_price'];
				$care_new_farmer=$_POST['care_new_farmer'];
				if(!empty($care_continued_farmer)){
					for ($i=0; $i <count($slno) ; $i++) {
						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$care_new_farmer_edit=$care_new_farmer[$i];
						$care_pulses_type_edit=$care_pulses_type[$i];
						$care_area_cultivated_edit=$care_area_cultivated[$i];
						$care_continued_farmer_edit=$care_continued_farmer[$i];
						$care_demo_plot_farmer_edit=$care_demo_plot_farmer[$i];
						$care_IR_training_edit=$care_IR_training[$i];
						$care_IR_seed_edit=$care_IR_seed[$i];
						$care_IR_fertiliser_edit=$care_IR_fertiliser[$i];
						$care_IR_pesticides_edit=$care_IR_pesticides[$i];
						$care_IR_extension_support_edit=$care_IR_extension_support[$i];
						$care_IR_other_edit=$care_IR_other[$i];
						$care_CRP_other_detail_edit=$care_CRP_other_detail[$i];
						$care_QR_seed_edit=$care_QR_seed[$i];
						$care_QR_fertiliser_edit=$care_QR_fertiliser[$i];
						$care_QR_pesticides_edit=$care_QR_pesticides[$i];
						$care_QR_other_edit=$care_QR_other[$i];
						$care_P_consumption_edit=$care_P_consumption[$i];
						$care_P_sale_edit=$care_P_sale[$i];
						$care_P_total_production_edit=$care_P_total_production[$i];
						$care_avg_price_edit=$care_avg_price[$i];

						$update_crp="UPDATE `care_master_crop_diversification_crp` SET `care_crop_div_MEO_status`='1', `care_crop_div_MEO_time`='$time', `care_crop_div_MEO_date`='$date', `care_crop_div_MEO_id`='$meo_user' WHERE `care_slno`='$slno_single'";
						$sql_update_crp=mysqli_query($conn,$update_crp);

						$file = fopen("test.txt", "a+");
							fwrite($file, "--- update_crp  " . $update_crp . "---slno_single  ".$slno_single."++++sql_update_crp  ".$sql_update_crp."++++------------");
							fclose($file);
						if($sql_update_crp){
							$check_crop="SELECT * FROM `care_master_crop_diversification_crp_meo` WHERE `care_crop_serial_id`='$slno_single' and `care_crop_div_MEO_status`='1'";
							$SQL_CHECK=mysqli_query($conn,$check_crop);
							$crop_num=mysqli_num_rows($SQL_CHECK);

							$file = fopen("tes3t.txt", "a+");
							fwrite($file, "--- check_crop  " . $check_crop . "---slno_single  ".$slno_single."++++crop_num  ".$crop_num."++++------------");
							fclose($file);
							if($crop_num==0){
							$insert="INSERT INTO `care_master_crop_diversification_crp_meo` ( `care_crop_serial_id`,`care_hhid`, `care_women_farmer`, `care_spouse_name`, `care_pulses_type`, `care_area_cultivated`, `care_continued_farmer`, `care_demo_plot_farmer`, `care_new_farmer`, `care_IR_training`, `care_IR_seed`, `care_IR_fertiliser`, `care_IR_pesticides`, `care_IR_extension_support`, `care_IR_other`, `care_CRP_other_detail`, `care_QR_seed`, `care_QR_fertiliser`, `care_QR_pesticides`, `care_QR_other`, `care_P_consumption`, `care_P_sale`, `care_P_total_production`, `care_avg_price`, `care_form_type`, `care_type_farm`, `care_CRP_lat_id`, `care_CRP_long_id`, `care_CRP_employee_id`, `care_CRP_vlg_name`, `care_CRP_gp_name`, `care_CRP_block_name_`, `care_CRP_district_name`, `care_CRP_month`, `care_CRP_year`, `care_CRP_status`, `care_CRP_date`, `care_CRP_time`, `care_crop_div_comment_mt`, `care_crop_div_date_comment`, `care_crop_div_time_comment_mt`, `care_crop_div_mt_id`, `care_crop_div_mt_id_status`, `care_crop_div_CBO_comment_empty`, `care_crop_div_CBO_comment_date`, `care_crop_div_CBO_comment_time`, `care_crop_div_CBO_comment_status`, `care_crop_div_CBO_id`, `care_crop_div_MEO_status`, `care_crop_div_MEO_time`, `care_crop_div_MEO_id`, `care_crop_div_MEO_date`) SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_slno`='$slno_single'";
							$sql_insert_crp=mysqli_query($conn,$insert);
								$file = fopen("test2.txt", "a+");
							fwrite($file, "--- check_crop  " . $insert . "---slno_single  ".$slno_single."++++sql_update_crp  ".$sql_insert_crp."++++------------");
							fclose($file);
							if($sql_insert_crp){
								$update_meo="UPDATE `care_master_crop_diversification_crp_meo` SET `care_pulses_type_edit`='$care_pulses_type_edit',`care_pulses_type_status`='2',`care_area_cultivated_edit`='$care_area_cultivated_edit',`care_area_cultivated_status`='2',`care_continued_farmer_edit`='$care_continued_farmer_edit',`care_continued_farmer_status`='2',`care_demo_plot_farmer_edit`='$care_demo_plot_farmer_edit',`care_demo_plot_farmer_status`='2',`care_new_farmer_edit`='$care_new_farmer_edit',`care_new_farmer_status`='2',`care_IR_training_edit`='$care_IR_training_edit',`care_IR_training_status`='2',`care_IR_seed_edit`='$care_IR_seed_edit',`care_IR_seed_status`='2',`care_IR_fertiliser_edit`='$care_IR_fertiliser_edit',`care_IR_fertiliser_status`='2',`care_IR_pesticides_edit`='$care_IR_pesticides_edit',`care_IR_pesticides_status`='2',`care_IR_extension_support_edit`='$care_IR_extension_support_edit',`care_IR_extension_support_status`='2',`care_IR_other_edit`='$care_IR_other_edit',`care_IR_other_status`='2',`care_CRP_other_detail_edit`='$care_CRP_other_detail_edit',`care_CRP_other_detail_status`='2',`care_QR_seed_edit`='$care_QR_seed_edit',`care_QR_seed_status`='2',`care_QR_fertiliser_edit`='$care_QR_fertiliser_edit',`care_QR_fertiliser_status`='2',`care_QR_pesticides_edit`=$care_QR_pesticides_edit,`care_QR_pesticides_status`='2',`care_QR_other_edit`='$care_QR_other_edit',`care_QR_other_status`='2',`care_P_consumption_edit`='$care_P_consumption_edit',`care_P_consumption_status`='2',`care_P_sale_edit`='$care_P_sale_edit',`care_P_sale_status`='2',`care_P_total_production_edit`='$care_P_total_production_edit',`care_P_total_production_status`='2',`care_avg_price_edit`='$care_avg_price_edit',`care_avg_price_status`='2' WHERE `care_crop_serial_id`='$slno_single'";

								$sql_update_edit_meo=mysqli_query($conn,$update_meo);

								$file = fopen("test4.txt", "a+");
									fwrite($file, "---   " . $slno_single . "---sql_update_meo ".$update_meo."++++sql_update_edit_meo ".$sql_update_edit_meo);
									fclose($file);
							}
						}

						}

					}
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}






					// care_new_farmer_edit
					$update_1="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_new_farmer`=`care_master_crop_diversification_crp_meo`.`care_new_farmer_edit`SET`care_master_crop_diversification_crp_meo`.`care_new_farmer_status`= '1'";
					$sql_get_detail1=mysqli_query($conn,$update_1);

					// care_pulses_type_edit

					$update_2="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_pulses_type`=`care_master_crop_diversification_crp_meo`.`care_pulses_type_edit`SET`care_master_crop_diversification_crp_meo`.`care_pulses_type_status`= '1'";
					$sql_get_detail2=mysqli_query($conn,$update_2);

					// care_area_cultivated_edit

					$update_3="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_area_cultivated`=`care_master_crop_diversification_crp_meo`.`care_area_cultivated_edit`SET`care_master_crop_diversification_crp_meo`.`care_area_cultivated_status`= '1'";
					$sql_get_detail3=mysqli_query($conn,$update_3);

					// care_continued_farmer_edit

					$update_4="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_continued_farmer`=`care_master_crop_diversification_crp_meo`.`care_continued_farmer_edit`SET`care_master_crop_diversification_crp_meo`.`care_continued_farmer_status`= '1'";
					$sql_get_detail4=mysqli_query($conn,$update_4);

					// care_demo_plot_farmer_edit

					$update_5="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_demo_plot_farmer`=`care_master_crop_diversification_crp_meo`.`care_demo_plot_farmer_edit`SET`care_master_crop_diversification_crp_meo`.`care_demo_plot_farmer_status`= '1'";
					$sql_get_detail5=mysqli_query($conn,$update_5);

					// care_IR_training_edit

					$update_6="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_training`=`care_master_crop_diversification_crp_meo`.`care_IR_training_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_training_status`= '1'";
					$sql_get_detail6=mysqli_query($conn,$update_6);

					// care_IR_seed_edit

					$update_7="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_seed`=`care_master_crop_diversification_crp_meo`.`care_IR_seed_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_seed_status`= '1'";
					$sql_get_detail7=mysqli_query($conn,$update_7);

					// care_IR_fertiliser_edit

					$update_8="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_fertiliser`=`care_master_crop_diversification_crp_meo`.`care_IR_fertiliser_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_fertiliser_status`= '1'";
					$sql_get_detail8=mysqli_query($conn,$update_8);

					// care_IR_pesticides_edit

					$update_9="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_pesticides`=`care_master_crop_diversification_crp_meo`.`care_IR_pesticides_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_pesticides_status`= '1'";
					$sql_get_detail9=mysqli_query($conn,$update_9);

					// care_IR_extension_support_edit

					$update_10="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_extension_support`=`care_master_crop_diversification_crp_meo`.`care_IR_extension_support_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_extension_support_status`= '1'";
					$sql_get_detail10=mysqli_query($conn,$update_10);

					// care_IR_other_edit

					$update_11="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_other`=`care_master_crop_diversification_crp_meo`.`care_IR_other_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_other_status`= '1'";
					$sql_get_detail11=mysqli_query($conn,$update_11);

					// care_CRP_other_detail_edit

					$update_12="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_CRP_other_detail`=`care_master_crop_diversification_crp_meo`.`care_CRP_other_detail_edit`SET`care_master_crop_diversification_crp_meo`.`care_CRP_other_detail_status`= '1'";
					$sql_get_detail12=mysqli_query($conn,$update_12);

					// care_QR_seed_edit

					$update_13="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_QR_seed`=`care_master_crop_diversification_crp_meo`.`care_QR_seed_edit`SET`care_master_crop_diversification_crp_meo`.`care_QR_seed_status`= '1'";
					$sql_get_detail13=mysqli_query($conn,$update_13);

					// care_QR_fertiliser_edit

					$update_14="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_QR_fertiliser`=`care_master_crop_diversification_crp_meo`.`care_QR_fertiliser_edit`SET`care_master_crop_diversification_crp_meo`.`care_QR_fertiliser_status`= '1'";
					$sql_get_detail14=mysqli_query($conn,$update_14);

					// care_QR_pesticides_edit

					$update_15="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_QR_pesticides`=`care_master_crop_diversification_crp_meo`.`care_QR_pesticides_edit`SET`care_master_crop_diversification_crp_meo`.`care_QR_pesticides_status`= '1'";
					$sql_get_detail15=mysqli_query($conn,$update_15);

					// care_QR_other_edit
					
					$update_16="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_QR_other`=`care_master_crop_diversification_crp_meo`.`care_QR_other_edit`SET`care_master_crop_diversification_crp_meo`.`care_QR_other_status`= '1'";
					$sql_get_detail16=mysqli_query($conn,$update_16);

					//care_P_consumption_edit

					$update_17="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_P_consumption`=`care_master_crop_diversification_crp_meo`.`care_P_consumption_edit`SET`care_master_crop_diversification_crp_meo`.`care_P_consumption_status`= '1'";
					$sql_get_detail17=mysqli_query($conn,$update_17);

					// care_P_sale_edit
					
					$update_18="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_P_sale`=`care_master_crop_diversification_crp_meo`.`care_P_sale_edit`SET`care_master_crop_diversification_crp_meo`.`care_P_sale_status`= '1'";
					$sql_get_detail18=mysqli_query($conn,$update_18);

					//care_P_total_production_edit

					$update_19="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_P_total_production`=`care_master_crop_diversification_crp_meo`.`care_P_total_production_edit`SET`care_master_crop_diversification_crp_meo`.`care_P_total_production_status`= '1'";
					$sql_get_detail19=mysqli_query($conn,$update_19);

					// care_LS_QP_extension_support_edit
					
					$update_20="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_avg_price`=`care_master_crop_diversification_crp_meo`.`care_avg_price_edit`SET`care_master_crop_diversification_crp_meo`.`care_avg_price_status`= '1'";
					$sql_get_detail20=mysqli_query($conn,$update_20);

					$hhi=$_POST['care_hhi'];
					$Year=$_POST['Year'];
					$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
					$sql_get_detail=mysqli_query($conn,$get_details);

					$fetch_check=mysqli_fetch_assoc($sql_get_detail);
					$slno_md=$fetch_check['care_hhi_sl_no'];
					$get_userilaze_form1=unserialize($fetch_check['care_form7']); // serial mo
					$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form7']);//
					$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form7']);


					for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
						$get_userilaze_form1_q=$get_userilaze_form1[$i];
						$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
						if(in_array($get_userilaze_form1_q,$din)){
							if($care_MEO_status_form1[$i]==2){
								$array_date[]=$date;
								$array_form1[]=1;
								$array_form2[]=2;
							}else{
								$array_date[]=$get_userilaze_form1_date_single;
								$array_form1[]=1;
								$array_form2[]=2;
							}
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=$care_MEO_status_form1[$i];
							
						}

					}
					 $date_mt=serialize($array_date);
					 $care_CBO_status_form1_new=serialize($array_form1);
					 $care_MEO_status_form1_new=serialize($array_form1);
					 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form7`='$care_MEO_status_form1_new',`care_MEO_date_form7`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
					mysqli_query($conn,$update);
					$msg->success('SuccessFully Edited information on Crop Diversfication of HHI '.$hhi);
					header('Location:index.php');
					exit;
				break;
			case 'form8':

			
				// Array ( [form_type_new] => 9f0QwTMUioqFjbXXZtFGLv8lmvQ455Q/ZQeFcf8UAi4= [form_type_id] => 4N2hI/3OP0oPXBMcAhTCIYbUPC17/+mXywepWW0rdvo= [form_type_user] => x8mFQV7/zmcrGyAQTUyVK6Lw1B5dCohIIxLgJHQYWGk= [form_type] => 1RgtQ2SK3ckjCWaMhRpqPNbS2RbsnKxdomzJWo+6SSk= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [care_hhi] => 102020200743 [care_hhi_slno] => [type_insert] => 1 [district] => kalahandi [GP_name] => bankapalas [hhi] => 102020200743 [Block] => bankapalas [Village] => bankapalas [Year] => 2017 [women] => nilendri majhi [Spouse] => makardhwajmajhi [form_type_id_div] => Array ( [0] => Nzq6mzbwAYNGhKPhBYtu39f5vH7nnvpp/IV9+8nsc4I= ) [care_pulses_type] => Array ( [0] => legumes ) [care_area_cultivated] => Array ( [0] => 1122 ) [care_continued_farmer] => Array ( [0] => 2 [1] => 2 ) [care_demo_plot_farmer] => Array ( [0] => 1 ) [care_IR_training] => Array ( [0] => 1 ) [care_IR_seed] => Array ( [0] => 1 ) [care_IR_fertiliser] => Array ( [0] => 2 ) [care_IR_pesticides] => Array ( [0] => 1 ) [care_IR_extension_support] => Array ( [0] => 1 ) [care_IR_other] => Array ( [0] => 2 ) [care_CRP_other_detail] => Array ( [0] => 11 ) [care_QR_seed] => Array ( [0] => 122 ) [care_QR_fertiliser] => Array ( [0] => 011 ) [care_QR_pesticides] => Array ( [0] => 0113 ) [care_QR_other] => Array ( [0] => 01 ) [care_P_consumption] => Array ( [0] => 02 ) [care_P_sale] => Array ( [0] => 03434 ) [care_P_total_production] => Array ( [0] => 0333 ) [care_avg_price] => Array ( [0] => 13 ) [save] => save )

				$care_pulses_type=$_POST['care_pulses_type'];
				$care_area_cultivated=$_POST['care_area_cultivated'];
				$care_continued_farmer=$_POST['care_continued_farmer'];
				$care_demo_plot_farmer=$_POST['care_demo_plot_farmer'];
				$care_IR_training=$_POST['care_IR_training'];
				$care_IR_seed=$_POST['care_IR_seed'];
				$care_IR_fertiliser=$_POST['care_IR_fertiliser'];
				$care_IR_pesticides=$_POST['care_IR_pesticides'];
				$care_IR_extension_support=$_POST['care_IR_extension_support'];
				$care_IR_other=$_POST['care_IR_other'];
				$care_CRP_other_detail=$_POST['care_CRP_other_detail'];
				$care_QR_seed=$_POST['care_QR_seed'];
				$care_QR_fertiliser=$_POST['care_QR_fertiliser'];
				$care_QR_pesticides=$_POST['care_QR_pesticides'];
				$care_QR_other=$_POST['care_QR_other'];
				$care_P_consumption=$_POST['care_P_consumption'];
				$care_P_sale=$_POST['care_P_sale'];
				$care_P_total_production=$_POST['care_P_total_production'];
				$care_avg_price=$_POST['care_avg_price'];
				$care_new_farmer=$_POST['care_new_farmer'];
				if(!empty($care_continued_farmer)){
					for ($i=0; $i <count($slno) ; $i++) {
						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$care_new_farmer_edit=$care_new_farmer[$i];
						$care_pulses_type_edit=$care_pulses_type[$i];
						$care_area_cultivated_edit=$care_area_cultivated[$i];
						$care_continued_farmer_edit=$care_continued_farmer[$i];
						$care_demo_plot_farmer_edit=$care_demo_plot_farmer[$i];
						$care_IR_training_edit=$care_IR_training[$i];
						$care_IR_seed_edit=$care_IR_seed[$i];
						$care_IR_fertiliser_edit=$care_IR_fertiliser[$i];
						$care_IR_pesticides_edit=$care_IR_pesticides[$i];
						$care_IR_extension_support_edit=$care_IR_extension_support[$i];
						$care_IR_other_edit=$care_IR_other[$i];
						$care_CRP_other_detail_edit=$care_CRP_other_detail[$i];
						$care_QR_seed_edit=$care_QR_seed[$i];
						$care_QR_fertiliser_edit=$care_QR_fertiliser[$i];
						$care_QR_pesticides_edit=$care_QR_pesticides[$i];
						$care_QR_other_edit=$care_QR_other[$i];
						$care_P_consumption_edit=$care_P_consumption[$i];
						$care_P_sale_edit=$care_P_sale[$i];
						$care_P_total_production_edit=$care_P_total_production[$i];
						$care_avg_price_edit=$care_avg_price[$i];

						$update_crp="UPDATE `care_master_crop_diversification_crp` SET `care_crop_div_MEO_status`='1', `care_crop_div_MEO_time`='$time', `care_crop_div_MEO_date`='$date', `care_crop_div_MEO_id`='$meo_user' WHERE `care_slno`='$slno_single'";
						$sql_update_crp=mysqli_query($conn,$update_crp);

						$file = fopen("test.txt", "a+");
							fwrite($file, "--- update_crp  " . $update_crp . "---slno_single  ".$slno_single."++++sql_update_crp  ".$sql_update_crp."++++------------");
							fclose($file);
						if($sql_update_crp){
							$check_crop="SELECT * FROM `care_master_crop_diversification_crp_meo` WHERE `care_crop_serial_id`='$slno_single' and `care_crop_div_MEO_status`='1'";
							$SQL_CHECK=mysqli_query($conn,$check_crop);
							$crop_num=mysqli_num_rows($SQL_CHECK);

							$file = fopen("tes3t.txt", "a+");
							fwrite($file, "--- check_crop  " . $check_crop . "---slno_single  ".$slno_single."++++crop_num  ".$crop_num."++++------------");
							fclose($file);
							if($crop_num==0){
							$insert="INSERT INTO `care_master_crop_diversification_crp_meo` ( `care_crop_serial_id`,`care_hhid`, `care_women_farmer`, `care_spouse_name`, `care_pulses_type`, `care_area_cultivated`, `care_continued_farmer`, `care_demo_plot_farmer`, `care_new_farmer`, `care_IR_training`, `care_IR_seed`, `care_IR_fertiliser`, `care_IR_pesticides`, `care_IR_extension_support`, `care_IR_other`, `care_CRP_other_detail`, `care_QR_seed`, `care_QR_fertiliser`, `care_QR_pesticides`, `care_QR_other`, `care_P_consumption`, `care_P_sale`, `care_P_total_production`, `care_avg_price`, `care_form_type`, `care_type_farm`, `care_CRP_lat_id`, `care_CRP_long_id`, `care_CRP_employee_id`, `care_CRP_vlg_name`, `care_CRP_gp_name`, `care_CRP_block_name_`, `care_CRP_district_name`, `care_CRP_month`, `care_CRP_year`, `care_CRP_status`, `care_CRP_date`, `care_CRP_time`, `care_crop_div_comment_mt`, `care_crop_div_date_comment`, `care_crop_div_time_comment_mt`, `care_crop_div_mt_id`, `care_crop_div_mt_id_status`, `care_crop_div_CBO_comment_empty`, `care_crop_div_CBO_comment_date`, `care_crop_div_CBO_comment_time`, `care_crop_div_CBO_comment_status`, `care_crop_div_CBO_id`, `care_crop_div_MEO_status`, `care_crop_div_MEO_time`, `care_crop_div_MEO_id`, `care_crop_div_MEO_date`) SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_slno`='$slno_single'";
							$sql_insert_crp=mysqli_query($conn,$insert);
								$file = fopen("test2.txt", "a+");
							fwrite($file, "--- check_crop  " . $insert . "---slno_single  ".$slno_single."++++sql_update_crp  ".$sql_insert_crp."++++------------");
							fclose($file);
							if($sql_insert_crp){
								$update_meo="UPDATE `care_master_crop_diversification_crp_meo` SET `care_pulses_type_edit`='$care_pulses_type_edit',`care_pulses_type_status`='2',`care_area_cultivated_edit`='$care_area_cultivated_edit',`care_area_cultivated_status`='2',`care_continued_farmer_edit`='$care_continued_farmer_edit',`care_continued_farmer_status`='2',`care_demo_plot_farmer_edit`='$care_demo_plot_farmer_edit',`care_demo_plot_farmer_status`='2',`care_new_farmer_edit`='$care_new_farmer_edit',`care_new_farmer_status`='2',`care_IR_training_edit`='$care_IR_training_edit',`care_IR_training_status`='2',`care_IR_seed_edit`='$care_IR_seed_edit',`care_IR_seed_status`='2',`care_IR_fertiliser_edit`='$care_IR_fertiliser_edit',`care_IR_fertiliser_status`='2',`care_IR_pesticides_edit`='$care_IR_pesticides_edit',`care_IR_pesticides_status`='2',`care_IR_extension_support_edit`='$care_IR_extension_support_edit',`care_IR_extension_support_status`='2',`care_IR_other_edit`='$care_IR_other_edit',`care_IR_other_status`='2',`care_CRP_other_detail_edit`='$care_CRP_other_detail_edit',`care_CRP_other_detail_status`='2',`care_QR_seed_edit`='$care_QR_seed_edit',`care_QR_seed_status`='2',`care_QR_fertiliser_edit`='$care_QR_fertiliser_edit',`care_QR_fertiliser_status`='2',`care_QR_pesticides_edit`=$care_QR_pesticides_edit,`care_QR_pesticides_status`='2',`care_QR_other_edit`='$care_QR_other_edit',`care_QR_other_status`='2',`care_P_consumption_edit`='$care_P_consumption_edit',`care_P_consumption_status`='2',`care_P_sale_edit`='$care_P_sale_edit',`care_P_sale_status`='2',`care_P_total_production_edit`='$care_P_total_production_edit',`care_P_total_production_status`='2',`care_avg_price_edit`='$care_avg_price_edit',`care_avg_price_status`='2' WHERE `care_crop_serial_id`='$slno_single'";

								$sql_update_edit_meo=mysqli_query($conn,$update_meo);

								$file = fopen("test4.txt", "a+");
									fwrite($file, "---   " . $slno_single . "---sql_update_meo ".$update_meo."++++sql_update_edit_meo ".$sql_update_edit_meo);
									fclose($file);
							}
						}

						}

					}
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}

					// care_new_farmer_edit
					$update_1="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_new_farmer`=`care_master_crop_diversification_crp_meo`.`care_new_farmer_edit`SET`care_master_crop_diversification_crp_meo`.`care_new_farmer_status`= '1'";
					$sql_get_detail1=mysqli_query($conn,$update_1);

					// care_pulses_type_edit

					$update_2="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_pulses_type`=`care_master_crop_diversification_crp_meo`.`care_pulses_type_edit`SET`care_master_crop_diversification_crp_meo`.`care_pulses_type_status`= '1'";
					$sql_get_detail2=mysqli_query($conn,$update_2);

					// care_area_cultivated_edit

					$update_3="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_area_cultivated`=`care_master_crop_diversification_crp_meo`.`care_area_cultivated_edit`SET`care_master_crop_diversification_crp_meo`.`care_area_cultivated_status`= '1'";
					$sql_get_detail3=mysqli_query($conn,$update_3);

					// care_continued_farmer_edit

					$update_4="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_continued_farmer`=`care_master_crop_diversification_crp_meo`.`care_continued_farmer_edit`SET`care_master_crop_diversification_crp_meo`.`care_continued_farmer_status`= '1'";
					$sql_get_detail4=mysqli_query($conn,$update_4);

					// care_demo_plot_farmer_edit

					$update_5="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_demo_plot_farmer`=`care_master_crop_diversification_crp_meo`.`care_demo_plot_farmer_edit`SET`care_master_crop_diversification_crp_meo`.`care_demo_plot_farmer_status`= '1'";
					$sql_get_detail5=mysqli_query($conn,$update_5);

					// care_IR_training_edit

					$update_6="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_training`=`care_master_crop_diversification_crp_meo`.`care_IR_training_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_training_status`= '1'";
					$sql_get_detail6=mysqli_query($conn,$update_6);

					// care_IR_seed_edit

					$update_7="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_seed`=`care_master_crop_diversification_crp_meo`.`care_IR_seed_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_seed_status`= '1'";
					$sql_get_detail7=mysqli_query($conn,$update_7);

					// care_IR_fertiliser_edit

					$update_8="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_fertiliser`=`care_master_crop_diversification_crp_meo`.`care_IR_fertiliser_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_fertiliser_status`= '1'";
					$sql_get_detail8=mysqli_query($conn,$update_8);

					// care_IR_pesticides_edit

					$update_9="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_pesticides`=`care_master_crop_diversification_crp_meo`.`care_IR_pesticides_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_pesticides_status`= '1'";
					$sql_get_detail9=mysqli_query($conn,$update_9);

					// care_IR_extension_support_edit

					$update_10="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_extension_support`=`care_master_crop_diversification_crp_meo`.`care_IR_extension_support_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_extension_support_status`= '1'";
					$sql_get_detail10=mysqli_query($conn,$update_10);

					// care_IR_other_edit

					$update_11="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_IR_other`=`care_master_crop_diversification_crp_meo`.`care_IR_other_edit`SET`care_master_crop_diversification_crp_meo`.`care_IR_other_status`= '1'";
					$sql_get_detail11=mysqli_query($conn,$update_11);

					// care_CRP_other_detail_edit

					$update_12="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_CRP_other_detail`=`care_master_crop_diversification_crp_meo`.`care_CRP_other_detail_edit`SET`care_master_crop_diversification_crp_meo`.`care_CRP_other_detail_status`= '1'";
					$sql_get_detail12=mysqli_query($conn,$update_12);

					// care_QR_seed_edit

					$update_13="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_QR_seed`=`care_master_crop_diversification_crp_meo`.`care_QR_seed_edit`SET`care_master_crop_diversification_crp_meo`.`care_QR_seed_status`= '1'";
					$sql_get_detail13=mysqli_query($conn,$update_13);

					// care_QR_fertiliser_edit

					$update_14="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_QR_fertiliser`=`care_master_crop_diversification_crp_meo`.`care_QR_fertiliser_edit`SET`care_master_crop_diversification_crp_meo`.`care_QR_fertiliser_status`= '1'";
					$sql_get_detail14=mysqli_query($conn,$update_14);

					// care_QR_pesticides_edit

					$update_15="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_QR_pesticides`=`care_master_crop_diversification_crp_meo`.`care_QR_pesticides_edit`SET`care_master_crop_diversification_crp_meo`.`care_QR_pesticides_status`= '1'";
					$sql_get_detail15=mysqli_query($conn,$update_15);

					// care_QR_other_edit
					
					$update_16="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_QR_other`=`care_master_crop_diversification_crp_meo`.`care_QR_other_edit`SET`care_master_crop_diversification_crp_meo`.`care_QR_other_status`= '1'";
					$sql_get_detail16=mysqli_query($conn,$update_16);

					//care_P_consumption_edit

					$update_17="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_P_consumption`=`care_master_crop_diversification_crp_meo`.`care_P_consumption_edit`SET`care_master_crop_diversification_crp_meo`.`care_P_consumption_status`= '1'";
					$sql_get_detail17=mysqli_query($conn,$update_17);

					// care_P_sale_edit
					
					$update_18="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_P_sale`=`care_master_crop_diversification_crp_meo`.`care_P_sale_edit`SET`care_master_crop_diversification_crp_meo`.`care_P_sale_status`= '1'";
					$sql_get_detail18=mysqli_query($conn,$update_18);

					//care_P_total_production_edit

					$update_19="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_P_total_production`=`care_master_crop_diversification_crp_meo`.`care_P_total_production_edit`SET`care_master_crop_diversification_crp_meo`.`care_P_total_production_status`= '1'";
					$sql_get_detail19=mysqli_query($conn,$update_19);

					// care_LS_QP_extension_support_edit
					
					$update_20="UPDATE`care_master_crop_diversification_crp_meo` INNER JOIN`care_master_crop_diversification_crp` ON`care_master_crop_diversification_crp`.`care_slno` =`care_master_crop_diversification_crp_meo`.`care_crop_serial_id` AND`care_master_crop_diversification_crp`.`care_avg_price`=`care_master_crop_diversification_crp_meo`.`care_avg_price_edit`SET`care_master_crop_diversification_crp_meo`.`care_avg_price_status`= '1'";
					$sql_get_detail20=mysqli_query($conn,$update_20);

					$hhi=$_POST['care_hhi'];
					$Year=$_POST['Year'];
					$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
					$sql_get_detail=mysqli_query($conn,$get_details);

					$fetch_check=mysqli_fetch_assoc($sql_get_detail);
					$slno_md=$fetch_check['care_hhi_sl_no'];
					$get_userilaze_form1=unserialize($fetch_check['care_form8']); // serial mo
					$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form8']);//
					$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form8']);


					for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
						$get_userilaze_form1_q=$get_userilaze_form1[$i];
						$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
						if(in_array($get_userilaze_form1_q,$din)){
							if($care_MEO_status_form1[$i]==2){
								$array_date[]=$date;
								$array_form1[]=1;
								$array_form2[]=2;
							}else{
								$array_date[]=$get_userilaze_form1_date_single;
								$array_form1[]=1;
								$array_form2[]=2;
							}
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=$care_MEO_status_form1[$i];
							
						}

					}
					 $date_mt=serialize($array_date);
					 $care_CBO_status_form1_new=serialize($array_form1);
					 $care_MEO_status_form1_new=serialize($array_form1);
					 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form8`='$care_MEO_status_form1_new',`care_MEO_date_form8`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
					mysqli_query($conn,$update);
					$msg->success('SuccessFully Edited information on Farmland of HHI '.$hhi);
					header('Location:index.php');
					exit;

				break;
			case 'form9':
		
			$care_EV_them_intervention=$_POST['care_EV_them_intervention'];
			$care_EV_topics_covered=$_POST['care_EV_topics_covered'];
			$care_EV_event_date=$_POST['care_EV_event_date'];
			$care_EV_avg_session_duration=$_POST['care_EV_avg_session_duration'];
			$care_EV_male_Participants=$_POST['care_EV_male_Participants'];
			$care_EV_female_Participants=$_POST['care_EV_female_Participants'];
			$care_EV_no_of_hhs_covered=$_POST['care_EV_no_of_hhs_covered'];
			$care_EV_male_Participants_repeats=$_POST['care_EV_male_Participants_repeats'];
			$care_EV_female_Participants_repeats=$_POST['care_EV_female_Participants_repeats'];
			$care_EV_no_of_hhs_repeats=$_POST['care_EV_no_of_hhs_repeats'];
			// $comments_mt=$_POST['comments_mt'];
			$care_EV_training_type=$_POST['care_EV_training_type'];
			$care_EV_group_type=$_POST['care_EV_group_type'];
			$care_EV_training_facilitator=$_POST['care_EV_training_facilitator'];
			$care_EV_external_resource=$_POST['care_EV_external_resource'];
			$care_EV_remarks=$_POST['care_EV_remarks'];
					for ($i=0; $i <count($slno) ; $i++) {
						$care_EV_them_intervention_edit=$care_EV_them_intervention[$i];
						$care_EV_topics_covered_edit=$care_EV_topics_covered[$i];
						$care_EV_event_date_edit=$care_EV_event_date[$i];
						$care_EV_avg_session_duration_edit=$care_EV_avg_session_duration[$i];
						$care_EV_male_Participants_edit=$care_EV_male_Participants[$i];
						$care_EV_female_Participants_edit=$care_EV_female_Participants[$i];
						$care_EV_no_of_hhs_covered_edit=$care_EV_no_of_hhs_covered[$i];
						$care_EV_male_Participants_repeats_edit=$care_EV_male_Participants_repeats[$i];
						$care_EV_female_Participants_repeats_edit=$care_EV_female_Participants_repeats[$i];
						$care_EV_no_of_hhs_repeats_edit=$care_EV_no_of_hhs_repeats[$i];
						$care_EV_training_type_edit=$care_EV_training_type[$i];
						$care_EV_group_type_edit=$care_EV_group_type[$i];
						$care_EV_training_facilitator_edit=$care_EV_training_facilitator[$i];
						$care_EV_external_resource_edit=$care_EV_external_resource[$i];
						$care_EV_remarks_edit=$care_EV_remarks[$i];
						//$singel_comments_mt=$comments_mt[$i];
						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
						$get_info="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_slno`='$slno_single' and`care_EV_MEO_status`='1'";
						$sql_get_detail=mysqli_query($conn,$get_info);
						$num_row=mysqli_num_rows($sql_get_detail);
						if($num_row==0){
							 $uspdate="UPDATE `care_master_mrf_exposure_visit_tarina` SET `care_EV_MEO_time`='$time',`care_EV_MEO_date`='$date',`care_EV_MEO_id`='$meo_user',`care_EV_MEO_status`='1' where `care_EV_slno`='$slno_single'";
							
							$meo_users=mysqli_query($conn,$uspdate);
							
						}
						if($meo_users){
							$insert_meo="INSERT INTO `care_master_mrf_exposure_visit_tarina_meo`(`car_training_serial_id`,`care_EV_them_intervention`, `care_EV_topics_covered`, `care_EV_event_date`, `care_EV_male_Participants`, `care_EV_female_Participants`, `care_EV_male_Participants_repeats`, `care_EV_female_Participants_repeats`, `care_EV_no_of_hhs_covered`, `care_EV_no_of_hhs_repeats`, `care_EV_avg_session_duration`, `care_EV_training_type`, `care_EV_group_type`, `care_EV_training_facilitator`, `care_EV_external_resource`, `care_EV_remarks`, `care_EV_vlg_name`, `care_EV_block_name`, `care_EV_district_name`, `care_EV_gp_name`, `care_EV_month`, `care_EV_year`, `care_EV_date`, `care_EV_time`, `care_EV_employee_id`, `care_EV_lat_id`, `care_EV_lang_id`, `care_EV_status`, `care_EV_mt_comment_empty`, `care_EV_mt_comment_date`, `care_EV_mt_comment_time`, `care_EV_mt_comment_status`, `care_EV_mt_id`, `care_EV_CBO_comment_empty`, `care_EV_CBO_comment_date`, `care_EV_CBO_comment_time`, `care_EV_CBO_comment_status`, `care_EV_CBO_id`, `care_EV_MEO_status`, `care_EV_MEO_date`, `care_EV_MEO_time`, `care_EV_MEO_id`) SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_slno`='$slno_single'";
							$meo_user_insert=mysqli_query($conn,$insert_meo);
										
						}
						if($meo_user_insert){
							$update_meo_details="UPDATE `care_master_mrf_exposure_visit_tarina_meo` SET `care_EV_them_intervention_edit`='$care_EV_them_intervention_edit',`care_EV_them_intervention_status`='2',`care_EV_topics_covered_edit`='$care_EV_topics_covered_edit',`care_EV_topics_covered_status`='2',`care_EV_event_date_edit`='$care_EV_event_date_edit',`care_EV_event_date_status`='2',`care_EV_male_Participants_edit`='$care_EV_male_Participants_edit',`care_EV_male_Participants_status`='2',`care_EV_female_Participants_edit`='$care_EV_female_Participants_edit',`care_EV_female_Participants_status`='2',`care_EV_male_Participants_repeats_edit`='$care_EV_male_Participants_repeats_edit',`care_EV_male_Participants_repeats_status`='2',`care_EV_female_Participants_repeats_edit`='$care_EV_female_Participants_repeats_edit',`care_EV_female_Participants_repeats_status`='2',`care_EV_no_of_hhs_covered_edit`='$care_EV_no_of_hhs_covered_edit',`care_EV_no_of_hhs_covered_status`='2',`care_EV_no_of_hhs_repeats_edit`='$care_EV_no_of_hhs_repeats_edit',`care_EV_no_of_hhs_repeats_status`='2',`care_EV_avg_session_duration_edit`='$care_EV_avg_session_duration_edit',`care_EV_avg_session_duration_status`='2',`care_EV_training_type_edit`='$care_EV_training_type_edit',`care_EV_training_type_status`='2',`care_EV_group_type_edit`='$care_EV_group_type_edit',`care_EV_group_type_status`='2',`care_EV_training_facilitator_edit`='$care_EV_training_facilitator_edit',`care_EV_training_facilitator_status`='2',`care_EV_external_resource_edit`='$care_EV_external_resource_edit',`care_EV_external_resource_status`='2',`care_EV_remarks_edit`='$care_EV_remarks_edit',`care_EV_remarks_status`='2' WHERE `car_training_serial_id`='$slno_single'";
							$update_meo_details_exe=mysqli_query($conn,$update_meo_details);
									
						}

					}

					// care_EV_them_intervention_edit
					$update_1="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_them_intervention`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_them_intervention_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_them_intervention_status`= '1'";
					$sql_get_detail1=mysqli_query($conn,$update_1);

					// care_EV_topics_covered_edit

					$update_2="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_topics_covered`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_topics_covered_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_topics_covered_status`= '1'";
					$sql_get_detail2=mysqli_query($conn,$update_2);

					// care_EV_event_date_edit

					$update_3="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_event_date`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_event_date_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_event_date_status`= '1'";
					$sql_get_detail3=mysqli_query($conn,$update_3);

					// care_EV_avg_session_duration_edit

					$update_4="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_avg_session_duration`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_avg_session_duration_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_avg_session_duration_status`= '1'";
					$sql_get_detail4=mysqli_query($conn,$update_4);

					// care_EV_male_Participants_edit

					$update_5="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_male_Participants`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_male_Participants_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_male_Participants_status`= '1'";
					$sql_get_detail5=mysqli_query($conn,$update_5);

					// care_EV_female_Participants_edit

					$update_6="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_female_Participants`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_female_Participants_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_female_Participants_status`= '1'";
					$sql_get_detail6=mysqli_query($conn,$update_6);

					// care_EV_no_of_hhs_covered_edit

					$update_7="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_no_of_hhs_covered`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_no_of_hhs_covered_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_no_of_hhs_covered_status`= '1'";
					$sql_get_detail7=mysqli_query($conn,$update_7);

					// care_EV_male_Participants_repeats_edit

					$update_8="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_male_Participants_repeats`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_male_Participants_repeats_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_male_Participants_repeats_status`= '1'";
					$sql_get_detail8=mysqli_query($conn,$update_8);

					// care_EV_female_Participants_repeats_edit

					$update_9="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_female_Participants_repeats`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_female_Participants_repeats_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_female_Participants_repeats_status`= '1'";
					$sql_get_detail9=mysqli_query($conn,$update_9);

					// care_EV_no_of_hhs_repeats_edit

					$update_10="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_no_of_hhs_repeats`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_no_of_hhs_repeats_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_no_of_hhs_repeats_status`= '1'";
					$sql_get_detail10=mysqli_query($conn,$update_10);

					// care_EV_training_type_edit

					$update_11="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_training_type`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_training_type_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_training_type_status`= '1'";
					$sql_get_detail11=mysqli_query($conn,$update_11);

					// care_EV_group_type_edit

					$update_12="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_group_type`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_group_type_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_group_type_status`= '1'";
					$sql_get_detail12=mysqli_query($conn,$update_12);

					// care_EV_training_facilitator_edit

					$update_13="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_training_facilitator`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_training_facilitator_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_training_facilitator_status`= '1'";
					$sql_get_detail13=mysqli_query($conn,$update_13);

					// care_EV_external_resource_edit

					$update_14="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_external_resource`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_external_resource_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_external_resource_status`= '1'";
					$sql_get_detail14=mysqli_query($conn,$update_14);

					// care_EV_remarks_edit

					$update_15="UPDATE`care_master_mrf_exposure_visit_tarina_meo` INNER JOIN`care_master_mrf_exposure_visit_tarina` ON`care_master_mrf_exposure_visit_tarina`.`care_EV_slno` =`care_master_mrf_exposure_visit_tarina_meo`.`car_training_serial_id` AND`care_master_mrf_exposure_visit_tarina`.`care_EV_remarks`=`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_remarks_edit`SET`care_master_mrf_exposure_visit_tarina_meo`.`care_EV_remarks_status`= '1'";
					$sql_get_detail15=mysqli_query($conn,$update_15);

					
					mysqli_query($conn,$update);
					$msg->success('SuccessFully Edited information on Farmland of HHI '.$hhi);
					header('Location:index.php');
					exit;

				break;
			case 'form10':
					// Array ( [form_type] => X06otqslU9E9QQ1QDb5dv7aXb/Pq8VJiz6X8ymtoinQ= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [form_type_new] => 9f0QwTMUioqFjbXXZtFGLv8lmvQ455Q/ZQeFcf8UAi4= [form_type_id] => Itt34AUThBeJwOfTxL6o1J9GWEStzKfD+2zWuYpWMn0= [form_type_user] => x8mFQV7/zmcrGyAQTUyVK6Lw1B5dCohIIxLgJHQYWGk= [district] => kalahandi [GP_name] => bankapalas [Block] => junagarh [Village] => bankapalas [Year] => 2017 [form_type_id_div] => Array ( [0] => TVGhMhqJNCoOSLGbQDiJe2LsbLRlyK+eZ6vABEMsEZg= [1] => 93Z/d1ygfbtPCPZ0WGuQwDDYiDCFkSlW29n6UYHfRrg= [2] => TVGhMhqJNCoOSLGbQDiJe2LsbLRlyK+eZ6vABEMsEZg= [3] => 93Z/d1ygfbtPCPZ0WGuQwDDYiDCFkSlW29n6UYHfRrg= ) [care_SHG_total_member] => Array ( [0] => 15 [1] => 2 ) [care_SHG_LMM_date] => Array ( [0] => 2017-11-20 [1] => 2017-11-21 ) [care_SHG_mem_prsnt_monthly_meeting] => Array ( [0] => 4 hours [1] => 1 ) [care_SHG_RMU_meeting_redg] => Array ( [0] => 2 [1] => 1 ) [care_SHG_RMU_cash_book] => Array ( [0] => 1 [1] => 1 ) [care_SHG_RMU_ind_passbook] => Array ( [0] => 1 [1] => 1 ) [care_SHG_RMU_group_passbook] => Array ( [0] => 2 [1] => 1 ) [care_SHG_RMU_saving_loan_ledger_book] => Array ( [0] => 1 [1] => 1 ) [care_SHG_ML_linkage_external_credit] => Array ( [0] => 1 [1] => 1 ) [care_SHG_ML_bank_name] => Array ( [0] => sbi [1] => cbc ) [care_SHG_ML_no_of_mem_link_market] => Array ( [0] => 5 [1] => 2 ) [care_SHG_ML_no_of_mem_link_tech_support_provider] => Array ( [0] => 3 [1] => 1 ) [comments_mt] => Array ( [0] => ok1 [1] => ok1 ) [care_SHG_no_of_mem_link_any_committee] => Array ( [0] => 7 [1] => 1 ) [care_SHG_committee_name] => Array ( [0] => Panchayat Raj [1] => SMC ) [care_SHG_nutrition_discus_SHG_mnthly_meeting] => Array ( [0] => 2 [1] => 1 ) [care_SHG_mt_comment_empty] => Array ( [0] => ok [1] => ok ) [save] => save )

					$care_SHG_total_member=$_POST['care_SHG_total_member'];
					$care_SHG_LMM_date=$_POST['care_SHG_LMM_date'];
					$care_SHG_mem_prsnt_monthly_meeting=$_POST['care_SHG_mem_prsnt_monthly_meeting'];
					$care_SHG_RMU_meeting_redg=$_POST['care_SHG_RMU_meeting_redg'];
					$care_SHG_RMU_cash_book=$_POST['care_SHG_RMU_cash_book'];
					$care_SHG_RMU_ind_passbook=$_POST['care_SHG_RMU_ind_passbook'];
					$care_SHG_RMU_group_passbook=$_POST['care_SHG_RMU_group_passbook'];
				    $care_SHG_RMU_saving_loan_ledger_book=$_POST['care_SHG_RMU_saving_loan_ledger_book'];
					$care_SHG_ML_linkage_external_credit=$_POST['care_SHG_ML_linkage_external_credit'];
					$care_SHG_ML_bank_name=$_POST['care_SHG_ML_bank_name'];
					$care_SHG_ML_no_of_mem_link_market=$_POST['care_SHG_ML_no_of_mem_link_market'];
				    $care_SHG_ML_no_of_mem_link_tech_support_provider=$_POST['care_SHG_ML_no_of_mem_link_tech_support_provider'];
				    $care_SHG_no_of_mem_link_any_committee=$_POST['care_SHG_no_of_mem_link_any_committee'];
					$care_SHG_committee_name=$_POST['care_SHG_committee_name'];
				    $care_SHG_nutrition_discus_SHG_mnthly_meeting=$_POST['care_SHG_nutrition_discus_SHG_mnthly_meeting'];
					$shg_field_new1=$_POST['shg_field_new1'];
					$shg_field_new2=$_POST['shg_field_new2'];
					$shg_field_new3=$_POST['shg_field_new3'];
					$shg_field_new4=$_POST['shg_field_new4'];
					$shg_field_new5=$_POST['shg_field_new5'];
					$shg_field_new6=$_POST['shg_field_new6'];
					$shg_field_new7=$_POST['shg_field_new7'];
					$shg_field_new8=$_POST['shg_field_new8'];


				for ($i=0; $i <count($slno) ; $i++) {
					
					$care_SHG_total_member_edit=$care_SHG_total_member[$i];
					$care_SHG_LMM_date_edit=$care_SHG_LMM_date[$i];
					$care_SHG_mem_prsnt_monthly_meeting_edit=$care_SHG_mem_prsnt_monthly_meeting[$i];
					$care_SHG_RMU_meeting_redg_edit=$care_SHG_RMU_meeting_redg[$i];
					$care_SHG_RMU_cash_book_edit=$care_SHG_RMU_cash_book[$i];
					$care_SHG_RMU_ind_passbook_edit=$care_SHG_RMU_ind_passbook[$i];
					$care_SHG_RMU_group_passbook_edit=$care_SHG_RMU_group_passbook[$i];
					$care_SHG_RMU_saving_loan_ledger_book_edit=$care_SHG_RMU_saving_loan_ledger_book[$i];
					$care_SHG_ML_linkage_external_credit_edit=$care_SHG_ML_linkage_external_credit[$i];
					$care_SHG_ML_bank_name_edit=$care_SHG_ML_bank_name[$i];
					$care_SHG_ML_no_of_mem_link_market_edit=$care_SHG_ML_no_of_mem_link_market[$i];
					$care_SHG_ML_no_of_mem_link_tech_support_provider_edit=$care_SHG_ML_no_of_mem_link_tech_support_provider[$i];
					$care_SHG_no_of_mem_link_any_committee_edit=$care_SHG_no_of_mem_link_any_committee[$i];
					$care_SHG_committee_name_edit=$care_SHG_committee_name[$i];
					$care_SHG_nutrition_discus_SHG_mnthly_meeting_edit=$care_SHG_nutrition_discus_SHG_mnthly_meeting[$i];
					$shg_field_new1_edit=$shg_field_new1[$i];
					$shg_field_new2_edit=$shg_field_new2[$i];
					$shg_field_new3_edit=$shg_field_new3[$i];
					$shg_field_new4_edit=$shg_field_new4[$i];
					$shg_field_new5_edit=$shg_field_new5[$i];
					$shg_field_new6_edit=$shg_field_new6[$i];
					$shg_field_new7_edit=$shg_field_new7[$i];
					$shg_field_new8_edit=$shg_field_new8[$i];

					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_slno`='$slno_single' and`care_SHG_MEO_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_mrf_shg_tracking_under_tarina` SET `care_SHG_MEO_time`='$time',`care_SHG_MEO_date`='$date',`care_SHG_MEO_id`='$meo_user',`care_SHG_MEO_status`='1' where `care_SHG_slno`='$slno_single'";
						$sql_get_detail_meo=mysqli_query($conn,$uspdate);
					}
					if($sql_get_detail_meo){
						$check="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina_meo` WHERE `care_SHG_serial_id`='$slno_single' and `care_SHG_MEO_status`='1'";
						$sql_check_detail_meo=mysqli_query($conn,$check);
						$sql_check_detail_meo_num=mysqli_num_rows($sql_check_detail_meo);
					}
					if($sql_check_detail_meo_num=='0'){
						// print_r($_POST);
						  $insert_meo="INSERT INTO `care_master_mrf_shg_tracking_under_tarina_meo`( `care_SHG_serial_id`, `care_SHG_list_id`, `care_SHG_name`, `care_SHG_total_member`, `care_SHG_LMM_date`, `care_SHG_mem_prsnt_monthly_meeting`, `care_SHG_RMU_meeting_redg`, `care_SHG_RMU_cash_book`, `care_SHG_RMU_ind_passbook`, `care_SHG_RMU_group_passbook`, `care_SHG_RMU_saving_loan_ledger_book`, `care_SHG_ML_linkage_external_credit`, `care_SHG_ML_bank_name`, `care_SHG_ML_no_of_mem_link_market`, `care_SHG_ML_no_of_ name_MLM`, `care_SHG_ML_no_of_mem_link_tech_support_provider`, `care_SHG_ML_no_of_name_MLTSP`, `care_SHG_no_of_mem_link_any_committee`, `care_SHG_no_of_name_MLAC`, `care_SHG_committee_name`, `care_SHG_nutrition_discus_SHG_mnthly_meeting`, `care_SHG_employee_id`, `care_SHG_lat_id`, `care_SHG_long_id`, `care_SHG_vlg_name`, `care_SHG_block_name`, `care_SHG_district_name`, `care_SHG_gp_name`, `care_SHG_crp_name`, `care_SHG_month`, `care_SHG_year`, `care_SHG_date`, `care_SHG_time`, `care_SHG_status`, `care_SHG_id`, `care_SHG_mt_comment_empty`, `care_SHG_mt_comment_date`, `care_SHG_mt_comment_time`, `care_SHG_mt_comment_status`, `care_SHG_mt_id`, `care_SHG_CBO_comment_empty`, `care_SHG_CBO_comment_date`, `care_SHG_CBO_comment_time`, `care_SHG_CBO_comment_status`, `care_SHG_CBO_id`, `care_SHG_MEO_status`, `care_SHG_MEO_date`, `care_SHG_MEO_time`, `care_SHG_MEO_id`,`shg_field_new1`, `shg_field_new2`, `shg_field_new3`, `shg_field_new4`, `shg_field_new5`, `shg_field_new6`, `shg_field_new7`, `shg_field_new8`) SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_slno`='$slno_single'";
						$sql_update_meo=mysqli_query($conn,$insert_meo);
						// echo mysqli_error($conn);
						// exit;
						
					}

					//print_r($_POST);


		// form10Array ( [form_type] => X06otqslU9E9QQ1QDb5dv7aXb/Pq8VJiz6X8ymtoinQ= [lat2] => 20.3100678 [lat] => 20.3100678 [long2] => 85.8191389 [long] => 85.8191389 [form_type_new] => 9f0QwTMUioqFjbXXZtFGLv8lmvQ455Q/ZQeFcf8UAi4= [form_type_id] => Itt34AUThBeJwOfTxL6o1J9GWEStzKfD+2zWuYpWMn0= [form_type_user] => CxZJSNwtcsmT9lyfL9LU50plzzZWC7VeX5F4GyYqbas= [district] => kalahandi [GP_name] => bankapalas [Block] => junagarh [Village] => balarampur [Year] => 2018 [form_type_id_div] => Array ( [0] => 93Z/d1ygfbtPCPZ0WGuQwDDYiDCFkSlW29n6UYHfRrg= [1] => 93Z/d1ygfbtPCPZ0WGuQwDDYiDCFkSlW29n6UYHfRrg= ) [care_SHG_total_member] => Array ( [0] => 12 ) [care_SHG_LMM_date] => Array ( [0] => 2018-03-03 ) [care_SHG_mem_prsnt_monthly_meeting] => Array ( [0] => 11 ) [Cash] => 1 [Individual] => 1 [Group] => 1 [Meeting] => 1 [care_SHG_RMU_saving_loan_ledger_book] => Array ( [0] => 1 ) [care_SHG_ML_linkage_external_credit] => Array ( [0] => 1 ) [care_SHG_ML_bank_name] => Array ( [0] => abc ltd ) [care_SHG_ML_no_of_mem_link_market] => Array ( [0] => 9 ) [care_SHG_ML_no_of_mem_link_tech_support_provider] => Array ( [0] => 8 ) [shg_field_new1] => ok [shg_field_new3] => 1 [shg_field_new4] => ok [shg_field_new5] => 1 [shg_field_new6] => ok [shg_field_new7] => 1 [shg_field_new8] => ok [comments_mt] => Array ( [0] => ok ) [care_SHG_no_of_mem_link_any_committee] => Array ( [0] => 11 ) [care_SHG_committee_name] => Array ( [0] => SMC ) [care_SHG_nutrition_discus_SHG_mnthly_meeting] => Array ( [0] => 1 ) [care_SHG_mt_comment_empty] => Array ( [0] => ok ) [save] => save ) UPDATE `care_master_mrf_shg_tracking_under_tarina_meo` SET `care_SHG_total_member_edit`='12',`care_SHG_total_member_status`='2',`care_SHG_LMM_date_edit`='2018-03-03',`care_SHG_LMM_date_status`='2',`care_SHG_mem_prsnt_monthly_meeting_edit`='11',`care_SHG_mem_prsnt_monthly_meeting_status`='2',`care_SHG_RMU_meeting_redg_edit`='',`care_SHG_RMU_meeting_redg_status`='2',`care_SHG_RMU_cash_book_edit`='',`care_SHG_RMU_cash_book_status`='2',`care_SHG_RMU_ind_passbook_edit`='',`care_SHG_RMU_ind_passbook_status`='2',`care_SHG_RMU_group_passbook_edit`='',`care_SHG_RMU_group_passbook_status`='2',`care_SHG_RMU_saving_loan_ledger_book_edit`='1',`care_SHG_RMU_saving_loan_ledger_book_status`='2',`care_SHG_ML_linkage_external_credit_edit`='1',`care_SHG_ML_linkage_lexternal_credit_status`='2',`care_SHG_ML_bank_name_edit`='abc ltd',`care_SHG_ML_bank_name_status`='2',`care_SHG_ML_no_of_mem_link_market_edit`='9',`care_SHG_ML_no_of_mem_link_market_status`='2',`care_SHG_ML_no_of_mem_link_tech_support_provider_edit`='8',`care_SHG_ML_no_of_mem_link_tech_support_provider_status`='2',`care_SHG_no_of_mem_link_any_committee_edit`='11',`care_SHG_no_of_mem_link_any_committee_status`='2',`care_SHG_committee_name_edit`='SMC',`care_SHG_committee_name_status`='2',`care_SHG_nutrition_discus_SHG_mnthly_meeting_edit`='1',`care_SHG_nutrition_discus_SHG_mnthly_meeting_status`='2',`shg_field_new1_edit`='o',`shg_field_new2_edit`='', `shg_field_new3_edit`='1',`shg_field_new4_edit`='o', `shg_field_new5_edit`='1',`shg_field_new6_edit`='o', `shg_field_new7_edit`='1',`shg_field_new8_edit`='o', `shg_field_new1_status`='2',`shg_field_new2_status`='2', `shg_field_new3_status`='2',`shg_field_new4_status`='2', `shg_field_new5_status`='2',`shg_field_new6_status`='2', `shg_field_new7_status`='2',`shg_field_new8_status`='2' WHERE `care_SHG_serial_id`='2'Incorrect integer value: '' for column 'care_SHG_RMU_meeting_redg_edit' at row 1



					if($sql_update_meo){
						  //print_r($_POST);
						  $update_info_meo="UPDATE `care_master_mrf_shg_tracking_under_tarina_meo` SET `care_SHG_total_member_edit`='$care_SHG_total_member_edit',`care_SHG_total_member_status`='2',`care_SHG_LMM_date_edit`='$care_SHG_LMM_date_edit',`care_SHG_LMM_date_status`='2',`care_SHG_mem_prsnt_monthly_meeting_edit`='$care_SHG_mem_prsnt_monthly_meeting_edit',`care_SHG_mem_prsnt_monthly_meeting_status`='2',`care_SHG_RMU_meeting_redg_edit`='$care_SHG_RMU_meeting_redg_edit',`care_SHG_RMU_meeting_redg_status`='2',`care_SHG_RMU_cash_book_edit`='$care_SHG_RMU_cash_book_edit',`care_SHG_RMU_cash_book_status`='2',`care_SHG_RMU_ind_passbook_edit`='$care_SHG_RMU_ind_passbook_edit',`care_SHG_RMU_ind_passbook_status`='2',`care_SHG_RMU_group_passbook_edit`='$care_SHG_RMU_group_passbook_edit',`care_SHG_RMU_group_passbook_status`='2',`care_SHG_RMU_saving_loan_ledger_book_edit`='$care_SHG_RMU_saving_loan_ledger_book_edit',`care_SHG_RMU_saving_loan_ledger_book_status`='2',`care_SHG_ML_linkage_external_credit_edit`='$care_SHG_ML_linkage_external_credit_edit',`care_SHG_ML_linkage_lexternal_credit_status`='2',`care_SHG_ML_bank_name_edit`='$care_SHG_ML_bank_name_edit',`care_SHG_ML_bank_name_status`='2',`care_SHG_ML_no_of_mem_link_market_edit`='$care_SHG_ML_no_of_mem_link_market_edit',`care_SHG_ML_no_of_mem_link_market_status`='2',`care_SHG_ML_no_of_mem_link_tech_support_provider_edit`='$care_SHG_ML_no_of_mem_link_tech_support_provider_edit',`care_SHG_ML_no_of_mem_link_tech_support_provider_status`='2',`care_SHG_no_of_mem_link_any_committee_edit`='$care_SHG_no_of_mem_link_any_committee_edit',`care_SHG_no_of_mem_link_any_committee_status`='2',`care_SHG_committee_name_edit`='$care_SHG_committee_name_edit',`care_SHG_committee_name_status`='2',`care_SHG_nutrition_discus_SHG_mnthly_meeting_edit`='$care_SHG_nutrition_discus_SHG_mnthly_meeting_edit',`care_SHG_nutrition_discus_SHG_mnthly_meeting_status`='2',`shg_field_new1_edit`='$shg_field_new1_edit',`shg_field_new2_edit`='$shg_field_new2_edit', `shg_field_new3_edit`='$shg_field_new3_edit',`shg_field_new4_edit`='$shg_field_new4_edit', `shg_field_new5_edit`='$shg_field_new5_edit',`shg_field_new6_edit`='$shg_field_new6_edit', `shg_field_new7_edit`='$shg_field_new7_edit',`shg_field_new8_edit`='$shg_field_new8_edit', `shg_field_new1_status`='2',`shg_field_new2_status`='2', `shg_field_new3_status`='2',`shg_field_new4_status`='2', `shg_field_new5_status`='2',`shg_field_new6_status`='2', `shg_field_new7_status`='2',`shg_field_new8_status`='2' WHERE `care_SHG_serial_id`='$slno_single'";

						 $sql_update_meos=mysqli_query($conn,$update_info_meo);
						  // echo mysqli_error($conn);
						  // exit;

							$file = fopen("test144.txt", "a+");
								fwrite($file, "---   " . $slno_single . "---update_info_meo ".$update_info_meo."----- sql_update_meos ".$sql_update_meos);
								fclose($file);

					}	

				}
					// care_SHG_total_member_edit
					$update_1="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_total_member`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_total_member_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_total_member_status`= '1'";
					$sql_get_detail1=mysqli_query($conn,$update_1);

					// care_SHG_LMM_date_edit

					$update_2="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_LMM_date`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_LMM_date_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_LMM_date_status`= '1'";
					$sql_get_detail2=mysqli_query($conn,$update_2);

					// care_SHG_mem_prsnt_monthly_meeting_edit

					$update_3="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_mem_prsnt_monthly_meeting`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_mem_prsnt_monthly_meeting_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_mem_prsnt_monthly_meeting_status`= '1'";
					$sql_get_detail3=mysqli_query($conn,$update_3);

					// care_SHG_RMU_meeting_redg_edit

					$update_4="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_RMU_meeting_redg`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_RMU_meeting_redg_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_RMU_meeting_redg_status`= '1'";
					$sql_get_detail4=mysqli_query($conn,$update_4);

					// care_SHG_RMU_cash_book_edit

					$update_5="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_RMU_cash_book`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_RMU_cash_book_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_RMU_cash_book_status`= '1'";
					$sql_get_detail5=mysqli_query($conn,$update_5);

					// care_SHG_RMU_ind_passbook_edit

					$update_6="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_RMU_ind_passbook`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_RMU_ind_passbook_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_RMU_ind_passbook_status`= '1'";
					$sql_get_detail6=mysqli_query($conn,$update_6);

					// care_SHG_RMU_group_passbook_edit

					$update_7="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_RMU_group_passbook`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_RMU_group_passbook_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_RMU_group_passbook_status`= '1'";
					$sql_get_detail7=mysqli_query($conn,$update_7);

					// care_SHG_RMU_saving_loan_ledger_book_edit

					$update_8="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_RMU_saving_loan_ledger_book`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_RMU_saving_loan_ledger_book_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_RMU_saving_loan_ledger_book_status`= '1'";
					$sql_get_detail8=mysqli_query($conn,$update_8);

					// care_SHG_ML_linkage_external_credit_edit
					
					$update_9="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_ML_linkage_external_credit`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_ML_linkage_external_credit_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_ML_linkage_lexternal_credit_status`= '1'";
					$sql_get_detail9=mysqli_query($conn,$update_9);

					// care_SHG_ML_bank_name_edit

					$update_10="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_ML_bank_name`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_ML_bank_name_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_ML_bank_name_status`= '1'";
					$sql_get_detail10=mysqli_query($conn,$update_10);

					// care_SHG_ML_no_of_mem_link_market_edit

					$update_11="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_ML_no_of_mem_link_market`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_ML_no_of_mem_link_market_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_ML_no_of_mem_link_market_status`= '1'";
					$sql_get_detail11=mysqli_query($conn,$update_11);

					// care_SHG_ML_no_of_mem_link_tech_support_provider_edit

					$update_12="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_ML_no_of_mem_link_tech_support_provider`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_ML_no_of_mem_link_tech_support_provider_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_ML_no_of_mem_link_tech_support_provider_status`= '1'";
					$sql_get_detail12=mysqli_query($conn,$update_12);

					// care_SHG_no_of_mem_link_any_committee_edit

					$update_13="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_no_of_mem_link_any_committee`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_no_of_mem_link_any_committee_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_no_of_mem_link_any_committee_status`= '1'";
					$sql_get_detail13=mysqli_query($conn,$update_13);

					// care_SHG_committee_name_edit

					$update_14="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_committee_name`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_committee_name_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_committee_name_status`= '1'";
					$sql_get_detail14=mysqli_query($conn,$update_14);

					// care_SHG_nutrition_discus_SHG_mnthly_meeting_edit

					$update_15="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_nutrition_discus_SHG_mnthly_meeting`=`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_nutrition_discus_SHG_mnthly_meeting_edit`SET`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_nutrition_discus_SHG_mnthly_meeting_status`= '1'";
					$sql_get_detail15=mysqli_query($conn,$update_15);

					// shg_field_new1

					$update_16="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`shg_field_new1`=`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new1_edit` SET`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new1_status`= '1'";
					$sql_get_detail16=mysqli_query($conn,$update_16);
					//shg_field_new2

					$update_17="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`shg_field_new2`=`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new2_edit` SET`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new2_status`= '1'";
					$sql_get_detail17=mysqli_query($conn,$update_17);
					//shg_field_new3

					$update_18="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`shg_field_new3`=`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new3_edit` SET`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new3_status`= '1'";
					$sql_get_detail18=mysqli_query($conn,$update_18);
					//shg_field_new4

					$update_19="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`shg_field_new4`=`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new4_edit` SET`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new4_status`= '1'";
					$sql_get_detail19=mysqli_query($conn,$update_19);
					//shg_field_new5

					$update_20="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`shg_field_new5`=`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new5_edit` SET`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new5_status`= '1'";
					$sql_get_detail20=mysqli_query($conn,$update_20);
					//shg_field_new6

					$update_21="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`shg_field_new6`=`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new6_edit` SET`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new6_status`= '1'";
					$sql_get_detail21=mysqli_query($conn,$update_21);
					//shg_field_new7

					$update_22="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`shg_field_new7`=`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new7_edit` SET`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new7_status`= '1'";
					$sql_get_detail22=mysqli_query($conn,$update_22);
					//shg_field_new8

					$update_23="UPDATE`care_master_mrf_shg_tracking_under_tarina_meo` INNER JOIN`care_master_mrf_shg_tracking_under_tarina` ON`care_master_mrf_shg_tracking_under_tarina`.`care_SHG_slno` =`care_master_mrf_shg_tracking_under_tarina_meo`.`care_SHG_serial_id` AND`care_master_mrf_shg_tracking_under_tarina`.`shg_field_new8`=`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new8_edit` SET`care_master_mrf_shg_tracking_under_tarina_meo`.`shg_field_new8_status`= '1'";
					$sql_get_detail23=mysqli_query($conn,$update_23);

					$msg->success('SuccessFully Edited information on SHG of HHI '.$hhi);
					header('Location:index.php');
					exit;
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