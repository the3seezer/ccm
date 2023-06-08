<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Manage Agencies/Facilities</h2>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">

                List of Agencies/Facilities

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <span style="float:right;">
                        <button class="btn btn-success" data-toggle="modal" data-target="#addFacility" data-id="<?php echo $_SESSION['userid']; ?>" id="getaddFacility"><i class="fa fa-plus-square"></i>Add New</button></p>
                    </span>

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Agencies/Facilities</th>
                                <th>Type</th>
                                <th>Council Name</th>
                                <th>Region Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $sel = $db->getFacility();
                            while ($row = $sel->fetch()) {
                                $facid = $row['facId'];
                            ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo strtoupper($row['facname']); ?></td>
                                    <td>
                                        <?php
                                        if ($row['facility_type_id'] != '') {
                                            $selectFTN = $db->getFacilityTypeName($row['facility_type_id']);
                                            $rowft = $selectFTN->fetch();
                                            echo strtoupper($rowft['name']);
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo strtoupper($row['DistrictName']); ?></td>
                                    <td><?php echo strtoupper($row['RegName']); ?></td>
                                    <td align="left">
                                        <a href="#editFacility" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $facid; ?>" id="geteditFacility"><i class="fa fa-edit"></i>Edit</a>
                                    </td>

                                    <td align="left"> <a href="#deleteFacility" class="btn  btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $facid; ?>" id="getdeleteFacility"><i class="fa fa-trash"></i>Delete</a>
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

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">

                List of Agencies/Facilities Types

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <span style="float:right;">
                        <button class="btn btn-success" data-toggle="modal" data-target="#addFacilityType" id=""><i class="fa fa-plus-square"></i>Add New</button></p>
                    </span>

                    <table class="table table-striped table-bordered table-hover" id="">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Agencies/Facilities Type</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $sel = $db->getFacilityTypes();
                            while ($row = $sel->fetch()) {
                                $facility_type_id = $row['facility_type_id'];
                                $type = $row['name'];
                            ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo ($type); ?></td>
                                    <td align="left">
                                        <a href="#editFacilityType" onclick="$('#facilityTypeID').val('<?= $facility_type_id; ?>');$('#facilityTypeName').val('<?= $type; ?>');" class="btn btn-primary btn-xs" data-toggle="modal"><i class="fa fa-edit"></i>Edit</a>
                                    </td>

                                    <td align="left"> <a href="#deleteFacilityType"  onclick="$('#deleteFacilityTypeID').val('<?= $facility_type_id; ?>')" class="btn  btn-danger btn-xs" data-toggle="modal"><i class="fa fa-trash"></i>Delete</a>
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
<div id="addFacility" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Agencies:</h4>
            </div>
            <div class="modal-body">

                <div id="addFacility-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="addFacilityType" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Agencies/Facility Type:</h4>
            </div>
            <div class="modal-body">

                <div id="">
                    <form action="includes/process.php" method="post" class="form-horizontal form-label-left">

                        <!--District Name-->
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Agencies/Facility Type<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="" class="form-control col-md-7 col-xs-12" name="type" required type="text">
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <input type="submit" id="send" class="btn btn-success" name="addFacilityType" value="Submit" />
                                <input type="reset" class="btn btn-default" value="Clear" />
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Edit -->
<div id="editFacility" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Agencies</h4>
            </div>
            <div class="modal-body">

                <div id="editFacility-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div id="editFacilityType" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Agencies/Facility Type:</h4>
            </div>
            <div class="modal-body">

                <div id="">
                    <form action="includes/process.php" method="post" class="form-horizontal form-label-left">

                        <!--District Name-->
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Agencies/Facility Type<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="facilityTypeName" class="form-control col-md-7 col-xs-12" name="type" required type="text">
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <input type="hidden" id="facilityTypeID" name="facility_type_id" value="">
                                <input type="submit" id="send" class="btn btn-success" name="editFacilityType" value="Submit" />
                                <!-- <input type="reset" class="btn btn-default" value="Clear" /> -->
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Delete -->
<div id="deleteFacility" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Agencies/Facility:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteFacility-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="deleteFacilityType" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Agencies/Facility type:</h4>
            </div>
            <div class="modal-body">
                <form action="includes/process.php" method="post" class="form-horizontal form-label-left">


                    <p>Do you want to delete this information?</p>
                    <br /> <br />


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input type="hidden" id="deleteFacilityTypeID" name="facility_type_id" value="">
                            <input type="submit" id="deleteFacilityType" class="btn btn-danger" name="deleteFacilityType" value="Delete" />
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