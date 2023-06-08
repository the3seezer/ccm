<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

//$selectreg=$db->getAllRegionName();

//$sel=$db->getWPCategory();

$sel=$db->getHealthCadres();
$sel1=$db->getListCriteria();
$sel11=$db->getListCriteria();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
      
	 <!--Cadre Name-->
     <div class="item form-group">
     <label class="control-label col-md-2 col-sm-2 col-xs-12">Cadre Name<span class="required">*</span></label>
     <div class="col-md-10 col-sm-10 col-xs-12">
     <select id="cadreName" class="form-control col-md-7 col-xs-12" name="cadreName" required="required">
     <option value="">--Select--</option>
	 <?php
	 while($rw=$sel->fetch())
	 {
	 ?>
     <option value="<?php echo $rw['cadreId']; ?>"><?php echo $rw['cadreName']; ?></option>
	 <?php
	 }
	 ?>
     </select>
     </div>
     </div>
   
     <!--Criteria-->
	 <?php $room=1; ?>
     <div class="item form-group">
     <label class="control-label col-md-2 col-sm-2 col-xs-12">Criteria<span class="required">*</span></label>
	 
     <div class="col-md-6 col-sm-6 col-xs-12">
	 <select id="criteria" class="form-control col-md-7 col-xs-12" name="criteria" required="required" onchange="loadStandardNames(this.value)">
      <option value="">--Select--</option>
	  <?php
	 while($row=$sel1->fetch())
	 {
	 ?>
     <option value="<?php echo $row['criteriaId']; ?>"><?php echo $row['criteriaName']; ?></option>
	 <?php
	 }
	 ?>
      </select>
     </div>

	 <div class="col-md-2 col-sm-2 col-xs-12">
     <input id="credit" class="form-control col-md-7 col-xs-12" name="credit" placeholder="Credit" required="required" type="text" min="0" pattern="[0-9]+" title="please enter number only">
     </div>

	 <!-- <div class="col-md-2 col-sm-2 col-xs-12">
     <button class="btn btn-primary" type="button"  onclick="education_fields();">+Add</button>
	 <input type="hidden" name="rowId" value="<?php echo $room; ?>"/>
     </div> -->
     </div>
	 
	 <div id="newRow"> </div>

	 <div id="standardNames"></div>
	                                                                             
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="addNewCCriteria" value="Submit"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
     <input type="hidden" name="member_id" value="<?php echo $_SESSION['member_id']; ?>"/>
	 
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
	divtest.innerHTML +='<div class="item form-group"><label class="control-label col-md-2 col-sm-2 col-xs-12">New Criteria<span class="required"></span></label><div class="col-md-6 col-sm-6 col-xs-12"><select id="criteria" class="form-control col-md-7 col-xs-12" name="criteria'+room+'" required="required"><option value="">--Select--</option><?php while($row=$sel11->fetch()){?> <option value="<?php echo $row['criteriaId']; ?>"><?php echo $row['criteriaName']; ?></option> <?php } ?></select></div><div class="col-md-2 col-sm-2 col-xs-12"><input type="number"  min="0" id="credit" class="form-control col-md-7 col-xs-12" name="credit'+room+'" placeholder="Credit" required="required" type="text"></div><div class="col-md-2 col-sm-2 col-xs-12"><button class="btn btn-danger" type="button"  onclick="remove_education_fields('+room+');">-Remove</button><input type="hidden" name="rowId" value="'+room+'"/></div></div>';
	
    
    objTo.appendChild(divtest);
	
	$("#choose"+room).chosen();
	$("#checkno"+room).chosen();
}

   function remove_education_fields(rid) {
	  
	   $('.removeclass'+rid).remove();
   }
   
   
   
 </script>
	 
	 
	 
	 
	 
	 
	 
	 
	 