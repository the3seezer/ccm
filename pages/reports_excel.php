<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$post = $_GET['post'];
$sel = $db->getReports($post);
$year = $post['year'];
$application_status = $post['application_status'];
$allocation_status = $post['allocation_status'];

$status = $application_status;
$pmYear = $year;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require_once '../vendor/phpoffice/phpspreadsheet/src/Bootstrap.php';


$helper = new Sample();
if ($helper->isCli()) {
    $helper->log('This example should only be run from a Web Browser' . PHP_EOL);
    return;
}

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('WAO Tool')
    ->setLastModifiedBy('WAO Tool')
    ->setTitle('WAO report')
    ->setSubject('WAO report')
    ->setDescription('WAO Report, generated using WAO Tool.')
    ->setKeywords('WAO Report')
    ->setCategory('Report');


$spreadsheet->setActiveSheetIndex(0);

$excel_row = 1;

\PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder(new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder());

$style = array(
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
);

// $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "APPLICATION AND ALLOCATION REPORT");
// $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
// $spreadsheet->getActiveSheet()->getStyle("A1:H1")->applyFromArray($style);
// $excel_row++;

$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, 'SN');
$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, 'Name');
$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, 'Gender');
$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, 'DOB');
$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, 'Marital Status');
$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, 'Phone');
$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, 'Council Reg. NO.');
$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, 'Facility');
$excel_row++;

$sn = 1;
while ($row = $sel->fetch()) {

    if ($application_status == 'All' || $application_status == 'Inprogress') {
        $applicant_id = $row['id'];
    } else {
        $applicant_id = $row['applicant_id'];
    }
    $facility = '';
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

        $facility .= strtoupper($wpname . "-" . $cadName);
    } else {
        //Get Application Details
        $getWP = $db->getApplicantAplication($applicant_id, $pmYear, $status);
        $tcount = $getWP->rowCount();
        $i = 1;
        if ($tcount < 1) {
            $facility .= "In progress (not yet applied)";
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
                    if ($i < $tcount) {
                        $facility .= $choiceNo . "." . strtoupper($wpname) . "-" . $cadName . "\n";
                    } else {
                        $facility .= $choiceNo . "." . strtoupper($wpname) . "-" . $cadName;
                    }
                } else {
                    if ($i < $tcount) {
                        $facility .= $choiceNo . "." . strtoupper($wpname) . "-" . $cadName . "(" . $score . ")" . "\n";
                    } else {
                        $facility .= $choiceNo . "." . strtoupper($wpname) . "-" . $cadName . "(" . $score . ")";
                    }
                }
                $i++;
            }
        }
    }

    $name = strtoupper($row['firstname'] . " " . $row['lastname']);
    $phone = $row['phone'];
    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $sn);
    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $name);
    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['gender']);
    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['dob']);
    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['maritalStatus']);
    // $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $phone);
    $spreadsheet->getActiveSheet()->setCellValueExplicit(
        'F'.$excel_row, "$phone", \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
    );
    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['councilRegistrationID']);
    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $facility);
    $excel_row++;
    $sn++;
}



foreach (range('A', 'Z') as $columnID) {
    $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('WAO Report');

// Redirect output to a client’s web browser (Xls)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="WAO Report.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
exit;
