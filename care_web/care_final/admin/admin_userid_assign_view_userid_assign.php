<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Admin View Assign List Of User";
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Assign List Of User
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User Information</a></li>
         <li><a href="#">Assign User Info</a></li>
        <li class="active">  View Assign List Of User </li>
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

              <h3 class="box-title">Assign List Of User</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="admin_userid_assign_new_userid_assign.php" class="btn btn-info btn-sm" ><i class="fa fa-plus-square"></i> Assign New Users
                 </a>
              </div>
              <!-- /. tools admin_userid_assign_view_userid_assign-->
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
                            <th>Employee id</th>
                            <th>User Name</th>
                            <th>District Name</th>
                            <th>Block Name</th>
                            <th>GP Name</th>
                            <th>Village Name</th>
                            <th>Action</th>                           
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Slno</th>
                            <th>Employee id</th>
                            <th>User Name</th>
                            <th>District Name</th>
                            <th>Block Name</th>
                            <th>GP Name</th>
                            <th>Village Name</th>
                            <th>Action</th> 
                        </tr>
                    </tfoot>
                   <tbody>
                      <?php
                        $x=0;
                        $query_list="SELECT * FROM `care_master_assigned_user_info` where `status`='1' ";
                        $sql_exe=mysqli_query($conn,$query_list);
                        while ($result=mysqli_fetch_assoc($sql_exe)) {
                          $x++;
                          ?>
                        <tr>
                          <td><?=$x?></td>
                          <td><?=$care_assU_employee_id=($result['care_assU_employee_id'])?></td>
                          <td><?php
                                $get_user="SELECT * FROM `care_master_system_user` WHERE `employee_id`='$care_assU_employee_id'";
                                $sql_exe_user=mysqli_query($conn,$get_user);
                                $fetch=mysqli_fetch_assoc($sql_exe_user);
                                echo $fetch['user_name'];
                          ?></td>
                        
                           <td><?=strtoupper($result['care_assU_district_id'])?></td>
                           <td><?=strtoupper($result['care_assU_block_id'])?></td>
                           <td><?=strtoupper($result['care_assU_gp_id'])?></td>
                           <td><?=strtoupper($result['care_assU_village_id'])?></td>
                          <td><a href="get_delete_assign.php?token=<?=web_encryptIt($result['care_assU_slno'])?>" class="btn btn-xs btn-danger" onclick="return confirm(' you want to delete?');">Delete</a></td>
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
    $('#example77 tfoot th').not(":eq(0),:eq(7)").each( function () {
        var title = $('#example77 thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example77').DataTable();
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        if (colIdx == 0 || colIdx == 7) return;
        
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
