<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Admin View Block Location List";
?>
<!--===============================================-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Gram Panchayat 
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="admin_gp_view_gp.php"><i class="fa fa-map-marker"></i>Location Name</a></li>
        <li><a href="admin_gp_view_gp.php"><i class="fa fa-map-marker"></i>View Gram Panchayat List</a></li>
        <li class="active"> Add New Gram Panchayat </li>
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
                 <h3 class="box-title">Create New Gram Panchayat</h3>
                 <!-- tools box -->
                 <div class="pull-right box-tools">
                <a href="admin_gp_view_gp.php" class="btn btn-info btn-sm" ><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Back </a>
              </div>
              <!-- /. tools -->
            </div>
          </div>
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div> -->
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="admin_location_save_information.php" onsubmit="return check_form(this);">
              <input type="hidden" name="form_type" id="form_type" value="<?=web_encryptIt('Admin Add GP')?>">
                <input type="hidden" name="web_district" id="web_gp" value="<?=web_encryptIt('gp_information')?>">
                  <div class="box-body">
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
                      <select class="form-control"  id="block_name" name="block_name" required="">
                        <option value="">--Please Select Block--</option>
                    
                      </select>
                     
                    </div>
                </div>
                <br>
                <br>
               <div class="form-group">
                  <label class="control-label col-sm-4 text-right" for="gp_name">Name Of The GP <span  style="color: red">*</span></label>
                    <div class="col-sm-8">
                      <input class="form-control" onkeyup="check_district(this)" id="gp_name" placeholder="Enter GP" name="gp_name" type="text" required="" onpaste="return false;">
                      <span id="error" style="color: red"></span>
                    </div>
                </div>
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
  function check_district(strInput){
    strInput.value=strInput.value.toLowerCase();
    var gp_name=$('#gp_name').val();
    var web_gp=$('#web_gp').val();
    if(gp_name!=""){              
            $.ajax({
                type:'POST',
                url:'admin_get_information.php',
                data:'field_info_name='+gp_name+'&web_district_ids='+web_gp,
                success:function(html){                 
                    if(html==1){
                        document.getElementById("error").innerHTML = "";
                        return false;
                        // $("#reli").submit(); 
                    }else{
                        document.getElementById("error").innerHTML = "GP Name Is In our Record  ,"+gp_name;
                        return false;
                    }
                }
            });
        }
  }
  function check_form(form) {

    var gp_name=$('#gp_name').val();
    var web_gp=$('#web_gp').val();
    var form_type="";
    if(gp_name!=""){              
            $.ajax({
                type:'POST',
                url:'admin_get_information.php',
                data:'field_info_name='+gp_name+'&web_district_ids='+web_gp+'&form_type='+form_type,
                success:function(html){                 
                    if(html==1){
                        document.getElementById("error").innerHTML = "";
                        // $("#reli").submit(); 
                        return true;
                    }else{
                       return false;
                        document.getElementById("error").innerHTML = "GP Name Is In our Record  ,"+gp_name;
                        $('#gp_name').val(' ');                       
                        return false;
                    }
                }
            });
        }else{
          return false;
        }
  }
  function get_block() {
    var form_type=$('#form_type').val();
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
      $('#block_name').html('<option value="">-- Please Select District --</option>');
    }
  }
  // $('#show_site_store').html(html);
</script>