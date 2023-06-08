<?php 
 include "../lib/dbconnect.php";
 $db = new dbClass();
 $db->connect();
 
 $applicant_id=$_POST['applicant_id'];

?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">

 <p>Do you want to delete this information? </p>

<div class="ln_solid"></div>
<div class="form-group">
<div class="col-md-6 col-md-offset-3">
<input type="submit"  id="send"  class="btn btn-danger" name="deleteApplicants" value="Delete"/>
<input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>" />
</div>
</div>
</form>