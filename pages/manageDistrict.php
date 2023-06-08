<?php
$selectreg=$db->getAllRegionName();
?>
<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Manage Council</h2>
 </div>                  
</div>        
<div class="row">
                   
<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
							
							 List of Council
							
							</div>
                            <!-- /.panel-heading -->
                    <div class="panel-body">
                    <div class="dataTable_wrapper">
								   <span style="float:right;">
							        <button class="btn btn-success" data-toggle="modal" data-target="#addDistrict" data-id="<?php echo $_SESSION['userid']; ?>" id="getaddDistrict"><i class="fa fa-plus-square"></i>Add New</button></p>
                    </span>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                      <tr>
											<th>SN</th>
                      <th>Council Name</th>
											<th>Region Name</th>
                      <th>Edit</th>
											<th>Delete</th>
                      </tr>
                      </thead>
                      <tbody>
										<?php
                    $i=1;
                    $sel=$db->getListofDistrictRegion(); 
                    while($row=$sel->fetch())
                    {
										 $disid=$row['District_Id'];
										?>
                    <tr class="odd gradeX">
											<td><?php echo $i; ?></td>
                      <td><?php echo strtoupper($row['DistrictName']); ?></td>
                      <td><?php echo strtoupper($row['RegName']); ?></td>
                      <td align="left">
											 <a href="#editDistrict" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $disid; ?>" 
												   id="geteditDistrict"><i class="fa fa-edit"></i>Edit</a>
											</td>
												
										  <td align="left"> <a href="#deleteDistrict" class="btn  btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $disid; ?>" id="getdeleteDistrict"><i class="fa fa-trash"></i>Delete</a>
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
     <div id="addDistrict" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Council:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="addDistrict-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 <!--Module to Edit -->
     <div id="editDistrict" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Council</h4>
     </div>
      <div class="modal-body">
     
	  <div id="editDistrict-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 <!--Module to Delete -->
     <div id="deleteDistrict" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Council:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="deleteDistrict-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>



          