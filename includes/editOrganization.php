<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$min_id=$_POST['min_id'];


$getF=$db->getOrganizationById($min_id);
$row=$getF->fetch();
$orgaName=$row['name'];
$regname=$row['RegName'];
$regid=$row['Reg_Id'];

$selectreg=$db->getAllRegionName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <!--Name-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Ministry/Organization Name<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12">
     <input id="orgName" class="form-control col-md-7 col-xs-12" name="orgName" value="<?php echo $orgaName; ?>" required="required" type="text">
     </div>
     </div>
	 
	 <!--Region-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Region<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12">
     <select id="gender" class="form-control col-md-7 col-xs-12" name="region" required="required">
     <option value="<?php echo $regid; ?>"><?php echo $regname; ?></option>
     <?php
	 while($row=$selectreg->fetch())
	 {
	 ?>
     <option value="<?php echo $row['Reg_Id']; ?>"><?php echo $row['RegName']; ?></option>
	 <?php
	 }
	 ?>
     </select>
     </div>
     </div>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="editOrganization" value="Save"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
	 <input type="hidden" name="min_id" value="<?php echo $min_id; ?>"/>
	 
     </div>
     </div>
     </form>	 