<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$wpc_id=$_POST['wpc_id'];


//Get cadre by cadre_id
$getF=$db->getWPCategorybyId($wpc_id);
$row=$getF->fetch();
$name=$row['name'];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this infromation?</p>
	 <br/> <br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-danger" name="deleteWPC" value="Delete"/>
	 <input type="hidden" name="wpc_id" value="<?php echo $wpc_id; ?>"/>
	 
     </div>
     </div>
     </form>	 