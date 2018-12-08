<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Admin New admin User ";
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New admin User 
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li><a href="admin_userid_view_userid.php">User Information</a></li>
        <li><a href="admin_userid_view_userid.php">Admin Info</a></li>
        <li><a href="admin_userid_view_userid.php"> View List Of admin User </a></li>        
        <li class="active"> Add New Admin User </li>
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

              <h3 class="box-title">Create New admin User</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="admin_userid_view_userid.php" class="btn btn-info btn-sm" ><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Back </a>
              </div>
              <!-- /. tools -->
            </div>
          </div>
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div> -->

            <!-- /.box-header -->
            <!-- form start -->
            <form id="reli" role="form" method="POST" action="admin_new_userid_save.php" autocomplete="off" >
              <input type="hidden" name="form_type" value="<?=web_encryptIt('Admin Add user Info')?>">
              <input type="hidden" name="web_district" id="web_user" value="<?=web_encryptIt('user_info_details')?>">
              <div class="box-body">

                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="user_roles">User Role<span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <select class="form-control" onchange="get_level_users()"  id="user_roles" name="user_roles" required="">
                        <option value="">--Please Select Role--</option>
                        
                        <option value="2">MT(Master Trainer)</option>
                        <option value="3">CBO(Capacity Building Officer)</option>
                        <option value="4">MEO(Monitoring and Evaluation Officer)</option>
                        <option value="5">Report User</option>
                     
                      </select>
                    
                    </div>
                </div>
                <br>
                <br>
                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="user_lable">User Level<span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <select class="form-control"  id="user_lable" name="user_lable" required="">
                        <option value="">--Please Select Level--</option>
                      </select>
                    
                    </div>
                </div>
                <br>
                <br>
                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="location">User Location<span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <select class="form-control"  id="location" name="location" required="">
                        <option value="">--Please Select location--</option>
                        <option value="kandhamal">kandhamal</option>
                        <option value="kalahandi">kalahandi</option>
                      </select>
                    </div>
                </div>
                <br>
                <br>
        
              <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="user_name">Name Of The User <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <input class="form-control" id="user_name" placeholder="Enter User" name="user_name" type="text" required="" onpaste="return false;">
                     
                    </div>
                </div> <br>
                <br>
                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="designation_name">Designation <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <input class="form-control"  id="designation_name" placeholder="Enter Designation" name="designation_name" type="text" required="" onpaste="return false;">
                     
                    </div>
                </div> <br>
                <br>
                
                 <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="email_id">Email Id <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <input class="form-control" id="email_id" placeholder="Enter Email Id" name="email_id" type="email" required="" onpaste="return false;">
                     
                    </div>
                </div> <br>
                <br>
                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="password_user">Password <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <input class="form-control" onkeyup="check_district(this)" id="password_user" placeholder="Enter Password" name="password_user" type="text" required="" onpaste="return false;">
                      <span id="error" style="color: red"></span>
                    </div>
                </div> <br>
                <br>
                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="mobile_no">Mobile No <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <input class="form-control"  id="mobile_no" placeholder="Enter Mobile No" name="mobile_no" type="text" required="" onpaste="return false;">
                 
                    </div>
                </div> <br>
                <br>
                      </div>
              <!-- /.box-body -->

              <div class="box-footer text-center">
                <button type="submit"  class="btn btn-primary">Submit</button>
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
  // function check_district(strInput){
  //   strInput.value=strInput.value.toLowerCase();
  //   var block_location=$('#employee_id').val();
  //   var web_block=$('#web_user').val();
  //   if(block_location!=""){              
  //           $.ajax({
  //               type:'POST',
  //               url:'admin_get_information.php',
  //               data:'field_info_name='+block_location+'&web_district_ids='+web_block,
  //               success:function(html){                 
  //                   if(html==1){
  //                       document.getElementById("error").innerHTML = "";
  //                       return false;
  //                       // $("#reli").submit(); 
  //                   }else{
  //                       document.getElementById("error").innerHTML = "Employee Id Record Is In our Record  ,"+block_location;
  //                       return false;
  //                   }
  //               }
  //           });
  //       }
  // }
  // function check_districts() {

  //   var block_name=$('#employee_id').val();
  //   var web_block=$('#web_user').val();
  //   if(block_name!=""){              
  //           $.ajax({
  //               type:'POST',
  //               url:'admin_get_information.php',
  //               data:'field_info_name='+block_name+'&web_district_ids='+web_block,
  //               success:function(html){                 
  //                   if(html==1){
  //                       document.getElementById("error").innerHTML = "";
  //                         // $("#reli").submit(); 
  //                       return true;
  //                   }else{
  //                       // document.getElementById("error").innerHTML = "Block Record Is In our Record  ,"+block_name;
  //                       $('#employee_id').val(' ');
  //                       return false;
  //                   }
  //               }
  //           });
  //       }else{
  //         return false;
  //       }
  // }
  function get_level_users(){
    var user_roles_id=$('#user_roles').val();
    if(user_roles_id!=""){
      $('#user_lable').html(' <option value="">--Please Select Level--</option>');
      $.ajax({
          type:'POST',
          url:'admin_get_information_user.php',
          data:'user_roles_id='+user_roles_id,
          success:function(html){                 
             alert(html);
                  // document.getElementById("error").innerHTML = "";
                    $("#user_lable").html(html); 
                
             
          }
      });
    }else{
      $('#user_lable').html(' <option value="">--Please Select Level--</option>');
    }

  }
  $('#password_user').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});
</script>