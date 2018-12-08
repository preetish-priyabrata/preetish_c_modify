<?php
session_start();
ob_start();
// ini_set('display_errors',1);
if($_SESSION['meo_user']){
  $form_types=$_SESSION['form_type'];
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Average size of influenced farmer land size";
  if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
      
      $months=$_POST['month'];
      $Year=$_POST['Year'];
      
    }else{
      $months="";
      $Year="";
      
      header('Location:logout.php');
      exit;
    }
  }else{
     $months="";
      $Year="";
      
  }
  $location_user=$_SESSION['location_user'];

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      
        <small>Average size of influenced farmer land size</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">New Report </a></li>
        <li class="active">Report/Analysis 17</li>
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
            <!-- <li><a data-toggle="tab" href="#menu2">Menu 2</a></li> -->
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade ">
              <h3>Report Tabular</h3>
              <div class="table-responsive">
                <table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Slno</th>                         
                      <th>Village Name</th>
                      <th>No of Entry</th>
                      <th>Sum Area Influenced farmer land size</th>
                      <!-- Average size of influenced farmer land size -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                          $x=0;
                          $frame='1';
                          $total_count=0;
                          $total_area=0;
                          $total_female=0;
                          $get_village="SELECT * FROM `care_master_village_info` where `care_vlg_district`='$location_user' ";
                          $sql_get_village=mysqli_query($conn,$get_village);
                          while($result_village=mysqli_fetch_assoc($sql_get_village)){
                            $care_vlg_name1=$result_village['care_vlg_name'];
                            $get_datas="SELECT AVG(`care_area_cultivated`),sum(`care_area_cultivated`),COUNT(*) FROM `care_master_crop_diversification_crp` WHERE `care_CRP_month`='$months' and `care_CRP_year`='$Year' and `care_CRP_vlg_name`='$care_vlg_name1' and `care_form_type`='$frame' and `care_demo_plot_farmer`='2' ";
                            $sql_get_datas=mysqli_query($conn,$get_datas);
                                 $fetch_result=mysqli_fetch_row($sql_get_datas);
                                if($fetch_result[1]!=""){
                               
                                  $total_count=$fetch_result[2]+$total_count;
                                  $total_area=$fetch_result[1]+$total_area;
                            $x++;
                            ?>
                    <tr>
                      <td><?=$x?></td>
                      <td><?=strtoupper($care_vlg_name=$result_village['care_vlg_name'])?></td>
                      <td><?=$fetch_result[2]?></td>
                      <td><?=$fetch_result[1]?></td>

                    </tr>
                          <?php }
                        }

                          ?>
                    <tr>
                      <th colspan="2">
                      Total</th>
                      <td><?=$total_count?></td>
                      <td><?=$total_area?></td>
                    </tr>
                    <tr>
                      <th colspan="3">
                      Average size of influenced farmer land size of  <?php if($frame==1){
                       
                      echo "Crop diversification";}?> <?php if($frame==2){
                        
                        echo "KG";}?></th>
                      <td><?php echo  $total_area ." / ".$total_count." = ".$avg=$total_area/$total_count?></td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
           
             <div id="menu1" class="tab-pane fade in active">

                <script type="text/javascript">
                 google.charts.load('current', {'packages':['bar']});
                  google.charts.setOnLoadCallback(drawStuff);

                  function drawStuff() {

                      var data = google.visualization.arrayToDataTable([
                       ['village',  'Area Of KG '],
                        <?php 
                        
                        $get_village_sc="SELECT * FROM `care_master_village_info` where `care_vlg_district`='$location_user' ";
                          $sql_get_village_sc=mysqli_query($conn,$get_village_sc);
                          while($result_village_sc=mysqli_fetch_assoc($sql_get_village_sc)){
                            $care_vlg_name1_sc=$result_village_sc['care_vlg_name'];
                            $get_datas_sc="SELECT AVG(`care_area_cultivated`),sum(`care_area_cultivated`),COUNT(*) FROM `care_master_crop_diversification_crp` WHERE `care_CRP_month`='$months' and `care_CRP_year`='$Year' and `care_CRP_vlg_name`='$care_vlg_name1_sc' and `care_form_type`='$frame' and `care_demo_plot_farmer`='2'  ";
                            $sql_get_datas_sc=mysqli_query($conn,$get_datas_sc);
                                $fetch_results_sc=mysqli_fetch_row($sql_get_datas_sc);
                                if($fetch_results_sc[1]!=""){
                                
                                  echo "['".strtoupper($care_vlg_name=$result_village_sc[care_vlg_name])."',".$fetch_results_sc[1]."],";
                                }


                              }?>
                        
                      ]);
                
                      var options = {
                        title: 'Average size of influenced farmer land size of <?php if($crops==1){echo "Crop diversification";} if($crops==2){echo "KG";}?> <?=$avg?>',
                        chartArea: {width: '80%'},
                         isStacked: true,
                        hAxis: {
                          title: 'Area Size  ',
                          minValue: 0
                        },
                        vAxis: {
                          title: 'Village'
                        }
                      };

                      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

                      chart.draw(data, options);
                    }
              </script>
                  <div class="row">
                    <div class="col-xs-12">
                     
                      <div class="col-sm-2"><div id="chart_div" style="width: 900px; height: 500px;"></div></div>
                      
                    </div>
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