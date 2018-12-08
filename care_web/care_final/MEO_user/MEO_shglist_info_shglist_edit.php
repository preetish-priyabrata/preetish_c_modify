<?php
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="FFS/Training/Exposure Visit/Capacity Building Events";
 
$form_types=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];

if($_POST['form_type']){
  $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
  if($form_type=='get_hhi_infomation'){
    $village=$_POST['village'];
    $months=$_POST['month'];
    $Year=$_POST['Year'];
    // $employee_id=$_POST['employee_id'];
   
  }else{

    $months="";
    $Year="";
    // $employee_id="";
    $village="";
     header('Location:logout.php');
    exit; 
  }

 }else{
   $months="";
    $Year="";
    // $employee_id="";
    $village="";
 
 }
  // $check="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_vlg_name`='$village' and `care_EV_month`='$months' and `care_EV_year` ='$Year' and `care_EV_employee_id`='$employee_id' and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='0' and `care_EV_CBO_comment_status`='1'";
  // $mysqli_exe=mysqli_query($conn,$check);
  // $num_sub=mysqli_num_rows($mysqli_exe);
?>
<style type="text/css">
  

/*.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    color: #333;
    background-color: #ffffff;
  }*/
</style>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Self Help Group
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Self Help Group</a></li>
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
                  
                  <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                      <?php $get_gp="SELECT * FROM `care_master_village_info` WHERE `care_vlg_district`='$location_user' ";
                        $sql_exe=mysqli_query($conn,$get_gp);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_vlg_name']?>"<?php if($village==$res_village['care_vlg_name']){ echo "selected";} ?> ><?=strtoupper($res_village['care_vlg_name'])?>[<?=strtoupper($res_village['care_vlg_gp'])?>]</option>
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
                
                    <select class="form-control"  name="Year" required="">
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
        if($form_type=='get_hhi_infomation'){
          if(!empty($village)){
      ?>
        <div class="panel panel-default">
            <div class="panel-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Slno</th>
                    <th>CRP</th>
                    <th>SHG</th>
                    <th>Date /Time <br>Entry</th>
                    <th>Lat/ Long</th>
                    <th>MT Comment <br> Date/ Time</th>
                    <th>CBO Comment <br> Date/ Time</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   <?php 
                   $x=0;
                         $get_detail_query="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_month`='$months' and `care_SHG_year`='$Year'  and `care_SHG_MEO_status`='0' ";
                        $sql_exe_deatils=mysqli_query($conn,$get_detail_query);
                        while ($res1=mysqli_fetch_assoc($sql_exe_deatils)) {
                          // print_r($res1);//
                          //Array ( [care_SHG_slno] => 1 [care_SHG_list_id] => Skh_0098 [care_SHG_name] => maa thakurani [care_SHG_total_member] => 95 [care_SHG_LMM_date] => 2018-07-29 [care_SHG_mem_prsnt_monthly_meeting] => 36 [care_SHG_RMU_meeting_redg] => 1 [care_SHG_RMU_cash_book] => 1 [care_SHG_RMU_ind_passbook] => 1 [care_SHG_RMU_group_passbook] => 1 [care_SHG_RMU_saving_loan_ledger_book] => 1 [care_SHG_ML_linkage_external_credit] => 1 [care_SHG_ML_bank_name] => SBI [care_SHG_ML_no_of_mem_link_market] => 45 [care_SHG_ML_no_of_ name_MLM] => [care_SHG_ML_no_of_mem_link_tech_support_provider] => 23 [care_SHG_ML_no_of_name_MLTSP] => [care_SHG_no_of_mem_link_any_committee] => 34 [care_SHG_no_of_name_MLAC] => [care_SHG_committee_name] => Health [care_SHG_nutrition_discus_SHG_mnthly_meeting] => 2 [care_SHG_employee_id] => 12345 [care_SHG_lat_id] => 20.3112448 [care_SHG_long_id] => 85.8226688 [care_SHG_vlg_name] => bandelguda [care_SHG_block_name] => bhawanipatna [care_SHG_district_name] => kalahandi [care_SHG_gp_name] => dwarsuni [care_SHG_crp_name] => [care_SHG_month] => 08 [care_SHG_year] => 2018 [care_SHG_date] => 2018-08-02 [care_SHG_time] => 16:47:23 [care_SHG_status] => 1 [care_SHG_id] => 98 [care_SHG_mt_comment_empty] => okay [care_SHG_mt_comment_date] => 2018-08-02 [care_SHG_mt_comment_time] => 16:49:24 [care_SHG_mt_comment_status] => 1 [care_SHG_mt_id] => mt_b_m_kalahandi@ilab.com [care_SHG_CBO_comment_empty] => fair [care_SHG_CBO_comment_date] => 2018-08-02 [care_SHG_CBO_comment_time] => 17:30:42 [care_SHG_CBO_comment_status] => 1 [care_SHG_CBO_id] => cbokalahandi@ilab.com [care_SHG_MEO_status] => 0 [care_SHG_MEO_date] => [care_SHG_MEO_time] => [care_SHG_MEO_id] => [shg_field_new1] => NONE [shg_field_new2] => ABCD [shg_field_new3] => 1 [shg_field_new4] => CULTIVATION [shg_field_new5] => 1 [shg_field_new6] => FERTILISER [shg_field_new7] => 1 [shg_field_new8] => WHEET ) 
                          $x++;
                          ?>

                      
                      <tr>
                        <td><?=$x?></td>
                        <td>
                          <?php 
                            $care_EV_employee_id=$res1['care_SHG_employee_id'];
                            $get_employee="SELECT * FROM `care_master_system_user` where `employee_id`='$care_EV_employee_id'";
                            $sql_exe=mysqli_query($conn,$get_employee);
                            $result_employee=mysqli_fetch_assoc($sql_exe);
                             echo $result_employee['user_name'];
                          ?>
                        </td>
                        <td><?=$res1['care_SHG_name']?></td>
                        <td><?=$res1['care_SHG_date'];?> / <?=$res1['care_SHG_time'];?></td>
                        <td><?=$res1['care_SHG_lat_id'];?> / <?=$res1['care_SHG_long_id'];?></td>
                        <td>
                          <?php if($res1['care_SHG_mt_comment_status']==1){
                                  echo $res1['care_SHG_mt_comment_date']." / ".$res1['care_SHG_mt_comment_time'];
                                }else{
                                    echo "No Comment Is been Enter in MT Level";

                                }
                          ?>                            
                          </td>
                          <td>

                          <?php 
                         
                          if($res1['care_SHG_CBO_comment_status']==1){
                                  echo $res1['care_SHG_CBO_comment_date']." / ".$res1['care_SHG_CBO_comment_time'];
                                }else{
                                    echo "No Comment Is been Enter In CBO Level";

                                }
                          ?>                            
                          </td>
                          <td><?php 
                                  if(($res1['care_SHG_mt_comment_status']==1) && ($res1['care_SHG_CBO_comment_status']==1)){
                                    ?>
                                     <a class="btn btn-primary btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('21')?>&care_hhi=<?=web_encryptIt($res1['care_SHG_slno'])?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=1" ><u>Edit</u></a>

                                    <?php
                                  }else{
                                    echo "--";
                                  }

                              ?>
                          </td>
                          </tr>
                      <?php 
                    }

                   ?>
                </tbody>
              </table>
            </div>
         </div>

      <?php 
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
<!-- continue -->
<!-- back -->
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } ); $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>
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