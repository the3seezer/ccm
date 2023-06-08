<div class="row">
  <div class="col-lg-12">
    <h2 class="page-header">Manage Documents</h2>
 </div>                  
</div>        

<div class="row">
    <div class="col-lg-6">
    <div class="panel panel-success">
            <div class="panel-heading">
                List of Mandatory Documents for all cadres
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    
                    <tr><td>#</td><td><b>Document / Attachment</td></tr>
                        <?php
                            $i=1;
                            $selDc=$db->getAllDocuments('Mandatory'); 
                            while($dc=$selDc->fetch())
                            {
                        ?>
                            <tr>
                                <td width="5%"><?=$i;?></td>
                                <td><?php echo $dc['DocumentType'].' <b>('.$dc['type'].') </b>'; ?></td>
                            </tr>
                            <?php $i++; }  ?>
                    </table>
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                List of Other Documents
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <span style="float:right;">
                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add"
                        data-id="<?php echo $_SESSION['userid']; ?>" id=""><i
                            class="fa fa-plus-square"></i> Add Document</button>
                </span>
                <br><br>
                <div id="" style="height: 550px; overflow: auto;">
                    <table class="table table-striped table-bordered table-hover" id="">
                        <thead>
                            <tr>
                                <th width="10%">SN</th>
                                <th colspan="2">Document/Attachment Type</th>
                                <!-- <th width="2%"></th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        $sel=$db->getOtherDocuments(); 
                        while($row=$sel->fetch())
                        {
                            $documentID=$row['DocumentID'];
                            $data = "{documentID:'".$documentID."', DocumentType:'".$row['DocumentType']."', type:'".$row['type']."'}";
                        ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['DocumentType'].' <b>('.$row['type'].') </b>'; ?></td>
                                <td><button title="Edit" class="btn btn-primary btn-xs"data-toggle="modal" data-target="#edit"
                        data-id="<?=$documentID; ?>" onclick="editDoc(<?=$data?>)"><i class="fa fa-edit"></i></button></td>
                            </tr>
                        <?php $i++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                Merge Cadre with Documents
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <span style="float:right;">
                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#merge"
                        data-id="<?php echo $_SESSION['userid']; ?>" id=""><i
                            class="fa fa-plus-square"></i> Merge Document to Cadre</button>
                </span>
                    <br><br>
                   

                    <div  style="height: 885px; overflow: auto;" >
                        <table class="table" id="">
                        
                            <tbody>
                            <tr><th class="text-center"><b>OTHER DOCUMENTS BASED ON SPECIFIC CADRE</b> </th></tr>
                            <?php
                            $sel = $db->getHealthCadres();
                            while ($row = $sel->fetch()) {
                                $cadreId = $row['cadreId'];
                                ?>
                                <tr >
                                    <td class="text-bold text-primary"><?php echo strtoupper($row['cadreName']); ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="table table-bordered table-hover">
                                        <?php
                                            $i=1;
                                            $selDoc=$db->getCarderDocuments($cadreId); 
                                            while($doc=$selDoc->fetch())
                                            {
                                                $merge_id=$doc['merge_id'];
                                                $docname = $doc['DocumentType'];
                                        ?>
                                            <tr>
                                                <td width="5%"><?=$i;?></td>
                                                <td><?php echo $docname.' <b>('.$doc['type'].') </b>'; ?></td>
                                                <td width="5%">
                                                    <form  action="includes/process.php" method="POST" onsubmit="if(!confirm('Are sure you want to delete?')){return false;}">
                                                        <input type="hidden" name="merge_id" value="<?=$merge_id ?>">
                                                        <button type="submit" title="Delete" name="deleteMergeDoc" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php $i++; }  ?>
                                        </table>
                                    </td>
                                </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>

<!--Modal -->
<div id="merge" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Documents merging area</h4>
            </div>
            <div class="modal-body">
                <form action="includes/process.php" method="post" class="form-horizontal form-label-left">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cadre<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="cadreId" required="required">
                                <option value="">--Select--</option>
                                <?php $selC = $db->getHealthCadres(); while ($rw = $selC->fetch()) { ?>
                                    <option value="<?= $rw['cadreId']; ?>"><?= strtoupper($rw['cadreName']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Other Documents<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select  name="DocumentID[]" multiple="multiple" class="form-control select2 col-md-7 col-xs-12" required="required" style="width:100% !important;">
                                <?php $selD = $db->getOtherDocuments(); while ($rwd = $selD->fetch()) { ?>
                                    <option value="<?= $rwd['DocumentID']; ?>"><?= $rwd['DocumentType'].' ('.$rwd['type'].')'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input type="submit" class="btn btn-success" name="mergeDocs" value="Submit"/>
                            <input type="reset" class="btn btn-default" value="Clear"/>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Document</h4>
            </div>
            <div class="modal-body">

            <form action="includes/process.php" method="post" class="form-horizontal form-label-left">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Document name<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text"  name="documentName" class="form-control select2 col-md-7 col-xs-12" required="required">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="type" class="form-control select2 col-md-7 col-xs-12" required="required">
                                <option value="">--Select--</option>
                                <option value="Optional">Optional</option>
                                <option value="Required">Required</option>
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input type="submit" class="btn btn-success" name="addDocumentName" value="Submit"/>
                            <input type="reset" class="btn btn-default" value="Clear"/>
                        </div>
                    </div>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Document</h4>
            </div>
            <div class="modal-body">
                  
                <form action="includes/process.php" method="post" class="form-horizontal form-label-left">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Document name<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="documentName" name="documentName" class="form-control select2 col-md-7 col-xs-12" required="required">
                            <input type="hidden" id="documentId" name="documentId" value="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="type" class="form-control select2 col-md-7 col-xs-12" required="required">
                                <option value="Optional">Optional</option>
                                <option value="Required">Required</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input type="submit" class="btn btn-success" name="editDocumentName" value="Submit"/>
                            <input type="reset" class="btn btn-default" value="Clear"/>
                        </div>
                    </div>
                </form>            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

function editDoc(str){
    let documentID = str.documentID;
    let DocumentType = str.DocumentType;
    let docType = str.type
    $("#documentId").val(documentID);
    $("#documentName").val(DocumentType);
    $('[name=type] option').filter(function() { 
        return ($(this).text() == docType); //To select Blue
    }).prop('selected', true);
}
</script>