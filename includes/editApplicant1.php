<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$applicant_id=$_POST['applicant_id'];

$query1=$db->getnationalList();

$getAp=$db->getApplicantsById($applicant_id);
$query2=$db->getCouncilList();
$query3=$db->getAllDisabilityName();


$row=$getAp->fetch();
$dob=$row['dob'];
$dobG=explode("-",$dob);
$year=$dobG[0];
$month=$dobG[1];
$day=$dobG[2];

$baraza_id = $row['councilTypeID'];
$getBaraza = $db->getBarazaById($baraza_id);
$baraza=$getBaraza->fetch();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
 
     
			
               <!--First Name-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="name" class="form-control col-md-7 col-xs-12"  name="firstname"  required type="text" value="<?php echo $row['firstname']; ?>">
               </div>
               </div>
               
               <!--Middle Name-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Middle Name</label>
               <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="middle" class="form-control col-md-7 col-xs-12"  name="middle"   type="text" value="<?php echo $row['middlename']; ?>">
               </div>
               </div>
               
               <!--Last Name-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name <span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="last" class="form-control col-md-7 col-xs-12"  name="lastname" value="<?php echo $row['lastname']; ?>" required="required" type="text">
               </div>
               </div>
			   
			   <!--Date Of Birth-->
               <div class="item form-group">

               <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth<span class="required">*</span> </label>
			   
			    <div class="col-md-2 col-sm-2 col-xs-12">
               <select class="form-control" id="year" name="year" required onChange="loadMonths(this.value)">
             <option><?php echo $year; ?></option>
             <option><?php echo date('Y'); ?></option>
		     <?php $i=1; for($i=1; $i<=100; $i++){?><option><?php echo date('Y')-$i; ?></option><?php } ?> 
             </select>
             </div>  
			   

			   
             <div class="col-md-2 col-sm-2 col-xs-12">
			 <select class="form-control col-md-7 col-xs-12" id="month" name="month" required onChange="loadDays(this.value)">
              <option><?php echo $month; ?></option>
              </select>
             </div>
			   
			   
	         <div class="col-md-2 col-sm-2 col-xs-12">
             <select class="form-control" id="days" name="day" required>
             <option><?php echo $day; ?></option>
             </select>
             </div>   
             </div>
               
               <!--Gender-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gender <span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="gender" class="form-control col-md-7 col-xs-12"   name="gender"  required="required">
               <option><?php echo $row['gender']; ?></option>
               <option value="Male">Male</option>
               <option value="Female">Female</option>
               </select>
               </div>
               </div>
			   
			   
			   <!--Marital Status-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12">Marital Status <span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="maritalStatus" class="form-control col-md-7 col-xs-12"  name="maritalStatus"  required="required">
               <option><?php echo $row['maritalStatus']; ?></option>
               <option value="Married">Married</option>
               <option value="Single">Single</option>
               <option value="Divorced">Divorced</option>
               <option value="Widow">Widow</option>
               </select>
               </div>
               </div>
               
               <!--Nationality-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nationality <span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="national" class="form-control col-md-7 col-xs-12"  name="national"  required="required">
                <option><?php echo $row['value']; ?></option>
               <?php
	             while($rw = $query1->fetch())
	            {
	             echo '<option value ="'.$rw['id'].'">'.$rw['value'].'</option><br>';
	            }           
                 ?>
               </select>
               </div>
               </div>
               
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">NIDA </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="nida" class="form-control col-md-7 col-xs-12"  name="nida" type="text" value="<?php echo $row['nida']; ?>">
               </div>
               </div>

               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Council Type </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="councilType" class="form-control col-md-7 col-xs-12"  name="councilType"  >
               <option value="<?php echo $baraza['id']; ?>"><?php echo $baraza['name']; ?></option>
               <?php while($row2 = $query2->fetch())
	             {
	                echo '<option value ="'.$row2['id'].'">'.$row2['name'].'</option><br>';
	             }           
                 ?>
               </select>
               </div>
               </div>

               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Council Registration ID. </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="councilRegistrationID" class="form-control col-md-7 col-xs-12"  name="councilRegistrationID" type="text" value="<?php echo $row['councilRegistrationID']; ?>">
               </div>
               </div>

               <!--Postal Addres-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Postal Address<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="address" class="form-control col-md-7 col-xs-12"  name="address" value="<?php echo $row['address']; ?>"  required="required" type="text">
               </div>
               </div>
               
               <!--Phone Number-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone Number<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="phone" class="form-control col-md-7 col-xs-12"  name="phone"  required="required" type="text" value="<?php echo $row['phone']; ?>">
               </div>
               </div>
               
               <!--Email Address-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="email" class="form-control col-md-7 col-xs-12"  name="email"  required="required" type="email" value="<?php echo $row['email']; ?>">
              <span id="emailStatus"></span>
               </div>
               </div>
              
			   
			   <div class="ln_solid"></div>
               <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                 <button id="send" type="submit" class="btn btn-success" name="editApplicant">Save</button>
                 <button type="reset" class="btn btn-default">Clear</button>
				 <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
                </div>
               </div>
			   
             </form>

	 
	
	 
	<!--  <script>
	 
	  // loadDisiability
function loadDisiability(str)
{
  // alert(str);
  if (str=="YES")
{
    // $("#countrytz".show();
    $("#disiability").show();
    // alert("hello"); 
}  else{
   $("#disiability").hide();

} 
     
} 

 // loadDisiability
function loadOthers(str)
{
  // alert(str);
  if (str=="others")
{
    // $("#countrytz".show();
    $("#others").show();
    // alert("hello"); 
}  else{
   $("#others").hide();

} 
     
}

</script>
 -->