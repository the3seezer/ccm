<?php
//include("../lib/dbconnect.php");
//$db = new dbClass();
//$db->connect();

$id = $_GET['q'];
//$id = 1;
//$selectreg = $db->getOnlyDistrictByRegID($id);


if(($id=="I") or($id=="II")or($id=="III")or($id=="V"))
{
?>
<!--kikao-->
<div class="col-lg-12">        
	 <div class="form-group">
     <label>Maoni na Mapendekezo ya Kikao Kwa Kifupi<span class="required">*</span></label>
    
          <select name="maonikifupi" id="maonikifupi" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
           <option>Anafaa Sana</option>
		   <option>Anafaa Kawaida</option>
		   <option>Anafaa Kidogo</option>
		   <option>Hafai</option>
          </select>
    
     </div>
</div>
    <div class="col-lg-12">
	 <div class="form-group">
       <label>Ufafanuzi ya Maoni na Mapendekezo<span class="required">*</span></label>
	    </div>
    <div class="form-group">
              <textarea id="ufafanuzi" class="form-control col-md-7 col-xs-12" name="ufafanuzi" rows="4" cols="50"></textarea>
     </div>
	</div>
	 
	 <div class="col-lg-12">
	 <div class="form-group">
          <label >Jina la Katibu<span class="required">*</span></label>
          <input id="katibujina" class="form-control col-md-7 col-xs-12" name="katibujina"  required type="text">
     </div>
	 </div>
	 
	<div class="col-lg-12">
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
	</div>
	
     
	 
	 <div class="col-lg-12">
	 <div class="form-group">
	 
       <label >Tarehe ya Kikao<span class="required">*</span></label>
     
          <input id="kikaotarehe" class="form-control col-md-7 col-xs-12" name="kikaotarehe"  required type="text">
     </div>
	 
	 </div>

<?php
}
elseif($id=="IV")
{
?>
<!--kikao-->
<div class="col-lg-12">        
	 <div class="form-group">
     <label>Maoni na Mapendekezo ya Kamati ya Halmashauri Kuu CCM ya Taifa (Zanzibar) Kwa Kifupi<span class="required">*</span></label>
    
          <select name="maonikifupi" id="maonikifupi" class="form-control col-md-7 col-xs-12" required>
          <option value="">--Chagua--</option>
           <option>Ndiyo</option>
		   <option>Hapana</option>
          </select>
    
     </div>
</div>
    <div class="col-lg-12">
	 <div class="form-group">
       <label>Ufafanuzi ya Maoni na Mapendekezo<span class="required">*</span></label>
    </div>  
	<div class="form-group">
              <textarea id="ufafanuzi" class="form-control col-md-7 col-xs-12" name="ufafanuzi" rows="4" cols="50"></textarea>
     </div>
	</div>
	 
	 <div class="col-lg-12">
	 <div class="form-group">
          <label >Jina la Naibu Katibu Mkuu wa CCM (Z)<span class="required">*</span></label>
          <input id="katibujina" class="form-control col-md-7 col-xs-12" name="katibujina"  required type="text">
     </div>
	 </div>
	 
	<div class="col-lg-12">
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
	</div>
	
     
	 
	 <div class="col-lg-12">
	 <div class="form-group">
	 
       <label >Tarehe ya Kamati<span class="required">*</span></label>
     
          <input id="kikaotarehe" class="form-control col-md-7 col-xs-12" name="kikaotarehe"  required type="text">
     </div>
	 
	 </div>
	 <?php
     }
	 ?>





	
