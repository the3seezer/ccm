<?php
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();
$username=$_REQUEST['username'];
/*
if(preg_match("/[^a-z0-9]/",$username))
{
print "<span style=\"color:red;\">Username contains illegal charaters.</span>";
exit;
}
*/
if(preg_match("/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/",$username))
{
print "<span style=\"color:red;\">Error.Make sure that your username is not your email address.It can be something like medel8888.</span>";
exit;
}

$data=$db->checkUsername($username);
if($data->rowCount()>0)
{
print "<span style=\"color:red;\">This username has already registered, try another one</span>";
}
else
{
print "<span style=\"color:green;\">Username is Ok just proceed!</span>";
}
?>