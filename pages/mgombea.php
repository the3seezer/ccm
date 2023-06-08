<?php
$id = $_SESSION['userid'];
$sell = $db->selectUbungeUser($id);
$rw = $sell->fetch();

$idd = $rw['ubunge_id'];

$numUta = $sell->rowCount();
$getEli= $db->mgombeaElimu($idd);
$numEli = $getEli->rowCount();
$getUanachama = $db->uanachama($idd);
$numUana = $getUanachama->rowCount();
$sel = $db->seachPicha($idd);
$numPicha = $sel->rowCount();
?>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Dashboard Mgombea</h2>
    </div>
</div>
<!-- /.row -->
                    <div class="alert alert-success" role="alert"> <strong>Tahadhali!</strong> Anza kujaza fomu ya utambulisho ambayo ni namba moja <button type="button" class="btn btn-primary btn-outline btn-circle btn-lgg"><i class="fa fa-check1"></i>1</button>
                              </div>
					<div class="row">
                        <div class="col-sm-3">
                            <div class="hero-widget well well-sm">
							 <a href="?pg=pDetailUtambulisho"><button type="button" class="btn btn-success btn-outline btn-circle"><i class="fa fa-check1"></i>1</button>
                                </a><a href="?pg=pDetailUtambulisho"><div class="icon">
                                    <i class="glyphicon glyphicon-user"></i>
                                </div>
                                
                                <div class="options">
                                    <button type="button" class="btn btn-success btn-circle"><i class="fa <?php if($numUta>0){ echo ' fa-check'; }else{ echo ' fa-times';}?> fa fw"></i></button> Ongeza Utambulisho
                                </div></a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="hero-widget well well-sm">
							
							<button type="button" class="btn btn-success btn-outline btn-circle">2</button>
							<a href="?pg=bEd">
                                <div class="icon">
                                    <i class="glyphicon glyphicon-education"></i>
                                </div>
                                <div class="options">
                                    <button type="button" class="btn btn-success btn-circle"><i class="fa <?php if($numEli>0){ echo ' fa-check'; }else{ echo ' fa-times';}?>  fa fw"></i></button> Ongeza Elimu
                                </div>
                                
								</a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="hero-widget well well-sm">
							<button type="button" class="btn btn-success btn-outline btn-circle">3</button>
							<a href="?pg=bUchama">
                                <div class="icon">
                                    <i class="glyphicon glyphicon-tags"></i>
                                </div>
                                
                                <div class="options">
                                    <button type="button" class="btn btn-success btn-circle"><i class="fa <?php if($numUana>0){ echo ' fa-check'; }else{ echo ' fa-times';}?>  fa fw"></i></button> Ongeza Uanachama
                                </div>
								</a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="hero-widget well well-sm">
							<button type="button" class="btn btn-success btn-outline btn-circle">4</button>
							<a href="?pg=Picha">
                                <div class="icon">
                                    <i class="glyphicon glyphicon-book"></i>
                                </div>
                                
                                <div class="options">
                                    <button type="button" class="btn btn-success btn-circle"><i class="fa <?php if($numPicha>0){ echo ' fa-check'; }else{ echo ' fa-times';}?> fa fw"></i></button> Ongeza Vyeti
                                </div>
								</a>
                            </div>
                        </div>
						 
                    </div>
					<!-- <div class="row show-grid">
                                        <div class="col-xs-6 col-sm-3">
                                             <button type="button" class="btn btn-primary btn-circle"><i class="fa fa-check  fa fw"></i></button> Utambulisho
                                            
                                        </div>
                                        <div class="col-xs-6 col-sm-3"> <button type="button" class="btn btn-success btn-circle"><i class="fa fa-times  fa fw"></i></button> Elimu
										</div>

                                        

                                        <div class="col-xs-6 col-sm-3"><button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times  fa fw"></i></button> Uanachama 
										</div>
                                        <div class="col-xs-6 col-sm-3"><button type="button" class="btn btn-info btn-circle"><i class="fa fa-times  fa fw"></i></button> Vyeti
										</div>
                                    </div> -->
					<div class="alert alert-default" role="alert">Namba ya Yako ya Kadi Mpya ya CCM ni: <strong><?php echo $_SESSION['kadi']; ?></strong></div>
                    <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Profile ya Mgombea
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">

                <div class="col-md-6">
                    

                </div>
            </div>
            <!-- /.panel-body -->
        </div>
    </div>

</div>