<?php //if($_SESSION['level']=="All"){ 
if(($_SESSION['aina']=="Tehama")||($_SESSION['aina']=="Kiongozi"))
{
include("adminDashboard.php");
}

elseif($_SESSION['aina']=="Mgombea"){

include("mgombea.php");

}

