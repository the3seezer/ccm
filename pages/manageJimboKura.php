<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Jimbo/Kata</h2>
    </div>
</div>
<div class="row">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                    Orodha ya Majimbo/Kata

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
								  

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>SN</th>
							<?php if($_POST['ngazi']=="Udiwani"){
							           echo '<th>Kata</th>';}
								  else {
								  echo '<th>Jimbo</th>'; }?>
                                <th>Wilaya</th>
								<th>Mkoa</th>
                                <th>Ongeza Kura</th>
                                <th>Angalia Kura</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
							$ngazi = $_POST['ngazi'];
							if(($ngazi=="Udiwani") and ($_SESSION['ngazi']=="Kata"))
							{
							$wilaya = $_POST['kata'];
							$getJimb = $db->select_KATABYID($wilaya);
                           
							while ($rwk = $getJimb->fetch()) {
								    $mkoa_id = $rwk['Region_Id'];
							        //Get region name
                                    $getRegs = $db->getRegionName($mkoa_id);
                                    $rwC = $getRegs->fetch();
                                    $gname = $rwC['RegName'];
									 $wilaya_id = $rwk['District_Id'];
									//Get wilaya name
                                    $getDict = $db->gettDistrict($wilaya_id);
                                    $rwD = $getDict->fetch();
                                    $dname = $rwD['DistrictName'];

									?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo strtoupper($rwk['KataName']); ?></td>
									<td><?php echo strtoupper($dname); ?></td>
                                    <td><?php echo strtoupper($gname); ?></td>
                                    <td align="left">
                                  <button class="btn btn-danger btn-outline" data-toggle="modal" data-target="#ongezakura"
                                            data-id="<?php echo "kata_".$rwk['Kata_Id']; ?>" id="getongezakura"><i
                                                class="fa fa-plus-square"></i> Ongeza Kura</button></a>
									</td>  
                                   <td><button class="btn btn-info btn-outline" data-toggle="modal" data-target="#addkura"
                                            data-id="<?php echo "kata_".$rwk['Kata_Id']; ?>" id="getaddkura"><i
                                                class="fa fa-plus-square"></i> Angalia Kura</button></td>
                              </tr>
                                <?php $i++;
                            } } else
							{
							$wilaya = $_POST['wilaya'];
                            $sel = $db->select_JI_DI_REE($wilaya);
                            while ($row = $sel->fetch()) {
                                
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo strtoupper($row['JimboName']); ?></td>
									<td><?php echo strtoupper($row['DistrictName']); ?></td>
                                    <td><?php echo strtoupper($row['RegName']); ?></td>
                                    <td align="left">
                                  <button class="btn btn-success"data-toggle="modal" data-target="#ongezakura"
                                            data-id="<?php echo $row['Jimbo_Id']; ?>" id="getongezakura"><i
                                                class="fa fa-plus-square"></i>Ongeza Kura</button></a>
									</td>  
                                   <td><button class="btn btn-info" data-toggle="modal" data-target="#addkura"
                                            data-id="<?php echo $row['Jimbo_Id']; ?>" id="getaddkura"><i
                                                class="fa fa-plus-square"></i>Angalia Kura</button></td>
                              </tr>
                                <?php $i++;
                            } }?>
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



          