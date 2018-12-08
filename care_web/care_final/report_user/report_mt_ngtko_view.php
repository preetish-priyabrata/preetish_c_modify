<?php 
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Nutrition Gender Tool Kits Observation";

 if($_POST['form_type']){
  $form_type=web_decryptIt(str_replace(" ", "+", $_GET['token']));
  	 $GET_INFO="SELECT * FROM  `care_master_mt_NGTKO_instruction_form` WHERE `care_district_name`='$District' AND `date` BETWEEN '$date_one' AND '$date_two' ORDER BY `slno` desc";

  }else{
  	$msg->warning('SomeThing went wrong');
  	header('Location: report_MT_NGTKO_instruction_raw.php');
  	exit;
  }

?>
<!-- <link rel="stylesheet" type="text/css" href="new_style.css"> -->
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
        <li><a href="#">View NGTKO Form</a></li>
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
                  <label for="District">District :</label>
                   <input type="hidden" name="form_types" id='form_types' value="<?=web_encryptIt('get_hhi_infomation')?>">
                   <select class="form-control" id="District" name="District" required="">
                    <option value="">--Select District--</option>
                   <?php $get_village="SELECT * FROM `care_master_district_info` WHERE `care_dis_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_dis_name']?>"<?php if($District==$res_village['care_dis_name']){ echo "selected";} ?> ><?=strtoupper($res_village['care_dis_name'])?></option>
                          <?php
                        }?>
                  </select>
                  <label for="village"> Month:</label>
                    <select class="form-control" id="month" name="month" required="">
                    <option value="">--Select Month--</option>
                    <?php
                          $monthArray = range(1, 12);
                          foreach ($monthArray as $month) {
                          // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                          // you can use whatever year you want
                          // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2017-$monthPadding-01"));
                            // $monthPadding=str_replace('0','',$monthPadding);

                            ?>
                            <option value="<?=$monthPadding?>" <?php if($monthPadding==$months){ echo 'selected';}?>><?=$fdate?></option><?php 
                          }
                        ?>
                  </select>
                 <label for="village"> Year:</label>
                    <select class="form-control" id="datepicker" name="Year" required="">
                    <option value="">--Select Year--</option>
                    <?php 
                    $yearSpan = 4;
                    $currentYear = date("Y", strtotime('2017-01-01'));
                    for($i = 0; $i<=$yearSpan; $i++) {
                       $x=$currentYear+$i;
                       ?>
                       <option value="<?=$x?>" <?php if($x==$Year){echo "selected";}?>><?=$x?></option>
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
              <form action="#" id="myForm"  class="form-horizontal">
                <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('hhi_for_Training')?>">
              
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
                          <th>Type of Group <!-- [Select appropriate box] --></th>
                          <th>Kind of the farmer field school group <br><!-- [Select Appropriate Number] --></th>
                          <th>Name of the SHG</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $get_detail_query="SELECT * FROM `care_master_mt_NGTKO_instruction_form` WHERE `care_villege_name`='$village'";
                        $sql_exe_deatils=mysqli_query($conn,$get_detail_query);
                        while ($res1=mysqli_fetch_assoc($sql_exe_deatils)) {?>
                        <tr>
                          <td>

                          <?php 
                              $care_group_type=json_decode($res1['care_group_type']);
                              for ($i=0; $i <count($care_group_type) ; $i++) { 
                                echo $care_group_type[$i]."<br>";
                              }

                              ?>
                            
                          </td>
                          <td>
                          <select disabled="" class="form-control" name="care_farmer_field_group" required="">
                            <option value="1"  <?php if($res1['care_farmer_field_group']==1){echo "selected";}?>>Kitchen Garden</option>
                            <option value="2" <?php if($res1['care_farmer_field_group']==2){echo "selected";}?>>Pulses/Legume</option>
                            <option value="3"  <?php if($res1['care_farmer_field_group']==3){echo "selected";}?>>Goat Rearing</option>
                            <option value="4" <?php if($res1['care_farmer_field_group']==4){echo "selected";}?>>Backyard Poultry</option>
                            <option value="5"  <?php if($res1['care_farmer_field_group']==5){echo "selected";}?>>Dairy Promotion</option>
                            <option value="6" <?php if($res1['care_farmer_field_group']==6){echo "selected";}?>>Post-Harvest Management</option>
                            <option value="7"  <?php if($res1['care_farmer_field_group']==7){echo "selected";}?>>Labour Saving Technology</option>
                            <option value="8" <?php if($res1['care_farmer_field_group']==8){echo "selected";}?>>Behaviour Change Communication</option>
                          </select>
                          </td>
                          <td><input disabled="" value="<?=$res1['care_shg_name']?>" class="form-control" type="text" name="care_shg_name" required=""></td>
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
                   <table id='example12' class="table table-hover" border="1">
                      <thead>

                        <tr>
                          <th>Number of participants in <br>the Nut-Gen tool execution (Male)</th>
                          <th>Number of participants in <br>the Nut-Gen tool execution (Female)</th>
                          <th>Number of participants in <br>the Nut-Gen tool execution (Total)</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php 
                        $get_detail_query="SELECT * FROM `care_master_mt_NGTKO_instruction_form` WHERE `care_villege_name`='$village'";
                        $sql_exe_deatils=mysqli_query($conn,$get_detail_query);
                        while ($res1=mysqli_fetch_assoc($sql_exe_deatils)) {?>
                       <tr>
                        <td>
                            <input type="number" min="0" class="form-control" value="<?=$res1['care_male_participants']?>"  disabled=""  name="male_qnty" required="">
                          </td>
                           <td>
                            <input type="number" min="0" class="form-control" value="<?=$res1['care_female_participants']?>"  disabled="" name="female_qnty" required="">
                          </td>
                          <td>
                            <input type="number" min="0" class="form-control" value="<?=$res1['care_total_participants']?>" disabled=""  name="total_qnty" required="">
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
                   <table id='example11' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Name of the NGTK</th>
                          <th>How many times have you<br> reached out to this group <br>through rolling out this tool?</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php 
                        $get_detail_query="SELECT * FROM `care_master_mt_NGTKO_instruction_form` WHERE `care_villege_name`='$village'";
                        $sql_exe_deatils=mysqli_query($conn,$get_detail_query);
                        while ($res1=mysqli_fetch_assoc($sql_exe_deatils)) {?>
                      <tr>
                      
                        <td>
                          <select disabled="" class="form-control" name="care_NGTK_name" required="">
                            <option value="1"  <?php if($res1['care_NGTK_name']==1){echo "selected";}?>>Access & Control</option>
                            <option value="2" <?php if($res1['care_NGTK_name']==2){echo "selected";}?>>Pile Sort</option>
                            <option value="3"  <?php if($res1['care_NGTK_name']==3){echo "selected";}?>>Daily Clock</option>
                            <option value="4" <?php if($res1['care_NGTK_name']==4){echo "selected";}?>>Tri-Colour Food Chart</option>
                            <option value="5"  <?php if($res1['care_NGTK_name']==5){echo "selected";}?>>Gender Stereotype</option>
                            <option value="6" <?php if($res1['care_NGTK_name']==6){echo "selected";}?>>Ludo</option>
                            <option value="7"  <?php if($res1['care_NGTK_name']==7){echo "selected";}?>>Snake & ladder</option>
                            <option value="8" <?php if($res1['care_NGTK_name']==8){echo "selected";}?>>Participatory Resource Appraisal</option>
                            <option value="9" <?php if($res1['care_NGTK_name']==9){echo "selected";}?>>Cash Flow Tree</option>
                          </select>
                          </td>
                           <td>
                           <select disabled="" class="form-control" name="classroom_Training_status" required="">
                            <option value="1"  <?php if($res1['care_rolling_time']==1){echo "selected";}?>>Once</option>
                            <option value="2" <?php if($res1['care_rolling_time']==2){echo "selected";}?>>Twice</option>
                            <option value="3"  <?php if($res1['care_rolling_time']==3){echo "selected";}?>>More than Twice</option>
                          </select>
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
                   <table id='example13' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>What was the observation of the<br>executed on the executed tool?</th>
                          <th>Are the support materials used <br>in execution of the tool sufficiently<br> and adequately addressed the<br> issues of the participants?</th>
                          <th>What key messages have been received <br>by the participants during this session</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $get_detail_query="SELECT * FROM `care_master_mt_NGTKO_instruction_form` WHERE `care_villege_name`='$village'";
                        $sql_exe_deatils=mysqli_query($conn,$get_detail_query);
                        while ($res1=mysqli_fetch_assoc($sql_exe_deatils)) {?>
                        <tr>
                        <td>
                           <select disabled="" class="form-control" name="care_observation_tool" required="">
                            <option value="1"  <?php if($res1['care_observation_tool']==1){echo "selected";}?>>Very Informative</option>
                            <option value="2" <?php if($res1['care_observation_tool']==2){echo "selected";}?>>Informative</option> 
                            <option value="3" <?php if($res1['care_observation_tool']==2){echo "selected";}?>>Non-Informative</option> 
                          </select>
                       </td>

                        <td>
                            <select disabled="" class="form-control" name="classroom_Training_status" required="">
                            <option value="1"  <?php if($res1['care_support_materials']==1){echo "selected";}?>>Yes</option>
                            <option value="2" <?php if($res1['care_support_materials']==2){echo "selected";}?>>No</option> 
                          </select></td>
                           <td>
                            <textarea class="form-control" name="message" disabled=""   required="" maxlength="100"><?=$res1['care_key_message']?></textarea><h5>(Maximum 100 letters)</h5>
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

