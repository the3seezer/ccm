<?php session_start(); 
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$cadreid=$_POST['cadreid'];
$sel=$db->getAllTrainingType();


$getF=$db->getHealthCadresById($cadreid);
$row=$getF->fetch();
$cadreName=$row['cadreName'];
$level=$row['level'];
$trainType=$row['trainType'];
$boardV=$row['boardV'];

if($level=='NTA4')
{
	$level1="Basic Certificate (NTA Level 4)";
}
elseif($level=='NTA5')
{
	$level1="Full Certificate (NTA Level 5)";
}
elseif($level=='NTA6')
{
	$level1="Ordinary Diploma (NTA Level 6)";
}
elseif($level=='NTA7')
{
	$level1="Advanced Diploma (NTA Level 7)";
}
elseif($level=='NTA8')
{
	$level1="Bachelor (NTA Level 8)";
}
elseif($level=='NTA9')
{
	$level1="Master (NTA Level 9)";
}
elseif($level=='NTA10')
{
	$level1="PhD (NTA Level 10)";
}


else{}
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">

      <div class="item form-group">
     <label class="control-label col-md-2 col-sm-2 col-xs-12">Training Type<span class="required">*</span></label>
      
     <div class="col-md-6 col-sm-6 col-xs-12">
      <select id="trainType" class="form-control col-md-7 col-xs-12" name="trainType" required="required">
      <option value="<?php echo $trainType; ?>"><?php echo $trainType; ?></option>
       <?php
      while($row=$sel->fetch())
      {
      ?>
     <option value="<?php echo $row['trainingtypeName']; ?>"><?php echo $row['trainingtypeName']; ?></option>
      <?php
      }
      ?>
      </select>
     </div>
     </div>
 
 
     <!--Cadre Name-->
     <div class="item form-group">
     <label class="control-label col-md-2 col-sm-2 col-xs-12">Cadre Name<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <input id="cadreName" class="form-control col-md-7 col-xs-12"  name="cadreName"  value="<?php echo $cadreName; ?>" required type="text">
     </select>
     </div>
     </div>
	 
	 
	 <!--Cadre Level-->
     <div class="item form-group">
     <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Cadre Level<span class="required">*</span> </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
       <select id="level" class="form-control col-md-7 col-xs-12"  name="level"  required="required">
         <option value="<?php echo $level; ?>"><?php echo $level1; ?></option>
         <option value="NTA4">Basic Certificate (NTA Level 4)</option>
	     <option value="NTA5">Full Certificate (NTA Level 5)</option>
         <option value="NTA6">Ordinary Diploma (NTA Level 6)</option>
         <option value="NTA7">Advanced Diploma (NTA Level 7)</option>
         <option value="NTA8">Bachelor (NTA Level 8)</option>
         <option value="NTA9">Master (NTA Level 9)</option>
         <option value="NTA10">PhD (NTA Level 10)</option>
        </select>
        </div>
        </div>	 
	 
	 <!--Board Registration Verification-->
     <div class="item form-group">
     <label class="control-label col-md-2 col-sm-2 col-xs-12">Board Registration Verification<span class="required">*</span></label>
     <div class="col-md-6 col-sm-6 col-xs-12" id="districtList">
     <select id="boardV" class="form-control col-md-7 col-xs-12" name="boardV" required="required">
     <option><?php echo $boardV; ?></option>
	 <option>Yes</option>
	 <option>No</option>
     </select>
     </div>
     </div>
	 
                                                                            
     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="editHealthCadre" value="Save"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
	 <input type="hidden" name="cadreid" value="<?php echo $cadreid; ?>"/>
	 
     </div>
     </div>
     </form>	 