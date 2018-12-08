<?php 
if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
     
      $months=$_POST['month'];
      $Year=$_POST['Year'];
      $District_name=$_POST['District_name'];
      $block_name=$_POST['block_name'];
      $gp_name=$_POST['gp_name'];
      $village=$_POST['village'];
    }else{
      $months="";
      $Year="";
      $District_name="";
      $block_name="";
      $gp_name="";
      $village="";
       header('Location:logout.php');
      exit;
    }
  }else{
      $months="";
      $Year="";
      $District_name="";
      $block_name="";
      $gp_name="";
      $village="";
  }
?>

<label for="District_name">District :</label>
	<input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">
		<select class="form-control" onchange="get_block()" id="District_name" name="District_name" required="">
			<option value="">--Please Select District--</option>
			<?php 
			$query="SELECT * FROM `care_master_district_info` WHERE `care_dis_status`='1'";
			$query_exe=mysqli_query($conn,$query);
			while ($fetch=mysqli_fetch_assoc($query_exe)) {
			?>
			<option value="<?php echo $fetch['care_dis_name'];?>" <?php if($District_name==$fetch['care_dis_name']){ echo "selected";} ?>  ><?=$fetch['care_dis_name'];?></option>
			<?php } ?>
		</select>
		<label for="block_name">Block :</label>
    <?php if($block_name==""){?>block_name
                  <select class="form-control" id="block_name" name="block_name" required="">
                    <option value="">--Select GP Name--</option>
                  </select>
                  <?php }else{?>
                    <select class="form-control" id="block_name" name="block_name" required="">
                    <option value="">--Select GP Name--</option>
                   <?php $query_bloack="SELECT * FROM `care_master_block_info` WHERE `care_block_status`='1' and `care_block_dis_name`='$$District_name'";
                        $query_block_exe=mysqli_query($conn,$query_bloack);
                        while ($query_block_fetch=mysqli_fetch_assoc($query_block_exe)) {
                          ?>
                          <option value="<?=$query_block_fetch['care_block_name']?>"<?php if($block_name==$query_block_fetch['care_block_name']){ echo "selected";} ?> ><?=$query_block_fetch['care_block_name']?><option>
                          <?php
                        }?>
                  </select>
                 <?php }
                    ?>   

  
		<select class="form-control" onchange="get_gp()" id="block_name" name="block_name" required="">
                        <option value="">--Please Select Block--</option>
                    
        </select>
        <label  for="gp_name">GP Name </label> 
         <?php if($gp_name==""){?>
                  <select class="form-control" id="gp_name" name="gp_name" required="">
                    <option value="">--Select GP Name--</option>
                  </select>
                  <?php }else{?>
                    <select class="form-control" id="gp_name" name="gp_name" required="">
                    <option value="">--Select GP Name--</option>
                   <?php $query_gp="SELECT * FROM `care_master_gp_info` WHERE `care_gp_block`='$block_name' and `care_vlg_status`='1' ";
                        $query_gp_exe=mysqli_query($conn,$query_gp);
                        while ($query_gp_fetch=mysqli_fetch_assoc($query_gp_exe)) {
                          ?>
                          <option value="<?=$query_gp_fetch['care_gp_name']?>"<?php if($gp_name==$query_gp_fetch['care_gp_name']){ echo "selected";} ?> ><?=$query_gp_fetch['care_gp_name']?><option>
                          <?php
                        }?>
                  </select>
                 <?php }
                    ?>                  
          
        <label for="village">Village :</label>
                  <?php if($village==""){?>
                  <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                  </select>
                  <?php }else{?>
                    <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                   <?php $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_gp`='$gp_name' and `care_vlg_status`='1' ";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_vlg_name']?>"<?php if($village==$res_village['care_vlg_name']){ echo "selected";} ?> ><?=$res_village['care_vlg_name']?><option>
                          <?php
                        }?>
                  </select>
                 <?php }
                    ?>
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




<script type="text/javascript">
	function get_block() {
    
    var District_name=$('#District_name').val();
    var web_gp="get_block_id";
    if(District_name!=""){
      $.ajax({
        type:'POST',
        url:'report_get_information.php',
        data:'field_info_name='+District_name+'&web_district_ids='+web_gp,
        success:function(html){   
          $('#block_name').html(html); 
          get_gp(); 
          get_village();                  
        }
      });
    }else{
      $('#block_name').html('<option value="">-- Please Select District --</option>');
       $('#gp_name').html('<option value="">-- Please Select Block --</option>');
       $('#village').html('<option value="">-- Please Select GP Name --</option>');
       get_gp();
    }
  }
  function get_gp() {
    
    var block_name=$('#block_name').val();
    var web_gp="get_gp_id";
    if(block_name!=""){
      $.ajax({
        type:'POST',
        url:'report_get_information.php',
        data:'field_info_name='+block_name+'&web_district_ids='+web_gp,
        success:function(html){   
          $('#gp_name').html(html);     
          get_village();                  
        }
      });
    }else{
      $('#gp_name').html('<option value="">-- Please Select Block --</option>');
      $('#village').html('<option value="">-- Please Select GP Name --</option>');
    }
  }
  function get_village(){
  	 var gp_name=$('#gp_name').val();
    var web_gp="get_village_id";
    // alert();
    if(gp_name!=""){
      $.ajax({
        type:'POST',
        url:'report_get_information.php',
        data:'field_info_name='+gp_name+'&web_district_ids='+web_gp,
        success:function(html){   
          $('#village').html(html);                    
        }
      });
    }else{
      $('#village').html('<option value="">-- Please Select GP Name --</option>');
    }
  }
</script>