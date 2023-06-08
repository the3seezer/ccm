<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

if(isset($_POST['member_id']))
{
$member_id=$_POST['member_id'];
$getF=$db->getMembersById($member_id);
$row=$getF->fetch();
$member_id=$row['member_id'];


}
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this information?</p>
	 <br/><br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="deleteUserEdited"  class="btn btn-danger" name="deleteUserEdited" value="Delete"/>
	 <input type="hidden" name="member_id" value="<?php echo $member_id; ?>"/>
	 
     </div>
     </div>
     </form>	 