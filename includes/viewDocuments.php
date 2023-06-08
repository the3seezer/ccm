<?php

$id=$_GET['id'];
$ext=$_GET['ext'];
$path="../documents/ccm".$id.".".$ext;
?><!--style="width:100px;height:100px;"-->
<p><img src="<?php echo $path; ?>"></p>
        