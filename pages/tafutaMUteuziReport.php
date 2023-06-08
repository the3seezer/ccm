
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
        <h3 class="page-header">Wagombea, Matokeo, na Uteuzi </h3>
    </div>
</div>
<div class="row">


    
                    <div class="dataTable_wrapper">
								     

                  <form method="post" action="manageReportUteuzi.php" class="form-horizontal form-label-center"  target="_blank">
                            <input id="idd" type="hidden" name="idd" value="<?php echo $id;?>">
         <div class="col-lg-12">
	       <div class="panel panel-default">
                      <div class="panel-heading">
                              <h4> <strong>Tafuta Wagombea, Matokeo, Uteuzi </strong></h4>
                       </div>
							
                        <div class="panel-body">
					    <div class="col-lg-12">
                            				
			<div class="form-group">
				<label>Aina ya Uchaguzi<span class="required">*</span></label>
			 
				  <select name="aina" id="aina" class="form-control col-md-7 col-xs-12" required >
				       <option value="">--Chagua--</option> 
					   <option value="Udiwani">Udiwani</option>
					   <option value="Ubunge">Ubunge</option>
				  </select>
			 </div>
			 <div class="form-group">
				<label>Ngazi ya Mtumiaji<span class="required">*</span></label>
			 
				  <select name="ngazi" id="ngazi" class="form-control col-md-7 col-xs-12" required onchange="loadNgazi(this.value)">
				       <option value="">--chagua--</option> 
					   <option value="Taifa">Taifa</option>
					   <option value="Mkoa">Mkoa</option>
					   <option value="Wilaya">Wilaya</option>
					   
			   
				  </select>
			 </div>
			 <div id="mkoaDIV"></div>
			 
	         <div class="ln_solid"></div>
										<div class="form-group">
                             <div class="col-md-6 col-md-offset-3">
                                    <button id="AddTafuta" type="submit" class="btn btn-primary" name="AddTafuta">Submit</button>
                                    <button type="reset" class="btn btn-default">Clear</button>
                                </div>
                            </div>
						 </div>
							</div>
							</div>
							
							</div>
                        </form>

                    
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
			function UserAina(str) {

                if (str == "") {

                    document.getElementById("UserAinaPrivillege").innerHTML = "";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("UserAinaPrivillege").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "lib/registerUserAd.php?q=" + str, true);

                xmlhttp.send();
            }


			
			
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

            function loadNgazi(str) {

                if (str == "") {

                    document.getElementById("mkoaDIV").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("mkoaDIV").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/mkoaReg.php?q=" + str, true);

                xmlhttp.send();
            }
			function loadKATA(str) {

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

                xmlhttp.open("GET", "lib/districtByRegChama2.php?q=" + str, true);

                xmlhttp.send();
            }
			
			function loadWARD(str) {

                if (str == "") {

                    document.getElementById("KataContainer").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("KataContainer").innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open("GET", "lib/districtByRegChama3.php?q=" + str, true);

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
			
			function loadWilayaChamaUser(str) {

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

                xmlhttp.open("GET", "lib/districtByRegChama4.php?q=" + str, true);

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

          