<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$prof_id = $_POST['prof_id'];


$query1 = $db->getnationalList();

$getAp = $db->getProfessionalByProfId($prof_id);
$row = $getAp->fetch();
$level = $row['level'];
$location = $row['location'];
$INSID = $row['college'];
$PID = $row['programme_id'];
$college_out = $row['college_out'];
$programme = $row['programme'];
$year = $row['year'];
$status = $row['status'];
$applicant_id = $row['applicant_id'];
$current = $row['is_current'];


if ($level == "NTA4") {
    $level1 = "Basic Certificate(NTA Level 4)";
} elseif ($level == "NTA5") {
    $level1 = "Full Certificate (NTA Level 5)";
} elseif ($level == "NTA6") {
    $level1 = "Ordinary Diploma (NTA Level 6)";
} elseif ($level == "NTA7") {
    $level1 = "Advanced Diploma (NTA Level 7)";
} elseif ($level == "NTA8") {
    $level1 = "Bachelor (NTA Level 8)";
} elseif ($level == "NTA9") {
    $level1 = "Master (NTA Level 9)";
} elseif ($level == "NTA10") {
    $level1 = "PhD (NTA Level 10)";
} else {
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
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Education Level<span
                                class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="level" class="form-control col-md-7 col-xs-12" name="level" required="required">
                            <option value="<?php echo $level; ?>"><?php echo $level1; ?></option>
                            <option value="NTA4">Basic Certificate(NTA Level 4)</option>
                            <option value="NTA5">Full Certificate (NTA Level 5)</option>
                            <option value="NTA6">Ordinary Diploma (NTA Level 6)</option>
                            <option value="NTA7">Advanced Diploma (NTA Level 7)</option>
                            <option value="NTA8">Bachelor (NTA Level 8)</option>
                            <option value="NTA9">Master (NTA Level 9)</option>
                            <option value="NTA10">PhD (NTA Level 10)</option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Study Country<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="location" class="form-control col-md-7 col-xs-12" name="location" required="required"
                                onchange="fetchInstitution(this.value)">
                            <option value="<?php echo $location; ?>"><?php echo $location; ?></option>
                            <?php
                            while ($row = $query1->fetch()) {
                                echo '<option  value ="' . $row['value'] . '">' . $row['value'] . '</option><br>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div id="institutionList">

                    <?php
                    if ($location == 'Tanzania, United Rep') {
                        $institutions = $db->getInstitution();
                        $programs = $db->getInstitutionProgram($INSID)
                        ?>
                        <!--College of Study-->
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">College of Study<span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <select id="college" class="form-control col-md-7 col-xs-12" name="college" required="required"
                                        onchange="loadProgrammeByInstId(this.value)">
                                    <option value="">--Select Institution--</option>
                                    <?php while ($value = $institutions->fetch()) { ?>
                                        <option value="<?php echo $value["id"]; ?>"  <?php echo $value["InstitutionName"]==$iName ? "selected" : "" ?>>
                                            <?php echo $value["InstitutionName"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>

                        <!--Programme Name-->
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Programme Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="programme" class="form-control col-md-7 col-xs-12"
                                        name="progName" required="required" >
                                    <option value="">--Select Programme--</option>
                                    <?php while ($value = $programs->fetch()) { ?>
                                        <option value="<?php echo $value["id"]; ?>" <?php echo $value['name']==$progName ? "selected": ""  ?> >
                                            <?php echo $value["name"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <!--College of Study-->
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">College of Study<span
                                        class="required">*</span> </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="college" class="form-control col-md-7 col-xs-12" name="college"
                                       value="<?php echo $iName; ?>" required="required" type="text">
                            </div>
                        </div>


                        <!--Programme Name-->
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Programme Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="progName" class="form-control col-md-7 col-xs-12" name="progName"
                                       value="<?php echo $progName; ?>" required="required" type="text">
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Completed Year<span
                                class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="end" class="form-control col-md-7 col-xs-12" name="end" value="<?php echo $year; ?>"
                               required="required" type="text">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Is this your Current Education <span
                                class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="is_current" class="form-control col-md-7 col-xs-12" name="is_current" required="required">
                            <option value="<?php echo $current; ?>"><?php echo $current; ?></option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="docs">
                <br>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        Certificate <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <input type="file" class="form-control" name="certificate" accept=".pdf, application/pdf "/>
                        <br><small class="text-center text-danger">Only PDF file with max size of 1024KB/1MB allowed </small>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        Transcript <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <input type="file" class="form-control" name="transcript" accept=".pdf, application/pdf"/>
                        <br><small class="text-center text-danger">Only PDF file with max size of 1024KB/1MB allowed </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button id="send" type="submit" name="editProfessional" class="btn btn-success">Update</button>
            <button type="reset" class="btn btn-default">Clear</button>
            <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
            <input type="hidden" name="prof_id" value="<?php echo $prof_id; ?>"/>
        </div>
    </div>

</form>






