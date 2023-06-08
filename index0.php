<?php session_start();
if (empty($_SESSION['userid'])) {
    header("Location:login/");
} else {
    //Connect to database
    include("lib/dbconnect.php");
    $db = new dbClass();
    $db->connect();

    //Get Permit Year
    
    $pmYear = 2020;

    $pg = $_GET['pg'];

    switch ($pg) {
        case "dash":
            $pg1 = "Karibu Mfumo wa CCM";
            break;

        case "mngUser":
            $pg1 = "Watumiaji wa Mfumo";
            break;

        case "mngMabaraza":
            $pg1 = "Manage Mabaraza";
            break;

        case "mngWk":
            $pg1 = "Manage Work Permit";
            break;

        case "mngFD":
            $pg1 = "Manage Facility Details";
            break;

        case "bEd":
            $pg1 = "Manage Basic Education";
            break;

        case "proD":
            $pg1 = "Manage Proffesional Details";
            break;

        case "ExpD":
            $pg1 = "Manage Experience Details";
            break;

        case "regD":
            $pg1 = "Manage Registration Details";
            break;

        case "DocD":
            $pg1 = "Manage Document Details";
            break;

        case "application":
        case "mngapp":
            $pg1 = "Manage Application";
            break;

        case "applicant":
            $pg1 = "Manage Applicants";
            break;

        case "mngAppDetails":
            $pg1 = "Manage Applicant Details";
            break;

        case "selected":
            $pg1 = "Manage Selected Applicant";
            break;

        case "shortListed":
            $pg1 = "Manage Short Listed Applicant";
            break;

        case "rejected":
            $pg1 = "Manage Rejected Applicant";
            break;

        case "grad":
            $pg1 = "Manage Graduates Details";
            break;

        case "mngWPC":
            $pg1 = "Manage Work Permit Category";
            break;

        case "mngReg":
            $pg1 = "Mkoa";
            break;

        case "mngDis":
            $pg1 = "Wilaya";
            break;
		case "mngJimbo":
            $pg1 = "Jimbo";
            break;
        case "mngTarafa":
            $pg1 = "Tarafa";
            break;
        case "mngKata":
            $pg1 = "Kata";
            break;
		case "mngMtaa":
            $pg1 = "Mtaa/Kijiji";
            break;
		case "mngTawi":
            $pg1 = "Tawi";
            break;
        case "mngMin":
            $pg1 = "Manage Ministry";
            break;

        case "mngFac":
            $pg1 = "Manage Facility";
            break;

        case "mngCdre":
            $pg1 = "Manage Cadre";
            break;

        case "mngCrS":
            $pg1 = "Setting Criteria";
            break;

        case "mngDisiability":
            $pg1 = "Manage Disiability";
            break;

        case "mngCr":
            $pg1 = "Manage Cadre Criteria";
            break;

        case "mngInstitution":
            $pg1 = "Manage Institutions";
            break;
        case "mngCourse":
            $pg1 = "Manage Course";
            break;

        case "changePassword":
            $pg1 = "Change Password";
            break;

        case "mngCCD":
            $pg1 = "Manage Cadre Criteria Details";
            break;

        case "mngAll":
            $pg1 = "Manage Allocation";
            break;
        case "mnAlloc":
            $pg1 = "Manual Allocation";
            break;

        case "shortRe":
            $pg1 = "Shortlisted Report";
            break;

        case "alloRep":
            $pg1 = "Allocation Report";
            break;

        case "mngRAS":
            $pg1 = "Manage Ras";
            break;

        case "mngRRH":
            $pg1 = "Manage RRH";
            break;

        case "agenciesApp":
            $pg1 = "Agencies Applicants";
            break;

        case "agenciesAccepted":
            $pg1 = "Accepted Applicants";
            break;

        case "agenciesRejected":
            $pg1 = "Rejected Applicants";
            break;

        case "accept":
            $pg1 = "accept Applicants";
            break;


        case "unshortRe":
            $pg1 = "Unshortlisted Report";
            break;

        case "mngDocuments":
            $pg1 = "Manage Documents";
            break;

        case "reports":
            $pg1 = "Reports";
            break;
        case "verifyApp":
            $pg1="Verify Applicant";
            break;

        default:
            $pg1 = "";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
       <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>CCM <?php echo $pg1; ?></title>

       <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">


        <!-- Morris Charts CSS -->
        <link href="css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- DataTables CSS -->
        <link href="css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!--For upload image to a modal-->
        <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <link href="themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css" />

        <script src="js/sweetalert.min.js"></script>
		 <script src="js/validator/validator.js"></script>

        <link href="select2/select2.min.css" rel="stylesheet" />

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
                    <a class="navbar-brand">Chama Cha Mapinduzi</a>
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
                    <?php include("includes/userprofile.php"); ?>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">

                    <?php include("includes/nav.php"); ?>


                </div>
            </nav>

            <div id="page-wrapper">

                <?php
                switch ($pg) {
                    case "dash":
                        include("pages/main.php");
                        break;
                    case "mngUser":
                        include("pages/manageUsers.php");
                        break;
					case "regUser":
                        include("pages/manageUserMpya.php");
                        break;
					case "regUserPost":
                        include("pages/registerUser.php");
                        break;
					case "Picha":
                        include("pages/managePichaList.php");
                        break;
					case "PichaPost":
                        include("pages/managePicha.php");
                        break;
					case "bthibitisha":
                        include("pages/tafutaWagombeaTb.php");
                        break;
                    case "mngWk":
                        include("pages/manageWorkP.php");
                        break;
                    case "mngFD":
                        include("pages/manageFD.php");
                        break;
                    case "bEd": 
                        include("pages/manageElimsingi1.php");
                        break;
					case "bElimu":
                        include("pages/manageBasicEdit.php");
                        break;
					case "bMsingi": 
                        include("pages/manageBasic1.php");
                        break;
					case "bUanaEdit":
                        include("pages/manageUchamaEdit.php");
                        break;
					case "bUchama":
                        include("pages/manageUanachama.php");
                        break;
					case "bChama":
                        include("pages/manageUchama1.php");
                        break;
					case "pProfile":
                        include("pages/manageProfile.php");
                        break;
				   case "bMgProfile":
                        include("pages/manageProfile1.php");
                        break;
				   case "wago":
                        include("pages/tafutaWagombeaReport.php");
                        break;
					case "mato":
                        include("pages/tafutaMatokeoReport.php");
                        break;
				    case "mapato":
                        include("pages/tafutaPesaReport.php");
                        break;
					case "teuliwa":
                        include("pages/tafutaMUteuziReport.php");
                        break;
					case "bMaoni":
                        include("pages/tafutaWagombea.php");
                        break;
					case "bMaoniPost":
                        include("pages/manageChamaaMaoni.php");
                        break;
					case "bUtambulishoEdit":
                        include("pages/managePersonalDetailsEdit.php");
                        break;
					case "bMgMaoni":
                        include("pages/manageMaoni.php");
                        break;
					case "bKurajumla":
                        include("pages/tafutaNgazi1.php");//include("pages/manageJimboKura.php");
                        break;
					case "bKurajumlaPost":
                        include("pages/manageJimboKura.php");
                        break;
					case "bKura":
                        include("pages/manageMatokeoKura.php");
                        break;
					case "bKuraJimbo":
                        include("pages/manageJimboJumlaKura.php");
                        break;
				    case "bKuramgombea":
                        include("pages/tafutaWagombeaKura1.php");
                        break;
					case "bKuramgombeaPost":
                        include("pages/manageKura1.php");
                        break;
					case "bUteuzi":
                        include("pages/tafutaWagombeaTeuzi1.php");
                        break;
					case "bUteuziPost":
                        include("pages/manageUteuzi1.php");
                        break;
					case "bMgUteuzi":
                        include("pages/manageMatokeoUteuzi.php");
                        break;
					case "pDetail": 
                        include("pages/managePersonalDetails.php");
                        break;
                    case "pDetailUtambulisho": 
                        include("pages/manageUtambulisho.php");
                        break;
                    case "proD":
                        include("pages/manageProDetails.php");
                        break;
                    case "ExpD":
                        include("pages/manageExpDetails.php");
                        break;
                    case "regD":
                        include("pages/manageReg.php");
                        break;
                    case "mngMabaraza":
                        include("pages/manageMabaraza.php");
                        break;
                    case "DocD":
                        include("pages/manageDocu.php");
                        break;
                    case "mngapp":
                        include("pages/manageApp.php");
                        break;
                    case "mngInstitution":
                        include("pages/manageInstitution.php");
                        break;

                    case "mngCourse":
                        include("pages/manageCourse.php");
                        break;

                    case "applicant":
                        include("pages/manageApplicants.php");
                        break;
                    case "application":
                        include("pages/manageApplication.php");
                        break;
                    case "mngAppDetails":
                        include("pages/manageApplicantDetails.php");
                        break;
                    case "verifyApp":
                        include("pages/verifyApplicant.php");
                        break;
                    case "selected":
                        include("pages/manageSelectedApp.php");
                        break;
                    case "shortListed":
					    include("pages/reportsAllocate.php");
                        //include("pages/manageShortListedApp.php");
                        break;
					case "shortListedB":
					    include("pages/reports_ajaxAllocateB.php");
                        break;
                    case "rejected":
                        include("pages/manageRejectedApp.php");
                        break;
                    case "grad":
                        include("pages/manageGraduate.php");
                        break;
                    case "mngWPC":
                        include("pages/manageWorkPC.php");
                        break;
                    case "mngReg":
                        include("pages/manageRegion.php");
                        break;
                    case "mngDis":
                        include("pages/manageDistrict.php");
                        break;
                    case "mngMin":
                        include("pages/manageMininistry.php");
                        break;
                    case "mngFac":
                        include("pages/manageFacility.php");
                        break;
                    case "mngCdre":
                        include("pages/manageCadre.php");
                        break;
                    case "mngCrS":
                        include("pages/manageCriSetting.php");
                        break;
                    case "mngDisiability":
                        include("pages/manageDisiability.php");
                        break;
                    case "mngCr":
                        include("pages/manageCCriteria.php");
                        break;
                    case "mngCCD":
                        include("pages/manageCCD.php");
                        break;
                   
                    case "mngJimbo":
                        include("pages/manageJimbo.php");
                        break;
					case "mngTarafa":
                        include("pages/manageTarafa.php");
                        break;
					case "mngKata":
                        include("pages/manageKata.php");
                        break;
					case "mngMtaa":
                        include("pages/manageMtaa.php");
                        break;
					case "mngTawi":
                        include("pages/manageTawi.php");
                        break;
         
                    case "changePassword":
                        include("pages/change_password.php");
                        break;
                    case "TrainingType":
                        include("pages/manageTrainigType.php");
                        break;

                    case "mngDocuments":
                        include("pages/manageDocuments.php");
                        break;


                    case "unshortRe":
                        include("pages/manageUnshortListedReport.php");
                        break;

                    case "reports":
                        include("pages/reports.php");
                        break;

                    default:
                        echo "<h2 align='center'>Access denied</h2>";
                        exit();
                }
                ?>
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        
        <!-- DataTables JavaScript -->
        <script src="js/dataTables/jquery.dataTables.min.js"></script>
        <script src="js/dataTables/dataTables.bootstrap.min.js"></script>

        <script src="select2/select2.min.js"></script>

        <script src="js/data-criteria.js"></script>
        
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });

            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true,
                });
            });

            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET DISTRICT LIST///////////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadDistrictList(str,from=null) {
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
                xmlhttp.open("GET", "includes/districtList.php?q=" + str +'&from='+from, true);

                xmlhttp.send();
            }


            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET DISTRICT LIST 1///////////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadDistrictList1(str) {

                if (str == "") {

                    document.getElementById("districtList1").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("districtList1").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/districtList1.php?q=" + str, true);

                xmlhttp.send();
            }


            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET FACILITY LIST///////////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadFacility(str) {

                if (str == "") {

                    document.getElementById("facid").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("facid").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/facility_List.php?q=" + str, true);

                xmlhttp.send();
            }


            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET WORK PERMIT NAMES///////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadFcilityNames(str) {
                if (str == "") {

                    document.getElementById("wpname").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("wpname").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/wpnames.php?q=" + str, true);
                xmlhttp.send();
            }


            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET WORK PERMIT NAMES///////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadStandardNames(str) {

                if (str == "") {

                    document.getElementById("standardNames").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        console.log(xmlhttp.responseText);
                        document.getElementById("standardNames").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/standardNames.php?a=" + str, true);
                xmlhttp.send();
            }


            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET PROGRAMME BY LEVEL//////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function typenewcourse(str) {

                if (str == "") {
                    document.getElementById("newcourse").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("newcourse").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/newcourse.php?q=" + str, true);
                xmlhttp.send();
            }


            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET Institution///////////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function fetchInstitution(str) {
                if (str == "") {
                    document.getElementById("institutionList").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("institutionList").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/collegeName.php?q=" + str, true);
                xmlhttp.send();
            }


            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////LOAD PROGRAMME BY NTA LEVEL/////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadProgrammeByNTALevel(str) {
                if (str == "") {
                    document.getElementById("programme").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("programme").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/list_programme.php?q=" + str, true);
                xmlhttp.send();
            }


            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET Programme by institution id/
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadProgrammeByInstId(str) {

                if (str == "") {
                    document.getElementById("programme").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("programme").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/programmeName.php?q=" + str, true);
                xmlhttp.send();
            }


            /////////////////////////////////////////
            /////////////////////////////////////////
            ////GET CADRE BY FACILITY FOR REPORTS//////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadCadreValueReport(str) {
                if (str == 'All') {
                    //var res = str.split("=");
                    var facid = 'All';
                    var cat = 'All';
                    var wp_id = 'All';
                } else {
                    var res = str.split("=");
                    var facid = res[0];
                    var cat = res[1];
                    var wp_id = res[2];
                }


                if (str == "") {
                    document.getElementById("cadreReport").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("cadreReport").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/cadre_listReport.php?q=" + facid + "&cat=" + cat + "&wp_id=" + wp_id, true);
                xmlhttp.send();
            }


            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET CADRE BY FACILITY///////////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadCadreValue(str) {
                // alert(str);
                var res = str.split("=");
                var facid = res[0];
                var cat = res[1];
                var wp_id = res[2];

                if (str == "") {
                    document.getElementById("cadre").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("cadre").innerHTML = xmlhttp.responseText;
                    }
                }
                //xmlhttp.open("GET","includes/list_cadre.php?q="+facid+"&cat="+cat+"&wp_id="+wp_id,true);
                xmlhttp.open("GET", "includes/cadre_list.php?q=" + facid + "&cat=" + cat + "&wp_id=" + wp_id, true);
                xmlhttp.send();
            }

            ///Choice 2
            function loadCadre1(str) {
                var res = str.split("=");
                var facid = res[0];
                var cat = res[1];
                var wp_id = res[2];

                if (str == "") {
                    document.getElementById("cadre1").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("cadre1").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/cadre_list.php?q=" + facid + "&cat=" + cat + "&wp_id=" + wp_id, true);
                xmlhttp.send();
            }


            ///Choice 3
            function loadCadre2(str) {
                var res = str.split("=");
                var facid = res[0];
                var cat = res[1];
                var wp_id = res[2];

                if (str == "") {
                    document.getElementById("cadre2").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("cadre2").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/cadre_list.php?q=" + facid + "&cat=" + cat + "&wp_id=" + wp_id, true);
                xmlhttp.send();
            }


            //Remark
            function showRemarks(str) {
                if (str == "") {
                    document.getElementById("remarks").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("remarks").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/aiax7.php?q=" + str, true);
                xmlhttp.send();
            }

 //show Approve Status
        function showApproveStatus1(str) {
            if (str == "") {
                document.getElementById("approveremarks").innerHTML = "<option  value='' >--select--</option>";
                return;
            }
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("approveremarks").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "includes/listApprove1.php?q=" + str, true);
            xmlhttp.send();
        }


        //Other Selection
        function showOtherSele(str) {
            if (str == "") {
                document.getElementById("showOtherSelection").innerHTML = "<option  value='' >--select--</option>";
                return;
            }
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("showOtherSelection").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "includes/otherSection1.php?q=" + str, true);
            xmlhttp.send();
        }


       
            //show Approve Status
            function showApproveStatus(str) {
                if (str == "") {
                    document.getElementById("approveremarks").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("approveremarks").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/listApprove.php?q=" + str, true);
                xmlhttp.send();
            }


            //Other Selection
            function showOtherSelection(str) {
                if (str == "") {
                    document.getElementById("showOtherSelection").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("showOtherSelection").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/otherSection.php?q=" + str, true);
                xmlhttp.send();
            }


            //Load registration type when council is selected
            function loadRegistrationType(str) {

                if (str == "") {
                    document.getElementById("regType").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("regType").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/getRegType.php?q=" + str, true);
                xmlhttp.send();
            }


            //Load registration Number
            function loadRegistrationNumber(str) {

                if (str == "") {
                    document.getElementById("regNo").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("regNo").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/getRegNo.php?q=" + str, true);
                xmlhttp.send();
            }


            //Load registration Year
            function loadRegistrationYear(str) {

                if (str == "") {
                    document.getElementById("regYear").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("regYear").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/getRegYear.php?q=" + str, true);
                xmlhttp.send();
            }


            //Check registration if valid
            function checkIfCertificateValid(str) {

                if (str == "") {
                    document.getElementById("certV").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("certV").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "includes/getcertV.php?q=" + str, true);
                xmlhttp.send();
            }
			
			
              //   view utambulisho 
			  $(document).ready(function() {
             
                $(document).on('click', '#getviewUtambulisho', function(e) {
					//alert("Hello");
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#getviewUtambulisho-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'pages/manageProfileUtambulisho.php',
                            type: 'POST',
                            data: 'id=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#getviewUtambulisho-content').html(''); // blank before load.
                            $('#getviewUtambulisho-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#getviewUtambulisho-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            //////////////////////////////////////////
            //////////////////////////////////////////
            //////PROCESSING REQUIREST FROM MODALS////
            //////////////////////////////////////////
            ///////////new user/////////
          
            $(document).ready(function() {

                $(document).on('click', '#getadduser', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addUser-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'pages/manageProfile2.php',
                            type: 'POST',
                            data: 'id=' + user_id,
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
			
			///////////new user/////////
          
            $(document).ready(function() {

                $(document).on('click', '#getaddkura', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addkura-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'pages/manageListKuraJimbo.php',
                            type: 'POST',
                            data: 'id=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addkura-content').html(''); // blank before load.
                            $('#addkura-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addkura-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

           ///////////new user/////////getaddUsers
          
            $(document).ready(function() {

                $(document).on('click', '#getaddUsers', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addRAS-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'pages/registerUser.php',
                            //url: 'pages/manageKuraMatokeo.php',
							type: 'POST',
                            data: 'id=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addRAS-content').html(''); // blank before load.
                            $('#addRAS-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addRAS-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

          $(document).ready(function() {

                $(document).on('click', '#getongezakura', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#ongezakura-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'pages/manageJimboJumlaKura10.php',
                            //url: 'pages/manageKuraMatokeo.php',
							type: 'POST',
                            data: 'id=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#ongezakura-content').html(''); // blank before load.
                            $('#ongezakura-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#ongezakura-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

         ///////////new user/////////
          
            $(document).ready(function() {

                $(document).on('click', '#getkuraaa', function(e) {
                    e.preventDefault();
                    
                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#mgoeakura-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'pages/manageKuraMatokeo.php',
                            type: 'POST',
                            data: 'id=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#mgoeakura-content').html(''); // blank before load.
                            $('#mgoeakura-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#mgoeakura-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            $(document).ready(function() {

                $(document).on('click', '#getprofiles', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addprofiles-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'pages/manageProfile2.php',
                            type: 'POST',
                            data: 'id=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addprofiles-content').html(''); // blank before load.
                            $('#addprofiles-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addprofiles-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            $(document).ready(function() {

                $(document).on('click', '#getprofiles10', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addprofiles10-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'pages/manageProfile210.php',
                            type: 'POST',
                            data: 'id=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addprofiles10-content').html(''); // blank before load.
                            $('#addprofiles10-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addprofiles10-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
			
			
            $(document).ready(function() {

                $(document).on('click', '#getroff', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#prof-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'pages/manageMaoni10.php',
                            type: 'POST',
                            data: 'id=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#prof-content').html(''); // blank before load.
                            $('#prof-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#prof-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            /////////////////////////////////////
            ////////////MANAGE REGION////////////
            ///////////////////////////////////
            //<
           //!-- -- - Add New Region-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getaddRegion', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addRegion-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addRegion.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addRegion-content').html(''); // blank before load.
                            $('#addRegion-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addRegion-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            //<
           //!-- -- - Edit Region-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#geteditRegion', function(e) {
                    e.preventDefault();

                    var regid = $(this).data('id'); // get id of clicked row


                    $('#editRegion-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editRegion.php',
                            type: 'POST',
                            data: 'regid=' + regid,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editRegion-content').html(''); // blank before load.
                            $('#editRegion-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editRegion-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            //<
           //!-- -- - Delete Region-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getdeleteRegion', function(e) {
                    e.preventDefault();

                    var regid = $(this).data('id'); // get id of clicked row


                    $('#deleteRegion-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteRegion.php',
                            type: 'POST',
                            data: 'regid=' + regid,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteRegion-content').html(''); // blank before load.
                            $('#deleteRegion-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deleteRegion-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
            /////////////////////////////////////
            ////////////MANAGE INSTITUTIONS////////////
            ///////////////////////////////////
            //<
           //!-- -- - Add New Institution-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getaddInstitution', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addInstitution-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addInstitution.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addInstitution-content').html(''); // blank before load.
                            $('#addInstitution-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addInstitution-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            //<
           //!-- -- - Edit Institution-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#geteditInstitution', function(e) {
                    e.preventDefault();

                    var id = $(this).data('id'); // get id of clicked row


                    $('#editInstitution-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editInstitution.php',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editInstitution-content').html(''); // blank before load.
                            $('#editInstitution-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editInstitution-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            //<
           //!-- -- - Delete Institution-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getdeleteInstitution', function(e) {
                    e.preventDefault();

                    var id = $(this).data('id'); // get id of clicked row


                    $('#deleteInstitution-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteInstitution.php',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteInstitution-content').html(''); // blank before load.
                            $('#deleteInstitution-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deleteInstitution-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            /////////////////////////////////////
            ////////////MANAGE COURSE/PROGRAMS ////////////
            ///////////////////////////////////
            //<
           //!-- -- - Add New Institution-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getaddCourse', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row

                    $('#addCourse-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addCourse.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addCourse-content').html(''); // blank before load.
                            $('#addCourse-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addCourse-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });
                });
            });

            //<
           //!-- -- - Edit Institution-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#geteditCourse', function(e) {
                    e.preventDefault();

                    var id = $(this).data('id'); // get id of clicked row


                    $('#editCourse-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editCourse.php',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editCourse-content').html(''); // blank before load.
                            $('#editCourse-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader


                        })
                        .fail(function() {
                            $('#editCourse-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            //<
           //!-- -- - Delete Institution-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getdeleteCourse', function(e) {
                    e.preventDefault();

                    var id = $(this).data('id'); // get id of clicked row


                    $('#deleteCourse-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteCourse.php',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteCourse-content').html(''); // blank before load.
                            $('#deleteCourse-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deleteCourse-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            //<
           //!-- -- - Manage Programs Institution-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getManageInstitutionPrograms', function(e) {
                    e.preventDefault();

                    var id = $(this).data('id'); // get id of clicked row


                    $('#manageInstitutionProgram-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/mngInstitutionPrograms.php',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'html'
                        })
                        .done(function(data) {

                            $('#manageInstitutionProgram-content').html(''); // blank before load.
                            $('#manageInstitutionProgram-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader

                            $('#dataTables-examples').DataTable({
                                "pageLength": 5,
                                "bLengthChange": false,
                            });
                        })
                        .fail(function() {
                            $('#manageInstitutionProgram-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            /////////////////////////////////////
            ////////////MANAGE MINISTRY////////////
            ///////////////////////////////////

            //<
           //!-- -- - Add New Organization-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getaddOrganization', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addOrganization-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addOrganization.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addOrganization-content').html(''); // blank before load.
                            $('#addOrganization-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addOrganization-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            //<
           //!-- -- - Edit Organization-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#geteditOrganization', function(e) {
                    e.preventDefault();

                    var min_id = $(this).data('id'); // get id of clicked row

                    $('#editOrganization-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editOrganization.php',
                            type: 'POST',
                            data: 'min_id=' + min_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editOrganization-content').html(''); // blank before load.
                            $('#editOrganization-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editOrganization-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            //<
           //!-- -- - Delete Organization-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getdeleteOrganization', function(e) {
                    e.preventDefault();

                    var min_id = $(this).data('id'); // get id of clicked row


                    $('#deleteOrganization-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteOrganization.php',
                            type: 'POST',
                            data: 'min_id=' + min_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteOrganization-content').html(''); // blank before load.
                            $('#deleteOrganization-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deleteOrganization-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            /////////////////////////////////////
            ////////////MANAGE DISTRICT////////////
            ///////////////////////////////////

            //<
           //!-- -- - Add New District-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getaddDistrict', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addDistrict-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addDistrict.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addDistrict-content').html(''); // blank before load.
                            $('#addDistrict-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addDistrict-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            //<
           //!-- -- - Edit District-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#geteditDistrict', function(e) {
                    e.preventDefault();

                    var disid = $(this).data('id'); // get id of clicked row


                    $('#editDistrict-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editDistrict.php',
                            type: 'POST',
                            data: 'disid=' + disid,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editDistrict-content').html(''); // blank before load.
                            $('#editDistrict-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editDistrict-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            //<
           //!-- -- - Delete District-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getdeleteDistrict', function(e) {
                    e.preventDefault();

                    var disid = $(this).data('id'); // get id of clicked row


                    $('#deleteDistrict-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteDistrict.php',
                            type: 'POST',
                            data: 'disid=' + disid,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteDistrict-content').html(''); // blank before load.
                            $('#deleteDistrict-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deleteDistrict-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            /////////////////////////////////////
            ////////////MANAGE RAS////////////
            ///////////////////////////////////

            //<!-----Add New District----->
            $(document).ready(function() {

                $(document).on('click', '#getaddRAS', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addRAS-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addJIMBO.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addRAS-content').html(''); // blank before load.
                            $('#addRAS-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addRAS-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            // <!-----Edit ras----->
            $(document).ready(function() {

                $(document).on('click', '#geteditRAS', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#editRAS-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editRAS.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editRAS-content').html(''); // blank before load.
                            $('#editRAS-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editRAS-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            // <!-----Delete RAS----->
            $(document).ready(function() {

                $(document).on('click', '#getdeleteRAS', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#deleteRAS-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteRAS.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteRAS-content').html(''); // blank before load.
                            $('#deleteRAS-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deletRAS-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

/////////////////////////////////////
            ////////////MANAGE TARAFA////////////
            ///////////////////////////////////

            //<!-----Add New TARAFA----->
            $(document).ready(function() {

                $(document).on('click', '#getaddTARA', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addTARA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addTARA.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addTARA-content').html(''); // blank before load.
                            $('#addTARA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addTARA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            // <!-----Edit TARA----->
            $(document).ready(function() {

                $(document).on('click', '#geteditTARA', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#editRAS-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editTARA.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editTARA-content').html(''); // blank before load.
                            $('#editTARA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editTARA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            // <!-----Delete TARA----->
            $(document).ready(function() {

                $(document).on('click', '#getdeleteTARA', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#deleteTARA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteTARA.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteTARA-content').html(''); // blank before load.
                            $('#deleteTARA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deletTARA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
			
			// <!-----Delete Doc----->
            $(document).ready(function() {

                $(document).on('click', '#getDeleteDoc', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#DeletePicha-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteD.php',
                            type: 'POST',
                            data: 'id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#DeletePicha-content').html(''); // blank before load.
                            $('#DeletePicha-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#DeletePicha-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
			
			// <!-----view Doc----->
            $(document).ready(function() {

                $(document).on('click', '#getViewDoc', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#ViewPicha-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/viewD.php',
                            type: 'POST',
                            data: 'id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#ViewPicha-content').html(''); // blank before load.
                            $('#ViewPicha-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#ViewPicha-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
			
			
			/////////////////////////////////////
            ////////////MANAGE KATA////////////
            ///////////////////////////////////

            //<!-----Add New KATA----->
            $(document).ready(function() {

                $(document).on('click', '#getaddKATA', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addKATA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addKATA.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addKATA-content').html(''); // blank before load.
                            $('#addKATA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addKATA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            // <!-----Edit KATA----->
            $(document).ready(function() {

                $(document).on('click', '#geteditKATA', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#editKATA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editKATA.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editKATA-content').html(''); // blank before load.
                            $('#editKATA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editKATA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            // <!-----Delete KATA----->
            $(document).ready(function() {

                $(document).on('click', '#getdeleteKATA', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#deleteKATA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteKATA.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteKATA-content').html(''); // blank before load.
                            $('#deleteKATA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deletKATA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
			
			
			/////////////////////////////////////
            ////////////MANAGE MTAA////////////
            ///////////////////////////////////

            //<!-----Add New MTAA----->
            $(document).ready(function() {

                $(document).on('click', '#getaddMTAA', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addMTAA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addMTAA.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addMTAA-content').html(''); // blank before load.
                            $('#addMTAA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addMTAA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            // <!-----Edit MTAA----->
            $(document).ready(function() {

                $(document).on('click', '#geteditMTAA', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#editMTAA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editMTAA.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editMTAA-content').html(''); // blank before load.
                            $('#editMTAA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editMTAA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            // <!-----Delete MTAA----->
            $(document).ready(function() {

                $(document).on('click', '#getdeleteMTAA', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#deleteMTAA-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteMTAA.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteMTAA-content').html(''); // blank before load.
                            $('#deleteMTAA-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deletMTAA-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
			
			
			/////////////////////////////////////
            ////////////MANAGE TAWI////////////
            ///////////////////////////////////

            //<!-----Add New TAWI----->
            $(document).ready(function() {

                $(document).on('click', '#getaddTAWI', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addTAWI-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addTAWI.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addTAWI-content').html(''); // blank before load.
                            $('#addTAWI-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addTAWI-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            // <!-----Edit TAWI----->
            $(document).ready(function() {

                $(document).on('click', '#geteditTAWI', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#editTAWI-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editTAWI.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editTAWI-content').html(''); // blank before load.
                            $('#editTAWI-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editTAWI-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            // <!-----Delete TAWI----->
            $(document).ready(function() {

                $(document).on('click', '#getdeleteTAWI', function(e) {
                    e.preventDefault();

                    var ras_id = $(this).data('id'); // get id of clicked row


                    $('#deleteTAWI-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteTAWI.php',
                            type: 'POST',
                            data: 'ras_id=' + ras_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteTAWI-content').html(''); // blank before load.
                            $('#deleteTAWI-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deletTAWI-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
            /////////////////////////////////////
            ////////////MANAGE RRH////////////
            ///////////////////////////////////
            $(document).ready(function() {

                $(document).on('click', '#getaddRRH', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addRRH-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addRRH.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addRRH-content').html(''); // blank before load.
                            $('#addRRH-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addRRH-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            $(document).ready(function() {

                $(document).on('click', '#geteditRRH', function(e) {
                    e.preventDefault();

                    var rrh_id = $(this).data('id'); // get id of clicked row


                    $('#editRRH-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editRRH.php',
                            type: 'POST',
                            data: 'rrh_id=' + rrh_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editRRH-content').html(''); // blank before load.
                            $('#editRRH-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editRRH-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            $(document).ready(function() {

                $(document).on('click', '#getdeleteRRH', function(e) {
                    e.preventDefault();

                    var rrh_id = $(this).data('id'); // get id of clicked row


                    $('#deleteRRH-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteRRH.php',
                            type: 'POST',
                            data: 'rrh_id=' + rrh_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteRRH-content').html(''); // blank before load.
                            $('#deleteRRH-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deletRAS-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            /////////////////////////////////////
            ////////////MANAGE Disability////////////
            ///////////////////////////////////

            //<
           //!-- -- - Add New Disability-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getaddDisability', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addDisability-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addDisability.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addDisability-content').html(''); // blank before load.
                            $('#addDisability-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addDisability-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });

            //<
           //!-- -- - Edit disability-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#geteditDisability', function(e) {
                    e.preventDefault();

                    var disability_id = $(this).data('id'); // get id of clicked row


                    $('#editDisability-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editDisability.php',
                            type: 'POST',
                            data: 'disability_id=' + disability_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editDisability-content').html(''); // blank before load.
                            $('#editDisability-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editDisability-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            //<
           //!-- -- - Delete Disability-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getdeleteDisability', function(e) {
                    e.preventDefault();

                    var disability_id = $(this).data('id'); // get id of clicked row


                    $('#deleteDisability-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteDisability.php',
                            type: 'POST',
                            data: 'disability_id=' + disability_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteDisability-content').html(''); // blank before load.
                            $('#deleteDisability-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deleteDisability-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            /////////////////////////////////////
            ////////////MANAGE FACILITY//////////
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
           //!-- -- - Edit Facility-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#geteditFacility', function(e) {
                    e.preventDefault();

                    var facid = $(this).data('id'); // get id of clicked row


                    $('#editFacility-content').html(''); //leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/editFacility.php',
                            type: 'POST',
                            data: 'facid=' + facid,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#editFacility-content').html(''); // blank before load.
                            $('#editFacility-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#editDistrict-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            //<
           //!-- -- - Delete Facility-- -- - >
            $(document).ready(function() {

                    $(document).on('click', '#getdeleteFacility', function(e) {
                        e.preventDefault();

                        var facid = $(this).data('id'); // get id of clicked row


                        $('#deleteFacility-content').html(''); // leave this div blank
                        $('#modal-loader').show(); // load ajax loader on button click

                        $.ajax({
                                url: 'includes/deleteFacility.php',
                                type: 'POST',
                                data: 'facid=' + facid,
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
                })


                
            /////////////////////////////////////
            ////////////DOCUMENTS////////////////
            ///////////////////////////////////

            // <
            // !--Preview Documents-- >
            $(document).ready(function() {
                $(document).on('click', '#viewDocu', function(e) {
                    e.preventDefault();
                    var docu_id = $(this).data('docid'); // get id of clicked row
                    $('#previewdocu-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/previewD.php',
                            type: 'POST',
                            data: 'docuID=' + docu_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#previewdocu-content').html(''); // blank before load.
                            $('#previewdocu-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#previewdocu-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });
                });
            });


            // <
            // !--Delete Documents-- >
            $(document).ready(function() {
                $(document).on('click', '#deleDoc', function(e) {
                    e.preventDefault();
                    var docu_id = $(this).data('docid1'); // get id of clicked row
                    $('#deleteDocument-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click
                    $.ajax({
                            url: 'includes/deleteD.php',
                            type: 'POST',
                            data: 'docuID=' + docu_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteDocument-content').html(''); // blank before load.
                            $('#deleteDocument-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deleteDocument-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });
                });
            });


            
            /////////////////////////////////////////
            ///////PREVIEW DOCUMENT////////
            ///////////////////////////////////////
            $(document).ready(function(){
                $(document).on('click', '#getDocuPreview',function(e){
                    e.preventDefault();
                    var docuid = $(this).data('id'); // get id of clicked row
                    $('#docuPreview-content').html(''); // leave this div blank
                    $('#modal-loader').show();      // load ajax loader on button click

                    $.ajax({
                        url: 'includes/previewDocument.php',
                        type: 'POST',
                        data: 'docu_id='+docuid,
                        dataType: 'html'
                    })
                        .done(function(data){
                            console.log(data);
                            $('#docuPreview-content').html(''); // blank before load.
                            $('#docuPreview-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function(){
                            $('#docuPreview-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            

            //////////////////////////////////////////
            ///////Scripts to process upload images.
            /////////////////////////////////////////
            $('#file-0a').fileinput({
                allowedFileExtensions: ['jpg', 'png', 'gif']
            });


            $('#file-fr').fileinput({

                language: 'fr',

                uploadUrl: '#',

                allowedFileExtensions: ['jpg', 'png', 'gif']

            });

            $('#file-es').fileinput({

                language: 'es',

                uploadUrl: '#',

                allowedFileExtensions: ['jpg', 'png', 'gif']

            });

            $("#file-0").fileinput({

                'allowedFileExtensions': ['jpg', 'png', 'gif']

            });


            //Uploading profile image

            $("#file-1").fileinput({

                //uploadUrl: 'includes/uploadImages.php',

                allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],

                overwriteInitial: false,

                maxFileSize: 500,

                maxFilesNum: 10,

                //allowedFileTypes: ['image', 'video', 'flash'],

                slugCallback: function(filename) {

                    return filename.replace('(', '_').replace(']', '_');

                }

            });


            //Uploading documents

            $("#file-11").fileinput({

                //uploadUrl: 'includes/uploadImages.php',

                allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg', 'pdf'],

                overwriteInitial: false,

                maxFileSize: 500,

                maxFilesNum: 10,

                //allowedFileTypes: ['image', 'video', 'flash'],

                slugCallback: function(filename) {

                    return filename.replace('(', '_').replace(']', '_');

                }

            });


            //Uploading Excel

            $("#file-12").fileinput({

                //uploadUrl: 'includes/uploadImages.php',

                allowedFileExtensions: ['xlsx', 'xltm', 'xlsm', 'xltx'],

                overwriteInitial: false,

                maxFileSize: 500,

                maxFilesNum: 10,

                //allowedFileTypes: ['image', 'video', 'flash'],

                slugCallback: function(filename) {

                    return filename.replace('(', '_').replace(']', '_');

                }

            });


            /*

             $(".file").on('fileselect', function(event, n, l) {

             alert('File Selected. Name: ' + l + ', Num: ' + n);

             });

             */

            $("#file-3").fileinput({

                showUpload: false,

                showCaption: false,

                browseClass: "btn btn-primary btn-lg",

                fileType: "any",

                previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",

                overwriteInitial: false,

                initialPreviewAsData: true,

                initialPreview: [

                    "http://lorempixel.com/1920/1080/transport/1",

                    "http://lorempixel.com/1920/1080/transport/2",

                    "http://lorempixel.com/1920/1080/transport/3",

                ],

                initialPreviewConfig: [

                    {
                        caption: "transport-1.jpg",
                        size: 329892,
                        width: "120px",
                        url: "{$url}",
                        key: 1
                    },

                    {
                        caption: "transport-2.jpg",
                        size: 872378,
                        width: "120px",
                        url: "{$url}",
                        key: 2
                    },

                    {
                        caption: "transport-3.jpg",
                        size: 632762,
                        width: "120px",
                        url: "{$url}",
                        key: 3
                    },

                ],

            });

            $("#file-4").fileinput({

                uploadExtraData: {
                    kvId: '10'
                }

            });

            $(".btn-warning").on('click', function() {

                var $el = $("#file-4");

                if ($el.attr('disabled')) {

                    $el.fileinput('enable');

                } else {

                    $el.fileinput('disable');

                }

            });

            $(".btn-info").on('click', function() {

                $("#file-4").fileinput('refresh', {
                    previewClass: 'bg-info'
                });

            });

            /*

             $('#file-4').on('fileselectnone', function() {

             alert('Huh! You selected no files.');

             });

             $('#file-4').on('filebrowse', function() {

             alert('File browse clicked for #file-4');

             });

             */

            $(document).ready(function() {

                $("#test-upload").fileinput({

                    'showPreview': false,

                    'allowedFileExtensions': ['jpg', 'png', 'gif'],

                    'elErrorContainer': '#errorBlock'

                });

                $("#kv-explorer").fileinput({

                    'theme': 'explorer',

                    'uploadUrl': '#',

                    overwriteInitial: false,

                    initialPreviewAsData: true,

                    initialPreview: [

                        "http://lorempixel.com/1920/1080/nature/1",

                        "http://lorempixel.com/1920/1080/nature/2",

                        "http://lorempixel.com/1920/1080/nature/3",

                    ],

                    initialPreviewConfig: [

                        {
                            caption: "nature-1.jpg",
                            size: 329892,
                            width: "120px",
                            url: "{$url}",
                            key: 1
                        },

                        {
                            caption: "nature-2.jpg",
                            size: 872378,
                            width: "120px",
                            url: "{$url}",
                            key: 2
                        },

                        {
                            caption: "nature-3.jpg",
                            size: 632762,
                            width: "120px",
                            url: "{$url}",
                            key: 3
                        },

                    ]

                });

                /*

                 $("#test-upload").on('fileloaded', function(event, file, previewId, index) {

                 alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);

                 });

                 */

            });
            
            

            
        </script>


        <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
    </body>

    </html>
<?php } ?>