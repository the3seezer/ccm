<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();
$docuID=$_POST['id'];
$image=$db->viewDocu($docuID);
?>
<p><img src="<?php echo $image; ?>"> </p>
        