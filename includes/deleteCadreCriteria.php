<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$cc_id=$_POST['cc_id'];

//Get cadre by cadre_id
$getCadre=$db->getListofCadreCriteriaFromCCById($cc_id);
$row=$getCadre->fetch();
$criteria_id=$row['criteria_id'];
$credit=$row['credit'];
$criteriaName=$row['criteriaName'];
$cadre_id=$row['cadre_id'];

$sel1=$db->getListCriteria();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do yo want to delete this information?</p>
	 <br/><br/>
	 
	
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-danger" name="deleteCadreCriteria" 
	 value="Delete"/>
     <input type="hidden" name="cadre_id" value="<?php echo $cadre_id; ?>"/>
	 <input type="hidden" name="cc_id" value="<?php echo $cc_id; ?>"/>
     </div>
     </div>
     </form>	 