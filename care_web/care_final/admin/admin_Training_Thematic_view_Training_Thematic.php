<?php
session_start();
ob_start();
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Admin View Groups List";
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View List Of Trainings
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">General Setting</a></li>
        <li class="active"> View List Of Trainings Thematic</li>
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
                <i class="fa fa-map-marker"></i>
                <h3 class="box-title">List Of Trainings Thematic</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                <a href="admin_Training_Thematic_new_Training_Thematic.php" class="btn btn-info btn-sm" ><i class="fa fa-plus-square"></i> Add New Training Thematic
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
                <table id="example77" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Slno</th>
                            <th>Training Name</th>
                            <th>Thematic Name</th>                           
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Slno</th>
                            <th>Training Name</th>
                            <th>Thematic Name</th>                            
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                      <?php
                        $x=0;
                        $query_list="SELECT * FROM `care_master_training_theme_info` ";
                        $sql_exe=mysqli_query($conn,$query_list);
                        while ($result=mysqli_fetch_assoc($sql_exe)) {
                          $x++;
                          ?>
                        <tr>
                          <td><?=$x?></td>
                          <td><?=strtoupper($result['care_training_name'])?></td>
                          <td><?php $heme=($result['care_training_thematic']);
                                $get_traget="SELECT * FROM `care_master_thematic_interventions_info` WHERE `care_thi_slno`='$heme'";
                                $sql_exe_traget=mysqli_query($conn,$get_traget);
                                $traget_fetch=mysqli_fetch_assoc($sql_exe_traget);
                                  echo $traget_fetch['care_thi_thematic_name'];
                                  
                          ?></td>
                          <!-- care_training_thematic -->
                          <td><?php $status=$result['care_training_status'];
                          if($status=='1'){
                          ?>
                          <a href="admin_status_general_setting.php?access=<?=web_encryptIt('trainingt_status')?>&slno=<?=web_encryptIt($result['care_train_slno'])?>&status=<?=web_encryptIt($result['care_training_status'])?>" class="btn btn-success btn-xs">Active</a>
                          <?php
                           }else if($status=="2"){
                          ?>
                          <a href="admin_status_general_setting.php?access=<?=web_encryptIt('trainingt_status')?>&slno=<?=web_encryptIt($result['care_train_slno'])?>&status=<?=web_encryptIt($result['care_training_status'])?>" class="btn btn-danger btn-xs">In-Active</a>
                          <?php
                           }

                          ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
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
    $('#example77 tfoot th').not(":eq(0),:eq(4),:eq(3)").each( function () {
        var title = $('#example77 thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example77').DataTable();
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        if (colIdx == 0 || colIdx == 4 ) return;
        
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
