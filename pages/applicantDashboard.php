<?php
$applicant_id=$_SESSION['applicant_id'];

$getAp=$db->getApplicantsById($applicant_id);
$row=$getAp->fetch();

$baraza_id = $row['councilTypeID'];
$getBaraza = $db->getBarazaById($baraza_id);
$baraza=$getBaraza->fetch();

$cadreid = $row['cadreType'];
$selCadre = $db->getHealthCadresById($cadreid);
$rowCadre = $selCadre->fetch();
?>

<div class="row">
<div class="col-lg-12"><h2 class="page-header">Personal Details</h2></div>
</div>

<div class="row">         
  <div class="col-lg-12"> 
     <div class="panel panel-success">
     <div class="panel-heading"><p align="center">You have submitted the following personal details!. Now you can proceed with registration process by filling education details. To fill education details, click on education details link OR click on Next button below this page.</p></div>
      <div class="panel-body">	
        <div class="col-md-3">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr bgcolor="">
                  <th colspan="2">
                    Passport size photograph
                  </th>                                   
                </tr>
              </thead>
                <tbody>
                  <tr>
                    <td class="text-center"> 
                    <?php 
                    	//get cetificate type
                        $getPass=$db->getDocType('Passport size');
                        $pass=$getPass->fetch();
                        $passport=$pass['DocumentID'];

                    	//Check if file uploaded
                      $checkPass=$db->checkIfFileExist($passport,$applicant_id);

                      if($checkPass->rowCount()>0)
                      {
                        $pspt = $checkPass->fetch();
                    ?>
                    <div id="passCnDIV">
                    <img src="documents/<?=$pspt['docName']?>.<?=$pspt['extension']?>" height="120px" width="120px" class="img img-responsive img-thumbnail" alt="Passport size photograph"> 
                      <br><br>
                        <button class="btn btn-xs btn-primary" onclick='$("#passCnDIV").hide();$("#passSaveDIV").show();' >  <i class="fa fa-edit"></i> Change Photograph </button>
                    </div>
                    <?php }else{ ?>
                        <div id="passUpDIV">
                          <span class="blinking">Please, Upload now!</span>
                          <br><br>
                          <button class="btn btn-xs btn-primary" onclick='$("#passUpDIV").hide();$("#passSaveDIV").show();' > Upload Photograph </button>
                        </div>
                    <?php } ?>
                        <div id="passSaveDIV" style="display:none;">
                            <form  enctype="multipart/form-data"  action="includes/process.php" method="post">
                              <input type="file" name="photo" id="" class="form-control"  accept="image/png,image/jpeg">
                              <br>
                              <span class="text-danger">
                                  <small>Only .jpg or .png file types allowed. <br> Max size allowed is 500KB <br> Should not exceed width/height 300/300 pixels.  </small>
                              </span>
                              <br>
                              <input type="hidden" name="docuType" value="<?=$passport?>">
                              <input type="hidden" name="applicant_id" value="<?=$applicant_id?>">
                              <input type="submit" name="uploadPassportSize" value="Save" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr bgcolor="">
                  <th colspan="2">
                    Certificate of Birth
                  </th>                                   
                </tr>
              </thead>
                <tbody>
                  <tr>
                    <td class="text-center"> 
                    <?php 
                    	//get cetificate type
                        $getBirthCertificate=$db->getDocType('Birth Certificate');
                        $birthCert=$getBirthCertificate->fetch();
                        $birthCertificate=$birthCert['DocumentID'];
                        // echo 'birthCertificate='.$birthCertificate;
                    	//Check if file uploaded
                      $checkCertificate=$db->checkIfFileExist($birthCertificate,$applicant_id);

                      if($checkCertificate->rowCount()>0)
                      {
                        $bcertificate = $checkCertificate->fetch();
                        $doc_id = $bcertificate['id'];
                    ?>
                    <div id="certCnDIV">
                      <img src="img/birth_certificate.png" class="img img-responsive img-thumbnail" alt="Birth Certificate"> 
                      <br><br>
                          <a href="#docuView" class="btn btn-info btn-xs" data-toggle="modal"  data-docid="<?php echo $doc_id; ?>" id="viewDocu"><i class="fa fa-folder"></i> View </a>

                        <button class="btn btn-xs btn-primary" onclick='$("#certCnDIV").hide();$("#certSaveDIV").show();' > <i class="fa fa-edit"></i>  Change Birth Certificate </button>
                    </div>
                    <?php }else{ ?>
                        <div id="certUpDIV">
                          <span class="blinking">Please, Upload now!</span>
                          <br><br>
                          <button class="btn btn-xs btn-primary" onclick='$("#certUpDIV").hide();$("#certSaveDIV").show();' > Upload Birth Certificate </button>
                        </div>
                    <?php } ?>
                        <div id="certSaveDIV" style="display:none;">
                            <form  enctype="multipart/form-data"  action="includes/process.php" method="post">
                              <input type="file" name="photo" id="" class="form-control"  accept=".pdf, application/pdf">
                              <br>
                              <span class="text-danger">
                                  <small>Only .pdf file types allowed. <br> Max size allowed is 1MB/1024KB  <br> </small>
                              </span>
                              <br>
                              <input type="hidden" name="docuType" value="<?=$birthCertificate?>">
                              <input type="hidden" name="applicant_id" value="<?=$applicant_id?>">
                              <input type="submit" name="uploadCertificate" value="Save" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div> 	
        <div class="col-md-9">
          <div class="table-responsive">
            <table class="table">
              <thead>
              <tr bgcolor="">
              <th colspan="2">
              Personal Information
              <span style="float:right;"><a href="#editApplicant" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $applicant_id; ?>" id="geteditApplicant"><i class="fa fa-edit"></i>Edit</a></span>
              </th>                                   
                </tr>
                </thead>
                <tbody>
            
                <tr>
                <td><strong>Full Name</strong></td><td><?php echo stripslashes($row['firstname']." ".$row['middlename']." ".$row['lastname']); ?></td>
                </tr>
            
            <tr>
              <td><strong>Gender</strong></td><td><?php echo $row['gender']; ?></td>
              </tr>
            
            <tr>
              <td><strong>DOB</strong></td><td><?php echo $row['dob']; ?></td>
              </tr>
            
            <tr>
              <td><strong>Marital Status</strong></td><td><?php echo $row['maritalStatus']; ?></td>
              </tr>
            
            <tr>
              <td><strong>Nationality</strong></td><td><?php echo $row['value']; ?></td>
            </tr>

            <tr>
              <td><strong>NIDA</strong></td><td><?php echo $row['nida']; ?></td>
            </tr>
            <!-- nida,councilTypeID,councilRegistrationID -->
            
            <tr>
              <td><strong>Cadre Type</strong></td><td><?php echo $rowCadre['cadreName']; ?></td>
            </tr>
            <tr>
              <td><strong>Council Type</strong></td><td><?php echo $baraza['name']; ?></td>
            </tr>
            
            <tr>
              <td><strong>Council Registration ID</strong></td><td><?php echo $row['councilRegistrationID']; ?></td>
            </tr>

            <tr>
              <td><strong>Previous Employment status</strong></td><td><?php echo $row['employed']; ?></td>
            </tr>

            <?php if($row['employed']=='YES'){ ?>
            <tr>
              <td><strong>Check Number</strong></td><td><?php echo $row['checkNumber']; ?></td>
            </tr>
          <?php } ?>

            <tr>
              <td><strong>Country</strong></td><td><?php echo $row['country']; ?></td>
            </tr>

            <tr>
              <td><strong>Disiability Status</strong></td><td><?php echo $row['disiability']; ?></td>
            </tr>

          <?php if($row['disiability']=='YES'){ ?>
            <tr>
              <td><strong>Disiability type</strong></td><td><?php echo $row['disiability_type']; ?></td>
            </tr>

            <tr>
              <td><strong>Other Disiability</strong></td><td><?php echo $row['other_disiability']; ?></td>
            </tr>
          <?php } ?>

            <tr>
              <td><strong>Postal Address</strong></td><td><?php echo $row['address']; ?></td>
              </tr>
            
            <tr>
              <td><strong>Phone Number</strong></td><td><?php echo $row['phone']; ?></td>
              </tr>
            
            
            <tr>
              <td><strong>Email</strong></td><td><?php echo $row['email']; ?></td>
              </tr>
            
            <tr>
              <td colspan="2" align="right">
            <span style="float:right;"><a 
            <?php  if($checkPass->rowCount()<=0) { ?>
                onclick="docMissingError('Passport size photograph ')";
            <?php }elseif ($checkCertificate->rowCount()<=0) {?>
                onclick="docMissingError('Certificate of Birth ')";
            <?php }else{?>
              href="?pg=bEd" 
            <?php } ?>
            class="btn btn-primary btn">Next</a></span>
            </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
	    </div>
 

<!--Modal: View Documents-->
<div id="docuView" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Preview Document</h4>
      </div>
      <div class="modal-body"> 	 
	     <div id="previewdocu-content"> <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div> </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
</div> 
</div> 


<div id="addPass" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Passport size photograph:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="" class="col-md-4 col-md-offset-4"> 
    
     <!-- <img id="blah" src="" alt="" /> -->

     <input type='file' class="form-control" onchange="readURL(this);" />

     </div>
     
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
     

     <!--DEFINING MODALS--->
     <!--Module to Edit Personal-->
     <div id="editApplicant" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Personal Details:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="editApplicant-content"> <div class="text-center"><i class="fa fa-spin fa-spinner fa-5x text-primary"></i></div> </div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>


<style>
.blinking{
    animation:blinkingText 1.0s infinite;
    font-weight: 200px;
    font-size: 20px;
}
@keyframes blinkingText{
    0%{     color: #ff0000;    }
    49%{    color: #ff0000; }
    60%{    color: transparent; }
    99%{    color: transparent;  }
    100%{   color: #ff0000;    }
}

img{
  max-width:180px;
}
/* input[type=file]{
padding:10px;
background:#2d2d2d; */
}

</style>

<script>
      function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
      
      function docMissingError(str){
        alert('To proceed, please, upload your '+str);
      }
</script>