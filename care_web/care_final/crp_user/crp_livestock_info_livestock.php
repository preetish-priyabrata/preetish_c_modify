<?php
session_start();
ob_start();
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
 $care_hhi=web_decryptIt(str_replace(" ", "+",$_GET['ID']));
 $care_hhi_slno=web_decryptIt(str_replace(" ", "+",$_GET['TOKEN_ID']));
 $TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));
switch ($TYPE) {
  case '1':
    $name="Goatery";
     break;
  case '2':
    $name="Dairy";
     break;
  case '3':
    $name="Poultry";
     break;
   
   default:
      header('Location:logout.php');
      exit; 
     break;
}
$get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' and `care_hhi_slno`='$care_hhi_slno'";
$sql_exe_get=mysqli_query($conn,$get_hhi);
$hhi_fetch=mysqli_fetch_assoc($sql_exe_get);
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
        Livestock
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Add New Data Entry</a></li>
        <li class="active">Livestock</li>
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>
         <div class="box box-primary">
            <div class="box-header with-border">

            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">Fill New Livestock of <?=$name?> Form</h3>
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
             <form action="crp_all_form_save.php" id="myForm" method="POST" class="form-horizontal">
                  <input type="hidden" name="form_type" value="<?=web_encryptIt('hhi_for_livestock')?>">
                  <input type="hidden" name="lat2" value="" id="user_browser_lat2" required="true">
                  <input type="hidden" name="lat" value="" id="user_browser_lat" required="true">
                  <input type="hidden" name="long2" value="" id="user_browser_long2" required="true">
                  <input type="hidden" name="long" value="" id="user_browser_long" required="true">
                  <input type="hidden" name="care_hhi" value="<?=$care_hhi?>" id="user_browser_long2" required="true">
                  <input type="hidden" name="care_hhi_slno" value="<?=$care_hhi_slno?>" id="user_browser_long" required="true">
                  <input type="hidden" name="type_ids" value="<?=$TYPE?>" required="true">
                

              <div class="col-xs-12">
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="district">District</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="district" name="district" value="<?=$hhi_fetch['care_district_name']?>" placeholder="Enter District" readonly>
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
                      <select class="form-control" name="month" required="">
                        <option value="">Select Month</option>
                        <?php
                          $monthArray = range(1, 12);
                          foreach ($monthArray as $month) {
                          // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                          // you can use whatever year you want
                          // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2017-$monthPadding-01"));
                            echo '<option value="'.$monthPadding.'">'.$fdate.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="hhi" >HHI </label>
                    <div class="col-sm-10">
                     <input type="text" class="form-control" id="hhi" value="<?=$hhi_fetch['care_hhi_id']?>" readonly  name="hhi" placeholder="Enter HHI">
                    </div>
                  </div>

                </div>
                <div class="col-xs-6">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Block">Block</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_block_name']?>" readonly  id="Block" placeholder="Enter Block" name="Block">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Village">Village</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?=$hhi_fetch['care_village_name']?>" readonly  id="Village" placeholder="Enter Village" name="Village">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-sm-2" for="Year">Year</label>
                    <div class="col-sm-10">
                      <!-- <input type="text" class="form-control" id="Year" value="<?=date('Y')?>" readonly placeholder="Enter Year" name="Year"> -->
                       <select class="form-control" id="Year" name="Year" required="">
                      <?php

                      foreach(range(2017, (int)date("Y")) as $year) {?>

                          <option value='<?=$year?>' <?php if($year==date('Y')){ echo "selected";}?>><?=$year?></option>
                          <?php 
                      }

                      ?>
                      </select>
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
                       <input type="text" class="form-control" id="Spouse" value="<?=$hhi_fetch['care_spouse_name']?>" readonly  name="Spouse" placeholder="Enter Spouse Name ">
                    </div>
                  </div>

                </div>
                 <ul class="nav nav-tabs nav-justified nav-pills">
                  <li class="active"><a data-toggle="pill" href="#part1">Type of Input Provided</a></li>
                  <li><a data-toggle="pill" href="#part2">Part 2</a></li>
                  <li><a data-toggle="pill" href="#part3">Quantity Provided</a></li>
                  <!-- <li><a data-toggle="pill" href="#part4">Part 4</a></li> -->
                </ul>
                
                <div class="tab-content">
                  <div id="part1" class="setup-content tab-pane fade in active">
                    <table id='example' class="table table-hover" border="1" >
                      <thead>
                        <tr>
                          <th>Training</th>
                          <th>Extension Support</th>
                          <th>No of anaimals<br> received extension</th>
                          <th>Medicine </th>
                          <th>No of animals <br> received medicine</th>
                          <th>Vaccination</th>
                          <th>No of animals <br> received vaccination</th>
                          <th>Others(specifiy)</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                         <td><select class="form-control " name="type_input_training" required="" style="width: 70px;">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <!-- training -->
                          <td><select class="form-control" name="get_id1" onchange="get_change(1)" id="get_id1" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <!-- extension support -->
                          <td>

                            <input class="form-control input-sm" type="number" placeholder="No of animals  received extension" id="get_id_no1" name="get_id_no1" required="" min="0" value="0"></td>
                          <!-- no of extenston support -->
                          <td><select class="form-control" name="get_id2" onchange="get_change(2)" id="get_id2" required=""  style="width: 70px";>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <!-- medicine  -->
                          <td><input class="form-control input-sm" placeholder="No of animals  received medicine" type="number" id="get_id_no2" name="get_id_no2" required="" min="0" value="0"></td>
                          <!-- no of medice used -->
                          <td><select class="form-control" name="get_id3"   onchange="get_change(3)" id="get_id3" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td>
                          <!-- vaccination  -->
                          <td><input class="form-control input-sm" placeholder="No of animals  received vaccination" type="number" id="get_id_no3" name="get_id_no3" required="" min="0" value="0"></td>
                          <td><select class="form-control"  onchange="get_change(4)" id="get_id4" name="get_id4" required="">                            
                            <option value="2">No</option>
                            <option value="1">Yes</option>
                          </select>
                          <br>
                          <input class="form-control input-sm" type="text" id="get_id_no4" placeholder="Others(specifiy)" name="get_id_no4" required="">
                        </td>
                          <!-- other -->
                          <td><input class="form-control input-sm" min="0" value="0" type="number" id="get_id_no5" name="get_id_no5" placeholder="Others(specifiy) Quanty" required=""></td>
 
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
                          <th>Total No. of animal/bird <br> currently present in HHID</th>
                          <th>Are you cultivating Fodder? </th>
                          <th>Area cultivated under <br> Fodder (in sqft)</th>
                          <th>New Farmers</th>
                          <th>Continued farmers</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <label for="Total_animal"></label>
                            <input class="form-control" type="number" min="0" name="Total_animal" required=""></td>
                         <td><select class="form-control" name="Cultivating_fodder_status"  required="">
                            <option value="2">No</option>
                            <option value="1">Yes</option>
                            
                          </select></td>
                          <td><input class="form-control" type="text" name="cultivated_area" id="cultivated_area" value="0" required=""></td>
                          <td><select class="form-control" onchange="farm_duct()" name="Farmers_new" id="Farmers_new" required="">
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                          </select></td><td><select class="form-control" onchange="farm_duct_cont()" name="farmers_cont" id="farmers_cont" required="">
                            <option value="2">No</option>
                            <option value="1">Yes</option>
                            
                          </select></td>                  
                        </tr>
                      </tbody>
                    </table>  
                    <br>
                  <ul class="pager">
                   <li class="previous back"><a >Previous</a></li>
                   <li class="next continue"><a >Next</a></li>
                 </ul>
                  </div>
                  <div id="part3" class="tab-pane fade">
                    <!-- Moistermeter-1, Hermative bags-2, Tarpaulin sheet-3, other specify-4 -->
                   <table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Quantity provided<br>Extension Support (No.)</th>
                          <th>Quantity provided<br>Medicine</th>
                          <th>Quantity provided<br> Vaccination</th>
                          <th>Quantity provided<br> Others (Specify)</th>                
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input class="form-control" type="text" name="Extension_qnty" required=""></td>
                          <td>
                               <table id="myTable" class=" table order-list-Medicine">
                                <thead>
                                    <tr>
                                        <td>Medicine Name</td>
                                        <td>Medicine Quantity</td>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-sm-4">
                                            <input type="text" name="Medicine_name[]" id="Medicine_name" class="form-control" />
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="mail" name="Medicine_qnty[]" id="Medicine_qnty"  class="form-control"/>
                                        </td>                                        
                                        <td class="col-sm-2"><a class="deleteRow-Medicine"></a>

                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" style="text-align: left;">
                                            <input type="button" class="btn btn-lg btn-block btn-xs" id="addrow-Medicine" value="Add Row" />
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tfoot>
                            </table>
                          </td>
                          <td>
                            <table id="myTable" class=" table order-list-Vaccination">
                                <thead>
                                    <tr>
                                        <td>Vaccination Name</td>
                                        <td>Vaccination Quantity</td>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-sm-4">
                                            <input type="text" name="Vaccination_name[]" id="Vaccination_name" class="form-control" />
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="mail" name="Vaccination_qnty[]" id="Vaccination_qnty"  class="form-control"/>
                                        </td>                                        
                                        <td class="col-sm-2"><a class="deleteRow-Vaccination"></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" style="text-align: left;">
                                            <input type="button" class="btn btn-lg btn-block btn-xs" id="addrow-Vaccination" value="Add Row" />
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tfoot>
                            </table>
                          </td>
                          <td>
                            <table id="myTable" class=" table order-list-Others">
                                <thead>
                                    <tr>
                                        <td>Others Name</td>
                                        <td>Others Quantity</td> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-sm-4">
                                            <input type="text" name="Others_name[]" id="Others_name" class="form-control" />
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="mail" name="Others_qnty[]" id="Others_qnty"  class="form-control"/>
                                        </td>                                        
                                        <td class="col-sm-2"><a class="deleteRow-Others"></a>

                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" style="text-align: left;">
                                            <input type="button" class="btn btn-lg btn-block btn-xs" id="addrow-Others" value="Add Row" />
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tfoot>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  <br>
                  <ul class="pager">
                   <li class="previous back"><a >Previous</a></li>
                  <li class="next pull-right" ><input type="submit" name="save" value="save"></li>
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
<script type="text/javascript">
   
     $(document).ready(function(){
    
        
        $('#get_id_no4').hide();
        $('#get_id_no5').hide();
         $('input[name=get_id_no5').prop('required',false);
              $('input[name=get_id_no4').prop('required',false);
    });  
    function get_change(id) {
      // alert(id);
      var get_ids=$('#get_id'+id).val();

          if(id==4){
            if(get_ids=='1'){
              $('#get_id_no4').show();
               $('#get_id_no5').show();
              
              $('input[name=get_id_no4').prop('required',true);
              $('input[name=get_id_no5').prop('required',true);
            }else{
              $('#get_id_no4').hide();
               $('#get_id_no5').hide();
              
              $('input[name=get_id_no4').prop('required',false);
              $('input[name=get_id_no5').prop('required',false);
            }
          }else{
            if(get_ids=='1'){
               $('#get_id_no'+id).show();
              $("input[name=get_id_no"+id).prop('required',true);
            }else{
             
              $('#get_id_no'+id).hide();
              $('input[name=get_id_no'+id).prop('required',false);
            }

          }
    } 
  function farm_duct(){
    var Farmers_new= $('#Farmers_new').val();
    if(Farmers_new==1){
      $('#farmers_cont').html('<option value="2">No</option><option value="1">Yes</option>');
    }else if(Farmers_new==2){
      $('#farmers_cont').html('<option value="1">Yes</option><option value="2">No</option>');
    }
   
  }
  function farm_duct_cont(){
    var farmers_cont= $('#farmers_cont').val();
    if(farmers_cont==1){
      $('#Farmers_new').html('<option value="2">No</option><option value="1">Yes</option>');
    }else if(farmers_cont==2){
      $('#Farmers_new').html('<option value="1">Yes</option><option value="2">No</option>');
    }
  } 

  $(document).ready(function() {
    $('#cultivated_area').prop('readonly', true);       
      $('select[name=Cultivating_fodder_status]').change(function(e){
        if ($('select[name=Cultivating_fodder_status]').val() == '1'){
          $('#cultivated_area').prop('readonly', false);

        }else{
          $('#cultivated_area').val('0');
          $('#cultivated_area').prop('readonly', true);
         

        
        }
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function () {
    var counter = 0;

    $("#addrow-Medicine").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="Medicine_name[]" id="Medicine_name' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="Medicine_qnty" id="Medicine_qnty' + counter + '"/></td>';
        

        cols += '<td><input type="button" class="ibtnDel-Medicine btn btn-xs btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-Medicine").append(newRow);
        counter++;
    });



    $("table.order-list-Medicine").on("click", ".ibtnDel-Medicine", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});
     $(document).ready(function () {
    var counters = 0;

    $("#addrow-Vaccination").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="Vaccination_name[]" id="Vaccination_name' + counters + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="Vaccination_qnty" id="Vaccination_qnty' + counters + '"/></td>';
        

        cols += '<td><input type="button" class="ibtnDel-Vaccination btn btn-xs btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-Vaccination").append(newRow);
        counters++;
    });



    $("table.order-list-Vaccination").on("click", ".ibtnDel-Vaccination", function (event) {
        $(this).closest("tr").remove();       
        counters -= 1
    });


});
     $(document).ready(function () {
    var counter = 0;

    $("#addrow-Others").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="Others_name[]" id="Others_name' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="Others_qnty" id="Others_qnty' + counter + '"/></td>';
        

        cols += '<td><input type="button" class="ibtnDel-Others btn btn-xs btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-Others").append(newRow);
        counter++;
    });



    $("table.order-list-Others").on("click", ".ibtnDel-Others", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});
 //     $("#myform").validate({
 //  submitHandler: function(form) {
 //    // some other code
 //    // maybe disabling submit button
 //    // then:
 //    $(form).submit();
 //  }
 // });
//  jQuery.validator.setDefaults({
//   debug: true,
//   success: "valid"
// });
// var form = $( "#myform" );
// form.validate();
// $( "button" ).click(function() {
//   alert( "Valid: " + form.valid() );
// });

     // var validator = $("#myForm").validate();
      
</script>