<?php
$hostname = "localhost"; 
$username = "tiisor_waoUser"; 
$password = "Nuv)wX!6IBKY";
$database = "tiisor_wao";
$conn = new mysqli($hostname,$username,$password, $database);

 $response = array();
 if(isset($_GET['action'])) {
     
    switch($_GET['action']){
        
        //Sajili malalamiko
        case 'sajili':
            
        if(isValid(array('kero', 'ngazi'))) {
            $kero = $_POST['kero']; 
            $ngazi = $_POST['ngazi']; 
            $namba = $_POST['namba'];
               
             
            $stmt = $conn->prepare("SELECT * FROM db_users1 WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $namba, $ngazi);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows == 0) {
              
                 //if user is new creating an insert
            $stmt = $conn->prepare("INSERT INTO db_users1 (username, email, password) VALUES (?, ?, ?)");
                //$stmt = $conn->prepare("SELECT id FROM db_users1 WHERE username = ? OR email = ?");
             //$stmt->bind_param("ss", $namba, $ngazi);
            $stmt->bind_param("sss", $kero, $ngazi, $namba);      
                //if the user is successfully added to the database 
                if($stmt->execute()){
                   

                    $malalamiko = array(
                        'kero'=>$kero, 
                        'ngazi'=>$ngazi,
                        'namba'=>$namba
                    );
                    //adding the user data in response 
                    $response['error'] = false; 
                    $response['message'] = 'Malalamiko yako yamepokelewa, utatumiwa namba ya malalamiko si muda mrefu.'; 
                    $response['malalamiko'] = $malalamiko; 
                } else {
                    $response['error'] = true; 
                    $response['message'] = 'Malalamiko yako hayakupokelewa.'; 
                }
            } else {
                $response['error'] = true;
                $response['message'] = 'Malalamiko yalishapokelewa zamani.';
            }
            
        } else {
            $response['error'] = true; 
            $response['message'] = 'Malalamiko hayakukamilika.';
        }
        
        break; 
        case 'fuatilia':
        if(isValid(array('Namba'))){
            //getting values 
            $Namba = $_POST['Namba'];
            
            //creating the check query 
            $stmt = $conn->prepare("SELECT `kero_number`, `description`, `status` FROM `kero` WHERE kero_number=?");
            $stmt->bind_param("s",$Namba);
            $stmt->execute();
            $stmt->store_result();
            
            //if the user exist with given credentials 
            if($stmt->num_rows > 0) {
                $stmt->bind_result($kero_no, $desc, $status);
                $stmt->fetch();
                $ombi = array(
                'namba'=>$kero_no, 
                'kero'=>$desc, 
                'status'=>$status
                );
                $response['error'] = false; 
                $response['message'] = 'Ombi lako linafanyiwa.'; 
                $response['Ombi'] =  $ombi; 
            }else{
                //if the user not found 
                $response['error'] = true; 
                $response['message'] = 'Malalamiko ya namba hiyo hayapo.';
            }
        } else {
            $response['error'] = true; 
            $response['message'] = 'Umekosea namba ya malalamiko .';
        }
        
        
        break;
        
        default;
            $response['error'] = true; 
            $response['message'] = 'Invalid Action.';
        break;
    }
 } else {
    $response['error'] = true; 
    $response['message'] = 'Invalid Request.';
 }
 
 
 function isValid($params){
    foreach($params as $param) {
        //if the paramter is not available or empty
        if(isset($_POST[$param])) {
            if(empty($_POST[$param])){
                return false;
            }
        } else {
            return false;
        }
    }
    //return true if every param is available and not empty 
    return true; 
}
echo json_encode($response);
?>
