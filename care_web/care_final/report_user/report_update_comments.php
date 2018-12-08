<?php
 // print_r($_POST);
// exit;
ini_set('display_errors',1);
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();


	 $form_type_new=web_decryptIt(str_replace(" ", "+", $_POST['form_type_new']));
	 $form_type_id=web_decryptIt(str_replace(" ", "+", $_POST['form_type_id'])); //to acess switcjh value
	// $slno=web_decryptIt(str_replace(" ", "+", $_POST['form_type_id_div'])); // serilano tobe impact
	$months=web_decryptIt(str_replace(" ", "+", $_POST['form_type_user']));// month
	$comments_mt=$_POST['comments_mt'];
	$slno=$_POST['form_type_id_div'];
	$date=date('Y-m-d');
	$time=date('H:i:s');
	$mt_user=$_SESSION['report_user'];
	if($form_type_new=='CBO_comment'){

		switch ($form_type_id) {
			case 'form1':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form1']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form1']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_CBO_date_form1']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form1']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_input_output_tracking_tarina` WHERE `care_TARINA_slno`='$slno_single' and`care_IP_OP_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_input_output_tracking_tarina` SET `care_IP_OP_CBO_comment_empty`='$singel_comments_mt',`care_IP_OP_CBO_comment_time`='$time',`care_IP_OP_CBO_comment_date`='$date',`care_IP_OP_CBO_id`='$mt_user',`care_IP_OP_CBO_comment_status`='1' where`care_TARINA_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
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
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form1`='$care_MEO_status_form1_new',`care_CBO_date_form1`='$date_mt',`care_CBO_status_form1`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Input & Output of HHI '.$hhi);
				header('Location:index.php');
				exit;

				
				break;
			case 'form2':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form2']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form2']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_CBO_date_form2']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form2']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_post_harvest_loss` WHERE `care_PHL_slno`='$slno_single' and `care_PHL_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						 $uspdate="UPDATE `care_master_post_harvest_loss` SET `care_PHL_CBO_comment_empty`='$singel_comments_mt',`care_PHL_CBO_comment_time`='$time',`care_PHL_CBO_comment_date`='$date',`care_PHL_mt_id`='$mt_user',`care_PHL_CBO_comment_status`='1' where`care_PHL_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
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
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);

			
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form2`='$care_MEO_status_form1_new',`care_CBO_date_form2`='$date_mt',`care_CBO_status_form2`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				 mysqli_query($conn,$update);
				$msg->success('SuccessFully comments Submited to Post Harvest Loss of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form3':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form3']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form3']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form3']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form3']);


				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_slno`='$slno_single' and`care_LS_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_CBO_comment_empty`='$singel_comments_mt',`care_LS_CBO_comment_time`='$time',`care_LS_CBO_comment_date`='$date',`care_LS_CBO_id`='$mt_user',`care_LS_CBO_comment_status`='1' where `care_LS_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
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
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);
				  $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form3`='$care_MEO_status_form1_new',`care_CBO_date_form3`='$date_mt',`care_CBO_status_form3`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Goatery of HHI '.$hhi);
				header('Location:index.php');
				exit;

				
				break;

			case 'form4':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form4']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form4']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form4']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form4']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_slno`='$slno_single' and`care_LS_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_CBO_comment_empty`='$singel_comments_mt',`care_LS_CBO_comment_time`='$time',`care_LS_CBO_comment_date`='$date',`care_LS_CBO_id`='$mt_user',`care_LS_CBO_comment_status`='1' where `care_LS_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
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
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form4`='$care_MEO_status_form1_new',`care_CBO_date_form4`='$date_mt',`care_CBO_status_form4`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Dairy of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;

			case 'form5':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form5']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form5']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form5']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form5']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_slno`='$slno_single' and`care_LS_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_mtf_livestock_tarina` SET `care_LS_CBO_comment_empty`='$singel_comments_mt',`care_LS_CBO_comment_time`='$time',`care_LS_CBO_comment_date`='$date',`care_LS_CBO_id`='$mt_user',`care_LS_CBO_comment_status`='1' where `care_LS_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				
				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
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
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form5`='$care_MEO_status_form1_new',`care_CBO_date_form5`='$date_mt',`care_CBO_status_form5`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Poultry of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form6':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form6']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form6']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form6']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form6']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mtf_labour_saving_tech_tarina` WHERE `care_MTF_slno`='$slno_single' and`care_MTF_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_mtf_labour_saving_tech_tarina` SET `care_MTF_CBO_comment_empty`='$singel_comments_mt',`care_MTF_CBO_comment_time`='$time',`care_MTF_CBO_comment_date`='$date',`care_MTF_CBO_id`='$mt_user',`care_MTF_CBO_comment_status`='1' where `care_MTF_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
						
					}
				}

				
				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
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
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form6`='$care_MEO_status_form1_new',`care_CBO_date_form6`='$date_mt',`care_CBO_status_form6`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Labour Saving Technologies of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form7':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
			    $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form7']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form7']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form7']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form7']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_slno`='$slno_single' and`care_crop_div_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						 $uspdate="UPDATE `care_master_crop_diversification_crp` SET `care_crop_div_CBO_comment_empty`='$singel_comments_mt',`care_crop_div_CBO_comment_time`='$time',`care_crop_div_CBO_comment_date`='$date',`care_crop_div_CBO_id`='$mt_user',`care_crop_div_CBO_comment_status`='1' where `care_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
						// echo mysqli_error($conn);
						// exit;
					}
				}
		for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
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
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);
				
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form7`='$care_MEO_status_form1_new',`care_CBO_date_form7`='$date_mt',`care_CBO_status_form7`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to farmland of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form8':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form8']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form8']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form8']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form8']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_slno`='$slno_single' and`care_crop_div_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_crop_diversification_crp` SET `care_crop_div_CBO_comment_empty`='$singel_comments_mt',`care_crop_div_CBO_comment_time`='$time',`care_crop_div_CBO_comment_date`='$date',`care_crop_div_CBO_id`='$mt_user',`care_crop_div_CBO_comment_status`='1' where `care_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
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
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);
				
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form8`='$care_MEO_status_form1_new',`care_CBO_date_form8`='$date_mt',`care_CBO_status_form8`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				 mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Kitchen Garden of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form9':
				
				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_slno`='$slno_single' and`care_EV_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					echo $num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						echo $update="UPDATE `care_master_mrf_exposure_visit_tarina` SET `care_EV_CBO_comment_empty`='$singel_comments_mt',`care_EV_CBO_comment_time`='$time',`care_EV_CBO_comment_date`='$date',`care_EV_CBO_id`='$mt_user',`care_EV_CBO_comment_status`='1' where `care_EV_slno`='$slno_single'";
						mysqli_query($conn,$update);
						echo mysqli_error($conn);
					}
				}
				// exit;

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
					$get_info="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_slno`='$slno_single' and`care_SHG_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_mrf_shg_tracking_under_tarina` SET `care_SHG_CBO_comment_empty`='$singel_comments_mt',`care_SHG_CBO_comment_time`='$time',`care_SHG_CBO_comment_date`='$date',`care_SHG_CBO_id`='$mt_user',`care_SHG_CBO_comment_status`='1' where `care_SHG_slno`='$slno_single'";
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
		 echo "me";
		 exit;
	header('Location:logout.php');
	    exit;
	}


}else{
	echo "string";
	exit;
	header('Location:logout.php');
    exit; 
}