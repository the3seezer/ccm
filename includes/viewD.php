<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();
$docuID=$_POST['id'];
$image=$db->viewDocu($docuID);
?><!--style="width:100px;height:100px;"-->
<p><img src="<?php echo $image; ?>"> </p>
        