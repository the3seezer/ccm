<?php
$applicant_id = $_SESSION['applicant_id'];

$getBE = $db->getEducationByAppId($applicant_id);

$getProf = $db->getProfessionalByAppId($applicant_id);

$getExp = $db->getExperienceByAppId($applicant_id);

$getDoc = $db->getDocuments($applicant_id);

$querry = $db->selectDocumentTypes();

$getAp = $db->getApplicantsById($applicant_id);
$rowAp = $getAp->fetch();
$selDoc = $db->getCarderDocuments($rowAp['cadreType']);


//$getReg=$db->getRegistrationByAppId($applicant_id);
//$getG=$db->getGraduatesByAppId($applicant_id); 
?>

<div class="row">
    <div class="col-lg-12"><h2 class="page-header">Document Details</h2></div>
</div>

<div class="row">

    <div class="col-lg-12">
        <!--#If No basic education details-->
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
        <?php } elseif ($checkCertificate->rowCount() <= 0) { ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Personal Details missing!. Make sure you have uploaded <b>Certificate of Birth</b> before
                        proceeding with this section</p>
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
        } elseif ($getProf->rowCount() < 1)//#If No Professional Details -->
        {
            ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Make sure that you enter your professional details before proceeding with this section</p>
                </div>
            </div>
            <?php
        } /*
	 elseif($getExp->rowCount()<1)//#If No Experience Details -->
	 {
	 ?>
	 <div class="panel panel-danger">
      <div class="panel-heading">Error!</div>
      <div class="panel-body">	  
	  <p>Make sure that you enter your graduate details before proceeding with this section</p>
	  </div>
     </div> 
	 <?php
	 }
	 */
        elseif ($getBE->rowCount() > 0 AND $getProf->rowCount() > 0 AND $getDoc->rowCount() < 1) {
            ?>
            <div class="panel panel-primary">
                <div class="panel-heading">Enter your Document details below by clicking on add new button.</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr bgcolor="">
                                <th colspan="6">

                                    <span style="float:right;"><a href="#addDoc" class="btn btn-primary btn-xs"
                                                                  data-toggle="modal"
                                                                  data-id="<?php echo $applicant_id; ?>" id="getaddDoc"><i
                                                    class="fa fa-plus"></i>Add New</a></span>
                                </th>

                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        } elseif ($getDoc->rowCount() > 0)//<!--#If there is document-->
        {
            ?>
            <div class="panel panel-success">
                <div class="panel-heading"><p align="center">
                        You have Submitted the following document details. Click on add new button to add new document
                        or click on next button to proceed with the next step.
                    <p>
                </div>
                <div class="panel-body">

                    <div class="col-md-4">
                        <!-- <br><br> -->
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th colspan="2">Required Documents</th>
                            </tr>
                            </thead>

                            <?php
                            $selDc = $db->getAllDocuments('Mandatory');
                            while ($dc = $selDc->fetch()) {
                                $documentID = $dc['DocumentID'];
                                $checkPass = $db->checkIfFileExist($documentID, $applicant_id);
                                if ($checkPass->rowCount() > 0) {
                                    $fa = 'fa fa-check';
                                } else {
                                    $fa = 'fa fa-times';
                                }
                                // attachmentFor
                                if ($dc['attachmentFor'] == 'A-Level') {
                                    $type = $dc['type'] . ' - if studied A-level';
                                } else {
                                    $type = $dc['type'];
                                }
                                ?>
                                <tr>
                                    <td width="1%"><i class="text-success <?= $fa ?>"></i></td>
                                    <td><?= $dc['DocumentType'] . ' <b>(' . $type . ') </b>'; ?></td>
                                </tr>
                            <?php }
                            $required = 0;
                            while ($rwDoc = $selDoc->fetch()) {
                                $documentID = $rwDoc['DocumentID'];
                                $checkPass = $db->checkIfFileExist($documentID, $applicant_id);
                                if ($checkPass->rowCount() > 0) {
                                    $fa = 'text-success fa fa-check';
                                    $text = '';
                                } else {
                                    $fa = 'text-danger fa fa-times';
                                    if ($rwDoc['type'] == 'Required') {
                                        $required += 1;
                                        $text = ' class="text-danger"';
                                    } else {
                                        $text = '';
                                    }
                                }

                                ?>

                                <tr>
                                    <td width="1%"><i class="<?= $fa ?>"></i></td>
                                    <td <?= $text ?>><?= $rwDoc['DocumentType'] . ' <b>(' . $rwDoc['type'] . ') </b>'; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>

                    <div class="table-responsive col-md-8">
                        <table class="table table-bordered">
                            <thead>
                            <tr bgcolor="">
                                <th colspan="6">

                                    <span style="float:right;"><a href="#addDoc" class="btn btn-success btn-xs"
                                                                  data-toggle="modal"
                                                                  data-id="<?php echo $applicant_id; ?>" id="getaddDoc"><i
                                                    class="fa fa-plus"></i>Add New</a></span>
                                </th>

                            </tr>

                            <tr bgcolor="">
                                <th>Uploaded Document Types</th>
                                <th width="5%">View</th>
                                <th width="5%">Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php while ($rowDoc = $getDoc->fetch()) {

                                $doc_id = $rowDoc['id'];
                                $doc_name = $rowDoc['document_id'];
                                $extension = $rowDoc['extension'];

                                $quD = $db->getDocumentName($doc_name);
                                $rwN2 = $quD->fetch();
                                $docName = $rwN2['DocumentType'];
                                ?>

                                <tr>
                                    <td><?php echo $docName; ?></td>

                                    <td><a href="#docuView" class="btn btn-info btn-xs" data-toggle="modal"
                                           data-docid="<?php echo $doc_id; ?>" id="viewDocu"><i
                                                    class="fa fa-folder"></i>View </a>
                                    </td>

                                    <td><a href="#docuDele" class="btn btn-danger btn-xs" data-toggle="modal"
                                           data-docid1="<?php echo $doc_id; ?>" id="deleDoc"><i
                                                    class="fa fa-trash-o"></i> Delete </a>
                                    </td>

                                </tr>

                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
	   		<span style="float:right;"><a 
			<?php if ($required > 0) { ?>
                onclick="docMissingError('Please upload all the required documents.')";
            <?php } else { ?>
                href="?pg=mngapp"
            <?php } ?>
				 title="Go to application" class="btn btn-primary btn">Next</a></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<!--DEFINING MODALS--->
<!--Add new document modal -->
<div id="addDoc" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Upload your Documents</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="includes/uploadFiles.php" method="POST">
                    <table width="100%" align="center">
                        <tr>
                            <td width="20%"><strong>Document Type</strong></td>
                            <td>
                                <select class="form-control col-md-7 col-xs-12" name="docuType">
                                    <option value="">--Select--</option>
                                    <?php
                                    $selDoc = $db->getCarderDocuments($rowAp['cadreType']);
                                    while ($rw1 = $selDoc->fetch()) {
                                        ?>
                                        <option value="<?php echo $rw1['DocumentID']; ?>"><?= $rw1['DocumentType']; ?>
                                            (<?= $rw1['type']; ?>)
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Document File</strong></td>
                            <td>
                                <input id="file-11" type="file" name="photo" multiple class="file"
                                       data-overwrite-initial="false" data-min-file-count="1">
                                <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


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


<!--Modal3: Delete Docuement Details -->
<div id="docuDele" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Cornfirm dialog:</h4>
            </div>
            <div class="modal-body">
                <div id="deleteDocument-content">
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
        alert('To proceed, ' + str);
    }
</script>