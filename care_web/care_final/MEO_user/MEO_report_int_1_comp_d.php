<?php
session_start();
ob_start();
if($_SESSION['meo_user']){
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
        Number of linkages established
       <!--  <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Interventions # 1:</li>
         <li class="active">Components D : </li>
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
                 <?php include 'MEO_report_default.php'; ?>

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
          $get_detail="SELECT * FROM `care_master_MRF_SHG_tracking_under_TARINA_meo` WHERE `care_SHG_vlg_name`='$village' and `care_SHG_month`='$months' and `care_SHG_year`='$Year'";
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
                   <table id="example11" class="display" cellspacing="0" width="100%" style="">
                    <thead>
                      <tr  >
                        <th><h4><b>slno</b></h4></th>
                        <th><h4><b>SHG Name</b></h4></th>
                        <th><h4><b>Linkage Extenal Credit</b></h4></th>
                        <th><h4><b>Member Link To Market</b></h4></th>
                        <th><h4><b>No Of Member Link To Suport</b></h4></th>
                        <th><h4><b>No Of Linkage To Any committee</b></h4></th>
                       
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                         <th><h4><b>slno</b></h4></th>
                        <th><h4><b>SHG Name</b></h4></th>
                        <th><h4><b>Linkage Extenal Credit</b></h4></th>
                        <th><h4><b>Member Link To Market</b></h4></th>
                        <th><h4><b>No Of Member Link To Suport</b></h4></th>
                        <th><h4><b>No Of Linkage To Any committee</b></h4></th>
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
                        <td><?=$sql_get_detail_fetch['care_SHG_name']?></td>
                        <td><?=$sql_get_detail_fetch['care_SHG_ML_linkage_external_credit_edit']?></td>
                        <td><?=$sql_get_detail_fetch['care_SHG_ML_no_of_mem_link_market_edit']?></td>
                        <td><?=$sql_get_detail_fetch['care_SHG_ML_no_of_mem_link_tech_support_provider_edit']?></td>
                        <td><?=$sql_get_detail_fetch['care_SHG_no_of_mem_link_any_committee_edit']?></td>
                        <!-- <td><?=$sql_get_detail_fetch['care_SHG_MEO_date']?></td> -->
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
  