<?php
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Male female ratio of the participants in the training in the reported month";
  if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
      
      $months=$_POST['month'];
      $Year=$_POST['Year'];
       $District=$_POST['District'];
    }else{
      $months="";
      $Year="";
      $District='';
     
       header('Location:logout.php');
      exit;
    }
  }else{
     $months="";
      $Year="";
     $District='';
      
  }
$form_types=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];
?>
<!-- =============================================== -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script> -->
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});     
      </script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       
        <small>Male female ratio of the participants in the training in the reported monthh</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">New Report </a></li>
        <li class="active">Report/Analysis 10</li>
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
                 <label for="District">District :</label>
              
                   <select class="form-control" id="District" name="District"  required="">
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
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade">
              <h3>Report Tabular</h3>
              <div class="table-responsive">
                <?php
                  if(!empty($months)){                      
                    ?>
                    <table id="example" class="display" cellspacing="0" width="100%">
                      <!-- <thead>
                        <tr id="filters">                         
                          <th>Average duration Of Session</th>
                        </tr>
                      </thead> -->
                      <tbody>
                        <tr>
                          <th>Male : Female </th>
                          <td>
                              <?php
                              $get_data="SELECT AVG(`care_EV_male_Participants`),AVG(`care_EV_female_Participants`),SUM(`care_EV_male_Participants`),Sum(`care_EV_female_Participants`),COUNT(*) FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_district_name`='$District' ";
                                $sql_get_data=mysqli_query($conn,$get_data);
                                $fetch_result=mysqli_fetch_row($sql_get_data);
                                // print_r($fetch_result);
                                // 
                                if(!empty($fetch_result[2]) && !empty($fetch_result[3])){
                                function GCD ($a, $b){
                                  while ( $b != 0){
                                      $remainder = $a % $b;
                                      $a = $b;
                                      $b = $remainder;
                                  }
                                  return abs ($a);
                                }

                                  $ax = $fetch_result[2];
                                  $bx = $fetch_result[3];

                                  $var = GCD ($ax,$bx);

                                  print $ax/$var .':'.$bx/$var;
                                  $ratio1=$ax/$var;
                                  $ratio2=$bx/$var;
                                }else{
                                  echo "0:0";
                                  $ratio1=0;
                                  $ratio2=0;
                                }
                                // echo mysqli_num_rows($sql_get_data);
                              ?>
                          </td>
                        </tr>
                            
                      
                      </tbody>
                    </table>
                <?php 
         

                  }
                ?>
              </div>
            </div>
             <div id="menu1" class="tab-pane fade in active">

                <script type="text/javascript">
                 google.charts.load('current', {'packages':['bar']});
                  google.charts.setOnLoadCallback(drawStuff);

                  function drawStuff() {

                      var data = google.visualization.arrayToDataTable([
                       ['Ratio', 'Male', 'Female'],
                        <?php
                                // print_r($fetch_results);
                                
                                  echo "['Ratio Male : Female',".$ratio1.",".$ratio2."],";
                               


                              ?>
                        // ['New York City, NY', 8175000],
                        // ['Los Angeles, CA', 3792000],
                        // ['Chicago, IL', 2695000],
                        // ['Houston, TX', 2099000],
                        // ['Philadelphia, PA', 1526000]
                      ]);
      //                 var options = {
      //   title: 'Population of Largest U.S. Cities',
      //   chartArea: {width: '50%'},
      //   isStacked: true,
      //   hAxis: {
      //     title: 'Total Population',
      //     minValue: 0,
      //   },
      //   vAxis: {
      //     title: 'City'
      //   }
      // };
                      var options = {
                        title: 'Ratio Male : Female <?=$ratio1.":".$ratio2?>',
                        chartArea: {width: '80%'},
                         isStacked: true,
                        hAxis: {
                          title: 'Nos',
                          minValue: 0
                        },
                        vAxis: {
                          title: 'Details'
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
  