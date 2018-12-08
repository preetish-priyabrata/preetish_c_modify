<?php
 //  print_r($_POST);
 // // exit;

 ini_set('display_errors',1);
 session_start();
 ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
    $msg = new \Preetish\FlashMessages\FlashMessages();
     // $form_type=web_decryptIt(str_replace(" ", "+", $_POST['slno']));
    $slno=$_POST['slno'];

    // Array ( [slno] => 2 [lat2] => [lat] => [long2] => [long] => [district] => kalahandi [GP_name] => bankapalas [Block] => junagarh [Village] => bankapalas [care_group_type] => Array ( [0] => Farmers Field School Group [2] => Self Help Group ) [care_farmer_field_group] => pulses/legume [care_shg_name] => Array ( [0] => shg_262 ) [care_male_participants] => 2 [care_female_participants] => 2 [care_NGTK_name] => Array ( [0] => daily clock [2] => tri-colour food chart ) [care_rolling_time] => 2 [care_observation_tool] => 2 [care_support_materials] => 2 [care_key_message] => hello ngtko )

   $district=$_POST['district'];
   $GP_name=$_POST['GP_name'];
   $Block=$_POST['Block'];
   $Village=$_POST['Village'];
   $care_group_type=json_encode($_POST['care_group_type']);
   $care_farmer_field_group=$_POST['care_farmer_field_group'];
   $care_shg_name=$_POST['care_shg_name'];
   $care_male_participants=$_POST['care_male_participants'];
   $care_female_participants=$_POST['care_female_participants'];
   $care_total_participants=$care_male_participants + $care_female_participants ;
   $care_NGTK_name=json_encode($_POST['care_NGTK_name']);
   $care_rolling_time=$_POST['care_rolling_time'];
   $care_observation_tool=$_POST['care_observation_tool'];
   $care_support_materials=$_POST['care_support_materials'];
   $care_key_message=$_POST['care_key_message'];
   $date=date('Y-m-d');
   $time=date('H:i:s');
   $meo_user=$_SESSION['meo_user'];

        //$din[]=$slno_singles=$slno;
        $care_group_type_single=json_encode($care_group_type);
        $care_farmer_field_group_single=$care_farmer_field_group;
        $care_shg_name_single=$care_shg_name;
        $care_male_participants_single=$care_male_participants;
        $care_female_participants_single=$care_female_participants;
        $care_total_participants_single=$care_total_participants;
        $care_NGTK_name_single=json_encode($care_NGTK_name);
        $care_rolling_time_single=$care_rolling_time;
        $care_observation_tool_single=$care_observation_tool;
        $care_support_materials_single=$care_support_materials;
        $care_key_message_single=$care_key_message;

          //$slno=$slno[$j];

          $update_meo="UPDATE `care_master_mt_NGTKO_instruction_form` SET `care_MEO_status`='2',`care_MEO_date`='$date',`care_MEO_time`='$time',`care_MEO_id`='$meo_user' WHERE `slno`='$slno'";
          $sql_get_detail_update_meo=mysqli_query($conn,$update_meo);

          // here basic information of mt table is upload in one go
          // Notice: Undefined index: care_NGTK_name in /var/www/html/care_final/MEO_user/MEO_NGTKO_instruction_edit_Save.php on line 26
          // SELECT * FROM `care_master_mt_NGTKO_instruction_form_meo` where `slno`='2' 0

          $check_before_upload="SELECT * FROM `care_master_mt_NGTKO_instruction_form_meo` where `slno_mt`='$slno' ";
          $sql_check=mysqli_query($conn,$check_before_upload);
          $num_upload=mysqli_num_rows($sql_check);

          if($num_upload==0){
                     $get_info="INSERT INTO `care_master_mt_NGTKO_instruction_form_meo`(`slno_mt`, `care_administration_date`, `care_district_name`, `care_block_name`, `care_gp_name`, `care_villege_name`, `care_group_type`, `care_farmer_field_group`, `care_shg_name`, `care_male_participants`, `care_female_participants`, `care_total_participants`, `care_NGTK_name`, `care_rolling_time`, `care_observation_tool`, `care_support_materials`, `care_key_message`, `date`, `time`, `status`, `care_mt_id`, `care_MEO_date`, `care_MEO_time`, `care_MEO_status`, `care_MEO_id`,`care_NGTKO_long_id`,`care_NGTKO_lat_id`)SELECT * FROM `care_master_mt_NGTKO_instruction_form` WHERE `care_master_mt_NGTKO_instruction_form`.`slno`= '$slno'";
                      $sql_get_detail_int=mysqli_query($conn,$get_info);

                      $update="UPDATE `care_master_mt_NGTKO_instruction_form_meo` SET `care_group_type_edit`='$care_group_type_single',`care_group_type_status`='2',`care_farmer_field_group_edit`='$care_farmer_field_group_single',`care_farmer_field_group_status`='2',`care_shg_name_edit`='$care_shg_name_single',`care_shg_name_status`='2',`care_male_participants_edit`='$care_male_participants_single',`care_male_participants_status`='2',`care_female_participants_edit`='$care_female_participants_single',`care_female_participants_status`='2',`care_total_participants_edit`='$care_total_participants_single',`care_total_participants_status`='2',`care_NGTK_name_edit`='$care_NGTK_name_single',`care_NGTK_name_status`='2',`care_rolling_time_edit`='$care_rolling_time_single',`care_rolling_time_status`='2',`care_observation_tool_edit`='$care_observation_tool_single',`care_observation_tool_status`='2',`care_support_materials_edit`='$care_support_materials_single',`care_support_materials_status`='2',`care_key_message_edit`='$care_key_message_single',`care_key_message_status`='2' WHERE `slno_mt`='$slno'";
                    $sql_get_detailsss=mysqli_query($conn,$update);

                    $update_1="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_group_type`=`care_master_mt_NGTKO_instruction_form_meo`.`care_group_type_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_group_type_status`= '1'";
                    $sql_get_detail1=mysqli_query($conn,$update_1);
                    // datepicker_single
                    $update_2="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_farmer_field_group`=`care_master_mt_NGTKO_instruction_form_meo`.`care_farmer_field_group_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_farmer_field_group_status`= '1'";
                    $sql_get_detail2=mysqli_query($conn,$update_2);
                    // Activity_single
                    $update_3="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_shg_name`=`care_master_mt_NGTKO_instruction_form_meo`.`care_shg_name_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_shg_name_status`= '1'";
                    $sql_get_detail3=mysqli_query($conn,$update_3);
                    // Support_single
                    $update_4="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_male_participants`=`care_master_mt_NGTKO_instruction_form_meo`.`care_male_participants_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_male_participants_status`= '1'";
                    $sql_get_detail4=mysqli_query($conn,$update_4);
                    // Production_single
                    $update_5="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_TARINA_production`=`care_master_mt_NGTKO_instruction_form_meo`.`care_TARINA_production_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_TARINA_production_status`= '1'";
                    $sql_get_detail5=mysqli_query($conn,$update_5);
                    // Remarks_single
                    $update_6="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_female_participants`=`care_master_mt_NGTKO_instruction_form_meo`.`care_female_participants_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_female_participants_status`= '1'";
                    $sql_get_detail6=mysqli_query($conn,$update_6);
                    // Signature_single
                    $update_7="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_total_participants`=`care_master_mt_NGTKO_instruction_form_meo`.`care_total_participants_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_total_participants_status`= '1'";
                    $sql_get_detail7=mysqli_query($conn,$update_7);
                    // Sale_s
                    $update_8="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_NGTK_name`=`care_master_mt_NGTKO_instruction_form_meo`.`care_NGTK_name_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_NGTK_name_status`= '1'";
                    $sql_get_detail8=mysqli_query($conn,$update_8);

                    $update_9="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_rolling_time`=`care_master_mt_NGTKO_instruction_form_meo`.`care_rolling_time_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_rolling_time_status`= '1'";
                    $sql_get_detail9=mysqli_query($conn,$update_9);

                    $update_9="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_observation_tool`=`care_master_mt_NGTKO_instruction_form_meo`.`care_observation_tool_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_observation_tool_status`= '1'";
                    $sql_get_detail9=mysqli_query($conn,$update_9);

                    $update_10="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_support_materials`=`care_master_mt_NGTKO_instruction_form_meo`.`care_support_materials_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_support_materials_status`= '1'";
                    $sql_get_detail10=mysqli_query($conn,$update_10);

                    $update_11="UPDATE `care_master_mt_NGTKO_instruction_form_meo` INNER JOIN `care_master_mt_NGTKO_instruction_form` ON `care_master_mt_NGTKO_instruction_form`.`slno` = `care_master_mt_NGTKO_instruction_form_meo`.`slno_mt` AND `care_master_mt_NGTKO_instruction_form`.`care_key_message`=`care_master_mt_NGTKO_instruction_form_meo`.`care_key_message_edit`SET `care_master_mt_NGTKO_instruction_form_meo`.`care_key_message_status`= '1'";
                    $sql_get_detail11=mysqli_query($conn,$update_11);


                $msg->success('SuccessFully Edited information of NGTK of MT');
                header('Location:index.php');
                exit;

             
        }      


        }else{  
            header('Location:logout.php');
            exit;
         }
         ?>