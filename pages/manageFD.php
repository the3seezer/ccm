<?php
$fac_id = $_GET['fac_id'];

$getF = $db->getfacilityByfacid($fac_id);
$rw = $getF->fetch();
$wp_id = $rw['wp_id'];
$category = $rw['category'];
$wpname = '';
include("lib/criteria_setting.php");

$sel = $db->getCadreByFacId($fac_id);

//Get Total number of cadres
$totalCadre = $sel->rowCount();
?>


<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Employment Permit Name: <?php echo $wpname; ?></h2>
    </div>
</div>
<div class="row">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                    List of Cadres

                </div>
                <!--/.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
								     <span style="float:right;">
							         <button class="btn btn-success" data-toggle="modal" data-target="#addCadre"
                                             data-id="<?php echo $fac_id; ?>" id="getaddCadre">
									 <i class="fa fa-plus-square"></i>Add New Cadre</button>
                                         </p>
							         </span>

                        <?php
                        $i = 1;
                        while ($row = $sel->fetch()) {
                            $cadreId = $row['cadreId'];
                            $cadreName = $row['cadreName'];
                            //$number=$row['number'];
                            //$status=$row['status'];

                            $getL = $db->getListNumbersPerCadre($cadreId, $fac_id);
                            ?>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                <thead>
                                <tr>
                                    <th colspan="5"><?php echo $cadreName; ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="4">
										  <span style="float:right;">
							         <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#addYear"
                                             data-id="<?php echo $cadreId . "=" . $fac_id; ?>" id="getaddYear">
									 <i class="fa fa-plus-square"></i>Add Year</button>
                                              </p>
							         </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vacancy</td>
                                    <!-- <td>Used</td> -->
                                    <td>Year</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                </tr>

                                <?php
                                //Get list of number by cadre Id
                                $i = 1;
                                while ($rw = $getL->fetch()) {
                                    $tableId = $rw['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $rw['number']; ?></td>
                                        <!-- <td><?php //echo $rw['used'];
                                        ?></td> -->
                                        <td><?php echo $rw['year']; ?></td>

                                        <td align="left">
                                            <a href="#editCadreYear" class="btn btn-primary btn-xs" data-toggle="modal"
                                               data-id="<?php echo $tableId . "=" . $fac_id; ?>"
                                               id="geteditCadreYear"><i class="fa fa-edit"></i>Edit</a>
                                        </td>

                                        <td align="left">
                                            <a href="#deleteCadreYear" class="btn btn-danger btn-xs" data-toggle="modal"
                                               data-id="<?php echo $tableId . "=" . $fac_id; ?>"
                                               id="getdeleteCadreYear"><i class="fa fa-trash">
                                                </i>Delete</a>
                                        </td>

                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>
                            </table>

                            <?php $i++;
                        } ?>

                        <!--
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                        <thead>
                                            <tr>
											    <th>SN</th>
                                                <th>Cadre Name</th>
                                                <th>Number</th>
                                                <th>Status</th>
                                                <th>Edit</th>
												<th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
                        $i = 1;

                        while ($row = $sel->fetch()) {
                            $cadre_id = $row['cadre_id'];
                            $cadreName = $row['cadreName'];
                            $number = $row['number'];
                            $status = $row['status'];
                            ?>
                                            <tr class="odd gradeX">
											    <td><?php echo $i; ?></td>
                                                <td><?php echo $cadreName; ?></td>
                                                <td><?php echo $number; ?></td>
												<?php
                            if ($status == 'Active') {
                                ?>
                                                <td align="left">
												   <button type="button" class="btn btn-success btn-xs">Active</button>
												</td>
												<?php
                            } else {
                                ?>
												<td align="left">
												  <button type="button" class="btn btn-danger btn-xs">In Active</button>
												</td>
												<?php
                            }
                            ?>
												
                                                <td align="left">
												   <a href="#editCadre" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $cadre_id; ?>" 
												   id="geteditCadre">
												   <i class="fa fa-edit"></i>Edit</a>
												</td>
												
										        <td align="left"> <a href="#deleteCadre" 
												class="btn btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $cadre_id . "=" . $fac_id; ?>" id="getdeleteCadre"><i class="fa fa-trash">
												</i>Delete</a>
												</td>
												
                                            </tr>
											
                                         <?php $i++;
                        } ?>
										
                                        </tbody>
										
                                    </table>
									-->

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
<!--Module to Add New -->
<div id="addCadre" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Cadre:</h4>
            </div>
            <div class="modal-body">

                <div id="addCadre-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Add New Cadre Year-->
<div id="addYear" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Cadre Year</h4>
            </div>
            <div class="modal-body">

                <div id="addCadreYear-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Edit -->
<div id="editCadreYear" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Details:</h4>
            </div>
            <div class="modal-body">

                <div id="editCadreYear-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Delete -->
<div id="deleteCadreYear" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Information</h4>
            </div>
            <div class="modal-body">

                <div id="deleteCadreYear-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


          