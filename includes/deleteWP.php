<?php session_start(); 

$fac_id=$_POST['fac_id'];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
     <p>Do yo want to delete this information?</p>
	 <br/><br/>
     
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-danger" name="deleteFacility" value="Delete"/>
     <input type="hidden" name="fac_id" value="<?php echo $fac_id; ?>"/>
	 
     </div>
     </div>
     </form>
