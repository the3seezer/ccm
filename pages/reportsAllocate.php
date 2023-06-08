<?php
$selWPC = $db->getWPCategory();

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
        <h1 class="page-header">Allocation</h1>
    </div>
</div>
<br>
<form method="POST" id="Budoya" action="pages/reports_ajaxAllocate.php">
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
			
            
            
            <div class="col-md-2" id="facilityContainer" >
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
            
            
            <div class="col-md-2">
                <div>
                    <label for="getReportButtonAllocate" style="color:#ffffff;">&nbsp;</label>
                </div>
                <!-- <button type="button" id="getReportButton" class="btn btn-primary">Get Report</button> -->
                <button type="submit" id="getReportButtonAllocate" class="form-control btn btn-primary">Get Report</button>
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
        <div id="AJAXres">

        </div>
    </div>

</div>