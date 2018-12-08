<?php
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Login History Of Diffrent user";
 
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
       
        <small>Get Login History of User Accessing System Through web Browser</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>      
        <li class="active">Get Login History</li>
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>
      <div class="panel panel-default">
            <div class="panel-body text-center">
      <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Report Login User</a></li>
            <!-- <li  class="active"><a data-toggle="tab" href="#menu1">Report Graphical</a></li> -->
      </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <h3>Report Login User</h3>
              <div class="table-responsive">
                <table id="example" class="display" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Slno</th>
                          <th>User Type Login</th>                         
                          <th>User Id </th>
                          <th>User Name</th>                          
                          <th>User Ip </th>
                          <th>user Browser</th>
                          <th>Lat/Long</th>
                          <th>Date /Time </th>
                        </tr>
                      </thead>
                      <!-- `slno`, `code_id`, `user_id`, `user_role`, `date_entry`, `time_entry`, `status_entry`, `user_ip`, `time_out`, `date_out`, `browser_details`, `ip_address_user`, `system_mac_id`, `session_id` -->
                      <?php 
                        $gets_login_histroy_query="SELECT * FROM `care_master_login_history`  ORDER by `slno` DESC LIMIT 2005 ";
                        $sql_exe=mysqli_query($conn,$gets_login_histroy_query);

                      ?>
                      <tbody>
                        <?php 
                        $x=0;
                          while ($result=mysqli_fetch_assoc($sql_exe)) {
                            $x++;
                        ?>
                        <tr>
                          <td><?=$x?></td>
                          <td><?php $user_role=$result['user_role'];
                                    switch ($user_role) {
                                      case '1':
                                        echo "Admin";
                                        $user_id=$result['user_id'];
                                        $query_login="SELECT * FROM `care_master_admin_info` where `cama_email`='$user_id' ";
                                        $sql_login=mysqli_query($conn,$query_login);
                                        $res=mysqli_fetch_assoc($sql_login);
                                        $user_name=$res['cama_username'];
                                        break;
                                      case '2':
                                        echo "MT USER";
                                         $user_id=$result['user_id'];
                                         $query_login="SELECT * FROM `care_master_admin_info` where `cama_email`='$user_id' ";
                                        $sql_login=mysqli_query($conn,$query_login);
                                        $res=mysqli_fetch_assoc($sql_login);
                                        $user_name=$res['cama_username'];
                                        break;
                                      case '3':
                                        echo "CBO USER";
                                         $user_id=$result['user_id'];
                                         $query_login="SELECT * FROM `care_master_admin_info` where `cama_email`='$user_id' ";
                                        $sql_login=mysqli_query($conn,$query_login);
                                        $res=mysqli_fetch_assoc($sql_login);
                                        $user_name=$res['cama_username'];
                                        break;
                                      case '4':
                                        echo "MEO USER";
                                         $user_id=$result['user_id'];
                                         $query_login="SELECT * FROM `care_master_admin_info` where `cama_email`='$user_id' ";
                                        $sql_login=mysqli_query($conn,$query_login);
                                        $res=mysqli_fetch_assoc($sql_login);
                                        $user_name=$res['cama_username'];
                                        break;
                                      case '5':
                                        echo "REPORT USER";
                                        $user_id=$result['user_id'];
                                        $query_login="SELECT * FROM `care_master_admin_info` where `cama_email`='$user_id' ";
                                        $sql_login=mysqli_query($conn,$query_login);
                                        $res=mysqli_fetch_assoc($sql_login);
                                        $user_name=$res['cama_username'];
                                        break;
                                      case '7':
                                        echo "CRP USER";
                                        $user_id=$result['user_id'];
                                        $query_login1="SELECT * FROM `care_master_system_user` where `employee_id`='$user_id' ";
                                        $sql_login1=mysqli_query($conn,$query_login1); 
                                        $res=mysqli_fetch_assoc($sql_login1);
                                        $user_name=$res['user_name'];
                                        break;
                                      
                                      default:
                                        echo "N/A";
                                        break;
                                    }
                          ?></td>

                          <td><?=$result['user_id']?></td>
                          <td><?=$user_name?></td>
                          <td><?=$result['user_ip']?></td>
                          <td><?=$result['browser_details']?></td>
                          <td><?=$result['system_mac_id']?></td>
                          <td><?=$result['date_entry']?>/<?=$result['time_entry']?></td>

                        </tr>

                        <?php
                          }
                        ?>
                      </tbody>
                       
                    </table>
               
              </div>
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
  