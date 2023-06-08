<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['id'];
//$id = 1;
$selectreg = $db->selectJI_TA_KA_MTA($id);



?>
        <!--Ministry-->
		 <div class="item form-group">
        
            
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jina la Mtaa </label>
                <div class="col-md-6 col-sm-6 col-xs-12" id="">
				<select class="form-control col-md-7 col-xs-12" id="mtaa" name="mtaa" required>
                    <option value="">--Select--</option>
                    <?php
                    while ($rw = $selectreg->fetch()) {
                    ?>
                        <option value="<?php echo $rw['Mtaa_Id']; ?>"><?php echo strtoupper($rw['MtaaName']); ?></option>
                    <?php
                    }
                    ?>
                </select>
            
        </div>
		 </div>
		 