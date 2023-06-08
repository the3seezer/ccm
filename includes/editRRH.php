<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();   
$rrh_id=$_POST['rrh_id'];

$getF=$db->getRRHNameById($rrh_id);
$row=$getF->fetch();
$name=$row['rrhName'];
$level=$row['level'];
$region_id = $row['region_id'];

// $selectreg=$db->getAllRASName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
     <!--Region Name-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Hospital Name<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12">
     <input id="rrhName" class="form-control col-md-7 col-xs-12" name="rrhName" value="<?php echo strtoupper($name); ?>" required="required" type="text">
     </div>
     </div>

     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Level<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12">
          <select name="level" id="level" class="form-control col-md-7 col-xs-12">
          <option value="" <?= $level=='' ? 'selected' : '' ?>>--Select--</option>
          <option value="Regional Referral">Regional Referral</option>
          <option value="Zonal Referral">Zonal Referral</option>
          <option value="Specialized">Specialized</option>
          <option value="National">National</option>
          </select>
     </div>
     </div>

     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Region<span class="required">*</span></label>
     <div class="col-md-5 col-sm-5 col-xs-12">
          <select name="region_id" id="region_id" class="form-control col-md-7 col-xs-12">
          <!-- <option value="">--Select--</option> -->
          <?php
               $sel=$db->getAllRegionName(); 
               while($row=$sel->fetch())
               {
                    $Reg_Id = $row['Reg_Id'];
          ?>
               <option <?php if($region_id==$Reg_Id){ echo "selected"; } ?> value="<?php echo $row['Reg_Id']; ?>"><?php echo strtoupper($row['RegName']); ?></option>
          <?php } ?>
          </select>
     </div>
     </div>
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="editRRH" value="Save"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
	<input type="hidden" name="rrh_id" value="<?php echo $rrh_id; ?>"/>
	 
     </div>
     </div>
     </form>	 