<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Admin New User ";
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New User 
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li><a href="admin_userid_assign_view_userid_assign.php">User Information</a></li>
        <li><a href="admin_userid_assign_view_userid_assign.php">Assign User Info</a></li>
        <li><a href="admin_userid_assign_view_userid_assign.php"> View Assign  List Of User </a></li>        
        <li class="active"> Add New User </li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="text-center">
          <?php $msg->display(); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-10 col-md-offset-1">
          <div class="box box-primary">
            <div class="box-header with-border">

            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-user-plus"></i>

              <h3 class="box-title">Assign User To Village</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="admin_userid_assign_view_userid_assign.php" class="btn btn-info btn-sm" ><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Back </a>
              </div>
              <!-- /. tools -->
            </div>
          </div>
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div> -->

            <!-- /.box-header -->
            <!-- form start -->
            <form id="reli" role="form" method="POST" action="admin_users_save_info.php" autocomplete="off" onsubmit="return check_it();">
             <input type="hidden" id="form_type1" value="<?=web_encryptIt('Admin Add GP')?>">
              <input type="hidden" id="form_type2" value="<?=web_encryptIt('Admin Add Assigned user')?>">
              <input type="hidden"  id="web_gp" value="<?=web_encryptIt('gp_information')?>">
              <input type="hidden" id="web_village" value="<?=web_encryptIt('assigned_information')?>">
              <input type="hidden" name="form_type" value="<?=web_encryptIt('Admin Add user Info2')?>">
              <input type="hidden" name="web_district" id="web_user" value="<?=web_encryptIt('user_info_details2')?>">
              <div class="box-body">

                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="employee_id">Employee Name<span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <select class="form-control"  id="employee_id" name="employee_id" required="">
                        <option value="">--Please Select Crp--</option>
                       <?php 
                            $query_employee="SELECT * FROM `care_master_system_user` WHERE `status`='1' AND `level`='1'  ORDER BY `care_master_system_user`.`user_name` ASC";
                            $sql_exe=mysqli_query($conn,$query_employee);
                            while ($employee_result=mysqli_fetch_assoc($sql_exe)) {?>

                            <option value="<?=$employee_result['employee_id']?>"><?=strtoupper($employee_result['user_name'])?>[<?=$employee_result['employee_id']?>]</option>
                            
                           <?php  }
                       ?>
                      </select>
                    
                    </div>
                </div>
                <br>
                <br>
                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="District_name">Name Of The District <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <select class="form-control" onchange="get_block()" id="District_name" name="District_name" required="">
                        <option value="">--Please Select District--</option>
                      
                      <?php 
                      $query="SELECT * FROM `care_master_district_info` WHERE `care_dis_status`='1'";
                      $query_exe=mysqli_query($conn,$query);
                      while ($fetch=mysqli_fetch_assoc($query_exe)) {
                      ?>
                        <option value="<?php echo $fetch['care_dis_name'];?>"><?=$fetch['care_dis_name'];?></option>
                     <?php } ?>
                    
                      </select>  
                    </div>
                  </div>
                    <br>
                <br>
                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="block_name">Name Of The Block <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <select class="form-control" onchange="get_gp()" id="block_name" name="block_name" required="">
                        <option value="">--Please Select Block--</option>
                    
                      </select>
                     
                    </div>
                </div>
                <br>
                <br>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <table id="example" class="display" cellspacing="0" width="100%">
      
                    </table>
                  </div>
                </div>
                      </div>
              <!-- /.box-body -->

              <div class="box-footer text-center">
                <button type="submit" onclick="check_districts()" class="btn btn-primary">Submit</button>
              </div>
            </form>
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
  function get_block() {

    var form_type=$('#form_type1').val();
    var District_name=$('#District_name').val();
    var web_gp=$('#web_gp').val();
    if(District_name!=""){
      $.ajax({
        type:'POST',
        url:'admin_get_information.php',
        data:'field_info_name='+District_name+'&web_district_ids='+web_gp+'&form_type='+form_type,
        success:function(html){   
          $('#block_name').html(html);                    
        }
      });
    }else{
       get_gp();
      $('#block_name').html('<option value="">-- Please Select District --</option>');
    }
  }
  function get_gp() {
     var form_type=$('#web_user').val();
    var District_name=$('#District_name').val();
    var block_name=$('#block_name').val();
    var web_village=$('#web_user').val();
    if(District_name!=""){
      if(block_name!=""){
        $.ajax({
          type:'POST',
          url:'admin_get_information.php',
          data:'field_info_name='+block_name+'&web_district_ids='+web_village,
          success:function(html){   
            $('#example').html(html);                    
          }
        });
      }else{
        $('#example').html(' ');
      }
    }else{
      $('#block_name').html('<option value="">-- Please Select District --</option>');
      $('#example').html(' ');
    }
  }
  function check_it(){
    var len = $(".roomselect:checked").length;
            if(len==0 && len!=1){
                alert('Select Any one Village ');
                return false;
            }
  }
  $(document).ready(function() {
    $('#example').DataTable( 
        );
} );
</script>