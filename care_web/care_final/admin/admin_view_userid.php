<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Admin View Block Location List";
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View List Of User 
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User Information</a></li>
         <li><a href="#">User Info</a></li>
        <li class="active"> View List Of User </li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="text-center">
          <?php $msg->display(); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="box box-primary">
            <div class="box-header with-border">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-users"></i>

              <h3 class="box-title">List Of User</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="admin_new_userid.php" class="btn btn-info btn-sm" ><i class="fa fa-plus-square"></i> Add New User
                 </a>
              </div>
              <!-- /. tools -->
            </div>
          </div>
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div> -->

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
               <div class="table-responsive">
                <table id="example77" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Slno</th>
                            <th>User Name</th>
                            <th>user id</th>
                            <th>Role</th>
                            <th>Access Form</th>
                          
                            <th>Status</th>    
                             <th>Location</th>                       
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Slno</th>
                            <th>User Name</th>
                            <th>user id</th>
                            <th>Role</th>
                            <th>Access Form</th>
                           
                            <th>Status</th> 
                             <th>Location</th>
                        </tr>
                    </tfoot>
                   <tbody>
                      <?php
                        $x=0;
                        // `cama_slno`, `cama_username`, `cama_email`, `cama_password`, `cama_pass_id`, `cama_status`, `cama_role`, `form_type`, `location_user`, `cama_date`, `cama_time`
                        $query_list="SELECT * FROM `care_master_admin_info` WHERE `location_user`!='1' and `cama_status`='1' ";
                        $sql_exe=mysqli_query($conn,$query_list);
                        while ($result=mysqli_fetch_assoc($sql_exe)) {
                          $x++;
                          ?>
                        <tr>
                          <td><?=$x?></td>
                          <td><?=strtoupper($result['cama_username'])?></td>
                          <td><?=($result['cama_email'])?></td>
                         
                           <td><?php 

                                  $level=($result['cama_role']);
                                  switch ($level) {
                                    // case '1':
                                    //    echo 'CRP(Community Resource Person)';
                                    //    break;
                                    case '2':
                                       echo 'MT(Master Trainer)';
                                       $form_type=$result['form_type'];
                                        
                                        switch ($form_type) {
                                          case '1':
                                            $access_form="All Form";
                                          break;
                                          case '2':
                                            $access_form="Kitchen Garden Form";
                                          break;
                                          case '3':
                                            $access_form="Animal Husbandary Form";
                                          break;
                                          case '4':
                                            $access_form="Labour Saving Technologies Form";
                                          break;
                                          case '5':
                                            $access_form="Training & SHG Form";
                                          break;
                                          case '6':
                                            $access_form="Crop Diversification";
                                          break;
                                          
                                          default:
                                            $access_form= "Not applicable";
                                            break;
                                        }
                                        $location_user=strtoupper($result['location_user']);

                                       break;
                                    case '3':
                                        echo 'CBO(Capacity Building Officer)';
                                         $access_form="All Form";
                                       $location_user=strtoupper($result['location_user']);
                                       break;
                                    case '4':
                                        echo 'MEO(Monitoring and Evaluation Officer)';
                                         $access_form="All Form";
                                        $location_user=strtoupper($result['location_user']);
                                       break;
                                    case '5':
                                       echo 'Report User';
                                        $access_form="All Form";
                                        $location_user=strtoupper('kalahandi <br> kandhamal');
                                       break;
                                    case '6':
                                        echo 'KMLE(Domain Expert)';
                                       break;
                                    case '7':
                                        echo 'DD(Deputy Director)';
                                       break;                                    
                                     
                                     default:
                                        echo 'N/A';
                                       break;
                                  }

                           ?></td>
                           <td><?=strtoupper($access_form)?></td>

                          <td><?php $status=$result['cama_status'];
                           if($status=='1'){
                           ?>
                           Active
                            
                               <?php
                                }else if($status=="2"){
                                ?>
                                
                                  In-Active
                                 
                                <?php
                              }

                          ?></td>
                           <td><?=strtoupper($location_user)?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
              </div>
            </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <a href="index.php" class="btn btn-primary btn-xs"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> BACK</a>
              </div>
            </form>
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
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example77 tfoot th').not(":eq(0),:eq(5)").each( function () {
        var title = $('#example77 thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example77').DataTable();
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        if (colIdx == 0 || colIdx == 5 ) return;
        
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
} );
  $(document).on("keypress", "form", function(event) { 
    return event.keyCode != 13;
});
</script>
