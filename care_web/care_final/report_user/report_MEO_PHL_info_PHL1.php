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
 
  $title="View Post Harvest Loss After Meo Edit For HHI :-".$care_hhi." For Month/year ".$x_month."/".$year;
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
                  <input type="hidden" name="form_type_new" value="<?=web_encryptIt('MEO_comment')?>">
                  <input type="hidden" name="form_type_id" value="<?=web_encryptIt('form2')?>">
                  <input type="hidden" name="form_type_user" value="<?=web_encryptIt($months)?>">
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('hhi_for_PHL')?>">
                  <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                  <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                  <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                  <input type="hidden" name="long" value="" id="user_browser_long" required="true">
                  <input type="hidden" name="care_hhi" value="<?=$care_hhi?>" id="user_browser_long2" required="true">
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
                </table>
                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2">Part 2</a></li>
                  <li><a data-toggle="pill" href="#part3">part 3</a></li>
                  <!-- <li><a data-toggle="pill" href="#part4">Part 4</a></li> -->
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
                          <th>Training provided in classroom <br> ( If  Yes  skip to next col. )</th>
                          <th>Mention the subject matter </th>
                          <th>Male</th>
                          <th>Female</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $get_phl="SELECT * FROM `care_master_post_harvest_loss_meo` WHERE `care_PHL_hhid`='$care_hhi' and `care_PHL_month`='$months' and `care_PHL_year`='$year' and `care_PHL_villege_name`='$village' and `care_PHL_mt_comment_status`='1'and `care_PHL_CBO_comment_status`='1' and `care_PHL_MEO_status`='1'";
                          $sql_phl_table1=mysqli_query($conn,$get_phl);
                          while ($fetch_table1=mysqli_fetch_assoc($sql_phl_table1)) {
                           
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
                          <td><?=$fetch_table1['care_PHL_date']?></td>
                          <td><?php if($fetch_table1['care_CT_status']==1){echo "Yes";}?>
                              <?php if($fetch_table1['care_CT_status']==2){echo "No";}?>
                          </td>
                          <td>
                              <?php if($fetch_table1['care_CT_subject_matter']==1){echo "Improved Storing";}?>
                              <?php if($fetch_table1['care_CT_subject_matter']==2){echo "FAQ & others on Pulse,Veg/Fruits/Grains";}?>
                          </td>
                          <td><?=$fetch_table1['care_CT_male_present']?></td>
                          <td><?=$fetch_table1['care_CT_feamle_present']?></td>
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
                            <td>MEO Input</td>
                          <td><?=$fetch_table1['care_PHL_date']?></td>
                          <?php if($fetch_table1['care_CT_status_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table1['care_CT_status_edit']==1){echo "Yes";}?>
                            <?php if($fetch_table1['care_CT_status_edit']==2){echo "No";}?>
                         </td>
                          <?php if($fetch_table1['care_CT_subject_matter_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table1['care_CT_subject_matter_edit']==1){echo "Improved Storing";}?>
                            <?php if($fetch_table1['care_CT_subject_matter_edit']==2){echo "FAQ & others on Pulse,Veg/Fruits/Grains";}?>
                          </td>
                         <?php if($fetch_table1['care_CT_male_present_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$fetch_table1['care_CT_male_present_edit']?></td>
                           <?php if($fetch_table1['care_CT_female_present_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?=$fetch_table1['care_CT_female_present_edit']?></td>
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
                  <table id='example12' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>hhi</th>
                          <th>women farmer</th>
                          <th>Month - Year </th>
                          <th>user</th>
                          <th>Demonstration Provided <br> ( If  Yes  skip to next col. )</th>
                          <th>Mention the subject matter </th>
                         <!--  <th>Male</th>
                          <th>Female</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php  $get_ph2="SELECT * FROM `care_master_post_harvest_loss_meo` WHERE `care_PHL_hhid`='$care_hhi' and `care_PHL_month`='$months' and `care_PHL_year`='$year' and `care_PHL_villege_name`='$village' and `care_PHL_mt_comment_status`='1' and `care_PHL_CBO_comment_status`='1' and `care_PHL_MEO_status`='1'";
                          $sql_phl_table2=mysqli_query($conn,$get_ph2);
                          while ($fetch_table2=mysqli_fetch_assoc($sql_phl_table2)) {?>
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

                          <td><?php if($fetch_table2['care_DP_status']==1){echo "Yes";}?> <?php if($fetch_table2['care_DP_status']==2){echo "No";}?>
                            
                          </td>
                          
                          <td><?php if($fetch_table2['care_DP_subject_matter']==1){echo "Improved Storing";}?>
                            <?php if($fetch_table2['care_DP_subject_matter']==2){echo "FAQ & others on Pulse,Veg/Fruits/Grains";}?>
                              
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
                          <td>MEO Input</td>
                          <?php if($fetch_table2['care_DP_status_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table2['care_DP_status_edit']==1){echo "Yes";}?><?php if($fetch_table2['care_DP_status_edit']==2){echo "No";}?>
                              
                            </td>
                          
                          <?php if($fetch_table2['care_DP_subject_matter_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table2['care_DP_subject_matter_edit']==1){echo "Improved Storing";}?>
                            <?php if($fetch_table2['care_DP_subject_matter_edit']==2){echo "FAQ & others on Pulse,Veg/Fruits/Grains";}?>
                          </td>
                          
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  <br>
                  </div>

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
                          <th>Month - Year </th>
                          <th>user</th>
                          <th>Name of inputs provided</th>
                          <th>Implement being used or not <br>( This  is only for implements)</th>
                          <th>Farmer parcticing the trained technique <br> ( This  is for all including outcome of training)</th>
                          <th>Comments Of MT</th>
                          <th>Comment Of CBO</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                         $get_ph3="SELECT * FROM `care_master_post_harvest_loss_meo` WHERE `care_PHL_hhid`='$care_hhi' and `care_PHL_month`='$months' and `care_PHL_year`='$year' and `care_PHL_villege_name`='$village' and `care_PHL_mt_comment_status`='1' and `care_PHL_CBO_comment_status`='1' and `care_PHL_MEO_status`='1'";
                          $sql_phl_table3=mysqli_query($conn,$get_ph3);
                            $x_id=0;
                          while ($fetch_table3=mysqli_fetch_assoc($sql_phl_table3)) {?>
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
                              <?php if($fetch_table3['care_IP_name']==1){echo "Moistermeter";}?>
                              <?php if($fetch_table3['care_IP_name']==2){echo "Hermative bags";}?>
                              <?php if($fetch_table3['care_IP_name']==3){echo "Tarpaulin sheet";}?>
                              <?php if($fetch_table3['care_IP_name']==4){echo "other";}?></td>
                           <td><?php if($fetch_table3['care_implements']==1){echo "Yes";}?>
                               <?php if($fetch_table3['care_implements']==2){echo "No";}?>
                                 
                           </td>
                           <td><?php if($fetch_table3['care_farmer_parcticing']==1){echo "Yes";}?><?php if($fetch_table3['care_farmer_parcticing']==2){echo "selected";}?></td>
                          <td>
                            <?php 
                            if($fetch_table3['care_PHL_mt_comment_status']=='0'){
                              echo "N/A";
                             }else{?>
                             
                              <?=$fetch_table3['care_PHL_mt_comment_empty']?>
                               
                            <?php }?>

                          </td>
                          <td>
                            <?php 
                            if($fetch_table3['care_PHL_CBO_comment_status']=='0'){
                           
                            echo "N/A";  
                             }else{?>
                              
                            <?=$fetch_table3['care_PHL_CBO_comment_empty']?>
                              
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
                          <td>MEO Input</td>
                          <?php if($fetch_table3['care_IP_name_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table3['care_IP_name_edit']==1){echo "Moistermeter";}?>
                            <?php if($fetch_table3['care_IP_name_edit']==2){echo "Hermative bags";}?>
                            <?php if($fetch_table3['care_IP_name_edit']==3){echo "Tarpaulin sheet";}?>
                            <?php if($fetch_table3['care_IP_name_edit']==4){echo "other";}?>
                          </td>
                            <?php if($fetch_table3['care_implements_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table3['care_implements_edit']==1){echo "Yes";}?>
                            <?php if($fetch_table3['care_implements_edit']==2){echo "No";}?>
                          </td>
                            <?php if($fetch_table3['care_farmer_parcticing_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?php if($fetch_table3['care_farmer_parcticing_edit']==1){echo "Yes";}?>
                            <?php if($fetch_table3['care_farmer_parcticing_edit']==2){echo "No";}?>
                          </td>
                          <td>
                            <?php 
                            if($fetch_table3['care_PHL_mt_comment_status']=='0'){
                              echo "N/A";
                             }else{?>                             
                             <?=$fetch_table3['care_PHL_mt_comment_empty']?>
                            <?php }?>

                          </td>
                          <td>
                            <?php 
                            if($fetch_table3['care_PHL_CBO_comment_status']=='0'){
                            echo "N/A";
                            }else{
                             echo $fetch_table3['care_PHL_CBO_comment_empty'];
                            }?>
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