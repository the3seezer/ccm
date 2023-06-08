<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$regid=$_POST['regid'];


//Get cadre by cadre_id
$getF=$db->getRegionName($regid);
$row=$getF->fetch();
$name=$row['RegName'];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this information?</p>
	 <br/><br/>
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-danger" name="deleteRegion" value="Delete"/>

	 <input type="hidden" name="regid" value="<?php echo $regid; ?>"/>
	 
     </div>
     </div>
     </form>	 