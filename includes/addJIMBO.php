<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$userID=$_POST['userID'];

// $selectreg=$db->getAllRASName();
?>

<form  action="../includes/process.php" method="post"  class="form-horizontal form-label-left">
      
	  <!--District Name-->
	  <div class="form-group">
     <label class="control-label col-md-12">Jina la Mkoa<span class="required">*</span></label>
     <div class="col-md-12">
          <select name="region_id" id="region_id" class="form-control col-md-12" required>
          <option value="">--Select--</option>
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
	
	 <div id="byDistrictTypeContainer"></div>
	
	 <!--District Name-->
	 
     <div class="form-group">
     <label class="control-label col-md-12">Jina la Jimbo<span class="required">*</span></label>
     <div class="col-md-12">
          <input id="jimbo" class="form-control col-md-12" name="jimbo"  required type="text">
     </div>
     </div>

     
	                                                                       
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-12">
     <input type="submit"  id="send"  class="btn btn-success" name="addJIMBO" value="Submit"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
     <input type="hidden" name="userID" value="<?php echo $userID; ?>"/>
	 
     </div>
     </div>
</form>
<script src="../plugins/jquery/jquery.min.js"></script>
<script >
$(document).ready(function () {
	//alert('test');
$("select#region_id").change(function () {
        selectedRegionTypeName = $("#region_id option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
            $("#byDistrictTypeContainer").show();
            let _url = "../lib/districtByReg.php?id=" + selectedRegionType;
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
	 
	 
	 
	 
	 
	 