<?php
// print_r($_GET);
// exit;
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
 $care_hhi=web_decryptIt(str_replace(" ", "+",$_GET['ID']));
 $months=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));
 $TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));
 $year=web_decryptIt(str_replace(" ", "+",$_GET['year']));
 $village=web_decryptIt(str_replace(" ", "+",$_GET['village']));

 $form_uses_id=web_decryptIt(str_replace(" ", "+",$_GET['form_uses_id']));
 // Array ( [ID] => LFao7iukYbKLQDXvOnSsBhUmQNtWeOM2gEk1Sb0IaNo= [TOKEN_ID] => WADuJmcX3b5zLsOHAjME0m3nZ6FCpACkKVquIxI/j0Y= [TYPE] => TVGhMhqJNCoOSLGbQDiJe2LsbLRlyK eZ6vABEMsEZg= [year] => whLZpPsds9Ze12kSi1rWLPEKrSyToY9H/mzGjSgQKBY= [village] => GopWP6U1Y8S6cryIsnWb1WIiIQ9o3CjIq93aCLYylLE= )
switch ($TYPE) {
  case '1':
    $form_type="form3";
    $name="Goatery";
     break;
  case '2':
    $form_type="form4";
    $name="Dairy";
     break;
  case '3':
    $form_type="form5";
    $name="Poultry";
     break;
   
   default:
      // header('Location:logout.php');
      // exit; 
     break;
}
$get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' ";
$sql_exe_get=mysqli_query($conn,$get_hhi);
$hhi_fetch=mysqli_fetch_assoc($sql_exe_get);
$get_life_stock1="SELECT * FROM `care_master_MTF_livestock_TARINA_meo` WHERE `livestock`='$TYPE' and `care_LS_hhid`='$care_hhi' and `care_LS_month`='$months' and `care_LS_year`='$year'";
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
        Livestock
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add New Data Entry</a></li>
        <li class="active">Livestock</li>
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

              <h3 class="box-title"> Livestock of <?=$name?> Form</h3>
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
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('hhi_for_livestock')?>">
                  <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                  <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                  <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                  <input type="hidden" name="long" value="" id="user_browser_long" required="true">
                  <input type="hidden" name="care_hhi" value="<?=$care_hhi?>" id="user_browser_long2" required="true">
                  <input type="hidden" name="month"  value="<?=$months?>">
                  <input type="hidden" name="care_hhi_slno" value="<?=$care_hhi_slno?>" id="user_browser_long" required="true">
                  <input type="hidden" name="type_ids" value="<?=$TYPE?>" required="true">
                
                    <input  type="hidden" name="form_type_new" value="<?=web_encryptIt('CBO_comment')?>">
                    <input  type="hidden" name="form_type_id" value="<?=web_encryptIt($form_type)?>">
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
                  <div id="part1" class="setup-content tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1" >
                      <thead>
                        <tr>
                          <th>User Type</th>
                          <th>Training</th>
                          <th>Extension Support</th>
                          <th>No of anaimals<br> received extension</th>
                          <th>Medicine </th>
                          <th>No of animals <br> received medicine</th>
                          <th>Vaccination</th>
                          <th>No of animals <br> received vaccination</th>
                          <th>Others(specifiy)</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $get_life_stock1="SELECT * FROM `care_master_MTF_livestock_TARINA_meo` WHERE `livestock`='$TYPE' and `care_LS_hhid`='$care_hhi' and `care_LS_month`='$months' and `care_LS_year`='$year' and care_LS_mt_comment_status='1' and `care_LS_CBO_comment_status`='1' and `care_LS_MEO_status`='1'";
                         $sql_phl_table1=mysqli_query($conn,$get_life_stock1);
                          while ($fetch_table1=mysqli_fetch_assoc($sql_phl_table1)) { 

                            ?>
                           <input  value="<?=web_encryptIt($fetch_table1['care_LS_slno'])?>" type="hidden" class="form-control" name="form_type_id_div[]" required="">
                        <tr>
                          <td>CRP Input</td>
                          <td>
                          <select disabled class="form-control " name="type_input_training" required="" style="width: 70px;">
                            <option value="1"  <?php if($fetch_table1['care_LS_IP_training']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table1['care_LS_IP_training']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <!-- training -->
                          <td>
                            <select disabled class="form-control" name="get_id1" onchange="get_change(1)" id="get_id1" required="">
                            <option value="1"  <?php if($fetch_table1['care_LS_IP_extension_support']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table1['care_LS_IP_extension_support']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <!-- extension support -->
                          <td>
                            <input disabled class="form-control input-sm" value="<?=$fetch_table1['care_LS_ES_no_of_animal']?>" type="number" placeholder="No of animals  received extension" id="get_id_no1" name="get_id_no1" required="" min="0" value="0"></td>
                          <!-- no of extenston support -->
                          <td>
                            <select disabled class="form-control" name="get_id2" onchange="get_change(2)" id="get_id2" required=""  style="width: 70px";>
                             <option value="1"  <?php if($fetch_table1['care_LS_IP_medicine']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table1['care_LS_IP_medicine']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <!-- medicine  -->
                          <td>
                            <input class="form-control input-sm" value="<?=$fetch_table1['care_LS_Med_no_of_animal']?>" disabled placeholder="No of animals  received medicine" type="number" id="get_id_no2" name="get_id_no2" required="" min="0" value="0"></td>
                          <!-- no of medice used -->
                          <td><select disabled class="form-control" name="get_id3"   onchange="get_change(3)" id="get_id3" required="">
                             <option value="1"  <?php if($fetch_table1['care_LS_IP_vaccination']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table1['care_LS_IP_vaccination']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <!-- vaccination  -->
                          <td><input  class="form-control input-sm" value="<?=$fetch_table1['care_LS_VN_no_of_animal']?>" disabled placeholder="No of animals  received vaccination" type="number" id="get_id_no3" name="get_id_no3" required="" min="0" value="0"></td>
                          <td><select disabled="" class="form-control"  onchange="get_change(4)" id="get_id4" name="get_id4" required="">                            
                             <option value="1"  <?php if($fetch_table1['care_LS_IP_others']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table1['care_LS_IP_others']==2){echo "selected";}?>>No</option>
                          </select>
                          <br>
                          <?php if($fetch_table1['care_LS_IP_others']==1){?>
                          <input class="form-control input-sm" value="<?=$fetch_table1['care_LS_IP_others_specify']?>" disabled type="text" id="get_id_no4" placeholder="Others(specifiy)" name="get_id_no4" required="">
                          <?php }?>
                        </td>
                        <td>
                          <!-- other -->
                           <?php if($fetch_table1['care_LS_IP_others']==1){?>
                          <input class="form-control input-sm" value="<?=$fetch_table1['care_LS_other_no_of_animal']?>" disabled min="0" value="0" type="number" id="get_id_no5" name="get_id_no5" placeholder="Others(specifiy) Quanty" required="">
                          <?php }?>
                        </td>

 
                        </tr>

                         <tr>
                           <td>MEO Input</td>
                           <?php if($fetch_table1['care_LS_IP_training_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <select  class="form-control " name="care_LS_IP_training[]" required="" style="width: 70px;">
                            <option value="1"  <?php if($fetch_table1['care_LS_IP_training_edit']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table1['care_LS_IP_training_edit']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <!-- training -->
                          <?php if($fetch_table1['care_LS_IP_extension_support_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <select  class="form-control" name="care_LS_IP_extension_support[]" onchange="get_change(1)" id="get_id1" required="">
                            <option value="1"  <?php if($fetch_table1['care_LS_IP_extension_support_edit']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table1['care_LS_IP_extension_support_edit']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <!-- extension support -->
                          <?php if($fetch_table1['care_LS_ES_no_of_animal_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <input  class="form-control input-sm" value="<?=$fetch_table1['care_LS_ES_no_of_animal_edit']?>" type="number" placeholder="No of animals  received extension" id="get_id_no1" name="care_LS_ES_no_of_animal[]" required="" min="0" value="0"></td>
                          <!-- no of extenston support -->
                           <?php if($fetch_table1['care_LS_IP_medicine_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <select  class="form-control" name="care_LS_IP_medicine[]" onchange="get_change(2)" id="get_id2" required=""  style="width: 70px";>
                             <option value="1"  <?php if($fetch_table1['care_LS_IP_medicine_edit']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table1['care_LS_IP_medicine_edit']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <!-- medicine  -->
                          <?php if($fetch_table1['care_LS_Med_no_of_animal_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <input class="form-control input-sm" value="<?=$fetch_table1['care_LS_Med_no_of_animal_edit']?>"  placeholder="No of animals  received medicine" type="number" id="get_id_no2" name="care_LS_Med_no_of_animal[]" required="" min="0" value="0"></td>
                          <!-- no of medice used care_LS_IP_vaccination_status-->
                           <?php if($fetch_table1['care_LS_IP_vaccination_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <select  class="form-control" name="care_LS_IP_vaccination[]"   onchange="get_change(3)" id="get_id3" required="">
                             <option value="1"  <?php if($fetch_table1['care_LS_IP_vaccination_edit']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table1['care_LS_IP_vaccination_edit']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <!-- vaccination  -->
                         <?php if($fetch_table1['care_LS_VN_no_of_animal_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <input  class="form-control input-sm" value="<?=$fetch_table1['care_LS_VN_no_of_animal_edit']?>"  placeholder="No of animals  received vaccination" type="number" id="get_id_no3" name="care_LS_VN_no_of_animal[]" required="" min="0" value="0"></td>
                          <?php if($fetch_table1['care_LS_IP_others_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <select class="form-control"  onchange="get_change(4)" id="get_id4" name="care_LS_IP_others[]" required="">                            
                             <option value="1"  <?php if($fetch_table1['care_LS_IP_others_edit']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table1['care_LS_IP_others_edit']==2){echo "selected";}?>>No</option>
                          </select>
                          <br>
                          <?php if($fetch_table1['care_LS_IP_others_edit']==1){?> 
                          <?php if($fetch_table1['care_LS_IP_others_specify_status']==2){?>

                            <input style="border:1px solid red;" class="form-control input-sm" value="<?=$fetch_table1['care_LS_IP_others_specify_edit']?>"  type="text" id="care_LS_IP_others_specify[]" placeholder="Others(specifiy)" name="get_id_no4[]" required="">
                            <?php }else{
                              ?> 
                              <input class="form-control input-sm" value="<?=$fetch_table1['care_LS_IP_others_specify_edit']?>"  type="text" id="care_LS_IP_others_specify[]" placeholder="Others(specifiy)" name="get_id_no4[]" required="">
                              <?php
                            }
                            ?>
                          
                          <?php }else{
                            ?>
                             <input class="form-control input-sm" value="<?=$fetch_table1['care_LS_IP_others_specify_edit']?>"  type="hidden" id="care_LS_IP_others_specify" placeholder="Others(specifiy)" name="care_LS_IP_others_specify[]" required="">
                            <?php 
                          }?>
                        </td>
                        <td>
                          <!-- other -->
                           <?php if($fetch_table1['care_LS_IP_others_edit']==1){?>
                            <?php if($fetch_table1['care_LS_other_no_of_animal_status']==2){?>
                          <input  style="border:1px solid red;" class="form-control input-sm" value="<?=$fetch_table1['care_LS_other_no_of_animal_edit']?>"  min="0" value="0" type="number" id="get_id_no5" name="get_id_no5[]" placeholder="Others(specifiy) Quanty" required="">
                           <?php }else{?>
                            <input class="form-control input-sm" value="<?=$fetch_table1['care_LS_other_no_of_animal_edit']?>"  min="0" value="0" type="number" id="get_id_no5" name="get_id_no5[]" placeholder="Others(specifiy) Quanty" required="">
                            <?php
                            }
                            ?>
                          <?php }else{
                            ?>
                            <input class="form-control input-sm" value="<?=$fetch_table1['care_LS_other_no_of_animal_edit']?>"  min="0" value="0" type="hidden" id="care_LS_other_no_of_animal" name="care_LS_other_no_of_animal[]" placeholder="Others(specifiy) Quanty" required="">
                            <?php }?>
                        </td>

 
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
                          <th>Total No. of animal/bird <br> currently present in HHID</th>
                          <th>Are you cultivating Fodder? </th>
                          <th>Area cultivated under <br> Fodder (in sqft)</th>
                          <th>New Farmers</th>
                          <th>Continued farmers</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           $get_life_stoc="SELECT * FROM `care_master_MTF_livestock_TARINA_meo` WHERE `livestock`='$TYPE' and `care_LS_hhid`='$care_hhi' and `care_LS_month`='$months' and `care_LS_year`='$year' and care_LS_mt_comment_status='1' and `care_LS_CBO_comment_status`='1' and `care_LS_MEO_status`='1'";
                          $sql_liveexe=mysqli_query($conn,$get_life_stoc);
                          // $sql_ls_table2=mysqli_query($conn,$get_life_stoc);
                           while ($fetch_table2=mysqli_fetch_assoc($sql_liveexe)) { 


                          ?>
                          <tr>
                          <td>
                          <label for="Total_animal"></label>
                          <input class="form-control"  value="<?=$fetch_table2['care_LS_total_animal']?>" disabled type="number" name="Total_animal" required=""></td>
                         <td><select disabled class="form-control" name="Cultivating_fodder_status" required="">
                          <option value="1"  <?php if($fetch_table2['care_LS_cultivating_fodder']==1){echo "selected";}?>>Yes</option>
                          <option value="2" <?php if($fetch_table2['care_LS_cultivating_fodder']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><input class="form-control"  value="<?=$fetch_table2['care_LS_cultivated_area']?>" disabled type="text" name="cultivated_area" required=""></td>
                          <td><select disabled class="form-control" name="Farmers_new" required="">
                             <option value="1"  <?php if($fetch_table2['care_LS_new_farmer']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table2['care_LS_new_farmer']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <td><select disabled class="form-control" name="farmers_cont" required="">
                             <option value="1"  <?php if($fetch_table2['care_LS_continued_farmer']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table2['care_LS_continued_farmer']==2){echo "selected";}?>>No</option>
                          </select></td>                  
                        </tr>
                        
                        <tr>

                          <?php if($fetch_table2['care_LS_total_animal_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                          <label for="Total_animal"></label>
                          <input class="form-control"  value="<?=$fetch_table2['care_LS_total_animal_edit']?>"  type="number" name="care_LS_total_animal[]" required=""></td>
                         <?php if($fetch_table2['care_LS_cultivating_fodder_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                          <select  class="form-control" name="care_LS_cultivating_fodder[]" required="">
                          <option value="1"  <?php if($fetch_table2['care_LS_cultivating_fodder_edit']==1){echo "selected";}?>>Yes</option>
                          <option value="2" <?php if($fetch_table2['care_LS_cultivating_fodder_edit']==2){echo "selected";}?>>No</option>
                          </select></td>
                         <?php if($fetch_table2['care_LS_cultivated_area_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <input class="form-control"  value="<?=$fetch_table2['care_LS_cultivated_area_edit']?>"  type="text" name="care_LS_cultivated_area[]" required=""></td>
                          <?php if($fetch_table2['care_LS_new_farmer_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>

                            <select  class="form-control" name="care_LS_new_farmer[]" required="">
                             <option value="1"  <?php if($fetch_table2['care_LS_new_farmer_edit']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table2['care_LS_new_farmer_edit']==2){echo "selected";}?>>No</option>
                          </select></td>
                          <?php if($fetch_table2['care_LS_continued_farmer_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>                            
                            <select  class="form-control" name="care_LS_continued_farmer[]" required="">
                             <option value="1"  <?php if($fetch_table2['care_LS_continued_farmer_edit']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($fetch_table2['care_LS_continued_farmer_edit']==2){echo "selected";}?>>No</option>
                          </select></td>                  
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
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Quantity provided<br>Extension Support (No.)</th>
                          <th>Quantity provided<br>Medicine</th>
                          <th>Quantity provided<br> Vaccination</th>
                          <th>Quantity provided<br> Others (Specify)</th>
                          <th>Comments OF MT</th>
                          <th>Comment Of CBO </th>                 
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $get_life_stock3="SELECT * FROM `care_master_MTF_livestock_TARINA_meo` WHERE `livestock`='$TYPE' and `care_LS_hhid`='$care_hhi' and `care_LS_month`='$months' and `care_LS_year`='$year' and care_LS_mt_comment_status='1' and `care_LS_CBO_comment_status`='1' and `care_LS_MEO_status`='1'";
                         $sql_phl_table3=mysqli_query($conn,$get_life_stock3);
                          $x_id=0;
                          while ($fetch_table3=mysqli_fetch_assoc($sql_phl_table3)) { 
                            $care_LS_slno=$fetch_table3['care_serial_id'];
                            ?>
                          <!-- crp -->
                        <tr>
                          <td>
                            <input class="form-control" value="<?=$fetch_table3['care_LS_QP_extension_support']?>" disabled type="text" name="Extension_qnty" required=""></td>
                          <td>
                            <table id="myTable" class=" table order-list-Medicine">
                              <thead>
                                <tr>
                                  <td>Medicine Name</td>
                                  <td>Medicine Quantity</td>                                  
                                </tr>
                                </thead>
                                <tbody>                                  
                                  <?php 
                                  
                                  $get_med1="SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_QP_livestock_slno`='$care_LS_slno' and`care_QP_type`='1'";
                                     $sql_med_table1=mysqli_query($conn,$get_med1);
                                   while ($fetch_med1=mysqli_fetch_assoc($sql_med_table1)) {?>
                                    <tr>
                                        <td class="col-sm-4">
                                            <input disabled type="text" value="<?=$fetch_med1['care_QP_item_name']?>" name="Medicine_name" id="Medicine_name" class="form-control" />
                                        </td>
                                        <td class="col-sm-4">
                                            <input disabled type="mail" value="<?=$fetch_med1['care_QP_quantity']?>" name="Medicine_qnty" id="Medicine_qnty"  class="form-control"/>
                                        </td>                                        
                                        <!-- // <td class="col-sm-2"><a class="deleteRow-Medicine"></a> -->

                                        
                                    </tr>
                                    
                                    <?php }?>
                                </tbody>
                            
                            </table>
                          </td>
                          <td>
                            <table id="myTable" class=" table order-list-Vaccination">
                                <thead>
                                    <tr>
                                        <td>Vaccination Name</td>
                                        <td>Vaccination Quantity</td>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                   $get_med2="SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_QP_livestock_slno`='$care_LS_slno' and`care_QP_type`='2'";
                                     $sql_med_table2=mysqli_query($conn,$get_med2);
                                   while ($fetch_med2=mysqli_fetch_assoc($sql_med_table2)) {?>
                                    <tr>
                                        <td class="col-sm-4">
                                            <input type="text" name="Vaccination_name[]" value="<?=$fetch_med2['care_QP_item_name']?>" disabled id="Vaccination_name" class="form-control" />
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="mail" name="Vaccination_qnty[]" value="<?=$fetch_med2['care_QP_quantity']?>" disabled id="Vaccination_qnty_edit"  class="form-control"/>
                                        </td>                                        
                                        <!-- <td class="col-sm-2"><a class="deleteRow-Vaccination"></a> -->
                                   
                                       
                                    </tr>
                                       
                                        
                                     <?php }?>
                                </tbody>
                             
                            </table>
                          </td>
                          <td>
                            <table id="myTable" class=" table order-list-Others">
                                <thead>
                                    <tr>
                                        <td>Others Name</td>
                                        <td>Others Quantity</td> 
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                   $get_med3="SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_QP_livestock_slno`='$care_LS_slno' and`care_QP_type`='3' ";
                                     $sql_med_table3=mysqli_query($conn,$get_med3);
                                   while ($fetch_med3=mysqli_fetch_assoc($sql_med_table3)) {?>
                                    <tr>
                                        <td class="col-sm-4">
                                            <input type="text" name="Others_name[]" value="<?=$fetch_med3['care_QP_item_name']?>" disabled id="Others_name" class="form-control" />
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="mail" value="<?=$fetch_med3['care_QP_quantity']?>" disabled  name="Others_qnty[]" id="Others_qnty"  class="form-control"/>
                                        </td>                                        
                                        <!-- <td class="col-sm-2"><a class="deleteRow-Others"></a> -->

                                       
                                    </tr>
                                    <?php }?>
                                </tbody>
                                
                            </table>
                          </td> 
                          <td>
                            <?php 
                            if($fetch_table3['care_LS_mt_comment_status']=='0'){
                             echo "N/A";
                            }else{?>                              
                              <textarea readonly="" class="form-control"><?=$fetch_table3['care_LS_mt_comment_empty']?></textarea>

                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>
                          <td>
                            <?php 
                            if($fetch_table3['care_LS_CBO_comment_status']=='0'){
                              echo "N/A";
                            }else{?>
                              
                              <textarea readonly=""  type="text" class="form-control" required=""><?=$fetch_table3['care_LS_CBO_comment_empty']?></textarea>

                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>

                        </tr>
                          <!-- meo -->
                         <tr>
                           <?php if($fetch_table3['care_LS_QP_extension_support_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?> 
                            <input class="form-control" value="<?=$fetch_table3['care_LS_QP_extension_support_edit']?>"  type="text" name="care_LS_QP_extension_support[]" required=""></td>
                          <td>
                               <table id="myTable" class=" table order-list-Medicine">
                                <thead>
                                    <tr>
                                      
                                        <td>Medicine Name</td>
                                        <td>Medicine Quantity</td>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  <!-- care_LS_slno -->
                                  <?php 
                                  
                                  $get_med12="SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_QP_livestock_slno`='$care_LS_slno' and`care_QP_type`='1'";
                                     $sql_med_table12=mysqli_query($conn,$get_med12);
                                   while ($fetch_med12=mysqli_fetch_assoc($sql_med_table12)) {?>
                                    <tr>
                                    <?php if($fetch_med12['care_QP_item_name_status']==2){?>
                                          <td class="col-sm-4" style=" border: 5px solid red;">
                                            <?php }else{
                                              ?>
                                              <td class="col-sm-4">
                                              <?php
                                            }
                                            ?> 
                                                     
                                            <input  disabled="" type="text" value="<?=$fetch_med12['care_QP_item_name_edit']?>" name="care_QP_item_name[]" id="Medicine_name" class="form-control" />
                                        </td>
                                        <?php if($fetch_med12['care_QP_quantity_status']==2){?>
                                          <td class="col-sm-4" style=" border: 5px solid red;">
                                            <?php }else{
                                              ?>
                                              <td class="col-sm-4">
                                              <?php
                                            }
                                            ?>
                                            <input  disabled="" type="mail" value="<?=$fetch_med12['care_QP_quantity_edit']?>" name="care_QP_quantity[]" id="Medicine_qnty"  class="form-control"/>
                                        </td>                                        
                                        <!-- // <td class="col-sm-2"><a class="deleteRow-Medicine"></a> -->

                                    </tr>
                                      
                                    <?php }?>
                                </tbody>
                               
                            </table>
                          </td>
                          <td>
                            <table id="myTable" class=" table order-list-Vaccination">
                                <thead>
                                    <tr>
                                        <td>Vaccination Name</td>
                                        <td>Vaccination Quantity</td>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                   $get_med21="SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_QP_livestock_slno`='$care_LS_slno' and`care_QP_type`='2'";
                                     $sql_med_table21=mysqli_query($conn,$get_med21);
                                   while ($fetch_med21=mysqli_fetch_assoc($sql_med_table21)) {?>
                                    <tr>
                                      <input type="hidden" name="care_QP_slno[]" value="<?=$fetch_med21['care_QP_slno']?>">
                                       <input type="hidden" name="care_QP_type[]" value="<?=$fetch_med21['care_QP_type']?>">
                                        <?php if($fetch_med21['care_QP_item_name_status']==2){?>
                                          <td class="col-sm-4" style=" border: 5px solid red;">
                                            <?php }else{
                                              ?>
                                              <td class="col-sm-4">
                                              <?php
                                            }
                                            ?> 
                                            <input disabled="" type="text" name="care_QP_item_name[]" value="<?=$fetch_med21['care_QP_item_name_edit']?>" id="Vaccination_name" class="form-control" />
                                        </td>
                                        <?php if($fetch_med21['care_QP_quantity_status']==2){?>
                                          <td class="col-sm-4" style=" border: 5px solid red;">
                                            <?php }else{
                                              ?>
                                              <td class="col-sm-4">
                                              <?php
                                            }
                                            ?>
                                            <input disabled="" type="mail" name="care_QP_quantity[]" value="<?=$fetch_med21['care_QP_quantity_edit']?>" id="Vaccination_qnty"  class="form-control"/>
                                        </td>                                        
                                        <!-- <td class="col-sm-2"><a class="deleteRow-Vaccination"></a> -->
                                      
                                       
                                    </tr>
                                      
                                     <?php }?>
                                </tbody>
                               
                            </table>
                          </td>
                          <td>
                            <table id="myTable" class=" table order-list-Others">
                                <thead>
                                    <tr>
                                        <td>Others Name</td>
                                        <td>Others Quantity</td> 
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                   $get_med31="SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_QP_livestock_slno`='$care_LS_slno' and`care_QP_type`='3' ";
                                     $sql_med_table31=mysqli_query($conn,$get_med31);
                                   while ($fetch_med31=mysqli_fetch_assoc($sql_med_table31)) {?>
                                    <tr>
                                      <input type="hidden" name="care_QP_slno[]" value="<?=$fetch_med31['care_QP_slno']?>">
                                       <input type="hidden" name="care_QP_type[]" value="<?=$fetch_med31['care_QP_type']?>">
                                        <?php if($fetch_med31['care_QP_item_name_status']==2){?>
                                          <td class="col-sm-4" style=" border: 5px solid red;">
                                            <?php }else{
                                              ?>
                                              <td class="col-sm-4">
                                              <?php
                                            }
                                            ?>
                                            <input disabled="" type="text" name="care_QP_item_name[]" value="<?=$fetch_med31['care_QP_item_name_edit']?>"  id="Others_name" class="form-control" />
                                        </td>
                                        <?php if($fetch_med31['care_QP_quantity_status']==2){?>
                                          <td class="col-sm-4" style=" border: 5px solid red;">
                                            <?php }else{
                                              ?>
                                              <td class="col-sm-4">
                                              <?php
                                            }
                                            ?>
                                            <input disabled type="mail" value="<?=$fetch_med31['care_QP_quantity_edit']?>"   name="care_QP_quantity[]" id="Others_qnty"  class="form-control"/>
                                        </td>                                        
                                        <!-- <td class="col-sm-2"><a class="deleteRow-Others"></a> -->

                                        </td>
                                    </tr>
                                     
                                    <?php }?>
                                </tbody>
                              
                            </table>
                          </td> 
                          <td>
                            <?php 
                            if($fetch_table3['care_LS_mt_comment_status']=='0'){
                             echo "N/A";
                            }else{?>                              
                              <textarea readonly="" class="form-control"><?=$fetch_table3['care_LS_mt_comment_empty']?></textarea>

                               <span id="error<?=$x_id?>" style="color: red"></span>
                            <?php }?>

                          </td>
                          <td>
                            <?php 
                            if($fetch_table3['care_LS_CBO_comment_status']=='0'){

                              echo "N/A";
                             }else{?>
                              
                              <textarea readonly=""  type="text" class="form-control" ><?=$fetch_table3['care_LS_CBO_comment_empty']?></textarea>

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
                    ?><li class="next pull-right" ><input onclick="return confirm('Are you sure want to submit Comments on this?');" type="submit" name="save" value="save"></li>
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
<script type="text/javascript">
   
     $(document).ready(function(){
    
        
        // $('#get_id_no4').hide();
        // $('#get_id_no5').hide();
        //  $('input[name=get_id_no5').prop('required',false);
        //       $('input[name=get_id_no4').prop('required',false);
    });  
    function get_change(id) {
      // alert(id);
      var get_ids=$('#get_id'+id).val();

          if(id==4){
            if(get_ids=='1'){
              $('#get_id_no4').show();
               $('#get_id_no5').show();
              
              $('input[name=get_id_no4').prop('required',true);
              $('input[name=get_id_no5').prop('required',true);
            }else{
              $('#get_id_no4').hide();
               $('#get_id_no5').hide();
              
              $('input[name=get_id_no4').prop('required',false);
              $('input[name=get_id_no5').prop('required',false);
            }
          }else{
            if(get_ids=='1'){
               $('#get_id_no'+id).show();
              $("input[name=get_id_no"+id).prop('required',true);
            }else{
             
              $('#get_id_no'+id).hide();
              $('input[name=get_id_no'+id).prop('required',false);
            }

          }
    }    
</script>
<script type="text/javascript">
    $(document).ready(function () {
    var counter = 0;

    $("#addrow-Medicine").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="Medicine_name[]" id="Medicine_name' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="Medicine_qnty" id="Medicine_qnty' + counter + '"/></td>';
        

        cols += '<td><input type="button" class="ibtnDel-Medicine btn btn-xs btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-Medicine").append(newRow);
        counter++;
    });



    $("table.order-list-Medicine").on("click", ".ibtnDel-Medicine", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});
     $(document).ready(function () {
    var counters = 0;

    $("#addrow-Vaccination").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="Vaccination_name[]" id="Vaccination_name' + counters + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="Vaccination_qnty" id="Vaccination_qnty' + counters + '"/></td>';
        

        cols += '<td><input type="button" class="ibtnDel-Vaccination btn btn-xs btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-Vaccination").append(newRow);
        counters++;
    });



    $("table.order-list-Vaccination").on("click", ".ibtnDel-Vaccination", function (event) {
        $(this).closest("tr").remove();       
        counters -= 1
    });


});
     $(document).ready(function () {
    var counter = 0;

    $("#addrow-Others").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="Others_name[]" id="Others_name' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="Others_qnty" id="Others_qnty' + counter + '"/></td>';
        

        cols += '<td><input type="button" class="ibtnDel-Others btn btn-xs btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-Others").append(newRow);
        counter++;
    });



    $("table.order-list-Others").on("click", ".ibtnDel-Others", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});
 //     $("#myform").validate({
 //  submitHandler: function(form) {
 //    // some other code
 //    // maybe disabling submit button
 //    // then:
 //    $(form).submit();
 //  }
 // });
//  jQuery.validator.setDefaults({
//   debug: true,
//   success: "valid"
// });
// var form = $( "#myform" );
// form.validate();
// $( "button" ).click(function() {
//   alert( "Valid: " + form.valid() );
// });

     // var validator = $("#myForm").validate();
      
</script>