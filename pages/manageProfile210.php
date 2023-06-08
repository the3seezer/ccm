<?php
session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();
$id = $_POST['id'];
?>
<div class="row">
    
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-danger">
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
                                
                                $sel = $db->selectSingleUbunge($id);
                                $rw = $sel->fetch();
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
					
				
                </div>
                <!-- /.panel-body -->
           <div class="panel panel-danger">
                <div class="panel-heading"><strong>MAONI NA MAPENDEKEZO</strong></div>
                <!-- /.panel-heading -->
                <div class="panel-body">
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>
							 
                                    <th>Aina ya Vikao</th>
									<th>Amekubarika</th>
                                    <th>Maelezo ya Maoni</th>
									<th>Jina la Katibu</th>
									<th>Ngazi ya Katibu</th>
									<th>Tarehe ya Kikao</th>
                                    
                            </tr>
                            </thead>
                            <tbody>
							<tr class="odd gradeX">
                                
                                <td><?php 
//`ainavikao`, `amekubalika`, `maelezoyamaoni`, `jinalakatibu`, `ngaziyakatibu`, `tareheyakikao`, 
	//`ubunge_id`
                                    $getMaoni = $db->selectMaoni($id);
                                    $rwM = $getMaoni->fetch();
                                    $aina = $rwM['ainavikao'];
									
                                    
                                    $status = $rwM['amekubalika'];
                                    $maelezo = $rwM['maelezoyamaoni'];
									$jina = $rwM['jinalakatibu'];
									$ngazi = $rwM['ngaziyakatibu'];
									$tarehe = $rwM['tareheyakikao'];
									if($aina=="I"){
										$maoni="Kikao cha Awali (Kabla ya Kura za Maoni)";
									}elseif($aina=="II")
									{
										$maoni="Kikao cha Pili (Kabla ya Kura za Maoni)";
									}elseif($aina=="III")
									{
										$maoni="Kikao cha Tatu (Kabla ya Kura za Maoni)";
									}
									elseif($aina=="IV")
									{
										$maoni="Kamati Maalumu ya Halmashauri Kuu ya CCM ya Taifa Zanzibar";
									}
									elseif($aina=="V")
									{
										$maoni="Kikao cha Uteuzi wa Awali";
									}
								echo $maoni; ?></td>
                                <td><?php echo $status; ?></td>
                                <td><?php echo $maelezo; ?></td>
								
                                <td><?php //Get wilaya name
                                    
									echo $jina; ?></td>
                                
                                <td><?php echo $ngazi ; ?></td>
                                <td><?php echo $tarehe ?></td>
                                
                               
                            </tr>
                            </tbody>
                        </table> 
						</div>
						</div>

           
