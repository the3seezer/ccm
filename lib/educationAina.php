<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['q'];
//$id = 1;




?>
       <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kiwango cha Elimu <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
		<?php 
		if(($id=="Msingi")or($id=="Chuo")or($id=="Sekondari"))
		{
			?>
            <select id="KiwangaElimu" class="form-control col-md-7 col-xs-12" name="kiwangoo" required="required">
                    <option value="">--Chagua--</option>
					<?php 
					if($id=="Msingi")
					   echo '<option>Primary School</option>';
				    elseif($id=="Sekondari"){
                      echo '<option>O-Level</option>
                    <option>A-Level</option>';
					}
					elseif($id=="Chuo")
					{
					  echo '<option>Certificate</option>
					<option>Diploma</option>
					<option>Advanced Diploma</option>
					<option>Bachelor</option>
					<option>Masters</option>
					<option>PhD</option>';	
					}
					?>
                    
            </select>
		<?php } elseif($id=="Mafunzo ya Taaluma")
		{
			?>
			<input id="kiwangoo" class="form-control col-md-7 col-xs-12" name="kiwangoo" required type="text">
			<?php
		}
		?>
        </div>
		</div>

