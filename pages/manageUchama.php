<?php
$id=$_GET['id'];
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
        <h3 class="page-header">Uanachama</h3>
    </div>
</div>
<div class="row">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">

                    <strong>SEHEMU YA PILI</strong> 

                </div>
                <!--/.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
								     

                      <form method="post" action="includes/process.php" class="form-horizontal form-label-left" novalidate>
                            <input id="idd" type="hidden" name="idd" value="<?php echo $id;?>">
         <div class="col-lg-12">
	       <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4> <strong>2.0 UANACHAMA, UONGOZI NA MAADILI</strong></h4>
                            </div>
							
                            <div class="panel-body">
							<div class="col-lg-12">
                            <!--kadi-->
					
							
                           
							<div class="alert alert-warning22"><h4> <strong>a) Uanachama wa CCM </strong></h4>
							 
							 </div>
							 <div class="col-lg-12">
							 
							<div class="form-group">
                                <label> Namba ya Kadi ya Zamani <span class="required">*</span> </label>
                                
                                    <input id="kadizamani" class="form-control col-md-7 col-xs-12" name="kadizamani" required="required" type="text" data-validate-length-range="2,50" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                                            print_r($_SESSION['formData']['lastname']);
                                                                                                                                                                                        } ?>">
                                </div>
                            
							
							
							<!--District Name-->
	  <div class="form-group">
     <label>Mkoa<span class="required">*</span></label>
     
          <select name="mkoa" id="mkoa" class="form-control col-md-7 col-xs-12" required onchange="loadWilayaChama(this.value)">
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
     
	
	 <div id="WilayaContainer"></div>
	
	 <!--tawi-->
	 
     <div class="form-group">
     <label >Tawi<span class="required">*</span></label>
     
          <input id="tawi" class="form-control col-md-7 col-xs-12" name="tawi"  required type="text">
     
     </div>

                <!--tarehe-->
                            <div class="form-group">

                                <label>Tarehe iliyotolewa<span class="required">*</span> </label>
                           </div> <div class="form-group">
                                <div class="col-md-3 col-xs-12">
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
                                        <option value="">--Mwezi--</option>
										
                    
                                    </select>
                                </div>


                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control" id="days" name="days" required>
                                                                                <option value="">--Siku--</option>
										<?php for ($i = 1; $i <= 31; $i++) { //Applicant must have less or equal to 45 years
                                        ?>
                                            <option><?php echo $i; ?></option><?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!--kadi-->
                            <div class="form-group">
                                <label class="" for="last">Namba ya Kadi Mpya <span class="required">*</span> </label>

                                    <input id="kadimpya" class="form-control col-md-7 col-xs-12" name="kadimpya" required="required" type="text" data-validate-length-range="2,50" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                                            print_r($_SESSION['formData']['lastname']);
                                                                                                                                                                                        } ?>">
                               
                            </div>
							
							
							<!--District Name-->
	  <div class="form-group">
     <label>Mkoa<span class="required">*</span></label>
    
          <select name="mkoam" id="mkoam" class="form-control col-md-7 col-xs-12" required onchange="loadWilaya(this.value)">
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
     
	
	 <div id="byWilayaTypeContainer"></div>
	
	 <!--tawi-->
	 
     <div class="form-group">
     <label>Tawi<span class="required">*</span></label>
     
          <input id="tawim" class="form-control col-md-7 col-xs-12" name="tawim"  required type="text">
     </div>
     

                <!--tarehe-->
                            <div class="form-group">

                                <label >Tarehe iliyotolewa<span class="required">*</span> </label>
              </div> <div class="form-group">
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control" id="yearm" name="yearm" required onChange="loadMonthsm(this.value)">
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
                                    <select class="form-control col-md-7 col-xs-12" id="monthm" name="monthm" required onchange="loadDaysm(this.value)">
                                        <option value="">--Mwezi--</option>
										
                    
                                    </select>
                                </div>


                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control" id="daysm" name="daysm" required>
                                                                                <option value="">--Siku--</option>
										<?php for ($i = 1; $i <= 31; $i++) { //Applicant must have less or equal to 45 years
                                        ?>
                                            <option><?php echo $i; ?></option><?php } ?>
                                    </select>
                                </div>
                            
                            </div>
                     <!--hadi-->
                            <div class="form-group">
                                <label for="name">Umelipa Ada Hadi lini?<span class="required">*</span> </label>
                                
                                    <input id="hadi" class="form-control col-md-7 col-xs-12" placeholder="" name="hadilini" required="required" type="text" data-validate-length-range="4,50" value=""><span id="status"></span>
                                
                            </div>
					 <div class="form-group">		
                  <div class="alert alert-warning22"><h4> <strong>b) Uanachama wa Jumuiya za CCM </strong></h4>
							 
							 </div> </div>
				  
	              <!--kadiUWT-->
                            <div class="form-group">
                                <label for="last">Namba ya Kadi ya UWT/UVCCM/WAZAZI <span class="required">*</span> </label>
                                
                                    <input id="kadijumuia" class="form-control col-md-7 col-xs-12" name="kadijumuia" required="required" type="text" data-validate-length-range="2,50" value="<?php if (isset($_SESSION['formData'])) {
                                                                                                                                                                                            print_r($_SESSION['formData']['lastname']);
                                                                                                                                                                                        } ?>">
                                </div>
                            	
							<!--District Name-->
	  <div class="form-group">
     <label>Mkoa<span class="required">*</span></label>
    
          <select name="mkoaju" id="mkoaju" class="form-control col-md-7 col-xs-12" required onchange="loadWilayaJu(this.value)">
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
     
	
	 <div id="Container10"></div>  
	
	 

                <!--tarehe-->
                            <div class="form-group">

                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarehe iliyotolewa<span class="required">*</span> </label>

                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control" id="yearvc" name="yearvc" required onChange="loadMonthsvc(this.value)">
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
                                    <select class="form-control col-md-7 col-xs-12" id="monthvc" name="monthvc" required onchange="loadDaysvc(this.value)">
                                        <option value="">--Mwezi--</option>
										
                    
                                    </select>
                                </div>


                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control" id="daysvc" name="daysvc" required>
                                                                                <option value="">--Siku--</option>
										<?php for ($i = 1; $i <= 31; $i++) { //Applicant must have less or equal to 45 years
                                        ?>
                                            <option><?php echo $i; ?></option><?php } ?>
                                    </select>
                                </div>
                            </div>
      <!--Uanachama-->
	 
     <div class="form-group">
       <label>Umelipa Ada ya Uanacha Hadi Lini<span class="required">*</span></label>
     
          <input id="hadilinivc" class="form-control col-md-7 col-xs-12" name="hadilinivc"  required type="text">
     
     </div>
	 
	 <!--Tawi lako-->
	 
     <div class="form-group">
       <label>Tawi Lako ya CCM Kwa Sasa<span class="required">*</span></label>
     
          <input id="tawilako" class="form-control col-md-7 col-xs-12" name="tawilako"  required type="text">
     </div>
     
	 
	 <!--Tawi lako-->
	 
     <div class="form-group">
       <label>Jina la Mwenyekiti Wako<span class="required">*</span></label>
     
          <input id="mwk" class="form-control col-md-7 col-xs-12" name="mwk"  required type="text">
     
     </div>
                                
							<!--District Name-->
	  <div class="form-group">
     <label>Umewahi kuwa Mwanachama wa Chama Kingine?<span class="required">*</span></label>
   
          <select name="kingine" id="kingine" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
           <option>Ndiyo</option>
		   <option>Hapana</option>
          </select>
     
     </div>
	 
	<div class=" form-group">
       <label>Kama ndio taja chama hicho, Muda uliotumikia na Wadhifa<span class="required">*</span></label>
    
          <input id="tajachama" class="form-control col-md-7 col-xs-12" name="tajachama"  required type="text">
     </div>
     </div>
	 </div>
     </div>
	 </div>
	 
	 <div class="col-lg-12">
	 <div class="panel panel-default">
                            <div class="panel-heading">
                              <h5> <strong>3.0 WAJIBU WA KULIPA KODI</strong></h5>
                            </div>
                            <div class="panel-body">
							<div class="col-lg-12">
	 <div class="form-group">
     <label>Je Umewahi Kutiwa Hatiani na Mahakama kwa Kosa la Kutolipa Kodi Serikalini?<span class="required">*</span></label>
     
          <select name="kodi" id="kodi" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
           <option>Ndiyo</option>
		   <option>Hapana</option>
          </select>
     </div>
     </div>
	 <div class="col-lg-12">
	 <div class="form-group">
       <label >Kama ndio eleza aina ya kodi na adhabu uliyopewa na Mahakama<span class="required">*</span></label>
     
          <input id="adhabu" class="form-control col-md-7 col-xs-12" name="adhabu"  required type="text">
     </div>
     </div>
	 </div>
     </div>
	 </div>
	 <div class="col-lg-12">
	 <div class="panel panel-default">
                            <div class="panel-heading">
                              <h5> <strong>4.0 UZOEFU WAKO KATIKA SHUGHULI ZA UONGOZI</strong></h5>
                            </div>
                            <div class="panel-body">
	 <div class="col-lg-12">
	 <div class="form-group">
       <label>Eleza Uzoefu Wako Katika Chama/Jumuiya<span class="required">*</span></label>
     
          <input id="uzoefu" class="form-control col-md-7 col-xs-12" name="uzoefu"  required type="text">
     
     </div>
	 
	 <div class="form-group">
       <label>Eleza Mchango Wako Katika Kuimarisha Uhai wa Chama<span class="required">*</span></label>
     
          <input id="mchango" class="form-control col-md-7 col-xs-12" name="mchango"  required type="text">
     </div>
     </div>
	 </div>
     </div>
	 </div>
	 <div class="col-lg-12">
	 <div class="panel panel-default">
                            <div class="panel-heading">
                              <h5> <strong>5.0 UTHIBITISHO WA MUOMBAJI</strong></h5>
                            </div>
                            <div class="panel-body">
							<div class="col-lg-12">
							
	 <div class="form-group">
       <label">Eleza Kazi Unayofanya Kupata Kipato<span class="required">*</span></label>
     
          <input id="kazi" class="form-control col-md-7 col-xs-12" name="kazi"  required type="text">
      
	 </div>
	 </div>
     </div>
	 </div>
     </div>
	 
	 
	 
	 <div class="col-lg-12">
	 <div class="panel panel-default">
                  <div class="panel-heading">
                         <h5> <strong>6.0 TABIA NA MAADILI</strong></h5>
                            </div>
                    <div class="panel-body">
			<div class="col-lg-12">
	 <div class="form-group">
     <label >Je umewahi Kupatikana na Hatia kwa Kosa la Jinai au Madai Mbele a Mahakama?<span class="required">*</span></label>
     
          <select name="jinai" id="jinai" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
           <option>Ndiyo</option>
		   <option>Hapana</option>
          </select>
     
     </div>
     </div>
	 <div class="col-lg-12">
	 <div class="form-group">
       <label>Kama ndio eleza aina ya Kosa na adhabu uliyopewa na Mahakama<span class="required">*</span></label>
    
       <input id="jinaiadhabu" class="form-control col-md-7 col-xs-12" name="jinaiadhabu"  required type="text">
    
     </div>
	 
	 </div>
	 
     <div class="col-lg-12">        
	 <div class="form-group">
     <label>Je umewahi Kushitakiwa kwa Kosa la Utovu wa Nidhamu/Maadili ndani ya Chama au Jumuiya?<span class="required">*</span></label>
    
          <select name="nidhamu" id="nidhamu" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
           <option>Ndiyo</option>
		   <option>Hapana</option>
          </select>
    
     </div>
	 </div>
	 
	 <div class="col-lg-12">
	 <div class="form-group">
	 
       <label >Kama ndio Taja Kosa hilo Adhabu Uliyopewa na Tarehe<span class="required">*</span></label>
     
          <input id="nidhamuadhabu" class="form-control col-md-7 col-xs-12" name="nidhamuadhabu"  required type="text">
     </div>
	 
	 </div>
    </div>
	 </div>
	 </div>


	 <div class="col-lg-12">
	 <div class="panel panel-default">
                            <div class="panel-heading">
                              <h5> <strong>7.0 UTHIBITISHO WA MUOMBAJI</strong></h5>
                            </div>
                            <div class="panel-body">
                
              
                <p>(i) Mimi .......nathibitisha kwamba maelezo yote niliyotoahapo juu, ni ya kweli kwa kadri ya ufahamu na imani yangu</p>

                <p>(ii) Nimesoma na kuelewa vyema Katiba, Kanuni pamoja na Sera mbalimbali za CCM na ninaahidi kuzitekeleza kwa vitendo na kuzitetea kwa nguvu na uwezo wangu wote na wala stazikosoa au kuzipinga nje ya vikao halali vya CCM/Jumuiya vinavyonihusu. </p>
                <p>(iii) Ili kudumisha umoja na mshikamano ndani ya Chama, nitakubaliana na uamuzi utakaotolewa na Chama, kuhusiana na ombi langu hili na nitashirikiana na Mgombea yeyote wa CCM, atakayeteuliwa kugombea nafasi ninayoomba. Aidha nitakuwa mwaminifu kwa Chama na kutekeleza jukumu lolote lile nitakalopangwa na Chama.</p>
      <div class="col-lg-12">
	  <div class="form-group">
	  <label> Thibitisha muombaji<span class="required">*</span></label>
	          <select name="muothibitisha" id="muothibitisha" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
           <option>Ndiyo</option>
		   <option>Hapana</option>
          </select>
	</div>
		<div class="form-group">
       <label> Tarehe ya kuthibitisha muombaji<span class="required">*</span></label>
       
          <input id="muombajithibitarehe" class="form-control" name="muombajithibitarehe"  required type="text">

	 </div>
		
        </div>
     </div>
</div>
	 
	 
   <div class="col-lg-12">
	 <div class="panel panel-default">
                            <div class="panel-heading">
			<h5><strong>8.0 UTHIBITISHO WA KATIBU WA CCM WA TAWI/KATA/WADI/JIMBO/WILAYA/MKOA</strong></h5>
			</div>
                            <div class="panel-body">
			
			
			<p>Ninathibitisha kwamba, muombaji ninamfahamu vyema na kwamba maelezo yote aliyotoa hapo juu ni ya kweli na sahihi.</p>
		       <div class="col-lg-12">
		<div class="form-group">
       <label> Jina la Katibu<span class="required">*</span></label>
       
          <input id="jinakatibuthibitisha" class="form-control col-md-7 col-xs-12" name="jinakatibuthibitisha"  required type="text">   
	 </div>
			   <div class="form-group">
	  <label> Ngazi ya Katibu<span class="required">*</span></label>
	          <select name="ngazikatibu" id="ngazikatibu" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
		    <option>Tawi</option>
		    <option>Wadi</option>
			<option>Kata</option>
            <option>Jimbo</option>
		    <option>Wilaya</option>
		    <option>Mkoa</option>
          </select>
	   </div>
			   <div class="form-group">
	  <label> Thibitisha Katibu<span class="required">*</span></label>
	          <select name="katibuthibitisha" id="katibuthibitisha" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
           <option>Ndiyo</option>
		   <option>Hapana</option>
          </select>
	   </div>
	
	</div>
	 <div class="col-lg-12">
		 <div class="form-group">
		   <label > Tarehe ya kuthibitisha Katibu<span class="required">*</span></label>
			  <input id="katibuthibitishatarehe" class="form-control col-md-7 col-xs-12" name="katibuthibitishatarehe"  required type="text">	
		       </div>
		      </div>
		     </div>
	        </div>
	        </div>
            <div class="ln_solid"></div>
                        <div class="form-group">
                             <div class="col-md-6 col-md-offset-3">
                                    <button id="AddUchama" type="submit" class="btn btn-primary" name="AddUchama">Submit</button>
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
			
			function loadMonthsm(str) {

                if (str == "") {

                    document.getElementById("monthm").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("monthm").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "includes/list_month.php?q=" + str, true);

                xmlhttp.send();
            }
			function loadMonthsvc(str) {

                if (str == "") {

                    document.getElementById("monthvc").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("monthvc").innerHTML = xmlhttp.responseText;
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

              function loadWilayaChama(str) {

                if (str == "") {

                    document.getElementById("WilayaContainer").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("WilayaContainer").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/districtByRegChama.php?q=" + str, true);

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
			
			function loadWilayaJu(str) {

                if (str == "") {

                    document.getElementById("Container10").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("Container10").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/districtByRegJu.php?q=" + str, true);

                xmlhttp.send();
            }

                function loadWilayas(str) {

                if (str == "") {

                    document.getElementById("Container10").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("Container10").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/districtByRegJu.php?q=" + str, true);

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
			 function loadDaysm(str) {

                if (str == "") {

                    document.getElementById("daysm").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("daysm").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "includes/list_days.php?q=" + str, true);

                xmlhttp.send();
            }
			 function loadDaysvc(str) {

                if (str == "") {

                    document.getElementById("daysvc").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("daysvc").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "includes/list_days.php?q=" + str, true);

                xmlhttp.send();
            }
        </script>

          