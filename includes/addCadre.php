<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$fac_id=$_POST['fac_id'];

$selectreg=$db->getAllRegionName();

$sel=$db->getWPCategory();

$sel1=$db->getHealthCadres();
$sel11=$db->getHealthCadres();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
      
     <!--Cadre-->
	 <?php $room=1; ?>
     <div class="item form-group">
     <label class="control-label col-md-2 col-sm-2 col-xs-12">Cadre<span class="required">*</span></label>
	 
     <div class="col-md-4 col-sm-4 col-xs-12">
      <select id="cadre" class="form-control col-md-7 col-xs-12" name="cadre<?php echo $room; ?>" required="required">
      <option value="">--Select--</option>
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
	 
	 <div class="col-md-2 col-sm-2 col-xs-12">
     <input id="number" class="form-control col-md-7 col-xs-12" name="number<?php echo $room; ?>" placeholder="Number" required="required" type="number">
     </div>
	 
	 
	 <!--Year-->
     <div class="col-md-2 col-sm-2 col-xs-12">
     <select id="year" class="form-control col-md-7 col-xs-12" name="year<?php echo $room; ?>" required="required">
     <option value="">--Select--</option>
	 <?php
	 $cYear=date('Y');
	 $i=1;
	 ?>
	 <option><?php echo $cYear-2; ?></option>
	 <option><?php echo $cYear-1; ?></option>
	 <option><?php echo $cYear; ?></option>
	 <?php
	 while($i<=5)
	 {
	 ?>
     <option><?php echo $cYear+$i; ?></option>
	 <?php $i++;} ?>
	 
     </select>
     </div>
	 
	 
	 <div class="col-md-2 col-sm-2 col-xs-12">
     <button class="btn btn-primary" type="button"  onclick="education_fields();">+Add</button>
	 <input type="hidden" name="rowId" value="<?php echo $room; ?>"/>
     </div>
     </div>
	 
	 <div id="newRow"> </div>
	 
                                                                      
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="addNewCadreToWP" 
	 value="Submit"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
     <input type="hidden" name="fac_id" value="<?php echo $fac_id; ?>"/>
	 
     </div>
     </div>
     </form>
	 
<script>
var room = 1;
function education_fields()
{
    room++;
	
    var objTo = document.getElementById('newRow')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "row clearfix form-line removeclass"+room);
	var rdiv = 'removeclass'+room;
	
	
	
	<!--Check Number -->
	divtest.innerHTML +='<div class="item form-group"><label class="control-label col-md-2 col-sm-2 col-xs-12"><span class="required"></span></label><div class="col-md-4 col-sm-4 col-xs-12"><select id="cadre" class="form-control col-md-7 col-xs-12" name="cadre'+room+'" required="required"><option value="">--Select--</option><?php while($rw11=$sel11->fetch()){ ?><option value="<?php echo $rw11['cadreId']; ?>"><?php echo $rw11['cadreName']; ?></option><?php } ?></select></div><div class="col-md-2 col-sm-2 col-xs-12"><input id="number" class="form-control col-md-7 col-xs-12" name="number'+room+'" placeholder="Number" required="required" type="text"></div><div class="col-md-2 col-sm-2 col-xs-12"><select id="year" class="form-control col-md-7 col-xs-12" name="year'+room+'" required="required"><option value="">--Select--</option><?php $cYear=date('Y');$i=1;?><option><?php echo $cYear-2; ?></option><option><?php echo $cYear-1; ?></option><option><?php echo $cYear; ?></option><?php while($i<=5){?><option><?php echo $cYear+$i; ?></option><?php $i++;} ?></select></div><div class="col-md-2 col-sm-2 col-xs-12"><button class="btn btn-danger" type="button"  onclick="remove_education_fields('+room+');">-Remove</button><input type="hidden" name="rowId" value="'+room+'"/></div></div>';
	
    
    objTo.appendChild(divtest);
	
	$("#choose"+room).chosen();
	$("#checkno"+room).chosen();
   }

   function remove_education_fields(rid) {
	  
	   $('.removeclass'+rid).remove();
   }
   
 </script>
	 
	 
	 
	 
	 
	 
	 
	 
	 