<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$app_id = $_POST['app_id'];

$getApp = $db->getApplicationById($app_id);

$rw = $getApp->fetch();
$category = $rw['category'];
$wp_id = $rw['fac_id'];
$cadre_id = $rw['cadre_id'];

//Get Cadre Name
$getCa = $db->getCadreByCardeId($cadre_id);
$rw1 = $getCa->fetch();
$cadName = $rw1['cadreName'];
$cadreid = $rw1['cadre_id'];

if ($category == 1)//Ministry
{
    $cat = "Ministry";

    //Get Ministry Name
    $min_id = $wp_id;
    $getM = $db->getMinistryById($min_id);
    $rwM = $getM->fetch();
    $wpname = $rwM['name'];
} elseif ($category == 3)//District
{
    $cat = "District";
    //Get District Name
    $disid = $wp_id;
    $getD = $db->getDistrictNameByDisId($disid);
    $rwD = $getD->fetch();
    $wpname = $rwD['DistrictName'];
} elseif ($category == 4)//Facility
{
    $cat = "Facility";
    $facid = $wp_id;
    $getF = $db->getFacilityById($facid);
    $rwF = $getF->fetch();
    $wpname = $rwF['facname'];
} elseif ($category == 5)//Region
{
    $cat = "Region";
    //Get RegName
    $regid = $wp_id;
    $getR = $db->getRegionName($regid);
    $rwR = $getR->fetch();
    $wpname = $rwR['RegName'];
} else {
}

$fac_id = 1;


//Get Permit Year
$getPY = $db->getWorkPermitYear();
$rP = $getPY->fetch();
$pmYear = $rP['year'];
$getCa = $db->getAllActiveFacility($pmYear);

?>

<form action="includes/process.php" method="post" class="form-horizontal form-label-left">

    <!--Choice 1-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Work Permit<span class="required"></span></label>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="status" class="form-control col-md-7 col-xs-12" name="fac1" required="required"
                    onchange="loadCadreValue(this.value)">
                <option value="<?php echo $fac_id . "=" . $category . "=" . $wp_id; ?>"><?php echo strtoupper($wpname); ?></option>
                <?php
                while ($row = $getCa->fetch()) {
                    $fac_id = $row['fac_id'];
                    $category = $row['category'];
                    $wp_id = $row['wp_id'];

                    $wpname = '';
                    include("lib/criteria_setting.php");
                    ?>
                    <option value="<?php echo $fac_id . "=" . $category . "=" . $wp_id; ?>"><?php echo strtoupper($wpname); ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>


 <!--    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cadre<span class="required"></span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="cadre" class="form-control col-md-7 col-xs-12" name="cadre1" required="required">
                <option value="<?php //echo $cadreid; ?>"><?php //echo $cadName; ?></option>
            </select>
        </div>
    </div>
 -->

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button id="send" type="submit" name="editApplication" class="btn btn-success">Save</button>
            <input type="hidden" name="app_id" value="<?php echo $app_id; ?>"/>
        </div>
    </div>


</form>

	 
	
	 
	 
	 
	 