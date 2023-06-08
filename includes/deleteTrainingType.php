<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

if(isset($_POST['trainingtype_id']))
{
$trainingtype_id=$_POST['trainingtype_id'];
$getF=$db->getTrainigTypeById($trainingtype_id);
$row=$getF->fetch();
$trainingtypeName=$row['trainingtypeName'];
$trainingtype_id=$row['trainingtype_id'];

$selectreg=$db->getAllTrainingType();
}
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this information?</p>
	 <br/><br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="deleteTrainingType"  class="btn btn-danger" name="deleteTrainingType" value="Delete"/>
	 <input type="hidden" name="trainingtype_id" value="<?php echo $trainingtype_id; ?>"/>
	 
     </div>
     </div>
     </form>	 