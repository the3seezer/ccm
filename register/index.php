<?php session_start();
//Connect to database
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();
if (isset($_SESSION['userid'])) {
    header("Location:../?pg=dash");
} else {
    //Get Permit Year
    $getPY = $db->getWorkPermitYear();
    $rP = $getPY->fetch();
    $pmYear = $rP['year'];
    $query1 = $db->getnationalList();
    $query2 = $db->getCouncilList();
    $query3 = $db->getAllDisabilityName();
    // $query4=$db->getDisabilityNameById($disability_id);


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>CCM Maombi</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!--Custom-->
        <link href="../css/custom.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand">TIIS-WAO</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <?php //include("includes/notification.php");
                    ?>
                    <?php //include("includes/userprofile.php");
                    ?>
                    <p style="padding-left:100px;padding-right:100px;padding-top:10px; padding-bottom:10px;">
                        <a href="../login/"><span style="color:#FFF;text-decoration:none;">Already Registered? Login here</span></a></p>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">HELP DESK</li>
                            <p style="padding:10px;">
                                <b><br> +255653405893 <br> +255656197769</b>
                            </p>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
                <br /><br />

                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Registration Form</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
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

                </div>


            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET DISTRICT LIST///////////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadDistrictList(str) {

                if (str == "") {

                    document.getElementById("districtList").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("districtList").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "includes/districtList.php?q=" + str, true);

                xmlhttp.send();
            }


            // loadNationality
            function loadNationality(str) {
                // alert(str);
                if (str == "1375") {
                    // $("#countrytz".show();
                    $("#countrytz").show();
                    // alert("hello");
                } else {
                    $("#countrytz").hide();

                }
            }

            // loadDisiability
            function loadDisiability(str) {
                // alert(str);
                if (str == "YES") {
                    // $("#countrytz".show();
                    $("#disiabilityDIV").show();
                    // alert("hello");
                } else {
                    $("#disiabilityDIV").hide();

                }

            }


            // empoled
            function loadEmployed(str) {
                // alert(str);
                if (str == "YES") {
                    // $("#countrytz".show();
                    $("#employed").show();
                    // alert("hello");
                } else {
                    $("#employed").hide();

                }

            }

            // loadDisiability
            function loadOthers(str) {
                // alert(str);
                if (str == "others") {
                    // $("#countrytz".show();
                    $("#others").show();
                    // alert("hello");
                } else {
                    $("#others").hide();

                }

            }

            //////////////////////////////////////////
            ///////////////////////////////////////////
            //////PROCESSING REQUIREST FROM MODALS////
            ///////////////////////////////////////////
            //////////////////////////////////////////

            //<
            //!-- -- - Add New User-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getadduser', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addUser-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addUser.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addUser-content').html(''); // blank before load.
                            $('#addUser-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addUser-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            /////////////////////////////////////
            ////////////FACILITY////////////////
            ///////////////////////////////////

            //<
            //!-- -- - Add New Facility-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getaddFacility', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addFacility-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addFacility.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addFacility-content').html(''); // blank before load.
                            $('#addFacility-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addFacility-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            //<
            //!-- -- - Delete Facility-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getdeleteF', function(e) {
                    e.preventDefault();

                    var fac_id = $(this).data('id'); // get id of clicked row


                    $('#deleteFacility-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteFacility.php',
                            type: 'POST',
                            data: 'fac_id=' + fac_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteFacility-content').html(''); // blank before load.
                            $('#deleteFacility-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deleteFacility-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
        </script>


        <!--FORM VALIDATION SCRIPT -->
        <!-- form validation -->
        <script src="../js/validator/validator.js"></script>
        <script>
            // initialize the validator function
            validator.message['date'] = 'not a real date';

            // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
            $('form')
                .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                .on('change', 'select.required', validator.checkField)
                .on('keypress', 'input[required][pattern]', validator.keypress);

            $('.multi.required')
                .on('keyup blur', 'input', function() {
                    validator.checkField.apply($(this).siblings().last()[0]);
                });

            // bind the validation to the form submit event
            //$('#send').click('submit');//.prop('disabled', true);

            $('form').submit(function(e) {
                e.preventDefault();
                var submit = true;
                // evaluate the form using generic validaing
                if (!validator.checkAll($(this))) {
                    submit = false;
                }

                if (submit)
                    this.submit();
                return false;
            });

            /* FOR DEMO ONLY */
            $('#vfields').change(function() {
                $('form').toggleClass('mode2');
            }).prop('checked', false);

            $('#alerts').change(function() {
                validator.defaults.alerts = (this.checked) ? false : true;
                if (this.checked)
                    $('form .alert').remove();
            }).prop('checked', false);


            ///////////////////////////////////////
            ///////////////////////////////////////
            ////Check if username already exist/////
            ///////////////////////////////////////
            ////////////////////////////////////////

            document.getElementById("username").onblur = function() {
                var xmlhttp;
                var username = document.getElementById("username");
                if (username.value != "") {
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("status").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "../includes/uname_availability.php?username=" + encodeURIComponent(username.value), true);
                    xmlhttp.send();
                }
            };


            //////////////////////////////////////////////////
            ////////////Check if email exist/////////////////
            ////////////////////////////////////////////////
            document.getElementById("email").onblur = function() {
                var xmlhttp;
                var email = document.getElementById("email");
                if (email.value != "") {
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("emailStatus").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "../includes/email_availability.php?email=" + encodeURIComponent(email.value), true);
                    xmlhttp.send();
                }
            };


            //////////////////////////////////////////////////
            ////////////Check if security code is correct/////
            ////////////////////////////////////////////////
            // document.getElementById("securtyCode1").onblur = function() {
            //     var xmlhttp;
            //     var securtyCode = document.getElementById("securtyCode1");
            //     if (securtyCode.value != "") {
            //         if (window.XMLHttpRequest) {
            //             xmlhttp = new XMLHttpRequest();
            //         } else {
            //             xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            //         }
            //         xmlhttp.onreadystatechange = function() {
            //             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //                 document.getElementById("capturestatus").innerHTML = xmlhttp.responseText;
            //             }
            //         };
            //         xmlhttp.open("GET", "../includes/checkcode.php?captcha_code=" + encodeURIComponent(securtyCode.value), true);
            //         xmlhttp.send();
            //     }
            // };
        </script>

        <script>
            $(function() {
                var allowsubmit = false;
                //on keypress of password 1
                $('#password2').keyup(function(e) {


                    //get values
                    var password = $('#password').val();
                    var password2 = $(this).val();

                    //check the strings
                    if (password == password2) {
                        //if both are same remove the error and allow to submit
                        $('.error').text('');
                        $("#errorShow").hide();
                        allowsubmit = true;
                    } else {
                        //if not matching show error and not allow to submit
                        $('.error').text('Password not matching');
                        $("#errorShow").show();
                        allowsubmit = false;
                    }
                });

                //jquery form submit
                $('#form').submit(function() {

                    var password = $('#password').val();
                    var password2 = $('#password2').val();

                    //just to make sure once again during submit
                    //if both are true then only allow submit
                    if (password == password2) {
                        allowsubmit = true;
                    }
                    if (allowsubmit) {
                        return true;
                    } else {
                        return false;
                    }
                });
            });
        </script>

        <script type="text/javascript">
            function loadMonths(str) {

                if (str == "") {

                    document.getElementById("month").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("month").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "../includes/list_month.php?q=" + str, true);

                xmlhttp.send();
            }


            //<
            //!--Load Days for a selected month-- >
            function loadDays(str) {

                if (str == "") {

                    document.getElementById("days").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("days").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "../includes/list_days.php?q=" + str, true);

                xmlhttp.send();
            }
        </script>

    </body>

    </html>
<?php } ?>