<?php
$selWPC = $db->getWPCategory();
$selCdr = $db->getHealthCadres();
$selDsb = $db->getAllDisabilityName();
?>
<style>
    .title {
        padding: 15px 15px;
        font-weight: bold;
        font-size: medium;
    }

    .loader {
        padding: 15px 0px 0px 15px;
    }
</style>


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Reports</h1>
    </div>
</div>
<br>
<form method="POST" id="theReportForm" action="pages/reports_ajax.php">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2" id="yearContainer">
                <div class="form-group">
                    <div>
                        <label for="year">Year</label>
                    </div>
                    <select type="text" class="form-control" id="year" name="year">
                    </select>
                </div>
            </div>
            <div class="col-md-2" id="statusContainer">
                <div class="form-group">
                    <div>
                        <label for="application_status">Application Status</label>
                    </div>

                    <select type="text" class="form-control" id="status" name="application_status">
                        <option value="All">Select All</option>
                        <option value="Inprogress"> In progress (not yet applied) </option>
                        <option value="Pending"> Pending (submited applications) </option>
                        <option value="Shortlisted"> Shortlisted</option>
                        <option value="Unshortlisted"> Unshortlisted</option>
                        <option value="Allocated"> Allocated</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2" id="allocationContainer" style="display: none;">
                <div class="form-group">
                    <div>
                        <label for="application_status">Allocation Status</label>
                    </div>
                    <select type="text" class="form-control" id="allocation" name="allocation_status">
                        <option value="All">Select All</option>
                        <option value="Pending"> Pending (Not reported) </option>
                        <option value="Accepted"> Reported and Accepted </option>
                        <option value="Rejected"> Reported but Rejected </option>
                    </select>
                </div>
            </div>
            <div class="col-md-2" id="facilityContainer" style="display: none;">
                <div class="form-group">
                    <div>
                        <label for="facility">Category</label>
                    </div>
                    <select type="text" class="form-control" id="facility" name="category">
                        <option value="All">Select All</option>
                        <?php
                        while ($wpc = $selWPC->fetch()) {
                        ?>
                            <option value="<?php echo $wpc['wpc_id']; ?>"><?php echo $wpc['name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div id="byFacilityTypeContainer"></div>

            <div class="col-md-4" id="cadreContainer" style="display: none;">
                <div class="form-group">
                    <div>
                        <label for="cadres">Cadres</label>
                    </div>
                    <select type="text" class="form-control" id="cadres" name="cadres">
                        <option value="All">Select All</option>
                        <?php
                        while ($cdr = $selCdr->fetch()) {
                        ?>
                            <option value="<?php echo $cdr['cadreId']; ?>"><?php echo $cdr['cadreName']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-md-2" id="genderContainer">
                <div class="form-group">
                    <div>
                        <label for="gender">Gender</label>
                    </div>
                    <select type="text" class="form-control" id="gender" name="gender">
                        <option value="All">Select Both</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2" id="disabilityContainer">
                <div class="form-group">
                    <div>
                        <label for="disability">Disability</label>
                    </div>
                    <select type="text" class="form-control" id="disability" name="disability">
                        <option value="ignore"> Ignore Disability </option>
                        <option value="no">With no disability</option>
                        <option value="yes">With disability</option>
                    </select>
                </div>
            </div>
			
            <div class="col-md-2" id="disabilityTypeContainer" style="display: none;">
                <div class="form-group">
                    <div>
                        <label for="disabilityType">Disability Type</label>
                    </div>
                    <select type="text" class="form-control" id="disabilityType" name="disability_type">
                        <option value="All">Select all </option>
                        <?php
                        while ($dsb = $selDsb->fetch()) {
                        ?>
                            <option value="<?php echo $dsb['disabilityName']; ?>"><?php echo $dsb['disabilityName']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
				
            </div>
            <div class="col-md-2" id="">
                <div class="form-group">
                    <div>
                        <label for="ageRange">Age Range (Years)</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-5">
                            <p class="input-group">
                                <input type="text" id="from" name="age_from" class="form-control text-center" value="18" />
                            </p>
                        </div>
                        <div class="col-xs-2 text-center">
                            <label for="to">TO</label>
                        </div>
                        <div class="col-xs-5">
                            <p class="input-group">
                                <input type="text" id="to" name="age_to" class="form-control text-center" value="45" />
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- <div class="col-md-2" id="maritalStatusContainer">
                <div class="form-group">
                    <div>
                        <label for="maritalStatus">Marital Status</label>
                    </div>
                    <select type="text" class="form-control" id="maritalStatus" name="maritalStatus">
                        <option value="All"> Select All </option>
                    </select>
                </div>
            </div> -->
            <div class="col-md-2" id="citizenshipContainer">
                <div class="form-group">
                    <div>
                        <label for="citizenship">Citizenship</label>
                    </div>
                    <select type="text" class="form-control" id="citizenship" name="citizenship">
                        <option value="All"> Select All </option>
                        <option value="Tanzanian">Tanzanian</option>
                        <option value="Non Tanzanian">Non Tanzanian</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2" id="citizenshipTypeContainer" style="display:none;">
                <div class="form-group">
                    <div>
                        <label for="citizenshipType">Country</label>
                    </div>
                    <select type="text" class="form-control" id="citizenshipType" name="citizenship_type">
                        <option value="All"> Select All </option>
                        <option value="Tanzania mainland">Tanzania Mainland</option>
                        <option value="Zanzibar">Zanzibar</option>
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div>
                    <label for="getReportButton" style="color:#ffffff;">&nbsp;</label>
                </div>
                <!-- <button type="button" id="getReportButton" class="btn btn-primary">Get Report</button> -->
                <button type="submit" id="getReportButton" class="form-control btn btn-primary">Get Report</button>
            </div>
        </div>
    </div>
</form>
<hr/>

<!-- <div class="row">
    <div class="col-md-12">
        <div class="title text-center" id="title1">
        </div>
    </div>
</div> -->

<div class="row" id="progressContainer" style="display: none;">
    <div class="col-md-12">
        <div class="title" id="loader">
            <div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        <span class="sr-only">100% Complete</span>
                    </div>
                </div>
                <div style="font-weight: bold;">Loading data please wait...</div>
            </div>
            <div id="errorAlert" class="alert alert-danger" role="alert" style="display: none;">
                <a href="#" class="alert-link">Failed to load report&nbsp;,&nbsp;&nbsp;<span id="innerErrorText"></span>.</a>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div id="AJAXresponseData">

        </div>
    </div>

</div>