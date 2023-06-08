<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$exp_id=$_POST['exp_id'];

$getEx=$db->getExperienceByExId($exp_id);
$row=$getEx->fetch();
$employer=$row['employer'];
$position=$row['duty'];
$employType=$row['employType'];
$start=$row['start'];
$end=$row['end'];
$applicant_id=$row['applicant_id'];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
     <!--Employer Name-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Employer Name</label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="employer" class="form-control col-md-7 col-xs-12"  name="employer" value="<?php echo $employer; ?>" type="text">
     </div>
     </div>
	 
	 
	 <!--Duty Post-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Duty Post</label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="position" class="form-control col-md-7 col-xs-12"  name="position" value="<?php echo $position; ?>" type="text">
     </div>
     </div>
	 
	 
	 <!--Employment Type-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Employment Type<span class="required">*</span> </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <select id="employType" class="form-control col-md-7 col-xs-12"  name="employType"  required="required">
      <option><?php echo $employType; ?></option>
      <option>Permanent</option>
      <option>Temporary</option>
      <option>Contact</option>
      <option>Internship</option>
      </select>
      </div>
      </div>
	 
	 
	 <!--Start Year-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Start Date">Start Year</label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="start" class="form-control col-md-7 col-xs-12"  name="start" value="<?php echo $start; ?>"  type="number">
     </div>
     </div>
	 
	 <!--End Year-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="schoolName">End Year</label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="end" class="form-control col-md-7 col-xs-12"  name="end" value="<?php echo $end; ?>"  type="number">
     </div>
     </div>
     
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <button id="send" type="submit" name="editExperience" class="btn btn-success">Update</button>
     <button type="reset" class="btn btn-default">Clear</button>
     <input type="hidden" name="exp_id" value="<?php echo $exp_id; ?>"/>
	 <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
     </div>
    </div>

</form>

	 
	
	 
	 
	 
	 