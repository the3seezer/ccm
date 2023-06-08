<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['id'];
//$id = 1;
$selectreg = $db->selectJI_TA_KA($id);



?>
        <!--Ministry-->
		 <div class="item form-group">
        
            
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jina la Kata </label>
                <div class="col-md-6 col-sm-6 col-xs-12" id="">
				<select class="form-control col-md-7 col-xs-12" id="Kata" name="Kata" required>
                    <option value="">--Select--</option>
                    <?php
                    while ($rw = $selectreg->fetch()) {
                    ?>
                        <option value="<?php echo $rw['Kata_Id']; ?>"><?php echo strtoupper($rw['KataName']); ?></option>
                    <?php
                    }
                    ?>
                </select>
            
        </div>
		 </div>
		  <div id="byMtaaTypeContainer"></div>
<script src="../js/jquery.min.js"></script>
<script >
$(document).ready(function () {

//alert('test t');
$("select#Kata").change(function () {
	//alert('test two');
        selectedRegionTypeName = $("#Kata option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
			//alert('test two33');
            $("#byMtaaTypeContainer").show();
            let _url = "lib/mtaaByReg.php?id=" + selectedRegionType;
            $.ajax({
                url: _url, success: function (result) {
                    $("#byMtaaTypeContainer").html(result);
                }
            });

     
        } else {
			//alert('test two22');
            $("#byMtaaTypeContainer").hide();
        }

    
    });
});

</script> 

		 