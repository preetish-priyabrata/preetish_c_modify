<?php
print_r($_POST);
exit;
ini_set('display_errors',1);
session_start();
ob_start();
if($_SESSION['cbo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();


	$form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
	// location 
	$district=$_POST['district'];
	$Block=$_POST['Block'];	
	$GP_name=$_POST['GP_name'];	
	$Village=$_POST['Village'];
	// user browser detail
	$lat2=$_POST['lat2'];
	$lat=$_POST['lat'];
	$long2=$_POST['long2'];
	$long=$_POST['long'];
	$mt_user=$_SESSION['cbo_user'];
	//which month there are capturing data 
	$month=$_POST['month'];
	$Year=$_POST['Year'];
	// current date time 
	$date=date('Y-m-d');
	$time=date('H:i:s');
	// household details
	$care_hhi=$_POST['care_hhi'];
	$care_hhi_slno=$_POST['care_hhi_slno'];
	$women=$_POST['women'];
	$Spouse=$_POST['Spouse'];

if(($lat2==$lat) && ($long2==$long)){
	switch (1) {
		case 'hhi_for_input_output':
			 // Array ( [form_type] => ZjtQ/MNZlhMely1fwllxj7iu2JE/zyVOWaBHIAoiGH8= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [care_hhi] => 12345 [care_hhi_slno] => 1 [district] => kalahandi [GP_name] => bankpalas [month] => 04 [hhi] => 12345 [Block] => bankpalas [Village] => bankpalas [Year] => 2017 [women] => Usha Roy .K [Spouse] => Preetish Priyabrata.K [SHG_Name] => ssssss [datepicker] => 10/17/2017 [Activity] => sssss [Support] => sssss [Production] => xxx [Consumption] => xxx [Sale] => xxx [Remarks] => xxx [Signature] => xxx [save] => save )
			 // 
			$SHG_Name=$_POST['SHG_Name'];
			$datepicker=date('Y-m-d',strtotime(trim($_POST['datepicker'])));
			$Activity=$_POST['Activity'];
			$Support=$_POST['Support'];
			$Production=$_POST['Production'];
			$Consumption=$_POST['Consumption'];
			$Sale=$_POST['Sale'];
			$Remarks=$_POST['Remarks'];
			$Signature=$_POST['Signature'];

			$insert_query="INSERT INTO `care_master_input_output_tracking_tarina`(`care_TARINA_slno`, `care_TARINA_event_date`, `care_TARINA_vlg_name`, `care_TARINA_gp_name`, `care_TARINA_spouse_name`, `care_TARINA_block_name`, `care_TARINA_district_name`, `care_TARINA_activity_name`, `care_TARINA_support_provide`, `care_TARINA_production`, `care_TARINA_consumption`, `care_TARINA_sale`, `care_TARINA_remarks`, `care_TARINA_participant_sign`, `care_TARINA_employee_id`, `care_TARINA_lat_id`, `care_TARINA_long_id`, `care_TARINA_shg_name`, `care_TARINA_w_farmer_name`, `care_TARINA_entry_date`, `care_TARINA_entry_time`, `care_TARINA_status`, `care_TARINA_hhi`, `care_TARINA_hhi_slno`,`care_TARINA_month`,`care_TARINA_year`) VALUES (Null,'$datepicker','$Village','$GP_name','$Spouse','$Block','$district','$Activity','$Support','$Production','$Consumption','$Sale','$Remarks','$Signature','$employee_id','$lat2','$long2','$SHG_Name','$women','$date','$time','1','$care_hhi','$care_hhi_slno','$month','$Year')";
			
			$sql_exe_insert=mysqli_query($conn,$insert_query);
			
			if($sql_exe_insert){ //check if error is in the record
				$msg->success('SuccessFully Submited Input & Output of HHI '.$care_hhi);
				header('Location:index.php');
				exit;
			}else{
				$msg->error('Some Problem Occur');
				header('Location:index.php');
				exit;
			}
			break;
		case 'hhi_for_PHL':

		// Array ( [form_type] => Ypl5rJ/7GRV5f3NW1rQNEZkSB7IJtG/UO31ELB1cgR8= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [district] => kalahandi [GP_name] => bankpalas [month] => 03 [hhi] => 12345 [Block] => bankpalas [Village] => bankpalas [Year] => 2017 [women] => Usha Roy .K [Spouse] => Preetish Priyabrata.K [classroom_Training_status] => 1 [subject_matter] => 1 [classroom_male] => 2 [classroom_female] => 2 [Demonstration_Training_status] => 2 [Demonstration_subject_matter] => 2 [Demonstration_male] => 2 [Demonstration_female] => 2 [Inputs_provided] => 2 [Implement] => 2 [Farmer] => 1 [save] => save )

			$classroom_Training_status=$_POST['classroom_Training_status'];
			$subject_matter=$_POST['subject_matter'];
		    $datepicker=date('Y-m-d',strtotime(trim($_POST['datepicker'])));
		    $datepicker1=date('Y-m-d',strtotime(trim($_POST['datepicker'])));
			$classroom_male=$_POST['classroom_male'];
			$classroom_female=$_POST['classroom_female'];
			$Demonstration_Training_status=$_POST['Demonstration_Training_status'];
			$Demonstration_subject_matter=$_POST['Demonstration_subject_matter'];
			$Demonstration_male=$_POST['Demonstration_male'];
			$Demonstration_female=$_POST['Demonstration_female'];
			$Inputs_provided=$_POST['Inputs_provided'];
			$Implement=$_POST['Implement'];
			$Farmer=$_POST['Farmer'];

			$insert_query="INSERT INTO `care_master_post_harvest_loss`(`care_PHL_slno`, `care_PHL_hhid`, `care_PHL_women_farmer`, `care_PHL_spouse_name`, `care_CT_status`, `care_CT_date`, `care_CT_subject_matter`, `care_CT_male_present`, `care_CT_feamle_present`, `care_DP_status`,`care_DP_date`, `care_DP_subject_matter`, `care_DP_male_present`, `care_DP_female_present`, `care_IP_name`, `care_implements`, `care_farmer_parcticing`, `care_PHL_lat_id`, `care_PHL_long_id`, `care_PHL_employee_id`, `care_PHL_villege_name`, `care_PHL_block_name`, `care_PHL_district_name`, `care_PHL_month`, `care_PHL_year`, `care_PHL_status`, `care_PHL_date`, `care_PHL_time`) VALUES (NULL,'$care_hhi','$women','$Spouse','$classroom_Training_status','$datepicker','$subject_matter','$classroom_male','$classroom_female','$Demonstration_Training_status','$datepicker1','$Demonstration_subject_matter','$Demonstration_male','$Demonstration_female','$Inputs_provided','$Implement',
			'$Farmer','$lat2','$long2','$employee_id','$Village','$Block','$district','$month','$Year','1','$date','$time')";
			
			$sql_exe_insert=mysqli_query($conn,$insert_query);
			//echo mysqli_error($conn);
			
			if($sql_exe_insert){ //check if error is in the record
				$msg->success('SuccessFully Submited Post_Harvest_Loss of HHI '.$care_hhi);
				header('Location:index.php');
				exit;
			}else{
				$msg->error('Some Problem Occur');
				header('Location:index.php');
				exit;
			}
			break;
		case 'hhi_for_livestock':
			// Array ( [form_type] => H3jxNxqIr2IuPg8TfgwWXkMS8TX4nV1sVkdtRmG45Nw= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [care_hhi] => 12345 [care_hhi_slno] => 1 [type_ids] => 1 [district] => kalahandi [GP_name] => bankpalas [month] => 09 [hhi] => 12345 [Block] => bankpalas [Village] => bankpalas [Year] => 2017 [women] => Usha Roy .K [Spouse] => Preetish Priyabrata.K [type_input_training] => 1 [get_id1] => 1 [get_id_no1] => 4 [get_id2] => 1 [get_id_no2] => 8 [get_id3] => 1 [get_id_no3] => 8 [get_id4] => 1 [get_id_no4] => gg [get_id_no5] => 04 [Total_animal] => 33 [Cultivating_fodder_status] => 1 [cultivated_area] => 33 [Farmers_new] => 1 [farmers_cont] => 1 [Extension_qnty] => 3 [Medicine_name] => Array ( [0] => med2 [1] => med4 [2] => med5 ) [Medicine_qnty] => 4 [Vaccination_name] => Array ( [0] => vac2 [1] => vac4 [2] => 3hh ) [Vaccination_qnty] => 5 [Others_name] => Array ( [0] => pp [1] => p2 ) [Others_qnty] => 3 [save] => save )
			$type_ids=$_POST['type_ids'];// this will define which value to be inserted
			$type_input_training=$_POST['type_input_training']; //Type of Input Provided (Y-1 & N-2)a.Training
			$get_id1=$_POST['get_id1']; //Type of Input Provided (Y-1 & N-2)b.Extension Support
			$get_id_no1=$_POST['get_id_no1'];//No. of animal/bird received inputs b.Extension Support
			$get_id2=$_POST['get_id2'];//Type of Input Provided (Y-1 & N-2)c.Medicine
			$get_id_no2=$_POST['get_id_no2'];//No. of animal/bird received inputs c.Medicine
			$get_id3=$_POST['get_id3'];//Type of Input Provided (Y-1 & N-2)d.Vaccination
			$get_id_no3=$_POST['get_id_no3'];//No. of animal/bird received inputs d.Vaccination
			$get_id4=$_POST['get_id4'];//Type of Input Provided (Y-1 & N-2)e.Others (Specify)
			$get_id_no4=$_POST['get_id_no4'];//Others (Specify) details
			$get_id_no5=$_POST['get_id_no5'];//No. of animal/bird received inputs e.Others (Specify)
			$Total_animal=$_POST['Total_animal'];// total no anmial present in hhi
			$Cultivating_fodder_status=$_POST['Cultivating_fodder_status'];//Are you cultivating Fodder? Y-1 N-2
			$cultivated_area=$_POST['cultivated_area'];//Area cultivated under Fodder (in Acre)
			$Farmers_new=$_POST['Farmers_new'];//New FarmersY-1 N-2
			$farmers_cont=$_POST['farmers_cont'];//Continued farmersY-1 N-2	
			$Extension_qnty=$_POST['Extension_qnty'];//Extension Support (No.)
			$Medicine_name=$_POST['Medicine_name'];//Quantity provided Medicine_name
			$Vaccination_name=$_POST['Vaccination_name'];//Quantity provided Vaccination_name
			$Others_name=$_POST['Others_name'];//Quantity provided Others_name
			$Medicine_qnty=$_POST['Medicine_qnty'];//Quantity provided Medicine_qnty
			$Vaccination_qnty=$_POST['Vaccination_qnty'];//Quantity provided Vaccination_qnty
			$Others_qnty=$_POST['Others_qnty'];//Quantity provided Others_qnty
			switch ($type_ids) {
				case '1': //Goatery
					$insert_query="INSERT INTO `care_master_mtf_livestock_tarina`(`care_LS_slno`, `care_LS_hhid`, `care_LS_women_farmer`, `care_LS_spouse_name`, `care_LS_IP_training`, `care_LS_IP_extension_support`, `care_LS_ES_no_of_animal`, `care_LS_IP_medicine`, `care_LS_Med_no_of_animal`, `care_LS_IP_vaccination`, `care_LS_VN_no_of_animal`, `care_LS_IP_others`, `care_LS_IP_others_specify`, `care_LS_other_no_of_animal`, `care_LS_total_animal`, `care_LS_cultivating_fodder`, `care_LS_cultivated_area`, `care_LS_new_farmer`, `care_LS_continued_farmer`, `care_LS_QP_extension_support`, `care_LS_district_name`, `care_LS_block_name`, `care_LS_gp_name`, `care_LS_vlg_name`, `care_LS_employee_id`, `care_LS_lat_id`, `care_LS_long_id`, `care_LS_month`, `care_LS_year`, `care_LS_date`, `care_LS_time`, `care_LS_status`, `livestock`) VALUES (Null,'$care_hhi','$women','$Spouse','$type_input_training','$get_id1','$get_id_no1','$get_id2','$get_id_no2','$get_id3','$get_id_no3','$get_id4','$get_id_no4','$get_id_no5','$Total_animal','$Cultivating_fodder_status','$cultivated_area','$Farmers_new','$farmers_cont','$Extension_qnty','$district','$Block','$GP_name','$Village','$employee_id','$lat','$long','$month','$Year','$date','$time','1','1')";
					$name ="Goatery";

					break;
				case '2': //Dairy
					$insert_query="INSERT INTO `care_master_mtf_livestock_tarina`(`care_LS_slno`, `care_LS_hhid`, `care_LS_women_farmer`, `care_LS_spouse_name`, `care_LS_IP_training`, `care_LS_IP_extension_support`, `care_LS_ES_no_of_animal`, `care_LS_IP_medicine`, `care_LS_Med_no_of_animal`, `care_LS_IP_vaccination`, `care_LS_VN_no_of_animal`, `care_LS_IP_others`, `care_LS_IP_others_specify`, `care_LS_other_no_of_animal`, `care_LS_total_animal`, `care_LS_cultivating_fodder`, `care_LS_cultivated_area`, `care_LS_new_farmer`, `care_LS_continued_farmer`, `care_LS_QP_extension_support`, `care_LS_district_name`, `care_LS_block_name`, `care_LS_gp_name`, `care_LS_vlg_name`, `care_LS_employee_id`, `care_LS_lat_id`, `care_LS_long_id`, `care_LS_month`, `care_LS_year`, `care_LS_date`, `care_LS_time`, `care_LS_status`, `livestock`) VALUES (Null,'$care_hhi','$women','$Spouse','$type_input_training','$get_id1','$get_id_no1','$get_id2','$get_id_no2','$get_id3','$get_id_no3','$get_id4','$get_id_no4','$get_id_no5','$Total_animal','$Cultivating_fodder_status','$cultivated_area','$Farmers_new','$farmers_cont','$Extension_qnty','$district','$Block','$GP_name','$Village','$employee_id','$lat','$long','$month','$Year','$date','$time','1','2')";

					$name ="Dairy";
					break;
				case '3': //Poultry
					$insert_query="INSERT INTO `care_master_mtf_livestock_tarina`(`care_LS_slno`, `care_LS_hhid`, `care_LS_women_farmer`, `care_LS_spouse_name`, `care_LS_IP_training`, `care_LS_IP_extension_support`, `care_LS_ES_no_of_animal`, `care_LS_IP_medicine`, `care_LS_Med_no_of_animal`, `care_LS_IP_vaccination`, `care_LS_VN_no_of_animal`, `care_LS_IP_others`, `care_LS_IP_others_specify`, `care_LS_other_no_of_animal`, `care_LS_total_animal`, `care_LS_cultivating_fodder`, `care_LS_cultivated_area`, `care_LS_new_farmer`, `care_LS_continued_farmer`, `care_LS_QP_extension_support`, `care_LS_district_name`, `care_LS_block_name`, `care_LS_gp_name`, `care_LS_vlg_name`, `care_LS_employee_id`, `care_LS_lat_id`, `care_LS_long_id`, `care_LS_month`, `care_LS_year`, `care_LS_date`, `care_LS_time`, `care_LS_status`, `livestock`) VALUES (Null,'$care_hhi','$women','$Spouse','$type_input_training','$get_id1','$get_id_no1','$get_id2','$get_id_no2','$get_id3','$get_id_no3','$get_id4','$get_id_no4','$get_id_no5','$Total_animal','$Cultivating_fodder_status','$cultivated_area','$Farmers_new','$farmers_cont','$Extension_qnty','$district','$Block','$GP_name','$Village','$employee_id','$lat','$long','$month','$Year','$date','$time','1','3')";

					$name ="Poultry";
					break;
				
				default:
					$msg->error('Some Problem Occur');
				header('Location:index.php');
				exit;
					break;
			}

			$sql_exe_insert=mysqli_query($conn,$insert_query);
			$last_id = mysqli_insert_id($conn);
			for ($i=0; $i <count($Medicine_name) ; $i++) { 
				$single_Medicine_name=$Medicine_name[$i];
				$single_Medicine_qnty=$Medicine_qnty[$i];
				 $insert_med="INSERT INTO `care_master_livestock_quantity_provided`(`care_QP_slno`, `care_QP_hhid`, `care_QP_livestock_slno`, `care_QP_item_name`, `care_QP_quantity`, `care_QP_type`, `care_QP_month`, `care_QP_date`, `care_QP_time`, `care_QP_status`, `care_QP_year`,`live_stock_id`) VALUES (NUll,'$care_hhi','$last_id','$single_Medicine_name','$single_Medicine_qnty','1','$month','$date','$time','1','$Year','$type_ids')";
				

				$sql_exe_insert_med=mysqli_query($conn,$insert_med);
				
			}

			for ($i=0; $i <count($Vaccination_name) ; $i++) { 
				$single_Medicine_name=$Vaccination_name[$i];
				$single_Medicine_qnty=$Vaccination_qnty[$i];
				$insert_med1="INSERT INTO `care_master_livestock_quantity_provided`(`care_QP_slno`, `care_QP_hhid`, `care_QP_livestock_slno`, `care_QP_item_name`, `care_QP_quantity`, `care_QP_type`, `care_QP_month`, `care_QP_date`, `care_QP_time`, `care_QP_status`, `care_QP_year`,`live_stock_id`) VALUES (NUll,'$care_hhi','$last_id','$single_Medicine_name','$single_Medicine_qnty','2','$month','$date','$time','1','$Year','$type_ids')";
				$sql_exe_insert_med=mysqli_query($conn,$insert_med1);
			}

			for ($i=0; $i <count($Others_name) ; $i++) { 
				$single_Medicine_name=$Others_name[$i];
				$single_Medicine_qnty=$Others_qnty[$i];
				$insert_med="INSERT INTO `care_master_livestock_quantity_provided`(`care_QP_slno`, `care_QP_hhid`, `care_QP_livestock_slno`, `care_QP_item_name`, `care_QP_quantity`, `care_QP_type`, `care_QP_month`, `care_QP_date`, `care_QP_time`, `care_QP_status`, `care_QP_year`,`live_stock_id`) VALUES (NUll,'$care_hhi','$last_id','$single_Medicine_name','$single_Medicine_qnty','3','$month','$date','$time','1','$Year','$type_ids')";
				$sql_exe_insert_med=mysqli_query($conn,$insert_med1);
			}
			if($sql_exe_insert){ //check if error is in the record
				$msg->success('SuccessFully Submited Livestock '.$name.'  of HHI '.$care_hhi);
				header('Location:index.php');
				exit;
			}else{
				$msg->error('Some Problem Occur');
				header('Location:index.php');
				exit;
			}

			break;


			case 'hhi_for_LST':

			// Array ( [form_type] => HJiMHUrJbelravpwLb8mEFMHjrVGPQGhwyQSLc2cFoY= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [care_hhi] => 12345 [care_hhi_slno] => 1 [type_ids] => 5 [district] => kalahandi [GP_name] => bankpalas [month] => 10 [Block] => bankpalas [Village] => bankpalas [Year] => 2017 [women] => Usha Roy .K [Spouse] => Preetish Priyabrata.K [implement_lst] => test [subject_matter] => 1 [setting_class_status] => 1 [Demonstration_date] => 10/31/2017 [Member_lst_male] => 3 [Member_lst_female] => 3 [Implement] => 1 [Farmer_lst_male] => 3 [Farmer_lst_female] => 3 [save] => save )


			$implement_lst=$_POST['implement_lst'];
			$target_activity=$_POST['subject_matter'];
			$setting_class_status=$_POST['setting_class_status'];
			$Demonstration_date=date('Y-m-d',strtotime(trim($_POST['Demonstration_date'])));
			$Member_lst_male=$_POST['Member_lst_male'];
			$Member_lst_female=$_POST['Member_lst_female'];
			$Implement=$_POST['Implement'];
			$Farmer_lst_male=$_POST['Farmer_lst_male'];
			$Farmer_lst_female=$_POST['Farmer_lst_female'];

			 $insert_query="INSERT INTO `care_master_mtf_labour_saving_tech_tarina`(`care_MTF_slno`, `care_MTF_hhid`, `care_MTF_women_farmer`, `care_MTF_spouse_name`, `care_MTF_implement_name`, `care_MTF_target_activity`, `care_MTF_classroom_trained`, `care_MTF_demo_date`, `care_MTF_male_present`, `care_MTF_female_present`, `care_MTF_implements`, `care_MTF_male_farmer_using`, `care_MTF_female_farmer_using`, `care_MTF_vlg_name`, `care_MTF_block_name`, `care_MTF_gp_name`, `care_MTF_district_name`, `care_MTF_month`, `care_MTF_year`, `care_MTF_employee_id`, `care_MTF_lat_id`, `care_MTF_long_id`, `care_MTF_date`, `care_MTF_time`, `care_MTF_status`) VALUES (NULL,'$care_hhi','$women','$Spouse','$implement_lst','$target_activity','$setting_class_status','$Demonstration_date','$Member_lst_male','$Member_lst_female','$Implement','$Farmer_lst_male','$Farmer_lst_female','$Village','$Block','$GP_name','$district','$month','$Year','$employee_id','$lat2','$long2','$date','$time','1')";
			
			
			$sql_exe_insert=mysqli_query($conn,$insert_query);
			
			if($sql_exe_insert){ //check if error is in the record
				$msg->success('SuccessFully Submited Labour Saving Technologies of HHI '.$care_hhi);
				header('Location:index.php');
				exit;
			}else{
				$msg->error('Some Problem Occur');
				header('Location:index.php');
				exit;
			}
			break;




		case 'hhi_for_crop_discersity':
			// // Array ( [form_type] => 1RgtQ2SK3ckjCWaMhRpqPNbS2RbsnKxdomzJWo+6SSk= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [care_hhi] => 12345 [care_hhi_slno] => 1 [type_insert] => 1 [district] => kalahandi [GP_name] => bankpalas [month] => 01 [hhi] => 12345 [Block] => bankpalas [Village] => bankpalas [Year] => 2017 [women] => Usha Roy .K [Spouse] => Preetish Priyabrata.K [type_crop] => jh [cultivated] => 0 [Farmers] => 1 [Demo] => 1 [Continued] => 1 [Training] => 1 [Seed] => 1 [Fertiliser] => 1 [Pesticides] => 1 [Extension] => 1 [Others] => 2 [specify_Input] => hjhj [Seed_qnty] => 0 [Fertiliser_qnty] => 0 [Pesticides_qnty] => 0 [Others_qnty] => 0 [Consumption] => 0 [care_P_sale] => 0 [Total] => 0 [Average_price] => 0 )
			
			$type_insert=$_POST['type_insert'];// type of form will 
			$type_crop=$_POST['type_crop']; //Type of Pulses/Legumes/Vegetables
			$cultivated=$_POST['cultivated']; //Area cultivated (Acre)
			$Farmers=$_POST['Farmers']; //New Farmers Y-1 N-2
			$Demo=$_POST['Demo']; //Demo Plot farmers Y-1 N-2
			$Continued=$_POST['Continued']; //Continued farmers Y-1 N-2
			$Training=$_POST['Training']; //Input received (During the month) (Y-1 N-2) Training
			$Seed=$_POST['Seed']; //Input received (During the month) (Y-1 N-2)Seed
			$Fertiliser=$_POST['Fertiliser']; //Input received (During the month) (Y-1 N-2) Fertiliser
			$Pesticides=$_POST['Pesticides']; //Input received (During the month) (Y-1 N-2)Pesticides
			$Extension=$_POST['Extension']; //Input received (During the month) (Y-1 N-2)Extension Support
			$Others=$_POST['Others']; //Input received (During the month) (Y-1 N-2)Others (Specify)
			$specify_Input=$_POST['specify_Input']; //Input received (During the month) (Y-1 N-2)
			$Seed_qnty=$_POST['Seed_qnty']; //Quantity Received (in KG/ lit/ml) Seeds
			$Fertiliser_qnty=$_POST['Fertiliser_qnty']; // Quantity Received (in KG/ lit/ml) Fertiliser
			$Pesticides_qnty=$_POST['Pesticides_qnty']; // Quantity Received (in KG/ lit/ml)Pesticides
			$Others_qnty=$_POST['Others_qnty']; //Quantity Received (in KG/ lit/ml) Others
			$Consumption=$_POST['Consumption']; //Production Consumption
			$Sale=$_POST['Sale']; //Production Sale
			$Total=$_POST['Total']; //Production Total Produciton 
			$Average_price=$_POST['Average_price']; //Average price(Rs/Kg)



			switch ($type_insert) {
				case '1':
				 	$insert_query="INSERT INTO `care_master_crop_diversification_crp`(`care_slno`, `care_hhid`, `care_women_farmer`, `care_spouse_name`, `care_pulses_type`, `care_area_cultivated`, `care_continued_farmer`, `care_demo_plot_farmer`, `care_new_farmer`, `care_IR_training`, `care_IR_seed`, `care_IR_fertiliser`, `care_IR_pesticides`, `care_IR_extension_support`, `care_IR_other`, `care_QR_seed`, `care_QR_fertiliser`, `care_QR_pesticides`, `care_QR_other`, `care_P_consumption`, `care_P_sale`, `care_P_total_production`, `care_avg_price`, `care_form_type`, `care_type_farm`, `care_CRP_lat_id`, `care_CRP_long_id`, `care_CRP_employee_id`, `care_CRP_vlg_name`, `care_CRP_block_name_`, `care_CRP_district_name`, `care_CRP_month`, `care_CRP_year`, `care_CRP_status`, `care_CRP_date`, `care_CRP_time`,`care_CRP_other_detail`,`care_CRP_gp_name`) VALUES (Null,'$care_hhi','$women','$Spouse','$type_crop','$cultivated','$Continued','$Demo','$Farmers','$Training','$Seed','$Fertiliser','$Pesticides','$Extension','$Others','$Seed_qnty','$Fertiliser_qnty','$Others_qnty','$Consumption','$Sale','$Total','$Average_price','$type_insert','1','1','$lat','$long','$employee_id','$Village','$Block','$district','$month','$Year','1','$date','$time','$specify_Input','$GP_name')";
					$name="Farmland";
					break;
				case '2':
					$insert_query="INSERT INTO `care_master_crop_diversification_crp`(`care_slno`, `care_hhid`, `care_women_farmer`, `care_spouse_name`, `care_pulses_type`, `care_area_cultivated`, `care_continued_farmer`, `care_demo_plot_farmer`, `care_new_farmer`, `care_IR_training`, `care_IR_seed`, `care_IR_fertiliser`, `care_IR_pesticides`, `care_IR_extension_support`, `care_IR_other`, `care_QR_seed`, `care_QR_fertiliser`, `care_QR_pesticides`, `care_QR_other`, `care_P_consumption`, `care_P_sale`, `care_P_total_production`, `care_avg_price`, `care_form_type`, `care_type_farm`, `care_CRP_lat_id`, `care_CRP_long_id`, `care_CRP_employee_id`, `care_CRP_vlg_name`, `care_CRP_block_name_`, `care_CRP_district_name`, `care_CRP_month`, `care_CRP_year`, `care_CRP_status`, `care_CRP_date`, `care_CRP_time`,`care_CRP_other_detail`,`care_CRP_gp_name`) VALUES (Null,'$care_hhi','$women','$Spouse','$type_crop','$cultivated','$Continued','$Demo','$Farmers','$Training','$Seed','$Fertiliser','$Pesticides','$Extension','$Others','$Seed_qnty','$Fertiliser_qnty','$Others_qnty','$Consumption','$Sale','$Total','$Average_price','$type_insert','2','4','$lat','$long','$employee_id','$Village','$Block','$district','$month','$Year','1','$date','$time','$specify_Input','$GP_name')";
					$name="Kitchen Garden";
					break;
				

				default:
					# code...
					break;
			}
			$sql_exe_insert=mysqli_query($conn,$insert_query);
				// echo mysqli_error($conn);
				// exit;
			if($sql_exe_insert){ //check if error is in the record
				$msg->success('SuccessFully Submited '.$name.' of HHI '.$care_hhi);
				header('Location:index.php');
				exit;
			}else{
				$msg->error('Some Problem Occur');
				header('Location:index.php');
				exit;
			}		
	
			break;

		case 'hhi_for_Training':

			// Array ( [form_type] => WzlczfpA8DUDUryn7D83xCaohU3WbZQ78ZwZ+C4KGEA= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [district] => kalahandi [GP_name] => bankpalas [month] => 04 [Block] => junagarh [Village] => bankpalas [Year] => 2017 [thematic_interventions] => [Topic_Covered] => warehouse [event_date] => 10/03/2017 [Duration_session] => 4 hours [Participants_Male] => 5 [Participants_female] => 5 [HHs_covered] => 6 [Repeats_Male] => 4 [Repeats_female] => 4 [HHs_Repeats] => 5 [training_check] => Fair/Mela [group_check] => Women SHG [Pesticides_qnty] => usha [Others_qnty] => restuslt [save] => save )
			
			$thematic_interventions=$_POST['thematic_interventions'];//Thematic Intervention
			$Topic_Covered=$_POST['Topic_Covered'];//Topic/s Covered
			$event_date=date('Y-m-d',strtotime(trim($_POST['event_date'])));//Date
			$Duration_session=$_POST['Duration_session'];//Average Duration  of session (in Hr.)
			$Participants_Male=$_POST['Participants_Male'];//No. of Participants MALE
			$Participants_female=$_POST['Participants_female'];//No. of Participants FEMALE
			$HHs_covered=$_POST['HHs_covered'];//No. of HHs covered
			$Repeats_Male=$_POST['Repeats_Male'];//No. of Participants Repeats MALE
			$Repeats_female=$_POST['Repeats_female'];//No. of Participants Repeats FEMALE
			$HHs_Repeats=$_POST['HHs_Repeats'];//No. of HHs Repeats
			$training_check=$_POST['training_check'];//Type of Training
			$group_check=$_POST['group_check'];//Type of group
			$Facilitator=$_POST['Facilitator'];//Training Facilitator
			$External=$_POST['External'];//External Resource person/agency, if any
			$Remarks=$_POST['Remarks'];//Remarks

			$insert_query="INSERT INTO `care_master_mrf_exposure_visit_tarina`(`care_EV_slno`, `care_EV_them_intervention`, `care_EV_topics_covered`, `care_EV_event_date`, `care_EV_male_Participants`, `care_EV_female_Participants`, `care_EV_male_Participants_repeats`, `care_EV_female_Participants_repeats`, `care_EV_no_of_hhs_covered`, `care_EV_no_of_hhs_repeats`, `care_EV_avg_session_duration`, `care_EV_training_type`, `care_EV_group_type`, `care_EV_training_facilitator`, `care_EV_external_resource`, `care_EV_remarks`, `care_EV_vlg_name`, `care_EV_block_name`, `care_EV_district_name`, `care_EV_gp_name`, `care_EV_month`, `care_EV_year`, `care_EV_date`, `care_EV_time`, `care_EV_employee_id`, `care_EV_lat_id`, `care_EV_lang_id`, `care_EV_status`) VALUES (Null,'$thematic_interventions','$Topic_Covered','$event_date','$Participants_Male','$Participants_female','$Repeats_Male','$Repeats_female','$HHs_covered','$HHs_Repeats','$Duration_session','$training_check','$group_check','$Facilitator','$External','$Remarks','$Village','$Block','$district','$GP_name','$month','$Year','$date','$time','$employee_id','$lat','$long','1')";

			$sql_exe_insert=mysqli_query($conn,$insert_query);
				// echo mysqli_error($conn);
				// exit;
			if($sql_exe_insert){ //check if error is in the record
				$msg->success('SuccessFully Submited Training Program Of Village '.$Village);
				header('Location:index.php');
				exit;
			}else{
				$msg->error('Some Problem Occur');
				header('Location:index.php');
				exit;
			}
		

		break;	
	


 case 'hhi_for_SHG':

    $district=$_POST['district'];
	$Block=$_POST['Block'];	
	$GP_name=$_POST['GP_name'];	
	$Village=$_POST['Village'];
	// user browser detail
	$lat2=$_POST['lat2'];
	$lat=$_POST['lat'];
	$long2=$_POST['long2'];
	$long=$_POST['long'];
	$employee_id=$_SESSION['employee_id'];
	//which month there are capturing data 
	$month=$_POST['month'];
	$Year=$_POST['Year'];
	// current date time 
	$date=date('Y-m-d');
	$time=date('H:i:s');
	// household details
	$care_hhi=$_POST['care_hhi'];
	$care_hhi_slno=$_POST['care_hhi_slno'];
	$women=$_POST['women'];
	$Spouse=$_POST['Spouse'];

// Array ( [form_type] => 1Z7hJdfFM0oLvACK4QlV4LMr2e8QvPEfwDzGFR1A/70= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [district] => kalahandi [GP_name] => bankpalas [month] => 03 [Block] => junagarh [Village] => bankpalas [Year] => 2017 [SHG] => [Topic_Covered] => 11 [event_date] => 12-2-2017 [Duration_session] => YES [type_input_training] => 1 [Seed_qnty] => 87 [Fertiliser_qnty] => HR [Pesticides_qnty] => HIH [Others_qnty] => N [Consumption] => K [Sale] => HJ [save] => save )
			$insert_query="INSERT INTO `care_master_mrf_shg_tracking_under_tarina`(`care_SHG_slno`, `care_SHG_villege`, `care_SHG_name`, `care_SHG_total_member`, `care_SHG_LMM_date`, `care_SHG_mem_prsnt_monthly_meeting`, `care_SHG_RMU_meeting_redg`, `care_SHG_RMU_cash_book`, `care_SHG_RMU_ind_passbook`, `care_SHG_RMU_group_passbook`, `care_SHG_RMU_saving_loan_ledger_book`, `care_SHG_ML_linkage_external_credit`, `care_SHG_ML_bank_name`, `care_SHG_ML_no_of_mem_link_market`, `care_SHG_ML_no_of_ name_MLM`, `care_SHG_ML_no_of_mem_link_tech_support_provider`, `care_SHG_ML_no_of_name_MLTSP`, `care_SHG_no_of_mem_link_any_committee`, `care_SHG_no_of_name_MLAC`, `care_SHG_committee_name`, `care_SHG_nutrition_discus_SHG_mnthly_meeting`, `care_SHG_employee_id`, `care_SHG_lat_id`, `care_SHG_long_id`, `care_SHG_vlg_name`, `care_SHG_block_name`, `care_SHG_district_name`, `care_SHG_gp_name`, `care_SHG_crp_name`, `care_SHG_month`, `care_SHG_year`, `care_SHG_date`, `care_SHG_time`, `care_SHG_status`, `care_SHG_id`) VALUES (NUll,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','')";

			$sql_exe_insert=mysqli_query($conn,$insert_query);
		   // echo mysqli_error($conn);
		   // exit;
			if($sql_exe_insert){ //check if error is in the record
				$msg->success('SuccessFully Submited Training Program Of Village '.$Village);
				header('Location:index.php');
				exit;
			}else{
				$msg->error('Some Problem Occur');
				header('Location:index.php');
				exit;
			}
		

		break;	
		default:
			if(1){ //check if error is in the record
				$msg->success('SuccessFully Submited');
				header('Location:index.php');
				exit;
			}else{
				$msg->error('Some Problem Occur');
				header('Location:index.php');
				exit;
			}
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