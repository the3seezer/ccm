<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$reg_id=$_POST['reg_id'];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">

     <p>Are you sure you want to delete this data</p>
     <br/><br/>
	 
     
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <button id="send" type="submit" name="deleteRegistration" class="btn btn-danger">Delete</button>
     <input type="hidden" name="reg_id" value="<?php echo $reg_id; ?>"/>
     </div>
    </div>

</form>

	 
	
	 
	 
	 
	 