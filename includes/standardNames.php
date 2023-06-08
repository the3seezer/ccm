<?php
include("../lib/dbconnect.php");

$db = new dbClass();
$db->connect();

$a = $_GET['a'];

$standard = $db->getStandardNames($a);
$row = $standard->fetch();
$standard_id = $row['standard_id'];

if ($standard_id == 6)
{
?>
<div class="item form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Age Range<span class="required">*</span></label>
    <div class="col-md-5 col-sm-5 col-xs-12">
        <input id="fromYear" class="form-control col-md-7 col-xs-12" Placeholder="From" name="lower_age"
               required="required" type="number" min="18">
    </div>

    <div class="col-md-5 col-sm-5 col-xs-12">
        <input id="endYear" class="form-control col-md-7 col-xs-12" name="higher_age" placeholder="To"
               required="required" type="number" min="18" max="60">
    </div>
    <input type="hidden" name="gender" value=""/>

    <?php
    }
    elseif ($standard_id == 7)//District
    {
        ?>
        <!--Region-->
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Gender<span class="required">*</span></label>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <select id="gender" class="form-control col-md-7 col-xs-12" name="gender" required="required">
                    <option value="">--Select--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="lower_age" value=""/>
        <input type="hidden" name="higher_age" value=""/>

        <?php
    } else {
        ?>
        <input type="hidden" name="lower_age" value=""/>
        <input type="hidden" name="higher_age" value=""/>
        <input type="hidden" name="gender" value=""/>

        <?php
    }

    ?>
   