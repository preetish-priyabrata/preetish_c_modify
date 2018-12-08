<?php
//print_r($_POST);
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Nutrition Gender Tool Kits Observation";

 if($_POST['form_type']){
  $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
  $village=web_decryptIt(str_replace(" ", "+",$_GET['village']));
  if($form_type=='get_hhi_infomation'){
    $village=$_POST['village'];
  }else{
    $village="";
     header('Location:logout.php');
    exit; 
  }

 }else{
  $village="";
 }

?>
<link rel="stylesheet" type="text/css" href="new_style.css">
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
        Nutrition Gender Tool Kits Observation
     <!--<small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add NGTKO Form</a></li>
        <li class="active">Nutrition Gender Tool Kits Observation</li>
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>
       <div class="row">
        <div class="col-xs-12">
          <div class="panel panel-default">
            <div class="panel-body text-center">
              <form class="form-inline" action="" method="POST">
                <div class="form-group">
                  <label for="village">Village :</label>
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('get_hhi_infomation')?>">
                  <select class="form-control" id="village" name="village">
                    <option value="">--Select Village--</option>
                    <?php 
                         $mt_user=$_SESSION['location_user'];
                         $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_district`='$mt_user' and `care_vlg_status`='1' ";
                         $sql_exe=mysqli_query($conn,$get_village);
                        
                         while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                         <option value="<?=$res_village['care_vlg_name']?>"<?php if($village==$res_village['care_vlg_name']){ echo "selected";} ?> ><?=$res_village['care_vlg_name']?>[<?=$res_village['care_vlg_gp']?>]</option>
                          <?php
                        }
                     ?>
                    
                   </select>
                 </div> 
               <button type="submit" class="btn btn-default">Find</button>
             </form>
           </div>
         </div>
      </div>
      </div>
      <br>
      <br> 
      <?php
        if($form_type=='get_hhi_infomation'){

        if(!empty($village)){
          $get_detail="SELECT * FROM `care_master_village_info` WHERE `care_vlg_name`='$village'";
          $sql_exe_detail=mysqli_query($conn,$get_detail);
          $fetch_data=mysqli_fetch_assoc($sql_exe_detail);
          ?>

         <div class="box box-primary">
            <div class="box-header with-border">

            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <!-- <i class="fa fa-map-marker"></i> -->
              <h3 class="box-title">Instruction: To be filed by facilitator after execution of the tool</h3>
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
              <form action="mt_NGTKO_instruction_save.php" id="myForm" method="POST" class="form-horizontal">
                <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('hhi_for_Training')?>">
                <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                <input type="hidden" name="long" value="" id="user_browser_long" required="true">
              <div class="col-xs-12">
                <div class="col-xs-6">
                       <?php 
                        $get_detail_query="SELECT * FROM `care_master_mt_NGTKO_instruction_form` WHERE `care_villege_name`='$village'";
                        $sql_exe_deatils=mysqli_query($conn,$get_detail_query);
                        $res1=mysqli_fetch_assoc($sql_exe_deatils);
                        ?>
                  <div class="form-group">

                    <label class="control-label col-sm-2" for="date">Date</label>
                    <div class="col-sm-10">
                    <input type="text" name="date" class="form-control" disabled="" value="<?php echo $res1['date']?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="district">District</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="district" name="district" value="<?=$fetch_data['care_vlg_district']?>" readonly placeholder="Enter District">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="GP_name">GP Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="GP_name" value="<?=$fetch_data['care_vlg_gp']?>" name="GP_name" readonly placeholder="Enter GP">
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Block">Block</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Block" value="<?=$fetch_data['care_vlg_block']?>" readonly placeholder="Enter Block" name="Block">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Village">Village</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Village" value="<?=$fetch_data['care_vlg_name']?>" readonly placeholder="Enter Village" name="Village">
                    </div>
                  </div>

                </div>
              </div>
                <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2">Part 2</a></li>
                  <li><a data-toggle="pill" href="#part3">Part 3</a></li>
                  <li><a data-toggle="pill" href="#part4">Part 4</a></li>
                </ul>
                
                <div class="tab-content">
                   <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Entry Type</th>
                          <th>Type of Group <!-- [Select appropriate box] --></th>
                          <th>Kind of the farmer field school group <br><!-- [Select Appropriate Number] --></th>
                          <th>Name of the SHG</th>
                        </tr>
                      </thead>

    
                      <tbody>
                         <?php 
                        $get_group_query="SELECT * FROM `care_master_mt_NGTKO_instruction_form_meo` WHERE `care_villege_name`='$village' and `care_MEO_status`='2'";
                        $sql_exe_group=mysqli_query($conn,$get_group_query);
                        while ($sql_exe_group_check=mysqli_fetch_assoc($sql_exe_group)) {?>
                          
                        <tr>
                 
                          <td>MT Input</td>
                          
                          <td>
                           <?php 
                              $care_group_type=json_decode($sql_exe_group_check['care_group_type']);
                              for ($i=0; $i <count($care_group_type) ; $i++) { 
                                 echo str_replace("_"," ",$care_group_type[$i])."<br>";
                              }

                              ?>
                          </td>
                          <td>
                            <?php
                               $slno=$sql_exe_group_check['care_farmer_field_group'];
                               $query_view_care_slno="SELECT * FROM `care_master_farmer_field_group` WHERE `slno`='$slno'";
                               $sql_exe_care_slno=mysqli_query($conn,$query_view_care_slno);
                               $rec_query_care_slno=mysqli_fetch_assoc($sql_exe_care_slno);
                               echo $rec_query_care_slno['care_famer_field_group_name'];
                             ?>
                              </td>

                           <td><?php
                               $care_shg_id=$sql_exe_group_check['care_shg_name'];
                               $query_view_care_shg_id="SELECT * FROM `care_master_shg_list_info` WHERE `care_shg_village`='$village' and `care_shg_id`='$care_shg_id'";
                               $sql_exe_care_shg_id=mysqli_query($conn,$query_view_care_shg_id);
                               $rec_query_care_shg_id=mysqli_fetch_assoc($sql_exe_care_shg_id);
                               echo $rec_query_care_shg_id['care_shg_name'];
                             ?></td>
                           </tr>
                       <tr>
                        <td>MEO Input</td>
                           
                            <?php if($sql_exe_group_check['care_group_type_status']==2){?>
                            <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                           <?php 
                              $care_group_type_edit=json_decode($sql_exe_group_check['care_group_type_edit']);
                              for ($i=0; $i <count($care_group_type_edit) ; $i++) { 
                                echo $care_group_type_edit[$i]."<br>";
                              }

                              ?>
                         </td>
                          <?php if($sql_exe_group_check['care_farmer_field_group_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                                
                           <!--  <?php
                               $slno=$sql_exe_group_check['care_farmer_field_group_edit'];
                               $query_view_care_slno="SELECT * FROM `care_master_farmer_field_group` WHERE `slno`='$slno'";
                               $sql_exe_care_slno=mysqli_query($conn,$query_view_care_slno);
                               $rec_query_care_slno=mysqli_fetch_assoc($sql_exe_care_slno);
                               echo $rec_query_care_slno['care_famer_field_group_name'];
                             ?> -->
                           
                                <?=$sql_exe_group_check['care_farmer_field_group_edit']?>
                              </td>
                        
                          </td>
                         <?php if($sql_exe_group_check['care_shg_name_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                             <?php
                               $care_shg_edit=$sql_exe_group_check['care_shg_name_edit'];
                               $query_view_care_edit="SELECT * FROM `care_master_shg_list_info` WHERE `care_shg_village`='$village' and `care_shg_id`='$care_shg_edit'";
                               $sql_exe_care_shg_edit=mysqli_query($conn,$query_view_care_edit);
                               $rec_query_care_shg_edit=mysqli_fetch_assoc($sql_exe_care_shg_edit);
                               echo $rec_query_care_shg_edit['care_shg_name'];
                             ?></td>
                      
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


                 <div id="part2" class="tab-pane fade">
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Entry Type</th>
                          <th>Number of participants in <br>the Nut-Gen tool execution (Male)</th>
                          <th>Number of participants in <br>the Nut-Gen tool execution (Female)</th>
                          <th>Number of participants in <br>the Nut-Gen tool execution (Total)</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php 
                        $get_number_query="SELECT * FROM `care_master_mt_NGTKO_instruction_form_meo` WHERE `care_villege_name`='$village' and `care_MEO_status`='2'";
                        $sql_number_deatils=mysqli_query($conn,$get_number_query);
                        while ($sql_number_check=mysqli_fetch_assoc($sql_number_deatils)) {?>

                      <tr>
                        <td>MT Input</td>
                        <td>
                          <?=$sql_number_check['care_male_participants']?>
                        </td>
                        <td>
                          <?=$sql_number_check['care_female_participants']?>
                        </td>
                        <td>
                          <?=$sql_number_check['care_total_participants']?>
                        </td>
                        </tr>

                        <tr>
                          <td>MEO Input</td>

                          <?php if($sql_number_check['care_male_participants_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$sql_number_check['care_male_participants_edit']?>
                          </td>
                           <?php if($sql_number_check['care_female_participants_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$sql_number_check['care_female_participants_edit']?>
                          </td>
                           <?php if($sql_number_check['care_total_participants_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                            <?=$sql_number_check['care_total_participants_edit']?>
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
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Entry Type</th>
                          <th>Name of the NGTK</th>
                          <th>How many times have you<br> reached out to this group <br>through rolling out this tool?</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php 
                        $get_ngtk_query="SELECT * FROM `care_master_mt_NGTKO_instruction_form_meo` WHERE `care_villege_name`='$village' and `care_MEO_status`='2'";
                        $sql_ngtk_deatils=mysqli_query($conn,$get_ngtk_query);
                        while ($sql_ngtk_check=mysqli_fetch_assoc($sql_ngtk_deatils)) {?>
                      <tr>
                      <td>MT Input</td>
                        <td>
                         <?php 
                            $care_NGTK_name=json_decode($sql_ngtk_check['care_NGTK_name']);
                            for ($i=0; $i <count($care_NGTK_name) ; $i++) { 
                              echo $care_NGTK_name[$i]."<br>";
                            }

                         ?>
                       </td>
                           <td>
                            <?php if($sql_ngtk_check['care_rolling_time']==1){echo "Once";}?>
                            <?php if($sql_ngtk_check['care_rolling_time']==2){echo "Twice";}?>
                            <?php if($sql_ngtk_check['care_rolling_time']==3){echo "More than Twice";}?>
                          </td>     
                        </tr>

                        <tr>
                        <td>MEO Input</td>
                       
                        <?php if($sql_ngtk_check['care_NGTK_name_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                              <?php 
                            $care_NGTK_name_edit=json_decode($sql_ngtk_check['care_NGTK_name_edit']);
                            for ($i=0; $i <count($care_NGTK_name_edit) ; $i++) { 
                              echo $care_NGTK_name_edit[$i]."<br>";
                            }

                         ?>
                        
                          </td>

                           <?php if($sql_ngtk_check['care_rolling_time_status']==2){?>
                          <td style=" border: 5px solid red;">
                            <?php }else{
                              ?>
                              <td>
                              <?php
                            }
                            ?>
                              <?php if($sql_ngtk_check['care_rolling_time_edit']==1){echo "Once";}?>
                              <?php if($sql_ngtk_check['care_rolling_time_edit']==2){echo "Twice";}?>
                              <?php if($sql_ngtk_check['care_rolling_time_edit']==3){echo "More than Twice";}?>
                          
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
                  <div id="part4" class="tab-pane fade">
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Entry Type</th>
                          <th>What was the observation of the<br>executed on the executed tool?</th>
                          <th>Are the support materials used <br>in execution of the tool sufficiently<br> and adequately addressed the<br> issues of the participants?</th>
                          <th>What key messages have been received <br>by the participants during this session</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $get_observe_query="SELECT * FROM `care_master_mt_NGTKO_instruction_form_meo` WHERE `care_villege_name`='$village' and `care_MEO_status`='2'";
                        $sql_exe_observe=mysqli_query($conn,$get_observe_query);
                        while ($sql_check_observe=mysqli_fetch_assoc($sql_exe_observe)) {?>
                        <tr>
                          <td>MT Input</td>
                           <td>
                            <?php if($sql_check_observe['care_observation_tool']==1){echo "Very Informative";}?>
                            <?php if($sql_check_observe['care_observation_tool']==2){echo "Informative";}?>
                            <?php if($sql_check_observe['care_observation_tool']==3){echo "Non-Informative";}?>
                           </td>
                           <td>
                             <?php if($sql_check_observe['care_support_materials']==1){echo "Yes";}?>
                              <?php if($sql_check_observe['care_support_materials']==2){echo "No";}?>
                           </td>
                           <td>
                            <?=$sql_check_observe['care_key_message']?>
                           </td>
                        </tr>

                        <tr>
                        <td>MEO Input</td>
                          <?php if($sql_check_observe['care_observation_tool_status']==2){?>
                          <td style="border: 5px solid red;">
                            <?php }else{
                              ?>
                          <td>
                            <?php
                            }
                            ?>
                            <?php if($sql_check_observe['care_observation_tool_edit']==1){echo "Very Informative";}?>
                            <?php if($sql_check_observe['care_observation_tool_edit']==2){echo "Informative";}?> 
                            <?php if($sql_check_observe['care_observation_tool_edit']==3){echo "Non-Informative";}?>
                          </td>
                          <?php if($sql_check_observe['care_support_materials_status']==2){?>
                          <td style="border: 5px solid red;">
                            <?php }else{
                              ?>
                            <td>
                              <?php
                            }
                            ?>
                           <?php if($sql_check_observe['care_support_materials_edit']==1){echo "Yes";}?>
                           <?php if($sql_check_observe['care_support_materials_edit']==2){echo "No";}?>
                          
                          </td>

                           <?php if($sql_check_observe['care_key_message_status']==2){?>
                          <td style="border: 5px solid red;">
                            <?php }else{
                              ?>
                            <td>
                              <?php
                            }
                            ?>
                           <?=$sql_check_observe['care_key_message_edit']?>
                          </td>

                        </tr>
                         <?php }?> 
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
    <?php } 
  }?>
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
<script src="new.js"></script>
<script type="text/javascript">
$(function() {
    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });
});
</script>
<!-- continue -->
<!-- back -->
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } ); $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>
<script type="text/javascript">
    function calculate() {
        var male_qnty = document.getElementById('male_qnty').value;
        console.log(male_qnty);

        var female_qnty = document.getElementById('female_qnty').value;
        console.log(female_qnty);
        var total = document.getElementById('total_qnty');

        var result = parseInt(male_qnty) + parseInt(female_qnty);
        total.value = result;
        console.log(result);
        console.log(total);
      }

</script>
