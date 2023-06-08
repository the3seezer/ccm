<?php
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();

$institutionID = $_GET['q'];

$programs = $db->getInstitutionProgram($institutionID)
?>

<option value="">--Select Programme--</option>
<?php while ($value = $programs->fetch()) { ?>
    <option value="<?php echo $value["id"]; ?>">
        <?php echo $value["name"]; ?>
    </option>
<?php } ?>

