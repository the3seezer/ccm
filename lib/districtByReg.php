<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['id'];
//$id = 1;
$selectreg = $db->getOnlyDistrictByRegID($id );



?>
        <!--Ministry-->
		 <div class="form-group">
        
            
                <label class="control-label col-md-12" >Jina la Wilaya </label>
                <div class="col-md-12" id="">
				<select class="form-control col-md-12" id="wilaya" name="wilaya" required>
                    <option value="">--Select--</option>
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

    