<?php
 include "../lib/dbconnect.php";
 $db = new dbClass();
 $db->connect();
 
 $qG=$_GET["q"];
 
 $qG1=explode("=",$qG);
 $q=$qG1[0];
 $applicant_id=$qG1[1];
 
 
 if($q=='MCT')//If Selected
 {
 ?>
   <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Registration Type<span class="required">*</span> </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <select id="regType" class="form-control col-md-7 col-xs-12"  name="regType"  required="required" onchange="loadRegistrationNumber(this.value)">
      <option value="">--Select--</option>
      <option value="<?php echo "Retention=".$applicant_id;?>">Retention</option>
      <option value="<?php echo "Full=".$applicant_id;?>">Full Registration</option>
	  <option value="<?php echo "Temporary=".$applicant_id;?>">Temporary Registration</option>
	  <option value="<?php echo "TemporaryNon=".$applicant_id;?>">Temporary for non Citizen</option>
	  <option value="<?php echo "License=".$applicant_id;?>">License to Practice</option>
     </select>
     </div>
   </div>
   
   <div id="regNo"></div>

 <?php
  }
  elseif($q=='TNMC')
  {
	  
	  
	  
  }
  else
  {}
  ?>
