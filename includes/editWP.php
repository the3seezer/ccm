<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$fac_id=$_POST['fac_id'];


//Get cadre by cadre_id
$getF=$db->getfacilityByfacid($fac_id);
$row=$getF->fetch();
$facname=$row['facname'];
$regid=$row['reg_id'];
$disid=$row['dis_id'];
$startdate=$row['startdate'];
$enddate=$row['enddate'];
$status=$row['status'];

//Get District Name
$getD=$db->getDistrictNameByDisId($disid);
$rwD=$getD->fetch();
$disName=$rwD['DistrictName'];
					  
//Get RegName
$getR=$db->getRegionName($regid);
$rwR=$getR->fetch();
$regName=$rwR['RegName'];


$selectreg=$db->getAllRegionName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <!--Facility Name-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Facility Name<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12">
     <input id="facname" class="form-control col-md-7 col-xs-12" name="facname" value="<?php echo $facname; ?>" required="required" type="text">
     </div>
     </div>
	 
	 <!--Region-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Region<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12">
     <select id="gender" class="form-control col-md-7 col-xs-12" name="region" required="required" onchange="loadDistrictList(this.value)">
     <option value="<?php echo $regid; ?>"><?php echo $regName; ?></option>
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
   
     <!--District-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">District<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12" id="districtList">
     <select id="district" class="form-control col-md-7 col-xs-12" name="district" required="required">
     <option value="<?php echo $disid; ?>"><?php echo $disName; ?></option>
     </select>
     </div>
     </div>
	 
	 
	 <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date<span class="required">*</span></label>
	 <div class="col-md-5 col-sm-5 col-xs-12">
     <input  class="form-control col-md-7 col-xs-12" name="startdate" required="required" type="text" value="<?php echo $startdate; ?>">
     </div>
	 </div>
	 
	 
	 <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date<span class="required">*</span></label>
	 <div class="col-md-5 col-sm-5 col-xs-12">
     <input  class="form-control col-md-7 col-xs-12" name="enddate" required="required" type="text" value="<?php echo $enddate; ?>">
     </div>
	 </div>
	 
	 <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span></label>
	 <div class="col-md-5 col-sm-5 col-xs-12">
     <select id="status" class="form-control col-md-7 col-xs-12" name="status" required="required">
     <option><?php echo $status; ?></option>
     <option value="Active">Active</option>
     <option value="Passive">Passive</option>
     </select>
     </div>
	 </div>
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="editFacility" value="Save"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
	 <input type="hidden" name="fac_id" value="<?php echo $fac_id; ?>"/>
	 
     </div>
     </div>
     </form>	 