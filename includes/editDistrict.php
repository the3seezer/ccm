<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$disid=$_POST['disid'];


$getF=$db->getDistrictNameByDisId($disid);
$row=$getF->fetch();
$disname=$row['DistrictName'];
$regname=$row['RegName'];
$regid=$row['Reg_Id'];

$selectreg=$db->getAllRegionName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <!--Region Name-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Council Name<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12">
     <input id="disName" class="form-control col-md-7 col-xs-12" name="disName" value="<?php echo $disname; ?>" required="required" type="text">
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
     <input type="submit"  id="send"  class="btn btn-success" name="editDistrict" value="Save"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
	 <input type="hidden" name="disid" value="<?php echo $disid; ?>"/>
	 
     </div>
     </div>
     </form>	 