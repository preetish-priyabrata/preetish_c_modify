<?php
session_start();
ob_start();
if($_SESSION['cbo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="FFS/Training/Exposure Visit/Capacity Building Events";
 
if($_POST['form_type']){
  $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
  if($form_type=='get_hhi_infomation'){
    $village=$_POST['village'];
    $months=$_POST['month'];
    $year=$_POST['Year'];
    $employee_id=$_POST['employee_id'];
      $get_shg="SELECT * FROM `care_master_village_info` WHERE `care_vlg_name`='$village'";
      $sql_exe_get=mysqli_query($conn,$get_shg);
      $shg_fetch=mysqli_fetch_assoc($sql_exe_get);
   
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

//    $care_shg=web_decryptIt(str_replace(" ", "+",$_GET['ID']));
//   $care_shg_slno=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));
//  $TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));


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
        <li><a href="#">SHG Report</a></li>
        <li class="active">Self Help Group</li>
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>
      
      <div class="box box-primary">
         <div class="box-header with-border">

            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">Self Help Group</h3>
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
               <form action="CBO_update_comments.php" id="myForm" name="in_ou" method="POST" class="form-horizontal" onsubmit="return check_comments()">
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('hhi_for_SHG')?>">
                  <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                  <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                  <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                  <input type="hidden" name="long" value="" id="user_browser_long" required="true">

              <div class="col-xs-12">
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="district">District</label>
                    <div class="col-sm-10">
                      <!-- <?php print_r($shg_fetch);?> -->
                      <input type="text" class="form-control" id="district" name="district" value="<?=$shg_fetch['care_vlg_district']?>" readonly placeholder="Enter District">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="GP_name">GP Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="GP_name" name="GP_name" value="<?=$shg_fetch['care_vlg_gp']?>" readonly placeholder="Enter GP">
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
                      <input type="text" class="form-control" id="Block" value="<?=$shg_fetch['care_vlg_block']?>" readonly placeholder="Enter Block" name="Block">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Village">Village</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$shg_fetch['care_vlg_name']?>" readonly id="Village" placeholder="Enter Village" name="Village">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year">Year</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Year" value="<?=$year?>" readonly placeholder="Enter Year" name="Year">
                    </div>
                  </div>

                   

                </div>

                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2"><h5>Record Maintenance and update</h5></a></li>
                  <li><a data-toggle="pill" href="#part3"><h5>Member Linkage<h5></a></li>
                  <li><a data-toggle="pill" href="#part4">Part 4</a></li>
                  <li><a data-toggle="pill" href="#part5">Part 5</a></li>
                 </ul>
                
                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Date Of Entry</th>
                          <th>SHG Name</th>
                          <th>Total no. of Members</th>
                          <th>Last Month Meeting Date </th>
                          <th>Member present in <br> monthly meeting</th>
                          <!-- <th>Average Duration  of session (in Hr.)</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                         $get_detail_query="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year'";
                        $sql_exe_deatils=mysqli_query($conn,$get_detail_query);
                        while ($res1=mysqli_fetch_assoc($sql_exe_deatils)) {?>
                       <tr>
                          <td><?=$res1['care_SHG_date']?></td>
                          <td><?=$res1['care_SHG_name']?></td>
                          <td><input disabled="" value="<?=$res1['care_SHG_total_member']?>" class="form-control" type="number" min="0" name="Topic_Covered" required=""></td>
                          <td><input disabled="" value="<?=$res1['care_SHG_LMM_date']?>" class="form-control" type="text" name="event_date" id="datepicker" required=""></td>
                           <td><input disabled="" value="<?=$res1['care_SHG_mem_prsnt_monthly_meeting']?>" class="form-control" type="text" name="Duration_session" required=""></td>
                          
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
                          <th><!-- Record Maintenance and update <br> --> Meeting Register</th>
                          <!--<th> Record Maintenance and update  <br> Cash book</th>-->
                          <!-- <th> Record Maintenance and update  <br> Individual Passbook</th>-->
                          <!--<th> Record Maintenance and update  <br> Group pass book</th>-->
                          <th><!-- Record Maintenance and update  --><br> Saving & loan ledger book
                          </th>
                          <!-- <th>No. of HHs <br>Repeats</th> -->
                        </tr>
                      </thead>
                      <tbody>
                         <?php 
                        $get_detail_query1="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year' and `care_SHG_mt_comment_status`='1'";
                        $sql_exe_deatils1=mysqli_query($conn,$get_detail_query1);
                        while ($res2=mysqli_fetch_assoc($sql_exe_deatils1)) {?>
                         <tr>
                           <td>
                            <select disabled class="form-control" name="Meeting" required="">
                             <option value="1"  <?php if($res2['care_SHG_RMU_meeting_redg']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res2['care_SHG_RMU_meeting_redg']==2){echo "selected";}?>>No</option>
                          </td>
                          <input type="hidden" name="Cash" value="1">
                          <input type="hidden" name="Individual" value="1">
                          <input type="hidden" name="Group" value="1">
                    
                           <td>
                            <select disabled class="form-control" name="Saving" required="">
                             <option value="1"  <?php if($res2['care_SHG_RMU_saving_loan_ledger_book']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res2['care_SHG_RMU_saving_loan_ledger_book']==2){echo "selected";}?>>No</option>
                          </select>
                          </td>
                        </tr>
                        <?php  }?>
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
                          <th>Linkage to external credit <br>(Gr taken loan from bank/MFI)</th>
                          <th>Name of the <br>Bank/Institution linked</th>
                          <th>No of Member linkages <br>to market</th>
                          <th>No of Member linkages <br>technical support provider@</th>
                          <th>Purpose of the linkages</th>
                          <!-- <th>Remarks</th> -->
                        </tr>
                      </thead>
                      <tbody>
                           <?php 
                        $get_detail_query3="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year' and `care_SHG_mt_comment_status`='1'";
                        $sql_exe_deatils3=mysqli_query($conn,$get_detail_query3);
                        while ($res3=mysqli_fetch_assoc($sql_exe_deatils3)) {?>
                       <tr>
                          <td>
                            <select disabled class="form-control" name="Seed_qnty" required="">
                              <option value="1"  <?php if($res2['care_SHG_ML_linkage_external_credit']==1){echo "selected";}?>>Yes</option>
                              <option value="2" <?php if($res2['care_SHG_ML_linkage_external_credit']==2){echo "selected";}?>>No</option>
                          </td>
                          <td>
                            <input disabled="" value="<?=$res3['care_SHG_ML_bank_name']?>" type="text" class="form-control" name="Fertiliser_qnty" required="">
                          </td>
                           <td>
                            <input disabled="" value="<?=$res3['care_SHG_ML_no_of_mem_link_market']?>" type="number" min="0" class="form-control" name="Pesticides_qnty" required="">
                          </td>
                           <td>
                            <input disabled="" value="<?=$res3['care_SHG_ML_no_of_mem_link_tech_support_provider']?>" type="number" min="0" class="form-control" name="Others_qnty" required="">
                          </td>
                           <td>
                            <input disabled="" type="text" value="<?=$res3['shg_field_new1']?>" class="form-control" name="shg_field_new1" required="">
                          </td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>

                    
                    <br>
                  <ul class="pager">
                   <li class="previous back"><a data-toggle="pill" href="#part2">Previous</a></li>
                   <li class="next continue" ><a data-toggle="pill" href="#part4">Next</a></li>
                 </ul>
                  </div>
                  <div id="part4" class="tab-pane fade">
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          
                         <th>Is this group accessed <br>agri services in this month</th>
                          <th>If yes, what services <br>this group accessed</th>
                          <th>Does this group discussed <br> MSP/FAQ on pulses in this month?</th>
                          <th>If yes, which topic<br> they are discussed </th>
                          <th>Is this group discussed any <br>agriculture product and services<br>options in this month?</th>
                          <th>If Yes, What kind of agriculture <br> product and services issues <br>in this month</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                           <?php 
                        $get_detail_query4="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year'";
                        $sql_exe_deatils4=mysqli_query($conn,$get_detail_query4);
                        while ($res5=mysqli_fetch_assoc($sql_exe_deatils4)) {?>
                        <tr>
                          <td>
                          <select class="form-control" name="shg_field_new3" disabled required="">
                            <option value="1"  <?php if($res5['shg_field_new3']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res5['shg_field_new3']==2){echo "selected";}?>>No</option>
                          </select>
                          </td>
                          <td>
                            <input type="text" value="<?php echo $res5['shg_field_new4']?>" disabled class="form-control" name="shg_field_new4">
                          </td>
                          <td>
                            <select class="form-control" name="shg_field_new5" disabled required="">
                            <option value="1"  <?php if($res5['shg_field_new5']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res5['shg_field_new5']==2){echo "selected";}?>>No</option>
                          </select>
                          </td>
                          <td>
                            <input type="text" class="form-control" disabled value="<?php echo $res5['shg_field_new6']?>" name="shg_field_new6" required="">
                          </td>
                           <td>
                           <select class="form-control" name="shg_field_new7" disabled required="">
                            <option value="1" <?php if($res5['shg_field_new7']==1){echo "selected";}  ?>>Yes</option>
                            <option value="2" <?php if ($res5['shg_field_new7']==2){echo "selected";}?>>No</option>
                           </select>
                          </td>
                           <td>
                            <input type="text" disabled class="form-control" value="<?php echo $res5['shg_field_new8']?>" name="shg_field_new8" required="">
                          </td>
                        
                        </tr>
                        <?php 
                     
                      }?>
                      </tbody>
                    </table>
                    
                    <br>
                  <ul class="pager">
                    
                   <li class="previous back"><a >Previous</a></li>
                   <!-- <li class="next pull-right" ><input type="submit" name="save" value="save"></li> -->
                   <!-- <li class="next"><a data-toggle="pill" href="#part4">Next</a></li> -->
                 </ul>
                  </div>

                  <input  type="hidden" name="form_type_new" value="<?=web_encryptIt('CBO_comment')?>">
                    <input  type="hidden" name="form_type_id" value="<?=web_encryptIt('form10')?>">
                    <input type="hidden" name="form_type_user" value="<?=web_encryptIt($months)?>">
                  <div id="part5" class="tab-pane fade">
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>No of member linkaged<br> to any committee</th>
                          <th>Name of the committee</th>
                          <th>Nutrition Discussion in<br> SHG Monthly Meeting.</th>
                          <th>Topic of the nutrition messages<br> discussed in the meeting</th>
                          <th>comments OF MT</th>
                          <th>Comment Of CBO</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                           <?php 
                        $get_detail_query4="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year' and `care_SHG_mt_comment_status`='1'";
                        $sql_exe_deatils4=mysqli_query($conn,$get_detail_query4);
                        while ($res4=mysqli_fetch_assoc($sql_exe_deatils4)) {?>
                        <tr>
                          <td>
                            <input readonly="" type="number" value="<?=$res4['care_SHG_no_of_mem_link_any_committee']?>" min="1" class="form-control" name="Consumption" required="">
                          </td>
                          <td>
                            <input readonly="" type="text" value="<?=$res4['care_SHG_committee_name']?>" class="form-control" name="Sale" required="">
                          </td>                          
                           <td>
                            <select disabled class="form-control" name="type_input_training" required="">
                            <option value="1"  <?php if($res4['care_SHG_nutrition_discus_SHG_mnthly_meeting']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res4['care_SHG_nutrition_discus_SHG_mnthly_meeting']==2){echo "selected";}?>>No</option>
                          </select>
                          </td>
                          <td> <textarea disabled class="form-control" name="shg_field_new2" required=""><?=$res4['shg_field_new2']?></textarea></td>
                          <td>
                           <?php 
                            if($res4['care_SHG_mt_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                             
                              <textarea readonly=""  type="text" class="form-control" ><?=$res4['care_SHG_mt_comment_empty']?></textarea>

                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>
                          <td>
                           <?php 
                            if($res4['care_SHG_CBO_comment_status']=='0'){?>
                             <input  value="<?=web_encryptIt($res4['care_SHG_slno'])?>" type="hidden" class="form-control" name="form_type_id_div[]" required="">
                              <textarea  value="" type="text" class="form-control" name="comments_mt[<?=$x_id?>]" id="comments_mt<?=$x_id?>" required="true"><?=$res4['care_SHG_CBO_comment_empty']?></textarea>
                              <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }else{?>
                              <input  value="<?=web_encryptIt($res4['care_SHG_slno'])?>" type="hidden" class="form-control" name="form_type_id_div[]" required="">
                              <textarea readonly=""  type="text" class="form-control" name="comments_mt[<?=$x_id?>]" id="comments_mt<?=$x_id?>" required=""><?=$res4['care_SHG_CBO_comment_empty']?></textarea>

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
                   <li class="next pull-right" ><input type="submit" name="save" value="save"></li>
                   <!-- <li class="next"><a data-toggle="pill" href="#part4">Next</a></li> -->
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
  $( function() {
    $( "#datepicker" ).datepicker();
  } ); $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } ); $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>
  
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