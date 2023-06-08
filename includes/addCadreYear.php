<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$GroupID=$_POST['GroupID'];

$group=explode("=",$GroupID);
$cadreId=$group[0];
$fac_id=$group[1];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
      

     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Vacancy<span class="required">*</span></label>
	 <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="number" class="form-control col-md-7 col-xs-12" name="number" placeholder="Number" required="required" type="number">
     </div>
	 </div>
	 
	 
	 <!--Year-->
	 <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Year<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <select id="year" class="form-control col-md-7 col-xs-12" name="year" required="required">
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
	 </div>
	 
                                                                      
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="addNewCadreToYear" 
	 value="Submit"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
     <input type="hidden" name="cadreId" value="<?php echo $cadreId; ?>"/>
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
	 
	 
	 
	 
	 
	 
	 
	 
	 