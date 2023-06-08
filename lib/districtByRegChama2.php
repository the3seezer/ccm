<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['q'];
//$id = 1;
$selectreg = $db->getOnlyDistrictByRegID($id);

?>
<!--wilaya-->
 <div class="item form-group">

		<label >Wilaya</label>
	  
		<select class="form-control col-md-7 col-xs-12" id="wilaya" name="wilaya" required onchange="loadWARD(this.value)">
			<option value="">--Chagua--</option>
			<?php
			while ($rw = $selectreg->fetch()) {
			?>
				<option value="<?php echo $rw['District_Id']; ?>"><?php echo strtoupper($rw['DistrictName']); ?></option>
			<?php
			}
			?>
		</select>
 </div>
<div id="KataContainer"></div>
    