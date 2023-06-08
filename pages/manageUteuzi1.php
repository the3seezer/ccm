<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Wagombea</h2>
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
                                    <th>Nafasi Anayogombea</th>
									<?php if($_POST['ngazi']=="Udiwani")
                                          {     
									       echo '<th>Kata</th>'; 
									      }
									      else
										  {
										   echo '<th>Jimbo</th>';	
										  }
								     ?>
                                    <th>Wilaya</th>
                                    <th>Mkoa</th>
                                    <th>Kura Zote</th>
									 <th>Kura Alizopata</th>
                                    <th>Nafasi</th>
									<th>Ongeza Uteuzi</th>
									
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
								
                                $ngazi = $_POST['ngazi'];
								if(($ngazi=="Udiwani")and ($_SESSION['ngazi']=="Kata"))
								{
								$wilaya = $_POST['kata'];
								$sel = $db->singleUdiwani($wilaya);
								}else {
								$wilaya = $_POST['wilaya'];
								$sel = $db->singleUbungeWilayaOnly($wilaya);
								}
                                
                                while ($rw = $sel->fetch()) {
//`jinamwanzo`, `jinakati`, `jinamwisho`, `nafasi`, `gjimbo_id`, `gwilaya_id`,
	  // `gmkoa_id`, `dob`
                                    $kwanza = $rw['jinamwanzo'];
                                    $kati = $rw['jinakati'];
                                    $mwisho = $rw['jinamwisho'];
                                    $naf = $rw['nafasi'];
                                    $jimbo_id = $rw['gjimbo_id'];
                                    $wilaya_id = $rw['gwilaya_id'];
                                    $mkoa_id = $rw['gmkoa_id'];
                                    $dob = $rw['dob'];
									$iddd = $rw['ubunge_id'];
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
									if($nafasi=="Udiwani")
								    {
								
									$getJimb = $db->select_KATABYID($jimbo_id);
                                    $rwJ = $getJimb->fetch();
                                    $jname = $rwJ['KataName'];
									}else {
                                    $getJimb = $db->select_JI($jimbo_id);
                                    $rwJ = $getJimb->fetch();
                                    $jname = $rwJ['JimboName'];
									}
                                    $getkuraa = $db->selectKuraMgombea($iddd);
                                    $rwr = $getkuraa->fetch();
                                    $kura = $rwr['kura'];
									$nafasi = $rwr['nafasi'];
                                    //$fName=$facName."<br/>(".$cadName.")";
									
									
									$getkurajumla = $db->selectKuraJumla($jimbo_id);
                                    $rwrj = $getkurajumla->fetch();
                                    $idadi = $rwrj['idadi'];
									$zilizoharibika = $rwrj['zilizoharibika'];
									$halali = $rwrj['halali'];

                                    //$fName=$facName."<br/>(".$cadName.")";
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $kwanza." " .$kati." ".$mwisho ; ?></td>
                                        
                                        <td><?php echo $naf; ?></td>
                                        <td><?php echo $jname; ?></td>
                                        <td><?php echo $dname; ?></td>
                                        <td><?php echo $gname; ?></td>
										<td><?php echo $idadi; ?></td>
                                        <td><?php echo $kura; ?></td>
										<td><?php echo $nafasi; ?></td>
									<td align="left"><a href="?pg=bMgUteuzi&id=<?php echo $rw['ubunge_id']; ?>"><button class="btn btn-danger"><i class="fa fa-plus-square"></i>Ongeza</button></a></td>
                                       
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

<!--DEFINING MODALS--->
<!--Module to Allocate-->
<div id="Profiles" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Profile</h4>
            </div>
            <div class="modal-body">
                <div id="addprofiles-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="Profiles10" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Maoni na Mapendekezo</h4>
            </div>
            <div class="modal-body">
                <div id="addprofiles10-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!--Module to View Choices-->
<div id="roff" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Ongeza Maoni</h4>
            </div>
            <div class="modal-body">

                <div id="prof-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--Module to Change Facility -->
<div id="changeFacility" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Facility</h4>
            </div>
            <div class="modal-body">

                <div id="changeFacility-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>