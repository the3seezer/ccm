<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$sel = $db->getReports($_POST);

$year = $_POST['year'];
$application_status = $_POST['application_status'];
$allocation_status = $_POST['allocation_status'];

$status = $application_status;
$pmYear = $year;
$url_post = http_build_query(array('post' => $_POST));
?>


<div class="col-md-10 text-center">
    <h3>APPLICATION AND ALLOCATION REPORT</h3>
    <h4 class="text-danger">Total: <b> <?= $sel->rowCount(); ?> </b> </h4>
</div>
<div class="col-md-2 text-center">
    <a href="pages/reports_excel.php?<?=$url_post; ?>" target="_blank" class="btn btn-primary btn-sm"><span><i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL</span></a>
</div>

<table class="table table-striped table-bordered table-hover" id="">
    <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Marital Status</th>
            <th>Phone</th>
            <th>Council Reg. NO.</th>
            <th>Facility</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;

        while ($row = $sel->fetch()) {
            if ($application_status == 'All' || $application_status == 'Inprogress') {
                $applicant_id = $row['id'];
            } else {
                $applicant_id = $row['applicant_id'];
            }
        ?>
            <tr class="odd gradeX">
                <td><?php echo $i; ?></td>
                <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['dob']; ?></td>
                <td><?php echo $row['maritalStatus']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['councilRegistrationID']; ?></td>
                <td align="left">
                    <?php
                    if ($application_status == 'Allocated') {
                        $selAll = $db->getApplicantAllocation($applicant_id, $pmYear);
                        $rw = $selAll->fetch();
                        $category = $rw['category'];
                        $wp_id = $rw['wp_id'];
                        $cadreid = $rw['cadre_id'];
                        $choiceNo = $rw['choiceNo'];
                        $score = $rw['score'];

                        $wpname = '';
                        include("../lib/criteria_setting.php");

                        //Get Cadre name
                        $getCa = $db->getHealthCadresById($cadreid);
                        $rwC = $getCa->fetch();
                        $cadName = $rwC['cadreName'];

                        echo strtoupper($wpname) . "-" . $cadName . "(" . $score . ")" . "<br/>";
                    } else {
                        //Get Application Details
                        $getWP = $db->getApplicantAplication($applicant_id, $pmYear, $status);
                        if ($getWP->rowCount() < 1) {
                            echo "<b class='text-danger'>In progress (not yet applied)</b>";
                        } else {
                            while ($rw1 = $getWP->fetch()) {
                                $app_id = $rw1['app_id'];
                                $category = $rw1['category'];
                                $wp_id = $rw1['fac_id'];
                                $cadreid = $rw1['cadre_id'];
                                $choiceNo = $rw1['choiceNo'];
                                $score = $rw1['credit'];

                                $wpname = '';
                                include("../lib/criteria_setting.php");

                                //Get Cadre name
                                $getCa = $db->getHealthCadresById($cadreid);
                                $rwC = $getCa->fetch();
                                $cadName = $rwC['cadreName'];
                                if ($application_status == 'All') {
                                    echo $choiceNo . "." . strtoupper($wpname) . "-" . $cadName . "<br/>";
                                }else{
                                    echo $choiceNo . "." . strtoupper($wpname) . "-" . $cadName . "(" . $score . ")" . "<br/>";
                                }
                            }
                        }
                    }
                    ?>
                </td>
                <td align="left">
                    <a href="?pg=mngAppDetails&id=<?php echo $applicant_id; ?>" class="btn btn-info btn-xs" target=_blank><i class="fa fa-folder"></i> More
                        Details</a>
                </td>
            </tr>
        <?php $i++;
        } ?>
    </tbody>
</table>