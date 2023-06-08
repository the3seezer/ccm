<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['q'];
//$id = 1;
if($id=="Mkoa")
{
?>

         <div class="form-group">
				<label>Mkoa wa Mtumiaji<span class="required">*</span></label>
			 
				  <select name="mkoa" id="mkoa" class="form-control col-md-7 col-xs-12" required ">
				  <option value="">--Chagua--</option>
				  <?php
					   $sel=$db->getAllRegionName(); 
					   while($row=$sel->fetch())
					   {
				?>
					   <option value="<?php echo $row['Reg_Id']; ?>"><?php echo strtoupper($row['RegName']); ?></option>
				  <?php } ?>
				  </select>
			 </div>
<?php
 }
 elseif($id=="Wilaya")
 {
?>
	 <div class="form-group">
				<label>Mkoa wa Mtumiaji<span class="required">*</span></label>
			 
				  <select name="mkoa" id="mkoa" class="form-control col-md-7 col-xs-12" required onchange="loadWilayaChamaUser(this.value)">
				  <option value="">--Chagua--</option>
				  <?php
					   $sel=$db->getAllRegionName(); 
					   while($row=$sel->fetch())
					   {
				  ?>
					   <option value="<?php echo $row['Reg_Id']; ?>"><?php echo strtoupper($row['RegName']); ?></option>
				  <?php } ?>
				  </select>
			 </div>
<?php
 }
elseif($id=="Kata")
 {
?>
	 <div class="form-group">
				<label>Mkoa wa Mtumiaji<span class="required">*</span></label>
			 
				  <select name="mkoa" id="mkoa" class="form-control col-md-7 col-xs-12" required onchange="loadKATA(this.value)">
				  <option value="">--Chagua--</option>
				  <?php
					   $sel=$db->getAllRegionName(); 
					   while($row=$sel->fetch())
					   {
				  ?>
					   <option value="<?php echo $row['Reg_Id']; ?>"><?php echo strtoupper($row['RegName']); ?></option>
				  <?php } ?>
				  </select>
			 </div>
<?php 
 }
 ?>
  <div id="WilayaContainer"></div>