<?php
$applicant_id = $_SESSION['applicant_id'];

$getAp = $db->getApplicationByAppId($applicant_id);
$getAp1 = $db->getApplicationByAppId($applicant_id);

//Get Permit Year
$getPY = $db->getWorkPermitYear();
$rP = $getPY->fetch();
$pmYear = $rP['year'];

//Applicant details
$getAppById = $db->getApplicantsById($applicant_id);
$rowAppById = $getAppById->fetch();

$getCa = $db->getAllActiveFacilityByCadre($pmYear, $rowAppById['cadreType']);
$getCa1 = $db->getAllActiveFacilityByCadre($pmYear, $rowAppById['cadreType']);
$getCa2 = $db->getAllActiveFacilityByCadre($pmYear,  $rowAppById['cadreType']);

//$getCa = $db->getAllActiveFacility($pmYear);
//$getCa1 = $db->getAllActiveFacility($pmYear);
//$getCa2 = $db->getAllActiveFacility($pmYear);

$getDocu = $db->getDocuments($applicant_id);
$getReg = $db->getRegistrationByAppId($applicant_id);
$getExp = $db->getExperienceByAppId($applicant_id);
$getProf = $db->getProfessionalByAppId($applicant_id);
$getBE = $db->getEducationByAppId($applicant_id);
$getG = $db->getGraduatesByAppId($applicant_id);



$selCadre = $db->getHealthCadresById($rowAppById['cadreType']);
$rowCadre = $selCadre->fetch();

$selDoc = $db->getCarderDocuments($rowAppById['cadreType']);

$required = 0;
while ($rwDoc = $selDoc->fetch()) {
    $documentID = $rwDoc['DocumentID'];
    $checkPass = $db->checkIfFileExist($documentID, $applicant_id);

    if ($checkPass->rowCount() == 0) {
        if ($rwDoc['type'] == 'Required') {
            $required += 1;
        }
    }
}
//get cetificate type
$getPass = $db->getDocType('Passport size');
$pass = $getPass->fetch();
$passport = $pass['DocumentID'];
//Check if file uploaded
$checkPass = $db->checkIfFileExist($passport, $applicant_id);

//get cetificate type
$getBirthCertificate = $db->getDocType('Birth Certificate');
$birthCert = $getBirthCertificate->fetch();
$birthCertificate = $birthCert['DocumentID'];
//Check if file uploaded
$checkCertificate = $db->checkIfFileExist($birthCertificate, $applicant_id);

?>
<div class="row">
    <div class="col-lg-12"><h2 class="page-header">Application Details </h2></div>


</div>

<div class="row">

    <div class="col-lg-12">
        <!--#If  -->
        <?php
        if (isset($_POST['searchRegistration']))
        {
            $council = $_POST['council'];
            $regType = $_POST['regType'];
            $regNo = $_POST['regNo'];
            $regYear = $_POST['regYear'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $fullname = $firstname . $lastname;
            $applicant_id = $_POST['applicant_id'];
            $app_id = $_POST['app_id'];

            //Check if user exist
            $curl = curl_init();

            //Set some options/settings
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://oas.mct.go.tz/wao_api.php?regType=' . $regType . '&regNo=' . $regNo . '&regYear=' . $regYear . '',
                CURLOPT_USERAGENT => 'MCT to WAO cURL Request'
            ));

            //Send the request & save response to $resp(JSON string)
            if (!curl_exec($curl)) {
                die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
            } else {
                $json_resp = curl_exec($curl);
            }

            //Close request to clear up some resources
            curl_close($curl);

            //Convert JSON string to Array
            $registrationArray = json_decode($json_resp, true);

            $countArr = count($registrationArray);

            if ($countArr < 1) {
                ?>
                <div class="panel panel-danger">
                    <div class="panel-heading">Error!</div>
                    <div class="panel-body">
                        <p>Your registration type number, number and year return nothing</p>
                    </div>
                </div>
                <?php
            } else {
                foreach ($registrationArray as $key => $value) {
                    $firstname1 = trim($value["first_name"]);
                    $lastname1 = trim($value["last_name"]);
                    $request = trim($value["Request"]);
                    $Reg_No = trim($value["Reg_No"]);
                    $regYear = trim($value["regYear"]);

                    $fullname1 = $firstname1 . $lastname1;
                }
                if ($fullname1 != $fullname) {
                    ?>
                    <div class="panel panel-warning">
                        <div class="panel-heading">Verification Error!</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr bgcolor="">
                                        <th colspan="6">
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <p>Your names do not match with the names querried from database depending on Registration
                                Type, Registration Number and Registration Year you provided. This deteils belongs
                                to <?php echo $firstname1 . " " . $lastname1; ?></p>
                        </div>
                    </div>
                    <?php
                } elseif ($fullname1 == $fullname) {
                    ?>
                    <div class="panel panel-success">
                        <div class="panel-heading">Verification Success!</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr bgcolor="">
                                        <th colspan="6">
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <p>
                                <?php
                                $updateR = $db->updateVerifiedRegistration($app_id);
                                ?>
                                One application is successfully verified!
                            </p>
                        </div>
                    </div>
                    <?php
                } else {
                }
            }
            ?>


            <!--If there is application show this section-->
            <div class="panel panel-success">
                <div class="panel-heading">
                    You have Submitted the following application details!
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>

                            <tr bgcolor="">
                                <th>Choices</th>
                                <th>Work Permit</th>
                                <th>Cadre</th>
                                <th>Reg Date</th>
                                <th>Status</th>
                                <!--                                <th>Board Registration <br/>Verification</th>-->
                                <th>Edit</th>
                                <!--<th>Delete</th>-->
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            while ($row = $getAp->fetch()) {
                                $app_id = $row['app_id'];
                                $choiceNo = $row['choiceNo'];
                                $category = $row['category'];
                                $wp_id = $row['fac_id'];
                                $cadre_id = $row['cadre_id'];
                                $cadreName = $row['cadreName'];
                                $boardV = $row['boardV'];
                                $date = $row['date'];
                                $status = $row['status'];
                                $req_verify = $row['required_verification'];
                                $verify = $row['verified'];

                                $wpname = '';
                                include("lib/criteria_setting.php");


                                /* //Get Cadre name
                                $getCa=$db->getCadreByCardeId($cadre_id);
                                $rw1=$getCa->fetch();
                                //$cadName=$rw1['cadreName']; */

                                ?>

                                <tr>
                                <td>Choice <?php echo $choiceNo; ?></td>
                                <td><?php echo strtoupper($wpname); ?></td>
                                <td><?php echo strtoupper($cadreName); ?></td>
                                <td><?php echo $row['date']; ?></td>


                                <?php
                                if ($status == "Pending") {
                                    ?>
                                    <td align="left"><a href="#" class="btn btn-warning btn-xs">Pending</a></td>
                                    <?php
                                } elseif ($status == "Accepted") {
                                    ?>
                                    <td align="left"><a href="#" class="btn btn-success btn-xs">Accepted</a></td>
                                    <?php
                                } elseif ($status == "Rejected") {
                                    ?>
                                    <td align="left"><a href="#" class="btn btn-danger btn-xs">Rejected</a></td>
                                    <?php
                                } else {
                                }
                                ?>

                                <?php
                                if ($status == "Pending") {

                                    ?>


                                    <td align="left">
                                        <a href="#editApplication" class="btn btn-primary btn-xs" data-toggle="modal"
                                           data-id="<?php echo $app_id; ?>" id="geteditApplication"><i
                                                    class="fa fa-edit"></i>Edit</a>
                                    </td>


                                    </tr>

                                    <?php
                                } else {
                                }
                                ?>


                                <?php $i++;
                            } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php
        } elseif ($checkPass->rowCount() <= 0) { ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Personal Details missing!. Make sure you have uploaded <b>Passport size photograph</b> before
                        proceeding with this section</p>
                </div>
            </div>
        <?php } elseif ($checkCertificate->rowCount() <= 0) { ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Personal Details missing!. Make sure you have uploaded <b>Certificate of Birth</b> before
                        proceeding with this section</p>
                </div>
            </div>
            <?php
        } #If No basic education details
        elseif ($getBE->rowCount() < 1) {
            ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Make sure that you enter your basic education details before proceeding with this section</p>
                </div>
            </div>
            <?php
        } elseif ($getProf->rowCount() < 1)//#If No Professional Details -->
        {
            ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Make sure that you enter your professional details before proceeding with this section</p>
                </div>
            </div>
            <?php
        } /*
       elseif($getG->rowCount()<1)//#If No Graduate Details -->
       {
        ?>
        <div class="panel panel-danger">
         <div class="panel-heading">Error!</div>
         <div class="panel-body">
         <p>Make sure that you enter your graduate details before proceeding with this section</p>
         </div>
        </div>
        <?php
        }

        elseif($getExp->rowCount()>1)//#If No Experience Details -->
        {
        ?>
        <div class="panel panel-danger">
        <div class="panel-heading">Error!</div>
        <div class="panel-body">
        <p>Make sure that you enter your Experience details before proceeding with this section</p>
        </div>
        </div>
        <?php
        }

        elseif($getReg->rowCount()>1)//#If No Registration Details -->
        {
        ?>
        <div class="panel panel-danger">
        <div class="panel-heading">Error!</div>
        <div class="panel-body">
        <p>Make sure that you enter your Registration details before proceeding with this section</p>
        </div>
        </div>
        <?php
        }
*/
        elseif ($required > 0)//#If No document Details -->
        {
            ?>
            <div class="panel panel-danger">
                <div class="panel-heading">Error!</div>
                <div class="panel-body">
                    <p>Make sure that you upload your document details before proceeding with this section</p>
                </div>
            </div>
            <?php
        } //elseif($getBE->rowCount()>1 AND $getProf->rowCount()>1 AND $getExp->rowCount()>1 AND $getReg->rowCount()> AND $getDocu->rowCount()>0 AND $getG->rowCount()>0 AND $getAp->rowCount()<1)
        elseif ($getAp->rowCount() < 1) {
            ?>
            <div class="panel panel-primary">
                <div class="panel-heading"> Make Application by selecting facility or work place below. You can select up to
                    three choices.
                </div>
                <div class="panel-body">


                    <form action="includes/process.php" method="post" class="form-horizontal">
                        <!-- Cadre -->
                        <div class="item form-group">
                            <span class="col-md-12 text-center text-danger">NB: <b>MAKE SURE YOU VERIFY YOUR CHOICES BEFORE YOU SUBMIT, SUBMITED APPLICATION CAN NEITHER BE EDITED NOR DELETED </b></span>
                        </div>
                        <hr>
                        <!--Choice 1-->
                        <div class="item form-group">
                            <label class="form-horizontal col-md-12 text-center">
                                Your cadre is: <?= $rowCadre['cadreName'] ?>
                                <input type="hidden" name="cadre_id" value="<?php echo $rowCadre['cadreId'] ?>">
                            </label>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Choice 1<span
                                        class="required"></span></label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" name="fac1" required="required"
                                        onchange="loadCadreValue(this.value);">
                                    <option value="">--Select Work Permit--</option>
                                    <?php
                                    while ($row = $getCa->fetch()) {
                                        $fac_id = $row['fac_id'];
                                        $category = $row['category']; //Category
                                        $wp_id = $row['wp_id']; //Work permit Id

                                        $wpname = '';
                                        include("lib/criteria_setting.php");
                                        ?>
                                        <option value="<?php echo $fac_id . "=" . $category . "=" . $wp_id; ?>">
                                            <?php echo strtoupper($wpname); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <!--Choice 2-->
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Choice 2<span
                                        class="required"></span></label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select id="status" class="form-control col-md-7 col-xs-12" name="fac2"
                                        required="required" onchange="loadCadre1(this.value)">
                                    <option value="">--Select Work Permit--</option>
                                    <?php
                                    while ($row1 = $getCa1->fetch()) {
                                        $fac_id = $row1['fac_id'];
                                        $category = $row1['category'];
                                        $wp_id = $row1['wp_id'];

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


                        <!--Choice 3-->
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Choice 3<span
                                        class="required"></span></label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select id="facility" class="form-control col-md-7 col-xs-12" name="fac3"
                                        required="required" onchange="loadCadre2(this.value)">
                                    <option value="">--Select Work Permit--</option>
                                    <?php
                                    while ($row11 = $getCa2->fetch()) {
                                        $fac_id = $row11['fac_id'];
                                        $category = $row11['category'];
                                        $wp_id = $row11['wp_id'];

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

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <input type="submit" id="send" class="btn btn-success" name="addApplication"
                                       value="Submit"/>
                                <input type="reset" class="btn btn-default" value="Clear"/>
                                <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>

                            </div>
                        </div>
                </div>
                </form>
            </div>

            <?php
        }
        elseif ($getAp->rowCount() > 0)
        {
        ?>

        <!--If there is application show this section-->
        <div class="panel panel-success">
            <div class="panel-heading">
                You have Submitted the following application details!
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>

                        <tr bgcolor="">
                            <th>Choices</th>
                            <th>Work Permit Location</th>
                            <th>Cadre</th>
                            <th>App Date</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $i = 1;
                        while ($row = $getAp->fetch()) {
                            $app_id = $row['app_id'];
                            $choiceNo = $row['choiceNo'];
                            $category = $row['category'];
                            $wp_id = $row['fac_id'];
                            $cadre_id = $row['cadre_id'];
                            $cadreName = $row['cadreName'];
                            $boardV = $row['boardV'];
                            $date = $row['date'];
                            $status = $row['status'];
                            $req_verify = $row['required_verification'];
                            $verify = $row['verified'];

                            $wpname = '';
                            include("lib/criteria_setting.php");


                            ?>

                            <tr>
                            <td>Choice <?php echo $choiceNo; ?></td>
                            <td><?php echo strtoupper($wpname); ?></td>
                            <td><?php echo strtoupper($cadreName); ?></td>
                            <td><?php echo $row['date']; ?></td>


                            <?php $i++;
                        } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!--SECTION STATUS-->
        <?php

        //Check application status
        $getStatus = $db->getApplicationStatus($applicant_id, $pmYear);
        $rw = $getStatus->fetch();
        $status = $rw['status'];

        if ($status == "Pending") {
            ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    Application was Posted Successfully
                </div>
                <div class="panel-body">

                    <div class="table-responsive">

                        <p>Wait for work allocation posts to be announced at the end when allocation process is over</p>
                    </div>
                </div>
            </div>
            <?php 
        //} elseif ($status == "Accepted") {
           // $getAppStatus = $db->getApplicationStatusByAppIdToApprove($applicant_id, $pmYear);
            // //$rwApp = $getAppStatus->fetch();
            // $allocate_id = $rwApp['allocate_id'];
            // $app_id = $rwApp['app_id'];
            // $applicant_id = $rwApp['applicant_id'];
            // $category = $rwApp['category'];
            // $wp_id = $rwApp['wp_id'];
            // $cadreid = $rwApp['cadre_id'];
            // $choiceNo = $rwApp['choiceNo'];
            // $score = $rwApp['score'];

            // $wpname = '';
            // include("lib/criteria_setting.php");

            //Get Cadre name
            // $getCa = $db->getHealthCadresById($cadreid);
            // $rwC = $getCa->fetch();
            // $cadName = $rwC['cadreName'];
            //?>
            <!-- <div class="panel panel-success">
                <div class="panel-heading">
                    Selection Status!
                </div>
                <div class="panel-body">

                    <div class="table-responsive">

                        <p>Your Application is accepted</p>
                        <p>Your working station is: <?php echo strtoupper($wpname); ?></p>
                        <p>You are Employed as: <?php echo strtoupper($cadName); ?></p> -->
                        <!--<p>Reporting date is: </p>-->


                    <!-- </div>
                </div>
            </div> -->


           <?php
       // } elseif ($status == "Unshortlisted") {
           // ?>
           <!--  <div class="panel panel-warning">
                <div class="panel-heading">
                    Selection Status!
                </div>
                <div class="panel-body">

                    <div class="table-responsive">

                        <p>Sorry! Your Application is rejected due to lack of proper information</p>


                    </div>
                </div>
            </div> -->
            <?php
        } elseif ($status != "Pending") {
            ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    Application was Posted Successfully
                </div>
                <div class="panel-body">

                    <div class="table-responsive">

                        <p>Wait for work allocation posts to be announced at the end when allocation process is over</p>
                    </div>
                </div>
            </div>
            <?php
        } else {
        }
        ?>
        <!--END-->


        </form>
    </div>
    <?php } else {
    } ?>
</div>
</div>
</div>


<!--DEFINING MODALS--->

<!--Module Verify Application-->
<div id="addReg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Verify Application</h4>
            </div>
            <div class="modal-body">

                <div id="addRegistration-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module Edit Application-->
<div id="editApplication" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Application Detail:</h4>
            </div>
            <div class="modal-body">

                <div id="editApplication-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


