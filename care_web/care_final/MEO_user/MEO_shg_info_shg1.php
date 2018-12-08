<?php
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 
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
      $get_detail_query41="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina_meo` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year' and `care_SHG_mt_comment_status`='1' and `care_SHG_MEO_status`='1' and `care_SHG_CBO_comment_status`='1'";
                        $sql_exe_deatils41=mysqli_query($conn,$get_detail_query41);
                        $num=mysqli_num_rows($sql_exe_deatils41);
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
    $employee_id="";
    $village="";
     header('Location:logout.php');
    exit; 
  }

 }else{
 header('Location:MEO_shglist_info_shglist1.php');
 exit; 
 
 }

$title="View >Self Help Group After Meo Edit For Village :-".$village." For Month/year ".$x_month."/".$year;
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
             <form  class="form-horizontal" onsubmit="return check_comments()">
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
                <?php if($num!=0){
                  ?>
               
                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2"><h5>Record Maintenance and update</h5></a></li>
                  <li><a data-toggle="pill" href="#part3"><h5>Member Linkage<h5></a></li>
                  <li><a data-toggle="pill" href="#part4">Part 4</a></li>
                  <li><a data-toggle="pill" href="#part5">Part 5</a></li>
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
                         $get_detail_query="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina_meo` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year' and `care_SHG_mt_comment_status`='1' and `care_SHG_MEO_status`='1' and `care_SHG_CBO_comment_status`='1'";
                        $sql_exe_deatils=mysqli_query($conn,$get_detail_query);
                        while ($res1=mysqli_fetch_assoc($sql_exe_deatils)) {?>
                        
                         <input  value="<?=web_encryptIt($res1['care_SHG_slno'])?>" type="hidden" class="form-control" name="form_type_id_div[]" required="">
                       
                        <tr>
                          <td><?=$shg_fetch['care_vlg_name']?></td>
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
                          <td><?=$res1['care_SHG_date']?></td>
                          <td><?=$res1['care_SHG_name']?></td>
                          <td><?=$res1['care_SHG_total_member']?></td>
                          <td><?=$res1['care_SHG_LMM_date']?></td>
                           <td><?=$res1['care_SHG_mem_prsnt_monthly_meeting']?></td>
                          
                        </tr>
                       <tr>
                        <td><?=$shg_fetch['care_vlg_name']?></td>
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
                          <td><?=$res1['care_SHG_date']?></td>
                          <td><?=$res1['care_SHG_name']?></td>
                          <?php if($res1['care_SHG_total_member_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                          <?=$res1['care_SHG_total_member_edit']?>
                          </td>
                           <?php if($res1['care_SHG_LMM_date_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?><?=$res1['care_SHG_LMM_date_edit']?></td>

                           <?php if($res1['care_SHG_mem_prsnt_monthly_meeting_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?><?=$res1['care_SHG_mem_prsnt_monthly_meeting_edit']?></td>
                          
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  <br>
                  </div>
                  <ul class="pager">
                   <!-- <li class="previous"><a data-toggle="pill" href="#Address">Previous</a></li> -->
                    <li class="next continue" ><a data-toggle="pill" href="#part2">Next</a></li>
                  <!-- <li class="next continue"><a >Next</a></li> -->
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
                          <th><!-- Record Maintenance and update <br> --> Meeting Register</th>
                          <!--<th> Record Maintenance and update  <br> Cash book</th>-->
                          <!-- <th> Record Maintenance and update  <br> Individual Passbook</th>-->
                          <!-- <th> Record Maintenance and update  <br> Group pass book</th>-->
                          <th><!-- Record Maintenance and update  --><br> Saving & loan ledger book
                          </th>
                          <!-- <th>No. of HHs <br>Repeats</th> -->
                        </tr>
                      </thead>
                      <tbody>
                         <?php 
                        $get_detail_query1="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina_meo` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year' and `care_SHG_mt_comment_status`='1' and `care_SHG_MEO_status`='1' and `care_SHG_CBO_comment_status`='1'";
                        $sql_exe_deatils1=mysqli_query($conn,$get_detail_query1);
                        while ($res2=mysqli_fetch_assoc($sql_exe_deatils1)) {?>
                        <tr>
                          <td><?=$shg_fetch['care_vlg_name']?></td>
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
                           <?php if($res2['care_SHG_RMU_meeting_redg']==1){echo "Yes";}?>
                          <?php if($res2['care_SHG_RMU_meeting_redg']==2){echo "No";}?>
                         </td>
                            <input type="hidden" name="care_SHG_RMU_cash_book[]" value="1">
                            <input type="hidden" name="care_SHG_RMU_ind_passbook[]" value="1">
                            <input type="hidden" name="care_SHG_RMU_group_passbook[]" value="1">
                         <td>
                           <?php if($res2['care_SHG_RMU_saving_loan_ledger_book']==1){echo "Yes";}?>
                           <?php if($res2['care_SHG_RMU_saving_loan_ledger_book']==2){echo "No";}?>
                         </td>
                        </tr>

                         <tr>
                          <td><?=$shg_fetch['care_vlg_name']?></td>
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
                           <?php if($res2['care_SHG_RMU_meeting_redg_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?php if($res2['care_SHG_RMU_meeting_redg_edit']==1){echo "Yes";}?>
                            <?php if($res2['care_SHG_RMU_meeting_redg_edit']==2){echo "No";}?>
                          </td>
                         
                           <input type="hidden" name="care_SHG_RMU_cash_book[]" value="1">
                            <input type="hidden" name="care_SHG_RMU_ind_passbook[]" value="1">
                            <input type="hidden" name="care_SHG_RMU_group_passbook[]" value="1">

                           <?php if($res2['care_SHG_RMU_saving_loan_ledger_book_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                           <?php if($res2['care_SHG_RMU_saving_loan_ledger_book_edit']==1){echo "Yes";}?><?php if($res2['care_SHG_RMU_saving_loan_ledger_book_edit']==2){echo "No";}?>
                          </td>                          
                        </tr>
                        <?php  }?>
                      </tbody>
                    </table>
                    </div>
                    <br>
                  <ul class="pager">
                     <li class="previous back"><a data-toggle="pill" href="#part1">Previous</a></li>
                   <li class="next continue" ><a data-toggle="pill" href="#part3">Next</a></li>
                   <!-- li class="previous back"><a>Previous</a></li>
                   <li class="next continue"><a>Next</a></li> -->
                 </ul>
                  </div>
                  <div id="part3" class="tab-pane fade">
                    <div class="table-responsive">
                   <table id='example13' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Village</th>
                          <th>Month-Year</th>
                          <th>User</th> 
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
                        $get_detail_query3="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina_meo` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year' and `care_SHG_mt_comment_status`='1' and `care_SHG_MEO_status`='1' and `care_SHG_CBO_comment_status`='1'";
                        $sql_exe_deatils3=mysqli_query($conn,$get_detail_query3);
                        while ($res3=mysqli_fetch_assoc($sql_exe_deatils3)) {?>
                        <tr>
                          <td><?=$shg_fetch['care_vlg_name']?></td>
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
                            <?php if($res3['care_SHG_ML_linkage_external_credit']==1){echo "Yes";}?>
                            <?php if($res3['care_SHG_ML_linkage_external_credit']==2){echo "No";}?>
                          </td>
                          <td>
                            <?=$res3['care_SHG_ML_bank_name']?>
                          </td>
                          <td>
                            <?=$res3['care_SHG_ML_no_of_mem_link_market']?>
                          </td>
                           <td>
                           <?=$res3['care_SHG_ML_no_of_mem_link_tech_support_provider']?>
                          </td>
                          <td>
                           <?=$res3['shg_field_new1']?>
                          </td>
                        </tr>
                        <tr>
                           <td><?=$shg_fetch['care_vlg_name']?></td>
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
                           <?php if($res3['care_SHG_ML_linkage_lexternal_credit_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?php if($res3['care_SHG_ML_linkage_external_credit_edit']==1){echo "Yes";}?>
                            <?php if($res3['care_SHG_ML_linkage_external_credit_edit']==2){echo "No";}?>

                          </td>
                           <?php if($res3['care_SHG_ML_bank_name_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                           <?=$res3['care_SHG_ML_bank_name_edit']?>
                          </td>
                           <?php if($res3['care_SHG_ML_no_of_mem_link_market_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?=$res3['care_SHG_ML_no_of_mem_link_market_edit']?>
                          </td>
                            <?php if($res3['care_SHG_ML_no_of_mem_link_tech_support_provider_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?=$res3['care_SHG_ML_no_of_mem_link_tech_support_provider_edit']?>
                          </td>

                           <?php if($res3['shg_field_new1_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?=$res3['shg_field_new1_edit']?>
                          </td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    </div>
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
                          <th>Village</th>
                          <th>Month-Year</th>
                          <th>User</th>
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
                      $get_detail_query5="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina_meo` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year' and `care_SHG_mt_comment_status`='1' and `care_SHG_MEO_status`='1' and `care_SHG_CBO_comment_status`='1'";
                        $sql_exe_deatils5=mysqli_query($conn,$get_detail_query5);
                        while ($res5=mysqli_fetch_assoc($sql_exe_deatils5)) {?>
                        <tr>
                          <td><?=$shg_fetch['care_vlg_name']?></td>
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
                         <?php if($res5['shg_field_new3']==1){echo "Yes";}?>
                         <?php if($res5['shg_field_new3']==2){echo "No";}?>
                         </td>
                         <td>
                            <?=$res5['shg_field_new4']?>
                          </td>  
                         <td>
                         <?php if($res5['shg_field_new5']==1){echo "Yes";}?>
                         <?php if($res5['shg_field_new5']==2){echo "No";}?> 
                          </td>
                                          
                           <td>
                            <?=$res5['shg_field_new6']?>
                          </td> 
                          <td>
                            <?php if($res5['shg_field_new7']==1){echo "Yes";}?>
                            <?php if($res5['shg_field_new7']==2){echo "No";}?>
                          </td>
                           <td>
                            <?=$res5['shg_field_new8']?>
                          </td> 
                        </tr>

                       <tr>
                         <td><?=$shg_fetch['care_vlg_name']?></td>
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
                         <?php if($res5['shg_field_new3_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?php if($res5['shg_field_new3_edit']==1){echo "Yes";}?>
                            <?php if($res5['shg_field_new3_edit']==2){echo "No";}?>

                          </td>


                          <?php if($res5['shg_field_new4_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?=$res5['shg_field_new4_edit']?>
                          </td>

                           <?php if($res5['shg_field_new5_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?php if($res5['shg_field_new5_edit']==1){echo "Yes";}?>
                            <?php if($res5['shg_field_new5_edit']==2){echo "No";}?>

                          </td>

                           <?php if($res5['shg_field_new6_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?=$res5['shg_field_new6_edit']?>
                          </td>

                          <?php if($res5['shg_field_new7_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?php if($res5['shg_field_new7_edit']==1){echo "Yes";}?>
                            <?php if($res5['shg_field_new7_edit']==2){echo "No";}?>
                          </td>

                            <?php if($res5['shg_field_new8_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?=$res5['shg_field_new8_edit']?>
                          </td>

                        </tr>
                        <?php 
                        
                      }?>
                      </tbody>
                    </table>
                  <ul class="pager">  
                   <li class="previous back"><a >Previous</a></li> 
                   <li class="next continue" ><a data-toggle="pill" href="#part5">Next</a></li>
                 </ul>
                </div>
                 
                  <div id="part5" class="tab-pane fade">
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Village</th>
                          <th>Month-Year</th>
                          <th>User</th>
                          <th>No of member linkaged<br> to any committee</th>
                          <th>Name of the committee</th>
                          <th>Nutrition Discussion in<br> SHG Monthly Meeting.</th>
                          <th>Topic of the nutrition messages<br> discussed in the meeting</th>
                          <th>Comments OF MT</th>
                          <th>Comment Of CBO</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                           <?php 
                        $get_detail_query4="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina_meo` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_employee_id`='$employee_id' and `care_SHG_month`='$months' and `care_SHG_year`='$year' and `care_SHG_mt_comment_status`='1' and `care_SHG_MEO_status`='1' and `care_SHG_CBO_comment_status`='1'";
                        $sql_exe_deatils4=mysqli_query($conn,$get_detail_query4);
                        while ($res4=mysqli_fetch_assoc($sql_exe_deatils4)) {?>
                        <tr>
                          <td><?=$shg_fetch['care_vlg_name']?></td>
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
                            <?=$res4['care_SHG_no_of_mem_link_any_committee']?>
                          </td>
                          <td>
                            <?=$res4['care_SHG_committee_name']?>
                          </td>                          
                           <td>
                            <?php if($res4['care_SHG_nutrition_discus_SHG_mnthly_meeting']==1){echo "Yes";}?>
                            <?php if($res4['care_SHG_nutrition_discus_SHG_mnthly_meeting']==2){echo "No";}?>
                          </td>

                           <td><?=$res4['shg_field_new2']?></td>
                          <td>
                           <?php 
                            if($res4['care_SHG_mt_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                             <?=$res4['care_SHG_mt_comment_empty']?>
                            <?php }?>

                          </td>


                          <td>
                           <?php 
                            if($res4['care_SHG_CBO_comment_status']=='0'){
                            echo "N/A";
                             }else{?>
                              <?=$res4['care_SHG_CBO_comment_empty']?>
                            <?php }?>

                          </td>


                        </tr>
                       <tr>
                         <td><?=$shg_fetch['care_vlg_name']?></td>
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
                          <?php if($res4['care_SHG_no_of_mem_link_any_committee_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?=$res4['care_SHG_no_of_mem_link_any_committee_edit']?>
                          </td>
                          <?php if($res4['care_SHG_committee_name_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                            <?=$res4['care_SHG_committee_name_edit']?>
                          </td>                          
                           <?php if($res4['care_SHG_nutrition_discus_SHG_mnthly_meeting_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                           <?php if($res4['care_SHG_nutrition_discus_SHG_mnthly_meeting_edit']==1){echo "Yes";}?>
                           <?php if($res4['care_SHG_nutrition_discus_SHG_mnthly_meeting_edit']==2){echo "No";}?>
                          
                          </td>



                            <?php if($res4['shg_field_new2_status']==2){?>
                              <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                            <?php
                            }
                          ?>
                             <?=$res4['shg_field_new2_edit']?>
                          </td> 

                          <td>
                           <?php 
                            if($res4['care_SHG_mt_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                              <?=$res4['care_SHG_mt_comment_empty']?>
                            <?php }?>

                          </td>
                           <td>
                           <?php 
                            if($res4['care_SHG_CBO_comment_status']=='0'){
                            echo "N/A";
                             }else{?>
                              <?=$res4['care_SHG_CBO_comment_empty']?>
                            <?php }?>

                          </td>

                        </tr>
                        <?php 
                        $x_id++;
                      }?>
                      </tbody>
                    </table>
                  <ul class="pager">  
                   <li class="previous back"><a >Previous</a></li> 
                 </ul>
                     </div>
                    <br>

           
                  </div>
                  <?php }else{
                    ?>
                    <span>
                    <p class="text-center">No Informtion  Found </p>
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