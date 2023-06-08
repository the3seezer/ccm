<?php
include "lib/dbconnect.php";
$db = new dbClass();
$db->connect();

$getName=$db->updateNames();

echo "Updated";
exit();
?>
<table width="65%" height="135" border="1" align="center">
<tr>
<td colspan="6">
<h2 align="center">PROVISIONAL CERTIFICATE TO BE PRINTED</h2>
</td>
</tr>
<tr bgcolor="#999999">
<td width="4%">SN</td>
<td width="21%">First Name</td>
<td width="20%">Last Name</td>
<td width="17%">Reg No</td>
</tr>
<?php
$i=1;
 while($row=$getName->fetch())
 {  
 $id=$row['id'];
 $firstname=$row['first_name'];
 $middle=$row['middle_name'];
 $lastname=$row['last_name'];
 ?>
  <tr>
<td><?php echo $i; ?></td>
<td><?php echo ucwords(strtolower($firstname)); ?></td>
<td><?php echo ucwords(strtolower($lastname)); ?></td>
<td><?php echo $id; ?></td>
</tr>
  <?php
  $i++;
 }
?>
</table>