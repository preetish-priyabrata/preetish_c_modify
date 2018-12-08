<?php
session_start();
ob_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $employee_id=$_SESSION['employee_id'];
  $msg = new \Preetish\FlashMessages\FlashMessages();
  $title="FFS/Training/Exposure Visit/Capacity Building Events";
  $care_EV_slno=web_decryptIt(str_replace(" ", "+", $_GET['care_EV_slno']));

  $get_training1="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_slno`='$care_EV_slno' and `care_EV_employee_id`='$employee_id' ";
  $sql_exe_training2=mysqli_query($conn,$get_training1);
                        $x_id=0;
                        $res3=mysqli_fetch_assoc($sql_exe_training2);


  $village=$res3['care_EV_vlg_name'];
  $Year=$res3['care_EV_year'];
  $months=$res3['care_EV_month'];
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
        <li class="active">FFS/Training/Exposure Visit <?=$care_EV_slno?></li>
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>
      <div class="row">
        <?php 
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
              <form class="form-horizontal">
                  <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('hhi_for_Training')?>">
                  <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                  <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                  <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                  <input type="hidden" name="long" value="" id="user_browser_long" required="true">
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
                      <select disabled class="form-control" name="month" required="">
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

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year"><h4><b>Thematic Intervention</b></h4></label>
                    <div class="col-sm-10">
                      <select disabled class="form-control" onchange="get_topic()" name="thematic_interventions" id="thematic_interventions" required="">
                            <?php 
                                $get_traget="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                   <option value="<?=$traget_fetch['care_thi_slno']?>"<?php if($res3['care_EV_them_intervention']==$traget_fetch['care_thi_slno']){echo "selected";}?>><?=$traget_fetch['care_thi_thematic_name']?></option>
                                  
                                  <?php
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
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year">Topics Covered</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" disabled value="<?=$res3['care_EV_topics_covered']?>" name="Topic_Covered" required="">
                    </div>
                  </div>

                </div>
                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2">No of Participants</a></li>
                  <li><a data-toggle="pill" href="#part3">Part 3</a></li>
                  <!-- <li><a data-toggle="pill" href="#part4">Part 4</a></li> -->
                </ul>
                
                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>CRP Entry Date</th>
                          <!-- <th>Thematic Intervention</th>
                          <th>Topics Covered</th> -->
                          <th>Date</th>
                          <th>Average Duration  of session (in Hr.)</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                    
                        
                        <tr>
                          <td><?=$res3['care_EV_date']?></td>
                          <!-- <td><select disabled class="form-control" name="thematic_interventions" required="">
                            
                            <?php 
                                $get_traget="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                   <option value="<?=$traget_fetch['care_thi_slno']?>"<?php if($res3['care_EV_them_intervention']==$traget_fetch['care_thi_slno']){echo "selected";}?>><?=$traget_fetch['care_thi_thematic_name']?></option>
                                  
                                  <?php
                                }
                                ?>
                          </select></td>
                          <td><input class="form-control" type="text" disabled value="<?=$res3['care_EV_topics_covered']?>" name="Topic_Covered" required=""></td> -->
                          <td><input class="form-control" disabled value="<?=$res3['care_EV_event_date']?>" type="text" name="event_date" id="datepicker" required=""></td>
                           <td><input class="form-control" disabled value="<?=$res3['care_EV_avg_session_duration']?>" type="text" name="Duration_session" required=""></td>
                          
                        </tr>
                       
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
                         
                        <tr>
                          <td>
                            <input type="number" disabled value="<?=$res3['care_EV_male_Participants']?>" class="form-control" name="Participants_Male" required="">
                          </td>
                          <td>
                            <input type="number" disabled value="<?=$res3['care_EV_female_Participants']?>" class="form-control" name="Participants_female" required>                     
                          </td>
                          <td>
                            <input type="number" disabled value="<?=$res3['care_EV_no_of_hhs_covered']?>" class="form-control" name="HHs_covered" required>                     
                          </td>
                          <td>
                            <input type="number" disabled value="<?=$res3['care_EV_male_Participants_repeats']?>" class="form-control" name="Repeats_Male" required>                     
                          </td>
                          <td>
                            <input type="number" disabled value="<?=$res3['care_EV_female_Participants_repeats']?>" class="form-control" name="Repeats_female" required >                     
                          </td>
                          <td>
                            <input type="number" disabled value="<?=$res3['care_EV_no_of_hhs_repeats']?>" class="form-control" name="HHs_Repeats" required>                     
                          </td>
                          
                        </tr>
                        
                      </tbody>
                    </table>
                    
                    <br>
                  <ul class="pager">
                   <li class="previous back"><a >Previous</a></li>
                   <li class="next continue"><a >Next</a></li>
                 </ul>
                  </div>
                  <input  type="hidden" name="form_type_new" value="<?=web_encryptIt('mt_comment')?>">
                    <input  type="hidden" name="form_type_id" value="<?=web_encryptIt('form9')?>">
                    <input type="hidden" name="form_type_user" value="<?=web_encryptIt($months)?>">
                  <div id="part3" class="tab-pane fade">
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          
                          <th>Type of Training</th>
                          <th>Type of group</th>
                          <th>Training Facilitator</th>
                          <th>External Resource person<br>/agency, if any</th>
                          <th>Remarks</th>
                     
                        </tr>
                      </thead>
                      <tbody>
                        
                        <tr>
                          <td>
                           <select disabled="" class="form-control" name="training_check" required="">
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
                           <select disabled="" class="form-control" name="group_check" required="">
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
                        </tr>
                      </tbody>
                    </table>
                  <br>
                  <ul class="pager">
                    <li class="previous back"><a >Previous</a></li>
                    
                 </ul>
                  </div>
                 
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
<!-- continue -->
<!-- back -->
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } ); $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>
   <!-- name="Topic_Covered" -->
  <script type="text/javascript">
    function get_topic() {
      var form_type=$('#form_type').val();
    var thematic_interventions=$('#thematic_interventions').val();

    if(thematic_interventions!=""){
      $.ajax({
        type:'POST',
        url:'crp_get_topic.php',
        data:'field_info_name='+thematic_interventions+'&form_type='+form_type,
        success:function(html){
          $('#Topic_Covered').html(html);
        }
      });
    }else{
      $('#Topic_Covered').html('<option value="">-- Please Select Thematic Intervention  --</option>');
    }
    }
     $(document).ready(function() {
    // $('#example').DataTable();
    get_topic();

} );
  </script>