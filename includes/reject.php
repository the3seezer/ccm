<?php 
 include "../lib/dbconnect.php";
 $db = new dbClass();
 $db->connect();
 $allocation_id=$_POST['allocation_id'];
 
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
<!--Approve Status:-->
 <div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12">Approve Status:<span class="required">*</span></label>
 <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="allocation_status" class="form-control col-md-7 col-xs-12" data-validate-length-range="" data-validate-words="" name="allocation_status" placeholder="" required="required" disabled="disabled" type="text" value="<?php echo 'Rejected'; ?>">
</div>
</div>

<!--Remark: -->
<div class="item form-group" id="remarks">
<label for="Remarks" class="control-label col-md-3">Rejection Reason:</label>
<div class="col-md-6 col-sm-6 col-xs-12">
<textarea name="rejection_reason" id="remarks"  rows="5" required="required" class="form-control"></textarea>
</div>
</div>



<div class="ln_solid"></div>
<div class="form-group">
<div class="col-md-6 col-md-offset-3">
<input type="submit"  id="send"  class="btn btn-danger" name="rejectAgenciesApplicant" value="Reject"/>
<input type="reset" class="btn btn-default" value="Clear"/>
<input type="hidden" name="allocation_id" value="<?php echo $allocation_id; ?>" />
</div>
</div>
</form>