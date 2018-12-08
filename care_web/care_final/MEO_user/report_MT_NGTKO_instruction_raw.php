<?php
//print_r($_POST);
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Nutrition Gender Tool Kits Observation";

 if($_POST['form_type']){
  $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
  //$slno=$_GET['slno'];
   $slno=$_GET['slno'];

 if($form_type=='get_hhi_infomation'){
    $village=$_POST['village'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    $date_one=date('Y-m-d',strtotime(trim($start_date)));
    $date_two=date('Y-m-d',strtotime(trim($end_date)));

 }else{
    $village="";
    $start_date="";
    $end_date="";
     header('Location:logout.php');
    exit; 
  }

 }else{
  $village="";
 }

?>
<link rel="stylesheet" type="text/css" href="new_style.css">
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
        <li><a href="#">Edit NGTKO Form</a></li>
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
                <label for="village">Village :</label>
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('get_hhi_infomation')?>">
                    <select class="form-control" id="village" name="village">
                    <option value="">--Select Village--</option>
                    <?php 
                         $mt_user=$_SESSION['location_user'];
                         $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_district`='$mt_user' and `care_vlg_status`='1' ";
                         $sql_exe=mysqli_query($conn,$get_village);
                         while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                         <option value="<?=$res_village['care_vlg_name']?>"<?php if($village==$res_village['care_vlg_name']){ echo "selected";} ?> ><?=$res_village['care_vlg_name']?>[<?=$res_village['care_vlg_gp']?>]</option>
                          <?php
                        }
                     ?>
                    
                    </select>
                  </div> 
                <div class="form-group">
                  <label for="form_date">From Date :</label>
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('get_hhi_infomation')
                  ?>">
                  <input type="text" class="form-control" name="start_date" id="start_date" class="filter-textfields" placeholder="Start Date" required value="<?=$start_date?>" />
               </div>
                <div class="form-group">
                  <label for="to_date">To Date :</label>
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('get_hhi_infomation')?>">
                  <input type="text" class="form-control"  required name="end_date" id="end_date" class="filter-textfields" placeholder="End Date"  value="<?=$end_date?>"/>
                </div>
              <button type="submit" class="btn btn-default">Find</button>
            </form>
          </div>
        </div>
      </div>
    </div>
      <br>
      <br>
     <div class="col-md-12 col-sm-12">
        <!-- Basic inputs -->
       <div class="panel panel-default">
         <div class="panel-heading">
         <div class="panel-title">NGTKO Instruction Form </div>
           </div>
             <div class="panel-body">
              <div class="table-responsive">
                  <table id="example77" class="display nowrap" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sl.No</th>
                      <th>Village</th>
                      <th>MT User</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                    
                    <tbody>
                      <?php 
                      $x=0;
                      if($form_type=='get_hhi_infomation'){
                       $GET_INFO="SELECT * FROM `care_master_mt_NGTKO_instruction_form` WHERE `care_villege_name`='$village'  AND `date`BETWEEN '$date_one' AND '$date_two'";
                      }
                    $sql_exe=mysqli_query($conn,$GET_INFO);

                    while ($res=mysqli_fetch_assoc($sql_exe)) {
                     //$mt_user=$_SESSION['cama_email'];
                      // zmr_site_from_location_id
                       // $slno=web_encryptIt($res['slno']);
                      // $site_list=web_encryptIt($res['zmr_unqiue_mr_id']);
                       $x++;
                    ?>
                     <tr>
                      <td><?=$x?></td>
                      <td><?=strtoupper($res['care_villege_name'])?></td>
                      <td><?=strtolower($res['care_MT_id'])?></td>
                      <td><?=$res['date']?></td>
                      <td>
                          <div class="btn-group">
                              <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action
                                <i class="icon-three-bars position-right"></i>
                              </button>
                              <ul class="dropdown-menu">
                               <li><a href="MEO_NGTKO_instruction_edit.php?slno=<?php echo $res['slno']?>" target="_blank">Edit/Confirm</a></li>
                            </ul>
                        </div>
                      </td>
                  </tr>
              <?php }?>
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
<script src="new.js"></script>
<script type="text/javascript">
$(function() {
    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });
});
</script>
<!-- continue -->
<!-- back -->
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } ); $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>
<script type="text/javascript">
    function calculate() {
        var male_qnty = document.getElementById('male_qnty').value;
        console.log(male_qnty);

        var female_qnty = document.getElementById('female_qnty').value;
        console.log(female_qnty);
        var total = document.getElementById('total_qnty');

        var result = parseInt(male_qnty) + parseInt(female_qnty);
        total.value = result;
        console.log(result);
        console.log(total);
      }

</script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script type="text/javascript">
  
  $( "#start_date" ).datepicker(
  
      { 
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
