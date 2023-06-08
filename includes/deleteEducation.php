<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$edu_id = $_POST['edu_id'];
$doc_id = $_POST['doc_id'];
$applicant = $_POST['applicant'];
?>

<form action="includes/process.php" method="post" class="form-horizontal form-label-left">

    <p>Do you want to delete this education details?</p>
    <br/><br/>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button id="delete" type="submit" name="deleteEducation" class="btn btn-danger">Delete</button>
            <input type="hidden" name="edu_id" value="<?=$edu_id; ?>"/>
            <input type="hidden" name="doc_id" value="<?=$doc_id; ?>"/>
            <input type="hidden" name="applicant" value="<?=$applicant; ?>"/>
        </div>
    </div>
</form>

	 
	
	 
	 
	 
	 