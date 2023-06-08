<?php
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();

$q = $_GET['q'];
$sql = $db->getInstitution();


if ($q == 'Tanzania, United Rep') {

    $institutions = $db->getInstitution();

    ?>
    <!--College of Study-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">College of Study<span
                    class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">

            <select id="college" class="form-control col-md-7 col-xs-12" name="college" required="required"
                    onchange="loadProgrammeByInstId(this.value)">
                <option value="">--Select Institution--</option>
                <?php while ($value = $institutions->fetch()) { ?>
                    <option value="<?php echo $value["id"]; ?>">
                        <?php echo $value["InstitutionName"]; ?>
                    </option>
                <?php } ?>
            </select>

        </div>
    </div>


    <!--Programme Name-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Programme Name<span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="programme" class="form-control col-md-7 col-xs-12"
                    name="progName" required="required">
                <option value="">--Select--</option>
            </select>
        </div>
    </div>
    <?php
} else {
    ?>
    <!--College of Study-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">College of Study<span
                    class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="college" class="form-control col-md-7 col-xs-12" name="college" required="required" type="text">
        </div>
    </div>


    <!--Programme Name-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Programme Name<span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="progName" class="form-control col-md-7 col-xs-12" name="progName" required="required"
                   type="text">
        </div>
    </div>


    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">
            NECTA/NACTE/TCU verification letter <span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">

            <input type="file" class="form-control" name="verification_letter" accept=".pdf, application/pdf" />
            <br><small class="text-center text-danger">Only PDF file with max size of 1024KB/1MB allowed </small>
        </div>
    </div>

    <?php
}
?>