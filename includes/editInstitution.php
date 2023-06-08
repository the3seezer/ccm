<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$inst_id = $_POST['id'];


//Get cadre by cadre_id
$getF = $db->getInstitutionName($inst_id);
$row = $getF->fetch();
$name = $row['InstitutionName'];
$from = $row['type'];
?>

<form action="includes/process.php" method="post" class="form-horizontal form-label-left">

    <!--Region Name-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Institution Name<span
                    class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="region" class="form-control col-md-7 col-xs-12" name="name" value="<?php echo $name; ?>"
                   required="required" type="text">
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Organization<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="org_type" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                    data-validate-words="2" name="org_type" placeholder="" required="required">
                <option value="">--Select--</option>
                <option value="nacte" <?=($from === "nacte"? "selected" :"") ?>>NACTE</option>
                <option value="tcu" <?=($from === "tcu"? "selected" :"") ?> >TCU</option>
            </select>
        </div>
    </div>


    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <input type="submit" id="send" class="btn btn-success" name="editInstitution" value="Save"/>
            <input type="reset" class="btn btn-default" value="Clear"/>
            <input type="hidden" name="inst_id" value="<?php echo $inst_id; ?>"/>

        </div>
    </div>
</form>