<?php
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();

$qGroup = $_GET["q"];
$q1 = explode("=", $qGroup);
$q = $q1[0];
$applicant_id = $q1[1];

//Get Permit Year
$getPY = $db->getWorkPermitYear();
$rP = $getPY->fetch();
$pmYear = $rP['year'];

$getCa = $db->getAllActiveFacility($pmYear);

if ($q == 'other')//If Selected
{
    $getAp = $db->getApplicationByAppId($applicant_id);
    ?>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select<span class="required"></span></label>

        <div class="col-md-3 col-sm-3 col-xs-12">
            <select class="form-control col-md-7 col-xs-12" name="fac1" required="required"
                    onchange="loadCadreValue(this.value);">
                <option value="">--Select Location--</option>
                <?php
                while ($row = $getCa->fetch()) {
                    $fac_id = $row['fac_id'];
                    $category = $row['category']; //Category
                    $wp_id = $row['wp_id']; //Work permit Id

                    $wpname = '';
					
                    include("../lib/criteria_setting.php");
                    ?>
                    <option value="<?php echo $fac_id . "=" . $category . "=" . $wp_id; ?>">
                        <?php echo strtoupper($wpname); ?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">
            <select id="cadre" class="form-control col-md-7 col-xs-12" name="cadre_id" required="required">
                <option value="">--Cadre--</option>
            </select>
        </div>
    </div>

    <?php
} else {
}
?>
