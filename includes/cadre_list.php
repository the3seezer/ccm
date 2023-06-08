<?php
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();
$fac_id=$_GET["q"];
$category=$_GET["cat"];
$wp_id=$_GET["wp_id"];
//Get Active Cadre by fac_id

//Get Permit Year
$getPY=$db->getWorkPermitYear();
$rP=$getPY->fetch();
$pmYear=$rP['year'];


$getC=$db->getActiveCadreByFacId($fac_id,$pmYear);
?><option value="">--Select Cadre--</option>
<?php while($row=$getC->fetch())
{
$cadre_id=$row['cadre_Id'];
$getC1=$db->getCadreByCardeIdFromCadreTable($cadre_id);
$row1=$getC1->fetch();
$cadreName=$row1['cadreName'];
?>
<option value="<?php echo $row['cadre_Id'];?>"><?php echo $cadreName; ?></option>
<?php 
} 
?>   
		
		
		   
