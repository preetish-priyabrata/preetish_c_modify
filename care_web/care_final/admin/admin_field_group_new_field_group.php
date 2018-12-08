<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Admin View Farmer Field School Group List";
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Farmer Field School Group 
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="admin_field_group_view_field_group.php"><i class="fa fa-map-marker"></i>Farmer Management</a></li>
        <li><a href="admin_field_group_view_field_group.php"><i class="fa fa-map-marker"></i>View Farmer Field School Group List</a></li>
        <li class="active"> Add New Group </li>
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
              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">Create New Farmer Field School Group</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="admin_field_group_view_field_group.php" class="btn btn-info btn-sm" ><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Back </a>
              </div>
              <!-- /. tools -->
            </div>
          </div>
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div> -->

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="admin_field_group_save_field_group.php">
             <input type="hidden" name="form_type" value="<?=web_encryptIt('Admin Add field group')?>">
            <!--   <input type="hidden" name="web_district" id="web_district" value="<?=web_encryptIt('district_information')?>"> -->
              <div class="box-body">

                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" >Name Of The Farmer Field School Group <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <input class="form-control"  placeholder="Enter Farmer Field School Group" name="care_famer_field_group_name" type="text" required>
                      <span id="error" style="color: red"></span>
                    </div>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
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
<!-- <script type="text/javascript">
  function check_district(strInput){
    strInput.value=strInput.value.toLowerCase();
    var district_location=$('#District_name').val();
    var web_districts=$('#web_district').val();
    if(district_location!=""){              
            $.ajax({
                type:'POST',
                url:'admin_get_information.php',
                data:'field_info_name='+district_location+'&web_district_ids='+web_districts,
                success:function(html){                 
                    if(html==1){
                        document.getElementById("error").innerHTML = "";
                        
                        // $("#reli").submit(); 
                    }else{
                        document.getElementById("error").innerHTML = "District Record Is In our Record  ,"+district_location;
                        
                        return false;
                    }
                }
            });
        }
  }
  function check_districts() {

   var district_location=$('#District_name').val();
    var web_districts=$('#web_district').val();
    if(district_location!=""){              
            $.ajax({
                type:'POST',
                url:'admin_get_information.php',
                data:'field_info_name='+district_location+'&web_district_ids='+web_districts,
                success:function(html){                 
                    if(html==1){
                        document.getElementById("error").innerHTML = "";
                        
                        return true;
                    }else{
                        document.getElementById("error").innerHTML = "District Record Is In our Record  ,"+district_location;
                        $('#District_name').val(' ');
                        return false;
                    }
                }
            });
        }
  }
</script> -->