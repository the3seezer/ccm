<?php
$query1 = $db->getnationalList();
$idd = $_GET['id'];                             
$sel = $db->selectSingleUbunge($idd);
$rw = $sel->fetch();

	$kwanza = $rw['jinamwanzo'];
	$kati = $rw['jinakati'];
	$mwisho = $rw['jinamwisho'];
	$nafasi = $rw['nafasi'];
	$jimbo_id = $rw['gjimbo_id'];
	$wilaya_id = $rw['gwilaya_id'];
	$mkoa_id = $rw['gmkoa_id'];
	$dob = $rw['dob'];
	$email = $rw['email'];
	
	
    $NIDA = $rw['NIDA'];
	$amount = $rw['amount'];
	$control = $rw['control'];
	$mobile = $rw['mobile'];
	//`jinababa`, `babadob`, `bzmtaa`, `jinamama`, `mzmtaa`, `mamadob`
	$babajina = $rw['jinababa'];
	$babadob = $rw['babadob'];
	$babamtaa = $rw['bzmtaa'];
	$mamajina = $rw['jinamama'];
	$mamadob = $rw['mamadob'];
	$mamamtaa = $rw['mzmtaa'];
	
	$zmtaa = $rw['zmtaa'];
	$ishimtaa = $rw['ishimtaa'];
	
	//mzmtaa = explode("-",$dob);
	//$year=$miaka[0];
	//$currentAge=date('Y')-$year;
	
	//`ishimtaa``zmtaa`
	$getRegs = $db->getRegionName($mkoa_id);
	$rwC = $getRegs->fetch();
	$gname = $rwC['RegName'];
	
	//Get wilaya name
	$getDict = $db->gettDistrict($wilaya_id);
	$rwD = $getDict->fetch();
	$dname = $rwD['DistrictName'];

	//Get jimbo name 
	$getJimb = $db->select_JI($jimbo_id);
	$rwJ = $getJimb->fetch();
	$jname = $rwJ['JimboName'];
	
	//Get wilaya name
	$getDict1 = $db->gettDistrict($rw['zwilaya_id']);
	$rwD1 = $getDict1->fetch();
	$dname1 = $rwD1['DistrictName'];
	
	//Get region name
	$getRegs1 = $db->getRegionName($rw['zmkoa_id']);
	$rwC1 = $getRegs1->fetch();
	$gname1 = $rwC1['RegName'];
	$mtaa = $rw['zmtaa'];
	
	?>
<script src="js/jquery.min.js"></script>
<script >
$(document).ready(function () {
	
$("select#region_id").change(function () {
        selectedRegionTypeName = $("#region_id option:selected").text();
        selectedRegionType = $(this).val();

        if (selectedRegionTypeName !== "All") {
            $("#byDistrictTypeContainer").show();
            let _url = "lib/districtByReg111.php?id=" + selectedRegionType;
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
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Maombi ya Mgombea</h3>
    </div>
</div>
<div class="row">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <strong>SEHEMU YA KWANZA: UTAMBULISHO</strong> 

                </div>
                <!--/.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
					 <div class="row">
								   <span style="float:right;">
							        <a href="?pg=dash"><button class="btn btn-success " >
                                        <i class="fa fa-fast-backward fa-fw"></i> &nbsp;Mwanzo</button></a>
                                       </p>
							        </span>
									</div>

                      <form method="post" action="includes/process.php" class="form-horizontal form-label-left" >
					  
					  <input type="hidden" id="custId" name="idd" value='<?php echo $idd; ?>'>
                            <!--First Name-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jina la Kwanza <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="first" class="form-control col-md-7 col-xs-12" name="first" required type="text" value='<?php echo $kwanza; ?>' >
                                </div>
                            </div>

                            <!--Middle Name-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jina la Kati</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="middle" class="form-control col-md-7 col-xs-12" name="middle" type="text" value='<?php echo $kati; ?>'>
                                </div>
                            </div>

                            <!--Last Name-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last">Jina la Ukoo <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="last" class="form-control col-md-7 col-xs-12" name="lastname" required="required" type="text" value='<?php echo $mwisho; ?>'>
                                </div>
                            </div>
							<!--simu-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last">Namba ya Simu <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="simu" class="form-control col-md-7 col-xs-12" name="simu" required="required" type="text" value='<?php echo $mobile; ?>'>
                                </div>
                            </div>
							<!--email-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last">Email <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="email" class="form-control col-md-7 col-xs-12" name="email" required="required" type="text" value='<?php echo $email; ?>'>
                                </div>
                            </div>
							
							<!--fedha-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last">Kiasi cha Fedha Ulicholipa <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="fedha" class="form-control col-md-7 col-xs-12" name="fedha" required="required" type="text" value='<?php echo $amount; ?>'>
                                </div>
                            </div>
							
							<!--control-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last">Controli Namba <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="control" class="form-control col-md-7 col-xs-12" name="control" required="required" type="text" value='<?php echo $control; ?>' >
                                </div>
                            </div>
							<div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last">Namba ya NIDA<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="nida" class="form-control col-md-7 col-xs-12" name="nida" required="required" type="text" value='<?php echo $NIDA; ?>' >
                                </div>
                            </div>
                            <!--Nafasi-->
							
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nafasi Unayoomba <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                    <select id="nafasi" class="form-control col-md-7 col-xs-12" name="nafasi" required="required" onchange="Regions(this.value)">
                                        <option value="">--Chagua--</option>
										<?php if($nafasi=="Udiwani")
										{
										?>
                                        <option value="Udiwani" selected="selected">Udiwani</option>
										<?php
										}
										elseif($nafasi=="Ubunge")
										{
										?>
                                        <option value="Ubunge" selected="selected">Ubunge</option>
                                        <?php
										}
										
										?>
                                    </select>
                                </div>
                            </div>
							<!--District Name-->
	  <div id ="regDIV"><div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Mkoa Anakogombea<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="region_id" id="region_id" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
          <?php
               $sel=$db->getAllRegionName(); 
               while($row=$sel->fetch())
               {
          ?>
               <option value="<?php echo $row['Reg_Id']; ?>"><?php echo strtoupper($row['RegName']); ?></option>
          <?php } ?>
          </select>
     </div>
     </div></div>
	
	 <div id="byDistrictTypeContainer"></div>
	 <div id="byJimboTypeContainer"></div>
                            <!--Date Of Birth-->
                            <div class="item form-group">

                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarehe ya Kuzaliwa Mgombea/Umri<span class="required">*</span> </label>

                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control" id="year" name="year" required onChange="loadMonths(this.value)">
                                        <option value="">Mwaka</option>
                                        <option>
                                            <?php
                                            $cY = date('Y');
                                            $reY = $cY - 18; //Applicant must have greater or equal to 18 years
                                            echo $reY; ?></option>
                                        <?php $i = 1;
                                        for ($i = 1; $i <= 27; $i++) { //Applicant must have less or equal to 45 years
                                        ?>
                                            <option><?php echo $reY - $i; ?></option><?php } ?>
                                    </select>
                                </div>


                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" id="month" name="month" required onchange="loadDays(this.value)">
                                        <option value="">--Chagua--</option>
										
                    
                                    </select>
                                </div>


                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control" id="days" name="day" required>
                                                                                <option value="">--Chagua--</option>
										<?php for ($i = 1; $i <= 31; $i++) { //Applicant must have less or equal to 45 years
                                        ?>
                                            <option><?php echo $i; ?></option><?php } ?>
                                    </select>
                                </div>
                            </div>

<!--District Name-->
	  <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Mkoa Ulipozaliwa Mgombea<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="mkoa" id="mkoa" class="form-control col-md-7 col-xs-12" required onchange="loadWilaya(this.value)">
          <option value="">--Chagua--</option>
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
	
	 <div id="byWilayaTypeContainer"></div>
	
	 <!--District Name-->
	 
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Mtaa/Kijiji Ulipozaliwa Mgombea<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="mtaa" class="form-control col-md-7 col-xs-12" name="mtaa"  required type="text" value='<?php echo $zmtaa; ?>'>
     </div>
     </div>

                            
                            <!--baba-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Majina Kamili la Baba (Matatu)<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="baba" class="form-control col-md-7 col-xs-12" placeholder="" name="baba" required="required" type="text" value="<?php echo $babajina; ?>">
                                </div>
                            </div>
							
							
							<!--District Name-->
	  <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Mkoa wa Alipozaliwa Baba<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="mkoababa" id="mkoababa" class="form-control col-md-7 col-xs-12" required onchange="loadWilayas(this.value)">
          <option value="">--Chagua--</option>
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
	
	 <div id="BabaTypeContainer"></div>
	
	 <!--District Name-->
	 
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Mtaa/Kijiji Alipozaliwa Baba<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="mtaababa" class="form-control col-md-7 col-xs-12" name="mtaababa"  required type="text" value="<?php echo $babamtaa; ?>">
     </div>
     </div>

    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarehe ya Kuzaliwa Baba<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="kuzaliwababa" class="form-control col-md-7 col-xs-12" name="kuzaliwababa"  required type="text" value="<?php echo $babadob; ?>">
     </div>
     </div>
                            
					<!--Mama-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Majina Kamili la Mama (Matatu)<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="mama" class="form-control col-md-7 col-xs-12" placeholder="" name="mama" required="required" type="text" value="<?php echo $mamadob; ?>"><span id="status"></span>
                                </div>
                            </div>
							
							
		<!--District Name-->
	  <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Mkoa Alipozaliwa Mama<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="mkoamama" id="mkoamama" class="form-control col-md-7 col-xs-12" required onchange="loadWilayasi(this.value)">
          <option value="">--Chagua--</option>
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
	
	 <div id="MamaTypeContainer"></div>
	
	 <!--District Name-->
	 
     <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Mtaa/Kijiji Alipozaliwa Mama<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="mtaamama" class="form-control col-md-7 col-xs-12" name="mtaamama"  required type="text" value="<?php echo $mamamtaa; ?>">
     </div>
     </div>

    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarehe ya Kuzaliwa Mama<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="kuzaliwamama" class="form-control col-md-7 col-xs-12" name="kuzaliwamama"  required type="text" value="<?php echo $mamadob; ?>">
     </div>
     </div>		
							
				
                            <!--Nationality-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Uraia Wako<span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                    <select id="national" class="form-control col-md-7 col-xs-12" name="national" required="required" onchange="loadNationality(this.value)">
                                        <!-- <option value="">--Select--</option> -->
                                        <?php
                                        while ($row = $query1->fetch()) {
                                            $id = $row['id'];

                                            echo '<option';
                                            if (isset($_SESSION['formData'])) {
                                                if ($national == $id) {
                                                    echo " selected ";
                                                }
                                            } else {
                                                if ($id == '1375') {
                                                    echo " selected ";
                                                }
                                            }
                                            echo ' value ="' . $row['id'] . '">' . $row['value'] . '</option><br>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div id="countrytz" style="display: block;">

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Aina ya Uraia <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        
                                        <select id="ainauraia" class="form-control col-md-7 col-xs-12" name="ainauraia" required="required">
                                            <option value="">--Chagua--</option>
                                            <option value="Kuzaliwa" >Kuzaliwa
                                            </option>
                                            <option value="Kuandikiswa" >Kuandikishwa
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nida">Kama ni Wakuandikishwa Taja Namba ya Hati: </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="kuandikishwahati" class="form-control col-md-7 col-xs-12" name="kuandikishwahati" type="text" placeholder="xxxxxxxxxxxxxxxxxxxx (without dashes)" >
                                    </div>
                                </div>
                            </div>

                           
                            <!--District Name-->
	  <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Mkoa Unapoishi<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <select name="mkoaishi" id="mkoaishi" class="form-control col-md-7 col-xs-12" required onchange="loadWilayasii(this.value)">
          <option value="">--Chagua--</option>
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
	
	 <div id="IshiTypeContainer"></div>
	
	 <!--mtaa unapoishi-->
	 
     

    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Mtaa/Kijiji Unapoishi<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="mtaaishi" class="form-control col-md-7 col-xs-12" name="mtaaishi"  required type="text" value='<?php echo $ishimtaa; ?>'>
     </div>
     </div>		
						

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="EditUbunge" type="submit" class="btn btn-primary" name="EditUbunge">Submit</button>
                                    <button type="reset" class="btn btn-default">Clear</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>



<script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
            /////////////////////////////////////////
            /////////////////////////////////////////
            /////////GET DISTRICT LIST///////////////
            /////////////////////////////////////////
            /////////////////////////////////////////
            function loadDistrictList(str) {

                if (str == "") {

                    document.getElementById("districtList").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("districtList").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "includes/districtList.php?q=" + str, true);

                xmlhttp.send();
            }

           function Regions(str) {

                if (str == "") {

                    document.getElementById("regDIV").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("regDIV").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/RegionsMkoa.php?q=" + str, true);

                xmlhttp.send();
            }
			
			function WilayaDistricts(str) {

                if (str == "") {

                    document.getElementById("byDistrictTypeContainer").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("byDistrictTypeContainer").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/wilayaDistricts.php?q=" + str, true);

                xmlhttp.send();
            }
			//districtByReg111
			function Districtsss(str) {

                if (str == "") {

                    document.getElementById("byDistrictTypeContainer").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("byDistrictTypeContainer").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/districtByReg112.php?q=" + str, true);

                xmlhttp.send();
            }
			
			//Jomboss
			function Jomboss(str) {

                if (str == "") {

                    document.getElementById("byJimboTypeContainer").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("byJimboTypeContainer").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/jimboByReg.php?id=" + str, true);

                xmlhttp.send();
            }
			//
			function KataWards(str) {

                if (str == "") {

                    document.getElementById("byJimboTypeContainer").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("byJimboTypeContainer").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/kataWards.php?q=" + str, true);

                xmlhttp.send();
            }

            // loadNationality
            function loadNationality(str) {
                // alert(str);
                if (str == "1375") {
                    // $("#countrytz".show();
                    $("#countrytz").show();
                    // alert("hello");
                } else {
                    $("#countrytz").hide();

                }
            }

            // loadDisiability
            function loadDisiability(str) {
                // alert(str);
                if (str == "YES") {
                    // $("#countrytz".show();
                    $("#disiabilityDIV").show();
                    // alert("hello");
                } else {
                    $("#disiabilityDIV").hide();

                }

            }


            // empoled
            function loadEmployed(str) {
                // alert(str);
                if (str == "YES") {
                    // $("#countrytz".show();
                    $("#employed").show();
                    // alert("hello");
                } else {
                    $("#employed").hide();

                }

            }

            // loadDisiability
            function loadOthers(str) {
                // alert(str);
                if (str == "others") {
                    // $("#countrytz".show();
                    $("#others").show();
                    // alert("hello");
                } else {
                    $("#others").hide();

                }

            }

            //////////////////////////////////////////
            ///////////////////////////////////////////
            //////PROCESSING REQUIREST FROM MODALS////
            ///////////////////////////////////////////
            //////////////////////////////////////////

            //<
            //!-- -- - Add New User-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getadduser', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addUser-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addUser.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addUser-content').html(''); // blank before load.
                            $('#addUser-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addUser-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            /////////////////////////////////////
            ////////////FACILITY////////////////
            ///////////////////////////////////

            //<
            //!-- -- - Add New Facility-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getaddFacility', function(e) {
                    e.preventDefault();

                    var user_id = $(this).data('id'); // get id of clicked row


                    $('#addFacility-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/addFacility.php',
                            type: 'POST',
                            data: 'userID=' + user_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#addFacility-content').html(''); // blank before load.
                            $('#addFacility-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#addFacility-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });


            //<
            //!-- -- - Delete Facility-- -- - >
            $(document).ready(function() {

                $(document).on('click', '#getdeleteF', function(e) {
                    e.preventDefault();

                    var fac_id = $(this).data('id'); // get id of clicked row


                    $('#deleteFacility-content').html(''); // leave this div blank
                    $('#modal-loader').show(); // load ajax loader on button click

                    $.ajax({
                            url: 'includes/deleteFacility.php',
                            type: 'POST',
                            data: 'fac_id=' + fac_id,
                            dataType: 'html'
                        })
                        .done(function(data) {
                            console.log(data);
                            $('#deleteFacility-content').html(''); // blank before load.
                            $('#deleteFacility-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function() {
                            $('#deleteFacility-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

                });
            });
        </script>


        <!--FORM VALIDATION SCRIPT -->
        <!-- form validation -->
        <script src="../js/validator/validator.js"></script>
        <script>
            // initialize the validator function
            validator.message['date'] = 'not a real date';

            // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
            $('form')
                .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                .on('change', 'select.required', validator.checkField)
                .on('keypress', 'input[required][pattern]', validator.keypress);

            $('.multi.required')
                .on('keyup blur', 'input', function() {
                    validator.checkField.apply($(this).siblings().last()[0]);
                });

            // bind the validation to the form submit event
            //$('#send').click('submit');//.prop('disabled', true);

            $('form').submit(function(e) {
                e.preventDefault();
                var submit = true;
                // evaluate the form using generic validaing
                if (!validator.checkAll($(this))) {
                    submit = false;
                }

                if (submit)
                    this.submit();
                return false;
            });

            /* FOR DEMO ONLY */
            $('#vfields').change(function() {
                $('form').toggleClass('mode2');
            }).prop('checked', false);

            $('#alerts').change(function() {
                validator.defaults.alerts = (this.checked) ? false : true;
                if (this.checked)
                    $('form .alert').remove();
            }).prop('checked', false);


            ///////////////////////////////////////
            ///////////////////////////////////////
            ////Check if username already exist/////
            ///////////////////////////////////////
            ////////////////////////////////////////

            document.getElementById("username").onblur = function() {
                var xmlhttp;
                var username = document.getElementById("username");
                if (username.value != "") {
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("status").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "../includes/uname_availability.php?username=" + encodeURIComponent(username.value), true);
                    xmlhttp.send();
                }
            };


            //////////////////////////////////////////////////
            ////////////Check if email exist/////////////////
            ////////////////////////////////////////////////
            document.getElementById("email").onblur = function() {
                var xmlhttp;
                var email = document.getElementById("email");
                if (email.value != "") {
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("emailStatus").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "../includes/email_availability.php?email=" + encodeURIComponent(email.value), true);
                    xmlhttp.send();
                }
            };


            //////////////////////////////////////////////////
            ////////////Check if security code is correct/////
            ////////////////////////////////////////////////
            // document.getElementById("securtyCode1").onblur = function() {
            //     var xmlhttp;
            //     var securtyCode = document.getElementById("securtyCode1");
            //     if (securtyCode.value != "") {
            //         if (window.XMLHttpRequest) {
            //             xmlhttp = new XMLHttpRequest();
            //         } else {
            //             xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            //         }
            //         xmlhttp.onreadystatechange = function() {
            //             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //                 document.getElementById("capturestatus").innerHTML = xmlhttp.responseText;
            //             }
            //         };
            //         xmlhttp.open("GET", "../includes/checkcode.php?captcha_code=" + encodeURIComponent(securtyCode.value), true);
            //         xmlhttp.send();
            //     }
            // };
        </script>

        <script>
            $(function() {
                var allowsubmit = false;
                //on keypress of password 1
                $('#password2').keyup(function(e) {


                    //get values
                    var password = $('#password').val();
                    var password2 = $(this).val();

                    //check the strings
                    if (password == password2) {
                        //if both are same remove the error and allow to submit
                        $('.error').text('');
                        $("#errorShow").hide();
                        allowsubmit = true;
                    } else {
                        //if not matching show error and not allow to submit
                        $('.error').text('Password not matching');
                        $("#errorShow").show();
                        allowsubmit = false;
                    }
                });

                //jquery form submit
                $('#form').submit(function() {

                    var password = $('#password').val();
                    var password2 = $('#password2').val();

                    //just to make sure once again during submit
                    //if both are true then only allow submit
                    if (password == password2) {
                        allowsubmit = true;
                    }
                    if (allowsubmit) {
                        return true;
                    } else {
                        return false;
                    }
                });
            });
        </script>

        <script type="text/javascript">
            function loadMonths(str) {

                if (str == "") {

                    document.getElementById("month").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("month").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "includes/list_month.php?q=" + str, true);

                xmlhttp.send();
            }

            function loadWilaya(str) {

                if (str == "") {

                    document.getElementById("byWilayaTypeContainer").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("byWilayaTypeContainer").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/districtByReg10.php?q=" + str, true);

                xmlhttp.send();
            }

                function loadWilayas(str) {

                if (str == "") {

                    document.getElementById("BabaTypeContainer").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("BabaTypeContainer").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/districtByReg15.php?q=" + str, true);

                xmlhttp.send();
            }

              function loadWilayasi(str) {

                if (str == "") {

                    document.getElementById("MamaTypeContainer").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("MamaTypeContainer").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/districtByReg12.php?q=" + str, true);

                xmlhttp.send();
            }
			
			 function loadWilayasii(str) {

                if (str == "") {

                    document.getElementById("IshiTypeContainer").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("IshiTypeContainer").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/districtByReg14.php?q=" + str, true);

                xmlhttp.send();
            }

           

            //<
            //!--Load Days for a selected month-- >
            function loadDays(str) {

                if (str == "") {

                    document.getElementById("days").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("days").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "includes/list_days.php?q=" + str, true);

                xmlhttp.send();
            }
        </script>

          