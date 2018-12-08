<?php
// print_r($_GET);
// exit;
// ini_set('display_errors',1);
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 
 $care_hhi=web_decryptIt(str_replace(" ", "+",$_GET['ID']));
 $months=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));//
 $form_uses_id=web_decryptIt(str_replace(" ", "+",$_GET['form_uses_id']));
 $TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));
 $year=web_decryptIt(str_replace(" ", "+",$_GET['year']));
 $village=web_decryptIt(str_replace(" ", "+",$_GET['village']));

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
 

$title="View Input and output tracking After Meo Edit For HHI :-".$care_hhi." For Month/year ".$x_month."/".$year;
$name="input and output tracking";
$get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' ";
$sql_exe_get_id=mysqli_query($conn,$get_hhi);
$hhi_fetch=mysqli_fetch_assoc($sql_exe_get_id);


?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Input and output tracking  
       <!--  <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add New Data Entry</a></li>
        <li class="active">Input and output tracking  </li>
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>
      
        <div class="box box-primary">
            <div class="box-header with-border">

            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-file"></i>

              <h3 class="box-title"><?=$name?></h3>
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
                  <input  type="hidden" name="form_type_new" value="<?=web_encryptIt('MEO_comment')?>">
                  <input  type="hidden" name="form_type_id" value="<?=web_encryptIt('form1')?>">
                  <input type="hidden" name="form_type_user" value="<?=web_encryptIt($months)?>">
                  <input  type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                  <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                  <input  type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                  <input  type="hidden" name="long" value="" id="user_browser_long" required="true">
                  <input  type="hidden" name="care_hhi" value="<?=$care_hhi?>" id="user_browser_long2" required="true">
                  <input  type="hidden" name="care_hhi_slno" value="<?=$care_hhi_slno?>" id="user_browser_long" required="true">

              <div class="col-xs-12">
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="district">District</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" name="district" id="district" value="<?=$hhi_fetch['care_district_name']?>" placeholder="Enter District" readonly>
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
                      <select disabled class="form-control" name="month" required="" >
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
                    <label class="control-label col-sm-2" for="hhi" >HHI </label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" id="hhi" value="<?=$hhi_fetch['care_hhi_id']?>" readonly  name="hhi" placeholder="Enter HHI">
                    </div>
                  </div>

                </div>
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Block">Block</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" value="<?=$hhi_fetch['care_gp_name']?>" readonly  id="Block" placeholder="Enter Block" name="Block">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Village">Village</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" value="<?=$hhi_fetch['care_village_name']?>" readonly  id="Village" placeholder="Enter Village" name="Village">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year">Year</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" id="Year" value="<?=$year?>" readonly placeholder="Enter Year" name="Year">
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
                      <input  type="text" class="form-control" id="Spouse" value="<?=$hhi_fetch['care_spouse_name']?>" readonly  name="Spouse" placeholder="Enter Spouse Name ">
                    </div>
                  </div>
                   <input disabled="" type="hidden" class="form-control" id="SHG_Name" name="SHG_Name" placeholder="Enter SHG Name  ">
                  <!-- <div class="form-group">
                    <label class="control-label col-sm-2" for="SHG_Name" > SHG Name </label>
                    <div class="col-sm-10">
                      <input disabled="" type="text" class="form-control" id="SHG_Name" name="SHG_Name" placeholder="Enter SHG Name  ">
                    </div>
                  </div> -->

                </div>
                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2">Part 2</a></li>

                </ul>

                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <div class="table-responsive">
                    <table id='example11' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>hhi</th>
                          <th>women farmer</th>
                          <th>Month -Year </th>
                          <th>user</th>
                          <th>Date CRP Entry</th>
                          <th>Event Date</th>
                          <th>Activity Name</th>
                          <th>Support Provided<br> (Goods & Services) </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $get_detail_fill1="SELECT * FROM `care_master_Input_output_tracking_TARINA_meo` WHERE `care_TARINA_month`='$months' and `care_TARINA_year`='$year' and `care_TARINA_vlg_name`='$village' and`care_TARINA_hhi`='$care_hhi' and `care_IP_OP_mt_status`='1' and `care_IP_OP_MEO_status`='1' and `care_IP_OP_CBO_comment_status`='1'";
                        $query_exe_table1=mysqli_query($conn,$get_detail_fill1);
                        while ($fetch_table1=mysqli_fetch_assoc($query_exe_table1)) {

                        ?>
                        <input  value="<?=web_encryptIt($fetch_table1['care_TARINA_slno'])?>" type="hidden" class="form-control" name="form_type_id_div[]" required="">
                        <tr>
                         <td><?=$hhi_fetch['care_hhi_id']?></td>
                          <td><?=$hhi_fetch['care_women_farmer']?></td>
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
                          <td>CRP Input</td>
                          <td><?=$fetch_table1['care_TARINA_entry_date']?></td>
                          <td><?=$fetch_table1['care_TARINA_event_date']?></td>
                          <td><?=$fetch_table1['care_TARINA_activity_name']?></td>
                          <td><?=$fetch_table1['care_TARINA_support_provide']?></td>

                        </tr>
                         <tr>
                          <td><?=$hhi_fetch['care_hhi_id']?></td>
                          <td><?=$hhi_fetch['care_women_farmer']?></td>
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
                          <td><?=$fetch_table1['care_TARINA_entry_date']?></td>
                          <?php if($fetch_table1['care_TARINA_event_date_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=date('Y-m-d',strtotime(trim($fetch_table1['care_TARINA_event_date_edit'])))?></td>
                          <?php if($fetch_table1['care_TARINA_activity_name_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table1['care_TARINA_activity_name_edit']?></td>
                         <?php if($fetch_table1['care_TARINA_support_provider_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table1['care_TARINA_support_provider_edit']?></td>

                        </tr>
                     <?php  }?>
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
                          <th>hhi</th>
                          <th>women farmer</th>
                          <th>Month -Year </th>
                          <th>user</th>
                          <th>Production</th>
                          <th>Consumption</th>
                          <th>Sale</th>
                          <th>Remarks</th>
                          <th>Signature of CRP/Participant</th>
                          <th>Comments of MT</th>
                          <th>Comment Of CBO </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $get_detail_fill2="SELECT * FROM `care_master_Input_output_tracking_TARINA_meo` WHERE `care_TARINA_month`='$months' and `care_TARINA_year`='$year' and `care_TARINA_vlg_name`='$village' and`care_TARINA_hhi`='$care_hhi' and `care_IP_OP_mt_status`='1' and `care_IP_OP_MEO_status`='1' and `care_IP_OP_CBO_comment_status`='1'";
                        $query_exe_table2=mysqli_query($conn,$get_detail_fill2);
                        $num=mysqli_num_rows($query_exe_table2);
                      $x_id=0;
                        while ($fetch_table2=mysqli_fetch_assoc($query_exe_table2)) {
                          ?>
                        <tr>
                          <td><?=$hhi_fetch['care_hhi_id']?></td>
                          <td><?=$hhi_fetch['care_women_farmer']?></td>
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
                          <td><?=$fetch_table2['care_TARINA_production']?></td>
                          <td><?=$fetch_table2['care_TARINA_consumption']?></td>
                           <td><?=$fetch_table2['care_TARINA_sale']?></td>
                           <td><?=$fetch_table2['care_TARINA_remarks']?></td>
                          <td><?=$fetch_table2['care_TARINA_participant_sign']?></td>
                          <td>
                            <?php 
                            if($fetch_table2['care_IP_OP_mt_status']=='0'){
                             echo "N/A";
                           }else{?>
                              <?=$fetch_table2['care_IP_OP_mt_comment_empty']?>
                            <?php }?>
                              
                          </td>
                          <td>
                            <?php 
                            if($fetch_table2['care_IP_OP_CBO_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                              <?=$fetch_table2['care_IP_OP_CBO_comment_empty']?>
                              <?php }?>
                                
                          </td>
                        </tr>
                        <tr>
                          <td><?=$hhi_fetch['care_hhi_id']?></td>
                          <td><?=$hhi_fetch['care_women_farmer']?></td>
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
                          <?php if($fetch_table2['care_TARINA_production_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table2['care_TARINA_production_edit']?>
                          </td>
                          <?php if($fetch_table2['care_TARINA_consumption_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table2['care_TARINA_consumption_edit']?>
                          </td>
                           <?php if($fetch_table2['care_TARINA_sale_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?=$fetch_table2['care_TARINA_sale_edit']?>
                          </td>
                           <?php if($fetch_table2['care_TARINA_remarks_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table2['care_TARINA_remarks_edit']?>
                          </td>
                           <?php if($fetch_table2['care_TARINA_participant_sign_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table2['care_TARINA_participant_sign_edit']?>
                          </td>
                          <td>
                            <?php 
                            if($fetch_table2['care_IP_OP_mt_status']=='0'){
                             echo "N/A";
                              
                           }else{?>
                              
                             <?=$fetch_table2['care_IP_OP_mt_comment_empty']?>

                               
                            <?php }?>

                          </td>
                          <td>
                            <?php 
                            if($fetch_table2['care_IP_OP_CBO_comment_status']=='0'){
                              echo "N/A";
                            
                            }else{?>
                              
                              <?=$fetch_table2['care_IP_OP_CBO_comment_empty']?>

                              
                            <?php }?>

                          </td>

                        </tr>
                        <?php 
                        $x_id++;
                      }?>

                      </tbody>
                    </table>
                    
                    </div>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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