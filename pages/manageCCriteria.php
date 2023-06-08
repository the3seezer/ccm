<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Manage Cadre Criteria</h2>
 </div>                  
</div>        
<div class="row">
                   

<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
							
							 List of Cadre Criteria
							
							</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
								   <span style="float:right;">
							        <button class="btn btn-success" data-toggle="modal" data-target="#addCC" data-id="<?php echo $_SESSION['userid']; ?>" id="getaddCC">
									<i class="fa fa-plus-square"></i>Add New</button></p>
							        </span>
									
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
											    <th>SN</th>
                                                <th>Cadre Name</th>
												<th>Criteria</th>
                                                <!--<th>Edit</th>-->
												<th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
					                    $i=1;
					                    $sel=$db->getListofCadreCriteria(); 
					                    while($row=$sel->fetch())
					                    {
										  $cadreid=$row['cadre_id'];
										 
										  $getF=$db->getHealthCadresById($cadreid);
                                          $row1=$getF->fetch();
                                          $cadreName=$row1['cadreName'];
										?>
                                            <tr class="odd gradeX">
											    <td><?php echo $i; ?></td>
                                                <td><?php echo $cadreName; ?></td>
												
												<td align="left">
												   <a href="?pg=mngCCD&cadreid=<?php echo $cadreid; ?>" class="btn btn-info btn-xs"><i class="fa fa-folder"></i>View Criteria(s)</a>
												</td>
												
										        <td align="left">
                                                    <form  action="includes/process.php" method="POST" onsubmit="if (!confirm('Are you sure you want to delete?')){ return false; }">
                                                        <input type="hidden" name="cadreid" value="<?=$cadreid ?>">
                                                        <input type="hidden" name="status" value="Inactive">
                                                        <button type="submit" name="deletecadreid" class="btn btn-danger btn-xs"
                                                        ><i class="fa fa-trash"></i>Delete</button>
                                                    </form>
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
     <div id="addCC" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Cadre Criteria:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="addCC-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 <!--Module to Edit -->
     <div id="editCC" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Cadre</h4>
     </div>
      <div class="modal-body">
     
	  <div id="editWP-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 <!--Module to Delete -->
     <div id="deleteWP" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Cadre Criteria:</h4>
     </div>
      <div class="modal-body">

	  <div id="deleteWP-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>



          