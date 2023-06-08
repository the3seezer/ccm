<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Rejected Applicants</h1>
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
												<th>Marital Status</th>
                                                <th>Phone</th>
												<th>App Date</th>
												<th>View</th>
												<th>Change</th>
												<th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
					                    $i=1;
										$status="Rejected";
					                    $sel=$db->getApplicantsByStatus($status); 
					                    while($rw=$sel->fetch())
					                    {
										$table_id=$rw['id'];
										$applicant_id=$rw['applicant_id'];
										$fac_id=$rw['fac_id'];
	                                    $cadre_id=$rw['carde_id'];

                                        //Get Facility name
                                        $getF=$db->getfacilityByfacid($fac_id);
                                        $rwF=$getF->fetch();
                                        $facName=$rwF['facname'];

                                        //Get Cadre name
                                        $getCa=$db->getCadreByCardeId($cadre_id);
                                        $rwC=$getCa->fetch();
                                        $cadName=$rwC['cadreName'];	

										//Get Applicants Details
										$getAp=$db->getApplicantsById($applicant_id);
										$row=$getAp->fetch();
										
										$fName=$facName."<br/>(".$cadName.")";
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
												   <a href="?pg=mngAppDetails&id=<?php echo $applicant_id; ?>" class="btn btn-info btn-xs" target=_blank><i class="fa fa-folder"></i>View Profile</a>
												</td>
												
												
												<td align="left">
		                                         <a href="#changeFacility" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $table_id."=".$applicant_id; ?>" id="getRejectFac">
												 <i class="fa fa-edit"></i>Change</a>
	                                            </td>
												
												
												<td align="left">
		                                         <a href="#deleteRejected" class="btn btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $table_id."=".$applicant_id; ?>" id="getDelRejected">
												 <i class="fa fa-trash"></i>Delete</a>
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
	 
	 
	 <!--Module to Assign Facility -->
     <div id="assignFacility" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Assign Facility</h4>
     </div>
      <div class="modal-body">
     
	  <div id="assignFacility-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 <!--Module to Assign Facility -->
     <div id="changeFacility" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Facility</h4>
     </div>
      <div class="modal-body">
     
	  <div id="changeRejectedStatus-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 <!--Module to Delete Rejected Application -->
     <div id="deleteRejected" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
     </div>
      <div class="modal-body">
     
	  <div id="deleteRejectedStatus-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>


          