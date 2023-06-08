<?php session_start();
 include "../lib/dbconnect.php";
 $db = new dbClass();
 $db->connect();
 

 $qGroup=$_GET["q"];
 
 $qG=explode("=",$qGroup);
 $regNo=$qG[0];
 $regType=$qG[1];
 $applicant_id=$qG[2];

 $firstname=$_SESSION['firstname'];
 
 $lastname=$_SESSION['lastname'];
 
 //if($q=='Retention')//If Selected
 //{
  
 $getCId=$db->getRegYearByNamesReg($firstname,$lastname,$regNo,$regType);
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
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Reg Year<span class="required">*</span> </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <select id="regYear" class="form-control col-md-7 col-xs-12"  name="regYear"  required="required" onchange="checkIfCertificateValid(this.value)">
      <option value="">--Select--</option>
	  <?php
	  while($rw=$getCId->fetch())
	  {
	  ?>
      <option value="<?php echo $rw['regYear']."=".$regType; ?>"><?php echo $rw['regYear']; ?></option>
	  <?php
	  }
	  ?>
     
     </select>
     </div>
   </div>
   
   <div id="certV"></div>

 <?php
 }
 ?>
