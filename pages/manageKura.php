<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Wagombea</h1>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Orodha ya Wagombea
                </div>
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
                                        <td align="left"><a href="?pg=bKura&id=<?php echo $rw['ubunge_id']; ?>"><button class="btn btn-danger"><i class="fa fa-plus-square"></i>Ongeza</button></a></td>
                                        
                                    

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
