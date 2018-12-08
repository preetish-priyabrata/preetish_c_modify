<?php
session_start();
ob_start();
// ini_set('display_errors',1);
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 
  $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
  if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
      $village=$_POST['village'];
      $months=$_POST['month'];
      $Year=$_POST['Year'];
      $employee_id=$_POST['employee_id'];
      $District=$_POST['District'];
      $Form_ids_views=$_POST['Form_ids_views'];

    }else{
      $months="";
      $Year="";
      $employee_id="";
      $village="";
      $District="";
      $Form_ids_views="";
       header('Location:logout.php');
      exit;
    }
  }else{
     $months="";
      $Year="";
      $employee_id="";
      $village="";
       $District="";
       $Form_ids_views="";
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
        <li class="active"><a href="#">Get List Of CRP</a></li>
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
                <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">
                <div class="form-group">
                  <label for="District">District :</label>
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
                  <label for="Form_ids_views">Mt-Domain :</label>
                  <select required class="form-control" id="Form_ids_views" name="Form_ids_views" > 
                    <option value="">--Please Select Domain--</option>
                    <option value="form1" <?php if($Form_ids_views=="form1"){ echo "selected";}?>><h4><b>Input and output tracking</b></h4></option>
                    <option value="form2" <?php if($Form_ids_views=="form2"){ echo "selected";}?>><h4><b>Post Harvest Loss</b></h4></option>
                    <option value="form3" <?php if($Form_ids_views=="form3"){ echo "selected";}?>><h4><b>Goatery</b></h4></option>
                    <option value="form4" <?php if($Form_ids_views=="form4"){ echo "selected";}?>><h4><b>Dairy</b></h4></option>
                    <option value="form5" <?php if($Form_ids_views=="form5"){ echo "selected";}?>><h4><b>Poultry</b></h4></option>
                    <option value="form6" <?php if($Form_ids_views=="form6"){ echo "selected";}?>><h4><b>Labour Saving Technologies</b></h4></option>
                    <option value="form7" <?php if($Form_ids_views=="form7"){ echo "selected";}?>><h4><b>Crop Diversity</b></h4></option>
                    <option value="form8" <?php if($Form_ids_views=="form8"){ echo "selected";}?>><h4><b>Kitchen Garden</b></h4></option>
                    <option value="form9" <?php if($Form_ids_views=="form9"){ echo "selected";}?>><h4><b>Training</b></h4></option>
                     <option value="form10" <?php if($Form_ids_views=="form10"){ echo "selected";}?>><h4><b>SHG</b></h4></option>
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
                <button type="submit" class="btn btn-default">Find</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <?php
       if(isset($_POST['form_type'])){
        if($form_type=='get_hhi_infomation'){
        if(!empty($village)){
           $date_one=$Year.'-'.$months.'-1';
      $date_two=date('Y-m-d');
           // $form1=$form2=$form3=$form4=$form5=$form6=$form7=$form8=$form9=$form10=0;
          // $get_detail="SELECT * FROM `care_master_hhi_month_year` WHERE `care_crp_id`='$employee_id' and`care_village_name`='$village' and `care_month`='$months' and `care_year`='$Year'";
          // $sql_get_detail=mysqli_query($conn,$get_detail);
          $form1_query="SELECT * FROM `care_master_input_output_tracking_tarina` WHERE `care_TARINA_year`='$Year' and `care_TARINA_month`='$months'and`care_TARINA_vlg_name`='$village' and`care_TARINA_employee_id`='$employee_id' and `care_TARINA_entry_date`BETWEEN '$date_one' AND '$date_two'";
           $sql_form1_query=mysqli_query($conn,$form1_query);
          $form1=mysqli_num_rows($sql_form1_query);

          $form2_query="SELECT * FROM `care_master_post_harvest_loss` WHERE `care_PHL_year`='$Year' and `care_PHL_month`='$months' and `care_PHL_villege_name`='$village' and`care_PHL_employee_id`='$employee_id' and `care_PHL_date`BETWEEN '$date_one' AND '$date_two'";
          $sql_form2_query=mysqli_query($conn,$form2_query);
          $form2=mysqli_num_rows($sql_form2_query);

          $form3_query="SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_vlg_name`='$village' and `care_LS_employee_id`='$employee_id'and`care_LS_month`='$months' and `care_LS_year`='$Year' and `livestock`='1' and `care_LS_date` BETWEEN '$date_one' AND '$date_two'";
          $sql_form3_query=mysqli_query($conn,$form3_query);
          $form3=mysqli_num_rows($sql_form3_query);

          $form4_query="SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_vlg_name`='$village' and `care_LS_employee_id`=''and`care_LS_month`='' and `care_LS_year`='' and `livestock`='2' and `care_LS_date` BETWEEN '$date_one' AND '$date_two'";
          $sql_form4_query=mysqli_query($conn,$form4_query);
          $form4=mysqli_num_rows($sql_form4_query);

          $form5_query="SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `care_LS_vlg_name`='$village' and `care_LS_employee_id`='$employee_id'and`care_LS_month`='$months' and `care_LS_year`='$Year' and `livestock`='3' and `care_LS_date` BETWEEN '$date_one' AND '$date_two'";
          $sql_form5_query=mysqli_query($conn,$form5_query);
          $form5=mysqli_num_rows($sql_form5_query);
          

           $form6_query="SELECT * FROM `care_master_mtf_labour_saving_tech_tarina` WHERE `care_MTF_employee_id`='$employee_id' and `care_MTF_month`='$months' and `care_MTF_year`='$Year' and `care_MTF_vlg_name`='$village' and `care_MTF_date` BETWEEN '$date_one' AND '$date_two'";
          $sql_form6_query=mysqli_query($conn,$form6_query);
          $form6=mysqli_num_rows($sql_form6_query);

          $form7_query="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_CRP_vlg_name`='$village' and `care_CRP_month`='$months' and `care_CRP_year`='$Year' and`care_CRP_employee_id`='$employee_id' and `care_form_type`='1' and `care_CRP_date` BETWEEN '$date_one' AND '$date_two'";
          $sql_form7_query=mysqli_query($conn,$form7_query);
          $form7=mysqli_num_rows($sql_form7_query);

          $form8_query="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_CRP_vlg_name`='$village' and `care_CRP_month`='$months' and `care_CRP_year`='$Year' and`care_CRP_employee_id`='$employee_id' and `care_form_type`='2' and `care_CRP_date` BETWEEN '$date_one' AND '$date_two'";
          $sql_form8_query=mysqli_query($conn,$form8_query);
          $form8=mysqli_num_rows($sql_form8_query);

       
          
          $form9_query="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE `care_EV_vlg_name`='$village' and`care_EV_month`='$months' and `care_EV_year`='$Year'and`care_EV_employee_id`='$employee_id' and `care_EV_date`BETWEEN '$date_one' AND '$date_two'";
          $sql_form9_query=mysqli_query($conn,$form9_query);
          $form9=mysqli_num_rows($sql_form1_query);


          $form10_query="SELECT * FROM `care_master_mrf_shg_tracking_under_tarina` WHERE `care_SHG_vlg_name`='$village'and`care_SHG_month`='$months' and`care_SHG_year`='$Year' and`care_SHG_employee_id`='$employee_id' and`care_SHG_date` BETWEEN '$date_one' AND '$date_two'";
          $sql_form10_query=mysqli_query($conn,$form10_query);
          $form10=mysqli_num_rows($sql_form10_query);

          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="panel panel-default">
                <div class="panel-body text-center">
                  <h4>Report Date From <?=$date_one ?> To <?=$date_two?></h4>
                 <div class="table-responsive">
                   <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                         <th>
                        <?php
                        switch ($Form_ids_views) {
                          case 'form1':
                           echo "Input and output tracking";
                            break;
                          case 'form2':
                           echo "Post Harvest Loss";
                            break;
                          case 'form3':
                            echo "Goatery";
                            break;
                          case 'form4':
                           echo "Dairy";
                            break;
                          case 'form5':
                           echo "Poultry";
                            break;
                          case 'form6':
                            echo "Labour Saving Technologies";
                            break;
                          case 'form7':
                           echo "Crop Diversity";
                            break;
                          case 'form8':
                           echo "Kitchen Garden";
                            break;
                          case 'form9':
                            echo "Training";
                            break;
                          case 'form10':
                            echo "SHG";
                            break;
                          
                          default:
                            header('Location:logout.php');
                            exit;
                            break;
                        }
                        ?>
                       </th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                       <th>
                        <?php
                        switch ($Form_ids_views) {
                          case 'form1':
                           echo "Input and output tracking";
                            break;
                          case 'form2':
                           echo "Post Harvest Loss";
                            break;
                          case 'form3':
                            echo "Goatery";
                            break;
                          case 'form4':
                           echo "Dairy";
                            break;
                          case 'form5':
                           echo "Poultry";
                            break;
                          case 'form6':
                            echo "Labour Saving Technologies";
                            break;
                          case 'form7':
                           echo "Crop Diversity";
                            break;
                          case 'form8':
                           echo "Kitchen Garden";
                            break;
                          case 'form9':
                            echo "Training";
                            break;
                          case 'form10':
                            echo "SHG";
                            break;
                          
                          default:
                            header('Location:logout.php');
                            exit;
                            break;
                        }
                        ?>
                       </th>
                      </tr>
                    </tfoot>
                     <tbody>
                      <tr>
                        <th>
                        <?php
                        switch ($Form_ids_views) {
                          case 'form1':
                           echo $form1;
                            break;
                          case 'form2':
                           echo $form2;
                            break;
                          case 'form3':
                            echo $form3;
                            break;
                          case 'form4':
                           echo $form4;
                            break;
                          case 'form5':
                           echo $form5;
                            break;
                          case 'form6':
                            echo $form6;
                            break;
                          case 'form7':
                           echo $form7;
                            break;
                          case 'form8':
                           echo $form8;
                            break;
                          case 'form9':
                            echo $form9;
                            break;
                          case 'form10':
                            echo $form10;
                            break;
                          
                          default:
                            header('Location:logout.php');
                            exit;
                            break;
                        }
                        ?>
                       </th>
                       

                       
                      </tr>
                      
                    </tbody>
                    </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>
          </div>
        <?php }
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
    // function get_village() {
    //   var form_type=$('#form_type').val();
    // var employee_id=$('#employee_id').val();

    // if(employee_id!=""){
    //   $.ajax({
    //     type:'POST',
    //     url:'report_get_information1.php',
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