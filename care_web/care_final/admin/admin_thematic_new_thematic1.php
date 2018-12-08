<?php
session_start();
ob_start();
print_r($_SESSION);
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Admin Enter New Thematic Interventions ";
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Thematic Interventions 
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home </a></li>
        <li><a href="admin_thematic_view_thematic.php"><i class="fa fa-gear"></i> General Setting </a></li>
        <li><a href="admin_thematic_view_thematic.php"> View Thematic Interventions List </a></li>
        <li class="active"> Add New Thematic Interventions </li>
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

              <h3 class="box-title">Create New Thematic Interventions</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="admin_thematic_view_thematic.php" class="btn btn-info btn-sm" ><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Back </a>
              </div>
              <!-- /. tools -->
            </div>
          </div>
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div> -->

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="admin_general_setting_save_information.php" onsubmit="return check_districts();">
              <input type="hidden" name="form_type" value="<?=web_encryptIt('Admin Add Thematic Interventions')?>">
              <input type="hidden" name="web_district" id="web_id" value="<?=web_encryptIt('Thematic_Interventions')?>">
              <div class="box-body">

                <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="thematic_name">Name Of The Thematic Interventions <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <input class="form-control" onkeyup="check_district(this)" id="thematic_name" placeholder="Enter Thematic Interventions" name="thematic_name" type="District" required>
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
  function check_district(strInput){
    strInput.value=strInput.value.toLowerCase();
    var thematic_name=$('#thematic_name').val();
    var web_districts=$('#web_id').val();
    if(thematic_name!=""){              
            $.ajax({
                type:'POST',
                url:'admin_get_information.php',
                data:'field_info_name='+thematic_name+'&web_district_ids='+web_districts,
                success:function(html){                 
                    if(html==1){
                        document.getElementById("error").innerHTML = "";
                        
                        // $("#reli").submit(); 
                    }else{
                        document.getElementById("error").innerHTML = "District Record Is In our Record  ,"+thematic_name;
                        
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
                        document.getElementById("error").innerHTML = "Thematic Interventions Record Is In our Record  ,"+district_location;
                        $('#District_name').val(' ');
                        return false;
                    }
                }
            });
        }
  }
</script>