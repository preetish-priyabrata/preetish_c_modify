<?php
ini_set('display_errors',1);
session_start();
ob_start();
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	table {border-collapse:collapse; table-layout:fixed; width:310px;}
       table td {border:solid 1px #fab; width:100px; word-wrap:break-word;}
</style>
<?php 
if($_SESSION['employee_id']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
$name=web_decryptIt(str_replace(" ", "+",$_GET['name']));
$id=web_decryptIt(str_replace(" ", "+",$_GET['id']));

switch ($name) {
	case 'form1':
		
		$names=date('d-m-Y').' - '.date('H:i a'); //to rename the file
	    header('Content-Disposition: attachment; filename='.$names.'.xls'); 
	    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
	    header('Pragma: no-cache');
	    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');

	     $get_detail_fill2="SELECT * FROM `care_master_Input_output_tracking_TARINA` WHERE `care_TARINA_slno`='$id' ";
		  $query_exe_table2=mysqli_query($conn,$get_detail_fill2);
		  // $num=mysqli_num_rows($query_exe_table2);
		  $fetch_table2=mysqli_fetch_assoc($query_exe_table2);

		  $care_hhi=$fetch_table2['care_TARINA_hhi'];
		  $months=$fetch_table2['care_TARINA_month'];
		  $year=$fetch_table2['care_TARINA_year'];
		  $name="input and output tracking";
		  $monthArray = range(1, 12);
                          foreach ($monthArray as $month) {
                          // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                          // you can use whatever year you want
                          // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2017-$monthPadding-01"));
                            if($months==$monthPadding){
                            	$month_name=$fdate;
                            }
                        }
		  $get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' ";
		  $sql_exe_get_id=mysqli_query($conn,$get_hhi);
		  $hhi_fetch=mysqli_fetch_assoc($sql_exe_get_id);

		  $msg="";
    	$var="";
    	$msg="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Personal Information </th></tr></table>";
    	$msg.="<table style='width:100%' class='table-bordered' border='2'>";
    	$msg.="<tr>";
    	$msg.="<th>District</th>";
    	$msg.="<th>Block</th>";
    	$msg.="<th>GP Name</th>";
    	$msg.="<th>Village</th>";
    	$msg.="<th>Month</th>";
    	$msg.="<th>Year</th>";
    	$msg.="<th>HHI</th>";
    	$msg.="<th>Woman Farmer</th>";
    	$msg.="<th>Spouse Name</th>";
    	$msg.="</tr>";
    	$msg.="<tr>";
    	$msg.="<td>".$hhi_fetch['care_district_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_block_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_gp_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_village_name']."</td>";    	
    	$msg.="<td>".$month_name."</td>";
    	$msg.="<td>".$year."</td>";
    	$msg.="<td>".$care_hhi."</td>";
    	$msg.="<td>".$hhi_fetch['care_women_farmer']." </td>";
    	$msg.="<td>".$hhi_fetch['care_spouse_name']."</td>";
    	$msg.="</tr>";
    	$msg.="</table>";
    	echo $msg;
    	$msg2="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 1 </th></tr></table>";
    	echo $msg2;
    	?>
    	<table id='example' class="table table-hover" border="1">
            <tr>
            	<th>Date CRP Entry</th>
                <th>Event Date</th>
                <th>Activity Name</th>
                <th>Support Provided<br> (Goods & Services) </th>
            </tr>
	        <tr>
             	<td><?=$fetch_table2['care_TARINA_entry_date']?></td>
              	<td><?=$fetch_table2['care_TARINA_event_date']?></td>
              	<td><?=$fetch_table2['care_TARINA_activity_name']?></td>
              	<td><?=$fetch_table2['care_TARINA_support_provide']?></td>

            </tr>
        </table>
    	<?php
    	$msg1="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 2 </th></tr></table>";
    	echo $msg1;
    	
    	?>
    	 <table id='example' class="table table-hover" border="1">
            <tr>

				<th>Production</th>
				<th>Consumption</th>
				<th>Sale</th>

				<th>Remarks</th>
				<th>Signature of CRP/Participant</th>
            </tr>
            <tr>
				<td><?=$fetch_table2['care_TARINA_production']?></td>
				<td><?=$fetch_table2['care_TARINA_consumption']?></td>
				<td><?=$fetch_table2['care_TARINA_sale']?></td>
				<td><?=$fetch_table2['care_TARINA_remarks']?></td>
				<td><?=$fetch_table2['care_TARINA_participant_sign']?></td>
            </tr>
        </table>
    	<?php
		break;
	case 'form2':
		$names=date('d-m-Y').' - '.date('H:i a'); //to rename the file
	    header('Content-Disposition: attachment; filename='.$names.'.xls'); 
	    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
	    header('Pragma: no-cache');
	    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');


	  	$get_ph3="SELECT * FROM `care_master_Post_Harvest_Loss` WHERE `care_PHL_slno`='$id'";
	  	$sql_phl_table3=mysqli_query($conn,$get_ph3);
	                            $x_id=0;
	  	$fetch_table3=mysqli_fetch_assoc($sql_phl_table3);
	  	$care_hhi=$fetch_table3['care_PHL_hhid'];
	  	$village=$fetch_table3['care_PHL_villege_name'];
	  	$months=$fetch_table3['care_PHL_month'];
	  	$year=$fetch_table3['care_PHL_year'];
	  	  $monthArray = range(1, 12);
                          foreach ($monthArray as $month) {
                          // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                          // you can use whatever year you want
                          // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2017-$monthPadding-01"));
                            if($months==$monthPadding){
                            	$month_name=$fdate;
                            }
                        }
		$get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' ";
		$sql_exe_get=mysqli_query($conn,$get_hhi);
		$hhi_fetch=mysqli_fetch_assoc($sql_exe_get);
		$msg="";
    	$var="";
    	$msg="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Personal Information </th></tr></table>";
    	$msg.="<table style='width:100%' class='table-bordered' border='2'>";
    	$msg.="<tr>";
    	$msg.="<th>District</th>";
    	$msg.="<th>Block</th>";
    	$msg.="<th>GP Name</th>";
    	$msg.="<th>Village</th>";
    	$msg.="<th>Month</th>";
    	$msg.="<th>Year</th>";
    	$msg.="<th>HHI</th>";
    	$msg.="<th>Woman Farmer</th>";
    	$msg.="<th>Spouse Name</th>";
    	$msg.="</tr>";
    	$msg.="<tr>";
    	$msg.="<td>".$hhi_fetch['care_district_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_block_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_gp_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_village_name']."</td>";    	
    	$msg.="<td>".$month_name."</td>";
    	$msg.="<td>".$year."</td>";
    	$msg.="<td>".$care_hhi."</td>";
    	$msg.="<td>".$hhi_fetch['care_women_farmer']." </td>";
    	$msg.="<td>".$hhi_fetch['care_spouse_name']."</td>";
    	$msg.="</tr>";
    	$msg.="</table>";
    	// part 1
    	$msg.="<table style='width:100%' class='table-bordered' border='2'><tr><th colspan='10'>Part 1 </th></tr></table>";
    	$msg.="<table class='table-bordered' border='2'>";
    	$msg.="<tr>";
    	$msg.="<th>Date CRP Entry</th><th>Training provided in classroom <br> ( If  Yes  skip to next col. )</th><th>Mention the subject matter </th><th>Male</th><th>Female</th>";
    	
    	$msg.="</tr>";
    	$msg.="<tr>";
    	$msg.="<td>".$fetch_table3['care_PHL_date']."</td>";
    	if($fetch_table3['care_CT_status']==1){$var="Yes";}
    	if($fetch_table3['care_CT_status']==2){$var="No";}
    	$msg.="<td>".$var."</td>";
    	if($fetch_table3['care_CT_subject_matter']==1){$var="Improved Storing";} 
		if($fetch_table3['care_CT_subject_matter']==2){$var="FAQ & others on Pulse,Veg/Fruits/Grains";}  
    	$msg.="<td>".$var."</td>";
    	$msg.="<td>".$fetch_table3['care_CT_male_present']."</td>";    	
    	$msg.="<td>".$fetch_table3['care_CT_feamle_present']."</td>";
    	
    	$msg.="</tr>";
    	$msg.="</table>";
    	// part 2
    	$msg.="<table style='width:100%' class='table-bordered' border='2'><tr><th colspan='10'>Part 2 </th></tr></table>";
    	$msg.="<table class='table-bordered' border='2'>";
    	$msg.="<tr>";
    	$msg.=" <th>Demonstration Provided <br> ( If  Yes  skip to next col. )</th><th>Mention the subject matter </th><th>Male</th><th>Female</th>";    
    	$msg.="</tr>";
    	$msg.="<tr>";
    	if($fetch_table3['care_DP_status']==1){$var="Yes";}
		if($fetch_table3['care_DP_status']==2){$var="No";}
    	$msg.="<td>".$var."</td>";
    	if($fetch_table3['care_DP_subject_matter']==1){$var="Improved Storing";} 
		if($fetch_table3['care_DP_subject_matter']==2){$var="FAQ & others on Pulse,Veg/Fruits/Grains";} 
    	$msg.="<td>".$var."</td>";
    	$msg.="<td>".$fetch_table3['care_DP_male_present']."</td>";
    	$msg.="<td>".$fetch_table3['care_DP_female_present']."</td>";    	
    	
    	$msg.="</tr>";
    	$msg.="</table>";
    	// part 3
    	$msg.="<table style='width:100%' class='table-bordered' border='2'><tr><th colspan='10'>Part 3 </th></tr></table>";
    	$msg.="<table class='table-bordered' border='2'>";
    	$msg.="<tr>";
    	$msg.="<th>Name of inputs provided</th><th>Implement being used or not <br>( This  is only for implements)</th><th>Farmer parcticing the trained technique <br> ( This  is for all including outcome of training)</th>";
    	
    	$msg.="</tr>";
    	$msg.="<tr>";
    	if($fetch_table3['care_IP_name']==1){$var="Moistermeter";}
 		if($fetch_table3['care_IP_name']==2){$var="Hermative bags";}
		if($fetch_table3['care_IP_name']==3){$var="Tarpaulin sheet";} 
		if($fetch_table3['care_IP_name']==4){$var="other";}
    	$msg.="<td>".$var."</td>";
    	if($fetch_table3['care_implements']==1){$var="Yes";}
		if($fetch_table3['care_implements']==2){$var="No";}
    	$msg.="<td>".$var."</td>";
    	 if($fetch_table3['care_farmer_parcticing']==1){$var="Yes";}
    	  if($fetch_table3['care_farmer_parcticing']==2){$var="NO";}
    	$msg.="<td>".$var."</td>";    	
    	$msg.="</tr>";
    	$msg.="</table>";
    	echo $msg;
		break;
	case 'form3':
		$names=date('d-m-Y').' - '.date('H:i a'); //to rename the file
	    header('Content-Disposition: attachment; filename='.$names.'.xls'); 
	    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
	    header('Pragma: no-cache');
	    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');

		$TYPE=web_decryptIt(str_replace(" ", "+",$_GET['TYPE']));
		$get_life_stock3="SELECT * FROM `care_master_MTF_livestock_TARINA` WHERE `livestock`='$TYPE' and `care_LS_slno`='$id'";
		$sql_phl_table3=mysqli_query($conn,$get_life_stock3);
		$x_id=0;
		$fetch_table3=mysqli_fetch_assoc($sql_phl_table3);
		$year=$fetch_table3['care_LS_year'];
		$months=$fetch_table3['care_LS_month'];
		$care_hhi=$fetch_table3['care_LS_hhid'];
		$monthArray = range(1, 12);
      foreach ($monthArray as $month) {
        // padding the month with extra zero
          $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
        // you can use whatever year you want
        // you can use 'M' or 'F' as per your month formatting preference
          $fdate = date("F", strtotime("2017-$monthPadding-01"));
          if($months==$monthPadding){
          	$month_name=$fdate;
          }
      }

		$get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' ";
		$sql_exe_get=mysqli_query($conn,$get_hhi);
		$hhi_fetch=mysqli_fetch_assoc($sql_exe_get);
		$msg="";
    	$var="";
    	$msg="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Personal Information </th></tr></table>";
    	$msg.="<table style='width:100%' class='table-bordered' border='2'>";
    	$msg.="<tr>";
    	$msg.="<th>District</th>";
    	$msg.="<th>Block</th>";
    	$msg.="<th>GP Name</th>";
    	$msg.="<th>Village</th>";
    	$msg.="<th>Month</th>";
    	$msg.="<th>Year</th>";
    	$msg.="<th>HHI</th>";
    	$msg.="<th>Woman Farmer</th>";
    	$msg.="<th>Spouse Name</th>";
    	$msg.="</tr>";
    	$msg.="<tr>";
    	$msg.="<td>".$hhi_fetch['care_district_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_block_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_gp_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_village_name']."</td>";    	
    	$msg.="<td>".$month_name."</td>";
    	$msg.="<td>".$year."</td>";
    	$msg.="<td>".$care_hhi."</td>";
    	$msg.="<td>".$hhi_fetch['care_women_farmer']." </td>";
    	$msg.="<td>".$hhi_fetch['care_spouse_name']."</td>";
    	$msg.="</tr>";
    	$msg.="</table>";
    	echo $msg;
    		$msg2="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 1 </th></tr></table>";
    	echo $msg2;
    	?>
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
                         <td><?php if($fetch_table3['care_LS_IP_training']==1){echo "Yes";}?> <?php if($fetch_table3['care_LS_IP_training']==2){echo "No";}?></td>
                          <!-- training -->
                          <td><?php if($fetch_table3['care_LS_IP_extension_support']==1){echo "Yes";}?><?php if($fetch_table3['care_LS_IP_extension_support']==2){echo "No";}?></td>
                          <!-- extension support -->
                          <td><?=$fetch_table3['care_LS_ES_no_of_animal']?></td>
                          <!-- no of extenston support -->
                          <td><?php if($fetch_table3['care_LS_IP_medicine']==1){echo "Yes";}?><?php if($fetch_table3['care_LS_IP_medicine']==2){echo "No";}?></td>
                          <!-- medicine  -->
                          <td><?=$fetch_table3['care_LS_Med_no_of_animal']?></td>
                          <!-- no of medice used -->
                          <td><?php if($fetch_table3['care_LS_IP_vaccination']==1){echo "Yes";}?><?php if($fetch_table3['care_LS_IP_vaccination']==2){echo "No";}?></td>
                          <!-- vaccination  -->
                          <td><?=$fetch_table3['care_LS_VN_no_of_animal']?></td>
                          <td><?php if($fetch_table3['care_LS_IP_others']==1){echo "Yes";}?><?php if($fetch_table3['care_LS_IP_others']==2){echo "No";}?>
                          <br>
                          <?php if($fetch_table3['care_LS_IP_others']==1){?>
                          <?=$fetch_table3['care_LS_IP_others_specify']?>
                          <?php }?>
                        </td>
                        <td>
                          <!-- other -->
                           <?php if($fetch_table3['care_LS_IP_others']==1){?>
                          <?=$fetch_table3['care_LS_other_no_of_animal']?>
                          <?php }?>
                        </td>

 
                        </tr>
                        
                      </tbody>
                    </table>
    	<?php
    	$msg3="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 2 </th></tr></table>";
    	echo $msg3;
    	?>
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
                         <?=$fetch_table3['care_LS_total_animal']?></td>
                         <td><?php if($fetch_table3['care_LS_cultivating_fodder']==1){echo "Yes";}?><?php if($fetch_table3['care_LS_cultivating_fodder']==2){echo "No";}?></td>
                          <td><?=$fetch_table3['care_LS_cultivated_area']?></td>
                          <td><?php if($fetch_table3['care_LS_new_farmer']==1){echo "Yes";}?><?php if($fetch_table3['care_LS_new_farmer']==2){echo "No";}?></td>
                          <td><?php if($fetch_table3['care_LS_continued_farmer']==1){echo "Yes";}?><?php if($fetch_table3['care_LS_continued_farmer']==2){echo "No";}?></td>                  
                        </tr>
                        
                      </tbody>
                    </table>  
    	<?php
    	$msg4="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 3 </th></tr></table>";
    	echo $msg4;
    	?>
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
                        
                          <td><?=$fetch_table3['care_LS_QP_extension_support']?></td>
                          <td>
                               <table id="myTable" class=" table order-list-Medicine">
                                <thead>
                                    <tr>
                                        <td>Medicine Name</td>
                                        <td>Medicine Quantity</td>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  <!-- care_LS_slno -->
                                  <?php 
                                  $care_LS_slno=$fetch_table3['care_LS_slno'];
                                  $get_med1="SELECT * FROM `care_master_livestock_quantity_provided` WHERE `care_QP_livestock_slno`='$care_LS_slno' and`care_QP_type`='1'";
                                     $sql_med_table1=mysqli_query($conn,$get_med1);
                                   while ($fetch_med1=mysqli_fetch_assoc($sql_med_table1)) {?>
                                    <tr>
                                        <td class="col-sm-4">
                                            <?=$fetch_med1['care_QP_item_name']?>
                                        </td>
                                        <td class="col-sm-4">
                                        	<?php if(!empty($fetch_med1['care_QP_quantity'])){
                                            	echo $fetch_med1['care_QP_quantity'];
                                            }else{
                                            	echo "0";
                                            }?>
                                            
                                        </td>                                        
                                        <!-- // <td class="col-sm-2"><a class="deleteRow-Medicine"></a> -->

                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                               
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
                                  <?php 
                                   $get_med2="SELECT * FROM `care_master_livestock_quantity_provided` WHERE `care_QP_livestock_slno`='$care_LS_slno' and`care_QP_type`='2'";
                                     $sql_med_table2=mysqli_query($conn,$get_med2);
                                   while ($fetch_med2=mysqli_fetch_assoc($sql_med_table2)) {?>
                                    <tr>
                                        <td class="col-sm-4">
                                            <?=$fetch_med2['care_QP_item_name']?>
                                        </td>
                                        <td class="col-sm-4">
                                            <?php if(!empty($fetch_med2['care_QP_quantity'])){
                                            	echo $fetch_med2['care_QP_quantity'];
                                            }else{
                                            	echo "0";
                                            }?>
                                        </td>                                        
                                        <!-- <td class="col-sm-2"><a class="deleteRow-Vaccination"></a> -->
                                        </td>
                                       
                                    </tr>
                                     <?php }?>
                                </tbody>
                               
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
                                  <?php 
                                   $get_med3="SELECT * FROM `care_master_livestock_quantity_provided` WHERE `care_QP_livestock_slno`='$care_LS_slno' and`care_QP_type`='3'";
                                     $sql_med_table3=mysqli_query($conn,$get_med3);
                                   while ($fetch_med3=mysqli_fetch_assoc($sql_med_table3)) {?>
                                    <tr>
                                        <td class="col-sm-4">
                                           <?=$fetch_med3['care_QP_item_name']?>
                                        </td>
                                        <td class="col-sm-4">
                                        	 <?php if(!empty($fetch_med3['care_QP_quantity'])){
                                            	echo $fetch_med3['care_QP_quantity'];
                                            }else{
                                            	echo "0";
                                            }?>
                                        
                                        </td>                                        
                                        <!-- <td class="col-sm-2"><a class="deleteRow-Others"></a> -->

                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                
                            </table>
                          </td> 
                         
                       
                      </tbody>
                    </table>

    	<?php
		break;
	 case 'form6':
	 		$names=date('d-m-Y').' - '.date('H:i a'); //to rename the file
	    header('Content-Disposition: attachment; filename='.$names.'.xls'); 
	    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
	    header('Pragma: no-cache');
	    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');


	 		$sql_id_query1="SELECT * FROM `care_master_MTF_labour_saving_tech_TARINA` WHERE `care_MTF_slno`='$id' ";
			$sql_exe_table1s=mysqli_query($conn,$sql_id_query1);
			$x_id=0;
			$res12=mysqli_fetch_assoc($sql_exe_table1s);
			$months= $res12['care_MTF_month'];
			$year=$res12['care_MTF_year'];
			$care_hhi=$res12['care_MTF_hhid'];
			// Array ( [ID] => LFao7iukYbKLQDXvOnSsBhUmQNtWeOM2gEk1Sb0IaNo= [TOKEN_ID] => WADuJmcX3b5zLsOHAjME0m3nZ6FCpACkKVquIxI/j0Y= [TYPE] => 0qkgUfUknFP5duX kz 31BwGThyQvL8or84Q7V FYnA= [year] => whLZpPsds9Ze12kSi1rWLPEKrSyToY9H/mzGjSgQKBY= [village] => GopWP6U1Y8S6cryIsnWb1WIiIQ9o3CjIq93aCLYylLE= )
			$get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi'";
			$sql_exe_get=mysqli_query($conn,$get_hhi);
			$hhi_fetch=mysqli_fetch_assoc($sql_exe_get);

			$msg="";
    	$var="";
    	$msg="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Personal Information </th></tr></table>";
    	$msg.="<table style='width:100%' class='table-bordered' border='2'>";
    	$msg.="<tr>";
    	$msg.="<th>District</th>";
    	$msg.="<th>Block</th>";
    	$msg.="<th>GP Name</th>";
    	$msg.="<th>Village</th>";
    	$msg.="<th>Month</th>";
    	$msg.="<th>Year</th>";
    	$msg.="<th>HHI</th>";
    	$msg.="<th>Woman Farmer</th>";
    	$msg.="<th>Spouse Name</th>";
    	$msg.="</tr>";
    	$msg.="<tr>";
    	$msg.="<td>".$hhi_fetch['care_district_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_block_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_gp_name']."</td>";
    	$msg.="<td>".$hhi_fetch['care_village_name']."</td>";    	
    	$msg.="<td>".$month_name."</td>";
    	$msg.="<td>".$year."</td>";
    	$msg.="<td>".$care_hhi."</td>";
    	$msg.="<td>".$hhi_fetch['care_women_farmer']." </td>";
    	$msg.="<td>".$hhi_fetch['care_spouse_name']."</td>";
    	$msg.="</tr>";
    	$msg.="</table>";
    	echo $msg;
    	$msg2="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 1 </th></tr></table>";
    	echo $msg2;
    	?>
    	<table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Date Of CRP Entry</th>
                          <th>Name of implement/ Devices</th>
                          <th>Target Activity </th>
                          <th>Trained in class room setting</th>
                          <th>Demonstration held date</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                   
                         
                        <tr>
                          <td> <?=$res12['care_MTF_date']?></td>
                          <td><?=$res12['care_MTF_implement_name']?></td>
                          <td>                            
                            <?php 
                                $get_traget="SELECT * FROM `care_master_target_LST_info` WHERE `care_status_target`='1'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
                                   if($res12['care_MTF_target_activity']==$traget_fetch['Care_slno'])
                                   	{echo $traget_fetch['care_activity_name'];}
                                }
                                ?>
                                	
                                </td>
                          <td><<?php if($res12['care_MTF_classroom_trained']==1){echo "Yes";}?>
                             <?php if($res12['care_MTF_classroom_trained']==2){echo "No";}?>
                         </td>
                          
                          <td><?=$res12['care_MTF_demo_date']?></td>
                        </tr>                       
                      </tbody>
                    </table>

    	<?php 

    	$msg3="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 2 </th></tr></table>";
    	echo $msg3;
    	?>
    	<table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Member present <br> Male</th>
                          <th>Member present <br> Female</th>
                          
                          
                        </tr>
                      </thead>
                      <tbody>
                        
                        <tr>
                          
                          <td><?=$res12['care_MTF_male_present']?></td>
                          <td><?=$res12['care_MTF_female_present']?></td>
                          
                          
                          
                        </tr>
                        
                      </tbody>
                    </table>
		<?php
    	$msg4="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 3 </th></tr></table>";
    	echo $msg4;
    	?>
    	<table id='example' class="table table-hover" border="1">
                      <thead>
                        <tr>
                          <th>Implement/Devices being used or not</th>
                          <th>Farmer using <br>Male</th>
                          <th>Farmer using <br> Female</th>
                        
                        </tr>
                      </thead>
                      <tbody>
               
                        <tr>
                          
                           <td><?php if($res12['care_MTF_implements']==1){echo "Yes";}?>
                           <?php if($res12['care_MTF_implements']==2){echo "No";}?></td>
                          <td><?=$res12['care_MTF_male_farmer_using']?></td>
                          <td><?=$res12['care_MTF_female_farmer_using']?></td>
                         </tr>
                      </tbody>
                    </table>
    	<?php
	 	break;
	 	case 'form7':
		 	$names=date('d-m-Y').' - '.date('H:i a'); //to rename the file
		    header('Content-Disposition: attachment; filename='.$names.'.xls'); 
		    header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
		    header('Pragma: no-cache');
		    header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');

        $get_kictch4="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_slno`='$id'";
        $sql_exe_get4=mysqli_query($conn,$get_kictch4);
        $x_id=0;
        $res_fetch4=mysqli_fetch_assoc($sql_exe_get4);
        $months=$res_fetch4['care_CRP_month']; 
         $year=$res_fetch4['care_CRP_year'];
        $care_hhi=$res_fetch4['care_hhid'];
        $TYPE=$res_fetch4['care_form_type'];
         switch ($TYPE) {
           case '1':
           $type_insert='1';
            $name="Farmland";
             $type_item="Pulses/Legumes/Vegetables";
             break;
          case '2':
            $type_insert='2';
            $name="Kitchen Garden";
            $type_item="Vegetables/Fruits";
             break;
           default:
             # code...
             break;
         }
        $get_hhi="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi' ";
        $sql_exe_get=mysqli_query($conn,$get_hhi);
        $hhi_fetch=mysqli_fetch_assoc($sql_exe_get);
        $msg="";
        $var="";
        $msg="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Personal Information </th></tr></table>";
        $msg.="<table style='width:100%' class='table-bordered' border='2'>";
        $msg.="<tr>";
        $msg.="<th>District</th>";
        $msg.="<th>Block</th>";
        $msg.="<th>GP Name</th>";
        $msg.="<th>Village</th>";
        $msg.="<th>Month</th>";
        $msg.="<th>Year</th>";
        $msg.="<th>HHI</th>";
        $msg.="<th>Woman Farmer</th>";
        $msg.="<th>Spouse Name</th>";
        $msg.="</tr>";
        $msg.="<tr>";
        $msg.="<td>".$hhi_fetch['care_district_name']."</td>";
        $msg.="<td>".$hhi_fetch['care_block_name']."</td>";
        $msg.="<td>".$hhi_fetch['care_gp_name']."</td>";
        $msg.="<td>".$hhi_fetch['care_village_name']."</td>";
        $msg.="<td>".$month_name."</td>";
        $msg.="<td>".$year."</td>";
        $msg.="<td>".$care_hhi."</td>";
        $msg.="<td>".$hhi_fetch['care_women_farmer']." </td>";
        $msg.="<td>".$hhi_fetch['care_spouse_name']."</td>";
        $msg.="</tr>";
        $msg.="</table>";
        // part 1
        $msg.="<table style='width:100%' class='table-bordered' border='2'><tr><th colspan='10'>Part 1 </th></tr></table>";
      echo $msg;
      ?> <table id='example' class="table table-hover" border="1">
            <thead>
              <tr>
                <th>Date OF CRP Entry</th>
                <th>Type of <?=$type_item?></th>
                <th>Area cultivated (Acre)</th>
                <th>New Farmers</th>
                <th>Demo Plot farmers</th>
                <th>Continued farmers</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               <td> <?=$res_fetch4['care_CRP_date']?></td>
                <td><?=$res_fetch4['care_pulses_type']?></td>
                <td><?=$res_fetch4['care_area_cultivated']?></td>
                <td><<?php if($res_fetch4['care_continued_farmer']==1){echo "Yes";}?>
                  <?php if($res_fetch4['care_continued_farmer']==2){echo "No";}?></td>
                <td><?php if($res_fetch4['care_demo_plot_farmer']==1){echo "Yes";}?>
                 <?php if($res_fetch4['care_demo_plot_farmer']==2){echo "No";}?></td>
                <td><?php if($res_fetch4['care_continued_farmer']==1){echo "Yes";}?><?php if($res_fetch4['care_continued_farmer']==2){echo "No";}?></td>
              </tr>
            </tbody>
          </table>

      <?php
      $msg2="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 2 </th></tr></table>";
      echo $msg2;
      ?>
      <table id='example' class="table table-hover" border="1">
        <thead>
          <tr>
            <th>Training</th>
            <th>Seed</th>
            <th>Fertiliser</th>
            <th>Pesticides</th>
            <th>Extension Support</th>
            <th>Others (Specify)</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php if($res_fetch4['care_IR_training']==1){echo "Yes";}?>
             <?php if($res_fetch4['care_IR_training']==2){echo "No";}?></td>
            <td><?php if($res_fetch4['care_IR_seed']==1){echo "Yes";}?>
             <?php if($res_fetch4['care_IR_seed']==2){echo "No";}?></td>
            <td><?php if($res_fetch4['care_IR_fertiliser']==1){echo "Yes";}?><?php if($res_fetch4['care_IR_fertiliser']==2){echo "No";}?>
            </td>
            <td><?php if($res_fetch4['care_IR_pesticides']==1){echo "Yes";}?>
              <?php if($res_fetch4['care_IR_pesticides']==2){echo "No";}?></td>
            <td><<?php if($res_fetch4['care_IR_extension_support']==1){echo "Yes";}?><?php if($res_fetch4['care_IR_extension_support']==2){echo "No";}?></td>
            <td><?php if($res_fetch4['care_IR_other']==1){echo "Yes";}?>
             <?php if($res_fetch4['care_IR_other']==2){echo "No";}?>
            </td>
            <td>
               <?php if($res_fetch4['care_IR_other']==1){
                echo $res_fetch4['care_CRP_other_detail'];
              }else{
                echo "";
              }?>
          </td>
          </tr>
        </tbody>
      </table>
      <?php
      $msg3="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 3 </th></tr></table>";
      echo $msg3;
      ?><table id='example' class="table table-hover" border="1">
          <thead>
            <tr>
              <th>Seed</th>
              <th>Fertiliser</th>
              <th>Pesticides</th>
              <th>Others (Specify)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
               <?=$res_fetch4['care_QR_seed']?>
              </td>
              <td>
               <?=$res_fetch4['care_QR_fertiliser']?>
              </td>
               <td>
              <?=$res_fetch4['care_QR_pesticides']?>
              </td>
               <td>
               <?=$res_fetch4['care_QR_other']?>
             </td>
            </tr>
          </tbody>
        </table>

    <?php
      $msg4="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 4 </th></tr></table>";
      echo $msg4;
      ?>
        <table id='example' class="table table-hover" border="1">
          <thead>
            <tr>
              <th>Production<br>Consumption</th>
              <th>Production<br>Sale</th>
              <th>Production<br>Total Produciton</th>
              <th>Production <br>Average price(Rs/Kg)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
               <?=$res_fetch4['care_P_consumption']?>
              </td>
              <td>
              <?=$res_fetch4['care_P_sale']?>
              </td>
               <td>
              <?=$res_fetch4['care_P_total_production']?>
              </td>
               <td>
                <?=$res_fetch4['care_avg_price']?>
              </td>
             </tr>
          </tbody>
        </table>
      <?php
	 	break;
  case 'form9':
      $names=date('d-m-Y').' - '.date('H:i a'); //to rename the file
      header('Content-Disposition: attachment; filename='.$names.'.xls'); 
      header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
      header('Pragma: no-cache');
      header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');
      $care_EV_slno=web_decryptIt(str_replace(" ", "+", $_GET['care_EV_slno']));
      $employee_id=$_SESSION['employee_id'];
    $get_training1="SELECT * FROM `care_master_MRF_exposure_visit_TARINA` WHERE `care_EV_slno`='$id' and `care_EV_employee_id`='$employee_id' ";
      $sql_exe_training2=mysqli_query($conn,$get_training1);
      $x_id=0;
      $res3=mysqli_fetch_assoc($sql_exe_training2);
      $village=$res3['care_EV_vlg_name'];
      $Year=$res3['care_EV_year'];
      $months=$res3['care_EV_month'];
      $monthArray = range(1, 12);
      foreach ($monthArray as $month) {
        // padding the month with extra zero
          $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
        // you can use whatever year you want
        // you can use 'M' or 'F' as per your month formatting preference
          $fdate = date("F", strtotime("2017-$monthPadding-01"));
          if($months==$monthPadding){
            $month_name=$fdate;
          }
      }
      $get_detail="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_village_id`='$village'";
      $sql_exe_detail=mysqli_query($conn,$get_detail);
      $fetch_data=mysqli_fetch_assoc($sql_exe_detail);

      $msg="";
      $var="";
      $msg="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Training Information </th></tr></table>";
      $msg.="<table style='width:100%' class='table-bordered' border='2'>";
      $msg.="<tr>";
      $msg.="<th>District</th>";
      $msg.="<th>Block</th>";
      $msg.="<th>GP Name</th>";
      $msg.="<th>Village</th>";
      $msg.="<th>Month</th>";
      $msg.="<th>Year</th>";
      $msg.="<th>Thematic Intervention</th>";
      $msg.="<th>Topics Covered</th>";     
      $msg.="</tr>";
      $msg.="<tr>";
      $msg.="<td>".$fetch_data['care_assU_district_id']."</td>";
      $msg.="<td>".$fetch_data['care_assU_block_id']."</td>";
      $msg.="<td>".$fetch_data['care_assU_gp_id']."</td>";
      $msg.="<td>".$fetch_data['care_assU_village_id']."</td>";     
      $msg.="<td>".$month_name."</td>";
      $msg.="<td>".$year."</td>";
      $get_traget="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_status`='1'";
      $sql_exe_traget=mysqli_query($conn,$get_traget);
      while ($traget_fetch=mysqli_fetch_assoc($sql_exe_traget)) {
        if($res3['care_EV_them_intervention']==$traget_fetch['care_thi_slno']){$var=$traget_fetch['care_thi_thematic_name'];}
      }
      $msg.="<td>".$var."</td>";
      $msg.="<td>".$res3['care_EV_topics_covered']." </td>";
    
      $msg.="</tr>";
      $msg.="</table>";
       // part 1
        $msg.="<table style='width:100%' class='table-bordered' border='2'><tr><th colspan='10'>Part 1 </th></tr></table>";
      echo $msg;
      ?>
      <table id='example' class="table table-hover" border="1">
        <thead>
          <tr>
            <th>CRP Entry Date</th>
            <th>Date</th>
            <th>Average Duration  of session (in Hr.)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?=$res3['care_EV_date']?></td>
            <td><?=$res3['care_EV_event_date']?></td>
            <td><?=$res3['care_EV_avg_session_duration']?></td>
          </tr>
       </tbody>
    </table>
 <?php
      $msg2="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 2 </th></tr></table>";
      echo $msg2;
      ?>
      <table id='example' class="table table-hover" border="1">
        <thead>
          <tr>
            <th>No. of Participants <br>Male</th>
            <th>No. of Participants <br>Female</th>
            <th>No. of HHs <br>covered</th>
            <th>No. of Participants Repeats <br> Male</th>
            <th>No. of Participants Repeats <br> Female</th>
            <th>No. of HHs <br>Repeats</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
             <?=$res3['care_EV_male_Participants']?>" class="form-control" name="Participants_Male" required="">
            </td>
            <td>
             <?=$res3['care_EV_female_Participants']?>
            </td>
            <td>
             <?=$res3['care_EV_no_of_hhs_covered']?>
            </td>
            <td>
              <?=$res3['care_EV_male_Participants_repeats']?>
            </td>
            <td>
              <?=$res3['care_EV_female_Participants_repeats']?>
            </td>
            <td>
              <?=$res3['care_EV_no_of_hhs_repeats']?>
            </td>
          </tr>
        </tbody>
      </table>
<?php
      $msg3="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 3 </th></tr></table>";
      echo $msg3;
      ?>
      <table id='example' class="table table-hover" border="1">
        <thead>
          <tr>
            
            <th>Type of Training</th>
            <th>Type of group</th>
            <th>Training Facilitator</th>
            <th>External Resource person<br>/agency, if any</th>
            <th>Remarks</th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td>
             
              <?php 
                  $get_training="SELECT * FROM `care_master_training_info` WHERE `care_trng_status`='1'";
                  $sql_exe_training=mysqli_query($conn,$get_training);
                  while ($training_fetch=mysqli_fetch_assoc($sql_exe_training)) {
                     if($res3['care_EV_training_type']==$training_fetch['care_trng_name']){echo $training_fetch['care_trng_name'];}
                  }
                  ?>
           
            </td>
            <td>
             <
              <?php 
                  $get_ttraining="SELECT * FROM `care_master_group_info` WHERE `care_group_status`='1'";
                  $sql_exe_group=mysqli_query($conn,$get_ttraining);
                  while ($group_fetch=mysqli_fetch_assoc($sql_exe_group)) {
                    if($res3['care_EV_group_type']==$group_fetch['care_group_name']){
                      echo $group_fetch['care_group_name'];
                    }
                  }
                  ?>
            </select>
            </td>
             <td>
            <?=$res3['care_EV_training_facilitator']?>
            </td>
             <td>
            <?=$res3['care_EV_external_resource']?>
            </td>
             <td>
              <i<?=$res3['care_EV_remarks']?>
            </td>
          </tr>
        </tbody>
      </table>
    <?php
    break;
    case 'form10':
      $names=date('d-m-Y').' - '.date('H:i a'); //to rename the file
      header('Content-Disposition: attachment; filename='.$names.'.xls'); 
      header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
      header('Pragma: no-cache');
      header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');
      $get_detail_query="SELECT * FROM `care_master_MRF_SHG_tracking_under_TARINA` WHERE `care_SHG_slno`='$id' ";
      $sql_exe_deatils=mysqli_query($conn,$get_detail_query);
      $res1=mysqli_fetch_assoc($sql_exe_deatils); 

      $village=$res1['care_SHG_vlg_name'];
      $months=$res1['care_SHG_month'];
      $year=$res1['care_SHG_year'];

      $employee_id=$res1['care_SHG_employee_id'];

        $get_shg="SELECT * FROM `care_master_village_info` WHERE `care_vlg_name`='$village'";
        $sql_exe_get=mysqli_query($conn,$get_shg);
        $shg_fetch=mysqli_fetch_assoc($sql_exe_get);
        $msg="";
      $var="";
      $msg="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>SHG Information </th></tr></table>";
      $msg.="<table style='width:100%' class='table-bordered' border='2'>";
      $msg.="<tr>";
      $msg.="<th>District</th>";
      $msg.="<th>Block</th>";
      $msg.="<th>GP Name</th>";
      $msg.="<th>Village</th>";
      $msg.="<th>Month</th>";
      $msg.="<th>Year</th>";
      $msg.="<th>SHG</th>";
      $msg.="</tr>";
      $msg.="<tr>";
      $msg.="<td>".$shg_fetch['care_vlg_district']."</td>";
      $msg.="<td>".$shg_fetch['care_vlg_block']."</td>";
      $msg.="<td>".$shg_fetch['care_vlg_gp']."</td>";
      $msg.="<td>".$shg_fetch['care_vlg_name']."</td>";
      $msg.="<td>".$month_name."</td>";
      $msg.="<td>".$year."</td>";
      $msg.="<td>".$res1['care_SHG_name']."</td>";
      $msg.="</tr>";
      $msg.="</table>";
       // part 1
        $msg.="<table style='width:100%' class='table-bordered' border='2'><tr><th colspan='10'>Part 1 </th></tr></table>";
      echo $msg;
      ?>
       <table id='example' class="table table-hover" border="1">
        <thead>
          <tr>
            <th>Date Of Entry</th>
            <th>Total no. of Members</th>
            <th>Last Month Meeting Date </th>
            <th>Member present in <br> monthly meeting</th>
            <!-- <th>Average Duration  of session (in Hr.)</th> -->
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?=$res1['care_SHG_date']?></td>
            <td><?=$res1['care_SHG_total_member']?></td>
            <td><?=$res1['care_SHG_LMM_date']?></td>
            <td><?=$res1['care_SHG_mem_prsnt_monthly_meeting']?></td>
          </tr>
        </tbody>
      </table>
      <?php
      $msg2="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 2 </th></tr></table>";
      echo $msg2;
      ?>
        <table id='example' class="table table-hover" border="1">
          <thead>
            <tr>
              <th><!-- Record Maintenance and update <br> --> Meeting Register</th>
              <th><!-- Record Maintenance and update --> <br> Cash book</th>
              <th><!-- Record Maintenance and update --> <br> Individual Passbook</th>
              <th><!-- Record Maintenance and update --> <br> Group pass book</th>
              <th><!-- Record Maintenance and update  --><br> Saving & loan ledger book</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <?php if($res1['care_SHG_RMU_meeting_redg']==1){echo "Yes";}?><?php if($res1['care_SHG_RMU_meeting_redg']==2){echo "No";}?>
              </td>
              <td><?php if($res1['care_SHG_RMU_cash_book']==1){echo "Yes";}?><?php if($res1['care_SHG_RMU_cash_book']==2){echo "selected";}?></td>
              <td><?php if($res1['care_SHG_RMU_ind_passbook']==1){echo "Yes";}?><?php if($res1['care_SHG_RMU_ind_passbook']==2){echo "No";}?></td>
              <td><?php if($res1['care_SHG_RMU_group_passbook']==1){echo "Yes";}?><?php if($res1['care_SHG_RMU_group_passbook']==2){echo "No";}?></td>
              <td><?php if($res1['care_SHG_RMU_saving_loan_ledger_book']==1){echo "Yes";}?><?php if($res1['care_SHG_RMU_saving_loan_ledger_book']==2){echo "No";}?></td>
            </tr>
          </tbody>
        </table>
      <?php
      $msg3="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 3 </th></tr></table>";
      echo $msg3;
      ?>
        <table id='example' class="table table-hover" border="1">
          <thead>
            <tr>
              <th>Linkage to external credit <br>(Gr taken loan from bank/MFI)</th>
              <th>Name of the <br>Bank/Institution linked</th>
              <th>No of Member linkages <br>to market</th>
              <th>No of Member linkages <br>technical support provider@</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?=$res1['care_SHG_ML_linkage_external_credit']?></td>
              <td><?=$res1['care_SHG_ML_bank_name']?></td>
              <td><?=$res1['care_SHG_ML_no_of_mem_link_market']?></td>
              <td><?=$res1['care_SHG_ML_no_of_mem_link_tech_support_provider']?></td>
            </tr>
          </tbody>
        </table>
      <?php
      $msg4="<table class='table-bordered' style='width:100%' border='2'><tr><th colspan='10'>Part 4 </th></tr></table>";
      echo $msg4;
      ?>
      <table id='example' class="table table-hover" border="1">
        <thead>
          <tr>
            <th>No of member linkaged<br> to any committee</th>
            <th>Name of the committee</th>
            <th>Nutrition Discussion in<br> SHG Monthly Meeting.</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?=$res1['care_SHG_no_of_mem_link_any_committee']?></td>
            <td><?=$res1['care_SHG_committee_name']?></td>
            <td><?php if($res1['care_SHG_nutrition_discus_SHG_mnthly_meeting']==1){echo "Yes";}?><?php if($res1['care_SHG_nutrition_discus_SHG_mnthly_meeting']==2){echo "No";}?></td>
          </tr>
        </tbody>
      </table>
      <?php
      break;
	default:
		# code...
		break;
}


 }else{
 	header('Location:logout.php');
  	exit;
 }