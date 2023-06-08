$(document).ready(function () {



    // Defining variables to hold selections Budoya
    let selectedWorkPermit = '';
    let selectedYear = '';
    let selectedApplicationStatus = '';
    let selectedAllocationStatus = '';
    let selectedGender = '';
    let selectedDisability = '';
    let selectedCadre = '';
    let selectedFacilityType = '';
    let selectedFacilityItemByType = '';
    let selectedRas = '';
    let pretext = "List of applicants";



    function createTitle(selectedWorkPermit,
        selectedYear,
        selectedApplicationStatus,
        selectedAllocationStatus,
        selectedGender,
        selectedDisability,
        selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas) {
        let title = (
            pretext + " " +
            (selectedWorkPermit !== 'All' && selectedWorkPermit !== "" ? ' for the permit ' + selectedWorkPermit : '') + " " +
            (selectedYear !== 'All' && selectedYear !== "" ? ' of the year ' + selectedYear : '') + " " +
            (selectedApplicationStatus !== 'All' && selectedApplicationStatus !== "" ? ' who are ' + selectedApplicationStatus : '') + " " +
            (selectedAllocationStatus !== 'All' && selectedAllocationStatus !== "" ? ' and ' + selectedAllocationStatus : '') + " " +
            (selectedGender !== 'All' && selectedGender !== "" ? ' for ' + selectedGender + ' gender' : '') + " " +
            (selectedDisability !== 'All' && selectedDisability !== "" ? ' with ' + selectedDisability + ' disability' : '') + " " +
            (selectedCadre !== 'All' && selectedCadre !== "" ? ' for ' + selectedCadre + ' cadres' : '') + " " + (selectedFacilityType === "" ? "" : "selected in " + selectedFacilityType) + " " + (selectedFacilityItemByType !== 'All' ? selectedFacilityItemByType : '') + " " + (selectedRas !== 'All' ? 'in ' + selectedRas : '')).toLowerCase();

        return title.charAt(0).toUpperCase() + title.substring(1);
    }

    /**
     * Create and populate  permit year option list
     */
    let currentYear = new Date().getFullYear();
    for (let yearDecrementFactor = 0; yearDecrementFactor < 10; yearDecrementFactor++) {
        $("select#year").append("<option value=" + currentYear + ">" + currentYear + "</option>");
        currentYear -= 1;
    }

    $("#title").html(pretext);
    $("#permitContainer");
    $("#yearContainer");
    $("#statusContainer");
    $("#allocationContainer").hide();
    $("#genderContainer");
    $("#disabilityContainer");
    $("#cadreContainer");
    $("#regionContainer");
    $("#byFacilityTypeContainer").hide();
    $("#getReportButton");
    $("#facilityContainer");
    $("#errorAlert").hide();
    $("#progressContainer").hide();

    $("select#status").change(function () {
        let selectApplicationStatus = $(this).val();
        if (selectApplicationStatus === "Inprogress" || selectApplicationStatus === "All") {
            $("#facilityContainer").hide();
            $("#byFacilityTypeContainer").hide();
            $("#cadreContainer").hide();
            $("#allocationContainer").hide();
        } else {
            $("#facilityContainer").show();
            $("#cadreContainer").show();
            if (selectApplicationStatus === "Allocated") {
                $("#allocationContainer").show();
            } else {
                $("#allocationContainer").hide();
            }
        }

        let titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });

    $("select#work_permit").change(function () {
        selectedWorkPermit = $(this).val();

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });

    $("select#year").change(function () {
        selectedYear = $(this).val();

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });


    $("select#status").change(function () {
        selectedApplicationStatus = $(this).val();

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });

    $("select#status").change(function () {
        selectedApplicationStatus = $(this).val();

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });

    $("select#allocation").change(function () {
        selectedAllocationStatus = $(this).val();

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });


    $("select#gender").change(function () {
        selectedGender = $(this).val();

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });


    $("select#disability").change(function () {
        selectedDisability = $(this).val();
        if (selectedDisability == 'yes') {
            $("#disabilityTypeContainer").show();
        } else {
            $("#disabilityTypeContainer").hide();
        }
        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });

    $("select#citizenship").change(function () {
        selectedCitizenship = $(this).val();
        if (selectedCitizenship == 'Tanzanian') {
            $("#citizenshipTypeContainer").show();
        } else {
            $("#citizenshipTypeContainer").hide();
        }
    });

    $("select#cadres").change(function () {
        selectedCadre = $(this).val();

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });


    $("select#facility").change(function () {
        selectedFacilityType = $(this).val();

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });

    $("select#by_facility_type").change(function () {
        selectedFacilityItemByType = $(this).val();
        alert('selectedFacilityItemByType=> ' + selectedFacilityItemByType);

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });

    // $("select#by_facility_type").change(function () {
    //     selectedFacilityItemByType = $(this).val();
    //     var titleString = createTitle(
    //         selectedWorkPermit,
    //         selectedYear,
    //         selectedApplicationStatus,
    //         selectedAllocationStatus,
    //         selectedGender,
    //         selectedDisability,
    //         selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
    //     $("#title").html(titleString);
    // });

    $("select#region").change(function () {
        selectedRas = $(this).val();

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityType, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });

    /**
     * Check  the changes , on selection of facility type,
     * if facility type is not Select All ,  show facility list according to type and show the input for list.
     */
    $("select#facility").change(function () {
        selectedFacilityTypeName = $("#facility option:selected").text();
        selectedFacilityType = $(this).val();

        if (selectedFacilityTypeName !== "All") {
            $("#byFacilityTypeContainer").show();
            let _url = "lib/criteria_setting_selections_reports.php?q=" + selectedFacilityType;
            $.ajax({
                url: _url, success: function (result) {
                    $("#byFacilityTypeContainer").html(result);
                }
            });

            // label facility type list
            // $("#byFacilityLabel").text(selectedFacilityTypeName);
        } else {
            $("#byFacilityTypeContainer").hide();
        }

        var titleString = createTitle(
            selectedWorkPermit,
            selectedYear,
            selectedApplicationStatus,
            selectedAllocationStatus,
            selectedGender,
            selectedDisability,
            selectedCadre, selectedFacilityTypeName, selectedFacilityItemByType, selectedRas);
        $("#title").html(titleString);
    });
     /**
     * Show district list
     */
    $("select#region_id").change(function () {
        selectedRegionTypeName = $("#region_id option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
            $("#byDistrictTypeContainer").show();
            let _url = "../lib/districtByReg.php?id=" + selectedRegionType;
            $.ajax({
                url: _url, success: function (result) {
                    $("#byDistrictTypeContainer").html(result);
                }
            });

            // label facility type list
            // $("#byFacilityLabel").text(selectedFacilityTypeName);
        } else {
            $("#byDistrictTypeContainer").hide();
        }

    
    });

    // $("#getReportButton").click(function (event) {
    $("#theReportForm").submit(function (event) {
        event.preventDefault();
        $("#progressContainer").show();
        $("#errorAlert").hide();
        let formData = $('#theReportForm').serialize();
        console.log(formData);
        $.ajax({
            type: "POST",
            data: formData,
            url: "pages/reports_ajax.php",
            context: document.body
        }).done(function (success) {
            console.log(success);
            $("#AJAXresponseData").html(success);

            $("#progressContainer").hide();
            $("#errorAlert").hide();
        }).error(function (error) {
            $("#innerErrorText").text(error.statusText);
            $("#progressContainer").hide();
            $("#errorAlert").show();
        });
        // console.log("Updating the report according to the selections");
    });

// $("#getReportButton").click(function (event) {
    $("#Budoya").submit(function (event) {
        event.preventDefault();
        $("#progressContainer").show();
        $("#errorAlert").hide();
        let formData = $('#Budoya').serialize();
        console.log(formData);
        $.ajax({
            type: "POST",
            data: formData,
            url: "pages/reports_ajaxAllocate.php",
            context: document.body
        }).done(function (success) {
            console.log(success);
            $("#AJAXres").html(success);

            $("#progressContainer").hide();
            $("#errorAlert").hide();
        }).error(function (error) {
            $("#innerErrorText").text(error.statusText);
            $("#progressContainer").hide();
            $("#errorAlert").show();
        });
        // console.log("Updating the report according to the selections");
    });
});
