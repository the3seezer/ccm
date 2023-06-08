<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();
$id = $_GET['q'];
//$id = 1;
$selectreg = $db->select_KATAONLY($id);

?>
<!--Kata-->
 <div class="item form-group">

		<label >Kata ya Mtumiaji</label>
	  
		<select class="form-control col-md-7 col-xs-12" id="kata" name="kata" required)">
			<option value="">--Chagua--</option>
			<?php
			while ($rw = $selectreg->fetch()) {
			?>
				<option value="<?php echo $rw['Kata_Id']; ?>"><?php echo strtoupper($rw['KataName']); ?></option>
			<?php
			}
			?>
		</select>
 </div>

    