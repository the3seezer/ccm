<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$edu_id = $_POST['edu_id'];

$query1 = $db->getnationalList();

$getAp = $db->getEducationById($edu_id);
$row = $getAp->fetch();
$level = $row['level'];
$school = $row['school'];
$indexNo = $row['indexNo'];
$year = $row['year'];
$division = $row['division'];
$merit = $row['merit'];
$applicant_id = $row['applicant_id'];


?>

<form action="includes/process.php" method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">

    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#information" aria-controls="information" role="tab"
                                                      data-toggle="tab">Information</a></li>
            <li role="presentation"><a href="#docs" aria-controls="docs" role="tab" data-toggle="tab">Documents</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="information">
                <br>
                <!--Education Level-->
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Education Level <span
                                class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="eduLevel" class="form-control col-md-7 col-xs-12" name="eduLevel"
                                required="required">
                            <option><?php echo $level; ?></option>
                        </select>
                    </div>
                </div>
                <!--School of Study-->
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">School Name<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="school" class="form-control col-md-7 col-xs-12" name="school"
                               value="<?php echo $school; ?>"
                               required type="text">
                    </div>
                </div>
                <!--Index Number-->
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        Index Number
                        <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="indexNo" class="form-control col-md-7 col-xs-12" name="indexNo"
                               value="<?php echo $indexNo; ?>"
                               required type="text">
                    </div>
                </div>

                <?php
                if($merit == 'none'){
                ?>
                <!--Division Awarded-->
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Division Awarded<span
                                class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="gender" class="form-control col-md-7 col-xs-12" name="division">
                            <option><?php echo $division; ?></option>
                            <option>I</option>
                            <option>II</option>
                            <option>III</option>
                            <option>IV</option>
                            <option>0</option>
                        </select>
                    </div>
                </div>
            <?php } else { ?>

            <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Merit Awarded<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="gender" class="form-control col-md-7 col-xs-12" name="merit">
                    <option value=""><?php echo $merit;?></option>
                    <option>Distiction</option>
                    <option>Pass</option>
                    <option>Merit</option>
                    <option>Fail</option>
                </select>
            </div>
        </div>
           <?php }?>
                <!--Completed Year-->
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Completion Year<span
                                class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="year" name="year" required>
                            <option><?php echo $year; ?></option>
                            <option><?php echo date('Y'); ?></option>
                            <?php $i = 1;
                            for ($i = 1; $i <= 100; $i++) { ?>
                                <option><?php echo date('Y') - $i; ?></option><?php } ?>
                        </select>
                    </div>

                </div>

            </div>
            <div role="tabpanel" class="tab-pane" id="docs">
                <br>
                <div class="text-center">
                    <?php
                    //get cetificate type
                    $query = $db->getDocType($level);
                    $data = $query->fetch();
                    $document_id = $data['DocumentID'];
                    $file = $db->checkIfFileExist($document_id, $applicant_id);

                    $certificate = $file->fetch();
                    $certificate_id = $certificate['id'];
                    ?>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            <?php if ($level == "O-Level") {
                                echo 'O-Level';
                            } else {
                                echo 'A-Level';
                            } ?>
                            Certificate <span class="required">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" class="form-control" name="certificate" accept=".pdf, application/pdf" />
                            <br><small class="text-center text-danger">Only PDF file with max size of 1024KB/1MB
                                allowed </small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button id="send" type="submit" name="editEducation" class="btn btn-success">Save</button>
            <button type="reset" class="btn btn-default">Clear</button>
            <input type="hidden" name="edu_id" value="<?php echo $edu_id; ?>"/>
            <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
        </div>
    </div>

</form>

	 
	
	 
	 
	 
	 