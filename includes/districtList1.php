<?php
include("../lib/dbconnect.php");

$db = new dbClass();
$db->connect();

$regid=$_GET['q'];

$dis=$db->getListofDistrictByRegId($regid);
?>
<select class="form-control" name="facName" required onchange="loadFacility(this.value);">
  <option value="">--Select--</option>
   <?php while($rw1=$dis->fetch()){?>
	<option value="<?php echo $rw1['District_Id']; ?>"><?php echo $rw1['DistrictName']; ?></option>
   <?php } ?>
</select>
   