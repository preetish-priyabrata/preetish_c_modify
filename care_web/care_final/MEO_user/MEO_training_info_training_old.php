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
  $check="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_vlg_name`='$village' and `care_EV_month`='$months' and `care_EV_year` ='$Year' and `care_EV_employee_id`='$employee_id' and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='0' and `care_EV_CBO_comment_status`='1'";
  $mysqli_exe=mysqli_query($conn,$check);
  $num_sub=mysqli_num_rows($mysqli_exe);
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
        FFS/Training/Exposure Visit/Capacity Building Events 
     <!--    <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Training Form</a></li>
        <li class="active">FFS/Training/Exposure Visit/Capacity Building Events</li>
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
                  <label for="village">CRP :</label>
                 <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">
                  <select class="form-control" id="employee_id" onchange="get_village()" name="employee_id">
                    <option value="">--Select CRP--</option>
                    <?php
                      if($form_types=='0'){
                        $get_employee="SELECT * FROM `care_master_system_user`  WHERE `level`='1' and `assign_status`='1' and `status`='1' ";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                      }else{
                        $get_employee="SELECT DISTINCT `care_master_system_user`.`employee_id`,`care_master_system_user`.`user_name` FROM `care_master_system_user` INNER JOIN `care_master_assigned_user_info` ON `care_master_system_user`.`employee_id`=`care_master_assigned_user_info`.`care_assU_employee_id` AND `care_master_assigned_user_info`.`care_assU_district_id`='$location_user' and `care_master_assigned_user_info`.`status`='1' WHERE `care_master_system_user`.`status`='1' and `care_master_system_user`.`assign_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                        }
                        ?>
                    
                  </select>
                    <label for="village">Village :</label>
                  <?php if($village==""){?>
                  <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                   
                    
                  </select>
                  <?php }else{?>
                    <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                   <?php $get_village="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_employee_id`='$employee_id' and `status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_assU_village_id']?>"<?php if($village==$res_village['care_assU_village_id']){ echo "selected";} ?> ><?=$res_village['care_assU_village_id']?>[<?=$res_village['care_assU_gp_id']?>]</option>
                          <?php
                          
                        }?>
                    
                  </select>
                 <?php }
                    ?>

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
          $get_detail="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_village_id`='$village'";
          $sql_exe_detail=mysqli_query($conn,$get_detail);
          $fetch_data=mysqli_fetch_assoc($sql_exe_detail);
          ?>

         <div class="box box-primary">
            <div class="box-header with-border">

            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <!-- <i class="fa fa-map-marker"></i> -->

              <h3 class="box-title">Training</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="index.php" class="btn btn-info btn-sm" ><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Back </a>
              </div>
              <!-- /. tools -->
            </div>
          </div>

        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">        
              <form action="MEO_update_comments.php" id="myForm" name="in_ou" method="POST" class="form-horizontal" onsubmit="return check_comments()">
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('hhi_for_Training')?>">
                  <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                  <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                  <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                  <input type="hidden" name="long" value="" id="user_browser_long" required="true">
                  <input  type="hidden" name="form_type_new" value="<?=web_encryptIt('MEO_comment')?>">
                  <input  type="hidden" name="form_type_id" value="<?=web_encryptIt('form9')?>">
                  <input type="hidden" name="form_type_user" value="<?=web_encryptIt($months)?>">
              <div class="col-xs-12">
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="district">District</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="district" name="district" value="<?=$fetch_data['care_assU_district_id']?>" readonly placeholder="Enter District">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="GP_name">GP Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="GP_name" value="<?=$fetch_data['care_assU_gp_id']?>" name="GP_name" readonly placeholder="Enter GP">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Month">Month</label>
                    <div class="col-sm-10">
                      <select disabled="" class="form-control" name="month" required="" readonly>
                        <option value="">Select Month</option>
                        <?php
                          $monthArray = range(1, 12);
                          foreach ($monthArray as $month) {
                          // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                          // you can use whatever year you want
                          // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2017-$monthPadding-01"));
                            ?>
                            <option value="<?=$monthPadding?>" <?php if($months==$monthPadding){echo "selected";}?>><?=$fdate?></option><?php
                          }
                       ?>
                      </select>
                    </div>
                  </div>

                   

                </div>
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Block">Block</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Block" value="<?=$fetch_data['care_assU_block_id']?>" readonly placeholder="Enter Block" name="Block">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Village">Village</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Village" value="<?=$fetch_data['care_assU_village_id']?>" readonly placeholder="Enter Village" name="Village">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year">Year</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Year" value="<?=$Year?>" readonly placeholder="Enter Year" name="Year">
                    </div>
                  </div>

                   

                </div>
                <?php 
                  
                 
                   if($num_sub!=0){?>
                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2">No of Participants</a></li>
                  <li><a data-toggle="pill" href="#part3">part 3</a></li>
                  <!-- <li><a data-toggle="pill" href="#part4">Part 4</a></li> -->
                </ul>
                
                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>CRP Entry Date</th>
                          <th>Thematic Intervention</th>
                          <th>Topic/s Covered</th>
                          <th>Date</th>
                          <th>Average Duration  of session (in Hr.)</th> 
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                         $get_training="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_vlg_name`='$village' and `care_EV_month`='$months' and `care_EV_year` ='$Year' and `care_EV_employee_id`='$employee_id' and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='0' and `care_EV_CBO_comment_status`='1'";
                        $sql_exe_training=mysqli_query($conn,$get_training);
                        while ($res1=mysqli_fetch_assoc($sql_exe_training)) {?>
                        <tr>
                           <input  value="<?=web_encryptIt($res1['care_EV_slno'])?>" type="hidden" class="form-control" name="form_type_id_div[]" required="">
                          <td><?=$res1['care_EV_date']?></td>
                          <td><select disabled class="form-control" name="thematic_interventions" required="">
                            
                            <?php 
                                $get_traget="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                   <option value="<?=$traget_fetch['care_thi_slno']?>"<?php if($res1['care_EV_them_intervention']==$traget_fetch['care_thi_slno']){echo "selected";}?>><?=$traget_fetch['care_thi_thematic_name']?></option>
                                  
                                  <?php
                                }
                                ?>
                          </select></td>
                          <td><input class="form-control" type="text" disabled value="<?=$res1['care_EV_topics_covered']?>" name="Topic_Covered" required=""></td>
                          <td><input class="form-control" disabled value="<?=$res1['care_EV_event_date']?>" type="text" name="event_date" id="datepicker" required=""></td>
                           <td><input class="form-control" disabled value="<?=$res1['care_EV_avg_session_duration']?>" type="text" name="Duration_session" required=""></td>
                          
                        </tr>

                        <tr>
                          <td><?=$res1['care_EV_date']?></td>
                          <td><select class="form-control" name="care_EV_them_intervention[]" required="">
                            
                            <?php 
                                $get_traget="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                   <option value="<?=$traget_fetch['care_thi_slno']?>"<?php if($res1['care_EV_them_intervention']==$traget_fetch['care_thi_slno']){echo "selected";}?>><?=$traget_fetch['care_thi_thematic_name']?></option>
                                  
                                  <?php
                                }
                                ?>
                          </select></td>
                          <td><input class="form-control" type="text" value="<?=$res1['care_EV_topics_covered']?>" name="care_EV_topics_covered[]" required=""></td>
                          <td><input class="form-control" value="<?=$res1['care_EV_event_date']?>" type="text" name="care_EV_event_date[]" id="datepicker" required=""></td>
                           <td><input class="form-control" value="<?=$res1['care_EV_avg_session_duration']?>" type="text" name="care_EV_avg_session_duration[]" required=""></td>
                          
                        </tr>
                        <?php 
                      }?>
                      </tbody>
                    </table>
                    
                    <br>
                  <ul class="pager">
                   <!-- <li class="previous"><a data-toggle="pill" href="#Address">Previous</a></li> -->
                   <li class="next continue"><a >Next</a></li>
                  </ul>
                  </div>
                  <div id="part2" class="tab-pane fade">
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>No. of Participants <br>Male</th>
                          <th>No. of Participants <br>Female</th>
                          <th>No. of HHs <br>covered</th>
                          <th>No. of Participants Repeats <br> Male</th>
                          <th>No. of Participants Repeats <br> Female</th>
                          <th>No. of HHs <br>Repeats</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         <?php $get_training1="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_vlg_name`='$village' and `care_EV_month`='$months' and `care_EV_year` ='$Year' and `care_EV_employee_id`='$employee_id' and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='0' and `care_EV_CBO_comment_status`='1'";
                        $sql_exe_training1=mysqli_query($conn,$get_training1);
                        while ($res12=mysqli_fetch_assoc($sql_exe_training1)) {?>
                        <tr>
                          <td>
                            <input type="number" disabled value="<?=$res12['care_EV_male_Participants']?>" class="form-control" name="Participants_Male" required="">
                          </td>
                          <td>
                            <input type="number" disabled value="<?=$res12['care_EV_female_Participants']?>" class="form-control" name="Participants_female" required>                     
                          </td>
                          <td>
                            <input type="number" disabled value="<?=$res12['care_EV_no_of_hhs_covered']?>" class="form-control" name="HHs_covered" required>                     
                          </td>
                          <td>
                            <input type="number" disabled value="<?=$res12['care_EV_male_Participants_repeats']?>" class="form-control" name="Repeats_Male" required>                     
                          </td>
                          <td>
                            <input type="number" disabled value="<?=$res12['care_EV_female_Participants_repeats']?>" class="form-control" name="Repeats_female" required >                     
                          </td>
                          <td>
                            <input type="number" disabled value="<?=$res12['care_EV_no_of_hhs_repeats']?>" class="form-control" name="HHs_Repeats" required>                     
                          </td>
                          
                        </tr>
                        <tr>
                          <td>
                            <input type="number"  value="<?=$res12['care_EV_male_Participants']?>" class="form-control" name="care_EV_male_Participants[]" required="">
                          </td>
                          <td>
                            <input type="number"  value="<?=$res12['care_EV_female_Participants']?>" class="form-control" name="care_EV_female_Participants[]" required>                     
                          </td>
                          <td>
                            <input type="number"  value="<?=$res12['care_EV_no_of_hhs_covered']?>" class="form-control" name="care_EV_no_of_hhs_covered[]" required>                     
                          </td>
                          <td>
                            <input type="number"  value="<?=$res12['care_EV_male_Participants_repeats']?>" class="form-control" name="care_EV_male_Participants_repeats[]" required>                     
                          </td>
                          <td>
                            <input type="number"  value="<?=$res12['care_EV_female_Participants_repeats']?>" class="form-control" name="care_EV_female_Participants_repeats[]" required >                     
                          </td>
                          <td>
                            <input type="number"  value="<?=$res12['care_EV_no_of_hhs_repeats']?>" class="form-control" name="care_EV_no_of_hhs_repeats[]" required>                     
                          </td>
                          
                        </tr>
                        <?php 
                      }?>
                      </tbody>
                    </table>
                    
                    <br>
                  <ul class="pager">
                   <li class="previous back"><a >Previous</a></li>
                   <li class="next continue"><a >Next</a></li>
                 </ul>
                  </div>
                
                  <div id="part3" class="tab-pane fade">
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          
                          <th>Type of Training</th>
                          <th>Type of group</th>
                          <th>Training Facilitator</th>
                          <th>External Resource person<br>/agency, if any</th>
                          <th>Remarks</th>
                          <th>Comment Of MT</th>
                          <th>Comment Of CBO</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php $get_training2="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_vlg_name`='$village' and `care_EV_month`='$months' and `care_EV_year` ='$Year' and `care_EV_employee_id`='$employee_id' and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='0' and `care_EV_CBO_comment_status`='1' ";
                        $sql_exe_training2=mysqli_query($conn,$get_training2);
                        $x_id=0;
                        while ($res3=mysqli_fetch_assoc($sql_exe_training2)) {?>
                        <tr>
                          <td>
                           <select disabled  class="form-control" name="training_check" required="">
                            <option value="">--Please Select--</option>
                            <?php 
                                $get_training="SELECT * FROM `care_master_training_info` WHERE `care_trng_status`='1'";
                                $sql_exe_training=mysqli_query($conn,$get_training);
                                while ($training_fetch=mysqli_fetch_assoc($sql_exe_training)) {
                                  ?>
                                   <option value="<?=$training_fetch['care_trng_name']?>" <?php if($res3['care_EV_training_type']==$training_fetch['care_trng_name']){echo "selected";}?>><?=$training_fetch['care_trng_name']?></option>
                                  
                                  <?php
                                }
                                ?>
                          </select>
                          </td>
                          <td>
                           <select disabled class="form-control" name="group_check" required="">
                            <option value="">--Please Select--</option>
                            <?php 
                                $get_ttraining="SELECT * FROM `care_master_group_info` WHERE `care_group_status`='1'";
                                $sql_exe_group=mysqli_query($conn,$get_ttraining);
                                while ($group_fetch=mysqli_fetch_assoc($sql_exe_group)) {
                                  ?>
                                   <option value="<?=$group_fetch['care_group_name']?>" <?php if($res3['care_EV_group_type']==$group_fetch['care_group_name']){echo "selected";}?> ><?=$group_fetch['care_group_name']?></option>
                                  
                                  <?php
                                }
                                ?>
                          </select>
                          </td>
                           <td>
                            <?php 
                              $care_EV_training_facilitator=json_decode($res3['care_EV_training_facilitator']);
                              for ($i=0; $i <count($care_EV_training_facilitator) ; $i++) { 
                                echo $care_EV_training_facilitator[$i]."<br>";
                              }

                              ?>
                            
                          </td>
                           <td>
                            <input type="text" class="form-control" disabled value="<?=$res3['care_EV_external_resource']?>" name="External" required="">
                          </td>
                           <td>
                            <input type="text" class="form-control" disabled value="<?=$res3['care_EV_remarks']?>" name="Remarks" required="">
                          </td>
                           <td>
                           <?php 
                            if($res3['care_EV_mt_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                              
                              <textarea readonly=""  type="text" class="form-control" ><?=$res3['care_EV_mt_comment_empty']?></textarea>

                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>
                        <td>
                           <?php 
                            if($res3['care_EV_CBO_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                              
                              <textarea readonly=""  type="text" class="form-control" ><?=$res3['care_EV_CBO_comment_empty']?></textarea>

                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>

                        </tr>
                         <tr>
                          <td>
                           <select class="form-control" name="care_EV_training_type[]" required="">
                            <option value="">--Please Select--</option>
                            <?php 
                                $get_training="SELECT * FROM `care_master_training_info` WHERE `care_trng_status`='1'";
                                $sql_exe_training=mysqli_query($conn,$get_training);
                                while ($training_fetch=mysqli_fetch_assoc($sql_exe_training)) {
                                  ?>
                                   <option value="<?=$training_fetch['care_trng_name']?>" <?php if($res3['care_EV_training_type']==$training_fetch['care_trng_name']){echo "selected";}?>><?=$training_fetch['care_trng_name']?></option>
                                  
                                  <?php
                                }
                                ?>
                          </select>
                          </td>
                          <td>
                           <select class="form-control" name="care_EV_group_type[]" required="">
                            <option value="">--Please Select--</option>
                            <?php 
                                $get_ttraining="SELECT * FROM `care_master_group_info` WHERE `care_group_status`='1'";
                                $sql_exe_group=mysqli_query($conn,$get_ttraining);
                                while ($group_fetch=mysqli_fetch_assoc($sql_exe_group)) {
                                  ?>
                                   <option value="<?=$group_fetch['care_group_name']?>" <?php if($res3['care_EV_group_type']==$group_fetch['care_group_name']){echo "selected";}?> ><?=$group_fetch['care_group_name']?></option>
                                  
                                  <?php
                                }
                                ?>
                          </select>
                          </td>
                           <td>
                            <?php 
                              $care_EV_training_facilitator=json_decode($res3['care_EV_training_facilitator']);
                              for ($i=0; $i <count($care_EV_training_facilitator) ; $i++) { 
                                echo $care_EV_training_facilitator[$i]."<br>";
                                ?>
                                
                                <?php 
                              }


                              ?>
                              <input type="hidden" class="form-control"  value="<?=$res3['care_EV_training_facilitator']?>" name="care_EV_training_facilitator[]" required="">
                            
                          </td>
                           <td>
                            <input type="text" class="form-control"  value="<?=$res3['care_EV_external_resource']?>" name="care_EV_external_resource[]" required="">
                          </td>
                           <td>
                            <input type="text" class="form-control"  value="<?=$res3['care_EV_remarks']?>" name="care_EV_remarks[]" required="">
                          </td>
                           <td>
                           <?php 
                            if($res3['care_EV_mt_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                              
                              <textarea  name="care_EV_mt_comment_empty[]"  type="text" class="form-control" ><?=$res3['care_EV_mt_comment_empty']?></textarea>

                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>
                        <td>
                           <?php 
                            if($res3['care_EV_CBO_comment_status']=='0'){
                              echo "N/A";
                            }else{?>
                             
                              <textarea    type="text" class="form-control"><?=$res3['care_EV_CBO_comment_empty']?></textarea>

                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>

                        </tr>
                        <?php 
                        $x_id++;
                      }?>
                      </tbody>
                    </table>
                  <br>
                  <ul class="pager">
                   <li class="previous back"><a >Previous</a></li>
                   <?php 
                  
                 
                   if($num_sub!=0){?>
                   <li class="next pull-right" ><input type="submit" name="save" value="save"></li>
                   <?php }?>
                 </ul>
                  </div>
                <?php }else{ ?>
                 <span>
                   <p class="text-center">No Information Is found</p>
                 </span>
                 <?php }?> 
        </div>
              </div>
            </form>
        </div>
      </div>
      </div>
    </div>
    <?php } 
  }?>
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