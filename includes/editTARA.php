<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();   
$ras_id=$_POST['ras_id'];

$getF=$db->select_JI($ras_id);
$row=$getF->fetch();
$name=$row['JimboName'];
$regID = $row['Region_Id'];
$distID = $row['District_Id'];

// $selectreg=$db->getAllRASName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
     <!--Region Name-->
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Jina la Jimbo<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="rasName" class="form-control col-md-7 col-xs-12" name="jimbo" value="<?php echo strtoupper($name); ?>" required="required" type="text">
     </div>
     </div>

     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Jina la Mkoa<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="region_id" id="region_id" class="form-control col-md-7 col-xs-12">
          <!-- <option value="">--Select--</option> -->
          <?php
               $sel=$db->select_AllRE(); 
               while($row=$sel->fetch())
               {
                    $Reg_Id = $row['Reg_Id'];
          ?>
               <option <?php if($regID==$Reg_Id){
				   echo "selected"; 
				   } 
				   ?> value="<?php echo $row['Reg_Id']; ?>"><?php echo strtoupper($row['RegName']); ?></option>
          <?php } ?>
          </select>
     </div>
     </div>
	 <div id="byDistrictTypeContainer">
	 <div class="item form-group">
	 
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Jina la Wilaya<span class="required">*</span></label>
     <div  class="col-md-6 col-sm-6 col-xs-12">
          <select name="wilaya" id="wilaya" class="form-control col-md-7 col-xs-12">
          <!-- <option value="">--Select--</option> -->
          <?php
               $sel=$db->select_AllDI(); 
               while($row=$sel->fetch())
               {
                    $di_Id = $row['District_Id'];
          ?>
               <option <?php if($distID==$di_Id){ echo "selected"; } ?> value="<?php echo $row['District_Id']; ?>"><?php echo strtoupper($row['DistrictName']); ?></option>
          <?php } ?>
          </select>
		  </div>
     </div>
     </div>
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="editTARA" value="Save"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
	<input type="hidden" name="ras_id" value="<?php echo $ras_id; ?>"/>
	 
     </div>
     </div>
     </form>
<script src="js/jquery.min.js"></script>
<script >
$(document).ready(function () {
	//alert('test');
$("select#region_id").change(function () {
        selectedRegionTypeName = $("#region_id option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
            $("#byDistrictTypeContainer").show();
            let _url = "lib/districtByReg.php?id=" + selectedRegionType;
            $.ajax({
                url: _url, success: function (result) {
                    $("#byDistrictTypeContainer").html(result);
                }
            });

     
        } else {
            $("#byDistrictTypeContainer").hide();
        }

    
    });
});
</script> 
	 	 