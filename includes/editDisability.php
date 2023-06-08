<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();   
$disability_id=$_POST['disability_id'];

$getF=$db->getDisabilityNameById($disability_id);
$row=$getF->fetch();
$name=$row['disabilityName'];

// $selectreg=$db->getAllRASName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
     <!--Region Name-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">DISABILITY Name<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12">
     <input id="disabilityName" class="form-control col-md-7 col-xs-12" name="disabilityName" value="<?php echo $name; ?>" required="required" type="text">
     </div>
     </div>

     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="editDisability" value="Save"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
	<input type="hidden" name="disability_id" value="<?php echo $disability_id; ?>"/>
	 
     </div>
     </div>
     </form>	 