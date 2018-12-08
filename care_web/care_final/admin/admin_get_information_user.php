<?php 
//include 'config.php';
session_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  $user_roles_id=$_POST['user_roles_id'];
  switch ($user_roles_id) {
  	case '2':
    ?>
    <option value="">--Select User Level--</option>
    <option value="2">Kitchen Garden Form</option>
    <option value="6">Crop Diversification</option>
    <option value="3">Animal Husbandary Form</option>
    <option value="4">Labour Saving Technologies Form</option>
    <option value="5">Training & SHG Form</option>

    <?php
    	exit();


  		break;
  	case '3':?>
  		 <option value="">--Select User Level--</option>
    <option value="1">All Form</option>
    	<?php 
    	exit;
  		break;
  	case '4':?>
  		 <option value="">--Select User Level--</option>
    <option value="1">All Form</option>
	<?php 
	exit;
  		break;
  	case '5':?>
  		 <option value="">--Select User Level--</option>
    <option value="1">All Form</option>
	<?php 
	exit;
  		break;
  	
  	default:
  		header('Location:logout.php');
	exit;
  		break;
  }


}else{
	header('Location:logout.php');
	exit;
}