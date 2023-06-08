<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Unshortlisted Applicants</h1>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">List of Unshortlisted Applicants</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">

                        <!-- <span style="float:right;">
		 <button class="btn btn-success" data-toggle="modal" data-target="#shortlist"
                 data-id="<?php //echo $_SESSION['userid']; 
                            ?>" id="getadduser"><i class="fa fa-plus-square"></i>View</button>
             </p>
		 </span> -->

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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $status = "Unshortlisted";

                                //Get Permit Year
                                $getPY = $db->getWorkPermitYear();
                                $rP = $getPY->fetch();
                                $pmYear = $rP['year'];

                                $sel = $db->getListofUnshortlistedApplicantsByYear($pmYear);
                                while ($rw = $sel->fetch()) {
                                    $applicant_id = $rw['applicant_id'];

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
                                        <td align="left">
                                            <?php
                                            //Get Shortlisted cadres
                                            $getWP = $db->getUnshortlistedWPByApplicantIdYear($applicant_id, $pmYear);
                                            while ($rw1 = $getWP->fetch()) {
                                                $app_id = $rw1['app_id'];
                                                $category = $rw1['category'];
                                                $wp_id = $rw1['fac_id'];
                                                $cadreid = $rw1['cadre_id'];
                                                $choiceNo = $rw1['choiceNo'];
                                                $score = $rw1['credit'];

                                                $wpname = '';
                                                include("lib/criteria_setting.php");

                                                //Get Cadre name
                                                $getCa = $db->getHealthCadresById($cadreid);
                                                $rwC = $getCa->fetch();
                                                $cadName = $rwC['cadreName'];


                                                echo $choiceNo . "." . strtoupper($wpname) . "-" . $cadName . "(" . $score . ")" . "<br/>";
                                            }
                                            ?>
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
<!--Module to Allocate-->
<div id="shortlist" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Unshortlisted Applicants</h4>
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
                                for ($i = $cYear; $i >= 2018; $i--) {
                                ?>
                                    <option><?php echo $i; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" name="shortlistTool" class="btn btn-success">Submit</button>
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