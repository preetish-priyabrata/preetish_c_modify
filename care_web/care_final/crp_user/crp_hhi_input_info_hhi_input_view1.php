<?php
// print_r($_GET);
// exit;
// ini_set('display_errors',1);
session_start();
ob_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();
  $title="View Detail Fill By CRP User ";
  $care_TARINA_slno=web_decryptIt(str_replace(" ", "+",$_GET['care_TARINA_slno']));
  // $care_TARINA_slno=(($_GET['care_TARINA_slno']));
  // $care_hhi=web_decryptIt(str_replace(" ", "+",$_GET['ID']));
  // $months=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));//
  // $form_uses_id=web_decryptIt(str_replace(" ", "+",$_GET['form_uses_id']));
  // $TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));
  // $year=web_decryptIt(str_replace(" ", "+",$_GET['year']));
  // $village=web_decryptIt(str_replace(" ", "+",$_GET['village']));

 $get_detail_fill2="SELECT * FROM `care_master_input_output_tracking_tarina` WHERE `care_TARINA_slno`='$care_TARINA_slno' ";
  $query_exe_table2=mysqli_query($conn,$get_detail_fill2);
  // $num=mysqli_num_rows($query_exe_table2);
  $fetch_table2=mysqli_fetch_assoc($query_exe_table2);

  $care_hhi=$fetch_table2['care_TARINA_hhi'];
  $months=$fetch_table2['care_TARINA_month'];
  $year=$fetch_table2['care_TARINA_year'];
  $name="input and output tracking";
  $get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' ";
  $sql_exe_get_id=mysqli_query($conn,$get_hhi);
  $hhi_fetch=mysqli_fetch_assoc($sql_exe_get_id);

// care_TARINA_slno
?>

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
         Input and output tracking  
       <!--  <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add New Data Entry</a></li>
        <li class="active">Input and output tracking  </li>
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>
      
        <div class="box box-primary">
            <div class="box-header with-border">

            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-file"></i>

              <h3 class="box-title"><?=$name?></h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="index.php" class="btn btn-info btn-sm" ><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Back </a>
              </div>
              <!-- /. tools -->
            </div>
          </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
           
               <form class="form-horizontal" id="myForm" >
            
                

              <div class="col-xs-12">
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="district">District</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" name="district" id="district" value="<?=$hhi_fetch['care_district_name']?>" placeholder="Enter District" readonly>
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="GP_name">GP Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_gp_name']?>" id="GP_name" name="GP_name" placeholder="Enter GP" readonly>
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Month">Month</label>
                    <div class="col-sm-10">
                      <select disabled class="form-control" name="month" required="" readonly>
                        <option value="">Select Month</option>
                        <?php
                          $monthArray = range(1, 12);
                          foreach ($monthArray as $month) {
                          // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                          // you can use whatever year you want
                          // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2017-$monthPadding-01"));
                            ?>
                            <option value="<?=$monthPadding?>" <?php if($months==$monthPadding){echo "selected";}?>><?=$fdate?></option><?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="hhi" >HHI </label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" id="hhi" value="<?=$hhi_fetch['care_hhi_id']?>" readonly  name="hhi" placeholder="Enter HHI">
                    </div>
                  </div>

                </div>
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Block">Block</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" value="<?=$hhi_fetch['care_block_name']?>" readonly  id="Block" placeholder="Enter Block" name="Block">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Village">Village</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" value="<?=$hhi_fetch['care_village_name']?>" readonly  id="Village" placeholder="Enter Village" name="Village">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year">Year</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" id="Year" value="<?=$year?>" readonly placeholder="Enter Year" name="Year">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="women" > women farmer </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_women_farmer']?>" readonly  id="women" name="women" placeholder="Enter women farmer ">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Spouse" > Spouse Name </label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" id="Spouse" value="<?=$hhi_fetch['care_spouse_name']?>" readonly  name="Spouse" placeholder="Enter Spouse Name ">
                    </div>
                  </div>

                 

                </div>
                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Part 1</a></li>
                  <li><a data-toggle="pill" href="#part2">Part 2</a></li>

                </ul>

                <div class="tab-content">
                  <div id="part1" class="tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Date CRP Entry</th>
                          <th>Event Date</th>
                          <th>Activity Name</th>
                          <th>Support Provided<br> (Goods & Services) </th>

                        </tr>
                      </thead>
                      <tbody>
                        
                        <tr>
                          <td><input readonly value="<?=$fetch_table2['care_TARINA_entry_date']?>" class="form-control"  required=""></td>
                          <td><input readonly value="<?=$fetch_table2['care_TARINA_event_date']?>" class="form-control" type="text" id="datepicker" name="datepicker" required=""></td>
                          <td><input readonly value="<?=$fetch_table2['care_TARINA_activity_name']?>" class="form-control" type="text" name="Activity" required=""></td>
                          <td><input readonly value="<?=$fetch_table2['care_TARINA_support_provide']?>" class="form-control" type="text" name="Support" required=""></td>

                        </tr>
                    
                      </tbody>
                    </table>

                    <br>
                  <ul class="pager">
                   <!-- <li class="previous"><a data-toggle="pill" href="#Address">Previous</a></li> -->
                   <li class="next continue"><a >Next</a></li>
                  </ul>
                  </div>
                   

                  <div id="part2" class="tab-pane fade">
                 <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>

                          <th>Production</th>
                          <th>Consumption</th>
                          <th>Sale</th>

                          <th>Remarks</th>
                          <th>Signature of CRP/Participant</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <input readonly value="<?=$fetch_table2['care_TARINA_production']?>" type="text" class="form-control" name="Production" required="">
                          </td>
                          <td>
                            <input readonly value="<?=$fetch_table2['care_TARINA_consumption']?>" type="text" class="form-control" name="Consumption" required="">
                          </td>
                           <td>
                            <input readonly value="<?=$fetch_table2['care_TARINA_sale']?>" type="text" class="form-control" name="Sale" required="">
                          </td>
                           <td>
                            <textarea class="form-control" name="Remarks" readonly="" required=""><?=$fetch_table2['care_TARINA_remarks']?></textarea>
                          </td>
                          <td>
                            <input readonly value="<?=$fetch_table2['care_TARINA_participant_sign']?>" type="text" class="form-control" name="Signature" required="">
                          </td>
                          

                        </tr>
                       

                      </tbody>
                    </table>
                    <input type="hidden" name="rows_id" id="rows" value="<?=$num?>">

                    <br>
                  <ul class="pager">
                   <li class="previous back"><a >Previous</a></li>
                    <li class="next"><?php $name="form1";
echo "<a target='_blank' href='download.php?name=".web_encryptIt($name)."&id=".web_encryptIt($care_TARINA_slno)."'>Click to download</a>"; //link to download file
?></li>
                 </ul>
                  </div>
                 
        </div>
              </div>
            </form>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } ); $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>
  
  <script>
$(document).ready(function () {

    $('.myform').validate({ // initialize the plugin
        // other options
    });

    $("[name^=field]").each(function () {
        $(this).rules("add", {
            required: true,
            checkValue: true
        },


        );
    });

    $.validator.addMethod("checkValue", function (value, element) {
        var response = ();
        return response;
    }, "invalid value");

});
</script>