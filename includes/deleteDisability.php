<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

if(isset($_POST['disability_id']))
{
$disability_id=$_POST['disability_id'];
$getF=$db->getDisabilityNameById($disability_id);
$row=$getF->fetch();
$disabilityName=$row['disabilityName'];
$disability_id=$row['disability_id'];

$selectreg=$db->getAllDisabilityName();
}
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this information?</p>
	 <br/><br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="deleteDisability"  class="btn btn-danger" name="deleteDisability" value="Delete"/>
	 <input type="hidden" name="disability_id" value="<?php echo $disability_id; ?>"/>
	 
     </div>
     </div>
     </form>	 