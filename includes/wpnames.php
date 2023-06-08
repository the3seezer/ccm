<?php
include("../lib/dbconnect.php");

$db = new dbClass();
$db->connect();

$q = $_GET['q'];

$selectreg = $db->getAllRegionName();

$getM = $db->getMinistry();

$getRas = $db->getAllRASName();
$getfac = $db->getOnlyFacility();
$getcouncil = $db->getOnlyDistrict();

include('../lib/criteria_setting_selections.php');
?>
   