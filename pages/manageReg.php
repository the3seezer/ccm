<?php
$applicant_id=$_SESSION['applicant_id'];

$getAp=$db->getRegistrationByAppId($applicant_id);

$getExp=$db->getExperienceByAppId($applicant_id);

$getProf=$db->getProfessionalByAppId($applicant_id);

$getBE=$db->getEducationByAppId($applicant_id);

$getG=$db->getGraduatesByAppId($applicant_id);
?>

<div class="row">
<div class="col-lg-12"><h2 class="page-header">Registration Details</h2></div>
</div>

<div class="row">
                    
  <div class="col-lg-12">
   <?php
   if(isset($_POST['searchRegistration']))
    {
	 $council=$_POST['council'];
	 $regType=$_POST['regType'];
	 $regNo=$_POST['regNo'];
 	 $regYear=$_POST['regYear'];
	 $firstname=$_POST['firstname'];
	 $lastname=$_POST['lastname'];
	 $fullname=$firstname.$lastname;
	 $applicant_id=$_POST['applicant_id'];

	  //Check if user exist
	  $curl = curl_init();

      // Set some options/settings
        curl_setopt_array($curl, array(
         CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://oas.mct.go.tz/wao_api.php?regType='.$regType.'&regNo='.$regNo.'&regYear='.$regYear.'',
        CURLOPT_USERAGENT => 'MCT to WAO cURL Request'
       ));

      // Send the request & save response to $resp(JSON string)
       if(!curl_exec($curl)){
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
       }else{
	   $json_resp = curl_exec($curl);
      }


      // Close request to clear up some resources
      curl_close($curl);

      // Convert JSON string to Array
      $institutionArray = json_decode($json_resp, true);
      //print_r($institutionArray);        // Dump all data of the Array
	  
	  $countArr=count($institutionArray);
	  
	  
	  //$checkR=$db->checkIfRegistrationForWaoExist($council,$regType,$regNo,$regYear,$firstname,$lastname);
	  if($countArr<1)
	  {
       ?>
       <div class="panel panel-danger">
        <div class="panel-heading">Verification Error!</div>
        <div class="panel-body">
         <div class="table-responsive">
         <table class="table">
          <thead>
           <tr bgcolor="">
             <th colspan="6">
	   
	          <span style="float:right;"><a href="#addReg" class="btn btn-success btn-xs" data-toggle="modal" data-id="<?php echo $applicant_id; ?>" id="getaddReg"><i class="fa fa-plus"></i>Add New</a></span>
	         </th>
	  
          </tr> 
         </thead>
         </table>
	    </div>	  
	     <p>No record found. Make sure that you use the same names as used in MCT. Also make sure that you select a type of registration which you have.</p>
	  </div>
      </div> 
	 <?php
	  }
	  else
	  {  
	   //$row=$checkR->fetch();
	   //$firstname1=trim($row['first_name']);
	   //$lastname1=trim($row['last_name']);
	   //$fullname1=$firstname1.$lastname1;
	   
	   foreach ($institutionArray as $key => $value) 
	   {
	  
	   $firstname1=trim($value["first_name"]);
	   $lastname1=trim($value["last_name"]);
	   $request=trim($value["Request"]);
	   $Reg_No=trim($value["Reg_No"]);
	   $regYear=trim($value["regYear"]);
	   
	   
	   $fullname1=$firstname1.$lastname1;
	    
	   }
       //echo $fullname2;

	   if($fullname1!=$fullname)
	   {
	   ?>
	   <div class="panel panel-danger">
        <div class="panel-heading">Verification Error!</div>
         <div class="panel-body">
         <div class="table-responsive">
         <table class="table">
          <thead>
           <tr bgcolor="">
             <th colspan="6">
	          <span style="float:right;"><a href="#addReg" class="btn btn-success btn-xs" data-toggle="modal" data-id="<?php echo $applicant_id; ?>" id="getaddReg"><i class="fa fa-plus"></i>Add New</a></span>
	         </th>
           </tr> 
           </thead>
          </table>
	     </div> 
	     <p>Your names do not match with the names queried from database depending on Registration Type, Registration Number and Registration Year you provide. This deteils belongs to <?php echo $firstname1." ".$lastname1; ?></p>
	     </div>
       </div>  
	   <?php
	   }
	   else
	   {
	  ?>
	   <div class="panel panel-success">
       <div class="panel-heading">Verification succeded!</div>
       <div class="panel-body">
	   <form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
       <div class="table-responsive">
	  
       <table class="table">
       <thead>
       <tr bgcolor="">
       <th colspan="6">
	   
	   <span style="float:right;"><a href="#addReg" class="btn btn-success btn-xs" data-toggle="modal" data-id="<?php echo $applicant_id; ?>" id="getaddReg"><i class="fa fa-plus"></i>Add New</a></span>
	   </th>
	  
       </tr>
	   
	   <tr>
	    <td colspan="7"><p>Cross check your information below and click submit button</p></td>
	   </tr>
	   
	   <tr>
       <td><strong>Type of Council</strong></td><td><?php echo $council; ?></td>
       </tr>
	   
	   <tr>
       <td><strong>Registration Type</strong></td><td><?php echo $request; ?></td>
       </tr>
	   
	   <tr>
       <td><strong>Registration No</strong></td><td><?php echo $Reg_No; ?></td>
       </tr>
	   
	   <tr>
       <td><strong>Registration Year</strong></td><td><?php echo $regYear; ?></td>
       </tr>
	   
	   <tr>
	   <td colspan="7">
	   <div class="ln_solid"></div>
      <div class="form-group">
      <div class="col-md-6 col-md-offset-3">
      <button id="send" type="submit" name="AddRegistration" class="btn btn-primary">Submit</button>
      <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
	  <input type="hidden" name="council" value="<?php echo $council; ?>"/>
	  <input type="hidden" name="regType" value="<?php echo $request; ?>"/>
	  <input type="hidden" name="regNo" value="<?php echo $Reg_No; ?>"/>
	  <input type="hidden" name="regYear" value="<?php echo $regYear; ?>"/>
      </div>
      </div>
	   
	   </td>
	   </tr>
       </thead>
     </table>
	 
	 </div>	  
	 </form>
	  </div>
      </div>
	  <?php
	   }
	  }
     }
	/* elseif($getBE->rowCount()<1)
	{
	?>
	 <div class="panel panel-danger">
      <div class="panel-heading">Error!</div>
      <div class="panel-body">	  
	  <p>Make sure that you enter your basic education details before proceeding with this section</p>
	  </div>
     </div> 
	<?php
	}
	elseif($getProf->rowCount()<1)//#If No Professional Details -->
	{
	 ?>
	 <div class="panel panel-danger">
      <div class="panel-heading">Error!</div>
      <div class="panel-body">	  
	  <p>Make sure that you enter your professional details before proceeding with this section</p>
	  </div>
     </div> 
	 <?php
	 }
	 elseif($getG->rowCount()<1)//#If No Experience Details -->
	 {
	 ?>
	 <div class="panel panel-danger">
     <div class="panel-heading">Error!</div>
     <div class="panel-body">	  
	 <p>Make sure that you enter your graduate details before proceeding with this section</p>
	 </div>
     </div> 
	 <?php  
	 } */
	 //elseif($getBE->rowCount()>0 AND $getProf->rowCount()>0 AND $getG->rowCount()>0 
	// AND $getAp->rowCount()<1)//#If there is  basic education and Professional but no experience-->
	 elseif($getAp->rowCount()<1)
	 {
	 ?>
	 <div class="panel panel-primary">
     <div class="panel-heading">Enter your Registration details below!</div>
     <div class="panel-body">	  
	 <div class="table-responsive">
     <table class="table">
      <thead>
       <tr bgcolor="">
       <th colspan="6">
	   
	   <span style="float:right;"><a href="#addReg" class="btn btn-success btn-xs" data-toggle="modal" data-id="<?php echo $applicant_id; ?>" id="getaddReg"><i class="fa fa-plus"></i>Add New</a></span>
	   </th>
	  
       </tr> 
       </thead>
     </table>
	 </div>
	 </div>
     </div> 
	 <?php
	 }
	 elseif($getAp->rowCount()>0 OR isset($_POST['searchRegistration']))//<!--#If there is experience-->
	 {
	 ?> 
     <div class="panel panel-success">
     <div class="panel-heading">You have Submitted the following registration details!</div>
     <div class="panel-body">	  
	 <div class="table-responsive">
     <table class="table">
      <thead>
       <tr bgcolor="">
       <th colspan="6">
	   
	   <span style="float:right;"><a href="#addReg" class="btn btn-success btn-xs" data-toggle="modal" data-id="<?php echo $applicant_id; ?>" id="getaddReg"><i class="fa fa-plus"></i>Add New</a></span>
	   </th>
	   
       </tr>
	   
	   <tr bgcolor="">
       <th>Council Type</th>
	   <th>Reg Type</th>
	   <th>Reg No</th>
	   <th>Reg Year</th>
	   <th>Edit</th>
	   <th>Delete</th>
       </tr>
       </thead>
       <tbody>
	   
	   <?php while($row=$getAp->fetch()){?>
	   
	   <tr>
       <td><?php echo $row['council']; ?></td>
	   <td><?php echo $row['regType']; ?></td>
	   <td><?php echo $row['regNo']; ?></td>
	   <td><?php echo $row['regYear']; ?></td>

	   <td align="left">
		<a href="#editEdu" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $row['reg_id']; ?>" id="geteditEdu"><i class="fa fa-edit"></i>Edit</a>
	   </td>
												
	   <td align="left"> <a href="#deleteReg" class="btn btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $row['reg_id']; ?>" id="getdeleteReg"><i class="fa fa-trash"></i>Delete</a>
       </td>
       </tr>
	   
	   <?php } ?>

      </tbody>
     </table>
	 </div>
	 </div>
     </div>
	 
     <?php } else{} ?>	
	 
   </div>                                       
</div>





     <!--DEFINING MODALS--->
     <!--Module to add-->
     <div id="addReg" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Registration Details:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="addRegistration-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 <!--Module to delete-->
     <div id="deleteReg" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Registration Details:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="deleteRegistration-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>


