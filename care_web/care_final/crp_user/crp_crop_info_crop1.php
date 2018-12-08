<?php
session_start();
ob_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP TYPE";
 $care_hhi=web_decryptIt(str_replace(" ", "+",$_GET['ID']));
 $care_hhi_slno=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));
 $TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));
 switch ($TYPE) {
   case '1':
   $type_insert='1';
    $name="Farmland";
     $type_item="Pulses/Legumes/Vegetables";
     break;
  case '4':
    $type_insert='2';
    $name="Kitchen Garden";
    $type_item="Vegetables/Fruits";
     break;
   
   default:
     # code...
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
        Crop Diversification  
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add New Data Entry</a></li>
        <li class="active">Crop Diversification  </li>
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
             <form action="crp_all_form_save.php" id="myForm"  method="POST" class="form-horizontal">
              <input type="hidden" name="form_type" value="<?=web_encryptIt('hhi_for_crop_discersity')?>">
              <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
              <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
              <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
              <input type="hidden" name="long" value="" id="user_browser_long" required="true">
              <input type="hidden" name="care_hhi" value="<?=$care_hhi?>" required="true">
              <input type="hidden" name="care_hhi_slno" value="<?=$care_hhi_slno?>"  required="true">
              <input type="hidden" name="type_insert" value="<?=$type_insert?>"  required="true">

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
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_block_name']?>" readonly  id="Block" placeholder="Enter Block" name="Block">
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
                  <li><a data-toggle="pill" href="#part2">Input Received</a></li>
                  <li><a data-toggle="pill" href="#part3">Quantity Received</a></li>
                  <li><a data-toggle="pill" href="#part4">Production</a></li>
                </ul>
                
                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Type of <?=$type_item?></th>
                          <th>Area cultivated (Sq.ft)</th>
                          <th>New Farmers</th>
                          <th>Demo Plot farmers</th>
                          <th>Continued farmers</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <select class="form-control" name="type_crop"  required="">
                               <?php 
                                $get_training="SELECT * FROM `care_master_pulse` ";
                                $sql_exe_training=mysqli_query($conn,$get_training);
                                while ($training_fetch=mysqli_fetch_assoc($sql_exe_training)) {
                                  ?>
                                   <option value="<?=$training_fetch['item_crop']?>"><?=$training_fetch['item_crop']?></option>
                                  
                                  <?php
                                }
                                ?>                              
                            </select>

                            <!-- <input class="form-control" type="text" name="type_crop"  required=""> -->
                          </td>
                          <td><input class="form-control" type="text" name="cultivated" value="0" required=""></td>
                          <td><select class="form-control" name="Farmers" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <td><select class="form-control" name="Demo" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <td><select class="form-control" name="Continued" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
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
                          <th>Training</th>
                          <th>Seed</th>
                          <th>Fertiliser</th>
                          <th>Pesticides</th>
                          <th>Extension Support</th>
                          <th>Others (Specify)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><select class="form-control" name="Training" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <td><select class="form-control" name="Seed" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <td><select class="form-control" name="Fertiliser" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <td><select class="form-control" name="Pesticides" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <td><select class="form-control" name="Extension" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <td><select class="form-control" name="Others" required="">                           
                            <option value="2">No</option>
                             <option value="1">Yes</option>
                          </select>
                          <br>
                          <input type="text" class="form-control" name="specify_Input">
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
                          
                          <th>Seed (in kg/lit/ml)</th>
                          <th>Fertiliser (in kg/lit/ml)</th>
                          <th>Pesticides (in kg/lit/ml)</th>
                          <th>Others (Specify) (in kg/lit/ml)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <input type="number" min="0" class="form-control" value="0" name="Seed_qnty" required="">
                          </td>
                          <td>
                            <input type="number" min="0" class="form-control" value="0"  name="Fertiliser_qnty" required="">
                          </td>
                           <td>
                            <input type="number" min="0" class="form-control" value="0"  name="Pesticides_qnty" required="">
                          </td>
                           <td>
                            <input type="number" min="0" class="form-control" value="0"  name="Others_qnty" required="">
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
                  <div id="part4" class="tab-pane fade">
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          
                          <th>Production<br>Consumption</th>
                          <th>Production<br>Sale</th>
                          <th>Production<br>Total Produciton</th>
                    
                          <th>Production <br>Average price(Rs/Kg)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <input type="text" class="form-control" name="Consumption" value="0" required="">
                          </td>
                          <td>
                            <input type="text" class="form-control" name="Sale" value="0" required="">
                          </td>
                           <td>
                            <input type="text" class="form-control" name="Total" value="0" required="">
                          </td>
                           <td>
                            <input type="text" class="form-control" name="Average_price" value="0" required="">
                          </td>
                          
                        </tr>
                      </tbody>
                    </table>
                    
                    <br>
                  <ul class="pager">
                    
                   <li class="previous back"><a>Previous</a></li>
                   <li class="next pull-right" ><button type="submit" class="btn" >Save</button></li>
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
