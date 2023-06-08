<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Manage Posted Applicants</h1>
 </div>                  
</div>        
<div class="row">
                   

<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
							 List of Posted Applicants
							</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
											    <th>SN</th>
                                                <th>Name</th>
                                                <th>Gender</th>
												<th>DOB</th>
												<th>View</th>
												<?= $_SESSION['permissions']['can_accept_posted_applicants']=='YES' ? '<th>Accept</th>' : ''; ?>
												<?= $_SESSION['permissions']['can_reject_posted_applicants']=='YES' ? '<th>Reject</th>' : ''; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
					                    $i=1;
					                    $sel=$db->getAllPostedApplicants('Pending'); 
					                    while($row=$sel->fetch())
					                    {
                                         $applicant_id=$row['id']; 
                                         $allocation_id = $row['allocate_id'];
										 $getAp=$db->getApplicationByAppId($applicant_id);
                                         $getDocu=$db->getDocuments($applicant_id);
                                         $getReg=$db->getRegistrationByAppId($applicant_id);
                                         $getExp=$db->getExperienceByAppId($applicant_id);
                                         $getProf=$db->getProfessionalByAppId($applicant_id);
                                         $getBE=$db->getEducationByAppId($applicant_id);
										 $getG=$db->getGraduatesByAppId($applicant_id);
										 
										?>
                                            <tr class="odd gradeX">
											    <td><?php echo $i; ?></td>
                                                <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                                                <td><?php echo $row['gender']; ?></td>
                                                <td><?php echo $row['dob']; ?></td>
												
                                                <td align="left">
												   <a href="?pg=mngAppDetails&id=<?php echo $applicant_id; ?>" class="btn btn-info btn-xs" target=_blank><i class="fa fa-folder"></i>More Details</a>
												</td>
                                                <?php if($_SESSION['permissions']['can_accept_posted_applicants']=='YES'){ ?>
												<td align="left">
												   <a href="includes/process.php?acceptAgenceyApplicant&allocation_id=<?php echo $allocation_id; ?>&applicant_id=<?php echo $applicant_id; ?>" class="btn btn-success btn-xs"><i class="fa fa-edit">Accept</i></a>
                                                </td>
                                                <?php } ?>
                                                <?php if($_SESSION['permissions']['can_reject_posted_applicants']=='YES'){?>
												<td align="left">
												   <a href="#rejectApplicants" class="btn btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $allocation_id; ?>" id="getRejectedApplicants"><i class="fa fa-times"></i> Reject</a>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                        <?php $i++;} ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                                
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>           
</div>



     <!--DEFINING MODALS--->
     <!--Module to Add New User -->
     <div id="addUser" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New User:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="addUser-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 <!--Module to delete applicant-->
     <div id="deleteApplicant" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Applicant</h4>
     </div>
      <div class="modal-body">
     
	  <div id="deleteApplicant-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>


     <!--Module to Approve Application -->
     <div id="rejectApplicants" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Reject Applicants:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="rejectApplicants-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>


          