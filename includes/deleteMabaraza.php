<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

if(isset($_POST['id']))
{
$id=$_POST['id'];
$getF=$db->getMabarazaNameById($id);
$row=$getF->fetch();
$name=$row['name'];
$id=$row['id'];

$selectreg=$db->getAllMabarazaName();
}
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this information?</p>
	 <br/><br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="deleteMabaraza"  class="btn btn-danger" name="deleteMabaraza" value="Delete"/>
	 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
	 
     </div>
     </div>
     </form>	 