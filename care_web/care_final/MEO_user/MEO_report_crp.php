<?php
session_start();
ob_start();
// ini_set('display_errors',1);
if($_SESSION['meo_user']){
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
    }else{
      $months="";
      $Year="";
      $employee_id="";
      $village="";
       header('Location:logout.php');
      exit;
    }
  }else{
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
                <div class="form-group">
                  <label for="village">CRP :</label>
                 <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">
                  <select class="form-control" id="employee_id" onchange="get_village()" name="employee_id">
                    <option value="">--Select CRP--</option>
                    <?php
                        $get_employee="SELECT * FROM `care_master_system_user`  WHERE `level`='1' and `assign_status`='1' and `status`='1' ";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
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


          $form10_query="SELECT * FROM `care_master_MRF_SHG_tracking_under_TARINA` WHERE `care_SHG_vlg_name`='$village'and`care_SHG_month`='$months' and`care_SHG_year`='$Year' and`care_SHG_employee_id`='$employee_id' and`care_SHG_date` BETWEEN '$date_one' AND '$date_two'";
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
                        <th>Input and output tracking</th>
                        <th>Post Harvest Loss</th>
                        <th>Goatery</th>
                        <th>Dairy</th>
                        <th>Poultry</th>
                        <th>Labour Saving Technologies</th>
                        <th>farmland</th>
                        <th>Kitchen Garden</th>
                        <th>Training</th>
                        <th>Shg</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Input and output tracking</th>
                        <th>Post Harvest Loss</th>
                        <th>Goatery</th>
                        <th>Dairy</th>
                        <th>Poultry</th>
                        <th>Labour Saving Technologies</th>
                        <th>farmland</th>
                        <th>Kitchen Garden</th>
                        <th>Training</th>
                        <th>Shg</th>
                      </tr>
                    </tfoot>
                     <tbody>
                      <tr>
                        <td>
                          <?php echo $form1 ?>
                        </td>
                        <td>
                          <?php echo $form2 ?>
                        </td>
                        <td>
                          <?php echo $form3 ?>
                        </td>
                        <td>
                          <?php echo $form4 ?>
                        </td>
                        <td>
                          <?php echo $form5 ?>
                        </td>
                        <td>
                          <?php echo $form6 ?>
                        </td>
                        <td>
                          <?php echo $form7 ?>
                        </td>
                        <td>
                          <?php echo $form8 ?>
                        </td>
                        <td>
                          <?php echo $form9 ?>
                        </td>
                        <td>
                          <?php echo $form10 ?>
                        </td>
                      </tr>
                      <?php
                      $xi=0;
                      $form1=$form2=$form3=$form4=$form5=$form6=$form7=$form8=$form9=$form10=0;

                      while ($sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail)) {
                        $xi++;
                          $form_type1=$sql_get_detail_fetch['form1'];
                          $form_type2=$sql_get_detail_fetch['form2'];
                          $form_type3=$sql_get_detail_fetch['form3'];
                          $form_type4=$sql_get_detail_fetch['form4'];
                          $form_type5=$sql_get_detail_fetch['form5'];
                          $form_type6=$sql_get_detail_fetch['form6'];
                          $form_type7=$sql_get_detail_fetch['form7'];
                          $form_type8=$sql_get_detail_fetch['form8'];
                          $form_type8=$sql_get_detail_fetch['form9'];
                          $form_type8=$sql_get_detail_fetch['form10'];



                        }
                        // $form_type9=$form_type10=0;
                        ?>
                      <tr>

                       
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
    function get_village() {
      var form_type=$('#form_type').val();
    var employee_id=$('#employee_id').val();

    if(employee_id!=""){
      $.ajax({
        type:'POST',
        url:'MEO_report_get_information1.php',
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
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    // get_village();

} );
  </script>