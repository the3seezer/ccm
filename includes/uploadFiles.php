<?php
include("../lib/dbconnect.php");
$db = new dbClass();
$docuType=$_POST['docuType'];
$name = $_FILES['photo']['name']; //Name of image
$extensional=getExtension($name);// Get extension
$applicant_id=$_POST['applicant_id'];
    $insertF=$db->insertFile($docuType,$applicant_id,$extensional,$name);
?>