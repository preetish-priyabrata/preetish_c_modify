<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Admin Enter New Training ";
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Training
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home </a></li>
        <li><a href="admin_training_view_training.php"><i class="fa fa-gear"></i> General Setting </a></li>
        <li><a href="admin_training_view_training.php"> View List Of Training Thematic </a></li>
        <li class="active"> Add New Training Thematic </li>
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
                  <h3 class="box-title">Create New Training Thematic</h3>
                   <!-- tools box -->
                  <div class="pull-right box-tools">
                 <a href="admin_training_view_training.php" class="btn btn-info btn-sm" ><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Back </a>
              </div>
              <!-- /. tools -->
            </div>
          </div>
            <!-- /.box-header -->
            <!-- form start -->
          <form role="form" method="POST" action="admin_general_setting_save_information.php" onsubmit="return check_districts();">
            <input type="hidden" name="form_type" value="<?=web_encryptIt('Admin Add Training')?>">
              <input type="hidden" name="web_district" id="web_training" value="<?=web_encryptIt('training_information')?>">
                <div class="box-body">
                  <div class="form-group">
                    <label class="control-label col-sm-4 text-right" for="training_name">Name Of The Training <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <input class="form-control" onkeyup="ckeck_training(this)" id="training_name" placeholder="Enter Training" name="training_name" type="Training" required>
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
<script type="text/javascript">
  function ckeck_training(strInput){
    strInput.value=strInput.value.toLowerCase();
    var training_location=$('#training_name').val();
    var web_districts=$('#web_training').val();
    if(training_location!=""){              
            $.ajax({
                type:'POST',
                url:'admin_get_information.php',
                data:'field_info_name='+training_location+'&web_district_ids='+web_districts,
                success:function(html){                 
                    if(html==1){
                        document.getElementById("error").innerHTML = "";
                        
                        // $("#reli").submit(); 
                    }else{
                        document.getElementById("error").innerHTML = "Training Record Is In our Record  ,"+training_location;
                        
                        return false;
                    }
                }
            });
        }
  }
  function ckeck_trainings() {
    var training_location=$('#training_name').val();
    var web_districts=$('#web_training').val();
    if(training_location!=""){              
            $.ajax({
                type:'POST',
                url:'admin_get_information.php',
                data:'field_info_name='+training_location+'&web_district_ids='+web_districts,
                success:function(html){                 
                    if(html==1){
                        document.getElementById("error").innerHTML = "";
                        
                        return true;
                    }else{
                        document.getElementById("error").innerHTML = "Training Record Is In our Record  ,"+training_location;
                        $('#training_name').val(' ');
                        return false;
                    }
                }
            });
        }
  }
</script>