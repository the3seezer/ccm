<?php
//Function to generate key
function GenKey($length = 7)
{
  $password = "";
  $possible = "0123456789abcdefghijkmnopqrstuvwxyz"; 
  
  $i = 0; 
    
  while ($i < $length) { 

    
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
       
    
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }

  }

  return $password;

}

//Function last login date
function currentDate()
{
	return date("Y-m-d");
}

//Function last login date
function currentTime()
{
	return date("H:i:s");
}

//To get extension of a document
function getExtension($str) 
{
	
	$i = strrpos($str,".");
	
	if (!$i) { return ""; }
	
	$l = strlen($str) - $i;
	
	$ext = substr($str,$i+1,$l);
	
	return $ext;
}

// Password and salt generation
function PwdHash($pwd, $salt = null)
{
    if($salt===null){
        $salt=substr(md5(uniqid(rand(),true)),0,SALT_LENGTH);
    }
    else{
        $salt=substr($salt,0,SALT_LENGTH);
    }
    return $salt.sha1($pwd.$salt);
}

?>