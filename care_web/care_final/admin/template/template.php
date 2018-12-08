<!DOCTYPE html>
<html style="font-size: 1.1em">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../assert/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assert/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../assert/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assert/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="../assert/plugins/morris/morris.css"> -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="../assert/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../assert/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../assert/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="../assert/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <!-- <script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script> -->
<!-- <link rel="stylesheet" href="../assert/plugins/datatables/dataTables.bootstrap.css"> -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script src="../assert/Chart1/dist/Chart.bundle.js"></script>
    <script src="../assert/Chart1/samples/utils.js"></script> -->
    <!-- <script src="../assert/js/fusioncharts.js"></script> -->
    <style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
  <!--   <script type="text/javascript" src="../assert/Chart/src/chart.js"></script>
    <script type="text/javascript" src="../assert/js/moment.js"></script> -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- sidebar-mini skin-purple -->
  <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet">
</head>
<body class="hold-transition skin-purple sidebar-mini" style="font-size: 1em">
<!-- Site wrapper -->
<div class="wrapper">
<?php
 // include 'side_menu.php';
 // include 'content.php';
 ?>
     <?php 
                    // if($_SESSION['admin_emails']){
                     
                        include 'side_menu.php';
                    // }else if($_SESSION['users_account']){
                    //      include 'user_menu.php';
                    // }else{
                    //     header('Location:logout.php');
                    //     exit;
                    // }
                ?>
                   
                        <?php echo "$contents"; ?>

 <footer class="main-footer">
    <div class="pull-right hidden-xs">
    
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?>   <a href="http://innovadorslab.co.in">Innovadors Lab Pvt Ltd </a>.</strong> All rights
    reserved.
</footer>
                        </div>

<!-- jQuery 2.2.3 -->
<script src="../assert/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="../assert/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../assert/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="../assert/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../assert/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assert/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../assert/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../assert/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../assert/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<!-- <script src="../assert/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
<!-- Slimscroll -->
<script src="../assert/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assert/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assert/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="../assert/dist/js/pages/dashboard.js"></script>
 --><!-- AdminLTE for demo purposes -->
<script src="../assert/dist/js/demo.js"></script>
<!-- DataTables -->
<!-- <script src="../assert/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assert/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

 -->
 <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
   <script src="//cdn.datatables.net/buttons/1.4.1/js/buttons.colVis.min.js"></script>
     <!-- <script src="../asserts/plugins/jquery/jquery.min.js"></script> -->
     <!-- 'copy', 'csv', 'excel', 'pdf', 'print' -->
     <!-- buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ], -->
        <!-- buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'    
        ] -->
     <script type="text/javascript">
      $(document).ready(function() {
        $('#example14').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'    
        ]
                          
        } );
    } );
    $(document).ready(function() {
      // Setup - add a text input to each footer cell
      $('#example1 tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      } );
   
      // DataTable
      var table = $('#example1').DataTable();
   
      // Apply the search
      table.columns().every( function () {
          var that = this;
   
          $( 'input', this.footer() ).on( 'keyup change', function () {
              if ( that.search() !== this.value ) {
                  that
                      .search( this.value )
                      .draw();
              }
          } );
      } );
      $("#example21").DataTable();
  } );
    
     </script>
     <script type="text/javascript">
      // here for submition is stop by enter value of keyboard
        $(document).on("keypress", "form", function(event) { 
          return event.keyCode != 13;
      });
        // here this restrict back button submition
        $(document).ready(function() {
        window.history.pushState(null, "", window.location.href);        
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };
    });
    </script> 
</body>
</html>