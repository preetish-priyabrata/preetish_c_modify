<?php
session_start();
ob_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP TYPE";
  $care_slno=web_decryptIt(str_replace(" ", "+",$_GET['care_slno']));
 // $care_hhi_slno=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));
 
$get_kictch4="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_slno`='$care_slno'";
$sql_exe_get4=mysqli_query($conn,$get_kictch4);
$x_id=0;
$res_fetch4=mysqli_fetch_assoc($sql_exe_get4);
$months=$res_fetch4['care_CRP_month']; 
 $year=$res_fetch4['care_CRP_year'];
$care_hhi=$res_fetch4['care_hhid'];
$TYPE=$res_fetch4['care_form_type'];
 switch ($TYPE) {
   case '1':
   $type_insert='1';
    $name="Farmland";
     $type_item="Pulses/Legumes/Vegetables";
     break;
  case '2':
    $type_insert='2';
    $name="Kitchen Garden";
    $type_item="Vegetables/Fruits";
     break;
   
   default:
     # code...
     break;
 }
$get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' ";
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
        <li class="active">Crop Diversificatio<?=$care_slno?>  </li>
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
          
                    <form class="form-horizontal" id="myForm" >
                   
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
                  <br>
                  <br>
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="GP_name">GP Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_gp_name']?>" id="GP_name" name="GP_name" placeholder="Enter GP" readonly>
                    </div>
                  </div>
                   <br>
                  <br>
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
                   <br>
                  <br>
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
                   <br>
                  <br>
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Village">Village</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_village_name']?>" readonly  id="Village" placeholder="Enter Village" name="Village">
                    </div>
                  </div>
                  <br>
                  <br>
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year">Year</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Year" value="<?=date('Y')?>" readonly placeholder="Enter Year" name="Year">
                    </div>
                  </div>
                   <br>
                  <br>
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="women" > women farmer </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_women_farmer']?>" readonly  id="women" name="women" placeholder="Enter women farmer ">
                    </div>
                  </div>
                  <br>
                  <br>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Spouse" > Spouse Name </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Spouse" value="<?=$hhi_fetch['care_spouse_name']?>" readonly  name="Spouse" placeholder="Enter Spouse Name ">
                    </div>
                  </div>
                   <br>
                  <br>
                </div>
                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2">Part 2</a></li>
                  <li><a data-toggle="pill" href="#part3">part 3</a></li>
                  <li><a data-toggle="pill" href="#part4">Part 4</a></li>
                </ul>
                
                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Date OF CRP Entry</th>
                          <th>Type of <?=$type_item?></th>
                          <th>Area cultivated (Acre)</th>
                          <th>New Farmers</th>
                          <th>Demo Plot farmers</th>
                          <th>Continued farmers</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        <tr>
                         <td> <?=$res_fetch4['care_CRP_date']?></td>
                          <td><input class="form-control" type="text" name="type_crop" value="<?=$res_fetch4['care_pulses_type']?>" disabled required=""></td>
                          <td><input class="form-control" type="text" name="cultivated" value="<?=$res_fetch4['care_area_cultivated']?>" disabled required=""></td>
                          <td><select class="form-control" name="Farmers" disabled required="">
                            <option value="1"  <?php if($res_fetch4['care_continued_farmer']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res_fetch4['care_continued_farmer']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><select disabled class="form-control" name="Demo" required="">
                            <option value="1"  <?php if($res_fetch4['care_demo_plot_farmer']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res_fetch4['care_demo_plot_farmer']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><select disabled class="form-control" name="Continued" required="">
                            <option value="1"  <?php if($res_fetch4['care_continued_farmer']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res_fetch4['care_continued_farmer']==2){echo "selected";}?>>No</option>
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
                        
                          <td><select disabled class="form-control" name="Training" required="">
                             <option value="1"  <?php if($res_fetch4['care_IR_training']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res_fetch4['care_IR_training']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><select disabled class="form-control" name="Seed" required="">
                             <option value="1"  <?php if($res_fetch4['care_IR_seed']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res_fetch4['care_IR_seed']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><select disabled class="form-control" name="Fertiliser" required="">
                            <option value="1"  <?php if($res_fetch4['care_IR_fertiliser']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res_fetch4['care_IR_fertiliser']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><select disabled class="form-control" name="Pesticides" required="">
                             <option value="1"  <?php if($res_fetch4['care_IR_pesticides']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res_fetch4['care_IR_pesticides']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><select disabled class="form-control" name="Extension" required="">
                             <option value="1"  <?php if($res_fetch4['care_IR_extension_support']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res_fetch4['care_IR_extension_support']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><select disabled class="form-control" name="Others" required="">                           
                            <option value="1"  <?php if($res_fetch4['care_IR_other']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res_fetch4['care_IR_other']==2){echo "selected";}?>>No</option>
                          </select>
                          <br>
                          <input type="text" class="form-control" value="<?=$res_fetch4['care_CRP_other_detail']?>" disabled name="specify_Input">
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
                          
                          <th>Seed</th>
                          <th>Fertiliser</th>
                          <th>Pesticides</th>
                          <th>Others (Specify)</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                        <tr>
                          <td>
                            <input type="number" min="0" class="form-control" value="<?=$res_fetch4['care_QR_seed']?>" disabled name="Seed_qnty" required="">
                          </td>
                          <td>
                            <input type="number" min="0" class="form-control" value="<?=$res_fetch4['care_QR_fertiliser']?>" disabled  name="Fertiliser_qnty" required="">
                          </td>
                           <td>
                            <input type="number" min="0" class="form-control" value="<?=$res_fetch4['care_QR_pesticides']?>" disabled  name="Pesticides_qnty" required="">
                          </td>
                           <td>
                            <input type="number" min="0" class="form-control" value="<?=$res_fetch4['care_QR_other']?>" disabled  name="Others_qnty" required="">
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
                            <input type="text" class="form-control" name="Consumption"  value="<?=$res_fetch4['care_P_consumption']?>" disabled required="">
                          </td>
                          <td>
                            <input type="text" class="form-control" name="Sale"  value="<?=$res_fetch4['care_P_sale']?>" disabled required="">
                          </td>
                           <td>
                            <input type="text" class="form-control" name="Total"  value="<?=$res_fetch4['care_P_total_production']?>" disabled required="">
                          </td>
                           <td>
                            <input type="text" class="form-control" name="Average_price"  value="<?=$res_fetch4['care_avg_price']?>" disabled required="">
                          </td>
                         </tr>
                      </tbody>
                    </table>
                    
                    <br>
                  <ul class="pager">
                    
                  <li class="previous back"><a>Previous</a></li>
                  <!--  <li class="next"><?php $name="form7";
                      echo "<a target='_blank' href='download.php?name=".web_encryptIt($name)."&id=".web_encryptIt($care_slno)."&TYPE=".web_encryptIt($TYPE)."'>Click to download</a>"; //link to download file
                      ?></li> -->
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