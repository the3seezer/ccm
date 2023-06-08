<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$exp_id=$_POST['exp_id'];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
     <p>Do you want to delete this information?</p>
	 <br/><br/>
     
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <button id="send" type="submit" name="deleteExperience" class="btn btn-danger">Delete</button>

     <input type="hidden" name="exp_id" value="<?php echo $exp_id; ?>"/>
     </div>
    </div>

</form>

	 
	
	 
	 
	 
	 