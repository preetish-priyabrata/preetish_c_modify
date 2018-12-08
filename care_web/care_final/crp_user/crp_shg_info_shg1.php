<?php
session_start();
ob_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="SHG Form";
 $care_shg=web_decryptIt(str_replace(" ", "+",$_GET['ID']));
 $care_shg_slno=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));
 $TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));
 $get_shg="SELECT * FROM `care_master_shg_list_info` WHERE `care_shg_id`='$care_shg' and `care_shg_slno`='$care_shg_slno'";
 $sql_exe_get=mysqli_query($conn,$get_shg);
 $shg_fetch=mysqli_fetch_assoc($sql_exe_get);

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
    SHG Form
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
               <form action="crp_all_form_save.php" id="myForm" method="POST" class="form-horizontal">
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('hhi_for_SHG')?>">
                  <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                  <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                  <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                  <input type="hidden" name="long" value="" id="user_browser_long" required="true">

                  <input type="hidden" name="care_hhi" value="<?=$care_shg?>" id="user_browser_long2" required="true">
                  <input type="hidden" name="care_hhi_slno" value="<?=$care_shg_slno?>" id="user_browser_long" required="true">
                  <input type="hidden" class="form-control" value="<?=$care_shg?>" readonly  id="women" name="women" placeholder="Enter women farmer ">
                  <input type="hidden" class="form-control" id="Spouse" value="<?=$care_shg_slno?>" readonly  name="Spouse" placeholder="Enter Spouse Name ">

              <div class="col-xs-12">
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="district">District</label>
                    <div class="col-sm-10">
                      <!-- <?php print_r($shg_fetch);?> -->
                      <input type="text" class="form-control" id="district" name="district" value="<?=$shg_fetch['care_shg_district']?>" readonly placeholder="Enter District">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="GP_name">GP Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="GP_name" name="GP_name" value="<?=$shg_fetch['care_shg_gp']?>" readonly placeholder="Enter GP">
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

                </div>
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Block">Block</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Block" value="<?=$shg_fetch['care_shg_block']?>" readonly placeholder="Enter Block" name="Block">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Village">Village</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$shg_fetch['care_shg_village']?>" readonly id="Village" placeholder="Enter Village" name="Village">
                    </div>
                  </div>

                  <div class="form-group">
                   <label class="control-label col-sm-2" for="Year">Year</label>
                    <div class="col-sm-10">
                     <!--  <input type="text" class="form-control" id="Year" value="<?=date('Y')?>" readonly placeholder="Enter Year" name="Year"> -->
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
                    <label class="control-label col-sm-2" for="SHG">SHG </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" readonly="" id="SHG" value="<?=$shg_fetch['care_shg_name']?>" placeholder="Enter SHG" name="SHG">
                    </div>
                  </div>
                </div>

                <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2"><h4>Record Maintenance and Update</h4></a></li>
                  <li><a data-toggle="pill" href="#part3"><h4>Member Linkages</h4></a></li>
                  <li><a data-toggle="pill" href="#part4">Part 4</a></li>
                  <li><a data-toggle="pill" href="#part5">Part 5</a></li>
               </ul>
                
                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Total no. of Members</th>
                          <th>Last Month Meeting Date </th>
                          <th>Member present in <br> monthly meeting</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input class="form-control" type="number" min="0" name="Topic_Covered" required=""></td>
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
                          <th><!-- Record Maintenance and update <br> --> Meeting Register</th>
                          <!--<th> Record Maintenance and update <br>  Cash book</th>-->
                          <!-- <th> Record Maintenance and update <br>  Individual Passbook</th>-->
                          <!--<th> Record Maintenance and update  <br> Group pass book</th>-->
                          <th><!-- Record Maintenance and update --> <br> Saving & loan ledger book
                          </th>
                          
                         
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <select class="form-control" name="Meeting" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            </select>
                          </td>
                            <input type="hidden" name="Cash" value="1">
                            <input type="hidden" name="Individual" value="1">
                            <input type="hidden" name="Group" value="1">
                    
                           <td>
                            <select class="form-control" name="Saving" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            </select>
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
                          <th>Linkage to external credit <br>(Gr taken loan from bank/MFI)</th>

                          <th>Name of the <br>Bank/Institution linked</th>
                          <th>No of Member linkages <br>to market</th>
                          <th>No of Member linkages <br>technical support provider@</th>
                          <th>Purpose of the linkages</th>
                          
                          <!-- <th>Remarks</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                          <select class="form-control" name="Linkage_external_credit" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="Bank_linked" required="">
                          </td>
                           <td>
                            <input type="number" min="0" class="form-control" name="linkages_market" required="">
                          </td>
                           <td>
                            <input type="number" min="0" class="form-control" name="linkages_technical_support" required="">
                          </td>
                           <td>
                            <input type="text" class="form-control" name="shg_field_new1" required="">
                          </td>
                        </tr>
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
                          <th>No of member linkaged<br> to any committee</th>
                          <th>Name of the committee</th>
                          <th>Nutrition Discussion in<br> SHG Monthly Meeting.</th>
                          <th>Topic of the nutrition messages<br> discussed in the meeting</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <input type="number" min="1" class="form-control" name="committee_no" required="">
                          </td>
                          <td>
                            <select class="form-control" name="committee" required="">
                             <?php 
                                $get_traget="SELECT * FROM `care_master_committee_info` WHERE `care_comm_status`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                <option value="<?=$traget_fetch['care_comm_name']?>"><?=$traget_fetch['care_comm_name']?></option>
                             <?php
                                }
                              ?>
                            </select>
                          </td>                          
                           <td>
                            <select class="form-control" name="Monthly_status" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select>
                          </td>
                          <td>
                            <textarea class="form-control" name="shg_field_new2" required=""></textarea>
                          </td>
                          
                        </tr>
                      </tbody>
                    </table>
                    
                    <br>
                  <ul class="pager">
                    
                   <li class="previous back"><a >Previous</a></li>
                  <!--  <li class="next pull-right" ><input type="submit" name="save" value="save"></li> -->
                   <li class="next"><a data-toggle="pill" href="#part4">Next</a></li>
                 </ul>
                  </div>

                 <div id="part5" class="tab-pane fade">
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
                        <tr>
                          <td>
                             <select class="form-control" name="shg_field_new3" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="shg_field_new4">
                          </td>
                          <td>
                            <select class="form-control" name="shg_field_new5" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="shg_field_new6" required="">
                          </td>
                           <td>
                           <select class="form-control" name="shg_field_new7" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                           </select>
                          </td>
                           <td>
                            <input type="text" class="form-control" name="shg_field_new8" required="">
                          </td>
                        
                        </tr>
                      </tbody>
                    </table>
                    <br>
                  <ul class="pager">
                   <li class="previous back"><a data-toggle="pill" href="#part2">Previous</a></li>
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


  