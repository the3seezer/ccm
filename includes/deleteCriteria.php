<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$criteriaid=$_POST['criteriaid'];


$getF=$db->getCriteriaById($criteriaid);
$row=$getF->fetch();
$criteriaName=$row['criteriaName'];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
      <p>Do you want to delete this information?</p>
	 <br/> <br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-danger" name="deleteCriteria" value="Delete"/>
     
	 <input type="hidden" name="criteriaid" value="<?php echo $criteriaid; ?>"/>
	 
     </div>
     </div>
     </form>	 