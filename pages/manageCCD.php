<?php
$cadreid=$_GET['cadreid'];

$getF=$db->getHealthCadresById($cadreid);
$row=$getF->fetch();
$cadreName=$row['cadreName'];

/* $getF=$db->getListofCadreCriteriaById($cadreid);
$rw=$getF->fetch();
$cName=$rw['criteriaName'];
$credit=$rw['credit']; */
?>



<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Cadre Name: <?php echo $cadreName; ?></h2>
 </div>                  
</div>        
<div class="row">
                   

<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
							
							 List of Criterias
							
							</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                              <div class="dataTable_wrapper">
								<span style="float:right;">
							     <button class="btn btn-success" data-toggle="modal" data-target="#addCriteria" data-id="<?php echo $cadreid; ?>" id="getaddCadreCriteria">
							     <i class="fa fa-plus-square"></i>Add New</button></p>
							    </span>
									
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                        <thead>
                                            <tr>
											    <th>SN</th>
                                                <th>Criteria Name</th>
                                                <th>Credit</th>
                                                <th>Edit</th>
												<th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
					                    $i=1;
					                    $sel=$db->getListofCadreCriteriaById($cadreid); 
					                    while($rw=$sel->fetch())
					                    {
										 $cc_id=$rw['cc_id'];
										 $cName=$rw['criteriaName'];
                                         $credit=$rw['credit'];
                                         $sc_id =$rw['standard_id'];
										
										?>
                                            <tr class="odd gradeX">
											    <td><?php echo $i; ?></td>
                                                <td><?php echo $cName; ?></td>
                                                <td><?php echo $credit; ?></td>
												
												
                                                <td align="left">
												   <a href="#editCC" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?php echo $cc_id; ?>" data-scid="<?php echo $sc_id; ?>"
												   id="geteditCadreCriteria"><i class="fa fa-edit"></i>Edit</a>
												</td>
												
										        <td align="left"> <a href="#deleteCC" class="btn btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $cc_id; ?>" id="getdeleteCadreCriteria"><i class="fa fa-trash"></i>Delete</a>
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
     <div id="addCriteria" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Criteria to Cadre</h4>
     </div>
      <div class="modal-body">
     
	  <div id="addCadreCriteria-content"></div>
	 
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
        <h4 class="modal-title" id="myModalLabel">Edit Details:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="editCadreCriteria-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>
	 
	 
	 
	 <!--Module to Delete -->
     <div id="deleteCC" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Information</h4>
     </div>
      <div class="modal-body">
     
	  <div id="deleteCadreCriteria-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>


          