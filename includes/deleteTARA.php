<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

if(isset($_POST['ras_id']))
{
$ras_id=$_POST['ras_id'];
$getF=$db->getRASNameById($ras_id);
$row=$getF->fetch();
$rasname=$row['rasName'];
$ras_id=$row['ras_id'];

$selectreg=$db->getAllRASName();
}
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this information?</p>
	 <br/><br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="deleteTARA"  class="btn btn-danger" name="deleteTARA" value="Delete"/>
	 <input type="hidden" name="ras_id" value="<?php echo $ras_id; ?>"/>
	 
     </div>
     </div>
     </form>	 