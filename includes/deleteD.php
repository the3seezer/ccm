<?php
 
 $docuID=$_POST['id']; 
?>
<p>Are you sure you want to delete this data</p>
<br/><br/>
<form method="post" action="includes/process.php" id="form" class="form-horizontal form-label-left">
<input id="send" type="submit" name="delDocu" class="btn btn-danger" value="Delete"/>
<input type="hidden" name="docuID" value="<?php echo $docuID; ?>"/>
</form>        