<?php 
$form_types=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];
?>

<link rel="stylesheet" href="https://use.fontawesome.com/6667a26d4c.css">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>Lab</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Ca</b>re</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../assert/dist/img/avatar2.gif" class="user-image" alt="User Image">
              <!-- 160X160  <?=$_SESSION['admin_name']?>-->
              <span class="hidden-xs"><?=$_SESSION['user_name']?></span>
              <!-- username -->
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../assert/dist/img/avatar2.gif" class="img-circle" alt="User Image">
                <p>
                 <small><?=ucwords($_SESSION['user_name'])?></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                </div>
                <div class="pull-right">
                  <a href="../config_file/logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- =============================================== -->
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../assert/dist/img/img.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=ucwords($_SESSION['user_name'])?></p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
         <?php  if(($form_types=='0') || ($form_types!='5') ){?>
        <li class="header"><?=ucwords('User')?> Menu</li>
        <li><a href="mt_hhi_get_hhi.php"><i class="fa fa-plus-square text-red"></i> <span>View Data Report</span></a></li>
        <?php }?>
         <?php  if($form_types==0 || $form_types==5 ){?>
        <li><a href="mt_training_info_training.php"><i class="fa fa-plus-square text-green"></i> <span> View Training Report</span></a></li>
        <li><a href="mt_shglist_info_shglist.php"><i class="fa fa-plus-square text-blue"></i> <span> View SHG Report</span></a></li>
        <?php }?>

        <li><a href="mt_NGTKO_instruction.php"><i class="fa fa-plus-square text-pink"></i> <span> Add NGTK Instruction</span></a></li>



        
   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
