<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$prof_id = $_POST['prof_id'];
$applicant_id = $_POST['applicant'];


$query1 = $db->getnationalList();

$getAp = $db->getProfessionalByProfId($prof_id);
$row = $getAp->fetch();
$level = $row['level'];
?>

<form action="includes/process.php" method="post" class="form-horizontal form-label-left">

    <p>Do you want to delete this information?</p>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button id="send" type="submit" name="deleteProfessional" class="btn btn-danger">Delete</button>
            <input type="hidden" name="prof_id" value="<?php echo $prof_id; ?>"/>
            <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
        </div>
    </div>

</form>

	 
	
	 
	 
	 
	 