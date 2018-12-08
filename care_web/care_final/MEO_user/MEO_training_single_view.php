<?php
// print_r($_GET);
// exit;
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
 $id=web_decryptIt(str_replace(" ", "+",$_GET['ID']));
 $months=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));
 $TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));
 $Year=web_decryptIt(str_replace(" ", "+",$_GET['year']));
 $village=web_decryptIt(str_replace(" ", "+",$_GET['village']));

$form_uses_id=web_decryptIt(str_replace(" ", "+",$_GET['form_uses_id']));


$get_detail="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_village_id`='$village'";
          $sql_exe_detail=mysqli_query($conn,$get_detail);
          $fetch_data=mysqli_fetch_assoc($sql_exe_detail);

;

  $check="SELECT * FROM `care_master_mrf_exposure_visit_tarina_meo` WHERE `care_EV_vlg_name`='$village' and `care_EV_month`='$months' and `care_EV_year` ='$Year' and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='1' and `care_EV_CBO_comment_status`='1' and `care_EV_slno`='$id'";
  $mysqli_exe=mysqli_query($conn,$check);
  $num_sub=mysqli_num_rows($mysqli_exe);

// Array ( [ID] => d2FkY0xsbDZWTHJ4RC9WQk5GYWZjdz09 [TOKEN_ID] => OFExUC9LRWd0a2wxZlArN2gzQjgyUT09 [TYPE] => d2FkY0xsbDZWTHJ4RC9WQk5GYWZjdz09 [year] => WDZYVlQwOThQVmwzdkZHeDVQM3dwQT09 [village] => SFVPMHJmcXVkVmo2VFQxRnRtbFo0dz09 [form_uses_id] => d2FkY0xsbDZWTHJ4RC9WQk5GYWZjdz09 )
// $sql_id_query="SELECT * FROM `care_master_MTF_labour_saving_tech_TARINA` WHERE `care_MTF_hhid`='$care_hhi' and `care_MTF_slno`='$id' and`care_MTF_month`='$months' and `care_MTF_year`='$year' and `care_MTF_vlg_name`='$village'";
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
         Training Report View
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Training Report</a></li>
        <li class="active">Training Report View </li>
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>
         <div class="box box-primary">
            <div class="box-header with-border">

            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <!-- <i class="fa fa-map-marker"></i> -->

              <h3 class="box-title">Training Information Of  village <?=$fetch_data['care_assU_village_id']?> </h3>
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
                    <div class="table-responsive">
                    <table id='example11' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Village</th>
                          <th>Month-Year</th>
                          <th>User</th>
                          <th>CRP Entry Date</th>
                          <th>Thematic Intervention</th>
                          <th>Topic/s Covered</th>
                          <th>Date</th>
                          <th>Average Duration  of session (in Hr.)</th> 
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $get_training="SELECT * FROM `care_master_mrf_exposure_visit_tarina_meo` WHERE `care_EV_vlg_name`='$village' and `care_EV_month`='$months' and `care_EV_year` ='$Year' and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='1' and `care_EV_CBO_comment_status`='1' and `care_EV_slno`='$id'";
                        $sql_exe_training=mysqli_query($conn,$get_training);
                        while ($res1=mysqli_fetch_assoc($sql_exe_training)) {?>
                        <tr>
                           <td><?=$fetch_data['care_assU_village_id']?></td>
                          <td>
                           <?php
                              $monthArray = range(1, 12);
                              foreach ($monthArray as $month) {
                              // padding the month with extra zero
                              $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                              // you can use whatever year you want
                              // you can use 'M' or 'F' as per your month formatting preference
                               $fdate = date("F", strtotime("2017-$monthPadding-01"));
                               
                               if($months==$monthPadding){echo $fdate;}

                               }
                           ?><?=$year?>
                         </td>
                         <td>CPR</td>
                          <td><?=$res1['care_EV_date']?></td>
                          <td>
                            
                            <?php 
                                $get_traget="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                  <?php if($res1['care_EV_them_intervention']==$traget_fetch['care_thi_slno']){echo $traget_fetch['care_thi_thematic_name'];}?>
                                  
                                  <?php
                                }
                                ?>
                          </td>
                          <td><?=$res1['care_EV_topics_covered']?></td>
                          <td><?=$res1['care_EV_event_date']?></td>
                           <td><?=$res1['care_EV_avg_session_duration']?></td>
                          
                        </tr>

                        <tr>
                          <td><?=$fetch_data['care_assU_village_id']?></td>
                          <td>
                           <?php
                              $monthArray = range(1, 12);
                              foreach ($monthArray as $month) {
                              // padding the month with extra zero
                              $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                              // you can use whatever year you want
                              // you can use 'M' or 'F' as per your month formatting preference
                               $fdate = date("F", strtotime("2017-$monthPadding-01"));

                               if($months==$monthPadding){echo $fdate;}

                               }
                           ?><?=$year?>
                         </td>
                         <td>MEO</td>
                          <td><?=$res1['care_EV_date']?></td>
                          <?php if($res1['care_EV_them_intervention_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>

                            <?php 
                                $get_traget="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                   <?php if($res1['care_EV_them_intervention_edit']==$traget_fetch['care_thi_slno']){echo $traget_fetch['care_thi_thematic_name'];}?>
                                  
                                  <?php
                                }
                                ?>
                          </td>
                          <?php if($res1['care_EV_topics_covered_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?=$res1['care_EV_topics_covered_edit']?></td>
                           <?php if($res1['care_EV_event_date_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?=$res1['care_EV_event_date']?></td>
                           <?php if($res1['care_EV_avg_session_duration_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?=$res1['care_EV_avg_session_duration_edit']?></td>
                          
                        </tr>
                        <?php 
                      }?>
                      </tbody>
                    </table>
                    </div> 
                    <br>
                  <ul class="pager">
                   <!-- <li class="previous"><a data-toggle="pill" href="#Address">Previous</a></li> -->
                   <li class="next continue"><a >Next</a></li>
                  </ul>
                  </div>
                  <div id="part2" class="tab-pane fade">
                    <div class="table-responsive">
                   <table id='example12' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Village</th>
                          <th>Month-Year</th>
                          <th>User</th>
                          <th>No. of Participants <br>Male</th>
                          <th>No. of Participants <br>Female</th>
                          <th>No. of HHs <br>covered</th>
                          <th>No. of Participants Repeats <br> Male</th>
                          <th>No. of Participants Repeats <br> Female</th>
                          <th>No. of HHs <br>Repeats</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         <?php $get_training1="SELECT * FROM `care_master_mrf_exposure_visit_tarina_meo` WHERE `care_EV_vlg_name`='$village' and `care_EV_month`='$months' and `care_EV_year` ='$Year'  and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='1' and `care_EV_CBO_comment_status`='1' and `care_EV_slno`='$id'";
                        $sql_exe_training1=mysqli_query($conn,$get_training1);
                        while ($res12=mysqli_fetch_assoc($sql_exe_training1)) {?>
                        <tr>
                          <td><?=$fetch_data['care_assU_village_id']?></td>
                          <td>
                           <?php
                              $monthArray = range(1, 12);
                              foreach ($monthArray as $month) {
                              // padding the month with extra zero
                              $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                              // you can use whatever year you want
                              // you can use 'M' or 'F' as per your month formatting preference
                               $fdate = date("F", strtotime("2017-$monthPadding-01"));
                               
                               if($months==$monthPadding){echo $fdate;}

                               }
                           ?><?=$year?>
                         </td>
                         <td>CPR</td>
                          <td>
                            <?=$res12['care_EV_male_Participants']?>
                          </td>
                          <td>
                            <?=$res12['care_EV_female_Participants']?>               
                          </td>
                          <td>
                           <?=$res12['care_EV_no_of_hhs_covered']?>       
                          </td>
                          <td>
                           <?=$res12['care_EV_male_Participants_repeats']?> 
                          </td>
                          <td>
                           <?=$res12['care_EV_female_Participants_repeats']?>  
                          </td>
                          <td>
                            <?=$res12['care_EV_no_of_hhs_repeats']?>       
                          </td>
                          
                        </tr>
                        <tr>
                          <td><?=$fetch_data['care_assU_village_id']?></td>
                          <td>
                           <?php
                              $monthArray = range(1, 12);
                              foreach ($monthArray as $month) {
                              // padding the month with extra zero
                              $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                              // you can use whatever year you want
                              // you can use 'M' or 'F' as per your month formatting preference
                               $fdate = date("F", strtotime("2017-$monthPadding-01"));
                               
                               if($months==$monthPadding){echo $fdate;}

                               }
                           ?><?=$year?>
                         </td>
                         <td>MEO</td>
                          <?php if($res12['care_EV_male_Participants_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?=$res12['care_EV_male_Participants_edit']?>
                          </td>
                          <?php if($res12['care_EV_female_Participants_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$res12['care_EV_female_Participants_edit']?>                   
                          </td>
                          <?php if($res12['care_EV_no_of_hhs_covered_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?=$res12['care_EV_no_of_hhs_covered_edit']?>                   
                          </td>
                            <?php if($res12['care_EV_male_Participants_repeats_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$res12['care_EV_male_Participants_repeats_edit']?>                   
                          </td>
                          <?php if($res12['care_EV_female_Participants_repeats_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$res12['care_EV_female_Participants_repeats_edit']?>
                          </td>
                          <?php if($res12['care_EV_no_of_hhs_repeats_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$res12['care_EV_no_of_hhs_repeats_edit']?>                   
                          </td>
                          
                        </tr>
                        <?php 
                      }?>
                      </tbody>
                    </table>
                    </div>
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
                          <th>Village</th>
                          <th>Month-Year</th>
                          <th>User</th>
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
                         <?php $get_training2="SELECT * FROM `care_master_mrf_exposure_visit_tarina_meo` WHERE `care_EV_vlg_name`='$village' and `care_EV_month`='$months' and `care_EV_year` ='$Year'  and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='1' and `care_EV_CBO_comment_status`='1' and `care_EV_slno`='$id'";
                        $sql_exe_training2=mysqli_query($conn,$get_training2);
                        $x_id=0;
                        while ($res3=mysqli_fetch_assoc($sql_exe_training2)) {?>
                        <tr>
                          <td><?=$fetch_data['care_assU_village_id']?></td>
                          <td>
                           <?php
                              $monthArray = range(1, 12);
                              foreach ($monthArray as $month) {
                              // padding the month with extra zero
                              $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                              // you can use whatever year you want
                              // you can use 'M' or 'F' as per your month formatting preference
                               $fdate = date("F", strtotime("2017-$monthPadding-01"));
                               
                               if($months==$monthPadding){echo $fdate;}

                               }
                           ?><?=$year?>
                         </td>
                         <td>CRP</td>
                          <td>
                          
                            <?php 
                                $get_training="SELECT * FROM `care_master_training_info` WHERE `care_trng_status`='1'";
                                $sql_exe_training=mysqli_query($conn,$get_training);
                                while ($training_fetch=mysqli_fetch_assoc($sql_exe_training)) {
                                  ?>
                                    <?php if($res3['care_EV_training_type']==$training_fetch['care_trng_name']){echo $training_fetch['care_trng_name'];}?>
                                  
                                  <?php
                                }
                                ?>
                          
                          </td>
                          <td>
                          
                            <?php 
                                $get_ttraining="SELECT * FROM `care_master_group_info` WHERE `care_group_status`='1'";
                                $sql_exe_group=mysqli_query($conn,$get_ttraining);
                                while ($group_fetch=mysqli_fetch_assoc($sql_exe_group)) {
                                  ?>
                                   <?php if($res3['care_EV_group_type']==$group_fetch['care_group_name']){echo $group_fetch['care_group_name'];}?> 
                                  
                                  <?php
                                }
                                ?>
                         
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
                            <!-- <?=$res3['care_EV_training_facilitator']?> -->
                          </td>
                           <td>
                           <?=$res3['care_EV_external_resource']?>
                          </td>
                           <td>
                            <?=$res3['care_EV_remarks']?>
                          </td>
                           <td>
                           <?php 
                            if($res3['care_EV_mt_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                              
                              <?=$res3['care_EV_mt_comment_empty']?>
                            <?php }?>

                          </td>
                        <td>
                           <?php 
                            if($res3['care_EV_CBO_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                              
                            <?=$res3['care_EV_CBO_comment_empty']?>
                            <?php }?>

                          </td>

                        </tr>
                         <tr>
                          <td><?=$fetch_data['care_assU_village_id']?></td>
                          <td>
                           <?php
                              $monthArray = range(1, 12);
                              foreach ($monthArray as $month) {
                              // padding the month with extra zero
                              $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                              // you can use whatever year you want
                              // you can use 'M' or 'F' as per your month formatting preference
                               $fdate = date("F", strtotime("2017-$monthPadding-01"));
                               
                               if($months==$monthPadding){echo $fdate;}

                               }
                           ?><?=$year?>
                         </td>
                         <td>MEO</td>
                          <?php if($res3['care_EV_training_type_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                          
                            <?php 
                                $get_training="SELECT * FROM `care_master_training_info` WHERE `care_trng_status`='1'";
                                $sql_exe_training=mysqli_query($conn,$get_training);
                                while ($training_fetch=mysqli_fetch_assoc($sql_exe_training)) {
                                  ?>
                                  <?php if($res3['care_EV_training_type_edit']==$training_fetch['care_trng_name']){echo $training_fetch['care_trng_name'];}?>
                                  <?php
                                }
                                ?>
                          </select>
                          </td>
                         <?php if($res3['care_EV_group_type_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                          
                            <?php 
                                $get_ttraining="SELECT * FROM `care_master_group_info` WHERE `care_group_status`='1'";
                                $sql_exe_group=mysqli_query($conn,$get_ttraining);
                                while ($group_fetch=mysqli_fetch_assoc($sql_exe_group)) {
                                  ?>
                                  <?php if($res3['care_EV_group_type_edit']==$group_fetch['care_group_name']){echo $group_fetch['care_group_name'];}?> 
                                  
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
                            <!-- <?=$res3['care_EV_training_facilitator']?> -->
                          </td>
                            <?php if($res3['care_EV_external_resource_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$res3['care_EV_external_resource_edit']?>
                          </td>
                          <?php if($res3['care_EV_remarks_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$res3['care_EV_remarks']?>
                          </td>
                           <td>
                           <?php 
                            if($res3['care_EV_mt_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                              
                              <?=$res3['care_EV_mt_comment_empty']?>
                            <?php }?>

                          </td>
                        <td>
                           <?php 
                            if($res3['care_EV_CBO_comment_status']=='0'){
                              echo "N/A";
                            }else{?>
                             
                              <?=$res3['care_EV_CBO_comment_empty']?>
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
                  
                 </ul>
                  </div>
                 <?php }else{ ?>
                 <span>
                   <p>No Information Is found</p>
                 </span>
                 <?php }?>
        </div>
              </div>
            </form>        
             
            </div>
          </div>
        </div>       
      </div>
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
<script>

$(function() {
   $('input').filter('.datepicker').datepicker({
    dateFormat:'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
    showOn: 'button',
    buttonImage: 'jquery/images/calendar.gif',
    buttonImageOnly: true
   });
  });

  </script>
<script>
  // $( function() {
  //   $( "#datepicker" ).datepicker();
  // } ); 
  $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script>
$(document).ready(function () {

    $('.myform').validate({ // initialize the plugin
        // other options
    });

    $("[name^=field]").each(function () {
        $(this).rules("add", {
            required: true,
            checkValue: true
        },


        );
    });

    $.validator.addMethod("checkValue", function (value, element) {
        var response = ();
        return response;
    }, "invalid value");

});
</script>
