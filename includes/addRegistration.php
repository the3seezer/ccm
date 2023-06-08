<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$idGroup=$_POST['applicant_id'];
$idGroup1=explode("=",$idGroup);
$app_id=$idGroup1[0];
$applicant_id=$idGroup1[1];
?>

<form  action="?pg=mngapp" method="post"  class="form-horizontal form-label-left">

     <!--Type of Council-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Type of Council<span class="required">*</span> </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <select id="council" class="form-control col-md-7 col-xs-12"  name="council"  required="required">
      <option value="">--Select--</option>
      <option>MCT</option>
      <option>TNMC</option>
      </select>
      </div>
      </div>
	  
	  <!--<div id="regType"></div>-->
	  
	  
	  <!--Registration Type-->
	  
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Registration Type<span class="required">*</span> </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <select id="regType" class="form-control col-md-7 col-xs-12"  name="regType"  required="required">
      <option value="">--Select--</option>
      <option value="Retention">Retention</option>
      <option value="Full">Full Registration</option>
	  <option value="Temporary">Temporary Registration</option>
	  <option value="license">License to Practice</option>
	  <option value="TemporaryNonCitizen">Temporary Registration</option>
     </select>
     </div>
     </div>
	

 
     <!--Registration No-->
	 
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Registration No</label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="regNo" class="form-control col-md-7 col-xs-12"  name="regNo"  type="text">
     </div>
     </div>

	 
	 
	 <!--Registration Year-->
	
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Registration Year</label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="regYear" class="form-control col-md-7 col-xs-12"  name="regYear"  type="text">
     </div>
     </div>
	
	 
     
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <button id="send" type="submit" name="searchRegistration" class="btn btn-success">Search</button>
     <button type="reset" class="btn btn-default">Clear</button>
     <input type="hidden" name="app_id" value="<?php echo $app_id; ?>"/>
	 <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
	 <input type="hidden" name="firstname" value="<?php echo $_SESSION['firstname']; ?>"/>
	 <input type="hidden" name="lastname" value="<?php echo $_SESSION['lastname']; ?>"/>
     </div>
    </div>
	

</form>

	 
	
	 
	 
	 
	 