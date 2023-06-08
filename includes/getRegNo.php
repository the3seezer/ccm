<?php session_start();
 include "../lib/dbconnect.php";
 $db = new dbClass();
 $db->connect();
 
  $qGroup=$_GET["q"];
 
 $qG=explode("=",$qGroup);
 $q=$qG[0];
 $applicant_id=$qG[1];

 $firstname=$_SESSION['firstname'];
 
 $lastname=$_SESSION['lastname'];
 

 
 //if($q=='Retention')//If Selected
 //{
  
 $getCId=$db->getRegNumberByNamesReg($firstname,$lastname,$q);
 if($getCId->rowCount()<1)
 {
	
 ?>
 <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span> </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <?php echo "<span style='color:red'>No record found. Make sure that you use the same names as used in MCT. Also make sure that you select a type of registration which you have.</span>"; ?>
     </div>
 </div>

<?php 
 }
 else
 {
 ?>
 
   <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Reg No<span class="required">*</span> </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <select id="regType" class="form-control col-md-7 col-xs-12"  name="regNo"  required="required" onchange="loadRegistrationYear(this.value)">
      <option value="">--Select--</option>
	  <?php
	  while($rw=$getCId->fetch())
	  {
	  ?>
      <option value="<?php echo $rw['regNo']."=".$q."=".$applicant_id; ?>"><?php echo $rw['regNo']; ?></option>
	  <?php
	  }
	  ?>
     
     </select>
     </div>
   </div>
   
   <div id="regYear"></div>

 <?php
 }
   
   /*
  }
  elseif($q=='TNMC')
  {
	  
	  
	  
  }
  else
  {}
 */
  ?>
