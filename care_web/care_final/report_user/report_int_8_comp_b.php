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
       No of farmers provided training on improved storing  
       <!--  <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Interventions # 8:</li>
         <li class="active">Components B: </li>
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
            $get_detail="SELECT * FROM `care_master_post_harvest_loss_meo` WHERE `care_PHL_villege_name`='$village' and `care_PHL_month`='$months' and `care_PHL_year`='$Year' and `care_CT_status_edit`='1' and `care_CT_subject_matter_edit`='1'";
          $sql_get_detail=mysqli_query($conn,$get_detail);

            $get_detail_s="SELECT * FROM `care_master_post_harvest_loss_meo` WHERE `care_PHL_villege_name`='$village' and `care_PHL_month`='$months' and `care_PHL_year`='$Year' and `care_DP_status_edit`='1' and `care_DP_subject_matter_edit`='1'";
          $sql_get_detail_s=mysqli_query($conn,$get_detail_s);

          // while ($sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail)) {
          //   # code...
          // }
          ?>
          <div class="row">

            <div class="col-xs-6">
              <div class="panel panel-default">
                <div class="panel-body text-center">
                  <div class="table-responsive">
                   <table id="example11" class="display" cellspacing="0" width="100%" style="">
                    <thead>
                      <tr  >
                        <th><h4><b>slno</b></h4></th>
                       
                        
                        <th><h4><b>No of Men</b></h4></th>
                        <th><h4><b>No of Women</b></h4></th>
                       
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                         <th><h4><b>slno</b></h4></th>
                        
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
                        
                        <td><?=$sql_get_detail_fetch['care_CT_male_present_edit']?></td>
                        <td><?=$sql_get_detail_fetch['care_CT_female_present_edit']?></td>
                      </tr>
                   <?php }?>
                  </tbody>
                 </tbody>
                </table>
               </div>
              </div>
             </div>
            </div>
            <div class="col-xs-6">
              <div class="panel panel-default">
                <div class="panel-body text-center">
                  <div class="table-responsive">
                   <table id="example12" class="display" cellspacing="0" width="100%" style="">
                    <thead>
                      <tr  >
                        <th><h4><b>slno</b></h4></th>
                        
                        <th><h4><b>No of Men</b></h4></th>
                        <th><h4><b>No of Women</b></h4></th>
                       
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                         <th><h4><b>slno</b></h4></th>
                        
                        <th><h4><b>No of Men</b></h4></th>
                        <th><h4><b>No of Women</b></h4></th>
                      </tr>
                    </tfoot>
                     <tbody>
                      <?php
                      $xi=0;
                      while ($sql_get_detail_fetch_s=mysqli_fetch_assoc($sql_get_detail_s)) {
                        $xi++;
                        // print_r($sql_get_detail_fetch);
                        ?>
                      <tr>
                        <td><?=$xi?></td>
                       
                        <td><?=$sql_get_detail_fetch_s['care_DP_male_present_edit']?></td>
                        <td><?=$sql_get_detail_fetch_s['care_DP_female_present_edit']?></td>
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
  