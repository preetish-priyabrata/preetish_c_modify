<?php 
// print_r($_POST);
// exit;
//include 'config.php';
session_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';

  // $web_check_ids=web_decryptIt(str_replace(" ", "+", $_POST['web_district_ids']));
  // [field_info_name] => kalahandi
    // [form_type] => 1
   // $slno=web_decryptIt(str_replace(" ", "+", $_GET['slno']));
  $form_type=$_POST['form_type'];
  if($form_type=='1'){
    $employee_id='';
     $field_info_name =strtolower(trim($_REQUEST['field_info_name'])); // which field is 
     $query="SELECT DISTINCT `care_master_system_user`.`employee_id`,`care_master_system_user`.`user_name` FROM `care_master_system_user` INNER JOIN `care_master_assigned_user_info` ON `care_master_system_user`.`employee_id` = `care_master_assigned_user_info`.`care_assU_employee_id` where `care_master_system_user`.`status`='1' and `care_master_assigned_user_info`.`care_assU_district_id`='$field_info_name' ";
      $query_exe=mysqli_query($conn,$query);
      $num_rows_check=mysqli_num_rows($query_exe);
        if($num_rows_check=='0'){
         ?>
          <option value="">--No CRP IS FOUND IN THIS DISTRICT--</option>
                            
         <?php 
       }else{
        ?>
        <option value="">--PLEASE SELECT CRP-</option>
        <?php
          while ($result_employee=mysqli_fetch_assoc($query_exe)) {
            // print_r($result_employee);
            ?>
               <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
            <?php

          }

      }
    }else if ($form_type=="v9") {
      $field_info_name=strtolower(trim($_POST['field_info_name']));
      $query="SELECT * FROM `care_master_village_info` WHERE `care_vlg_district`='$field_info_name' ";
            $query_exe=mysqli_query($conn,$query);
            $num_rows_check=mysqli_num_rows($query_exe);
           if($num_rows_check!='0'){
            ?>
              <option value="">--Please Select Village--</option>
                            
            <?php 
              while ($fetch=mysqli_fetch_assoc($query_exe)) {
          ?>
                <option value="<?php echo $fetch['care_vlg_name'];?>"><?=strtoupper($fetch['care_vlg_name']);?></option>
          <?php } 
            }else{
          ?>
            <option value="">--No District Village Is Found--</option>
          <?php 
            }
            exit;
    
   }else if($form_type==2){
    $village="";
      $field_info_name =strtolower(trim($_REQUEST['field_info_name'])); // which field is inserted will allowed to 
  $query="SELECT * FROM `care_master_assigned_user_info` WHERE `status`='1' and `care_assU_employee_id`='$field_info_name'";
            $query_exe=mysqli_query($conn,$query);
            $num_rows_check=mysqli_num_rows($query_exe);
           if($num_rows_check!='0'){
            ?>
              <option value="">--Please Select Village--</option>
                            
            <?php 
              while ($res_village=mysqli_fetch_assoc($query_exe)) {
          ?>
               <option value="<?=$res_village['care_assU_village_id']?>"<?php if($village==$res_village['care_assU_village_id']){ echo "selected";} ?> ><?=$res_village['care_assU_village_id']?>[<?=$res_village['care_assU_gp_id']?>]</option>
          <?php } 
            }else{
          ?>
            <option value="">--No Village Is Assign--</option>
          <?php 
            }
            exit;
  }else{
    header('Location:logout.php');
  exit;
  }
	

}else{
	header('Location:logout.php');
	exit;
}