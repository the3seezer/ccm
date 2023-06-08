<?php
$id = $_SESSION['userid'];
$sell = $db->selectUbungeUser($id);
$rw = $sell->fetch();
$idd = $rw['ubunge_id'];
//echo $idd."hello";
//exit;
//SELECT `extension`, `size`, `type`, `ubunge_id`, `picha_id` FROM `picha` WHERE 1
if(empty($idd))
{
	    echo '<script language="javascript">';
        echo "alert('Tafadhali ingiza kwanza taarifa za Mgombea')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "?pg=pDetail"';
        echo '</script>';
}
$sel = $db->seachPicha($idd);
  
?>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Taarifa za Vyeti</h2>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
		
		
            <div class="panel panel-default">
                
                <!-- /.panel-heading -->
                <div class="panel-body">
				<div class="row">
				                  <span style="float:right;">
							        <a href="?pg=PichaPost&id=<?php echo $idd; ?>"><button class="btn btn-success btn-outline1" >
                                        <i class="fa fa-plus-square fa-fw"></i>Ongeza Cheti</button></a>
                                       </p>
							        </span>
									</div>
                    <div class="dataTable_wrapper">

                        

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                
                                    <th>Aina ya Cheti</th>
                                    <th>Saizi </th>
                                    <th>Extension</th>
								   
									<th>Futa</th>
                                    <th>Angalia</th>
									
                                </tr>
                            </thead>
                            <tbody>
                         <?php while($rwe = $sel->fetch())
							   {
							   
								   ?>
                               
                                    <tr class="odd gradeX">
                                        
                                        
                                       
                                        <td><?php echo $rwe['type']; ?></td>
										<td><?php echo $rwe['size']; ?></td>
                                        <td><?php echo $rwe['extension']; ?></td>
                                         
										
                                        <td><button class="btn btn-danger btn-outline" data-toggle="modal" data-target="#DeletePicha"
                                            data-id="<?php echo $rwe['picha_id']; ?>" id="getDeleteDoc"><i
                                                class="fa fa-trash fa fw"></i>  Delete</button>
                                       </td> 
                                       <td><button class="btn btn-primary btn-outline" data-toggle="modal" data-target="#ViewPicha"
                                            data-id="<?php echo $rwe['picha_id']; ?>" id="getViewDoc"><i
                                                class="fa fa-list fa fw"></i>  View</button>
                                       </td>
                                    </tr>
							   <?php } ?>
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



<!--Module to View Choices-->
<div id="DeletePicha" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Futa Cheti</h4>
            </div>
            <div class="modal-body">

                <div id="DeletePicha-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--Module to Change Facility -->
<div id="ViewPicha" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Cheti</h4>
            </div>
            <div class="modal-body">

                <div id="ViewPicha-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>