<?php
//print_r($_POST);
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Nutrition Gender Tool Kits Observation";

 if($_POST['form_types']){
  $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_types']));
  if($form_type=='get_hhi_infomation'){
    $District=$_POST['District'];
   $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    $date_one=date('Y-m-d',strtotime(trim($start_date)));
    $date_two=date('Y-m-d',strtotime(trim($end_date)));
    
  }else{
    $District="";
   $start_date="";
    $end_date="";
     header('Location:logout.php');
    exit; 
  }

 }else{
 $start_date="";
    $end_date="";
  $District="";
 }

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="new_style.css">
<!-- <link rel="stylesheet" type="text/css" href="new_style.css"> -->
<style type="text/css">

/*.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    color: #333;
    background-color: #ffffff;
  }*/
</style>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nutrition Gender Tool Kits Observation
     <!--<small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">View NGTKO Form</a></li>
        <li class="active">Nutrition Gender Tool Kits Observation</li>
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
                  <label for="District">District :</label>
                   <input type="hidden" name="form_types" id='form_types' value="<?=web_encryptIt('get_hhi_infomation')?>">
                   <select class="form-control" id="District" name="District" required="">
                    <option value="">--Select District--</option>
                   <?php $get_village="SELECT * FROM `care_master_district_info` WHERE `care_dis_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_dis_name']?>"<?php if($District==$res_village['care_dis_name']){ echo "selected";} ?> ><?=strtoupper($res_village['care_dis_name'])?></option>
                          <?php
                        }?>
                  </select>
                  <div class="form-group">
                  <label for="form_date">From Date :</label>
                 
                  <input type="text" class="form-control" name="start_date" id="start_date" class="filter-textfields" placeholder="Start Date" required value="<?=$start_date?>" />
               </div>
                <div class="form-group">
                  <label for="to_date">To Date :</label>
                  
                  <input type="text" class="form-control"  required name="end_date" id="end_date" class="filter-textfields" placeholder="End Date"  value="<?=$end_date?>"/>
                </div>
                 </div> 
               <button type="submit" class="btn btn-default">Find</button>
             </form>
           </div>
         </div>
      </div>
      </div>
      <br>
      <br>
      <!-- Array ( [form_types] => SXJ5TVhwYUlqSDBJOXFFaW5wTk5pUFNNbzF1VTEyUHJvU1h4UE5CQktKcz0= [District] => kalahandi [start_date] => 07/01/2018 [end_date] => 08/07/2018 ) -->
      <!-- <?php print_r($_POST)?> -->
     <?php  if($_POST['form_types']){?>
        <div class="panel panel-primary">
          <div class="panel-heading">List Report </div>
          <div class="panel-body">
              <table class="table table-condensed">
                <thead>
                  <tr>
                    <th>Slno </th>
                    <th>User Name</th>                    
                    <th>Village Name</th>
                    <th>Date Of Entry</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $x=0;
                      $GET_INFO="SELECT * FROM  `care_master_mt_NGTKO_instruction_form` WHERE `care_district_name`='$District' AND `date` BETWEEN '$date_one' AND '$date_two' ORDER BY `slno` desc";
                     
                    $sql_exe=mysqli_query($conn,$GET_INFO);

                    while ($res=mysqli_fetch_assoc($sql_exe)) {
                      // `slno`, `care_administration_date`, `care_district_name`, `care_block_name`, `care_gp_name`, `care_villege_name`, `care_group_type`, `care_farmer_field_group`, `care_shg_name`, `care_male_participants`, `care_female_participants`, `care_total_participants`, `care_NGTK_name`, `care_rolling_time`, `care_observation_tool`, `care_support_materials`, `care_key_message`, `date`, `time`, `status`, `care_MT_id`, `care_MEO_date`, `care_MEO_time`, `care_MEO_status`, `care_MEO_id`, `care_NGTKO_long_id`, `care_NGTKO_lat_id`
                      $x++;
                      $care_MT_id=$res['care_MT_id'];
                      $get_user="SELECT * FROM `care_master_admin_info` WHERE `cama_email`='$care_MT_id' ";
                      $sql_user_exe=mysqli_query($conn,$get_user);
                      $fetch_user=mysqli_fetch_assoc($sql_user_exe);


                  ?>
                  <tr>
                    <td><?=$x?></td>
                    <td><?=$fetch_user['cama_username']?></td>
                    <td><?=$res['care_villege_name']?></td>
                    <td><?=$res['date']?></td>
                    <td>
                      <a target="_blank"  onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;"  href="report_mt_ngtko_view.php?token=<?=web_encryptIt($res['slno'])?>">View</a>
                    </td>
                  </tr>
               <?php }?>
                </tbody>
              </table>
          </div>
        </div>
      <?php }?>
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

 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script type="text/javascript">
  
  $( "#start_date" ).datepicker(
  
      { 
              changeMonth: true,
      changeYear: true,
        maxDate: '0d', 
        beforeShow : function()
        {
          jQuery( this ).datepicker('option','maxDate','minDate', jQuery('#end_date').val() );
        },
        // altFormat: "dd/mm/yy", 
        // dateFormat: 'dd/mm/yy'
        
      }
      
  );

  $( "#end_date" ).datepicker( 
  
      {
              changeMonth: true,
      changeYear: true,
        maxDate: '0d', 
        beforeShow : function()
        {
          jQuery( this ).datepicker('option','minDate', jQuery('#start_date').val() );
        } , 
        // altFormat: "dd/mm/yy", 
        // dateFormat: 'dd/mm/yy'
        
      }
      
  );



</script>
