<?php session_start();
 include "../lib/dbconnect.php";
 $db = new dbClass();
 $db->connect();



 $qGroup=$_GET["q"];
 
 $qG=explode("=",$qGroup);
 $regYear=$qG[0];
 $regType=$qG[1];
 
 $cYear=date('Y');
 
 $difYear=$cYear-$regYear;
 
 if($regType=='Retention' AND $regYear==$cYear)
 {
 ?>
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <button id="send" type="submit" name="AddRegistration" class="btn btn-success">Submit</button>
     <button type="reset" class="btn btn-default">Clear</button>
     <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
     </div>
     </div>
 <?php
 }
 elseif($regType=='Full' OR $regType=='License')
 {
  ?>
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <button id="send" type="submit" name="AddRegistration" class="btn btn-success">Submit</button>
     <button type="reset" class="btn btn-default">Clear</button>
     <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
     </div>
     </div>
 <?php 
 }
 elseif($regType=='Temporary' AND $difYear<=2)
 {
	?>
     <div class="ln_solid"></div>
      <div class="form-group">
      <div class="col-md-6 col-md-offset-3">
      <button id="send" type="submit" name="AddRegistration" class="btn btn-success">Submit</button>
      <button type="reset" class="btn btn-default">Clear</button>
      <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
      </div>
     </div>
 <?php
 }
 elseif($regType=='TemporaryNon' AND $difYear<=2)
 {
	?>
     <div class="ln_solid"></div>
      <div class="form-group">
      <div class="col-md-6 col-md-offset-3">
      <button id="send" type="submit" name="AddRegistration" class="btn btn-success">Submit</button>
      <button type="reset" class="btn btn-default">Clear</button>
      <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
      </div>
     </div>
 <?php 
 }
 else
 {
 ?>
   <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span> </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <?php echo "<span style='color:red'>This certificate has been expired. Go to the responsible council and renewed it</span>"; ?>
     </div>
   </div>
 <?php
 }
