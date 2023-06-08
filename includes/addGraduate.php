<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$applicant_id=$_POST['applicant_id'];

$curl = curl_init();

//Set some options/settings
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://41.93.40.136/nacteapi/index.php/institutions',
    CURLOPT_USERAGENT => 'WAO to NACTE cURL Request'
));

//Send the request & save response to $resp(JSON string)
if(!curl_exec($curl)){
    die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}else{
	$json_resp = curl_exec($curl);
}

//Convert JSON string to Array
$institutionsArray = json_decode($json_resp, true);


?>

<form  action="?pg=grad" method="post"  class="form-horizontal form-label-left">
              
			  <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">College RegNo<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="end" class="form-control col-md-7 col-xs-12"  name="collegRegNo"  required="required" type="text">
               </div>
               </div>
			  

			  <!--College of Study-->
               <div class="item form-group">
                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">College of Study<span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
			   
                <select id="college" class="form-control col-md-7 col-xs-12"  name="college"  required="required" onchange="loadProgrammeByInstId(this.value)">
                   <option value="">--Select Institution--</option>
                    <?php foreach ($institutionsArray as $key => $value){?>
                   <option value="<?php echo $value["Institution_NIRID"];?>">
				   <?php echo $value["Institution_Name"];?>
			       </option>
                 <?php }?>
                </select>
			   
               </div>
               </div>	



 
               <!--Course Name-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Course Name<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="programme" class="form-control col-md-7 col-xs-12"  name="programme"  required="required">
               <option value="">--Select--</option>
               </select>
               </div>
               </div>
               
               
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12">Completed Academic Year<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="end" class="form-control col-md-7 col-xs-12" placeholder="E.g 2011/2012"  name="end"  required="required" type="text">
               </div>
               </div>
			   
     
               <div class="ln_solid"></div>
               <div class="form-group">
               <div class="col-md-6 col-md-offset-3">
               <button id="send" type="submit" name="searchGraduate" class="btn btn-success">Submit</button>
               <button type="reset" class="btn btn-default">Clear</button>
               <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>"/>
               </div>
              </div>

</form>
	
	 
	 
	 
	 