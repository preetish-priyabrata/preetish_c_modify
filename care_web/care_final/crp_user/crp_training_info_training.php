<?php
session_start();
ob_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="FFS/Training/Exposure Visit/Capacity Building Events";

  if(isset($_POST['form_type'])){
  $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
  if($form_type=='get_hhi_infomation'){
    $village=$_POST['village'];
  }else{
    $village="";
     header('Location:logout.php');
    exit; 
  }

 }else{
  $village="";
 }

?>
<link rel="stylesheet" type="text/css" href="new_style.css">
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
        <li class="active">FFS/Training/Exposure Visit</li>
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
                  <label for="village">Village :</label>
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('get_hhi_infomation')?>">
                  <select class="form-control" id="village" name="village">
                    <option value="">--Select Village--</option>
                    <?php 
                        $employee_id=$_SESSION['employee_id'];
                        $get_village="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_employee_id`='$employee_id' and `status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_assU_village_id']?>"<?php if($village==$res_village['care_assU_village_id']){ echo "selected";} ?> ><?=$res_village['care_assU_village_id']?>[<?=$res_village['care_assU_gp_id']?>]</option>
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
              <form action="crp_all_form_save.php" id="myForm" method="POST" class="form-horizontal">
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
                      <select class="form-control" name="month" required="">
                        <option value="">Select Month</option>
                        <?php
                          $monthArray = range(1, 12);
                          foreach ($monthArray as $month) {
                          // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                          // you can use whatever year you want
                          // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2017-$monthPadding-01"));
                            echo '<option value="'.$monthPadding.'">'.$fdate.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year"><h4><b>Thematic Intervention</b></h4></label>
                    <div class="col-sm-10">
                      <select class="form-control" onchange="get_topic()" name="thematic_interventions" id="thematic_interventions" required="">
                            <option value="">--Select Thematic Intervention--</option>
                            <?php 
                                $get_traget="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                   <option value="<?=$traget_fetch['care_thi_slno']?>"><?=$traget_fetch['care_thi_thematic_name']?></option>
                                  
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
                      <!-- <input type="text" class="form-control" id="Year" value="<?=date('Y')?>" readonly placeholder="Enter Year" name="Year"> -->
                       <select class="form-control" id="Year" name="Year" required="">
                      <?php

                      foreach(range(2017, (int)date("Y")) as $year) {?>

                          <option value='<?=$year?>' <?php if($year==date('Y')){ echo "selected";}?>><?=$year?></option>
                          <?php 
                      }

                      ?>
                      </select>
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year">Topics Covered</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="Topic_Covered"  id="Topic_Covered" required="">
                            <option value="">--Select Thematic Intervention--</option>
                            
                          </select>
                    </div>
                  </div>

                </div>
                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2">No Of Participants</a></li>
                  <li><a data-toggle="pill" href="#part3">part 3</a></li>
                  <!-- <li><a data-toggle="pill" href="#part4">Part 4</a></li> -->
                </ul>
                
                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>    
                          <th>Date</th>
                          <th>Average Duration  of session (in Hr.)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                         
                          <!-- <td><input class="form-control" type="text" name="Topic_Covered" required=""></td> -->
                          <td><input class="form-control" type="text" name="event_date" id="datepicker" required=""></td>
                           <td><input class="form-control" type="text" name="Duration_session" required=""></td>
                          
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
                            <input type="number" min="0" class="form-control" name="Participants_Male" required="">
                          </td>
                          <td>
                            <input type="number" min="0" class="form-control" name="Participants_female" required>                     
                          </td>
                          <td>
                            <input type="number" min="0" class="form-control" name="HHs_covered" required>                     
                          </td>
                          <td>
                            <input type="number" min="0" class="form-control" name="Repeats_Male" required>                     
                          </td>
                          <td>
                            <input type="number" min="0" class="form-control" name="Repeats_female" required >                     
                          </td>
                          <td>
                            <input type="number" min="0" class="form-control" name="HHs_Repeats" required>                     
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
                           <select class="form-control" name="training_check" required="">
                            <option value="">--Please Select--</option>
                            <?php 
                                $get_training="SELECT * FROM `care_master_training_info` WHERE `care_trng_status`='1'";
                                $sql_exe_training=mysqli_query($conn,$get_training);
                                while ($training_fetch=mysqli_fetch_assoc($sql_exe_training)) {
                                  ?>
                                   <option value="<?=$training_fetch['care_trng_name']?>"><?=$training_fetch['care_trng_name']?></option>
                                  
                                  <?php
                                }
                                ?>
                          </select>
                          </td>
                          <td>
                           <select class="form-control" name="group_check" required="">
                            <option value="">--Please Select--</option>
                            <?php 
                                $get_ttraining="SELECT * FROM `care_master_group_info` WHERE `care_group_status`='1'";
                                $sql_exe_group=mysqli_query($conn,$get_ttraining);
                                while ($group_fetch=mysqli_fetch_assoc($sql_exe_group)) {
                                  ?>
                                   <option value="<?=$group_fetch['care_group_name']?>"><?=$group_fetch['care_group_name']?></option>
                                  
                                  <?php
                                }
                                ?>
                          </select>
                          </td>
                           <td>
                             <select id="dates-field2" class="multiselect-ui form-control" multiple="multiple" name="Facilitator[]" required="">
                            <!-- <select class="form-control" name="Facilitator" > -->
                            <!-- <option value="">--Please Select--</option> -->
                            <option value="CRP">CRP</option>
                            <option value="MT">MT</option>
                            <option value="CBO">CBO</option>
                            <option value="MEO">MEO</option>  
                          </select>
                           <!--  <input type="text" class="form-control" name="Facilitator" required="">
                          -->
                           </td>
                           <td>
                            <input type="text" class="form-control" name="External" >
                          </td>
                           <td>
                            <input type="text" class="form-control" name="Remarks" required="">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  <br>
                  <ul class="pager">
                    <li class="previous back"><a >Previous</a></li>
                    <li class="next pull-right" ><input type="submit" name="save" value="save"></li>
                  </ul>
                </div>
                 
               </div>
              </div>
            </form>
        </div>
      </div>
      </div>
    </div>
    <?php } }
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
<script src="new.js"></script>
<script type="text/javascript">
$(function() {
    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });
});
</script>
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