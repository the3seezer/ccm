<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Application</h1>
 </div>                  
</div>        
<div class="row">
                   

<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
							 List of Applications
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
												<th>Marital Status</th>
                                                <th>Phone</th>
												<th>App Date</th>
                                                <th>Choices</th>
												<th>View</th>
												<?= $_SESSION['permissions']['can_perform_manual_approve']=='YES' ? '<th>Approve</th>' : ''; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
					                    $i=1;
					                    $sel=$db->getApplicantsWithPendingApplication(); 
					                    while($rw=$sel->fetch())
					                    {
										$applicant_id=$rw['applicant_id'];
										
										//Get Applicants Details
										$getAp=$db->getApplicantsById($applicant_id);
										$row=$getAp->fetch();
										?>
                                            <tr class="odd gradeX">
											    <td><?php echo $i; ?></td>
                                                <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                                                <td><?php echo $row['gender']; ?></td>
                                                <td><?php echo $row['dob']; ?></td>
												<td><?php echo $row['maritalStatus']; ?></td>
												<td><?php echo $row['phone']; ?></td>
												<td><?php echo $rw['date']; ?></td>
												
                                                <td align="left">
												   <a href="#viewChoices" class="btn btn-success btn-xs" data-toggle="modal" data-id="<?php echo $applicant_id; ?>" id="getChoices"><i class="fa fa-file">
												   </i>View Choices</a>
												</td>
												
												<td align="left">
												   <a href="?pg=mngAppDetails&id=<?php echo $applicant_id; ?>" class="btn btn-info btn-xs" target=_blank><i class="fa fa-folder"></i>View Profile</a>
												</td>
                                                
                                                <?php if($_SESSION['permissions']['can_perform_manual_approve']=='YES'){?>
												<td align="left">
		                                         <a href="#approveApp" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $applicant_id; ?>" id="getApproveApp"><i class="fa fa-edit"></i>Approve</a>
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
	 
	 
	 <!--Module to View Choices-->
     <div id="viewChoices" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Choices</h4>
     </div>
      <div class="modal-body">
     
	  <div id="viewChoices-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 <!--Module to Approve Application -->
     <div id="approveApp" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Approve Application:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="approveApplication-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>


          