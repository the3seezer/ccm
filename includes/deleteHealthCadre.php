<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$cadreid=$_POST['cadreid'];


$getF=$db->getHealthCadresById($cadreid);
$row=$getF->fetch();
$cadreName=$row['cadreName'];
$level=$row['level'];
$trainType=$row['trainType'];

if($level=='NTA4')
{
	$level1="Basic Certificate (NTA Level 4)";
}
elseif($level=='NTA5')
{
	$level1="Full Certificate (NTA Level 5)";
}
elseif($level=='NTA6')
{
	$level1="Ordinary Diploma (NTA Level 6)";
}
elseif($level=='NTA7')
{
	$level1="Advanced Diploma (NTA Level 7)";
}
elseif($level=='NTA8')
{
	$level1="Bachelor (NTA Level 8)";
}
elseif($level=='NTA9')
{
	$level1="Master (NTA Level 9)";
}
elseif($level=='NTA10')
{
	$level1="PhD (NTA Level 10)";
}


else{}
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <p>Do you want to delete this information?</p>
	 <br/> <br/>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-danger" name="deleteHealthCadre" value="Delete"/>
	 <input type="hidden" name="cadreid" value="<?php echo $cadreid; ?>"/>
	 
     </div>
     </div>
     </form>	 