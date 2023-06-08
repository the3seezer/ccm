<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['q'];
//$id = 1;
$selectreg = $db->getOnlyDistrictByRegID($id );



?>
        <!--mama wilaya-->
		 <div class="item form-group">
        
            
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jina la Wilaya </label>
                <div class="col-md-6 col-sm-6 col-xs-12" id="">
				<select class="form-control col-md-7 col-xs-12" id="wilaya_mama" name="wilaya_mama" required>
                    <option value="">--Chagua--</option>
                    <?php
                    while ($rw = $selectreg->fetch()) {
                    ?>
                        <option value="<?php echo $rw['District_Id']; ?>"><?php echo strtoupper($rw['DistrictName']); ?></option>
                    <?php
                    }
                    ?>
                </select>
            
        </div>
		 </div>

    