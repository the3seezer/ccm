<?php session_start(); 
$group_id=$_POST['group_id'];
$group=explode("=",$group_id);

$cadre_id=$group[0];
$fac_id=$group[1];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
     <p>Do yo want to delete this information?</p>
	 <br/><br/>
     
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-danger" name="deleteCadre" value="Delete"/>
     <input type="hidden" name="cadre_id" value="<?php echo $cadre_id; ?>"/>
	 <input type="hidden" name="fac_id" value="<?php echo $fac_id; ?>"/>
	 
     </div>
     </div>
     </form>
