<?php
// 
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $care_hhi=web_decryptIt(str_replace(" ", "+",$_GET['ID']));
 $months=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));
 $year=web_decryptIt(str_replace(" ", "+",$_GET['year']));
$TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));
 switch ($TYPE) {
   case '1':
   $type_insert='1';
   $form_type="form7";
    $name="Farmland";
    $type_item="Pulses/Legumes/Vegetables";
     break;
  case '4':
  $form_type="form8";
    $type_insert='2';
     $type_item="Vegetables/Fruits";
    $name="Kitchen Garden";
     break;
   
   default:
     # code...
     break;
 }
 
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
 
 $title="View Crop Diversification OF ".$name."  After Meo Edit For HHI :-".$care_hhi." For Month/year ".$x_month."/".$year;
 $village=web_decryptIt(str_replace(" ", "+",$_GET['village']));
 $form_uses_id=web_decryptIt(str_replace(" ", "+",$_GET['form_uses_id']));
 // Array ( [ID] => LFao7iukYbKLQDXvOnSsBhUmQNtWeOM2gEk1Sb0IaNo= [TOKEN_ID] => WADuJmcX3b5zLsOHAjME0m3nZ6FCpACkKVquIxI/j0Y= [TYPE] => TVGhMhqJNCoOSLGbQDiJe2LsbLRlyK eZ6vABEMsEZg= [year] => whLZpPsds9Ze12kSi1rWLPEKrSyToY9H/mzGjSgQKBY= [village] => GopWP6U1Y8S6cryIsnWb1WIiIQ9o3CjIq93aCLYylLE= )
 
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
                  <input  type="hidden" name="form_type_id" value="<?=web_encryptIt($form_type)?>">
                  <input type="hidden" name="form_type_user" value="<?=web_encryptIt($months)?>">
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
                 <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2"><h4>Input Received(During the month)</h4></a></li>
                  <li><a data-toggle="pill" href="#part3"><h4>Quantity Received(in kg/lit/ml)</h4></a></li>
                  <li><a data-toggle="pill" href="#part4">Production</a></li>
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
                          <th>Date OF CRP Entry</th>
                          <th>Type of <?=$type_item?></th>
                          <th>Area cultivated (sqft)</th>
                          <th>New Farmers</th>
                          <th>Demo Plot farmers</th>
                          <th>Continued farmers</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                           $get_kictch1="SELECT * FROM `care_master_crop_diversification_crp_meo` WHERE `care_type_farm`='$TYPE' and `care_form_type`='$type_insert' and `care_hhid`='$care_hhi' AND `care_CRP_month`='$months' AND `care_CRP_year`='$year' AND `care_crop_div_mt_id_status`='1' and `care_crop_div_CBO_comment_status`='1' and `care_crop_div_MEO_status`='1'";
                          $sql_exe_get1=mysqli_query($conn,$get_kictch1);
                          while ($res_fetch=mysqli_fetch_assoc($sql_exe_get1)) {   
                        ?>
                        <input  value="<?=web_encryptIt($res_fetch['care_slno'])?>" type="hidden" class="form-control" name="form_type_id_div[]" required="">
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
                           <td> Crp</td>
                         <td> <?=$res_fetch['care_CRP_date']?></td>
                          <td>
                             <?php 
                              $care_pulses_type=json_decode($res_fetch4['care_pulses_type']);
                              for ($i=0; $i <count($care_pulses_type) ; $i++) { 
                                echo $care_pulses_type[$i]."<br>";
                              }

                              ?>
                            
                            
                          </td>
                          <td><?=$res_fetch['care_area_cultivated']?></td>

                          <td>
                            <?php if($res_fetch['care_new_farmer']==1){echo "Yes";}?>
                            <?php if($res_fetch['care_new_farmer']==2){echo "No";}?>
                         </td>
                          <td><?php if($res_fetch['care_demo_plot_farmer']==1){echo "Yes";}?>
                           <?php if($res_fetch['care_demo_plot_farmer']==2){echo "No";}?></td>
                          <td><?php if($res_fetch['care_continued_farmer']==1){echo "Yes";}?>
                            <?php if($res_fetch['care_continued_farmer']==2){echo "No";}?>
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
                         <td> meo</td> 
                      
                         <td> <?=$res_fetch['care_CRP_date']?></td>

                          <?php if($res_fetch['care_pulses_type_status']==2){?>
                            <td class="danger" style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                          <td>
                              <?php
                            }
                            ?>
                            <?=$res_fetch['care_pulses_type_edit']?>
                              
                            </td>
                          

                            <?php if($res_fetch['care_area_cultivated_status']==2){?>
                            <td class="danger" style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$res_fetch['care_area_cultivated_edit']?>
                              
                            </td>
                         


                         <?php if($res_fetch['care_new_farmer_status']==2){?>
                          <td class="danger" style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                             <?php if($res_fetch['care_new_farmer_edit']==1){echo "Yes";}?><?php if($res_fetch['care_new_farmer_edit']==2){echo "No";}?>
                           </td>
                          

                         
                           <?php if($res_fetch['care_demo_plot_farmer_status']==2){?>
                          <td class="danger" style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?php if($res_fetch['care_demo_plot_farmer']==1){echo "Yes";}?>
                           <?php if($res_fetch['care_demo_plot_farmer']==2){echo "No";}?>
                          
                        </td>
                          


                           <?php if($res_fetch['care_continued_farmer_status']==2){?>
                          <td class="danger" style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($res_fetch['care_continued_farmer']==1){echo "Yes";}?>
                            <?php if($res_fetch['care_continued_farmer']==2){echo "No";}?>
                          
                        </td>
                          

                        </tr>
                     <?php  }?>
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
                          <th>Training</th>
                          <th>Seed</th>
                          <th>Fertiliser</th>
                          <th>Pesticides</th>
                          <th>Extension Support</th>
                          <th>Others (Specify)</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php
                          $get_kictch2="SELECT * FROM `care_master_crop_diversification_crp_meo` WHERE `care_type_farm`='$TYPE' and `care_form_type`='$type_insert' and `care_hhid`='$care_hhi' AND `care_CRP_month`='$months' AND `care_CRP_year`='$year' AND `care_crop_div_mt_id_status`='1' and `care_crop_div_CBO_comment_status`='1' and `care_crop_div_MEO_status`='1'";
                          $sql_exe_get12=mysqli_query($conn,$get_kictch2);
                          while ($res_fetch2=mysqli_fetch_assoc($sql_exe_get12)) {
                           
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
                           <td> Crp</td>
                          <td>
                            <?php if($res_fetch2['care_IR_training']==1){echo "Yes";}?>
                            <?php if($res_fetch2['care_IR_training']==2){echo "No";}?>
                          </td>
                          <td>
                            <?php if($res_fetch2['care_IR_seed']==1){echo "Yes";}?>
                            <?php if($res_fetch2['care_IR_seed']==2){echo "No";}?>
                          </td>
                          <td><?php if($res_fetch2['care_IR_fertiliser']==1){echo "Yes";}?>
                            <?php if($res_fetch2['care_IR_fertiliser']==2){echo "No";}?>
                          </td>
                          <td>
                            <?php if($res_fetch2['care_IR_pesticides']==1){echo "Yes";}?>
                            <?php if($res_fetch2['care_IR_pesticides']==2){echo "No";}?>
                          </td>
                          <td>
                            <?php if($res_fetch2['care_IR_extension_support']==1){echo "Yes";}?>
                           <?php if($res_fetch2['care_IR_extension_support']==2){echo "No";}?>
                         </td>
                          <td> <?php if($res_fetch2['care_IR_other']==1){echo "Yes";}?>
                            <?php if($res_fetch2['care_IR_other']==2){echo "No";}?>
                          <br>
                          <?=$res_fetch2['care_CRP_other_detail']?>
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
                           <td> MEO</td>
                          <?php if($res_fetch2['care_IR_training_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($res_fetch2['care_IR_training_edit']==1){echo "Yes";}?><?php if($res_fetch2['care_IR_training_edit']==2){echo "No";}?>
                          </td>

                         <?php if($res_fetch2['care_IR_seed_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?php if($res_fetch2['care_IR_seed_edit']==1){echo "Yes";}?><?php if($res_fetch2['care_IR_seed_edit']==2){echo "No";}?>
                          </td>
                          
                           <?php if($res_fetch2['care_IR_fertiliser_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?php if($res_fetch2['care_IR_fertiliser_edit']==1){echo "Yes";}?><?php if($res_fetch2['care_IR_fertiliser_edit']==2){echo "No";}?>
                          </td>
                          
                           <?php if($res_fetch2['care_IR_pesticides_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?php if($res_fetch2['care_IR_pesticides_edit']==1){echo "Yes";}?><?php if($res_fetch2['care_IR_pesticides_edit']==2){echo "No";}?>
                          </td>

                           <?php if($res_fetch2['care_IR_extension_support_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($res_fetch2['care_IR_extension_support_edit']==1){echo "Yes";}?>
                            <?php if($res_fetch2['care_IR_extension_support_edit']==2){echo "No";}?>
                          </td>                          
                          
                          <?php if($res_fetch2['care_IR_other_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                          <?php if($res_fetch2['care_IR_other_edit']==1){echo "Yes";}?>
                           <?php if($res_fetch2['care_IR_other_edit']==2){echo "No";}?>                         
                         <br>
                          <?php if($res_fetch2['care_CRP_other_detail_status']==2){?>
                            <?php echo "<p  style='color :red;'>".$res_fetch2['care_CRP_other_detail_edit']."</p>"?>
                            <?php }else{
                              ?>
                               <?php echo "<p>".$res_fetch2['care_CRP_other_detail_edit']."</p>"?>
                              <?php
                            }
                            ?>
                           
                         </td>
                        </tr>
                     <?php  }?>
                      </tbody>
                    </table>
                   </div>
                    <br>
                  <ul class="pager">
                   <li class="previous back"><a >Previous</a></li>
                   <li class="next continue"><a >Next</a></li>
                 </ul>
                  </div>
                  <div id="part3" class="tab-pane fade">
                    <div class="table-responsive">
                   <table id='example13' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>hhi</th>
                          <th>women farmer</th>
                          <th>Month -Year </th>
                          <th>user</th>
                          <th>Seed</th>
                          <th>Fertiliser</th>
                          <th>Pesticides</th>
                          <th>Others (Specify)</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                          $get_kictch3="SELECT * FROM `care_master_crop_diversification_crp_meo` WHERE `care_type_farm`='$TYPE' and `care_form_type`='$type_insert' and `care_hhid`='$care_hhi' AND `care_CRP_month`='$months' AND `care_CRP_year`='$year' AND `care_crop_div_mt_id_status`='1' and `care_crop_div_CBO_comment_status`='1' and `care_crop_div_MEO_status`='1'";
                          $sql_exe_get3=mysqli_query($conn,$get_kictch3);
                          while ($res_fetch3=mysqli_fetch_assoc($sql_exe_get3)) { 
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
                           <td> CRP</td>
                           <td> <?=$res_fetch3['care_QR_seed']?></td>
                           <td><?=$res_fetch3['care_QR_fertiliser']?></td>
                           <td><?=$res_fetch3['care_QR_pesticides']?></td>
                           <td><?=$res_fetch3['care_QR_other']?></td>
                        
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
                           <td> MEO</td>
                          <?php if($res_fetch3['care_QR_seed_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?=$res_fetch3['care_QR_seed_edit']?>
                          </td>

                         <?php if($res_fetch3['care_QR_fertiliser_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?=$res_fetch3['care_QR_fertiliser_edit']?>
                          </td>

                           <?php if($res_fetch3['care_QR_pesticides_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$res_fetch3['care_QR_pesticides_edit']?>
                          </td>

                          

                           <?php if($res_fetch3['care_QR_other_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$res_fetch3['care_QR_other_edit']?>
                          </td>

                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    </div>
                    <br>
                  <ul class="pager">
                   <li class="previous back"><a >Previous</a></li>
                   <li class="next continue"><a >Next</a></li>
                 </ul>
                  </div>
                    
                  <div id="part4" class="tab-pane fade">
                    <div class="table-responsive">
                      <table id='example15' class="table table-hover" border="1">
                        <thead>
                          <tr>
                            <th>hhi</th>
                            <th>women farmer</th>
                            <th>Month -Year </th>
                            <th>user</th>
                            <th>Production<br>Consumption</th>
                            <th>Production<br>Sale</th>
                            <th>Production<br>Total Produciton</th>
                            <th>Production<br>Average price(Rs/Kg)</th>
                            <th>Comment of MT</th>
                            <th>Comment Of CBO </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $get_kictch4="SELECT * FROM `care_master_crop_diversification_crp_meo` WHERE `care_type_farm`='$TYPE' and `care_form_type`='$type_insert' and `care_hhid`='$care_hhi' AND `care_CRP_month`='$months' AND `care_CRP_year`='$year' AND `care_crop_div_mt_id_status`='1' and `care_crop_div_CBO_comment_status`='1' and `care_crop_div_MEO_status`='1'";
                            $sql_exe_get4=mysqli_query($conn,$get_kictch4);
                            $x_id=0;
                            while ($res_fetch4=mysqli_fetch_assoc($sql_exe_get4)) {

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
                            <td> CRP</td>
                            <td>
                              <?=$res_fetch4['care_P_consumption']?>
                            </td>
                            <td>
                              <?=$res_fetch4['care_P_sale']?>
                            </td>
                            <td>
                              <?=$res_fetch4['care_P_total_production']?>
                            </td>
                            <td>
                              <?=$res_fetch4['care_avg_price']?>
                            </td>
                            <td>
                              <?php 
                                if($res_fetch4['care_crop_div_mt_id_status']=='0'){
                                  echo "N/A";
                                }else{
                                  echo $res_fetch4['care_crop_div_comment_mt'];
                                }
                              ?>
                            </td>
                            <td>
                              <?php 
                                if($res_fetch4['care_crop_div_CBO_comment_status']=='0'){
                                  echo "N/A";
                                }else{
                                  echo $res_fetch4['care_crop_div_CBO_comment_empty'];

                               }
                              ?>
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
                            <td> MEO</td>
                              <?php if($res_fetch4['care_P_consumption_status']==2){?>
                            <td style=" border: 5px solid red;">
                              <?php }else{
                              ?>
                            <td>
                              <?php
                                }
                              ?>
                              <?=$res_fetch4['care_P_consumption_edit']?>
                            </td>
                              <?php if($res_fetch4['care_P_sale_status']==2){?>
                            <td style=" border: 5px solid red;">
                              <?php }else{
                              ?>
                            <td>
                              <?php
                                }
                              ?>
                              <?=$res_fetch4['care_P_sale_edit']?>
                            </td>
                              <?php if($res_fetch4['care_P_total_production_status']==2){?>
                            <td style=" border: 5px solid red;">
                              <?php }else{
                              ?>
                            <td>
                              <?php
                                }
                              ?>
                              <?=$res_fetch4['care_P_total_production_edit']?>
                            </td>
                              <?php if($res_fetch4['care_avg_price_status']==2){?>
                            <td style=" border: 5px solid red;">
                              <?php }else{
                              ?>
                            <td>
                              <?php
                              }
                              ?>
                              <?=$res_fetch4['care_avg_price_edit']?>
                            </td>
                            <td>
                              <?php 
                                if($res_fetch4['care_crop_div_mt_id_status']=='0'){
                                  echo "N/A";
                                }else{
                                  echo $res_fetch4['care_crop_div_comment_mt'];
                                }?>
                            </td>
                            <td>
                              <?php 
                                if($res_fetch4['care_crop_div_CBO_comment_status']=='0'){
                                  echo "N/A";
                                }else{

                                  echo $res_fetch4['care_crop_div_CBO_comment_empty'];

                                }?>
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
                    
                   <li class="previous back"><a>Previous</a></li>
                  
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