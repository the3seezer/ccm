<?php 
 include "../lib/dbconnect.php";
 $db = new dbClass();
 $db->connect();
 $applicant_id=$_POST['applicant_id'];
 
 
 $getF=$db->getApplicantsById($applicant_id);
 $row=$getF->fetch();
 $fullname=$row['firstname']." ".$row['lastname'];
 $email=$row['email'];
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



<!--Approve Allocation Status:-->
 <div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12">Approve Allocation Status:<span class="required">*</span></label>
 <div class="col-md-6 col-sm-6 col-xs-12">
 <select name="approveStatus" onchange="showApproveStatus1(this.value)" class="form-control" required>
  <option value="">--Select--</option>
  <option value="1=<?php echo $applicant_id; ?>">Selected</option>
   
 </select> 
</div>
</div>

<div class="item form-group" id="approveremarks">
</div>

<!--Remark: -->
<div class="item form-group" id="remarks">
<label for="Remarks" class="control-label col-md-3">Remarks:</label>
<div class="col-md-6 col-sm-6 col-xs-12">
<textarea name="remarks" id="remarks"  rows="5" required="required" class="form-control"></textarea>
</div>
</div>



<div class="ln_solid"></div>
<div class="form-group">
<div class="col-md-6 col-md-offset-3">
<input type="submit"  id="send"  class="btn btn-success" name="approveAllocateApp" value="Submit"/>
<input type="reset" class="btn btn-default" value="Clear"/>
<!-- <input type="hidden" name="app_id" value="<?php //echo $app_id; ?>" /> -->
<input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>" />
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="fullname" value="<?php echo $fullname; ?>" />
</div>
</div>
</form>