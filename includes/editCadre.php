<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$cadre_id=$_POST['cadre_id'];


//Get cadre by cadre_id
$getCadre=$db->getCadreByCadreId($cadre_id);
$row=$getCadre->fetch();
$cName=$row['cadreName'];
$number=$row['number'];
$status=$row['status'];
$fac_id=$row['fac_id'];

$sel1=$db->getHealthCadres();

?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
 
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Cadre Name<span class="required">*</span></label>
	 
     <div class="col-md-5 col-sm-5 col-xs-12">
     <select id="cadre" class="form-control col-md-7 col-xs-12" name="cadre" required="required">
      <option value="<?php echo $cadre_id; ?>"><?php echo $cName; ?></option>
	  <?php
	  while($rw1=$sel1->fetch())
	  {
	  ?>
      <option value="<?php echo $rw1['cadreId']; ?>"><?php echo $rw1['cadreName']; ?></option>
	  <?php
	  }
	  ?>
      </select>
     </div>
	 </div>
	 
	 
	 <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Number<span class="required">*</span></label>
	 <div class="col-md-5 col-sm-5 col-xs-12">
     <input id="number" class="form-control col-md-7 col-xs-12" name="number" required="required" type="number" value="<?php echo $number; ?>">
     </div>
	 </div>
	 
	 <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span></label>
	 <div class="col-md-5 col-sm-5 col-xs-12">
     <select id="status" class="form-control col-md-7 col-xs-12" name="status" required="required">
     <option><?php echo $status; ?></option>
     <option value="Active">Active</option>
     <option value="Passive">Passive</option>
     </select>
     </div>
	 </div>
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="editCadre" value="Save"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
     <input type="hidden" name="cadre_id" value="<?php echo $cadre_id; ?>"/>
	 <input type="hidden" name="fac_id" value="<?php echo $fac_id; ?>"/>
	 
     </div>
     </div>
     </form>	 