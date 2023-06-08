<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Manage Hospitals </h2>
    </div>
</div>
<div class="row">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">

                    List of Hospitals

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <span style="float:right;">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addRRH" data-id="<?php echo $_SESSION['userid']; ?>" id="getaddRRH"><i class="fa fa-plus-square"></i>Add New</button></p>
                        </span>

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Hospital Name</th>
                                    <th>Level</th>
                                    <th>Region</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $sel = $db->getAllRRHName();
                                while ($row = $sel->fetch()) {
                                    $rrh_id = $row['id'];
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo strtoupper($row['rrhName']); ?></td>
                                        <td><?php echo strtoupper($row['level']); ?></td>
                                        <td><?php echo strtoupper($row['RegName']); ?> </td>
                                        <td align="left">
                                            <a href="#editRRH" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $rrh_id; ?>" id="geteditRRH"><i class="fa fa-edit"></i>Edit</a>
                                        </td>

                                        <td align="left"> <a href="#deleteRRH" class="btn  btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $rrh_id; ?>" id="getdeleteRRH"><i class="fa fa-trash"></i>Delete</a>
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
<div id="addRRH" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Hospital:</h4>
            </div>
            <div class="modal-body">

                <div id="addRRH-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!--Module to Edit -->
<div id="editRRH" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Hospital</h4>
            </div>
            <div class="modal-body">

                <div id="editRRH-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!--Module to Delete -->
<div id="deleteRRH" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Hospital:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteRRH-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>