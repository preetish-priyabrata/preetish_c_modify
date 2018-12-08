<?php

session_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  $field_info_name =strtolower(trim($_REQUEST['field_info_name']));
  $query="SELECT * FROM `care_master_training_theme_info` WHERE `care_training_status`='1' and `care_training_thematic`='$field_info_name'";
  $query_exe=mysqli_query($conn,$query);
  $num_rows_check=mysqli_num_rows($query_exe);
    if($num_rows_check!='0'){
    ?>
      <option value="">--Please Select Topic--</option>

    <?php 
      while ($fetch=mysqli_fetch_assoc($query_exe)) {
    ?>
        <option value="<?php echo $fetch['care_training_name'];?>"><?=$fetch['care_training_name'];?></option>
    <?php } 
    }else{
    ?>
      <option value="">--No Topic Is Found--</option>
    <?php 
    }
      exit;

}else{
   header('Location:logout.php');
  exit;
}