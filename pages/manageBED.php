<?php
$applicant_id = $_SESSION['applicant_id'];

$getAp = $db->getEducationByAppId($applicant_id);

//Check if A-Level is added
$olevel = $db->checkIfLevelExit($applicant_id, 'A-Level');
$rw = $olevel->fetch();
$currentLevel = $rw['level'];
?>

<div class="row">
    <div class="col-lg-12"><h2 class="page-header">Education Details</h2></div>
</div>

<div class="row">

    <div class="col-lg-12">
        <!--If there is education details, show this panel-->
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
                    <p>Personal Details missing!. Make sure you have uploaded <b>Passport size photograph</b> before
                        proceeding with this section</p>
                </div>
            </div>
        <?php } if ($checkCertificate->rowCount() <= 0) { ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Personal Details missing!. Make sure you have uploaded <b>Certificate of Birth</b> before
                        proceeding with this section</p>
                </div>
            </div>
            <?php
        }
        if ($getAp->rowCount() < 1)
        {
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">Enter your education details by clicking on add new button below!</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr bgcolor="">
                            <th colspan="6">
                                <?php
                                if ($currentLevel != 'A-Level') {
                                    ?>
                                    <span style="float:right;"><a href="#addEdu" class="btn btn-primary btn-xs"
                                                                  data-toggle="modal"
                                                                  data-id="<?php echo $applicant_id; ?>" id="getaddEdu"><i
                                                    class="fa fa-plus"></i>Add New</a></span>
                                <?php } ?>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <?php
            }
            else {
                ?>
                <div class="panel panel-success">
                <div class="panel-heading">
                <?php
                if ($currentLevel != 'A-Level') {
                    ?>
                    <p align="center">You have Submitted the following Education details. If you have completed form
                        six, click on add new button to add form six education details. But if you don't have form six
                        click on next button to proceed with professional details.</p></div>
                <?php } else {
                    ?>
                    <p align="center">You have Submitted the following Education details. Click "next" button to proceed
                        with professional details.</p></div>
                <?php } ?>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr bgcolor="">
                                <th colspan="7">

                                    <?php if ($currentLevel != 'A-Level') { ?>
                                        <span style="float:right;"><a href="#addEdu" class="btn btn-primary btn-xs"
                                                                      data-toggle="modal"
                                                                      data-id="<?php echo $applicant_id; ?>"
                                                                      id="getaddEdu"><i
                                                        class="fa fa-plus"></i>Add New</a></span>
                                    <?php } ?>
                                </th>

                            </tr>

                            <tr bgcolor="">
                                <th>Education Level</th>
                                <th>School of Study</th>
                                <th>Index Number</th>
                                <th>Completed Year</th>
                                <th>Division/Merit</th>
                                <th>Document</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php while ($row = $getAp->fetch()) { ?>

                                <tr>
                                    <td><?php echo $row['level']; ?></td>
                                    <td><?php echo stripslashes($row['school']); ?></td>
                                    <td><?php echo $row['indexNo']; ?></td>
                                    <td><?php echo $row['year']; ?></td>
                                    <td><?php
                                        if ($row['division'] == "none") {
                                            echo $row['merit'];
                                        } else {
                                            echo $row['division'];
                                        }
                                        ?></td>
                                    <?php
                                    //get cetificate type
                                    $elevel = $row['level'];

                                    $getDoc = $db->getDocType($elevel);
                                    $doc = $getDoc->fetch();
                                    $document_id = $doc['DocumentID'];

                                    //Check if file uploaded
                                    $checkDoc = $db->checkIfFileExist($document_id, $applicant_id);

                                    if ($checkDoc->rowCount() > 0) {
                                        $bcertificate = $checkDoc->fetch();
                                        $doc_id = $bcertificate['id'];
                                        ?>
                                        <td><a href="#docuView" class="btn btn-info btn-xs" data-toggle="modal"
                                               data-docid="<?php echo $doc_id; ?>" id="viewDocu"><i
                                                        class="fa fa-folder"></i>View </a>
                                        </td>
                                    <?php } else { ?>
                                        <td> Not Uploaded</td>
                                    <?php } ?>

                                    <td align="left">
                                        <a href="#editEdu" class="btn btn-primary btn-xs" data-toggle="modal"
                                           data-id="<?=$row['edu_id']; ?>"
                                           data-applicant="<?=$applicant_id; ?>"
                                           id="geteditEdu"><i class="fa fa-edit"></i>Edit</a>
                                    </td>

                                    <td align="left"><a href="#deleteEdu" class="btn btn-danger btn-xs"
                                                        data-toggle="modal"
                                                        data-id="<?= $row['edu_id']; ?>"
                                                        data-document="<?= $document_id; ?>"
                                                        data-applicant="<?= $applicant_id; ?>"
                                                        id="getdeleteEdu"><i class="fa fa-trash"></i>Delete</a>
                                    </td>
                                </tr>

                            <?php } ?>


                            </tbody>
                        </table>
                        <hr/>
                        <br/>

                        <span style="float:right;"><a
      <?php if ($currentLevel == 'A-Level') { ?>
          href="?pg=proD"
      <?php } else { ?>
          onclick='
          if(confirm("Are you sure you want to proceed without adding A-Level education details?")){
            location.href="?pg=proD";
            }
        '
      <?php } ?>
      class="btn btn-primary btn"> Next</a></span>

                    </div>
                </div>
            <?php } ?>
        </div>
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

<!--Module to add Education-->
<div id="addEdu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Education Details:</h4>
            </div>
            <div class="modal-body">

                <div id="addEdu-content">
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
<div id="editEdu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Education Details:</h4>
            </div>
            <div class="modal-body">

                <div id="editEdu-content">
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
<div id="deleteEdu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Details:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteEdu-content">
                    <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


