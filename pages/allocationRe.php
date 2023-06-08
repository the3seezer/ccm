<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Allocation Report</h1>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">List of selected Applicants</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
     <span style="float:right;">
	 <button class="btn btn-success" data-toggle="modal" data-target="#allocate"
             data-id="<?php echo $_SESSION['userid']; ?>" id="getadduser"><i
                 class="fa fa-folder"></i>View Report By</button>
         </p>
	 </span>

                        <?php
                        if (isset($_POST['allocationReport']))
                        {
                        ?>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>DOB</th>
                                <th>Marital Status</th>
                                <th>Phone</th>
                                <th>Facility</th>
                                <th>Cadre</th>
                                <th>Score</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $pmYear = $_POST['year'];
                            $fac1G = $_POST['fac1'];
                            $cadre1 = $_POST['cadre1'];


                            if ($fac1G == "All" AND $cadre1 == "All") {
                                $sel = $db->getListofAllocatedApplicants($pmYear);
                            } elseif ($fac1G == "All" AND $cadre1 != "All") {
                                $sel = $db->getListofAllocatedApplicantsByCadreId($cadre1, $pmYear);
                            } elseif ($fac1G != "All" AND $cadre1 == "All") {
                                $fac1G1 = explode("=", $fac1G);
                                $fac1 = $fac1G1[0];
                                $cat1 = $fac1G1[1];
                                $wp_id1 = $fac1G1[2];

                                $sel = $db->getListofAllocatedApplicantsByLocation($pmYear, $cat1, $wp_id1, $cadre1);
                            } elseif ($fac1G != "All" AND $cadre1 != "All") {
                                $fac1G1 = explode("=", $fac1G);
                                $fac1 = $fac1G1[0];
                                $cat1 = $fac1G1[1];
                                $wp_id1 = $fac1G1[2];

                                $sel = $db->getListofAllocatedApplicantsByYearWPCat($pmYear, $cat1, $wp_id1, $cadre1);
                            } else {
                            }


                            $i = 1;
                            while ($rw = $sel->fetch()) {
                                $allocate_id = $rw['allocate_id'];
                                $app_id = $rw['app_id'];
                                $applicant_id = $rw['applicant_id'];
                                $category = $rw['category'];
                                $wp_id = $rw['wp_id'];
                                $cadreid = $rw['cadre_id'];
                                $choiceNo = $rw['choiceNo'];
                                $score = $rw['score'];

                                $wpname = '';
                                include("lib/criteria_setting.php");

                                //Get Cadre name
                                $getCa = $db->getHealthCadresById($cadreid);
                                $rwC = $getCa->fetch();
                                $cadName = $rwC['cadreName'];

                                //Get Applicants Details
                                $getAp = $db->getApplicantsById($applicant_id);
                                $row = $getAp->fetch();

                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['dob']; ?></td>
                                    <td><?php echo $row['maritalStatus']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td align="left"><?php echo strtoupper($wpname); ?></td>
                                    <td align="left"><?php echo strtoupper($cadName); ?></td>
                                    <td align="left"><?php echo $score; ?></td>
                                </tr>
                                <?php $i++;
                            }
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

                <form action="?pg=alloRep" method="post" class="form-horizontal form-label-left">

                    <!--Year-->
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Year<span
                                    class="required">*</span></label>
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


                    <!--Work Permit-->
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Work Permit
                            <span class="required"></span></label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="fac1" required="required"
                                    onchange="loadCadreValueReport(this.value);">
                                <option value="">--Select--</option>
                                <option value="All">All</option>
                                <?php
                                $getCa = $db->getAllActiveFacility($pmYear);
                                while ($row = $getCa->fetch()) {
                                    $fac_id = $row['fac_id'];
                                    $category = $row['category']; //Category
                                    $wp_id = $row['wp_id']; //Work permit Id


                                    $wpname = '';
                                    include("lib/criteria_setting.php");

                                    ?>
                                    <option value="<?php echo $fac_id . "=" . $category . "=" . $wp_id; ?>">
                                        <?php echo strtoupper($wpname); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Cadre
                            <span class="required"></span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="cadreReport" class="form-control col-md-7 col-xs-12" name="cadre1"
                                    required="required">
                                <option value="">--Select--</option>
                            </select>
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" name="allocationReport" class="btn btn-success">Submit
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


          