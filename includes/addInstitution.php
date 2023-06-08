<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$userID = $_POST['userID'];

?>

<form action="includes/process.php" method="post" class="form-horizontal form-label-left">

    <!--Category-->
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Institution Name<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="region" class="form-control col-md-7 col-xs-12" name="name" required type="text">
            </select>
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Organization<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="org_type" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                    data-validate-words="2" name="org_type" placeholder="" required="required">
                <option value="">--Select--</option>
                <option value="nacte">NACTE</option>
                <option value="tcu">TCU</option>
            </select>
        </div>
    </div>


    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <input type="submit" id="send" class="btn btn-success" name="addNewInstitution" value="Submit"/>
            <input type="reset" class="btn btn-default" value="Clear"/>
            <input type="hidden" name="userID" value="<?php echo $userID; ?>"/>

        </div>
    </div>
</form>






