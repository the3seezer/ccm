<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$applicant_id=$_POST['applicant_id'];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
     <!--Employer Name-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Employer Name</label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="employer" class="form-control col-md-7 col-xs-12"  name="employer"  type="text" required>
     </div>
     </div>
	 
	 
	 <!--Duty Post-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Duty Post</label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="position" class="form-control col-md-7 col-xs-12"  name="position"  type="text">
     </div>
     </div>
	 
	 
	 <!--Employment Type-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Employment Contract<span class="required">*</span> </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <select id="employType" class="form-control col-md-7 col-xs-12"  name="employType"  required="required">
      <option value="">--Select--</option>
      <option>Permanent</option>
      <option>Temporary</option>
      <option>Contract</option>
      <option>Internship</option>
      </select>
      </div>
      </div>

      <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12"><small>Is this your current Employment?</small><span class="required">*</span> </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <select onchange="current_employment()" id="currentEmployment" class="form-control col-md-7 col-xs-12"  name="currentEmployment"  required="required">
      <option value="NO">NO</option>
      <option value="YES">YES</option>
      </select>
      </div>
      </div>
	 
	 
	 <!--Start Year-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Start Date">Start Year</label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <!-- <input id="start" class="form-control col-md-7 col-xs-12"  name="start"  type="number"> -->
        <select class="form-control" id="start" name="start" required>
               <option value="">--Select--</option>
               <option><?php echo date('Y'); ?></option>
		       <?php $i=1; for($i=1; $i<=100; $i++){?><option><?php echo date('Y')-$i; ?></option><?php } ?> 
        </select>
     </div>
     </div>
	 
	 <!--End Year-->
     <div class="item form-group " id="endYear">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="schoolName">End Year</label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <!-- <input id="end" class="form-control col-md-7 col-xs-12"  name="end"  type="number"> -->
        <select class="form-control" id="end" name="end" >
            <option value="">--Select--</option>
            <option><?php echo date('Y'); ?></option>
            <?php $i=1; for($i=1; $i<=100; $i++){?><option><?php echo date('Y')-$i; ?></option><?php } ?> 
        </select>
     </div>
     </div>
     
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <button id="send" type="submit" name="AddExperience" class="btn btn-success">Submit</button>
     <button type="reset" class="btn btn-default">Clear</button>
     <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
     </div>
    </div>

</form>

<script>
    function current_employment(){
        var e = document.getElementById("currentEmployment");
        var currentEmp = e.options[e.selectedIndex].value;
        if(currentEmp=='YES'){
            $('#endYear').hide();
        }else{
            $('#endYear').show();
        }
    }
</script>
	
	 
	 
	 
	 