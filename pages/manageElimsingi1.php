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
$kwanza = $rw['jinamwanzo'];
$kati = $rw['jinakati'];
$mwisho = $rw['jinamwisho'];
$nafasi = $rw['nafasi'];

  $jimbo_id = $rw['gjimbo_id'];
  $wilaya_id = $rw['gwilaya_id'];
  $mkoa_id = $rw['gmkoa_id'];
  $getRegs = $db->getRegionName($mkoa_id);
  $rwC = $getRegs->fetch();
  $gname = $rwC['RegName'];
  
  $getJimb = $db->select_JI($jimbo_id);
  $rwJ = $getJimb->fetch();
  $jname = $rwJ['JimboName'];
?>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Elimu ya Mgombea</h2>
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
							        <a href="?pg=bMsingi&id=<?php echo $idd; ?>"><button class="btn btn-success btn-outline1" >
                                        <i class="fa fa-plus-square fa-fw"></i>Ongeza Elimu</button></a>
                                       </p>
							        </span>
									</div>
                    <div class="dataTable_wrapper">

                        

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    
                                    
									<th>S/N</th>
									<th>Aina ya Elimu</th>
                                    <th>Kiwango Cha Elimu</th>
                                    <th>Shule/ Secondari/ Chuo</th>
                                    <th>Mwaka wa Kuhitimu</th>
								    <th>Maelezo</th>
                                    <th>Rekebisha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getEli= $db->mgombeaElimu($idd); 
							//SELECT `ainaelimu`, `kiwango`, `chuo`, `mwaka`, `maelezo`, `elimu_id`, 
							//`ubunge_id` FROM `ubunge_elimu` WHERE 1
                            $i = 1;
                            while ($rwe = $getEli->fetch()) {
                                ?>
                               
                                    <tr class="odd gradeX">
                                        
                                        
                                       
                                        <td><?php echo $i; ?></td>
										<td><?php echo $rwe['ainaelimu']; ?></td>
                                        <td><?php echo $rwe['kiwango']; ?></td>
                                        <td><?php echo $rwe['chuo']; ?></td>
                                        <td><?php echo $rwe['mwaka']; ?></td>
									    <td><?php echo $rwe['maelezo']; ?></td>
                                        <td align="left"><a href="?pg=bElimu&id=<?php echo $rwe['elimu_id']; ?>"><button class="btn btn-danger btn-outline"><i class="fa fa-edit fa fw"></i> Edit</button></a></td>
                                       
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
<div id="allocate" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Allocate Applicants</h4>
            </div>
            <div class="modal-body">
                <!--<div id="addUser-content"></div>-->

                <form action="includes/process.php" method="post" class="form-horizontal form-label-left">

                    <!--Year-->
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Year<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="year" class="form-control col-md-7 col-xs-12" name="year" required="required">
                                <option value="">--Select--</option>
                                <?php
                                $cYear = date('Y');
                                $i = 1;
                                ?>
                                <option><?php echo $cYear - 2; ?></option>
                                <option><?php echo $cYear - 1; ?></option>
                                <option><?php echo $cYear; ?></option>
                                <?php
                                while ($i <= 5) {
                                ?>
                                    <option><?php echo $cYear + $i; ?></option>
                                <?php $i++;
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" name="allocationTool" class="btn btn-success">Submit
                            </button>
                            <button type="reset" class="btn btn-default">Clear</button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


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