<?php
$id = $_GET['id'];
?>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Taarifa za Mgombea</h2>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">UTAMBULISHO WA MGOMBEA</div>
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
								
                                <td><?php 
								  //Get wilaya name
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

			<div class="panel panel-success">
                <div class="panel-heading">UANACHAMA</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>
                                <th>Kadi ya Zamani</th>
                                <th>Mkoa </th>
                                <th>Wilaya</th>
                                <th>Tawi</th>
								<th>Tarehe iliyotolewa</th>
								<th>Kadi Mpya</th>
                                <th>Mkoa </th>
                                <th>Wilaya</th>
                                <th>Tawi</th>
								<th>Tarehe iliyotolewa</th>
								<th>Imelipiwa hadi lini</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
							$getEli= $db->mgombeaUanachama($id); 
							//SELECT `ainaelimu`, `kiwango`, `chuo`, `mwaka`, `maelezo`, `elimu_id`, 
							//`ubunge_id` FROM `ubunge_elimu` WHERE 1
                            $i = 1;
                            $rwee = $getEli->fetch();
							
							//Get wilaya name
                             $getDict6= $db->gettDistrict($rwee['zamakadiwilaya_id']);
                             $rwD6 = $getDict6->fetch();
                             $dname6 = $rwD6['DistrictName'];
									
                            //Get region name
                            $getRegs6 = $db->getRegionName($rwee['zamakadimkoa_id']);
                            $rwC6 = $getRegs6->fetch();
                            $gname6 = $rwC6['RegName'];
							
							//Get wilaya name
                             $getDict7= $db->gettDistrict($rwee['mpyawilaya_id']);
                             $rwD7 = $getDict7->fetch();
                             $dname7 = $rwD7['DistrictName'];
									
                            //Get region name
                            $getRegs7 = $db->getRegionName($rwee['mpyamkoa_id']);
                            $rwC7 = $getRegs7->fetch();
                            $gname7 = $rwC7['RegName'];
                            
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $rwee['zamanikadi']; ?></td>
                                    <td><?php echo $gname6; ?></td>
                                    <td><?php echo $dname6; ?></td>
                                    <td><?php echo $rwee['zamakaditawi']; ?></td>
									<td><?php echo $rwee['zamatarehe']; ?></td>
									<td><?php echo $rwee['mpyakadi']; ?></td>
                                    <td><?php echo $gname7; ?></td>
                                    <td><?php echo $dname7; ?></td>
                                    <td><?php echo $rwee['mpyatawi']; ?></td>
									<td><?php echo $rwee['mpyatarehe']; ?></td>
									<td><?php echo $rwee['mpyahadilini']; ?></td>
                                </tr>
                                <?php $i++;
                            ?>
                            </tbody>
                        </table>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>
                                <th>Kadi ya UWT, UVCCM, WAZAZI</th>
                                <th>Mkoa</th>
                                <th>Wilaya</th>
								<th>Tarehe Iliyotolewa</th>
								<th>Amelipia Hadi Lini</th>
                                <th>Tawi la Sasa</th>
                                <th>Mwenyekiti wa Tawi CCM</th>
                                <th>Uwanachama Chama Kingine</th>
								<th>Maelezo ya Chama Kingine</th>
								
                            </tr>
                            </thead>
                            <tbody>
                            <?php
							
							
							//Get wilaya name
                             $getDict8= $db->gettDistrict($rwee['jumuiyawilaya_id']);
                             $rwD8 = $getDict8->fetch();
                             $dname8 = $rwD8['DistrictName'];
									
                            //Get region name
                            $getRegs8 = $db->getRegionName($rwee['jumuiyamkoa_id']);
                            $rwC8 = $getRegs8->fetch();
                            $gname8 = $rwC8['RegName'];
						
                            
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $rwee['jumuiyakadi']; ?></td>
                                    <td><?php echo $gname8; ?></td>
                                    <td><?php echo $dname8; ?></td>
                                    <td><?php echo $rwee['jumuiatarehe']; ?></td>
									<td><?php echo $rwee['jumuiyahadilini']; ?></td>
									<td><?php echo $rwee['tawimwkjina']; ?></td>
                                    <td><?php echo $rwee['tawijina']; ?></td>
                                    <td><?php echo $rwee['chamakingine']; ?></td>
                                    <td><?php echo $rwee['chamamaelezo']; ?></td>
									
                                </tr>
                                <?php $i++;
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
			<div class="panel panel-success">
                <div class="panel-heading">UONGOZI NA MAADILI</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>
                                <th>Hatia ya Kutokulipa Kodi</th>
                                <th>Maelezo ya Kutokulipa Kodi</th>
                                <th>Uzoefu wa Uongozi CCM</th>
								<th>Mchango Kuimaisha CCM</th>
								
                                <th>Kazi Anayofanya</th>
                                <th>Kosa la Jinai</th>
								<th>Maelezo ya Kosa la Jinai</th>
								
								
                            </tr>
                            </thead>
                            <tbody>
                            <?php
							
							
				
                            
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $rwee['kwepakodi']; ?></td>
                                    <td><?php echo $rwee['kwepakodimaelezo']; ?></td>
                                    <td><?php echo $rwee['chamauongozi'];; ?></td>
                                    <td><?php echo $rwee['chamamchango']; ?></td>
									<td><?php echo $rwee['kazikipato']; ?></td>
									<td><?php echo $rwee['kosajinai']; ?></td>
                                    <td><?php echo $rwee['kosajinaimaelezo']; ?></td>
                                    
									
                                </tr>
                                <?php $i++;
                            ?>
                            </tbody>
                        </table>
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>
                                
								<th>Kosa la Nidhamu CCM</th>
								<th>Maelezo ya Kosa Nidhamu</th>
								<th>Uthibitisho wa Katibu</th>
								<th>Jina la Katibu</th>
								<th>Ngazi ya Katibu</th>
								
                            </tr>
                            </thead>
                            <tbody>
                            <?php
							
							
				
                            
                                ?>
                                <tr class="odd gradeX">
                                    
                                    <td><?php echo $rwee['kosamaadiliccm']; ?></td>
									 <td><?php echo $rwee['kosamaadilimaelezo']; ?></td>
                                    <td><?php echo $rwee['katibuthibitisha']; ?></td>
									<td><?php echo $rwee['jinalakatibu']; ?></td>
									<td><?php echo $rwee['ngaziyakatibu']; ?></td>
									
                                </tr>
                                <?php $i++;
                            ?>
                            </tbody>
                        </table>
						</div>
						</div>
						</div>