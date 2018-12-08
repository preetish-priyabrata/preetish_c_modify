<?php
session_start();
ob_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
 $care_hhi=web_decryptIt(str_replace(" ", "+",$_GET['ID']));
 $care_hhi_slno=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));
 $TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));
switch ($TYPE) {
  case '5':
    $name="Goatery";
     break;
  case '2':
    $name="Dairy";
     break;
  case '3':
    $name="Poultry";
     break;
   
   default:
      header('Location:logout.php');
      exit; 
     break;
}
$get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' and `care_hhi_slno`='$care_hhi_slno'";


$sql_exe_get=mysqli_query($conn,$get_hhi);
$hhi_fetch=mysqli_fetch_assoc($sql_exe_get);
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
        Post Harvest Loss
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add New Data Entry</a></li>
        <li class="active">Post Harvest Loss</li>
      </ol>
    </section>

   <section class="content">
    <div class="text-center">
     <?php $msg->display(); 
     ?>
      </div>
         <div class="box box-primary">
            <div class="box-header with-border">

            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">Post Harvest Loss</h3>
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
            <form id="myForm" action="crp_all_form_save.php" method="POST" class="form-horizontal">
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('hhi_for_PHL')?>">
                   <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                  <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                  <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                  <input type="hidden" name="long" value="" id="user_browser_long" required="true">
                  <input type="hidden" name="care_hhi" value="<?=$care_hhi?>" id="user_browser_long2" required="true">
                  <input type="hidden" name="care_hhi_slno" value="<?=$care_hhi_slno?>" id="user_browser_long" required="true">
                  <input type="hidden" name="type_ids" value="<?=$TYPE?>" required="true">
                

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
                    <label class="control-label col-sm-2" for="hhi" >HHI </label>
                    <div class="col-sm-10">
                     <input type="text" class="form-control" id="hhi" value="<?=$hhi_fetch['care_hhi_id']?>" readonly  name="hhi" placeholder="Enter HHI">
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
                      <input type="text" class="form-control" id="Year" value="<?=date('Y')?>" readonly placeholder="Enter Year" name="Year">
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
                  <li class="active"><a data-toggle="pill" href="#part1"><h4>Training provided in classroom setting</h4></a></li>
                  <li><a data-toggle="pill" href="#part2">Demonstration Provided</a></li>
                  <li><a data-toggle="pill" href="#part3">part 3</a></li>
                  <!-- <li><a data-toggle="pill" href="#part4">Part 4</a></li> -->
                </ul>
                
                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Training provided in classroom <br> ( If  Yes  skip to next col. )</th>
                          <th>Mention the subject matter </th>
                          <th>Male</th>
                          <th>Female</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><select class="form-control" name="classroom_Training_status" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <td><select class="form-control" name="subject_matter" required="">
                            <option value="1"> Improved Storing</option>
                            <option value="2">  FAQ & others on Pulse,Veg/Fruits/Grains</option>
                          </select></td>
                          <td><input class="form-control" type="number" min="0" name="classroom_male" required=""></td>
                          <td><input class="form-control" type="number" min="0" name="classroom_female" required=""></td>    
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
                          <th>Demonstration Provided <br> ( If  Yes  skip to next col. )</th>
                          <th>Mention the subject matter </th>
                          <!-- <th>Male</th>
                          <th>Female</th> -->
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><select class="form-control" name="Demonstration_Training_status" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <td><select class="form-control" name="Demonstration_subject_matter" required="">
                            <option value="1"> Improved Storing</option>
                            <option value="2">  FAQ & others on Pulse,Veg/Fruits/Grains</option>
                          </select></td>
                          <input type="hidden" name="Demonstration_male" value="1">
                          <input type="hidden" name="Demonstration_female" value="1">

                      <!--     <td><input class="form-control" type="number" min="0" name="Demonstration_male" required=""></td>
                          <td><input class="form-control" type="number" min="0" name="Demonstration_female" required=""></td>   -->
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
                    <!-- Moistermeter-1, Hermative bags-2, Tarpaulin sheet-3, other specify-4 -->
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Name of Inputs provided</th>
                          <th>Implement being used or not <br>( This  is only for implements)</th>
                          <th>Farmer parcticing the trained technique <br> ( This  is for all including outcome of training)</th>                
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><select class="form-control" name="Inputs_provided" required="">
                            <option value="">--Please Select--</option>
                            <option value="1"> Moistermeter</option>
                            <option value="2">  Hermative bags</option>
                            <option value="3">  Tarpaulin sheet</option>
                            <option value="4">other</option>
                          </select></td>
                           <td><select class="form-control" name="Implement" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                           <td><select class="form-control" name="Farmer" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          
                          
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
