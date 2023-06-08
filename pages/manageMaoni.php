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
        <h3 class="page-header">Maoni na Mapendekezo</h3>
    </div>
</div>
<div class="row">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">

                    <strong>SEHEMU YA TATU</strong> 

                </div>
                <!--/.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
								     

                      <form method="post" action="includes/process.php" class="form-horizontal form-label-left" novalidate>
                            <input id="idd" type="hidden" name="idd" value="<?php echo $id;?>">
        

                

                            
	 <div class="col-lg-12">
	 <div class="panel panel-default">
                  <div class="panel-heading">
                         <h4> <strong>10.0 MAONI NA MAPENDEKEZO YA VIKAO VYA UTEUZI</strong></h4>
						 <h5> <strong> (a) VIKAO VYA UTEUZI WA AWALI</strong></h5>
                            </div>
                    <div class="panel-body">
			<div class="col-lg-12">
	 <div class="form-group">
     <label >Aina ya Kikao/Kamati<span class="required">*</span></label>
     
          <select name="aina" id="jinai" class="form-control col-md-7 col-xs-12" required onchange="loadVikao(this.value)">
          <option value="">--Chagua--</option>
           <option value="I">(i) Kikao cha Awali (Kabla ya Kura za Maoni)</option>
		   <option value="II">(ii) Kikao cha Pili (Kabla ya Kura za Maoni)</option>
		   <option value="III">(iii) Kikao cha Tatu (Kabla ya Kura za Maoni)</option>
		   <option value="IV">(iv) Kamati Maalumu ya Halmashauri Kuu ya CCM ya Taifa Zanzibar</option>
		   <option value="V">(v) Kikao cha Uteuzi wa Awali</option>
          </select>
     
     </div>
     </div>
	 <div id="Container20"></div> 
	 
	     </div>
	 </div>
	 </div>
                          <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="AddMaoni" type="submit" class="btn btn-primary" name="AddMaoni">Submit</button>
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
            function loadVikao(str) {
             //alert('test');
                if (str == "") {

                    document.getElementById("Container20").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("Container20").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "lib/vikao.php?q=" + str, true);

                xmlhttp.send();
            }

          function loadDistrictList(str) {

                if (str == "") {

                    document.getElementById("Container").innerHTML = "<option  value='' >--select--</option>";
                    return;
                }
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("Container").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "lib/vikao.php?q=" + str, true);

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

          