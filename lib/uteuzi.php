<?php
//include("../lib/dbconnect.php");
//$db = new dbClass();
//$db->connect();

$id = $_GET['q'];
//$id = 1;
//$selectreg = $db->getOnlyDistrictByRegID($id);


if(($id=="I") or($id=="II")or($id=="III"))
{
?>
<!--kikao-->
<div class="form-group">
	  <label>Mapendekezo<span class="required">*</span></label>
	          <select name="katibuthibitisha" id="katibuthibitisha" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
            <option>Anafaa</option>
		    <option>Hafai</option>
		    <option>Ameteuliwa</option>
		    <option>Hakuteuliwa</option>
          </select>
	   </div>
	
	 <div class="form-group">
       <label>Ufafanuzi ya Mapendekezo na Uteuzi<span class="required">*</span></label>
	    </div>
    <div class="form-group">
              <textarea id="ufafanuzi" class="form-control col-md-7 col-xs-12" name="ufafanuzi" rows="4" cols="50"></textarea>
     </div>
	
	 <div class="form-group">
     <label >Jina la Katibu<span class="required">*</span></label>
     
         <input id="jina" class="form-control col-md-7 col-xs-12" name="jina"  required type="text">
     
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
			<option>Taifa</option>
          </select>
	   </div>
	 <div class="form-group">
     <label >Tarehe ya Kikao<span class="required">*</span></label>
     
         <input id="tarehe" class="form-control col-md-7 col-xs-12" name="tarehe"  required type="text">
     
     </div>

<?php
}
elseif($id=="IV")
{
?>
<!--kikao-->
<div class="form-group">
	  <label>Mapendekezo<span class="required">*</span></label>
	          <select name="katibuthibitisha" id="katibuthibitisha" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
            <option>Anafaa</option>
		    <option>Hafai</option>
		    <option>Ameteuliwa</option>
		    <option>Hakuteuliwa</option>
          </select>
	   </div>
	
	 <div class="form-group">
       <label>Ufafanuzi ya Mapendekezo na Uteuzi<span class="required">*</span></label>
	    </div>
    <div class="form-group">
              <textarea id="ufafanuzi" class="form-control col-md-7 col-xs-12" name="ufafanuzi" rows="4" cols="50"></textarea>
     </div>
	
	 <div class="form-group">
     <label >Jina la Naibu Katibu Mkuu wa CCM (Z)<span class="required">*</span></label>
     
         <input id="jina" class="form-control col-md-7 col-xs-12" name="jina"  required type="text">
     
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
			<option>Taifa</option>
          </select>
	   </div>
	 <div class="form-group">
     <label >Tarehe ya Kikao<span class="required">*</span></label>
     
         <input id="tarehe" class="form-control col-md-7 col-xs-12" name="tarehe"  required type="text">
     
     </div>	
<?php
}
elseif(($id=="V")or($id=="VI"))
{
?>

<div class="form-group">
	  <label>Mapendekezo<span class="required">*</span></label>
	          <select name="katibuthibitisha" id="katibuthibitisha" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
            <option>Anafaa</option>
		    <option>Hafai</option>
		    <option>Ameteuliwa</option>
		    <option>Hakuteuliwa</option>
          </select>
	   </div>
	
	 <div class="form-group">
       <label>Ufafanuzi ya Mapendekezo na Uteuzi<span class="required">*</span></label>
	    </div>
    <div class="form-group">
              <textarea id="ufafanuzi" class="form-control col-md-7 col-xs-12" name="ufafanuzi" rows="4" cols="50"></textarea>
     </div>
	
	 <div class="form-group">
     <label >Jina la Katibu Mkuu wa CCM<span class="required">*</span></label>
     
         <input id="jina" class="form-control col-md-7 col-xs-12" name="jina"  required type="text">
     
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
			<option>Taifa</option>
          </select>
	   </div>
	 <div class="form-group">
     <label >Tarehe ya Kikao<span class="required">*</span></label>
     
         <input id="tarehe" class="form-control col-md-7 col-xs-12" name="tarehe"  required type="text">
     
     </div>

<?php
}

?>
	
