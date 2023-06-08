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
 
 
     <!--Facility Name-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Facility Name<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12">
     <input id="category" class="form-control col-md-7 col-xs-12" name="category" value="<?php echo $name; ?>" required="required" type="text">
     </div>
     </div>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="editWPC" value="Save"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
	 <input type="hidden" name="wpc_id" value="<?php echo $wpc_id; ?>"/>
	 
     </div>
     </div>
     </form>	 