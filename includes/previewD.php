<?php
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();
$docuID = $_POST['docuID'];


//Get document Name and extension when docuID=$docuID;
$seDoc1 = $db->getDocumentNameExtension($docuID);
$rwDoc1 = $seDoc1->fetch();
$dName = $rwDoc1['docName'];
$ext = $rwDoc1['extension'];

if (isset($dName))
    $file_pointer = $dName . "." . $ext;
else
    $file_pointer = "n";

$file = dirname(__DIR__) . "\documents\\" . $file_pointer;

$files = file("../documents/" . $file_pointer);

?>

<br/>
<div style="text-align: center;">
    <?php if (isset($file)) {
        ?>
        <iframe src="<?php echo "documents/" . $file_pointer ?>" style="width:800px; height:800px;" frameborder="0">
        </iframe>
        <?php
    } else {
        echo "The file does not exists please upload";
        echo "<br>";
    } ?>

</div>      