<?php

	$id = $_GET['id'];
?>
<script src="js/jquery.min.js"></script>

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Maombi ya Mgombea </h3>
    </div>
</div>
<div class="row">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <strong>SEHEMU YA KWANZA: ELIMU YA MGOMBEA</strong> 

                </div>
                <!--/.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
								     

                      <form enctype="multipart/form-data" action="includes/process.php" method="post" class="form-horizontal form-label-left">
<input id="idd" type="hidden" name="idd" value="<?php echo $id;?>">
<div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Aina ya Cheti <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="aina" class="form-control col-md-7 col-xs-12" name="aina" required="required" onchange="loadWilayasi(this.value)">
                    <option value="">--Chagua--</option>
					<option>Passport</option>
					<option>CV</option>
                    <option>Form Four Certificate</option>
                    <option>Form Six Certificate</option>
					<option>Certificate</option>
					<option>Passport</option>
                    <option>Diploma</option>
                    <option>Advanced Diploma</option>
					<option>Bachelor</option>
					<option>Masters</option>
					<option>PhD</option>
				
            </select>
        </div>
    </div>
   

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">
            
            Kivuli cha Cheti <span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">

            <input type="file" class="form-control" name="certificate" required>
            <br><small class="text-center text-danger">Only file with max size of 1024KB/1MB allowed </small>
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button id="send" type="submit" name="AddPicha" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-default">Clear</button>
            <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
        </div>
    </div>
</form>

<script type="text/javascript">
    function loadDivision(str) {
        // alert(str);
        if (str == "Division") {
            // $("#countrytz".show();
            $("#division").show();
            // alert("hello");
        } else {

            $("#division").hide();

        }

        if (str == "Merit") {
            $("#merit").show();
        } else {

            $("#merit").hide();
        }

    }
	function loadWilayasi(str) {

                if (str == "") {

                    document.getElementById("MamaTypeContainer").innerHTML = "";
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

                xmlhttp.open("GET", "lib/educationAina.php?q=" + str, true);

                xmlhttp.send();
            }
           </script>

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
<?php  ?>
