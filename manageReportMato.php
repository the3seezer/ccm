<?php session_start();
    //Connect to database
    include("lib/dbconnect.php");
    $db = new dbClass();
    $db->connect();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Orodha ya Wagombea na Matokeo</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
	<table width="90%" align='center'>
	<tr><td>&nbsp;</td></tr>
	<tr><td align='center'><img src="img/ccm.png" style="width:100px;height:100px;"></td> </tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td align='center'><strong>Chama Cha Mapinduzi (CCM)</strong></td></tr>
	
	
	<tr><td>&nbsp;</td></tr>
	<tr><td align='center'><strong>Orodha ya Wagombea na Matokeo</strong></td></tr>
	
	<tr><td align="right">&nbsp;<button class="btn btn-outline btn-info" onclick="window.print();return false;" ><i class="fa fa-print fa-fw "></i>Print</button></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr> 
	<td>
<div class="row">
    <div class="row" >
        <div class="col-lg-12">
            <div class="panel panel-default">
                
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">

                       

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example" width="90%" border="1">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Jina la Mgombea</th>
                                    <th>Umri</th>
                                    <th>Nafasi Anayogombea</th>
                                    <?php if($_POST['aina']=="Udiwani")
									{
										echo '<th>Kata</th>';
									}else{
										echo '<th>Jimbo</th>';
									}?>
                                    <th>Mkoa</th>
                        
									<th>Kura Zote</th>
                                    <th>Zilizoharibika</th>
									
                                    <th>Halali</th>
									<th>Alizopata</th>
									<th>Nafasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
								$aina = $_POST['aina'];
								$ngazi = $_POST['ngazi'];
								$sel="";
								if($aina=="Ubunge")
								{
									if($ngazi=="Taifa")
									{
								        $sel = $db->singleUbungeAll();
									}elseif($ngazi=="Mkoa"){
									    $mkoa = $_POST['mkoa'];
									    $sel = $db->singleUbungeMkoaOnly($mkoa);
									}elseif($ngazi=="Wilaya")
									{
										$wilaya = $_POST['wilaya'];
									    $sel = $db->singleUbungeWilayaOnly($wilaya);
									}
								}elseif($aina=="Udiwani")
								{
									if($ngazi=="Taifa")
									{
								        $sel = $db->singleUdiwaniAll();
										
									}elseif($ngazi=="Mkoa"){
									    $mkoa = $_POST['mkoa'];
									    $sel = $db->singleUdiwaniMkoaOnly($mkoa);
										
									}elseif($ngazi=="Wilaya")
									{
										$wilaya = $_POST['wilaya'];
									    $sel = $db->singleUdiwaniWilayaOnly($wilaya);
										
									}
								}
                                
                                while ($rw = $sel->fetch()) {
//`jinamwanzo`, `jinakati`, `jinamwisho`, `nafasi`, `gjimbo_id`, `gwilaya_id`,
	  // `gmkoa_id`, `dob`
                                    $kwanza = $rw['jinamwanzo'];
                                    $kati = $rw['jinakati'];
                                    $mwisho = $rw['jinamwisho'];
                                    $nafasi1 = $rw['nafasi'];
                                    $jimbo_id = $rw['gjimbo_id'];
                                    $wilaya_id = $rw['gwilaya_id'];
                                    $mkoa_id = $rw['gmkoa_id'];
                                    $dob = $rw['dob'];
                                    $id=$rw['ubunge_id'];
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
                                    if($aina=="Udiwani")
								    {
								
									$getJimb = $db->select_KATABYID($jimbo_id);
                                    $rwJ = $getJimb->fetch();
                                    $jname = $rwJ['KataName'];
									}else {
                                    $getJimb = $db->select_JI($jimbo_id);
                                    $rwJ = $getJimb->fetch();
                                    $jname = $rwJ['JimboName'];
									}
                                    
									$getkuraa = $db->selectKuraMgombea($id);
                                    $rwr = $getkuraa->fetch();
                                    $kura = $rwr['kura'];
									$nafasi = $rwr['nafasi'];
									
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
                                        <td><?php echo $currentAge; ?></td>
                                        <td><?php echo $nafasi1; ?></td>
                                        <td><?php echo $jname; ?></td>
                                        <td><?php echo $gname; ?></td>
                                        <td><?php echo $idadi; ?></td>
                                        <td><?php echo $zilizoharibika; ?></td>  
                                        <td><?php echo $halali; ?></td>
                                        <td><?php echo $kura; ?></td>
										<td><?php echo $nafasi; ?></td>

                                    </tr>
                                <?php
								$i++;
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
</table>
	</tr> 
	</td>
</body>
</html>
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
