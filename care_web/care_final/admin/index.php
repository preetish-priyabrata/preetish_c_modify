<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of Admin Officer";
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
      <br>
      <br>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
              $query_list_admin="SELECT * FROM `care_master_admin_info` WHERE `location_user`!='1' and `cama_status`='1' ";
              $sql_exe_admin=mysqli_query($conn,$query_list_admin); 
              ?>
              <h3><?=mysqli_num_rows($sql_exe_admin)?></h3>

              <p>Admin User Registered</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="admin_view_userid.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
              $query_list_crp="SELECT * FROM `care_master_system_user` where `status`='1' ";
              $sql_exe_crp=mysqli_query($conn,$query_list_crp);
              ?>
              <h3><?=mysqli_num_rows($sql_exe_crp)?></h3>

              <p>CRP User Registered</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="admin_userid_view_userid.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-6 col-xs-6">
          <div class="panel panel-default">
            <div class="panel-heading">Last Login Details</div>
            <div class="panel-body">
              <table class="table table-condensed">
                <?php 
                // `slno`, `code_id`, `user_id`, `user_role`, `date_entry`, `time_entry`, `status_entry`, `user_ip`, `time_out`, `date_out`, `browser_details`, `ip_address_user`, `system_mac_id`, `session_id`
                $login_query="SELECT * FROM `care_master_login_history` WHERE `user_id` ='$_SESSION[admin]' and `status_entry`='2' ORDER by `slno` DESC";
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
    <!-- <section class="content">

    </section> -->
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

// $seconds_ago = (time() - strtotime('2014-01-06 15:25:08'));

// if ($seconds_ago >= 31536000) {
//     echo "Seen " . intval($seconds_ago / 31536000) . " years ago";
// } elseif ($seconds_ago >= 2419200) {
//     echo "Seen " . intval($seconds_ago / 2419200) . " months ago";
// } elseif ($seconds_ago >= 86400) {
//     echo "Seen " . intval($seconds_ago / 86400) . " days ago";
// } elseif ($seconds_ago >= 3600) {
//     echo "Seen " . intval($seconds_ago / 3600) . " hours ago";
// } elseif ($seconds_ago >= 60) {
//     echo "Seen " . intval($seconds_ago / 60) . " minutes ago";
// } else {
//     echo "Seen less than a minute ago";
// }