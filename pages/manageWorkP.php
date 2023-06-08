<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Manage Employment Permit</h2>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    List of Employment permit
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
								   <span style="float:right;">
							        <button class="btn btn-success" data-toggle="modal" data-target="#addWP"
                                            data-id="<?php echo $_SESSION['userid']; ?>" id="getaddWP"><i
                                                class="fa fa-plus-square"></i>Add New</button>
                                       </p>
							        </span>

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Category Name</th>
                                <th>Work Place Name</th>
                                <th>Cadre</th>
                                <th>Status</th>
                                <!--<th>Edit</th>-->
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $sel = $db->getAllFacility();
                            while ($row = $sel->fetch()) {
                                $fac_id = $row['fac_id'];
                                $category = $row['category'];
                                $wp_id = $row['wp_id'];
                                //$year=$row['year'];
                                $status = $row['status'];

                                $wpname = '';
                                include("lib/criteria_setting.php");

                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo strtoupper($cat); ?></td>
                                    <td><?php echo strtoupper($wpname); ?></td>
                                    <td align="left">
                                        <a href="?pg=mngFD&fac_id=<?php echo $fac_id; ?>" class="btn btn-info btn-xs"><i
                                                    class="fa fa-folder"></i>View Cadre(s)</a>
                                    </td>

                                    <?php if ($status == 'Active') { ?>
                                        <td align="left">
                                            <form  action="includes/process.php" method="POST">
                                                <input type="hidden" name="fac_id" value="<?=$fac_id ?>">
                                                <input type="hidden" name="status" value="Inactive">
                                                <button type="submit" name="deleteWP" class="btn btn-success btn-xs">Active</button>
                                            </form>
                                        </td>
                                    <?php } else { ?>
                                        <td align="left">
                                            <form  action="includes/process.php" method="POST">
                                                <input type="hidden" name="fac_id" value="<?=$fac_id ?>">
                                                <input type="hidden" name="status" value="Active">
                                                <button type="submit" name="deleteWP" class="btn btn-warning btn-xs">Inactive</button>
                                            </form>
                                        </td>
                                    <?php } ?>


                                    <td align="left"><a href="#deleteWP" class="btn btn-danger btn-xs"
                                                        data-toggle="modal" data-id="<?php echo $fac_id; ?>"
                                                        id="getdeleteWP"><i class="fa fa-trash"></i>Delete</a>
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


<!--DEFINING MODALS--->
<!--Module to Add New -->
<div id="addWP" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Employment Permit:</h4>
            </div>
            <div class="modal-body">

                <div id="addWP-contents"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Edit -->
<div id="editWP" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Facility</h4>
            </div>
            <div class="modal-body">

                <div id="editWP-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Delete -->
<div id="deleteWP" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Work Permit:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteWP-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



          