<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Manage DISABILITY</h2>
 </div>                  
</div>        
<div class="row">
                   
<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
							
							 List of DISABILITY
							
							</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
								   <span style="float:right;">
							        <button class="btn btn-success" data-toggle="modal" data-target="#addDisability" data-id="<?php echo $_SESSION['userid']; ?>" id="getaddDisability"><i class="fa fa-plus-square"></i>Add New</button></p>
							        </span>
									
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
											    <th>SN</th>
                        <th>Disability Name</th>
                        <th>Edit</th>
												<th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
					                    $i=1;
					                    $sel=$db->getAllDisabilityName(); 
					                    while($row=$sel->fetch())
					                    {
										 $disability_id=$row['disability_id'];
										?>
                                            <tr class="odd gradeX">
											    <td><?php echo $i; ?></td>
                                                <td><?php echo strtoupper($row['disabilityName']); ?></td>
                                                <td align="left">
                                                    <?php if($row['disabilityName']=='others'){
                                                        echo '
                                                        <a href="#" class="btn btn-primary btn-xs" onclick=\'alert("This field cannot be edited nor deleted because it is used on registration form logics.")\'><i class="fa fa-edit"></i>Edit</a>
                                                        ';}else{?>
                                                        <a href="#editDisability" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $disability_id; ?>" 
                                                        id="geteditDisability"><i class="fa fa-edit"></i>Edit</a>
                                                    <?php } ?>
												</td>
												
										        <td align="left">
                                                    <?php if($row['disabilityName']=='others'){
                                                        echo '
                                                        <a href="#" class="btn btn-danger btn-xs" onclick=\'alert("This field cannot be edited nor deleted because it is used on registration form logics.")\'><i class="fa fa-trash"></i>Delete</a>
                                                        ';}else{?>
                                                         <a href="#deleteDisability" class="btn  btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $disability_id; ?>" id="getdeleteDisability"><i class="fa fa-trash"></i>Delete</a>
                                                         <?php } ?>
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
     <!--Module to Add New -->
     <div id="addDisability" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New DISIABILITY:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="addDisability-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 <!--Module to Edit -->
     <div id="editDisability" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit DISABILITY</h4>
     </div>
      <div class="modal-body">
     
	  <div id="editDisability-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 <!--Module to Delete -->
     <div id="deleteDisability" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Disability:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="deleteDisability-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>



          