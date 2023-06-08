<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$applicant_id = $_POST['applicant_id'];


$query1 = $db->getnationalList();

$getAp = $db->getApplicantsById($applicant_id);
$row = $getAp->fetch();
$dob = $row['dob'];
$dobG = explode("-", $dob);
$year = $dobG[0];
$month = $dobG[1];
$day = $dobG[2];

//Check if O-Level is added
$olevel = $db->checkIfLevelExit($applicant_id);
$rw = $olevel->fetch();
$level = $rw['level'];
?>

<form enctype="multipart/form-data" action="includes/process.php" method="post" class="form-horizontal form-label-left">

    <!--Education Level-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Education Level <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="eduLevel" class="form-control col-md-7 col-xs-12" name="eduLevel" required="required">
                <?php
                if ($level == "") {
                    ?>
                    <option>O-Level</option>
                    <?php
                } elseif ($level == "O-Level") {
                    ?>
                    <option>A-Level</option>
                    <?php
                } else {
                }
                ?>
            </select>
        </div>
    </div>


    <!--School Name-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">School Name<span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="school" class="form-control col-md-7 col-xs-12" name="school" required type="text">
        </div>
    </div>


    <!--Index Number-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">
            <?php
            if ($level == "") {
                ?>
                Form Four
                <?php
            } elseif ($level == "O-Level") {
                ?>
                Form Six
                <?php
            } else {
            }
            ?>
            Index Number
            <span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="indexNo" class="form-control col-md-7 col-xs-12" name="indexNo"
                   placeholder="Required Format:  S0000/0000/0000" required type="text">
        </div>
    </div>

    <div class="item form-group" id="errorShow" style="display:none;">
        <label class="col-sm-2 control-label"></label>

        <div class="col-sm-10">
            <label class="col-sm-12 error" style="color:red"></label>
        </div>
    </div>

    <!--Division Awarded-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Division or Merit System<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="gender" class="form-control col-md-7 col-xs-12" name="division" required="required"
                    onchange="loadDivision(this.value)">
                <option value="">--Select--</option>
                <option value="Division">Division system</option>
                <option value="Merit">Merit System</option>
            </select>
        </div>
    </div>

    <!--Division Awarded-->
    <div id="division" style="display: none;">
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Division Awarded<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="gender" class="form-control col-md-7 col-xs-12" name="division">
                    <option value="">--Select--</option>
                    <option>I</option>
                    <option>II</option>
                    <option>III</option>
                    <option>IV</option>
                </select>
            </div>
        </div>
    </div>

    <!--merit Awarded-->
    <div id="merit" style="display: none;">
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Merit Awarded<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="gender" class="form-control col-md-7 col-xs-12" name="merit">
                    <option value="">--Select--</option>
                    <option>Distiction</option>
                    <option>Pass</option>
                    <option>Merit</option>
                    <option>Fail</option>
                </select>
            </div>
        </div>
    </div>

    <!--Completion Year-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Completion Year<span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" id="year" name="year" required>
                <option value="">--Select--</option>
                <option><?php echo date('Y'); ?></option>
                <?php $i = 1;
                for ($i = 1; $i <= 100; $i++) { ?>
                    <option><?php echo date('Y') - $i; ?></option><?php } ?>
            </select>
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">
            <?php if ($level == "O-Level") {
                echo 'A-Level';
            } else {
                echo 'O-Level';
            } ?>
            Certificate <span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">

            <input type="file" class="form-control" name="certificate" accept=".pdf, application/pdf" required/>
            <br><small class="text-center text-danger">Only PDF file with max size of 1024KB/1MB allowed </small>
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button id="send" type="submit" name="AddEducation" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-default">Clear</button>
            <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
        </div>
    </div>
</form>

<script type="text/javascript">
    function loadDivision(str) {
        // alert(str);
        if (str == "Division") {
            // $("#countrytz".show();
            $("#division").show();
            // alert("hello");
        } else {

            $("#division").hide();

        }

        if (str == "Merit") {
            $("#merit").show();
        } else {

            $("#merit").hide();
        }

    }
</script>
			 
			 
			 
			

	 
	
	 
	 
	 
	 