<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_POST['id'];


//Get cadre by cadre_id
$getF = $db->getCourseName($id);
$row = $getF->fetch();
$name = $row['name'];
$from = $row['from_server'];
$abbreviation = $row['abbreviation'];
?>

<form action="includes/process.php" method="post" class="form-horizontal">

    <!--Region Name-->
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Course Name<span
                class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="region" class="form-control col-md-7 col-xs-12" name="name" value="<?php echo $name; ?>"
                   required="required" type="text">
        </div>
    </div> <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="abbreviation">Abbreviation<span
                class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="region" class="form-control col-md-7 col-xs-12" name="abbreviation" value="<?php echo $abbreviation; ?>"
                   required="required" type="text">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Organization<span class="required">*</span></label>
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
            <input type="submit" id="send" class="btn btn-success" name="editCourse" value="Save"/>
            <input type="reset" class="btn btn-default" value="Clear"/>
            <input type="hidden" name="course_id" value="<?=$id; ?>"/>

        </div>
    </div>
</form>