<?php
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
 
$form_types=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       No of farmers imparted training on BCC and Goatery
       <!--  <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Interventions # 6:</li>
         <li class="active">Components D: </li>
        <!-- <li class="active"><a href="#">Number of HHs provided with training on improved technologies</a></li> -->
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
                 <?php include 'report_default.php'; ?>

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
           $get_detail="SELECT * FROM `care_master_mrf_exposure_visit_tarina_meo` WHERE `care_EV_them_intervention`='6' and `care_EV_vlg_name`='$village' and `care_EV_month`='$months' and `care_EV_year`='$Year'";
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
                   <table id="example" class="display" cellspacing="0" width="100%" style="">
                    <thead>
                      <tr  >
                        <th><h4><b>slno</b></h4></th>
                        <th><h4><b>Topic Covered</b></h4></th>
                        <th><h4><b>No of HHs provided with training</b></h4></th>
                        <th><h4><b>No of Men</b></h4></th>
                        <th><h4><b>No of Women</b></h4></th>
                       
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                         <th><h4><b>slno</b></h4></th>
                        <th><h4><b>Topic Covered</b></h4></th>
                        <th><h4><b>No of HHs provided with training</b></h4></th>
                        <th><h4><b>No of Men</b></h4></th>
                        <th><h4><b>No of Women</b></h4></th>
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
                        <td><?=$sql_get_detail_fetch['care_EV_topics_covered']?></td>
                        <td><?=$sql_get_detail_fetch['care_EV_no_of_hhs_covered_edit']?></td>
                        <td><?=$sql_get_detail_fetch['care_EV_male_Participants_edit']?></td>
                        <td><?=$sql_get_detail_fetch['care_EV_female_Participants_edit']?></td>
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
  