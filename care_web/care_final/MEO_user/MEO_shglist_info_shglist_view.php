<?php
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="FFS/Training/Exposure Visit/Capacity Building Events";
 
$form_types=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];

if($_POST['form_type']){
  $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
  if($form_type=='get_hhi_infomation'){
    $village=$_POST['village'];
    $months=$_POST['month'];
    $Year=$_POST['Year'];
    // $employee_id=$_POST['employee_id'];
   
  }else{

    $months="";
    $Year="";
    // $employee_id="";
    $village="";
     header('Location:logout.php');
    exit; 
  }

 }else{
   $months="";
    $Year="";
    // $employee_id="";
    $village="";
 
 }
  
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
      Self Help Group
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Self Help Group</a></li>
        <!-- <li class="active">Blank page</li> -->
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
                    <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">                  
                    <label for="village">Village :</label>
                  
                  <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                      <?php $get_gp="SELECT * FROM `care_master_village_info` WHERE `care_vlg_district`='$location_user' ";
                        $sql_exe=mysqli_query($conn,$get_gp);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_vlg_name']?>"<?php if($village==$res_village['care_vlg_name']){ echo "selected";} ?> ><?=strtoupper($res_village['care_vlg_name'])?>[<?=strtoupper($res_village['care_vlg_gp'])?>]</option>
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
                            ?>
                            <option value="<?=$monthPadding?>" <?php if($monthPadding==$months){ echo 'selected';}?>><?=$fdate?></option><?php 
                          }
                        ?>
                  </select>
                 <label for="village"> Year:</label>
                
                    <select class="form-control"  name="Year" required="">
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
      ?>
        <div class="panel panel-default">
            <div class="panel-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Slno</th>
                    <th>CRP</th>
                    <th>SHG</th>
                    <th>Date /Time <br>Entry</th>
                    <th>Lat/ Long</th>
                    <th>MT Comment <br> Date/ Time</th>
                    <th>CBO Comment <br> Date/ Time</th>
                    <th>Meo Comment <br> Date/ Time</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   <?php 
                   $x=0;
                         $get_detail_query="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina_meo` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_month`='$months' and `care_SHG_year`='$Year'  and `care_SHG_MEO_status`='1' ";
                        $sql_exe_deatils=mysqli_query($conn,$get_detail_query);
                        while ($res1=mysqli_fetch_assoc($sql_exe_deatils)) {
                          $x++;
                          ?>

                      
                      <tr>
                        <td><?=$x?></td>
                        <td>
                          <?php 
                            $care_EV_employee_id=$res1['care_SHG_employee_id'];
                            $get_employee="SELECT * FROM `care_master_system_user` where `employee_id`='$care_EV_employee_id'";
                            $sql_exe=mysqli_query($conn,$get_employee);
                            $result_employee=mysqli_fetch_assoc($sql_exe);
                             echo $result_employee['user_name'];
                          ?>
                        </td>
                        <td><?=$res1['care_SHG_name']?></td>
                        <td><?=$res1['care_SHG_date'];?> / <?=$res1['care_SHG_time'];?></td>
                        <td><?=$res1['care_SHG_lat_id'];?> / <?=$res1['care_SHG_long_id'];?></td>
                        <td>
                          <?php if($res1['care_SHG_mt_comment_status']==1){
                                  echo $res1['care_SHG_mt_comment_date']." / ".$res1['care_SHG_mt_comment_time'];
                                }else{
                                    echo "No Comment Is been Enter in MT Level";

                                }
                          ?>                            
                          </td>
                          <td>

                          <?php 
                         
                          if($res1['care_SHG_CBO_comment_status']==1){
                                  echo $res1['care_SHG_CBO_comment_date']." / ".$res1['care_SHG_CBO_comment_time'];
                                }else{
                                    echo "No Comment Is been Enter In CBO Level";

                                }
                          ?>                            
                          </td>
                          <td>

                          <?php 
                         
                          if($res1['care_SHG_MEO_status']==1){
                                  echo $res1['care_SHG_MEO_date']." / ".$res1['care_SHG_MEO_time'];
                                }else{
                                    echo "No Comment Is been Enter In MEO Level";

                                }
                          ?>                            
                          </td>
                          <td><?php 
                                  if(($res1['care_SHG_mt_comment_status']==1) && ($res1['care_SHG_CBO_comment_status']==1)){
                                    // `care_SHG_slno`, `care_SHG_serial_id`, `care_SHG_list_id`, `care_SHG_name`
                                    ?>
                                     <a class="btn btn-primary btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('21')?>&care_hhi=<?=web_encryptIt($res1['care_SHG_slno'])?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" ><u>View</u></a>

                                      <a class="btn btn-danger btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('21')?>&care_hhi=<?=web_encryptIt($res1['care_SHG_slno'])?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=3&reset=<?=web_encryptIt($res1['care_SHG_serial_id'])?>" onclick="return confirm('Are you sure you want to delete this item?');" ><u>Delete</u></a>

                                    <?php
                                  }else{
                                    echo "--";
                                  }

                              ?>
                          </td>
                          </tr>
                      <?php 
                    }

                   ?>
                </tbody>
              </table>
            </div>
         </div>

      <?php 
    }
  }
         ?> 

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
    function get_village() {
      var form_type=$('#form_type').val();
    var employee_id=$('#employee_id').val();
   
    if(employee_id!=""){
      $.ajax({
        type:'POST',
        url:'MEO_get_information.php',
        data:'field_info_name='+employee_id+'&form_type='+form_type,
        success:function(html){   
          $('#village').html(html);                    
        }
      });
    }else{
      
      $('#village').html('<option value="">-- Please Select CRP --</option>');
    }
    }
  </script>