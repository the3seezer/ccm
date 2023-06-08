<?php session_start();
    //Connect to database
    include("../lib/dbconnect.php");
    $db = new dbClass();
    $db->connect();
?>
<html>
<head>
<title>Wagombea
</title>
<!-- Morris Charts CSS -->
    <script src="../js/jquery.min.js"></script>
	<script src="../js/plugins/sortable.js"></script>
	<!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <link href="css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!--For upload image to a modal-->
        <link href="../css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <link href="../themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css" />

        <script src="../js/sweetalert.min.js"></script>
		 <script src="../js/validator/validator.js"></script>

        <link href="../select2/select2.min.css" rel="stylesheet" />
		</head>
		<body>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">

                       

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Jina la Mgombea</th>
                                    
                                    <th>Umri</th>
                                    <th>Nafasi Anayogombea</th>
                                    <th>Jimbo</th>
                                    <th>Wilaya</th>
                                    <th>Mkoa</th>
                                    <th>Ongeza Alizopata</th>
									
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $id = $_POST['wilaya'];
                                $sel = $db->singleUbunge($id);
                                while ($rw = $sel->fetch()) {
//`jinamwanzo`, `jinakati`, `jinamwisho`, `nafasi`, `gjimbo_id`, `gwilaya_id`,
	  // `gmkoa_id`, `dob`
                                    $kwanza = $rw['jinamwanzo'];
                                    $kati = $rw['jinakati'];
                                    $mwisho = $rw['jinamwisho'];
                                    $nafasi = $rw['nafasi'];
                                    $jimbo_id = $rw['gjimbo_id'];
                                    $wilaya_id = $rw['gwilaya_id'];
                                    $mkoa_id = $rw['gmkoa_id'];
                                    $dob = $rw['dob'];

                                    $miaka = explode("-",$dob);
                                    $year=$miaka[0];
                                    $currentAge=date('Y')-$year;
                                    
									//Get region name
                                    $getRegs = $db->getRegionName($mkoa_id);
                                    $rwC = $getRegs->fetch();
                                    $gname = $rwC['RegName'];
									
									//Get wilaya name
                                    $getDict = $db->gettDistrict($wilaya_id);
                                    $rwD = $getDict->fetch();
                                    $dname = $rwD['DistrictName'];

                                    //Get jimbo name 
                                    $getJimb = $db->select_JI($jimbo_id);
                                    $rwJ = $getJimb->fetch();
                                    $jname = $rwJ['JimboName'];
                                    

                                    //$fName=$facName."<br/>(".$cadName.")";
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $kwanza." " .$kati." ".$mwisho ; ?></td>
                                        <td><?php echo $currentAge; ?></td>
                                        <td><?php echo $nafasi; ?></td>
                                        <td><?php echo $jname; ?></td>
                                        <td><?php echo $dname; ?></td>
                                        <td><?php echo $gname; ?></td>
                                        <td align="left"><a href="?pg=profile&id=<?php echo $rw['ubunge_id']; ?>"><button class="btn btn-danger"><i class="fa fa-plus-square"></i>Ongeza</button></a></td>
                                        
                                    

                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>

<!--DEFINING MODALS--->

<!--Module to View Choices-->
<div id="mgombeakura" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Kura Alizopata</h4>
            </div>
            <div class="modal-body">

                <div id="mgoeakura-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--Module to Add New -->
<div id="addkura" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Angalia Kura:</h4>
            </div>
            <div class="modal-body">

                <div id="addkura-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>