<?php
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();
include("../securimage/securimage.php");$securimage = new Securimage();
if($securimage->check($_REQUEST['captcha_code'])==false) 
{
print "<span style=\"color:red;\">The security code entered is incorrect</span>";exit;
}
else
{
print "<span style=\"color:green;\">Security code is Ok just proceed!</span>";
}
?>