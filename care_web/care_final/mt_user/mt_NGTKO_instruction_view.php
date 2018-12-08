<?php
session_start();
ob_start();
if($_SESSION['mt_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $employee_id=$_SESSION['employee_id'];
  $msg = new \Preetish\FlashMessages\FlashMessages();
  $title="FFS/Training/Exposure Visit/Capacity Building Events";
  $slno=web_decryptIt(str_replace(" ", "+", $_GET['slno']));

  $get_training1="SELECT * FROM `care_master_mt_NGTKO_instruction_form` WHERE `slno`='$slno' ";
  $sql_exe_training2=mysqli_query($conn,$get_training1);
  $x_id=0;
  $res3=mysqli_fetch_assoc($sql_exe_training2);


$village=$res3['care_EV_vlg_name'];
$Year=$res3['care_EV_year'];
$months=$res3['care_EV_month'];
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
        FFS/Training/Exposure Visit/Capacity Building Events 
     <!--    <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Training Form</a></li>
        <li class="active">FFS/Training/Exposure Visit <?=$slno?></li>
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>
      <div class="row">
        <?php 
          $get_detail="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_village_id`='$village'";
          $sql_exe_detail=mysqli_query($conn,$get_detail);
          $fetch_data=mysqli_fetch_assoc($sql_exe_detail);
          ?>

         <div class="box box-primary">
            <div class="box-header with-border">

            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <!-- <i class="fa fa-map-marker"></i> -->

              <h3 class="box-title">Instruction:To be filled by facilitator after execution of the tool</h3>
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

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="date">Date</label>
                    <div class="col-sm-10">
                    <input type="text" name="date" class="form-control" disabled="" value="<?php echo date('Y-m-d');?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="district">District</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="district" name="district" value="<?=$fetch_data['care_assU_district_id']?>" readonly placeholder="Enter District">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="GP_name">GP Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="GP_name" value="<?=$fetch_data['care_assU_gp_id']?>" name="GP_name" readonly placeholder="Enter GP">
                    </div>
                  </div>

                </div>
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Block">Block</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Block" value="<?=$fetch_data['care_assU_block_id']?>" readonly placeholder="Enter Block" name="Block">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Village">Village</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Village" value="<?=$fetch_data['care_assU_village_id']?>" readonly placeholder="Enter Village" name="Village">
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
                          <th>Type of Group [Select appropriate box]</th>
                          <th>Kind of the farmaer field school group <br>[Select Appropriate Number]</th>
                          <th>New of the SHG</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                           <select id="dates-field2" class="multiselect-ui form-control" multiple="multiple" name="type_group[]" required="">
                           <option value="<?=$res3['care_group_type']?>"><?=$res3['care_group_type']?>"</option>                      
                           </select>
                          </td>
                           <td><select class="form-control" name="farmers" required="">
                              <option value="<?=$res3['care_farmer_field_group']?>"><?=$res3['care_farmer_field_group']?>"</option>   
                          </select></td>
                          <td>  <input class="form-control" type="text" name="shg_name" value="<?=$res3['care_shg_name']?>"  required=""></td>
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
                          <th>Number of participants in <br>the Nut-Gen tool execution (Male)</th>
                          <th>Number of participants in <br>the Nut-Gen tool execution (Female)</th>
                          <th>Number of participants in <br>the Nut-Gen tool execution (Total)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                           <td>
                            <input type="number" min="0" class="form-control" value="<?=$res3['care_male_participants']?>"  name="male_qnty" required="">
                          </td>
                           <td>
                            <input type="number" min="0" class="form-control" value="<?=$res3['care_female_participants']?>"  name="female_qnty" required="">
                          </td>
                          <td>
                            <input type="number" min="0" class="form-control" value="<?=$res3['care_total_participants']?>"  name="total_qnty" required="">
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
                          <th>Name of the NGTK</th>
                          <th>How many times have you<br> reached out to this group <br>through rolling out this tool?</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>              
                          <td><select class="form-control" name="ngtk_name[]" required="" multiple="multiple" >
                           <option value="<?=$res3['care_NGTK_name']?>"><?=$res3['care_NGTK_name']?>"</option>
                           </select></td>
                          <td><select class="form-control" name="times" required="">
                              <option value="<?=$res3['care_rolling_time']?>"><?=$res3['care_rolling_time']?>"</option>
                          </select></td>
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
                          <th>What was the observation of the<br>executed on the executed tool?</th>
                          <th>Are the support materials used <br>in execution of the tool sufficiently<br> and adequately addressed the<br> issues of the participants?</th>
                          <th>What key messages have been received <br>by the participants during this session</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                           <td><select class="form-control" name="observation" required="">
                               <option value="<?=$res3['care_observation_tool']?>"><?=$res3['care_observation_tool']?>"</option>
                          </select></td>
                          <td><select class="form-control" name="support_material" required="">
                               <option value="<?=$res3['care_support_materials']?>"><?=$res3['care_support_materials']?>"</option>
                          </select></td>
                           <td>
                            <textarea class="form-control" name="message" required="" maxlength="100"> <?=$res3['care_key_message']?></option></textarea></h5>
                          </td>
                         
                          
                        </tr>
                      </tbody>
                    </table>
                    
                    <br>
                  <ul class="pager">
                   <li class="previous back"><a >Previous</a></li>
                    <!--  <li class="next pull-right" ><button type="submit" class="btn" >Save</button></li> -->
                   
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
   <!-- name="Topic_Covered" -->
 <!--  <script type="text/javascript">
    function get_topic() {
      var form_type=$('#form_type').val();
    var thematic_interventions=$('#thematic_interventions').val();

    if(thematic_interventions!=""){
      $.ajax({
        type:'POST',
        url:'crp_get_topic.php',
        data:'field_info_name='+thematic_interventions+'&form_type='+form_type,
        success:function(html){
          $('#Topic_Covered').html(html);
        }
      });
    }else{
      $('#Topic_Covered').html('<option value="">-- Please Select Thematic Intervention  --</option>');
    }
    }
     $(document).ready(function() {
    // $('#example').DataTable();
    get_topic();

} );
  </script> -->