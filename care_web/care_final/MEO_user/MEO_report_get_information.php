<?php 
//include 'config.php';
session_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  // print_r($_POST);
  // exit;
   $form_type=$_POST['web_district_ids'];
   $field_info_name=$_POST['field_info_name'];
   if(!empty($field_info_name)){
    if($form_type=="get_block_id"){
            $query="SELECT * FROM `care_master_block_info` WHERE `care_block_status`='1' and `care_block_dis_name`='$field_info_name'";
            $query_exe=mysqli_query($conn,$query);
            $num_rows_check=mysqli_num_rows($query_exe);
           if($num_rows_check!='0'){
            ?>
              <option value="">--Please Select Block--</option>
                            
            <?php 
              while ($fetch=mysqli_fetch_assoc($query_exe)) {
          ?>
                <option value="<?php echo $fetch['care_block_name'];?>"><?=$fetch['care_block_name'];?></option>
          <?php } 
            }else{
          ?>
            <option value="">--No BLock Is Found--</option>
          <?php 
            }
            exit;

          }else if($form_type=="get_village_id"){
            $query="SELECT * FROM `care_master_village_info` WHERE `care_vlg_gp`='$field_info_name' and `care_vlg_status`='1' ";
            $query_exe=mysqli_query($conn,$query);
            $num_rows_check=mysqli_num_rows($query_exe);
           if($num_rows_check!='0'){
            ?>
              <option value="">--Please Select Village--</option>
                            
            <?php 
              while ($fetch=mysqli_fetch_assoc($query_exe)) {
          ?>
                <option value="<?php echo $fetch['care_vlg_name'];?>"><?=$fetch['care_vlg_name'];?></option>
          <?php } 
            }else{
          ?>
            <option value="">--No GP Is Found--</option>
          <?php 
            }
            exit;
          }else if($form_type=="get_gp_id"){
            $query="SELECT * FROM `care_master_gp_info` WHERE `care_gp_status`='1' and `care_gp_block`='$field_info_name'";
            $query_exe=mysqli_query($conn,$query);
            $num_rows_check=mysqli_num_rows($query_exe);
           if($num_rows_check!='0'){
            ?>
              <option value="">--Please Select GP--</option>
                            
            <?php 
              while ($fetch=mysqli_fetch_assoc($query_exe)) {
          ?>
                <option value="<?php echo $fetch['care_gp_name'];?>"><?=$fetch['care_gp_name'];?></option>
          <?php } 
            }else{
          ?>
            <option value="">--No BLock Is Found--</option>
          <?php 
            }
            exit;
          }else{
            header('Location:index.php');
            exit;
          }
        }else{
         header('Location:logout.php');
          exit; 
        }


}else{
	header('Location:logout.php');
	exit;
}