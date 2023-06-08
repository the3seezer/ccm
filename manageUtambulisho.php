<?php
 $id = $_SESSION['userid'];
 $sel = $db->selectUbungeUser($id);
 $numb = $sel->rowCount();
?>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Utambulisho wa Mgombea</h2>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <?php if($numb>0) { ?>
                        <span style="float:right;">
							        <a href="?pg=pDetail"><button class="btn btn-success btn-outline1" >
                                        <i class="fa fa-plus-square fa-fw"></i>Ongeza Utambulisho</button></a>
                                       </p>
							        </span>
					  <?php } ?>

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
                                    <th>Rekebisha</th>
									<th>Angalia Profile </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                
                                //$sel = $db->selectUbunge();
                                while ($rw = $sel->fetch()) {

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
                                        <td align="left"><a href="?pg=bUtambulishoEdit&id=<?php echo $rw['ubunge_id']; ?>"><button class="btn btn-danger btn-outline"><i class="fa fa-edit fa fw"></i>&nbsp;Edit</button></a></td>
                                        <td align="left"><span style="float:right;">
                        <button class="btn btn-primary btn-outline" data-toggle="modal" data-target="#viewUtambulisho" data-id="<?php echo $rw['ubunge_id']; ?>" id="getviewUtambulisho"><i class="fa fa-list fa fw"></i>&nbsp;View</button></p>
                    </span>
										  </td>
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


<!-- View utambulisho -->

<div class="col-lg-12">
   <div id="viewUtambulisho" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><strong>Utambulisho</strong></h4>
            </div>
            <div class="modal-body">

             

<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>UTAMBULISHO WA MGOMBEA</strong></div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>
                                    <th>Jina la Mgombea</th>
                                    <th>Umri</th>
                                    <th>Nafasi</th>
                                    <th>Jimbo Alikogombea</th>
                                    <th>Wilaya Alikogombea</th>
                                    <th>Mkoa Alikogombea</th>
									<th>Mtaa/Kijiji Alikozaliwa</th>
                                    <th>Wilaya Alikozaliwa</th>
									<th>Mkoa Alikozaliwa</th>
                            </tr>
                            </thead>
                            <tbody>
                             <?php
                                $i = 1;
                                //$sel
                                $id = $_SESSION['userid'];
                                $sell = $db->selectUbungeUser($id);
                                $rw = $sell->fetch();
                                //`jinamwanzo`, `jinakati`, `jinamwisho`, 
								//`nafasi`, `gjimbo_id`, `gwilaya_id`,
	                            //`gmkoa_id`, `dob`
                                    $kwanza = $rw['jinamwanzo'];
                                    $kati = $rw['jinakati'];
                                    $mwisho = $rw['jinamwisho'];
                                    $nafasi = $rw['nafasi'];
                                    $jimbo_id = $rw['gjimbo_id'];
                                    $wilaya_id = $rw['gwilaya_id'];
                                    $mkoa_id = $rw['gmkoa_id'];
                                    $dob = $rw['dob'];
									$jimbo_id = $rw['gjimbo_id'];
                                    $wilaya_id = $rw['gwilaya_id'];
                                    $mkoa_id = $rw['gmkoa_id'];

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
									
									//Get wilaya name
                                    $getDict1 = $db->gettDistrict($rw['zwilaya_id']);
                                    $rwD1 = $getDict1->fetch();
                                    $dname1 = $rwD1['DistrictName'];
									
                                    //Get region name
                                    $getRegs1 = $db->getRegionName($rw['zmkoa_id']);
                                    $rwC1 = $getRegs1->fetch();
                                    $gname1 = $rwC1['RegName'];
                                    $mtaa = $rw['zmtaa'];
									
      // SELECT `jinamwanzo`, `jinakati`, `jinamwisho`, `nafasi`, `gjimbo_id`, 
	  //`gwilaya_id`, `gmkoa_id`, `dob`, `zmkoa_id`, `zwilaya_id`, `zmtaa`, 
	  //`jinababa`, `babadob`, `bzmkoa_id`, `bzwilaya_id`, `bzmtaa`, `jinamama`, 
	  //`mzmkoa_id`, `mzwilaya_id`, `mzmtaa`, `mamadob`, `ishimkoa`, `ishiwilaya`, 
	  //`ishimtaa`, `uraia`, `ainayauraia`, `nambayahati`, `ubunge_id`  FROM `ubunge WHERE 1

                                    //$fName=$facName."<br/>(".$cadName.")";
                                ?>
								
                            <tr class="odd gradeX">
                                
                                <td><?php echo $kwanza." ".$kati." ".$mwisho; ?></td>
                                <td><?php echo $nafasi; ?></td>
                                <td><?php echo $currentAge; ?></td>
                                <td><?php echo $jname; ?></td>
                                <td><?php echo $dname; ?></td>
                                <td><?php echo $gname; ?></td>
								<td><?php echo $mtaa; ?></td>
                                <td><?php echo $dname1 ?></td>
                                <td><?php echo $gname1; ?></td>
                               
                              
                            </tr>
						
                            </tbody>
                        </table>
						</div>
						</div>
					
				<div class="panel panel-success">
                <div class="panel-heading">WAZAZI WA MGOMBEA</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>
							 
                                    <th>Jina la Baba</th>
									<th>Mtaa/Kijiji Alikozaliwa</th>
                                    <th>Wilaya Alikozaliwa</th>
									<th>Mkoa Alikozaliwa</th>
									<th>Jina la Mama</th>
									<th>Mtaa/Kijiji Alikozaliwa</th>
                                    <th>Wilaya Alikozaliwa</th>
									<th>Mkoa Alikozaliwa</th>
                            </tr>
                            </thead>
                            <tbody>
							<tr class="odd gradeX">
                                <td><?php echo $rw['jinababa']; ?></td>
                                <td><?php 
								  //Get wilaya name
                                    $getDict3 = $db->gettDistrict($rw['bzwilaya_id']);
                                    $rwD3 = $getDict3->fetch();
                                    $dname3 = $rwD3['DistrictName'];
									
                                    //Get region name
                                    $getRegs3 = $db->getRegionName($rw['bzmkoa_id']);
                                    $rwC3 = $getRegs3->fetch();
                                    $gname3 = $rwC3['RegName'];
                                    $bmtaa3 = $rw['bzmtaa'];
								echo $bmtaa3; ?></td>
                                <td><?php echo $dname3; ?></td>
                                <td><?php echo $gname3; ?></td>
								
                                <td><?php //Get wilaya name
                                    $getDict4= $db->gettDistrict($rw['mzwilaya_id']);
                                    $rwD4 = $getDict4->fetch();
                                    $dname4 = $rwD4['DistrictName'];
									
                                    //Get region name
                                    $getRegs4 = $db->getRegionName($rw['mzmkoa_id']);
                                    $rwC4 = $getRegs4->fetch();
                                    $gname4 = $rwC4['RegName'];
                                    $bmtaa4 = $rw['mzmtaa'];
									$mama = $rw['jinamama'];
									echo $mama; ?></td>
                                
                                <td><?php echo $bmtaa4 ; ?></td>
                                <td><?php echo $dname4 ?></td>
                                <td><?php echo $gname4; ?></td>
                               
                            </tr>
                            </tbody>
                        </table> 
						</div>
						</div>

<div class="panel panel-success">
                <div class="panel-heading">URAIA WA MGOMBEA</div>
                <!-- /.panel-heading -->
                <div class="panel-body">						
                             <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>
							 
                                    <th>Uraia </th>
									<th>Aina ya Uraia</th>
                                    <th>Hati ya Uraia</th>
									<th>Mtaa/Kijiji Unapoishi</th>
                                    <th>Wilaya Unapoishi</th>
									<th>Mkoa Unapoishi</th>
                            </tr>
                            </thead>
                            <tbody>
							<tr class="odd gradeX">
                                <td><?php  if($rw['uraia']=="1375")
								{
									echo "Tanzania";
								}else{
									echo "Nchi nyingine";
								}									?></td>
                                <td><?php 
								  //Get wilaya name
                                    $getDict5 = $db->gettDistrict($rw['ishiwilaya']);
                                    $rwD5 = $getDict5->fetch();
                                    $dname5 = $rwD5['DistrictName'];
									
                                    //Get region name
                                    $getRegs5 = $db->getRegionName($rw['ishimkoa']);
                                    $rwC5 = $getRegs5->fetch();
                                    $gname5 = $rwC5['RegName'];
                                    
								echo $rw['ainayauraia']; ?></td>
                                <td><?php echo $rw['nambayahati'];; ?></td>
                                <td><?php echo $rw['ishimtaa'];; ?></td>
								
                                <td><?php //Get wilaya name
                                    
                                    
									echo $dname5; ?></td>
                                <td><?php echo $gname5; ?></td>
                                
                               
                            </tr>
                            </tbody>
                        </table> 
						
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>


            <div class="panel panel-success">
                <div class="panel-heading">ELIMU YA MGOMBEA</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>
                                <th>Aina ya Elimu</th>
                                <th>Kiwango Cha Elimu</th>
                                <th>Shule/Secondari/Chuo</th>
                                <th>Mwaka wa Kuhitimu</th>
								<th>Maelezo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
							$getEli= $db->mgombeaElimu($id); 
							//SELECT `ainaelimu`, `kiwango`, `chuo`, `mwaka`, `maelezo`, `elimu_id`, 
							//`ubunge_id` FROM `ubunge_elimu` WHERE 1
                            $i = 1;
                            while ($rwe = $getEli->fetch()) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $rwe['ainaelimu']; ?></td>
                                    <td><?php echo $rwe['kiwango']; ?></td>
                                    <td><?php echo $rwe['chuo']; ?></td>
                                    <td><?php echo $rwe['mwaka']; ?></td>
									<td><?php echo $rwe['maelezo']; ?></td>
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

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--Edit Utambulisho-->
<div id="utabulishoEdit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Utambulisho</h4>
            </div>
            <div class="modal-body">
<!-- body start -->

<!-- body end -->
                

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