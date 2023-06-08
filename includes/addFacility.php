<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$userID = $_POST['userID'];

$selectreg = $db->getAllRegionName();
$selectFT = $db->getFacilityTypes();
?>
<form action="includes/process.php" method="post" class="form-horizontal form-label-left">

     <!--Facility Name-->
     <div class="item form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Agency Name<span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="agencyName" class="form-control col-md-7 col-xs-12" name="agencyName" required type="text">
          </div>
     </div>


     <div class="item form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Agency Type<span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="facility_type_id" class="form-control col-md-7 col-xs-12" name="facility_type_id" required="required">
                    <option value="">--Select--</option>
                    <?php
                    while ($rowft = $selectFT->fetch()) {
                    ?>
                         <option value="<?php echo $rowft['facility_type_id']; ?>"><?php echo $rowft['name']; ?></option>
                    <?php
                    }
                    ?>
               </select>
          </div>
     </div>

     <!--Region-->
     <div class="item form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Region<span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="gender" class="form-control col-md-7 col-xs-12" name="region" required="required" onchange="loadDistrictList(this.value)">
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
     </div>

     <!--District-->
     <div class="item form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Council<span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12" id="districtList">
               <select id="district" class="form-control col-md-7 col-xs-12" name="district" required="required">
                    <option value="">--Select--</option>
               </select>
          </div>
     </div>


     <div class="ln_solid"></div>
     <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
               <input type="submit" id="send" class="btn btn-success" name="addFacility" value="Submit" />
               <input type="reset" class="btn btn-default" value="Clear" />
               <input type="hidden" name="userID" value="<?php echo $userID; ?>" />

          </div>
     </div>
</form>