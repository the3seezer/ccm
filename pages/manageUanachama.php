<?php
$id = $_SESSION['userid'];
$sell = $db->selectUbungeUser($id);
$rw = $sell->fetch();
$idd = $rw['ubunge_id'];

if(empty($idd))
{
	    echo '<script language="javascript">';
        echo "alert('Tafadhali ingiza kwanza taarifa za Mgombea')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "?pg=pDetail"';
        echo '</script>';
}
  $getUanachama = $db->uanachama($idd);
  $rwa = $getUanachama->fetch();
  $zamakadi = $rwa['zamanikadi'];
  $mpyakadi = $rwa['mpyakadi'];
  $mkoaid = $rwa['mpyamkoa_id'];
  $wilayaid = $rwa['mpyawilaya_id'];
  $tawi = $rwa['mpyatawi'];
  $mpyatarehe = $rwa['mpyatarehe'];
  $mpyahadilini = $rwa['mpyahadilini'];
  
  //Get region name
	$getRegs = $db->getRegionName($mkoaid);
	$rwC = $getRegs->fetch();
	$gname = $rwC['RegName'];

	//Get wilaya name
	$getDict = $db->gettDistrict($wilayaid);
	$rwD = $getDict->fetch();
	$dname = $rwD['DistrictName'];
	
  //`zamanikadi`, `zamakadimkoa_id`, `zamakadiwilaya_id`, `zamakaditawi`,`zamatarehe`,
	//  mpyakadi,`mpyamkoa_id`, `mpyawilaya_id`,mpyatawi,`mpyatarehe`, `mpyahadilini`, 
	//`jumuiyakadi`, `jumuiyamkoa_id`, `jumuiyawilaya_id`, `jumuiatarehe`,`jumuiyahadilini`,  
	//`tawijina`,`tawimwkjina`, `chamakingine`, `chamamaelezo`, 
  
  
?>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Uanachama, Uadilifu wa Mgombea</h2>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                
                <!-- /.panel-heading -->
                <div class="panel-body">
				<div class="row">
				                        <span style="float:right;">
							        <a href="?pg=bChama&id=<?php echo $idd; ?>"><button class="btn btn-success btn-outline1" >
                                        <i class="fa fa-plus-square fa-fw"></i>Ongeza Uanachama</button></a>
                                       </p>
							        </span>
									</div>
                    <div class="dataTable_wrapper">

                        

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    
                                    
									
									<th>Kadi ya Zamani</th>
                                    <th>Kadi Mpya</th>
                                    <th>Mkoa </th>
                                    <th>Wilaya </th>
								    <th>Tawi</th>
                                    <th>Tarehe</th>
									<th>Imelipiwa hadi Lini</th>
									<th>Badili</th>
									<th>Angalia</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                               
                                    <tr class="odd gradeX">
                                        
                                        
                                       
                                        <td><?php echo $zamakadi; ?></td>
										<td><?php echo $mpyakadi; ?></td>
                                        <td><?php echo $gname; ?></td>
                                        <td><?php echo $dname; ?></td>
                                        <td><?php echo $tawi; ?></td>
									    <td><?php echo $mpyatarehe; ?></td> 
										<td><?php echo $mpyahadilini; ?></td>
                                        <td align="left"><a href="?pg=bUanaEdit&id=<?php echo $idd; ?>"><button class="btn btn-danger btn-outline"><i class="fa fa-edit fa fw"></i> Edit</button></a></td>
                                       <td align="left"><a href="pages/manageProfileUchama.php?id=<?php echo $idd; ?>" target="_blank"><button class="btn btn-info btn-outline"><i class="fa fa-list fa fw"></i> View</button></a></td>
                                       
                                    </tr>
                                
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
<div id="viewChoices" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Choices</h4>
            </div>
            <div class="modal-body">

                <div id="viewChoices-content"></div>

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