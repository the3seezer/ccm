<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['id'];
//$id = 364;
$selectreg = $db->selectJI($id);



?>
        <!--Ministry-->
		 <div class="item form-group">
        
            
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jina la Jimbo</label>
                <div class="col-md-6 col-sm-6 col-xs-12" id="">
				<select class="form-control col-md-7 col-xs-12" id="jimbo" name="jimbo" required>
                    <option value="">--Select--</option>
                    <?php
                    while ($rw = $selectreg->fetch()) {
                    ?>
                        <option value="<?php echo $rw['Jimbo_Id']; ?>"><?php echo strtoupper($rw['JimboName']); ?></option>
                    <?php
                    }
                    ?>
                </select>
            
        </div>
		 </div>
<div id="byTarafaTypeContainer"></div>
<script src="../js/jquery.min.js"></script>
<script >
$(document).ready(function () {

//alert('test onebhh');
$("select#jimbo").change(function () {
	//alert('test two');
        selectedRegionTypeName = $("#jimbo option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
			//alert('test two33');
            $("#byTarafaTypeContainer").show();
            let _url = "../lib/tarafaByReg1.php?id=" + selectedRegionType;
            $.ajax({
                url: _url, success: function (result) {
                    $("#byTarafaTypeContainer").html(result);
                }
            });

     
        } else {
			//alert('test two22');
            $("#byTarafaTypeContainer").hide();
        }

    
    });
});

</script> 
    