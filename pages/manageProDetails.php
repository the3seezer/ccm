<?php
$applicant_id = $_SESSION['applicant_id'];

$getAp = $db->getProfessionalByAppId($applicant_id);

$getBE = $db->getEducationByAppId($applicant_id);
?>

<div class="row">
    <div class="col-lg-12"><h2 class="page-header">Professional Details</h2></div>
</div>

<div class="row">

    <div class="col-lg-12">

        <!--Panel if basic education is not entered-->
        <?php
        //get cetificate type
        $getPass = $db->getDocType('Passport size');
        $pass = $getPass->fetch();
        $passport = $pass['DocumentID'];
        //Check if file uploaded
        $checkPass = $db->checkIfFileExist($passport, $applicant_id);

        //get cetificate type
        $getBirthCertificate = $db->getDocType('Birth Certificate');
        $birthCert = $getBirthCertificate->fetch();
        $birthCertificate = $birthCert['DocumentID'];
        //Check if file uploaded
        $checkCertificate = $db->checkIfFileExist($birthCertificate, $applicant_id);

        if ($checkPass->rowCount() <= 0) { ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Make sure you have uploaded <b>Passport size photograph</b> before proceeding with this section
                    </p>
                </div>
            </div>
        <?php } elseif ($checkCertificate->rowCount() <= 0) { ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Make sure you have uploaded <b>Certificate of Birth</b> before proceeding with this section</p>
                </div>
            </div>
            <?php
        } elseif ($getBE->rowCount() < 1) {
            ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Make sure that you enter your basic education details before proceeding with this section</p>
                </div>
            </div>
            <?php
        } elseif ($getBE->rowCount() > 0 AND $getAp->rowCount() < 1)//Panel if  basic education is entered and profesional is not entered
        {
            ?>
            <div class="panel panel-primary">
                <div class="panel-heading">Enter professional details by clicking on add new button below</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr bgcolor="">
                                <th colspan="7">

                                    <span style="float:right;">
                                        <a href="#addProf"
                                           class="btn btn-primary btn-xs"
                                           data-toggle="modal"
                                           data-id="<?php echo $applicant_id; ?>"
                                           id="getaddProf"><i class="fa fa-plus"></i>Add New</a>
                                    </span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php
        } elseif ($getAp->rowCount() > 0 AND $getBE->rowCount() > 0) //Panel if  profesional is entered
        {
            ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <p align="center">You have Submitted the following professional details. Click on add new button if
                        you want to add another professional details or click on next button below to continue with
                        experience details.
                    </p>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr bgcolor="">
                                <th colspan="7">

                                    <span style="float:right;"><a href="#addProf" class="btn btn-primary btn-xs"
                                                                  data-toggle="modal"
                                                                  data-id="<?php echo $applicant_id; ?>"
                                                                  id="getaddProf"><i class="fa fa-plus"></i>Add New</a></span>
                                </th>

                            </tr>

                            <tr bgcolor="">
                                <th>Education Level</th>
                                <th>Study Country</th>
                                <th>College Name</th>
                                <th>Programme</th>
                                <th>Completed Year</th>
                                <th>Certificate</th>
                                <th>Transcript</th>
                                <th>Is this your Current Education?</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php 
                            $is_current_yes = 'not';
                            $is_current_yes_count = 0;
                            while ($row = $getAp->fetch()) {
                                $PID = $row['programme_id'];
                                $INSID = $row['college'];
                                $location = $row['location'];
                                $is_current = $row['is_current'];
                                if ($is_current == 'Yes') {
                                    $is_current_yes = 'ok';
                                    $is_current_yes_count++;
                                }
                                if ($location == 'Tanzania, United Rep') {

                                    $institutions = $db->getInstitutionByID($INSID);

                                    while ($value = $institutions->fetch()) {
                                        $iName = $value['InstitutionName'];
                                    }


                                    $program = $db->getCourseName($PID);

                                    while ($value = $program->fetch()) {
                                        $progName = $value['name'];
                                    }
                                } else { //IF LOCATION IS NOT IN TANZANIA
                                    $iName = $row['college'];
                                    $progName = $row['programme_id'];
                                }

                                ?>

                                <tr>
                                    <td><?php echo $row['level']; ?></td>
                                    <td><?php echo strtoupper($row['location']); ?></td>
                                    <td><?php echo strtoupper($iName); ?></td>
                                    <td><?php echo strtoupper($progName); ?></td>
                                    <td><?php echo $row['year']; ?></td>
                                    <td>
                                        <?php if ($row['document_type_id'] != "") { ?>
                                            <a href="#docuView" class="btn btn-info btn-xs" data-toggle="modal"
                                               data-docid="<?php echo $row['document_type_id']; ?>" id="viewDocu"><i
                                                        class="fa fa-folder"></i> View </a>
                                        <?php } else { ?>
                                            Not Uploaded
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($row['trans_doc'] != "") { ?>
                                            <a href="#docuView" class="btn btn-success btn-xs" data-toggle="modal"
                                               data-docid="<?php echo $row['trans_doc']; ?>" id="viewDocu"><i
                                                        class="fa fa-folder"></i> View </a>
                                        <?php } else { ?>
                                            Not Uploaded
                                        <?php } ?>
                                    </td>
                                    <td><?= $is_current; ?></td>
                                    <td align="left">
                                        <a href="#editPro" class="btn btn-primary btn-xs" data-toggle="modal"
                                           data-id="<?php echo $row['prof_id']; ?>" id="geteditPro"><i
                                                    class="fa fa-edit"></i>Edit</a>
                                    </td>

                                    <td align="left"><a href="#deletePro" class="btn btn-danger btn-xs"
                                                        data-toggle="modal" data-id="<?php echo $row['prof_id']; ?>"
                                                        data-applicant="<?=$applicant_id ?>"
                                                        id="getdeletePro"><i class="fa fa-trash"></i>Delete</a>
                                    </td>
                                </tr>

                            <?php } ?>


                            </tbody>
                        </table>
                        <hr/>
                        <br/>
                        <span style="float:right;">
        <a 
        <?php if ($is_current_yes != 'ok') { ?>
            onclick="docMissingError(' Set your current Professional education details. ')";
        <?php }elseif ($is_current_yes_count>1) {?>
            onclick="docMissingError(' Set one current Professional education details. ')";
        <?php } else { ?>
            href="?pg=ExpD" 
        <?php } ?>
        class="btn btn-primary btn">Next</a>
      </span>
                    </div>
                </div>
            </div>
            <?php
        } else {
        }
        ?>
    </div>
</div>


<!--DEFINING MODALS--->
<!--Modal: View Documents-->
<div id="docuView" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Preview Document</h4>
            </div>
            <div class="modal-body">
                <div id="previewdocu-content">
                    <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--Module to add-->
<div id="addProf" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Professional Details:</h4>
            </div>
            <div class="modal-body">

                <div id="addProffesional-content">
                    <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--Module to Edit-->
<div id="editPro" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Professional Details:</h4>
            </div>
            <div class="modal-body">

                <div id="editProffesional-content">
                    <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Delete-->
<div id="deletePro" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Professional Details:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteProffesional-content">
                    <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function docMissingError(str) {
        alert('To proceed, please, ' + str);
    }
</script>