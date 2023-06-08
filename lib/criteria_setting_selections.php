<?php
$selectreg = $db->getAllRegionName();

$getM = $db->getMinistry();

$getRas = $db->getAllRASName();
$getRrh = $db->getAllRRHName();
$getfac = $db->getOnlyFacility();
$getcouncil = $db->getOnlyDistrict();

switch ($q){
    case 1:
        ?>
        <!--MOH-->
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Ministry<span class="required">*</span></label>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <select id="facName" class="form-control col-md-7 col-xs-12" name="facName" required="required">
                    <option value="">--Select--</option>
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
        <!--Agencies-->
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Region<span class="required">*</span></label>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <select id="gender" class="form-control col-md-7 col-xs-12" name="facRegName" required="required"
                        onchange="loadDistrictList(this.value)">
                    <option value="">--Select--</option>
                    <?php
                    while ($row = $selectreg->fetch()) {
                        ?>
                        <option value="<?php echo $row['Reg_Id']; ?>"><?php echo $row['RegName']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <br><br>
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Council<span class="required">*</span></label>
            <div class="col-md-10 col-sm-10 col-xs-12" id="districtList">
                <select id="district" class="form-control col-md-7 col-xs-12" name="facName" required="required">
                    <option value="">--Select--</option>
                </select>
            </div>
        </div>
        <?php
        break;
    case 3:
       ?>
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">RAS<span class="required">*</span></label>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <select id="facName" class="form-control col-md-7 col-xs-12" name="facName" required="required">
                    <option value="">--Select--</option>
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
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Agencies<span class="required">*</span></label>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <select id="facName" class="form-control col-md-7 col-xs-12" name="facName" required="required">
                    <option value="">--Select--</option>
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
        <!--Agencies-->
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Hospitals<span class="required">*</span></label>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <select id="facName" class="form-control col-md-7 col-xs-12" name="facName" required="required">
                    <option value="">--Select--</option>
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
