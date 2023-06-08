<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$facid=$_POST['facid'];


$getF=$db->getFacilityById($facid);
$row=$getF->fetch();
$facname=$row['facname'];
$disname=$row['DistrictName'];
$regname=$row['RegName'];
$regid=$row['Reg_Id'];
$disid=$row['District_Id'];

$selectreg=$db->getAllRegionName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this information?</p>
	 <br/> <br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-danger" name="deleteFacilityDetails" value="Delete"/>
	 <input type="hidden" name="facid" value="<?php echo $facid; ?>"/>
	 
     </div>
     </div>
     </form>	 