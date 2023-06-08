<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$q = $_GET['q'];
$selectreg = $db->getAllRegionName();

$getM = $db->getMinistry();

$getRas = $db->getAllRASName();
$getRrh = $db->getAllRRHName();
$getfac = $db->getOnlyFacility();
$getcouncil = $db->getOnlyDistrict();

switch ($q) {
    case 1:
?>
        <!--Ministry-->
        <div class="col-md-3" id="">
            <div class="item form-group">
                <label class="control-label" for="by_facility_type" id="byFacilityLabel">Ministry </label>
                <select class="form-control" id="by_facility_type" name="facility_type">
                    <option value="All">Select All</option>
                    <?php
                    while ($rw = $getM->fetch()) {
                    ?>
                        <option value="<?php echo $rw['min_id']; ?>"><?php echo $rw['name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

    <?php
        break;
    case 2:
    ?>
        <!--Council-->
        <div class="col-md-2" id="regionContainer">
            <div class="item form-group">
                <label for="region">Region</label>
                <select type="text" class="form-control" id="region" onchange="loadDistrictList(this.value,'report')">
                    <option value="All">Select All</option>
                    <?php
                    while ($row = $selectreg->fetch()) {
                    ?>
                        <option value="<?php echo $row['Reg_Id']; ?>"><?php echo $row['RegName']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-2" id="">
            <div class="item form-group">
                <label class="control-label" for="by_facility_type" id="byFacilityLabel">Council </label>
                <div id="districtList">
                    <select class="form-control" id="by_facility_type" name="facility_type">
                        <option value="All">Select All</option>
                    </select>
                </div>
            </div>
        </div>
    <?php
        break;
    case 3:
    ?>
        <div class="col-md-2" id="">
            <div class="item form-group">
                <label class="control-label" for="by_facility_type" id="byFacilityLabel">RAS </label>
                <select class="form-control" id="by_facility_type" name="facility_type">
                    <option value="All">Select All</option>
                    <?php
                    while ($rw = $getRas->fetch()) {
                    ?>
                        <option value="<?php echo $rw['ras_id']; ?>"><?php echo $rw['rasName']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    <?php
        break;
    case 4:
    ?>
        <!--Agencies-->
        <div class="col-md-3" id="">
            <div class="item form-group">
                <label class="control-label" for="by_facility_type" id="byFacilityLabel">Agencies </label>
                <select class="form-control" id="by_facility_type" name="facility_type">
                    <option value="All">Select All</option>
                    <?php
                    while ($rw = $getfac->fetch()) {
                    ?>
                        <option value="<?php echo $rw['facId']; ?>"><?php echo $rw['facname']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    <?php
        break;
    case 5:
    ?>
        <!--Hospitals-->
        <div class="col-md-3" id="">
            <div class="form-group">
                <label class="control-label" for="by_facility_type" id="byFacilityLabel">Hospitals </label>
                <select class="form-control" id="by_facility_type" name="facility_type">
                    <option value="All">Select All</option>
                    <?php
                    while ($rw = $getRrh->fetch()) {
                    ?>
                        <option value="<?php echo $rw['id']; ?>"><?php echo $rw['rrhName']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>
        </div>

<?php
        break;
}
