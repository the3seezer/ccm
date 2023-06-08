<?php
session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();
$id = $_POST['id'];
$idd = explode("_",$id);
$idds1 = $idd[0];
$idds2 = $idd[1];

?>
<div class="row">
    
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-danger">
                <div class="panel-heading"><strong>Kura Kwa Ujumla</strong></div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>   <?php if($idds1=="kata")
							        {
                                    echo '<th>Kata</th>';
									}
									else
									{
										echo '<th>Jimbo</th>';
									} ?>
                                    <th>Wilaya</th>
                                    <th>Mkoa</th>
                                    <th>Idadi ya Kura</th>
                                    <th>Kura Zilizoharibika</th>
                                    <th>Kura Halali</th>
									
                            </tr>
                            </thead>
                            <tbody>
                             <?php
                            $i = 1;
							if($idds1=="kata")
							{	
							
							$getJimb = $db->select_KATABYID($idds2);
                   
							while ($rwk = $getJimb->fetch()) {
								    $mkoa_id = $rwk['Region_Id'];
							        //Get region name
                                    $getRegs = $db->getRegionName($mkoa_id);
                                    $rwC = $getRegs->fetch();
                                    $gname = $rwC['RegName'];
									 $wilaya_id = $rwk['District_Id'];
									//Get wilaya name
                                    $getDict = $db->gettDistrict($wilaya_id);
                                    $rwD = $getDict->fetch();
                                    $dname = $rwD['DistrictName'];
									
									$sell = $db->selectKuraJumla($rwk['Kata_Id']);
                                    $roww = $sell->fetch();
									?>
									<tr class="odd gradeX">
                                  
                                    <td><?php echo strtoupper($rwk['KataName']); ?></td>
									<td><?php echo strtoupper($dname); ?></td>
                                    <td><?php echo strtoupper($gname); ?></td>
									<td><?php echo strtoupper($roww['idadi']); ?></td>
									<td><?php echo strtoupper($roww['zilizoharibika']); ?></td>
									<td><?php echo strtoupper($roww['halali']); ?></td>
                                    
                               
                              
                            </tr>
							<?php }}else{ 
							
                            $sel = $db->select_JI_DI_REEJ($id);
                            while ($row = $sel->fetch()) {
								
								$sell = $db->selectKuraJumla($row['Jimbo_Id']);
                                $roww = $sell->fetch();
                                ?>
                                <tr class="odd gradeX">
                                  
                                    <td><?php echo strtoupper($row['JimboName']); ?></td>
									<td><?php echo strtoupper($row['DistrictName']); ?></td>
                                    <td><?php echo strtoupper($row['RegName']); ?></td>
									<td><?php echo strtoupper($roww['idadi']); ?></td>
									<td><?php echo strtoupper($roww['zilizoharibika']); ?></td>
									<td><?php echo strtoupper($roww['halali']); ?></td>
                                    
                               
                              
                            </tr>
							<?php } }?>
                            </tbody>
                        </table>
						</div>
						</div>
					
				
                </div>
                