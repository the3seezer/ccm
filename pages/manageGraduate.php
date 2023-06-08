<?php
$applicant_id=$_SESSION['applicant_id'];

$getBE=$db->getEducationByAppId($applicant_id);

$getProf=$db->getProfessionalByAppId($applicant_id);

$getG=$db->getGraduatesByAppId($applicant_id);
?>

<div class="row">
<div class="col-lg-12"><h2 class="page-header">Graduate Details</h2></div>
</div>

<div class="row">
                    
  <div class="col-lg-12">
  
     <?php
   if(isset($_POST['searchGraduate']))
    {
	  $regNo=$_POST['collegRegNo'];
	  $instID=$_POST['instID'];
	  $progID=$_POST['progID'];
 	  $acYear=$_POST['acYear'];
	  $eduLevel=$_POST['eduLevel'];
	  $applicant_id=$_POST['applicant_id'];
	  $prof_id=$_POST['prof_id'];
	 
	  //Get Names
	  $getNames=$db->getApplicantsById($applicant_id);
	  $row=$getNames->fetch();
	  $firstname=ucwords(strtolower($row['firstname']));
	  $lastname=ucwords(strtolower($row['lastname']));
	  $verifyName=$firstname.$lastname;
	 
      //$regNo="CMT6/KLS/16/01";

	  //Check if user exist
	  $curl = curl_init();

      //Set some options/settings
      curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL =>'http://tiis.go.tz/training/api2/graduate/read_one3.php?RegNum='.$regNo.'&InstitutionID='.$instID.'&ProgrammeID='.$progID.'&AccademicYear='.$acYear.'',
		
      CURLOPT_USERAGENT => 'TIIS to WAO cURL Request'
      ));
        
       // Send the request & save response to $resp(JSON string)
        if(!curl_exec($curl)){ 
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }else{
	    $json_resp = curl_exec($curl);
        }

        //Close request to clear up some resources
        curl_close($curl);

        // Convert JSON string to Array
        $institutionArray = json_decode($json_resp, true);
       
	    $countArr=count($institutionArray);
		
	    $regNum=$institutionArray['RegNum'];
		
		if($regNum=="")
		{
		  //IF NO RECORD, VERIFICATION FAILED
		  ?>
		  <div class="panel panel-danger">
          <div class="panel-heading">Verification failed. Try agian to enter correct registration number!</div>
	      <div class="panel-body">	  
	      <div class="table-responsive">
          <table class="table">
          <thead>
	  
          <tr bgcolor="">
           <th colspan="7">
	       </th>
          </tr>
	   
	      <tr bgcolor="">
           <th>Education Level</th>
	       <th>Study Country</th>
	       <th>College</th>
	       <th>Programme</th>
	       <th>Completed Year</th>
	       <th>Status</th>
	       <th>Verify</th>
           </tr>
          </thead>
          <tbody>
	      <?php while($row=$getProf->fetch())
		  { 
	        $PID=$row['programme_id'];
	        $INSID=$row['college'];
			$status=$row['status'];
			
			
	   
	   
	        ////////////////////////////////////
	        ///////////////////////////////////
	        ////GET INSTITUTION  BY INSID//////
	        ///////////////////////////////////
	        ///////////////////////////////////
	        $curl = curl_init();

            //Set some options/settings
           curl_setopt_array($curl, array(
           CURLOPT_RETURNTRANSFER => 1,
           CURLOPT_URL => 'http://41.93.40.136/nacteapi/index.php/institutions/'.$INSID.'',
           CURLOPT_USERAGENT => 'WAO to NACTE cURL Request'
           ));

           //Send the request & save response to $resp(JSON string)
           if(!curl_exec($curl)){
           die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
           }else{
	       $json_resp = curl_exec($curl);
            }

            //Convert JSON string to Array
            $institutionsArray = json_decode($json_resp, true);
		    $iName=$institutionsArray['Institution_Name'];
		


           ///////////////////////////////
	       //////////////////////////////
	       ////GET PROGRAMME BY PID//////
	       /////////////////////////////
	       ////////////////////////////
	   
	       $curl1 = curl_init();

           //Set some options/settings
           curl_setopt_array($curl1, array(
           CURLOPT_RETURNTRANSFER => 1,
           CURLOPT_URL => 'http://41.93.40.136/nacteapi/index.php/program_details/'.$PID.'',
           CURLOPT_USERAGENT => 'WAO to NACTE cURL Request'
           ));

           //Send the request & save response to $resp(JSON string)
           if(!curl_exec($curl1)){
           die('Error: "' . curl_error($curl1) . '" - Code: ' . curl_errno($curl1));
           }else{
	       $json_resp1 = curl_exec($curl1);
           }

          //Convert JSON string to Array
          $programmeArray = json_decode($json_resp1, true);
          foreach($programmeArray as $value1)
	      {
		   $progName=$value1['Name'];
	      }
	      ?>
	   
	      <tr>
          <td><?php echo $row['level']; ?></td>
	      <td><?php echo $row['location']; ?></td>
	      <td><?php echo $INSID; ?></td>
	      <td><?php echo $progName; ?></td>
	      <td><?php echo $row['year']; ?></td>
	   
	      <?php
	      if($status=="No")
	      {
	      ?>
	       <td align="left"><button  class="btn btn-danger btn-xs">Not Verified</button></td>
	   
	       <td align="left">
	      <a href="#verifyPro" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $row['prof_id']."=".$INSID."=".$PID; ?>" id="getverifyPro">Verify</a>
           </td>
	      <?php
	      }
	       elseif($status=="Yes")
	       {
	        ?>
		    <td align="left"><button  class="btn btn-success btn-xs">Verified</button></td>
	       <?php
	       }else{}
	       ?>
		  
          </tr>
	   
	      <?php } ?>
	  
          </thead>
          <tbody> 
          </tbody>
          </table>
	      </div>
	      </div>
	      </div>	
		  <?php
		 }
		 else
		 {
		 ?>
		 <div class="panel panel-primary">
         <div class="panel-heading">Verify the following professional details!</div>
	     <div class="panel-body">	  
	     <div class="table-responsive">
          <table class="table">
          <thead>
	  
          <tr bgcolor="">
          <th colspan="7">
	      
	   
	     </th>
         </tr>
	   
	     <tr bgcolor="">
          <th>Education Level</th>
	      <th>Study Country</th>
	      <th>College</th>
	      <th>Programme</th>
	      <th>Completed Year</th>
	      <th>Status</th>
	      <th>Verify</th>
         </tr>
         </thead>
         <tbody>
	      <?php 
		  while($row=$getProf->fetch()){ 
	      $PID=$row['programme_id'];
	      $INSID=$row['college'];
	      //$status=$row['status'];
	     
	     
	   
	       ////////////////////////////////////
	       ///////////////////////////////////
	       ////GET INSTITUTION  BY INSID//////
	       ///////////////////////////////////
	       ///////////////////////////////////
	       $curl = curl_init();

           //Set some options/settings
           curl_setopt_array($curl, array(
           CURLOPT_RETURNTRANSFER => 1,
           CURLOPT_URL => 'http://41.93.40.136/nacteapi/index.php/institutions/'.$INSID.'',
           CURLOPT_USERAGENT => 'WAO to NACTE cURL Request'
           ));

          //Send the request & save response to $resp(JSON string)
          if(!curl_exec($curl)){
            die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
          }else{
	       $json_resp = curl_exec($curl);
           }

           //Convert JSON string to Array
           $institutionsArray = json_decode($json_resp, true);
		   $iName=$institutionsArray['Institution_Name'];
	      	

 
           ///////////////////////////////
	       //////////////////////////////
	       ////GET PROGRAMME BY PID//////
	      /////////////////////////////
	      ////////////////////////////
	   
	      $curl1 = curl_init();

           //Set some options/settings
          curl_setopt_array($curl1, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => 'http://41.93.40.136/nacteapi/index.php/program_details/'.$PID.'',
          CURLOPT_USERAGENT => 'WAO to NACTE cURL Request'
          ));

          //Send the request & save response to $resp(JSON string)
           if(!curl_exec($curl1)){
          die('Error: "' . curl_error($curl1) . '" - Code: ' . curl_errno($curl1));
          }else{
	      $json_resp1 = curl_exec($curl1);
          }

            //Convert JSON string to Array
            $programmeArray = json_decode($json_resp1, true);
           foreach($programmeArray as $value1)
	       {
		   $progName=$value1['Name'];
	       }
	       ?>
	   
	       <tr>
           <td><?php echo $row['level']; ?></td>
	       <td><?php echo $row['location']; ?></td>
	       <td><?php echo $INSID; ?></td>
	       <td><?php echo $progName; ?></td>
	       <td><?php echo $row['year']; ?></td>
	   
	      <?php
	      if($row['status']=="No")
	      {
	      ?>
	      <td align="left"><button  class="btn btn-danger btn-xs">Not Verified</button></td>
	   
	      <td align="left">
	      <a href="#verifyPro" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $row['prof_id']."=".$INSID."=".$PID; ?>" id="getverifyPro">Verify</a>
           </td>
	       <?php
	       }
	      elseif($row['status']=="Yes")
	      {
	       ?>
	       <td align="left"><button  class="btn btn-success btn-xs">Verified</button></td>
	       <?php
	      }else{}
	       ?>
	   
           </tr>
	   
	       <?php } ?>
	  
           </thead>
          <tbody> 
          </tbody>
          </table>
	      </div>
	      </div>
	      </div>
		 <?php
	        $regNum=$institutionArray['RegNum'];
			$instID1=$institutionArray['InstitutionID'];
			$PID1=$institutionArray['ProgrammeID'];
			$acYear1=$institutionArray['AccademicYear'];
			$gpa=$institutionArray['GPA'];
			$fname=ucwords(strtolower($institutionArray['FirstName']));
			$lname=ucwords(strtolower($institutionArray['LastName']));
			$level=$institutionArray['Level'];
			$fulName=$fname." ".$lname;
			$verifyName1=$fname.$lname;
			
			
			$curl11 = curl_init();

           //Set some options/settings
           curl_setopt_array($curl11, array(
           CURLOPT_RETURNTRANSFER => 1,
           CURLOPT_URL => 'http://41.93.40.136/nacteapi/index.php/program_details/'.$PID1.'',
           CURLOPT_USERAGENT => 'WAO to NACTE cURL Request'
           ));

           //Send the request & save response to $resp(JSON string)
           if(!curl_exec($curl11)){
           die('Error: "' . curl_error($curl11) . '" - Code: ' . curl_errno($curl11));
           }else{
	       $json_resp11 = curl_exec($curl11);
           }

           //Convert JSON string to Array
           $programmeArray1 = json_decode($json_resp11, true);
           foreach($programmeArray1 as $value11)
	       {
		    $progName1=$value11['Name'];
	       }
	       ?>
	   
	   
	      <!--#-->
	      <div class="panel panel-info">
         <div class="panel-heading">Verification process</div>
	     <div class="panel-body">	  
	     <div class="table-responsive1">
          <table class="table" border="1" width="100%">
          <thead>
	  
          <tr bgcolor="">
          Part 1: Names Verification
          </tr>
	   
	     <tr bgcolor="">
          <th>Your Names</th>
	      <th>Names returned after entering RegNo</th>
	      <th>Verify Status</th>
         </tr>
		 </thead>
		 
		 <tbody>
		 <tr>
           <td><?php echo $firstname." ".$lastname; ?></td>
	       <td><?php echo $fulName; ?></td>
	       <td>
		   <?php if($verifyName==$verifyName1)
		   { 
	        $verify1=1;
	       echo "<button  class='btn btn-success btn-xs'>Verification Success: Names Match</button>";
		   }
		   else
		   { 
	        $verify1=2;
	       echo "<button  class='btn btn-danger btn-xs'>Verification Error : Names do not match</button>"; 
		   }
		   ?>
		   </td>
		 </tr>
		 </tbody>
		 </table>
		 
		 <br/><br/>
		 
		 <table class="table" border="1" width="100%">
          <thead>
	  
          <tr bgcolor="">
          Part 2: Professional Verification
          </tr>
	   
	     <tr bgcolor="">
          <th colspan="6">Professional details returned after entering RegNo</th>
         </tr>
		 
		 <tr>
		   <th>Education Level</th>
	       <!--<th>Study Country</th>-->
	       <th>College</th>
	       <th>Programme</th>
	       <th>Completed Year</th>
	       <th>Verify Status</th>
		 </tr>
		 </thead>
		 
		 <tbody>
		 <tr>
           <td><?php echo $level; ?></td>
	       <!--<td><?php //echo $fulName; ?></td>-->
		   <td><?php echo $instID1; ?></td>
		   <td><?php echo $progName1; ?></td>
		   <td><?php echo $acYear1; ?></td>
	       <td><?php 
		   if(($instID1==$instID) AND ($PID1==$progID) AND ($acYear1==$acYear) AND ($level== $eduLevel))
		   {
			  $verify2=1;
			echo "<button  class='btn btn-success btn-xs'>Verification Success: ".$level." profesional details match</button>";}
			else
			 {
			 $verify2=2;
			echo "<button  class='btn btn-danger btn-xs'>Verification Error : Professional details do not match</button>";
			}?>
		  </td>
		 </tr>
		 </tbody>
		 </table>
		 <?php
			
			//UPDATE PROFESSIONAL DETAILS
			
		
			if($verify1==$verify2)
			{
			 
             $update=$db->updateProfessionalStatus($prof_id);
			 
			 //Insert into graguate table
			 $insert=$db->insertGraduatesDetails($prof_id,$instID,$progID,$acYear,$eduLevel,$gpa,$applicant_id);

              
              if(isset($update))
              {
              echo "<p align='center'><button  class='btn btn-success btn-xs'>Verification Success</button></p>";           
			  }	
              else
              {
			   echo "<p align='center'><button  class='btn btn-danger btn-xs'>Verification Failed</button></p>";  
              }				  
				
			}
			else{
				
				 echo "<p align='center'><button  class='btn btn-danger btn-xs'>Verification Failed</button></p>";  	
			}

		}
	  ?>
       
	<!--Panel if basic education is not entered-->
	<?php
	}
	elseif($getProf->rowCount()<1)
	{
	?>
	<div class="panel panel-danger">
      <div class="panel-heading">Error!</div>
      <div class="panel-body">	  
	   <p>Make sure that you enter your proffesional details before proceeding with this section</p>
	  </div>
    </div> 
	<?php
	}
	elseif(($getProf->rowCount()>0 AND $getG->rowCount()<1) OR ($getG->rowCount()>0))//Panel if  basic education is entered and profesional is not entered
	{
	?>
	 <div class="panel panel-primary">
     <div class="panel-heading"><p>Verify your Graduate details below by clicking on verify button along side each professional details. After verifying your graguate click on next button to continue with application process.</p></div>
	 <div class="panel-body">	  
	 <div class="table-responsive">
     <table class="table">
      <thead>
	  
       <tr bgcolor="">
       <th colspan="7">
	   </th>
       </tr>
	   
	   <tr bgcolor="">
       <th>Education Level</th>
	   <th>Study Country</th>
	   <th>College</th>
	   <th>Programme</th>
	   <th>Completed Year</th>
	   <th>Status</th>
	   <th>Verify</th>
       </tr>
       </thead>
       <tbody>
	   
	   <?php while($row=$getProf->fetch()){ 
	   $PID=$row['programme_id'];
	   $INSID=$row['college'];
	   $status=$row['status'];
	   
	   
	   ////////////////////////////////////
	   ///////////////////////////////////
	   ////GET INSTITUTION  BY INSID//////
	   ///////////////////////////////////
	   ///////////////////////////////////
	   $curl = curl_init();

       //Set some options/settings
       curl_setopt_array($curl, array(
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_URL => 'http://41.93.40.136/nacteapi/index.php/institutions/'.$INSID.'',
       CURLOPT_USERAGENT => 'WAO to NACTE cURL Request'
       ));

      //Send the request & save response to $resp(JSON string)
       if(!curl_exec($curl)){
       die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
       }else{
	   $json_resp = curl_exec($curl);
       }

       //Convert JSON string to Array
       $institutionsArray = json_decode($json_resp, true);
	   $iName=$institutionsArray['Institution_Name'];
		


       ///////////////////////////////
	   //////////////////////////////
	   ////GET PROGRAMME BY PID//////
	   /////////////////////////////
	   ////////////////////////////
	   
	   $curl1 = curl_init();

       //Set some options/settings
       curl_setopt_array($curl1, array(
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_URL => 'http://41.93.40.136/nacteapi/index.php/program_details/'.$PID.'',
       CURLOPT_USERAGENT => 'WAO to NACTE cURL Request'
       ));

      //Send the request & save response to $resp(JSON string)
       if(!curl_exec($curl1)){
       die('Error: "' . curl_error($curl1) . '" - Code: ' . curl_errno($curl1));
       }else{
	   $json_resp1 = curl_exec($curl1);
       }

      //Convert JSON string to Array
       $programmeArray = json_decode($json_resp1, true);
       foreach($programmeArray as $value1)
	   {
		   $progName=$value1['Name'];
	   }
	   ?>
	   
	   <tr>
       <td><?php echo $row['level']; ?></td>
	   <td><?php echo $row['location']; ?></td>
	   <td><?php echo $iName; ?></td>
	   <td><?php echo $progName; ?></td>
	   <td><?php echo $row['year']; ?></td>
	   
	   <?php
	   if($status=="No")
	   {
	   ?>
	   <td align="left"><button  class="btn btn-danger btn-xs">Not Verified</button></td>
	   
	   <td align="left">
	     <a href="#verifyPro" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $row['prof_id']."=".$INSID."=".$PID; ?>" id="getverifyPro">Verify</a>
       </td>
	   <?php
	   }
	   elseif($status=="Yes")
	   {
	   ?>
	   <td align="left"><button  class="btn btn-success btn-xs">Verified</button></td>
	   <?php
	   }else{}
	   ?>
											
	   
       </tr>
	   
	   <?php } ?>
	   

       </thead>
       <tbody> 
      </tbody>
     </table>
	   <hr/>
	   <br/>
	   <span style="float:right;"><a href="?pg=mngapp" title="Go to Application" class="btn btn-primary btn">Next</a></span>
	 </div>
	 </div>
	 </div>
	<?php
	}
	else{}
	?>
   </div>                                       
</div>





     <!--DEFINING MODALS--->
     <!--Module to verify-->
     <div id="verifyPro" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Verify Graduate Details:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="verifyGraduate-content"> <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div> </div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 <!--Module to Edit-->
     <div id="editPro" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Proffesional Details:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="editProffesional-content"> <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div> </div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 <!--Module to Delete-->
     <div id="deletePro" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Proffesional Details:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="deleteProffesional-content"> <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div> </div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>


