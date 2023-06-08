<?php
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();

$email=$_REQUEST['email'];
$data1=$db->checkEmailIfExist($email);
if($data1->rowCount()>0)
{
print "<span style=\"color:red;\">Error: A user with this email has already registered.</span>";
exit();
}
else
{
print "<span style=\"color:green;\">Email is Ok just proceed!</span>";
}
?>