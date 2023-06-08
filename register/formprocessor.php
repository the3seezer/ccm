<?php session_start();
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();
  
include("../securimage/securimage.php");
if(isset($_SESSION['formData'])){unset($_SESSION['formData']);}//unset formData session 

$securimage = new Securimage();
//Check if Security code is correct
if($securimage->check($_POST['captcha_code'])==false) 
{
   $_SESSION['formData'] = $_POST; //set formData session
   
echo '<script language="javascript">';
echo "alert('The security code entered is incorrect.')";
echo '</script>';
echo '<script language="javascript">';
echo 'location.href = "../register/"';
echo '</script>';
}
else
{
/////////////////////////////////////////////
////////Personal Details/////////////////////
/////////////////////////////////////////////


$firstname=$_POST['firstname'];
$firstname1=addslashes($firstname);
$firstname2=filter_var(ucwords(strtolower($firstname1)), FILTER_SANITIZE_STRING);
$middle=$_POST['middle'];
$middle1=addslashes($middle);
$middle2=filter_var(ucwords(strtolower($middle1)), FILTER_SANITIZE_STRING);
$lastname=$_POST['lastname'];
$lastname1=addslashes($lastname);
$lastname2=filter_var(ucwords(strtolower($lastname1)), FILTER_SANITIZE_STRING);
$year=$_POST['year'];
$month=$_POST['month'];
$day=$_POST['day'];
$gender=$_POST['gender'];
$maritalStatus=$_POST['maritalStatus'];
$national=$_POST['national'];

$nida=filter_var($_POST['nida'], FILTER_SANITIZE_STRING);
$councilType=$_POST['councilType'];
$employed=$_POST['employed'];
// $checkNumber=$_POST['checkNumber'];
if(empty($_POST['checkNumber'])){
    $checkNumber = 'none'; // default value
}else{
    $checkNumber = $_POST['checkNumber'];
}

$cadreType=$_POST['cadreType'];
$councilRegistrationID=filter_var($_POST['councilRegistrationID'], FILTER_SANITIZE_STRING);
$country=$_POST['country'];
$disiability=$_POST['disiability'];
// $disiability_type=$_POST['disiability_type'];
// $other_disiability=$_POST['other_disiability'];

if(empty($_POST['disiability_type'])){
    $disiability_type = 'none'; // default value
}else{
    $disiability_type = $_POST['disiability_type'];
}

if(empty($_POST['other_disiability'])){
    $other_disiability = 'none'; // default value
}else{
    $other_disiability = $_POST['other_disiability'];
}
// echo 'nida='.$nida.' councilType='.$councilType.' councilRegistrationID='.$councilRegistrationID;exit;

$address= filter_var($_POST['address'], FILTER_SANITIZE_STRING);
$address1=addslashes($address);
$phone=filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
$email=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$userlevel='Applicant';

$monthG=explode('=',$month);
$m=$monthG[0];

$dob=$year."-".$m."-".$day;

$username=filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$_SESSION['userReg']=$username;
$_SESSION['passReg']=$password;

//Check if email exist
$data1=$db->checkEmailIfExist($email);
$countN=$data1->rowCount();

if($countN>0)
{
   echo '<script language="javascript">';
   echo "alert('Error: Not added because email exist')";
   echo '</script>';
   echo '<script language="javascript">';
   echo 'location.href = "../register/"';
   echo '</script>';

}
else
{
	//Check if username exist
   $data=$db->checkUsername($username);
   if($data->rowCount()>0)
   {
	echo '<script language="javascript">';
    echo "alert('Not Added successfully, because a user with this username is already exist.')";
    echo '</script>';
    echo '<script language="javascript">';
    echo 'location.href = "../register/"';
    echo '</script>';
   }
   else
   {
    $inertContact=$db->insertDataIntoapplicantsTable($firstname2,$middle2,$lastname2,$dob,$gender,$maritalStatus,$national,$nida,$cadreType,$councilType,$councilRegistrationID,$employed,$checkNumber,$country,$disiability,$disiability_type,$other_disiability,$address1,$phone,$email,$userlevel,$username,$password);
	
    if(isset($inertContact))
	{
	 echo '<script language="javascript">';
     echo "alert('Added sucessfully. Your username is ".$username." and password is ".$password.". Take these username and password for future use. Now, go on to complete your application process')";
     echo '</script>';
     echo '<script language="javascript">';
     echo 'location.href = "../login/"';
     echo '</script>';    
    }
	else
	{
	 echo '<script language="javascript">';
     echo "alert('Error: Not updated sucessfully')";
     echo '</script>';
     echo '<script language="javascript">';
     echo 'location.href = "../register/"';
     echo '</script>';    
    }	
   }
}
}
?>