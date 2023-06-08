<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['q'];
//$id = 1;
//$selectreg = $db->getOnlyDistrictByRegID($id);
if($id=="Ubunge")
{
	?>
	<div class="item form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12">Mkoa Anakogombea<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <select id="region_id" name="region_id" class="form-control col-md-7 col-xs-12" required onchange="Districtsss(this.value)">
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
	 </div>
	<?php
}
elseif($id=="Udiwani")
{
?>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Mkoa Anakogombea<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="region_id" class="form-control col-md-7 col-xs-12" required onchange="WilayaDistricts(this.value)">
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
   </div>  
<?php } ?>
    