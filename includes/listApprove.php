<?php
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();

$qGroup = $_GET["q"];

$q1 = explode("=", $qGroup);
$q = $q1[0];
$applicant_id = $q1[1];


if ($q == 1)//If Selected
{
    $getAp = $db->getApplicationByAppId($applicant_id);
    ?>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Location<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="facility" onchange="showOtherSelection(this.value)" class="form-control" required>
                <option value="">--Select--</option>
                <?php
                while ($rowApp = $getAp->fetch()) {
                    $category = $rowApp['category'];
                    $wp_id = $rowApp['fac_id'];
                    $cadre_id = $rowApp['cadre_id'];
                    $cadName = $rowApp['cadreName'];
                    $app_id = $rowApp['app_id'];
                    $choiceNo = $rowApp['choiceNo'];

                    $wpname = '';
                    include("../lib/criteria_setting.php");

                    //Get Cadre name
                    //$getCa=$db->getCadreByCardeIdApplication($cadre_id);
                    // $rwC=$getCa->fetch();
                    //$cadName=$rwC['cadreName'];

                    $facility = $wpname . "(" . $cadName . ")";
                    ?>
                    <option value="<?php echo $app_id . "=" . $choiceNo . "=" . $category . "=" . $wp_id . "=" . $cadre_id; ?>"><?php echo strtoupper($facility); ?></option>
                <?php } ?>
                <option value="<?php echo "other=" . $applicant_id; ?>">Others</option>
            </select>
        </div>
    </div>


    <!--Score-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Score<span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="score" class="form-control col-md-7 col-xs-12" name="score" required type="text">
        </div>
    </div>


    <div class="item form-group" id="showOtherSelection">
    </div>
    <?php
} elseif ($q == 2)//Short Listed
{
    $getAp = $db->getApplicationByAppId($applicant_id);
    ?>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Location<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="facility" onchange="showOtherSelection(this.value)" class="form-control" required>
                <option value="">--Select--</option>
                <?php
                while ($rowApp = $getAp->fetch()) {
                    $category = $rowApp['category'];
                    $wp_id = $rowApp['fac_id'];
                    $cadre_id = $rowApp['cadre_id'];
                    $cadName = $rowApp['cadreName'];
                    $app_id = $rowApp['app_id'];
                    $choiceNo = $rowApp['choiceNo'];

                    $wpname = '';
                    include("../lib/criteria_setting.php");

                    //Get Cadre name
                    //$getCa=$db->getCadreByCardeIdApplication($cadre_id);
                    // $rwC=$getCa->fetch();
                    //$cadName=$rwC['cadreName'];

                    $facility = $wpname . "(" . $cadName . ")";
                    ?>
                    <option value="<?php echo $app_id . "=" . $choiceNo . "=" . $category . "=" . $wp_id . "=" . $cadre_id; ?>"><?php echo strtoupper($facility); ?></option>
                <?php } ?>
                <option value="<?php echo "other=" . $applicant_id; ?>">Others</option>
            </select>
        </div>
    </div>

    <!--Score-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Score<span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="score" class="form-control col-md-7 col-xs-12" name="score" required type="text">
        </div>
    </div>


    <div class="item form-group" id="showOtherSelection">
    </div>


<?php } ?>