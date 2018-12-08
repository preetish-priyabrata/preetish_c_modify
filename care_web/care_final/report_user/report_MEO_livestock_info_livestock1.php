<?php
// print_r($_GET);
// exit;
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 
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


$title="View Livestock ".$name." After Meo Edit For HHI :-".$care_hhi." For Month/year ".$x_month."/".$year;
$get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' ";
$sql_exe_get=mysqli_query($conn,$get_hhi);
$hhi_fetch=mysqli_fetch_assoc($sql_exe_get);
$get_life_stock1="SELECT * FROM `care_master_mtf_livestock_tarina_meo` WHERE `livestock`='$TYPE' and `care_LS_hhid`='$care_hhi' and `care_LS_month`='$months' and `care_LS_year`='$year'";
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
                    <div class="table-responsive">
                    <table id='example11' class="table table-hover" border="1" >
                      <thead>
                        <tr>
                          <th>hhi</th>
                          <th>women farmer</th>
                          <th>Month -Year </th>
                          <th>user</th>
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
                        $get_life_stock1="SELECT * FROM `care_master_mtf_livestock_tarina_meo` WHERE `livestock`='$TYPE' and `care_LS_hhid`='$care_hhi' and `care_LS_month`='$months' and `care_LS_year`='$year' and care_LS_mt_comment_status='1' and `care_LS_CBO_comment_status`='1' and `care_LS_MEO_status`='1'";
                         $sql_phl_table1=mysqli_query($conn,$get_life_stock1);
                          while ($fetch_table1=mysqli_fetch_assoc($sql_phl_table1)) { 

                            ?>
                           <input  value="<?=web_encryptIt($fetch_table1['care_LS_slno'])?>" type="hidden" class="form-control" name="form_type_id_div[]" required="">
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
                          <td>
                            <?php if($fetch_table1['care_LS_IP_training']==1){echo "Yes";}?>
                            <?php if($fetch_table1['care_LS_IP_training']==2){echo "No";}?>
                          </td>
                          <!-- training -->
                          <td>
                            <?php if($fetch_table1['care_LS_IP_extension_support']==1){echo "Yes";}?>
                            <?php if($fetch_table1['care_LS_IP_extension_support']==2){echo "No";}?>
                          </td>
                          <!-- extension support -->
                          <td><?=$fetch_table1['care_LS_ES_no_of_animal']?></td>
                          <!-- no of extenston support -->
                          <td>
                            <?php if($fetch_table1['care_LS_IP_medicine']==1){echo "Yes";}?>
                            <?php if($fetch_table1['care_LS_IP_medicine']==2){echo "No";}?>
                          </td>
                          <!-- medicine  -->
                          <td><?=$fetch_table1['care_LS_Med_no_of_animal']?></td>
                          <!-- no of medice used -->
                          <td><?php if($fetch_table1['care_LS_IP_vaccination']==1){echo "Yes";}?>
                              <?php if($fetch_table1['care_LS_IP_vaccination']==2){echo "No";}?>
                          </td>
                          <!-- vaccination  -->
                          <td><?=$fetch_table1['care_LS_VN_no_of_animal']?></td>
                          <td>
                            <?php if($fetch_table1['care_LS_IP_others']==1){echo "Yes";}?>
                            <?php if($fetch_table1['care_LS_IP_others']==2){echo "No";}?>
                         
                          <br>
                          <?php if($fetch_table1['care_LS_IP_others']==1){?>
                                <?=$fetch_table1['care_LS_IP_others_specify']?>
                          <?php }else{
                            echo $fetch_table1['care_LS_IP_others_specify'];
                          }?>
                        </td>
                        <td>
                          <!-- other -->
                           <?php if($fetch_table1['care_LS_IP_others']==1){?>
                            <?=$fetch_table1['care_LS_other_no_of_animal']?>
                          <?php }else{
                             echo $fetch_table1['care_LS_other_no_of_animal'];
                          }?>
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
                           <?php if($fetch_table1['care_LS_IP_training_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?php if($fetch_table1['care_LS_IP_training_edit']==1){echo "Yes";}?>
                           <?php if($fetch_table1['care_LS_IP_training_edit']==2){echo "No";}?></td>
                          <!-- training -->
                          <?php if($fetch_table1['care_LS_IP_extension_support_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table1['care_LS_IP_extension_support_edit']==1){echo "Yes";}?>
                            <?php if($fetch_table1['care_LS_IP_extension_support_edit']==2){echo "No";}?>
                          </td>
                          <!-- extension support -->
                          <?php if($fetch_table1['care_LS_ES_no_of_animal_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table1['care_LS_ES_no_of_animal_edit']?></td>
                          <!-- no of extenston support -->
                           <?php if($fetch_table1['care_LS_IP_medicine_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table1['care_LS_IP_medicine_edit']==1){echo "Yes";}?>
                            <?php if($fetch_table1['care_LS_IP_medicine_edit']==2){echo "No";}?>
                              
                            </td>
                          <!-- medicine  -->
                          <?php if($fetch_table1['care_LS_Med_no_of_animal_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?=$fetch_table1['care_LS_Med_no_of_animal_edit']?></td>
                          <!-- no of medice used care_LS_IP_vaccination_status-->
                           <?php if($fetch_table1['care_LS_IP_vaccination_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table1['care_LS_IP_vaccination_edit']==1){echo "Yes";}?>
                            <?php if($fetch_table1['care_LS_IP_vaccination_edit']==2){echo "No";}?>
                          </td>
                          <!-- vaccination  -->
                         <?php if($fetch_table1['care_LS_VN_no_of_animal_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table1['care_LS_VN_no_of_animal_edit']?></td>
                          <?php if($fetch_table1['care_LS_IP_others_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table1['care_LS_IP_others_edit']==1){echo "Yes";}?>
                            <?php if($fetch_table1['care_LS_IP_others_edit']==2){echo "No";}?>
                          <br>
                          <?php if($fetch_table1['care_LS_IP_others_edit']==1){?> 
                          <?php if($fetch_table1['care_LS_IP_others_specify_status']==2){?>

                            <p style="border:1px solid red;"><?=$fetch_table1['care_LS_IP_others_specify_edit']?></p>
                            <?php }else{
                              ?> 
                               <p style="border:1px solid red;"><?=$fetch_table1['care_LS_IP_others_specify_edit']?></p>
                              <?php
                            }
                            ?>
                          
                          <?php }else{
                            ?>
                            <p style="border:1px solid red;"><?=$fetch_table1['care_LS_IP_others_specify_edit']?></p>
                            <?php 
                          }?>
                        </td>
                        <td>
                          <!-- other -->
                           <?php if($fetch_table1['care_LS_IP_others_edit']==1){?>
                            <?php if($fetch_table1['care_LS_other_no_of_animal_status']==2){?>
                          <p style="border:1px solid red;"><?=$fetch_table1['care_LS_other_no_of_animal_edit']?></p>
                           <?php }else{?>
                            <p style="border:1px solid red;"><?=$fetch_table1['care_LS_other_no_of_animal_edit']?></p>
                            <?php
                            }
                            ?>
                          <?php }else{
                            ?>
                            <p style="border:1px solid red;"><?=$fetch_table1['care_LS_other_no_of_animal_edit']?></p>
                            <?php }?>
                        </td>

 
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    </div>
                    <br>
                  <ul class="pager">
                  
                   <li class="next continue"><a >Next</a></li>
                  </ul>
                  </div>
                  <div id="part2" class="tab-pane fade">
                    <div class="table-responsive">
                     <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>hhi</th>
                          <th>women farmer</th>
                          <th>Month -Year </th>
                          <th>user</th>
                          <th>Total No. of animal/bird <br> currently present in HHID</th>
                          <th>Are you cultivating Fodder? </th>
                          <th>Area cultivated under <br> Fodder (in sqft)</th>
                          <th>New Farmers</th>
                          <th>Continued farmers</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           $get_life_stoc="SELECT * FROM `care_master_mtf_livestock_tarina_meo` WHERE `livestock`='$TYPE' and `care_LS_hhid`='$care_hhi' and `care_LS_month`='$months' and `care_LS_year`='$year' and care_LS_mt_comment_status='1' and `care_LS_CBO_comment_status`='1' and `care_LS_MEO_status`='1'";
                          $sql_liveexe=mysqli_query($conn,$get_life_stoc);
                          // $sql_ls_table2=mysqli_query($conn,$get_life_stoc);
                           while ($fetch_table2=mysqli_fetch_assoc($sql_liveexe)) { 


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
                          <td>CRP Input</td>
                          <td><?=$fetch_table2['care_LS_total_animal']?></td>
                         <td>
                            <?php if($fetch_table2['care_LS_cultivating_fodder']==1){echo "Yes";}?>
                            <?php if($fetch_table2['care_LS_cultivating_fodder']==2){echo "No";}?>

                          </td>
                          <td><?=$fetch_table2['care_LS_cultivated_area']?></td>
                          <td><?php if($fetch_table2['care_LS_new_farmer']==1){echo "Yes";}?>
                             <?php if($fetch_table2['care_LS_new_farmer']==2){echo "No";}?>
                               
                             </td>
                          <td><?php if($fetch_table2['care_LS_continued_farmer']==1){echo "Yes";}?>
                              <?php if($fetch_table2['care_LS_continued_farmer']==2){echo "No";}?>
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
                          <?php if($fetch_table2['care_LS_total_animal_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table2['care_LS_total_animal_edit']?></td>
                         <?php if($fetch_table2['care_LS_cultivating_fodder_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table2['care_LS_cultivating_fodder_edit']==1){echo "Yes";}?>
                           <?php if($fetch_table2['care_LS_cultivating_fodder_edit']==2){echo "No";}?>
                          </td>
                         <?php if($fetch_table2['care_LS_cultivated_area_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table2['care_LS_cultivated_area_edit']?></td>
                          <?php if($fetch_table2['care_LS_new_farmer_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>

                            <?php if($fetch_table2['care_LS_new_farmer_edit']==1){echo "Yes";}?>
                            <?php if($fetch_table2['care_LS_new_farmer_edit']==2){echo "No";}?>
                              
                            </td>
                          <?php if($fetch_table2['care_LS_continued_farmer_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>                            
                            <?php if($fetch_table2['care_LS_continued_farmer_edit']==1){echo "Yes";}?>
                          <?php if($fetch_table2['care_LS_continued_farmer_edit']==2){echo "No";}?>
                          </td>                  
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
                    <div class="table-responsive">
                    <table id='example13' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>hhi</th>
                          <th>women farmer</th>
                          <th>Month -Year </th>
                          <th>user</th>
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

                        $get_life_stock3="SELECT * FROM `care_master_mtf_livestock_tarina_meo` WHERE `livestock`='$TYPE' and `care_LS_hhid`='$care_hhi' and `care_LS_month`='$months' and `care_LS_year`='$year' and care_LS_mt_comment_status='1' and `care_LS_CBO_comment_status`='1' and `care_LS_MEO_status`='1'";
                         $sql_phl_table3=mysqli_query($conn,$get_life_stock3);
                          $x_id=0;
                          while ($fetch_table3=mysqli_fetch_assoc($sql_phl_table3)) { 
                            $care_LS_slno=$fetch_table3['care_serial_id'];
                            ?>
                          <!-- crp -->
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
                          <td><?=$fetch_table3['care_LS_QP_extension_support']?></td>
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
                                        <td class="col-sm-4"><?=$fetch_med1['care_QP_item_name']?></td>
                                        <td class="col-sm-4">
                                            <<?=$fetch_med1['care_QP_quantity']?>
                                        </td>
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
                                        <td><?=$fetch_med2['care_QP_item_name']?>
                                        </td>
                                        <td class="col-sm-4"><?=$fetch_med2['care_QP_quantity']?></td>
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
                                           <?=$fetch_med3['care_QP_item_name']?>
                                        </td>
                                        <td class="col-sm-4">
                                            <?=$fetch_med3['care_QP_quantity']?>
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
                             <?=$fetch_table3['care_LS_mt_comment_empty']?>
                            <?php }?>

                          </td>
                          <td>
                            <?php 
                            if($fetch_table3['care_LS_CBO_comment_status']=='0'){
                              echo "N/A";
                            }else{?>
                              <?=$fetch_table3['care_LS_CBO_comment_empty']?>
                            <?php }?>

                          </td>

                        </tr>
                          <!-- meo -->
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
                           <?php if($fetch_table3['care_LS_QP_extension_support_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?> 
                           <?=$fetch_table3['care_LS_QP_extension_support_edit']?></td>
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
                                                     
                                            <?=$fetch_med12['care_QP_item_name_edit']?>
                                        </td>
                                        <?php if($fetch_med12['care_QP_quantity_status']==2){?>
                                          <td class="col-sm-4" style=" border: 5px solid red;">
                                            <?php }else{
                                              ?>
                                              <td class="col-sm-4">
                                              <?php
                                            }
                                            ?>
                                            <?=$fetch_med12['care_QP_quantity_edit']?>
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
                                           <?=$fetch_med21['care_QP_item_name_edit']?>
                                        </td>
                                        <?php if($fetch_med21['care_QP_quantity_status']==2){?>
                                          <td class="col-sm-4" style=" border: 5px solid red;">
                                            <?php }else{
                                              ?>
                                              <td class="col-sm-4">
                                              <?php
                                            }
                                            ?>
                                           <?=$fetch_med21['care_QP_quantity_edit']?>
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
                                            <?=$fetch_med31['care_QP_item_name_edit']?>
                                        </td>
                                        <?php if($fetch_med31['care_QP_quantity_status']==2){?>
                                          <td class="col-sm-4" style=" border: 5px solid red;">
                                            <?php }else{
                                              ?>
                                              <td class="col-sm-4">
                                              <?php
                                            }
                                            ?>
                                            <?=$fetch_med31['care_QP_quantity_edit']?>
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
                             <?=$fetch_table3['care_LS_mt_comment_empty']?>

                              
                            <?php }?>

                          </td>
                          <td>
                            <?php 
                            if($fetch_table3['care_LS_CBO_comment_status']=='0'){

                              echo "N/A";
                             }else{?>
                              
                              <?=$fetch_table3['care_LS_CBO_comment_empty']?>

                               
                            <?php }?>

                          </td>

                        </tr>
                        <?php 
                        $x_id++;
                      }?>
                       
                      </tbody>
                    </table>
                  <br>
                   </div>
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

