<?php
session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();
$id = $_POST['id'];
?>
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
                             
                                    <th>Jimbo</th>
                                    
									<th>Idadi ya Kura</th>
                                    <th>Zilizoharibika</th>
									<th>Halali</th>
                                    <th>Kura Alizopata</th>
									<th>Nafasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $id = $_POST['id'];
                                $sel = $db->selectSingleUbunge($id);
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
                                    
									$getkuraa = $db->selectKuraMgombea($id);
                                    $rwr = $getkuraa->fetch();
                                    $kura = $rwr['kura'];
									$nafasi = $rwr['nafasi'];
                                    //$fName=$facName."<br/>(".$cadName.")";
									
									
									$getkurajumla = $db->selectKuraJumla($jimbo_id);
                                    $rwrj = $getkurajumla->fetch();
                                    $idadi = $rwrj['idadi'];
									$zilizoharibika = $rwrj['zilizoharibika'];
									$halali = $rwrj['halali'];
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $kwanza." " .$kati." ".$mwisho ; ?></td>
                                        <td><?php echo $currentAge; ?></td>
                                        <td><?php echo $nafasi; ?></td>
                                        <td><?php echo $jname; ?></td>
                                        <td><?php echo $dname; ?></td>
										
                                        <td><?php echo $gname; ?></td>
										<td><?php echo $idadi; ?></td>
                                        <td><?php echo $zilizoharibika; ?></td>
                                        <td><?php echo $halali; ?></td>
                                        <td><?php echo $kura; ?></td>
                                        <td><?php echo $nafasi; ?></td>
                                    </tr>
                                <?php $i++;
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

