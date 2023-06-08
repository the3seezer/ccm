 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tiisor_wao";

$id = $_GET['id'];


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $sql = "INSERT INTO application_status (firstname, lastname, email)
    // VALUES ('John', 'Doe', 'john@example.com')";

    $sql = "UPDATE application SET status='Accepted' WHERE applicant_id='$id' ";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    //$stmt->execute();

    // echo a message to say the UPDATE succeeded
    //echo $stmt->rowCount() . " records UPDATED successfully";
    if($stmt->execute()){
     echo '<script language="javascript">';
     echo "alert('Accepted sucessfully')";
     echo '</script>';
     echo '<script language="javascript">';
     echo 'location.href = "?pg=agenciesApp"';
     echo '</script>';   
     }
     else
     {
    echo '<script language="javascript">';
    echo "alert('Error: Not Accepted sucessfully')";
    echo '</script>';
    echo '<script language="javascript">';
    echo 'location.href = "?pg=agenciesApp"';
    echo '</script>';
     }

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

// $conn = null;

    //include("lib/dbconnect.php");
    // $id = $_GET['id'];
    // $query = "select * from `application` where `applicant_id` = '$id'; ";
    // if(count(fetchAll($query)) > 0){
    //     foreach(fetchAll($query) as $row){
    //         $status = "Accepted";
    //         $fac_id = "11";
    //         $carde_id = "11";
    //         $date = now();
    //         $id=$_POST['applicant_id'];
    //         $query = "INSERT INTO `application_status` (`id`, `fac_id`, `carde_id`, `date`, `applicant_id`) VALUES ('$fac_id', '$carde_id', '$date', '$id');";
    //     }
    //     $query .= "DELETE FROM `application` WHERE `application`.`id` = '$id';";
    //     if(performQuery($query)){
    //         echo "Account has been accepted.";
    //     }else{
    //         echo "Unknown error occured. Please try again.";
    //     }
    // }else{
    //     echo "Error occured.";
    // }
    ?> 

