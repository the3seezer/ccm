<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Employment Permit Category</h2>
 </div>                  
</div>        
<div class="row">
                   

<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
							
							 List of Employment permit Category
							
							</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
								   <span style="float:right;">
							        <!-- <button class="btn btn-success" data-toggle="modal" data-target="#addCategory" data-id="<?php //echo $_SESSION['userid']; ?>" id="getaddWPCategory"><i class="fa fa-plus-square"></i>Add New</button></p> -->
							        </span>
									
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
											    <th width="10%">SN</th>
                                                <th>Category Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
					                    $i=1;
					                    $sel=$db->getWPCategory(); 
					                    while($row=$sel->fetch())
					                    {
										 $wpc_id=$row['wpc_id'];
										?>
                                            <tr class="odd gradeX">
											    <td><?php echo $i; ?></td>
                                                <td><?php echo strtoupper($row['name']); ?></td>
                                                
												
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
     <div id="addCategory" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Category:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="addWPCategory-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 <!--Module to Edit -->
     <div id="editWPC" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
     </div>
      <div class="modal-body">
     
	  <div id="editWPC-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 <!--Module to Delete -->
     <div id="deleteWPC" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Category:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="deleteWPC-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>



          