<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$disid=$_POST['disid'];


$getF=$db->getDistrictNameByDisId($disid);
$row=$getF->fetch();
$disname=$row['DistrictName'];
$regname=$row['RegName'];
$regid=$row['Reg_Id'];

$selectreg=$db->getAllRegionName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this information?</p>
	 <br/><br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-danger" name="deleteDistrict" value="Delete"/>
	 <input type="hidden" name="disid" value="<?php echo $disid; ?>"/>
	 
     </div>
     </div>
     </form>	 