<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

//$userID=$_POST['userID'];

$selectreg=$db->getAllRegionName();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
     

            <div class="card card-warning card-outline">
              <div class="card-header">
			   <div class="row"> 
			   <div class="col-10">
			   </div>
			   
			    <div class="pull-right col-2">
			  <button class="btn btn-success" data-toggle="modal" data-target="#addMTAA"
                                            data-id="" id="getaddMTAA"><i
                                                class="fa fa-plus-square"></i>Ongeza</button>             			       
			     </div> 
			    </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
			  
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                            <tr>
                                <th>SN</th>
								<th>Mkakati</th>
								<th>Kilicho fanyika</th>
								<th>Mafanikio</th>
                                <th>Hali</th>
                                <th>tarehe</th>
                                <th>Badili</th>
                                <th>Futa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
							//mikailani_id, `shughuli`, `tarehe`, `kiasimafanikio`, `haliutekelezaji`, `utekeilani_id` 
                            $sel = $db->selectUtekeahadi();
                            while ($row = $sel->fetch()) {
                                
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
									<td><?php echo strtoupper($row['mikaahadi_id']); ?></td>
									<td><?php echo strtoupper($row['shughuli']); ?></td>
									<td><?php echo strtoupper($row['kiasimafanikio']); ?></td>
                                    
                                    <td><?php echo strtoupper($row['haliutekelezaji']); ?></td>
                                    <td><?php echo strtoupper($row['tarehe']); ?></td>
									<td align="left">
                                        <a href="#editMTAA" class="btn btn-primary btn-xs" data-toggle="modal"
                                           data-id="<?php echo $row['utekeahadi_id']; ?>"
                                           id="geteditMTAA"><i class="fa fa-edit"></i>Edit</a>
                                    </td>

                                    <td align="left"><a href="#deleteMTAA" class="btn  btn-danger btn-xs"
                                                        data-toggle="modal" data-id="<?php echo $row['utekeahadi_id']; ?>"
                                                        id="getdeleteMTAA"><i class="fa fa-trash"></i>Delete</a>
                                    </td>

                                </tr>
                                <?php $i++;
                            } ?>
                            </tbody>
                          </table>
				
				
				
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
 
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  
  $(function () {
  //$.validator.setDefaults({
    //submitHandler: function () {
     // alert( "Form successful submitted!" );
    //}
  //});
  $('#quickForm').validate({
    rules: {
      email: {
        required: true
       
      },
      password: {
        required: true
        
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address"
      },
      password: {
        required: "Please provide a password"
        
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});

/////////////////////////////////////
            ////////////MANAGE MTAA////////////
            ///////////////////////////////////

            //<!-----Add New MTAA----->
            $(document).ready(function() {

                $(document).on('click', '#getaddMTAA', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addMTAA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: '../includes/addMTAA.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addMTAA-content').html(''); // blank before load.
                            $('#addMTAA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addMTAA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            // <!-----Edit MTAA----->
            $(document).ready(function() {

                $(document).on('click', '#geteditMTAA', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#editMTAA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editMTAA.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editMTAA-content').html(''); // blank before load.
                            $('#editMTAA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editMTAA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            // <!-----Delete MTAA----->
            $(document).ready(function() {

                $(document).on('click', '#getdeleteMTAA', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#deleteMTAA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteMTAA.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteMTAA-content').html(''); // blank before load.
                            $('#deleteMTAA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deletMTAA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
			
			
</script>

 <!--DEFINING MODALS--->
<!--Module to Add New -->
<div id="addMTAA" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Ongeza Mtaa/Kijiji:</h4>
            </div>
            <div class="modal-body">

                <div id="addMTAA-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Edit -->
<div id="editMTAA" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Badili Mtaa</h4>
            </div>
            <div class="modal-body">

                <div id="editMTAA-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Delete -->
<div id="deleteMTAA" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Futa Mtaa:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteMTAA-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


</body>
</html>
