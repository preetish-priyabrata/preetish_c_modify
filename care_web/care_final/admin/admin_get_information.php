<?php 
//include 'config.php';
session_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  $web_check_ids=web_decryptIt(str_replace(" ", "+", $_POST['web_district_ids']));

   // $slno=web_decryptIt(str_replace(" ", "+", $_GET['slno']));
	$field_info_name =strtolower(trim($_REQUEST['field_info_name'])); // which field is inserted will allowed to check
    switch ($web_check_ids) {

      case 'district_information':
        $query="SELECT * FROM `care_master_district_info` where `care_dis_name`='$field_info_name' ";
    
        $result=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($result);
        if($num_rows==0){
          echo "1";
          exit;
        }else{
          echo "2";
          exit;
        }
        break;
      case 'block_information':
        $query="SELECT * FROM `care_master_block_info` where `care_block_name`='$field_info_name' ";
    
        $result=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($result);
        if($num_rows==0){
          echo "1";
          exit;
        }else{
          echo "2";
          exit;
        }

        break;

      case 'gp_information':
          $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
          if($form_type=="Admin Add GP"){
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

          }else{

            $query="SELECT * FROM `care_master_gp_info` where `care_gp_name`='$field_info_name' ";
            
            $result=mysqli_query($conn,$query);
            $num_rows=mysqli_num_rows($result);
            if($num_rows==0){
              echo "1";
              exit;
            }else{
              echo "2";
              exit;
            }
          }

        break;

      case 'village_information':
        $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
          if($form_type=="Admin Add village"){
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

            $query="SELECT * FROM ` care_master_village_info` where `care_vlg_name`='$field_info_name' ";
            
            $result=mysqli_query($conn,$query);
            $num_rows=mysqli_num_rows($result);
            if($num_rows==0){
              echo "1";
              exit;
            }else{
              echo "2";
              exit;
            }
          }

        break;
      case 'Thematic_information':
         $query="SELECT * FROM `care_master_thematic_interventions_info` where `care_thi_thematic_name`='$field_info_name' ";
    
        $result=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($result);
        if($num_rows==0){
          echo "1";
          exit;
        }else{
          echo "2";
          exit;
        }
        break;

    case 'group_information':
        $query="SELECT * FROM `care_master_group_info` where `care_group_name`='$field_info_name' ";
    
        $result=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($result);
        if($num_rows==0){
          echo "1";
          exit;
        }else{
          echo "2";
          exit;
        }
        break;
      case 'training_information':
        $query="SELECT * FROM `care_master_training_info` where `care_trng_name`='$field_info_name' ";
    
        $result=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($result);
        if($num_rows==0){
          echo "1";
          exit;
        }else{
          echo "2";
          exit;
        }
        break;
      case 'Technical_information': 
         $query="SELECT * FROM `care_master_technical_support_providers_info` WHERE `care_tsp_name`='$field_info_name' ";
    
        $result=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($result);
        if($num_rows==0){
          echo "1";
          exit;
        }else{
          echo "2";
          exit;
        }
      break;
      case 'committee_information': 
         $query="SELECT * FROM `care_master_committee_info` WHERE `care_comm_name`='$field_info_name' ";
    
        $result=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($result);
        if($num_rows==0){
          echo "1";
          exit;
        }else{
          echo "2";
          exit;
        }
      break;
    case 'user_info_details': 
         $query="SELECT * FROM `care_master_system_user` WHERE `employee_id`='$field_info_name' ";
    
        $result=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($result);
        if($num_rows==0){
          echo "1";
          exit;
        }else{
          echo "2";
          exit;
        }
      break;
    case 'user_info_details2': 
       ?>
       <thead>
        <tr>
          <th>gp name</th>
          <th>village name</th>
          <th>action</th>
        </tr>
      </thead>
      <tfoot>
         <tr>
          <th>GP Name</th>
          <th>Village Name</th>
          <th>Action</th>
        </tr>
      </tfoot>
      <tbody>
        <?php
          $query="SELECT * FROM `care_master_village_info` where `care_vlg_block`='$field_info_name'  ";          
          $result=mysqli_query($conn,$query);
          while ($village=mysqli_fetch_assoc($result)) {?>
          <tr>
            <td><input type="hidden" name="care_vlg_gp[]" value="<?=$village['care_vlg_gp']?>"><?=$village['care_vlg_gp']?></td>
            <td><input type="hidden" name="care_vlg_name[]" value="<?=$village['care_vlg_name']?>"><?=$village['care_vlg_name']?></td>
            <td>
              <input type="hidden" name="care_vlg_slno[]" value="<?=$village['care_vlg_slno']?>">
              <!-- <label class="checkbox-inline checkbox-right"> -->
                      <input  class="roomselect" name="batch_id[]" value="<?php echo $village['care_vlg_slno']?>" type="checkbox">

                        <!-- <?php echo $res_list['batch_name']?> -->
                <!-- </label> -->
              </td>
            <?php          }
        ?>
      </tbody>
        <?php
        exit;
        break;
      case 'training_Thematic_information':
        $query="SELECT * FROM `care_master_training_theme_info` where `care_training_name`='$field_info_name' ";
    
        $result=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($result);
        if($num_rows==0){
          echo "1";
          exit;
        }else{
          echo "2";
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