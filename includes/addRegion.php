<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$userID=$_POST['userID'];

//$selectreg=$db->getAllRegionName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
      
	 <!--Category-->
     <div class="item form-group">
     <label class="control-label col-md-2 col-sm-2 col-xs-12">Region Name<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="region" class="form-control col-md-7 col-xs-12"  name="region"  required type="text">
     </select>
     </div>
     </div>

     
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="addNewRegion" value="Submit"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
     <input type="hidden" name="userID" value="<?php echo $userID; ?>"/>
	 
     </div>
     </div>
</form>
	 
	 
	 
	 
	 
	 
	 