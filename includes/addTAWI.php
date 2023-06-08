<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$userID=$_POST['userID'];

// $selectreg=$db->getAllRASName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
      
	  <!--District Name-->
	  <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Jina la Mkoa<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="region_id" id="region_id" class="form-control col-md-7 col-xs-12" required>
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
	 <div id="byJimboTypeContainer"></div>
	 <!--District Name-->
	 
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Jina la Tawi<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="tawi" class="form-control col-md-7 col-xs-12" name="tawi"  required type="text">
     </div>
     </div>

     
	                                                                       
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="addTAWI" value="Submit"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
     <input type="hidden" name="userID" value="<?php echo $userID; ?>"/>
	 
     </div>
     </div>
</form>
 <script src="js/jquery.min.js"></script>
<script >
$(document).ready(function () {
	
$("select#region_id").change(function () {
        selectedRegionTypeName = $("#region_id option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
            $("#byDistrictTypeContainer").show();
            let _url = "lib/districtByReg4.php?id=" + selectedRegionType;
            $.ajax({
                url: _url, success: function (result) {
                    $("#byDistrictTypeContainer").html(result);
                }
            });

     
        } else {
            $("#byDistrictTypeContainer").hide();
        }

    
    });


$("select#wilaya").change(function () {
	//alert('test');
        selectedRegionTypeName = $("#wilaya option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
            $("#byJimboTypeContainer").show();
            let _url = "lib/jimboByReg.php?id=" + selectedRegionType;
            $.ajax({
                url: _url, success: function (result) {
                    $("#byJimboTypeContainer").html(result);
                }
            });

     
        } else {
            $("#byJimboTypeContainer").hide();
        }

    
    });
});

</script> 
	 
	 
	 
	 
	 
	 