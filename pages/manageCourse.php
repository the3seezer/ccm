<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Manage Programs</h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">

                List of Programs

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
								   <span style="float:right;">
							        <button class="btn btn-success" data-toggle="modal" data-target="#addCourse"
                                            data-id="<?php echo $_SESSION['userid']; ?>" id="getaddCourse"><i
                                            class="fa fa-plus-square"></i> Add New</button>
                                       </p>
							        </span>

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Course Name</th>
                            <th>From Server</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        $sel = $db->getCourses();
                        while ($row = $sel->fetch()) {
                            $id = $row['id'];
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo strtoupper($row['name']); ?></td>
                                <td><?php echo strtoupper($row['from_server']); ?></td>
                                <td align="left">
                                    <a href="#editCourse" class="btn btn-primary btn-xs" data-toggle="modal"
                                       data-id="<?php echo $id; ?>"
                                       id="geteditCourse"><i class="fa fa-edit"></i> Edit</a>
                                </td>

                                <td align="left">
                                    <a href="#deleteCourse"
                                       class="btn btn-danger btn-xs"
                                       data-toggle="modal" data-id="<?php echo $id; ?>"
                                       id="getdeleteCourse"><i class="fa fa-trash"></i> Delete</a>
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

<!--DEFINING MODALS--->
<!--Module to Add New -->
<div id="addCourse" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Course:</h4>
            </div>
            <div class="modal-body">

                <div id="addCourse-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Edit -->
<div id="editCourse" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Course</h4>
            </div>
            <div class="modal-body">

                <div id="editCourse-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Delete -->
<div id="deleteCourse" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Course:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteCourse-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



