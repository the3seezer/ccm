<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

$id=$_POST['id'];
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
    <p>Do you want to delete this information?</p>
    <br/><br/>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <input type="submit"  id="send"  class="btn btn-danger" name="deleteCourse" value="Delete"/>

            <input type="hidden" name="course_id" value="<?=$id ?>"/>

        </div>
    </div>
</form>