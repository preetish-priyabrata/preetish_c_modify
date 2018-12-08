<?php 
//include 'config.php';
session_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  $web_check_ids=web_decryptIt(str_replace(" ", "+", $_POST['web_district_ids']));

   // $slno=web_decryptIt(str_replace(" ", "+", $_GET['slno']));
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