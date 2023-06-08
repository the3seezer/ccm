<?php
$applicant_id=$_SESSION['applicant_id'];

$getBE=$db->getEducationByAppId($applicant_id);

$getProf=$db->getProfessionalByAppId($applicant_id);

$getExp=$db->getExperienceByAppId($applicant_id);


//$getG=$db->getGraduatesByAppId($applicant_id);

//$getReg=$db->getRegistrationByAppId($applicant_id);
?>

<div class="row">
<div class="col-lg-12"><h2 class="page-header">Experience Details</h2></div>
</div>

<div class="row">
                    
  <div class="col-lg-12">
     
	 <!--#If No basic education details-->
	 <?php
         //get cetificate type
         $getPass=$db->getDocType('Passport size');
         $pass=$getPass->fetch();
         $passport=$pass['DocumentID'];
         //Check if file uploaded
         $checkPass=$db->checkIfFileExist($passport,$applicant_id);
   
         //get cetificate type
         $getBirthCertificate=$db->getDocType('Birth Certificate');
         $birthCert=$getBirthCertificate->fetch();
         $birthCertificate=$birthCert['DocumentID'];
         //Check if file uploaded
         $checkCertificate=$db->checkIfFileExist($birthCertificate,$applicant_id);
   
      if($checkPass->rowCount()<=0) { ?>
       <div class="panel panel-danger">
           <div class="panel-heading">Error!</div>
           <div class="panel-body">
           <p>Personal Details missing!. Make sure you have uploaded <b>Passport size photograph</b> before proceeding with this section</p>
           </div>
       </div>
   <?php }elseif ($checkCertificate->rowCount()<=0) {?>
       <div class="panel panel-danger">
           <div class="panel-heading">Error!</div>
           <div class="panel-body">
           <p>Personal Details missing!. Make sure you have uploaded <b>Certificate of Birth</b> before proceeding with this section</p>
           </div>
       </div>
   <?php 
   }
	elseif($getBE->rowCount()<1)
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
	 elseif($getBE->rowCount()>0 AND $getProf->rowCount()>0 AND $getExp->rowCount()<1)//#If there is  basic education and Professional but no experience-->
	 {
	 ?>
	  <div class="panel panel-primary">
    <div class="panel-heading">Enter your experience details by clicking on add new button below. If you don't have any work experience, click on next button so as to go on document details.</div>
   <div class="panel-body">	  
	 <div class="table-responsive">
     <table class="table">
      <thead>
       <tr bgcolor="">
       <th colspan="7">
	   
	   <span style="float:right;"><a href="#addExp" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $applicant_id; ?>" id="getaddExp"><i class="fa fa-plus"></i>Add New</a></span>
	   </th>
	   
       </tr>
       </thead>
     </table>
	 <hr/>
	   <br/>
	   <span style="float:right;"><a href="?pg=DocD" class="btn btn-primary btn">Next</a></span>
	 </div>
	 </div>
     </div> 
	 <?php
	 }
	 elseif($getExp->rowCount()>0)//<!--#If there is experience-->
	 {
	 ?>
    <div class="panel panel-success">
     <div class="panel-heading">
	 <p align="center">You have submitted the following work experience details. To add another work experience details, click on add new button. If you do not have any other experience click on next button so as to go on document details.</p>
</div>
     <div class="panel-body">	  
	 <div class="table-responsive">
     <table class="table">
      <thead>
       <tr bgcolor="">
       <th colspan="7">
	   
	   <span style="float:right;"><a href="#addExp" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $applicant_id; ?>" id="getaddExp"><i class="fa fa-plus"></i>Add New</a></span>
	   </th>
	   
       </tr>
	   
	   <tr bgcolor="">
       <th>Employer Name</th>
	   <th>Duty Post</th>
	   <th>Employment Contract </th>
	   <th>Start Date</th>
	   <th>End Date</th>
	   <th>Edit</th>
	   <th>Delete</th>
       </tr>
       </thead>
       <tbody>
	   
	   <?php while($row=$getExp->fetch()){?>
	   
	   <tr>
       <td><?php echo $row['employer']; ?></td>
	   <td><?php echo $row['duty']; ?></td>
	   <td><?php echo $row['employType']; ?></td>
	   <td><?php echo $row['start']; ?></td>
	   <td><?php if($row['end']=='0'){ echo '-';}else{echo $row['end'];} ?></td>
	   <td align="left">
		<a href="#editExp" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $row['exp_id']; ?>" id="geteditExp"><i class="fa fa-edit"></i>Edit</a>
	   </td>
												
	   <td align="left"> <a href="#deleteExp" class="btn btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $row['exp_id']; ?>" id="getdeleteExp"><i class="fa fa-trash"></i>Delete</a>
       </td>
       </tr>
	   
	   <?php } ?>
	   
	   
      </tbody>
     </table>
	 <hr/>
	   <br/>
	   <span style="float:right;"><a href="?pg=DocD" class="btn btn-primary btn">Next</a></span>
	 </div>
	 </div>
     </div>
     <?php } else{}?>	 
   </div>                                       
</div>





     <!--DEFINING MODALS--->
     <!--Module to add-->
     <div id="addExp" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Experience Details:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="addExperience-content"> <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div> </div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 <!--Module to Edit-->
     <div id="editExp" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Experience Details:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="editExperience-content"> <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div> </div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 
	 
	 <!--Module to delete-->
     <div id="deleteExp" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Experience Details:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="deleteExperience-content"> <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div> </div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>


