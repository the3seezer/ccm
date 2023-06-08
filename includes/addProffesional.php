<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$applicant_id = $_POST['applicant_id'];


$query1 = $db->getnationalList();

$getAp = $db->getApplicantsById($applicant_id);
$row = $getAp->fetch();

?>

<form enctype="multipart/form-data" action="includes/process.php" method="post" class="form-horizontal form-label-left">

    <!--Education Level-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Education Level<span
                    class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="level" class="form-control col-md-7 col-xs-12" name="level" required="required">
                <option value="">--Select--</option>
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


    <!--Study Country-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Study Country<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="location" class="form-control col-md-7 col-xs-12" name="location" required="required"
                    onchange="fetchInstitution(this.value)">
                <option value="">--Select--</option>
                <?php
                while ($row = $query1->fetch()) {
                    echo '<option  value ="' . $row['value'] . '">' . $row['value'] . '</option><br>';
                }
                ?>
            </select>
        </div>
    </div>

    <div id="institutionList"></div>


    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Completed Academic Year<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="end" class="form-control col-md-7 col-xs-12" placeholder="E.g 2011/2012" name="end"
                   required="required" type="text">
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Is this your Current Education <span
                    class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="is_current" class="form-control col-md-7 col-xs-12" name="is_current" required="required">
                <option value="Yes">Yes</option>
                <option value="No" selected>No</option>
            </select>
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">
            Certificate <span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">

            <input type="file" class="form-control" name="certificate" accept=".pdf, application/pdf " required/>
            <br><small class="text-center text-danger">Only PDF file with max size of 1024KB/1MB allowed </small>
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">
            Transcript <span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">

            <input type="file" class="form-control" name="transcript" accept=".pdf, application/pdf " required/>
            <br><small class="text-center text-danger">Only PDF file with max size of 1024KB/1MB allowed </small>
        </div>
    </div>


    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button id="send" type="submit" name="AddProfessional" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-default">Clear</button>
            <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
        </div>
    </div>

</form>

	 
	
	 
	 
	 
	 