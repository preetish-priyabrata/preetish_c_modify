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
                <a href="admin_userid_new_userid.php" class="btn btn-info btn-sm" ><i class="fa fa-plus-square"></i> Add New User
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
                            <th>Designation</th>
                            <th>Status</th>                           
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Slno</th>
                            <th>User Name</th>
                            <th>user id</th>
                            <th>Role</th>
                            <th>Designation</th>
                            <th>Status</th> 
                        </tr>
                    </tfoot>
                   <tbody>
                      <?php
                        $x=0;
                        $query_list="SELECT * FROM `care_master_system_user` ";
                        $sql_exe=mysqli_query($conn,$query_list);
                        while ($result=mysqli_fetch_assoc($sql_exe)) {
                          $x++;
                          ?>
                        <tr>
                          <td><?=$x?></td>
                          <td><?=strtoupper($result['user_name'])?></td>
                          <td><?=($result['employee_id'])?></td>
                          <!-- <option value="1">CRP(Community Resource Person)</option>
                        <option value="2">MT(Master Trainer)</option>
                        <option value="3">CBO(Capacity Building Officer)</option>
                        <option value="4">MEO(Monitoring and Evaluation Officer)</option>
                        <option value="5">DA(Data Analyst)</option>
                        <option value="6">KMLE(Domain Expert)</option>
                        <option value="7">DD(Deputy Director)</option> -->
                           <td><?php 

                                  $level=($result['level']);
                                  switch ($level) {
                                    case '1':
                                       echo 'CRP(Community Resource Person)';
                                       break;
                                    case '2':
                                       echo 'MT(Master Trainer)';
                                       break;
                                    case '3':
                                        echo 'CBO(Capacity Building Officer)';
                                       break;
                                    case '4':
                                        echo 'MEO(Monitoring and Evaluation Officer)';
                                       break;
                                    case '5':
                                       echo 'DA(Data Analyst)';
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
                           <td><?=strtoupper($result['designation'])?></td>
                          <td><?php $status=$result['status'];
                           if($status=='1'){
                           ?><a href="admin_status_location.php?access=<?=web_encryptIt('userId_status')?>&slno=<?=web_encryptIt($result['sl_no'])?>&status=<?=web_encryptIt($result['status'])?>" class="btn btn-success btn-xs">Active</a>
                            
                               <?php
                                }else if($status=="2"){
                                ?>
                                  <a href="admin_status_location.php?access=<?=web_encryptIt('userId_status')?>&slno=<?=web_encryptIt($result['sl_no'])?>&status=<?=web_encryptIt($result['status'])?>" class="btn btn-danger btn-xs">In-Active</a>
                                 
                                <?php
                              }

                          ?></td>
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
