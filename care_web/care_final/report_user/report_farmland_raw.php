<?php
session_start();
ob_start();


if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $form_type=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
  if($_POST['form_types']){

    $form_types=web_decryptIt(str_replace(" ", "+", $_POST['form_types']));
    if($form_types=='get_hhi_infomation'){
      //print_r($_POST);
      $village=$_POST['village'];
      $months=$_POST['month'];
      $Year=$_POST['Year'];
      $employee_id=$_POST['employee_id'];
      $District=$_POST['District'];
    }else{
      $District="";
      $months="";
      $Year="";
      $employee_id="";
      $village="";
       header('Location:logout.php');
      exit;
    }
  }else{
    $District="";
     $months="";
      $Year="";
      $employee_id="";
      $village="";
  }

?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CRP LIST
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Get List Of CRP<?=$form_type?></a></li>
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
                  <label for="District">District :</label>
                   <input type="hidden" name="form_types" id='form_types' value="<?=web_encryptIt('get_hhi_infomation')?>">
                   <select class="form-control" id="District" name="District" onchange="get_crp()" required="">
                    <option value="">--Select District--</option>
                   <?php $get_village="SELECT * FROM `care_master_district_info` WHERE `care_dis_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_dis_name']?>"<?php if($District==$res_village['care_dis_name']){ echo "selected";} ?> ><?=strtoupper($res_village['care_dis_name'])?></option>
                          <?php
                        }?>
                  </select>
                  <label for="village">CRP :</label>                
                  
                    <select class="form-control" id="employee_id" onchange="get_village()" name="employee_id">
                    <option value="">--Select CRP--</option>
                   
                    <?php
                     if($employee_id!=""){
                         $get_employee="SELECT DISTINCT `care_master_system_user`.`employee_id`,`care_master_system_user`.`user_name` FROM `care_master_system_user` INNER JOIN `care_master_assigned_user_info` ON `care_master_system_user`.`employee_id` = `care_master_assigned_user_info`.`care_assU_employee_id` where `care_master_system_user`.`status`='1' and `care_master_assigned_user_info`.`care_assU_district_id`='$District' ";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                      }
                        ?>
                  </select>
                    <label for="village">Village :</label>
                  <?php if($village==""){?>
                  <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                  </select>
                  <?php }else{?>
                    <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                   <?php $get_village="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_employee_id`='$employee_id' and `status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_assU_village_id']?>"<?php if($village==$res_village['care_assU_village_id']){ echo "selected";} ?> ><?=$res_village['care_assU_village_id']?>[<?=$res_village['care_assU_gp_id']?>]</option>
                          <?php
                        }?>
                  </select>
                 <?php }
                    ?>
                    <br>
                    <br>
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
                 <br>
                  <br>
                <button type="submit" class="btn btn-default">Find</button>
              </form>
            </div>
          </div>

        </div>
      </div>
      <br>
      <br>
      <?php
        if($form_types=='get_hhi_infomation'){

        if(!empty($village)){
           $get_detail="SELECT * FROM `care_master_hhi_month_year` WHERE `care_crp_id`='$employee_id' and`care_village_name`='$village' and `care_month`='$months' and `care_year`='$Year'";
          $sql_get_detail=mysqli_query($conn,$get_detail);

          // while ($sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail)) {
          //   # code...
          // }
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="panel panel-default">
                <div class="panel-body text-center">
                  <div class="table-responsive">
                   <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th><h4><b>slno</b></h4></th>
                        <th><h4><b>HHI</b></h4></th>
                        <th><h4><b>women farmer</b></h4></th>
                        <th><h4><b>Spouse Name</b></h4></th>
                   
                       
                        <?php  if(($form_type==0) ||($form_type==2) ){?>
                        <th><h4><b>Crop Diversity</b></h4></th>
                        <?php }?>
                        
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th><h4><b>slno</b></h4></th>
                        <th><h4><b>HHI</b></h4></th>
                        <th><h4><b>women farmer</b></h4></th>
                        <th><h4><b>Spouse Name</b></h4></th>
                       
                        
                        <?php  if(($form_type=='0') ||($form_type=='2') ){?>
                        <th><h4><b>Crop Diversity</b></h4></th>
                        <?php }?>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      $xi=0;
                      while ($sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail)) {
                        $xi++;
                        // print_r($sql_get_detail_fetch);
                        ?>
                      <tr>

                        <td><?=$xi?></td>
                        <td><?=$care_hhi_id_info=$sql_get_detail_fetch['care_hhi_id_info'];
                           $query_detail="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi_id_info'";
                          $sql_exe_details=mysqli_query($conn,$query_detail);
                          $details_fetch=mysqli_fetch_assoc($sql_exe_details);
                        ?></td>
                        <td><?=$details_fetch['care_women_farmer']?></td>
                        <td><?=$details_fetch['care_spouse_name']?></td>

                        
                          <?php  if(($form_type=='0') ||($form_type=='2') ){?>
                        <td><?php
                              $Input_out7=1;
                              $form8=unserialize($sql_get_detail_fetch['care_form7']);
                              $care_form8_date=unserialize($sql_get_detail_fetch['care_form7_date']);
                              $care_mt_status_form8=unserialize($sql_get_detail_fetch['care_mt_status_form7']);
                                  if(!empty($form8)){
                                   for ($i=0; $i <count($form8) ; $i++) {
                                      if($care_mt_status_form8[$i]=='0'){
                                        $Input_out7++;
                                      }
                                    }
                                    $x8=count($form8);
                                    if($Input_out7!="2"){
                                     ?>
                                      <a class="btn btn-danger btn-xs" href="report_MT_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('1')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" >click to View <?=$x8?></a>
                                   
                                    <?php
                                  }else{
                                    ?>
                                    <a class="btn btn-danger btn-xs" href="report_MT_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('1')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" >click to View <?=$x8?></a>
                                    <?php
                                  }
                                  }else{
                                    echo "N/A";
                                  }
                        ?></td>
                         <?php }?> 
                      </tr>
                      <?php }?>
                    </tbody>
                    </tbody>
                  </table>
                 </div>
                </div>
              </div>
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
  <script type="text/javascript">
function get_village() {
  var form_type="2";
  var employee_id=$('#employee_id').val();
  if(employee_id!=""){
    $.ajax({
      type:'POST',
      url:'report_MEO_get_information.php',
      data:'field_info_name='+employee_id+'&form_type='+form_type,
      success:function(html){   
        $('#village').html(html);                    
      }
    });
  }else{
    $('#village').html('<option value="">-- Please Select CRP --</option>');
  }
}
function get_crp() {
  var form_type="1";
  var District=$('#District').val();
  if(District!=""){
    $.ajax({
      type:'POST',
      url:'report_MEO_get_information.php',
      data:'field_info_name='+District+'&form_type='+form_type,
      success:function(html){   
        $('#employee_id').html(html);                    
      }
    });
  }else{
    $('#employee_id').html('<option value="">-- Please Select District --</option>');
     $('#village').html('<option value="">-- Please Select CRP --</option>');
  }
}
  </script>
  <script type="text/javascript">
    // function get_village() {
    //   var form_type=$('#form_type').val();
    // var employee_id=$('#employee_id').val();

    // if(employee_id!=""){
    //   $.ajax({
    //     type:'POST',
    //     url:'report_MT_get_information.php',
    //     data:'field_info_name='+employee_id+'&form_type='+form_type,
    //     success:function(html){
    //       $('#village').html(html);
    //     }
    //   });
    // }else{
    //   $('#village').html('<option value="">-- Please Select CRP --</option>');
    // }
    // }
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    // get_village();

} );
  </script>