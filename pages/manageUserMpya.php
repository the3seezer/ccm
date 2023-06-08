<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Watumiaji wa Mfumo</h2>
    </div>
</div>
<div class="row">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">

                    Orodha ya Watumiaji

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
								   <span style="float:right;"> <p><a href="?pg=regUserPost"><button class="btn btn-success"><i class="fa fa-plus-square fa-fw"></i>Ongeza</button></a>
							   
                                       </p>
							        </span>

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Jina La Mtumiaji</th>
                                <th>Namba ya Uanachama</th>
								<th>Aina ya Mtumiaji</th>
                                <th>Ngazi </th>
                                <th>Kazi</th>
								<th>Rekebisha </th>
								<th>Futa </th>
								<th>Password </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
							$ngazi=$_SESSION['ngazi'];
							$ngaziid=$_SESSION['ngazi_id'];
							$aina=$_SESSION['aina'];
							$kazi=$_SESSION['kazi_mfumo'];
                            $sel = $db->selectUser($ngazi,$ngaziid,$aina,$kazi);
                            while ($row = $sel->fetch()) {
                                
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo strtoupper($row['name']); ?></td>
									<td><?php echo strtoupper($row['kadi']); ?></td>
                                    <td><?php echo strtoupper($row['ainamtumia']); ?></td>
									<td><?php echo strtoupper($row['ngazi']); ?></td>
                                    <td><?php echo strtoupper($row['kazi_mfumo']); ?></td>
                                    <td align="left">
                                  <button class="btn btn-outline btn-danger"data-toggle="modal" data-target="#ongezakuraP"
                                            data-id="<?php echo $row['user_id']; ?>" id="getongezakura"><i
                                                class="fa fa-edit fa-fw"></i>Rekebisha</button></a>
									</td>
                                        
<td><button class="btn btn-outline btn-info" data-toggle="modal" data-target="#addkuraP"
                                            data-id="<?php echo $row['user_id']; ?>" id="getaddkura"><i
                                                class="fa fa-trash fa-fw"></i>Futa</button></td>
												<td><button class="btn btn-outline btn-info" data-toggle="modal" data-target="#addkuraP"
                                            data-id="<?php echo $row['user_id']; ?>" id="getpass"><i
                                                class="fa fa-sun-o fa-fw"></i>Badilisha</button></td>
                                    

                                </tr>
                                <?php $i++;
                            } ?>
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
<div id="addRAS" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Ongeza Jimbo:</h4>
            </div>
            <div class="modal-body">

                <div id="addRAS-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Add New -->
<div id="addkura" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Angalia Kura:</h4>
            </div>
            <div class="modal-body">

                <div id="addkura-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="ongezakura" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Ongeza Kura:</h4>
            </div>
            <div class="modal-body">

                <div id="ongezakura-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--Module to Edit -->
<div id="editRAS" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Badili Jimbo</h4>
            </div>
            <div class="modal-body">

                <div id="editRAS-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Delete -->
<div id="deleteRAS" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Futa Jimbo:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteRAS-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



          