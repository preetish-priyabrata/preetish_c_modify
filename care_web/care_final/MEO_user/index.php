<?php
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DASHBOARD 
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li> -->
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <div class="panel panel-default">
            <div class="panel-heading">Last Login Details</div>
            <div class="panel-body">
              <table class="table table-condensed">
                <?php 
                // `slno`, `code_id`, `user_id`, `user_role`, `date_entry`, `time_entry`, `status_entry`, `user_ip`, `time_out`, `date_out`, `browser_details`, `ip_address_user`, `system_mac_id`, `session_id`
                $login_query="SELECT * FROM `care_master_login_history` WHERE `user_id` ='$_SESSION[meo_user]' and `status_entry`='2' ORDER by `slno` DESC";
                $sql_exe_login=mysqli_query($conn,$login_query); 
                $fetch_login=mysqli_fetch_assoc($sql_exe_login);
                ?>

                  <tbody>
                    <tr>
                      <td width="30%">Last Login Date / Time</td>
                      <td><?=$fetch_login['date_entry']?>/<?=$fetch_login['time_entry']?></td>
                    </tr>
                    <tr>
                      <td width="30%">Browser Detail</td>
                      <td><?=$fetch_login['browser_details']?></td>
                    </tr>
                    <tr>
                      <td width="30%">Login Ip Detail</td>
                      <td><?=$fetch_login['ip_address_user']?></td>
                    </tr>
                    <tr>
                      <td width="30%">Location Detail</td>
                      <td><?=$fetch_login['system_mac_id']?></td>
                    </tr>
                  </tbody>
                </tbody>
              </table>
            </div>
          </div>
          
        </div>
      </div>

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

