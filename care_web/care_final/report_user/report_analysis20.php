<?php
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Percentage of KG farmer received extension support by village";
  if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
      
      $months=$_POST['month'];
      $Year=$_POST['Year'];
      $District=$_POST['District'];
      $village=$_POST['village'];
      
    }else{
      $months="";
      $Year="";
      $District="";
      $village="";
     
       header('Location:logout.php');
      exit;
    }
  }else{
     $months="";
      $Year="";
      $District="";
      $village="";
      
      
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
       
        <small>Percentage of KG farmer received extension support by village</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">New Report </a></li>
        <li class="active">Report/Analysis 20</li>
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
                   <select class="form-control" id="District" name="District" onchange="get_dis_village()" required="">
                    <option value="">--Select District--</option>
                   <?php $get_village="SELECT * FROM `care_master_district_info` WHERE `care_dis_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_dis_name']?>"<?php if($District==$res_village['care_dis_name']){ echo "selected";} ?> ><?=strtoupper($res_village['care_dis_name'])?></option>
                          <?php
                        }?>
                  </select>
                  <label for="village">Village :</label>
                  <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>

                   <?php 
                    if($village!=""){
                    $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_district`='$District' order by `care_vlg_name` asc";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_vlg_name']?>"<?php if($village==$res_village['care_vlg_name']){ echo "selected";} ?> ><?=strtoupper($res_village['care_vlg_name'])?><option>
                          <?php
                         }
                        }?>
                    </select>
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
            <div id="home" class="tab-pane fade ">
              <h3>Report Tabular</h3>
              <div class="table-responsive">
                <?php
                  if(!empty($months)){                      
                    ?>
                     <table id="example" class="display" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Slno</th>                         
                          <th>Village Name</th>
                          <th>Percentage of KG farmer received extension support</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        <!-- queries -->
                        <?php
                          $x=0;
                          $total_count=0;
                          $total_area=0;
                          $total_female=0;
                          $get_village="SELECT * FROM `care_master_village_info`  WHERE `care_vlg_district`='$District'  ";
                          $sql_get_village=mysqli_query($conn,$get_village);
                          while($result_village=mysqli_fetch_assoc($sql_get_village)){
                            $care_vlg_name1=$result_village['care_vlg_name'];

                            $get_data="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_CRP_month`='$months' and `care_CRP_year`='$Year' and `care_CRP_vlg_name`='$care_vlg_name1' and `care_form_type`='2' and `care_IR_extension_support`='1' ";
                                $sql_get_data=mysqli_query($conn,$get_data);
                                $fetch_result=mysqli_num_rows($sql_get_data);

                                $get_data1="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_CRP_month`='$months' and `care_CRP_year`='$Year' and `care_CRP_vlg_name`='$care_vlg_name1' and `care_form_type`='2' ";
                                $sql_get_data1=mysqli_query($conn,$get_data1);
                                 $fetch_result1=mysqli_num_rows($sql_get_data1);
                              if($fetch_result1!=0 && $fetch_result!==0){
                               
                                 
                            $x++;
                            ?>
                            <tr>
                              <td><?=$x?></td>
                              <td><?=strtoupper($care_vlg_name=$result_village['care_vlg_name'])?></td>
                              <td> <?php echo "(".$fetch_result."X 100)/".$fetch_result1.")=" ?>
                                <?php echo round(($fetch_result*100)/$fetch_result1,2). "%"; ?></td>
                            

                            </tr>
                             
                          <?php }
                        }
                          ?>
                          
                            
                      </tbody>
                    </table>
                     
                <?php 
         

                  }
                ?>
              </div>
            </div>

             <!-- graph  -->
             <div id="menu1" class="tab-pane fade in active">
                <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['Village ', 'Percentage of KG extension support'],
                       <?php
                          $get_village_sc="SELECT * FROM `care_master_village_info`  WHERE `care_vlg_district`='$District'  ";
                          $sql_get_village_sc=mysqli_query($conn,$get_village_sc);
                          while($result_village_sc=mysqli_fetch_assoc($sql_get_village_sc)){
                            $care_vlg_name1_sc=$result_village_sc['care_vlg_name'];

                             $get_data_sc="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_CRP_month`='$months' and `care_CRP_year`='$Year' and `care_CRP_vlg_name`='$care_vlg_name1_sc' and `care_form_type`='2' and `care_IR_extension_support`='1' ";
                                $sql_get_data_sc=mysqli_query($conn,$get_data_sc);
                                $fetch_result_sc=mysqli_num_rows($sql_get_data_sc);

                                $get_data1_sc="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_CRP_month`='$months' and `care_CRP_year`='$Year' and `care_CRP_vlg_name`='$care_vlg_name1_sc' and `care_form_type`='2' ";
                                $sql_get_data1_sc=mysqli_query($conn,$get_data1_sc);
                                 $fetch_result1_sc=mysqli_num_rows($sql_get_data1_sc);
                              if($fetch_result1_sc!=0 && $fetch_result_sc!==0){
                                  $result=round(($fetch_result_sc*100)/$fetch_result1_sc,2);
                                
                                  echo "['".strtoupper($care_vlg_name=$result_village_sc[care_vlg_name])."',".$result."],";
                                }


                              }?>
                    
                    ]);

                    var options = {
                      title: 'Percentage of KG farmer received extension support'
                    };

                    var chart = new google.visualization.BarChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                  }
                </script>
                
                  <div class="row">
                    <div class="col-xs-12">
                     
                      <div class="col-sm-2"><div id="piechart" style="width: 900px; height: 500px;"></div></div>
                      
                    </div>
                  </div>

            </div>
            <!-- over of graph -->
                      
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
    function get_dis_village() {
      var form_type="v9";
    var District=$('#District').val();

    if(District!=""){
      $.ajax({
        type:'POST',
        url:'report_MEO_get_information.php',
        data:'field_info_name='+District+'&form_type='+form_type,
        success:function(html){
          $('#village').html(html);
        }
      });
    }else{
      $('#village').html('<option value="">-- Please Select District --</option>');
    }
    }
  </script>
 