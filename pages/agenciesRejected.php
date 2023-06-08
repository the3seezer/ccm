<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Manage Applicants</h1>
 </div>                  
</div>        
<div class="row">
                   

<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
							 List of Rejected Applicants
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
                                                <th>Rejection Reason</th>
												<th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
					                    $i=1;
					                    $sel=$db->getAllPostedApplicants('Rejected'); 
					                    while($row=$sel->fetch())
					                    {
										 $applicant_id=$row['id']; 
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
                                                <td><?php echo $row['rejection_reason']; ?></td>
												
                                                <td align="left">
												   <a href="?pg=mngAppDetails&id=<?php echo $applicant_id; ?>" class="btn btn-info btn-xs" target=_blank><i class="fa fa-folder"></i>More Details</a>
												</td>
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

          