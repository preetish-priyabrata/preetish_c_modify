<?php
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
  if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
      $village=$_POST['village'];
      $months=$_POST['month'];
      $Year=$_POST['Year'];
      $employee_id=$_POST['employee_id'];
    }else{
      $months="";
      $Year="";
      $employee_id="";
      $village="";
       header('Location:logout.php');
      exit;
    }
  }else{
     $months="";
      $Year="";
      $employee_id="";
      $village="";
  }
$form_types=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        HHI Entry LIST
        <!-- <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">View Data Report</a></li>
        <li><a href="#">Goatary </a></li>
        <li class="active"><a href="#">Edit Goatary  </a></li>
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
                  <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">
                  
                 <label for="village">Village :</label>
                  <?php if($form_types==0){
                        $get_village="SELECT * FROM `care_master_village_info` WHERE  `care_vlg_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                      }else{
                         $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_district`='$location_user' and `care_vlg_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                      }

                    ?>
                  
                    <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                   <?php 
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_vlg_name']?>"<?php if($village==$res_village['care_vlg_name']){ echo "selected";} ?> ><?=$res_village['care_vlg_name']?>[<?=$res_village['care_vlg_gp']?>]</option>
                          <?php
                        }?>
                  </select>
                 

                   <label for="village"> Month:</label>
                    <select class="form-control" id="month" name="month" required="">
                    <option value="">--Select Month--</option>
                    <?php
                          $monthArray = range(1, 12);
                          foreach ($monthArray as $month) {
                          // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                          // you can use whatever year you want
                          // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2017-$monthPadding-01"));
                            ?>
                            <option value="<?=$monthPadding?>" <?php if($monthPadding==$months){ echo 'selected';}?>><?=$fdate?></option><?php 
                          }
                        ?>
                  </select>
                 <label for="village"> Year:</label>
                  <select class="form-control" id="datepicker" name="Year" required="">
                    <option value="">--Select Year--</option>
                    <?php 
                    $yearSpan = 4;
                    $currentYear = date("Y", strtotime('2017-01-01'));
                    for($i = 0; $i<=$yearSpan; $i++) {
                       $x=$currentYear+$i;
                       ?>
                       <option value="<?=$x?>" <?php if($x==$Year){echo "selected";}?>><?=$x?></option>
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

        if(!empty($village)){
          // 
          // 
          $get_detail="SELECT * FROM `care_master_mtf_livestock_tarina` WHERE `livestock`='3' and `care_LS_vlg_name`='$village' AND `care_LS_month`='$months' AND `care_LS_year`='$Year' and `care_LS_MEO_status`='0'";
          // AND `care_crop_div_mt_id_status`='1' and `care_crop_div_CBO_comment_status`='1' and `care_crop_div_MEO_status`='0'
          $sql_get_detail=mysqli_query($conn,$get_detail);

          // while ($sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail)) {
          //   # code...
          // }
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="panel panel-default">
                <div class="panel-body text-center">
                  <div class="table-responsive">
                   <table id="example" class="display" cellspacing="0" width="100%" style="">
                    <thead>
                      <tr  >
                        <th><h4><b>slno</b></h4></th>
                        <th><h4><b>HHI</b></h4></th>
                        <th><h4><b>women farmer</b></h4></th>
                        <th><h4><b>Spouse Name</b></h4></th>
                        <th><h4><b>CRP Date / Time</b></h4></th>
                        <th><h4><b>CRP Lat / Long</b></h4></th>
                        <th><h4><b>MT-Comment Date / Time</b></h4></th>
                        <th><h4><b>CBO-Comment Date / Time</b></h4></th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th><h4><b>slno</b></h4></th>
                        <th><h4><b>HHI</b></h4></th>
                        <th><h4><b>women farmer</b></h4></th>
                        <th><h4><b>Spouse Name</b></h4></th>
                        <th><h4><b>CRP Date / Time</b></h4></th>
                        <th><h4><b>CRP Lat / Long</b></h4></th>
                        <th><h4><b>MT-Comment Date / Time</b></h4></th>
                        <th><h4><b>CBO-Comment Date / Time</b></h4></th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                     <tbody>
                      <?php
                      $xi=0;
                     
                      while ($sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail)) {
                        $xi++;
                        // `care_LS_slno`, `care_LS_hhid`, `care_LS_women_farmer`, `care_LS_spouse_name`, `care_LS_IP_training`, `care_LS_IP_extension_support`, `care_LS_ES_no_of_animal`, `care_LS_IP_medicine`, `care_LS_Med_no_of_animal`, `care_LS_IP_vaccination`, `care_LS_VN_no_of_animal`, `care_LS_IP_others`, `care_LS_IP_others_specify`, `care_LS_other_no_of_animal`, `care_LS_total_animal`, `care_LS_cultivating_fodder`, `care_LS_cultivated_area`, `care_LS_new_farmer`, `care_LS_continued_farmer`, `care_LS_QP_extension_support`, `care_LS_district_name`, `care_LS_block_name`, `care_LS_gp_name`, `care_LS_vlg_name`, `care_LS_employee_id`, `care_LS_lat_id`, `care_LS_long_id`, `care_LS_month`, `care_LS_year`, `care_LS_date`, `care_LS_time`, `care_LS_status`, `livestock`, `care_LS_mt_comment_empty`, `care_LS_mt_comment_date`, `care_LS_mt_comment_time`, `care_LS_mt_comment_status`, `care_LS_mt_id`, `care_LS_CBO_comment_empty`, `care_LS_CBO_comment_date`, `care_LS_CBO_comment_time`, `care_LS_CBO_comment_status`, `care_LS_CBO_id`, `care_LS_MEO_date`, `care_LS_MEO_time`, `care_LS_MEO_status`, `care_LS_MEO_id`
                        ?>
                      <tr>

                        <td><?=$xi?></td>
                        <td><?=$care_hhi_id_info=$sql_get_detail_fetch['care_LS_hhid'];
                           $query_detail="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi_id_info'";
                          $sql_exe_details=mysqli_query($conn,$query_detail);
                          $details_fetch=mysqli_fetch_assoc($sql_exe_details);
                        ?></td>
                        <td><?=$details_fetch['care_women_farmer']?></td>
                        <td><?=$details_fetch['care_spouse_name']?></td>
                        <td><?=$sql_get_detail_fetch['care_LS_date']?><br><?=$sql_get_detail_fetch['care_LS_time']?></td>
                        <td><?=$sql_get_detail_fetch['care_LS_lat_id']?><br><?=$sql_get_detail_fetch['care_LS_long_id']?></td>
                        <td>
                          <?php 
                            if ($sql_get_detail_fetch['care_LS_mt_comment_status']==0) {
                              echo  "Not MT-Comment";
                            }else{
                              echo $sql_get_detail_fetch['care_LS_mt_comment_date']."/".$sql_get_detail_fetch['care_LS_mt_comment_time'];
                            }
                          ?>
                            
                          </td>
                        <td>
                          <?php 
                            if ($sql_get_detail_fetch['care_LS_CBO_comment_status']==0) {
                              echo  "Not CBO-Comment";
                            }else{
                              echo $sql_get_detail_fetch['care_LS_CBO_comment_date']."/".$sql_get_detail_fetch['care_LS_CBO_comment_time'];
                            }
                            
                        ?>
                          
                            
                          </td>
                        <td>
                          <?php 
                          if (($sql_get_detail_fetch['care_LS_CBO_comment_status']==1)&& ($sql_get_detail_fetch['care_LS_mt_comment_status']==1)) {
                            ?>
                               <a class="btn btn-primary btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('11')?>&care_hhi=<?=web_encryptIt($sql_get_detail_fetch['care_LS_slno'])?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=1" ><u>Edit</u></a>
                            <?php
                          }else{
                            echo "--";

                          }
                          ?>
                        </td>
                        
                        
                        </tr>
                        <?php }?>
                  </tbody>
                 </tbody>
                </table>
               </div>
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
    function get_village() {
      var form_type=$('#form_type').val();
    var employee_id=$('#employee_id').val();

    if(employee_id!=""){
      $.ajax({
        type:'POST',
        url:'MEO_get_information.php',
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
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    // get_village();

} );
  </script>

