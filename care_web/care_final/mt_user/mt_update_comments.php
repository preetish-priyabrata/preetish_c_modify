<?php
// print_r($_POST);
// exit;
ini_set('display_errors',1);
session_start();
ob_start();
if($_SESSION['mt_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();
// Array ( [lat2] => 20.3016985 [lat] => 20.3016985 [long2] => 85.83231599999999 [long] => 85.83231599999999 [care_hhi] => 12345 [care_hhi_slno] => [district] => kalahandi [GP_name] => bankpalas [hhi] => 12345 [Block] => bankpalas [Village] => bankpalas [Year] => 2017 [women] => Usha Roy .K [Spouse] => Preetish Priyabrata.K [SHG_Name] => [datepicker] => 2017-04-05 [Activity] => Production of Pulses [Support] => Demonstration [form_type_new] => UsQLfuJHm03Jrs75ieleiiOSlzxHvEYAGv1RAU5NkRw= [form_type_id] => ULWBMP8PCuPzD98MItazIJUNdP/orU8IeYI25v34epY= [form_type_user] => WADuJmcX3b5zLsOHAjME0m3nZ6FCpACkKVquIxI/j0Y= [Production] => 9 [Consumption] => 9 [Sale] => 0 [Remarks] => good [Signature] => usha roy [form_type_id_div] => Array ( [0] => TVGhMhqJNCoOSLGbQDiJe2LsbLRlyK+eZ6vABEMsEZg= [1] => w4LEXdqXcNdWDkqJ/nitm0SoLa5ummDOSd5H56Kb0Ok= [2] => McpVnUGL5N9WobEWZw5s/J595rY2GlILDCVexdmyKxA= ) [comments_mt] => Array ( [0] => hello test1 [1] => test2 [2] => test4 ) [rows_id] => 3 [save] => save )

	$form_type_new=web_decryptIt(str_replace(" ", "+", $_POST['form_type_new']));
	$form_type_id=web_decryptIt(str_replace(" ", "+", $_POST['form_type_id'])); //to acess switcjh value
	// $slno=web_decryptIt(str_replace(" ", "+", $_POST['form_type_id_div'])); // serilano tobe impact
	$months=web_decryptIt(str_replace(" ", "+", $_POST['form_type_user']));// month
	$comments_mt=$_POST['comments_mt'];
	$slno=$_POST['form_type_id_div'];
	$date=date('Y-m-d');
	$time=date('H:i:s');
	$mt_user=$_SESSION['mt_user'];
	if($form_type_new=='mt_comment'){

		switch ($form_type_id) {
			case 'form1':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_details=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_details);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form1']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form1']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form1']);//
				$get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form1']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_input_output_tracking_tarina` WHERE `care_TARINA_slno`='$slno_single' and`care_IP_OP_mt_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						echo $uspdate="UPDATE `care_master_input_output_tracking_tarina` SET `care_IP_OP_mt_comment_empty`='$singel_comments_mt',`care_IP_OP_mt_comment_time`='$time',`care_IP_OP_mt_comment_date`='$date',`care_IP_OP_mt_id`='$mt_user',`care_IP_OP_mt_status`='1' where`care_TARINA_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($get_userilaze_form1_status[$i]==0){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form2[]=0;
					}

				}
				$care_mt_date_form1=serialize($array_date);
				$care_mt_status_form1=serialize($array_form1);
				$care_CBO_status_form2=serialize($array_form2);
				$update="UPDATE `care_master_hhi_month_year` SET `care_CBO_status_form1`='$care_CBO_status_form2',`care_mt_date_form1`='$care_mt_date_form1',`care_mt_status_form1`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Input & Output of HHI '.$hhi);
				header('Location:index.php');
				exit;

				
				break;
			case 'form2':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_details=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_details);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form2']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form2']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form2']);//
				$get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form2']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_post_harvest_loss` WHERE `care_PHL_slno`='$slno_single' and `care_PHL_mt_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						 $uspdate="UPDATE `care_master_post_harvest_loss` SET `care_PHL_mt_comment_empty`='$singel_comments_mt',`care_PHL_mt_comment_time`='$time',`care_PHL_mt_comment_date`='$date',`care_PHL_mt_id`='$mt_user',`care_PHL_mt_comment_status`='1' where`care_PHL_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($get_userilaze_form1_status[$i]==0){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form2[]=0;
					}

				}
				$care_mt_date_form1=serialize($array_date);
				$care_mt_status_form1=serialize($array_form1);
				$care_CBO_status_form2=serialize($array_form2);
				$update="UPDATE `care_master_hhi_month_year` SET `care_CBO_status_form2`='$care_CBO_status_form2',`care_mt_date_form2`='$care_mt_date_form1',`care_mt_status_form2`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Post Harvest Loss of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form3':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_details=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_details);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form3']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form3']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form3']);//
				$get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form3']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_slno`='$slno_single' and `care_LS_mt_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					 $num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						 $uspdate="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_mt_comment_empty`='$singel_comments_mt',`care_LS_mt_comment_time`='$time',`care_LS_mt_comment_date`='$date',`care_LS_mt_id`='$mt_user',`care_LS_mt_comment_status`='1' where `care_LS_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}
				// echo mysqli_error($conn);
				// exit;

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($get_userilaze_form1_status[$i]==0){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form2[]=0;
					}

				}
				$care_mt_date_form1=serialize($array_date);
				$care_mt_status_form1=serialize($array_form1);
				$care_CBO_status_form3=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_CBO_status_form3`='$care_CBO_status_form3',`care_mt_date_form3`='$care_mt_date_form1',`care_mt_status_form3`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Goatery of HHI '.$hhi);
				header('Location:index.php');
				exit;

				
				break;

			case 'form4':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_details=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_details);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form4']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form4']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form4']);//
				$get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form4']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_slno`='$slno_single' and`care_LS_mt_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						 $uspdate="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_mt_comment_empty`='$singel_comments_mt',`care_LS_mt_comment_time`='$time',`care_LS_mt_comment_date`='$date',`care_LS_mt_id`='$mt_user',`care_LS_mt_comment_status`='1' where `care_LS_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}
				

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($get_userilaze_form1_status[$i]==0){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form2[]=0;
					}

				}
				$care_mt_date_form1=serialize($array_date);
				$care_mt_status_form1=serialize($array_form1);
				$care_CBO_status_form4=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_CBO_status_form4`='$care_CBO_status_form4',`care_mt_date_form4`='$care_mt_date_form1',`care_mt_status_form4`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Dairy of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;

			case 'form5':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_details=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_details);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form5']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form5']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form5']);//
				$get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form5']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_slno`='$slno_single' and`care_LS_mt_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_mt_comment_empty`='$singel_comments_mt',`care_LS_mt_comment_time`='$time',`care_LS_mt_comment_date`='$date',`care_LS_mt_id`='$mt_user',`care_LS_mt_comment_status`='1' where `care_LS_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($get_userilaze_form1_status[$i]==0){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form2[]=0;
					}

				}
				$care_mt_date_form1=serialize($array_date);
				$care_mt_status_form1=serialize($array_form1);
				$care_CBO_status_form5=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_CBO_status_form5`='$care_CBO_status_form5',`care_mt_date_form5`='$care_mt_date_form1',`care_mt_status_form5`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Poultry of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form6':
		
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_details=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_details);
				$slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form6']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){
				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form6']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form6']);//
				$get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form6']);

				for ($i=0; $i <count($slno); $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mtf_labour_saving_tech_tarina` WHERE `care_MTF_slno`='$slno_single' and`care_MTF_mt_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
					$uspdate="UPDATE `care_master_mtf_labour_saving_tech_tarina` SET `care_MTF_mt_comment_empty`='$singel_comments_mt',`care_MTF_mt_comment_time`='$time',`care_MTF_mt_comment_date`='$date',`care_MTF_mt_id`='$mt_user',`care_MTF_mt_comment_status`='1' where `care_MTF_slno`='$slno_single'";
						$sql_uspdate=mysqli_query($conn,$uspdate);
						
						
					}
				}
				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($get_userilaze_form1_status[$i]==0){
							$array_date[]=$date;
							$array_form1[]=1;$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;$array_form2[]=2;
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;$array_form2[]=0;
					}

				}
				$care_mt_date_form1=serialize($array_date);
				$care_mt_status_form1=serialize($array_form1);
				$care_CBO_status_form6=serialize($array_form2);
				$update="UPDATE `care_master_hhi_month_year` SET `care_CBO_status_form6`='$care_CBO_status_form6',`care_mt_date_form6`='$care_mt_date_form1' , `care_mt_status_form6`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				$sql_exe_update=mysqli_query($conn,$update);
				$file = fopen("test.txt", "a+");
								fwrite($file, "---newupdate " . $update . "---sql_exe_update".$sql_exe_update);
								fclose($file);

				$msg->success('SuccessFully comments Submited to Labour Saving Technologies of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;

			case 'form7':

			// Array ( [flash_messages] => Array ( ) [meo_user] => meouser@ilab.com [meo_user_type] => Master Training [user_name] => pragya mishra [slno] => 2 [mt_user] => mtuser@ilab.com [mt_user_type] => Master Training ) Array ( [form_type] => 1RgtQ2SK3ckjCWaMhRpqPNbS2RbsnKxdomzJWo+6SSk= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [care_hhi] => 102020200743 [care_hhi_slno] => [type_insert] => 1 [district] => kalahandi [GP_name] => bankapalas [hhi] => 102020200743 [Block] => bankapalas [Village] => bankapalas [Year] => 2017 [women] => nilendri majhi [Spouse] => makardhwajmajhi [form_type_new] => UsQLfuJHm03Jrs75ieleiiOSlzxHvEYAGv1RAU5NkRw= [form_type_id] => 4N2hI/3OP0oPXBMcAhTCIYbUPC17/+mXywepWW0rdvo= [form_type_user] => x8mFQV7/zmcrGyAQTUyVK6Lw1B5dCohIIxLgJHQYWGk= [form_type_id_div] => Array ( [0] => Nzq6mzbwAYNGhKPhBYtu39f5vH7nnvpp/IV9+8nsc4I= [1] => Nzq6mzbwAYNGhKPhBYtu39f5vH7nnvpp/IV9+8nsc4I= ) [comments_mt] => Array ( [0] => test 1 [1] => test2 ) [save] => save )
			// print_r($_SESSION);
			// print_r($_POST);
			// exit;
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				 $get_details_id="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_details=mysqli_query($conn,$get_details_id);
				// echo mysqli_error($conn);
				//echo mysqli_num_rows($sql_get_details);
				$fetch_check=mysqli_fetch_assoc($sql_get_details);
				$slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form7']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form7']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form7']);//
				$get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form7']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_slno`='$slno_single' and`care_crop_div_mt_id_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
				    $num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						 $uspdate="UPDATE `care_master_crop_diversification_crp` SET `care_crop_div_comment_mt`='$singel_comments_mt',`care_crop_div_time_comment_mt`='$time',`care_crop_div_date_comment`='$date',`care_crop_div_mt_id`='$mt_user',`care_crop_div_mt_id_status`='1' where `care_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
						/// mysqli_error($conn);
					}
				}
		
				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($get_userilaze_form1_status[$i]==0){
							$array_date[]=$date;
							$array_form1[]=1;$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;$array_form2[]=2;
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;$array_form2[]=0;
					}

				}
				$care_mt_date_form1=serialize($array_date);
				$care_mt_status_form1=serialize($array_form1);
				$care_CBO_status_form7=serialize($array_form2);
				  $update="UPDATE `care_master_hhi_month_year` SET `care_CBO_status_form7`='$care_CBO_status_form7',`care_mt_date_form7`='$care_mt_date_form1' , `care_mt_status_form7`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to farmland of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form8':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_details=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_details);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form8']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form8']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form8']);//
				$get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form8']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_slno`='$slno_single' and`care_crop_div_mt_id_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_crop_diversification_crp` SET `care_crop_div_comment_mt`='$singel_comments_mt',`care_crop_div_time_comment_mt`='$time',`care_crop_div_date_comment`='$date',`care_crop_div_mt_id`='$mt_user',`care_crop_div_mt_id_status`='1' where `care_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($get_userilaze_form1_status[$i]==0){
							$array_date[]=$date;
							$array_form1[]=1;$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;$array_form2[]=2;
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;$array_form2[]=0;
					}

				}
				$care_mt_date_form1=serialize($array_date);
				$care_mt_status_form1=serialize($array_form1);
				$care_CBO_status_form8=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_CBO_status_form8`='$care_CBO_status_form8',`care_mt_date_form8`='$care_mt_date_form1' , `care_mt_status_form8`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Kitchen Garden of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form9':
			// Array ( [form_type] => WzlczfpA8DUDUryn7D83xCaohU3WbZQ78ZwZ+C4KGEA= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [district] => kalahandi [GP_name] => bankapalas [Block] => junagarh [Village] => bankapalas [Year] => 2017 [form_type_new] => UsQLfuJHm03Jrs75ieleiiOSlzxHvEYAGv1RAU5NkRw= [form_type_id] => FulaFAxi5FB1tB0EmbpwjRtHQpp+PJR2R+CQaIFpcbE= [form_type_user] => x8mFQV7/zmcrGyAQTUyVK6Lw1B5dCohIIxLgJHQYWGk= [form_type_id_div] => Array ( [0] => TVGhMhqJNCoOSLGbQDiJe2LsbLRlyK+eZ6vABEMsEZg= ) [comments_mt] => Array ( [0] => ok ) [save] => save ) UPDATE `care_master_MRF_exposure_visit_TARINA` SET `care_EV_mt_comment_empty`='ok',`care_EV_mt_comment_time`='15:05:19',`care_EV_mt_comment_date`='2017-11-17',`care_crop_div_mt_id`='mtuser@ilab.com',`care_EV_mt_comment_status`='1' where `care_EV_slno`='1'

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_slno`='$slno_single' and`care_EV_mt_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
					 $update="UPDATE `care_master_mrf_exposure_visit_tarina` SET `care_EV_mt_comment_empty`='$singel_comments_mt',`care_EV_mt_comment_time`='$time',`care_EV_mt_comment_date`='$date',`care_EV_mt_id`='$mt_user',`care_EV_mt_comment_status`='1' where `care_EV_slno`='$slno_single'";
						
						mysqli_query($conn,$update);
						//echo mysqli_error($conn);

					}
				}
				//exit;
				$msg->success('SuccessFully comments Submited to Training of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form10': //shg
				// $hhi=$_POST['care_hhi'];
				// $Year=$_POST['Year'];
				// $get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				// $sql_get_detail=mysqli_query($conn,$get_details);

				// $fetch_check=mysqli_fetch_assoc($sql_get_detail);
				//  $slno_md=$fetch_check['care_hhi_sl_no'];
				// $get_userilaze_form1=unserialize($fetch_check['care_form8']); // serial mo
				// if(count($get_userilaze_form1)==count($slno)){

				// }
				// // $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				// $get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form8']);
				// $get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form8']);//
				// $get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form8']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_slno`='$slno_single' and`care_SHG_mt_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
					 $uspdate="UPDATE `care_master_mrf_shg_tracking_under_tarina` SET `care_SHG_mt_comment_empty`='$singel_comments_mt',`care_SHG_mt_comment_time`='$time',`care_SHG_mt_comment_date`='$date',`care_SHG_mt_id`='$mt_user',`care_SHG_mt_comment_status`='1' where `care_SHG_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}
				

				// for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
				// 	$get_userilaze_form1_q=$get_userilaze_form1[$i];
				// 	$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
				// 	if(in_array($get_userilaze_form1_q,$din)){
				// 		if($get_userilaze_form1_status[$i]==0){
				// 			$array_date[]=$date;
				// 			$array_form1[]=1;
				// 		}else{
				// 			$array_date[]=$get_userilaze_form1_date_single;
				// 			$array_form1[]=1;
				// 		}
				// 	}else{
				// 		$array_date[]='0000-00-00';
				// 		$array_form1[]=0;
				// 	}
				// }
				// $care_mt_date_form1=serialize($array_date);
				// $care_mt_status_form1=serialize($array_form1);
				//  $update="UPDATE `care_master_hhi_month_year` SET `care_mt_date_form8`='$care_mt_date_form1' , `care_mt_status_form8`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				// mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to SHG of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			default:
				# code...
				break;
		}

	}else{
		echo "string1";
		exit;
	header('Location:logout.php');
	    exit;
	}


}else{
	echo "stri2ng1";
		exit;
	header('Location:logout.php');
    exit; 
}