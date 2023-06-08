<?php 
 include "../lib/dbconnect.php";
 $db = new dbClass();
 $db->connect();
 
 $q=$_POST['group_id'];
 $q1=explode("=",$q);
 $table_id=$q1[0];
 $applicant_id=$q1[1];;   $getF=$db->getApplicantsById($applicant_id); $row=$getF->fetch(); $fullname=$row['firstname']." ".$row['lastname']; $email=$row['email'];
?>
<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">

 <p>Do you want to delete this information?</p>
<div class="ln_solid"></div>
<div class="form-group">
<div class="col-md-6 col-md-offset-3">
<input type="submit"  id="send"  class="btn btn-danger" name="deleteRejectedApp" value="Delete"/>
<input type="hidden" name="table_id" value="<?php echo $table_id; ?>" />
<input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>" />
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="fullname" value="<?php echo $fullname; ?>" />
</div>
</div>
</form>