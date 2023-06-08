<?php
$applicant_id = $_GET['id'];
$getF = $db->getApplicantsById($applicant_id);
$getBE = $db->getEducationByAppId($applicant_id);
$getProf = $db->getProfessionalByAppId($applicant_id);
$getExp = $db->getExperienceByAppId($applicant_id);
$getReg = $db->getRegistrationByAppId($applicant_id);
$getDoc = $db->getDocuments($applicant_id);
$getAp = $db->getApplicationByAppId($applicant_id);

//Get Permit Year
$getPY = $db->getWorkPermitYear();
$rP = $getPY->fetch();
$pmYear = $rP['year'];
$getCa = $db->getAllActiveFacility($pmYear);
$getCa1 = $db->getAllActiveFacility($pmYear);
$getCa2 = $db->getAllActiveFacility($pmYear);

$getRegNo=$db->getCouncilRegID($applicant_id);
$rwRN=$getRegNo->fetch();
$str=$rwRN['councilRegistrationID'];

$regNo = "MCT".substr($str,-4);
?>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"><span style="left">Application Details</span><span style="float:right; margin-right:10px;">
	<a href="?pg=verifyApp&id=<?php echo $applicant_id; ?>&regN=<?php echo $regNo; ?>" class="btn btn-success btn-xs" target=_blank><i class="fa fa-folder"></i> Verify</a>
	</span></h2>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">Part 1: Personal Details</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                         <form method="post" action="formprocessor.php" class="form-horizontal form-label-left" novalidate>
                            <!--First Name-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="firstname" required type="text" data-validate-length-range="2,50" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                                print_r($_SESSION['formData']['firstname']);
                                                                                                                                                                            } ?>">
                                </div>
                            </div>

                            <!--Middle Name-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Middle Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="middle" class="form-control col-md-7 col-xs-12" data-validate-length-range="2,50" name="middle" type="text" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                        print_r($_SESSION['formData']['middle']);
                                                                                                                                                                    } ?>">
                                </div>
                            </div>

                            <!--Last Name-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last">Last Name <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="last" class="form-control col-md-7 col-xs-12" name="lastname" required="required" type="text" data-validate-length-range="2,50" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                                            print_r($_SESSION['formData']['lastname']);
                                                                                                                                                                                        } ?>">
                                </div>
                            </div>

                            <!--Date Of Birth-->
                            <div class="item form-group">

                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth<span class="required">*</span> </label>

                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control" id="year" name="year" required onChange="loadMonths(this.value)">
                                        <option value="">Year</option>
                                        <option>
                                            <?php
                                            $cY = date('Y');
                                            $reY = $cY - 18; //Applicant must have greater or equal to 18 years
                                            echo $reY; ?></option>
                                        <?php $i = 1;
                                        for ($i = 1; $i <= 27; $i++) { //Applicant must have less or equal to 45 years
                                        ?>
                                            <option><?php echo $reY - $i; ?></option><?php } ?>
                                    </select>
                                </div>


                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" id="month" name="month" required onchange="loadDays(this.value)">
                                        <option value="">Month</option>
                                    </select>
                                </div>


                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control" id="days" name="day" required>
                                        <option value="">Day</option>
                                    </select>
                                </div>
                            </div>

                            <!--Gender-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gender <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php if (isset($_SESSION['formData'])) {
                                        $gender = $_SESSION['formData']['gender'];
                                    } ?>
                                    <select id="gender" class="form-control col-md-7 col-xs-12" name="gender" required="required">
                                        <option value="">--Select--</option>
                                        <option value="Male" <?php if (isset($_SESSION['formData'])) {
                                                                    if ($gender == "Male") {
                                                                        echo "selected";
                                                                    }
                                                                } ?>>Male
                                        </option>
                                        <option value="Female" <?php if (isset($_SESSION['formData'])) {
                                                                    if ($gender == "Female") {
                                                                        echo "selected";
                                                                    }
                                                                } ?>>Female
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <!--Marital Status-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Marital Status <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php if (isset($_SESSION['formData'])) {
                                        $maritalStatus = $_SESSION['formData']['maritalStatus'];
                                    } ?>
                                    <select id="maritalStatus" class="form-control col-md-7 col-xs-12" name="maritalStatus" required="required">
                                        <option value="">--Select--</option>
                                        <option value="Married" <?php if (isset($_SESSION['formData'])) {
                                                                    if ($maritalStatus == "Married") {
                                                                        echo "selected";
                                                                    }
                                                                } ?>>Married
                                        </option>
                                        <option value="Single" <?php if (isset($_SESSION['formData'])) {
                                                                    if ($maritalStatus == "Single") {
                                                                        echo "selected";
                                                                    }
                                                                } ?>>Single
                                        </option>
                                        <option value="Divorced" <?php if (isset($_SESSION['formData'])) {
                                                                        if ($maritalStatus == "Divorced") {
                                                                            echo "selected";
                                                                        }
                                                                    } ?>>Divorced
                                        </option>
                                        <option value="Widow" <?php if (isset($_SESSION['formData'])) {
                                                                    if ($maritalStatus == "Widow") {
                                                                        echo "selected";
                                                                    }
                                                                } ?>>Widow
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!--Username-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="username" class="form-control col-md-7 col-xs-12" placeholder="" name="username" required="required" type="text" data-validate-length-range="4,50" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                                                                print_r($_SESSION['formData']['username']);
                                                                                                                                                                                                            } ?>"><span id="status"></span>
                                </div>
                            </div>

                            <!--Password-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Password<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password" class="form-control col-md-7 col-xs-12" name="password" data-validate-length="" data-validate-length-range="8,50" required type="password" placeholder="Password must contain atleast 8 or more characters">
                                </div>
                            </div>

                            <!--Re-type Password-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Re-type Password<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password2" class="form-control col-md-7 col-xs-12" name="password2" data-validate-linked="password" required="required" type="password">
                                </div>
                            </div>

                            <div class="item form-group" id="errorShow" style="display:none;">
                                <label class="col-sm-2 control-label"></label>

                                <div class="col-sm-10">
                                    <label class="col-sm-12 error" style="color:red"></label>
                                </div>
                            </div>


                            <!--Nationality-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nationality <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php if (isset($_SESSION['formData'])) {
                                        $national = $_SESSION['formData']['national'];
                                    } ?>
                                    <select id="national" class="form-control col-md-7 col-xs-12" name="national" required="required" onchange="loadNationality(this.value)">
                                        <!-- <option value="">--Select--</option> -->
                                        <?php
                                        while ($row = $query1->fetch()) {
                                            $id = $row['id'];

                                            echo '<option';
                                            if (isset($_SESSION['formData'])) {
                                                if ($national == $id) {
                                                    echo " selected ";
                                                }
                                            } else {
                                                if ($id == '1375') {
                                                    echo " selected ";
                                                }
                                            }
                                            echo ' value ="' . $row['id'] . '">' . $row['value'] . '</option><br>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div id="countrytz" style="display: block;">

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Country <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php if (isset($_SESSION['formData'])) {
                                            $country = $_SESSION['formData']['country'];
                                        } ?>
                                        <select id="country" class="form-control col-md-7 col-xs-12" name="country" required="required">
                                            <option value="">--Select--</option>
                                            <option value="Tanzania mainland" <?php if (isset($_SESSION['formData'])) {
                                                                                    if ($country == "Tanzania mainland") {
                                                                                        echo "selected";
                                                                                    }
                                                                                } ?>>Tanzania Mainland
                                            </option>
                                            <option value="Zanzibar" <?php if (isset($_SESSION['formData'])) {
                                                                            if ($country == "Zanzibar") {
                                                                                echo "selected";
                                                                            }
                                                                        } ?>>Zanzibar
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nida">NIDA </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="nida" class="form-control col-md-7 col-xs-12" name="nida" type="text" placeholder="xxxxxxxxxxxxxxxxxxxx (without dashes)" data-validate-length="20,20" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                                                                        print_r($_SESSION['formData']['nida']);
                                                                                                                                                                                                                    } ?>">
                                    </div>
                                </div>
                            </div>

                            <!--Disiability-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Disability <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php if (isset($_SESSION['formData'])) {
                                        $disiability = $_SESSION['formData']['disiability'];
                                    } ?>
                                    <select id="disiability" class="form-control col-md-7 col-xs-12" name="disiability" required="required" onchange="loadDisiability(this.value)">
                                        <option value="">--Select--</option>
                                        <option value="YES" <?php if (isset($_SESSION['formData'])) {
                                                                if ($disiability == "YES") {
                                                                    echo "selected";
                                                                }
                                                            } ?>>YES
                                        </option>
                                        <option value="NO" <?php if (isset($_SESSION['formData'])) {
                                                                if ($disiability == "NO") {
                                                                    echo "selected";
                                                                }
                                                            } ?>>NO
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div id="disiabilityDIV" <?php if (isset($_SESSION['formData']) && $_SESSION['formData']['disiability'] == "YES") {
                                                            echo 'style="display: block;"';
                                                        } else {
                                                            echo 'style="display: none;"';
                                                        } ?>>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Disability Type<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php if (isset($_SESSION['formData'])) {
                                            $disiability_type = $_SESSION['formData']['disiability_type'];
                                        } ?>
                                        <select id="disiability_type" class="form-control col-md-7 col-xs-12" name="disiability_type" required="required" onchange="loadOthers(this.value)">
                                            <option value="">--Select--</option>
                                            <?php
                                            while ($row = $query3->fetch()) {
                                                $disabilityName = $row['disabilityName'];
                                            ?>
                                                <option <?php if (isset($_SESSION['formData'])) {
                                                            if ($disiability_type == $disabilityName) {
                                                                echo "selected";
                                                            }
                                                        } ?> value="<?php echo $row['disabilityName']; ?>"><?php echo $row['disabilityName']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="others" style="display: none;">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Others
                                        Disability </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="other_disiability" class="form-control col-md-7 col-xs-12" name="other_disiability" type="text" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                print_r($_SESSION['formData']['other_disiability']);
                                                                                                                                                            } ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Cadre Type <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                    if (isset($_SESSION['formData'])) {
                                        $cadreType = $_SESSION['formData']['cadreType'];
                                    }
                                    ?>
                                    <select id="cadreType" class="form-control col-md-7 col-xs-12" name="cadreType" required="required">
                                        <option value="">--Select--</option>
                                        <?php
                                        $selCadre = $db->getActiveWorkPermitYearWithCadre($pmYear);
                                        while ($rowCadre = $selCadre->fetch()) {
                                            $cadreId = $rowCadre['cadreId'];
                                            $cadreName = $rowCadre['cadreName'];
                                            echo '<option';
                                            if (isset($_SESSION['formData'])) {
                                                if ($cadreId == $cadreType) {
                                                    echo " selected ";
                                                }
                                            }
                                            echo ' value ="' . $cadreId . '">' . $cadreName . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Council Type <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                    if (isset($_SESSION['formData'])) {
                                        $councilType = $_SESSION['formData']['councilType'];
                                    }
                                    ?>
                                    <select id="councilType" class="form-control col-md-7 col-xs-12" name="councilType" required="required">
                                        <option value="">--Select--</option>
                                        <?php while ($row2 = $query2->fetch()) {
                                            $council_id = $row2['id'];
                                            echo '<option';
                                            if (isset($_SESSION['formData'])) {
                                                if ($council_id == $councilType) {
                                                    echo " selected ";
                                                }
                                            }
                                            echo ' value ="' . $row2['id'] . '">' . $row2['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Council Registration Number<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="councilRegistrationID" class="form-control col-md-7 col-xs-12" name="councilRegistrationID" type="text" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                    print_r($_SESSION['formData']['councilRegistrationID']);
                                                                                                                                                                } ?>" required="required">
                                </div>
                                <span class="text-center"></span>
                            </div>


                            <!--Have You Ever been employed-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Have You Ever been employed?<small>By Government</small> <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php if (isset($_SESSION['formData'])) {
                                        $employed = $_SESSION['formData']['employed'];
                                    } ?>
                                    <select id="gov" class="form-control col-md-7 col-xs-12" name="employed" required="required" onchange="loadEmployed(this.value)">
                                        <option value="">--Select--</option>
                                        <option value="YES" <?php if (isset($_SESSION['formData'])) {
                                                                if ($employed == "YES") {
                                                                    echo "selected";
                                                                }
                                                            } ?>>YES
                                        </option>
                                        <option value="NO" <?php if (isset($_SESSION['formData'])) {
                                                                if ($employed == "NO") {
                                                                    echo "selected";
                                                                }
                                                            } ?>>NO
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!--END Have You Ever been employed-->

                            <div id="employed" style="display: none;">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Check Number </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="checkNumber" class="form-control col-md-7 col-xs-12" name="checkNumber" type="text" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                    print_r($_SESSION['formData']['checkNumber']);
                                                                                                                                                } ?>">
                                    </div>
                                </div>
                            </div>

                            <!--END Have You Ever been employed-->


                            <!--Postal Addres-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Postal Address<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="address" class="form-control col-md-7 col-xs-12" name="address" required="required" type="text" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                            print_r($_SESSION['formData']['address']);
                                                                                                                                                        } ?>">
                                </div>
                            </div>

                            <!--Phone Number-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone Number<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <!-- <input type='tel' pattern="^[\0]\d{10}$" title='Phone Number (Format: 0xxxxxxxxx' name="phone" required="required" class="form-control col-md-7 col-xs-12" id="phone" placeholder="07xxxxxxxx" > -->
                                    <input id="phone" class="form-control col-md-7 col-xs-12" name="phone" required="required" type="tel" data-validate-minmax="10,10" data-validate-length-range="10,10" placeholder="07xxxxxxxx" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                                                                                                print_r($_SESSION['formData']['phone']);
                                                                                                                                                                                                                                            } ?>">
                                </div>
                            </div>

                            <!--Email Address-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="email" class="form-control col-md-7 col-xs-12" name="email" required="required" type="email" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                        print_r($_SESSION['formData']['email']);
                                                                                                                                                    } ?>">
                                    <span id="emailStatus"></span>
                                </div>
                            </div>

                            <!--Capture Image-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img id="captcha" src="../securimage/securimage_show.php" alt="CAPTCHA Image" />
                                    <a href="#" onclick="document.getElementById('captcha').src = '../securimage/securimage_show.php?' + Math.random(); return false">[Try
                                        other codes ]</a>
                                </div>
                            </div>

                            <!--Write text image-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="captcha_code">Write Text as
                                    seen above<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="securtyCode1" class="form-control col-md-7 col-xs-12" name="captcha_code" required="required" type="text">
                                    <!--<span id="capturestatus"></span>-->
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-default">Clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>


            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>


<!--DEFINING MODALS--->
<!--Module to Add New -->
<div id="addFacility" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Facility:</h4>
            </div>
            <div class="modal-body">

                <div id="addFacility-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Delete -->
<div id="deleteF" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Facility:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteFacility-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Modal: View Documents-->
<div id="docuView" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Preview Document</h4>
            </div>
            <div class="modal-body">
                <div id="previewdocu-content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Accept Application -->
<div id="acceptEdu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Accept Application:</h4>
            </div>
            <div class="modal-body">

                <div id="acceptApplication-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Reject Application -->
<div id="rejectApp" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Reject Application:</h4>
            </div>
            <div class="modal-body">

                <div id="rejectApplication-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


          