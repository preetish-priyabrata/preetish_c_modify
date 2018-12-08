<?php

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
 $year=web_decryptIt(str_replace(" ", "+",$_GET['year']));
 $village=web_decryptIt(str_replace(" ", "+",$_GET['village']));

$form_uses_id=web_decryptIt(str_replace(" ", "+",$_GET['form_uses_id']));

 $get_detail="SELECT * FROM `care_master_mtf_labour_saving_tech_tarina` WHERE `care_MTF_vlg_name`='$village' AND `care_MTF_month`='$months' AND `care_MTF_year`='$year' and `care_MTF_MEO_status`='0' and `care_MTF_slno`='$id'";
$sql_get_detail=mysqli_query($conn,$get_detail);
$sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail);
//  // `care_MTF_slno`, `care_MTF_hhid`, `care_MTF_women_farmer`, `care_MTF_spouse_name`, `care_MTF_implement_name`, `care_MTF_target_activity`, `care_MTF_classroom_trained`, `care_MTF_demo_date`, `care_MTF_male_present`, `care_MTF_female_present`, `care_MTF_implements`, `care_MTF_male_farmer_using`, `care_MTF_female_farmer_using`, `care_MTF_vlg_name`, `care_MTF_block_name`, `care_MTF_gp_name`, `care_MTF_district_name`, `care_MTF_month`, `care_MTF_year`, `care_MTF_employee_id`, `care_MTF_lat_id`, `care_MTF_long_id`, `care_MTF_date`, `care_MTF_time`, `care_MTF_status`, `care_MTF_mt_comment_empty`, `care_MTF_mt_comment_date`, `care_MTF_mt_comment_time`, `care_MTF_mt_comment_status`, `care_MTF_mt_id`, `care_MTF_CBO_comment_empty`, `care_MTF_CBO_comment_date`, `care_MTF_CBO_comment_time`, `care_MTF_CBO_comment_status`, `care_MTF_CBO_id`, `care_MTF_MEO_status`, `care_MTF_MEO_date`, `care_MTF_MEO_time`, `care_MTF_MEO_id`
// 
 $care_hhi=$sql_get_detail_fetch['care_MTF_hhid'];
$get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi'";
$sql_exe_get=mysqli_query($conn,$get_hhi);
$hhi_fetch=mysqli_fetch_assoc($sql_exe_get);


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
         Labour Saving Technologies
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add New Data Entry</a></li>
        <li class="active"> Labour Saving Technologies </li>
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

              <h3 class="box-title">Labour Saving Technologies</h3>
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
                 <?php if($form_uses_id==2){
              ?>
               <form class="form-horizontal" id="myForm" >
              <?php
             }else if($form_uses_id==1){?>
                 <form action="MEO_update_comments.php" id="myForm" name="in_ou" method="POST" class="form-horizontal" onsubmit="return check_comments()">
             <?php }else{
                 header('Location:logout.php');
                 exit;
             }?>
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('hhi_for_LST')?>">
                  <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                  <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                  <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                  <input type="hidden" name="long" value="" id="user_browser_long" required="true">
                  <input type="hidden" name="care_hhi" value="<?=$care_hhi?>" id="user_browser_long2" required="true">
                  <input type="hidden" name="care_hhi_slno" value="<?=$care_hhi_slno?>" id="user_browser_long" required="true">
                  <input type="hidden" name="type_ids" value="<?=$TYPE?>" required="true">
                   <input  type="hidden" name="form_type_new" value="<?=web_encryptIt('MEO_comment')?>">
                    <input  type="hidden" name="form_type_id" value="<?=web_encryptIt('form6')?>">
                    <input type="hidden" name="form_type_user" value="<?=web_encryptIt($months)?>">

              <div class="col-xs-12">
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="district">District</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="district" name="district" value="<?=$hhi_fetch['care_district_name']?>" placeholder="Enter District" readonly>
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="GP_name">GP Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_gp_name']?>" id="GP_name" name="GP_name" placeholder="Enter GP" readonly>
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

                 <div class="form-group">
                    <label class="control-label col-sm-2" for="care_hhi" >HHI </label>
                    <div class="col-sm-10">
                     <input type="text" class="form-control" id="care_hhi" value="<?=$hhi_fetch['care_hhi_id']?>" readonly  name="care_hhi" placeholder="Enter HHI">
                    </div>
                  </div>

                </div>
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Block">Block</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_gp_name']?>" readonly  id="Block" placeholder="Enter Block" name="Block">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Village">Village</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_village_name']?>" readonly  id="Village" placeholder="Enter Village" name="Village">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year">Year</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Year" value="<?=$year?>" readonly placeholder="Enter Year" name="Year">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="women" > women farmer </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_women_farmer']?>" readonly  id="women" name="women" placeholder="Enter women farmer ">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Spouse" > Spouse Name </label>
                    <div class="col-sm-10">
                       <input type="text" class="form-control" id="Spouse" value="<?=$hhi_fetch['care_spouse_name']?>" readonly  name="Spouse" placeholder="Enter Spouse Name ">
                    </div>
                  </div>

                </div>
                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2">Part 2</a></li>
                  <li><a data-toggle="pill" href="#part3">part 3</a></li>
                  <!-- <li><a data-toggle="pill" href="#part4">Part 4</a></li> -->
                </ul>
               
                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>User Type</th>
                          <th>Date Of CRP Entry</th>
                          <th>Name of implement/ Devices</th>
                          <th>Target Activity </th>
                          <th>Trained in class room setting</th>
                          <th>Demonstration held date</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $form_lst1="SELECT * FROM `care_master_mtf_labour_saving_tech_tarina` WHERE `care_MTF_hhid`='$care_hhi' and `care_MTF_slno`='$id' and`care_MTF_month`='$months' and `care_MTF_year`='$year' and `care_MTF_vlg_name`='$village' and `care_MTF_mt_comment_status`='1' and `care_MTF_CBO_comment_status`='1' and `care_MTF_MEO_status`='0'";
                          $sql_exe_get1=mysqli_query($conn,$form_lst1);
                          
                          while ($hhi_fetch1=mysqli_fetch_assoc($sql_exe_get1)) {?>
                         
                        <tr>
                          <input  value="<?=web_encryptIt($hhi_fetch1['care_MTF_slno'])?>" type="hidden" class="form-control" name="form_type_id_div[]" required="">
                          <td>CRP Input</td>
                          <td> <?=$hhi_fetch1['care_MTF_date']?></td>
                          <td><input disabled class="form-control" type="text"  value="<?=$hhi_fetch1['care_MTF_implement_name']?>" disabled name="implement_lst" required=""></td>
                          <td>
                            <select disabled class="form-control" name="subject_matter" required="">
                            
                            <?php 
                                $get_traget="SELECT * FROM `care_master_target_lst_info` WHERE `care_status_target`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                   <option value="<?=$traget_fetch['Care_slno']?>"<?php if($hhi_fetch1['care_MTF_target_activity']==$traget_fetch['Care_slno']){echo "selected";}?>><?=$traget_fetch['care_activity_name']?></option>
                                  
                                  <?php
                                }
                                ?>

                          </select></td>
                          <td><select disabled class="form-control" name="setting_class_status" required="">
                            <option value="1"  <?php if($hhi_fetch1['care_MTF_classroom_trained']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($hhi_fetch1['care_MTF_classroom_trained']==2){echo "selected";}?>>No</option>
                          </select></td>
                          
                          <td><input class="form-control" value="<?=$hhi_fetch1['care_MTF_demo_date']?>"  type="text" name="Demonstration_date" disabled id="datepicker" required=""></td>
                        </tr>

                         <tr>
                           <td>MEO Input</td>
                            <td> <?=$hhi_fetch1['care_MTF_date']?></td>
                            <td><input  class="form-control" type="text"  value="<?=$hhi_fetch1['care_MTF_implement_name']?>"  name="care_MTF_implement_name[]" required=""></td>
                          <td>
                            <select  class="form-control" name="care_MTF_target_activity[]" required="">
                            
                            <?php 
                                $get_traget="SELECT * FROM `care_master_target_lst_info` WHERE `care_status_target`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                   <option value="<?=$traget_fetch['Care_slno']?>"<?php if($hhi_fetch1['care_MTF_target_activity']==$traget_fetch['Care_slno']){echo "selected";}?>><?=$traget_fetch['care_activity_name']?></option>
                                  
                                  <?php
                                }
                                ?>

                          </select></td>
                          <td><select  class="form-control" name="care_MTF_classroom_trained[]" required="">
                              <option value="1"  <?php if($hhi_fetch1['care_MTF_classroom_trained']==1){echo "selected";}?>>Yes</option>
                              <option value="2" <?php if($hhi_fetch1['care_MTF_classroom_trained']==2){echo "selected";}?>>No</option>
                          </select></td>
                          
                          <td><input class="form-control datepicker" value="<?=date('m/d/Y',strtotime(trim($hhi_fetch1['care_MTF_demo_date'])))?>"  type="text" name="care_MTF_demo_date[]"  id="datepicker" required=""></td>
                        </tr>
                        <?php }?>
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
                          <th>Member present <br> Male</th>
                          <th>Member present <br> Female</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           $sql_id_query="SELECT * FROM `care_master_mtf_labour_saving_tech_tarina` WHERE `care_MTF_hhid`='$care_hhi' and `care_MTF_slno`='$id' and`care_MTF_month`='$months' and `care_MTF_year`='$year' and `care_MTF_vlg_name`='$village' and `care_MTF_mt_comment_status`='1' and `care_MTF_CBO_comment_status`='1' and `care_MTF_MEO_status`='0'";
                          $sql_exe_table=mysqli_query($conn,$sql_id_query);
                          while ($table=mysqli_fetch_assoc($sql_exe_table)) {?>
                        
                        <tr>  
                          <td><input disabled value="<?=$table['care_MTF_male_present']?>" class="form-control" type="number" min="0"  name="Member_lst_male" required=""></td>
                          <td><input disabled value="<?=$table['care_MTF_female_present']?>" class="form-control" type="number" min="0" name="care_MTF_male_present[]" required=""></td>
                        </tr>
                         <tr>
                          <td><input  value="<?=$table['care_MTF_male_present']?>" class="form-control" type="number" min="0"  name="care_MTF_male_present[]" required=""></td>
                          <td><input  value="<?=$table['care_MTF_female_present']?>" class="form-control" type="number" min="0" name="care_MTF_female_present[]" required=""></td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    
                    
                    <br>
                  <ul class="pager">
                   <li class="previous back"><a >Previous</a></li>
                   <li class="next continue"><a >Next</a></li>
                 </ul>
                  </div>
                  <div id="part3" class="tab-pane fade">
                    <!-- Moistermeter-1, Hermative bags-2, Tarpaulin sheet-3, other specify-4 -->
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Implement/Devices being used or not</th>
                          <th>Farmer using <br>Male</th>
                          <th>Farmer using <br> Female</th>
                          <th>Comments OF MT</th>
                          <th>Comment Of CBO </th> 
                        </tr>
                      </thead>
                      <tbody>
                         <?php
                           $sql_id_query1="SELECT * FROM `care_master_mtf_labour_saving_tech_tarina` WHERE `care_MTF_hhid`='$care_hhi' and `care_MTF_slno`='$id' and`care_MTF_month`='$months' and `care_MTF_year`='$year' and `care_MTF_vlg_name`='$village' and `care_MTF_mt_comment_status`='1' and `care_MTF_CBO_comment_status`='1' and `care_MTF_MEO_status`='0'";
                          $sql_exe_table1s=mysqli_query($conn,$sql_id_query1);
                          $x_id=0;
                          while ($res12=mysqli_fetch_assoc($sql_exe_table1s)) {?>
                        <tr>
                          
                           <td><select disabled class="form-control" name="care_MTF_implements[]" required="">
                           <option value="1"  <?php if($res12['care_MTF_implements']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res12['care_MTF_implements']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><input disabled value="<?=$res12['care_MTF_male_farmer_using']?>" class="form-control" type="number" min="0" name="care_MTF_male_farmer_using[]" required=""></td>
                          <td><input disabled value="<?=$res12['care_MTF_female_farmer_using']?>" class="form-control" type="number" min="0" name="care_MTF_female_farmer_using[]" required=""></td>
                          <td>
                            <?php 
                            if($res12['care_MTF_mt_comment_status']=='0'){
                              echo "N/A";
                            }else{?>
                              
                              <textarea readonly=""  type="text" class="form-control" ><?=$res12['care_MTF_mt_comment_empty']?></textarea>

                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>
                          <td>
                            <?php 
                            if($res12['care_MTF_CBO_comment_status']=='0'){
                             echo "N/A";
                              }else{?>
                              
                              <textarea readonly=""  type="text" class="form-control"><?=$res12['care_MTF_CBO_comment_empty']?></textarea>
                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>

                        </tr>
                        <tr>
                           <td><select  class="form-control" name="care_MTF_implements[]" required="">
                           <option value="1"  <?php if($res12['care_MTF_implements']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res12['care_MTF_implements']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><input  value="<?=$res12['care_MTF_male_farmer_using']?>" class="form-control" type="number" min="0" name="care_MTF_male_farmer_using[]" required=""></td>
                          <td><input  value="<?=$res12['care_MTF_female_farmer_using']?>" class="form-control" type="number" min="0" name="care_MTF_female_farmer_using[]" required=""></td>
                          <td>
                            <?php 
                            if($res12['care_MTF_mt_comment_status']=='0'){
                              echo "N/A";
                            }else{?>
                              
                              <textarea disabled=""  type="text" class="form-control" ><?=$res12['care_MTF_mt_comment_empty']?></textarea>

                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>
                          <td>
                            <?php 
                            if($res12['care_MTF_MEO_comment_status']=='0'){
                              echo "N/A";
                            }else{?>
                             
                              <textarea  disabled="" type="text" class="form-control" ><?=$res12['care_MTF_CBO_comment_empty']?></textarea>
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
                 <?php if($form_uses_id==1){
                    ?><li class="next pull-right" ><input onclick="return confirm('Are you sure want to submit this?');" type="submit" name="save" value="save"></li>
                    <?php }?>
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
