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
              <!-- 160X160  -->
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
        <li class="header"><?=ucwords('Admin')?> Menu</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-map"></i> <span>Location Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> District Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_district_view_district.php"><i class="fa fa-circle-o"></i>Add & View District</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Block Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_block_view_block.php"><i class="fa fa-circle-o"></i>Add & View Block</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> GP Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_gp_view_gp.php"><i class="fa fa-circle-o"></i>Add & View GP</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Village Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_village_view_village.php"><i class="fa fa-circle-o"></i>Add & View Village</a></li>
              </ul>
            </li>

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>General Setting </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Thematic Interventions Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_thematic_view_thematic.php"><i class="fa fa-circle-o"></i>Add & View Thematic List</a></li>
              </ul>
            </li>
             <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Group Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_group_view_group.php"><i class="fa fa-circle-o"></i>Add & View Group List</a></li>
              </ul>
            </li>

             <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Training Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_training_view_training.php"><i class="fa fa-circle-o"></i>Add & View Training List</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Technical Support Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_ts_view_ts.php"><i class="fa fa-circle-o"></i>Add & View Technical List</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Committee Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_committee_view_committee.php"><i class="fa fa-circle-o"></i>Add & View Committee</a></li>
              </ul>
            </li>
             <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Training-Thematic list
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_Training_Thematic_view_Training_Thematic.php"><i class="fa fa-circle-o"></i>Add & View Training-Thematic</a></li>
              </ul>
            </li>

          </ul>
        </li>
       <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>User Management </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> User Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_userid_view_userid.php"><i class="fa fa-circle-o"></i>Add & View User List</a></li>
                <li><a href="admin_view_userid.php"><i class="fa fa-circle-o"></i>Add & View Admin List</a></li>
              </ul>
            </li>
             <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Assign User Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
               <ul class="treeview-menu">
                <li><a href="admin_userid_assign_view_userid_assign.php"><i class="fa fa-circle-o"></i>Add & View User List</a></li>               
              </ul>
            </li>
            <!-- <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Assign User Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
               <ul class="treeview-menu">
                <li><a href="admin_userid_assign_view_userid_assign.php"><i class="fa fa-circle-o"></i>Add & View User List</a></li>               
              </ul>
            </li> -->
<!-- 
             <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Training Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_training_view_training.php"><i class="fa fa-circle-o"></i>Add & View Training List</a></li>               
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Technical Support Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_ts_view_ts.php"><i class="fa fa-circle-o"></i>Add & View Technical List</a></li>               
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Committee Info
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_committee_view_committee.php"><i class="fa fa-circle-o"></i>Add & View Committee</a></li>               
              </ul>
            </li> -->
            
            
          </ul>
        </li>

        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Location Info</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
           
          </a>
          <ul class="treeview-menu">
            <li><a href="admin_view_district.php"><i class="fa fa-circle-o"></i>Add & View District</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Menu1-2</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Menu2</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
           
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Menu2-1</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Menu2-2</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Menu3</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
           
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Menu3-1</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Menu3-2</a></li>
          </ul>
        </li> -->
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>NGTK Management </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Name of the NGTK 
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_ngtk_view_ngtk.php"><i class="fa fa-circle-o"></i>Add & View NGTK List</a></li>               
              </ul>
            </li>
          </ul>
        </li>
       <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Farmer Management </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Farmer Field School Group 
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin_field_group_view_field_group.php"><i class="fa fa-circle-o"></i>Add & View Field List</a></li>               
              </ul>
            </li>
          </ul>
        </li>
     

     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
