<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Tawi</h2>
    </div>
</div>
<div class="row">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">

                    Orodha ya Matawi

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
								   <span style="float:right;">
							        <button class="btn btn-success" data-toggle="modal" data-target="#addTAWI"
                                            data-id="<?php echo $_SESSION['userid']; ?>" id="getaddTAWI"><i
                                                class="fa fa-plus-square"></i>Ongeza</button>
                                       </p>
							        </span>

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>SN</th>
								<th>Tawi</th>
								<th>Mtaa/Kijiji</th>
								<th>Kata</th>
								<th>Tarafa</th>
                                <th>Jimbo</th>
                                <th>Wilaya</th>
								<th>Mkoa</th>
                                <th>Badili</th>
                                <th>Futa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $sel = $db->select_TA_KA_TARA_JI_DI_RE();
                            while ($row = $sel->fetch()) {
                                
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
									<td><?php echo strtoupper($row['TawiName']); ?></td>
									<td><?php echo strtoupper($row['MtaaName']); ?></td>
									<td><?php echo strtoupper($row['KataName']); ?></td>
									<td><?php echo strtoupper($row['TarafaName']); ?></td>
                                    <td><?php echo strtoupper($row['JimboName']); ?></td>
									<td><?php echo strtoupper($row['DistrictName']); ?></td>
                                    <td><?php echo strtoupper($row['RegName']); ?></td>
                                    <td align="left">
                                        <a href="#editTAWI" class="btn btn-primary btn-xs" data-toggle="modal"
                                           data-id="<?php echo $row['Tarafa_Id']; ?>"
                                           id="geteditTAWI"><i class="fa fa-edit"></i>Edit</a>
                                    </td>

                                    <td align="left"><a href="#deleteTAWI" class="btn  btn-danger btn-xs"
                                                        data-toggle="modal" data-id="<?php echo $row['Tarafa_Id']; ?>"
                                                        id="getdeleteTAWI"><i class="fa fa-trash"></i>Delete</a>
                                    </td>

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
<div id="addTAWI" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Ongeza Tawi:</h4>
            </div>
            <div class="modal-body">

                <div id="addTAWI-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Edit -->
<div id="editTAWI" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Badili Tawi</h4>
            </div>
            <div class="modal-body">

                <div id="editTAWI-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Delete -->
<div id="deleteTAWI" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Futa Tawi:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteTAWI-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



          