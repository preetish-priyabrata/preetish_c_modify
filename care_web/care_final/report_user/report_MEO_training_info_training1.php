<?php
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="FFS/Training/Exposure Visit/Capacity Building Events";

if($_POST['form_type']){
  $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
  if($form_type=='get_hhi_infomation'){
    $District=$_POST['District'];
    $months=$_POST['month'];
    $Year=$_POST['Year'];
   

    $monthArray = range(1, 12);
    foreach ($monthArray as $month) {
        // padding the month with extra zero
      $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
        // you can use whatever year you want
        // you can use 'M' or 'F' as per your month formatting preference
      $fdate = date("F", strtotime("2017-$monthPadding-01"));
      if($months==$monthPadding){
        $x_month=$fdate;
      }
    }
   
  }else{

    $months="";
    $Year="";
    
    $District="";
     header('Location:logout.php');
    exit; 
  }

 }else{
   $months="";
    $Year="";
   
    $District="";
 
 }
  $check="SELECT * FROM `care_master_mrf_exposure_visit_tarina_meo` WHERE `care_EV_district_name`='$District' and `care_EV_month`='$months' and `care_EV_year` ='$Year' and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='1' and `care_EV_CBO_comment_status`='1'";
  $mysqli_exe=mysqli_query($conn,$check);
  $num_sub=mysqli_num_rows($mysqli_exe);

  $form_types=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];

$title="View FFS/Training/Exposure Visit/Capacity Building Events After Meo Edit For District :-".$District." For Month/year ".$x_month."/".$year;
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
                 
                 <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">
                   <label for="District">District :</label>
                 
                 
                    <select class="form-control" id="District" name="District" required="">
                    <option value="">--Select District--</option>
                   <?php $get_village="SELECT * FROM `care_master_district_info` WHERE `care_dis_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_dis_name']?>"<?php if($District==$res_village['care_dis_name']){ echo "selected";} ?> ><?=strtoupper($res_village['care_dis_name'])?></option>
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
                          $get_training="SELECT * FROM `care_master_mrf_exposure_visit_tarina_meo` WHERE`care_EV_district_name`='$District' and `care_EV_month`='$months' and `care_EV_year` ='$Year' and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='1' and `care_EV_CBO_comment_status`='1'";
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
                           <?=$res1['care_EV_event_date_status']?></td>
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
                         <?php $get_training1="SELECT * FROM `care_master_mrf_exposure_visit_tarina_meo` WHERE  `care_EV_month`='$months' and `care_EV_year` ='$Year' and `care_EV_district_name`='$District' and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='1' and `care_EV_CBO_comment_status`='1'";
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
                     <div class="table-responsive">
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
                         <?php $get_training2="SELECT * FROM `care_master_mrf_exposure_visit_tarina_meo` WHERE`care_EV_district_name`='$District' and `care_EV_month`='$months' and `care_EV_year` ='$Year'  and `care_EV_mt_comment_status`='1' and `care_EV_MEO_status`='1' and `care_EV_CBO_comment_status`='1' ";
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
                            <<?=$res3['care_EV_remarks_edit']?>
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
                   <?php 
                  
                 
                   if($num_sub==0){?>
                   <li class="next pull-right" ><input type="submit" name="save" value="save"></li>
                   <?php }?>
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
        url:'report_MEO_get_information.php',
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