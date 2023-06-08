<?php
session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id = $_GET['q'];
if($id=="Mgombea")
{
}
else
{
?>

			 
			 <div class="form-group">
				<label>Kazi Katika Mfumo<span class="required">*</span></label>
			 
				  <select name="kazi" id="kazi" class="form-control col-md-7 col-xs-12" required >
				       <option value="">--chagua--</option>
                      <?php					   
					   if($_SESSION['kazi']=="Super"){
						   ?>
					   <option value="kuangalia">Kuangalia Taarifa</option>
					   <option value="kuingiza">Kuingiza Taarifa/Katibu</option>
					   <option value="Admin">Msimamizi Mdogo/Junior ICT Manager</option>
					   <option value="Adminz">Msimamizi Mkuu Tehama Zanzibar</option>
					   <option value="Super">Msimamizi Mkuu Tehama Taifa</option>
			          <?php
                       }				   
					   elseif($_SESSION['kazi']=="Admin"){
						   ?>
					   <option value="kuangalia">Kuangalia Taarifa</option>
					   <option value="kuingiza">Kuingiza Taarifa/Katibu</option>
					   <option value="Admin">Msimamizi Mdogo/Junior ICT Manager</option>
					   
					   <?php
                       }				   
					  elseif($_SESSION['kazi']=="Adminz"){
						   ?>
						   <option value="kuangalia">Kuangalia Taarifa</option>
					       <option value="kuingiza">Kuingiza Taarifa/Katibu</option>
					       <option value="Admin">Msimamizi Mdogo/Junior ICT Manager</option>
						   <option value="Adminz">Msimamizi Mkuu Tehama Zanzibar</option>
						   <?php
					   }
					   ?>
				  </select>
			 </div>
			 <div class="form-group">
				<label>Ngazi ya Mtumiaji<span class="required">*</span></label>
			 
				  <select name="ngazi" id="ngazi" class="form-control col-md-7 col-xs-12" required onchange="loadNgazi(this.value)">
				       <option value="">--chagua--</option> 
					   <?php
                       				   
					   if($_SESSION['ngazi']=="Taifa"){
						   ?>
					   <option value="Taifa">Taifa Zima</option>
					   <option value="Zanzibar">Taifa Zanzibar</option>
					   <option value="Mkoa">Mkoa</option>
					   <option value="Wilaya">Wilaya</option>
					   <option value="Kata">Kata</option>
			         <?php
                       }				   
					   elseif($_SESSION['ngazi']=="Zanzibar"){
						   
						   ?>
						   <option value="Zanzibar">Taifa Zanzibar</option>
					       <option value="Mkoa">Mkoa</option>
					       <option value="Wilaya">Wilaya</option>
					       <option value="Kata">Kata</option>
						 <?php
                       }				   
					   elseif($_SESSION['ngazi']=="Mkoa"){
						   
						   ?> 
						   <option value="Mkoa">Mkoa</option>
					       <option value="Wilaya">Wilaya</option>
					       <option value="Kata">Kata</option>
						   <?php
                       }				   
					   elseif($_SESSION['ngazi']=="Wilaya"){
						   
						   ?>
						   <option value="Wilaya">Wilaya</option>
					       <option value="Kata">Kata</option>
						    <?php
                       }				   
					   elseif($_SESSION['ngazi']=="Kata"){
						   
						   ?>
						   <option value="Kata">Kata</option>
					   <?php }?>
				  </select>
			 </div>
			 <div id="mkoaDIV"></div>
	         <div id="WilayaContainer"></div>
			  <div id="KataContainer"></div>
			 <?php if($id== "Kiongozi")
			 {
				 ?>
			   <div class="panel panel-default">
                <div class="panel-heading">

                    <strong>Chagua Kazi za Kiongozi Anayeingiza Taarifa </strong> 

                </div>
                <!--/.panel-heading -->
                <div class="panel-body">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kithibitisha" value="Yes">Kuthibitisha Mgombea
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kikaokawali" value="Yes">Kikao Cha Awali (Kabla ya Kura za Maoni)
					</label>
				</div>
				<div class="checkbox">
					<label>
				<input type="checkbox" name="kikaokpili" value="Yes">Kikao Cha Pili (Kabla ya Kura za Maoni)
					</label>
                     
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kikaoktatu" value="Yes">Kikao Cha Tatu (Kabla ya Kura za Maoni)
					</label>

				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kamatizanziba" value="Yes">Kamati Maalumu ya Halmashauri Kuu CCM (Taifa Zanziba)
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kikaoutezi" value="Yes">Kikao Cha Uteuzi wa Awali
					</label>
					</div>
					
                <div class="checkbox">
					<label>
						<input type="checkbox" name="kuramaoni" value="Yes">Kuratibu Kura za Maoni
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kikaobawali" value="Yes">Kikao cha Ngazi ya Awali (Baada ya Kura)
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kikaobpili" value="Yes">Kikao cha Ngazi ya Pili (Baada ya Kura)
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kikaobtatu" value="Yes">Kikao cha Ngazi ya Tatu (Baada ya Kura)
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kamatimaalumza" value="Yes">Kamati Maalum ya Halmashauri Kuu CCM (Zanziba)
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kamatitaifa" value="Yes">Kikao Kamati Kuu ya Halmashauri Kuu ya CCM (Taifa)
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="kamatimwisho" value="Yes">Kikao cha Halmashauri Kuu ya CCM ya Taifa (Uteuzi wa Mwisho)
					</label>
					
				</div>
				
				
	              </div>
				  </div>
				  <?php
				  }
				  ?>
				  
<?php
}
?>		 
							
							