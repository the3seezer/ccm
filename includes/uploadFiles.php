<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$docuType=$_POST['docuType'];
$name = $_FILES['photo']['name']; //Name of image
$extensional=getExtension($name);// Get extension
$applicant_id=$_POST['applicant_id'];//Check if file uploaded$checkF=$db->checkIfFileExist($docuType,$applicant_id);if($checkF->rowCount()>0){    echo '<script language="javascript">';    echo "alert('Error: Not uploaded sucessfully because this file exist')";    echo '</script>';    echo '<script language="javascript">';    echo 'location.href = "../?pg=DocD"';    echo '</script>'; 	}else{	
    $insertF=$db->insertFile($docuType,$applicant_id,$extensional,$name);    if(isset($insertF))	{	 echo '<script language="javascript">';     echo "alert('Added sucessfully')";     echo '</script>';     echo '<script language="javascript">';     echo 'location.href = "../?pg=DocD"';     echo '</script>';        }	else	{	 echo '<script language="javascript">';     echo "alert('Error: Not Added sucessfully')";     echo '</script>';     echo '<script language="javascript">';     echo 'location.href = "../?pg=DocD"';     echo '</script>';        }	} 
?>