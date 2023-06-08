<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

if(isset($_POST['rrh_id']))
{
$rrh_id=$_POST['rrh_id'];
$getF=$db->getRRHNameById($rrh_id);
$row=$getF->fetch();
// print_r($row);exit;
$rrhname=$row['rrhName'];
$rrh_id=$row['id'];

// $selectreg=$db->getAllRRHName();
}
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this information?</p>
	 <br/><br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="deleteRRH"  class="btn btn-danger" name="deleteRRH" value="Delete"/>
	 <input type="hidden" name="rrh_id" value="<?php echo $rrh_id; ?>"/>
	 
     </div>
     </div>
     </form>	 