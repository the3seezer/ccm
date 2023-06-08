<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['id'];
$selectreg = $db->selectJI_TA($id);



?>
        <!--Ministry-->
		 <div class="item form-group">
        
            
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jina la Tarafa 2</label>
                <div class="col-md-6 col-sm-6 col-xs-12" id="">
				<select class="form-control col-md-7 col-xs-12" id="tarafa" name="tarafa" required>
                    <option value="">--Select--</option>
                    <?php
                    while ($rw = $selectreg->fetch()) {
                    ?>
                        <option value="<?php echo $rw['Tarafa_Id']; ?>"><?php echo strtoupper($rw['TarafaName']); ?></option>
                    <?php
                    }
                    ?>
                </select>
            
        </div>
		 </div>
		 <div id="byKataTypeContainer"></div>
<script src="../js/jquery.min.js"></script>
<script >
$(document).ready(function () {

//alert('test t');
$("select#tarafa").change(function () {
	//alert('test two');
        selectedRegionTypeName = $("#tarafa option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
			//alert('test two33');
            $("#byKataTypeContainer").show();
            let _url = "../lib/kataByReg.php?id=" + selectedRegionType;
            $.ajax({
                url: _url, success: function (result) {
                    $("#byKataTypeContainer").html(result);
                }
            });

     
        } else {
			//alert('test two22');
            $("#byKataTypeContainer").hide();
        }

    
    });
});

</script> 
