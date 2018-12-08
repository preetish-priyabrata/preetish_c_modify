
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
       
        <li class="header"><?=ucwords('User')?> Menu</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Data Information</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="report_MEO_hhi_get_hhi.php"><i class="fa fa-plus-square text-red"></i> <span>View Data Report</span></a></li>
             <li><a href="report_MEO_training_info_training1.php"><i class="fa fa-circle-o"></i> Training Report View</a></li>
             <li><a href="report_MEO_shglist_info_shglist1.php"><i class="fa fa-circle-o"></i>SHG Report View</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Report Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <!-- <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li> -->
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Interventions # 1 :
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="report_int_1_comp_c.php"><i class="fa fa-circle-o"></i> Components C : </a></li>
                <li><a href="report_int_1_comp_d.php"><i class="fa fa-circle-o"></i> Components D : </a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Interventions # 2 :
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="report_int_2_comp_d.php"><i class="fa fa-circle-o"></i> Components D : </a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Interventions # 3 :
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="report_int_3_comp_b.php"><i class="fa fa-circle-o"></i> Components B : </a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Interventions # 4 :
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="report_int_4_comp_d.php"><i class="fa fa-circle-o"></i> Components D : </a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Interventions # 6 :
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="report_int_6_comp_d.php"><i class="fa fa-circle-o"></i> Components D : </a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Interventions # 7 :
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="report_int_7_comp_a.php"><i class="fa fa-circle-o"></i> Components A : </a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Interventions # 8 :
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="report_int_8_comp_a.php"><i class="fa fa-circle-o"></i> Components A : </a></li>
                <li><a href="report_int_8_comp_b.php"><i class="fa fa-circle-o"></i> Components B : </a></li>
                <li><a href="report_int_8_comp_c.php"><i class="fa fa-circle-o"></i> Components C : </a></li>

              </ul>
            </li>
  

        <li><a href="report_crp.php"><i class="fa fa-plus-square text-red"></i> <span>Basic Info</span></a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Raw Data Manage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu" style="display: none;">
           <li><a href="report_farmland_raw.php"><i class="fa fa-circle-o"></i> Crop Diversity  Raw  </a></li>
           <li><a href="report_kitichen_raw.php"><i class="fa fa-circle-o"></i> Kitchen Garden Raw  </a></li>
           <!--  <li><a href="report_kitchengarden_raw.PHP"><i class="fa fa-circle-o"></i> Kitchengarden Raw </a></li> -->
            <li><a href="report_post_harvest_loss_raw.php"><i class="fa fa-circle-o"></i> Post Harvest Loss Raw  </a></li>
            <li><a href="report_labor_saving_technology_raw.php"><i class="fa fa-circle-o"></i> Labor Saving Technology Raw  </a></li>
            <li><a href="report_animal_husbandry_raw.php"><i class="fa fa-circle-o"></i> Report Animal Husbandry Raw  </a></li>
            <li><a href="report_input_output_raw.php"><i class="fa fa-circle-o"></i> Input/Output Raw  </a></li>

            <li><a href="report_shg_raw.php"><i class="fa fa-circle-o"></i> Shg Raw </a></li>
            <li><a href="report_training_raw.php"><i class="fa fa-circle-o"></i> Training Raw </a></li>
            <li><a href="report_MT_NGTKO_instruction_raw.php"><i class="fa fa-circle-o"></i> NGTKO Instruction Raw </a></li>


            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>New Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="report_analysis1.php" title="Number of training conducted village wise in the reported month"><i class="fa fa-circle-o"></i> Report/Analysis 1</a></li>
            <li><a href="report_analysis2.php" title="Number of training conducted CRP wise in the reported month"><i class="fa fa-circle-o"></i> Report/Analysis 2</a></li>
             <li><a href="report_analysis3.php" title="Number of training conducted intervention wise by CRP wise in the reported month"><i class="fa fa-circle-o"></i> Report/Analysis 3</a></li>
            <li><a href="report_analysis4.php" title="Number of training conducted intervention wise by village wise in the reported month"><i class="fa fa-circle-o"></i> Report/Analysis 4</a></li>
            <li><a href="report_analysis5.php" title="Number of training conducted intervention wise by CRP by village wise in the reported month"><i class="fa fa-circle-o"></i> Report/Analysis 5</a></li>
            <li><a href="report_analysis6.php" title="Number of training conducted intervention wise by CRP by sessions in the reported month"><i class="fa fa-circle-o"></i> Report/Analysis 6</a></li>
            <li><a href="report_analysis7.php" title="Average duration of the sessions of the training in the reported month"><i class="fa fa-circle-o"></i> Report/Analysis 7</a></li>
            <li><a href="report_analysis8.php" title="Average number of participants (Total) in the training in the reported month"><i class="fa fa-circle-o"></i> Report/Analysis 8</a></li>
            <li><a href="report_analysis9.php" title="Average number of female participants (Total) in the training in the reported month"><i class="fa fa-circle-o"></i> Report/Analysis 9</a></li>
            <li><a href="report_analysis10.php" title="Male female ratio of the participants in the  training in the reported month"><i class="fa fa-circle-o"></i> Report/Analysis 10</a></li>
            <li><a href="report_analysis11.php" title="Number of the training conducted by the external resource person"><i class="fa fa-circle-o"></i> Report/Analysis 11</a></li>
            <li><a href="report_analysis12.php" title="Number of KG established  per village"><i class="fa fa-circle-o"></i> Report/Analysis 12</a></li>
            <li><a href="report_analysis13.php" title="Number of KG established per CRP"><i class="fa fa-circle-o"></i> Report/Analysis 13</a></li>
            <li><a href="report_analysis14.php" title="Number of new KG established per CRP"><i class="fa fa-circle-o"></i> Report/Analysis 14</a></li>
            <li><a href="report_analysis15.php" title="Average size of the KG"><i class="fa fa-circle-o"></i> Report/Analysis 15</a></li>
            <li><a href="report_analysis16.php" title="Average size of the Demo plot size"><i class="fa fa-circle-o"></i> Report/Analysis 16</a></li>
            <li><a href="report_analysis17.php" title="Average size of influenced farmer land size"><i class="fa fa-circle-o"></i> Report/Analysis 17</a></li>
            <li><a href="report_analysis18.php" title="Average production of vegetables per KG by CRP and village"><i class="fa fa-circle-o"></i> Report/Analysis 18</a></li>
            <li><a href="report_analysis19.php" title="Percentage of KG farmer received of total KG famer by CRP and village"><i class="fa fa-circle-o"></i> Report/Analysis 19</a></li>
            <li><a href="report_analysis20.php" title="Percentage of KG farmer received extension support by village"><i class="fa fa-circle-o"></i> Report/Analysis 20</a></li>
            <li><a href="report_analysis21.php" title="Average quantity of input received per KG"><i class="fa fa-circle-o"></i> Report/Analysis 21</a></li>
            <li><a href="report_analysis22.php" title="Average quantity of seed received as input  per demo farmer and influenced farmer"><i class="fa fa-circle-o"></i> Report/Analysis 22</a></li>
            <li><a href="report_analysis23.php" title="Average quantity of production of pulses in demo plot"><i class="fa fa-circle-o"></i> Report/Analysis 23</a></li>
            <li><a href="report_analysis24.php" title="Average quantity of production of pulses in non-demo plot"><i class="fa fa-circle-o"></i> Report/Analysis 24</a></li>
            <li><a href="report_analysis25.php" title="Number of goat received vaccination per village per crp"><i class="fa fa-circle-o"></i> Report/Analysis 25</a></li>
            <li><a href="report_analysis26.php" title="Number of cattle received vaccination per village per crp"><i class="fa fa-circle-o"></i> Report/Analysis 26</a></li>
            <li><a href="report_analysis27.php" title="Number of poultry received vaccination per village per crp"><i class="fa fa-circle-o"></i> Report/Analysis 27</a></li>


          


            
          </ul>
        </li>
        <li>  <a href="report_database.php">Get Backup Database</a></li>
        <li>  <a href="login_history_user.php">Get Login History</a></li>
        <!-- <li><a href="CBO_hhi_get_hhi.php"><i class="fa fa-plus-square text-red"></i> <span>View Data Report</span></a></li>
        <li><a href="CBO_training_info_training.php"><i class="fa fa-plus-square text-green"></i> <span> View Training Report</span></a></li>
        <li><a href="CBO_shglist_info_shglist.php"><i class="fa fa-plus-square text-blue"></i> <span> View SHG Report</span></a></li> -->
   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
