<?php
session_start();
ob_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";

 if(isset($_POST['form_type'])){
  $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
  if($form_type=='get_hhi_infomation'){
    $village=$_POST['village'];
  }else{
    $village="";
     header('Location:logout.php');
    exit; 
  }

 }else{
  $village="";
 }

?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        HHID LIST 
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Get List Of HHID</a></li>
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
                  <label for="village">Village :</label>
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('get_hhi_infomation')?>">
                  <select class="form-control" id="village" name="village">
                    <option value="">--Select Village--</option>
                    <?php 
                        $employee_id=$_SESSION['employee_id'];
                        $get_village="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_employee_id`='$employee_id' and `status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_assU_village_id']?>"<?php if($village==$res_village['care_assU_village_id']){ echo "selected";} ?> ><?=$res_village['care_assU_village_id']?>[<?=$res_village['care_assU_gp_id']?>]</option>
                          <?php
                          
                        }

                    ?>
                    
                  </select>
                 
                </div> 
                <button type="submit" class="btn btn-default">Find</button>
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

        if(!empty($village)){?>
           <div class="row">
            <div class="col-xs-12">
              <div class="panel panel-default">
                <div class="panel-body text-center">
                  <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>slno</th>
                        <th>HHI</th>
                        <th>Woman Farmer</th>
                        <th>Spouse Name</th>
                        <th>Form</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>slno</th>
                        <th>HHI</th>
                        <th>Woman Farmer</th>
                        <th>Spouse Name</th>
                        <th>Form</th>
                        <th></th>
                      </tr>
                    </tfoot>
                    <tbody>
                        <?php 
                        $x=0;
                          $get_user_query="SELECT * FROM `care_master_hhi_infomation` WHERE `care_village_name`='$village'";
                          $sql_exe_hhi=mysqli_query($conn,$get_user_query);
                            while ($result_hhi=mysqli_fetch_assoc($sql_exe_hhi)) {
                              $x++;
                              ?>
                            
                        <tr>
                          <td><?=$x?></td>
                          <form action="crp_go_form_go.php" method="POST">
                            <input type="hidden" name="form_type" value="<?=web_encryptIt('go_form_ids')?>">
                            <td><input type="hidden" name="care_hhi" value="<?=web_encryptIt($result_hhi['care_hhi_id'])?>">
                             <input type="hidden" name="care_hhi_slno" value="<?=web_encryptIt($result_hhi['care_hhi_slno'])?>"><?=$result_hhi['care_hhi_id']?></td>
                             <td><?=$result_hhi['care_women_farmer']?></td>
                              <td><?=$result_hhi['care_spouse_name']?></td>
                              <td>
                                <select class="form-control" name="form_id" required="">
                                  <option value="">--Please Select Form--</option>
                                  <optgroup label="Crop Diversification Farmland">
                                    <option value="1">Farmland</option>
                                    
                                   
                                  </optgroup>
                                  <optgroup label="Crop Diversification Kitchen Garden">
                                    <option value="4">Kitchen Garden</option>
                                   
                                  </optgroup>
                                  <optgroup label="Livestock">
                                    <option value="9">Goatery</option>
                                    <option value="10">Dairy</option>
                                    <option value="11">Poultry</option>
                                  </optgroup>
                                  <optgroup label="Other Tracking">
                                    <option value="7"> Post Harvest Loss </option>
                                    <option value="8">Labour Saving Technologies</option>
                                  </optgroup>
                                  <optgroup label="Basic">
                                    <option value="12">HHI Input and output tracking</option>
                                  </optgroup>
                                </select>
                            </td>
                            <td>
                              <input type="submit" class="form-control" name="form_name_link" value="Get Fill">
                            </td>
                          </form>
                        </tr>
                        <?php }?>
                    </tbody>
                  </table>
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
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
  </script>

