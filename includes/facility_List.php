<?php
include("../lib/dbconnect.php");

$db = new dbClass();
$db->connect();

$disid=$_GET['q'];

$dis=$db->getFacilityByDisId($disid);
?>
<select class="form-control" name="facName" required>
  <option value="">--Select--</option>
   <?php while($rw11=$dis->fetch()){?>
	<option value="<?php echo $rw11['facId']; ?>"><?php echo $rw11['facname']; ?></option>
   <?php } ?>
</select>
   