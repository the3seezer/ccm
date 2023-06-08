<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$inst_id = $_POST['id'];
$courses = $db->getCourses();
$selectedCourse = $db->getInstitutionProgram($inst_id);
$coursesAll = array();
$coursesSelectedAll = array();
$notSelectedCourse = array();
while ($data = $courses->fetch()) {
    $coursesAll[] = $data;
}

while ($data = $selectedCourse->fetch()) {
    $coursesSelectedAll[] = $data;
}

$i = 1;
foreach ($coursesAll as $item) {
    if (!empty($coursesSelectedAll)) {
        $found = false;
        foreach ($coursesSelectedAll as $data) {
            if ($data['course_id'] == $item['id']) {
                $found = true;
            }
        }
        if ($found) {
            continue;
        }
        array_push($notSelectedCourse, $item);
    } else {
        array_push($notSelectedCourse, $item);
    }

}
?>

<form action="includes/process.php" method="post" class="form-horizontal form-label-left">
    <table class="table table-striped table-bordered table-hover" id="dataTables-examples">
        <thead>
        <tr>
            <th>SN</th>
            <th>Course Name</th>
            <th>From Server</th>
            <th>Select</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $i = 1;

        foreach ($coursesSelectedAll as $item) {
            ?>
            <tr class="odd gradeX">
                <td><?php echo $i; ?></td>
                <td><?php echo strtoupper($item['name']); ?></td>
                <td><?php echo strtoupper($item['from_server']); ?></td>
                <td align="left">
                    <div class="checkbox">
                        <label><input type="checkbox" checked name="selectedValue[]" value="<?= $id ?>"></label>
                    </div>
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
        <?php

        foreach ($notSelectedCourse as $row) {
            $id = $row['id'];
            ?>
            <tr class="odd gradeX">
                <td><?php echo $i; ?></td>
                <td><?php echo strtoupper($row['name']); ?></td>
                <td><?php echo strtoupper($row['from_server']); ?></td>
                <td align="left">
                    <div class="checkbox">
                        <label><input type="checkbox" name="selectedValue[]" value="<?= $id ?>"></label>
                    </div>
                </td>
            </tr>
            <?php $i++;
        } ?>
        </tbody>
    </table>
    <hr>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-6">
            <input type="submit" id="send" class="btn btn-success col-md-6" name="addInstitutionCourse" value="Save"/>
            <input type="hidden" name="inst_id" value="<?php echo $inst_id; ?>"/>
        </div>
    </div>
</form>




