<?php
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
  if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
      $village=$_POST['village'];
      $months=$_POST['month'];
      $Year=$_POST['Year'];
      $employee_id=$_POST['employee_id'];
    }else{
      $months="";
      $Year="";
      $employee_id="";
      $village="";
       header('Location:logout.php');
      exit;
    }
  }else{
     $months="";
      $Year="";
      $employee_id="";
      $village="";
  }
$form_types=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        HHI Entry LIST
        <!-- <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">View Data Report</a></li>
        <li><a href="#">PHL </a></li>
        <li class="active"><a href="#">View PHL  </a></li>
        <!-- <li class="active">Blank page</li> -->
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>

       <div class="row">
        <div class="col-xs-12">
          <div class="panel panel-default">
            <div class="panel-body text-center">
              <form class="form-inline" action="" method="POST">
                <div class="form-group">
                  <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">
                  
                 <label for="village">Village :</label>
                  <?php if($form_types==0){
                        $get_village="SELECT * FROM `care_master_village_info` WHERE  `care_vlg_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                      }else{
                         $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_district`='$location_user' and `care_vlg_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                      }

                    ?>
                  
                    <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                   <?php 
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_vlg_name']?>"<?php if($village==$res_village['care_vlg_name']){ echo "selected";} ?> ><?=$res_village['care_vlg_name']?>[<?=$res_village['care_vlg_gp']?>]</option>
                          <?php
                        }?>
                  </select>
                 

                   <label for="village"> Month:</label>
                    <select class="form-control" id="month" name="month" required="">
                    <option value="">--Select Month--</option>
                    <?php
                          $monthArray = range(1, 12);
                          foreach ($monthArray as $month) {
                          // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                          // you can use whatever year you want
                          // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2017-$monthPadding-01"));
                            ?>
                            <option value="<?=$monthPadding?>" <?php if($monthPadding==$months){ echo 'selected';}?>><?=$fdate?></option><?php 
                          }
                        ?>
                  </select>
                 <label for="village"> Year:</label>
                  <select class="form-control" id="datepicker" name="Year" required="">
                    <option value="">--Select Year--</option>
                    <?php 
                    $yearSpan = 4;
                    $currentYear = date("Y", strtotime('2017-01-01'));
                    for($i = 0; $i<=$yearSpan; $i++) {
                       $x=$currentYear+$i;
                       ?>
                       <option value="<?=$x?>" <?php if($x==$Year){echo "selected";}?>><?=$x?></option>
                       <?php
                     }

                     ?>
                </select>
                </div>
                <button type="submit" class="btn btn-default">Find</button>
              </form>
            </div>
          </div>

        </div>
      </div>
      <br>
      <br>
      <?php
        if(isset($_POST['form_type'])){
        if($form_type=='get_hhi_infomation'){

        if(!empty($village)){
          // 
          // 
          $get_detail="SELECT * FROM `care_master_post_harvest_loss_meo` WHERE `care_PHL_villege_name`='$village' AND `care_PHL_month`='$months' AND `care_PHL_year`='$Year' and `care_PHL_MEO_status`='1'";
          // AND `care_crop_div_mt_id_status`='1' and `care_crop_div_CBO_comment_status`='1' and `care_crop_div_MEO_status`='0'
          $sql_get_detail=mysqli_query($conn,$get_detail);

          // while ($sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail)) {
          //   # code...
          // }
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="panel panel-default">
                <div class="panel-body text-center">
                  <div class="table-responsive">
                   <table id="example" class="display" cellspacing="0" width="100%" style="">
                    <thead>
                      <tr  >
                        <th><h4><b>slno</b></h4></th>
                        <th><h4><b>HHI</b></h4></th>
                        <th><h4><b>women farmer</b></h4></th>
                        <th><h4><b>Spouse Name</b></h4></th>
                        <th><h4><b>CRP Date / Time</b></h4></th>
                        <th><h4><b>CRP Lat / Long</b></h4></th>
                        <th><h4><b>MT-Comment Date / Time</b></h4></th>
                        <th><h4><b>CBO-Comment Date / Time</b></h4></th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th><h4><b>slno</b></h4></th>
                        <th><h4><b>HHI</b></h4></th>
                        <th><h4><b>women farmer</b></h4></th>
                        <th><h4><b>Spouse Name</b></h4></th>
                        <th><h4><b>CRP Date / Time</b></h4></th>
                        <th><h4><b>CRP Lat / Long</b></h4></th>
                        <th><h4><b>MT-Comment Date / Time</b></h4></th>
                        <th><h4><b>CBO-Comment Date / Time</b></h4></th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                     <tbody>
                      <?php
                      $xi=0;
                     
                      while ($sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail)) {
                        $xi++;
                        // `care_PHL_slno`, `care_phl_serial_id`, `care_PHL_hhid`, `care_PHL_women_farmer`, `care_PHL_spouse_name`, `care_CT_status`, `care_CT_date`, `care_CT_subject_matter`, `care_CT_male_present`, `care_CT_feamle_present`, `care_DP_status`, `care_DP_date`, `care_DP_subject_matter`, `care_DP_male_present`, `care_DP_female_present`, `care_IP_name`, `care_IP_others`, `care_implements`, `care_farmer_parcticing`, `care_PHL_lat_id`, `care_PHL_long_id`, `care_PHL_employee_id`, `care_PHL_villege_name`, `care_PHL_block_name`, `care_PHL_district_name`, `care_PHL_month`, `care_PHL_year`, `care_PHL_status`, `care_PHL_date`, `care_PHL_time`, `care_PHL_mt_comment_empty`, `care_PHL_mt_comment_date`, `care_PHL_mt_comment_time`, `care_PHL_mt_comment_status`, `care_PHL_mt_id`, `care_PHL_CBO_comment_empty`, `care_PHL_CBO_comment_date`, `care_PHL_CBO_comment_time`, `care_PHL_CBO_comment_status`, `care_PHL_CBO_id`, `care_PHL_MEO_status`, `care_PHL_MEO_date`, `care_PHL_MEO_time`, `care_PHL_MEO_id`, `care_CT_status_edit`, `care_CT_status_status`, `care_CT_date_edit`, `care_CT_date_status`, `care_CT_subject_matter_edit`, `care_CT_subject_matter_status`, `care_CT_male_present_edit`, `care_CT_male_present_status`, `care_CT_female_present_edit`, `care_CT_female_present_status`, `care_DP_status_edit`, `care_DP_status_status`, `care_DP_date_edit`, `care_DP_date_staus`, `care_DP_subject_matter_edit`, `care_DP_subject_matter_status`, `care_DP_male_present_edit`, `care_DP_male_present_status`, `care_DP_female_present_edit`, `care_DP_female_present_status`, `care_IP_name_edit`, `care_IP_name_status`, `care_IP_others_edit`, `care_IP_others_status`, `care_implements_edit`, `care_implements_status`, `care_farmer_parcticing_edit`, `care_farmer_parcticing_status`
                        ?>
                      <tr>

                        <td><?=$xi?></td>
                        <td><?=$care_hhi_id_info=$sql_get_detail_fetch['care_PHL_hhid'];
                           $query_detail="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi_id_info'";
                          $sql_exe_details=mysqli_query($conn,$query_detail);
                          $details_fetch=mysqli_fetch_assoc($sql_exe_details);
                        ?></td>
                        <td><?=$details_fetch['care_women_farmer']?></td>
                        <td><?=$details_fetch['care_spouse_name']?></td>
                        <td><?=$sql_get_detail_fetch['care_MTF_date']?><br><?=$sql_get_detail_fetch['care_MTF_time']?></td>
                        <td><?=$sql_get_detail_fetch['care_PHL_lat_id']?><br><?=$sql_get_detail_fetch['care_PHL_long_id']?></td>
                        <td>
                          <?php 
                            if ($sql_get_detail_fetch['care_PHL_mt_comment_status']==0) {
                              echo  "Not MT-Comment";
                            }else{
                              echo $sql_get_detail_fetch['care_PHL_date']."/".$sql_get_detail_fetch['care_PHL_mt_comment_time'];
                            }
                          ?>
                            
                          </td>
                        <td>
                          <?php 
                            if ($sql_get_detail_fetch['care_PHL_CBO_comment_status']==0) {
                              echo  "Not CBO-Comment";
                            }else{
                              echo $sql_get_detail_fetch['care_PHL_CBO_comment_date']."/".$sql_get_detail_fetch['care_PHL_CBO_comment_time'];
                            }
                            
                        ?>
                          
                            
                          </td>
                        <td>
                          <?php 
                          if (($sql_get_detail_fetch['care_PHL_CBO_comment_status']==1)&& ($sql_get_detail_fetch['care_PHL_mt_comment_status']==1)) {
                            ?>
                               <a class="btn btn-primary btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('7')?>&care_hhi=<?=web_encryptIt($sql_get_detail_fetch['care_PHL_slno'])?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" ><u>View</u></a>

                               <a class="btn btn-danger btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('7')?>&care_hhi=<?=web_encryptIt($sql_get_detail_fetch['care_PHL_slno'])?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=3&reset=<?=web_encryptIt($sql_get_detail_fetch['care_phl_serial_id'])?>" onclick="return confirm('Are you sure you want to delete this item?');"><u>Delete</u></a>
                            <?php
                          }else{
                            echo "--";

                          }
                          ?>
                        </td>
                        
                        
                        </tr>
                        <?php }?>
                  </tbody>
                 </tbody>
                </table>
               </div>
              </div>
             </div>
            </div>
           </div>
        <?php
      }
      }
        }
      ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
}else{
  header('Location:logout.php');
  exit;
}
  $contents = ob_get_contents();
  ob_clean();
  include 'template/template.php';
  ?>
  <script type="text/javascript">
    function get_village() {
      var form_type=$('#form_type').val();
    var employee_id=$('#employee_id').val();

    if(employee_id!=""){
      $.ajax({
        type:'POST',
        url:'MEO_get_information.php',
        data:'field_info_name='+employee_id+'&form_type='+form_type,
        success:function(html){
          $('#village').html(html);
        }
      });
    }else{
      $('#village').html('<option value="">-- Please Select CRP --</option>');
    }
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    // get_village();

} );
  </script>

