<?php
session_start();
ob_start();
// ini_set('display_errors',1);
if($_SESSION['meo_user']){
  $location_user=$_SESSION['location_user'];
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Number of training conducted intervention wise by village wise in the reported month";
  if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
      $thematic_interventions=$_POST['thematic_interventions'];
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <small>Number of training conducted intervention wise by CRP wise in the reported month</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">New Report </a></li>
        <li class="active">Report/Analysis 3</li>
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
                  <label for="village">Intervention :</label>
                 
                   <select class="form-control"  name="thematic_interventions" id="thematic_interventions" required="">
                            <option value="">--Select Thematic Intervention--</option>
                            <?php 
                                $get_traget="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                  ?>
                                   <option value="<?=$traget_fetch['care_thi_slno']?>" <?php if($thematic_interventions==$traget_fetch['care_thi_slno']){ echo "selected";} ?> ><?=$traget_fetch['care_thi_thematic_name']?></option>
                                  
                                  <?php
                                }
                                ?>
                      </select>

                  <label for="village">CRP :</label>
               
                  <select class="form-control" id="employee_id"  name="employee_id" required="">
                    <option value="">--Select CRP--</option>
                   <?php
                      if($form_types=='0'){
                        $get_employee="SELECT * FROM `care_master_system_user`  WHERE `level`='1' and `assign_status`='1' and `status`='1' ";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                      }else{
                        $get_employee="SELECT DISTINCT `care_master_system_user`.`employee_id`,`care_master_system_user`.`user_name` FROM `care_master_system_user` INNER JOIN `care_master_assigned_user_info` ON `care_master_system_user`.`employee_id`=`care_master_assigned_user_info`.`care_assU_employee_id` AND `care_master_assigned_user_info`.`care_assU_district_id`='$location_user' and `care_master_assigned_user_info`.`status`='1' WHERE `care_master_system_user`.`status`='1' and `care_master_system_user`.`assign_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                        }
                        ?>

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


          ?>
          <div class="panel panel-default">
            <div class="panel-body text-center">
          <ul class="nav nav-tabs">
            <li ><a data-toggle="tab" href="#home">Report Tabular</a></li>
            <li class="active"><a data-toggle="tab" href="#menu1">Report Graphical</a></li>
           <!--  <li><a data-toggle="tab" href="#menu2">Menu 2</a></li> -->
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <h3>Report Tabular</h3>
              <div class="table-responsive">
                <?php 
                  if(!empty($thematic_interventions) && empty($employee_id)){
                    // $get_employee_details="SELECT * FROM `care_master_assigned_user_info` WHERE `status`='1'";
                      $get_employee_details= "SELECT * FROM `care_master_system_user` WHERE `status`='1'";
                    $sql_exe_employee=mysqli_query($conn,$get_employee_details);
                        
                ?>
                <table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Employee Name</th>
                      <th>No Of Training</th>                        
                    </tr>
                  </thead>
                  <tbody>
                  

                <?php
                  while ($res_employee=mysqli_fetch_assoc($sql_exe_employee)) {
                    $care_assU_employee_id=$res_employee['employee_id'];

                    
                  // $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_gp`='$village'";
                  // $sql_get_village=mysqli_query($conn,$get_village);
                  // while($result_village=mysqli_fetch_assoc($sql_get_village)){
                    ?>
                    <tr>
                      <td><?php echo $res_employee['user_name'];?></td>
                      <td>
                        <?php
                        $get_data="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_them_intervention`='$thematic_interventions' and `care_EV_employee_id`='$care_assU_employee_id'";
                    
                    $sql_get_data=mysqli_query($conn,$get_data);
                    echo mysqli_num_rows($sql_get_data);
                ?>
                  </td>
                   </tr>
              <?php   }
                ?>
             
            </tbody>
          </table>
        <?php }else if(empty($thematic_interventions) && !empty($employee_id)){
            $get_traget1="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
            $sql_exe_traget1=mysqli_query($conn,$get_traget1);
            ?>
            <table id="example" class="display" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Intervention Name</th>
                  <th>No Of Training</th>                        
                </tr>
              </thead>
              <tbody>
              <?php
              $care_assU_employee_id=$employee_id;
              while ($traget_fetch1=mysqli_fetch_assoc($sql_exe_traget1)) {
                $care_thi_slno=$traget_fetch1['care_thi_slno'];

          ?>
          <tr>
             <td><?php echo $traget_fetch1['care_thi_thematic_name'];?></td>
                      <td>
                        <?php
                        $get_data="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_them_intervention`='$care_thi_slno' and `care_EV_employee_id`='$care_assU_employee_id'";
                    
                    $sql_get_data=mysqli_query($conn,$get_data);
                    echo mysqli_num_rows($sql_get_data);
                ?>
                  </td>
                </tr>
              <?php }?>
                </tbody>
              </table>

          <?php
        } else if(!empty($thematic_interventions) && !empty($employee_id)){
          ?>
            <table id="example" class="display" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Intervention Name</th>
                  <th>Intervention Name</th>
                  <th>No Of Training</th>                        
                </tr>
              </thead>
              <tbody>             
          <tr>
             <td><?php

                   $get_traget1="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_slno`='$thematic_interventions' and  `care_thi_status`='1'";
                  $sql_exe_traget1=mysqli_query($conn,$get_traget1);
                  $traget_fetch1=mysqli_fetch_assoc($sql_exe_traget1);
                  echo $traget_fetch1['care_thi_thematic_name'];?>
                
              </td>
              <td>
                <?php  
                    $get_employee_details= "SELECT * FROM `care_master_system_user` WHERE `status`='1' and `employee_id`='$employee_id'";
                    $sql_exe_employee=mysqli_query($conn,$get_employee_details);
                    $res_employee=mysqli_fetch_assoc($sql_exe_employee);
                    echo $res_employee['user_name'];
                     ?>
                       
              </td>
              <td>
                <?php
                        
                    $get_data="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_them_intervention`='$thematic_interventions' and `care_EV_employee_id`='$employee_id'";
                    $sql_get_data=mysqli_query($conn,$get_data);
                    echo mysqli_num_rows($sql_get_data);
                ?>
                  </td>
                </tr>
             
                </tbody>
              </table>
          <?php

        }else{
          echo "<b class='text-center'>Not Possible</b>";
        }
        ?>
        </div>
            </div>
            <div id="menu1" class="tab-pane fade">
              <?php 
                  if(!empty($thematic_interventions) && empty($employee_id)){
                    // $get_employee_details="SELECT * FROM `care_master_assigned_user_info` WHERE `status`='1'";
                     
                        
                ?>
                <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                  var data = google.visualization.arrayToDataTable([
                    ['CRP List', 'No Of Training'],
                    <?php
                       $get_employee_details_script= "SELECT * FROM `care_master_system_user` WHERE `status`='1'";
                      $sql_exe_employee_script=mysqli_query($conn,$get_employee_details_script);
                      while ($res_employee_script=mysqli_fetch_assoc($sql_exe_employee_script)) {
                          $care_assU_employee_id_script=$res_employee_script['employee_id'];
                          $user_name=$res_employee_script['user_name'];
                           $get_data_script="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_them_intervention`='$thematic_interventions' and `care_EV_employee_id`='$care_assU_employee_id_script'";  
                            $sql_get_data_script=mysqli_query($conn,$get_data_script);
                      
                    echo "['".strtoupper($user_name)."',".mysqli_num_rows($sql_get_data_script)."],";
                    }
                    ?>  
                  
                  ]);

                  var options = {
                    title: 'Training Report intervention',
                    width: 600,
        
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                  chart.draw(data, options);
                }
              </script>
               <div id="piechart" style="width: 900px; height: 500px;"></div>


              <?php }else if(empty($thematic_interventions) && !empty($employee_id)){ ?>
                <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                  var data = google.visualization.arrayToDataTable([
                    ['Intervention', 'No Of Training'],
                    <?php
                       $get_traget1_script="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
                      $sql_exe_traget1_script=mysqli_query($conn,$get_traget1_script);
                      $care_assU_employee_id=$employee_id;
                      while ($traget_fetch1=mysqli_fetch_assoc($sql_exe_traget1_script)) {
                      $care_thi_slno=$traget_fetch1['care_thi_slno'];
                      $care_thi_thematic_name=$traget_fetch1['care_thi_thematic_name'];
                          $get_data_script="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_them_intervention`='$care_thi_slno' and `care_EV_employee_id`='$care_assU_employee_id'";
                    
                    $sql_get_data_script=mysqli_query($conn,$get_data_script);
                      
                    echo "['".strtoupper($care_thi_thematic_name)."',".mysqli_num_rows($sql_get_data_script)."],";
                    }
                    ?>  
                  
                  ]);

                  var options = {
                    title: 'Training Report Intervention',
                    width: 600,
        
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                  chart.draw(data, options);
                }
              </script>
               <div id="piechart" style="width: 900px; height: 500px;"></div>


              <?php  }else if(!empty($thematic_interventions) && !empty($employee_id)){ ?>

                <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['Intervention', 'No Of Training'],
                      <?php
                          $get_traget1="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_slno`='$thematic_interventions' and  `care_thi_status`='1'";
                          $sql_exe_traget1=mysqli_query($conn,$get_traget1);
                          $traget_fetch1=mysqli_fetch_assoc($sql_exe_traget1);
                          $care_thi_thematic_name= $traget_fetch1['care_thi_thematic_name'];

                           $get_employee_details= "SELECT * FROM `care_master_system_user` WHERE `status`='1' and `employee_id`='$employee_id'";
                    $sql_exe_employee=mysqli_query($conn,$get_employee_details);
                    $res_employee=mysqli_fetch_assoc($sql_exe_employee);
                     $user_name=$res_employee['user_name'];
                     $get_data_script="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_them_intervention`='$thematic_interventions' and `care_EV_employee_id`='$employee_id'";
                      $sql_get_data_script=mysqli_query($conn,$get_data_script);
                        
                      echo "['".strtoupper($care_thi_thematic_name."/".$user_name)."',".mysqli_num_rows($sql_get_data_script)."],";
                      
                      ?>  
                    
                    ]);

                    var options = {
                      title: 'Training Report Intervention',
                      width: 600,
          
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                  }
              </script>
               <div id="piechart" style="width: 900px; height: 500px;"></div>

              <?php }else{
                 echo "<b class='text-center'>Not Possible</b>";
              }?>
            
            </div>
            <div id="menu2" class="tab-pane fade">
              <h3>Menu 2</h3>
              <p>Some content in menu 2.</p>
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
      var form_type=$('#form_type').val();
    var employee_id=$('#employee_id').val();

    if(employee_id!=""){
      $.ajax({
        type:'POST',
        url:'report_get_information1.php',
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