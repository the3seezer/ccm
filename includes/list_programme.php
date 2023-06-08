   <?php
     include "../lib/dbconnect.php";
     $db = new dbClass();
     $db->connect();
     $q=$_GET["q"];
	 //Get list of courses when education level is selected
     $sql1=$db->getCourseEducation($q);
	 ?>
    <select name="courseName" id="courseName" class="form-control"  style="width:100%; height:35px; border:1px solid #06C" required>
    <option value="">--Select--</option>
    <?php
	while($rwL=$sql1->fetch())
	{
	?>
    <option value="<?php echo $rwL['id']; ?>"><?php echo $rwL['abbreviation']; ?></option>
    <?php
	}
	?>
    </select>
    