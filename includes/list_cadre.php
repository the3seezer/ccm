<?php
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();


$fac_id=$_GET["q"];
$category=$_GET["cat"];
$wp_id=$_GET["wp_id"];


//$group=explode("=",$groupID);

//$fac_id=$group[0];
//$category=$group[1];
//$wp_id=$group[2];

//Get Active Cadre by fac_id
$getC=$db->getActiveCadreByFacId($fac_id);
?>
<option value="">--Select Cadre--</option>
<?php while($row=$getC->fetch()){?>
<option value="<?php echo $row['cadreId'];?>"><?php echo $row['cadreName'];?></option>
<?php } ?>

