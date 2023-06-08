<?php 
 include "../lib/dbconnect.php";
 $db = new dbClass();
 $db->connect();
 $Group_id=$_POST['Group_id']; $group=explode("=",$Group_id);  $app_id=$group[0]; $applicant_id=$group[1];  $getF=$db->getApplicantsById($applicant_id); $row=$getF->fetch(); $fullname=$row['firstname']." ".$row['lastname']; $email=$row['email'];   $getAp=$db->getApplicationById($app_id);  $rowApp=$getAp->fetch(); $app_id=$rowApp['app_id']; $fac_id=$rowApp['fac_id']; $cadre_id=$rowApp['cadre-id'];  //Get Facility name $getF=$db->getfacilityByfacid($fac_id); $rwF=$getF->fetch(); $facName=$rwF['facname']; //Get Cadre name $getCa=$db->getCadreByCardeId($cadre_id); $rwC=$getCa->fetch(); $cadName=$rwC['cadreName'];
?>
<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 <!--Name-->
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Name<span class="required">*</span></label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="fst" class="form-control col-md-7 col-xs-12" data-validate-length-range="" data-validate-words="" name="fst" placeholder="" required="required" disabled="disabled" type="text" value="<?php echo  $fullname; ?>">
  </div>
</div>
<!--Email-->
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Email<span class="required">*</span></label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="email" class="form-control col-md-7 col-xs-12" data-validate-length-range="" data-validate-words="" name="email10" placeholder="" required="required" disabled="disabled" type="text" value="<?php echo $email; ?>">
</div>
</div>
   
<!--Facility: -->
<div class="item form-group">
<label for="password" class="control-label col-md-3">Facility:</label>
<div class="col-md-6 col-sm-6 col-xs-12">
<input id="fst" type="text" disabled="disabled" name="facName" data-validate-length-range="" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $facName; ?>">
</div>
</div><!--Cadre: --><div class="item form-group"><label for="password" class="control-label col-md-3">Cadre:</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="fst" type="text" disabled="disabled" name="cadName" data-validate-length-range="" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $cadName; ?>"></div></div>
<!--Application Status:-->
 <div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Rejection Status:<span class="required">*</span></label>
 <div class="col-md-6 col-sm-6 col-xs-12">
 <select name="status" id="mar"  onchange="showRemarks(this.value)" class="form-control" required>
  <option value="">--Select--</option>
  <option value="1">Reject with recommendation</option>
  <option value="2">Reject without recommendation</option>        
 </select> 
</div>
</div>
<!--Remark: -->
<div class="item form-group" id="remarks">
</div>

<div class="ln_solid"></div>
<div class="form-group">
<div class="col-md-6 col-md-offset-3">
<input type="submit"  id="send"  class="btn btn-success" name="rejectApp" value="Submit"/>
<input type="reset" class="btn btn-default" value="Clear"/>
<input type="hidden" name="app_id" value="<?php echo $app_id; ?>" />
<input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>" />
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="facName" value="<?php echo $facName; ?>" /> <input type="hidden" name="cadName" value="<?php echo $cadName; ?>" /> 
<input type="hidden" name="fullname" value="<?php echo $fullname; ?>" />
</div>
</div>
</form>